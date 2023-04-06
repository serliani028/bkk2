<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;

class Sekolah extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }
    
    //////////////////////////////////////////// START TAHUN ANGKATAN/////////////////////////////////////////
    public function tahunAngkatan()
    {
        $data['page'] = 'Kelola Tahun Angkatan';
        $data['menu'] = 'tahunAngkatan';
        $data['edit_tahun'] = site_url('sekolah/edit_tahun');
        $data['tambah_tahun'] = site_url('sekolah/tambah_tahun');
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        $data['years'] = range(2022, strftime("%Y", time())); 
        
        if($data['id']){
        $get_data = $this->SekolahModel->getTahunAngkatan($data['id']);
        }else{
        $get_data = ['data' => null, 'status' => 0];
        }
        
        $result = [];
        
        if($get_data['status'] == 1){
            if($get_data['data'] == null){
                $get_tahun = $this->db->get_where('tahun_angkatan',array('id_mitra' => $data['id']))->row();
                $result[$get_tahun->id] = 
                ['id_tahun' => $get_tahun->id, 'tahun' => $get_tahun->tahun_angkatan, 'kelasX'=> 0,'kelasXI' => 0, 'kelasXII' => 0];
            }else{
                foreach($get_data['data'] as $keys => $v){
                 $key = $v->id_tahun;
                  if(!isset($result[$key])){
                    $result[$key] = ['id_tahun' => $key, 'tahun' => $v->tahun, 'kelasX' => $v->jum,'kelasXI' => 0, 'kelasXII' => 0,];
                   }else{
                     if($v->kelas_siswa == 'XI'){
                        $result[$key]['kelasXI'] = $v->jum;
                     }else{
                        $result[$key]['kelasXII'] = $v->jum;
                     }
                   }
                }
            }
        } 
        
        $data['data'] = $result;
       
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/tahunAngkatan/index');
    }
    

    public function tambah_tahun()
    {
       $id_mitra = $this->input->post('id_mitra');
       $tahun_angkatan = $this->input->post('tahun_angkatan');
       
       $cek = $this->db->get_where('tahun_angkatan',array('id_mitra' => $id_mitra, 'tahun_angkatan' => $tahun_angkatan))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Tahun Angkatan Sudah Tersedia');
       }else{
           $data = array('id_mitra' => $id_mitra, 'tahun_angkatan' => $tahun_angkatan);
           $this->db->insert('tahun_angkatan',$data);
           $this->session->set_flashdata('success', 'Tahun Angkatan Berhasil Ditambahkan');
       }
        redirect('sekolah/kelola-tahun-angkatan');
    }
    
    
    
    ///////////////////////////////////////////// END TAHUN ANGKATAN/////////////////////////////////////////
    
    ///////////////////////////////////////////// START JURUSAN ////////////////////////////////////////////
    
     public function jurusan()
    {
        $data['page'] = 'Kelola Jurusan';
        $data['menu'] = 'Jurusan';
        $data['edit_jurusan'] = site_url('sekolah/edit_jurusan');
        $data['tambah_jurusan'] = site_url('sekolah/tambah_jurusan');
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        
        if($data['id']){
        $get_data = $this->SekolahModel->getJurusan($data['id']);
        }else{
        $get_data = ['data' => null, 'status' => 0];
        }
        
        // echo json_encode($get);
        // die;
        
        $result = [];
        if($get_data['status'] == 1){
            if($get_data['data'] == null){
                $get_jur = $this->db->get_where('jurusan',array('id_mitra' => $data['id']))->row();
                $result[$get_jur->id] = 
                ['id_jurusan' => $get_jur->id, 'jurusan' => $get_jur->nama, 'kelasX'=> 0,'kelasXI' => 0, 'kelasXII' => 0];
            }else{
                
            foreach($get_data['data'] as $keys => $v){
             $key = $v->id_jurusan;
              if(!isset($result[$key])){
                $result[$key] = ['id_jurusan' => $key, 'jurusan' => $v->jurusan, 'kelasX' => $v->jum,'kelasXI' => 0, 'kelasXII' => 0,];
              }else{
                 if($v->kelas_siswa == 'XI'){
                    $result[$key]['kelasXI'] = $v->jum;
                 }else{
                    $result[$key]['kelasXII'] = $v->jum;
                 }
              }
            }
          }  
        }
        
       
        $data['data'] = $result;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/jurusan/index');
    }
    

    public function tambah_jurusan()
    {
       $id_mitra = $this->input->post('id_mitra');
       $jurusan = $this->input->post('jurusan');
       
       $cek = $this->db->get_where('jurusan',array('id_mitra' => $id_mitra, 'nama' => $jurusan))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Jurusan Sudah Tersedia');
       }else{
           $data = array('id_mitra' => $id_mitra, 'nama' => $jurusan);
           $this->db->insert('jurusan',$data);
           $this->session->set_flashdata('success', 'Jurusan Berhasil Ditambahkan');
       }
        redirect('sekolah/kelola-jurusan');
    }
    
    public function edit_jurusan()
    {
       $id_mitra = $this->input->post('id_mitra');
       $id = $this->input->post('id');
       $jurusan = $this->input->post('jurusan');
       
       $cek = $this->db->get_where('jurusan',array('id_mitra' => $id_mitra, 'nama' => $jurusan))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Jurusan '.$jurusan.' Sudah Tersedia');
       }else{
           $data = array('nama' => $jurusan);
           $this->db->where('id',$id);
           $this->db->update('jurusan',$data);
           $this->session->set_flashdata('success', 'Jurusan Berhasil Diedit');
       }
        redirect('sekolah/kelola-jurusan');
    }
    
    
    /////////////////////////////////////////////// END JURUSAN ////////////////////////////////////////////
    
     ///////////////////////////////////////////// START KELAS ////////////////////////////////////////////
    
     public function kelas()
    {
        $data['page'] = 'Kelola Kelas';
        $data['menu'] = 'Kelas';
        $data['edit_kelas'] = site_url('sekolah/edit_kelas');
        $data['tambah_kelas'] = site_url('sekolah/tambah_kelas');
        $data['kelola_kelas'] = site_url('sekolah/kelola_kelas');
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        $data['jurusan'] =  $this->db->get_where('jurusan',array('id_mitra' => $data['id']))->result();
        
        $data['data'] = $this->SekolahModel->getKelas($data['id']);
        // echo json_encode($data['data']);
        // die;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/kelas/index');
    }
    
    public function get_kelas()
  {
    $id  = $this->input->get('id');
    $id_mitra = $this->session->userdata('admin')['account_id'];
    // $kelas = '';
    if($id == 1){
        $kelas = 'X';
    }elseif ($id == 2) {
        $kelas = 'XI';
    }elseif ($id == 3){
        $kelas = 'XII';
    }
    $data = $this->db->get_where('candidates', array('account_id' => $id_mitra,'kelas_siswa' => $kelas))->result();
    echo json_encode($data);
  }
    

    public function tambah_kelas()
    {
       $id_mitra = $this->input->post('id_mitra');
       $id_jurusan = $this->input->post('id_jurusan');
       $kelas = $this->input->post('kelas');
       $nama_kelas = $this->input->post('nama_kelas');
       
       $cek = $this->db->get_where('kelas',array('id_mitra' => $id_mitra, 'kelas' => $kelas, 'id_jurusan' => $id_jurusan, 'nama' => $nama_kelas))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Kelas yang Sama Sudah Tersedia');
       }else{
           $data = array('id_mitra' => $id_mitra,'id_jurusan' => $id_jurusan, 'kelas' => $kelas, 'nama' => $nama_kelas);
           $this->db->insert('kelas',$data);
           $this->session->set_flashdata('success', 'Kelas Berhasil Ditambahkan');
       }
        redirect('sekolah/kelola-kelas');
    }
    
    
    public function kelola_kelas()
    {
       $id_mitra = $this->input->post('id_mitra');
       $status = $this->input->post('status');
       $siswa = $this->input->post('siswa');
       
       if($status == 1){
       $data_siswa = array();
       if(empty($siswa)){
       $get_data_siswa = $this->db->get_where('candidates',array('account_id' => $id_mitra, 'kelas_siswa' => 'X'))->result();
       if($get_data_siswa){
        foreach ($get_data_siswa as $key => $value) {
            $get_kelas = $this->db->get_where('kelas',array('id_mitra' => $id_mitra, 'kelas' => 'XI', 'id_jurusan' => $value->id_jurusan))->row();
            if(!empty($get_kelas)){
            $data_siswa[] = array('candidate_id' => $value->candidate_id ,'id_kelas' => $get_kelas->id, 'kelas_siswa' => 'XI');
            }else{
            $data_siswa[] = array('candidate_id' => '' ,'id_kelas' => '', 'kelas_siswa' => '');
            break;
            }
        }
       $this->db->update_batch('candidates', $data_siswa, 'candidate_id');
       }
       }else{
        foreach ($siswa as $val){
            $this->db->where('candidate_id !=',$val);
        }
        $get_data_siswa = $this->db->get_where('candidates',array('account_id' => $id_mitra, 'kelas_siswa' => 'X'))->result();
        if($get_data_siswa){
        foreach ($get_data_siswa as $key => $value) {
            $get_kelas = $this->db->get_where('kelas',array('id_mitra' => $id_mitra, 'kelas' => 'XI', 'id_jurusan' => $value->id_jurusan))->row();
            if(!empty($get_kelas)){
            $data_siswa[] = array('candidate_id' =>  $value->candidate_id  ,'id_kelas' => $get_kelas->id, 'kelas_siswa' => 'XI');
            }else{
            $data_siswa[] = array('candidate_id' => '' ,'id_kelas' => '', 'kelas_siswa' => '');
            break;
            }
        }
       $this->db->update_batch('candidates', $data_siswa, 'candidate_id');
       }
       }
       }else if($status == 2){
       $data_siswa = array();
       if(empty($siswa)){
       $get_data_siswa = $this->db->get_where('candidates',array('account_id' => $id_mitra, 'kelas_siswa' => 'XI'))->result();
       if($get_data_siswa){
        foreach ($get_data_siswa as $key => $value) {
            $get_kelas = $this->db->get_where('kelas',array('id_mitra' => $id_mitra, 'kelas' => 'XII', 'id_jurusan' => $value->id_jurusan))->row();
            if(!empty($get_kelas)){
            $data_siswa[] = array('candidate_id' => $value->candidate_id ,'id_kelas' => $get_kelas->id, 'kelas_siswa' => 'XII');
            }else{
            $data_siswa[] = array('candidate_id' => '' ,'id_kelas' => '', 'kelas_siswa' => '');
            break;
            }
        }
       $this->db->update_batch('candidates', $data_siswa, 'candidate_id');   
       }
       }else{
         foreach ($siswa as $val){
            $this->db->where('candidate_id !=',$val);
        }
        $get_data_siswa = $this->db->get_where('candidates',array('account_id' => $id_mitra, 'kelas_siswa' => 'XI'))->result();
        if($get_data_siswa){
        foreach ($get_data_siswa as $key => $value) {
            $get_kelas = $this->db->get_where('kelas',array('id_mitra' => $id_mitra, 'kelas' => 'XII', 'id_jurusan' => $value->id_jurusan))->row();
            if(!empty($get_kelas)){
            $data_siswa[] = array('candidate_id' =>  $value->candidate_id  ,'id_kelas' => $get_kelas->id, 'kelas_siswa' => 'XII');
            }else{
            $data_siswa[] = array('candidate_id' => '' ,'id_kelas' => '', 'kelas_siswa' => '');
            break;
            }
        }
       $this->db->update_batch('candidates', $data_siswa, 'candidate_id');
       }
       }
       }else{
        $data_siswa = array();
       if(empty($siswa)){
       $get_data_siswa = $this->db->get_where('candidates',array('account_id' => $id_mitra, 'kelas_siswa' => 'XII'))->result();
       if($get_data_siswa){
        foreach ($get_data_siswa as $key => $value) {
            $data_siswa[] = array('candidate_id' => $value->candidate_id ,'id_kelas' => '', 'kelas_siswa' => '');
        }
       $this->db->update_batch('candidates', $data_siswa, 'candidate_id');   
       }
       }else{
         foreach ($siswa as $val){
            $this->db->where('candidate_id !=',$val);
        }
        $get_data_siswa = $this->db->get_where('candidates',array('account_id' => $id_mitra, 'kelas_siswa' => 'XII'))->result();
        if($get_data_siswa){
        foreach ($get_data_siswa as $key => $value) {
            $data_siswa[] = array('candidate_id' =>  $value->candidate_id  ,'id_kelas' => '', 'kelas_siswa' => '');
        }
       $this->db->update_batch('candidates', $data_siswa, 'candidate_id');
       }
       }
       }
       
        $this->session->set_flashdata('success', 'Berhasil Kelola Kelas');
        redirect('sekolah/kelola-kelas');
    }
    
    public function edit_kelas()
    {
       $id = $this->input->post('id');
       $id_mitra = $this->input->post('id_mitra');
       $id_jurusan = $this->input->post('id_jurusan');
       $kelas = $this->input->post('kelas');
       $nama_kelas = $this->input->post('nama_kelas');
       
       $cek = $this->db->get_where('kelas',array('id_mitra' => $id_mitra,'id_jurusan' => $id_jurusan, 'kelas' => $kelas, 'nama' => $nama_kelas))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Kelas '.$nama_kelas.' Sudah Tersedia');
       }else{
           $data = array('kelas' => $kelas, 'id_jurusan' => $id_jurusan, 'nama' => $nama_kelas);
           $this->db->where('id',$id);
           $this->db->update('kelas',$data);
           $this->session->set_flashdata('success', 'Kelas Berhasil Diedit');
       }
        redirect('sekolah/kelola-kelas');
    }
    
    
    /////////////////////////////////////////////// END KELAS ////////////////////////////////////////////
    
    /////////////////////////////////////////////// START LINK ////////////////////////////////////////////
    
    public function link_pendaftaran()
    {
        $data['page'] = 'Kelola Link Pendaftaran';
        $data['menu'] = 'LinkPendaftaran';
        $data['link'] =  $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row();
       
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/link_pendaftaran');
    }
    
    
    /////////////////////////////////////////////// END LINK ////////////////////////////////////////////
    
     /////////////////////////////////////////////// START SISWA ////////////////////////////////////////////
    
    public function siswa()
    {
        $data['page'] = 'Kelola Siswa';
        $data['menu'] = 'Siswa';
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        $data['data'] = $this->SekolahModel->getSiswa($data['id']);
       
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/siswa/index');
    }
    
    public function siswa_pertahun($id)
    {
        $id = decode($id);
        $data['page'] = 'Kelola Siswa';
        $data['menu'] = 'Siswa';
        $data['tahun'] = $this->db->get_where('tahun_angkatan',array('id'=>$id))->row();
        $data['sekolah'] = $this->db->get_where('user_mitra',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->row();
        $data['jurusan'] = $this->db->get_where('jurusan',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->result();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/siswa/kelola');
    }
    
     public function siswa_bkk()
    {
        // $id = decode($id);
        $data['page'] = 'Kelola Data BKK';
        $data['menu'] = 'SiswaBKK';
        // $data['tahun'] = $this->db->get_where('tahun_angkatan',array('id'=>$id))->row();
        $data['sekolah'] = $this->db->get_where('user_mitra',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->row();
        $data['jurusan'] = $this->db->get_where('jurusan',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->result();
        // $data['kelas'] = $this->db->get_where('kelas',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->result();
        $data['tahun'] = $this->db->get_where('tahun_angkatan',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->result();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/siswa/kelola-bkk');
    }
    
    public function data()
    {
        echo json_encode($this->SekolahModel->candidatesList());
        
    }
    
     public function data_bkk()
    {
        $id_sekolah = $this->session->userdata('admin')['account_id'];
        echo json_encode($this->SekolahModel->candidatesListBKK($id_sekolah));
        
    }
    
    
    /////////////////////////////////////////////// END SISWA ////////////////////////////////////////////
    
     /////////////////////////////////////////////// START TES KOMPETENSI ////////////////////////////////////////////
    
    public function tes_kompetensi()
    {
        $data['page'] = 'Tes Kompetensi Siswa';
        $data['menu'] = 'Kompetensi';
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        $data['data'] = $this->SekolahModel->getTesKompetensi($data['id']);
       
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/kompetensi/index');
    }
    
    public function kelola_tes_kompetensi($id)
    {
        $id = decode($id);
        $data['page'] = 'Kelola Tes Kompetensi';
        $data['menu'] = 'Kompetensi';
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        $data['data'] = $this->SekolahModel->getTesKompetensi($data['id']);
        $data['tahun'] = $this->db->get_where('tahun_angkatan',array('id'=>$id))->row();
        $data['sekolah'] = $this->db->get_where('user_mitra',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->row();
        $data['jurusan'] = $this->db->get_where('jurusan',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->result();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/kompetensi/kelola');
    }
    
    public function data_kompetensi()
    {
        echo json_encode($this->SekolahModel->candidatesListTes());
        
    }
    
    
    /////////////////////////////////////////////// END KOMPETENSI ////////////////////////////////////////////
    
    
    /////////////////////////////////////////////// START TES PSIKOLOGI ////////////////////////////////////////////
    
    public function tes_psikologi()
    {
        $data['page'] = 'Tes Psikologi Siswa';
        $data['menu'] = 'Psikologi';
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        $data['data'] = $this->SekolahModel->getTesPsikologi($data['id']);
       
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/psikologi/index');
    }
    
    public function kelola_tes_psikologi($id)
    {
        $id = decode($id);
        $data['page'] = 'Kelola Tes Psikologi';
        $data['menu'] = 'Psikologi';
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        $data['data'] = $this->SekolahModel->getTesKompetensi($data['id']);
        $data['tahun'] = $this->db->get_where('tahun_angkatan',array('id'=>$id))->row();
        $data['sekolah'] = $this->db->get_where('user_mitra',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->row();
        $data['jurusan'] = $this->db->get_where('jurusan',array('id_mitra'=>$this->session->userdata('admin')['account_id']))->result();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/psikologi/kelola');
    }
    
    public function data_psikologi()
    {
        echo json_encode($this->SekolahModel->candidatesListPsikologi());
        
    }
    
    
    /////////////////////////////////////////////// END PSIKOLOGI ////////////////////////////////////////////
    
    
     /////////////////////////////////////////////// START TES PSIKOLOGI ////////////////////////////////////////////
    
    public function tes_akhir()
    {
        $data['page'] = 'Penyaluran Siswa';
        $data['menu'] = 'Akhir';
        $data['id'] =  $this->session->userdata('admin')['account_id'];
        $data['data'] = $this->SekolahModel->getTesAkhir($data['id']);
       
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/tes_akhir/index');
    }
    
    
    /////////////////////////////////////////////// END PSIKOLOGI ////////////////////////////////////////////
    
}
