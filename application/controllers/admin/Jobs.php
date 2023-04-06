<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;

class Jobs extends CI_Controller
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
     * View Function to display jobs list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = 'Daftar Tes Seleksi';
        $data['menu'] = 'jobs';
        $pagedata['companies'] = objToArr($this->AdminCompanyModel->getAll());
        $pagedata['departments'] = objToArr($this->AdminDepartmentModel->getAll());
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/jobs/list', $pagedata);
    }

    public function kategori()
    {
        $data['page'] = 'Kategori Divisi';
        $data['menu'] = 'kategori-pekerjaan';
        $data['kategori'] = $this->AdminJobModel->getDataKategori();
        $data['action'] = site_url('tambah_kategori');
        $data['action_edit'] = site_url('edit_kategori');
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/jobs/kategori', $data);
    }

    public function tambah_kategori()
  {
    $nama = $this->input->post('nama_kategori');
    $status = $this->input->post('status');
       $data  = array(
         'nama_kategori' => $nama,
         'status' => $status,
         'created_date' => date('Y-m-d H:i:s'),
       );
       $this->db->insert('kategori_pekerjaan',$data);
       redirect('admin/kategori-pekerjaan');
  }

    public function edit_kategori()
  {
    $id = $this->input->post('id');
     $cek = $this->db->get_where('kategori_pekerjaan', array('id' => $id ))->num_rows();
     if ($cek == NULL) {
       redirect('admin/kategori-pekerjaan');
     }else{
       $data  = array(
         'nama_kategori' => $nama = $this->input->post('nama_kategori'),
         'status' => $nama = $this->input->post('status'),
         'update_date' => date('Y-m-d H:i:s'),
         'status' => 1
       );
       $this->db->where('id', $id);
       $this->db->update('kategori_pekerjaan', $data);
       redirect('admin/kategori-pekerjaan');
     }
  }

  public function aktif_kategori($id)
  {
    if ($id == NULL) {
    redirect('admin/kategori-pekerjaan');
    }else{
      $cek = $this->db->get_where('kategori_pekerjaan', array('id' => $id));
      if ($cek) {
      $data  = array(
        'status' => 1,
        'update_date' => date('Y-m-d H:i:s'),
      );
      $this->db->where('id', $id);
      $this->db->update('kategori_pekerjaan', $data);

      redirect('admin/kategori-pekerjaan');
    }else{

      redirect('admin/kategori-pekerjaan');
    }
  }
}

  public function nonaktif_kategori($id)
  {
    if ($id == NULL) {
    redirect('admin/kategori-pekerjaan');
    }else{
      $cek = $this->db->get_where('kategori_pekerjaan', array('id' => $id));
      if ($cek) {
      $data  = array(
        'status' => 0,
        'update_date' => date('Y-m-d H:i:s'),
      );
      $this->db->where('id', $id);
      $this->db->update('kategori_pekerjaan', $data);

      redirect('admin/kategori-pekerjaan');
    }else{

      redirect('admin/kategori-pekerjaan');
    }
  }
}

public function hapus($id)
{
  if ($id == NULL) {
  redirect('admin/kategori-pekerjaan');
  }else{
    $cek = $this->db->get_where('kategori_pekerjaan', array('id' => $id));
    if ($cek) {
    $this->db->delete('kategori_pekerjaan', array('id' => $id));
    redirect('admin/kategori-pekerjaan');
  }else{

    redirect('admin/kategori-pekerjaan');
  }
}
}

    /**
     * Function to get data for jobs jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminJobModel->jobsList());
    }

    /**
     * View Function (for ajax) to display create or edit job
     *
     * @param integer $job_id
     * @return html/string
     */
    public function createOrEdit($job_id = NULL)
    {
        $pagedata['job'] = objToArr($this->AdminJobModel->getJob('jobs.job_id', $job_id));
        $pagedata['companies'] = objToArr($this->AdminCompanyModel->getAll());
        $pagedata['kategori'] = objToArr($this->AdminJobModel->getKategori());
        $pagedata['lokasi'] = objToArr($this->db->get('kabupaten')->result());
        $pagedata['level'] = objToArr($this->AdminJobModel->getLevel());
        $pagedata['departments'] = objToArr($this->AdminDepartmentModel->getAll());
        $pagedata['traits'] = objToArr($this->AdminTraitModel->getAll());
        $pagedata['fields'] = objToArr($this->AdminJobModel->getFields($job_id));
        $pagedata['tes_esai'] = $this->db->get_where('interviews')->result_array();
        $pagedata['quizes'] = objToArr($this->AdminQuizModel->getAll());
        $data['page'] = 'Kelola Tes Seleksi';
        $data['menu'] = 'job';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/jobs/create-or-edit', $pagedata);
    }

    /**
     * Function (for ajax) to process job create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[50]|max_length[10000]');
        $this->form_validation->set_rules('labels[]', 'Labels', 'max_length[50]');
        $this->form_validation->set_rules('values[]', 'Values', 'max_length[200]');

        $edit = $this->xssCleanInput('job_id') ? $this->xssCleanInput('job_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $this->AdminJobModel->storeJob($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('job') . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (for ajax) to process job change status request
     *
     * @param integer $job_id
     * @param string $status
     * @return void
     */
    public function changeStatus($job_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminJobModel->changeStatus($job_id, $status);
    }

    /**
     * Function (for ajax) to process job bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminJobModel->bulkAction();
    }

    /**
     * Function (for ajax) to process job delete request
     *
     * @param integer $job_id
     * @return void
     */
    public function delete($job_id)
    {
        $this->checkIfDemo();
        $this->AdminJobModel->remove($job_id);
    }

    /**
     * Post Function to download jobs data in excel
     *
     * @return void
     */
    public function excel()
    {
        $data = $this->AdminJobModel->getJobsForCSV($this->xssCleanInput('ids'));
        $data = sortForCSV(objToArr($data));
        $excel = new SimpleExcel('csv');
        $excel->writer->setData($data);
        $excel->writer->saveFile('jobs');
        exit;
    }


    /**
     * Function (for ajax) to process add custom field request
     *
     * @return void
     */
    public function addCustomField()
    {
        $data['field'] = array('custom_field_id' => '', 'label' => '', 'value' => '');
        echo $this->load->view('admin/jobs/custom-field', $data, TRUE);
    }

    /**
     * Function (for ajax) to process remove custom field request
     *
     * @param integer $custom_field_id
     * @return void
     */
    public function removeCustomField($custom_field_id)
    {
        $this->checkIfDemo();
        $this->AdminJobModel->removeCustomField($custom_field_id);
    }

}
