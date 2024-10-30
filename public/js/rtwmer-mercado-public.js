(function ($) {
  'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *var rtwmer_trans = rtwmer_pro_obj.rtwmer_pro_translations;
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
  $(document).ready(function () {

    $(document).find(".rtwmer-toggle-sidebar").click(function () {
      $(".rtwmer_vendor_drawer").addClass("rtwmer-show-sidebar");
    });
    $(document).find(".rtwmer-sidebar-close").click(function () {
      $(".rtwmer_vendor_drawer").removeClass("rtwmer-show-sidebar");
    });
    $(document).find(".rtwmer_sidebar_list_item").click(function () {
      $(".rtwmer_vendor_drawer").removeClass("rtwmer-show-sidebar");
    });

    if(typeof datepicker == 'function'){
      $(document).find("#rtwmer_schedule_from").datepicker({
        dateFormat: 'yy-mm-dd'
      });
  
      $(document).find("#rtwmer_schedule_to").datepicker({
        dateFormat: 'yy-mm-dd'
      });
    }
   
    $('.rtwmer-withdra-card,.rtwmer_announcement_div').wrapAll('<div class="rtwmer_parent_wrapper"></div>');
   
    // $("#rtwmer_drawer_content").niceScroll();
    $(".rtwmer_payment_tabs_list").niceScroll();

    $(".rtwmer-home-wrap").css("top", $("#wpadminbar").css("height"));
    $(".rtwmer_vendor_drawer").css("top", $("#wpadminbar").css("height"));
    $(".rtwmer-modal-dialog").css("top", $("#wpadminbar").css("height"));

    if ($(document).find(".rtwmer_store_setup_wizzard_body").length > 0) {

      $("#rtwmer_store_banner_preview").hide();
      var file_frame;
      var attachment;
      var wp_media_post_id;
      var set_to_post_id = $("#rtwmer_store_banner_upload_button").attr("data-id"); 
      jQuery(document).on('click', '#rtwmer_store_banner_upload_button', function (event) {
        event.preventDefault();
        if (file_frame) {
          file_frame.uploader.uploader.param('post_id', set_to_post_id);
          file_frame.open();
          return;
        } else {
          wp.media.model.settings.post.id = set_to_post_id;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
          title: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_img,
          button: {
            text: rtwmer_ajax_object.rtwmer_translation.rtwmer_use_this_img,
          },
          multiple: false
        });
        file_frame.on('select', function () {
          $("#rtwmer_store_banner_preview").show();
          attachment = file_frame.state().get('selection').first().toJSON();
          $('#rtwmer_store_banner_preview').attr('src', attachment.url).css('width', 'auto');
          $('#rtwmer_store_setup_img_id').val(attachment.id);
          wp.media.model.settings.post.id = wp_media_post_id;
        });
        file_frame.open();
      });

      jQuery('a.add_media').on('click', function () {
        wp.media.model.settings.post.id = wp_media_post_id;
      });


      $("#rtwmer_store_setup_profile").hide();
      var rtwmer_pro_file_frame;
      var rtwmer_pro_attachment;
      var wp_media_pro_post_id;
      var set_to_pro_post_id = $("#rtwmer_store_profile_upload_button").attr("data-id");
      jQuery(document).on('click', '#rtwmer_store_profile_upload_button', function (event) {
        event.preventDefault();


        if (rtwmer_pro_file_frame) {

          rtwmer_pro_file_frame.uploader.uploader.param('post_id', set_to_pro_post_id);

          rtwmer_pro_file_frame.open();
          return;
        } else {

          wp.media.model.settings.post.id = set_to_pro_post_id;
        }

        rtwmer_pro_file_frame = wp.media.frames.rtwmer_pro_file_frame = wp.media({
          title: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_img,
          button: {
            text: rtwmer_ajax_object.rtwmer_translation.rtwmer_use_this_img,
          },
          multiple: false
        });

        rtwmer_pro_file_frame.on('select', function () {
          $("#rtwmer_store_setup_profile").show();
          rtwmer_pro_attachment = rtwmer_pro_file_frame.state().get('selection').first().toJSON();
          $('#rtwmer_store_setup_profile').attr('src', rtwmer_pro_attachment.url).css('width', 'auto');
          $('#rtwmer_store_profile_id').val(rtwmer_pro_attachment.id);
          wp.media.model.settings.post.id = wp_media_pro_post_id;
        });
        rtwmer_pro_file_frame.open();
      });
      jQuery('a.add_media').on('click', function () {
        wp.media.model.settings.post.id = wp_media_pro_post_id;
      });

      $(document).find('.rtwmer_setup_timing_input').timepicker();

      $(document).find(".rtwmer_setup_days").select2({
        // theme: "material",
        width: '15%',
      });

      if ($("#rtwmer_setup_show_time_widget").prop("checked")) {
        $(document).find(".rtwmer_time_widget").show();
      } else {
        $(document).find(".rtwmer_time_widget").hide();
      }

      $(document).on("click", "#rtwmer_setup_show_time_widget", function () {
        if ($("#rtwmer_setup_show_time_widget").prop("checked")) {
          $(document).find(".rtwmer_time_widget").show();
        } else {
          $(document).find(".rtwmer_time_widget").hide();
        }
        $(".rtwmer_modal").addClass("rtwmer-modal-open");
        $("body").css("overflow", "hidden");
      })

      if ($(document).find("#rtwmer_setup_sunday").val() == "close") {
        $(document).find("#rtwmer_setup_sunday").siblings(".rtwmer_setup_timing").hide();
      }

      $(document).on("change", "#rtwmer_setup_sunday", function () {
        if ($(this).val() == 'open') {
          $(document).find(this).siblings(".rtwmer_setup_timing").show();
        } else {
          $(document).find(this).siblings(".rtwmer_setup_timing").hide();
        }
      })
      $(document).on("change", "#rtwmer_setup_monday", function () {
        if ($(this).val() == 'open') {
          $(document).find(this).siblings(".rtwmer_setup_timing").show();
        } else {
          $(document).find(this).siblings(".rtwmer_setup_timing").hide();
        }
      })
      $(document).on("change", "#rtwmer_setup_tuesday", function () {
        if ($(this).val() == 'open') {
          $(document).find(this).siblings(".rtwmer_setup_timing").show();
        } else {
          $(document).find(this).siblings(".rtwmer_setup_timing").hide();
        }
      })
      $(document).on("change", "#rtwmer_setup_wednesday", function () {
        if ($(this).val() == 'open') {
          $(document).find(this).siblings(".rtwmer_setup_timing").show();
        } else {
          $(document).find(this).siblings(".rtwmer_setup_timing").hide();
        }
      })
      $(document).on("change", "#rtwmer_setup_thursday", function () {
        if ($(this).val() == 'open') {
          $(document).find(this).siblings(".rtwmer_setup_timing").show();
        } else {
          $(document).find(this).siblings(".rtwmer_setup_timing").hide();
        }
      })
      $(document).on("change", "#rtwmer_setup_friday", function () {
        if ($(this).val() == 'open') {
          $(document).find(this).siblings(".rtwmer_setup_timing").show();
        } else {
          $(document).find(this).siblings(".rtwmer_setup_timing").hide();
        }
      })

      $(document).on("change", "#rtwmer_setup_saturday", function () {
        if ($(this).val() == 'open') {
          $(document).find(this).siblings(".rtwmer_setup_timing").show();
        } else {
          $(document).find(this).siblings(".rtwmer_setup_timing").hide();
        }
      })

      $(".rtwmer_store_setup_settings_sec").hide();
      $(".rtwmer_store_setup_tabs a").click(function(e) {
        e.preventDefault();
        var position = $(this).parent().position();
        var width = $(this).parent().width();
          $(".rtwmer_store_setup_tabs .rtwmer_tab_slider").css({"left":+ position.left,"width":width});
      });
       var actWidth = $(".rtwmer_tab_active").parent().width();
      var actPosition = $(".rtwmer_tab_active").parent().position();
      if(actPosition != undefined ){
        $(".rtwmer_tab_slider").css({"left":+ actPosition.left,"width": actWidth});
      }
      
      $(document).on("click",".rtwmer_store_tabs",function(e){
        $(".rtwmer_setup_section").hide();
        $("."+$(this).attr("data-section")).show();
        $(".rtwmer_store_tabs").removeClass("rtwmer_tab_active");
        $(this).addClass("rtwmer_tab_active");
      });
      $(document).on("click",".rtwmer_store_next_btn",function(){
        //$(".rtwmer_store_tabs").removeClass("rtwmer_tab_active");
        $(".rtwmer_payment_details_btn").addClass("mdc-tab--active");
        $(".rtwmer_payment_details_btn .mdc-tab-indicator").addClass("mdc-tab-indicator--active");
        $(".rtwmer_general_details_btn").removeClass("mdc-tab--active");
        $(".rtwmer_general_details_btn .mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $(this).hide();
      });
      
      // rtwmer_hide_imp
      var actWidth = $(".rtwmer_tab_active").width();
      var actPosition = $(".rtwmer_tab_active").position();
     //$(".rtwmer_tab_slider").css({"left":+ actPosition.left,"width": actWidth});

      $(document).on("click", ".rtwmer_start_setup", function () {
        
        $(document).find(".rtwmer_store_setup_settings_sec").removeClass("rtwmer_hide_imp");
        $(document).find(".rtwmer_store_setup_settings_sec").show();
        $(document).find(".rtwmer_start_up").hide();
      })
      $(document).on("click", ".rtwmer_next", function () {
        $(document).find(".rtwmer_store_setup_payment_sec").show();
        $(document).find(".rtwmer_store_setup_settings_sec").hide();
      })

      $(document).on("click", ".rtwmer_back", function () {
        $(document).find(".rtwmer_store_setup_payment_sec").hide();
        $(document).find(".rtwmer_store_setup_settings_sec").show();
      })

      $(document).find("#rtwmer_setup_payment_submit").on("click", function () {
        var rtwmer_banner_img = $("#rtwmer_store_setup_img_id").val();
        var rtwmer_profile_img = $("#rtwmer_store_profile_id").val();
        var rtwmer_prod_per_page = $("#rtwmer_store_setup_ppp").val();
        var rtwmer_address1 = $("#rtwmer_setup_address_one").val();
        var rtwmer_address2 = $("#rtwmer_setup_address_two").val();
        var rtwmer_city = $("#rtwmer_setup_address_city").val();
        var rtwmer_zip_code = $("#rtwmer_setup_address_zip").val();
        var rtwmer_country = $("#rtwmer_setup_country").val();
        var rtwmer_state = $("#rtwmer_setup_calc_shipping_state").val();
        var rtwmer_phone = $("#rtwmer_setup_vendor_phone").val();
        if ($("#rtwmer_setup_show_email").prop("checked")) {
          var rtwmer_show_email = true;
        } else {
          var rtwmer_show_email = false;
        }
        if ($("#rtwmer_setup_show_more_tab").prop("checked")) {
          var rtwmer_show_more = true;
        } else {
          var rtwmer_show_more = false;
        }
        var rtwmer_map_key = $("#rtwmer_setup_map_api_key").val();
        if ($("#rtwmer_setup_show_time_widget").prop("checked")) {
          var rtwmer_show_time_widget = true;
        } else {
          var rtwmer_show_time_widget = false;
        }
        var rtwmer_sunday = $("#rtwmer_setup_sunday").val();
        var rtwmer_sunday_open = $("#rtwmer_setup_sunday_open_time").val();
        var rtwmer_sunday_close = $("#rtwmer_setup_sunday_close_time").val();
        var rtwmer_monday = $("#rtwmer_setup_monday").val();
        var rtwmer_monday_open = $("#rtwmer_setup_monday_open_time").val();
        var rtwmer_monday_close = $("#rtwmer_setup_monday_close_time").val();
        var rtwmer_tuesday = $("#rtwmer_setup_tuesday").val();
        var rtwmer_tuesday_open = $("#rtwmer_setup_tuesday_open_time").val();
        var rtwmer_tuesday_close = $("#rtwmer_setup_tuesday_close_time").val();
        var rtwmer_wednesday = $("#rtwmer_setup_wednesday").val();
        var rtwmer_wednesday_open = $("#rtwmer_setup_wednesday_open_time").val();
        var rtwmer_wednesday_close = $("#rtwmer_setup_wednesday_close_time").val();
        var rtwmer_thursday = $("#rtwmer_setup_thursday").val();
        var rtwmer_thursday_open = $("#rtwmer_setup_thursday_open_time").val();
        var rtwmer_thursday_close = $("#rtwmer_setup_thursday_close_time").val();
        var rtwmer_friday = $("#rtwmer_setup_friday").val();
        var rtwmer_friday_open = $("#rtwmer_setup_friday_open_time").val();
        var rtwmer_friday_close = $("#rtwmer_setup_friday_close_time").val();
        var rtwmer_saturday = $("#rtwmer_setup_saturday").val();
        var rtwmer_saturday_open = $("#rtwmer_setup_saturday_open_time").val();
        var rtwmer_saturday_close = $("#rtwmer_setup_saturday_close_time").val();
        var rtwmer_store_op_notice = $("#rtwmer_setup_store_open_notice").val();
        var rtwmer_store_close_notice = $("#rtwmer_setup_store_close_notice").val();
        var rtwmer_paypal_email = $("#rtwmer_setup_payment_paypal_email").val();
        var rtwmer_stripe_id = $("#rtwmer_setup_payment_stripe").val();
        var rtwmer_account_name = $("#rtwmer_setup_payment_account_name").val();
        var rtwmer_account_no = $("#rtwmer_setup_payment_account_no").val();
        var rtwmer_bank_name = $("#rtwmer_setup_payment_bank_name").val();
        var rtwmer_bank_place = $("#rtwmer_setup_payment_bank_place").val();
        var rtwmer_routing_no = $("#rtwmer_setup_payment_routing_no").val();
        var rtwmer_iban = $("#rtwmer_setup_payment_iban").val();
        var rtwmer_swift_code = $("#rtwmer_setup_payment_swift_code").val();

        var rtwmer_extra = $(".rtwmer_store_setup_extra_field").children("input");
        if (rtwmer_extra.length > 0) {
          var rtw_obj = {};
          $.each(rtwmer_extra, function (index, event) {
            rtw_obj[event.name] = event.value;
          });
        }

        var rtwmer_extra_payment = $(".rtwmer_store_setup_payment_extra_field").children("input");
        if (rtwmer_extra_payment.length > 0) {
          var rtw_payment_obj = {};
          $.each(rtwmer_extra_payment, function (index, event) {
            rtw_payment_obj[event.name] = event.value;
          });
        }
        var data = {
          'action': 'rtwmer_store_setting',
          'rtwmer_banner_id': rtwmer_banner_img,
          'rtwmer_profile_id': rtwmer_profile_img,
          'rtwmer_ppp': rtwmer_prod_per_page,
          'rtwmer_street': rtwmer_address1,
          'rtwmer_street2t': rtwmer_address2,
          'rtwmer_city': rtwmer_city,
          'rtwmer_post_zip': rtwmer_zip_code,
          'rtwmer_country': rtwmer_country,
          'rtwmer_state': rtwmer_state,
          'rtwmer_phone': rtwmer_phone,
          'rtwmer_show_email': rtwmer_show_email,
          'rtwmer_show_more_tab': rtwmer_show_more,
          'rtwmer_map_api_key': rtwmer_map_key,
          'rtwmer_show_time_widget': rtwmer_show_time_widget,
          'rtwmer_sunday': rtwmer_sunday,
          'rtwmer_sunday_open_time': rtwmer_sunday_open,
          'rtwmer_sunday_close_time': rtwmer_sunday_close,
          'rtwmer_monday': rtwmer_monday,
          'rtwmer_monday_open_time': rtwmer_monday_open,
          'rtwmer_monday_close_time': rtwmer_monday_close,
          'rtwmer_tuesday': rtwmer_tuesday,
          'rtwmer_tuesday_open_time': rtwmer_tuesday_open,
          'rtwmer_tuesday_close_time': rtwmer_tuesday_close,
          'rtwmer_wednesday': rtwmer_wednesday,
          'rtwmer_wednesday_open_time': rtwmer_wednesday_open,
          'rtwmer_wednesday_close_time': rtwmer_wednesday_close,
          'rtwmer_thursday': rtwmer_thursday,
          'rtwmer_thursday_open_time': rtwmer_thursday_open,
          'rtwmer_thursday_close_time': rtwmer_thursday_close,
          'rtwmer_friday': rtwmer_friday,
          'rtwmer_friday_open_time': rtwmer_friday_open,
          'rtwmer_friday_close_time': rtwmer_friday_close,
          'rtwmer_saturday': rtwmer_saturday,
          'rtwmer_saturday_open_time': rtwmer_saturday_open,
          'rtwmer_saturday_close_time': rtwmer_saturday_close,
          'rtwmer_store_open_notice': rtwmer_store_op_notice,
          'rtwmer_store_close_notice': rtwmer_store_close_notice,
          'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
        };
        if (rtwmer_extra.length > 0) {
          var data = { ...rtw_obj, ...data };
        }
        jQuery.post(
          rtwmer_ajax_object.rtwmer_ajax_url,
          data,
          function (response) {
          }, "json")
        var rtwmer_data = {
          'action': 'rtwmer_payment_ajax',
          'rtwmer_paypal_email': rtwmer_paypal_email,
          'rtwmer_stripe_id':rtwmer_stripe_id,
          'rtwmer_account_name': rtwmer_account_name,
          'rtwmer_account_no': rtwmer_account_no,
          'rtwmer_bank_name': rtwmer_bank_name,
          'rtwmer_bank_place': rtwmer_bank_place,
          'rtwmer_routing_no': rtwmer_routing_no,
          'rtwmer_iban': rtwmer_iban,
          'rtwmer_swift_code': rtwmer_swift_code,
          'rtwmer_cond': 'store_setup_request',
          'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
        };
        if (rtwmer_extra_payment.length > 0) {
          var data = { ...rtw_payment_obj, ...data };
        }
        jQuery.post(
          rtwmer_ajax_object.rtwmer_ajax_url,
          rtwmer_data,
          function (response) {
            if (response != null) {
              window.location.reload();
            }
          }, "json")
      })
    }


    var rip = window.location.href;
    var rtwmer_link = rip.split("?");
    var rtwmer_withdraw_link = rip.split("#");
    var rtwmer_home = rtwmer_link[0].split("#");
    var rtwmer_sub_link = rtwmer_link[0];
    var i;
    for (i = 0; i < rtwmer_sub_link.length; i++) {
      if (rtwmer_sub_link[i] != "#") {
        continue;
      } else {
        var text = rtwmer_sub_link.substr(i + 1, rtwmer_sub_link.length - 1);
      }
    }

    function rtwmer_dashboard_load(){
      var data = {
        'action': 'rtwmer_get_data',
        'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
      };
  
      jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (rtwmer_response) {
        if (rtwmer_response) {
          // console.log(rtwmer_response);
         
          var product_all = rtwmer_response.pie_chart.rtwmer_prod_count_array.rtwmer_prod_all_count;
          var product_published = rtwmer_response.pie_chart.rtwmer_prod_count_array.rtwmer_prod_publish_count;
          var product_pending = rtwmer_response.pie_chart.rtwmer_prod_count_array.rtwmer_prod_pending_count;
  
          var withdraw_approved = rtwmer_response.pie_chart.rtwmer_withdraw_count_array.rtwmer_withdraw_approved_count;
          var withdraw_pending = rtwmer_response.pie_chart.rtwmer_withdraw_count_array.rtwmer_withdraw_pending_count;
          var withdraw_failed = rtwmer_response.pie_chart.rtwmer_withdraw_count_array.rtwmer_withdraw_cancelled_count;
          var total_withdraw = withdraw_approved + withdraw_pending + withdraw_failed;
  
  
          var order_total = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_all_count;
          var order_complete = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_complete_count;
          var order_processing = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_processing_count;
          var order_pending = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_pending_count;
          var order_on_hold = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_on_hold_count;
          var order_refunded = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_refunded_count;
          var order_cancelled = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_cancelled_count;
          var order_failed = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_failed_count;
  
  
          var rtwmer_complete_percentage = (order_complete / order_total) * 100;
          $(document).find("#rtwmer_completed_orders_progress").css("width", rtwmer_complete_percentage + "%");
  
          var rtwmer_processing_percentage = (order_processing / order_total) * 100;
          $(document).find("#rtwmer_process_orders_progress").css("width", rtwmer_processing_percentage + "%");
  
          var rtwmer_on_hold_percentage = (order_on_hold / order_total) * 100;
          $(document).find("#rtwmer_on_hold_orders_progress").css("width", rtwmer_on_hold_percentage + "%");
  
          var rtwmer_pending_percentage = (order_pending / order_total) * 100;
          $(document).find("#rtwmer_pending_orders_progress").css("width", rtwmer_pending_percentage + "%");
  
          var rtwmer_prod_publish_prod = (product_published / product_all) * 100;
          $(document).find("#rtwmer_published_product_progress").css("width", rtwmer_prod_publish_prod + "%");
  
          var rtwmer_prod_pending_prod = (product_pending / product_all) * 100;
          $(document).find("#rtwmer_pending_prod_progress").css("width", rtwmer_prod_pending_prod + "%");
  
          var rtwmer_approved_withdraw = (withdraw_approved / total_withdraw) * 100;
          $(document).find("#rtwmer_approved_withdraw_progress").css("width", rtwmer_approved_withdraw + "%");
  
          var rtwmer_pending_withdraw_percent = (withdraw_pending / total_withdraw) * 100;
          $(document).find("#rtwmer_pend_withdraw_progress").css("width", rtwmer_pending_withdraw_percent + "%");
          if ($("#rtwmer_order_chart").length) {
          
           if(order_total > 0){
            var rtwmer_labels = [rtwmer_ajax_object.rtwmer_translation.rtwmer_complete, rtwmer_ajax_object.rtwmer_translation.rtwmer_processing, rtwmer_ajax_object.rtwmer_translation.rtwmer_pending, rtwmer_ajax_object.rtwmer_translation.rtwmer_on_hold, rtwmer_ajax_object.rtwmer_translation.rtwmer_refunded, rtwmer_ajax_object.rtwmer_translation.rtwmer_cancelled, rtwmer_ajax_object.rtwmer_translation.rtwmer_failed];
            var rtwmer_data = [order_complete, order_processing, order_pending, order_on_hold, order_refunded, order_cancelled, order_failed];
  
            var doughnat_chart = new Chart("rtwmer_order_chart", {
              type: 'doughnut',
              data: {
                labels: [rtwmer_ajax_object.rtwmer_translation.rtwmer_complete, rtwmer_ajax_object.rtwmer_translation.rtwmer_processing, rtwmer_ajax_object.rtwmer_translation.rtwmer_pending, rtwmer_ajax_object.rtwmer_translation.rtwmer_on_hold, rtwmer_ajax_object.rtwmer_translation.rtwmer_refunded, rtwmer_ajax_object.rtwmer_translation.rtwmer_cancelled, rtwmer_ajax_object.rtwmer_translation.rtwmer_failed],
                datasets: [{
                  data: [order_complete, order_processing, order_pending, order_on_hold, order_refunded, order_cancelled, order_failed],
                  backgroundColor: ["#57eb77", "#e7e95f", "#e3b81c", "#4a2fe1", "#E5E5E5", "#E5E5E5", "#ECA3A3"],
                  hoverBackgroundColor: ["#57eb77", "#e7e95f", "#e3b81c", "#4a2fe1", "#E5E5E5", "#E5E5E5", "#ECA3A3"],
                  borderColor: [
                    '#ffffff'
                  ],
                  borderWidth: 0,
                }]
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                animateRotate: true,
                legend: {
                  display: false,
                  position: 'bottom',
                },
                title: {
                  display: true,
                  text: rtwmer_ajax_object.rtwmer_translation.rtwmer_order,
                  fontSize: 20,
                },
                tooltips: {
                  bodyFontSize: 20,
                  titleFontColor: '#000000',
                  bodyFontColor: '#000',
                  backgroundColor: '#FFF',
                },
  
              }
  
            });
  
            doughnat_chart.render();
           }
           else{
             var rtwmer_html = "<div class='rtwmer_no_order_found'>"+rtwmer_ajax_object.rtwmer_translation.rtwmer_no_order_found+"</div>";
             $("#rtwmer-chart-circle").html(rtwmer_html);
           }
           
          }
  
          var dates = rtwmer_response.bar_graph.rtwmer_dates;
          var sales = rtwmer_response.bar_graph.rtwmer_sales;
          
  
          if ($("#rtwmer_sales_chart").length) {
            var chart = new Chart("rtwmer_sales_chart", {
              type: 'line',
              data: {
                labels: dates,
                datasets: [{
                  label: [rtwmer_ajax_object.rtwmer_translation.rtwmer_total_sales],
                  data: sales,
                  backgroundColor: ["rgba(255,255,255,0)"],
                  borderColor: [
                    '#058fd2'
                  ],
                  borderWidth: 2,
                }]
              },
  
              options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                  display: true,
                  text: rtwmer_ajax_object.rtwmer_translation.rtwmer_total_sales_this_month
                },
                tooltips: {
                  mode: 'index',
                  intersect: false,
                },
                hover: {
                  mode: 'nearest',
                  intersect: true
                },
                scales: {
                  xAxes: [{
                    gridLines: {
                      display: false
                    }
                  }],
                  yAxes: [{
                    gridLines: {
                      display: false
                    },
                  }]
                }
              }
            });
            chart.render();
          }
  
          if((rtwmer_response.prod_sales_rec.rtwmer_prod_title.length > 0) && (rtwmer_response.prod_sales_rec.rtwmer_prod_sales.length > 0)){
            var prod_title = rtwmer_response.prod_sales_rec.rtwmer_prod_title;
            var prod_sales = rtwmer_response.prod_sales_rec.rtwmer_prod_sales;
            var coloR = [];
    
            var dynamicColors = function() {
               var r = Math.floor(Math.random() * 255);
               var g = Math.floor(Math.random() * 255);
               var b = Math.floor(Math.random() * 255);
               return "rgb(" + r + "," + g + "," + b + ")";
            };
    
            for (var i in prod_title) {
              coloR.push(dynamicColors());
           }
           if($("#rtwmer_prod_sales_chart").length > 0){
    var myChart = new Chart("rtwmer_prod_sales_chart", {
      type: 'pie',
      data: {
        labels: prod_title,
        datasets: [{
          backgroundColor:coloR, 
          data: prod_sales
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
      }
    });
  }
          }else{
            var rtwmer_html = "<div class='rtwmer_no_prod_sale_found'>"+rtwmer_ajax_object.rtwmer_translation.rtwmer_no_prod_sales_found+"</div>";
            $(".rtwmer_prod_sales_chart_box").html(rtwmer_html);
          }
        }
      }, 'json');
    }

    rtwmer_dashboard_load();

    var rtwmer_string = window.location.href;
    var index = rtwmer_string.indexOf("?rtwmer_order_id_csv=");  
if(index !== -1){
  window.location.replace(rtwmer_ajax_object.rtwmer_translation.rtwmer_dashboard_url+"#orders");
}



    if(text == undefined || text == ""){
      var fid = $(".rtwmer_vendor_main_menu li").first().children("a").attr("href");
      text = (fid != undefined) ? fid.substring(1, fid.length) : "";
    }

    if (text == "dashboard") {
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-dashboard").addClass("rtwmer-active");
      $(".rtwmer-dashboard-panel").show();
      $(".rtwmer_loader").hide();
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").hide();
      rtwmer_dashboard_load();
    }
    else if (text == "product") {
      var rtwmer_conditions;
      if (rtwmer_link[1] == "published_product") {
        rtwmer_conditions = "published_prod";
        $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
        $(".rtwmer_listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_published_product_table").addClass("rtwmer_active_button");
        $("#rtwmer_published_product_table").addClass("mdc-tab--active");
        $(".rtwmer_listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_published_product_table").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");

      } else if (rtwmer_link[1] == "trashed_product") {
        rtwmer_conditions = "trash_prod";
        $(".rtwmer_restore_op").css("display", "block");
        $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_trash_product_table").addClass("rtwmer_active_button");
        $(".rtwmer_listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_trash_product_table").addClass("mdc-tab--active");
        $(".rtwmer_listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_trash_product_table").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      } else if (rtwmer_link[1] == "pending_product") {
        rtwmer_conditions = "pending_prod";
        $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_pending_product_table").addClass("rtwmer_active_button");
        $(".rtwmer_listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_pending_product_table").addClass("mdc-tab--active");
        $(".rtwmer_listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_pending_product_table").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      }
      else {
        rtwmer_conditions = "all_prod";
        $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_all_product_table").addClass("rtwmer_active_button");
        $(".rtwmer_listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_all_product_table").addClass("mdc-tab--active");
        $(".rtwmer_listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_all_product_table").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      }
      var rtwmer_prod_data_table;
      rtwmer_count_ajax();
      if (!$.fn.DataTable.isDataTable('#table_id')) {
        rtwmer_prod_data_table = $('#table_id').DataTable({
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
            $(document).find(".dataTables_length label:first").addClass('rtwmer_label_show_entries');
            $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
            $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
          },
          'ajax': {
            'url': rtwmer_ajax_object.rtwmer_ajax_url,
            'data': {
              'action': 'rtwmer_product_table',
              'cond': rtwmer_conditions,
              'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            },
            'type': 'POST',
            "dataType": 'json',
          },
          "order": [[2, "asc"]],
          columnDefs: [{
            orderable: false,
            targets: [0, 1, 5, 8],
          }]
        });
      }
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-product").addClass("rtwmer-active");
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-product-panel").show();
      $(".rtwmer_loader").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").hide();
    }
    else if (text == "orders") {
      if (rtwmer_link[1] == "completed") {
        var rtwmer_load_cond = "complete_table";
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_order_complete_button").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_order_complete_button").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_order_complete_button").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      }
      else if (rtwmer_link[1] == "processing") {
        var rtwmer_load_cond = "processing_table";
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_order_processing_button").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_order_processing_button").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_order_processing_button").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      }
      else if (rtwmer_link[1] == "onhold") {
        var rtwmer_load_cond = "On_hold_table";
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_order_On_hold_button").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_order_On_hold_button").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_order_On_hold_button").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      }
      else if (rtwmer_link[1] == "pending") {
        var rtwmer_load_cond = "pending_table";
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_order_Pending_button").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_order_Pending_button").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_order_Pending_button").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      }
      else if (rtwmer_link[1] == "cancelled") {
        var rtwmer_load_cond = "cancel_table";
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_order_Cancelled_button").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_order_Cancelled_button").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_order_Cancelled_button").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      }
      else if (rtwmer_link[1] == "refunded") {
        var rtwmer_load_cond = "refunded_table";
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_order_Refunded_button").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_order_Refunded_button").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_order_Refunded_button").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      }
      else if (rtwmer_link[1] == "failed") {
        var rtwmer_load_cond = "failed_table";
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_order_Failed_button").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_order_Failed_button").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_order_Failed_button").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
      } else {
        var rtwmer_load_cond = "All_table";
      }
      var rtwmer_order_data_table;
      rtwmer_count_ajax();
      var rtwmer_ID = $('#rtwmer-order-all-table-id').attr("data-id");
      if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
        rtwmer_order_data_table = $('#rtwmer-order-all-table-id').dataTable({
          'processing': true,
          'stateSave': true,
          'info': false,
          'sortable': true,
          'serverSide': true,
          "select": true,
          'responsive': true,
          language: {
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
              'action': 'rtwmer_order_all_table',
              'cond': rtwmer_load_cond,
              'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            },
            'type': 'POST',
            "dataType": 'json',
          },
          "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
          }],
          "order": [1, 'asc']
        });
      }
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-orders").addClass("rtwmer-active");
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-orders-panel").show();
      $(".rtwmer_loader").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").hide();
    }
    else if (text == "withdraw") {

      if (rtwmer_link[1] == "approved") {
        $(".rtwmer_req_table").css("display", "none");
        $(".rtwmer_status_table").css("display", "block");
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_approved_request").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_approved_request").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_approved_request").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
        var rtwmer_withdraw_data_table;
        rtwmer_count_ajax();
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
      }
      else if (rtwmer_link[1] == "cancelled") {
        $(".rtwmer_req_table").css("display", "none");
        $(".rtwmer_status_table").css("display", "block");
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_cancel_request").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $("#rtwmer_cancel_request").addClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_cancel_request").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
        var rtwmer_withdraw_data_table;
        rtwmer_count_ajax();
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

      } else {
        $(".listing_button").removeClass("rtwmer_active_button");
        $("#rtwmer_withdraw_request").addClass("rtwmer_active_button");
        $(".listing_button").removeClass("mdc-tab--active");
        $(".listing_button").find(".mdc-tab-indicator").removeClass("mdc-tab-indicator--active");
        $("#rtwmer_withdraw_request").find(".mdc-tab-indicator").addClass("mdc-tab-indicator--active");
        $("#rtwmer_withdraw_request").addClass("mdc-tab--active");
        var rtwmer_withdraw_data_table;
        rtwmer_count_ajax();
        if (!$.fn.DataTable.isDataTable('#rtwmer-withdraw-table-id')) {
          rtwmer_withdraw_data_table = $('#rtwmer-withdraw-table-id').DataTable({
            'processing': true,
            'stateSave': true,
            'info': false,
            'sortable': true,
            'serverSide': true,
            "select": true,
            'responsive': true,
            "pagingType": "full_numbers",
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
      }
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-withdraw").addClass("rtwmer-active");
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").show();
      $(".rtwmer_loader").hide();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").hide();
    }
    else if (text == "Setting") {
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-setting").addClass("rtwmer-active");
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").show();
      $(".rtwmer_loader").hide();
      $(".rtwmer-payment-panel").hide();
    }
    else if (text == "payment") {
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-payments").addClass("rtwmer-active");
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").show();
      $(".rtwmer_loader").hide();

      var rtwmer_link = window.location.href;
      var rtwmer_array = rtwmer_link.split("?");
      var rtwmer_withdraw_link = rtwmer_array[0].split("#");
      if(rtwmer_array[1] == "paypal"){
        $(".rtwmer-input-padding").hide();
        $(".rtwmer_paypal_field").show();
        $(".rtwmer_payment_tab").removeClass("rtwmer_tab_active");
        $(".rtwmer_paypal_menu").addClass("rtwmer_tab_active");
      }else if(rtwmer_array[1] == "stripe"){
        $(".rtwmer-input-padding").hide();
        $(".rtwmer_stripe_field").show();
        $(".rtwmer_payment_tab").removeClass("rtwmer_tab_active");
        $(".rtwmer_stripe_menu").addClass("rtwmer_tab_active");
      }else if(rtwmer_array[1] == "bank"){
        $(".rtwmer-input-padding").hide();
        $(".rtwmer_bank_field").show();
        $(".rtwmer_payment_tab").removeClass("rtwmer_tab_active");
        $(".rtwmer_bank_menu").addClass("rtwmer_tab_active");
      }

    } else {
      $(".rtwmer_loader").hide();
    }

   

    $(document).on("click", ".rtwmer-modal-close", function () {
      $(this).closest(".rtwmer_modal").removeClass("rtwmer-modal-open");
      $("body").css("overflow-y", "scroll");
    });

    $(document).find("#rtwmer_bulk_action_order_check").select2({
      // theme: "material",
      width: '100%',
    });

    $(document).find('#rtwmer_product_tags').select2({
      placeholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_tag,
      width: '100%',
    });

    $(document).find("#rtwmer_setup_country").select2({
      width: '100%',
    });

    $(document).find("#rtwmer_paymet_method").select2({
      width: '100%',
      placeholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_payment,
    });

    $(document).find('#rtwmer_category').select2({
      // theme: "material",
      placeholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_cat,
      allowClear: true,
      width: '100%'
    });

    $(document).find("#rtwmer_country").select2({
      // theme: "material",
      width: '100%',
    });

    $(document).find("#rtwmer_select_box").select2({
      // theme: "material",
      width: '50%',
    });

    $(document).find("#rtwmer_filter_cat").select2({
      // theme: "material",
      width: '40%',
    });

    $(document).find("#rtwmer_stock_status").select2({
      // theme: "material",
      width: '31%',
    });

    $(document).find("#rtwmer_visibility").select2({
      // theme: "material",
      width: '31%',
    });

    $(document).find("#rtwmer_archieve_filter").select2({
      // theme: "material",
      width: '40%',
    });

    $(document).find(".rtwmer_order_filter_cust").select2({
      // theme: "material",
      width: '100%',
      minimumInputLength: 3,
      placeholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_for_reg_customer,
      ajax: {
        url: rtwmer_ajax_object.rtwmer_ajax_url,
        dataType: 'json',
        type: "POST",
        quietMillis: 50,
        data: function (term) {
          return {
            rtwmer_user_name: term,
            action: 'rtwmer_search_reg_users',
            rtwmer_nonce: rtwmer_ajax_object.rtwmer_ajax_nonce
          };
        },
        processResults: function (data, params) {
          var terms = [];
          if (data) {
            $.each(data, function (id, text) {
              terms.push({
                id: id,
                text: text
              });
            });
          }
          return {
            results: terms,
          };
        },
        cache: true,
      }
    });

    if ($.fn.datepicker) {
      $(document).find(".rtwmer_order_filter_date").datepicker({
        dateFormat: 'yy-mm-dd'
      });
    }

    $(document).on("click", ".rtwmer-dashboard", function () {
      window.history.replaceState(null, null, rtwmer_home[0]);
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-dashboard").addClass("rtwmer-active");
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-dashboard-panel").show();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").hide();
      rtwmer_dashboard_load();
      
    });

    $(document).on("click", ".rtwmer-withdraw", function () {
      window.history.replaceState(null, null, rtwmer_home[0] + "#withdraw");
      var rtwmer_withdraw_data_table;
      rtwmer_count_ajax();
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
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-withdraw").addClass("rtwmer-active");
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").show();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").hide();
    });
    $(document).on("click", ".rtwmer-setting", function () {
      window.history.replaceState(null, null, rtwmer_home[0] + "#Setting");
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-setting").addClass("rtwmer-active");
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").show();
      $(".rtwmer-payment-panel").hide();
    });
    $(document).on("click", ".rtwmer-payments", function () {
      window.history.replaceState(null, null, rtwmer_home[0] + "#payment");
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-payments").addClass("rtwmer-active");
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").show();
    });

    /////////////////////variation-swatches///////////////////////
    $(document).on("click", ".rtwmer-variation-swatches", function () {
      window.history.replaceState(null, null, rtwmer_home[0] + "#variation-swatches");
      $(".rtwmer_div").removeClass("rtwmer-active");
      $(".rtwmer-variation-swatches").addClass("rtwmer-active");
      $(".rtwmer-product-panel").hide();
      $(".rtwmer-dashboard-panel").hide();
      $(".rtwmer-orders-panel").hide();
      $(".rtwmer-withdraw-panel").hide();
      $(".rtwmer-Setting-panel").hide();
      $(".rtwmer-payment-panel").hide();
      $(".rtwmer-variation-swatches-panel").show();
    });
    /////////////////////variation-swatches///////////////////////



    $(document).on("click", "#rtwmer-add-product", function () {
      if (!$(document).find('#rtwmer-button').hasClass('rtwmer_popup')) {
        $("#rtwmer_prdct_modal").addClass("rtwmer-modal-open");
        $("body").css("overflow", "hidden");
      }
      $(".rtwmer_endsec").show();
      $(".rtwmer-add-product-div").show();
      $(".rtwmer-add-product-div2").hide();
    })
    $(document).on("click", ".rtwmer-Create_new", function () {
      $(".rtwmer_endsec").hide();
      $(".rtwmer-add-product-div").show();
      $(".rtwmer-add-product-div2").show();
    })

  })

 


})(jQuery);


function rtwmer_count_ajax() {

  var data = {
    'action': 'rtwmer_update_count',
    'rtwmer_cond': 'rtwmer_order_page',
    'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
  };

  jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (rtwmer_response_count) {
    // console.log(rtwmer_response_count);
    // return; 

    var rtwmer_all_prod_counts = rtwmer_response_count['rtwmer_prod_count_array'];
    var rtwmer_all_order_counts = rtwmer_response_count['rtwmer_order_count_array'];
    var rtwmer_all_withdraw_counts = rtwmer_response_count['rtwmer_withdraw_count_array'];
    var rtwmer_vendor_balance = rtwmer_response_count['rtwmer_vendor_bal'];

    jQuery(document).find(".rtwmer_all_prod").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_all + "(" + rtwmer_all_prod_counts['rtwmer_prod_all_count'] + ")");
    jQuery(document).find(".rtwmer_publish_prod").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_online + "(" + rtwmer_all_prod_counts['rtwmer_prod_publish_count'] + ")");
    jQuery(document).find(".rtwmer_pendin_prod").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_pending + "(" + rtwmer_all_prod_counts['rtwmer_prod_pending_count'] + ")");
    jQuery(document).find(".rtwmer_trash_prod").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_trash + "(" + rtwmer_all_prod_counts['rtwmer_prod_trash_count'] + ")");

    jQuery(document).find(".rtwmer_status_all").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_all + "(" + rtwmer_all_order_counts['rtwmer_order_all_count'] + ")");
    jQuery(document).find(".rtwmer_status_completed").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_complete + "(" + rtwmer_all_order_counts['rtwmer_order_complete_count'] + ")");
    jQuery(document).find(".rtwmer_status_processing").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_processing + "(" + rtwmer_all_order_counts['rtwmer_order_processing_count'] + ")");
    jQuery(document).find(".rtwmer_status_onhold").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_on_hold + "(" + rtwmer_all_order_counts['rtwmer_order_on_hold_count'] + ")");
    jQuery(document).find(".rtwmer_status_pending").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_pending + "(" + rtwmer_all_order_counts['rtwmer_order_pending_count'] + ")");
    jQuery(document).find(".rtwmer_status_cancelled").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_cancelled + "(" + rtwmer_all_order_counts['rtwmer_order_cancelled_count'] + ")");
    jQuery(document).find(".rtwmer_status_refunded").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_refunded + "(" + rtwmer_all_order_counts['rtwmer_order_refunded_count'] + ")");
    jQuery(document).find(".rtwmer_status_failed").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_failed + "(" + rtwmer_all_order_counts['rtwmer_order_failed_count'] + ")");

    jQuery(document).find(".rtwmer_withdraw_req").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_withdraw_req + "(" + rtwmer_all_withdraw_counts['rtwmer_withdraw_pending_count'] + ")");
    jQuery(document).find(".rtwmer_withdraw_approv").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_approved_req + "(" + rtwmer_all_withdraw_counts['rtwmer_withdraw_approved_count'] + ")");
    jQuery(document).find(".rtwmer_withdraw_cancel").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_cancelled_req + "(" + rtwmer_all_withdraw_counts['rtwmer_withdraw_cancelled_count'] + ")");
    jQuery(document).find("#rtwmer_curent_bal").html(rtwmer_vendor_balance);

  }, 'json');

}

function rtwmer_dashboard_load(){
  var data = {
    'action': 'rtwmer_get_data',
    'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
  };

  jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (rtwmer_response) {
    if (rtwmer_response) {
      var product_all = rtwmer_response.pie_chart.rtwmer_prod_count_array.rtwmer_prod_all_count;
      var product_published = rtwmer_response.pie_chart.rtwmer_prod_count_array.rtwmer_prod_publish_count;
      var product_pending = rtwmer_response.pie_chart.rtwmer_prod_count_array.rtwmer_prod_pending_count;

      var withdraw_approved = rtwmer_response.pie_chart.rtwmer_withdraw_count_array.rtwmer_withdraw_approved_count;
      var withdraw_pending = rtwmer_response.pie_chart.rtwmer_withdraw_count_array.rtwmer_withdraw_pending_count;
      var withdraw_failed = rtwmer_response.pie_chart.rtwmer_withdraw_count_array.rtwmer_withdraw_cancelled_count;
      var total_withdraw = withdraw_approved + withdraw_pending + withdraw_failed;


      var order_total = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_all_count;
      var order_complete = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_complete_count;
      var order_processing = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_processing_count;
      var order_pending = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_pending_count;
      var order_on_hold = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_on_hold_count;
      var order_refunded = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_refunded_count;
      var order_cancelled = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_cancelled_count;
      var order_failed = rtwmer_response.pie_chart.rtwmer_order_count_array.rtwmer_order_failed_count;


      var rtwmer_complete_percentage = (order_complete / order_total) * 100;
      jQuery(document).find("#rtwmer_completed_orders_progress").css("width", rtwmer_complete_percentage + "%");

      var rtwmer_processing_percentage = (order_processing / order_total) * 100;
      jQuery(document).find("#rtwmer_process_orders_progress").css("width", rtwmer_processing_percentage + "%");

      var rtwmer_on_hold_percentage = (order_on_hold / order_total) * 100;
      jQuery(document).find("#rtwmer_on_hold_orders_progress").css("width", rtwmer_on_hold_percentage + "%");

      var rtwmer_pending_percentage = (order_pending / order_total) * 100;
      jQuery(document).find("#rtwmer_pending_orders_progress").css("width", rtwmer_pending_percentage + "%");

      var rtwmer_prod_publish_prod = (product_published / product_all) * 100;
      jQuery(document).find("#rtwmer_published_product_progress").css("width", rtwmer_prod_publish_prod + "%");

      var rtwmer_prod_pending_prod = (product_pending / product_all) * 100;
      jQuery(document).find("#rtwmer_pending_prod_progress").css("width", rtwmer_prod_pending_prod + "%");

      var rtwmer_approved_withdraw = (withdraw_approved / total_withdraw) * 100;
      jQuery(document).find("#rtwmer_approved_withdraw_progress").css("width", rtwmer_approved_withdraw + "%");

      var rtwmer_pending_withdraw_percent = (withdraw_pending / total_withdraw) * 100;
      jQuery(document).find("#rtwmer_pend_withdraw_progress").css("width", rtwmer_pending_withdraw_percent + "%");
      if (jQuery("#rtwmer_order_chart").length) {
      
       if(order_total > 0){
        var rtwmer_labels = [rtwmer_ajax_object.rtwmer_translation.rtwmer_complete, rtwmer_ajax_object.rtwmer_translation.rtwmer_processing, rtwmer_ajax_object.rtwmer_translation.rtwmer_pending, rtwmer_ajax_object.rtwmer_translation.rtwmer_on_hold, rtwmer_ajax_object.rtwmer_translation.rtwmer_refunded, rtwmer_ajax_object.rtwmer_translation.rtwmer_cancelled, rtwmer_ajax_object.rtwmer_translation.rtwmer_failed];
        var rtwmer_data = [order_complete, order_processing, order_pending, order_on_hold, order_refunded, order_cancelled, order_failed];

        var doughnat_chart = new Chart("rtwmer_order_chart", {
          type: 'doughnut',
          data: {
            labels: [rtwmer_ajax_object.rtwmer_translation.rtwmer_complete, rtwmer_ajax_object.rtwmer_translation.rtwmer_processing, rtwmer_ajax_object.rtwmer_translation.rtwmer_pending, rtwmer_ajax_object.rtwmer_translation.rtwmer_on_hold, rtwmer_ajax_object.rtwmer_translation.rtwmer_refunded, rtwmer_ajax_object.rtwmer_translation.rtwmer_cancelled, rtwmer_ajax_object.rtwmer_translation.rtwmer_failed],
            datasets: [{
              data: [order_complete, order_processing, order_pending, order_on_hold, order_refunded, order_cancelled, order_failed],
              backgroundColor: ["#57eb77", "#e7e95f", "#e3b81c", "#4a2fe1", "#E5E5E5", "#E5E5E5", "#ECA3A3"],
              hoverBackgroundColor: ["#57eb77", "#e7e95f", "#e3b81c", "#4a2fe1", "#E5E5E5", "#E5E5E5", "#ECA3A3"],
              borderColor: [
                '#ffffff'
              ],
              borderWidth: 0,
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            animateRotate: true,
            legend: {
              display: false,
              position: 'bottom',
            },
            title: {
              display: true,
              text: rtwmer_ajax_object.rtwmer_translation.rtwmer_order,
              fontSize: 20,
            },
            tooltips: {
              bodyFontSize: 20,
              titleFontColor: '#000000',
              bodyFontColor: '#000',
              backgroundColor: '#FFF',
            },

          }

        });

        doughnat_chart.render();
       }
       else{
         var rtwmer_html = "<div class='rtwmer_no_order_found'>"+rtwmer_ajax_object.rtwmer_translation.rtwmer_no_order_found+"</div>";
         jQuery("#rtwmer-chart-circle").html(rtwmer_html);
       }
       
      }

      var dates = rtwmer_response.bar_graph.rtwmer_dates;
      var sales = rtwmer_response.bar_graph.rtwmer_sales;

      if (jQuery("#rtwmer_sales_chart").length) {
        var chart = new Chart("rtwmer_sales_chart", {
          type: 'line',
          data: {
            labels: dates,
            datasets: [{
              label: [rtwmer_ajax_object.rtwmer_translation.rtwmer_total_sales],
              data: sales,
              backgroundColor: ["rgba(255,255,255,0)"],
              borderColor: [
                '#058fd2'
              ],
              borderWidth: 2,
            }]
          },

          options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
              display: true,
              text: rtwmer_ajax_object.rtwmer_translation.rtwmer_total_sales_this_month
            },
            tooltips: {
              mode: 'index',
              intersect: false,
            },
            hover: {
              mode: 'nearest',
              intersect: true
            },
            scales: {
              xAxes: [{
                gridLines: {
                  display: false
                }
              }],
              yAxes: [{
                gridLines: {
                  display: false
                },
              }]
            }
          }
        });
        chart.render();
      }

      if((rtwmer_response.prod_sales_rec.rtwmer_prod_title.length > 0) && (rtwmer_response.prod_sales_rec.rtwmer_prod_sales.length > 0)){
        var prod_title = rtwmer_response.prod_sales_rec.rtwmer_prod_title;
        var prod_sales = rtwmer_response.prod_sales_rec.rtwmer_prod_sales;
        var coloR = [];

        var dynamicColors = function() {
           var r = Math.floor(Math.random() * 255);
           var g = Math.floor(Math.random() * 255);
           var b = Math.floor(Math.random() * 255);
           return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in prod_title) {
          coloR.push(dynamicColors());
       }
       if(jQuery("#rtwmer_prod_sales_chart").length > 0){
var myChart = new Chart("rtwmer_prod_sales_chart", {
  type: 'pie',
  data: {
    labels: prod_title,
    datasets: [{
      backgroundColor:coloR, 
      data: prod_sales
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
  }
});
}
      }else{
        var rtwmer_html = "<div class='rtwmer_no_prod_sale_found'>"+rtwmer_ajax_object.rtwmer_translation.rtwmer_no_prod_sales_found+"</div>";
        jQuery(".rtwmer_prod_sales_chart_box").html(rtwmer_html);
      }
    }
  }, 'json');
}

