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
        $this->checkAdminLogin();
    }
    
    
    public function data_unverif()
    {
        echo json_encode($this->AdminCandidateModel->candidatesList_unverif());
    }
    
    

    /**
     * View Function to display candidates list view page
     *
     * @return html/string
     */
     
    
     public function mitra_vokasi()
    {
        $data['page'] = 'Mitra Vokasi SMA/SMK';
        $data['menu'] = 'mitra_vokasi';
        
        $data['action'] = site_url('status_tes');
        $data['action_2'] = site_url('mou_smk');
        $data['action_3'] = site_url('admin/edit_link_smk');
        $data['import'] = site_url('candidates/import-siswa');
        
        
        $data['prakerja'] = $this->db->select('user_mitra.*, provinsi.nama as prov, kabupaten.nama as kab, 
                                            kecamatan.nama as kec,')
                                     ->from('user_mitra')
                                     ->join('provinsi','provinsi.id_prov = user_mitra.provinsi')
                                     ->join('kabupaten','kabupaten.id_kab = user_mitra.kabupaten')
                                     ->join('kecamatan','kecamatan.id_kec = user_mitra.kecamatan')
                                     ->get()->result();
        // echo json_encode($data['prakerja']);
        // die;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/mitra/vokasi');
    } 
    
    
    public function kelola_siswa_mitra($id)
    {
        $data['id'] = decode($id);
        
        $data['page'] = 'Kelola Siwa Mitra';
        $data['menu'] = 'mitra_vokasi';
        
        $data['mitra'] = $this->db->get_where('user_mitra',array('id_mitra' => decode($id)))->row();
        
        
        // $data['data'] = $this->AdminCandidateModel->getSiswaMitra($id);
        // echo json_encode($data['data']);
        // die;
        // // select('candidates.*,kelas.nama as nama_kelas, jurusan.nama as jurusan, tahun_angkatan.tahun_angkatan as tahun_angkatan')
        // //                              ->from('candidates')
        // //                              ->where('candidates.account_id',$id)
        // //                              ->where('candidates.kelas_siswa != ', '')
        // //                              ->join('kelas','kelas.id = candidates.id_kelas')
        // //                              ->join('jurusan','jurusan.id = candidates.id_jurusan')
        // //                              ->join('tahun_angkatan','tahun_angkatan.id = candidates.id_tahun_angkatan')
        // //                              ->get()->result();
        // // echo json_encode($data['prakerja']);
        // die;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/mitra/kelola_siswa_mitra');
    }
    
    public function status_tes(){
    $id = $this->input->post('id');
    $status = $this->input->post('status');
    $value = $this->input->post('value');
    
    $table = 'user_mitra';
    $where = 'id_mitra';
    $redirect = '';
    if($status == "vokasi"){
        $redirect = 'admin/mitra_vokasi';
    }else{
        $redirect = 'admin/mitra_kampus';
    }
    
    $datas = $this->db->get_where($table, array($where => $id))->row();
    if(!empty($datas)){
     $data  = array(
        'status' => $value
       );
       $this->db->where($where, $id);
       $cek_status = $this->db->update($table, $data);
       if($cek_status){
           
           $cek_data = $this->db->get_where('users',array('account_id'=>$id))->row();
           if(!empty($cek_data)){
          
                $this->db->where('account_id', $id);
                 $this->db->update('users', $data);
                 
                 
           }else{
          
                  $data_user = array(
                  'account_id' => $id,
                  'first_name' => $datas->nama,
                  'username' => $datas->nama,
                  'email' => $datas->email,
                  'phone' => $datas->no_telp,
                  'password' => $datas->password,
                  'status' => $value,
                  'user_type' => 'team',
                  'created_at' => date('Y-m-d H:i:s')
                    );
                    
                     $cek_user = $this->db->insert('users', $data_user);
                     if($cek_user){
                       $get_user = $this->db->get_where('users',array('account_id'=>$id))->row();
                         $data_role = array(
                         'user_id' => $get_user->user_id,
                         'role_id' => 8,
                          );
                      $cek_role = $this->db->insert('user_roles', $data_role);
                      if($cek_role){
                           $data2  = array(
                            'role_mitra' => 8
                            );
                         $this->db->where($where, $id);
                         $this->db->update($table, $data2);
                      }
                     }
           }
       }
    }
    redirect($redirect);
    }
    
    public function edit_link_smk()
    {
    $id_mitra = $this->input->post('id_mitra');
    $link_siswa = $this->input->post('link_siswa'); 
    
    $data = array('link_siswa' => $link_siswa);
    $cek = $this->db->get_where('user_mitra',array('id_mitra' => $id_mitra, 'link_siswa' => $link_siswa))->num_rows();
    if($cek > 0){
        $this->session->set_flashdata('error', 'Gagal Perbarui Link Pendaftaran. Link yang sama sudah terdaftar !');
    }else{
        $this->db->where('id_mitra',$id_mitra);
        $this->db->update('user_mitra',$data);
        $this->session->set_flashdata('success', 'Berhasil Perbarui Link Pendaftaran');
    }
        redirect('admin/mitra_vokasi');
    }
    
    public function mou_smk()
    {
    $id_mitra = $this->input->post('id_mitra');
    $mou = $this->input->post('mou'); 
    $jenis = $this->input->post('jenis'); 
            // echo json_encode($jenis);
            // die;
    
    if($jenis == 1){
        $file_mou = $this->uploadMOU($id_mitra,$jenis); 
        if ($file_mou['success'] == false) {
            $this->session->set_flashdata('error', 'File MOU Gagal di Kirim');
            redirect('admin/mitra_vokasi');
        }else{
            $datax = array('mou' => $file_mou['file_mou']);
            $this->db->where('id_mitra',$id_mitra);
            $this->db->update('user_mitra',$datax);
        }
    }else{
        $file_mou = $this->uploadMOU($id_mitra,$jenis); 
        if ($file_mou['success'] == false) {
            $this->session->set_flashdata('error', 'File MOU Gagal di Kirim');
            redirect('admin/mitra_vokasi');
        }else{
            $datax = array('mou' => $file_mou['file_mou'], 'status_mitra' => 1);
            $this->db->where('id_mitra',$id_mitra);
            $this->db->update('user_mitra',$datax);
        
        }
    }
    
    $this->session->set_flashdata('success', 'File MOU Berhasil di Kirim');
    redirect('admin/mitra_vokasi');
    
    }
    
    private function uploadMOU($id_mitra,$jenis)
  {
    if ($_FILES['mou']['name'] != '') {
        if($jenis == 1){
        $mitra = $this->db->get_where('user_mitra',array('id_mitra' => $id_mitra))->row_array();
            if ($mitra['mou'] != '') {
                    @unlink(ASSET_ROOT . '/admin/mou/' . $mitra['mou']);
            }
        }
      $file = explode('.', $_FILES['mou']['name']);
      $ext = $file[1];
      $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
      $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
      $config['upload_path'] = ASSET_ROOT . '/admin/mou/';
      $config['allowed_types'] = 'pdf|PDF|';
      $config['file_name'] = $filename;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('mou')) {
        return array(
          'success' => false, 'message' => 'File Harus Bertipe PDF'
        );
      } else {
        $data = $this->upload->data();
        return array('success' => true, 'file_mou' => $data['file_name']);
      }
    }
    return array('success' => true, 'message' => '');
  }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
     public function vokasi()
    {
       $data['page'] = 'List Magang SMK';
        $data['menu'] = 'pendaftar-vokasi';
        
        $data['prakerja'] = $this->AdminCandidateModel->getDataVokasi();
        
    // var_dump($data['prakerja']);
    // die;
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/vokasi');
    }
    
    public function magang()
    {
       $data['page'] = 'List Magang SMK';
        $data['menu'] = 'pendaftar-vokasi';
        $id= $this->session->userdata('admin')['account_id'];
        $data['prakerja'] = $this->AdminCandidateModel->getDataVokasiMagang($id);
        
    // var_dump($data['prakerja']);
    // die;
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/magang');
    }
    
    public function link_pendaftaran()
    {
       $data['page'] = 'Link Pendaftaran SMK';
        $data['menu'] = 'link-pendaftaran';
        
        $data['profile'] = $this->db->get_where('user_mitra', array('id_mitra' => $this->session->userdata('admin')['account_id'] ))->row();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/link_daftar');
    }
    
     public function kelola_jurusan()
    {
       $data['page'] = 'Kelola Jurusan SMK';
        $data['menu'] = 'kelola-jurusan';
        $id = $this->session->userdata('admin')['account_id'];
        
        $data['prakerja'] = $this->AdminCandidateModel->getDataJurusanSmk($id);
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/jurusan');
    }
    
     public function guru()
    {
       $data['page'] = 'List Guru SMK';
        $data['menu'] = 'pendaftar-guru';
        
        $data['prakerja'] = $this->AdminCandidateModel->getDataVokasiGuru();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/guru');
    }
    
     public function psiko_kompetensi_guru($id)
    {
         $id = decode($id);
       $data['page'] = 'Detail Guru SMK';
        $data['menu'] = 'pendaftar-guru';
        
       $data['prakerja'] = $this->AdminCandidateModel->getDetailGuruPsiko($id);
         $get_smk = $this->db->get_where('user_mitra', array('id_mitra' => $id))->row();
        $data['smk'] = $get_smk->nama;
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/psiko_guru');
    }
    
    public function detail_guru($id)
    {
         $id = decode($id);
       $data['page'] = 'Detail Guru SMK';
        $data['menu'] = 'pendaftar-guru';
        
       $data['prakerja'] = $this->AdminCandidateModel->getDetailGuru($id);
         $get_smk = $this->db->get_where('user_mitra', array('id_mitra' => $id))->row();
        $data['smk'] = $get_smk->nama;
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/detail_guru');
    }
    
    public function lolos($id)
    {
        $id = decode($id);
       $data['page'] = 'Peserta Lolos';
        $data['menu'] = 'pendaftar-vokasi';
        
        $data['prakerja'] = $this->AdminCandidateModel->getDataVokasiLolos($id);
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/kampus');
    }
    
    
    public function psikotes($id)
    {
         $id = decode($id);
       $data['page'] = 'Peserta Psikotes';
        $data['menu'] = 'pendaftar-vokasi';
        
        $data['prakerja'] = $this->AdminCandidateModel->getDataVokasiPsikotes($id);
         $get_smk = $this->db->get_where('user_mitra', array('id_mitra' => $id))->row();
        $data['smk'] = $get_smk->nama;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/psikotes');
    }
    
    
    public function kompetensi($id)
    {
         $id = decode($id);
       $data['page'] = 'Peserta Kompetensi';
        $data['menu'] = 'pendaftar-vokasi';
        
        $data['prakerja'] = $this->AdminCandidateModel->getDataVokasiKompetensi($id);
         $get_smk = $this->db->get_where('user_mitra', array('id_mitra' => $id))->row();
        $data['smk'] = $get_smk->nama;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/kompetensi');
    }
    
    
    public function user($id)
    {
        $id = decode($id);
        $data['page'] = 'Peserta User';
        $data['menu'] = 'pendaftar-vokasi';
        
        $data['prakerja'] = $this->AdminCandidateModel->getDataVokasiUser($id);
        $get_smk = $this->db->get_where('user_mitra', array('id_mitra' => $id))->row();
        $data['smk'] = $get_smk->nama;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/magang/user');
    }
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
     public function unverif()
    {
        $data['page'] = 'User Unverif';
        $data['menu'] = 'pendaftar-unverif';
        $data['action'] = site_url('kirim-link');
        $data['action_kode'] = site_url('kirim_kode');
        $data['action_hasil'] = site_url('status_tes');
        $data['action2'] = site_url('interview_2');
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/unverif');
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
        $message = $this->load->view('admin/emails/form',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Tes Google Form'
        );
    
        redirect('admin/pendaftar-kandidat');
      }else{
        redirect('admin/pendaftar-kandidat');
      }
      
    }
    
     public function kirim_kode()
    {
    
      $id = $this->input->post('id');
     $id_kandidat = $this->input->post('id_kandidat');
     $kode_aktivasi = $this->input->post('kode_aktivasi');
     $awal = $this->input->post('jam_awal');
     $akhir = $this->input->post('jam_akhir');
     
      $cek = $this->db->get_where('job_applications', array('job_application_id' => $id))->row();
        if ($cek != NULL) {

        $data  = array(
        'job_application_id' => $id,
        'kode_aktivasi' => $kode_aktivasi,
        'deskripsi' => 'TES PSIKOLOGI',
        'status' => 0
         );
         
        $cek2 = $this->db->insert('tes_psikologi', $data); 
        if($cek2){
        $data2  = array(
        'kode_aktivasi' => $kode_aktivasi,
         );
        
        $this->db->where('job_application_id', $id); 
        $this->db->update('job_applications', $data2); 
        }
            // $data['candidate'] = $this->db->get_where('candidates', array('candidate_id' => $id_kandidat ))->row_array();
            // $data['tanggal_kerja'] = $tanggal;
            // $data['awal'] = $awal;
            // $data['akhir'] = $akhir;
            // $message = $this->load->view('admin/emails/tagihan', $data, TRUE);
            // $this->sendEmail($message, $data['candidate']['email'], 'Tes Psikologi');
        
        
        redirect('admin/pendaftar-vokasi');
      }else{
        redirect('admin/pendaftar-vokasi');
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
        $message = $this->load->view('admin/emails/interview2',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Tes Interview Tahap 2'
        );
    
        redirect('admin/pendaftar-kandidat');
      }else{
        redirect('admin/pendaftar-kandidat');
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
      
        $message = $this->load->view('admin/emails/email_acc',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Tahap Verifikasi'
        );
            
        redirect('admin/pendaftar-kandidat');
      }else{
        redirect('admin/pendaftar-kandidat');
      }
    }
    
    public function next_step($id)
    {
      if ($id == NULL) {
      $this->load->view('admin/404_eror');
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
        
        $this->load->view('admin/success');
      }else{
         $this->load->view('admin/404_eror');
      }
    }
  }
  
  public function end($id)
    {
      if ($id == NULL) {
      $this->load->view('admin/404_eror');
      }else{
        $cek = $this->db->get_where('job_applications', array('token_acc' => $id))->row();
        if (!empty($cek)) {
        $data  = array(
          'token_acc' => '',
          'status_verif' =>  '3'
        );
        $this->db->where('token_acc', $id);
        $this->db->update('job_applications', $data);
        
        $this->load->view('admin/end');
      }else{
         $this->load->view('admin/404_eror');
      }
    }
  }
    
    public function cek_form(){
    $id = $this->input->get('id');
    $data = $this->db->get_where('form', array('id' => $id))->row();
    echo json_encode($data);
    }

    public function form()
    {
        $data['page'] = 'Data Link Google Form';
        $data['menu'] = 'kelola-form';
        $data['action'] = site_url('kelas');
        $data['action_edit'] = site_url('edit_kelas');
        // $data['prakerja'] = $this->AdminPrakerjaModel->getPrakerja();
        $data['link'] = $this->db->get('form')->result();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/form');
    }
    
    //FUNGSI LINK GOOGLE FORM

    public function link()
    {
        $data['page'] = 'Data Zoom Meeting';
        $data['menu'] = 'Link Zoom Meeting';
        $data['action'] = site_url('tambah_link');
        $data['action_edit'] = site_url('edit_link');
        // $data['prakerja'] = $this->AdminPrakerjaModel->getPrakerja();
        $data['link'] = $this->db->get('link')->result();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/link');
    }
    
     public function kode()
    {
        $data['page'] = 'Data Batch Psikotest';
        $data['menu'] = 'Data Batch Psikotest';
        
        $data['action'] = site_url('tambah_kode');
        $data['action_edit'] = site_url('edit_kode');
        // $data['prakerja'] = $this->AdminPrakerjaModel->getPrakerja();
        $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
        if(!empty($cek)){
        if($cek->status_mitra == 1){
        $this->db->order_by('id','DESC');
        $data['kode'] = $this->db->get_where('kode_psikotest',array('id_mitra' => $this->session->userdata('admin')['account_id']))->result();
        }
        }else{
        $this->db->order_by('id','DESC');
        $data['kode'] = $this->db->get('kode_psikotest')->result();
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/prakerja/kode');
    }

    public function import()
	{
		if (isset($_POST['import'])) {
      $file = $_FILES['prakerja']['tmp_name'];
	    $ekstensi  = explode('.', $_FILES['prakerja']['name']);
      if (empty($file)) {
				echo 'File tidak boleh kosong!';
			} else {
			  if (strtolower(end($ekstensi)) === 'csv' && $_FILES["prakerja"]["size"] > 0) {

					$i = 0;
					$handle = fopen($file, "r");
					while (($row = fgetcsv($handle, 20480))) {
						$i++;
						if ($i == 1) continue;

						// Data yang akan disimpan ke dalam databse
						$data = [
							'prakerja_id' => $row[0],
							'nama' => $row[1],
							'email' => $row[2],
							'no_telp' => $row[3],
							'alamat' => $row[4],
							'status' => '0',
						];

					$this->db->insert('prakerja', $data);
					}

					fclose($handle);
					redirect('admin/sertifikasi');

				} else {
					redirect('admin/sertifikasi');
				}
			 }
      }
	}
    
    //FUNGSI LINK GOOGLE FORM
    public function input_kelas()
	{
    $nama = $this->input->post('nama_link');
    $link = $this->input->post('link');
    $batas = $this->input->post('batas');
       $data  = array(
         'nama' => $nama,
         'link' => $link,
         'batas' => $batas,
         'dibuat' => date('Y-m-d H:i:s')
       );
       $this->db->insert('form',$data);
       redirect('admin/kelola-form');
	}
    public function edit_kelas()
	{
     $id = $this->input->post('id');
	   $cek = $this->db->get_where('form', array('id' => $id ))->num_rows();
     if ($cek == NULL) {
       redirect('admin/kelola-form');
     }else{
       $data  = array(
         'nama' => $this->input->post('nama_link'),
         'link' => $this->input->post('link'),
         'batas' => $this->input->post('batas'),
         'diubah' => date('Y-m-d H:i:s'),
       );
       $this->db->where('id', $id);
       $this->db->update('form', $data);
       redirect('admin/kelola-form');
     }
	}
	//FUNGSI LINK GOOGLE FORM
	
    public function tambah_link()
	{
    $nama = $this->input->post('nama_link');
    $link = $this->input->post('link');
       $data  = array(
         'nama' => $nama,
         'link' => $link,
         'dibuat' => date('Y-m-d H:i:s')
       );
       $this->db->insert('link',$data);
       redirect('admin/kelola-link');
	}
	
	 public function tambah_kode()
	{
	    $nama = $this->input->post('nama');
	    $modul = $this->input->post('modul');
	    $banyak = $this->input->post('jumlah');
	    $kode = $this->Psikotes_Model->generate_kodeAktivasi($banyak,$modul);
	    $kode_aktivasi = implode(",", $kode) ;
	    
	     $data  = array(
         'nama' => $nama,
         'modul' => $modul,
         'jumlah' => $banyak,
         'dibuat' => date('Y-m-d H:i:s'),
         'kode' => $kode_aktivasi
       );
       
       $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
        if(!empty($cek)){
        if($cek->status_mitra == 1){
            $data['id_mitra'] =  $cek->id_mitra;
            $data['nama'] =  $nama.'-'.$cek->nama;
        }}
        
       $this->db->insert('kode_psikotest',$data);
       redirect('admin/kelola-kode');
	    
	}
	
    public function edit_link()
	{
    $id = $this->input->post('id');
	   $cek = $this->db->get_where('link', array('id' => $id ))->num_rows();
     if ($cek == NULL) {
       redirect('admin/kelola-link');
     }else{
       $data  = array(
         'nama' => $nama = $this->input->post('nama_link'),
         'link' => $nama = $this->input->post('link'),
         'diubah' => date('Y-m-d H:i:s'),
       );
       $this->db->where('id', $id);
       $this->db->update('link', $data);
       redirect('admin/kelola-link');
     }
	}
   
   
    public function aktif($id)
    {
      if ($id == NULL) {
      redirect('admin/sertifikasi');
      }else{
        $cek = $this->db->get_where('prakerja', array('prakerja_id' => $id));
        if ($cek) {
        $data  = array(
          'status' => 1
        );
        $this->db->where('id', $id);
        $this->db->update('prakerja', $data);

        redirect('admin/sertifikasi');
      }else{

        redirect('admin/sertifikasi');
      }
    }
  }

    public function nonaktif($id)
    {
      if ($id == NULL) {
      redirect('admin/sertifikasi');
      }else{
        $cek = $this->db->get_where('prakerja', array('prakerja_id' => $id));
        if ($cek) {
        $data  = array(
          'status' => 0
        );
        $this->db->where('id', $id);
        $this->db->update('prakerja', $data);

        redirect('admin/sertifikasi');
      }else{

        redirect('admin/sertifikasi');
      }
    }
  }
    public function aktif_kelas($id)
    {
      if ($id == NULL) {
      redirect('admin/kelola-kelas');
      }else{
        $cek = $this->db->get_where('kelas', array('id' => $id));
        if ($cek) {
        $data  = array(
          'update_date' => date('Y-m-d H:i:s'),
          'status' => 1,
        );
        $this->db->where('id', $id);
        $this->db->update('kelas', $data);

        redirect('admin/kelola-kelas');
      }else{

        redirect('admin/kelola-kelas');
      }
    }
  }

    public function nonaktif_kelas($id)
    {
      if ($id == NULL) {
      redirect('admin/kelola-kelas');
      }else{
        $cek = $this->db->get_where('kelas', array('id' => $id));
        if ($cek) {
        $data  = array(
           'update_date' => date('Y-m-d H:i:s'),
          'status' => 0
        );
        $this->db->where('id', $id);
        $this->db->update('kelas', $data);

        redirect('admin/kelola-kelas');
      }else{

        redirect('admin/kelola-kelas');
      }
    }
  }

    public function hapus($id)
    {
      if ($id == NULL) {
      redirect('admin/sertifikasi');
      }else{
        $cek = $this->db->get_where('prakerja', array('prakerja_id' => $id));
        if ($cek) {
        $this->db->delete('prakerja', array('id' => $id));
        redirect('admin/sertifikasi');
      }else{

        redirect('admin/sertifikasi');
      }
    }
  }
    public function hapus_link($id)
    {
      if ($id == NULL) {
      redirect('admin/kelola-link');
      }else{
        $cek = $this->db->get_where('link', array('id' => $id));
        if ($cek) {
        $this->db->delete('link', array('id' => $id));
        redirect('admin/kelola-link');
      }else{

        redirect('admin/kelola-link');
      }
    }
  }
  
  public function hapus_form($id)
    {
      if ($id == NULL) {
      redirect('admin/kelola-form');
      }else{
        $cek = $this->db->get_where('form', array('id' => $id));
        if ($cek) {
        $this->db->delete('form', array('id' => $id));
        redirect('admin/kelola-form');
      }else{

        redirect('admin/kelola-form');
      }
    }
  }
  
   public function verif_bayar($id)
    {
        if ($id == NULL) {
      redirect('admin/pendaftar-kandidat');
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
        $message = $this->load->view('admin/emails/konfirmasi',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Verifikasi Pembayaran'
        );
    
        redirect('admin/pendaftar-kandidat');
      }else{
        redirect('admin/pendaftar-kandidat');
      }
    }
  }
  
  public function kirim_invoice($id)
    {
      if ($id == NULL) {
      redirect('admin/pendaftar-kandidat');
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
        $message = $this->load->view('admin/emails/tagihan',$datas, TRUE);
        
        $cek_kirim = $this->sendEmail(
        $message,
        $email,
        'Invoice Tes Psikologi'
        );
    
        redirect('admin/pendaftar-kandidat');
      }else{
        redirect('admin/pendaftar-kandidat');
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
