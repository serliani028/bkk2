<?php

class QuizModel extends CI_Model
{
    protected $table = 'jobs';
    protected $key = 'job_id';
    protected $candidate_id;

    public function __construct()
    {
        parent::__construct();
        $this->candidate_id = candidateSession();
    }

    public function getQuiz($quiz_id)
    {
        $this->db->where('candidate_quizes.candidate_quiz_id', decode($quiz_id));
        $this->db->select('
            candidate_quizes.*,
            jobs.title as job_title,
        ');
        $this->db->join('jobs', 'jobs.job_id = candidate_quizes.job_id', 'left');
        $result = $this->db->get('candidate_quizes');
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
    }

    public function getCandidateQuizes($page = '', $limit)
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->where('candidate_quizes.candidate_id', $this->candidate_id);
        $this->db->select('
            candidate_quizes.*,
            jobs.title as job_title,
        ');
        $this->db->join('jobs', 'jobs.job_id = candidate_quizes.job_id', 'left');
        $this->db->order_by('candidate_quizes.created_at', 'DESC');
        $this->db->group_by('candidate_quizes.candidate_quiz_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get('candidate_quizes');
        return objToArr($result->result());
    }
    
     public function getCandidateQuizes2($page = '', $limit)
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->where('job_applications.job_id = jobs.job_id');
        $this->db->where('tes_psikologi.job_application_id = job_applications.job_application_id');
        $this->db->select('
            tes_psikologi.*,jobs.title as job_title
        ');
        
        $this->db->order_by('tes_psikologi.id_tes', 'DESC');
        $this->db->limit($limit, $offset);
        $result = $this->db->get('tes_psikologi,job_applications,jobs');
        return objToArr($result->result());
    }

    public function getTotalCandidateQuizes()
    {
        $this->db->from('candidate_quizes');
        $this->db->where('candidate_quizes.candidate_id', $this->candidate_id);
        $this->db->group_by('candidate_quizes.candidate_quiz_id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getDataVerif($id)
    {
        $this->db->select('candidates.*,resumes.skck,resumes.sk_covid,resume_qualifications.marks as ijazah');
        $this->db->from('candidates');
        $this->db->where('candidates.candidate_id', $id);
        $this->db->join('resumes','resumes.candidate_id = candidates.candidate_id', 'left');
        $this->db->join('resume_qualifications','resume_qualifications.resume_id = resumes.resume_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getTotalCandidateQuizes_not($id)
    {
        $this->db->from('candidate_quizes');
        $this->db->where('candidate_quizes.candidate_id', $id);
        $this->db->where('candidate_quizes.status_quiz !=',2);
        // $this->db->group_by('candidate_quizes.candidate_id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getTotalCandidateQuizes2()
    {
        $this->db->from('job_applications,tes_psikologi');
        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->where('tes_psikologi.job_application_id = job_applications.job_application_id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     public function getTotalQuiz()
    {
        
        $this->db->from('job_applications,tes_psikologi');
        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->where('tes_psikologi.job_application_id = job_applications.job_application_id');
        $this->db->where('tes_psikologi.status = 0 ');
        $query = $this->db->get();
        return $query->num_rows();
        
    }

    public function updateCandidateQuiz()
    {
       $candidate_quiz_id = $this->xssCleanInput('quiz');
        $question = $this->xssCleanInput('question') ? decode($this->xssCleanInput('question')) : 0;
        $answer = $this->xssCleanInput('answer');

        $detail = $this->getQuiz($candidate_quiz_id);
        $quiz = objToArr(json_decode($detail['quiz_data']));
        $questions = $quiz['questions'];
        $current_index = $question == 0 ? 0 : $question-1;
        $current = $questions[$current_index];

        $answers_data = objToArr(json_decode($detail['answers_data']));
        $submitted_answers = $this->checkAnswers($current, $answer);

        if ($question == 0) {
            $update['started_at'] = date('Y-m-d G:i:s');
        }

        $update['attempt'] = $detail['attempt'] + 1;
        $update['correct_answers'] = $detail['correct_answers'] + $submitted_answers['result'];

        //Updating the answers history (answers_data) with user answers
        $answers_data = $detail['answers_data'] ? json_decode($detail['answers_data']) : array();
        $new[$current_index] = $submitted_answers['user_answers'];
        if (count($submitted_answers['user_answers']) > 1) {
            $user_answers_data = array($submitted_answers['user_answers']);
        } else {
            $user_answers_data = $submitted_answers['user_answers'];
        }
        $new_answers_data = array_merge($answers_data, $user_answers_data);
        $update['answers_data'] = json_encode($new_answers_data);
        $update['status_quiz'] = 1;

        $this->db->where('candidate_quizes.candidate_id', $this->candidate_id);
        $this->db->where('candidate_quizes.candidate_quiz_id', decode($candidate_quiz_id));
        $this->db->update('candidate_quizes', $update);

        $this->updateQuizResultInJobApplication($detail);
        $this->updateOverallResultInJobApplication($detail);
    }
    
    public function waupdateCandidateQuiz()
    {
        $this->db->from('candidate_quizes');
        $this->db->where('candidate_quizes.candidate_id', $this->candidate_id);
        $query = $this->db->get();
        $querytest = $this->db->get_where('candidate_quizes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
        $attemp1 = $querytest->attempt;
        $tquest1 = $querytest->total_questions;
        if ($query->num_rows() > 1)
        {
            foreach ($query->result_array() as $row)
            {
                if($row['attempt']-1 == $row['total_questions'])
                {
                    $hasil1=1;
                }else{
                    $hasil1=0;
                }
            }
            if($hasil1 == 1){
                $querywhatsapp = $this->db->get_where('candidates',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
                $nomorwa = $querywhatsapp->whatsapp;
                $pesanwa = "Anda sudah menyelesaikan *Tes Interview Internal*, Silahkan Melanjutkan untuk menyelesaikan *Tes Psikologi*";
                $this->load->model('NotifwaModel');
                $this->NotifwaModel->kirim($nomorwa, $pesanwa);
            }
        }else{
            if($attemp1 > $tquest1)
            {
                $hasil1=1;
                
            }else{
                $hasil1=0;
                
            }
            if($hasil1 == 1){
                $querywhatsapp = $this->db->get_where('candidates',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
                $nomorwa = $querywhatsapp->whatsapp;
                $pesanwa = "Anda sudah menyelesaikan *Tes Interview Internal*, Silahkan Melanjutkan untuk menyelesaikan *Tes Psikologi*";
                $this->load->model('NotifwaModel');
                $this->NotifwaModel->kirim($nomorwa, $pesanwa);
            }
        }
    }

    private function updateQuizResultInJobApplication($data)
    {
        $this->db->select('
            ROUND((SUM('.CF_DB_PREFIX.'candidate_quizes.correct_answers)/SUM('.CF_DB_PREFIX.'candidate_quizes.total_questions))*100) as percent
        ');
        $this->db->where('candidate_quizes.candidate_id', $data['candidate_id']);
        $this->db->where('candidate_quizes.job_id', $data['job_id']);
        $result = $this->db->get('candidate_quizes');
        $result = ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
        $percent = isset($result['percent']) ? $result['percent'] : 0;

        $this->db->where('job_applications.candidate_id', $data['candidate_id']);
        $this->db->where('job_applications.job_id', $data['job_id']);
        $this->db->update('job_applications', array('quizes_result' => $percent));
    }

    private function updateOverallResultInJobApplication($data)
    {
        $this->db->set(
            'overall_result',
            'ROUND(('.CF_DB_PREFIX.'job_applications.traits_result+'.CF_DB_PREFIX.'job_applications.quizes_result+'.CF_DB_PREFIX.'job_applications.interviews_result)/3)',
            false
        );
        $this->db->where('job_applications.candidate_id', $data['candidate_id']);
        $this->db->where('job_applications.job_id', $data['job_id']);
        $this->db->update('job_applications');
    }

    private function checkAnswers($current, $answer)
    {
        if ($answer) {
            $correct_answers = array();
            foreach ($current['answers'] as $value) {
                if ($value['is_correct'] == 1) {
                    $correct_answers[] = $value['quiz_question_answer_id'];
                }
            }
            $user_answers = array();
            foreach ($answer as $value) {
                $user_answers[] = decode($value);
            }
            return array(
                'user_answers' => $user_answers,
                'result' => $correct_answers === $user_answers
            );
        } else {
            return array(
                'user_answers' => array(),
                'result' => 0
            );
        }
    }
}
