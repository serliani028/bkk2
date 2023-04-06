<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Sertfikat extends CI_Controller
{
    public function index($page = null)
    {
        $this->checkLogin();
        $total = $this->JobModel->getTotalFavoriteJobs();
        $limit = 5;
        $data['pagination'] = $this->createPagination($page, '/account/job-favorites/', $total, $limit);
        $pageData['page'] = lang('job_favorites').' | ' . setting('site-name');
        $data['jobs'] = $this->JobModel->getFavoriteJobsList($page, $limit);
        $data['page'] = 'favorites';
        $this->load->view('front/layout/header', $pageData);
        $this->load->view('front/account-job-favorites', $data);
    }
}
