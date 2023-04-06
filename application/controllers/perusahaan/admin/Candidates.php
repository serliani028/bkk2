<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;

class Candidates extends CI_Controller
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    /**
     * View Function to display candidates list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('candidates');
        $data['menu'] = 'candidates';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/candidates/list');
    }

    /**
     * Function to get data for candidates jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminCandidateModel->candidatesList());
    }

    /**
     * Function (for ajax) to process candidate change status request
     *
     * @param integer $candidate_id
     * @param string $status
     * @return void
     */
    public function changeStatus($candidate_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminCandidateModel->changeStatus($candidate_id, $status);
    }

    /**
     * Function (for ajax) to process candidate bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminCandidateModel->bulkAction();
    }

    /**
     * Function (for ajax) to process candidate delete request
     *
     * @param integer $candidate_id
     * @return void
     */
    public function delete($candidate_id)
    {
        $this->checkIfDemo();
        $this->AdminCandidateModel->remove($candidate_id);
    }

    /**
     * Function (for ajax) to display candidate resume
     *
     * @param integer $resume_id
     * @return void
     */
    public function resume($resume_id)
    {
        $data['resum'] = $this->AdminCandidateModel->getCompleteResume($resume_id);
        
        $id_prov = $data['resum']['provinsi'];
        $id_kab = $data['resum']['city'];
        $id_kec = $data['resum']['state'];
        $id_kel = $data['resum']['kelurahan'];
        
        // $minat = $data['resum']['peminatan'];
        $data['peminatan'] = $data['resum']['peminatan'];
        
        // $data['prov'] = $this->db->get_where('provinsi', array('id_prov' => $id_prov))->row();
        // $data['kab'] = $this->db->get_where('kabupaten', array('id_kab' => $id_kab))->row();
        // $data['kec'] = $this->db->get_where('kecamatan', array('id_kec' => $id_kec))->row();
        // $data['kel'] = $this->db->get_where('kelurahan', array('id_kel' => $id_kel))->row();
        
        $data['prov'] = $id_prov;
        $data['kab'] = $id_kab;
        $data['kec'] = $id_kec;
        $data['kel'] = $id_kel;
        
        echo $this->load->view('admin/candidates/resume', $data, TRUE);
    }

    /**
     * Post Function to download candidate resume
     *
     * @return void
     */
    public function resumeDownload()
    {
        ini_set('max_execution_time', '0');
        $this->checkAdminLogin();
        $ids = explode(',', $this->xssCleanInput('ids'));
        $resumes = '';
        foreach ($ids as $id) {
            $data['resume'] = $this->AdminCandidateModel->getCompleteResumeJobBoard($id);
            if ($data['resume']['type'] == 'detailed') {
                $resumes .= $this->load->view('admin/candidates/resume-pdf', $data, TRUE);
            } else {
                $resumes .= "<hr />";
                $resumes .= 'Resume of "'.$data['resume']['first_name'].' '.$data['resume']['last_name'].' ('.$data['resume']['designation'].')" is static and can be downloaded separately';
                $resumes .= "<br /><hr />";
            }

        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($resumes);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Resumes.pdf');
        exit;
    }

    /**
     * Post Function to download candidates data in excel
     *
     * @return void
     */
    public function candidatesExcel()
    {
        $data = $this->AdminCandidateModel->getCandidatesForCSV($this->xssCleanInput('ids'));
        $data = sortForCSV(objToArr($data));
        $excel = new SimpleExcel('csv');
        $excel->writer->setData($data);
        $excel->writer->saveFile('candidates');
        exit;
    }
}
