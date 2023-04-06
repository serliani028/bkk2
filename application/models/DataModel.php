<?php

class DataModel extends CI_Model
{
    public function __construct()
    {
        $this->load->dbforge();
    }

    public function run()
    {
        $this->importUsersData();
        $this->importCandidatesData();
        $this->importRolesData();
        $this->importDepartmentsData();
        $this->importPermissionsData();
        $this->importCompaniesData();
        $this->importLanguagesData();
        $this->importTraitsData();
        $this->importJobsData();
        $this->importJobFavoritesData();
        $this->importJobReferredData();
        $this->importBlogCategoriesData();
        $this->importBlogsData();
        $this->importResumeData();
        $this->importFooterSections();
        $this->importSettings();
        $this->importToDos();
        $this->importUpdate();
    }

    public function importUsersData()
    {
        $data = array(
            array(
                'first_name' => 'Admin',
                'last_name' => 'User',
                'username' => 'admin',
                'email' => 'admin@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'admin',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Liam',
                'last_name' => 'Logan',
                'username' => 'liam',
                'email' => 'liam@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'William',
                'last_name' => 'Amith',
                'username' => 'william',
                'email' => 'william@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Oliver',
                'last_name' => 'Wood',
                'username' => 'oliver',
                'email' => 'oliver@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Brad',
                'last_name' => 'Pitt',
                'username' => 'brad',
                'email' => 'brad@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Neil',
                'last_name' => 'Armstrong',
                'username' => 'neil',
                'email' => 'neil@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Anthony',
                'last_name' => 'Hopkins',
                'username' => 'anthony',
                'email' => 'anthony@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Fredrick',
                'last_name' => 'John',
                'username' => 'john',
                'email' => 'john@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Virat',
                'last_name' => 'Anand',
                'username' => 'virat',
                'email' => 'anand@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Ali',
                'last_name' => 'Moeen',
                'username' => 'ali',
                'email' => 'ali.moeen@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Victoria',
                'last_name' => 'Joseph',
                'username' => 'team',
                'email' => 'victoria@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Mahima',
                'last_name' => 'Khan',
                'username' => 'khan',
                'email' => 'khan@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('username', $d['username']);
            $result = $this->db->get('users');
            if ($result->num_rows() <= 0) {
                $this->db->insert('users', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importCandidatesData()
    {
        $data = array(
            array(
                'first_name' => 'Josh',
                'last_name' => 'Kent',
                'email' => 'josh@cf.com',
                'image' => '',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Candidate',
                'last_name' => '',
                'email' => 'candidate@cf.com',
                'image' => '2.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'William',
                'last_name' => 'Amith',
                'email' => 'william@cf.com',
                'image' => '3.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Kristen',
                'last_name' => 'Wood',
                'email' => 'oliver@cf.com',
                'image' => '4.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Brad',
                'last_name' => 'Pitt',
                'email' => 'brad@cf.com',
                'image' => '6.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Neil',
                'last_name' => 'Armstrong',
                'email' => 'neil@cf.com',
                'image' => '7.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Anthony',
                'last_name' => 'Hopkins',
                'email' => 'anthony@cf.com',
                'image' => '8.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Fredrick',
                'last_name' => 'John',
                'email' => 'john@cf.com',
                'image' => '9.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Virat',
                'last_name' => 'Anand',
                'email' => 'anand@cf.com',
                'image' => '',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Ali',
                'last_name' => 'Moeen',
                'email' => 'ali.moeen@cf.com',
                'image' => '',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Victoria',
                'last_name' => 'Joseph',
                'email' => 'victoria@cf.com',
                'image' => '5.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Mahima',
                'last_name' => 'Khan',
                'email' => 'khan@cf.com',
                'image' => '',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('email', $d['email']);
            $result = $this->db->get('candidates');
            if ($result->num_rows() <= 0) {
                $this->db->insert('candidates', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importRolesData()
    {
        $data = array(
            array(
                'title' => 'Super Admin',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Interviewer',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'News Manager',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Quiz Designer',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Site Controller',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('roles');
            if ($result->num_rows() <= 0) {
                $this->db->insert('roles', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importDepartmentsData()
    {
        $data = array(
            array(
                'title' => 'Finance',
                'image' => 'finance.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Accounting',
                'image' => 'accounting.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Administration',
                'image' => 'administration.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Marketing',
                'image' => 'marketing.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Human Resource',
                'image' => 'human-resource.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Information Technology',
                'image' => 'information-tech.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('departments');
            if ($result->num_rows() <= 0) {
                $this->db->insert('departments', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importResumeData()
    {
        $data = array(
            array(
                'candidate_id' => '1',
                'title' => 'My Resume 1',
                'designation' => 'Marketing Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                    array('title' => 'German2', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '2',
                'title' => 'My Resume 2',
                'designation' => 'Marketing Executive',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2016-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2016-01-01', 'to' => '2017-12-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2018-01-01', 'to' => '2019-12-15'),
                    array('title' => 'Sr. Manager', 'company' => 'XYZ Corp 2.', 'from' => '2019-04-01', 'to' => '2020-10-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'P.H.D.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                )
            ),
            array(
                'candidate_id' => '3',
                'title' => 'My Resume 3',
                'designation' => 'Public Relations Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'English 2', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'French 2', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '4',
                'title' => 'My Resume 4',
                'designation' => 'Business Developer',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'P.H.D.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),                
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '5',
                'title' => 'My Resume 5',
                'designation' => 'Manager Market Operations',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2017-06-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-02-01', 'to' => '2019-08-30'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'Certification','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '6',
                'title' => 'My Resume 6',
                'designation' => 'Regional Sales Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2012-01-01', 'to' => '2015-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2016-04-01', 'to' => '2018-09-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '7',
                'title' => 'My Resume 7',
                'designation' => 'Business Developer',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2016-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-05-01', 'to' => '2019-10-30'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '8',
                'title' => 'My Resume 8',
                'designation' => 'Marketeer',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2011-01-01', 'to' => '2016-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2017-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '9',
                'title' => 'My Resume 9',
                'designation' => 'Business Developer',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '10',
                'title' => 'My Resume 10',
                'designation' => 'Marketing Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2011-01-01', 'to' => '2013-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2014-01-01', 'to' => '2016-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2017-04-01', 'to' => '2018-02-15'),
                    array('title' => 'Sr. Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'Doctorate','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '11',
                'title' => 'My Resume 11',
                'designation' => 'Area Sales Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '12',
                'title' => 'My Resume 12',
                'designation' => 'Marketing Supervisor',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'M Phil.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'beginner'),
                    array('title' => 'French', 'proficiency' => 'native'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '5',
                'title' => 'My Resume 13',
                'designation' => 'Network Administrator',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'M Phil.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'beginner'),
                    array('title' => 'French', 'proficiency' => 'native'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '6',
                'title' => 'My Resume 14',
                'designation' => 'System Software Architect',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'M Phil.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'beginner'),
                    array('title' => 'French', 'proficiency' => 'native'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $this->db->where('candidate_id', $d['candidate_id']);
            $result = $this->db->get('resumes');
            if ($result->num_rows() <= 0) {
                //Separting dependents
                $experiences = $d['experiences'];
                $qualifications = $d['qualifications'];
                $achievements = $d['achievements'];
                $references = $d['references'];
                $languages = $d['languages'];
                unset($d['experiences'],$d['qualifications'],$d['achievements'],$d['references'],$d['languages']);

                $d['updated_at'] = date('Y-m-d G:i:s');
                $d['created_at'] = date('Y-m-d G:i:s');
                $d['type'] = 'detailed';
                $d['experience'] = getExprienceInMonths($experiences);
                $d['experiences'] = count($experiences);
                $d['qualifications'] = count($qualifications);
                $d['achievements'] = count($achievements);
                $d['references'] = count($references);
                $d['languages'] = count($languages);
                $this->db->insert('resumes', $d);
                $resume_id = $this->db->insert_id();

                //Inserting experiences
                foreach ($experiences as $e) {
                    $e['resume_id'] = $resume_id;
                    $e['updated_at'] = date('Y-m-d G:i:s');
                    $e['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_experiences', $e);
                }

                //Inserting qualifications
                foreach ($qualifications as $q) {
                    $q['resume_id'] = $resume_id;
                    $q['updated_at'] = date('Y-m-d G:i:s');
                    $q['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_qualifications', $q);
                }

                //Inserting achievements
                foreach ($achievements as $a) {
                    $a['resume_id'] = $resume_id;
                    $a['updated_at'] = date('Y-m-d G:i:s');
                    $a['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_achievements', $a);
                }

                //Inserting references
                foreach ($references as $r) {
                    $r['resume_id'] = $resume_id;
                    $r['updated_at'] = date('Y-m-d G:i:s');
                    $r['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_references', $r);
                }

                //Inserting languages
                foreach ($languages as $l) {
                    $l['resume_id'] = $resume_id;
                    $l['updated_at'] = date('Y-m-d G:i:s');
                    $l['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_languages', $l);
                }

                $job_id = $resume_id <= 12 ? 1 : 3;
                $this->importJobBoardData($d['candidate_id'], $job_id, $resume_id);
            }
        }
    }

    public function importJobBoardData($candidate_id, $job_id, $resume_id)
    {
        //Creating a job application entry
        $ja['job_id'] = $job_id;
        $ja['candidate_id'] = $candidate_id;
        $ja['resume_id'] = $resume_id;
        $this->db->insert('job_applications', $ja);
        $ja_id = $this->db->insert_id();

        //Creating a job trait answers entry
        $jts = $this->AdminTraitModel->getJobTraits($job_id);
        $traits_result = array();
        foreach ($jts as $value) {
            $rating =  rand(1,5);
            $traits_result[] = $rating;
            $jt['job_trait_id'] = $value['job_trait_id'];
            $jt['job_trait_title'] = $value['title'];
            $jt['candidate_id'] = $candidate_id;
            $jt['job_application_id'] = $ja_id;
            $jt['rating'] = $rating;
            $this->db->insert('job_trait_answers', $jt);
        }

        //Creating first candidates quizes entries
        $quiz_id = $job_id == 1 ? 2 : 1;
        $quiz_data = $this->AdminQuizModel->getCompleteQuiz($quiz_id);
        $cq['candidate_id'] = $candidate_id;
        $cq['job_id'] = $job_id;
        $cq['quiz_title'] = $quiz_data['quiz']['title'];
        $cq['total_questions'] = count($quiz_data['questions']);
        $cq['allowed_time'] = $quiz_data['quiz']['allowed_time'];
        $cq['correct_answers'] = rand(1,count($quiz_data['questions']));
        $cq['started_at'] = '2019-01-01 00:00:00';
        $cq['attempt'] = 15;
        $cq['quiz_data'] = json_encode($quiz_data);
        $this->db->insert('candidate_quizes', $cq);

        //Creating second candidates quizes entries
        $quiz_data = $this->AdminQuizModel->getCompleteQuiz(3);
        $cq['candidate_id'] = $candidate_id;
        $cq['job_id'] = $job_id;
        $cq['quiz_title'] = $quiz_data['quiz']['title'];
        $cq['total_questions'] = count($quiz_data['questions']);
        $cq['allowed_time'] = $quiz_data['quiz']['allowed_time'];
        $cq['correct_answers'] = rand(1,15);
        $cq['started_at'] = '2019-01-01 00:00:00';
        $cq['attempt'] = 15;
        $cq['quiz_data'] = json_encode($quiz_data);
        $this->db->insert('candidate_quizes', $cq);

        //Creating candidate interview entry
        $interview_data = $this->AdminInterviewModel->getCompleteInterview(3);
        $ci['candidate_id'] = $candidate_id;
        $ci['job_id'] = $job_id;
        $ci['user_id'] = rand(2,10);
        $ci['interview_title'] = $interview_data['interview']['title'];
        $ci['total_questions'] = count($interview_data['questions']);
        $ci['overall_rating'] = rand(1,250);
        $ci['status'] = 1;
        $ci['created_at'] = date('Y-m-d G:i:s');
        $ci['interview_data'] = json_encode($interview_data);
        $this->db->insert('candidate_interviews', $ci);

        //Updating overall results
        $array = array('candidate_id' => $candidate_id, 'job_id' => $job_id);
        $this->AdminJobBoardModel->updateTraitResultInJobApplication($traits_result, $array);                
        $this->AdminJobBoardModel->updateQuizResultInJobApplication($array);
        $this->AdminJobBoardModel->updateInterviewResultInJobApplication($array);                
        $this->AdminJobBoardModel->updateOverallResultInJobApplication($array);

    }

    public function importCompaniesData()
    {
        $data = array(
            array(
                'title' => 'ABC Inc.',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'XYZ Enterprises',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('companies');
            if ($result->num_rows() <= 0) {
                $this->db->insert('companies', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importLanguagesData()
    {
        $data = array(
            array(
                'title' => 'English',
                'slug' => 'english',
                'status' => 1,
                'is_selected' => 1,
                'is_default' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Chinese',
                'slug' => 'chinese',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Danish',
                'slug' => 'danish',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Dutch',
                'slug' => 'dutch',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'French',
                'slug' => 'french',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'German',
                'slug' => 'german',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Italian',
                'slug' => 'italian',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Polish',
                'slug' => 'polish',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Russian',
                'slug' => 'russian',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Spanish',
                'slug' => 'spanish',
                'status' => 1,
                'is_selected' => 0,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('languages');
            if ($result->num_rows() <= 0) {
                $this->db->insert('languages', $d);
            }
        }
    }

    public function importTraitsData()
    {
        $data = array(
            array(
                'title' => 'Communication',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Punctuality',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Attention to detail',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Report Writing',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Presentation Skills',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('traits');
            if ($result->num_rows() <= 0) {
                $this->db->insert('traits', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importJobsData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array(
                'title' => 'Marketing Executive',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,
                'department_id' => 4,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'quizes' => array(
                    array('quiz_id' => '2', 'created_at' => $ca, 'allowed_time' => 30),
                    array('quiz_id' => '3', 'created_at' => $ca, 'allowed_time' => 30),
                ),
            ),
            array(
                'title' => 'Accounts Manager',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,                
                'department_id' => 2,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Computer System Analyst',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,                
                'department_id' => 6,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'quizes' => array(
                    array('quiz_id' => '1', 'created_at' => $ca, 'allowed_time' => 30),
                    array('quiz_id' => '3', 'created_at' => $ca, 'allowed_time' => 30),
                ),
            ),
            array(
                'title' => 'Network Administrator',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,                
                'department_id' => 6,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Project Manager',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'HR Business Partner',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 5,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Quality Supervisor',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Sr. Software Engineer',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 6,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Support Staff',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Warehouse Supervisor',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Legal Advisor',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'CTO',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        $ids = array();
        foreach ($data as $d) {
            $quizes = isset($d['quizes']) ? $d['quizes'] : array();
            unset($d['quizes']);
            $this->db->where('title', $d['title']);
            $result = $this->db->get('jobs');
            if ($result->num_rows() <= 0) {
                $this->db->insert('jobs', $d);
                $id = $this->db->insert_id();
                foreach ($quizes as $quiz) {
                    $quiz_data = $this->AdminQuizModel->getCompleteQuiz($quiz['quiz_id']);
                    $quiz['job_id'] = $id;
                    $quiz['total_questions'] = count($quiz_data['questions']);
                    $quiz['allowed_time'] = $quiz['allowed_time'];
                    $quiz['quiz_data'] = json_encode($quiz_data);
                    $quiz['quiz_title'] = $quiz_data['quiz']['title'];
                    $this->db->insert('job_quizes', $quiz);
                }
                $ids[] = $id;
            }
        }
        $this->importJobTraitsData($ids);        
    }

    public function importJobFavoritesData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array('job_id' => 5, 'candidate_id' => 1, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 2, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 3, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 4, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 5, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 6, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 6, 'candidate_id' => 3, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 6, 'candidate_id' => 4, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 6, 'candidate_id' => 6, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 6, 'candidate_id' => 7, 'created_at' => date('Y-m-d G:i:s'),),
        );
        $ids = array();
        foreach ($data as $d) {
            $this->db->where('job_id', $d['job_id']);
            $this->db->where('candidate_id', $d['candidate_id']);
            $result = $this->db->get('job_favorites');
            if ($result->num_rows() <= 0) {
                $this->db->insert('job_favorites', $d);
            }
        }
    }

    public function importJobReferredData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array('job_id' => 10, 'candidate_id' => 1, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 2, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 3, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 4, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 5, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 6, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 11, 'candidate_id' => 3, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 11, 'candidate_id' => 4, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 11, 'candidate_id' => 6, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 11, 'candidate_id' => 7, 'created_at' => date('Y-m-d G:i:s'),),
        );
        $ids = array();
        foreach ($data as $d) {
            $this->db->where('job_id', $d['job_id']);
            $this->db->where('candidate_id', $d['candidate_id']);
            $result = $this->db->get('job_referred');
            if ($result->num_rows() <= 0) {
                $this->db->insert('job_referred', $d);
            }
        }
    }

    public function importBlogCategoriesData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array(
                'title' => 'Category 1',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Category 2',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Category 3',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        $ids = array();
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('blog_categories');
            if ($result->num_rows() <= 0) {
                $this->db->insert('blog_categories', $d);
            }
        }
    }

    public function importBlogsData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array(
                'title' => 'Frequently Asked Questions',
                'description' => getTextFromFile('job.txt'),
                'blog_category_id' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'How to Apply',
                'description' => getTextFromFile('job.txt'),
                'blog_category_id' => 1,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Quiz Timings',
                'description' => getTextFromFile('job.txt'),
                'blog_category_id' => 1,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Privacy Policy',
                'description' => getTextFromFile('job.txt'),
                'blog_category_id' => 1,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Lorem Ipsum Post',
                'description' => getTextFromFile('job.txt'),
                'blog_category_id' => 2,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Lorem Ipsum Post 2',
                'description' => getTextFromFile('job.txt'),
                'blog_category_id' => 2,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array( 
                'title' => 'Lorem Ipsum Post 3',
                'description' => getTextFromFile('job.txt'),
                'blog_category_id' => 2,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Lorem Ipsum Post 4',
                'description' => getTextFromFile('job.txt'),
                'blog_category_id' => 2,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        $ids = array();
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('blogs');
            if ($result->num_rows() <= 0) {
                $this->db->insert('blogs', $d);
            }
        }
    }

    public function importJobTraitsData($job_ids)
    {
        $this->db->from('traits');
        $traits = $this->db->get();
        $traits = objToArr($traits->result());
        foreach ($traits as $d) {
            foreach ($job_ids as $job_id) {
                $this->db->where('title', $d['title']);
                $this->db->where('job_id', $job_id);
                $result = $this->db->get('job_traits');
                if ($result->num_rows() <= 0) {
                    $d2 = array(
                        'job_id' => $job_id, 
                        'trait_id' => $d['trait_id'], 
                        'title' => $d['title'],
                        'created_at' => date('Y-m-d G:i:s'),
                    );
                    $this->db->insert('job_traits', $d2);
                }
            }
        }
    }

    public function importPermissionsData()
    {
        $data = array(
            //Dashboard
            array('category' => 'Dashboard', 'title' => 'View Dashboard Stats', 'slug' => 'view_dashboard_stats',),
            array('category' => 'Dashboard', 'title' => 'View Job chart', 'slug' => 'view_job_chart',),
            array('category' => 'Dashboard', 'title' => 'View Candidate chart', 'slug' => 'view_candidate_chart',),
            array('category' => 'Dashboard', 'title' => 'View Jobs Status', 'slug' => 'view_jobs_status',),
            array('category' => 'Dashboard', 'title' => 'To Do List', 'slug' => 'to_do_list',),
            //Job Board
            array('category' => 'Job Board', 'title' => 'View Job Board', 'slug' => 'view_job_board',),
            array('category' => 'Job Board', 'title' => 'Actions Job Board', 'slug' => 'actions_job_board',),
            //Interviews
            array('category' => 'Interviews', 'title' => 'View & Conduct Interviews', 'slug' => 'view_conduct_interviews',),
            //Jobs
            array('category' => 'Jobs', 'title' => 'View Jobs', 'slug' => 'view_jobs',),
            array('category' => 'Jobs', 'title' => 'Create Jobs', 'slug' => 'create_jobs',),
            array('category' => 'Jobs', 'title' => 'Edit Jobs', 'slug' => 'edit_jobs',),
            array('category' => 'Jobs', 'title' => 'Delete Jobs', 'slug' => 'delete_jobs',),
            //Companies
            array('category' => 'Companies', 'title' => 'View Companies', 'slug' => 'view_companies',),
            array('category' => 'Companies', 'title' => 'Create Companies', 'slug' => 'create_companies',),
            array('category' => 'Companies', 'title' => 'Edit Companies', 'slug' => 'edit_companies',),
            array('category' => 'Companies', 'title' => 'Delete Companies', 'slug' => 'delete_companies',),
            //Departments
            array('category' => 'Departments', 'title' => 'View Departments', 'slug' => 'view_departments',),
            array('category' => 'Departments', 'title' => 'Create Departments', 'slug' => 'create_departments',),
            array('category' => 'Departments', 'title' => 'Edit Departments', 'slug' => 'edit_departments',),
            array('category' => 'Departments', 'title' => 'Delete Departments', 'slug' => 'delete_departments',),
            //Quizes
            array('category' => 'Quizes', 'title' => 'View Questions', 'slug' => 'view_quiz_questions',),
            array('category' => 'Quizes', 'title' => 'Add Questions', 'slug' => 'add_quiz_questions',),
            array('category' => 'Quizes', 'title' => 'Edit Questions', 'slug' => 'edit_quiz_questions',),
            array('category' => 'Quizes', 'title' => 'Delete Questions', 'slug' => 'delete_quiz_questions',),
            array('category' => 'Quizes', 'title' => 'View Quizes', 'slug' => 'view_quizes',),
            array('category' => 'Quizes', 'title' => 'Add Quizes', 'slug' => 'add_quizes',),
            array('category' => 'Quizes', 'title' => 'Edit Quizes', 'slug' => 'edit_quizes',),
            array('category' => 'Quizes', 'title' => 'Delete Quizes', 'slug' => 'delete_quizes',),
            array('category' => 'Quizes', 'title' => 'Clone Quizes', 'slug' => 'clone_quizes',),
            array('category' => 'Quizes', 'title' => 'Download Quizes', 'slug' => 'download_quizes',),
            //Interviews
            array('category' => 'Interviews', 'title' => 'View Questions', 'slug' => 'view_interview_questions',),
            array('category' => 'Interviews', 'title' => 'Add Questions', 'slug' => 'add_interview_questions',),
            array('category' => 'Interviews', 'title' => 'Edit Questions', 'slug' => 'edit_interview_questions',),
            array('category' => 'Interviews', 'title' => 'Delete Questions', 'slug' => 'delete_interview_questions',),
            array('category' => 'Interviews', 'title' => 'View Interviews', 'slug' => 'view_interviews',),
            array('category' => 'Interviews', 'title' => 'Add Interviews', 'slug' => 'add_interviews',),
            array('category' => 'Interviews', 'title' => 'Edit Interviews', 'slug' => 'edit_interviews',),
            array('category' => 'Interviews', 'title' => 'Delete Interviews', 'slug' => 'delete_interviews',),
            array('category' => 'Interviews', 'title' => 'Clone Interviews', 'slug' => 'clone_interviews',),
            array('category' => 'Interviews', 'title' => 'Download Interviews', 'slug' => 'download_interviews',),
            array('category' => 'Interviews', 'title' => 'All Candidate Interviews', 'slug' => 'all_candidate_interviews',),
            //Traits
            array('category' => 'Traits', 'title' => 'View Traits', 'slug' => 'view_traits',),
            array('category' => 'Traits', 'title' => 'Create Traits', 'slug' => 'create_traits',),
            array('category' => 'Traits', 'title' => 'Edit Traits', 'slug' => 'edit_traits',),
            array('category' => 'Traits', 'title' => 'Delete Traits', 'slug' => 'delete_traits',),
            //Question Categories
            array('category' => 'Question Categories', 'title' => 'View Question Categories', 'slug' => 'view_question_categories',),
            array('category' => 'Question Categories', 'title' => 'Create Question Categories', 'slug' => 'create_question_categories',),
            array('category' => 'Question Categories', 'title' => 'Edit Question Categories', 'slug' => 'edit_question_categories',),
            array('category' => 'Question Categories', 'title' => 'Delete Question Categories', 'slug' => 'delete_question_categories',),
            //Quiz Categories
            array('category' => 'Quiz Categories', 'title' => 'View Quiz Categories', 'slug' => 'view_quiz_categories',),
            array('category' => 'Quiz Categories', 'title' => 'Create Quiz Categories', 'slug' => 'create_quiz_categories',),
            array('category' => 'Quiz Categories', 'title' => 'Edit Quiz Categories', 'slug' => 'edit_quiz_categories',),
            array('category' => 'Quiz Categories', 'title' => 'Delete Quiz Categories', 'slug' => 'delete_quiz_categories',),
            //Interview Categories
            array('category' => 'Interview Categories', 'title' => 'View Interview Categories', 'slug' => 'view_interview_categories',),
            array('category' => 'Interview Categories', 'title' => 'Create Interview Categories', 'slug' => 'create_interview_categories',),
            array('category' => 'Interview Categories', 'title' => 'Edit Interview Categories', 'slug' => 'edit_interview_categories',),
            array('category' => 'Interview Categories', 'title' => 'Delete Interview Categories', 'slug' => 'delete_interview_categories',),
            //Questions
            array('category' => 'Questions', 'title' => 'View Questions', 'slug' => 'view_questions',),
            array('category' => 'Questions', 'title' => 'Create Questions', 'slug' => 'create_questions',),
            array('category' => 'Questions', 'title' => 'Edit Questions', 'slug' => 'edit_questions',),
            array('category' => 'Questions', 'title' => 'Delete Questions', 'slug' => 'delete_questions',),
            //Team
            array('category' => 'Team', 'title' => 'View Team Listing', 'slug' => 'view_team_listing',),
            array('category' => 'Team', 'title' => 'Add Team Member', 'slug' => 'add_team_member',),
            array('category' => 'Team', 'title' => 'Edit Team Member', 'slug' => 'edit_team_member',),
            array('category' => 'Team', 'title' => 'Delete Team Member', 'slug' => 'delete_team_member',),
            array('category' => 'Team', 'title' => 'View Roles', 'slug' => 'view_roles',),
            array('category' => 'Team', 'title' => 'Add Role', 'slug' => 'add_role',),
            array('category' => 'Team', 'title' => 'Edit Role', 'slug' => 'edit_role',),
            array('category' => 'Team', 'title' => 'Delete Role', 'slug' => 'delete_role',),
            //Candidates
            array('category' => 'Candidates', 'title' => 'View Candidate Listing', 'slug' => 'view_candidate_listing',),
            array('category' => 'Candidates', 'title' => 'Delete Candidate', 'slug' => 'delete_candidate',),
            //Blog
            array('category' => 'Blog', 'title' => 'View Blog Listing', 'slug' => 'view_blog_listing',),
            array('category' => 'Blog', 'title' => 'Add Blog', 'slug' => 'add_blog',),
            array('category' => 'Blog', 'title' => 'Edit Blog', 'slug' => 'edit_blog',),
            array('category' => 'Blog', 'title' => 'Delete Blog', 'slug' => 'delete_blog',),
            array('category' => 'Blog', 'title' => 'View Blog Categories', 'slug' => 'view_blog_categories',),
            array('category' => 'Blog', 'title' => 'Add Blog Categories', 'slug' => 'add_blog_categories',),
            array('category' => 'Blog', 'title' => 'Edit Blog Categories', 'slug' => 'edit_blog_categories',),
            array('category' => 'Blog', 'title' => 'Delete Blog Categories', 'slug' => 'delete_blog_categories',),
            //Settings
            array('category' => 'Settings', 'title' => 'General', 'slug' => 'general_settings',),
            array('category' => 'Settings', 'title' => 'Home Page', 'slug' => 'home_page_settings',),
            array('category' => 'Settings', 'title' => 'Footer', 'slug' => 'footer_settings',),
            array('category' => 'Settings', 'title' => 'Apis', 'slug' => 'apis_settings',),
            array('category' => 'Settings', 'title' => 'Css', 'slug' => 'css_settings',),
            array('category' => 'Settings', 'title' => 'Languages', 'slug' => 'languages_settings',),
            array('category' => 'Settings', 'title' => 'Update App', 'slug' => 'update_application',),
        );
        foreach ($data as $d) {
            $this->db->where('slug', $d['slug']);
            $result = $this->db->get('permissions');
            if ($result->num_rows() <= 0) {
                $this->db->insert('permissions', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importToDos()
    {
        $data = array(
            array('user_id' => '1', 'status' => '1', 'title' => 'Create a Job', 'description' => 'Create a Job',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Add Team Member', 'description' => 'Add Team Member',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Take Interview', 'description' => 'Take Interview',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Edit Quizes', 'description' => 'Edit Quizes',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Make Blog Post', 'description' => 'Make Blog Post',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Create a Job 2', 'description' => 'Create a Job',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Add Team Member 2', 'description' => 'Add Team Member',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Take Interview 2', 'description' => 'Take Interview',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Edit Quizes 2', 'description' => 'Edit Quizes',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Make Blog Post 2', 'description' => 'Make Blog Post',),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('to_dos');
            if ($result->num_rows() <= 0) {
                $this->db->insert('to_dos', $d);
            }
        }
    }

    public function importUpdate()
    {
        $data = array(
            array('title' => 'Initial', 'version' => '1.3', 'details' => 'Initial Installation<br />', 'files' => '', 'is_current' => 1, 'released_at' => '2020-11-20 00:00:00', 'created_at' => date('Y-m-d G:i:s')),
        );
        foreach ($data as $d) {
            $this->db->where('version', $d['version']);
            $result = $this->db->get('updates');
            if ($result->num_rows() <= 0) {
                $this->db->insert('updates', $d);
            }
        }
    }

    public function importFooterSections()
    {
        $data = array(
            array(
                'title' => 'Column 1',
                'content' => getTextFromFile('col1.txt'),
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 2',
                'content' => '<div class="footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><a href="'.CF_BASE_URL.'/blog/'.encode(2).'">How To Apply</a></li>
                                <li><a href="'.CF_BASE_URL.'/jobs">Latest Jobs</a></li>
                                <li><a href="'.CF_BASE_URL.'/account">My Account</a></li>
                                <li><a href="'.CF_BASE_URL.'/blogs">News & Announcements</a></li>
                                <li><a href="'.CF_BASE_URL.'/blog/'.encode(4).'">Privacy policy</a></li>
                            </ul>
                            </div>',
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 3',
                'content' => '<div class="footer-links">
                            <h4>Latest Jobs</h4>
                            <ul>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(1).'">Marketing Executive</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(2).'">Accounts Manager</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(3).'">Computer System Analyst</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(4).'">Network Administrator</a></li>
                                <li><a href="'.CF_BASE_URL.'/job/'.encode(5).'">Project Manager</a></li>
                            </ul>
                            </div>',
                'updated_at' => date('Y-m-d G:i:s')
            ),
            array(
                'title' => 'Column 4',
                'content' => getTextFromFile('col2.txt'),
                'updated_at' => date('Y-m-d G:i:s')
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('footer_sections');
            if ($result->num_rows() <= 0) {
                $this->db->insert('footer_sections', $d);
            }
        }
    }    

    public function importSettings()
    {
        $googleTut = '<a href="https://code.tutsplus.com/tutorials/create-a-google-login-page-in-php--cms-33214" target="_blank">Google Login</a>';
        $linkedinTut = '<a href="https://www.linkedin.com/developers/login" target="_blank">Linkedin Login</a>';
        $shareThisTut = '<a target="_blank" href="https://sharethis.com/">Share This</a>';
        $smtpTutorial = '<a href="#">Email Settings</a>';
        $bannerText = '<h2>Looking for an exciting career path ?<br>Come, Join Us!</h2>
        <a href="'.CF_BASE_URL.'/register" class="btn-get-started scrollto">Register Now</a>';

        $data = array(

            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'default-landing-page', 'value' => 'home', 'description' => 'Default landing page', 'options' => '["home", "jobs", "news"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'home-banner', 'value' => 'yes', 'description' => 'Display home page banner', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'how-it-works', 'value' => 'yes', 'description' => 'Enable How it works section', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'department-section', 'value' => 'yes', 'description' => 'Enable Department Section', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Home', 'key' => 'news-section', 'value' => 'yes', 'description' => 'Enable News Section', 'options' => '["yes", "no"]'),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'banner-text', 
                'value' => $bannerText, 'description' => 'Banner Text', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'before-how', 'value' => '', 
                'description' => 'Text Before How It Works Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'after-how', 'value' => '', 
                'description' => 'Text After How It Works Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'before-news', 'value' => '', 
                'description' => 'Text Before News Section', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'Home', 'key' => 'after-news', 'value' => '', 
                'description' => 'Text After News Section', 'options' => ''),

            array('type' => 'image', 'user_id' => 0, 'category' => 'General', 'key' => 'site-logo', 'value' => 'site-logo.png', 'description' => 'Select site logo'),
            array('type' => 'image', 'user_id' => 0, 'category' => 'General', 'key' => 'site-banner-image', 'value' => '', 'description' => 'Select home page banner'),
            array('type' => 'image', 'user_id' => 0, 'category' => 'General', 'key' => 'site-favicon', 'value' => 'site-favicon.png', 'description' => 'Select favicon'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'site-name', 'value' => 'Candidate Finder', 'description' => 'Define site name', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'admin-email', 'value' => 'admin@example.com', 'description' => 'Define admin email', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'purchase-code', 'value' => 'test', 'description' => 'Enter purchase code', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'General', 'key' => 'site-keywords', 'value' => 'candidate finder', 'description' => 'Define Site Keywords', 'options' => ''),
            array('type' => 'textarea', 'user_id' => 0, 'category' => 'General', 'key' => 'site-description', 'value' => 'candidate finder', 'description' => 'Define Site Description', 'options' => ''),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'jobs-limit', 'value' => '10', 'description' => 'No of jobs to display per page', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'blogs-limit', 'value' => '10', 'description' => 'No of blogs to display per page', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'charts-limit', 'value' => '5', 'description' => 'Chart elements count on Dashboard', 'options' => '["5", "10", "25", "50"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-email-verification', 'value' => 'yes', 'description' => 'Enable email verification on register.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-forgot-password', 'value' => 'yes', 'description' => 'Enable forgot/recover password feature.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-register', 'value' => 'yes', 'description' => 'Enable new user register feature.', 'options' => '["yes", "no"]'),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'enable-multiple-resume', 'value' => 'no', 'description' => 'Enable multiple resume for a candidate.', 'options' => '["yes", "no"]'),

            array('type' => 'heading', 'user_id' => 0, 'category' => 'General', 'key' => $smtpTutorial, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp', 'value' => 'no', 'description' => 'Enable external smtp for emails (selecting no will use default hosting email settings e.g. sendmail)', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-host', 'value' => 'ssl://smtp.googlemail.com', 'description' => 'Define smtp host.', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-port', 'value' => '465', 'description' => 'Define smtp port.', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-username', 'value' => 'your-gmail@gmail.com', 'description' => 'Define smtp username.', 'options' => ''),
            array('type' => 'password', 'user_id' => 0, 'category' => 'General', 'key' => 'smtp-password', 'value' => 'Abcd1234!', 'description' => 'Define smtp password.', 'options' => ''),


            //Apis menu
            array('type' => 'heading', 'user_id' => 0, 'category' => 'Apis', 'key' => $googleTut, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Apis', 'key' => 'enable-google-login', 'value' => 'yes', 'description' => 'Enable google login.', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-client-id', 'value' => 'abcd1234', 'description' => 'Define Google client id', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-client-secret', 'value' => 'abcd1234', 'description' => 'Define Google client secret', 'options' => ''),
            array('type' => 'readonly', 'user_id' => 0, 'category' => 'Apis', 'key' => 'google-app-redirect', 'value' => CF_BASE_URL.'/google-redirect', 'description' => 'Paste this redirect uri in google app console.', 'options' => ''),

            array('type' => 'heading', 'user_id' => 0, 'category' => 'Apis', 'key' => $linkedinTut, 'value' => '', 'description' => '',),
            array('type' => 'radio', 'user_id' => 0, 'category' => 'Apis', 'key' => 'enable-linkedin-login', 'value' => 'yes', 'description' => 'Enable linkedin login.', 'options' => '["yes", "no"]'),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-id', 'value' => 'abcd1234', 'description' => 'Define linkedin App id', 'options' => ''),
            array('type' => 'text', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-secret', 'value' => 'abcd1234', 'description' => 'Define linkedin App secret', 'options' => ''),
            array('type' => 'readonly', 'user_id' => 0, 'category' => 'Apis', 'key' => 'linkedin-app-redirect', 'value' => CF_BASE_URL.'/linkedin-redirect', 'description' => 'Paste this redirect uri in linkedin app console.', 'options' => ''),

            //Colors Alignment menu
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'banner-text-color',  'value' => '#f4f4f4', 'description' => 'Select Banner text color'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'site-background',  'value' => '#f4f4f4', 'description' => 'Select background color for site content area (#f4f4f4)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'headings-underline-color',  'value' => '#56c7ff', 'description' => 'Select colors for heading underline (#56c7ff)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-background', 'value' => '#1D3352', 'description' => 'Select background color for footer (#1D3352)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-items-color', 'value' => '#FFFFFF', 'description' => 'Select items color for footer (#FFFFFF)'),
            array('type' => 'color', 'user_id' => 0, 'category' => 'Colors', 'key' => 'footer-social-icons-color',  'value' => '#56c7ff', 'description' => 'Define color for footer social icons (#56c7ff)'),

        );

        foreach ($data as $d) {
            $d['value'] = str_replace('"', "'", $d['value']);
            $this->db->where('key', $d['key']);
            $this->db->where('user_id', 0);
            $result = $this->db->get('settings');
            if ($result->num_rows() <= 0) {
                $this->db->insert('settings', $d);
            }
        }
    }
}