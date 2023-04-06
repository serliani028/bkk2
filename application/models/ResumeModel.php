<?php

class ResumeModel extends CI_Model
{
    protected $table = 'resumes';
    protected $table2 = 'resume_qualifications';
    protected $key = 'resume_id';

    public function getFirst($column, $value)
    {
        $this->db->where($column, $value);
        $this->db->select('resumes.*');
        $this->db->from($this->table);
        $result = $this->db->get();
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
    }
    
    public function getFirst2($column, $value)
    {
        $this->db->where($column, $value);
        $this->db->select('resume_qualifications.*');
        $this->db->from($this->table2);
        $result = $this->db->get();
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
    }

    public function getResumeItem($resume_id, $table, $first_condition = array(), $second_condition = array())
    {
        if ($first_condition) {
            $this->db->where($first_condition[0], $first_condition[1]);
        }
        if ($second_condition) {
            $this->db->where($second_condition[0], $second_condition[1]);
        }
        $this->db->where('resume_id', $resume_id);
        $this->db->from($table);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? true : false;
    }

    public function getCandidateResumesList()
    {
        if (candidateSession()) {
            $this->db->select('resumes.title, resumes.resume_id');
            $this->db->where('resumes.candidate_id', candidateSession());
            $this->db->where('resumes.status', 1);
            $this->db->order_by('resumes.updated_at', 'DESC');
            $this->db->group_by('resumes.resume_id');
            $this->db->from($this->table);
            $result = $this->db->get();
            return objToArr($result->result());
        } else {
            return array();
        }
    }

    public function getCandidateResumesAchiev($id_kandidat)
    {
            $this->db->select('*');
            $this->db->from('resumes,resume_qualifications');
            $this->db->where('resumes.candidate_id',$id_kandidat);
            $this->db->where('resumes.resume_id = resume_qualifications.resume_id');
            return $this->db->get()->num_rows();
    }

    public function getCandidateResumes($candidate_id)
    {
        $this->db->where('resumes.candidate_id', $candidate_id);
        $this->db->select('
            resumes.*,
            COUNT(DISTINCT('.CF_DB_PREFIX.'resume_experiences.resume_experience_id)) as experience,
            COUNT(DISTINCT('.CF_DB_PREFIX.'resume_qualifications.resume_qualification_id)) as qualification,
            COUNT(DISTINCT('.CF_DB_PREFIX.'resume_languages.resume_language_id)) as language,
            COUNT(DISTINCT('.CF_DB_PREFIX.'resume_achievements.resume_achievement_id)) as achievement,
            COUNT(DISTINCT('.CF_DB_PREFIX.'resume_references.resume_reference_id)) as reference
        ');
        $this->db->join('resume_experiences','resume_experiences.resume_id = resumes.resume_id', 'left');
        $this->db->join('resume_qualifications','resume_qualifications.resume_id = resumes.resume_id', 'left');
        $this->db->join('resume_languages','resume_languages.resume_id = resumes.resume_id', 'left');
        $this->db->join('resume_achievements','resume_achievements.resume_id = resumes.resume_id', 'left');
        $this->db->join('resume_references','resume_references.resume_id = resumes.resume_id', 'left');
        $this->db->order_by('resumes.created_at', 'DESC');
        $this->db->group_by('resumes.resume_id');
        $this->db->from($this->table);
        $result = $this->db->get();
        return objToArr($result->result());
    }

    public function getCompleteResume($resume_id)
    {
        $this->db->where('resumes.resume_id', $resume_id);
        $this->db->select('resumes.*,resumes.candidate_id as id_kandidat, resumes.skck as skck, resumes.sk_covid as skcd');
        $this->db->from($this->table);
        $result = $this->db->get();
        $result = objToArr($result->result());
        $result[0]['experiences'] = $this->getResumeEntities('resume_experiences', $resume_id);
        $result[0]['qualifications'] = $this->getResumeEntities('resume_qualifications', $resume_id);
        $result[0]['languages'] = $this->getResumeEntities('resume_languages', $resume_id);
        $result[0]['achievements'] = $this->getResumeEntities('resume_achievements', $resume_id);
        $result[0]['references'] = $this->getResumeEntities('resume_references', $resume_id);
        $result[0]['type'] = "detailed";
        $result[0]['resume_id'] = $resume_id;
        return $result[0];
    }
    
    public function getCompleteResume2($resume_id)
    {
        $this->db->where('resume_qualifications.resume_id', $resume_id);
        $this->db->select('resume_qualifications.*');
        $this->db->from('resume_qualifications');
        return $result = $this->db->get()->row();
    }

    public function getFirstDetailedResume()
    {
        $this->db->where('resumes.candidate_id', candidateSession());
        $this->db->where('resumes.type', 'detailed');
        $this->db->select('resumes.*');
        $this->db->from($this->table);
        $result = $this->db->get();
        $result = objToArr($result->result());
        $resume_id = isset($result[0]['resume_id']) ? $result[0]['resume_id'] : '';
        if ($resume_id) {
            return $resume_id;
        } else {
            return $this->createFirstDetailedResumeIfNotExist();
        }
    }

    private function createFirstDetailedResumeIfNotExist()
    {
        $data['candidate_id'] = candidateSession();
        $data['title'] = 'My Resume';
        $data['designation'] = 'My Designation';
        $data['objective'] = 'My Objective';
        $data['status'] = 1;
        $data['type'] = 'detailed';
        $data['created_at'] = date('Y-m-d G:i:s');
        $data['updated_at'] = date('Y-m-d G:i:s');
        $this->db->insert('resumes', $data);
        return $this->getFirstDetailedResume();
    }

    public function getResumeEntities($table, $resume_id)
    {
        $this->db->where($table.'.resume_id', $resume_id);
        $this->db->select($table.'.*');
        $this->db->from($table);
        $result = $this->db->get();
        $result = objToArr($result->result());
        return $result;
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('resume_id !=', $edit);
        }
        $query = $this->db->get('resumes');
        return $query->num_rows() > 0 ? true : false;
    }

    public function createResume($verification = false)
    {
        $data = $this->xssCleanInput();
        unset($data['email']);
        $data['candidate_id'] = candidateSession();
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d G:i:s');
        $data['updated_at'] = date('Y-m-d G:i:s');
        $this->db->insert('resumes', $data);
        $id = $this->db->insert_id();
        return $this->getFirst('resumes.resume_id', $id);
    }

    private function insertResumeImage($image, $id)
    {
        $name = $id.'.jpg';
        $full_path = ASSET_ROOT.'/images/resumes/'.$name;
        $content = file_get_contents($image);
        $fp = fopen($full_path, "w");
        fwrite($fp, $content);
        fclose($fp);
        $controllerInstance = & get_instance();
        $controllerInstance->resizeByWidthAndCropByHeight(ASSET_ROOT.'/images/resumes/', $id, 'jpg', 60, 60);
        $controllerInstance->resizeByWidthAndCropByHeight(ASSET_ROOT.'/images/resumes/', $id, 'jpg', 120, 120);
    }

    public function updateResumeMain($resume_id, $experienceTotal = '')
    {
        if ($experienceTotal == '') {
            $data = array(
                'experiences' => $this->getResumeItemsCount('resume_experiences', $resume_id),
                'qualifications' => $this->getResumeItemsCount('resume_qualifications', $resume_id),
                'languages' => $this->getResumeItemsCount('resume_languages', $resume_id),
                'achievements' => $this->getResumeItemsCount('resume_achievements', $resume_id),
                'references' => $this->getResumeItemsCount('resume_references', $resume_id)
            );
        } else {
            $data = array('experience' => $experienceTotal);
        }
        $this->db->where('resumes.resume_id', $resume_id);
        $this->db->update('resumes', $data);
    }

    public function getResumeItemsCount($table, $resume_id)
    {
        $this->db->where('resume_id', $resume_id);
        $this->db->from($table);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function updateResumeGeneral($file)
    {
        $data = $this->xssCleanInput();
        $id = decode($data['id']);
        unset($data['id']);
        unset($data['skck']);
        $data['updated_at'] = date('Y-m-d G:i:s');
        
        if (isset($file['file'])) {
            $data['file'] = $file['file'];
        }
        
       
        $this->db->where('resumes.resume_id', $id);
        return $this->db->update('resumes', $data);
    }

    public function sertifikat($file)
    {
        $data = $this->xssCleanInput();
        if (isset($file['file'])) {
            $data['file'] = $file['file'];
        }
        $data['created_date'] = date('Y-m-d H:i:s');
        $this->db->insert('sertifikat', $data);
    }

    public function updateResumeExperience()
    {
        $data = arrangeSections($this->xssCleanInput());
        foreach ($data as $d) {
            $d['resume_id'] = decode($d['resume_id']);
            if ($d['resume_experience_id']) {
                $id = decode($d['resume_experience_id']);
                unset($d['resume_experience_id']);
                $d['updated_at'] = date('Y-m-d G:i:s');
                $this->db->where('resume_experiences.resume_experience_id', $id);
                $this->db->update('resume_experiences', $d);
            } else {
                $existing = $this->getResumeItem(
                    $d['resume_id'], 'resume_experiences', array('title', $d['title']), array('company', $d['company'])
                );
                if (!$existing) {
                    unset($d['resume_experience_id']);
                    $new['created_at'] = date('Y-m-d G:i:s');
                    $new['updated_at'] = date('Y-m-d G:i:s');
                    $new = array_merge($new, $d);
                    $this->db->insert('resume_experiences', $new);
                }
            }
        }
        $resume_id = decode($data[0]['resume_id']);
        $this->updateResumeMain($resume_id);
        $this->updateResumeMain($resume_id, $this->getExprienceInMonths($resume_id));
    }

    public function updateResumeQualification($file)
    {
            $d = $this->xssCleanInput();
            if ($d['resume_qualification_id'] != "") {
                $id = decode($d['resume_qualification_id']);
                unset($d['resume_qualification_id']);
                unset($d['resume_id']);
                $a['title'] = $d['title'];
                
                if($d['title'] == 'Tidak Bersekolah'){
                $a['institution'] = '-';
                $ceks = $this->db->get_where('resume_qualifications',array('resume_qualification_id => $id'))->row();
                    if((!empty($ceks)) && $ceks->marks != '-'){
                         @unlink(ASSET_ROOT.'/images/candidates/'.$ceks->marks);    
                    }
                $a['marks'] = '-';
                }else{
                    if ($file['file'] != '') {
                $a['marks'] = $file['file'];
                }
                $a['institution'] = $d['institution'];
                }
                
                
                $a['updated_at'] = date('Y-m-d G:i:s');
                $this->db->where('resume_qualifications.resume_qualification_id', $id);
                $this->db->update('resume_qualifications', $a);
            } else {
            $d['resume_id'] = decode($d['resume_id']);
                
                    unset($d['resume_qualification_id']);
                    $new['resume_id'] = $d['resume_id'];
                    $new['title'] = $d['title'];
                    
                    if($new['title'] == 'Tidak Bersekolah'){
                    $new['institution'] = '-';
                    $new['marks'] = '-';
                    }else{
                    if ($file['file'] != '') {
                    $new['marks'] = $file['file'];
                    }
                    $new['institution'] = $d['institution'];
                    }
                
                    $new['created_at'] = date('Y-m-d G:i:s');
                    $new['updated_at'] = date('Y-m-d G:i:s');
                    $cek = $this->db->insert('resume_qualifications', $new);
                    
                if($cek){
                $data['qualifications'] = 1;
                $this->db->where('resumes.resume_id', $d['resume_id']);
                $this->db->update('resumes', $data);
                }
            }
        return TRUE;
    }

    public function updateResumeLanguage()
    {
        $data = arrangeSections($this->xssCleanInput());
        foreach ($data as $d) {
            $d['resume_id'] = decode($d['resume_id']);
            if ($d['resume_language_id']) {
                $id = decode($d['resume_language_id']);
                unset($d['resume_language_id']);
                $d['updated_at'] = date('Y-m-d G:i:s');
                $this->db->where('resume_languages.resume_language_id', $id);
                $this->db->update('resume_languages', $d);
            } else {
                $existing = $this->getResumeItem($d['resume_id'], 'resume_languages', array('title', $d['title']));
                if (!$existing) {
                    unset($d['resume_language_id']);
                    $new['created_at'] = date('Y-m-d G:i:s');
                    $new['updated_at'] = date('Y-m-d G:i:s');
                    $new = array_merge($new, $d);
                    $this->db->insert('resume_languages', $new);
                }
            }
        }
        $this->updateResumeMain(decode($data[0]['resume_id']));
    }

    public function updateResumeAchievement()
    {
        $data = arrangeSections($this->xssCleanInput());
        // if (isset($file['file'])) {
        //  $data['file'] = $file['file'];
        // }
        foreach ($data as $d) {
            $d['resume_id'] = decode($d['resume_id']);
            if ($d['resume_achievement_id']) {
                $id = decode($d['resume_achievement_id']);
                unset($d['resume_achievement_id']);
                unset($d['file']);
                $d['updated_at'] = date('Y-m-d G:i:s');
                $this->db->where('resume_achievements.resume_achievement_id', $id);
                $this->db->update('resume_achievements', $d);
            } else {
                $existing = $this->getResumeItem($d['resume_id'], 'resume_achievements', array('title', $d['title']));
                if (!$existing) {
                    unset($d['resume_achievement_id']);
                    unset($d['file']);
                    $new['created_at'] = date('Y-m-d G:i:s');
                    $new['updated_at'] = date('Y-m-d G:i:s');
                    $new = array_merge($new, $d);
                    $this->db->insert('resume_achievements', $new);
                }
            }
        }
        $this->updateResumeMain(decode($data[0]['resume_id']));
    }

    public function updateResumeReference()
    {
        $data = arrangeSections($this->xssCleanInput());
        foreach ($data as $d) {
            $d['resume_id'] = decode($d['resume_id']);
            if ($d['resume_reference_id']) {
                $id = decode($d['resume_reference_id']);
                unset($d['resume_reference_id']);
                $d['updated_at'] = date('Y-m-d G:i:s');
                $this->db->where('resume_references.resume_reference_id', $id);
                $this->db->update('resume_references', $d);
            } else {
                $existing = $this->getResumeItem(
                    $d['resume_id'], 'resume_references', array('title', $d['title']), array('relation', $d['relation'])
                );
                if (!$existing) {
                    unset($d['resume_reference_id']);
                    $new['created_at'] = date('Y-m-d G:i:s');
                    $new['updated_at'] = date('Y-m-d G:i:s');
                    $new = array_merge($new, $d);
                    $this->db->insert('resume_references', $new);
                }
            }
        }
        $this->updateResumeMain(decode($data[0]['resume_id']));
    }

    public function removeSection($section_id, $type)
    {
        switch ($type) {
            case 'experience':
                $this->db->delete('resume_experiences', array('resume_experience_id' => decode($section_id)));
                break;
            case 'qualification':
                $this->db->delete('resume_qualifications', array('resume_qualification_id' => decode($section_id)));
                break;
            case 'language':
                $this->db->delete('resume_languages', array('resume_language_id' => decode($section_id)));
                break;
            case 'achievement':
                $this->db->delete('resume_achievements', array('resume_achievement_id' => decode($section_id)));
                break;
            case 'reference':
                $this->db->delete('resume_references', array('resume_reference_id' => decode($section_id)));
                break;
            default:
                break;
        }
    }

    public function getEmptyTableObject($table)
    {
        return $this->emptyObject($table);
    }

    public function updateDocResume($file)
    {
        $data = $this->xssCleanInput();
        $id = decode($data['resume_id']);
        unset($data['resume_id']);
        $data['updated_at'] = date('Y-m-d G:i:s');
        if (isset($file['file'])) {
            $data['file'] = $file['file'];
        }
        $this->db->where('resume_id', $id);
        return $this->db->update('resumes', $data);
    }

    private function getExprienceInMonths($resume_id)
    {
        $this->db->where('resume_id', $resume_id);
        $this->db->select('from, to');
        $this->db->from('resume_experiences');
        $data = $this->db->get();

        $experience = 0;
        foreach ($data->result() as $key => $value) {
            $experience = $experience + getMonthsBetweenDates($value->from, $value->to) + 1;
        }
        return $experience;
    }

}
