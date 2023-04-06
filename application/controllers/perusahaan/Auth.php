<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Auth extends CI_Controller
{
  /**
  * View function to display login page for candidate
  *
  * @return html/string
  */
  public function loginView($hal)
  {
    $pageData['action'] = 'post-login-perusahaan';
   
    $pageData['page'] = 'Login Perusahaan | ' . setting('site-name');
    $pagedata['settings'] = setting();
    // $pagedata['slug'] = $slug;
    $this->load->view('perusahaan/layout/header2', $pageData);
    
    if($hal == "vokasi"){
     $this->load->view('perusahaan/login2', $pageData); 
      
    }else if($hal == "kampus"){
      $this->load->view('perusahaan/login', $pageData);
          
     }else{
         redirect('https://magang.cybersjob.com/');
     }
  
    
  }

  /**
  * Post Function to process login request by candidate
  *
  * @return html/string
  */
  public function login()
  {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('error', lang('email_and_or_password_was_invalid'));
    } else {
      $email = $this->xssCleanInput('email');
      $password = makePassword($this->xssCleanInput('password'));
      $company = $this->CandidateModel->loginPH($email, $password);
      if ($company) {
        $this->session->set_userdata(array('company' => objToArr($company)));
        $this->setRememberMe($email, $this->xssCleanInput('remember'));
         redirect('perusahaan/admin');
    } else {
        $this->session->set_flashdata('error', lang('email_and_or_password_was_invalid'));
      }
    }
    redirect('login-perusahaan');
  }

  /**
  * View Function to display register page for candidate
  *
  * @return html/string
  */


  public function daftar_ph()
  {
      $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[2]|max_length[20]|is_unique[companies.title]', array('is_unique' => 'Nama Perusahaan Sudah Terdaftar'));
      $this->form_validation->set_rules('no_telp_ph', 'Phone', 'required|max_length[13]|is_unique[companies.no_telp_ph]', array('is_unique' => 'Nomor Sudah Terdaftar'));
      $this->form_validation->set_rules('email_ph', 'Email', 'required|valid_email|is_unique[companies.email_ph]', array('is_unique' => 'Email Sudah Terdaftar'));
      $this->form_validation->set_rules('password_ph', 'Password', 'min_length[8]|required', array('min_length' => 'Password Minimal 8 Karakter'));

      if ($this->form_validation->run() === FALSE) {
          $this->session->set_flashdata('error', validation_errors());
          redirect('perusahaan');
       } else {
            
         $token = token(); 
                  $data = array(
                    
                    'title' => $this->input->post('title'),
                    'email_ph' => $this->input->post('email_ph'),
                    'no_telp_ph' => $this->input->post('no_telp_ph'),
                    'password_ph' => makePassword($this->input->post('password_ph')),
                    'token' =>   $token,
                    'status' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                  );

                  $this->db->insert('companies',$data);

                  $email = $this->input->post('email_ph');
                  $cek_token = $this->db->get_where('companies', array('email_ph' => $this->input->post('email_ph')))->row();
                  $data['candidate'] = $cek_token;
                   $message = $this->load->view('perusahaan/emails/verify-account-ph',$data, TRUE);
                   $this->sendEmail(
                       $message,
                       $email,
                       'Aktivasi Akun Perusahaan'
                   );

                  $this->session->set_flashdata('success', 'Pendaftaran Perusahaan Anda Berhasil, Silahkan Cek Email Anda');
                    redirect('perusahaan');   
        
       }
  }

  /**
  * Function to process request for logout
  *
  * @return redirect
  */
  public function logout()
  {
    $this->session->unset_userdata('company');
    $this->session->set_flashdata('user_loggedout', lang('you_are_now_logged_out'));
    $this->load->helper('cookie');
    delete_cookie('remember_me_token_ph' . appId(), SITE_URL, '/');
    redirect('login-perusahaan');
  }
  
  private function setRememberMe($email, $check)
    {
        if ($check) {
            $this->load->helper('cookie');
            $tokenValue = $email.'-'.strtotime(date('Y-m-d G:i:s'));
            $cookie = array(
                'name' => 'remember_me_token_ph' . appId(),
                'value' => $tokenValue,
                'expire' => '1209600',// Two weeks
                'domain' => SITE_URL,
                'path' => '/'
            );            
            $this->input->set_cookie($cookie);
            $this->AdminUserModel->storeRememberMeTokenPH($email, $tokenValue);
        }
    }

  /**
  * View Function to display register page for user
  *
  * @return html/string
  */

}
