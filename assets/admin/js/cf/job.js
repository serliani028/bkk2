function Job() {

    "use strict";

    var self = this;

    this.initFilters = function () {
        $("#status, #department, #company").off();
        $("#status, #department, #company").change(function () {
            self.initJobsDatatable();
            self.initJobsDatatablePH();
        });
        $('.select2').select2();
    };

    this.initJobsDatatable = function () {
        $('#jobs_datatable').DataTable({
            "columnDefs": [{"orderable": false, "targets": [0,1,2,3,4,5,6,7,8]}],
            "lengthMenu": [[10, 25, 50, 100000000], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "GET",
                "url": application.url+'admin/jobs/data',
                "data": function ( d ) {
                    d.status = $('#status').val();
                    d.company = $('#company').val();
                    d.department = $('#department').val();
                },
                "complete": function (response) {
                    self.initiCheck();
                    self.initAllCheck();
                    self.initJobsListBulkActions();
                    self.initJobCreateOrEditForm();
                    self.initJobChangeStatus();
                    self.initJobDelete();
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
    
     this.initJobsDatatablePH = function () {
        $('#jobs_datatablePH').DataTable({
            "aaSorting": [[ 7, 'desc' ]],
            "columnDefs": [{"orderable": false, "targets": [0,7]}],
            "lengthMenu": [[10, 25, 50, 100000000], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "GET",
                "url": application.url+'perusahaan/admin/jobs/data',
                "data": function ( d ) {
                    d.status = $('#statusPH').val();
                    d.company = $('#companyPH').val();
                    d.department = $('#departmentPH').val();
                },
                "complete": function (response) {
                    self.initJobCreateOrEditFormPH();
                    self.initJobChangeStatusPH();
                    self.initJobDeletePH();
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

    this.initJobSave = function () {
        application.onSubmit('#admin_job_create_update_form', function (result) {
            for(var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            application.showLoader('admin_job_create_update_form_button');
            application.post('admin/jobs/save', '#admin_job_create_update_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('admin_job_create_update_form_button');
                application.showMessages(result.messages, 'admin_job_create_update_form');
            });
        });
    };
    
    this.initJobSavePH = function () {
        application.onSubmit('#admin_job_create_update_form_ph', function (result) {
            for(var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            application.showLoader('admin_job_create_update_form_button_ph');
            application.post('perusahaan/admin/jobs/save', '#admin_job_create_update_form_ph', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('admin_job_create_update_form_button_ph');
                application.showMessages(result.messages, 'admin_job_create_update_form_ph');
            });
        });
    };

    this.initJobCreateOrEditForm = function () {
        $('.create-or-edit-job').off();
        $('.create-or-edit-job').on('click', function () {
            var id = $(this).data('id');
            id = id ? '/'+id : '';
            window.location = application.url+'admin/jobs/create-or-edit'+id;
        });
    };
    
    this.initJobCreateOrEditFormPH = function () {
        $('.create-or-edit-job_ph').off();
        $('.create-or-edit-job_ph').on('click', function () {
            var id = $(this).data('id');
            id = id ? '/'+id : '';
            window.location = application.url+'perusahaan/admin/jobs/create-or-edit'+id;
        });
    };

    this.initJobChangeStatus = function () {
        $('.change-job-status').off();
        $('.change-job-status').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = parseInt($(this).data('status'));
            button.html("<i class='fa fa-spin fa-spinner'></i>");
            button.attr("disabled", true);
            application.load('admin/jobs/status/'+id+'/'+status, '', function (result) {
                button.removeClass('btn-success');
                button.removeClass('btn-danger');
                button.addClass(status === 1 ? 'btn-danger' : 'btn-success');
                button.html(status === 1 ? lang['inactive'] : lang['active']);
                button.data('status', status === 1 ? 0 : 1);
                button.attr("disabled", false);
                button.attr("title", status === 1 ? lang['click_to_activate'] : lang['click_to_deactivate']);
            });
        });
    };
    
    this.initJobChangeStatusPH = function () {
        $('.change-job-status_ph').off();
        $('.change-job-status_ph').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = parseInt($(this).data('status'));
            button.html("<i class='fa fa-spin fa-spinner'></i>");
            button.attr("disabled", true);
            application.load('perusahaan/admin/jobs/status/'+id+'/'+status, '', function (result) {
                button.removeClass('btn-success');
                button.removeClass('btn-danger');
                button.addClass(status === 1 ? 'btn-danger' : 'btn-success');
                button.html(status === 1 ? lang['inactive'] : lang['active']);
                button.data('status', status === 1 ? 0 : 1);
                button.attr("disabled", false);
                button.attr("title", status === 1 ? lang['click_to_activate'] : lang['click_to_deactivate']);
            });
        });
    };

    this.initAllCheck = function () {
        $('input.all-check').on('ifChecked', function(event){
            $('input.single-check').iCheck('check');
        });
        $('input.all-check').on('ifUnchecked', function(event){
            $('input.single-check').iCheck('uncheck');
        });
    };

    this.initJobDelete = function () {
        $('.delete-job').off();
        $('.delete-job').on('click', function () {
            var status = confirm(lang['are_u_sure']);
            var id = $(this).data('id');
            if (status === true) {
                application.load('admin/jobs/delete/'+id, '', function (result) {
                    self.initJobsDatatable();
                });
            }
        });
    };
    
    this.initJobDeletePH = function () {
        $('.delete-job_ph').off();
        $('.delete-job_ph').on('click', function () {
            var status = confirm(lang['are_u_sure']);
            var id = $(this).data('id');
            if (status === true) {
                application.load('perusahaan/admin/jobs/delete/'+id, '', function (result) {
                    self.initJobsDatatablePH();
                });
            }
        });
    };

    this.initJobsListBulkActions = function () {
        $('.bulk-action').off();
        $('.bulk-action').on('click', function () {
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
            } else if (action == 'download-excel') {
                var form = "#jobs-form";
                $("<input />").attr("type", "hidden").attr("name", "ids").attr("value", ids).appendTo(form);
                $("<input />").attr("type", "hidden").attr("name", "csrf_token").attr("value", application.csrf_token).appendTo(form);
                $(form).submit();
            } else {
                application.post('admin/jobs/bulk-action', {ids:ids, action: $(this).data('action')}, function (result) {
                    $('.bulk-action').val('');
                    $('.all-check').prop('checked', false);
                    self.initJobsDatatable();
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

    this.initRemoveCustomField = function () {
        $('.remove-custom-field').off();
        $('.remove-custom-field').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = confirm(lang['are_u_sure']);
            if (status === true) {
                if (id != '') {
                    application.load('admin/jobs/remove-custom-field/'+id, '', function (result) {
                        button.parent().parent().parent().parent().remove();
                    });
                } else {
                    button.parent().parent().parent().parent().remove();
                }
                self.initShowHideEmptyCustomField();
            }
        });
    }

    this.initAddCustomField = function () {
        $('.add-custom-field').off();
        $('.add-custom-field').on('click', function (event) {
            event.preventDefault();
            application.load('admin/jobs/add-custom-field', '', function (result) {
                $('.custom-fields-container').append(application.response);
                self.initRemoveCustomField();
                self.initShowHideEmptyCustomField();
            });
        });
    };

    this.initShowHideEmptyCustomField = function () {
        if ($('.custom-value-box').length == 0) {
            $('.no-custom-value-box').show();
        } else {
            $('.no-custom-value-box').hide();
        }
    };

    this.initCKEditor = function () {
        var elementExists = document.getElementById("description");
        if (elementExists) {
            CKEDITOR.replace('description', {
                allowedContent : true,
                filebrowserUploadUrl: application.url+'/admin/ckeditor/images/upload?CKEditorFuncNum=1',
                filebrowserUploadMethod: 'form',
            });
        }
    };
}

$(document).ready(function() {
    var job = new Job();

    //For both screens
    job.initiCheck();

    //For listing screen
    job.initFilters();
    job.initJobsDatatable();
    job.initJobsDatatablePH();

    //For create edit screen
    job.initJobSave();
    job.initJobSavePH();
    job.initAddCustomField();
    job.initRemoveCustomField();
    job.initShowHideEmptyCustomField();
    job.initCKEditor();

    var company = new Company(); //From company.js
    company.initCompanyCreateOrEditForm();

    var department = new Department(); //From department.js
    department.initDepartmentCreateOrEditForm();
});
