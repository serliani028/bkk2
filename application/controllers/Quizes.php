<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Quizes extends CI_Controller
{
    /**
     * View Function to display candidate quiz listing page
     *
     * @param integer $page
     * @return html/string
     */
    public function listView($page = null)
    {
        $this->checkLogin();
        
        $total = $this->QuizModel->getTotalCandidateQuizes2();
        $limit = 5;
        $pageData['page'] = lang('assigned_quizes').' | ' . setting('site-name');
        
        $id_k = $this->session->userdata('candidate')['candidate_id'];
        $get_resume = $this->db->get_where('resumes', array('candidate_id'=>$id_k))->row();
        $id = $get_resume->resume_id;
        
        $data['resume_verif'] = $id;
        
        $data['resumesz'] = $this->ResumeModel->getCompleteResume2($id);
        $data['resume'] = $this->ResumeModel->getCompleteResume($id);
        $data['resumes_profile'] = $this->db->get_where('resumes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
        $data['jumlah_quiz'] =  $this->QuizModel->getTotalQuiz();
        $data['jumlah_interview_internal'] =  $this->QuizModel->getTotalCandidateQuizes_not($id_k);
        $data['cek_data_verif'] = $this->QuizModel->getDataVerif($this->session->userdata('candidate')['candidate_id']);
        
        $data['page'] = 'quizes';
        $data['quizes'] = $this->QuizModel->getCandidateQuizes2($page, $limit);
        $data['pagination'] = $this->createPagination($page, '/account/quizes/', $total, $limit);
        $this->load->view('front/layout/header', $pageData);
        $this->load->view('front/account-quiz-listing', $data);
            
    }

    /**
     * View Function to display quiz detail and attempt page
     *
     * @param  $id string
     * @return html/string
     */
    public function attemptView($id = null)
    {
        $this->checkLogin();
        //$this->QuizModel->waupdateCandidateQuiz();
        $pageData['page'] = 'Persiapan Tes Interview Internal'.' | ' . setting('site-name');

        $detail = $this->QuizModel->getQuiz($id);
        if (!$detail) {
            redirect('404_override');
        }

        $quiz = objToArr(json_decode($detail['quiz_data']));
        $data['page'] = 'interview-internal';
        $data['detail'] = $detail;
        $data['quiz'] = $quiz['quiz'];
        $data['questions'] = $quiz['questions'];
        $data['time'] = quizTime($detail['started_at'], $detail['allowed_time']);
        
        
        $id_k = $this->session->userdata('candidate')['candidate_id'];
        $get_resume = $this->db->get_where('resumes', array('candidate_id'=>$id_k))->row();
        $id = $get_resume->resume_id;
        $data['resumesz'] = $this->ResumeModel->getCompleteResume2($id);
        $data['resume'] = $this->ResumeModel->getCompleteResume($id);
        $data['resumes_profile'] = $this->db->get_where('resumes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
        $data['jumlah_quiz'] =  $this->QuizModel->getTotalQuiz();
        $data['jumlah_interview_internal'] =  $this->QuizModel->getTotalCandidateQuizes_not($id_k);
        

        if ($detail['attempt'] > 0) {
            if ($data['time']['diff'] > 0 && ($detail['attempt'] <= $detail['total_questions'])) {
                $data['question'] = $data['questions'][$detail['attempt']-1];
                $this->load->view('front/layout/header', $pageData);
                $this->load->view('front/account-quiz-attempt', $data);
            } else {
                if($detail['status_quiz'] == 0 || $detail['status_quiz'] == 1){
                $data_waktu1['status_quiz'] = 2;
                $data_waktu2['status_kuis'] = 2;
                
                $id_s = $this->uri->segment(3);
                $this->db->where('candidate_quizes.candidate_quiz_id', decode($id_s));
                $cek_status = $this->db->update('candidate_quizes',$data_waktu1);
                
                if($cek_status){
                    $this->db->where('candidate_quizes.candidate_id',$id_k);
                    $this->db->where('candidate_quizes.status_quiz !=',2);
                    $cek_kuis = $this->db->get('candidate_quizes')->num_rows();
                    if($cek_kuis == 0){
                        $this->db->where('job_applications.candidate_id', $id_k);
                        $this->db->where('job_applications.job_id', $detail['job_id']);
                        $cek_status = $this->db->update('job_applications',$data_waktu2);
                    }
                }
                
                $this->load->view('front/layout/header', $pageData);
                $this->load->view('front/account-quiz-done', $data);
                
                }else{
                $this->load->view('front/layout/header', $pageData);
                $this->load->view('front/account-quiz-done', $data);
                }
                
            }
        } else {
            $this->load->view('front/layout/header', $pageData);
            $this->load->view('front/account-quiz-detail', $data);
        }
    }

    /**
     * Function (form post) to record quiz progress
     *
     * @return html/string
     */
    public function attempt()
    {
        $this->checkIfDemo('reload');
        $this->QuizModel->updateCandidateQuiz();
        redirect('account/quiz/'.$this->xssCleanInput('quiz'));
    }
     public function attempt2()
    {
        $this->checkIfDemo('reload');
        $this->QuizModel->updateCandidateQuiz();
        redirect('account/tes-interview-internal-pre/'.$this->xssCleanInput('quiz'));
    }
}
