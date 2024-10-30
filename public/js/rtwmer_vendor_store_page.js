(function ($) {
    'use strict';
    $(document).ready( function () {
        const old_pre = $('#rtwmer_profile_img_preview').attr('src');
        if($.fn.timepicker){
            $('.rtwmer_timing_input').timepicker();
        }

        $(document).on("click", ".rtwmer_banner_remove_button", function () {
            $(".rtwmer_banner_remove").hide();
            $("#rtwmer_store_upload_button").text(rtwmer_ajax_object.rtwmer_translation.rtwmer_upload_banner);
            $('#rtwmer_store_img_preview').attr('src', "" ).css('width', '100%');
            $('#rtwmer_store_img_preview').css('height', '100%');
                $('#rtwmer_store_img_id').val("");
        })

        var rtwmer_files_fram;
        var rtwmer_attachment;
        var wp_media_post_id;
        var set_to_post_id = $("#rtwmer-upload_image_button").attr("data-id"); 

        jQuery(document).on('click', '#rtwmer_store_upload_button', function (event) {
            event.preventDefault();
           
            if (rtwmer_files_fram) {
                rtwmer_files_fram.uploader.uploader.param('post_id', set_to_post_id);
                rtwmer_files_fram.open();
                return;
            } else {
                wp.media.model.settings.post.id = set_to_post_id;
            }
           
            rtwmer_files_fram = wp.media.frames.rtwmer_files_fram = wp.media({
                title: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_img,
                button: {
                    text: rtwmer_ajax_object.rtwmer_translation.rtwmer_use_this_img,
                },
                multiple: false	
            });
          
            rtwmer_files_fram.on('select', function () {
                $("#rtwmer_store_img_preview").show();
                $(".rtwmer_banner_remove").show();
                $("#rtwmer_store_upload_button").text(rtwmer_ajax_object.rtwmer_translation.rtwmer_change_banner);
                rtwmer_attachment = rtwmer_files_fram.state().get('selection').first().toJSON();
                $('#rtwmer_store_img_preview').attr('src', rtwmer_attachment.url ).css('width', 'auto');
                $('#rtwmer_store_img_id').val(rtwmer_attachment.id);
                wp.media.model.settings.post.id = wp_media_post_id;
            });
            rtwmer_files_fram.open();
        });
        
        jQuery('a.add_media').on('click', function () {
            wp.media.model.settings.post.id = wp_media_post_id;
        });

        $(document).on("click", "#rtwmer_show_time_widget", function () {
            if ($(document).find("#rtwmer_show_time_widget").prop('checked')) {
                $(document).find(".rtwmer_days_box").css("display", "block");
                $(document).find(".rtwmer_notice_row").show();
                $("#rtwmer_timming_modal").addClass("rtwmer-modal-open");
                $("body").css("overflow","hidden");
            } else {
                $(document).find(".rtwmer_days_box").css("display", "none");
                $(document).find(".rtwmer_notice_row").hide();
            }
        })

        if ($(document).find("#rtwmer_show_time_widget").prop("checked")) {
            $(document).find(".rtwmer_days_box").css("display", "block");
            $(document).find(".rtwmer_notice_row").show();
        }

        if ($(document).find("#rtwmer_sunday").val() == "close") {
            $(document).find("#rtwmer_sunday").next().hide();
        }
        if ($(document).find("#rtwmer_monday").val() == "close") {
            $(document).find("#rtwmer_monday").next().hide();
        }
        if ($(document).find("#rtwmer_tuesday").val() == "close") {
            $(document).find("#rtwmer_tuesday").next().hide();
        }
        if ($(document).find("#rtwmer_wednesday").val() == "close") {
            $(document).find("#rtwmer_wednesday").next().hide();
        }
        if ($(document).find("#rtwmer_thursday").val() == "close") {
            $(document).find("#rtwmer_thursday").next().hide();
        }
        if ($(document).find("#rtwmer_friday").val() == "close") {
            $(document).find("#rtwmer_friday").next().hide();
        }
        if ($(document).find("#rtwmer_saturday").val() == "close") {
            $(document).find("#rtwmer_saturday").next().hide();
        }

        $(document).on("change", "#rtwmer_sunday", function () {
            if ($(this).val() == 'open') {
                $(document).find(this).next().show();
            } else {
                $(document).find(this).next().hide();
            }
        })
        $(document).on("change", "#rtwmer_monday", function () {
            if ($(this).val() == 'open') {
                $(document).find(this).next().show();
            } else {
                $(document).find(this).next().hide();
            }
        })
        $(document).on("change", "#rtwmer_tuesday", function () {
            if ($(this).val() == 'open') {
                $(document).find(this).next().show();
            } else {
                $(document).find(this).next().hide();
            }
        })
        $(document).on("change", "#rtwmer_wednesday", function () {
            if ($(this).val() == 'open') {
                $(document).find(this).next().show();
            } else {
                $(document).find(this).next().hide();
            }
        })
        $(document).on("change", "#rtwmer_thursday", function () {
            if ($(this).val() == 'open') {
                $(document).find(this).next().show();
            } else {
                $(document).find(this).next().hide();
            }
        })
        $(document).on("change", "#rtwmer_friday", function () {
            if ($(this).val() == 'open') {
                $(document).find(this).next().show();
            } else {
                $(document).find(this).next().hide();
            }
        })
        $(document).on("change", "#rtwmer_saturday", function () {
            if ($(this).val() == 'open') {
                $(document).find(this).next().show();
            } else {
                $(document).find(this).next().hide();
            }
        })

        if ($.fn.googleMap) {
            if($('html').hasClass("rtwmer_vendor_map")){
                $(".rtwmer_vendor_map").googleMap({
                    zoom: 10, 
                    coords: [48.895651, 2.290569], 
                    type: "ROADMAP"
                });
            }
        }

        if($.fn.mapbox){
            if($('html').hasClass("rtwmer_vendor_map")){
                L.mapbox.accessToken = '<your access token here>';
                var map = L.mapbox.map('map')
                .setView([40, -74.50], 9)
                .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
            }
     }


    //  $(document).on("click", ".rtwmer_profile_remove_button", function () {
    //     $(".rtwmer_profile_remove").hide();
    //     $("#rtwmer_profile_upload_button").text(rtwmer_ajax_object.rtwmer_translation.rtwmer_upload_profile);
    //             $('#rtwmer_profile_img_preview').attr('src', "");
    //             $('#rtwmer_profile_img_id').val("");
    // })

    $(document).on("click", "#rtwmer_remove_profile_btn", function () {
       
        $(".rtwmer_profile_remove").hide();
        $("#rtwmer_profile_upload_button").text(rtwmer_ajax_object.rtwmer_translation.rtwmer_upload_profile);
        $('#rtwmer_profile_img_preview').attr('src', old_pre);
        $('#rtwmer_profile_img_id').val("");
        $('#rtwmer_remove_profile_btn').css("display","none");

    })

     var rtwmer_profile_files_fram;
     var rtwmer_profile_attachment;
        var wp_media_profile_post_id; 
        var set_to_post_id = $("#rtwmer_profile_img_id").attr("data-id"); 
        jQuery(document).on('click', '#rtwmer_profile_upload_button', function (event) {
            event.preventDefault();
          
            if (rtwmer_profile_files_fram) {
                rtwmer_profile_files_fram.uploader.uploader.param('post_id', set_to_post_id);
                rtwmer_profile_files_fram.open();
                return;
            } else {
                wp.media.model.settings.post.id = set_to_post_id;
            }
        
            rtwmer_profile_files_fram = wp.media.frames.rtwmer_profile_files_fram = wp.media({
                title: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_img,
                button: {
                    text: rtwmer_ajax_object.rtwmer_translation.rtwmer_use_this_img,
                },
                multiple: false
            });
         
            rtwmer_profile_files_fram.on('select', function () {
                $("#rtwmer_profile_img_preview").show();
               
                var test = $("#rtwmer_profile_img_preview").attr('src');
                if(test == old_pre){
                    $('#rtwmer_remove_profile_btn').css('display','inline-block');
                }
                // console.log(test);
                $("#rtwmer_profile_upload_button").text(rtwmer_ajax_object.rtwmer_translation.rtwmer_change_profile);
                $(".rtwmer_profile_remove").show();
                rtwmer_profile_attachment = rtwmer_profile_files_fram.state().get('selection').first().toJSON();
                $('#rtwmer_profile_img_preview').attr('src', rtwmer_profile_attachment.url).css('width', 'auto');
                $('#rtwmer_profile_img_id').val(rtwmer_profile_attachment.id);
                wp.media.model.settings.post.id = wp_media_profile_post_id;
            });

            rtwmer_profile_files_fram.open();
           
        });
        jQuery('a.add_media').on('click', function () {
            wp.media.model.settings.post.id = wp_media_profile_post_id;
        });

        $(document).on("click", "#rtwmer_store_submit", function () {
            var rtwmer_banner_id = $("#rtwmer_store_img_id").val();
            var rtwmer_profile_id = $("#rtwmer_profile_img_id").val();
            var rtwmer_ID = $("#rtwmer_store_submit").attr("data-id");
            var rtwmer_ppp = $("#rtwmer_store_ppp").val();
            var rtwmer_street = $("#rtwmer_address_one").val();
            var rtwmer_street2t = $("#rtwmer_address_two").val();
            var rtwmer_city = $("#rtwmer_address_city").val();
            var rtwmer_post_zip = $("#rtwmer_address_zip").val();
            var rtwmer_country = $("#rtwmer_country").val();
            var rtwmer_state = $("#rtwmer_calc_shipping_state").val();
            var rtwmer_phone = $("#rtwmer_vendor_phone").val();
            if ($("#rtwmer_show_email").prop('checked')) {
                var rtwmer_show_email = 1;
            }
            else {
                var rtwmer_show_email = 0;
            }
            if ($("#rtwmer_show_more_tab").prop('checked')) {
                var rtwmer_show_more_tab = 1;
            }
            else {
                var rtwmer_show_more_tab = 0;
            }
            var rtwmer_map_api_key = $("#rtwmer_map_api_key").val();
            if ($("#rtwmer_show_time_widget").prop('checked')) {
                var rtwmer_show_time_widget = 1;
            }
            else {
                var rtwmer_show_time_widget = 0;
            }
            var rtwmer_sunday = $("#rtwmer_sunday").val();
            var rtwmer_sunday_open_time = $("#rtwmer_sunday_open_time").val();
            var rtwmer_sunday_close_time = $("#rtwmer_sunday_close_time").val();
            var rtwmer_monday = $("#rtwmer_monday").val();
            var rtwmer_monday_open_time = $("#rtwmer_monday_open_time").val();
            var rtwmer_monday_close_time = $("#rtwmer_monday_close_time").val();
            var rtwmer_tuesday = $("#rtwmer_tuesday").val();
            var rtwmer_tuesday_open_time = $("#rtwmer_tuesday_open_time").val();
            var rtwmer_tuesday_close_time = $("#rtwmer_tuesday_close_time").val();
            var rtwmer_wednesday = $("#rtwmer_wednesday").val();
            var rtwmer_wednesday_open_time = $("#rtwmer_wednesday_open_time").val();
            var rtwmer_wednesday_close_time = $("#rtwmer_wednesday_close_time").val();
            var rtwmer_thursday = $("#rtwmer_thursday").val();
            var rtwmer_thursday_open_time = $("#rtwmer_thursday_open_time").val();
            var rtwmer_thursday_close_time = $("#rtwmer_thursday_close_time").val();
            var rtwmer_friday = $("#rtwmer_friday").val();
            var rtwmer_friday_open_time = $("#rtwmer_friday_open_time").val();
            var rtwmer_friday_close_time = $("#rtwmer_friday_close_time").val();
            var rtwmer_saturday = $("#rtwmer_saturday").val();
            var rtwmer_saturday_open_time = $("#rtwmer_saturday_open_time").val();
            var rtwmer_saturday_close_time = $("#rtwmer_saturday_close_time").val();
            var rtwmer_store_open_notice = $("#rtwmer_store_open_notice").val();
            var rtwmer_store_close_notice = $("#rtwmer_store_close_notice").val();
            var rtwmer_extra = $(".rtwmer_store_extra_field");
           if(rtwmer_extra.length>0){
             var rtw_obj={};
            $.each(rtwmer_extra, function(index,event) {
             rtw_obj[event.name]=event.value;
             });
             }
             var rtwmer_multiple_select = $(document).find(".rtwmer_store_multiple_data");
             if (rtwmer_multiple_select.length > 0) {
                var extra_multi_data = {};
                $.each(rtwmer_multiple_select, function (index, event) {
                    extra_multi_data[event.name] = getSelectValues(event);
                });
            }
            var rtwmer_image_src = $(".rtwmer_store_image_src");
            if (rtwmer_image_src.length > 0) {
                var rtwmer_image_src_path = {};
                $.each(rtwmer_image_src, function (index, event) {
                    rtwmer_image_src_path[event.name] = event.src;
                });
            }
             var rtwmer_extra_check = $(".rtwmer_store_checkbox");
             if(rtwmer_extra_check.length>0){
               var rtw_check_obj={};
              $.each(rtwmer_extra_check, function(index,event) {
                rtw_check_obj[event.name]= $("#"+event.id).is(":checked");
               });
               }
            var data = {
                'action': 'rtwmer_store_setting',
                'rtwmer_vendor_id': rtwmer_ID,
                'rtwmer_banner_id': rtwmer_banner_id,
                'rtwmer_profile_id':rtwmer_profile_id,
                'rtwmer_ppp': rtwmer_ppp,
                'rtwmer_street': rtwmer_street,
                'rtwmer_street2t': rtwmer_street2t,
                'rtwmer_city': rtwmer_city,
                'rtwmer_post_zip': rtwmer_post_zip,
                'rtwmer_country': rtwmer_country,
                'rtwmer_state': rtwmer_state,
                'rtwmer_phone': rtwmer_phone,
                'rtwmer_show_email': rtwmer_show_email,
                'rtwmer_show_more_tab': rtwmer_show_more_tab,
                'rtwmer_map_api_key': rtwmer_map_api_key,
                'rtwmer_show_time_widget': rtwmer_show_time_widget,
                'rtwmer_sunday': rtwmer_sunday,
                'rtwmer_sunday_open_time': rtwmer_sunday_open_time,
                'rtwmer_sunday_close_time': rtwmer_sunday_close_time,
                'rtwmer_monday': rtwmer_monday,
                'rtwmer_monday_open_time': rtwmer_monday_open_time,
                'rtwmer_monday_close_time': rtwmer_monday_close_time,
                'rtwmer_tuesday': rtwmer_tuesday,
                'rtwmer_tuesday_open_time': rtwmer_tuesday_open_time,
                'rtwmer_tuesday_close_time': rtwmer_tuesday_close_time,
                'rtwmer_wednesday': rtwmer_wednesday,
                'rtwmer_wednesday_open_time': rtwmer_wednesday_open_time,
                'rtwmer_wednesday_close_time': rtwmer_wednesday_close_time,
                'rtwmer_thursday': rtwmer_thursday,
                'rtwmer_thursday_open_time': rtwmer_thursday_open_time,
                'rtwmer_thursday_close_time': rtwmer_thursday_close_time,
                'rtwmer_friday': rtwmer_friday,
                'rtwmer_friday_open_time': rtwmer_friday_open_time,
                'rtwmer_friday_close_time': rtwmer_friday_close_time,
                'rtwmer_saturday': rtwmer_saturday,
                'rtwmer_saturday_open_time': rtwmer_saturday_open_time,
                'rtwmer_saturday_close_time': rtwmer_saturday_close_time,
                'rtwmer_store_open_notice': rtwmer_store_open_notice,
                'rtwmer_store_close_notice': rtwmer_store_close_notice,
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
                    if (response == "successfull") {
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_success, { className: 'rtwmer_success', position: "right bottom" });
                    }
                },"json")
        })
})


})(jQuery);