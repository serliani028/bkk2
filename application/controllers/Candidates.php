<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;

class Candidates extends CI_Controller
{
  /**
  * View function to display login page for candidate
  *
  * @return html/string
  */
  
   public function cek_nim(){
    $pageData['page'] = 'CEK NIM SISWA';
    $data['settings'] = setting();
    $data['action'] = base_url('proses_cek_nim');
  
    $this->load->view('front/layout/header2', $pageData);
    $this->load->view('front/cek_nim', $data);
    
  }
  
   public function proses_cek_nim(){
            $data_siswa = [];
            $file = $_FILES['file']['tmp_name'];
    		$ekstensi  = explode('.', $_FILES['file']['name']);
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
						$get_nim = $this->db->select('email')
						                    ->from('candidates')
						                    ->like('first_name',$row[0])
						                    ->get()->row();
						if(!empty($get_nim)){
						    $data_siswa[] = array('nama' => $row[0], 'email/nim' => $get_nim->email);
						}
					}

					fclose($handle);
					
					$data = sortForCSV(objToArr($data_siswa));
                    $excel = new SimpleExcel('csv');
                    $excel->writer->setData($data);
                    $excel->writer->saveFile('cek_nim_siswa');
                    exit;
    
				} else {
				    
                    $this->session->set_flashdata('error', 'Data Gagal DIIMPORT ! , Format Salah');
				    
				}
			}
			
        
   }
  
  
  public function loginView($slug = null)
  {
    $pageData['action'] = 'post-login';
    if (candidateSession()) {
      redirect('account');
    } else if ($this->input->cookie('remember_me_token_candidate' . appId(), TRUE)) {
      $candidateWithToken = $this->CandidateModel->getCandidateWithRememberMeToken(
        $this->input->cookie('remember_me_token_candidate' . appId())
      );
      if ($candidateWithToken) {
        $this->session->set_userdata(array('candidate' => objToArr($candidateWithToken)));
        redirect('account');
      } else {
        $this->logout();
      }
    }

    $pageData['page'] = 'Login | ' . setting('site-name');
    $data['settings'] = setting();
    $data['slug'] = $slug;

    if (setting('enable-google-login') == 'yes') {
      $client = $this->getGoogleClient();
      $data['googleLogin'] = $client->createAuthUrl();
    } else {
      $data['googleLogin'] = '';
    }

    if (setting('enable-linkedin-login') == 'yes') {
      $linkedinHelper = new LinkedinHelper();
      $data['linkedinLogin'] = $linkedinHelper->getLink();
    } else {
      $data['linkedinLogin'] = '';
    }

    $this->load->view('front/layout/header2', $pageData);
    $this->load->view('front/login', $data);
  }
  
  public function success_register()
  {
     $pageData['page'] = 'Register Sukses | ' . setting('site-name');
     $this->load->view('front/layout/header2', $pageData);
     $this->load->view('front/success');
   }

  /**
  * Post Function to process login request by candidate
  *
  * @return html/string
  */
  public function login()
  {
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('error', lang('email_and_or_password_was_invalid'));
    } else {
      $email = $this->xssCleanInput('email');
      $password = makePassword($this->xssCleanInput('password'));
      $candidate = $this->CandidateModel->login($email, $password);
      if ($candidate->status == '1') {
        $this->session->set_userdata(array('candidate' => objToArr($candidate)));
        $this->setRememberMe($email, $this->xssCleanInput('remember'));
        redirect('account');
      }else if($candidate->status == '0'){
          $this->session->set_flashdata('error', 'Akun belum aktif. Silahkan cek email Anda untuk aktivasi !!');
      } else {
        $this->session->set_flashdata('error', lang('email_and_or_password_was_invalid'));
      }
    }
    redirect('/login');
  }

  /**
  * View Function to display register page for candidate
  *
  * @return html/string
  */
  public function registerView($hal)
  {
    $pageData['action'] = 'regist';
    if (candidateSession()) {
      redirect('account');
    } else if ($this->input->cookie('remember_me_token_candidate' . appId(), TRUE)) {
      $candidateWithToken = $this->CandidateModel->getCandidateWithRememberMeToken(
        $this->input->cookie('remember_me_token_candidate' . appId())
      );
      if ($candidateWithToken) {
        $this->session->set_userdata(array('candidate' => objToArr($candidateWithToken)));
        redirect('account');
      } else {
        $this->logout();
      }
    }

    if (setting('enable-register') == 'yes') {
      $pageData['page'] = 'Register | ' . setting('site-name');
      
      $get_id = $this->db->get_where('user_mitra',array('link_siswa' => $hal))->row();
      
      if(!empty($get_id)) {
      $id_mitra = $get_id->id_mitra;
  
      $pageData['action'] = 'register_vokasi';
      $pageData['hal'] = $hal;
      $pageData['id_sekolah'] = $id_mitra;
      $pageData['nama_sekolah'] = $get_id->nama;
      $pageData['jurusan'] = $this->db->get_where('jurusan',array('id_mitra' => $id_mitra))->result();
      $pageData['tahun_angkatan'] = $this->db->get_where('tahun_angkatan',array('id_mitra' => $id_mitra))->result();
      
      $this->load->view('front/layout/header2', $pageData);
      $this->load->view('front/register_vokasi');
      }else{
          
    //   $this->load->view('front/layout/header2', $pageData);
      $this->load->view('front/404');
      }
        
    } else {
        
      $this->load->view('front/layout/header2', $pageData);
      $this->load->view('front/404');
    }
    
    
    
  }
  
  
  
   public function registerView_mitra()
  {
   $pageData['action'] = 'regist/mitra';
    if (candidateSession()) {
      redirect('account');
    } else if ($this->input->cookie('remember_me_token_candidate' . appId(), TRUE)) {
      $candidateWithToken = $this->CandidateModel->getCandidateWithRememberMeToken(
        $this->input->cookie('remember_me_token_candidate' . appId())
      );
      if ($candidateWithToken) {
        $this->session->set_userdata(array('candidate' => objToArr($candidateWithToken)));
        redirect('account');
      } else {
        $this->logout();
      }
    }

    if (setting('enable-register') == 'yes') {
      $pageData['page'] = 'Register Mitra | ' . setting('site-name');
      
      $this->load->view('front/layout/header2', $pageData);
      $this->load->view('front/register');
     } else {
        
      $this->load->view('front/layout/header2', $pageData);
      $this->load->view('front/404');
    }
    
  }
  
 public function get_kelas(){
    $id_sekolah = $this->input->get('id_sekolah');
    $id_jurusan = $this->input->get('id_jurusan');
    $id_kelas = $this->input->get('id_kelas');
    if($id_kelas == ''){
    $data = $this->db->get_where('kelas', array('id_mitra' => $id_sekolah, 'id_jurusan' => $id_jurusan))->result();
    }elseif ($id_jurusan == ''){
    $data = $this->db->get_where('kelas', array('id_mitra' => $id_sekolah, 'kelas' => $id_kelas))->result();    
    }else if($id_kelas != '' && $id_jurusan != ''){
    $data = $this->db->get_where('kelas', array('id_mitra' => $id_sekolah, 'kelas' => $id_kelas, 'id_jurusan' => $id_jurusan))->result();
    }else{
    $data = 200;
    }
    echo json_encode($data);
  }

      public function register_vokasi()
  {
      $hal = $this->input->post('hal');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
      $this->form_validation->set_rules('phone1', 'Phone', 'required|numeric|is_unique[candidates.phone1]', array('is_unique' => 'Nomor Sudah Terdaftar','numeric' => 'Isikan Nomor Telepon dengan Angka'));
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[candidates.email]', array('is_unique' => 'Email Sudah Terdaftar'));
      $this->form_validation->set_rules('nis', 'Nis', 'required|numeric|is_unique[candidates.nis]', array('numeric' => 'NIS hanya bisa diisikan angka','is_unique' => 'NIS Sudah Terdaftar' ));
      $this->form_validation->set_rules('password', 'Password', 'min_length[8]|required', array('min_length' => 'Password Minimal 8 Karakter'));
      $this->form_validation->set_rules('repassword', 'Confirm Password', 'min_length[8]|required|matches[password]', array('matches' => 'Password Tidak Cocok'));

      if ($this->form_validation->run() === FALSE) {
          $this->session->set_flashdata('error', validation_errors());
          
          redirect('register/'.$hal);
       } else {
                $kar = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789'; 
                $token = str_shuffle($kar);

                  $data = array(
                    'account_id' => $this->input->post('id_sekolah'),
                    'id_tahun_angkatan' => $this->input->post('id_tahun_angkatan'),
                    'id_jurusan' => $this->input->post('id_jurusan'),
                    'id_kelas' => $this->input->post('id_kelas'),
                    'first_name' => $this->input->post('first_name'),
                    'phone1' => $this->input->post('phone1'),
                    'email' => $this->input->post('email'),
                    'kelas_siswa' => $this->input->post('kelas_siswa'),
                    'nis' => $this->input->post('nis'),
                    'password' => makePassword($this->input->post('password')),
                    'status' => 1,
                    'jenis_user' => 1,
                    'account_type' => 'siswa',
                    'token' =>   $token,
                    'created_at' => date('Y-m-d H:i:s')
                  );

                  $this->db->insert('candidates',$data);

                  $cek = $this->db->get_where('candidates', array('email' => $this->input->post('email')))->row();
                  $id_kandidat = $cek->candidate_id;
                  $data2 = array(
                    'candidate_id' => $id_kandidat,
                    'status' => 1,
                    'file' => 'vokasi',
                    'type' => 'detailed',
                    'is_default' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                  );
                  $cek = $this->db->insert('resumes',$data2);
                  
                  $data3 = array(
                      'candidate_id' => $id_kandidat,
                      'ig' => '',
                      'yt' => '',
                      'fb' => '',
                      'linkedln' => '',
                      'tiktok' => '',
                      'twitter' => '',
                  );
                  
                  $this->db->insert('medsos',$data3);
                  
                  if($cek){
                  
                      $emails = $this->input->post('email');
                      $passwords = makePassword($this->input->post('password'));
                      $candidate = $this->CandidateModel->login($emails, $passwords);
                      $this->session->set_userdata(array('candidate' => objToArr($candidate)));
                      $this->setRememberMe($email, $this->xssCleanInput('remember'));
                      redirect('account');
     
                  }else{
                 $this->session->set_flashdata('error', 'Pendaftaran Gagal Silahkan Masukkan Data yang benar');
          
                  redirect('register/'.$hal);
                  }
                  
                //  redirect('success-register');
        } 
  }
  
  public function registerMitra()
  {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      
      $this->form_validation->set_rules('no_telp', 'Phone', 'required|max_length[13]|is_unique[user_mitra.no_telp]', array('is_unique' => 'Nomor Sudah Terdaftar'));
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user_mitra.email]', array('is_unique' => 'Email Sudah Terdaftar'));
      $this->form_validation->set_rules('nama', 'Nama', 'trim|required|is_unique[user_mitra.nama]', array('is_unique' => 'Nama Kampus Sudah Terdaftar'));
      $this->form_validation->set_rules('password', 'Password', 'min_length[8]|required', array('min_length' => 'Password Minimal 8 Karakter'));
      $this->form_validation->set_rules('retype_password', 'Confirm Password', 'min_length[8]|required|matches[password]', array('matches' => 'Password Tidak Cocok'));
      
      $this->form_validation->set_rules('no_telp', 'Phone', 'required|max_length[13]|is_unique[users.phone]', array('is_unique' => 'Nomor Sudah Terdaftar'));
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', array('is_unique' => 'Email Sudah Terdaftar'));
      $this->form_validation->set_rules('nama', 'Nama', 'trim|required|is_unique[users.first_name]', array('is_unique' => 'Nama Kampus Sudah Terdaftar'));

      if ($this->form_validation->run() === FALSE) {
          $this->session->set_flashdata('error', validation_errors());
          redirect('register-mitra');
       } else {
           
                  $data = array(
                    'nama' => $this->input->post('nama'),
                    'no_telp' => $this->input->post('no_telp'),
                    'email' => $this->input->post('email'),
                    'password' => makePassword($this->input->post('password')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'status_mitra' => 0,
                    'status' => 1,
                    'role_mitra' => 8
                  );

                  $cek = $this->db->insert('user_mitra',$data);
                  
                if($cek){
                $get_id = $this->db->get_where('user_mitra',array('email' => $email, 'password' => makePassword($password) ))->row();
                if(!empty($get_id)){
                
                $datax = array(
                    'account_id' => $get_id->id_mitra,
                    'first_name' => $this->input->post('nama'),
                    'username' => $this->input->post('email'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('no_telp'),
                    'password' => $get_id->password,
                    'status' => 1,
                    'user_type' => 'team',
                    'created_at' => date('Y-m-d H:i:s')
                );
                $cek_2 = $this->db->insert('users',$datax);
                
                if($cek_2){
                $get_id_users = $this->db->get_where('users',array('email' => $email, 'password' => makePassword($password) ))->row();
                $this->db->insert('user_roles',array('user_id' => $get_id_users->user_id, 'role_id' => 8));
                
                $user = objToArr($this->AdminUserModel->login($get_id->email, $get_id->password));
                if ($user) {
                $user['permissions'] = $this->AdminRoleModel->getUserPermissions($user['user_id']);
                $this->session->set_userdata(array('admin' => $user));
                $this->setRememberMe($email, $this->xssCleanInput('rememberme'));
                redirect('/admin/dashboard');
                } else {
                $this->session->set_flashdata('error', 'Pendaftaran Mitra Gagal, Silahkan coba lagi atau hubungi Team Support Kami !');
                redirect('register-mitra');
                }
                }else{
                $this->session->set_flashdata('error', 'Pendaftaran Mitra Gagal, Silahkan coba lagi atau hubungi Team Support Kami !');
                redirect('register-mitra');    
                }
                }else{
                $this->session->set_flashdata('error', 'Pendaftaran Mitra Gagal, Silahkan coba lagi atau hubungi Team Support Kami !');
                redirect('register-mitra');    
                }
                }else{
                $this->session->set_flashdata('error', 'Pendaftaran Mitra Gagal, Silahkan isi data dengan legkap !');
                redirect('register-mitra');
                }          
       }
  }

  /**
  * Private function to set remember me token for logged in user
  *
  * @return void
  */
  private function setRememberMe($email, $check)
  {
    if ($check) {
      $this->load->helper('cookie');
      $tokenValue = $email.'-'.strtotime(date('Y-m-d G:i:s'));
      $cookie = array(
        'name' => 'remember_me_token_candidate' . appId(),
        'value' => $tokenValue,
        'expire' => '1209600',// Two weeks
        'domain' => SITE_URL,
        'path' => '/'
      );
      $this->input->set_cookie($cookie);
      $this->CandidateModel->storeRememberMeToken($email, $tokenValue);
    }
  }
  
  ////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////TES ESAI///
  
  
   public function list_tes_esai($page = null)
  {
      
    $this->checkLogin();
        
    // $kandidat = $this->session->userdata('candidate')['candidate_id'];
    
    $id_k = $this->session->userdata('candidate')['candidate_id'];
    $get_resume = $this->db->get_where('resumes', array('candidate_id'=>$id_k))->row();
    $id = $get_resume->resume_id;
    $data['resume'] = $this->ResumeModel->getCompleteResume($id);
    $data['resumesz'] = $this->ResumeModel->getCompleteResume2($id);
    $data['resumes_profile'] = $this->db->get_where('resumes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
    $data['jumlah_quiz'] =  $this->QuizModel->getTotalQuiz();
    $data['jumlah_interview_internal'] =  $this->QuizModel->getTotalCandidateQuizes_not($id_k);
    
    
    $get_data = $this->db->get_where('candidate_interviews',array('candidate_id'=>$id_k))->result_array();
    
    $total = $this->JobModel->getTotalAppliedJobsEsai();
    $limit = 5;
    $data['pagination'] = $this->createPagination($page, '/account/tes-esai/', $total, $limit);
    // die;
    $data['esai'] = $get_data;
    $pageData['page'] = 'Tes Esai | ' . setting('site-name');
    $data['page'] = 'tes_esai';
    
    $this->load->view('front/layout/header', $pageData);
    $this->load->view('front/account-list-esai', $data);
  }
  
  public function tes_esai($ide)
  {
      
    $this->checkLogin();
    $ide = decode($ide);
    
    $id_k = $this->session->userdata('candidate')['candidate_id'];
    $get_resume = $this->db->get_where('resumes', array('candidate_id'=>$id_k))->row();
    $id = $get_resume->resume_id;
    $data['resume'] = $this->ResumeModel->getCompleteResume($id);
    $data['resumesz'] = $this->ResumeModel->getCompleteResume2($id);
    $data['resumes_profile'] = $this->db->get_where('resumes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
    $data['jumlah_quiz'] =  $this->QuizModel->getTotalQuiz();
    $data['jumlah_interview_internal'] =  $this->QuizModel->getTotalCandidateQuizes_not($id_k);
    
    $get_data = $this->db->get_where('candidate_interviews',array('candidate_interview_id'=>$ide))->row_array();
    // echo $id;
    // echo json_encode($get_data);
    // die;
    
    $esai = [];
    $interview = objToArr(json_decode($get_data['interview_data']));
    if($interview){
    foreach ($interview['questions'] as $key => $question) {
    array_push($esai,$question);
    }        
    }
    
    $data['candidate_interview_id'] = $get_data['candidate_interview_id'];
    $data['tes_esai'] = $get_data['interview_title'];
    $data['status'] = $get_data['status'];
    $data['esai'] = $esai;
    $data['action'] = 'account/post-tes-esai';
    
    $pageData['page'] = 'Tes Esai | ' . setting('site-name');
    $data['page'] = 'tes_esai';
    
    $this->load->view('front/layout/header', $pageData);
    $this->load->view('front/account-esai', $data);
  }
  
  public function post_esai()
    {
        $data = $this->xssCleanInput();

        // $interview = $this->getCandidateInterview('candidate_interview_id', $data['candidate_interview_id']);
        $result['answers_data'] = json_encode(arrangeSections(array('comment' => $data['comments'] )));
        $result['updated_at'] = date('Y-m-d G:i:s');
        $result['status'] = 1;
        $this->db->where('candidate_interview_id', $data['candidate_interview_id']);
        $this->db->update('candidate_interviews', $result);
        
        $this->session->set_flashdata('success', 'Tes Esai Telah Selesai ');
        redirect('account/tes-esai');
    }
  
  
  ////////////////////////////////////////////////////////////////////////////////////////////////////////

  /**
  * Function to process request for logout
  *
  * @return redirect
  */
  public function logout()
  {
    $this->session->unset_userdata('candidate');
    $this->session->set_flashdata('user_loggedout', lang('you_are_now_logged_out'));
    $this->load->helper('cookie');
    delete_cookie('remember_me_token_candidate' . appId(), SITE_URL, '/');
    redirect('/login');
  }

  /**
  * View Function to display register page for user
  *
  * @return html/string
  */
  public function showForgotPassword()
  {
    if (setting('enable-forgot-password') == 'yes') {
      $pageData['page'] = 'Lupa Password | ' . setting('site-name');
      $this->load->view('front/layout/header2', $pageData);
      $this->load->view('front/forgot-password');
    } else {
      redirect('404_override');
    }
  }

  /**
  * Function to display register page for user
  *
  * @return html/string
  */
  public function sendPasswordLink()
  {
    $this->checkIfDemo();
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if ($this->form_validation->run() === FALSE) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
      ));
    } elseif (!$this->CandidateModel->getFirst('candidates.email', $this->xssCleanInput('email'))) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => lang('email_does_not_exist')))
      ));
    } else {
      $this->CandidateModel->createTokenForCandidate($this->xssCleanInput('email'));
    //   $existingCandidate = $this->CandidateModel->getFirst('candidates.email', $this->xssCleanInput('email'));
    //   $this->sendEmail(
    //     $this->load->view('front/emails/forgot-password', $existingCandidate, TRUE),
    //     $existingCandidate['email'],
    //     'Create new password'
    //   );
    $email = $this->input->post('email');
    $data = array('password' => '25d55ad283aa400af464c76d713c07adf89c848fa');
    $this->db->where('email',$email);
    $this->db->update('candidates',$data);
      $message = '<b>Password Berhasil di reset menjadi Password default 12345678.</b><br> Silahkan Ubah Password anda setelah Berhasil login untuk keamanan akun Anda !';
      echo json_encode(array(
        'success' => 'true',
        'messages' => $this->ajaxErrorMessage(array('success' => $message))
      ));
    }
  }

  /**
  * View function to display password reset form by email
  *
  * @return redirect
  */
  public function resetPassword($token = null)
  {
      
    $data['token'] = $token;
    $pageData['page'] = 'Reset Password | ' . setting('site-name');
    $this->load->view('front/layout/header', $pageData);
    $this->load->view('front/reset-password', $data);
  }

  /**
  * Function (for ajax) to process password reset form request
  *
  * @return redirect
  */
  public function updatePasswordByForgot()
  {
    $this->checkIfDemo();
    $this->form_validation->set_rules('token', 'Token', 'required', array('required' => 'Token mismatch.'));
    $this->form_validation->set_rules('password', 'New Password', 'required');
    $this->form_validation->set_rules('retype_password', 'Confirm Password', 'required|matches[password]');

    if ($this->form_validation->run() === FALSE) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
      ));
    } elseif (!$this->CandidateModel->getFirst('candidates.token', $this->xssCleanInput('token'))) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => lang('token_mismatch')))
      ));
    } else {
      $this->CandidateModel->updatePasswordByField(
        'candidates.token',
        $this->xssCleanInput('token'),
        makePassword($this->xssCleanInput('password'))
      );
      echo json_encode(array(
        'success' => 'true',
        'messages' => $this->ajaxErrorMessage(array('success' => lang('password_updated')))
      ));
    }
  }
  
  public function download_cv($id)
    {
        ini_set('max_execution_time', '0');
        $id = decode($id);
        $resumes = '';
        $pengalaman = '';
        // echo $id;
        // die;
        // foreach ($ids as $id) {
        $resume = $this->db->get_where('resumes',array('candidate_id' => $id))->row(); 
        $data['resume'] = $this->db->get_where('candidates',array('candidate_id' => $id))->row();
        if($data['resume']->tentang != '' && $data['resume']->dob != '' && $data['resume']->provinsi != '' && $data['resume']->city != '' && $data['resume']->state != '' && $data['resume']->email != '' && $data['resume']->phone1 != '' && $data['resume']->address != '' && $data['resume']->image != ''){
        // echo $resume->tentang;
        // die;
        $data['pengalaman'] = $this->db->get_where('resume_achievements',array('resume_id' => $resume->resume_id))->result();
        $pengalaman = $data['pengalaman'];
        $data['skill'] = $this->db->select('resume_languages.*, skill.jenis as jenis')
                                ->from('resume_languages')
                                ->where('resume_languages.resume_id',$resume->resume_id)
                                ->join('skill','skill.id = resume_languages.proficiency','left')
                                ->get()->result();
                             
        $data['medsos'] = $this->db->get_where('medsos',array('candidate_id' => $id))->row();
        
        // if(!empty($medsos)){
        //     $data['medsos'] = $medsos;
        // }else{
        //     $data['medsos'] = ['ig' => ''];
        //     $data['medsos'] = ['ig' => ''];
        //     $data['medsos'] = ['ig' => ''];
        //     $data['medsos'] = ['ig' => ''];
        //     $data['medsos'] = ['ig' => ''];
        //     $data['medsos'] = ['ig' => ''];
        // }
        
        $data['hoby'] = $this->db->get_where('hoby',array('candidate_id' => $id))->result();
        $data['tes'] = $this->db->select('job_applications.*, jobs.title as judul')
                                ->from('job_applications')
                                ->where('job_applications.candidate_id',$id)
                                ->join('jobs','jobs.job_id = job_applications.job_id','left')
                                ->get()->result();
        
        $data['kelas'] = $this->db->get_where('kelas',array('id' => $data['resume']->id_kelas))->row();
        $data['jurusan'] = $this->db->get_where('jurusan',array('id' => $data['resume']->id_jurusan))->row();
        $data['kegiatan'] = $this->db->get_where('kegiatan',array('candidate_id' => $id))->result();
        
        $resumes = $this->load->view('front/resume-cv', $data, TRUE);
        // }
        
    //   die;
        $dompdf = new Dompdf();
        $dompdf->loadHtml($resumes);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('CV.pdf');
        exit;
        }else{    
        $this->session->set_flashdata('error', 'Gagal Download CV, Silahkan lengkapi Profil Anda');
        redirect('account/profile');
        }
    }

  public function get_kab()
  {
    $id  = $this->input->get('id');
    $data = $this->db->get_where('kabupaten', array('id_prov' => $id))->result();
    echo json_encode($data);
  }

  public function get_kec()
  {
    $id  = $this->input->get('id');
    $data = $this->db->get_where('kecamatan', array('id_kab' => $id))->result();
    echo json_encode($data);
  }
  
  public function get_kel()
  {
    $id  = $this->input->get('id');
    $data = $this->db->get_where('kelurahan', array('id_kel' => $id))->result();
    echo json_encode($data);
  }

  public function get_edit()
  {
    $id  = $this->input->get('id');
    $data = $this->db->select('candidates.provinsi, candidates.city, candidates.state')
                     ->from('candidates')
                     ->where('candidate_id',$id)
                     ->get()->result();
    echo json_encode($data);
  }

  /**
  * View Function to display profile update page for candidate
  *
  * @return html/string
  */
  public function updateProfileView($id = null)
  {
      
    $this->checkLogin();
    $data['provinsi'] = $this->db->get_where('provinsi')->result();
    
    $id_k = $this->session->userdata('candidate')['candidate_id'];
    $get_resume = $this->db->get_where('resumes', array('candidate_id'=>$id_k))->row();
    $id = $get_resume->resume_id;
    $data['resume'] = $this->ResumeModel->getCompleteResume($id);
    $data['resumesz'] = $this->ResumeModel->getCompleteResume2($id);
    $data['resumes_profile'] = $this->db->get_where('resumes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
    $data['jumlah_quiz'] =  $this->QuizModel->getTotalQuiz();
    $data['jumlah_interview_internal'] =  $this->QuizModel->getTotalCandidateQuizes_not($id_k);
    
        
    $candidateId = candidateSession();
    $pageData['page'] = 'Update Profile | ' . setting('site-name');
    $data['page'] = 'profile';
    $data['candidate'] = $this->CandidateModel->getFirst('candidates.candidate_id', $candidateId);
    $this->load->view('front/layout/header', $pageData);
    $this->load->view('front/account-profile', $data);
  }
  

  /**
  * Function (for ajax) to process profile update form request
  *
  * @return redirect
  */
  public function updateProfile()
  {
    $this->checkIfDemo();
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
    $this->form_validation->set_rules('phone1', 'Phone 1', 'max_length[13]|numeric','min_length[11]');
    $this->form_validation->set_rules('address', 'Address', 'min_length[3]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('nis', 'Nis', 'required');   
   
    $imageRes = $this->uploadImage(candidateSession()); 
   
    if ($this->form_validation->run() === FALSE) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
      ));
    } elseif ($this->CandidateModel->valueExist(
      'email',
      $this->xssCleanInput('email'),
      candidateSession()
    )) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => lang('email_already_exist')))
      ));
    } elseif ($imageRes['success'] == false) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => $imageRes['message']))
      ));
    }else {
      $this->CandidateModel->updateProfile($imageRes);
      echo json_encode(array(
        'success' => 'true',
        'messages' => $this->ajaxErrorMessage(array('success' => lang('profile_updated')))
      ));
    }
  }

  /**
  * Private function to upload user image if any
  *
  * @param integer $candidate_id
  * @return array
  */
  private function uploadImage($candidate_id = false)
  {
    if ($_FILES['image']['name'] != '') {
      $candidate = objToArr($this->CandidateModel->getFirst('candidates.candidate_id', $candidate_id));
      if ($candidate['image']) {
        $file = explode('.', $candidate['image']);
        //unlink(ASSET_ROOT.'/images/candidates/'.$candidate['image']);
        foreach (userImageDimensions() as $d) {
          $name = $file[0] . '-' . $d[0] . '-' . $d[1] . '.' . $file[1];
          @unlink(ASSET_ROOT . '/images/candidates/' . $name);
        }
      }
      $file = explode('.', $_FILES['image']['name']);
      $ext = $file[1];
      $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
      $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
      $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
      $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
      $config['file_name'] = $filename;
      $config['max_size'] = '1024';
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('image')) {
        return array(
          'success' => false,
          'message' => 'Foto Maksimal Berukuran 1 MB (Hanya PNG/JPG)'
        );
      } else {
        $data = $this->upload->data();
        return array('success' => true, 'file' => $data['file_name']);
      }
    }
    return array('success' => true, 'message' => '');
  }

  /**
  * View Function to display password update page for candidate
  *
  * @return html/string
  */
  public function updatePasswordView($id = null)
  {
      
    $this->checkLogin();
        
     $id_k = $this->session->userdata('candidate')['candidate_id'];
     $get_resume = $this->db->get_where('resumes', array('candidate_id'=>$id_k))->row();
     $id = $get_resume->resume_id;
     $data['resume'] = $this->ResumeModel->getCompleteResume($id);
     $data['resumesz'] = $this->ResumeModel->getCompleteResume2($id);
     $data['resumes_profile'] = $this->db->get_where('resumes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
     $data['jumlah_quiz'] =  $this->QuizModel->getTotalQuiz();
     $data['jumlah_interview_internal'] =  $this->QuizModel->getTotalCandidateQuizes_not($id_k);
        
    $pageData['page'] = lang('update_password').' | ' . setting('site-name');
    $data['page'] = 'password';
    $this->load->view('front/layout/header', $pageData);
    $this->load->view('front/account-password', $data);
    // $this->load->view('front/layout/footer');
  }

  public function updateHobby($id = null)
  {
      
    $this->checkLogin();
        
     $id_k = $this->session->userdata('candidate')['candidate_id'];
     $get_resume = $this->db->get_where('resumes', array('candidate_id'=>$id_k))->row();
     $id = $get_resume->resume_id;
     $data['resume'] = $this->ResumeModel->getCompleteResume($id);
     $data['resumesz'] = $this->ResumeModel->getCompleteResume2($id);
     $data['resumes_profile'] = $this->db->get_where('resumes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
     $data['jumlah_quiz'] =  $this->QuizModel->getTotalQuiz();
     $data['jumlah_interview_internal'] =  $this->QuizModel->getTotalCandidateQuizes_not($id_k);
     
     $data['hoby'] = $this->db->get_where('hoby',array('candidate_id' => $id_k))->result();
     $data['id'] = $id_k;
     $data['update_medsos'] = site_url('update_medsos');
     $data['tambah_hoby'] = site_url('tambah_hoby');
     $data['tambah_kegiatan'] = site_url('tambah_kegiatan');
     $medsos = $this->db->get_where('medsos',array('candidate_id' => $id_k))->row();
     $data['kegiatan'] = $this->db->get_where('kegiatan',array('candidate_id' => $id_k))->result();
     if(!empty($medsos)){
         $data['ig'] = $medsos->ig;
         $data['fb'] = $medsos->fb;
         $data['yt'] = $medsos->yt;
         $data['tiktok'] = $medsos->tiktok;
         $data['twitter'] = $medsos->twitter;
         $data['linkedln'] = $medsos->linkedln;
     }else{
         $data['ig'] = '';
         $data['fb'] = '';
         $data['yt'] = '';
         $data['tiktok'] = '';
         $data['twitter'] = '';
         $data['linkedln'] = '';
     }
    // echo json_encode($medsos);
    // die;
    $pageData['page'] = 'Hobi & Medsos | ' . setting('site-name');
    $data['page'] = 'hobby';
    $this->load->view('front/layout/header', $pageData);
    $this->load->view('front/account-hoby', $data);
    // $this->load->view('front/layout/footer');
  }
  
  public function updateMedsos($id = null)
  {
    $this->checkLogin();
    $id = $this->input->post('id');     
    
    $fb = $this->input->post('fb');     
    $yt = $this->input->post('yt');     
    $twitter = $this->input->post('twitter');     
    $ig = $this->input->post('ig');     
    $linkedln = $this->input->post('linkedln');
    $tiktok = $this->input->post('tiktok');
    
    $data = array(
        'ig' => $ig,
        'fb' => $fb,
        'yt' => $yt,
        'linkedln' => $linkedln,
        'twitter' => $twitter,
        'tiktok' => $tiktok,
        );
    $cek_data = $this->db->get_where('medsos',array('candidate_id' => $id))->num_rows();
    if($cek_data > 0){
    $this->db->where('candidate_id',$id);    
    $cek = $this->db->update('medsos',$data);
    }else{
    $data['candidate_id'] = $id;
    $cek = $this->db->insert('medsos',$data);
    }
    // echo json_encode($linkedln);
    // die;
    if ($cek) {
        $this->session->set_flashdata('success', 'Berhasil Update Medsos');
        // redirect('account/hobby');
      } else {
        $this->session->set_flashdata('error', 'Gagal Update Medsos');
        // $this->load->view('front/user-existing-account');
      }
    redirect('account/hobby');
    
    // $this->load->view('front/layout/footer');
  }
  
  
   public function tambahHobby($id = null)
  {
    $this->checkLogin();
    $id = $this->input->post('id');
    $hobby = $this->input->post('hobby');     
    
    $data = array(
        'candidate_id' => $id,
        'hoby' => $hobby,
        );
    $cek = $this->db->insert('hoby',$data);
    if ($cek) {
        $this->session->set_flashdata('success', 'Berhasil Tambah Hoby');
      } else {
        $this->session->set_flashdata('error', 'Gagal Tambah Hoby');
      }
    redirect('account/hobby');
    }
    
    public function tambahKegiatan()
  {
    $this->checkLogin();
    $id = $this->input->post('id');
    $jenis = $this->input->post('jenis');     
    $lokasi = $this->input->post('lokasi');     
    $posisi = $this->input->post('posisi');     
    $informasi = $this->input->post('informasi');     
    
    $data = array(
        'candidate_id' => $id,
        'jenis' => $jenis,
        'lokasi' => $lokasi,
        'posisi' => $posisi,
        'informasi' => $informasi,
        );
    $cek = $this->db->insert('kegiatan',$data);
    if ($cek) {
        // if()
        //  $this->db->where('candidates.candidate_id',$id);
        //  $this->db->update('candidates',array('status_siswa_bkk' => $jenis));
         
        $this->session->set_flashdata('success', 'Berhasil Tambah Kegiatan');
      } else {
        $this->session->set_flashdata('error', 'Gagal Tambah Kegiatan');
      }
    redirect('account/hobby');
    }
    
    public function hapusHobby($id)
  {
    $this->checkLogin();  
    $id = decode($id);
    $this->db->where('id',$id);
    $cek = $this->db->delete('hoby');
    if ($cek) {
        $this->session->set_flashdata('success', 'Berhasil Hapus Hoby');
      } else {
        $this->session->set_flashdata('error', 'Gagal Hapus Hoby');
      }
    redirect('account/hobby');
    }
    
    public function hapusKegiatan($id)
  {
    $this->checkLogin();  
    $id = decode($id);
    
    $get_id = $this->db->get_where('kegiatan',array('id'=>$id))->row();
    $cek_banyak = $this->db->get_where('kegiatan',array('candidate_id'=>$get_id->candidate_id))->num_rows();
    
    if($cek_banyak <= 1){
     $this->db->where('candidates.candidate_id',$get_id->candidate_id);
     $this->db->update('candidates',array('status_siswa_bkk' => 0));   
    }
    
    $this->db->where('id',$id);
    $cek = $this->db->delete('kegiatan');
    if ($cek) {
        $this->session->set_flashdata('success', 'Berhasil Hapus Kegiatan');
      } else {
        $this->session->set_flashdata('error', 'Gagal Hapus Kegiatan');
      }
    redirect('account/hobby');
    }
    
    public function hapusKegiatanSimpan($id,$redirect)
  {
    // $this->checkLogin();  
    $id = decode($id);
    $redirect = decode($redirect);
    // echo $id;
    $jenis = '';
    $informasi = '';
    
    $get_kegiatan = $this->db->get_where('kegiatan',array('id' => $id))->row();
    // echo json_encode($get_kegiatan);
    // die;
    $resume = $this->db->get_where('resumes',array('candidate_id' => $get_kegiatan->candidate_id))->row();
    if($get_kegiatan->jenis == 1){
        $jenis = 'Magang';
    }else{
        $jenis = 'Bekerja';
    }
    if($get_kegiatan->informasi == ''){
        $informasi = 'informasi lain : '.$get_kegiatan->informasi;
    }else{
        $informasi = '';
    }
    // if(!empty($get_kegiatan)){
        $data = array(
            'resume_id' => $resume->resume_id,
            'title' => $get_kegiatan->posisi,
            'link' => 5,
            'description' => $jenis.' sebagai '.$get_kegiatan->posisi.' di '.$get_kegiatan->lokasi.' , '.$informasi,
            'created_at' => date('Y-m-d H:i:s'),
            );    
            
            $this->db->insert('resume_achievements',$data);
    // }
    
    $this->db->where('id',$id);
    $cek = $this->db->delete('kegiatan');
    if ($cek) {
        $this->session->set_flashdata('success', 'Berhasil Hapus Kegiatan');
      } else {
        $this->session->set_flashdata('error', 'Gagal Hapus Kegiatan');
      }
    redirect($redirect);
    }
  
  /**
  * Function (for ajax) to process password reset form request
  *
  * @return redirect
  */
  public function updatePassword()
  {
    $this->checkIfDemo();
    $this->form_validation->set_rules('old_password', 'Old Password', 'required');
    $this->form_validation->set_rules('new_password', 'New Password', 'required');
    $this->form_validation->set_rules('retype_password', 'Retype.. Password', 'required|matches[new_password]');

    $cek = $this->db->get_where('candidates',array('candidate_id'=>$this->session->userdata('candidate')['candidate_id']))->row();
 
    if ($this->form_validation->run() === FALSE) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
      ));
    } elseif (makePassword($this->xssCleanInput('old_password')) != $cek->password ) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => lang('old_password_do_not_match')))
      ));
    } else {
      $this->CandidateModel->updatePasswordByField(
        'candidates.candidate_id',
        candidateSession(),
        makePassword($this->xssCleanInput('new_password'))
      );
      echo json_encode(array(
        'success' => 'true',
        'messages' => $this->ajaxErrorMessage(array('success' => lang('password_updated')))
      ));
    }
  }

  /**
  * Function to activate account
  * e.g. resulting function for click on email
  *
  * @return redirect
  */
  public function waactivate()
  {
        $tokensegmen = $this->uri->segment(3);
        $baseurl = base_url();
        redirect($baseurl.'activate-account/'.$tokensegmen, 'refresh');
  }
  
  public function activateAccount($token = null)
  {
    $result = $this->CandidateModel->activateAccount($token);
    if ($result) {
      $content = '';
      $content .= '<strong><h3>Terimakasih.</h3></strong>';
      $content .= '<br /><br />';
      $content .= '<p>Anda sudah berhasil mengaktifkan akun SDM Cybersjob.</p >';
      $content .= '<br /><br />';
      $content .= '<p>Anda Akan dialihkan ke halaman Login Sebentar Lagi</p >';
      $pageData['page'] = 'Jobs | ' . setting('site-name');
      $this->load->view('front/layout/header', $pageData);
      $this->load->view('front/result-action-page', compact('content'));
      header( "refresh:3; url=/account");
    } else {
      $content = '';
      $content .= '<strong><h3>Terjadi eror!</h3></strong>';
      $content .= '<br />';
      $content .= '<p>Silahkan coba untuk login jika anda pernah aktivasi sebelumnya.<p>';
      $content .= '<br /><br />';
      $content .= '<a href="'.base_url().'login">Login</a>';
      $content .= '<br /><br />';
      $pageData['page'] = 'Jobs | ' . setting('site-name');
      $this->load->view('front/layout/header', $pageData);
      $this->load->view('front/result-action-page', compact('content'));
    }
  }

  /**
  * Page Function to process google redirect
  *
  * @return html
  */
  public function googleRedirect()
  {
    $client = $this->getGoogleClient();

    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {
      $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
      $client->setAccessToken($token['access_token']);

      // get profile info
      $google_oauth = new Google_Service_Oauth2($client);
      $google_account_info = $google_oauth->userinfo->get();
      $id =  $google_account_info->id;
      $email =  $google_account_info->email;
      $name =  $google_account_info->name;
      $image = $google_account_info->picture;

      $result = $this->CandidateModel->createGoogleCandidateIfNotExist($id, $email, $name, $image);
      if ($result) {
        $this->session->set_userdata(array('candidate' => objToArr($result)));
        $this->setRememberMe($email, $this->xssCleanInput('remember'));
        redirect('account');
      } else {
        $this->load->view('front/user-existing-account');
      }
    }
  }

  /**
  * Page Function to process linkedin redirect
  *
  * @return html
  */
  public function linkedinRedirect()
  {
    if(isset($_GET['code']))
    {
      $linkedinHelper = new LinkedinHelper();
      $accessToken = $linkedinHelper->getAccessToken($_GET['code']);
      $result = $linkedinHelper->getLinkedinRefinedData($accessToken);
      $result = $this->CandidateModel->createLinkedinCandidateIfNotExist($result);
      if ($result) {
        $this->session->set_userdata(array('candidate' => objToArr($result)));
        $this->setRememberMe($email, $this->xssCleanInput('remember'));
        redirect('account');
      } else {
        $this->load->view('front/user-existing-account');
      }
    } else {
      redirect('account');
    }
  }
}
