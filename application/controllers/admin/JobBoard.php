<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;

class JobBoard extends CI_Controller
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
     * View Function For the overall page of job board
     *
     * @return html/string
     */
    public function index($job_id = '')
    {
        $header['page'] = lang('job_board');
        $header['menu'] = 'job_board';
        

        $jobsResults = $this->AdminJobBoardModel->getJobs();
        $jobs = $jobsResults['records'];
        $data['jobs_total_pages'] = $jobsResults['total_pages'];
        $data['jobs_pagination'] = $jobsResults['pagination'];
        $data['jobs'] = $this->load->view('admin/job-board/job-list-items', compact('jobs'), TRUE);

        //Getting session values for search, filters and pagination for jobs and candidates
        $session_data = array('jobs_per_page','jobs_search','jobs_company_id','jobs_department_id',
                            'jobs_status','candidates_per_page','candidates_search','candidates_sort',
                            'candidates_min_experience','candidates_max_experience','candidates_min_overall',
                            'candidates_max_overall','candidates_min_interview','candidates_max_interview',
                            'candidates_min_quiz','candidates_max_quiz','candidates_min_self','candidates_max_self',);
        foreach ($session_data as $value) {
            $data[$value] = $this->session->userdata($value);
        }
        $data['jobs_page'] = $this->sess('jobs_page', 1);
        $data['candidates_page'] = $this->sess('candidates_page', 1);

        $data['companies'] = objToArr($this->AdminCompanyModel->getAll());
        $data['departments'] = objToArr($this->AdminDepartmentModel->getAll());
        $data['first_job_id'] = $job_id ? $job_id : (isset($jobs[0]['job_id']) ? $jobs[0]['job_id'] : '');

        $this->load->view('admin/layout/header', $header);
        $this->load->view('admin/job-board/index', $data);
    }

    /**
     * Function (via ajax) to get data for jobs list
     *
     * @return json
     */
    public function jobsList()
    {
        $jobsResults = $this->AdminJobBoardModel->getJobs();
        $jobs = $jobsResults['records'];
        echo json_encode(array(
            'pagination' => $jobsResults['pagination'],
            'total_pages' => $jobsResults['total_pages'],
            'list' => $this->load->view('admin/job-board/job-list-items', compact('jobs'), TRUE),
        ));
    }

    /**
     * Function (via ajax) to get data for candidates list
     *
     * @param $job_id integer
     * @return json
     */
    public function candidatesList($job_id = '')
    {
        $candidatesResults = $this->AdminJobBoardModel->getCandidates($job_id);
        $candidates = $candidatesResults['records'];
        echo json_encode(array(
            // 'kelola_psikogram' => ,
            'pagination' => $candidatesResults['pagination'],
            'total_pages' => $candidatesResults['total_pages'],
            'candidates_all' => $candidatesResults['candidates_all'],
            'list' => $this->load->view('admin/job-board/candidate-list-items', compact('candidates'), TRUE),
        ));
    }

    /**
     * Function (via ajax) to view assign quiz or interview to candidate(s)
     *
     * @param $type string
     * @param $job_id integer
     * @return json
     */
    public function assignView($type = '', $job_id = '')
    {
        if ($type == 'quiz') {
            $data['quizes'] = $this->AdminQuizModel->getAll();
        } else if ($type == 'psikotes') {
           $this->db->order_by('kode_psikotest.id','DESC');
            $data['batch'] = $this->db->get_where('kode_psikotest',array('status' => 0))->result_array();
        } else {
            $data['interviews'] = $this->AdminInterviewModel->getAll();
            $data['link'] = $this->db->get('link')->result();
            $data['users'] = objToArr($this->AdminUserModel->getAll());
        }
        $data['type'] = $type;
        $data['job_id'] = $job_id;
        echo $this->load->view('admin/job-board/assign', $data, TRUE);
        exit;
    }

    /**
     * Function (via ajax) to assign quiz or interview to candidate(s)
     *
     * @return json
     */
    public function assign()
    {
        // ini_set('max_execution_time', 10000);
        $this->AdminJobBoardModel->assignToCandidates();

        $data = $this->xssCleanInput();
        $candidates = json_decode($data['candidates']);

            foreach ($candidates as $candidate_id) {
                $candidate = objToArr($this->AdminCandidateModel->getCandidate('candidate_id', $candidate_id));
                if ($data['type'] == 'interview') {
                    $interview_time = $data['interview_time'];
                    $description = $data['description'];
                    $subject = 'Zoom Interview dan Tes';
                    $message = $this->load->view(
                        'admin/emails/candidate-interview-notification', compact('candidate', 'interview_time', 'description'), TRUE
                    );
                }else {
                    $subject = lang('quiz_assigned');
                    $message = $this->load->view('admin/emails/candidate-quiz-notification', compact('candidate'), TRUE);
                }
                $this->sendEmail($message, $candidate['email'], $subject);
            }
         
            if($data['type'] == 'psikotes'){
                    $idls = $data['id_psikotes'];
                    $this->db->where('kode_psikotest.id', $data['id_psikotes']);
                    $this->db->update('kode_psikotest', array('status' => 1));
            
            }

        if (isset($data['notify_team_member'])) {
            $user = objToArr($this->AdminUserModel->getUser('user_id', $data['user_id']));
            $interview_time = $data['interview_time'];
            $description = $data['description'];
            $message = $this->load->view(
                'admin/emails/team-member-interview-notification', compact('user', 'interview_time', 'description'), TRUE
            );
            $this->sendEmail(
                $message,
                $user['email'],
                'Interview Schedule'
            );
        }

        echo json_encode(array(
            'success' => 'true',
            'messages' => $candidates
        ));
    }
    
     public function assign_rating()
    {
        $id = $this->xssCleanInput('id');
        $rating = $this->xssCleanInput('rg1');
        $detail = $this->xssCleanInput('detail');
        
        $candidates = json_decode($id);
        
        foreach ($candidates as $candidate_id) {
        
        $data = array('rating'=>$rating,'detail'=>$detail);
        $this->db->where('job_application_id',$candidate_id);
        $this->db->update('job_applications',$data);
        
        }
        
        echo json_encode(array(
            'success' => 'true',
            'messages' => 'Berti Rating Sukses'
        ));
    }

    /**
     * Function (via ajax) to update candidate job application status
     *
     * @return json
     */
    public function candidateStatus()
    {
        $action=$this->input->get('action');
        $ids=$this->input->get('ids');
        $job=$this->input->get('job');
        
        if($action == 'hired' || $action == 'rejected' || $action == 'interviewed'){
            
            if($action == 'hired'){

            foreach ($ids as $id) {
            
            $query = $this->db->get_where('candidates',array('candidate_id' => $id))->row();
            $query2 = $this->db->get_where('jobs',array('job_id' => $job))->row();
            // $this->db->update('job_applications', array('status' => $action));
            
            $email = $query->email;
            
            $datas['candidate'] = $query;
            $datas['job'] = $query2->title;
            // $datas['batas'] = $batas;
            $message = $this->load->view('admin/emails/hired',$datas, TRUE);
                  
//             $pekerjaanjob = $query2->title;
//             $pekerjaanjob2="$pekerjaanjob";
//             $nomorwa = $query->whatsapp;
//             $pesanwa = "Selamat Anda adalah Kandidat yang Lolos dan Diterima Bekerja!
            
// *PEKERJAAN DILAMAR :*
// $pekerjaanjob2

// Untuk Tahap Selanjutnya Anda diminta penanda tanganan Kontrak Kerja via Online. Silahkan cek email selanjutnya untuk link Penanda Tanganan Kontrak Kerja Anda";
//             $this->load->model('NotifwaModel');
//             $this->NotifwaModel->kirim($nomorwa, $pesanwa);
        
            $cek_kirim = $this->sendEmail(
            $message,
            $email,
            'Selamat dan Sukses'
            );
            
           
            $this->db->where('job_applications.job_id', $job);
            $this->db->where('job_applications.candidate_id', $id);
            $this->db->update('job_applications', array('status' => $action));
            
            // $this->db->where('id', $id);
            // $this->db->update('user', $data);
            
                
            // }
            
            }
            
                
            }else if($action == 'rejected'){
            
            foreach ($ids as $id) {
            
            $query = $this->db->get_where('candidates',array('candidate_id' => $id))->row();
            $query2 = $this->db->get_where('jobs',array('job_id' => $job))->row();
            // $this->db->update('job_applications', array('status' => $action));
            
            $email = $query->email;
            
            $datas['candidate'] = $query;
            $datas['job'] = $query2->title;
             $message = $this->load->view('admin/emails/rejected',$datas, TRUE);
            // $datas['batas'] = $batas;
            
//             $pekerjaanjob = $query2->title;
//             $pekerjaanjob2="$pekerjaanjob";
//             $nomorwa = $query->whatsapp;
//             $pesanwa = "Terkait dengan proses rekrutmen, kami infokan bahwa Saudara untuk sementara belum kami lanjutkan ke proses berikutnya! 
            
// PEKERJAAN DILAMAR :
// $pekerjaanjob2

// Namun data Saudara tetap kami keep di database kami untuk kebutuhan di kemudian hari.Terimakasih";
//             $this->load->model('NotifwaModel');
//             $this->NotifwaModel->kirim($nomorwa, $pesanwa);
        
            $cek_kirim = $this->sendEmail(
            $message,
            $email,
            'Anda Tidak Lolos'
            );
            
                //  $this->AdminJobBoardModel->updateCandidateStatus();
            $this->db->where('job_applications.job_id', $job);
            $this->db->where('job_applications.candidate_id', $id);
            $this->db->update('job_applications', array('status' => $action));
            // }
            
            }
                
            }else if($action == 'interviewed'){
             
             foreach ($ids as $id) {
            
            $query = $this->db->get_where('candidates',array('candidate_id' => $id))->row();
            $query2 = $this->db->get_where('jobs',array('job_id' => $job))->row();
            // $this->db->update('job_applications', array('status' => $action));
            
            $email = $query->email;
            
            $datas['candidate'] = $query;
            $datas['job'] = $query2->title;
            // $datas['batas'] = $batas;
            $message = $this->load->view('admin/emails/interviewed',$datas, TRUE);
        
            $cek_kirim = $this->sendEmail(
            $message,
            $email,
            'Anda Lanjut Tahap Interview'
            );
            
                //  $this->AdminJobBoardModel->updateCandidateStatus();
            $this->db->where('job_applications.job_id', $job);
            $this->db->where('job_applications.candidate_id', $id);
            $this->db->update('job_applications', array('status' => $action));
            // }
            
            }
            
            }
        
         echo json_encode(array(
            'success' => 'true',
            'messages' => lang('assigned')
        ));
        
        }else{
        $this->AdminJobBoardModel->updateCandidateStatus();
        echo json_encode(array(
            'success' => 'true',
            'messages' => lang('assigned')
        ));
        }
    }

    /**
     * Function (via ajax) to view job detail
     *
     * @param  $job_id integer
     * @return json
     */
    public function viewJob($job_id = '')
    {
        $job = objToArr($this->AdminJobModel->getJob('jobs.job_id', $job_id));
        echo $this->load->view('admin/job-board/job-detail', compact('job'), TRUE);
    }

    /**
     * Function (via ajax) to view resume
     *
     * @param  $resume_id integer
     * @return json
     */
    public function viewResume($resume_id = '')
    {
          $resume = objToArr($this->AdminCandidateModel->getCompleteResume($resume_id, true));

        $id_kab = $resume['city'];
        $id_kec = $resume['state'];
        $data['kab'] = $this->db->get_where('kabupaten', array('id' => $id_kab))->row();
        $data['kec'] = $this->db->get_where('kecamatan', array('id' => $id_kec))->row();
        $data['resum'] = $resume;
        $data['resume_id'] = $resume['resume_id'];
        $data['resume'] = $this->load->view('admin/candidates/resume', $data, TRUE);
        $data['type'] = $resume['type'];
        $data['file'] = $resume['file'];
        echo $this->load->view('admin/job-board/resume', $data, TRUE);
    }

    /**
     * Function do export overall result in excel
     *
     * @return json
     */
    public function overallResult()
    {
        ini_set('max_execution_time', '0');
        $result = $this->AdminJobBoardModel->overallResult();
        $data = sortForCSV($result);
        $excel = new SimpleExcel('csv');
        $excel->writer->setData($data);
        $excel->writer->saveFile('overallResult');
        exit;
    }

    /**
     * Function do export pdf result for traits, quizes and interviews
     *
     * @return json
     */
    public function pdfResult()
    {
        $this->checkIfDemo('reload');
        ini_set('max_execution_time', '0');
        $results = '';
        $filename = '';

        if ($this->xssCleanInput('type') == 'e-self') {
            $result = $this->AdminJobBoardModel->traitsResult();
            foreach ($result as $r) {
                $data['trait'] = $r;
                $results .= $this->load->view('admin/job-board/pdf-traits', $data, TRUE);
            }
            $filename = $this->xssCleanInput('job').'-SelfAssementResults.pdf';
        } else if ($this->xssCleanInput('type') == 'e-quiz') {
            $result = $this->AdminJobBoardModel->quizesResult();
            foreach ($result as $r) {
                $data['quizes'] = $r;
                $results .= $this->load->view('admin/job-board/pdf-quizes', $data, TRUE);
            }
            $filename = $this->xssCleanInput('job').'-QuizResults.pdf';
        } else if ($this->xssCleanInput('type') == 'e-interview') {
            $result = $this->AdminJobBoardModel->interviewsResult();
            foreach ($result as $r) {
                $data['interviews'] = $r;
                $results .= $this->load->view('admin/job-board/pdf-interviews', $data, TRUE);
            }
            $filename = $this->xssCleanInput('job').'-interviewsResults.pdf';
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($results);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename);
        exit;
    }

    /**
     * Function (for ajax) to delete candidate interview
     *
     * @param  $candidate_interview_id integer
     * @return redirect
     */
    public function deleteInterview($candidate_interview_id = '')
    {
        $this->checkIfDemo();
        $data = $this->AdminCandidateInterviewModel->deleteCandidateInterview($candidate_interview_id);
        $this->AdminJobBoardModel->updateInterviewResultInJobApplication($data);
        $this->AdminJobBoardModel->updateOverallResultInJobApplication($data);
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('candidate_interview_deleted')))
        ));
    }

    /**
     * Function (for ajax) to delete candidate quiz
     *
     * @param  $candidate_quiz_id integer
     * @return redirect
     */
    public function deleteQuiz($candidate_quiz_id = '')
    {
        $this->checkIfDemo();
        $data = $this->AdminQuizModel->deleteCandidateQuiz($candidate_quiz_id);
        $this->AdminJobBoardModel->updateQuizResultInJobApplication($data);
        $this->AdminJobBoardModel->updateOverallResultInJobApplication($data);
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('candidate_quiz_deleted')))
        ));
    }
    
    public function rating()
    {
        $data['job_id'] = '';
        echo $this->load->view('admin/job-board/rating', $data, TRUE);
        exit;
    }

}
