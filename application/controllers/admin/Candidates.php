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
      public function import_siswa()
    {
       $date = date('Y-m-d H:i:s');
        $id_mitra = $this->input->post('id_mitra');
        // $tahun_angkatan = $this->input->post('tahun_angkatan');
        // echo $tahun_angkatan;
        // die;
        $kelas = '';
// if ( isset($_POST['import'])) {

            $file = $_FILES['file']['tmp_name'];

			// Medapatkan ekstensi file csv yang akan diimport.
			$ekstensi  = explode('.', $_FILES['file']['name']);

			// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
			if (empty($file)) {
				echo 'File tidak boleh kosong!';
			} else {
				// Validasi apakah file yang diupload benar-benar file csv.
				if (strtolower(end($ekstensi)) === 'csv' && $_FILES["file"]["size"] > 0) {

					$i = 0;
					$handle = fopen($file, "r");
					while (($row = fgetcsv($handle, 2048))) {
						$i++;
						if ($i == 1) continue;
				// 		$row[0];
				// 		die;
						$get_kelas = $this->db->get_where('kelas',array('id' => $row[1]))->row();
						
						if(!empty($get_kelas)){
						    $kelas = $get_kelas->kelas;
						}else{
						    $kelas = '';
						}
						
						$data = [
							'account_id' => $id_mitra,
							'id_jurusan' => $row[0],
							'id_kelas' => $row[1],
							'id_tahun_angkatan' => 8,
							'first_name' => $row[2],
							'email' => $row[3],
							'password' => '25d55ad283aa400af464c76d713c07adf89c848fa',
							'nis' => $row[4],
							'kelas_siswa' => $kelas,
							'status' => 1,
							'jenis_user' => 1,
							'account_type' => 'siswa',
							'created_at' => $date
						];

                        $cekawal = $this->db->get_where('candidates',array('email' => $row[3]))->row();
                        if(!empty($cekawal)){
                        // return false;
                        // exit();
                        // echo 'da';
                        $this->session->set_flashdata('error', 'Data Gagal DIIMPORT ! Data terakhir diimport <h3><b>'.$row[2].'</b></h3>');
                        redirect('admin/mitra_vokasi');
                        }else{
						$this->db->insert('candidates',$data);
						
						 $cek = $this->db->get_where('candidates', array('email' => $row[3]))->row();
                        //  $id_kandidat = $cek->candidate_id;
                         $data2 = array(
                            'candidate_id' => $cek->candidate_id,
                            'status' => 1,
                            'file' => '',
                            'type' => 'detailed',
                            'is_default' => 1,
                            'created_at' => $date
                          );
                          $this->db->insert('resumes',$data2);
                          
                          $data3 = array(
                              'candidate_id' => $cek->candidate_id,
                              'ig' => '',
                              'yt' => '',
                              'fb' => '',
                              'linkedln' => '',
                              'tiktok' => '',
                              'twitter' => '',
                          );
                  
                        $this->db->insert('medsos',$data3);
                  
                                // return true;
                        }
					}

					fclose($handle);
					
                    $this->session->set_flashdata('success', 'Data Berhasil DIIMPORT ! ');
    
				} else {
				    
                    $this->session->set_flashdata('error', 'Data Gagal DIIMPORT ! , Format Salah');
				    
				}
			}
    redirect('admin/mitra_vokasi');
    }
// }
    public function listView()
    {
        $data['page'] = 'User';
        $data['menu'] = 'candidates';
        $data['sekolah'] = $this->db->get_where('user_mitra',array('status_mitra' => 1))->result();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/candidates/list');
    }
    
    public function pengalaman()
    {
        $data['page'] = 'Kelola Pengalaman';
        $data['menu'] = 'pengalaman';
        $data['edit_pengalaman'] = site_url('edit_pengalaman');
        $data['tambah_pengalaman'] = site_url('tambah_pengalaman');
        $data['data'] = $this->db->get('pengalaman')->result();
        // echo json_encode($data['data']);
        // die;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/candidates/pengalaman');
    }
    
     public function tandai_bkk($status,$id)
    {
       $id = decode($id);
       $this->db->where('candidate_id',$id);
       $this->db->update('candidates',array('status_siswa_bkk' => $status));
       redirect('admin/candidates');
    }
    
  
    public function detail_siswa($id)
    {
        $data['page'] = 'Detail Siswa';
        $data['menu'] = '';
        $id = decode($id);
        // echo $id;
        // die;
        
        $resume = $this->db->get_where('resumes',array('candidate_id' => $id))->row(); 
        $data['user'] = $this->db->get_where('candidates',array('candidate_id' => $id))->row();
        $data['pengalaman'] = $this->db->get_where('resume_achievements',array('resume_id' => $resume->resume_id))->result();
        
        $data['skill'] = $this->db->select('resume_languages.*, skill.jenis as jenis')
                                ->from('resume_languages')
                                ->where('resume_languages.resume_id',$resume->resume_id)
                                ->join('skill','skill.id = resume_languages.proficiency','left')
                                ->get()->result();
        
        $data['medsos'] = $this->db->get_where('medsos',array('candidate_id' => $id))->row_array();
        
        if(empty($data['medsos'])){
            $data['medsos']['ig'] = 'Belum Terisi';
            $data['medsos']['twitter'] = 'Belum Terisi';
            $data['medsos']['tiktok'] = 'Belum Terisi';
            $data['medsos']['fb'] = 'Belum Terisi'    ;
            $data['medsos']['yt'] = 'Belum Terisi';
            $data['medsos']['linkedln'] = 'Belum Terisi';
        }
        
        // $data['kegiatan'] = $this->db->get_where('kegiatan',array('candidate_id' => $candidate_id))->result();
        $data['hoby'] = $this->db->get_where('hoby',array('candidate_id' => $id))->result();
        $data['tes'] = $this->db->select('job_applications.*, jobs.title as judul')
                                ->from('job_applications')
                                ->where('job_applications.candidate_id',$id)
                                ->join('jobs','jobs.job_id = job_applications.job_id','left')
                                ->get()->result();
        
        $data['kelas'] = $this->db->get_where('kelas',array('id' => $data['user']->id_kelas))->row();
        // $data['kelas'] = $this->db->get_where('kelas',array('id' => $data['user']->id_kelas))->row();
        $data['jurusan'] = $this->db->get_where('jurusan',array('id' => $data['user']->id_jurusan))->row();
        $data['kegiatan'] = $this->db->get_where('kegiatan',array('candidate_id' => $id))->result();
        
        if(!empty($data['user']->provinsi)){
        $data['prov'] = $this->db->get_where('provinsi',array('id_prov' => $data['user']->provinsi))->row();
        }else{
        $data['prov'] = '';
        }
        
        if(!empty($data['user']->city)){
        $data['kab'] = $this->db->get_where('kabupaten',array('id_kab' => $data['user']->city))->row();
        }else{
        $data['kab'] = '';
        }
        
        if(!empty($data['user']->state)){
        $data['kec'] = $this->db->get_where('kecamatan',array('id_kec' => $data['user']->state))->row();
        }else{
        $data['kec'] = '';
        }
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sekolah/siswa/detail_siswa');
    }
    
     public function tambah_pengalaman()
    {
       $jenis = $this->input->post('jenis');
       
       $cek = $this->db->get_where('pengalaman',array('jenis' => $jenis))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Pengalaman Sudah Tersedia');
       }else{
           $data = array('jenis' => $jenis,'status' => 1);
           $this->db->insert('pengalaman',$data);
           $this->session->set_flashdata('success', 'Pengalaman Berhasil Ditambahkan');
       }
        redirect('admin/kelola-pengalaman');
    }
    
    public function edit_pengalaman()
    {
       $jenis = $this->input->post('jenis');
       $id = $this->input->post('id');
       
       $cek = $this->db->get_where('pengalaman',array('jenis' => $jenis, 'id !=' => $id))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Pengalaman Sudah Tersedia');
       }else{
           $data = array('jenis' => $jenis);
           $this->db->where('id',$id);
           $this->db->update('pengalaman',$data);
           $this->session->set_flashdata('success', 'Pengalaman Berhasil Diubah');
       }
        redirect('admin/kelola-pengalaman');
    }
    
    public function status_pengalaman($id,$status)
    {
       $id = decode($id);
       $cek = $this->db->get_where('pengalaman',array('id' => $id))->num_rows();
       if($cek <= 0){
            $this->session->set_flashdata('error', 'Status Pengalaman Gagal Diubah');
       }else{
           $data = array('status' => $status);
           $this->db->where('id',$id);
           $this->db->update('pengalaman',$data);
           $this->session->set_flashdata('success', 'Status Pengalaman Berhasil Diubah');
       }
        redirect('admin/kelola-pengalaman');
    }
    
    public function skill()
    {
        $data['page'] = 'Kelola Skill';
        $data['menu'] = 'skill';
        $data['edit_skill'] = site_url('edit_skill');
        $data['tambah_skill'] = site_url('tambah_skill');
        $data['data'] = $this->db->get('skill')->result();
        // echo json_encode($data['data']);
        // die;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/candidates/skill');
    }
    
    public function tambah_skill()
    {
       $jenis = $this->input->post('jenis');
       
       $cek = $this->db->get_where('skill',array('jenis' => $jenis))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Skill Sudah Tersedia');
       }else{
           $data = array('jenis' => $jenis,'status' => 1);
           $this->db->insert('skill',$data);
           $this->session->set_flashdata('success', 'Skill Berhasil Ditambahkan');
       }
        redirect('admin/kelola-skill');
    }
    
    public function edit_skill()
    {
       $jenis = $this->input->post('jenis');
       $id = $this->input->post('id');
       
       $cek = $this->db->get_where('skill',array('jenis' => $jenis, 'id !=' => $id))->num_rows();
       if($cek > 0){
            $this->session->set_flashdata('error', 'Skill Sudah Tersedia');
       }else{
           $data = array('jenis' => $jenis);
           $this->db->where('id',$id);
           $this->db->update('skill',$data);
           $this->session->set_flashdata('success', 'Skill Berhasil Diubah');
       }
        redirect('admin/kelola-skill');
    }
    
    public function status_skill($id,$status)
    {
       $id = decode($id);
       $cek = $this->db->get_where('skill',array('id' => $id))->num_rows();
       if($cek <= 0){
            $this->session->set_flashdata('error', 'Status Skill Gagal Diubah');
       }else{
           $data = array('status' => $status);
           $this->db->where('id',$id);
           $this->db->update('skill',$data);
           $this->session->set_flashdata('success', 'Status Skill Berhasil Diubah');
       }
        redirect('admin/kelola-skill');
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
    
    public function detail_psikogram()
    {
    $id  = $this->input->get('id');
    $data1 = $this->db->select('nilai_psiko.*, grey_psiko.pola, grey_psiko.grey')
                     ->from('nilai_psiko')
                     ->join('grey_psiko','grey_psiko.id = nilai_psiko.id_grey','left')
                     ->where('nilai_psiko.job_application_id',$id)
                     ->get()->result();
    
    $data2 = $this->db->select('job_applications.narasi_psiko,job_applications.status_tes')
                     ->from('job_applications')
                     ->where('job_applications.job_application_id',$id)
                     ->get()->row();
    $data = ['data_psiko' => $data1, 'data_rating' => $data2];                 
    echo json_encode($data);
    }
    
    
    public function kelola_psikogram()
    {
    $job_app_id = $this->input->post('job_app_id');
    $deskripsi = $this->input->post('deskripsi');
    $rating = $this->input->post('rating');
    $id = $this->input->post('id[]');
    $nilai = $this->input->post('nilai[]');
    
    // echo json_encode($id);
    // die;
    
    $get_job_id = $this->db->get_where('job_applications',array('job_application_id' => $job_app_id))->row();
    
    foreach ($id as $key => $value){
        $ids = $value;
        $nilais = $nilai[$key];
        $this->db->where('id',$ids);
        $this->db->update('nilai_psiko',array('nilai' => $nilais));
    }
    
    if($deskripsi != '' || $deskripsi != null){
    
    $this->db->where('job_application_id',$job_app_id);
    $this->db->update('job_applications',array('narasi_psiko' => $deskripsi,'status_tes' => $rating));
    }
    
    redirect('admin/job-board/'.$get_job_id->job_id);
    }
    
    public function psikogram($id)
    {
    $id  = decode($id);
    $data['nilai'] = $this->db->select('nilai_psiko.*, grey_psiko.pola, grey_psiko.grey')
                     ->from('nilai_psiko')
                     ->join('grey_psiko','grey_psiko.id = nilai_psiko.id_grey','left')
                     ->where('nilai_psiko.job_application_id',$id)
                     ->get()->result();
                     
    $data['candidate'] = $this->db->select('candidates.*,user_mitra.nama, job_applications.job_application_id,job_applications.narasi_psiko')
                     ->from('candidates')
                     ->join('job_applications','job_applications.candidate_id = candidates.candidate_id','left')
                     ->join('user_mitra','user_mitra.id_mitra = candidates.account_id','left')
                     ->where('job_applications.job_application_id',$id)
                     ->get()->row();
                     
//   $this->load->view('front/layout/header2', $pageData);
    $this->load->view('front/partials/psikogram', $data);
    
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

    public function resetPassword($candidate_id)
    {
        $this->checkIfDemo();
        $data = ['password' => makePassword('12345678')];
        $this->db->where('candidate_id', $candidate_id);
        $update = $this->db->update('candidates', $data);
        
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
        
        $data['lembaga'] = '';
        $data['jurusan'] = '';
        $data['status_lembaga'] = $data['resum']['divisi'];
        
        if($data['resum']['account_type'] == "vokasi"){
            $cek_sekolah = $this->db->get_where('user_mitra',array('id_mitra'=>$data['resum']['jabatan']))->row();
            if(!empty($cek_sekolah)){
                $data['lembaga'] = $cek_sekolah->nama;
            }else{
                $data['lembaga'] = $data['resum']['jabatan'];
            }
            
            switch ($data['resum']['jurusan']) 
            { 
                case 'akuntansi': 
                    $data['jurusan'] = "Akuntansi";
                    break; 
                case 'administrasi': 
                    $data['jurusan'] = "Administrasi Perkantoran";
                    break; 
                case 'marketing': 
                    $data['jurusan'] = "Marketing";
                    break; 
                case 'tkj': 
                    $data['jurusan'] = "Teknik Jaringan Komputer";
                    break;
                default: 
                    $data['jurusan'] = $data['resum']['jurusan'];
                    break; 
            } 
        }else{
             $data['lembaga'] = $data['resum']['jabatan'];
        }
        
        // $minat = $data['resum']['peminatan'];
        // $data['peminatan'] = $data['resum']['peminatan'];
        
        // $data['prov'] = $this->db->get_where('provinsi', array('id_prov' => $id_prov))->row();
        $kota = $this->db->get_where('kabupaten', array('id_kab' => $id_kab))->row();
        $kecamatan = $this->db->get_where('kecamatan', array('id_kec' => $id_kec))->row();
        $kelurahan = $this->db->get_where('kelurahan', array('id_kel' => $id_kel))->row();
        
        // $data['prov'] = $id_prov;
        
        if(!empty($kota)){
        $data['kota'] = $kota->nama;
        $data['kecamatan'] = $kecamatan->nama;
        $data['kelurahan'] = $kelurahan->nama;
        }else{
        $data['kota'] = $data['resum']['city'];
        $data['kecamatan'] = $data['resum']['state'];
        $data['kelurahan'] = $data['resum']['kelurahan'];
        }
        
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
        $excel->writer->saveFile('data_siswa');
        exit;
    }
}
