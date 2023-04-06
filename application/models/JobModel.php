<?php

class JobModel extends CI_Model
{
    protected $table = 'jobs';
    protected $key = 'job_id';
    protected $candidate_id;

    public function __construct()
    {
        parent::__construct();
        @$this->candidate_id = candidateSession();
    }

    public function getJob($id)
    {
        $this->db->where('jobs.job_id', decode($id));
        $this->db->select('
            jobs.*,
            companies.title as company,
            departments.title as department,
            kategori_pekerjaan.nama_kategori as kategori,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_quizes.job_quiz_id)) as quizes_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_traits.job_trait_id)) as traits_count,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.trait_id)) as traits,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.job_trait_id) SEPARATOR "-=-++-=-") as job_trait_ids,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.title) SEPARATOR "-=-++-=-") as trait_titles
        ');

        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = jobs.id_kategori', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->join('job_quizes', 'job_quizes.job_id = jobs.job_id', 'left');
        $this->db->group_by('jobs.job_id');
        $result = $this->db->get('jobs');
        $result = ($result->num_rows() == 1) ? $this->sorted($result->result()) : $this->emptyObject('jobs');
        return isset($result[0]) ? $result[0] : array();
    }

    public function getJobQuizes($id)
    {
        $this->db->where('job_quizes.job_id', decode($id));
        $this->db->select('
            job_quizes.*
        ');
        $result = $this->db->get('job_quizes');
        return objToArr($result->result());
    }
    
    public function CekMinat($id)
    {
        $this->db->select('minat.level as level_pekerjaan');
        $this->db->from('jobs,minat');
        $this->db->where('jobs.job_id',decode($id));
        $this->db->where('jobs.status_minat = minat.id');
        $result = $this->db->get();
        return $result;
    }

    public function getAll($page, $search, $companies, $departments, $limit)
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;
        $this->db->from('jobs');
        $this->db->select('
            jobs.*,
            companies.title as company,
            kategori_pekerjaan.nama_kategori as kategori,
            departments.title as department,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_quizes.job_quiz_id)) as quizes_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_traits.job_trait_id)) as traits_count,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.trait_id) SEPARATOR "-=-++-=-") as trait_ids,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.title) SEPARATOR "-=-++-=-") as trait_titles
        ');
        
        
        if ($companies) {
            $this->db->where_in('jobs.id_kategori', $this->sortForSearch($companies));
        }
        if ($departments) {
            $this->db->where_in('jobs.id_lokasi', $this->sortForSearch($departments));
        }
        if ($search) {
            $this->db->group_start()->like('jobs.title', $search)->or_like('jobs.description', $search)->group_end();
        }
        
           
        
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = jobs.id_kategori', 'left');
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_quizes', 'job_quizes.job_id = jobs.job_id', 'left');
        $this->db->order_by('jobs.job_id', 'DESC');
        $this->db->group_by('jobs.job_id');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $this->sorted($query->result());
    }
    
      public function getAll3($page, $search, $companies, $departments, $limit)
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->from('jobs');
        $this->db->select('
            jobs.*,
            companies.title as company,
            kategori_pekerjaan.nama_kategori as kategori,
            departments.title as department,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_quizes.job_quiz_id)) as quizes_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_traits.job_trait_id)) as traits_count,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.trait_id) SEPARATOR "-=-++-=-") as trait_ids,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.title) SEPARATOR "-=-++-=-") as trait_titles
        ');
        $this->db->where('jobs.status', 1);
        if ($companies) {
            $this->db->where_in('jobs.id_kategori', $this->sortForSearch($companies));
        }
        if ($departments) {
            $this->db->where_in('jobs.department_id', $this->sortForSearch($departments));
        }
        if ($search) {
            $this->db->group_start()->like('jobs.title', $search)->or_like('jobs.description', $search)->group_end();
        }
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = jobs.id_kategori', 'left');
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_quizes', 'job_quizes.job_id = jobs.job_id', 'left');
        $this->db->order_by('jobs.job_id', 'DESC');
        $this->db->group_by('jobs.job_id');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $this->sorted($query->result());
    }

    public function getTotal($search, $companies, $departments)
    {
        $this->db->from('jobs');
        $this->db->select('jobs.*,');
        // $this->db->where('jobs.status', 1);
    
        if ($companies) {
            $this->db->where_in('jobs.id_kategori', $this->sortForSearch($companies));
        }
        if ($departments) {
            $this->db->where_in('jobs.department_id', $this->sortForSearch($departments));
        }
        if ($search) {
            $this->db->group_start()->like('jobs.title', $search)->or_like('jobs.description', $search)->group_end();
        }
        $this->db->group_by('jobs.job_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getAppliedJobs()
    {
        $this->db->select('GROUP_CONCAT('.CF_DB_PREFIX.'job_applications.job_id) as applied');
        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->from('job_applications');
        $this->db->group_by('job_applications.candidate_id');
        $result = $this->db->get();
        $result = objToArr($result->result());
        return isset($result[0]['applied']) ? explode(',', $result[0]['applied']) : array();
    }

    public function getAppliedJobsList($page = '', $limit)
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->select('
            jobs.*,
            kategori_pekerjaan.nama_kategori as kategori,
            companies.title as company,
            job_applications.status as job_status,
            job_applications.created_at as applied_on,
            departments.title as department,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values
        ');
        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->from('job_applications');
        $this->db->join('jobs', 'jobs.job_id = job_applications.job_id', 'left');
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = jobs.id_kategori', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->order_by('job_applications.created_at', 'DESC');
        $this->db->group_by('job_applications.job_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        $result = objToArr($result->result());
        return $this->sorted($result);
    }

    public function getTotalAppliedJobs()
    {
        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->from('job_applications');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     public function getTotalAppliedJobsEsai()
    {
        $this->db->where('candidate_interviews.candidate_id', $this->candidate_id);
        $this->db->from('candidate_interviews');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getFavoriteJobsList($page = '', $limit)
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->select('
            jobs.*,
            kategori_pekerjaan.nama_kategori as kategori,
            job_favorites.created_at as favorited_on,
            departments.title as department,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values
        ');
        $this->db->where('job_favorites.candidate_id', $this->candidate_id);
        $this->db->from('job_favorites');
        $this->db->join('jobs', 'jobs.job_id = job_favorites.job_id', 'left');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = jobs.id_kategori', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->order_by('job_favorites.created_at', 'DESC');
        $this->db->group_by('job_favorites.job_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        $result = objToArr($result->result());
        return $this->sorted($result);
    }

    // public function getSertifikat($page = '', $limit)
    // {
    //     $offset = $page > 1 ? (($page-1)*$limit) : 0;
    //
    //     $this->db->select('*');
    //     $this->db->from('sertifikat');
    //     $this->db->where('id_kandidat', $this->candidate_id);
    //     $this->db->limit($limit, $offset);
    //     $result = $this->db->get();
    //     $result = objToArr($result->result());
    //     return $this->sorted($result);
    // }
    public function getSertifikat()
    {

        $this->db->select('*');
        $this->db->from('sertifikat');
        $this->db->where('id_kandidat', $this->candidate_id);
        // $this->db->limit($limit, $offset);
        return $result = $this->db->get()->result();
        // $result = objToArr($result->result());
        // return $this->sorted($result);
    }

    public function getKelas()
    {
        $this->db->select('*');
        $this->db->from('kelas');
         $this->db->where('status', 1);
        // $this->db->where('id_kandidat', $this->candidate_id);
        // // $this->db->limit($limit, $offset);
        return $result = $this->db->get()->result();
        // $result = objToArr($result->result());
        // return $this->sorted($result);
    }

    public function getTotalFavoriteJobs()
    {
        $this->db->where('job_favorites.candidate_id', $this->candidate_id);
        $this->db->from('job_favorites');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getReferredJobsList($page = '', $limit)
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->select('
            jobs.*,
            job_referred.created_at as favorited_on,
            job_referred.name,
            job_referred.email,
            job_referred.phone,
            departments.title as department,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values
        ');
        $this->db->where('job_referred.candidate_id', $this->candidate_id);
        $this->db->from('job_referred');
        $this->db->join('jobs', 'jobs.job_id = job_referred.job_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->order_by('job_referred.created_at', 'DESC');
        $this->db->group_by('job_referred.job_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        $result = objToArr($result->result());
        return $this->sorted($result);
    }

    public function getTotalReferredJobs()
    {
        $this->db->where('job_referred.candidate_id', $this->candidate_id);
        $this->db->from('job_referred');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function ifAlreadyReferred()
    {
        $this->db->where('job_id', decode($this->xssCleanInput('job_id')));
        $this->db->where('email', $this->xssCleanInput('email'));
        $this->db->where('candidate_id', $this->candidate_id);
        $result = $this->db->get('job_referred');
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function referJob()
    {
        $data = $this->xssCleanInput();
        $data['candidate_id'] = $this->candidate_id;
        $data['created_at'] = date('Y-m-d G:i:s');
        $data['job_id'] = decode($data['job_id']);
        $this->db->insert('job_referred', $data);
    }

    public function applyJob($mitra)
    {
        $data = $this->xssCleanInput();
        $traits = isset($data['traits']) ? $data['traits'] : array();
        $trait_titles = isset($data['trait_titles']) ? $data['trait_titles'] : array();
        $traits_result = array();

        //First Inserting into job application table
        $apply['candidate_id'] = $this->candidate_id;
        $cek_id = $this->db->get_where('job_applications', array('candidate_id'=>$apply['candidate_id']))->row();
        if(!empty($cek_id)){
            if($cek_id->status != "applied"){
             $apply['status'] = 'shortlisted';
            }    
        }
        
        $applys = decode($data['resume']);
        
        $cek_ids = $this->db->get_where('resume_qualifications', array('resume_id'=>$applys))->num_rows();
        if($cek_ids <= 0){
            $datas['resume_id'] = $applys;
            $this->db->insert('resume_qualifications', $datas);
        }
        
        $apply['created_at'] = date('Y-m-d G:i:s');
        $apply['job_id'] = decode($data['job_id']);
        $apply['mitra'] = $mitra;
        if (setting('enable-multiple-resume') == 'yes') {
            $apply['resume_id'] = $this->ResumeModel->getFirstDetailedResume();
        } else {
            $apply['resume_id'] = decode($data['resume']);
        }
        
        // if($kode != ''){
        // $apply['kode_aktivasi'] = $kode;
        // }
        
        $this->db->insert('job_applications', $apply);
        $job_application_id = $this->db->insert_id();

        // $cek_idz = $this->db->get_where('job_applications', array('kode_aktivasi'=>$apply['kode_aktivasi']))->row();
        // if(!empty($cek_idz)){
        //     $datasa['job_application_id'] = $cek_idz->job_application_id;
        //     $datasa['kode_aktivasi'] = $apply['kode_aktivasi'];
        //     $datasa['deskripsi'] = 'TES PSIKOLOGI';
        //     $datasa['status'] = 0;
        //     $this->db->insert('tes_psikologi', $datasa);
        // }
        
        //Second Inserting traits to job traits answers
        if (!empty($traits)) {
            foreach ($traits as $key => $value) {
                $traits_result[] = $value;
                $answer['candidate_id'] = $this->candidate_id;
                $answer['job_application_id'] = $job_application_id;
                $answer['created_at'] = date('Y-m-d G:i:s');
                $answer['job_trait_id'] = decode($key);
                $answer['job_trait_title'] = isset($trait_titles[$key]) ? $trait_titles[$key] : 'null';
                $answer['rating'] = $value;
                $this->db->insert('job_trait_answers', $answer);
            }
        }

        //Third inserting overall trait results to job_applications table //For Job Board results
         if ($traits) {
        $total = array_sum($traits_result);
        $div = count($traits_result)*5;
        $traits_result = ceil(($total/$div)*100);
        $this->db->where('job_application_id', $job_application_id);
        $this->db->update('job_applications', array('traits_result' => $traits_result));
         }

        //Forth copying any assigned quiz from job_quizes to candidate_quizes
        $job_quizes = $this->getJobQuizes($data['job_id']);
        foreach ($job_quizes as $quiz) {
            $candidate_quiz['candidate_id'] = $this->candidate_id;
            $candidate_quiz['job_id'] = decode($data['job_id']);
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

        //Fifth updating overall results
        $this->updateOverallResultInJobApplication(
            array('candidate_id' => $this->candidate_id, 'job_id' => decode($data['job_id']))
        );
        
// //             $querywhatsapp = $this->db->get_where('candidates',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
// //             $cek_minatwa = $this->db->get_where('jobs',array('job_id' => decode($data['job_id'])))->row();
// //             $nomorwa = $querywhatsapp->whatsapp;
// //             $namajob = $cek_minatwa->title;
// //             $pesanwa = "Anda akan mengikuti tes:
// // *$namajob*
            
// // Silahkan menyelesaikan *Tes Interview Internal* dan *Tes Psikologi*";
//             $this->load->model('NotifwaModel');
//             $this->NotifwaModel->kirim($nomorwa, $pesanwa);
    }

    public function getCompleteQuiz($quiz_id)
    {
        $result = array();
        $result['quiz'] = $this->AdminQuizModel->get('quiz_id', $quiz_id);
        $result['questions'] = $this->AdminQuizModel->quizQuestions($quiz_id);
        foreach ($result['questions'] as $key => $question) {
            $answers = $this->AdminQuizModel->quizQuestionAnswers($question['quiz_question_id']);
            $result['questions'][$key]['answers'] = $answers;
        }
        return objToArr($result);
    }

    public function markFavorite($job_id)
    {
        $this->db->where('job_id', decode($job_id));
        $this->db->where('candidate_id', $this->candidate_id);
        $result = $this->db->get('job_favorites');
        if ($result->num_rows() <= 0) {
            $data['candidate_id'] = $this->candidate_id;
            $data['job_id'] = decode($job_id);
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('job_favorites', $data);
            return true;
        } else {
            return false;
        }
    }

    public function unmarkFavorite($job_id)
    {
        $data['job_id'] = decode($job_id);
        $data['candidate_id'] = $this->candidate_id;
        $this->db->delete('job_favorites', $data);
    }

    public function getFavorites()
    {
        $this->db->select('GROUP_CONCAT('.CF_DB_PREFIX.'job_favorites.job_id) as ids');
        $this->db->where('candidate_id', $this->candidate_id);
        $result = $this->db->get('job_favorites');
        $result = objToArr($result->result());
        $result = isset($result[0]['ids']) ? explode(',', $result[0]['ids']) : array();
        return $result;
    }

    public function remove($job_id)
    {
        $this->db->delete('jobs', array('job_id' => $job_id));
    }

    public function getAll2($active = true, $srh = '')
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        if ($srh) {
            $this->db->group_start()->like('jobname', $srh)->group_end();
        }
        $this->db->where('job_type !=', 'admin');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
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

    public function sorted($jobs)
    {
        $return = array();
        $jobs = objToArr($jobs);
        foreach ($jobs as $job) {
            $labels = explode('-=-++-=-', $job['field_labels']);
            $values = explode('-=-++-=-', $job['field_values']);
            if (isset($job['job_trait_ids'])) {
                $job_trait_ids = explode('-=-++-=-', $job['job_trait_ids']);
                $trait_titles = explode('-=-++-=-', $job['trait_titles']);
            }
            if (isset($labels[0])) {
                $fields = arrangeSections(array('label' => $labels, 'value' => $values));
            } else {
                $fields = array();
            }
            if (isset($job_trait_ids[0])) {
                $traits = arrangeSections(array('id' => $job_trait_ids, 'title' => $trait_titles));
            } else {
                $traits = array();
            }
            $job['fields'] = $fields;
            $job['traits'] = $traits;
            unset($job['field_labels'],$job['field_values'],$job['job_trait_ids'],$job['trait_titles']);
            $return[] = $job;
        }
        return $return;
    }

    private function sortForSearch($data)
    {
        $return = array();
        $array = explode(',', $data);
        foreach ($array as $value) {
            if ($value) {
                $return[] = decode($value);
            }
        }
        return $return;
    }
}
