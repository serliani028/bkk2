function Psikologi() {

    "use strict";

    var self = this;

    this.initFilters = function () {
        $("#status_psikologi").off();
        $("#status_psikologi").change(function () {
            self.initCandidatesDatatable();
        });
        $("#jurusan_siswa_psikologi").off();
        $("#jurusan_siswa_psikologi").change(function () {
            self.initCandidatesDatatable();
        });
        $("#kelas_siswa_psikologi").off();
        $("#kelas_siswa_psikologi").change(function () {
            self.initCandidatesDatatable();
        });
       $("#tahun_angkatan_psikologi").off();
        $("#tahun_angkatan_psikologi").on('keyup', function() {
            self.initCandidatesDatatable();
        });
        $('.select2').select2();
    };

    this.initCandidatesDatatable = function () {
        $('#candidates_datatable_psikologi').DataTable({
            "aaSorting": [[ 1, 'desc' ]],
            "columnDefs": [{"orderable": false, "targets": [0,1,2,3,4,5]}],
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "GET",
                "url": application.url+'/sekolah/data_psikologi',
                "data": function ( d ) {
                    d.status_psikologi = $('#status_psikologi').val();
                    d.jurusan_psikologi = $('#jurusan_siswa_psikologi').val();
                    d.kelas_siswa_psikologi = $('#kelas_siswa_psikologi').val();
                    d.tahun_angkatan_psikologi = $('#tahun_angkatan_psikologi').val();
                },
                "complete": function (response) {
                    
                    self.initiCheck(); 
                    self.initAllCheck();
                    // self.initCandidateChangeStatus();
                    // self.initCandidateDelete();
                    // self.initCandidateResetPassword();
                    // self.initLoadResume();
                    $('.table-bordered').parent().attr('style', 'overflow:auto'); //For responsive
                },
            },
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'info': true,
            'autoWidth': true,
            'destroy':true,
            'stateSave': true
        });
    };
    
    
    
    // this.initCandidateChangeStatus = function () {
    //     $('.change-candidate-status').off();
    //     $('.change-candidate-status').on('click', function () {
    //         var button = $(this);
    //         var id = $(this).data('id');
    //         var status = parseInt($(this).data('status'));
    //         button.html("<i class='fa fa-spin fa-spinner'></i>");
    //         button.attr("disabled", true);
    //         application.load('admin/candidates/status/'+id+'/'+status, '', function (result) {
    //             button.removeClass('btn-success');
    //             button.removeClass('btn-danger');
    //             button.addClass(status === 1 ? 'btn-danger' : 'btn-success');
    //             button.html(status === 1 ? lang['inactive'] : lang['active']);
    //             button.data('status', status === 1 ? 0 : 1);
    //             button.attr("disabled", false);
    //             button.attr("title", status === 1 ? lang['click_to_activate'] : lang['click_to_deactivate']);
    //         });
    //     });
    // };

    this.initAllCheck = function () {
        $('input.all-check').on('ifChecked', function(event){
            $('input.single-check').iCheck('check');
        });
        $('input.all-check').on('ifUnchecked', function(event){
            $('input.single-check').iCheck('uncheck');
        });
    };

    // this.initCandidateDelete = function () {
    //     $('.delete-candidate').off();
    //     $('.delete-candidate').on('click', function () {
    //         var status = confirm(lang['are_u_sure']);
    //         var id = $(this).data('id');
    //         if (status === true) {
    //             application.load('admin/candidates/delete/'+id, '', function (result) {
    //                 self.initCandidatesDatatable();
    //             });
    //         }
    //     });
    // };

    // this.initCandidateResetPassword = function () {
    //     $('.reset-password').off();
    //     $('.reset-password').on('click', function () {
    //         var status = confirm(lang['are_u_sure']);
    //         var id = $(this).data('id');
    //         if (status === true) {
    //             application.load('admin/candidates/reset-password/'+id, '', function (result) {
    //                 self.initCandidatesDatatable();
    //             });
    //         }
    //     });
    // };

    this.initCandidatesListBulkActions = function () {
        $('.bulk-action').off();
        $('.bulk-action').on('click', function (e) {
            e.preventDefault();
            var ids = [];
            var action = $(this).data('action');
            $('.single-check').each(function (i, v) {
                if ($(this).is(':checked')) {
                    ids.push($(this).data('id'))
                }
            });
            if (ids.length === 0) {
                alert(lang['please_select_some_records_first']);
                $('.bulk-action').val('');
                return false;
            }
            if (action == 'download-resume') {
	        	self.downloadResume(ids);
            } else if (action == 'download-excel') {
                self.downloadCandidateExcel(ids);
            } else if (action == 'email') {
	        	self.initEmailCandidateForm(ids);
            }else if (action == 'tugaskan') {
	        	self.initTugaskanCandidateForm(ids);
            } else {
                application.post('admin/candidates/bulk-action', {ids:ids, action: $(this).data('action')}, function (result) {
                    $('.bulk-action').val('');
                    $('.all-check').prop('checked', false);
                    self.initCandidatesDatatable();
                });
            }
        });
    };
    
    
    this.initiCheck = function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        });
    };

    // this.initLoadResume = function() {
    //     $('.view-resume').on('click', function() {
    //         var modal = '#modal-right';
    //         $(modal).modal('show');
    //         $(modal+' .modal-title').html('Resume');
    //         var button = $(this);
    //         var id = button.data('id');
    //         application.load('admin/candidates/resume/'+id, modal+' .modal-body', function (result) {
    //         });
    //     });
    // };

    this.initEmailCandidateForm = function(ids) {
        var modal = '#modal-default';
        $(modal).modal('show');
        $(modal+' .modal-title').html('Email');
        application.load('admin/candidates/message-view', modal+' .modal-body-container', function (result) {
            $("<input />").attr("type", "hidden").attr("name", "ids").attr("value", ids).appendTo('#admin_candidate_message_form');
            self.initCKEditor();
            self.initEmailCandidate();
        });
    };
    
    this.initTugaskanCandidateForm = function(ids) {
         var modal = '#modal-default';
                $(modal).modal('show');
                $(modal+' .modal-title').html('Tugsakan Kandidat');
                application.load('admin/candidates/tugaskan-view', modal+' .modal-body-container', function (result) {
                    $("<input />").attr("type", "text").attr("name", "ids").attr("value", ids).appendTo('#admin_candidate_tugaskan_form');
                    self.initCKEditor();
                    self.initTugaskanCandidate();
                });
    };


    this.initEmailCandidate = function () {
        application.onSubmit('#admin_candidate_message_form', function (result) {
            for(var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            application.showLoader('admin_candidate_message_form_button');
            application.post('/admin/candidates/message', '#admin_candidate_message_form', function (res) {
                var result = JSON.parse(application.response);
                // console.log(result);
                if (result.success === 'true') {
                    $('#modal-default').modal('hide');
                } else {
                    application.hideLoader('admin_candidate_message_form_button');
                    application.showMessages(result.messages, 'admin_candidate_message_form');
                }
            });
        });
    };
    
    this.initTugaskanCandidate = function () {
        application.onSubmit('#admin_candidate_tugaskan_form', function (result) {
            for(var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            application.showLoader('admin_candidate_tugaskan_form_button');
            application.post('/admin/candidates/tugaskan', '#admin_candidate_tugaskan_form', function (res) {
                var result = JSON.parse(application.response);
                console.log(result);
                if (result.success === 'true') {
                    $('#modal-default').modal('hide');
                } else {
                    application.hideLoader('admin_candidate_tugaskan_form_button');
                    application.showMessages(result.messages, 'admin_candidate_tugaskan_form');
                }
            });
        });
    };

    // this.downloadResume = function (ids) {
    //     var form = "#resume-form";
    //     $("<input />").attr("type", "hidden").attr("name", "ids").attr("value", ids).appendTo(form);
    //     $("<input />").attr("type", "hidden").attr("name", "csrf_token").attr("value", application.csrf_token).appendTo(form);
    //     $(form).submit();
    // };

    // this.downloadCandidateExcel = function (ids) {
    //     var form = "#candidates-form";
    //     $("<input />").attr("type", "hidden").attr("name", "ids").attr("value", ids).appendTo(form);
    //     $("<input />").attr("type", "hidden").attr("name", "csrf_token").attr("value", application.csrf_token).appendTo(form);
    //     $(form).submit();
    // };

    this.initCKEditor = function () {
        var elementExists = document.getElementById("msg");
        if (elementExists) {
            CKEDITOR.replace('msg', {
                allowedContent : true,
                filebrowserUploadUrl: application.url+'/admin/ckeditor/images/upload?CKEditorFuncNum=1',
                filebrowserUploadMethod: 'form',
            });
        }
    };
}

$(document).ready(function() {
    var candidate = new Psikologi();
    candidate.initFilters();
    candidate.initCandidatesDatatable();
    candidate.initCandidatesListBulkActions();
});
