<?php

class AdminPrakerjaModel extends CI_Model
{
//     protected $table = 'candidates';
//     protected $key = 'candidate_id';


    // public function getCandidatesForCSV($ids)
    // {
    //     $this->db->from('candidates');
    //     $this->db->select('
    //         candidates.*,
    //         resumes.*,
    //         GROUP_CONCAT('.CF_DB_PREFIX.'resume_experiences.title) as job_title
    //     ');
    //     $this->db->where_in('candidates.candidate_id', explode(',', $ids));
    //     $this->db->join('resumes','resumes.candidate_id = candidates.candidate_id AND resumes.is_default = 1', 'left');
    //     $this->db->join('resume_experiences','resume_experiences.resume_id = resumes.resume_id', 'left');
    //     $this->db->group_by('candidates.candidate_id');
    //     $this->db->order_by('candidates.created_at', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    //
    // public function changeStatus($candidate_id, $status)
    // {
    //     $this->db->where('candidate_id', $candidate_id);
    //     $this->db->update('candidates', array('status' => ($status == 1 ? 0 : 1)));
    // }
    //
    // public function remove($candidate_id)
    // {
    //     //First deleting candidate
    //     $this->db->delete('candidates', array('candidate_id' => $candidate_id));
    //
    //     //Second(A) get resume_ids of candidate
    //     $resume_ids = $this->getCandidateResumeIds($candidate_id);
    //
    //     if ($resume_ids) {
    //         //Second(B) delete all resumes of candidate
    //         $this->db->where_in('resume_id', $resume_ids);
    //         $this->db->delete('resumes');
    //         $this->db->where_in('resume_id', $resume_ids);
    //         $this->db->delete('resume_achievements');
    //         $this->db->where_in('resume_id', $resume_ids);
    //         $this->db->delete('resume_experiences');
    //         $this->db->where_in('resume_id', $resume_ids);
    //         $this->db->delete('resume_qualifications');
    //         $this->db->where_in('resume_id', $resume_ids);
    //         $this->db->delete('resume_languages');
    //         $this->db->where_in('resume_id', $resume_ids);
    //         $this->db->delete('resume_references');
    //     }
    //
    //     //Third delete job applications
    //     $this->db->delete('job_applications', array('candidate_id' => $candidate_id));
    //
    //     //Forth delete interviews of candidate
    //     $this->db->delete('candidate_interviews', array('candidate_id' => $candidate_id));
    //
    //     //Fifth delete quizes of candidate
    //     $this->db->delete('candidate_quizes', array('candidate_id' => $candidate_id));
    //
    //     //Sixth delete self assesment answers
    //     $this->db->delete('job_trait_answers', array('candidate_id' => $candidate_id));
    // }
    //
    // public function bulkAction()
    // {
    //     $data = objToArr(json_decode($this->xssCleanInput('data')));
    //     $action = $data['action'];
    //     $ids = $data['ids'];
    //     switch ($action) {
    //         case "activate":
    //             $this->db->where_in('candidate_id', $ids);
    //             $this->db->update('candidates', array('status' => 1));
    //         break;
    //         case "deactivate":
    //             $this->db->where_in('candidate_id', $ids);
    //             $this->db->update('candidates', array('status' => '0'));
    //         break;
    //     }
    // }
    //
    // public function valueExist($field, $value, $edit = false)
    // {
    //     $this->db->where($field, $value);
    //     if ($edit) {
    //         $this->db->where('candidate_id !=', $edit);
    //     }
    //     $query = $this->db->get('candidates');
    //     return $query->num_rows() > 0 ? true : false;
    // }
    //
    // public function getAll($active = true, $srh = '')
    // {
    //     if ($active) {
    //         $this->db->where('status', 1);
    //     }
    //     if ($srh) {
    //         $this->db->group_start()->like('candidatename', $srh)->group_end();
    //     }
    //     $this->db->from($this->table);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    //
    // public function getTotalCandidates()
    // {
    //     $this->db->where('status', 1);
    //     $query = $this->db->get('candidates');
    //     return $query->num_rows();
    // }
    //
    // public function candidatesList()
    // {
    //     $request = $this->input->get();
    //     $columns = array(
    //         "",
    //         "",
    //         "candidates.first_name",
    //         "candidates.last_name",
    //         "candidates.email",
    //         "",
    //         "resumes.experience",
    //         "candidates.account_type",
    //         "candidates.created_at",
    //         "candidates.status",
    //     );
    //     $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
    //     $orderDirection = $request['order'][0]['dir'];
    //     $srh = $request['search']['value'];
    //     $limit = $request['length'];
    //     $offset = $request['start'];
    //
    //     $this->db->from('candidates');
    //     $this->db->select('
    //         candidates.*,
    //         resumes.experience,
    //         GROUP_CONCAT('.CF_DB_PREFIX.'resume_experiences.title) as job_title
    //     ');
    //     if ($srh) {
    //         $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
    //     }
    //     if (isset($request['status']) && $request['status'] != '') {
    //         $this->db->where('candidates.status', $request['status']);
    //     }
    //     if (isset($request['account_type']) && $request['account_type'] != '') {
    //         $this->db->where('candidates.account_type', $request['account_type']);
    //     }
    //     if (isset($request['job_title']) && $request['job_title'] != '') {
    //         $this->db->like('resume_experiences.title', $request['job_title']);
    //     }
    //     if (isset($request['experience']) && $request['experience'] != '') {
    //         $this->db->where('resumes.experience >=', $request['experience']);
    //     }
    //     $this->db->join('resumes','resumes.candidate_id = candidates.candidate_id AND resumes.is_default = 1', 'left');
    //     $this->db->join('resume_experiences','resume_experiences.resume_id = resumes.resume_id', 'left');
    //     $this->db->group_by('candidates.candidate_id');
    //     $this->db->order_by($orderColumn, $orderDirection);
    //     $this->db->limit($limit, $offset);
    //     $query = $this->db->get();
    //
    //     $result = array(
    //         'data' => $this->prepareDataForTable($query->result()),
    //         'recordsTotal' => $this->getTotal(),
    //         'recordsFiltered' => $this->getTotal($srh, $request),
    //     );
    //
    //     return $result;
    // }
    //
    // public function getTotal($srh = false, $request = '')
    // {
    //     $this->db->from('candidates');
    //     if ($srh) {
    //         $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
    //     }
    //     if (isset($request['status']) && $request['status'] != '') {
    //         $this->db->where('candidates.status', $request['status']);
    //     }
    //     if (isset($request['account_type']) && $request['account_type'] != '') {
    //         $this->db->where('candidates.account_type', $request['account_type']);
    //     }
    //     if (isset($request['job_title']) && $request['job_title'] != '') {
    //         $this->db->like('resume_experiences.title', $request['job_title']);
    //     }
    //     if (isset($request['experience']) && $request['experience'] != '') {
    //         $this->db->where('resumes.experience >=', $request['experience']);
    //     }
    //     $this->db->join('resumes','resumes.candidate_id = candidates.candidate_id AND resumes.is_default = 1', 'left');
    //     $this->db->join('resume_experiences','resume_experiences.resume_id = resumes.resume_id', 'left');
    //     $this->db->group_by('candidates.candidate_id');
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }
    //
    // private function prepareDataForTable($candidates)
    // {
    //     $sorted = array();
    //     foreach ($candidates as $u) {
    //         $u = objToArr($u);
    //         if ($u['status'] == 1) {
    //             $button_text = lang('active');
    //             $button_class = 'success';
    //             $button_title = lang('click_to_deactivate');
    //         } else {
    //             $button_text = lang('inactive');
    //             $button_class = 'danger';
    //             $button_title = lang('click_to_activate');
    //         }
    //         if (allowedTo('delete_candidate')) {
    //             $actions = '
    //                 <button type="button" class="btn btn-danger btn-xs delete-candidate" data-id="'.$u['candidate_id'].'"><i class="far fa-trash-alt"></i></button>
    //             ';
    //         } else {
    //             $actions = '---';
    //         }
    //         $default_image = base_url().'assets/images/not-found.png';
    //         $sorted[] = array(
    //             "<input type='checkbox' class='minimal single-check' data-id='".$u['candidate_id']."' />",
    //             "<img class='candidate-thumb-table' src='".candidateThumb($u['image'])."' onerror='this.src=\"".$default_image."\"'/>",
    //             "<a class='view-resume' title='View Resume' data-id='".$u['candidate_id']."' href='#'>".$u['first_name']."</a>",
    //             $u['last_name'],
    //             $u['email'],
    //             $u['job_title'] ? $u['job_title'] : '---',
    //             $u['experience'],
    //             $u['account_type'],
    //             date('d M, Y', strtotime($u['created_at'])),
    //             '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-candidate-status" data-status="'.$u['status'].'" data-id="'.$u['candidate_id'].'">'.$button_text.'</button>',
    //             $actions
    //         );
    //     }
    //     return $sorted;
    // }
    //
    // public function getCompleteResume($id = '', $type = '')
    // {
    //     $this->db->select('resumes.*, candidates.*');
    //     $this->db->from('resumes');
    //     if ($type) {
    //     $this->db->where('resumes.resume_id', $id);
    //     } else {
    //     $this->db->where('resumes.candidate_id', $id);
    //     }
    //     $this->db->where('resumes.status', 1);
    //     $this->db->join('candidates','candidates.candidate_id = resumes.candidate_id', 'left');
    //
    //     $result = $this->db->get();
    //     $result = objToArr($result->result());
    //     $result = isset($result[0]) ? $result[0] : array();
    //     if ($result) {
    //         $resume_id = isset($result['resume_id']) ? $result['resume_id'] : '';
    //         $result['experiences'] = $this->getResumeEntities('resume_experiences', $resume_id);
    //         $result['qualifications'] = $this->getResumeEntities('resume_qualifications', $resume_id);
    //         $result['languages'] = $this->getResumeEntities('resume_languages', $resume_id);
    //         $result['achievements'] = $this->getResumeEntities('resume_achievements', $resume_id);
    //         $result['references'] = $this->getResumeEntities('resume_references', $resume_id);
    //     }
    //     return $result;
    // }
    //
    // public function getCompleteResumeJobBoard($id = '')
    // {
    //     $this->db->select('resumes.*, candidates.*');
    //     $this->db->from('resumes');
    //     $this->db->where('resumes.resume_id', $id);
    //     $this->db->where('resumes.status', 1);
    //     $this->db->join('candidates','candidates.candidate_id = resumes.candidate_id', 'left');
    //
    //     $result = $this->db->get();
    //     $result = objToArr($result->result());
    //     $result = isset($result[0]) ? $result[0] : array();
    //     if ($result) {
    //         $resume_id = isset($result['resume_id']) ? $result['resume_id'] : '';
    //         $result['experiences'] = $this->getResumeEntities('resume_experiences', $resume_id);
    //         $result['qualifications'] = $this->getResumeEntities('resume_qualifications', $resume_id);
    //         $result['languages'] = $this->getResumeEntities('resume_languages', $resume_id);
    //         $result['achievements'] = $this->getResumeEntities('resume_achievements', $resume_id);
    //         $result['references'] = $this->getResumeEntities('resume_references', $resume_id);
    //     }
    //     return $result;
    // }
    //
    // public function getResumeEntities($table, $resume_id)
    // {
    //     $this->db->where($table.'.resume_id', $resume_id);
    //     $this->db->select($table.'.*');
    //     $this->db->from($table);
    //     $result = $this->db->get();
    //     $result = objToArr($result->result());
    //     return $result;
    // }
    //
    // public function getTopCandidates()
    // {
    //     //Setting session for every parameter of the request
    //     $this->setSessionValues();
    //     $limit = setting('charts-limit');
    //
    //     $traits_result = $this->getSessionValues('traits_check');
    //     $interviews_result = $this->getSessionValues('interviews_check');
    //     $quizes_result = $this->getSessionValues('quizes_check');
    //     $job_id = $this->getSessionValues('job_id');
    //
    //     if ($job_id) {
    //     $this->db->where('job_applications.job_id', $job_id);
    //     }
    //     $this->db->where('candidates.status', 1);
    //     $this->db->select('
    //         CONCAT('.CF_DB_PREFIX.'candidates.first_name, " ", '.CF_DB_PREFIX.'candidates.last_name) as label,
    //         SUM('.CF_DB_PREFIX.'job_applications.traits_result) as traits_result,
    //         SUM('.CF_DB_PREFIX.'job_applications.quizes_result) as quizes_result,
    //         SUM('.CF_DB_PREFIX.'job_applications.interviews_result) as interviews_result
    //     ');
    //     $this->db->join('job_applications', 'job_applications.candidate_id = candidates.candidate_id', 'left');
    //     $this->db->group_by('job_applications.candidate_id');
    //     $this->db->order_by('job_applications.job_application_id', 'DESC');
    //     $this->db->limit($limit, 0);
    //     $result = $this->db->get('candidates');
    //     $result = $result->result();
    //     $labels = array();
    //     $totals = array();
    //     foreach ($result as $key => $value) {
    //         $total = 0;
    //         $labels[] = $value->label;
    //         if ($traits_result) {
    //             $total = $total + $value->traits_result;
    //         }
    //         if ($interviews_result) {
    //             $total = $total + $value->interviews_result;
    //         }
    //         if ($quizes_result) {
    //             $total = $total + $value->quizes_result;
    //         }
    //         $totals[] = round($total/3);
    //     }
    //
    //     $result = array(
    //         'labels' => $labels,
    //         'data' => $totals,
    //     );
    //
    //     return json_encode($result);
    // }
    //
    // public function getCandidateResumeIds($candidate_id)
    // {
    //     $this->db->select('GROUP_CONCAT('.CF_DB_PREFIX.'resumes.resume_id) as ids');
    //     $this->db->where('candidate_id', $candidate_id);
    //     $result = $this->db->get('resumes');
    //     $result = objToArr($result->result());
    //     $result = isset($result[0]['ids']) ? explode(',', $result[0]['ids']) : array();
    //     return $result;
    // }

}
