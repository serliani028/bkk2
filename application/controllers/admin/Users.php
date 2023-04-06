<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    /**
     * View Function to display login page
     *
     * @return html/string
     */
    public function loginView()
    {
        if (adminSession()) {
            redirect('admin/dashboard');
        } else if ($this->input->cookie('remember_me_token_admin' . appId(), TRUE)) {
            $userWithToken = $this->AdminUserModel->getUserWithRememberMeToken(
                $this->input->cookie('remember_me_token_admin' . appId())
            );
            if ($userWithToken) {
                $userWithToken = objToArr($userWithToken);
                $userWithToken['permissions'] = $this->AdminRoleModel->getUserPermissions($userWithToken['user_id']);
                $this->session->set_userdata(array('admin' => $userWithToken));
                redirect('admin/dashboard');
            } else {
                $this->logout(true);
            }
        }
        $this->load->view('admin/login');
    }

    /**
     * Function to process login form request
     *
     * @return redirect
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
            $user = objToArr($this->AdminUserModel->login($email, $password));
            if ($user) {
                $user['permissions'] = $this->AdminRoleModel->getUserPermissions($user['user_id']);
                $this->session->set_userdata(array('admin' => $user));
                $this->setRememberMe($email, $this->xssCleanInput('rememberme'));
                redirect('/admin/dashboard');
            } else {
                $this->session->set_flashdata('error', lang('email_and_or_password_was_invalid'));
            }
        }
        redirect('admin/login');
    }

    /**
     * View Function to display forgot password page view
     *
     * @return html/string
     */
    public function forgotPasswordView()
    {
        $this->load->view('admin/forgot-password');
    }

    /**
     * Function to process forgot password form request
     *
     * @return redirect
     */
    public function forgotPassword()
    {
        $this->checkIfDemo('reload');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', lang('please_enter_email_correctly'));
        } else {
            $email = $this->xssCleanInput('email');
            $user = $this->AdminUserModel->checkUserByEmail($email);
            if ($user) {
                $token = $this->AdminUserModel->saveTokenForPasswordReset($email);
                $this->session->set_flashdata('success', lang('an_email_has_been_sent'));
                $data = array('token' => $token, 'user' => $user);
                $this->sendEmail(
                    $this->load->view('admin/emails/reset-password', $data, TRUE),
                    $user->email,
                    'Your password reset link'
                );
            } else {
                $this->session->set_flashdata('error', lang('email_not_found'));
            }
        }
        redirect('admin/forgot-password');
    }

    /**
     * View Function to display reset password page view
     *
     * @param string $token
     * @return html/string
     */
    public function resetPasswordView($token = NULL)
    {
        $this->load->view('admin/reset-password', compact('token'));
    }

    /**
     * Function to process reset password form request
     *
     * @return redirect
     */
    public function resetPassword()
    {
        $this->checkIfDemo('reload');
        $this->form_validation->set_rules('token', 'Token', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('retype_new_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/reset-password/' . $this->xssCleanInput('token'));
        } elseif (!$this->AdminUserModel->checkIfTokenExist($this->xssCleanInput('token'))) {
            $this->session->set_flashdata('error', lang('invalid_request_please_regenerate'));
            redirect('admin/reset-password/' . $this->xssCleanInput('token'));
        } else {
            $this->AdminUserModel->updatePasswordByField('token', $this->xssCleanInput('token'), makePassword($this->xssCleanInput('new_password')));
            $this->session->set_flashdata('success', lang('your_password_has_been_successfully'));
            redirect('admin');
        }
    }

    /**
     * Function to process request for logout
     *
     * @return redirect
     */
    public function logout($noRedirect = false)
    {
        $this->session->unset_userdata('admin');
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        $this->load->helper('cookie');
        delete_cookie('remember_me_token_admin' . appId(), SITE_URL, '/');
        if (!$noRedirect) {
            redirect('/admin');
        }
    }

    /**
     * View Function to display profile page view
     *
     * @return html/string
     */
    public function profile()
    {
        $this->checkAdminLogin();
        $data['page'] = lang('profile');
        $data['prov'] = $this->db->get_where('provinsi')->result();
        $data['menu'] = 'profile';  
        $profile = '';
        $data['jenis'] = 1;
        $cek = $this->db->get_where('user_mitra',array('id_mitra' => $this->session->userdata('admin')['account_id']))->row_array();
        if(!empty($cek)){
        $profile = $cek;
        $data['jenis'] = 2;
        }else{
        $data['jenis'] = 1;
        $profile = objToArr($this->AdminUserModel->getUser('user_id', adminSession()));
        }
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/profile', compact('profile'));
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

  public function get_edit()
  {
    $id  = $this->input->get('id');
    $data = $this->db->select('user_mitra.provinsi, user_mitra.kabupaten, user_mitra.kecamatan')
                     ->from('user_mitra')
                     ->where('id_mitra',$id)
                     ->get()->result();
    echo json_encode($data);
  }

    /**
     * View Function to display profile page view
     *
     * @return html/string
     */
    public function passwordView()
    {
        $this->checkAdminLogin();
        $data['page'] = lang('password');
        $data['menu'] = 'password';
        $profile = objToArr($this->AdminUserModel->getUser('user_id', adminSession()));
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/password', compact('profile'));
    }
    
    public function download_mou($file)
    {
        $this->load->helper('download');
        $data = file_get_contents(ASSET_ROOT . '/admin/mou/'.$file); // Read the file's contents
        force_download($file, $data);
    }

    /**
     * Function (for ajax) to process profile update form request
     *
     * @return redirect
     */
    public function updateProfile()
    {
        $this->checkIfDemo();
        if($this->input->post('jenis') == 1){
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone', 'min_length[2]|max_length[50]|numeric');

        $imageUpload = $this->uploadImage(true);

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminUserModel->valueExist('username', $this->xssCleanInput('username'), adminSession())) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('username_already_exist')))
            ));
        } elseif ($this->AdminUserModel->valueExist('email', $this->xssCleanInput('email'), adminSession())) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('email_already_exist')))
            ));
        } elseif ($imageUpload['success'] == 'false') {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $imageUpload['message']))
            ));
        } else {
            $this->AdminUserModel->updateProfile($imageUpload['message']);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('profile_updated')))
            ));
        }
    }else{
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('npsn', 'NPSN', 'trim|required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('nip_ks', 'NIP', 'required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('no_telp', 'No_telp', 'min_length[12]|max_length[13]|numeric');
        
         if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminUserModel->valueExist('email', $this->xssCleanInput('email'), adminSession())) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('email_already_exist')))
            ));
        }else {
            $this->AdminUserModel->updateProfileMitra();
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('profile_updated')))
            ));
        }
        
       
    }
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
        $this->form_validation->set_rules('retype_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif (makePassword($this->xssCleanInput('old_password')) !== adminSession('password')) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array(
                    'error' => lang('old_password_do_not_match')
                ))
            ));
        } else {
            $this->AdminUserModel->updatePasswordByField(
                'user_id',
                adminSession(),
                makePassword($this->xssCleanInput('new_password'))
            );
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => 'Password reset'))
            ));
        }
    }

    /**
     * View Function to display users list view page
     *
     * @return html/string
     */
    public function usersListView()
    {
        $this->checkAdminLogin();
        $data['page'] = lang('team');
        $data['menu'] = 'team';
        $pagedata['roles'] = objToArr($this->AdminRoleModel->getAll());
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/users/list', $pagedata);
    }

    /**
     * Function to get data for users jquery datatable
     *
     * @return json
     */
    public function usersList()
    {
        echo json_encode($this->AdminUserModel->usersList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $user_id
     * @return html/string
     */
    public function createOrEditUser($user_id = NULL)
    {
        $user = objToArr($this->AdminUserModel->getUser('user_id', $user_id));
        $roles = objToArr($this->AdminRoleModel->getAll());
        $userRoles = explode(',', $this->AdminRoleModel->getUserRoles($user_id));
        echo $this->load->view('admin/users/create-or-edit', compact('user', 'roles', 'userRoles'), TRUE);
    }

    /**
     * Function (for ajax) to process user create or edit form request
     *
     * @return redirect
     */
    public function saveUser()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'required|min_length[2]|max_length[50]|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone', 'min_length[2]|max_length[50]|numeric');

        $edit = $this->xssCleanInput('user_id') ? $this->xssCleanInput('user_id') : false;
        $imageUpload = $this->uploadImage($edit);
        if (!$edit) {
            $this->form_validation->set_rules('password', 'Password', 'required');
        }

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminUserModel->valueExist('username', $this->xssCleanInput('username'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('username_already_exist')))
            ));
        } elseif ($this->AdminUserModel->valueExist('email', $this->xssCleanInput('email'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('email_already_exist')))
            ));
        } elseif ($imageUpload['success'] == 'false') {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $imageUpload['message']))
            ));
        } else {
            $this->AdminUserModel->storeUser($edit, $imageUpload['message']);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('user').' ' . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (for ajax) to process user create or edit form request
     *
     * @return redirect
     */
    public function saveUserRoles()
    {
        $this->checkIfDemo();
        $this->AdminUserModel->storeUserRolesBulk();
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => 'created'))
        ));
    }

    /**
     * Function (for ajax) to process user change status request
     *
     * @param integer $user_id
     * @param string $status
     * @return void
     */
    public function changeStatus($user_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminUserModel->changeStatus($user_id, $status);
    }

    /**
     * Function (for ajax) to process user bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminUserModel->bulkAction();
    }

    /**
     * Function (for ajax) to process user delete request
     *
     * @param integer $user_id
     * @return void
     */
    public function delete($user_id)
    {
        $this->checkIfDemo();
        $cek = $this->db->get_where('users',array('user_id'=>$user_id))->row();
        if($cek->account_id == ''){
        $this->AdminUserModel->remove($user_id);
        }else{
        $get_mitra = $this->db->get_where('user_mitra',array('id_mitra'=>$cek->account_id))->row();
        $id_mitra = $get_mitra->id_mitra; 
        $this->db->delete('user_mitra',array('id_mitra' => $id_mitra));
        $this->db->delete('tahun_angkatan',array('id_mitra' => $id_mitra));
        $this->db->delete('jurusan',array('id_mitra' => $id_mitra));
        $this->db->delete('kelas',array('id_mitra' => $id_mitra));
        $cek2 = $this->db->get_where('candidates',array('account_id' => $id_mitra));
        
        if($cek2->num_rows() > 0){
        $kandidat = $cek2->row();
        $this->db->delete('candidates',array('account_id' => $id_mitra));
        $this->db->delete('magang',array('candidate_id' => $kandidat->candidate_id));
        $this->db->delete('wirausaha',array('candidate_id' => $kandidat->candidate_id));
        $this->db->delete('job_applications',array('candidate_id' => $kandidat->candidate_id));
        $this->db->delete('candidate_quizes',array('candidate_id' => $kandidat->candidate_id));
        $this->db->delete('candidate_interviews',array('candidate_id' => $kandidat->candidate_id));
        $cek3 = $this->db->get_where('resumes',array('candidate_id' => $kandidat->candidate_id));
        
        if($cek3->num_rows() > 0){
        $resume = $cek3->row();
        $this->db->delete('resumes',array('candidate_id' => $kandidat->candidate_id));
        $this->db->delete('resume_achievements',array('resume_id' => $resume->resume_id));
        $this->db->delete('resume_experiences',array('resume_id' => $resume->resume_id));
        }
        
        }
        $this->AdminUserModel->remove($user_id);
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
                'name' => 'remember_me_token_admin' . appId(),
                'value' => $tokenValue,
                'expire' => '1209600',// Two weeks
                'domain' => SITE_URL,
                'path' => '/'
            );            
            $this->input->set_cookie($cookie);
            $this->AdminUserModel->storeRememberMeToken($email, $tokenValue);
        }
    }

    /**
     * Private function to upload user image if any
     *
     * @param integer $edit
     * @return array
     */
    private function uploadImage($edit = false)
    {
        if ($_FILES['image']['name'] != '') {
            if ($edit) {
                $user = objToArr($this->AdminUserModel->getUser('user_id', $edit));
                if ($user['image']) {
                    @unlink(ASSET_ROOT . '/images/users/' . $user['image']);
                }
            }
            $file = explode('.', $_FILES['image']['name']);
            $filename = url_title(convert_accented_characters($_FILES['image']['name']), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/users/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $filename;
            $config['max_size'] = '1024';
            $config['max_width'] = '400';
            $config['max_height'] = '400';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                return array(
                    'success' => 'false',
                    'message' => lang('only_image_allowed_400')
                );
            } else {
                $data = $this->upload->data();
                return array('success' => 'true', 'message' => $data['file_name']);
            }
        }
        return array('success' => 'true', 'message' => '');
    }
    
}
