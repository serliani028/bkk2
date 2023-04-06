<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CandidateInterviews extends CI_Controller
{
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    /**
     * View Function to display candidateInterviews list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('candidate_interviews');
        $data['menu'] = 'candidate_interviews';
        $data['users'] = objToArr($this->AdminUserModel->getAll());
        $data['jobs'] = objToArr($this->AdminJobModel->getAll());
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/candidate-interviews/list');
    }

    /**
     * Function to get data for candidateInterviews jquery datatable
     *
     * @return json
     */
    public function data()
    {
        $this->checkAdminLogin();
        echo json_encode($this->AdminCandidateInterviewModel->candidateInterviewsList());
    }    

    /**
     * View Function (for ajax) to display view or conduct view page via modal
     *
     * @param integer $candidate_interview_id
     * @return html/string
     */
    public function viewOrConduct($candidate_interview_id = NULL)
    {
        $candidate_interview = $this->AdminCandidateInterviewModel->getCandidateInterview(
            'candidate_interview_id', $candidate_interview_id
        );
        echo $this->load->view('admin/candidate-interviews/edit', compact('candidate_interview'), TRUE);
    }

    /**
     * Function (for ajax) to process candidate_interview create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $data = $this->AdminCandidateInterviewModel->storeCandidateInterview();
        $this->AdminJobBoardModel->updateInterviewResultInJobApplication($data);
        $this->AdminJobBoardModel->updateOverallResultInJobApplication($data);
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('candidate_interview_recorded')))
        ));
    }

    /**
     * Function (for ajax) to display form to send email to candidate
     *
     * @return void
     */
    public function messageView()
    {
        echo $this->load->view('admin/candidates/message', array(), TRUE);
    }
    
     public function tugaskanView()
    {
        $data['jobs'] = $this->db->get_where('jobs',array('status' => 1))->result();
        echo $this->load->view('admin/candidates/tugaskan',$data, TRUE);
    }

    /**
     * Function (for ajax) to send email to candidate
     *
     * @return void
     */
    public function message()
    {
        ini_set('max_execution_time', 5000);
        $data = $this->xssCleanInput();
        $candidates = explode(',', $data['ids']);

        $this->checkIfDemo();
        $this->form_validation->set_rules('email', 'Message', 'min_length[10]|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
            exit;
        }

        foreach ($candidates as $candidate_id) {
            $candidate = objToArr($this->AdminCandidateModel->getCandidate('candidate_id', $candidate_id));
            $msg = $data['msg'];
            $message = $this->load->view('admin/emails/candidate-email', compact('candidate', 'msg'), TRUE);
            $this->sendEmail($message, $candidate['email'], lang('notification'));
        }

        echo json_encode(array(
            'success' => 'true',
            'messages' => ''
        ));
    }    
    
     public function tugaskan()
    {
        // ini_set('max_execution_time', 5000);
        $data = $this->xssCleanInput();
        $candidates = explode(',', $data['ids']);
        $jobs = $this->input->post('job_id');
        $mitra = 0;
        $date = date('Y-m-d H:i:s');
        foreach ($candidates as $candidate_id) {
            $get_mitra = $this->db->get_where('candidates',array('candidate_id' => $candidate_id))->row();
            if($get_mitra->account_id != 0){
                $mitra = $get_mitra->account_id;
            }
            
            
            
            $ceks = $this->db->get_where('resumes',array('candidate_id' => $candidate_id))->row();
            
            $dataj = array(
            'job_id' => $jobs,
            'candidate_id' => $candidate_id,
            'mitra' => $mitra,
            'resume_id' => $ceks->resume_id,
            'status' => 'applied',
            'created_at' => $date
            );
                         
            $this->db->insert('job_applications',$dataj);
            
            $cek_job = $this->db->get_where('jobs',array('job_id' => $jobs))->row();
            
            $cek_q = $this->db->get_where('job_quizes',array('job_id' => $jobs))->row();
            
            if(!empty($cek_q)){
                $job_quizes = $this->JobModel->getJobQuizes(encode($jobs));
        // echo json_encode($job_quizes);
        // die;
        foreach ($job_quizes as $quiz) {
            $candidate_quiz['candidate_id'] = $candidate_id;
            $candidate_quiz['job_id'] = $jobs;
            $candidate_quiz['job_quiz_id'] = $quiz['job_quiz_id'];
            $candidate_quiz['quiz_title'] = $quiz['quiz_title'];
            $candidate_quiz['quiz_data'] = $quiz['quiz_data'];
            $candidate_quiz['total_questions'] = $quiz['total_questions'];
            $candidate_quiz['allowed_time'] = $quiz['allowed_time'];
            $candidate_quiz['attempt'] = 0;
            $candidate_quiz['correct_answers'] = 0;
            $candidate_quiz['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('candidate_quizes', $candidate_quiz);
        }
                
            }
            
            // if($cek_job->status_psikotes == 1){
                $get_minat = $this->db->get_where('minat',array('id' => $cek_job->status_minat))->row();
                
                $generatedcode = $this->Psikotes_Model->generate_kodeAktivasi(1,$get_minat->level);
                $kode = implode(",", $generatedcode) ;
                $apply['kode_aktivasi'] = $kode;
                
            $this->db->where('created_at',$date);
            $cek_input = $this->db->update('job_applications', $apply);

            $cek_idz = $this->db->get_where('job_applications', array('kode_aktivasi'=>$apply['kode_aktivasi']))->row();
            if(!empty($cek_idz)){
            $datasa['job_application_id'] = $cek_idz->job_application_id;
            $datasa['kode_aktivasi'] = $apply['kode_aktivasi'];
            $datasa['deskripsi'] = 'TES PSIKOLOGI';
            $datasa['status'] = 0;
            $this->db->insert('tes_psikologi', $datasa);
            // }        
            }
                
            if($cek_job->id_tes_esai != 0){
                 $job_id = $jobs;
                 $data_id_in = 1;
                 $idata = $this->AdminInterviewModel->getCompleteInterview($cek_job->id_tes_esai);
            
                $candidate_interview['candidate_id'] = $candidate_id;
                $candidate_interview['job_id'] = $job_id;
                $candidate_interview['interview_title'] = $idata['interview']['title'];
                $candidate_interview['interview_data'] = json_encode($idata);
                $candidate_interview['interview_time'] = null;
                $candidate_interview['description'] = 'Silahkan Mengerjakan Tes Esai Untuk Melanjutkan Proses Seleksi';
                $candidate_interview['total_questions'] = count($idata['questions']);
                $candidate_interview['overall_rating'] = 0;
                $candidate_interview['created_at'] = date('Y-m-d G:i:s');
                $candidate_interview['user_id'] = 0;
                $this->db->insert('candidate_interviews', $candidate_interview);
                
            }
                            
            // $candidate = objToArr($this->AdminCandidateModel->getCandidate('candidate_id', $candidate_id));
            // $msg = $data['msg'];
            // $message = $this->load->view('admin/emails/candidate-email', compact('candidate', 'msg'), TRUE);
            // $this->sendEmail($message, $candidate['email'], lang('notification'));
        }

        echo json_encode(array(
            'success' => 'true',
            'messages' => ''
        ));
    }    
    
}
