<?php

class AdminCandidateModel extends CI_Model
{
    protected $table = 'candidates';
    protected $key = 'candidate_id';

    public function getCandidate($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('candidates');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('candidates');
    }

    public function getDataPrakerja()
    {
      $this->db->select('*');
      $this->db->from('prakerja');
      $query=$this->db->get()->result();

      return $query;
    }
    
    public function getSiswaMitra($id)
    {
    $this->db->select('
      GROUP_CONCAT('.CF_DB_PREFIX.'resume_languages.title) as job_title');
    $this->db->from('candidates');
    $this->db->where('candidates.account_id',$id);
    $this->db->join('resumes','resumes.candidate_id = candidates.candidate_id');
    $this->db->join('resume_languages','resume_languages.resume_id = resumes.resume_id');
    $this->db->group_by('candidates.candidate_id');
    $query = $this->db->get()->result();

      return $query;
    }

   
    //  public function getDataVokasi()
    // {
    //   $this->db->select('
    //   user_mitra.nama as nama,
    //   user_mitra.id_mitra as id_mitra,
    //   COUNT(DISTINCT(CONCAT('.CF_DB_PREFIX.'candidates.candidate_id))) as daftar,
    //   COUNT(DISTINCT(jai.candidate_id)) as tes,
    //   COUNT(DISTINCT(jah.job_application_id)) as lolos,
    //   COUNT(DISTINCT(jar.candidate_quiz_id)) as kompetensi
    //   ');
      
    //   $this->db->from('user_mitra');
      
    //   $this->db->join('job_applications as jah', 'jah.mitra = user_mitra.id_mitra AND jah.status = "hired" AND jai.candidate_id = candidates.candidate_id AND candidates.status_siswa = 0', 'left');
    //   $this->db->join('candidate_quizes as jar', 'jar.mitra = user_mitra.id_mitra AND jai.candidate_id = candidates.candidate_id AND candidates.status_siswa = 0', 'left');
      
    //   $this->db->group_by('user_mitra.id_mitra');
      
    //   $kampus=$this->db->get()->result();
    //   return $kampus;
    // }
    
    public function getDataJurusanSmk($id)
    {
      $this->db->select('
      jurusan_mitra.*,
      COUNT(candidates.candidate_id) as jumlah_siswa
      ');
      
      $this->db->from('jurusan_mitra,candidates');
      
       if($id != null){
      $this->db->where('jurusan_mitra.id_mitra',$id);
      }
      
      $this->db->where('jurusan_mitra.kode_jurusan = candidates.jurusan');
      $this->db->group_by('jurusan_mitra.kode_jurusan');
      
      $kampus=$this->db->get()->result();
      return $kampus;
    }
    
    public function getDataVokasiGuru()
    {
      $this->db->select('
      user_mitra.nama as nama,
      user_mitra.id_mitra as id_mitra,
      COUNT(DISTINCT(CONCAT('.CF_DB_PREFIX.'candidates.candidate_id))) as daftar_guru,
      COUNT(DISTINCT(jai.candidate_id)) as tes_guru,
      ');
      
      $this->db->from('user_mitra');
      
      $this->db->join('job_applications as jai', 'jai.mitra = user_mitra.id_mitra AND jai.candidate_id = candidates.candidate_id AND candidates.jenis_user = 1 AND candidates.status_siswa = 1', 'left');
    //   $this->db->where('candidates.jenis_user', 1);    
    //         $this->db->where('candidates.status_siswa', 1);  
            
      $this->db->group_by('user_mitra.id_mitra');
      
      $kampus=$this->db->get()->result();
      return $kampus;
    }
    
     public function getDataVokasiUser($id)
    {
      $this->db->select('candidates.*,candidates.created_at as tanggal_lamar');
      $this->db->from('candidates');  
    
    
      
      $this->db->order_by('candidates.candidate_id ','DESC');
      $query=$this->db->get()->result();

      return $query;
    }
    
    public function getDetailGuru($id)
    {
      $this->db->select('candidates.*,candidates.created_at as tanggal_lamar');
      $this->db->from('candidates');  

      
      $this->db->order_by('candidates.candidate_id ','DESC');
      $query=$this->db->get()->result();

      return $query;
    }
    
    public function getDataVokasiPsikotes($id)
    {
      $this->db->select('
        candidates.*,job_applications.*,job_applications.created_at as tanggal_lamar,job_applications.job_application_id as id_lamar,
        jobs.*,jobs.title as judul_pekerjaan, minat.level as level_pekerjaan,
         GROUP_CONCAT('.CF_DB_PREFIX.'jobs.title) as lamaran
        ');
      $this->db->from('candidates,job_applications,jobs,minat');  
      
      $this->db->where('candidates.candidate_id = job_applications.candidate_id ');
      $this->db->where('candidates.status_siswa !=',1);
    //   $this->db->where('candidates.jenis_user !=',1);
     
     
    //   $this->db->where('candidates.status_siswa',0);
      $this->db->where('job_applications.job_id = jobs.job_id');
      $this->db->where('jobs.status_minat = minat.id');
      $this->db->group_by('job_applications.candidate_id');
      $this->db->order_by('job_applications.candidate_id ','DESC');
      $query=$this->db->get()->result();

      return $query;
    }
    
    public function getDetailGuruPsiko($id)
    {
       $this->db->select('
        candidates.*,job_applications.*,job_applications.created_at as tanggal_lamar,job_applications.job_application_id as id_lamar,
        jobs.*,jobs.title as judul_pekerjaan, minat.level as level_pekerjaan,
         GROUP_CONCAT('.CF_DB_PREFIX.'jobs.title) as lamaran
        ');
      $this->db->from('candidates,job_applications,jobs,minat');  
      
      $this->db->where('candidates.candidate_id = job_applications.candidate_id ');
      $this->db->where('candidates.status_siswa',1);
      $this->db->where('candidates.jenis_user',1);
     
    
     
    //   $this->db->where('candidates.status_siswa',0);
      $this->db->where('job_applications.job_id = jobs.job_id');
      $this->db->where('jobs.status_minat = minat.id');
      $this->db->group_by('job_applications.candidate_id');
      $this->db->order_by('job_applications.candidate_id ','DESC');
      $query=$this->db->get()->result();

      return $query;
    }
    
    public function getDataVokasiMagang($id)
    {
      $this->db->select('
        candidates.*,job_applications.*,job_applications.created_at as tanggal_lamar,
        job_applications.job_application_id as id_lamar,jobs.*,jobs.title as judul_pekerjaan, 
         GROUP_CONCAT('.CF_DB_PREFIX.'jobs.title) as lamaran
        ');
      $this->db->from('candidates,job_applications,jobs');  
    
      $this->db->where('candidates.candidate_id = job_applications.candidate_id ');
      $this->db->where('job_applications.job_id = jobs.job_id');
      $this->db->group_by('job_applications.candidate_id');
      $this->db->order_by('job_applications.candidate_id ','DESC');
      $query=$this->db->get()->result();

      return $query;
    }
    
    public function getDataVokasiKompetensi($id)
    {
      $this->db->select('candidates.*,candidate_quizes.*,candidate_quizes.created_at as tanggal_lamar,jobs.*,jobs.title as judul_pekerjaan, candidate_quizes.status_quiz as status_kuis');
      $this->db->from('candidates,candidate_quizes,jobs');  
     
      $this->db->where('candidates.candidate_id = candidate_quizes.candidate_id ');
      $this->db->where('candidates.status_siswa !=',1);
      
      $this->db->where('candidate_quizes.job_id = jobs.job_id');
      $this->db->group_by('candidate_quizes.candidate_id');
      $this->db->order_by('candidate_quizes.candidate_quiz_id ','DESC');
      $query=$this->db->get()->result();

      return $query;
    }
    
     public function getDataVokasiLolos($id)
    {
      $this->db->select('candidates.*,job_applications.*,job_applications.status as status_pekerjaan,job_applications.link_form as link_form,job_applications.created_at as tanggal_lamar,
      job_applications.status_verif as status_verif,job_applications.job_application_id as id_lamar,job_applications.status_bayar as status_bayar,job_applications.token_bayar as token_bayar,resumes.*,resumes.file as file_cv,resume_qualifications.marks as ijazah2, jobs.*, candidates.created_at as tgl_buat, job_applications.file_bukti as file_bukti_bayar,minat.level as level_pekerjaan');
      $this->db->from('candidates,job_applications,resumes,resume_qualifications,jobs,minat');  
    //   $this->db->where('candidates.ktp != "" ');
   
      
      $this->db->where('candidates.status_siswa !=',1);
      
      $this->db->where('candidates.candidate_id = job_applications.candidate_id ');
      $this->db->where('job_applications.resume_id = resumes.resume_id ');
      $this->db->where('resume_qualifications.resume_id = job_applications.resume_id ');
    //   $this->db->where('resume_qualifications.marks != "" ');
      $this->db->where('job_applications.job_id = jobs.job_id');
      $this->db->where('job_applications.status !=','rejected');
      $this->db->where('jobs.status_minat = minat.id');
      
      $this->db->order_by('candidates.candidate_id ','DESC');
      $this->db->group_by('job_applications.job_application_id ');
      $query=$this->db->get()->result();

      return $query;
    }
    
     public function getPesertaMagang($var)
    {
        
      $this->db->select('candidates.account_type');
      $this->db->from('candidates');
      
      $this->db->where('candidates.account_type','kampus');
      $kampus=$this->db->get()->num_rows();
    
      $this->db->select('candidates.account_type');
      $this->db->from('candidates');
      
      $this->db->where('candidates.account_type','vokasi');
      $vokasi=$this->db->get()->num_rows();
      
      $query = array (
          'kampus' => $kampus,
          'vokasi' => $vokasi,
          'total' => $kampus+$vokasi
          );
          
      return $query;
    }
    
     public function getPsikotesMagang($var)
    {
      $this->db->select('job_applications.candidate_id,candidates.candidate_id');
      $this->db->from('job_applications,candidates');
     
    //   $this->db->where('kode_aktivasi !=','');
      $this->db->group_by('job_applications.candidate_id');
      return $this->db->get()->num_rows();
    }
    
    public function getKompetensi($var)
    {
      $this->db->select('candidate_quizes.candidate_id,candidates.candidate_id ');
      $this->db->from('candidate_quizes,candidates');
      $this->db->where('candidate_quizes.candidate_id = candidates.candidate_id');
      
      $this->db->group_by('candidate_quizes.candidate_id');
      return $this->db->get()->num_rows();
    }
    
    public function getGagal($var)
    {
        
      $this->db->select('candidate_id');
      $this->db->from('job_applications');
      $this->db->where('status','hired');
      $this->db->group_by('candidate_id');
      return $this->db->get()->num_rows();
    }
    
   
    public function getLolosPsikotesMagang($var)
    {
        
      $this->db->where('candidates.account_type = "kampus"  ');
      
      $this->db->where('candidates.candidate_id = job_applications.candidate_id ');
      $this->db->where('job_applications.status = "interviewed" ');
      $kampus=$this->db->get('candidates,job_applications')->num_rows();
    
      $this->db->where('candidates.account_type = "vokasi"');
      
      $this->db->where('candidates.candidate_id = job_applications.candidate_id  ');
      $this->db->where('job_applications.status = "interviewed" ');
      $vokasi=$this->db->get('candidates,job_applications')->num_rows();
      
      $query = array (
          'kampus' => $kampus,
          'vokasi' => $vokasi,
          'total' => $kampus+$vokasi
          );
          
      return $query;
    }
    
    

    public function getCandidatesForCSV($ids)
    {
        $this->db->from('candidates');
        $this->db->select('
            candidates.nis,
            candidates.first_name , candidates.last_name,
            candidates.email,
            candidates.phone1,
            candidates.address,
            candidates.dob,
            jurusan.nama as jurusan,candidates.kelas_siswa as kelas,
            ROUND(AVG(job_applications.rating),2) as rating,
            ROUND(AVG(job_applications.quizes_result),2) as kompetensi,
            ROUND(AVG(job_applications.status_tes),2) as psikologi,
        ');
        $this->db->where_in('candidates.candidate_id', explode(',', $ids));
         $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('job_applications','job_applications.candidate_id = candidates.candidate_id', 'left');
        $this->db->group_by('candidates.candidate_id');
        $this->db->order_by('candidates.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function changeStatus($candidate_id, $status)
    {
        $this->db->where('candidate_id', $candidate_id);
        $this->db->update('candidates', array('status' => ($status == 1 ? 0 : 1)));
        return $status;
    }

    public function remove($candidate_id)
    {
        //First deleting candidate
        $this->db->delete('candidates', array('candidate_id' => $candidate_id));

        //Second(A) get resume_ids of candidate
        $resume_ids = $this->getCandidateResumeIds($candidate_id);

        if ($resume_ids) {
            //Second(B) delete all resumes of candidate
            $this->db->where_in('resume_id', $resume_ids);
            $this->db->delete('resumes');
            $this->db->where_in('resume_id', $resume_ids);
            $this->db->delete('resume_achievements');
            $this->db->where_in('resume_id', $resume_ids);
            $this->db->delete('resume_experiences');
            $this->db->where_in('resume_id', $resume_ids);
            $this->db->delete('resume_qualifications');
            $this->db->where_in('resume_id', $resume_ids);
            $this->db->delete('resume_languages');
            $this->db->where_in('resume_id', $resume_ids);
            $this->db->delete('resume_references');
        }

        //Third delete job applications
        $this->db->delete('job_applications', array('candidate_id' => $candidate_id));

        //Forth delete interviews of candidate
        $this->db->delete('candidate_interviews', array('candidate_id' => $candidate_id));

        //Fifth delete quizes of candidate
        $this->db->delete('candidate_quizes', array('candidate_id' => $candidate_id));

        //Sixth delete self assesment answers
        $this->db->delete('job_trait_answers', array('candidate_id' => $candidate_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('candidate_id', $ids);
                $this->db->update('candidates', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('candidate_id', $ids);
                $this->db->update('candidates', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('candidate_id !=', $edit);
        }
        $query = $this->db->get('candidates');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll($active = true, $srh = '')
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        if ($srh) {
            $this->db->group_start()->like('candidatename', $srh)->group_end();
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getTotalCandidates()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('candidates');
        return $query->num_rows();
    }

    public function candidatesList()
    {
        
        $request = $this->input->get();
        $columns = array(
            "",
            "",
            "candidates.first_name , candidates.last_name",
            "candidates.email",
            "user_mitra.nama as sekolah,jurusan.nama as jurusan,candidates.kelas as kelas,",
            "",
            "candidates.created_at",
            "candidates.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('candidates');
        $this->db->select('
            candidates.*,
            AVG(job_applications.rating) as rating,
            AVG(job_applications.quizes_result) as kompetensi,
            AVG(job_applications.status_tes) as psikologi,
            user_mitra.nama as sekolah,jurusan.nama as jurusan,candidates.kelas_siswa as kelas,
            resumes.experience,
        ');
        if ($srh) {
            $this->db->group_start()->like('candidates.first_name', $srh)->or_like('candidates.last_name', $srh)->or_like('candidates.email', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
           if($request['status'] == 1){
            $this->db->where('candidates.status', 1);    
            }else if($request['status'] == 2){
            $this->db->where('candidates.status_siswa_bkk', 1);  
            }else{
            $this->db->where('candidates.status', 0);  
            }
        }
        
        if (isset($request['f_siswa']) && $request['f_siswa'] != '') {
           if($request['f_siswa'] == 1){
            $this->db->order_by('AVG(job_applications.rating)','DESC');    
            }else if($request['f_siswa'] == 2){
            $this->db->order_by('AVG(job_applications.quizes_result)','DESC');  
            }else{
            $this->db->order_by('AVG(job_applications.status_tes)','DESC');  
            }
        }
        
        if (isset($request['jenis_mitra']) && $request['jenis_mitra'] != '') {
           $this->db->where('candidates.account_id', $request['jenis_mitra']);  
        }
        
        $this->db->join('resumes','resumes.candidate_id = candidates.candidate_id AND resumes.is_default = 1', 'left');
        $this->db->join('user_mitra','user_mitra.id_mitra = candidates.account_id', 'left');
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('job_applications','job_applications.candidate_id = candidates.candidate_id', 'left');
        $this->db->group_by('candidates.candidate_id');
        $this->db->order_by($orderColumn, $orderDirection);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        $result = array(
            'data' => $this->prepareDataForTable($query->result()),
            'recordsTotal' => $this->getTotal(),
            'recordsFiltered' => $this->getTotal($srh, $request),
        );

        return $result;
    }
    
    
    public function getTotal($srh = false, $request = '')
    {
        $this->db->from('candidates');
        
        if ($srh) {
            $this->db->group_start()->like('candidates.first_name', $srh)->or_like('candidates.last_name', $srh)->or_like('candidates.email', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            if($request['status'] == 1){
            $this->db->where('candidates.status', 1);    
            }else if($request['status'] == 2){
            $this->db->where('candidates.status_siswa_bkk', 1);  
            }else{
            $this->db->where('candidates.status', 0);  
            }
        }
        
        if (isset($request['f_siswa']) && $request['f_siswa'] != '') {
           if($request['f_siswa'] == 1){
            $this->db->order_by('AVG(job_applications.rating)','DESC');    
            }else if($request['f_siswa'] == 2){
            $this->db->order_by('AVG(job_applications.quizes_result)','DESC');  
            }else{
            $this->db->order_by('AVG(job_applications.status_tes)','DESC');  
            }
        }
        
         if (isset($request['jenis_mitra']) && $request['jenis_mitra'] != '') {
           $this->db->where('candidates.account_id', $request['jenis_mitra']);  
        }
     
        $this->db->join('resumes','resumes.candidate_id = candidates.candidate_id AND resumes.is_default = 1', 'left');
        $this->db->join('user_mitra','user_mitra.id_mitra = candidates.account_id', 'left');
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('job_applications','job_applications.candidate_id = candidates.candidate_id', 'left');
        $this->db->group_by('candidates.candidate_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($candidates)
    {
        $sorted = array();
        foreach ($candidates as $u) {
            $u = objToArr($u);
            if ($u['status'] == 1) {
                $button_text = lang('active');
                $button_class = 'success';
                $button_title = lang('click_to_deactivate');
            } else {
                $button_text = lang('inactive');
                $button_class = 'danger';
                $button_title = lang('click_to_activate');
            }
            
            if ($u['rating']) {
                $button_text_rating = '<br> RATING : '.round($u['rating'],2).'<i class ="fas fa-star" style="color:orange" ></i>';
            } else {
                $button_text_rating = '<br> RATING : - ';
            }
            
            if ($u['kelas']) {
                $button_kelas = '<br> Kelas : '.$u['kelas'];
            } else {
                $button_kelas = '<br> <b class="btn btn-success btn-xs">Lulus</b>';
            }
            // $tandai = 
            if($u['status_siswa_bkk'] == 1){
            $tandai = "<a href='".base_url('tandai_bkk/0/'.encode($u['candidate_id']))."'><button class='btn btn-success btn-xs'>Siswa BKK</button></a>";
            }else{
            $tandai = "<a href='".base_url('tandai_bkk/1/'.encode($u['candidate_id']))."'><button class='btn btn-warning btn-xs'>Tandai BKK</button></a>";
            }
            // if ($u['kompetensi']) {
            $button_text_kompetensi = '<br> TES KOMPETENSI : <b>'.round($u['kompetensi'],2).'</b>';
            $button_text_psikologi = '<br> TES PSIKOLOGI : <b>'.round($u['psikologi'],2).'</b>';
            // } else {
            //     $button_text_rating = '<br> RATING : - ';
            // }
            
            if (allowedTo('delete_candidate')) {
                $actions = '
                    <button type="button" class="btn btn-danger btn-xs delete-candidate" data-id="'.$u['candidate_id'].'"><i class="far fa-trash-alt"></i></button>
                ';
            } else {
                $actions = '---';
            }
            $buttonsa = '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-candidate-status" data-status="'.$u['status'].'" data-id="'.$u['candidate_id'].'">'.$button_text.'</button>';
            
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$u['candidate_id']."' />",
                "<img style='width:50px;height:50px' src='".candidateThumb($u['image'])."' onerror='this.src=\"".$default_image."\"'/><br>".$tandai,
                "<a href='".base_url('detail-siswa/'.encode($u['candidate_id']))."'>".$u['first_name']."&nbsp;".$u['last_name']."</a>".$button_text_kompetensi.$button_text_psikologi.$button_text_rating,
                $u['email'],
                '<b>'.$u['sekolah'].'</b><br> Jurusan : '.$u['jurusan'].$button_kelas,
                date('d M, Y', strtotime($u['created_at'])),
                $buttonsa,
                $actions . '<button type="button" class="btn btn-danger btn-xs reset-password" data-id="'.$u['candidate_id'].'"><i class="fas fa-key"></i></button>'
            );
        }
        return $sorted;
    }
    
 
    public function getCompleteResume($id = '', $type = '')
    {
        $this->db->select('resumes.*, candidates.*,resumes.file as file_cv');
        $this->db->from('resumes');
        if ($type) {
        $this->db->where('resumes.resume_id', $id);
        } else {
        $this->db->where('resumes.candidate_id', $id);
        }
        $this->db->where('resumes.status', 1);
        $this->db->join('candidates','candidates.candidate_id = resumes.candidate_id', 'left');

        $result = $this->db->get();
        $result = objToArr($result->result());
        $result = isset($result[0]) ? $result[0] : array();
        if ($result) {
            $resume_id = isset($result['resume_id']) ? $result['resume_id'] : '';
            $result['experiences'] = $this->getResumeEntities('resume_experiences', $resume_id);
            $result['qualifications'] = $this->getResumeEntities('resume_qualifications', $resume_id);
            $result['languages'] = $this->getResumeEntities('resume_languages', $resume_id);
            $result['achievements'] = $this->getResumeEntities('resume_achievements', $resume_id);
            $result['references'] = $this->getResumeEntities('resume_references', $resume_id);
        }
        return $result;
    }

    public function getCompleteResumeJobBoard($id = '')
    {
        $this->db->select('resumes.*, candidates.*');
        $this->db->from('resumes');
        $this->db->where('resumes.resume_id', $id);
        $this->db->where('resumes.status', 1);
        $this->db->join('candidates','candidates.candidate_id = resumes.candidate_id', 'left');

        $result = $this->db->get();
        $result = objToArr($result->result());
        $result = isset($result[0]) ? $result[0] : array();
        if ($result) {
            $resume_id = isset($result['resume_id']) ? $result['resume_id'] : '';
            $result['experiences'] = $this->getResumeEntities('resume_experiences', $resume_id);
            $result['qualifications'] = $this->getResumeEntities('resume_qualifications', $resume_id);
            $result['languages'] = $this->getResumeEntities('resume_languages', $resume_id);
            $result['achievements'] = $this->getResumeEntities('resume_achievements', $resume_id);
            $result['references'] = $this->getResumeEntities('resume_references', $resume_id);
        }
        return $result;
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

    public function getTopCandidates()
    {
        //Setting session for every parameter of the request
        $this->setSessionValues();
        $limit = setting('charts-limit');

        $traits_result = $this->getSessionValues('traits_check');
        $interviews_result = $this->getSessionValues('interviews_check');
        $quizes_result = $this->getSessionValues('quizes_check');
        $job_id = $this->getSessionValues('job_id');

        if ($job_id) {
        $this->db->where('job_applications.job_id', $job_id);
        }
        // $this->db->where('candidates.status', 1);
        $this->db->select('
            CONCAT('.CF_DB_PREFIX.'candidates.first_name, " ", '.CF_DB_PREFIX.'candidates.last_name) as label,
            SUM('.CF_DB_PREFIX.'job_applications.traits_result) as traits_result,
            SUM('.CF_DB_PREFIX.'job_applications.quizes_result) as quizes_result,
            SUM('.CF_DB_PREFIX.'job_applications.interviews_result) as interviews_result
        ');
        $this->db->join('job_applications', 'job_applications.candidate_id = candidates.candidate_id', 'left');
        $this->db->group_by('job_applications.candidate_id');
        $this->db->order_by('job_applications.job_application_id', 'DESC');
        $this->db->limit($limit, 0);
        $result = $this->db->get('candidates');
        $result = $result->result();
        $labels = array();
        $totals = array();
        foreach ($result as $key => $value) {
            $total = 0;
            $labels[] = $value->label;
            if ($traits_result) {
                $total = $total + $value->traits_result;
            }
            if ($interviews_result) {
                $total = $total + $value->interviews_result;
            }
            if ($quizes_result) {
                $total = $total + $value->quizes_result;
            }
            $totals[] = round($total/3);
        }

        $result = array(
            'labels' => $labels,
            'data' => $totals,
        );

        return json_encode($result);
    }

    public function getCandidateResumeIds($candidate_id)
    {
        $this->db->select('GROUP_CONCAT('.CF_DB_PREFIX.'resumes.resume_id) as ids');
        $this->db->where('candidate_id', $candidate_id);
        $result = $this->db->get('resumes');
        $result = objToArr($result->result());
        $result = isset($result[0]['ids']) ? explode(',', $result[0]['ids']) : array();
        return $result;
    }

}
