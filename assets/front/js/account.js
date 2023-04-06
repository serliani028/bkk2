function Account() {

    "use strict";

    var self = this;

    this.initRegister = function () {
        application.onSubmit('#register_form', function (result) {
            application.showLoader('register_form_button');
            application.post('post-register', '#register_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('register_form_button');
                application.showMessages(result.messages, 'register_form');
            });
        });
    };

    this.initForgot = function () {
        application.onSubmit('#forgot_form', function (result) {
            application.showLoader('forgot_form_button');
            application.post('send-password-link', '#forgot_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('forgot_form_button');
                application.showMessages(result.messages, 'forgot_form');
            });
        });
    };

    this.initReset = function () {
        application.onSubmit('#reset_form', function (result) {
            application.showLoader('reset_form_button');
            application.post('reset-password', '#reset_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success === 'true') {
                    $('#register_form').find("input[type=text], textarea").val("");
                }
                application.hideLoader('reset_form_button');
                application.showMessages(result.messages, 'reset_form');
            });
        });
    };

    this.initProfileUpdate = function () {
        application.onSubmit('#profile_update_form', function (result) {
            application.showLoader('profile_update_form_button');
            application.post('profile-update', '#profile_update_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('profile_update_form_button');
                application.showMessages(result.messages, 'profile_update_form');
                
				// window.setInterval(function () {
				// 		location.reload(true);
				// }, 1000);
			
            });
        });
    };

    this.initPasswordUpdate = function () {
        application.onSubmit('#password_update_form', function (result) {
            application.showLoader('password_update_form_button');
            application.post('password-update', '#password_update_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('password_update_form_button');
                application.showMessages(result.messages, 'password_update_form');
            });
        });
    };

    this.initResumeCreateForm = function () {
      $('.add-resume').on('click', function() {
        $('#modal-default-2').modal('show');
        self.initResumeCreate();
      });
    };

    this.initResumeCreate = function () {
        application.onSubmit('#resume_create_form', function (result) {
            application.showLoader('resume_create_form_button');
            application.post('create-resume', '#resume_create_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('resume_create_form_button');
                application.showMessages(result.messages, 'resume_create_form');
                if (result.success === 'true') {
                    window.location = application.url+'account/resume/'+result.id;
                }
            });
        });
    };

    this.initResumeEditTabs = function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var href = $(e.target).attr('href');
            var $curr = $(".resume-process-edit  a[href='" + href + "']").parent();
            $('.resume-process-edit li').removeClass();
            $curr.addClass("active");
        });
    };

    this.initResumeSaveGeneral = function () {
        application.onSubmit('#resume_edit_general_form', function (result) {
            application.showLoader('resume_edit_general_form_button');
            application.post('account/resume-save-general', '#resume_edit_general_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('resume_edit_general_form_button');
                application.showMessages(result.messages, 'resume_edit_general_form');
    //             if (result.success == 'true') {
                   
    //                 	window.setInterval(function () {
				// 		location.reload(true);
				// }, 1000);
    //             }
            });
        });
    };

    this.initResumeSaveExperience = function () {
        application.onSubmit('#resume_edit_experiences_form', function (result) {
            application.showLoader('resume_edit_experiences_form_button');
            application.post('account/resume-save-experience', '#resume_edit_experiences_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('resume_edit_experiences_form_button');
                application.showMessages(result.messages, 'resume_edit_experiences_form');
                $("html, body").animate({ scrollTop: 0 }, "slow");
    //             if (result.success == 'true') {
                
    //                 window.setInterval(function () {
				// 		location.reload(true);
				// }, 1000);
    //             }
            });
        });
    };

    this.initResumeSaveQualification = function () {
        application.onSubmit('#resume_edit_qualifications_form', function (result) {
            application.showLoader('resume_edit_qualifications_form_button');
            application.post('account/resume-save-qualification', '#resume_edit_qualifications_form', function (res) {
                var result = JSON.parse(application.response);
                console.log(result);
                application.hideLoader('resume_edit_qualifications_form_button');
                application.showMessages(result.messages, 'resume_edit_qualifications_form');
                $("html, body").animate({ scrollTop: 0 }, "slow");
    //             if (result.success == 'true') {
                 
    //                 	window.setInterval(function () {
				// 		location.reload(true);
				// }, 1000);
    //             }
            });
        });
    };

    this.initResumeSaveLanguage = function () {
        application.onSubmit('#resume_edit_languages_form', function (result) {
            application.showLoader('resume_edit_languages_form_button');
            application.post('account/resume-save-language', '#resume_edit_languages_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('resume_edit_languages_form_button');
                application.showMessages(result.messages, 'resume_edit_languages_form');
                $("html, body").animate({ scrollTop: 0 }, "slow");
                // if (result.success == 'true') {
                //     setTimeout(function() {
                //         $('#qualification-tab a').click();
                //     }, 1000);
                // }
            });
        });
    };

    var jum = 0;
    this.initResumeSaveAchievement = function () {
        application.onSubmit('#resume_edit_achievements_form', function (result) {
            application.showLoader('resume_edit_achievements_form_button');
            application.post('account/resume-save-achievement', '#resume_edit_achievements_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('resume_edit_achievements_form_button');
                application.showMessages(result.messages, 'resume_edit_achievements_form');
                $("html, body").animate({ scrollTop: 0 }, "slow");
                jum -= 1;
                // if (result.success == 'true') {
                //     setTimeout(function() {
                //         location.reload();
                //     }, 1000);
                // }
            });
        });
    };

    this.initResumeSaveReference = function () {
        application.onSubmit('#form_2', function (result) {
            application.showLoader('button_sertifkat_2');
            application.post('create-sertifikat', '#form_2', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('button_sertifkat_2');
                application.showMessages(result.messages, 'form_2');
                // if (result.success == 'true') {
                //     setTimeout(function() {
                //         location.reload();
                //     }, 1000);
                // }
            });
        });
    };
    
        
    
    this.initAddFile = function () {
        $('.file_pelengkap').off();
        $('.file_pelengkap').on('click', function () {
            var button = $(this);
            var id_resume = $(this).data('id_resume');
            var id = $(this).data('id');
            var type = $(this).data('type_file');
            var file = $(this).data('file');
            $('.upload_file_pendukung').modal('show');
            if(file !== ''){
            $('#file_ach').css('display','inline-block');
            $('#file_ach').attr('href',file);
            }else{
            $('#file_ach').css('display','none');
            $('#file_ach').removeAttr('href');    
            }
            $('#id_file').attr('value',id);
            $('#id_resume').attr('value',id_resume);
            $('#type_file').val(type).trigger('change');
        });
    }
    
    this.initRemoveSection = function () {
        $('.remove-section').off();
        $('.remove-section').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var type = $(this).data('type');
            var status = confirm(lang['are_u_sure']);
            if (status === true) {
                if (id != '') {
                    application.load('account/resume-remove-section/'+id+'/'+type, '', function (result) {
                      window.location.reload(true);
                    });
                } else {
                    button.parent().parent().remove();
                   
                }
                jum -= 1;
                self.initShowHideEmptyBoxes();
            }
        });
    }

    this.initAddSection = function () {
        $('.add-section').off();
        $('.add-section').on('click', function (event) {
        if(jum >= 1){
        alert('Silahkan isi terlebih dahulu Form yang terbuka');
        }else{
            event.preventDefault();
            var button = $(this);
            var type = $(this).data('type');
            var id = $(this).data('id');
            application.load('account/resume-add-section/'+id+'/'+type, '', function (result) {
                jum += 1;
                button.parent().parent().parent().parent().find('.section-container').append(application.response);
                self.initRemoveSection();
                self.initDropifyAndDatepicker();
                self.initShowHideEmptyBoxes();
            });
        }
        });
    };

    this.initShowHideEmptyBoxes = function () {
        if ($('.experience-box').length == 0) {
            $('.no-experience-box').show();
        } else {
            $('.no-experience-box').hide();
        }
        if ($('.qualification-box').length == 0) {
            $('.no-qualification-box').show();
        } else {
            $('.no-qualification-box').hide();
        }
        if ($('.language-box').length == 0) {
            $('.no-language-box').show();
        } else {
            $('.no-language-box').hide();
        }
        if ($('.achievement-box').length == 0) {
            $('.no-achievement-box').show();
        } else {
            $('.no-achievement-box').hide();
        }
        if ($('.reference-box').length == 0) {
            $('.no-reference-box').show();
        } else {
            $('.no-reference-box').hide();
        }
    };

    this.initDocResumeUpdate = function () {
        application.onSubmit('#resume_update_form', function (result) {
            application.showLoader('resume_update_form_button');
            application.post('account/resume-update-doc', '#resume_update_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('resume_update_form_button');
                application.showMessages(result.messages, 'resume_update_form');
            });
        });
    };

    this.initDropifyAndDatepicker =  function () {
      $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        yearRange: "-90:+00"
      });
      $('.dropify').dropify();
    };

}

$(document).ready(function() {
    var account = new Account();

    //General
    account.initDropifyAndDatepicker();
    account.initShowHideEmptyBoxes();

    //Create modal on the resume listing page
    account.initResumeCreateForm();

    //Doc resume update
    account.initDocResumeUpdate();

    //Detailed resume update
    account.initResumeEditTabs();
    account.initResumeSaveGeneral();
    account.initResumeSaveExperience();
    account.initResumeSaveQualification();
    account.initResumeSaveLanguage();
    account.initResumeSaveAchievement();
    account.initResumeSaveAchievement();
    account.initResumeSaveReference();
    account.initRemoveSection();
    account.initAddFile();
    account.initAddSection();

    //Password update
    account.initForgot();
    account.initPasswordUpdate();

    //Profile update
    account.initProfileUpdate();

    //Register page
    account.initRegister();

    //Password reset
    account.initReset();

});
