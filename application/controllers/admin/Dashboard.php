<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    /**
     * Function to load dashboard main page
     *
     * @return json
     */
    public function index()
    {
        
        $data['siswa_aktif'] = $this->db->select('candidates.candidate_id')
                              ->from('candidates')
                             ->where('candidates.account_id ',$this->session->userdata('admin')['account_id'])
                              ->where('candidates.kelas_siswa !=','')
                              ->get()->num_rows();
                              
        $data['siswa_daftar'] = $this->db->get_where('candidates', array('account_id' => $this->session->userdata('admin')['account_id']))->num_rows();
      
        $jurusan = $this->db->select('jurusan.id')
                            ->from('jurusan')
                            ->where('jurusan.id_mitra',$this->session->userdata('admin')['account_id'])
                             ->get()->num_rows();
                              
        $kelas = $this->db->select('kelas.id')
                          ->from('kelas')
                          ->where('kelas.id_mitra',$this->session->userdata('admin')['account_id'])
                          ->get()->num_rows();
        
        $get_tahun = $this->db->select('tahun_angkatan.tahun_angkatan')
                          ->from('tahun_angkatan')
                          ->where('tahun_angkatan.id_mitra',$this->session->userdata('admin')['account_id'])
                          ->get()->result();
                              
       
        $data['jurusan'] = $jurusan;
        $data['kelas'] = $kelas;  
        
        $get_kompetensi = $this->SekolahModel->getTesKompetensiGarph($this->session->userdata('admin')['account_id']);
        $get_psikologi = $this->SekolahModel->getTesPsikologiGarph($this->session->userdata('admin')['account_id']);
        // $result = array_merge($kompetensi,$psikologi);
        $kompetensi = [];
        if($get_kompetensi){
        foreach ($get_kompetensi as $val){
            $kompetensi[] = (float)number_format((float)$val->persentase, 2, '.', '');
        }
        }
        
        $psikologi = [];
        if($get_psikologi){
        foreach ($get_psikologi as $val){
            $psikologi[] = (float)number_format((float)$val->persentase, 2, '.', '');
        }
        }
        
        $tahun_angkatan = [];
        if($get_tahun){
        foreach ($get_tahun as $val){
            $tahun_angkatan[] = 'Tahun '.$val->tahun_angkatan; 
        }
        }        
        // echo json_encode($kompetensi);
        // die;
        $data['garph_kompetensi'] = $kompetensi;
        $data['garph_psikologi'] = $psikologi;
        
        $data['tahun_angkatan'] = $tahun_angkatan;
        
        $data['page'] = lang('dashboard');
        $data['menu'] = 'dashboard';
        $data['jobs'] = $this->AdminJobModel->getAll_dash();
        $data['jobsCount'] = $this->AdminJobModel->getTotalJobs();
        $data['candidates'] = $this->AdminCandidateModel->getTotalCandidates();
        $data['applications'] = $this->AdminJobBoardModel->getJobApplicationsCount();
        $data['hired'] = $this->AdminJobBoardModel->getJobApplicationsCount('hired');
        $data['rejected'] = $this->AdminJobBoardModel->getJobApplicationsCount('rejected');
        $data['interviews'] = $this->AdminInterviewModel->getInterviewsCount();
        $data['dashboard_jobs_page'] = $this->sess('dashboard_jobs_page', 1);
        $data['dashboard_jobs_total_pages'] = $this->sess('dashboard_jobs_total_pages');
        $data['dashboard_todos_page'] = $this->sess('dashboard_todos_page', 1);
        $data['dashboard_todos_total_pages'] = $this->sess('dashboard_todos_total_pages');
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/dashboard/index');
    }

    /**
     * Function (via ajax) to get data for popular job charts
     *
     * @return json
     */
    public function popularJobsChartData()
    {
        echo $this->AdminJobModel->getPopularJobs();
    }

    /**
     * Function (via ajax) to get data for candidates cahrts
     *
     * @return json
     */
    public function topCandidatesChartData()
    {
        echo $this->AdminCandidateModel->getTopCandidates();
    }

    /**
     * Function (via ajax) to get data for job statuses
     *
     * @return json
     */
    public function jobsList()
    {
        $jobsResults = $this->AdminDashboardModel->getJobs();
        $jobs = $jobsResults['records'];
        echo json_encode(array(
            'pagination' => $jobsResults['pagination'],
            'total_pages' => $jobsResults['total_pages'],
            'list' => $this->load->view('admin/dashboard/job-item', compact('jobs'), TRUE),
        ));
    }

}
