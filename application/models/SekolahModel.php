<?php

class SekolahModel extends CI_Model
{
    protected $table = 'tahun_angkatan';
    protected $key = 'id_mitra';

    public function getTahunAngkatan($id_mitra)
    {
        $this->db->select('tahun_angkatan.id as id_tahun,tahun_angkatan.tahun_angkatan as tahun,COUNT(candidates.candidate_id) as jum,candidates.kelas_siswa');
         $this->db->from('tahun_angkatan');
         $this->db->where('tahun_angkatan.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_tahun_angkatan = tahun_angkatan.id');
         $this->db->group_by('tahun_angkatan.tahun_angkatan');
         $this->db->group_by('candidates.kelas_siswa');
         $this->db->order_by('tahun_angkatan.tahun_angkatan', 'DESC');
         $result = ['data' => $this->db->get()->result(), 'status' => 1];
         return $result;
    }
    
     public function getJurusan($id_mitra)
    {
        $this->db->select('jurusan.nama as jurusan,jurusan.id as id_jurusan,candidates.kelas_siswa,COUNT(candidates.candidate_id) as jum');
         $this->db->from('jurusan');
         $this->db->where('jurusan.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_jurusan = jurusan.id');
         $this->db->group_by('jurusan.id');
         $this->db->group_by('candidates.kelas_siswa');
         $result = ['data' => $this->db->get()->result(), 'status' => 1];
         return $result;
    }
    
     public function getKelas($id_mitra)
    {
        $this->db->select('kelas.nama as nama_kelas,kelas.id as id_kelas,kelas.id_jurusan as id_jurusan, kelas.kelas as kelas,
        jurusan.nama as jurusan , COUNT(DISTINCT(candidates.candidate_id)) as jumlah,
         ');
         $this->db->from('kelas');
         $this->db->where('kelas.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_kelas = kelas.id', 'left');
         $this->db->join('jurusan', 'jurusan.id = kelas.id_jurusan', 'left');
         $this->db->group_by('kelas.id');
         $this->db->order_by('kelas.kelas');
         $result = $this->db->get()->result();
         return $result;
    }
    
     public function getSiswa($id_mitra)
    {
        $this->db->select('tahun_angkatan.tahun_angkatan as tahun,tahun_angkatan.id as id_tahun ,
         COUNT(DISTINCT(candidates.candidate_id)) as jumlah,
         ');
         $this->db->from('tahun_angkatan');
         $this->db->where('tahun_angkatan.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_tahun_angkatan = tahun_angkatan.id AND candidates.kelas_siswa != "" ', 'left');
        //  $this->db->where('candidates.id_mitra',$id_mitra);
         $this->db->group_by('tahun_angkatan.tahun_angkatan');
         $this->db->order_by('tahun_angkatan.tahun_angkatan', 'DESC');
         $result = $this->db->get()->result();
         return $result;
    }
    
    
    public function getTesKompetensi($id_mitra)
    {
        $this->db->select('tahun_angkatan.tahun_angkatan as tahun,tahun_angkatan.id as id_tahun ,
         AVG(job_applications.quizes_result) as persentase,
         COUNT(DISTINCT(candidate_quizes.candidate_id)) as jumlah,
         ');
         $this->db->from('tahun_angkatan');
         $this->db->where('tahun_angkatan.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_tahun_angkatan = tahun_angkatan.id', 'left');
         $this->db->join('candidate_quizes', 'candidate_quizes.candidate_id = candidates.candidate_id', 'left');
         $this->db->join('job_applications', 'job_applications.candidate_id = candidate_quizes.candidate_id', 'left');
         $this->db->group_by('tahun_angkatan.tahun_angkatan');
         $this->db->order_by('tahun_angkatan.tahun_angkatan', 'DESC');
         $result = $this->db->get()->result();
         return $result;
    }
    
    public function getTesPsikologi($id_mitra)
    {
        $this->db->select('tahun_angkatan.tahun_angkatan as tahun,tahun_angkatan.id as id_tahun ,
         AVG(job_applications.status_tes) as persentase,
         COUNT(DISTINCT(job_applications.candidate_id)) as jumlah,
         ');
         $this->db->from('tahun_angkatan');
         $this->db->where('tahun_angkatan.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_tahun_angkatan = tahun_angkatan.id', 'left');
         $this->db->join('job_applications', 'job_applications.candidate_id = candidates.candidate_id', 'left');
         $this->db->group_by('tahun_angkatan.tahun_angkatan');
         $this->db->order_by('tahun_angkatan.tahun_angkatan', 'DESC');
         $result = $this->db->get()->result();
         return $result;
    }
    
    public function getTesKompetensiGarph($id_mitra)
    {
        $this->db->select('AVG(job_applications.quizes_result) as persentase');
         $this->db->from('tahun_angkatan');
         $this->db->where('tahun_angkatan.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_tahun_angkatan = tahun_angkatan.id', 'left');
         $this->db->join('job_applications', 'job_applications.candidate_id = candidates.candidate_id', 'left');
         $this->db->group_by('tahun_angkatan.tahun_angkatan');
         $this->db->order_by('tahun_angkatan.tahun_angkatan', 'DESC');
         $result = $this->db->get()->result();
         return $result;
    }
    
    public function getTesPsikologiGarph($id_mitra)
    {
        $this->db->select('AVG(job_applications.status_tes) as persentase');
         $this->db->from('tahun_angkatan');
         $this->db->where('tahun_angkatan.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_tahun_angkatan = tahun_angkatan.id', 'left');
         $this->db->join('job_applications', 'job_applications.candidate_id = candidates.candidate_id', 'left');
         $this->db->group_by('tahun_angkatan.tahun_angkatan');
         $this->db->order_by('tahun_angkatan.tahun_angkatan', 'DESC');
         $result = $this->db->get()->result();
         return $result;
    }
    
    
    public function getTesAkhir($id_mitra)
    {
        $this->db->select('tahun_angkatan.tahun_angkatan as tahun,tahun_angkatan.id as id_tahun ,
         COUNT(magang.candidate_id) as jumlah_magang,
         COUNT(wirausaha.candidate_id) as jumlah_wirausaha,
         ');
         $this->db->from('tahun_angkatan');
         $this->db->where('tahun_angkatan.id_mitra',$id_mitra);
         $this->db->join('candidates', 'candidates.id_tahun_angkatan = tahun_angkatan.id', 'left');
         $this->db->join('magang', 'magang.candidate_id = candidates.candidate_id', 'left');
         $this->db->join('wirausaha', 'wirausaha.candidate_id = candidates.candidate_id', 'left');
         $this->db->group_by('tahun_angkatan.tahun_angkatan');
         $this->db->order_by('tahun_angkatan.tahun_angkatan', 'DESC');
         $result = $this->db->get()->result();
         return $result;
    }
    

     public function candidatesList()
    {
        $request = $this->input->get();
        // echo json_encode($request['tahun_angkatan']);
        // die;
        $columns = array(
            "",
            "",
            "candidates.first_name",
            "kelas.kelas, kelas.nama_kelas",
            "jurusan.nama",
            "candidates.email",
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
            jurusan.nama as jurusan,
            kelas.nama as nama_kelas,
            kelas.kelas as kelas,
        ');
        
        $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan']);
        $this->db->where('candidates.kelas_siswa !=','');
        
        if ($srh) {
            $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        
        if (isset($request['status_siswa']) && $request['status_siswa'] != '') {
           if($request['status_siswa'] == 'X'){
            $this->db->where('candidates.kelas_siswa', 'X');    
           }else if($request['status_siswa'] == 'XI'){
            $this->db->where('candidates.kelas_siswa', 'XI');  
           }else if($request['status_siswa'] == 'XII'){
            $this->db->where('candidates.kelas_siswa', 'XII');  
           }
        }
        
        
        if (isset($request['jurusan']) && $request['jurusan'] != '') {
            $this->db->where('candidates.id_jurusan',$request['jurusan']);  
         }
      
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('kelas','kelas.id = candidates.id_kelas', 'left');
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
        
        // $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan']);
        
        if ($srh) {
            $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        if (isset($request['status_siswa']) && $request['status_siswa'] != '') {
           if($request['status_siswa'] == 'X'){
            $this->db->where('candidates.kelas_siswa', 'X');    
           }else if($request['status_siswa'] == 'XI'){
            $this->db->where('candidates.kelas_siswa', 'XI');  
           }else if($request['status_siswa'] == 'XII'){
            $this->db->where('candidates.kelas_siswa', 'XII');  
           }
        }
        if (isset($request['jurusan']) && $request['jurusan'] != '') {
            $this->db->where('candidates.id_jurusan',$request['jurusan']);  
         }
         
        if (isset($request['tahun_angkatan'])) {
        $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan']);
        }
        $this->db->where('candidates.kelas_siswa !=','');
        
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('kelas','kelas.id = candidates.id_kelas', 'left');
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
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$u['candidate_id']."' />",
                "<img style='width:50px;height:50px' src='".candidateThumb($u['image'])."' onerror='this.src=\"".$default_image."\"'/>",
                "<a href='".base_url('detail-siswa/'.encode($u['candidate_id']))."'>".$u['first_name']."&nbsp;".$u['last_name']."</a>",
                // $u['first_name'],
                "Kelas - ".$u['kelas']." ".$u['nama_kelas'],
                $u['jurusan'],
                $u['email'],
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-candidate-status" data-status="'.$u['status'].'" data-id="'.$u['candidate_id'].'">'.$button_text.'</button>',
                // $actions . '<button type="button" class="btn btn-danger btn-xs reset-password" data-id="'.$u['candidate_id'].'"><i class="fas fa-key"></i></button>'
            );
        }
        return $sorted;
    }
    
    
    public function candidatesListBKK($id_sekolah)
    {
        $request = $this->input->get();
        // echo json_encode($request['tahun_angkatan']);
        // die;
        $columns = array(
            "",
            "",
            "candidates.first_name",
            "kelas.kelas, kelas.nama_kelas",
            "jurusan.nama",
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
            tahun_angkatan.*,
            AVG(job_applications.rating) as rating,
            AVG(job_applications.quizes_result) as kompetensi,
            AVG(job_applications.status_tes) as psikologi,
            jurusan.nama as jurusan,
            kelas.nama as nama_kelas,
            kelas.kelas as kelas,
            candidates.status_siswa_bkk as status_bkk,
        ');
        
        $this->db->where('candidates.account_id',$request['id_sekolah']);
        $this->db->where('candidates.status_siswa_bkk',1);
        
        if ($srh) {
            $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        
        if (isset($request['jurusan']) && $request['jurusan'] != '') {
            $this->db->where('candidates.id_jurusan',$request['jurusan']);  
        }
      
        if (isset($request['tahun']) && $request['tahun'] != '') {
            $this->db->where('candidates.id_tahun_angkatan',$request['tahun']);  
        }
        
        $this->db->join('tahun_angkatan','tahun_angkatan.id = candidates.id_tahun_angkatan', 'left');
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('kelas','kelas.id = candidates.id_kelas', 'left');
        $this->db->join('job_applications','job_applications.candidate_id = candidates.candidate_id', 'left');
        $this->db->group_by('candidates.candidate_id');
        $this->db->order_by($orderColumn, $orderDirection);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        // $id_sekolah = 18;
        $result = array(
            'data' => $this->prepareDataForTableBKK($query->result()),
            'recordsTotal' => $this->getTotalBKK($srh, $request,$id_sekolah),
            'recordsFiltered' => $this->getTotalBKK($srh, $request,$id_sekolah),
        );

        return $result;
    }
    
    
    public function getTotalBKK($srh = false, $request = '',$id_sekolah)
    {
        $this->db->from('candidates');
        
        // $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan']);
        if ($srh) {
            $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        
        if (isset($request['tahun']) && $request['tahun'] != '') {
            $this->db->where('candidates.id_tahun_angkatan',$request['tahun']);  
        }
        
        if (isset($request['jurusan']) && $request['jurusan'] != '') {
            $this->db->where('candidates.id_jurusan',$request['jurusan']);  
         }
        
        if (isset($request['id_sekolah'])) {
        $this->db->where('candidates.account_id',$request['id_sekolah']);
        }
        
        
        $this->db->where('candidates.status_siswa_bkk',1);
        
        
        $this->db->join('tahun_angkatan','tahun_angkatan.id = candidates.id_tahun_angkatan', 'left');
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('kelas','kelas.id = candidates.id_kelas', 'left');
        $this->db->join('job_applications','job_applications.candidate_id = candidates.candidate_id', 'left');
        $this->db->group_by('candidates.candidate_id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    private function prepareDataForTableBKK($candidates)
    {
        $sorted = array();
        foreach ($candidates as $u) {
            $u = objToArr($u);
            // if ($u['status_siswa_bkk'] == 1) {
            //     $button_text = 'Magang';
            //     $button_class = 'primary';
            //     // $button_title = lang('click_to_deactivate');
            // } elseif ($u['status_siswa_bkk'] == 2) {
            //     $button_text = 'Bekerja';
            //     $button_class = 'success';
            //     // $button_title = lang('click_to_activate');
            // }else{
            //      $button_text = 'Belum Ada Status';
            //     $button_class = 'warning';
            // } 
            
            if ($u['rating']) {
                $button_text_rating = '<br> RATING : '.round($u['rating'],2).'<i class ="fas fa-star" style="color:orange" ></i>';
            } else {
                $button_text_rating = '<br> RATING : - ';
            }
            
            if ($u['kelas']) {
                $button_kelas = "Kelas - ".$u['kelas']." ".$u['nama_kelas'];
            } else {
                $button_kelas = '<br> <b class="btn btn-success btn-xs">Lulus</b>';
            }
            
            // if ($u['kompetensi']) {
            $button_text_kompetensi = '<br> TES KOMPETENSI : <b>'.round($u['kompetensi'],2).'</b>';
            $button_text_psikologi = '<br> TES PSIKOLOGI : <b>'.round($u['psikologi'],2).'</b>';
            
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                // "<input type='checkbox' class='minimal single-check' data-id='".$u['candidate_id']."' />",
                "<img style='width:50px;height:50px' src='".candidateThumb($u['image'])."' onerror='this.src=\"".$default_image."\"'/>",
                "<a  href='".base_url('detail-siswa/'.encode($u['candidate_id']))."'>".$u['first_name']."&nbsp;".$u['last_name']."</a>".$button_text_kompetensi.$button_text_psikologi.$button_text_rating,
                // $u['first_name'],
                $button_kelas,
                $u['jurusan'],
                'Tahun Ajaran <b>'.$u['tahun_angkatan'].'</b>',
                // $u['email'],
                // '<button type="button" class="btn btn-'.$button_class.' btn-xs " >'.$button_text.'</button>',
                // '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-candidate-status" data-status="'.$u['status'].'" data-id="'.$u['candidate_id'].'">'.$button_text.'</button>',
                // $actions . '<button type="button" class="btn btn-danger btn-xs reset-password" data-id="'.$u['candidate_id'].'"><i class="fas fa-key"></i></button>'
            );
        }
        return $sorted;
    }
    
    
    public function candidatesListTes()
    {
        $request = $this->input->get();
        // echo json_encode($request['tahun_angkatan']);
        // die;
        $columns = array(
            "",
            "",
            "candidates.first_name",
            "kelas.kelas, kelas.nama_kelas",
            "jurusan.nama",
            "job_applications.quizes_result",
            "candidates.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('job_applications');
        $this->db->select('
            candidates.*,
            jurusan.nama as jurusan,
            kelas.nama as nama_kelas,
            kelas.kelas as kelas,
            AVG(job_applications.quizes_result) as hasil,
        ');
        
        $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan_tes']);
        
        if ($srh) {
            $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        
        if (isset($request['kelas_siswa_tes']) && $request['kelas_siswa_tes'] != '') {
           if($request['kelas_siswa_tes'] == 'X'){
            $this->db->where('candidates.kelas_siswa', 'X');    
           }else if($request['kelas_siswa_tes'] == 'XI'){
            $this->db->where('candidates.kelas_siswa', 'XI');  
           }else if($request['kelas_siswa_tes'] == 'XII'){
            $this->db->where('candidates.kelas_siswa', 'XII');  
           }
        }
        
        if (isset($request['status_tes']) && $request['status_tes'] != '') {
           if($request['status_tes'] == 1){
            $this->db->having('AVG(job_applications.quizes_result) >', 70);    
           }else if($request['status_tes'] == 2){
            $this->db->having('AVG(job_applications.quizes_result) <= ', 70); 
            $this->db->having('AVG(job_applications.quizes_result) >', 40); 
           }else if($request['status_tes'] == 3){
            $this->db->having('AVG(job_applications.quizes_result) <=', 40); 
           }
        }
        
        
        if (isset($request['jurusan_tes']) && $request['jurusan_tes'] != '') {
            $this->db->where('candidates.id_jurusan',$request['jurusan_tes']);  
         }
      
        $this->db->join('candidates','candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('kelas','kelas.id = candidates.id_kelas', 'left');
        $this->db->group_by('job_applications.candidate_id');
        $this->db->order_by($orderColumn, $orderDirection);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        $result = array(
            'data' => $this->prepareDataForTableTes($query->result()),
            'recordsTotal' => $this->getTotalTes(),
            'recordsFiltered' => $this->getTotalTes($srh, $request),
        );

        return $result;
    }
    
    
    public function getTotalTes($srh = false, $request = '')
    {
        $this->db->from('job_applications');
        
        // $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan']);
        
        if ($srh) {
            $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        if (isset($request['kelas_siswa_tes']) && $request['kelas_siswa_tes'] != '') {
           if($request['kelas_siswa_tes'] == 'X'){
            $this->db->where('candidates.kelas_siswa', 'X');    
           }else if($request['kelas_siswa_tes'] == 'XI'){
            $this->db->where('candidates.kelas_siswa', 'XI');  
           }else if($request['kelas_siswa_tes'] == 'XII'){
            $this->db->where('candidates.kelas_siswa', 'XII');  
           }
        }
        
        if (isset($request['status_tes']) && $request['status_tes'] != '') {
           if($request['status_tes'] == 1){
            $this->db->having('AVG(job_applications.quizes_result) >', 70);    
           }else if($request['status_tes'] == 2){
            $this->db->having('AVG(job_applications.quizes_result) <= ', 70); 
            $this->db->having('AVG(job_applications.quizes_result) >', 40); 
           }else if($request['status_tes'] == 3){
            $this->db->having('AVG(job_applications.quizes_result) <=', 40); 
           }
        }
        
        
        if (isset($request['jurusan_tes']) && $request['jurusan_tes'] != '') {
            $this->db->where('candidates.id_jurusan',$request['jurusan_tes']);  
         }
      
        if (isset($request['tahun_angkatan_tes'])) {
        $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan_tes']);
        }
        
        $this->db->join('candidates','candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('kelas','kelas.id = candidates.id_kelas', 'left');
        $this->db->group_by('job_applications.candidate_id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    private function prepareDataForTableTes($candidates)
    {
        $sorted = array();
        foreach ($candidates as $u) {
            $u = objToArr($u);
            if ($u['hasil'] > 70) {
                $button_text = 'Tinggi / Kompeten';
                $button_class = 'success';
                $button_title = '';
            } else if ($u['hasil'] > 40 && $u['hasil'] <= 70){
                $button_text = 'Menengah';
                $button_class = 'warning';
                $button_title = '';
            } else{
                $button_text = 'Rendah';
                $button_class = 'danger';
                $button_title = '';    
            }
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$u['candidate_id']."' />",
                // "<img style='width:50px;height:50px' src='".candidateThumb($u['image'])."' onerror='this.src=\"".$default_image."\"'/>",
                "<a href='".base_url('detail-siswa/'.encode($u['candidate_id']))."'>".$u['first_name']."&nbsp;".$u['last_name']."</a>",
                // $u['first_name'],
                $u['jurusan'],
                "Kelas - ".$u['kelas']." ".$u['nama_kelas'],
                number_format($u['hasil'],2,',','.'),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs">'.$button_text.'</button>',
                // $actions . '<button type="button" class="btn btn-danger btn-xs reset-password" data-id="'.$u['candidate_id'].'"><i class="fas fa-key"></i></button>'
            );
        }
        return $sorted;
    }
    
    
     public function candidatesListPsikologi()
    {
        $request = $this->input->get();
        // echo json_encode($request['tahun_angkatan']);
        // die;
        $columns = array(
            "",
            "",
            "candidates.first_name",
            "kelas.kelas, kelas.nama_kelas",
            "jurusan.nama",
            "job_applications.status_tes",
            "candidates.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('job_applications');
        $this->db->select('
            candidates.*,
            jurusan.nama as jurusan,
            kelas.nama as nama_kelas,
            kelas.kelas as kelas,
            AVG(job_applications.status_tes) as hasil,
        ');
        
        $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan_psikologi']);
        
        if ($srh) {
            $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        
        if (isset($request['kelas_siswa_psikologi']) && $request['kelas_siswa_psikologi'] != '') {
           if($request['kelas_siswa_psikologi'] == 'X'){
            $this->db->where('candidates.kelas_siswa', 'X');    
           }else if($request['kelas_siswa_psikologi'] == 'XI'){
            $this->db->where('candidates.kelas_siswa', 'XI');  
           }else if($request['kelas_siswa_psikologi'] == 'XII'){
            $this->db->where('candidates.kelas_siswa', 'XII');  
           }
        }
        
        if (isset($request['status_psikologi']) && $request['status_psikologi'] != '') {
           if($request['status_psikologi'] == 5){
            $this->db->having('AVG(job_applications.status_tes) >', 4);    
           }else if($request['status_psikologi'] == 4){
            $this->db->having('AVG(job_applications.status_tes) <= ', 4); 
            $this->db->having('AVG(job_applications.status_tes) >', 3); 
           }else if($request['status_psikologi'] == 3){
            $this->db->having('AVG(job_applications.status_tes) <=', 3); 
            $this->db->having('AVG(job_applications.status_tes) >', 2); 
           }else if($request['status_psikologi'] == 2){
            $this->db->having('AVG(job_applications.status_tes) <=', 2); 
            $this->db->having('AVG(job_applications.status_tes) >', 1); 
           }else if($request['status_psikologi'] == 1){
            $this->db->having('AVG(job_applications.status_tes) <=', 1); 
            $this->db->having('AVG(job_applications.status_tes) >=', 0); 
           }
        }
        
        
        if (isset($request['jurusan_psikologi']) && $request['jurusan_psikologi'] != '') {
            $this->db->where('candidates.id_jurusan',$request['jurusan_psikologi']);  
         }
      
        $this->db->join('candidates','candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('kelas','kelas.id = candidates.id_kelas', 'left');
        $this->db->group_by('candidates.candidate_id');
        $this->db->order_by($orderColumn, $orderDirection);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        $result = array(
            'data' => $this->prepareDataForTablePsikologi($query->result()),
            'recordsTotal' => $this->getTotalPsikologi(),
            'recordsFiltered' => $this->getTotalPsikologi($srh, $request),
        );

        return $result;
    }
    
    
    public function getTotalPsikologi($srh = false, $request = '')
    {
        $this->db->from('job_applications');
        
        // $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan']);
        
        if ($srh) {
            $this->db->group_start()->like('first_name', $srh)->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        if (isset($request['kelas_siswa_psikologi']) && $request['kelas_siswa_psikologi'] != '') {
           if($request['kelas_siswa_psikologi'] == 'X'){
            $this->db->where('candidates.kelas_siswa', 'X');    
           }else if($request['kelas_siswa_psikologi'] == 'XI'){
            $this->db->where('candidates.kelas_siswa', 'XI');  
           }else if($request['kelas_siswa_psikologi'] == 'XII'){
            $this->db->where('candidates.kelas_siswa', 'XII');  
           }
        }
        
       if (isset($request['status_psikologi']) && $request['status_psikologi'] != '') {
           if($request['status_psikologi'] == 5){
            $this->db->having('AVG(job_applications.status_tes) >', 4);    
           }else if($request['status_psikologi'] == 4){
            $this->db->having('AVG(job_applications.status_tes) <= ', 4); 
            $this->db->having('AVG(job_applications.status_tes) >', 3); 
           }else if($request['status_psikologi'] == 3){
            $this->db->having('AVG(job_applications.status_tes) <=', 3); 
            $this->db->having('AVG(job_applications.status_tes) >', 2); 
           }else if($request['status_psikologi'] == 2){
            $this->db->having('AVG(job_applications.status_tes) <=', 2); 
            $this->db->having('AVG(job_applications.status_tes) >', 1); 
           }else if($request['status_psikologi'] == 1){
            $this->db->having('AVG(job_applications.status_tes) <=', 1); 
            $this->db->having('AVG(job_applications.status_tes) >=', 0); 
           }
        }
        
        
        if (isset($request['jurusan_psikologi']) && $request['jurusan_psikologi'] != '') {
            $this->db->where('candidates.id_jurusan',$request['jurusan_psikologi']);  
         }
      
        if (isset($request['tahun_angkatan_psikologi'])) {
        $this->db->where('candidates.id_tahun_angkatan',$request['tahun_angkatan_psikologi']);
        }
        
        $this->db->join('candidates','candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join('jurusan','jurusan.id = candidates.id_jurusan', 'left');
        $this->db->join('kelas','kelas.id = candidates.id_kelas', 'left');
        $this->db->group_by('candidates.candidate_id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    private function prepareDataForTablePsikologi($candidates)
    {
        $sorted = array();
        foreach ($candidates as $u) {
            $u = objToArr($u);
            if ($u['hasil'] > 4) {
                $button_text = 'Tinggi / Kompeten';
                $button_class = 'success';
                $button_title = '';
            } else if ($u['hasil'] > 3 && $u['hasil'] <= 4){
                $button_text = 'Baik';
                $button_class = 'info';
                $button_title = '';
            } else if ($u['hasil'] > 2 && $u['hasil'] <= 3){
                $button_text = 'Cukup';
                $button_class = 'primary';
                $button_title = '';    
            } else if ($u['hasil'] > 1 && $u['hasil'] <= 2){
                $button_text = 'Kurang';
                $button_class = 'warning';
                $button_title = '';    
            } else if ($u['hasil'] >= 0 && $u['hasil'] <= 1){
                $button_text = 'Rendah';
                $button_class = 'danger';
                $button_title = '';    
            }
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$u['candidate_id']."' />",
                // "<img style='width:50px;height:50px' src='".candidateThumb($u['image'])."' onerror='this.src=\"".$default_image."\"'/>",
                "<a href='".base_url('detail-siswa/'.encode($u['candidate_id']))."'>".$u['first_name']."&nbsp;".$u['last_name']."</a>",
                // $u['first_name'],
                $u['jurusan'],
                "Kelas - ".$u['kelas']." ".$u['nama_kelas'],
                'Rating : '.'&nbsp;'.'<i class="fas fa-star" style="color:orange"></i> '. '&nbsp;'.number_format($u['hasil'],2,',','.'),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs">'.$button_text.'</button>',
                // $actions . '<button type="button" class="btn btn-danger btn-xs reset-password" data-id="'.$u['candidate_id'].'"><i class="fas fa-key"></i></button>'
            );
        }
        return $sorted;
    }

}