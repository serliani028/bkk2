<?php

class Dashboard extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
         if (PhSession()) {
        return TRUE;
         }else{
              redirect('login-perusahaan');
         }
    }

    /**
     * Function to load dashboard main page
     *
     * @return json
     */
    public function index()
    {
        
        
        $data['total_ph'] = $this->AdminCandidateModel->getAllPendaftarPH($this->session->userdata('company')['company_id']);
        
        $data['cv_diterima'] = $this->AdminCandidateModel->getDiterima2($this->session->userdata('company')['company_id']);
        $data['cv_screening'] = $this->AdminCandidateModel->getScreening2($this->session->userdata('company')['company_id']);
        
        $data['diinterview'] = $this->AdminCandidateModel->getDiinterview2($this->session->userdata('company')['company_id']);
        $data['inter2'] = $this->AdminCandidateModel->getInter2($this->session->userdata('company')['company_id']);
        
        $data['form'] = $this->AdminCandidateModel->getForm2($this->session->userdata('company')['company_id']);
        $data['bekerja'] = $this->AdminCandidateModel->getBekerja2($this->session->userdata('company')['company_id']);
        $data['ditolak'] = $this->AdminCandidateModel->getDitolak2($this->session->userdata('company')['company_id']);
        
        if($data['total_ph'] != 0){
        $data['ig'] = ($data['bekerja']['ig'] / $data['total_ph'])*100 ;
                      
        $data['fb'] = ($data['bekerja']['fb'] / $data['total_ph'])*100 ;
                      
        $data['tiktok'] = ($data['bekerja']['tiktok'] / $data['total_ph'])*100 ;
                      
        $data['med'] = ($data['bekerja']['med'] / $data['total_ph'])*100 ;
                      
        $data['linke'] = ($data['bekerja']['linke'] / $data['total_ph'])*100 ;
                      
        $data['teman'] = ($data['bekerja']['teman'] / $data['total_ph'])*100 ;
                      
        $data['tele'] = ($data['bekerja']['tele'] / $data['total_ph'])*100 ;
                      
        $data['total'] = $data['linke'] + $data['ig'] + $data['fb'] + $data['tiktok'] +
                        $data['tele'] + $data['teman'] + $data['med'] ;
        }else{
        $data['ig'] = 0;
        $data['fb'] = 0;
        $data['tiktok'] = 0;
        $data['med'] = 0;
        $data['linke'] = 0;
        $data['teman'] = 0;
        $data['tele'] = 0;
        $data['total'] = 0;
        }
                      
        $data['menu'] = 'dashboard';
        $data['page'] = 'Dashboard Perusahaan | ' . setting('site-name');
        
        $data['dashboard_jobs_page'] = $this->sess('dashboard_jobs_page', 1);
        $data['dashboard_jobs_total_pages'] = $this->sess('dashboard_jobs_total_pages');
        $this->load->view('perusahaan/admin/layout/header', $data);
        $this->load->view('perusahaan/admin/dashboard/index');
    
        
    }

    /**
     * Function (via ajax) to get data for popular job charts
     *
     * @return json
     */
    public function popularJobsChartData()
    {
        echo $this->AdminJobModel->getPopularJobs2($this->session->userdata('company')['company_id']);
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
        $jobsResults = $this->AdminDashboardModel->getJobs2($this->session->userdata('company')['company_id']);
        $jobs = $jobsResults['records'];
        echo json_encode(array(
            'pagination' => $jobsResults['pagination'],
            'total_pages' => $jobsResults['total_pages'],
            'list' => $this->load->view('perusahaan/admin/dashboard/job-item', compact('jobs'), TRUE),
        ));
    }

}
