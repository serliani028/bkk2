<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Candidates extends CI_Controller
{
  /**
  * View function to display login page for candidate
  *
  * @return html/string
  */
  public function loginView($slug = null)
  {
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

    $this->load->view('front/layout/header', $pageData);
    $this->load->view('front/login', $data);
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
      $candidate = $this->CandidateModel->login($email, $password);
      if ($candidate) {
        $this->session->set_userdata(array('candidate' => objToArr($candidate)));
        $this->setRememberMe($email, $this->xssCleanInput('remember'));
        redirect('/account');
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
  public function registerView()
  {
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
      $this->load->view('front/layout/header', $pageData);
      $this->load->view('front/register');
    } else {
      $this->load->view('front/404');
    }
  }

  /**
  * Post Function to register a candidate
  *
  * @return html/string
  */
  public function register()
  {
    $this->checkIfDemo();
    // $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[20]');
    // $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[20]');
    // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[candidates.email]', array('is_unique' => 'Email already exists'));
    $this->form_validation->set_rules('id_prakerja', 'ID Prakerja', 'required|is_unique[candidates.id_prakerja]', array('is_unique' => 'ID Sertifikasi Sudah digunakan'));
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('retype_password', 'Confirm Password', 'required|matches[password]');

    if ($this->form_validation->run() === FALSE) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
      ));
    } else {
      if (setting('enable-email-verification') == 'yes') {
        $cek = $this->CandidateModel->createCandidate();
        if ($cek == FALSE) {
          $message = 'ID Sertifikasi Tidak Terdaftar, Silahkan Hubungi Admin Kami !';
          echo json_encode(array(
            'error' => 'true',
            'messages' => $this->ajaxErrorMessage(array('error' => $message))
          ));
        }else{
          $id = $this->input->post('id_prakerja');
          $cek_token = $this->db->get_where('candidates', array('id_prakerja' => $id))->row();
          $messag = 'Pendaftaran Berhasil. Silahkan Verifikasi Email Anda Yang Sudah Terdaftar dengan ID Sertifikasi';
          echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => $messag))
          ));

          $email = $cek_token->email;
          $data['candidate'] = $cek_token;
          $message = $this->load->view('front/emails/verify-account',$data, TRUE);
          $this->sendEmail(
            $message,
            $email,
            'Activate your account'
          );

        }
      } else {
        $cek = $this->CandidateModel->createCandidate();
        if ($cek == FALSE) {
          $message = 'ID Sertifikasi Tidak Terdaftar, Silahkan Hubungi Admin Kami !';
          echo json_encode(array(
            'error' => 'true',
            'messages' => $this->ajaxErrorMessage(array('error' => $message))
          ));
        }else{
        $message = lang('account_created_please_login');
        }
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
      $pageData['page'] = 'Forgot Password | ' . setting('site-name');
      $this->load->view('front/layout/header', $pageData);
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
      $existingCandidate = $this->CandidateModel->getFirst('candidates.email', $this->xssCleanInput('email'));
      $this->sendEmail(
        $this->load->view('front/emails/forgot-password', $existingCandidate, TRUE),
        $existingCandidate['email'],
        'Create new password'
      );
      $message = lang('an_email_with_a_link_to_reset');
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

  /**
  * View Function to display profile update page for candidate
  *
  * @return html/string
  */
  public function updateProfileView($id = null)
  {
    $this->checkLogin();
    $data['kabupaten'] = $this->db->get('kabupaten')->result();
    $data['kecamatan'] = $this->db->get('kecamatan')->result();
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
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('phone1', 'Phone 1', 'min_length[11]|max_length[13]|numeric');
    $this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]|max_length[50]');
    // $this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('dob', 'Date of Birth', 'required|min_length[3]|max_length[50]');
    // $this->form_validation->set_rules('phone2', 'Phone 2', 'max_length[50]|numeric');
    $this->form_validation->set_rules('state', 'State', 'trim|required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('address', 'Address', 'required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('bio', 'Short Biography', 'required|min_length[3]|max_length[2500]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

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
    } else {
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
      $config['allowed_types'] = 'jpg|png|JPG|PNG';
      $config['file_name'] = $filename;
      $config['max_size'] = '1024';
      $config['max_width'] = '400';
      $config['max_height'] = '400';
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('image')) {
        return array(
          'success' => false,
          'message' => lang('only_image_allowed_400_2')
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
    $pageData['page'] = lang('update_password').' | ' . setting('site-name');
    $data['page'] = 'password';
    $this->load->view('front/layout/header', $pageData);
    $this->load->view('front/account-password', $data);
    $this->load->view('front/layout/footer');
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

    if ($this->form_validation->run() === FALSE) {
      echo json_encode(array(
        'success' => 'false',
        'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
      ));
    } elseif (makePassword($this->xssCleanInput('old_password')) !== $this->session->userdata('password')) {
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
  public function activateAccount($token = null)
  {
    $result = $this->CandidateModel->activateAccount($token);
    if ($result) {
      $content = '';
      $content .= '<strong><h3>Congratulations!</h3></strong>';
      $content .= '<br /><br />';
      $content .= '<p>Your account is activated. Please login with your entered credentials.</p >';
      $content .= '<br /><br />';
      $content .= '<p>You will be redirected to the login page in a while</p >';
      $pageData['page'] = 'Jobs | ' . setting('site-name');
      $this->load->view('front/layout/header', $pageData);
      $this->load->view('front/result-action-page', compact('content'));
      header( "refresh:3; url=/account");
    } else {
      $content = '';
      $content .= '<strong><h3>Some Error Occured!</h3></strong>';
      $content .= '<br /><br />';
      $content .= '<a href="'.base_url().'login">Please try again</a>';
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
