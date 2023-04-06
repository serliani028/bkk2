function InterviewCategory() {

    "use strict";
    
    var self = this;

    this.initFilters = function () {
        $("#status").off();
        $("#status").change(function () {
            self.initInterviewCategoriesDatatable();
        });
        $('.select2').select2();
    };

    this.initInterviewCategoriesDatatable = function () {
        $('#interview_categories_datatable').DataTable({
            "aaSorting": [[ 2, 'desc' ]],
            "columnDefs": [{"orderable": false, "targets": [0,4]}],
            "lengthMenu": [[10, 25, 50, 100000000], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "GET",
                "url": application.url+'/admin/interview-categories/data',
                "data": function ( d ) {
                    d.status = $('#status').val();
                },
                "complete": function (response) {
                    self.initiCheck();
                    self.initAllCheck();
                    self.initInterviewCategoryCreateOrEditForm();
                    self.initInterviewCategoryChangeStatus();
                    self.initInterviewCategoryDelete();
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

    this.initInterviewCategorySave = function () {
        application.onSubmit('#admin_interview_category_create_update_form', function (result) {
            application.showLoader('admin_interview_category_create_update_form_button');
            application.post('admin/interview-categories/save', '#admin_interview_category_create_update_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success === 'true') {
                    $('#modal-default').modal('hide');
                    self.initInterviewCategoriesDatatable();
                } else {
                    application.hideLoader('admin_interview_category_create_update_form_button');
                    application.showMessages(result.messages, 'admin_interview_category_create_update_form');
                }
            });
        });
    };

    this.initInterviewCategoryCreateOrEditForm = function () {
        $('.create-or-edit-interview-category').off();
        $('.create-or-edit-interview-category').on('click', function () {
            var modal = '#modal-default';
            var id = $(this).data('id');
            id = id ? '/'+id : '';
            var modal_title = id ? 'Edit Kategori Tes Esai' : 'Tambah Kategori Tes Esai';
            $(modal).modal('show');
            $(modal+' .modal-title').html(modal_title);
            application.load('admin/interview-categories/create-or-edit'+id, modal+' .modal-body-container', function (result) {
                self.initInterviewCategorySave();
                $('.dropify').dropify();
            });
        });
    };

    this.initInterviewCategoryChangeStatus = function () {
        $('.change-interview-category-status').off();
        $('.change-interview-category-status').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = parseInt($(this).data('status'));
            button.html("<i class='fa fa-spin fa-spinner'></i>");
            button.attr("disabled", true);
            application.load('admin/interview-categories/status/'+id+'/'+status, '', function (result) {
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

    this.initInterviewCategoryDelete = function () {
        $('.delete-interview-category').off();
        $('.delete-interview-category').on('click', function () {
            var status = confirm(lang['are_u_sure']);
            var id = $(this).data('id');
            if (status === true) {
                application.load('admin/interview-categories/delete/'+id, '', function (result) {
                    self.initInterviewCategoriesDatatable();
                });
            }
        });
    };

    this.initInterviewCategoriesListBulkActions = function () {
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
            } else {
                application.post('admin/interview-categories/bulk-action', {ids:ids, action: $(this).data('action')}, function (result) {
                    $('.bulk-action').val('');
                    $('.all-check').prop('checked', false);
                    self.initInterviewCategoriesDatatable();
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

}

$(document).ready(function() {
    var interview_category = new InterviewCategory();
    interview_category.initFilters();
    interview_category.initInterviewCategoriesListBulkActions();
    interview_category.initInterviewCategoriesDatatable();
});
