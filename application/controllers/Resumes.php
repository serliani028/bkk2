<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Resumes extends CI_Controller
{
    /**
     * View Function to display account resume listing page
     *
     * @return html/string
     */
     
    public function listing($id = null)
    {
        
        $this->checkLogin();

        // redirect('account/profile');
        $this->db->order_by('id','DESC');
        $data['pengalaman'] = $this->db->get('pengalaman')->result();
        $this->db->order_by('id','DESC');
        $data['skill'] = $this->db->get('skill')->result();
        $data['upload_file'] = site_url('account/upload_file');
        if (setting('enable-multiple-resume') == 'yes') {
            $pageData['page'] = lang('resume_listing').' | ' . setting('site-name');
            $data['page'] = 'resumes';
            $data['resumes'] = $this->ResumeModel->getCandidateResumes(candidateSession());
            $this->load->view('front/layout/header', $pageData);
            $this->load->view('front/account-resume-listing', $data);
        } else {
            $resume = $this->ResumeModel->getFirstDetailedResume();
            redirect('account/resume/'.encode($resume));
        }
    }

    /**
     * Function (for ajax) to process create resume form request
     *
     * @return redirect
     */
    public function create()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required|min_length[2]|max_length[80]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $result = $this->ResumeModel->createResume();
            echo json_encode(array(
                'success' => 'true',
                'id' => encode($result['resume_id']),
                'messages' => $this->ajaxErrorMessage(array('success' => 'success'))
            ));
        }
    }

    /**
     * View Function to display account resume detail page
     *
     * @return html/string
     */
    public function detailView($id = null)
    {
        
        $this->checkLogin();
        $data['upload_file'] = site_url('account/upload_file');
        $this->db->order_by('id','DESC');
        $data['pengalaman'] = $this->db->get('pengalaman')->result();
        $this->db->order_by('id','DESC');
        $data['skill'] = $this->db->get('skill')->result();
        $id = setting('enable-multiple-resume') == 'yes' ? $id : encode($this->ResumeModel->getFirstDetailedResume());
        $pageData['page'] = lang('resume_detail').' | ' . setting('site-name');
        $data['page'] = 'resumes';
        $data['id'] = decode($id);
        $data['resume'] = $this->ResumeModel->getCompleteResume(decode($id));
        $data['resumesz'] = $this->ResumeModel->getCompleteResume2(decode($id));
        $data['resumes_profile'] = $this->db->get_where('resumes',array('candidate_id' => $this->session->userdata('candidate')['candidate_id']))->row();
        $data['jumlah_quiz'] =  $this->QuizModel->getTotalQuiz();
        $data['jumlah_interview_internal'] =  $this->QuizModel->getTotalCandidateQuizes_not( $this->session->userdata('candidate')['candidate_id']);
         
        $this->load->view('front/layout/header', $pageData);
        if ($data['resume']['type'] == 'detailed') {
            $this->load->view('front/account-edit-resume', $data);
        } else {
            $this->load->view('front/account-edit-resume-doc', $data);
        }
    }

    /**
     * Function (for ajax) to process resume general section update form request
     *
     * @return redirect
     */
    public function updateGeneral()
    {
         $data = array();
  
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'doc|docx|pdf';
            $config['max_size'] = '1024';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            
        if ($_FILES['file']['name'] != '') {
        if (!$this->upload->do_upload('file')) {
             echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => 'Upload FIle CV Gagal !'))
            ));
        }else{
         $file1 = $this->upload->data();
          $data['file'] = $file1['file_name'];
        }
        }
       
        if($this->session->userdata('candidate')['account_type'] == "umum" || $this->session->userdata('candidate')['account_type'] == "site" ){
       
        if ($_FILES['skck']['name'] != '') {
        if (!$this->upload->do_upload('skck')) {
             echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => 'Upload FIle SKCK Gagal !'))
            ));
        }else{
         $file2 = $this->upload->data();
         $data['skck'] = $file2['file_name'];
        }
        }
        
        if ($_FILES['sk_covid']['name'] != '') {
        if (!$this->upload->do_upload('sk_covid')) {
             echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => 'Upload FIle Surat Covid Gagal !'))
            ));
        }else{
         $file3 = $this->upload->data();
         $data['sk_covid'] = $file3['file_name'];
        }
        }
        
            
        }else{
            $data['skck'] = '';
            $data['sk_covid'] = '';
        }
        
       
        $data_update = array();
        $id = decode($this->xssCleanInput('id'));
        $data_update['updated_at'] = date('Y-m-d G:i:s');
        
        if (!empty($data['file'])) {
        $data_update['file'] = $data['file'];
        }
        
        if (!empty($data['skck'])) {
        $data_update['skck'] = $data['skck'];
        }
        
        if (!empty($data['sk_covid'])) {
        $data_update['sk_covid'] = $data['sk_covid'];
        }
        
       
        $this->db->where('resumes.resume_id', $id);
        $this->db->update('resumes', $data_update);
  
        $cek_stat = $this->db->get_where('candidates',array('candidate_id'=>$this->session->userdata('candidate')['candidate_id']))->row();
        
       
        
       echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => 'Data Pelengkap Berhasil di Update'))
            ));
        
        
    }

    public function sertifikat()
    {
      if ($_FILES['file']['name'] != '') {
          $config['upload_path'] = './upload/sertifikat/';
          $config['allowed_types'] = 'doc|docx|pdf';
          $config['file_name'] = round(microtime(true)*1000).'-'.$this->input->post('id');
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('file')) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => 'Gagal Upload'))
            ));
          } else {
              $data_gambar = $this->upload->data();

              $data = array(
                'id_kandidat' => $this->input->post('id'),
                'nama_kandidat' => $this->input->post('name'),
                'nama_kelas' => $this->input->post('nama_kelas'),
                'judul_sertifikat' => $this->input->post('judul'),
                'file' => $data_gambar['file_name'],
                'created_date' => date('Y-m-d H:i:s')
              );

              $this->db->insert('sertifikat',$data);

              echo json_encode(array(
                  'success' => 'true',
                  'messages' => $this->ajaxErrorMessage(array('success' => 'Form Sukses'))
              ));

          }
      }else{
        echo json_encode(array(
            'success' => 'false',
            'messages' => $this->ajaxErrorMessage(array('error' => 'Gagal Upload'))
        ));
      }
    }

    public function hapus_sertifikat($id)
    {
      if ($id == NULL) {
        redirect('account/job-sertifikat');
      }else{
        $get = $this->db->get_where('sertifikat',  array('id_sertifikat' => $id))->row();
        $file_lama =  $get->file;
        $paths =  'upload/sertifikat/';
        unlink($paths.$file_lama);
        $this->db->delete('sertifikat', array('id_sertifikat' => $id));
        redirect('account/job-sertifikat');
      }
    }

    /**
     * Function (for ajax) to process resume experiences section update form request
     *
     * @return redirect
     */
    public function updateExperience()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules(
            'title[]', 'Title', 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules('from[]', 'From', 'required|max_length[20]');
        $this->form_validation->set_rules(
            'company[]', 'Company', 'trim|required|min_length[3]|max_length[50]'
        );
        $this->form_validation->set_rules('to[]', 'To', 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('description[]', 'description', 'required|min_length[3]|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $this->ResumeModel->updateResumeExperience();
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('experiences_updated')))
            ));
        }
    }

    /**
     * Function (for ajax) to process resume qualifications section update form request
     *
     * @return redirect
     */
    public function updateQualification()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules(
            'title[]', 'Title', 'trim|required|min_length[2]|max_length[50]'
        );
        
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
             $docRes = $this->uploadDoc2($this->xssCleanInput('resume_qualification_id'));
            
            if ($docRes['success'] == false ) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => 'File harus PDf Maksimal Berukuran 1MB !'))
            ));
        }else{
            $ceksz = $this->ResumeModel->updateResumeQualification($docRes);
            
            if($ceksz){
            $cek_stat = $this->db->get_where('candidates',array('candidate_id'=>$this->session->userdata('candidate')['candidate_id']))->row();
            if($cek_stat->status_data_verif <= 0){
            $cek2s = $this->db->get_where('resumes',array('candidate_id'=>$cek_stat->candidate_id))->row();
            $cekij = $this->db->get_where('resume_qualifications',array('resume_id'=>$cek2s->resume_id))->row();
            if(!empty($cekij)){
            if(($cekij->marks != "") && ($cek_stat->ktp != "")){
            $datal['status_data_verif'] = 1;
            
            $this->db->where('candidates.candidate_id',$cek_stat->candidate_id);
            $this->db->update('candidates',$datal);
            }
            }
            }
            }
            
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => 'Berhasil Diperbarui'))
            ));
        }
        }
    }

    /**
     * Function (for ajax) to process resume language section update form request
     *
     * @return redirect
     */
    public function updateLanguage()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title[]', 'Language', 'required|min_length[2]|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $this->ResumeModel->updateResumeLanguage();
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('Skill Berhasil diperbarui')))
            ));
        }
    }

    /**
     * Function (for ajax) to process resume achievement section update form request
     *
     * @return redirect
     */
    public function updateAchievement()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules(
            'title[]', 'Title', 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules('description[]', 'Description', 'required|min_length[10]|max_length[100]');
       
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        // }else if ($docRes['success'] == false ) {
        //     echo json_encode(array(
        //         'success' => 'false',
        //         'messages' => $this->ajaxErrorMessage(array('error' => 'File Yang dimasukkan Tidak Sesuai Format / Ukuran !'))
        //     ));
        }else {
            $this->ResumeModel->updateResumeAchievement();
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('Pengalaman berhasil di Perbarui')))
            ));
        }
    }
    
    public function upload_file()
    {
        $docRes = $this->uploadFile($this->input->post('id'));
       if ($docRes['success'] == false ) {
           $this->session->set_flashdata('error', 'File Tidak Sesuai Format / Ukuran !');
       }else {
           $type = $this->input->post('type');
           $id = $this->input->post('id');
           $id_resume = $this->input->post('id_resume');
           $data = array('file' => $docRes['file'],'type' => $type);
           $this->db->where('resume_achievement_id',$id);
           $this->db->update('resume_achievements',$data);
           $this->session->set_flashdata('success', 'File Berhasil di Upload !');
       }
        redirect('account/resume/'.encode($id_resume));
    }

    /**
     * Function (for ajax) to process resume reference section update form request
     *
     * @return redirect
     */
    public function updateReference()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules(
            'title[]', 'Title', 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules(
            'relation[]', 'Relation', 'trim|required|min_length[2]|max_length[50]'
        );
        $this->form_validation->set_rules('email[]', 'Email', 'required|min_length[2]|max_length[100]|valid_email');
        $this->form_validation->set_rules('company[]', 'Company', 'trim|max_length[50]');
        $this->form_validation->set_rules('phone[]', 'Phone', 'max_length[50]|numeric');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $this->ResumeModel->updateResumeReference();
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('references_updated')))
            ));
        }
    }

    /**
     * Function (for ajax) to process resume section add request
     *
     * @param string $resume_id
     * @param string $type
     * @return void
     */
    public function addSection($resume_id, $type)
    {
        switch ($type) {
            case 'experience':
                $data['experience'] = $this->ResumeModel->getEmptyTableObject('resume_experiences');
                $data['experience']['resume_id'] = decode($resume_id);
                $data['experience']['from'] = date('Y-m-d');
                $data['experience']['to'] = date('Y-m-d');
                echo $this->load->view('front/partials/account-edit-resume-experiences.php', $data, TRUE);
                break;
            case 'qualification':
                $data['qualification'] = $this->ResumeModel->getEmptyTableObject('resume_qualifications');
                $data['qualification']['resume_id'] = decode($resume_id);
                $data['qualification']['from'] = date('Y-m-d');
                $data['qualification']['to'] = date('Y-m-d');
                echo $this->load->view('front/partials/account-edit-resume-qualifications.php', $data, TRUE);
                break;
            case 'language':
                $this->db->order_by('id','DESC');
                $data['skill'] = $this->db->get('skill')->result();
                $data['language'] = $this->ResumeModel->getEmptyTableObject('resume_languages');
                $data['language']['resume_id'] = decode($resume_id);
                echo $this->load->view('front/partials/account-edit-resume-languages.php', $data, TRUE);
                break;
            case 'achievement':
                $data['achievement'] = $this->ResumeModel->getEmptyTableObject('resume_achievements');
                $data['achievement']['resume_id'] = decode($resume_id);
                $data['achievement']['date'] = date('Y-m-d');
                $this->db->order_by('id','DESC');
                $data['pengalaman'] = $this->db->get('pengalaman')->result();
                echo $this->load->view('front/partials/account-edit-resume-achievements.php', $data, TRUE);
                break;
            case 'reference':
                $data['reference'] = $this->ResumeModel->getEmptyTableObject('resume_references');
                $data['reference']['resume_id'] = decode($resume_id);
                echo $this->load->view('front/partials/account-edit-resume-references.php', $data, TRUE);
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Function (for ajax) to process resume section delete request
     *
     * @param integer $section_id
     * @param string $type
     * @return void
     */
    public function removeSection($section_id, $type)
    {
        $this->checkIfDemo();
        $this->ResumeModel->removeSection($section_id, $type);
    }

    /**
     * Function (for ajax) to process profile update form request
     *
     * @return redirect
     */
    public function updateDocResume()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[2]|max_length[20]');

        $docRes = $this->uploadDoc($this->xssCleanInput('resume_id'));

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($docRes['success'] == false) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $docRes['message']))
            ));
        } else {
            $this->ResumeModel->updateDocResume($docRes);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('resume_updated')))
            ));
        }
    }

    /**
     * Private function to upload resume file if any
     *
     * @param integer $resume_id
     * @return array
     */
    private function uploadDoc($resume_id = false)
    {
        if ($_FILES['file']['name'] != '') {
            $resume = objToArr($this->ResumeModel->getFirst('resumes.resume_id', decode($resume_id)));
            if ($resume['file']) {
                @unlink(ASSET_ROOT.'/images/candidates/'.$resume['file']);
            }
            $file = explode('.', $_FILES['file']['name']);
            $ext = $file[1];
            $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'doc|docx|pdf';
            $config['file_name'] = $filename;
            $config['max_size'] = '1024';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                return array(
                    'success' => false,
                    'message' => lang('only_ms_word_pdf_file')
                );
            } else {
                $data = $this->upload->data();
                return array('success' => true, 'file' => $data['file_name']);
            }
        }
        return array('success' => true, 'message' => '');
    }
    
    private function uploadDoc_2($resume_id = false)
    {
        if ($_FILES['skck']['name'] != '') {
            $resume = objToArr($this->ResumeModel->getFirst('resumes.resume_id', decode($resume_id)));
            if ($resume['skck']) {
                @unlink(ASSET_ROOT.'/images/candidates/'.$resume['skck']);
            }
            $file = explode('.', $_FILES['skck']['name']);
            $ext = $file[1];
            $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'doc|docx|pdf';
            $config['file_name'] = $filename;
            $config['max_size'] = '1024';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('skck')) {
                return array(
                    'success' => false,
                    'message' => lang('only_ms_word_pdf_file')
                );
            } else {
                $data = $this->upload->data();
                return array('success' => true, 'skck' => $data['file_name']);
            }
        }
        return array('success' => true, 'message' => '');
    }
    
    private function uploadDoc_3($resume_id = false)
    {
        if ($_FILES['sk_covid']['name'] != '') {
            $resume = objToArr($this->ResumeModel->getFirst('resumes.resume_id', decode($resume_id)));
            if ($resume['sk_covid']) {
                @unlink(ASSET_ROOT.'/images/candidates/'.$resume['sk_covid']);
            }
            $file = explode('.', $_FILES['sk_covid']['name']);
            $ext = $file[1];
            $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'doc|docx|pdf';
            $config['file_name'] = $filename;
            $config['max_size'] = '1024';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('sk_covid')) {
                return array(
                    'success' => false,
                    'message' => lang('only_ms_word_pdf_file')
                );
            } else {
                $data = $this->upload->data();
                return array('success' => true, 'file' => $data['file_name']);
            }
        }
        return array('success' => true, 'message' => '');
    }
    
    private function uploadFile($resume_id = false)
    {
        if ($_FILES['file']['name'] != '') {
            $resume = objToArr($this->db->get_where('resume_achievements', array('resume_achievement_id' => $resume_id) ));
            if ($resume['file']) {
                @unlink(ASSET_ROOT.'/pengalaman/'.$resume['file']);
            }
            $file = explode('.', $_FILES['file']['name']);
            $ext = $file[1];
            $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/pengalaman/';
            $config['allowed_types'] = 'pdf|PDF|IMG|img|png|PNG|JPEG|jpeg|JPG|jpg';
            $config['file_name'] = $filename;
            $config['max_size'] = '1024';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                return array(
                    'success' => false,
                    'message' => 'File Yang dimasukkan Tidak Sesuai Format / Ukuran'
                );
            } else {
                $data = $this->upload->data();
                return array('success' => true, 'file' => $data['file_name']);
            }
        }
        return array('success' => true, 'message' => '');
    }
    
     private function uploadImage($resume_id = false)
    {
        if ($_FILES['ktp']['name'] != '') {
            $resume = objToArr($this->ResumeModel->getFirst2('candidates.candidate_id', $resume_id));
            if ($resume['ktp']) {
                @unlink(ASSET_ROOT.'/images/candidates/'.$resume['ktp']);
            }
            $file = explode('.', $_FILES['ktp']['name']);
            $ext = $file[1];
            $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'PNG|JPG|png|jpg';
            $config['file_name'] = $filename;
            $config['max_size'] = '1024';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('ktp')) {
                return array(
                    'success' => false,
                    'message' => 'Hanya PNG/JPG'
                );
            } else {
                $data = $this->upload->data();
                return array('success' => true, 'file2' => $data['file_name']);
            }
        }
        return array('success' => true, 'message' => '');
    }
    
    private function uploadDoc2($resume_id = false)
    {
        if ($_FILES['marks']['name'] != '') {
            if($resume_id != ""){
            $resume = objToArr($this->ResumeModel->getFirst2('resume_qualifications.resume_qualification_id', decode($resume_id)));
            if ($resume['marks']) {
                @unlink(ASSET_ROOT.'/images/candidates/'.$resume['marks']);
            }
            }
            $file = explode('.', $_FILES['marks']['name']);
            $ext = $file[1];
            $filename = url_title(convert_accented_characters($file[0]), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = $filename;
            $config['max_size'] = '1024';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('marks')) {
                return array(
                    'success' => false,
                    'message' => 'File harus PDf Maksimal Berukuran 1MB'
                );
            } else {
                $data = $this->upload->data();
                return array('success' => true, 'file' => $data['file_name']);
            }
        }
        return array('success' => true, 'file' => '');
    }
}
