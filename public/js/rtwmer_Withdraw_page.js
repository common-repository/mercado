(function ($) {
  'use strict';
  $(document).ready(function() {


    /* working of withdraw */
    $(document).on("click", "#rtwmer_submit_request_button", function () {
      // alert('df;ldsa');
     
      var rtwmer_payment_meth = $("#rtwmer_paymet_method").val();
      var rtwmer_amount_req = parseFloat($("#rtwmer_ven_with_amount").val());
      var rtwmer_min_bal = parseFloat($("#rtwmer_min_bal").html());
      var rtwmer_max_bal = parseFloat($("#rtwmer_curent_bal").html());
      $(".rtwmer_req_table").show();
      $(".rtwmer_status_table").css("display", "none");
      var rtwmer_extra = $(".rtwmer_withdraw_extra_field");
      // console.log(rtwmer_payment_meth.length);
      //  return;
      if(rtwmer_payment_meth.length == 0){
        $('.notifyjs-wrapper').remove();
        $.notify('Payment method not selected please select', { className: 'rtwmer_error', position: "right bottom" });
        return;
      }
      
      if(rtwmer_extra.length>0){
        var rtw_obj={};
       $.each(rtwmer_extra, function(index,event) {
        rtw_obj[event.name]=event.value;
        });
        }
        var rtwmer_multiple_select = $(document).find(".rtwmer_withdraw_multiple_data");
        if (rtwmer_multiple_select.length > 0) {
           var extra_multi_data = {};
           $.each(rtwmer_multiple_select, function (index, event) {
               extra_multi_data[event.name] = getSelectValues(event);
           });
       }
       var rtwmer_image_src = $(".rtwmer_withdraw_image_src");
       if (rtwmer_image_src.length > 0) {
           var rtwmer_image_src_path = {};
           $.each(rtwmer_image_src, function (index, event) {
               rtwmer_image_src_path[event.name] = event.src;
           });
       }
        var rtwmer_extra_check = $(".rtwmer_withdraw_checkbox");
        if(rtwmer_extra_check.length>0){
          var rtw_check_obj={};
         $.each(rtwmer_extra_check, function(index,event) {
           rtw_check_obj[event.name]= $("#"+event.id).is(":checked");
          });
          }

      if ((rtwmer_amount_req >= rtwmer_min_bal) && (rtwmer_amount_req <= rtwmer_max_bal)) {
        $(".rtwmer_loader").show();
        var data = {
          'action': 'withdraw_request_ajax',
          'rtwmer_payment_meth': rtwmer_payment_meth,
          'rtwmer_amount_req': rtwmer_amount_req,
          'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
        };
        if(rtwmer_extra.length>0){
          var data={...rtw_obj,...data};
        }
        if (rtwmer_multiple_select.length > 0) {
         var data = { ...extra_multi_data, ...data };
         }
         if (rtwmer_image_src.length > 0) {
         var data = { ...rtwmer_image_src_path, ...data };
         }
        if(rtwmer_extra_check.length>0){
         var data={...rtw_check_obj,...data};
       }
        jQuery.post(
          rtwmer_ajax_object.rtwmer_ajax_url,
          data,
          function (response) {
            if(response){
              $(".rtwmer_loader").hide();
            }
            if (response == "successfull") {
              $(document).find("#rtwmer_withdraw_form").removeClass("rtwmer-modal-open");
              $("body").css("overflow","scroll");
              rtwmer_count_ajax();
              $('.notifyjs-wrapper').remove();
              $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_success, { className: 'rtwmer_success', position: "right bottom" });
              $('#rtwmer-withdraw-table-id').DataTable().ajax.reload(null, false);
              $("#rtwmer_ven_with_amount").val("");
            
            } else {
              $('.notifyjs-wrapper').remove();
              $.notify(response, { className: 'rtwmer_error', position: "right bottom" });
            }

          }, 'json')
      }else{
        $('.notifyjs-wrapper').remove();
        $.notify('Insufficient Balance', { className: 'rtwmer_error', position: "right bottom" });
      }
    })

    var rtwmer_bal = $("#rtwmer_curent_bal").html();
    if (rtwmer_bal == 0) {
      $(".rtwmer_withdraw_request_form").css("dispaly", "none");
    }


    $(document).on("click", ".rtwmer_withdraw_cancel_button", function (e) {
      e.preventDefault();
      var rtwmer_cancel_id = $(this).attr("data-id");
      $(".rtwmer_loader").show();
      var data = {
        'action': 'withdraw_request_cancel_ajax',
        'rtwmer_cancel_id': rtwmer_cancel_id,
        'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
      };
      jQuery.post(
        rtwmer_ajax_object.rtwmer_ajax_url,
        data,
        function (response) {
          $(".rtwmer_loader").hide();
          $('.notifyjs-wrapper').remove();
          $.notify(response, { className: 'rtwmer_success', position: "right bottom" });
          rtwmer_count_ajax();
          $('#rtwmer-withdraw-table-id').DataTable().ajax.reload(null, false);
        }, 'json')
    })

    $(document).on("click", "#rtwmer_withdraw_request", function () {
      $(".rtwmer_req_table").css("display", "block");
      $(".rtwmer_status_table").css("display", "none");
      $(".listing_button").removeClass("rtwmer_active_button");
      $("#rtwmer_withdraw_request").addClass("rtwmer_active_button");
      var rtwmer = $("#rtwmer-withdraw-status").DataTable()
      rtwmer.state.clear();
      $("#rtwmer-withdraw-status").dataTable().fnDestroy();
      var rtwmer_withdraw_data_table;
      if (!$.fn.DataTable.isDataTable('#rtwmer-withdraw-table-id')) {
        rtwmer_withdraw_data_table = $('#rtwmer-withdraw-table-id').DataTable({
          'processing': true,
          'stateSave': true,
          'info': false,
          'sortable': true,
          'serverSide': true,
          "select": true,
          'responsive': true,
          'language': {
            search: "_INPUT_",
            searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
            'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
          },
          "drawCallback": function () {
            $('.dataTables_filter input').addClass('rtwmer-input-search-field');
            $('.dataTables_length select').addClass('rtwmer-select-box');
            $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
            $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
          },
          'ajax': {
            'url': rtwmer_ajax_object.rtwmer_ajax_url,
            'data': {
              'action': 'rtwmer_withdraw_all_table',
              'cond': 'request',
              'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            },
            'type': 'POST',
            "dataType": 'json',
          },
        });
      }
    })

    $(document).on("click", "#rtwmer_approved_request", function () {
      $(".rtwmer_req_table").css("display", "none");
      $(".rtwmer_status_table").css("display", "block");
      $(".listing_button").removeClass("rtwmer_active_button");
      $("#rtwmer_approved_request").addClass("rtwmer_active_button");
      var rtwmer = $("#rtwmer-withdraw-status").DataTable()
      rtwmer.state.clear();
      $("#rtwmer-withdraw-status").dataTable().fnDestroy();
      var rtwmer_withdraw_data_table;
      if (!$.fn.DataTable.isDataTable('#rtwmer-withdraw-status')) {
        rtwmer_withdraw_data_table = $('#rtwmer-withdraw-status').DataTable({
          'processing': true,
          'stateSave': true,
          'info': false,
          'sortable': true,
          'serverSide': true,
          "select": true,
          'responsive': true,
          'language': {
            search: "_INPUT_",
            searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
            'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
          },
          "drawCallback": function () {
            $('.dataTables_filter input').addClass('rtwmer-input-search-field');
            $('.dataTables_length select').addClass('rtwmer-select-box');
            $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
            $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
          },
          'ajax': {
            'url': rtwmer_ajax_object.rtwmer_ajax_url,
            'data': {
              'action': 'rtwmer_withdraw_all_table',
              'cond': 'approved',
              'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            },
            'type': 'POST',
            "dataType": 'json',
          },
        });
      }
    })

    $(document).on("click", "#rtwmer_cancel_request", function () {
      $(".rtwmer_req_table").css("display", "none");
      $(".rtwmer_status_table").css("display", "block");
      $(".listing_button").removeClass("rtwmer_active_button");
      $("#rtwmer_cancel_request").addClass("rtwmer_active_button");
      var rtwmer = $("#rtwmer-withdraw-status").DataTable()
      rtwmer.state.clear();
      $("#rtwmer-withdraw-status").dataTable().fnDestroy();
      var rtwmer_withdraw_data_table;
      if (!$.fn.DataTable.isDataTable('#rtwmer-withdraw-status')) {
        rtwmer_withdraw_data_table = $('#rtwmer-withdraw-status').DataTable({
          'processing': true,
          'stateSave': true,
          'info': false,
          'sortable': true,
          'serverSide': true,
          "select": true,
          'responsive': true,
          'language': {
            search: "_INPUT_",
            searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
            'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
          },
          "drawCallback": function () {
            $('.dataTables_filter input').addClass('rtwmer-input-search-field');
            $('.dataTables_length select').addClass('rtwmer-select-box');
            $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
            $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
          },
          'ajax': {
            'url': rtwmer_ajax_object.rtwmer_ajax_url,
            'data': {
              'action': 'rtwmer_withdraw_all_table',
              'cond': 'cancelled',
              'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            },
            'type': 'POST',
            "dataType": 'json',
          },
        });
      }
    })


    
    $(document).on("click", ".rtwmer-method-details", function (e) {
      e.preventDefault();
      var data = {
        'action': 'rtwrre_withdraw_method_detail_ajax',
        'rtwmer_withdraw_id': $(this).attr("data-id"),
        'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
      };
      jQuery.post(
        rtwmer_ajax_object.rtwmer_ajax_url,
        data,
        function (response) {
          rtwmer_count_ajax();
          $(".rtwmer_method_details_append").html(response);
        }, 'json')
      $("#rtwmer_method_detail_modal").addClass("rtwmer-modal-open");
      $("body").css("overflow", "hidden");
    })

    $(document).on("click", ".rtwmer_close_method_details", function () {
      $(".rtwmer_method_details_append").html("");
    })

    $(document).on("click", "#rtwmer_add_new_withdraw_req", function () {
      $("#rtwmer_withdraw_form").addClass("rtwmer-modal-open");
      $("body").css("overflow", "hidden");
    })


  })
})(jQuery);