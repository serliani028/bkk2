function Trait() {

    "use strict";

    var self = this;

    this.initFilters = function () {
        $("#status").off();
        $("#status").change(function () {
            self.initTraitsDatatable();
            self.initTraitsDatatablePH();
        });
        $('.select2').select2();
    };

    this.initTraitsDatatable = function () {
        $('#traits_datatable').DataTable({
            "aaSorting": [[ 2, 'desc' ]],
            "columnDefs": [{"orderable": false, "targets": [0,4]}],
            "lengthMenu": [[10, 25, 50, 100000000], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "GET",
                "url": application.url+'/admin/traits/data',
                "data": function ( d ) {
                    d.status = $('#status').val();
                },
                "complete": function (response) {
                    self.initiCheck();
                    self.initAllCheck();
                    self.initTraitCreateOrEditForm();
                    self.initTraitChangeStatus();
                    self.initTraitDelete();
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
    
    this.initTraitsDatatablePH = function () {
        $('#traits_datatable_ph').DataTable({
            "aaSorting": [[ 2, 'desc' ]],
            "columnDefs": [{"orderable": false, "targets": [0,3]}],
            "lengthMenu": [[10, 25, 50, 100000000], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "type": "GET",
                "url": application.url+'/perusahaan/admin/traits/data',
                "data": function ( d ) {
                    d.status = $('#status').val();
                },
                "complete": function (response) {
                    self.initTraitCreateOrEditFormPH();
                    self.initTraitChangeStatusPH();
                    self.initTraitDeletePH();
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

    this.initTraitSave = function () {
        application.onSubmit('#admin_trait_create_update_form', function (result) {
            application.showLoader('admin_trait_create_update_form_button');
            application.post('admin/traits/save', '#admin_trait_create_update_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success === 'true') {
                    $('#modal-default').modal('hide');
                    self.initTraitsDatatable();
                } else {
                    application.hideLoader('admin_trait_create_update_form_button');
                    application.showMessages(result.messages, 'admin_trait_create_update_form');
                }
            });
        });
    };
    
    this.initTraitSavePH = function () {
        application.onSubmit('#admin_trait_create_update_form_ph', function (result) {
            application.showLoader('admin_trait_create_update_form_button_ph');
            application.post('perusahaan/admin/traits/save', '#admin_trait_create_update_form_ph', function (res) {
                var result = JSON.parse(application.response);
                if (result.success === 'true') {
                    $('#modal-default_ph_tr').modal('hide');
                    self.initTraitsDatatablePH();
                } else {
                   application.hideLoader('admin_trait_create_update_form_button_ph');
                    application.showMessages(result.messages, 'admin_trait_create_update_form_ph');
                }
            });
        });
    };

    this.initTraitCreateOrEditForm = function () {
        $('.create-or-edit-trait').off();
        $('.create-or-edit-trait').on('click', function () {
            var modal = '#modal-default';
            var id = $(this).data('id');
            id = id ? '/'+id : '';
            var modal_title = id ? lang['edit_trait'] : lang['create_trait'];
            $(modal).modal('show');
            $(modal+' .modal-title').html(modal_title);
            application.load('admin/traits/create-or-edit'+id, modal+' .modal-body-container', function (result) {
                self.initTraitSave();
                $('.dropify').dropify();
            });
        });
    };
    
    this.initTraitCreateOrEditFormPH = function () {
        $('.create-or-edit-trait_ph').off();
        $('.create-or-edit-trait_ph').on('click', function () {
            var modal = '#modal-default_ph_tr';
            var id = $(this).data('id');
            id = id ? '/'+id : '';
            var modal_title = id ? lang['edit_trait'] : lang['create_trait'];
            $(modal).modal('show');
            $(modal+' .modal-title').html(modal_title);
            application.load('perusahaan/admin/traits/create-or-edit'+id, modal+' .modal-body-container', function (result) {
                self.initTraitSavePH();
                $('.dropify').dropify();
            });
        });
    };

    this.initTraitChangeStatus = function () {
        $('.change-trait-status').off();
        $('.change-trait-status').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = parseInt($(this).data('status'));
            button.html("<i class='fa fa-spin fa-spinner'></i>");
            button.attr("disabled", true);
            application.load('admin/traits/status/'+id+'/'+status, '', function (result) {
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

    
    this.initTraitChangeStatusPH = function () {
        $('.change-trait-status_ph').off();
        $('.change-trait-status_ph').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = parseInt($(this).data('status'));
            button.html("<i class='fa fa-spin fa-spinner'></i>");
            button.attr("disabled", true);
            application.load('perusahaan/admin/traits/status/'+id+'/'+status, '', function (result) {
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

    this.initTraitDelete = function () {
        $('.delete-trait').off();
        $('.delete-trait').on('click', function () {
            var status = confirm(lang['are_u_sure']);
            var id = $(this).data('id');
            if (status === true) {
                application.load('admin/traits/delete/'+id, '', function (result) {
                    self.initTraitsDatatable();
                });
            }
        });
    };
    
    this.initTraitDeletePH = function () {
        $('.delete-trait_ph').off();
        $('.delete-trait_ph').on('click', function () {
            var status = confirm(lang['are_u_sure']);
            var id = $(this).data('id');
            if (status === true) {
                application.load('perusahaan/admin/traits/delete/'+id, '', function (result) {
                    self.initTraitsDatatablePH();
                });
            }
        });
    };

    this.initTraitsListBulkActions = function () {
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
                application.post('admin/traits/bulk-action', {ids:ids, action: $(this).data('action')}, function (result) {
                    $('.bulk-action').val('');
                    $('.all-check').prop('checked', false);
                    self.initTraitsDatatable();
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
    var trait = new Trait();
    trait.initFilters();
    trait.initTraitsListBulkActions();
    trait.initTraitsDatatable();
    trait.initTraitsDatatablePH();
});
