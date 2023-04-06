function Company() {

    "use strict";

    var self = this;

    this.initFilters = function () {
        $("#status").off();
        $("#status").change(function () {
            self.initCompaniesDatatable();
        });
        $('.select2').select2();
    };

    this.initCompaniesDatatable = function () {
        $('#companies_datatable').DataTable({
            "aaSorting": [[ 2, 'desc' ]],
            "columnDefs": [{"orderable": false, "targets": [0,4]}],
            "lengthMenu": [[10, 25, 50, 100000000], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "GET",
                "url": application.url+'/admin/companies/data',
                "data": function ( d ) {
                    d.status = $('#status').val();
                },
                "complete": function (response) {
                    self.initiCheck();
                    self.initAllCheck();
                    self.initCompanyCreateOrEditForm();
                    self.initCompanyChangeStatus();
                    self.initCompanyDelete();
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

    this.initCompanySave = function () {
        application.onSubmit('#admin_company_create_update_form', function (result) {
            application.showLoader('admin_company_create_update_form_button');
            application.post('admin/companies/save', '#admin_company_create_update_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success === 'true') {
                    $('#modal-default').modal('hide');
                    self.initCompaniesDatatable();

                    //For job create or edit
                    if (!isEmpty(result.data)) {
                        var data = {id: result.data.id, text: result.data.title};
                        var newOption = new Option(data.text, data.id, false, false);
                        $('#companies').append(newOption).trigger('change');
                    }
                } else {
                    application.hideLoader('admin_company_create_update_form_button');
                    application.showMessages(result.messages, 'admin_company_create_update_form');
                }
            });
        });
    };

    this.initCompanyCreateOrEditForm = function () {
        $('.create-or-edit-company').off();
        $('.create-or-edit-company').on('click', function () {
            var modal = '#modal-default';
            var id = $(this).data('id');
            id = id ? '/'+id : '';
            var modal_title = id ? lang['edit_company'] : lang['create_company'];
            $(modal).modal('show');
            $(modal+' .modal-title').html(modal_title);
            application.load('admin/companies/create-or-edit'+id, modal+' .modal-body-container', function (result) {
                self.initCompanySave();
                $('.dropify').dropify();
            });
        });
    };

    this.initCompanyChangeStatus = function () {
        $('.change-company-status').off();
        $('.change-company-status').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = parseInt($(this).data('status'));
            button.html("<i class='fa fa-spin fa-spinner'></i>");
            button.attr("disabled", true);
            application.load('admin/companies/status/'+id+'/'+status, '', function (result) {
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

    this.initCompanyDelete = function () {
        $('.delete-company').off();
        $('.delete-company').on('click', function () {
            var status = confirm(lang['are_u_sure']);
            var id = $(this).data('id');
            if (status === true) {
                application.load('admin/companies/delete/'+id, '', function (result) {
                    self.initCompaniesDatatable();
                });
            }
        });
    };

    this.initCompaniesListBulkActions = function () {
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
            } else {
                application.post('admin/companies/bulk-action', {ids:ids, action: $(this).data('action')}, function (result) {
                    $('.bulk-action').val('');
                    $('.all-check').prop('checked', false);
                    self.initCompaniesDatatable();
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
    var company = new Company();
    company.initFilters();
    company.initCompaniesListBulkActions();
    company.initCompaniesDatatable();
});
