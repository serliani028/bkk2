<?php

class SchemaModel extends CI_Model
{
    public function __construct()
    {
        $this->load->dbforge();
    }

    public function run()
    {
        $this->createUsersTable();
        $this->createRolesTable();
        $this->createPermissionsTable();
        $this->createRolePermissionsTable();
        $this->createUserRolesTable();
        $this->createCandidatesTable();
        $this->createResumeTable();
        $this->addColumnToResumeTable();
        $this->createResumeExperienceTable();
        $this->createResumeLanguageTable();
        $this->createResumeQualificationTable();
        $this->createResumeAchievementsTable();
        $this->createResumeReferencesTable();
        $this->createJobsTable();
        $this->createJobsCustomFieldsTable();
        $this->createDepartmentsTable();
        $this->createCompaniesTable();
        $this->createTraitsTable();
        $this->createJobTraitsTable();
        $this->createJobTraitAnswersTable();
        $this->createJobApplicationsTable();
        $this->createJobFavoritesTable();
        $this->createJobReferredTable();
        $this->createBlogCategoriesTable();
        $this->createBlogsTable();
        $this->createFooterSectionsTable();
        $this->createSettingsTable();
        $this->createToDosTable();
        $this->createLanguagesTable();
        $this->createAppUpdateTable();
    }

    private function createUsersTable()
    {
        $fields = array(
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'first_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'last_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'username' => array('type' => 'VARCHAR', 'constraint' => '100', 'unique' => TRUE,),
            'email' => array('type' => 'VARCHAR', 'constraint' => '150', 'unique' => TRUE,),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'password' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'status' => array('type' => 'TINYINT',),
            'token' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'user_type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'admin',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('users', $fields, 'user_id');
    }

    private function createCandidatesTable()
    {
        $fields = array(
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'first_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'last_name' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'email' => array('type' => 'VARCHAR', 'constraint' => '150', 'unique' => TRUE,),
            'password' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'phone1' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'phone2' => array('type' => 'VARCHAR', 'constraint' => '30', 'null' => TRUE,),
            'city' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'state' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'country' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'address' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'gender' => array('type' => 'VARCHAR', 'constraint' => '150', 'null' => TRUE,),
            'dob' => array('type' => 'DATETIME', 'null' => TRUE,),
            'bio' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'account_type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'site', 'null' => TRUE,),
            'external_id' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE,),
            'token' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('candidates', $fields, 'candidate_id');
    }

    private function createResumeTable()
    {
        $fields = array(
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'designation' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'objective' => array('type' => 'TEXT',),
            'status' => array('type' => 'TINYINT',),
            'type' => array('type' => 'VARCHAR', 'constraint' => '30', 'default' => 'detailed', 'null' => TRUE,),
            'file' => array('type' => 'VARCHAR', 'constraint' => '200',),
            'experience' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'experiences' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'qualifications' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'languages' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'achievements' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'references' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'is_default' => array('type' => 'TINYINT', 'default' => 1),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resumes', $fields, 'resume_id');
    }

    private function addColumnToResumeTable()
    {
        if ($this->db->table_exists('resumes')) {
            if (!$this->db->field_exists('is_default', 'resumes')) {
                $field = array('is_default' => array('type' => 'TINYINT', 'default' => 1, 'after' => 'references'));
                $this->dbforge->add_column('resumes', $field);
            }
        }
    }

    private function createResumeExperienceTable()
    {
        $fields = array(
            'resume_experience_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'company' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'from' => array('type' => 'DATETIME', 'null' => TRUE,),
            'to' => array('type' => 'DATETIME', 'null' => TRUE,),
            'description' => array('type' => 'TEXT',),
            'is_current' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_experiences', $fields, 'resume_experience_id');
    }

    private function createResumeLanguageTable()
    {
        $fields = array(
            'resume_language_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'proficiency' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_languages', $fields, 'resume_language_id');
    }

    private function createResumeQualificationTable()
    {
        $fields = array(
            'resume_qualification_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'institution' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'marks' => array('type' => 'DOUBLE',),
            'out_of' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'from' => array('type' => 'DATETIME', 'null' => TRUE,),
            'to' => array('type' => 'DATETIME', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_qualifications', $fields, 'resume_qualification_id');
    }

    private function createResumeAchievementsTable()
    {
        $fields = array(
            'resume_achievement_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'link' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'date' => array('type' => 'DATETIME', 'null' => TRUE,),
            'type' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_achievements', $fields, 'resume_achievement_id');
    }

    private function createResumeReferencesTable()
    {
        $fields = array(
            'resume_reference_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'relation' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'company' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'email' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('resume_references', $fields, 'resume_reference_id');
    }

    private function createRolesTable()
    {
        $fields = array(
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('roles', $fields, 'role_id');
    }

    private function createPermissionsTable()
    {
        $fields = array(
            'permission_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'category' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '100',),
        );
        $this->createTable('permissions', $fields, 'permission_id');
    }

    private function createRolePermissionsTable()
    {
        $fields = array(
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'permission_id' => array('type' => 'INT', 'unsigned' => TRUE,),
        );
        $this->createTable('role_permissions', $fields);
    }

    private function createUserRolesTable()
    {
        $fields = array(
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'role_id' => array('type' => 'INT', 'unsigned' => TRUE,),
        );
        $this->createTable('user_roles', $fields);
    }

    private function createPagesTable()
    {
        $fields = array(
            'page_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'default' => 0,),
            'sidebar_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'sidebar_alignment' => array('type' => 'ENUM("left","right")', 'default' => 'right',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '150',),
            'description' => array('type' => 'TEXT',),
            'keywords' => array('type' => 'TEXT',),
            'summary' => array('type' => 'TEXT',),
            'status' => array('type' => 'TINYINT',),
            'is_default' => array('type' => 'TINYINT',),
            'is_home' => array('type' => 'TINYINT',),
            'order' => array('type' => 'TINYINT', 'default' => 0,),
            'is_menu_enabled' => array('type' => 'TINYINT', 'default' => 1,),
            'parent_id' => array('type' => 'INT', 'default' => 0,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('pages', $fields, 'page_id');
    }

    private function createFooterSectionsTable()
    {
        $fields = array(
            'footer_section_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'content' => array('type' => 'TEXT',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('footer_sections', $fields, 'footer_section_id');
    }    

    private function createSettingsTable()
    {
        $fields = array(
            'setting_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'type' => array('type' => 'VARCHAR', 'constraint' => '80', 'null' => TRUE,),
            'category' => array('type' => 'VARCHAR', 'constraint' => '80', 'null' => TRUE,),
            'description' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'key' => array('type' => 'VARCHAR', 'constraint' => '250',),
            //'value' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
            'value' => array('type' => 'TEXT', 'null' => TRUE,),
            'options' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE,),
        );
        $this->createTable('settings', $fields, 'setting_id');
    }

    private function createToDosTable()
    {
        $fields = array(
            'to_do_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('to_dos', $fields, 'to_do_id');
    }

    private function createJobsTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'company_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'department_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'is_static_allowed' => array('type' => 'TINYINT', 'default' => '0',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('jobs', $fields, 'job_id');
    }

    private function createJobsCustomFieldsTable()
    {
        $fields = array(
            'custom_field_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'label' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'value' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_custom_fields', $fields, 'custom_field_id');
    }

    private function createDepartmentsTable()
    {
        $fields = array(
            'department_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('departments', $fields, 'department_id');
    }

    private function createCompaniesTable()
    {
        $fields = array(
            'company_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('companies', $fields, 'company_id');
    }

    private function createTraitsTable()
    {
        $fields = array(
            'trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('traits', $fields, 'trait_id');
    }

    private function createJobTraitsTable()
    {
        $fields = array(
            'job_trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_traits', $fields, 'job_trait_id');
    }

    private function createJobTraitAnswersTable()
    {
        $fields = array(
            'job_trait_answer_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_trait_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_trait_title' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => TRUE),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'job_application_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'rating' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_trait_answers', $fields, 'job_trait_answer_id');
    }

    private function createJobApplicationsTable()
    {
        $fields = array(
            'job_application_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'resume_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'status' => array('type' => 'ENUM("applied","shortlisted","interviewed","hired","rejected")', 'default' => 'applied',),            
            'traits_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'quizes_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'interviews_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'overall_result' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE, 'default' => '0'),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_applications', $fields, 'job_application_id');
    }

    private function createJobFavoritesTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_favorites', $fields);
    }

    private function createJobReferredTable()
    {
        $fields = array(
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'candidate_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'email' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '50',),
            'name' => array('type' => 'VARCHAR', 'constraint' => '50',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('job_referred', $fields);
    }

    private function createBlogCategoriesTable()
    {
        $fields = array(
            'blog_category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('blog_categories', $fields, 'blog_category_id');
    }

    private function createBlogsTable()
    {
        $fields = array(
            'blog_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'blog_category_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'TEXT',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('blogs', $fields, 'blog_id');
    }    

    private function createLanguagesTable()
    {
        $fields = array(
            'language_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT',),
            'is_selected' => array('type' => 'TINYINT',),
            'is_default' => array('type' => 'TINYINT', 'default' => '0',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('languages', $fields, 'language_id');
    }

    private function createAppUpdateTable()
    {
        $fields = array(
            'update_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'version' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'details' => array('type' => 'TEXT', 'null' => TRUE,),
            'files' => array('type' => 'TEXT', 'null' => TRUE,),
            'is_current' => array('type' => 'TINYINT', 'default' => '0',),
            'released_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('updates', $fields, 'update_id');
    }

    private function createTable($table, $fields, $key = null)
    {
        $this->dbforge->add_field($fields);
        if ($key) {
            $this->dbforge->add_key($key, TRUE);
        }
        $this->dbforge->create_table($table, TRUE);
    }
}