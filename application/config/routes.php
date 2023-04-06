<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|ki
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Admin Prakerja routes

//Admin User(outer) routes

$route['perusahaan'] = 'perusahaan/pages/index';
$route['login-perusahaan/(:any)'] = 'perusahaan/auth/loginView/$1';
$route['post-login-perusahaan'] = 'perusahaan/auth/login';
$route['daftar-perusahaan'] = 'perusahaan/auth/daftar_ph';
$route['perusahaan/logout'] = 'perusahaan/auth/logout';
$route['perusahaan/admin'] = 'perusahaan/admin/dashboard';

//Perusahaan Dashboard Routes
$route['perusahaan/admin/dashboard'] = 'perusahaan/admin/dashboard/index';
$route['perusahaan/admin/dashboard/popular-jobs-data_ph'] = 'perusahaan/admin/dashboard/popularJobsChartData';
$route['perusahaan/admin/dashboard/top-candidates-data'] = 'perusahaan/admin/dashboard/topCandidatesChartData';
$route['perusahaan/admin/dashboard/jobs-list'] = 'perusahaan/admin/dashboard/jobsList';


$route['perusahaan/import'] = 'perusahaan/admin/prakerja/import';
$route['perusahaan/edit'] = 'perusahaan/admin/prakerja/edit_sertifikasi';
$route['perusahaan/kelas'] = 'perusahaan/admin/prakerja/input_kelas';
$route['perusahaan/edit_kelas'] = 'perusahaan/admin/prakerja/edit_kelas';
$route['perusahaan/tambah_kategori'] = 'perusahaan/admin/jobs/tambah_kategori';
$route['perusahaan/edit_kategori'] = 'perusahaan/admin/jobs/edit_kategori';
$route['perusahaan/tambah_link'] = 'perusahaan/admin/prakerja/tambah_link';
$route['perusahaan/tambah_kode'] = 'perusahaan/admin/prakerja/tambah_kode';
$route['perusahaan/edit_link'] = 'perusahaan/admin/prakerja/edit_link';
$route['perusahaan/hapus_prakerja/(:any)'] = 'perusahaan/admin/prakerja/hapus/$1';
$route['perusahaan/akftifkan_prakerja/(:any)'] = 'perusahaan/admin/prakerja/aktif/$1';
$route['perusahaan/nonaktif_prakerja/(:any)'] = 'perusahaan/admin/prakerja/nonaktif/$1';
$route['perusahaan/akftifkan_kelas/(:any)'] = 'perusahaan/admin/prakerja/aktif_kelas/$1';
$route['perusahaan/nonaktif_kelas/(:any)'] = 'perusahaan/admin/prakerja/nonaktif_kelas/$1';
$route['perusahaan/akftifkan_kategori/(:any)'] = 'perusahaan/admin/jobs/aktif_kategori/$1';
$route['perusahaan/nonaktif_kategori/(:any)'] = 'perusahaan/admin/jobs/nonaktif_kategori/$1';
$route['perusahaan/hapus_kategori/(:any)'] = 'perusahaan/admin/jobs/hapus/$1';
$route['perusahaan/hapus_link/(:any)'] = 'perusahaan/admin/prakerja/hapus_link/$1';
$route['perusahaan/hapus_form/(:any)'] = 'perusahaan/admin/prakerja/hapus_form/$1';
$route['perusahaan/cek_form'] = 'perusahaan/admin/prakerja/cek_form';
$route['perusahaan/tambah-test'] = 'perusahaan/admin/disc/tambah_test';
$route['perusahaan/edit-test'] = 'perusahaan/admin/disc/edit_test';
$route['perusahaan/edit-pattern'] = 'perusahaan/admin/disc/edit_pattern';
$route['perusahaan/hapus-test/(:any)'] = 'perusahaan/admin/disc/hapus/$1';
$route['perusahaan/verif_bayar/(:any)'] = 'perusahaan/admin/prakerja/verif_bayar/$1';
$route['perusahaan/kirim_invoice/(:any)'] = 'perusahaan/admin/prakerja/kirim_invoice/$1';
$route['perusahaan/kirim-link'] = 'perusahaan/admin/prakerja/kirim_link';
$route['perusahaan/kirim_verif/(:any)'] = 'perusahaan/admin/prakerja/kirim_verif/$1';
$route['perusahaan/next-step/(:any)'] = 'perusahaan/admin/prakerja/next_step/$1';
$route['perusahaan/end/(:any)'] = 'perusahaan/admin/prakerja/end/$1';
$route['perusahaan/interview_2'] = 'perusahaan/admin/prakerja/interview_2';
$route['perusahaan/view_cv/(:any)'] = 'perusahaan/admin/prakerja/view_pdf/$1';
$route['perusahaan/tandai'] = 'perusahaan/admin/prakerja/tandai';

/////////////////////////
$route['perusahaan/admin/pendaftar-kandidat'] = 'perusahaan/admin/prakerja/sertifikat';
$route['perusahaan/admin/kategori-pekerjaan'] = 'perusahaan/admin/jobs/kategori';
$route['perusahaan/admin/kelola-link'] = 'perusahaan/admin/prakerja/link';
$route['perusahaan/admin/kelola-form'] = 'perusahaan/admin/prakerja/form';

//Perusahaan Job Board routes
$route['perusahaan/admin/job-board'] = 'perusahaan/admin/JobBoard/index';
$route['perusahaan/admin/job-board/jobs-list'] = 'perusahaan/admin/JobBoard/jobsList';
$route['perusahaan/admin/job-board/candidates-list/(:any)'] = 'perusahaan/admin/JobBoard/candidatesList/$1';
$route['perusahaan/admin/job-board/assign-view/(:any)/(:any)'] = 'perusahaan/admin/JobBoard/assignView/$1/$2';
$route['perusahaan/admin/job-board/assign'] = 'perusahaan/admin/JobBoard/assign';
$route['perusahaan/admin/job-board/delete-interview/(:any)'] = 'perusahaan/admin/JobBoard/deleteInterview/$1';
$route['perusahaan/admin/job-board/delete-quiz/(:any)'] = 'perusahaan/admin/JobBoard/deleteQuiz/$1';
$route['perusahaan/admin/job-board/candidate-status'] = 'perusahaan/admin/JobBoard/candidateStatus';
$route['perusahaan/admin/job-board/job/(:any)'] = 'perusahaan/admin/JobBoard/viewJob/$1';
$route['perusahaan/admin/job-board/resume/(:any)'] = 'perusahaan/admin/JobBoard/viewResume/$1';
$route['perusahaan/admin/job-board/overall-result'] = 'perusahaan/admin/JobBoard/overallResult';
$route['perusahaan/admin/job-board/pdf-result'] = 'perusahaan/admin/JobBoard/pdfResult';
$route['perusahaan/admin/job-board/(:any)'] = 'perusahaan/admin/JobBoard/index/$1';

//Perusahaan Jobs module routes
$route['perusahaan/admin/jobs'] = 'perusahaan/admin/jobs/listView';
$route['perusahaan/admin/jobs/data'] = 'perusahaan/admin/jobs/data';

$route['perusahaan/admin/jobs/create-or-edit'] = 'perusahaan/admin/jobs/createOrEdit/$1';
$route['perusahaan/admin/jobs/create-or-edit/(:any)'] = 'perusahaan/admin/jobs/createOrEdit/$1';
$route['perusahaan/admin/jobs/save'] = 'perusahaan/admin/jobs/save';
$route['perusahaan/admin/jobs/status/(:any)/(:any)'] = 'perusahaan/admin/jobs/changeStatus/$1/$2';
$route['perusahaan/admin/jobs/bulk-action'] = 'perusahaan/admin/jobs/bulkAction';
$route['perusahaan/admin/jobs/delete/(:any)'] = 'perusahaan/admin/jobs/delete/$1';
$route['perusahaan/admin/jobs/excel'] = 'perusahaan/admin/jobs/excel';
$route['perusahaan/admin/jobs/add-custom-field'] = 'perusahaan/admin/jobs/addCustomField';
$route['perusahaan/admin/jobs/remove-custom-field/(:any)'] = 'perusahaan/admin/jobs/removeCustomField/$1';

//Perusahaan Traits module routes
$route['perusahaan/admin/traits'] = 'perusahaan/admin/traits/listView';
$route['perusahaan/admin/traits/data'] = 'perusahaan/admin/traits/data';
$route['perusahaan/admin/traits/create-or-edit'] = 'perusahaan/admin/traits/createOrEdit/$1';
$route['perusahaan/admin/traits/create-or-edit/(:any)'] = 'perusahaan/admin/traits/createOrEdit/$1';
$route['perusahaan/admin/traits/save'] = 'perusahaan/admin/traits/save';
$route['perusahaan/admin/traits/status/(:any)/(:any)'] = 'perusahaan/admin/traits/changeStatus/$1/$2';
$route['perusahaan/admin/traits/bulk-action'] = 'perusahaan/admin/traits/bulkAction';
$route['perusahaan/admin/traits/delete/(:any)'] = 'perusahaan/admin/traits/delete/$1';

//Perusahaan Departments module routes
$route['perusahaan/admin/departments'] = 'perusahaan/admin/departments/listView';
$route['perusahaan/admin/departments/data'] = 'perusahaan/admin/departments/data';
$route['perusahaan/admin/departments/create-or-edit'] = 'perusahaan/admin/departments/createOrEdit/$1';
$route['perusahaan/admin/departments/create-or-edit/(:any)'] = 'perusahaan/admin/departments/createOrEdit/$1';
$route['perusahaan/admin/departments/save'] = 'perusahaan/admin/departments/save';
$route['perusahaan/admin/departments/status/(:any)/(:any)'] = 'perusahaan/admin/departments/changeStatus/$1/$2';
$route['perusahaan/admin/departments/bulk-action'] = 'perusahaan/admin/departments/bulkAction';
$route['perusahaan/admin/departments/delete/(:any)'] = 'perusahaan/admin/departments/delete/$1';

//////////////////////////////////////////////////////////////////////////////////////////////////////

$route['admin'] = 'admin/users/loginView';
$route['admin/login'] = 'admin/users/loginView';
$route['admin/login-post'] = 'admin/users/login';
$route['admin/forgot-password'] = 'admin/users/forgotPasswordView';
$route['admin/forgot-password-post'] = 'admin/users/forgotPassword';
$route['admin/reset-password/(:any)'] = 'admin/users/resetPasswordView/$1';
$route['admin/reset-password-post'] = 'admin/users/resetPassword';
$route['admin/kelola_psikogram/(:any)'] = 'admin/Candidates/kelola_psikogram/$1';

//Admin Prakerja routes

//Admin User(inner) routes
$route['admin/profile'] = 'admin/users/profile';
$route['admin/Users/get_edit'] = 'admin/users/get_edit';
$route['admin/Users/get_kab'] = 'admin/users/get_kab';
$route['admin/Users/get_kec'] = 'admin/users/get_kec';
$route['admin/password'] = 'admin/users/passwordView';
$route['admin/profile-post'] = 'admin/users/updateProfile';
$route['admin/password-post'] = 'admin/users/updatePassword';
$route['admin/logout'] = 'admin/users/logout';
$route['admin/settings/general'] = 'admin/settings/general';
$route['admin/settings/apis'] = 'admin/settings/apis';
$route['admin/settings/css'] = 'admin/settings/css';
$route['admin/settings/languages'] = 'admin/settings/languages';
$route['admin/settings/home'] = 'admin/settings/home';
$route['admin/settings/save'] = 'admin/settings/updateSettings';
$route['admin/settings/update-css'] = 'admin/settings/updateCss';
$route['admin/settings/update-app'] = 'admin/settings/updateApplication';

//Admin Users module routes
$route['admin/users'] = 'admin/users/usersListView';
$route['admin/users/data'] = 'admin/users/usersList';
$route['admin/users/create-or-edit'] = 'admin/users/createOrEditUser';
$route['admin/users/create-or-edit/(:any)'] = 'admin/users/createOrEditUser/$1';
$route['admin/users/message-user/(:any)'] = 'admin/users/messageUser/$1';
$route['admin/users/message-user-save'] = 'admin/users/messageUserSave/$1';
$route['admin/users/save'] = 'admin/users/saveUser';
$route['admin/users/save-roles'] = 'admin/users/saveUserRoles';
$route['admin/users/status/(:any)/(:any)'] = 'admin/users/changeStatus/$1/$2';
$route['admin/users/bulk-action'] = 'admin/users/bulkAction';
$route['admin/users/delete/(:any)'] = 'admin/users/delete/$1';

//Admin Roles module routes
$route['admin/roles'] = 'admin/roles/listView';
$route['admin/role-permissions/(:any)'] = 'admin/roles/getRolePermissions/$1';
$route['admin/roles/save'] = 'admin/roles/saveRole';
$route['admin/roles/delete/(:any)'] = 'admin/roles/delete/$1';
$route['admin/roles/add-permission/(:any)/(:any)'] = 'admin/roles/addPermission/$1/$2';
$route['admin/roles/remove-permission/(:any)/(:any)'] = 'admin/roles/removePermission/$1/$2';
$route['admin/roles/rolesAsSelect2'] = 'admin/roles/rolesAsSelect2';

//Admin Candidates module routes
$route['admin/candidates'] = 'admin/candidates/listView';
$route['tandai_bkk/(:any)/(:any)'] = 'admin/candidates/tandai_bkk/$1/$2';
$route['tandai_bkk/(:any)/(:any)'] = 'admin/candidates/tandai_bkk/$1/$2';

$route['candidates/import-siswa'] = 'admin/candidates/import_siswa';
$route['admin/prakerja/view_pdf/(:any)'] = 'admin/prakerja/view_pdf/$1';
$route['admin/prakerja/cek_lamaran'] = 'admin/prakerja/cek_lamaran';
$route['admin/sertifikasi'] = 'admin/prakerja/listView';
$route['admin/candidates/data'] = 'admin/candidates/data';
$route['admin/candidates/data_unverif'] = 'admin/prakerja/data_unverif';
$route['admin/candidates/status/(:any)/(:any)'] = 'admin/candidates/changeStatus/$1/$2';
$route['admin/candidates/bulk-action'] = 'admin/candidates/bulkAction';
$route['admin/candidates/delete/(:any)'] = 'admin/candidates/delete/$1';
$route['admin/candidates/reset-password/(:any)'] = 'admin/candidates/resetPassword/$1';
$route['admin/candidates/resume/(:any)'] = 'admin/candidates/resume/$1';
$route['admin/candidates/resume-download'] = 'admin/candidates/resumeDownload';
$route['admin/candidates/excel'] = 'admin/candidates/candidatesExcel';

$route['admin/candidates/message-view'] = 'admin/CandidateInterviews/messageView';
$route['admin/candidates/tugaskan-view'] = 'admin/CandidateInterviews/tugaskanView';
$route['admin/candidates/message'] = 'admin/CandidateInterviews/message';
$route['admin/candidates/tugaskan'] = 'admin/CandidateInterviews/tugaskan';

$route['admin/kelola-pengalaman'] = 'admin/Candidates/pengalaman';
$route['tambah_pengalaman'] = 'admin/Candidates/tambah_pengalaman';
$route['edit_pengalaman'] = 'admin/Candidates/edit_pengalaman';
$route['status_pengalaman/(:any)/(:any)'] = 'admin/Candidates/status_pengalaman/$1/$2';

$route['admin/kelola-skill'] = 'admin/Candidates/skill';
$route['tambah_skill'] = 'admin/Candidates/tambah_skill';
$route['edit_skill'] = 'admin/Candidates/edit_skill';
$route['status_skill/(:any)/(:any)'] = 'admin/Candidates/status_skill/$1/$2';

//Admin Jobs module routes
$route['admin/jobs'] = 'admin/jobs/listView';
$route['admin/jobs/data'] = 'admin/jobs/data';
$route['admin/jobs/create-or-edit'] = 'admin/jobs/createOrEdit/$1';
$route['admin/jobs/create-or-edit/(:any)'] = 'admin/jobs/createOrEdit/$1';
$route['admin/jobs/save'] = 'admin/jobs/save';
$route['admin/jobs/status/(:any)/(:any)'] = 'admin/jobs/changeStatus/$1/$2';
$route['admin/jobs/bulk-action'] = 'admin/jobs/bulkAction';
$route['admin/jobs/delete/(:any)'] = 'admin/jobs/delete/$1';
$route['admin/jobs/excel'] = 'admin/jobs/excel';
$route['admin/jobs/add-custom-field'] = 'admin/jobs/addCustomField';
$route['admin/jobs/remove-custom-field/(:any)'] = 'admin/jobs/removeCustomField/$1';

//Admin Companies module routes
$route['admin/companies'] = 'admin/companies/listView';
$route['admin/companies/data'] = 'admin/companies/data';
$route['admin/companies/create-or-edit'] = 'admin/companies/createOrEdit/$1';
$route['admin/companies/create-or-edit/(:any)'] = 'admin/companies/createOrEdit/$1';
$route['admin/companies/save'] = 'admin/companies/save';
$route['admin/companies/status/(:any)/(:any)'] = 'admin/companies/changeStatus/$1/$2';
$route['admin/companies/bulk-action'] = 'admin/companies/bulkAction';
$route['admin/companies/delete/(:any)'] = 'admin/companies/delete/$1';

//Admin Languages module routes
$route['admin/languages'] = 'admin/languages/listView';
$route['admin/languages/data'] = 'admin/languages/data';
$route['admin/languages/create'] = 'admin/languages/create';
$route['admin/languages/edit/(:any)'] = 'admin/languages/edit/$1';
$route['admin/languages/save'] = 'admin/languages/save';
$route['admin/languages/update'] = 'admin/languages/update';
$route['admin/languages/status/(:any)/(:any)'] = 'admin/languages/changeStatus/$1/$2';
$route['admin/languages/selected/(:any)'] = 'admin/languages/changeSelected/$1';
$route['admin/languages/bulk-action'] = 'admin/languages/bulkAction';
$route['admin/languages/delete/(:any)'] = 'admin/languages/delete/$1';

//Admin Traits module routes
$route['admin/traits'] = 'admin/traits/listView';
$route['admin/traits/data'] = 'admin/traits/data';
$route['admin/traits/create-or-edit'] = 'admin/traits/createOrEdit/$1';
$route['admin/traits/create-or-edit/(:any)'] = 'admin/traits/createOrEdit/$1';
$route['admin/traits/save'] = 'admin/traits/save';
$route['admin/traits/status/(:any)/(:any)'] = 'admin/traits/changeStatus/$1/$2';
$route['admin/traits/bulk-action'] = 'admin/traits/bulkAction';
$route['admin/traits/delete/(:any)'] = 'admin/traits/delete/$1';

//Admin Departments module routes
$route['admin/departments'] = 'admin/departments/listView';
$route['admin/departments/data'] = 'admin/departments/data';
$route['admin/departments/create-or-edit'] = 'admin/departments/createOrEdit/$1';
$route['admin/departments/create-or-edit/(:any)'] = 'admin/departments/createOrEdit/$1';
$route['admin/departments/save'] = 'admin/departments/save';
$route['admin/departments/status/(:any)/(:any)'] = 'admin/departments/changeStatus/$1/$2';
$route['admin/departments/bulk-action'] = 'admin/departments/bulkAction';
$route['admin/departments/delete/(:any)'] = 'admin/departments/delete/$1';

//Admin Question Categories module routes
$route['admin/question-categories'] = 'admin/QuestionCategories/listView';
$route['admin/question-categories/data'] = 'admin/QuestionCategories/data';
$route['admin/question-categories/create-or-edit'] = 'admin/QuestionCategories/createOrEdit/$1';
$route['admin/question-categories/create-or-edit/(:any)'] = 'admin/QuestionCategories/createOrEdit/$1';
$route['admin/question-categories/save'] = 'admin/QuestionCategories/save';
$route['admin/question-categories/status/(:any)/(:any)'] = 'admin/QuestionCategories/changeStatus/$1/$2';
$route['admin/question-categories/bulk-action'] = 'admin/QuestionCategories/bulkAction';
$route['admin/question-categories/delete/(:any)'] = 'admin/QuestionCategories/delete/$1';

//Admin Questions Bank routes
$route['admin/questions/create-or-edit'] = 'admin/questions/createOrEdit/$1';
$route['admin/questions/create-or-edit/(:any)'] = 'admin/questions/createOrEdit/$1';
$route['admin/questions/create-or-edit/(:any)/(:any)'] = 'admin/questions/createOrEdit/$1/$2';
$route['admin/questions/save'] = 'admin/questions/save';
$route['admin/questions/delete/(:any)'] = 'admin/questions/delete/$1';
$route['admin/questions/add-answer/(:any)'] = 'admin/questions/addAnswer/$1';
$route['admin/questions/add-answer/(:any)/(:any)'] = 'admin/questions/addAnswer/$1/$2';
$route['admin/questions/remove-answer/(:any)'] = 'admin/questions/removeAnswer/$1';
$route['admin/questions/remove-image/(:any)'] = 'admin/questions/removeImage/$1';
$route['admin/questions/(:any)'] = 'admin/questions/index/$1';

//Admin Quiz Categories module routes
$route['admin/quiz-categories'] = 'admin/QuizCategories/listView';
$route['admin/quiz-categories/data'] = 'admin/QuizCategories/data';
$route['admin/quiz-categories/create-or-edit'] = 'admin/QuizCategories/createOrEdit/$1';
$route['admin/quiz-categories/create-or-edit/(:any)'] = 'admin/QuizCategories/createOrEdit/$1';
$route['admin/quiz-categories/save'] = 'admin/QuizCategories/save';
$route['admin/quiz-categories/status/(:any)/(:any)'] = 'admin/QuizCategories/changeStatus/$1/$2';
$route['admin/quiz-categories/bulk-action'] = 'admin/QuizCategories/bulkAction';
$route['admin/quiz-categories/delete/(:any)'] = 'admin/QuizCategories/delete/$1';

//Admin Quiz routes
$route['admin/quizes/create-or-edit'] = 'admin/quizes/createOrEdit/$1';
$route['admin/quizes/create-or-edit/(:any)'] = 'admin/quizes/createOrEdit/$1';
$route['admin/quizes/save'] = 'admin/quizes/save';
$route['admin/quizes/clone'] = 'admin/quizes/cloneQuiz';
$route['admin/quizes/clone/(:any)'] = 'admin/quizes/cloneForm/$1';
$route['admin/quizes/delete/(:any)'] = 'admin/quizes/delete/$1';
$route['admin/quizes/dropdown/(:any)'] = 'admin/quizes/dropdown/$1';
$route['admin/quizes/download/(:any)'] = 'admin/quizes/download/$1';

//Admin Quiz Questions routes
$route['admin/quiz-questions/add/(:any)/(:any)'] = 'admin/QuizQuestions/add/$1/$2';
$route['admin/quiz-questions/edit/(:any)'] = 'admin/QuizQuestions/edit/$1';
$route['admin/quiz-questions/delete/(:any)'] = 'admin/QuizQuestions/delete/$1';
$route['admin/quiz-questions/order'] = 'admin/QuizQuestions/order';
$route['admin/quiz-questions/add-answer/(:any)/(:any)'] = 'admin/QuizQuestions/addAnswer/$1/$2';
$route['admin/quiz-questions/remove-answer/(:any)'] = 'admin/QuizQuestions/removeAnswer/$1';
$route['admin/quiz-questions/save'] = 'admin/QuizQuestions/save';
$route['admin/quiz-questions/remove-image/(:any)'] = 'admin/QuizQuestions/removeImage/$1';
$route['admin/quiz-questions/(:any)'] = 'admin/QuizQuestions/index/$1';

//Admin Interview Categories module routes
$route['admin/interview-categories'] = 'admin/InterviewCategories/listView';
$route['admin/interview-categories/data'] = 'admin/InterviewCategories/data';
$route['admin/interview-categories/create-or-edit'] = 'admin/InterviewCategories/createOrEdit/$1';
$route['admin/interview-categories/create-or-edit/(:any)'] = 'admin/InterviewCategories/createOrEdit/$1';
$route['admin/interview-categories/save'] = 'admin/InterviewCategories/save';
$route['admin/interview-categories/status/(:any)/(:any)'] = 'admin/InterviewCategories/changeStatus/$1/$2';
$route['admin/interview-categories/bulk-action'] = 'admin/InterviewCategories/bulkAction';
$route['admin/interview-categories/delete/(:any)'] = 'admin/InterviewCategories/delete/$1';

//Admin Interview routes
$route['admin/interviews/create-or-edit'] = 'admin/interviews/createOrEdit/$1';
$route['admin/interviews/create-or-edit/(:any)'] = 'admin/interviews/createOrEdit/$1';
$route['admin/interviews/save'] = 'admin/interviews/save';
$route['admin/interviews/clone'] = 'admin/interviews/cloneInterview';
$route['admin/interviews/clone/(:any)'] = 'admin/interviews/cloneForm/$1';
$route['admin/interviews/delete/(:any)'] = 'admin/interviews/delete/$1';
$route['admin/interviews/dropdown/(:any)'] = 'admin/interviews/dropdown/$1';
$route['admin/interviews/download/(:any)'] = 'admin/interviews/download/$1';

//Admin Interview Questions routes
$route['admin/interview-questions/add/(:any)/(:any)'] = 'admin/InterviewQuestions/add/$1/$2';
$route['admin/interview-questions/edit/(:any)'] = 'admin/InterviewQuestions/edit/$1';
$route['admin/interview-questions/delete/(:any)'] = 'admin/InterviewQuestions/delete/$1';
$route['admin/interview-questions/order'] = 'admin/InterviewQuestions/order';
$route['admin/interview-questions/add-answer/(:any)/(:any)'] = 'admin/InterviewQuestions/addAnswer/$1/$2';
$route['admin/interview-questions/remove-answer/(:any)'] = 'admin/InterviewQuestions/removeAnswer/$1';
$route['admin/interview-questions/save'] = 'admin/InterviewQuestions/save';
$route['admin/interview-questions/(:any)'] = 'admin/InterviewQuestions/index/$1';

//Admin Candidate Interviews module routes
$route['admin/candidate-interviews'] = 'admin/CandidateInterviews/listView';
$route['admin/candidate-interviews/data'] = 'admin/CandidateInterviews/data';
$route['admin/candidate-interviews/view-or-conduct/(:any)'] = 'admin/CandidateInterviews/viewOrConduct/$1';
$route['admin/candidate-interviews/save'] = 'admin/CandidateInterviews/save';

////// PSIKOGRAM ////////
$route['admin/detail_psikogram'] = 'admin/Candidates/detail_psikogram';
$route['admin/kelola_psikogram'] = 'admin/Candidates/kelola_psikogram';
$route['psikogram/(:any)'] = 'admin/Candidates/psikogram/$1';
//////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////SEKOLAH SMK//////////////////////////////////////////////

$route['Candidates/get_kelas'] = 'Candidates/get_kelas';
$route['Candidates/get_edit'] = 'Candidates/get_edit';
$route['Candidates/get_kab'] = 'Candidates/get_kab';
$route['Candidates/get_kec'] = 'Candidates/get_kec';
////////////////////////TAHUN ANGKATAN////////////////////////////////////
$route['sekolah/kelola-tahun-angkatan'] = 'admin/Sekolah/tahunAngkatan';
$route['sekolah/tambah_tahun'] = 'admin/Sekolah/tambah_tahun';
$route['sekolah/edit_tahun'] = 'admin/Sekolah/edit_tahun';

////////////////////////JURUSAN////////////////////////////////////
$route['sekolah/kelola-jurusan'] = 'admin/Sekolah/jurusan';
$route['sekolah/tambah_jurusan'] = 'admin/Sekolah/tambah_jurusan';
$route['sekolah/edit_jurusan'] = 'admin/Sekolah/edit_jurusan';

////////////////////////KELAS////////////////////////////////////
$route['sekolah/kelola-kelas'] = 'admin/Sekolah/kelas';
$route['sekolah/tambah_kelas'] = 'admin/Sekolah/tambah_kelas';
$route['sekolah/edit_kelas'] = 'admin/Sekolah/edit_kelas';
$route['sekolah/kelola_kelas'] = 'admin/Sekolah/kelola_kelas';
$route['sekolah/get_kelas'] = 'admin/Sekolah/get_kelas';

////////////////////////LINK////////////////////////////////////
$route['sekolah/kelola-link'] = 'admin/Sekolah/link_pendaftaran';

////////////////////////SISWA////////////////////////////////////
$route['detail-siswa/(:any)'] = 'admin/Candidates/detail_siswa/$1';

$route['sekolah/kelola-siswa'] = 'admin/Sekolah/siswa';
$route['sekolah/kelola-siswa-pertahun/(:any)'] = 'admin/Sekolah/siswa_pertahun/$1';
$route['sekolah/kelola-siswa-bkk'] = 'admin/Sekolah/siswa_bkk';
$route['admin/sekolah/data'] = 'admin/sekolah/data';
$route['admin/sekolah/data_bkk'] = 'admin/sekolah/data_bkk';

////////////////////////TES KOMPETENSI////////////////////////////////////
$route['sekolah/kelola-tes-kompetensi'] = 'admin/Sekolah/tes_kompetensi';
$route['sekolah/tes_kompetensi/(:any)'] = 'admin/Sekolah/kelola_tes_kompetensi/$1';
$route['sekolah/data_kompetensi'] = 'admin/Sekolah/data_kompetensi';

$route['sekolah/kelola-tes-psikologi'] = 'admin/Sekolah/tes_psikologi';
$route['sekolah/tes_psikologi/(:any)'] = 'admin/Sekolah/kelola_tes_psikologi/$1';
$route['sekolah/data_psikologi'] = 'admin/Sekolah/data_psikologi';


$route['sekolah/kelola-penyaluran-siswa'] = 'admin/Sekolah/tes_akhir';
///////////////////////////////// END SEKOLAH SMK//////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
$route['cek_nim'] = 'candidates/cek_nim';
$route['proses_cek_nim'] = 'candidates/proses_cek_nim';

$route['import'] = 'admin/prakerja/import';
$route['edit'] = 'admin/prakerja/edit_sertifikasi';
$route['kelas'] = 'admin/prakerja/input_kelas';
$route['edit_kelas'] = 'admin/prakerja/edit_kelas';
$route['tambah_kategori'] = 'admin/jobs/tambah_kategori';
$route['edit_kategori'] = 'admin/jobs/edit_kategori';
$route['tambah_link'] = 'admin/prakerja/tambah_link';
$route['tambah_kode'] = 'admin/prakerja/tambah_kode';
$route['edit_link'] = 'admin/prakerja/edit_link';
$route['hapus_prakerja/(:any)'] = 'admin/prakerja/hapus/$1';
$route['akftifkan_prakerja/(:any)'] = 'admin/prakerja/aktif/$1';
$route['nonaktif_prakerja/(:any)'] = 'admin/prakerja/nonaktif/$1';
$route['akftifkan_kelas/(:any)'] = 'admin/prakerja/aktif_kelas/$1';
$route['nonaktif_kelas/(:any)'] = 'admin/prakerja/nonaktif_kelas/$1';
$route['akftifkan_kategori/(:any)'] = 'admin/jobs/aktif_kategori/$1';
$route['nonaktif_kategori/(:any)'] = 'admin/jobs/nonaktif_kategori/$1';
$route['hapus_kategori/(:any)'] = 'admin/jobs/hapus/$1';
$route['hapus_link/(:any)'] = 'admin/prakerja/hapus_link/$1';
$route['hapus_form/(:any)'] = 'admin/prakerja/hapus_form/$1';
$route['cek_form'] = 'admin/prakerja/cek_form';
$route['tambah-test'] = 'admin/disc/tambah_test';
$route['edit-test'] = 'admin/disc/edit_test';
$route['edit-pattern'] = 'admin/disc/edit_pattern';
$route['hapus-test/(:any)'] = 'admin/disc/hapus/$1';
$route['verif_bayar/(:any)'] = 'admin/prakerja/verif_bayar/$1';
$route['kirim_invoice/(:any)'] = 'admin/prakerja/kirim_invoice/$1';
$route['kirim-link'] = 'admin/prakerja/kirim_link';
$route['kirim_kode'] = 'admin/prakerja/kirim_kode';
$route['kirim_verif/(:any)'] = 'admin/prakerja/kirim_verif/$1';
$route['next-step/(:any)'] = 'admin/prakerja/next_step/$1';
$route['end/(:any)'] = 'admin/prakerja/end/$1';
$route['interview_2'] = 'admin/prakerja/interview_2';
$route['view_cv/(:any)'] = 'admin/prakerja/view_pdf/$1';
$route['tandai'] = 'admin/prakerja/tandai';
$route['status_tes'] = 'admin/prakerja/status_tes';
$route['mou_smk'] = 'admin/prakerja/mou_smk';
$route['download_mou/(:any)'] = 'admin/Users/download_mou/$1';
$route['admin/edit_link_smk'] = 'admin/Prakerja/edit_link_smk';

/////////////////////////
$route['admin/pendaftar-kandidat'] = 'admin/prakerja/pelamar';

$route['admin/mitra_kampus'] = 'admin/prakerja/mitra_kampus';

$route['admin/mitra_vokasi'] = 'admin/prakerja/mitra_vokasi';
$route['admin/kelola_siswa_mitra/(:any)'] = 'admin/prakerja/kelola_siswa_mitra/$1';

$route['admin/pendaftar-manager'] = 'admin/prakerja/manager';
$route['admin/pendaftar-spv'] = 'admin/prakerja/spv';
$route['admin/pendaftar-admin'] = 'admin/prakerja/admin';
$route['admin/pendaftar-marketing'] = 'admin/prakerja/marketing';
$route['admin/pendaftar-it'] = 'admin/prakerja/it';
$route['admin/pendaftar-bisnis'] = 'admin/prakerja/bisnis';
$route['admin/pendaftar-desain'] = 'admin/prakerja/desain';
$route['admin/pendaftar-lainnya'] = 'admin/prakerja/lainnya';

$route['admin/pendaftar-umum-paid'] = 'admin/prakerja/umum_paid';
$route['admin/pendaftar-umum-unpaid'] = 'admin/prakerja/umum_unpaid';

$route['admin/pendaftar-kampus'] = 'admin/prakerja/kampus';

////////////////////////////////////////////////////////////////////////////////////////////
$route['admin/pendaftar-vokasi'] = 'admin/prakerja/vokasi';

$route['admin/pendaftar-lolos/(:any)'] = 'admin/prakerja/lolos/$1';
$route['admin/pendaftar-user/(:any)'] = 'admin/prakerja/user/$1';
$route['admin/pendaftar-psikotes/(:any)'] = 'admin/prakerja/psikotes/$1';
$route['admin/pendaftar-kompetensi/(:any)'] = 'admin/prakerja/kompetensi/$1';

////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////
$route['admin/pendaftar-guru'] = 'admin/prakerja/guru';
$route['admin/psiko_kompetensi_guru/(:any)'] = 'admin/prakerja/psiko_kompetensi_guru/$1';
$route['admin/detail_guru/(:any)'] = 'admin/prakerja/detail_guru/$1';
$route['admin/link-pendaftaran'] = 'admin/prakerja/link_pendaftaran';
$route['admin/kelola-jurusan'] = 'admin/prakerja/kelola_jurusan';

// $route['admin/pendaftar-lolos/(:any)'] = 'admin/prakerja/lolos/$1';
// $route['admin/pendaftar-user/(:any)'] = 'admin/prakerja/user/$1';
// $route['admin/pendaftar-psikotes/(:any)'] = 'admin/prakerja/psikotes/$1';
// $route['admin/pendaftar-kompetensi/(:any)'] = 'admin/prakerja/kompetensi/$1';

////////////////////////////////////////////////////////////////////////////////////////////
$route['admin/pendaftar-magang'] = 'admin/prakerja/magang';
// $route['admin/pendaftar-magang'] = 'admin/prakerja/magang';

$route['admin/pendaftar-unverif'] = 'admin/prakerja/unverif';
$route['admin/rekap'] = 'admin/prakerja/rekap';
$route['admin/kelola-kelas'] = 'admin/prakerja/kelas';
$route['admin/kategori-pekerjaan'] = 'admin/jobs/kategori';
$route['admin/kelola-link'] = 'admin/prakerja/link';
$route['admin/kelola-kode'] = 'admin/prakerja/kode';
$route['admin/kelola-form'] = 'admin/prakerja/form';
$route['admin/kelola-disc'] = 'admin/disc/listView';
$route['admin/kelola-pattern'] = 'admin/disc/pattern';
$route['download_sertifikat'] = 'admin/prakerja/download';

//Admin Quiz Designer Page route
$route['admin/quiz-designer'] = 'admin/QuizDesigner/index';

//Admin Interview Designer Page route
$route['admin/interview-designer'] = 'admin/InterviewDesigner/index';

//Admin Job Board routes
$route['admin/job-board'] = 'admin/JobBoard/index';
$route['admin/rating'] = 'admin/JobBoard/rating';
$route['admin/job-board/jobs-list'] = 'admin/JobBoard/jobsList';
$route['admin/job-board/candidates-list/(:any)'] = 'admin/JobBoard/candidatesList/$1';
$route['admin/job-board/assign-view/(:any)/(:any)'] = 'admin/JobBoard/assignView/$1/$2';
$route['admin/job-board/assign'] = 'admin/JobBoard/assign';
$route['admin/job-board/assign-rating'] = 'admin/JobBoard/assign_rating';
$route['admin/job-board/delete-interview/(:any)'] = 'admin/JobBoard/deleteInterview/$1';
$route['admin/job-board/delete-quiz/(:any)'] = 'admin/JobBoard/deleteQuiz/$1';
$route['admin/job-board/candidate-status'] = 'admin/JobBoard/candidateStatus';
$route['admin/job-board/job/(:any)'] = 'admin/JobBoard/viewJob/$1';
$route['admin/job-board/resume/(:any)'] = 'admin/JobBoard/viewResume/$1';
$route['admin/job-board/overall-result'] = 'admin/JobBoard/overallResult';
$route['admin/job-board/pdf-result'] = 'admin/JobBoard/pdfResult';
$route['admin/job-board/(:any)'] = 'admin/JobBoard/index/$1';

//Admin Dashboard Routes
$route['admin/dashboard'] = 'admin/dashboard/index';
$route['admin/dashboard/popular-jobs-data'] = 'admin/dashboard/popularJobsChartData';
$route['admin/dashboard/top-candidates-data'] = 'admin/dashboard/topCandidatesChartData';
$route['admin/dashboard/jobs-list'] = 'admin/dashboard/jobsList';

//Admin Dashboard todos Routes
$route['admin/todos/list'] = 'admin/todos/listView';
$route['admin/todos/create-or-edit'] = 'admin/todos/createOrEditToDo';
$route['admin/todos/create-or-edit/(:any)'] = 'admin/todos/createOrEditToDo/$1';
$route['admin/todos/save'] = 'admin/todos/save';
$route['admin/todos/delete/(:any)'] = 'admin/todos/delete/$1';
$route['admin/todo/(:any)/(:any)'] = 'admin/todos/todoStatus/$1/$2';

//Admin Blog Categories module routes
$route['admin/blog-categories'] = 'admin/BlogCategories/listView';
$route['admin/blog-categories/data'] = 'admin/BlogCategories/data';
$route['admin/blog-categories/create-or-edit'] = 'admin/BlogCategories/createOrEdit/$1';
$route['admin/blog-categories/create-or-edit/(:any)'] = 'admin/BlogCategories/createOrEdit/$1';
$route['admin/blog-categories/save'] = 'admin/BlogCategories/save';
$route['admin/blog-categories/status/(:any)/(:any)'] = 'admin/BlogCategories/changeStatus/$1/$2';
$route['admin/blog-categories/bulk-action'] = 'admin/BlogCategories/bulkAction';
$route['admin/blog-categories/delete/(:any)'] = 'admin/BlogCategories/delete/$1';

//Admin Blog module routes
$route['admin/blogs'] = 'admin/blogs/listView';
$route['admin/blogs/data'] = 'admin/blogs/data';
$route['admin/blogs/create-or-edit'] = 'admin/blogs/createOrEdit/$1';
$route['admin/blogs/create-or-edit/(:any)'] = 'admin/blogs/createOrEdit/$1';
$route['admin/blogs/save'] = 'admin/blogs/save';
$route['admin/blogs/status/(:any)/(:any)'] = 'admin/blogs/changeStatus/$1/$2';
$route['admin/blogs/bulk-action'] = 'admin/blogs/bulkAction';
$route['admin/blogs/delete/(:any)'] = 'admin/blogs/delete/$1';

//Admin General routes
$route['admin/ckeditor/images/upload'] = 'admin/blogs/uploadCkEditorImages';
$route['admin/sidebar-toggle'] = 'pages/sidebarToggle';

//Admin Footer section modue
$route['admin/footer-sections'] = 'admin/FooterSections/index';
$route['admin/footer-sections/save'] = 'admin/FooterSections/save';

//Candidate Routes (outer)
$route['login'] = 'candidates/loginView';
$route['post-login'] = 'candidates/login';
$route['logout'] = 'candidates/logout';
$route['tes'] = 'candidates/tes';

$route['register/(:any)'] = 'candidates/registerView/$1';

$route['register-umum'] = 'candidates/registerViewUmum';
$route['register-kampus-merdeka'] = 'candidates/registerViewKampus';

$route['regist/mitra'] = 'candidates/registerMitra';
$route['register-mitra'] = 'Candidates/registerView_mitra';

$route['register-vokasi'] = 'candidates/registerViewVokasi';
$route['post-register'] = 'candidates/register';
$route['forgot-password'] = 'candidates/showForgotPassword';
$route['send-password-link'] = 'candidates/sendPasswordLink';
$route['reset-password/(:any)'] = 'candidates/resetPassword/$1';
$route['reset-password'] = 'candidates/updatePasswordByForgot';
$route['activate-account/(:any)'] = 'candidates/activateAccount/$1';
$route['google-redirect'] = 'candidates/googleRedirect';
$route['linkedin-redirect'] = 'candidates/linkedinRedirect';
$route['get-kec'] = 'candidates/get_kec';

//Candidate Routes (inner)
$route['account/profile'] = 'candidates/updateProfileView';
$route['account/pembayaran-psikotes'] = 'candidates/pembayaran';
$route['profile-update'] = 'candidates/updateProfile';
$route['account/password'] = 'candidates/updatePasswordView';
$route['account/hobby'] = 'candidates/updateHobby';
$route['tambah_hoby'] = 'candidates/tambahHobby';
$route['tambah_kegiatan'] = 'candidates/tambahKegiatan';
$route['delete_h/(:any)'] = 'candidates/hapusHobby/$1';
$route['delete_k/(:any)'] = 'candidates/hapusKegiatan/$1';
$route['delete_k_s/(:any)/(:any)'] = 'candidates/hapusKegiatanSimpan/$1/$2';
$route['update_medsos'] = 'candidates/updateMedsos';
$route['password-update'] = 'candidates/updatePassword';

//Account area Candidate Resumes Routes (inner)
$route['account'] = 'resumes/listing';

$route['account/tes-esai'] = 'candidates/list_tes_esai';
$route['account/tes-seleksi-esai/(:any)'] = 'candidates/tes_esai/$1';
$route['account/post-tes-esai'] = 'candidates/post_esai';

$route['create-resume'] = 'resumes/create';
$route['account/resume/(:any)'] = 'resumes/detailView/$1';
$route['account/resume-save-general'] = 'resumes/updateGeneral';
$route['account/resume-save-experience'] = 'resumes/updateExperience';
$route['account/resume-save-qualification'] = 'resumes/updateQualification';
$route['account/resume-save-language'] = 'resumes/updateLanguage';
$route['account/resume-save-achievement'] = 'resumes/updateAchievement';
$route['account/upload_file'] = 'resumes/upload_file';
$route['account/resume-save-reference'] = 'resumes/updateReference';
$route['account/resume-add-section/(:any)/(:any)'] = 'resumes/addSection/$1/$2';
$route['account/resume-remove-section/(:any)/(:any)'] = 'resumes/removeSection/$1/$2';
$route['account/resume-update-doc'] = 'resumes/updateDocResume';
/////////////////// sertfikat
$route['account/job-sertifikat'] = 'jobs/sertifikat';
$route['create-sertifikat'] = 'resumes/sertifikat';
$route['regist'] = 'candidates/register';
$route['register_vokasi'] = 'candidates/register_vokasi';
$route['success-register'] = 'candidates/success_register';
$route['success'] = 'candidates/success';
$route['cek_kab'] = 'candidates/cek_kab';
$route['cek_kec'] = 'candidates/cek_kec';
$route['cek_kel'] = 'candidates/cek_kel';
$route['psikotes'] = 'candidates/psikotes';
$route['cek-id/(:any)'] = 'candidates/cek_id/$1';
$route['hapus-sertifikat/(:any)'] = 'resumes/hapus_sertifikat/$1';
//Account ares job routes
$route['account/job-applications'] = 'jobs/jobApplicationsView';
$route['account/job-applications/(:any)'] = 'jobs/jobApplicationsView/$1';
$route['account/job-favorites'] = 'jobs/jobFavoritesView';
$route['account/tes-interview-internal'] = 'jobs/jobFavoritesView';
$route['account/job-favorites/(:any)'] = 'jobs/jobFavoritesView/$1';
$route['account/tes-interview-internal/(:any)'] = 'jobs/jobFavoritesView/$1';
$route['account/job-referred'] = 'jobs/jobReferredView';
$route['account/job-referred/(:any)'] = 'jobs/jobReferredView/$1';

$route['download_cv/(:any)'] = 'candidates/download_cv/$1';

//Account Area Quizes routes
$route['account/quizes'] = 'quizes/listView';
$route['account/quizes/(:any)'] = 'quizes/listView/$1';
$route['account/tes-interview-internals/(:any)'] = 'quizes/listView/$1';
$route['account/quiz/(:any)'] = 'quizes/attemptView/$1';
$route['account/tes-interview-internal-pre/(:any)'] = 'quizes/attemptView/$1';
$route['account/quiz-attempt'] = 'quizes/attempt';
$route['account/tes-interview-internal-attempt'] = 'quizes/attempt2';

//Front end routes
$route['jobs'] = 'jobs/listing';
$route['jobs/(:any)'] = 'jobs/listing/$1';
$route['job/(:any)'] = 'jobs/detail/$1';
$route['mark-favorite/(:any)'] = 'jobs/markFavorite/$1';
$route['unmark-favorite/(:any)'] = 'jobs/unmarkFavorite/$1';
$route['refer-job-view'] = 'jobs/referJobView';
$route['refer-job'] = 'jobs/referJob';
$route['apply-job'] = 'jobs/applyJob';
$route['blogs'] = 'pages/blogListing';
$route['blogs/(:any)'] = 'pages/blogListing/$1';
$route['blog/(:any)'] = 'pages/blogDetail/$1';
$route['vokasi'] = 'pages/vokasi';

//Installation and other routes
$route['admin-user'] = 'admin/users/createAdminUser';
$route['encrypt-files'] = 'admin/settings/encryptFiles';
$route['schema'] = 'schema/run';
$route['import-data'] = 'schema/data';
$route['complete-install'] = 'pages/createSchemaAndImportData';
$route['default_controller'] = 'pages/index';
$route['kandidat'] = 'pages/index';
$route['404_override'] = 'pages/notFoundPage';
$route['translate_uri_dashes'] = FALSE;
