function General() {

    "use strict";

    var self = this;
    self.traits = [];

    this.initJobSearch = function () {
        $('.job-search-button').off();
        $('.job-search-button').on('click', function (event) {
            self.doJobSearch();
        });
        $('.job-search-value').on('keypress', function (event) {
            if(event.which == 13) {
                self.doJobSearch();
            }
        });
    };

    this.initCompanySearch = function () {
        $('input.company-check').on('ifChecked', function(event){
            self.doJobSearch();
        });
        $('input.company-check').on('ifUnchecked', function(event){
            self.doJobSearch();
        });
    };

    this.initDepartmentSearch = function () {
         var departments = '';
        $('.department-check').off();
        $('.department-check').on('click', function (e) {
          departments = $(this).val();
           if(departments != ""){
            window.location = application.url+'jobs?search=&departments='+departments;
        }else{
            // window.location = application.url+'jobs?search=&departments=';
        }
        });
       
         
    };

    this.doJobSearch = function () {
        var search = $('.job-search-value').val();
        var companies = '&companies=';
        var departments = '&departments=';
        $('.company-check').each(function (i, v) {
            if ($(this).is(':checked')) {
                companies += $(this).val()+',';
            }
        });
       
        window.location = application.url+'jobs?search='+search+companies;
    };

    this.initBlogSearch = function () {
        $('.blog-search-button').off();
        $('.blog-search-button').on('click', function (event) {
            self.doBlogSearch();
        });
        $('.blog-search-value').on('keypress', function (event) {
            if(event.which == 13) {
                self.doBlogSearch();
            }
        });
    };

    this.initBlogCategorySearch = function () {
        $('input.category-check').on('ifChecked', function(event){
            self.doBlogSearch();
        });
        $('input.category-check').on('ifUnchecked', function(event){
            self.doBlogSearch();
        });
    };

    this.doBlogSearch = function () {
        var search = $('.blog-search-value').val();
        var categories = '&categories=';
        $('.category-check').each(function (i, v) {
            if ($(this).is(':checked')) {
                categories += $(this).val()+',';
            }
        });
        window.location = application.url+'blogs?search='+search+categories;
    };

    this.initIcheck = function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
        });
    };

    this.initMarkFavorite = function () {
        $('.mark-favorite').off();
        $('.mark-favorite').on('click', function() {
            var item = $(this);
            if (item.hasClass('favorited')) {
                application.load('unmark-favorite/'+$(this).data('id'), '', function (result) {
                    var result = JSON.parse(application.response);
                    if (result.success == 'true') {
                        item.removeClass('favorited');
                        item.attr('title', lang['mark_favorite']);
                    }
                });
            } else {
                application.load('mark-favorite/'+$(this).data('id'), '', function (result) {
                    var result = JSON.parse(application.response);
                    if (result.success == 'true') {
                        item.addClass('favorited');
                        item.attr('title', lang['unmark_favorite']);
                    } else {
                        window.location = application.url+'login';
                    }
                });
            }
        });
    };

    this.initJobRefer = function () {
      $('.refer-job').off();
      $('.refer-job').on('click', function() {
        var modal = '#modal-default';
        $(modal+' .modal-title').html(lang['refer_this_job']);
        $(modal).modal('show');
        var button = $(this);
        application.load('refer-job-view', '.modal-body-container', function (result) {
            $('#job_id').val(button.data('id'));
            self.initSaveJobRefer();
        });
      });
    };

    this.initSaveJobRefer = function () {
        application.onSubmit('#job_refer_form', function (result) {
            application.showLoader('job_refer_form_button');
            application.post('refer-job', '#job_refer_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success == 'false' ) {
                    window.location = application.url+'login';
                } else {
                    if (result.success == 'true') {
                        setTimeout(function() {
                            $('#modal-default').modal('hide');
                        }, 2000);
                    }
                    application.hideLoader('job_refer_form_button');
                    application.showMessages(result.messages, 'job_refer_form');
                }
            });
        });
    };

      this.initJobApply = function () {
        application.onSubmit('#job_apply_form', function (result) {
            application.showLoader('job_apply_form_button');
            application.post('apply-job', '#job_apply_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('job_apply_form_button');
                application.showMessages(result.messages, 'job_apply_form');
                if (result.success == 'true') {
                    setTimeout(function() { 
                        window.location = application.url+'account/tes-interview-internal';
                    }, 1000);
                }
            });
        });
    };

    this.initPillRating = function () {
        $('.pill-rating').barrating('show', {
            theme: 'bars-pill',
            initialRating: 'A',
            showValues: true,
            showSelectedRating: false,
            allowEmpty: true,
            emptyValue: '-- no rating selected --',
            onSelect: function(value, text) {
                self.traits.push($(this).data('id'))
                //alert('Selected rating: ' + value);
            }
        });
    };

    this.initJobFunctions = function () {
      self.initJobSearch();
      self.initCompanySearch();
      self.initDepartmentSearch();
      self.initMarkFavorite();
      self.initJobRefer();
    };

    this.initBlogFunctions = function () {
      self.initBlogSearch();
      self.initBlogCategorySearch();
    };

}

$(document).ready(function() {
    var general = new General();
    general.initJobFunctions();
    general.initJobRefer();
    general.initMarkFavorite();
    general.initIcheck();
    general.initJobFunctions();
    general.initBlogFunctions();

    //Job Apply page
    general.initJobFunctions();
    general.initPillRating();
    general.initJobApply();
});
