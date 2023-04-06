<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;

class Prakerja extends CI_Controller
{
    /**
     * Constructor
     *
     * @return void
     */
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
     * View Function to display candidates list view page
     *
     * @return html/string
     */
   
    
    public function tandai(){
    
    $id = $this->input->get('id');
    $cek = $this->db->get_where('job_applications', array('candidate_id' => $id))->row();
    if(!empty($cek)){
    $data  = array(
    'status' => 'shortlisted'
    );    
    
    $this->db->where('candidate_id', $id);
    $this->db->update('job_applications', $data);
   
    echo json_encode(array(
        'success' => 'true'
      ));
    
    }
    }
    
    public function view_pdf($id)
    {
        $cek_pdf = $this->db->get_where('resumes', array('candidate_id'=>decode($id)))->row();
        if(!empty($cek_pdf)){
        
        $data['page'] = 'View PDF';
        $data['menu'] = 'View PDF';
        
        $data['link'] = site_url('perusahaan/tandai');
        
        $data['pdf'] = $cek_pdf->file;
        $data['id'] = $cek_pdf->candidate_id;
        
        $cek_status = $this->db->get_where('job_applications', array('candidate_id'=>$cek_pdf->candidate_id))->row();
        
        $data['status'] = $cek_status->status;

        $this->load->view('perusahaan/admin/layout/header', $data);
        $this->load->view('perusahaan/admin/candidates/view_pdf',$data);
        }else{
            redirect('perusahaan/admin/pendaftar-kandidat');
        }
    }

    public function sertifikat()
    {
        $data['page'] = 'Data Pendaftar Kandidat';
        $data['menu'] = 'pendaftar-kandidat';
        $data['action'] = site_url('perusahaan/kirim-link');
        $data['action2'] = site_url('perusahaan/interview_2');
        
        $data['link'] = $this->db->get_where('form_ph',array('company_id'=>$this->session->userdata('company')['company_id']))->result();
        $data['link_zoom'] = $this->db->get_where('link_ph',array('company_id'=>$this->session->userdata('company')['company_id']))->result();
        
        // $data['link'] = $this->db->get('form')->result();
        // $data['link_zoom'] = $this->db->get('link')->result();
        
        $data['prakerja'] = $this->AdminCandidateModel->getDataSertifikat2($this->session->userdata('company')['company_id']);

        $this->load->view('perusahaan/admin/layout/header', $data);
        $this->load->view('perusahaan/admin/prakerja/sertifikat');
    }
    
    //FUNGSI LINK GOOGLE FORM
    
     public function kirim_link()
    {
     $id = $this->input->post('id');
     $admin = $this->input->post('admin');
    //  $nama = $this->input->post('nama');
     $link = $this->input->post('link');
    //  $tanggal = $this->input->post('tanggal');
     $batas = $this->input->post('batas');
     
      $cek = $this->db->get_where('job_applications', array('job_application_id' => $id))->row();
        if ($cek != NULL) {
        $token = uniqid('user_', true);
        $data  = array(
        'link_form' => $link
         );
         
        $this->db->where('job_application_id', $id);
        $this->db->update('job_applications', $data); 
        
        $data_p = $this->db->get_where('candidates', array('candidate_id' => $cek->candidate_id))->row();
        $email = $data_p->email;
        
        $cek_token = $this->AdminCandidateModel->getDataPendaftar($id);
        $datas['candidate'] = $cek_token;
        $datas['batas'] = $batas;
        $message = $this->load->view('perusahaan/admin/emails/form',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Tes Google Form'
        );
    
        redirect('perusahaan/admin/pendaftar-kandidat');
      }else{
        redirect('perusahaan/admin/pendaftar-kandidat');
      }
      
    }
    
    public function interview_2()
    {
     $id = $this->input->post('id');
     $link = $this->input->post('link_interview2');
     $tanggal = $this->input->post('tgl_interview2');
     
      $cek = $this->db->get_where('job_applications', array('job_application_id' => $id))->row();
        if ($cek != NULL) {
            
         $data  = array(
       'status' => 'INTERVIEW TAHAP 2',
        'link_form' => ""
       );
         
        $this->db->where('job_application_id', $id);
        $this->db->update('job_applications', $data); 
        
        $data_p = $this->db->get_where('candidates', array('candidate_id' => $cek->candidate_id))->row();
        $email = $data_p->email;
        
        $cek_token = $this->AdminCandidateModel->getDataPendaftar($id);
        $datas['candidate'] = $cek_token;
        $datas['link'] = $link;
        $datas['tgl'] = $tanggal;
        $message = $this->load->view('perusahaan/admin/emails/interview2',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Tes Interview Tahap 2'
        );
    
        redirect('perusahaan/admin/pendaftar-kandidat');
      }else{
        redirect('perusahaan/admin/pendaftar-kandidat');
      }
    }
    
    public function kirim_verif($id)
    {
        
    $cek = $this->db->get_where('job_applications', array('job_application_id' => $id))->row();
        if ($cek != NULL) {
            
         $token = uniqid('user_', true);
       
       $data  = array(
       'token_acc' => $token,
       'status_verif' =>  '1'
       );
         
        $this->db->where('job_application_id', $id);
        $this->db->update('job_applications', $data); 
        
        $data_p = $this->db->get_where('candidates', array('candidate_id' => $cek->candidate_id))->row();
        $email = $data_p->email;
        
        $cek_token = $this->AdminCandidateModel->getDataPendaftar($id);
        $datas['candidate'] = $cek_token;
        $datas['job'] = $cek_token->title;
      
        $message = $this->load->view('perusahaan/admin/emails/email_acc',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Tahap Verifikasi'
        );
            
        redirect('perusahaan/admin/pendaftar-kandidat');
      }else{
        redirect('perusahaan/admin/pendaftar-kandidat');
      }
    }
    
    public function next_step($id)
    {
      if ($id == NULL) {
      $this->load->view('perusahaan/admin/404_eror');
      }else{
        $cek = $this->db->get_where('job_applications', array('token_acc' => $id))->row();
        if (!empty($cek)) {
        $data  = array(
          'token_acc' => '',
          'status_verif' =>  '2'
        );
        // $id_kandidat = $cek->candidate_id;
        $this->db->where('token_acc', $id);
        $this->db->update('job_applications', $data);
        
        $this->load->view('perusahaan/admin/success');
      }else{
         $this->load->view('perusahaan/admin/404_eror');
      }
    }
  }
  
  public function end($id)
    {
      if ($id == NULL) {
      $this->load->view('perusahaan/admin/404_eror');
      }else{
        $cek = $this->db->get_where('job_applications', array('token_acc' => $id))->row();
        if (!empty($cek)) {
        $data  = array(
          'token_acc' => '',
          'status_verif' =>  '3'
        );
        $this->db->where('token_acc', $id);
        $this->db->update('job_applications', $data);
        
        $this->load->view('perusahaan/admin/end');
      }else{
         $this->load->view('perusahaan/admin/404_eror');
      }
    }
  }
  
   //////////////////////////////////////////////////////////////////////////////////////////////
    
    public function cek_form(){
    $id = $this->input->get('id');
    $data = $this->db->get_where('form_ph', array('id_link' => $id))->row();
    echo json_encode($data);
    }

    public function form()
    {
        $data['page'] = 'Data Link Google Form';
        $data['menu'] = 'kelola-form';
        $data['action'] = site_url('perusahaan/kelas');
        $data['action_edit'] = site_url('perusahaan/edit_kelas');
        $data['link'] = $this->db->get_where('form_ph',array('company_id'=>$this->session->userdata('company')['company_id']))->result();

        $this->load->view('perusahaan/admin/layout/header', $data);
        $this->load->view('perusahaan/admin/prakerja/form');
    }
    
     public function input_kelas()
	{
    $nama = $this->input->post('nama_link');
    $link = $this->input->post('link');
    $batas = $this->input->post('batas');
       $data  = array(
         'company_id' => $this->session->userdata('company')['company_id'],
         'nama' => $nama,
         'link' => $link,
         'batas' => $batas,
         'dibuat' => date('Y-m-d H:i:s')
       );
       $this->db->insert('form_ph',$data);
       redirect('perusahaan/admin/kelola-form');
	}
    public function edit_kelas()
	{
     $id = $this->input->post('id');
	   $cek = $this->db->get_where('form_ph', array('id_form' => $id ))->num_rows();
     if ($cek == NULL) {
       redirect('perusahaan/admin/kelola-form');
     }else{
       $data  = array(
         'nama' => $this->input->post('nama_link'),
         'link' => $this->input->post('link'),
         'batas' => $this->input->post('batas'),
         'diubah' => date('Y-m-d H:i:s'),
       );
       $this->db->where('id_form', $id);
       $this->db->update('form_ph', $data);
       redirect('perusahaan/admin/kelola-form');
     }
	}
	
	public function hapus_form($id)
    {
      if ($id == NULL) {
      redirect('perusahaan/admin/kelola-form');
      }else{
        $cek = $this->db->get_where('form_ph', array('id_form' => $id));
        if ($cek) {
        $this->db->delete('form_ph', array('id_form' => $id));
        redirect('perusahaan/admin/kelola-form');
      }else{

        redirect('perusahaan/admin/kelola-form');
      }
    }
  }
    
    //FUNGSI LINK GOOGLE FORM
    
    //////////////////////////////////////////////////////////////////////////////////////////////

    public function link()
    {
        $data['page'] = 'Data Zoom Meeting';
        $data['menu'] = 'Link Zoom Meeting';
        $data['action'] = site_url('perusahaan/tambah_link');
        $data['action_edit'] = site_url('perusahaan/edit_link');
        $data['link'] = $this->db->get_where('link_ph',array('company_id'=>$this->session->userdata('company')['company_id']))->result();

        $this->load->view('perusahaan/admin/layout/header', $data);
        $this->load->view('perusahaan/admin/prakerja/link');
    }

  
   	//FUNGSI LINK GOOGLE FORM
	
    public function tambah_link()
	{
    $nama = $this->input->post('nama_link');
    $cph = $this->session->userdata('company')['company_id'];
    $link = $this->input->post('link');
       $data  = array(
         'company_id' => $cph,
         'nama' => $nama,
         'link' => $link,
         'dibuat' => date('Y-m-d H:i:s')
       );
       $this->db->insert('link_ph',$data);
       redirect('perusahaan/admin/kelola-link');
	}
	
    public function edit_link()
	{
    $id = $this->input->post('id');
	   $cek = $this->db->get_where('link_ph', array('id_link' => $id ))->num_rows();
     if ($cek == NULL) {
       redirect('perusahaan/admin/kelola-link');
     }else{
       $data  = array(
         'nama' => $nama = $this->input->post('nama_link'),
         'link' => $nama = $this->input->post('link'),
         'diubah' => date('Y-m-d H:i:s'),
       );
       $this->db->where('id_link', $id);
       $this->db->update('link_ph', $data);
       redirect('perusahaan/admin/kelola-link');
     }
	}
       public function hapus_link($id)
    {
      if ($id == NULL) {
      redirect('perusahaan/admin/kelola-link');
      }else{
        $cek = $this->db->get_where('link_ph', array('id_link' => $id));
        if ($cek) {
        $this->db->delete('link_ph', array('id_link' => $id));
        redirect('perusahaan/admin/kelola-link');
      }else{

        redirect('perusahaan/admin/kelola-link');
      }
    }
  }

    //////////////////////////////////////////////////////////////////////////////////////////////

    public function aktif($id)
    {
      if ($id == NULL) {
      redirect('perusahaan/admin/sertifikasi');
      }else{
        $cek = $this->db->get_where('prakerja', array('prakerja_id' => $id));
        if ($cek) {
        $data  = array(
          'status' => 1
        );
        $this->db->where('id', $id);
        $this->db->update('prakerja', $data);

        redirect('perusahaan/admin/sertifikasi');
      }else{

        redirect('perusahaan/admin/sertifikasi');
      }
    }
  }

    public function nonaktif($id)
    {
      if ($id == NULL) {
      redirect('perusahaan/admin/sertifikasi');
      }else{
        $cek = $this->db->get_where('prakerja', array('prakerja_id' => $id));
        if ($cek) {
        $data  = array(
          'status' => 0
        );
        $this->db->where('id', $id);
        $this->db->update('prakerja', $data);

        redirect('perusahaan/admin/sertifikasi');
      }else{

        redirect('perusahaan/admin/sertifikasi');
      }
    }
  }
    public function aktif_kelas($id)
    {
      if ($id == NULL) {
      redirect('perusahaan/admin/kelola-kelas');
      }else{
        $cek = $this->db->get_where('kelas', array('id' => $id));
        if ($cek) {
        $data  = array(
          'update_date' => date('Y-m-d H:i:s'),
          'status' => 1,
        );
        $this->db->where('id', $id);
        $this->db->update('kelas', $data);

        redirect('perusahaan/admin/kelola-kelas');
      }else{

        redirect('perusahaan/admin/kelola-kelas');
      }
    }
  }

    public function nonaktif_kelas($id)
    {
      if ($id == NULL) {
      redirect('perusahaan/admin/kelola-kelas');
      }else{
        $cek = $this->db->get_where('kelas', array('id' => $id));
        if ($cek) {
        $data  = array(
           'update_date' => date('Y-m-d H:i:s'),
          'status' => 0
        );
        $this->db->where('id', $id);
        $this->db->update('kelas', $data);

        redirect('perusahaan/admin/kelola-kelas');
      }else{

        redirect('perusahaan/admin/kelola-kelas');
      }
    }
  }
  
   public function verif_bayar($id)
    {
        if ($id == NULL) {
      redirect('perusahaan/admin/pendaftar-kandidat');
      }else{
        $cek = $this->db->get_where('job_applications', array('job_application_id' => $id))->row();
        if ($cek != NULL) {
        $token = uniqid('user_', true);
        $data  = array(
          'token_bayar' => '',
          'status_bayar' => 3,
         );
         
        $this->db->where('job_application_id', $id);
        $this->db->update('job_applications', $data); 
        
        $data_p = $this->db->get_where('candidates', array('candidate_id' => $cek->candidate_id))->row();
        $email = $data_p->email;
        
        $cek_token = $this->AdminCandidateModel->getDataPendaftar($id);
        $datas['candidate'] = $cek_token;
        $datas['dated'] = date('Y-m-d H:i:s');
        $message = $this->load->view('perusahaan/admin/emails/konfirmasi',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Verifikasi Pembayaran'
        );
    
        redirect('perusahaan/admin/pendaftar-kandidat');
      }else{
        redirect('perusahaan/admin/pendaftar-kandidat');
      }
    }
  }
  
  public function kirim_invoice($id)
    {
      if ($id == NULL) {
      redirect('perusahaan/admin/pendaftar-kandidat');
      }else{
        $cek = $this->db->get_where('job_applications', array('job_application_id' => $id))->row();
        if ($cek != NULL) {
        $token = uniqid('user_', true);
        $data  = array(
        //   'status' => 1,
          'token_bayar' => $token,
          'status_bayar' => 1,
         );
         
        $this->db->where('job_application_id', $id);
        $this->db->update('job_applications', $data); 
        
        $data_p = $this->db->get_where('candidates', array('candidate_id' => $cek->candidate_id))->row();
        $email = $data_p->email;
        
        $cek_token = $this->AdminCandidateModel->getDataPendaftar($id);
        $datas['candidate'] = $cek_token;
        $message = $this->load->view('perusahaan/admin/emails/tagihan',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Invoice Tes Psikologi'
        );
    
        redirect('perusahaan/admin/pendaftar-kandidat');
      }else{
        redirect('perusahaan/admin/pendaftar-kandidat');
      }
    }
  }

    /**
     * Function (for ajax) to process candidate bulk action request
     *
     * @return void
     */
    // public function bulkAction()
    // {
    //     $this->checkIfDemo();
    //     $this->AdminCandidateModel->bulkAction();
    // }
    //
    // /**
    //  * Function (for ajax) to process candidate delete request
    //  *
    //  * @param integer $candidate_id
    //  * @return void
    //  */
    // public function delete($candidate_id)
    // {
    //     $this->checkIfDemo();
    //     $this->AdminCandidateModel->remove($candidate_id);
    // }
    //
    // /**
    //  * Function (for ajax) to display candidate resume
    //  *
    //  * @param integer $resume_id
    //  * @return void
    //  */
    // public function resume($resume_id)
    // {
    //     $data['resume'] = $this->AdminCandidateModel->getCompleteResume($resume_id);
    //     echo $this->load->view('admin/candidates/resume', $data, TRUE);
    // }
    //
    // /**
    //  * Post Function to download candidate resume
    //  *
    //  * @return void
    //  */
    // public function resumeDownload()
    // {
    //     ini_set('max_execution_time', '0');
    //     $this->checkAdminLogin();
    //     $ids = explode(',', $this->xssCleanInput('ids'));
    //     $resumes = '';
    //     foreach ($ids as $id) {
    //         $data['resume'] = $this->AdminCandidateModel->getCompleteResumeJobBoard($id);
    //         if ($data['resume']['type'] == 'detailed') {
    //             $resumes .= $this->load->view('admin/candidates/resume-pdf', $data, TRUE);
    //         } else {
    //             $resumes .= "<hr />";
    //             $resumes .= 'Resume of "'.$data['resume']['first_name'].' '.$data['resume']['last_name'].' ('.$data['resume']['designation'].')" is static and can be downloaded separately';
    //             $resumes .= "<br /><hr />";
    //         }
    //
    //     }
    //
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($resumes);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     $dompdf->stream('Resumes.pdf');
    //     exit;
    // }
    //
    // /**
    //  * Post Function to download candidates data in excel
    //  *
    //  * @return void
    //  */
    // public function candidatesExcel()
    // {
    //     $data = $this->AdminCandidateModel->getCandidatesForCSV($this->xssCleanInput('ids'));
    //     $data = sortForCSV(objToArr($data));
    //     $excel = new SimpleExcel('csv');
    //     $excel->writer->setData($data);
    //     $excel->writer->saveFile('candidates');
    //     exit;
    // }
}
