(function ($) {
    'use strict';
    $(document).on('ready', function () {
        function getSelectValues(select) {
            var result = [];
            var options = select && select.options;
            var opt;
            if(Array.isArray(options)){
                for (var i = 0, iLen = options.length; i < iLen; i++) {
                    opt = options[i];

                    if (opt.selected) {
                        result.push(opt.value || opt.text);
                    }
                }
            }
            
            return result;
        } 

        $(document).find("#rtwmer-downloadable").on("click", function () {
            if ($(document).find("#rtwmer-downloadable").prop("checked")) {
                $(document).find(".rtwmer_downloadable_box").show();
            } else {
                $(document).find(".rtwmer_downloadable_box").hide();
            }
        })

        $(document).find(".rtwmer_remove_prod_img").on("click", function () {
            $("#rtwmer-image-preview").hide();
            $(".rtwmer_remove_prod_image").hide();
            $(".rtwmer_upload_box").show();
            $('#rtwmer-image-preview').attr('src', "").css('width', 'auto');
            $('#rtwmer-image_attachment_id').val("");
        })

        ////////////////////////////////////////////////////////////////////////////////////////////////////
        var rtwmer_pro_file_frame;
        var rtwmer_pro_attachment;
        var wp_media_pro_post_id;
        var set_to_pro_post_id = "";
        jQuery(document).on('click', '.rtwmer-prod_upload_file', function (event) {
            event.preventDefault();
            if (rtwmer_pro_file_frame) {
                rtwmer_pro_file_frame.uploader.uploader.param('post_id', set_to_pro_post_id);
                rtwmer_pro_file_frame.open();
                return;
            } else {
                wp.media.model.settings.post.id = set_to_pro_post_id;
            }
            rtwmer_pro_file_frame = wp.media.frames.rtwmer_pro_file_frame = wp.media({
                title: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_file,
                button: {
                    text: rtwmer_ajax_object.rtwmer_translation.rtwmer_use_file,
                },
                multiple: true
            });

            rtwmer_pro_file_frame.on('select', function () {
                var selection = rtwmer_pro_file_frame.state().get('selection');
                selection.map(function (attachment) {
                    attachment.toJSON();
                    var rtwmer_table_html = $("#rtwmer_prod_download_file").html();

                    var rtwmer_push_html = '<input type="text" name="rtwmer_file_name[]" class="rtwmer_prod_file_name" placeholder="Name">';

                    var rtwmer_src_html = '<input type="text" name="rtwmer_file_path[]" class="rtwmer_file_src" placeholder="URL" value="' + attachment.attributes.url + '"><input type="hidden" name="rtwmer-file_id" class="rtwmer-file_id" value="' + attachment.id + '">';

                    var rtwmer_del_html = '<button class="rtwmer_delete mdc-button mdc-button--raised">' + rtwmer_ajax_object.rtwmer_translation.rtwmer_remove + '</button>';
                    var rtwmer_final_html = "<div class='rtwmer_add_file_section'><div>" + rtwmer_push_html + "</div><div>" + rtwmer_src_html + "</div><div>" + rtwmer_del_html + "</div></div>";
                    $("#rtwmer_prod_download_file").html(rtwmer_table_html + rtwmer_final_html);
                });
            });
            rtwmer_pro_file_frame.open();
        });
        jQuery('a.add_media').on('click', function () {
            wp.media.model.settings.post.id = wp_media_pro_post_id;
        });



        $(document).on("click", ".rtwmer_delete", function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })


        /*   create product section   */

        if ($(document).find('#rtwmer-button').hasClass('rtwmer_popup')) {

            $(document).find("#rtwmer-add-product").on("click", function () {
              
                $(document).find('.rtwmer-table').css('display', 'none');
                $(document).find('.rtwmer_no_modal_add_prod').slideDown(1000);
                $(document).find('.rtwmer_no_modal_add_prod').css({ "width": "70%", "margin": "0 auto" });
                $(document).find('.rtwmer_go_back').css('display', 'block');
            })
            $(document).find(".rtwmer_listing_button").on("click", function () {
                $(document).find('.rtwmer-table').css('display', 'block');
                $(document).find('.rtwmer_no_modal_add_prod').css('display', 'none');
                $(document).find('.rtwmer_go_back').css('display', 'none');
            })
            $(document).find(".rtwmer_div").on("click", function () {
                $(document).find('.rtwmer-table').css('display', 'block');
                $(document).find('.rtwmer_no_modal_add_prod').css('display', 'none');
                $(document).find('.rtwmer_go_back').css('display', 'none');
            })
            $(document).find(".rtwmer_back_prod").on("click", function () {
                $(document).find('.rtwmer-table').css('display', 'block');
                $(document).find('.rtwmer_no_modal_add_prod').css('display', 'none');
                $(document).find('.rtwmer_go_back').css('display', 'none');
            })
        }

        $(document).on("click", "#rtwmer_schedule_button", function (e) {
            e.preventDefault();
            $(document).find(".rtwmer_schedule_box").slideDown();
            $(document).find("#rtwmer_schedule_cancel_button").css("display", "block");
            $(document).find("#rtwmer_schedule_button").css("display", "none");
        })

        $(document).on("click", "#rtwmer_schedule_cancel_button", function (e) {
            e.preventDefault();
            $(document).find(".rtwmer_schedule_box").slideUp();
            $(document).find("#rtwmer_schedule_cancel_button").css("display", "none");
            $(document).find("#rtwmer_schedule_button").css("display", "block");
        })


        function clear_form_elements(class_name) {
            jQuery(class_name).find(':input').each(function() {
              switch(this.type) {
                  case 'password':
                  case 'text':
                  case 'textarea':
                  case 'file':
                  case 'select-one':
                  case 'select-multiple':
                  case 'date':
                  case 'number':
                  case 'tel':
                  case 'email':
                      jQuery(this).val('');
                      break;
                  case 'checkbox':
                  case 'radio':
                      this.checked = false;
                      break;
              }
            });
          }



        $(document).on("click", ".rtwmer_close_product_modal", function () {

            // $("#rtwmer_prdct_modal").find('input:text,input:number,select,textarea').val('');
            // $("#rtwmer_prdct_modal").find('input:radio,input:checkbox').removeAttr('checked').removeAttr('selected');
            clear_form_elements("#rtwmer_prdct_modal");

            $(".rtwmer-add-product-div2").hide();
            $("#rtwmer-image-preview").attr("src", "").hide();
            $("#rtwmer_product_id").val("");
            $(".rtwmer_endsec").show();
            $("#rtwmer-image_attachment_id").val("");
            $("#rtwmer_product_name").val("");
            $("#rtwmer_product_price").val("");
            $("#rtwmer_discounted-price").val("");
            $("#rtwmer_visibility").val("Visible");
            $("#rtwmer_category").val("Uncategorized");
            $("#rtwmer_product_tags").val("").change();
            $("#rtwmer_description").val("");
            $("#rtwmer-downloadable").removeAttr('checked');
            $("#rtwmer-virtual").removeAttr('checked');
            $("#rtwmer_stock_manage").removeAttr('checked');
            $("#rtwmer_sku_field").val("");
            $("#rtwmer_schedule_from").val("");
            $("#rtwmer_schedule_to").val("");
            $("#rtwmer_stock_status").val("instock");
            $("#rtwmer_purchase_note_field").val("");
            $("#rtwmer_product_reviews").removeAttr('checked');
            $("#rtwmer_prod_exist").addClass("rtwmer_prod_new");
            $("#rtwmer_prod_exist").removeClass("rtwmer_prod_already_exist");
            $(".rtwmer-downlodable_prod").hide();
            $("#rtwmer_prod_download_file").empty();
        })



        $(document).on("keyup", "#rtwmer_sku_field", function (e) {
            if ($(this).val() != "") {
                var data = {
                    'action': 'check_if_sku_exists',
                    'rtwmer_sku_string': $(this).val(),
                    'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                };
                jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (response) {
                    if (response) {
                        $("#rtwmer_product_add").attr('disabled', 'disabled');
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_sku_exist, { className: 'rtwmer_error', position: "right bottom" });
                    } else {
                        $('#rtwmer_product_add').removeAttr('disabled');
                    }
                }, "json");
            }
        })


        $(document).on("click", "#rtwmer-create-product", function (e) {
            e.preventDefault();
            var rtwmer_id = $("#rtwmer_product_id").val();
            var rtwmer_image = $("#rtwmer-image_attachment_id").val();
            var rtwmer_product_name = $("#rtwmer_product_name").val();
            var rtwmer_schedule_to = $("#rtwmer_schedule_to").val();
            var rtwmer_schedule_from = $("#rtwmer_schedule_from").val();
            // var rtwmer_product_price = parseFloat($("#rtwmer_product_price").val());
            var rtwmer_product_price = parseFloat($("#rtwmer_product_price").val());
           
           
            if (rtwmer_product_name == "") {
                $('.notifyjs-wrapper').remove();
                $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_enter_prod_name, { className: 'rtwmer_error', position: "right bottom" });
                return;
            }
            if (rtwmer_product_price == "") {
                $('.notifyjs-wrapper').remove();
                $.notify('Enter Product Price', { className: 'rtwmer_error', position: "right bottom" });
                return;
            }
            
            var rtwmer_discount_price = $("#rtwmer_discounted-price").val();
            if(rtwmer_discount_price){
                rtwmer_discount_price = parseFloat($("#rtwmer_discounted-price").val());
            }else{
                rtwmer_discount_price = '';
            }
            // alert(typeof(rtwmer_product_price));
            // alert(typeof(rtwmer_discount_price));
            if (rtwmer_discount_price > rtwmer_product_price) {
                $('.notifyjs-wrapper').remove();
                $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_reg_should_great, { className: 'rtwmer_error', position: "right bottom" });
                return;
            }
            var rtwmer_category = new Array();
            rtwmer_category.push($("#rtwmer_category").val());
            var rtwmer_product_tags = [];
            rtwmer_product_tags.push($("#rtwmer_product_tags").val());
            var rtwmer_description = $("#rtwmer_description").val();
            var rtwmer_user_id = $("#rtwmer-create-product").data("id");

            var rtwmer_field = $(".rtwmer_product_data");
            if (rtwmer_field.length > 0) {
                var extra_data = {};
                $.each(rtwmer_field, function (index, event) {
                    extra_data[event.name] = event.value;
                });
            }

            var rtwmer_multiple_select = $(".rtwmer_product_multiple_data");
            if (rtwmer_multiple_select.length > 0) {
                var extra_multi_data = {};
                $.each(rtwmer_multiple_select, function (index, event) {
                    extra_multi_data[event.name] = getSelectValues(this);
                });
            }
            // console.log('testtt');

            var rtwmer_image_src = $(".rtwmer_image_src");
            // console.log("zee"+rtwmer_image_src);
            // return false;
            if (rtwmer_image_src.length > 0) {
                var rtwmer_image_src_path = {};
                $.each(rtwmer_image_src, function (index, event) {
                    rtwmer_image_src_path[event.name] = event.src;
                });
            }
          
           
             var rtwmer_extra_check = $(".rtwmer_prod_checkbox");
             if(rtwmer_extra_check.length>0){
               var rtw_check_obj={};
              $.each(rtwmer_extra_check, function(index,event) {
                rtw_check_obj[event.name]= $("#"+event.id).is(":checked");
               });
               }

            if ($("#rtwmer_prod_exist").hasClass("rtwmer_prod_new")) {
                var rtwmer_prod_exists = "new";
            } else if ($("#rtwmer_prod_exist").hasClass("rtwmer_prod_already_exist")) {
                var rtwmer_prod_exists = "old";
            }
            else {
                var rtwmer_prod_exists = "unknown";
            }
            $(".rtwmer_loader").show();
            var data = {
                'action': 'add_product_ajax',
                'image': rtwmer_image,
                'rtwmer_id': rtwmer_id,
                'rtwmer_schedule_from': rtwmer_schedule_from,
                'rtwmer_schedule_to': rtwmer_schedule_to,
                'pname': rtwmer_product_name,
                'pprice': rtwmer_product_price,
                'dprice': rtwmer_discount_price,
                'category': rtwmer_category,
                'tags': rtwmer_product_tags,
                'desc': rtwmer_description,
                'userID': rtwmer_user_id,
                'cond': 'rtwmer_add_prod',
                'rtwmer_prod_exists': rtwmer_prod_exists,
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            
           
            if (rtwmer_field.length > 0) {
                var data = { ...extra_data, ...data };
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

            jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (response) {
                // console.log(response);
                // alert('hello');

                if(response){
                    $(".rtwmer_loader").hide();
                    $("#rtwmer_prdct_modal").removeClass("rtwmer-modal-open");
                    $('body').css('overflowY', 'auto'); 
                    $('#table_id').DataTable().ajax.reload(null, false);
                }
                if (response == "successful") {
                    // console.log("if"+response);
                    $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_success, { className: 'rtwmer_success', position: "right bottom" });
                    $("#rtwmer-image-preview").hide();
                    $("#rtwmer_product_id").val("");
                    $("#rtwmer-image_attachment_id").val("");
                    $("#rtwmer_product_name").val("");
                    $("#rtwmer_product_price").val("");
                    $("#rtwmer_discounted-price").val("");
                    $("#rtwmer_category").val("Uncategorized");
                    $("#rtwmer_product_tags").val("").change();
                    $("#rtwmer_description").val("");
                    $("#rtwmer_schedule_from").val("");
                    $("#rtwmer_schedule_to").val("");
                    $('#table_id').DataTable().ajax.reload(null, false);
                    // console.log(rtwmer_count_ajax());
                    $("#rtwmer_prod_exist").addClass("rtwmer_prod_new");
                    $("#rtwmer_prod_exist").removeClass("rtwmer_prod_already_exist");
                }
                else {
                    // console.log("else"+response);
                    $('.notifyjs-wrapper').remove();
                    $.notify(response, { className: 'rtwmer_error', position: "right bottom" });
                }
            }, 'json');
        })


        $(document).on("click", "#rtwmer_product_add", function () {
            
        $('#rtwmer_product_price').css('overflow', 'hidden');
     
            var image_src = $("#rtwmer-image-preview").attr('src');
            // console.log(image_src);
            // if(image_src == ''){
            //     console.log('zeeshan');
            // }else{
            //     console.log('zeeshan2');
            // }
            var rtwmer_image = $("#rtwmer-image_attachment_id").val();
          
            var rtwmer_id = $("#rtwmer_product_id").val();
            var rtwmer_product_name = $("#rtwmer_product_name").val();
            var rtwmer_product_price = parseFloat($("#rtwmer_product_price").val());
            var rtwmer_discount_price = parseFloat($("#rtwmer_discounted-price").val());
            if(isNaN(rtwmer_discount_price))
            {
                rtwmer_discount_price = '';
            }
            if(isNaN(rtwmer_product_price))
            {
                rtwmer_product_price = '';
            }
            var rtwmer_schedule_to = $("#rtwmer_schedule_to").val();
            var rtwmer_schedule_from = $("#rtwmer_schedule_from").val();
            var rtwmer_category = new Array();
            rtwmer_category.push($("#rtwmer_category").val());
            if (rtwmer_product_name == "") {
                $('.notifyjs-wrapper').remove();
                $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_enter_prod_name, { className: 'rtwmer_error', position: "right bottom" });
                return;
            }
            if (rtwmer_discount_price > rtwmer_product_price) {
                $('.notifyjs-wrapper').remove();
                $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_reg_should_great, { className: 'rtwmer_error', position: "right bottom" });
                return;
            }
            var rtwmer_product_tags = [];
            rtwmer_product_tags.push($("#rtwmer_product_tags").val());
            var rtwmer_description = $("#rtwmer_description").val();
            //console.log(rtwmer_description);
            var rtwmer_user_id = $("#rtwmer-create-product").data("id");

            if ($("#rtwmer-downloadable").prop("checked")) {
                var rtwmer_download_product = 'yes';
            } else {
                var rtwmer_download_product = 'no';
            }
            if ($("#rtwmer-virtual").prop("checked")) {
                var rtwmer_virtual_product = 'yes';
            } else {
                var rtwmer_virtual_product = 'no';
            }
            if ($("#rtwmer_stock_manage").attr("checked")) {
                var rtwmer_stock_manage = 'yes';
            } else {
                var rtwmer_stock_manage = 'no';
            }
            if ($("#rtwmer_single_product_permission").attr("checked")) {
                var rtwmer_single_product_permission = 'yes';
            } else {
                var rtwmer_single_product_permission = 'no';
            }
            //var rtwmer_short_description = tinyMCE.activeEditor.getContent({ format: 'text' });

            if (typeof tinyMCE !== 'undefined' && tinyMCE.activeEditor !== null) {
                var rtwmer_short_description = tinyMCE.activeEditor.getContent({ format: 'text' });
            }else{
                var rtwmer_short_description = $(document).find('#rtwmer_short_description_field').val();
            }
            // var rtwmer_short_description = $(document).find('#rtwmer_short_description_field').val();
            // console.log(rtwmer_short_description);
            if (rtwmer_download_product == "yes") {
                var rtwmer_downloadable_prod = $(".rtwmer_file_src");
                var rtwmer_downloadable_prod_id = $(".rtwmer-file_id");
                var rtwmer_downloadable_prod_name = $(".rtwmer_prod_file_name");
                var i = 0;
                var rtwmer_download_prod_array = [];
                for (i = 0; i < rtwmer_downloadable_prod.length; i++) {
                    var rtwmer_download_prod_name = $(rtwmer_downloadable_prod_name[i]).val()
                    var rtwmer_download_prod_src = $(rtwmer_downloadable_prod[i]).val();
                    var rtwmer_download_prod_id = $(rtwmer_downloadable_prod_id[i]).val();
                    rtwmer_download_prod_array[i] = [rtwmer_download_prod_id, rtwmer_download_prod_name, rtwmer_download_prod_src];
                }
                var rtwmer_prod_download_limit = $(".rtwmer_prod_download_limit").val();
                var rtwmer_prod_download_expiry = $(".rtwmer_prod_download_expiry").val();
            } else {
                var rtwmer_download_prod_array = [];
                var rtwmer_prod_download_limit = "";
                var rtwmer_prod_download_expiry = "";
            }
            //////////// extar product option ///////////
            var rtwmer_destination_include = $("#rtwmer_destination_include").val();
            var rtwmer_duration            = $("#rtwmer_duration").val();
            var rtwmer_experience          = $("#rtwmer_experience").val();
            var rtwmer_start_date          = $("#rtwmer_start_date").val();
            var rtwmer_end_date            = $("#rtwmer_end_date").val();
            var rtwmer_tour_leader         = $("#rtwmer_tour_leader").val();
            var rtwmer_weather             = $("#rtwmer_weather").val();
            var rtwmer_timeto_visit        = $("#rtwmer_time-to_visit").val();
            //var rtwmer_days                = $("#rtwmer_days").val();
            var rtwmer_included            = $("#rtwmer_included").val();
            var rtwmer_excluded            = $("#rtwmer_excluded").val();
            var rtwmer_other_details       = $("#rtwmer_other_details").val();
            var rtwmer_extra_note          = $("#rtwmer_extra_note").val();

            var rtwmer_days_and_desc = new Array();

            $(document).find('.rtwmer_curr_day_val').each(function(){
                rtwmer_days_and_desc.push($(this).val());
            });
            // console.log(rtwmer_days_and_desc);

            var rtwmer_sku = $("#rtwmer_sku_field").val();
            var rtwmer_stock_status = $("#rtwmer_stock_status").val();
            var rtwmer_visible = $("#rtwmer_visibility").val();
            var rtwmer_purchase_note_field = $("#rtwmer_purchase_note_field").val();
            if ($("#rtwmer_product_reviews").attr("checked")) {
                var rtwmer_product_reviews = 'open';
            } else {
                var rtwmer_product_reviews = 'closed';
            }

            var rtwmer_field = $(document).find(".rtwmer_product_data");
            if (rtwmer_field.length > 0) {
                var extra_data = {};
                $.each(rtwmer_field, function (index, event) {
                    extra_data[event.name] = event.value;
                });
            }
            var rtwmer_multiple_select = $(document).find(".rtwmer_product_multiple_data");

            if ($("#rtwmer_prod_exist").hasClass("rtwmer_prod_new")) {
                var rtwmer_prod_exists = "new";
            } else if ($("#rtwmer_prod_exist").hasClass("rtwmer_prod_already_exist")) {
                var rtwmer_prod_exists = "old";
            }
            else {
                var rtwmer_prod_exists = "unknown";
            }

            if (rtwmer_multiple_select.length > 0) {
                var extra_multi_data = {};
                $.each(rtwmer_multiple_select, function (index, event) {
                    extra_multi_data[event.name] = getSelectValues(event);
                });
            }

            var rtwmer_image_src = $(".rtwmer_image_src");
            // console.log(rtwmer_image_src.length);
            if (rtwmer_image_src.length > 0) {
                var rtwmer_image_src_path = {};
                $.each(rtwmer_image_src, function (index, event) {
                    rtwmer_image_src_path[event.name] = $(this).attr('data-id');
                });
            }

            // console.log(rtwmer_image_src_path);
            var rtwmer_extra_check = $(".rtwmer_prod_checkbox");
            if(rtwmer_extra_check.length>0){
              var rtw_check_obj={};
             $.each(rtwmer_extra_check, function(index,event) {
               rtw_check_obj[event.name]= $("#"+event.id).is(":checked");
              });
            }
            var pro_id = $(document).find('.rtwmer_variation_box').attr('data-product_id');
            // console.log(pro_id);
            $(".rtwmer_loader").show();
            var data = {
               
                'action': 'add_product_ajax',
                'rtwmer_product_id': pro_id,
                'image': rtwmer_image,
                'rtwmer_id': rtwmer_id,
                'pname': rtwmer_product_name,
                'pprice': rtwmer_product_price,
                'dprice': rtwmer_discount_price,
                'category': rtwmer_category,
                'rtwmer_schedule_from': rtwmer_schedule_from,
                'rtwmer_schedule_to': rtwmer_schedule_to,
                'tags': rtwmer_product_tags,
                'desc': rtwmer_description,
                'rtwmer_prod_exists': rtwmer_prod_exists,
                'userID': rtwmer_user_id,
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce,
                'download_product': rtwmer_download_product,
                'virtual_product': rtwmer_virtual_product,
                'stock_manage': rtwmer_stock_manage,
                'rtwmer_single_product_permission': rtwmer_single_product_permission,
                'short_description': rtwmer_short_description,
                'sku': rtwmer_sku,
                'stock_status': rtwmer_stock_status,
                'visibility': rtwmer_visible,
                'purchase_note_field': rtwmer_purchase_note_field,
                'product_reviews': rtwmer_product_reviews,
                'rtwmer_download_prod_array': rtwmer_download_prod_array,
                "rtwmer_prod_download_limit": rtwmer_prod_download_limit,
                "rtwmer_prod_download_expiry": rtwmer_prod_download_expiry,
                'rtwmer_destination_include' : rtwmer_destination_include, 
                'rtwmer_duration' : rtwmer_duration,            
                'rtwmer_experience' : rtwmer_experience,          
                'rtwmer_start_date' : rtwmer_start_date,
                'rtwmer_end_date' : rtwmer_end_date,          
                'rtwmer_tour_leader' : rtwmer_tour_leader,         
                'rtwmer_weather' : rtwmer_weather,             
                'rtwmer_timeto_visit' : rtwmer_timeto_visit,        
                'rtwmer_days_and_desc' : rtwmer_days_and_desc,                
                'rtwmer_included' : rtwmer_included,            
                'rtwmer_excluded' : rtwmer_excluded,            
                'rtwmer_other_details' : rtwmer_other_details,       
                'rtwmer_extra_note' : rtwmer_extra_note,          
                'cond': 'add_detailed',
            };
            
            if (rtwmer_field.length > 0) {
                var data = { ...extra_data, ...data };
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
            // console.log(data);
            jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (response) {
                if(response){
                    $(".rtwmer_loader").hide();
                    $(document).find('#rtwmer_prdct_modal').removeClass('rtwmer-modal-open');
                    $("body").css("overflow", "initial");
                }
                if (response == "successful") {
                    $('.notifyjs-wrapper').remove();
                
                    $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_success, { className: 'rtwmer_success', position: "right bottom" });
                    if(tinyMCE.activeEditor==null)
                    {
                        jQuery("#rtwmer_short_description_field").html();
                    }
                    else{
                        tinyMCE.activeEditor.dom.remove(tinyMCE.activeEditor.dom.select('p'));
                    }
                    $('#table_id').DataTable().ajax.reload(null, false);
                    rtwmer_count_ajax();
                    $(".rtwmer-add-product-div2").hide();
                    $("#rtwmer-image-preview").attr("src", "");
                    $("#rtwmer_product_id").val("");
                    $(".rtwmer_endsec").show();
                    $("#rtwmer-image_attachment_id").val("");
                    $("#rtwmer_product_name").val("");
                    $("#rtwmer_product_price").val("");
                    $("#rtwmer_discounted-price").val("");
                    $("#rtwmer_visibility").val("Visible");
                    $("#rtwmer_category").val("Uncategorized");
                    $("#rtwmer_product_tags").val("").change();
                    $("#rtwmer_description").val("");
                    $("#rtwmer-downloadable").removeAttr('checked');
                    $("#rtwmer-virtual").removeAttr('checked');
                    $("#rtwmer_stock_manage").removeAttr('checked');
                    $("#rtwmer_sku_field").val("");
                    $("#rtwmer_schedule_from").val("");
                    $("#rtwmer_schedule_to").val("");
                    $("#rtwmer_stock_status").val("instock");
                    $("#rtwmer_purchase_note_field").val("");
                    $("#rtwmer_product_reviews").removeAttr('checked');
                    $("#rtwmer_prod_download_file").html("");
                    $(".rtwmer_prod_download_limit").val("");
                    $(".rtwmer_prod_download_expiry").val("");
                    //$("#rtwmer_days").val("");
                    $("#rtwmer_included").val("");
                    $("#rtwmer_destination_include").val("");
                    $("#rtwmer_duration").val("");
                    $("#rtwmer_experience").val("");
                    $("#rtwmer_start_date").val("");
                    $("#rtwmer_end_date").val("");
                    $("#rtwmer_tour_leader").val("");
                    $("#rtwmer_weather").val("");
                    $("#rtwmer_time-to_visit").val("");
                    $("#rtwmer_excluded").val("");
                    $("#rtwmer_other_details").val("");
                    $("#rtwmer_extra_note").val("");
                    var rtwmer_extra = $(".rtwmer_product_data");
                    if (rtwmer_extra.length > 0) {
                        var rtw_obj = {};
                        $.each(rtwmer_extra, function (index, event) {
                            event.value = "";
                        });
                    }
                    $("#rtwmer_prod_exist").addClass("rtwmer_prod_new");
                    $("#rtwmer_prod_exist").removeClass("rtwmer_prod_already_exist");
                    if ($(document).find('#rtwmer-button').hasClass('rtwmer_popup')) {
                        $(document).find('.rtwmer-table').css('display', 'block');
                        $(document).find('.rtwmer_no_modal_add_prod').css('display', 'none');
                        $(document).find('.rtwmer_go_back').css('display', 'none');
                    }
                } else {
                    $('.notifyjs-wrapper').remove();
                    $.notify(response, { className: 'rtwmer_error', position: "right bottom" });
                }
            }, 'json');
        })

        $(document).on("click", ".rtwmer_add_days_desc", function () {
            var rtwmer_data = $(this).data('rtwmer_curr_day');
            var rtwmer_html = '<div><label>Day '+(rtwmer_data+1)+'</label><label class=""><textarea class="rtwmer_curr_day_val" id="" rows="2" cols="50"></textarea></label></div><input style="color: #090600;background-color: #D93;" type="button" data-rtwmer_curr_day="'+(rtwmer_data+1)+'" value="Add More" class="rtwmer_add_days_desc">';
            $(this).hide();
            //$(this).parent().append(rtwmer_html);
            $(".rtwmer_days_details div").last().append(rtwmer_html);
        });


        /*   all product working   */

        /*    On clicking checkbox it selects all checkbox     */
        $(document).on('click', '#rtwmer_parent_table_bulk_check', function (e) {
            if ($("#rtwmer_parent_table_bulk_check").prop("checked")) {
                $(".rtwmer_table_bulk_check").prop("checked", true);
            } else {
                $(".rtwmer_table_bulk_check").prop("checked", false);
            }
        })

        /*    delete button on single product       */
        $(document).on('click', '.rtwmer_delete_button', function (e) {
            // alert('fjsdkjf');
            // return;
            e.preventDefault();

            if (confirm(rtwmer_ajax_object.rtwmer_translation.rtwmer_trash_warning) ) {
                var rtwmer_ID = $(this).attr("data-id");
                $(".rtwmer_loader").show();
                var data = {
                    'action': 'delete_product_ajax',
                    'rtwmer_prod_ID': rtwmer_ID,
                    // 'rtwmer_condition': "delete_permanent",
                    'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                };
                jQuery.post(
                    rtwmer_ajax_object.rtwmer_ajax_url,
                    data,
                    function (response) {
                        
                        
                        if(response){
                            $(".rtwmer_loader").hide();
                        }
                        if (response == "Trashed successfully") {
                            rtwmer_count_ajax();
                            $('.notifyjs-wrapper').remove();
                            // console.log(rtwmer_ajax_object.rtwmer_translation.rtwmer_trash_success);
                            $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_trash_success, { className: 'rtwmer_success', position: "right bottom" });
                            setTimeout(function () { $('#table_id').DataTable().ajax.reload(null, false); }, 500);
                        } else if (response == "Deleted successfully") {
                            rtwmer_count_ajax();
                            $('.notifyjs-wrapper').remove();
                            $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_delete_success, { className: 'rtwmer_success', position: "right bottom" });
                            setTimeout(function () { $('#table_id').DataTable().ajax.reload(null, false); }, 500);
                        }
                    }, 'json')
            }
            else {
                $('#table_id').DataTable().ajax.reload(null, false);
                return;
            }
        })

        /*        edit button on single product in Table                 */
        $(document).on('click', '.rtwmer_edit_button', function (e) {
           
            e.preventDefault();
                document.addEventListener("wheel", function(event){
                    if(document.activeElement.type === "number")
                    {
                        document.activeElement.blur();
                    }
                });
               
            $(document).find("#rtwmer-add-product").trigger("click");
            
            $("#rtwmer_prod_exist").addClass("rtwmer_prod_already_exist");
            
            $("#rtwmer_prod_exist").removeClass("rtwmer_prod_new");
            $("#rtwmer_product_id").val($(this).attr("data-id"));
            var rtwmer_ID = $(this).attr("data-id");
          
            $(".rtwmer_loader").show();
            var data = {
                'action': 'edit_product_ajax',
                'rtwmer_data_ID': rtwmer_ID,
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            jQuery.post(
                rtwmer_ajax_object.rtwmer_ajax_url,
                data,
                function (response) {
                    // console.log(response);
                   
                    if(response){
                        $(".rtwmer_loader").hide();
                    }
                    
                    $(document).trigger('rtwmer_edit_prod_req', response);
                    if(response.temp_attach_src == ''){
                        $("#rtwmer-image-preview").attr("src", response.temp_src);
                    }else{
                        $("#rtwmer-image-preview").attr("src", response.temp_attach_src);
                    }
                    
                    $("#rtwmer-image-preview").css("display", "block");
                    $("#rtwmer-image_attachment_id").val(response.temp_attach_id);
                    $("#rtwmer_product_name").val(response.temp_name).addClass('rtwmer_focus');
                    $("#rtwmer_product_price").val(response.temp_reg_price).addClass('rtwmer_focus');
                    $("#rtwmer_discounted-price").val(response.temp_sale_price).addClass('rtwmer_focus');
                    $("#rtwmer_category").val(response.temp_cat[0]).change();
                    $("#rtwmer_product_tags").val(response.rtwmer_temp_tag).change();
                    $("#rtwmer_description").val(response.temp_desc).addClass('rtwmer_focus');
                    if ( response.rtwmer_days_and_desc ) 
                    {
                        var html = '';
                        var count = 1;
                        // console.log(typeof(response.rtwmer_days_and_desc));
                        // alert(Array.isArray(response.rtwmer_days_and_desc));
                        //var x=0; x<=15; x++

                        // for (var i = 0; i < response.rtwmer_days_and_desc.length; i++) 
                        // {
                        //     html += '<div><label>Day '+count+'</label><label class=""><textarea class="rtwmer_curr_day_val" id="" rows="2" cols="50">'+response.rtwmer_days_and_desc[i]+'</textarea></label></div>';
                        //     count++;
                        //     if ( i == response.rtwmer_days_and_desc.length-1) {
                        //         alert('hlo');
                        //         html += '<input style="color: #090600;background-color: #D93;" type="button" data-rtwmer_curr_day="'+(response.rtwmer_days_and_desc.length+1)+'" value="Add More" class="rtwmer_add_days_desc">'
                        //     }
                        // }
                        response.rtwmer_days_and_desc.forEach(function(elem, idx, array){
                            html += '<div><label>Day '+count+'</label><label class=""><textarea class="rtwmer_curr_day_val" id="" rows="2" cols="50">'+response.rtwmer_days_and_desc[idx]+'</textarea></label></div>';
                            if (idx === array.length - 1){ 
                               //console.log("Last callback call at index " + idx + " with value " + elem );
                               html += '<input style="color: #090600;background-color: #D93;" type="button" data-rtwmer_curr_day="'+(response.rtwmer_days_and_desc.length-1)+'" value="Add More" class="rtwmer_add_days_desc">' 
                            }
                            count++;
                        });
                        $(document).find('.rtwmer_days_details').html(html);
                    }

                    $("#rtwmer_destination_include").val(response.rtwmer_destination_include);
                    $("#rtwmer_duration").val(response.rtwmer_duration);
                    $("#rtwmer_experience").val(response.rtwmer_experience);
                    $("#rtwmer_start_date").val(response.rtwmer_start_date);
                    $("#rtwmer_end_date").val(response.rtwmer_end_date);
                    $("#rtwmer_tour_leader").val(response.rtwmer_tour_leader);
                    $("#rtwmer_weather").val(response.rtwmer_weather);
                    $("#rtwmer_time-to_visit").val(response.rtwmer_timeto_visit);
                    $("#rtwmer_days").val(response.rtwmer_days);
                    $("#rtwmer_included").val(response.rtwmer_included);
                    $("#rtwmer_excluded").val(response.rtwmer_excluded);
                    $("#rtwmer_other_details").val(response.rtwmer_other_details);
                    $("#rtwmer_extra_note").val(response.rtwmer_extra_note);

                    if(tinyMCE.activeEditor==null)
                    {
                        jQuery("#rtwmer_short_description_field").html(response.temp_short_desc);
                    }
                    else{
                        tinyMCE.activeEditor.setContent(response.temp_short_desc);
                    }

                    
                    if (response.rtwmer_is_downloadable) {
                        $("#rtwmer-downloadable").attr("checked", "true");
                    }
                    if ($(document).find("#rtwmer-downloadable").prop("checked")) {
                        $(document).find(".rtwmer_downloadable_box").show();
                    } else {
                        $(document).find(".rtwmer_downloadable_box").hide();
                    }
                    $.each(response.rtwmer_temp_downloadable, function (index, value) {
                        var rtwmer_push_html = ' <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">';
                        rtwmer_push_html += '<input type="text" name="rtwmer_file_name[]" class="rtwmer_prod_file_name mdc-text-field__input" value=' + value[0] + '>';
                        rtwmer_push_html += '<div class="mdc-notched-outline mdc-notched-outline--upgraded">';
                        rtwmer_push_html += '<div class="mdc-notched-outline__leading">'
                        rtwmer_push_html += '</div>';
                        rtwmer_push_html += '<div class="mdc-notched-outline__notch">';
                        rtwmer_push_html += '<span class="mdc-floating-label">' + rtwmer_ajax_object.rtwmer_translation.rtwmer_file_name + '</span>';
                        rtwmer_push_html += '</div>';
                        rtwmer_push_html += '<div class="mdc-notched-outline__trailing">';
                        rtwmer_push_html += '</div>';
                        rtwmer_push_html += '</div>';
                        rtwmer_push_html += '</label>';
                        var rtwmer_src_html = '<label class="mdc-text-field mdc-text-field--outlined rtwmer-prdct-price-label">';
                        rtwmer_src_html += '<input type="text" name="rtwmer_file_path[]" class="rtwmer_file_src mdc-text-field__input" placeholder="" value="' + value[1] + '"><input type="hidden" name="rtwmer-file_id" class="rtwmer-file_id" value="' + value[2] + '">';
                        rtwmer_src_html += '<div class="mdc-notched-outline mdc-notched-outline--upgraded">';
                        rtwmer_src_html += '<div class="mdc-notched-outline__leading"></div>';
                        rtwmer_src_html += '<div class="mdc-notched-outline__notch">';
                        rtwmer_src_html += '<span class="mdc-floating-label">' + rtwmer_ajax_object.rtwmer_translation.rtwmer_file_url + '</span>';
                        rtwmer_src_html += '</div><div class="mdc-notched-outline__trailing"></div>';
                        rtwmer_src_html += '</div></label>';
                        var rtwmer_del_html = '<button class="rtwmer_delete mdc-button mdc-button--raised rtwmer-footer-btn">' + rtwmer_ajax_object.rtwmer_translation.rtwmer_delete + '</button>';
                        var rtwmer_final_html = "<div><span>" + rtwmer_push_html + "</span><span>" + rtwmer_src_html + "</span><span>" + rtwmer_del_html + "</span></div>";
                        $(rtwmer_final_html).appendTo("#rtwmer_prod_download_file");
                    });
                    $("#rtwmer_sku_field").val(response.temp_sku).addClass('rtwmer_focus');
                    $("#rtwmer_stock_status").val(response.temp_stock_status).addClass('rtwmer_focus');
                    $(".rtwmer-dashboard-panel").hide();
                    $(".rtwmer-product-panel").show();
                    $(".rtwmer-orders-panel").hide();
                    $(".rtwmer-withdraw-panel").hide();
                    $(".rtwmer-Setting-panel").hide();
                    $(".rtwmer-payment-panel").hide();
                    $(".rtwmer-add-product-div").show();
                    $(document).find('.rtwmer_focus').each(function (a, b) {
                        $(this).siblings().addClass('mdc-notched-outline--notched');
                        $(this).siblings().children(".mdc-notched-outline__notch").children(".mdc-floating-label").addClass('mdc-floating-label--float-above');
                    });
                    $(".rtwmer_endsec").hide();
                    $(".rtwmer-add-product-div").show();
                    $(".rtwmer-add-product-div2").show();
                    if ($(document).find("#rtwer_prod_type").val() == "variable") {
                        $(".rtwmer_attribute").hide();
                        $(".rtwmer_variable_product").show();
                    }
                    else{
                        $(".rtwmer_attribute").show();
                        $(".rtwmer_variable_product").hide(); 
                    }

                    // if(response.rtwmer_temp_type == 'variable')
                    // {
                    //     $(document).find('#rtwer_prod_type').val('variable').change();
                    //     $(document).find('#rtwer_prod_type').val('Variable').change();
                    // }else if(response.rtwmer_temp_type == 'simple')
                    // {
                    //     $(document).find('#rtwer_prod_type').val('simple').change();
                    //     $(document).find('#rtwer_prod_type').val('Simple').change();
                    // }else if(response.rtwmer_temp_type == 'grouped')
                    // {
                    //     $(document).find('#rtwer_prod_type').val('grouped').change();
                    //     $(document).find('#rtwer_prod_type').val('Grouped').change();
                    // }

                    if (response.rtwmer_temp_type == "simple") {
                        if (!$('#rtwer_prod_type option[value="simple"]').prop("selected", true).length) {
                            $("#rtwer_prod_type").val("Simple").change();
                        }
                    }
                    if (response.rtwmer_temp_type == "variable") {
                        if (!$('#rtwer_prod_type option[value="variable"]').prop("selected", true).length) {
                            $("#rtwer_prod_type").val("Variable").change();
                        }
                    }
                    if (response.rtwmer_temp_type == "grouped") {
                        if (!$('#rtwer_prod_type option[value="grouped"]').prop("selected", true).length) {
                            $("#rtwer_prod_type").val("Grouped").change();
                        }
                    }
                    // $('#rtwer_prod_type').select2().val(response.rtwmer_temp_type).trigger("change");
                }, 'json')
        })

        $('#all').on('click', function () {
            table.page.len(-1).draw();
        });

        var rip = window.location.href;
        var rtwmer_link = rip.split("?");
        var rtwmer_withdraw_link = rip.split("#");
        var rtwmer_home = rtwmer_link[0].split("#");

        $(document).on("click", ".rtwmer-product", function () {
            var rtwmer_link_current = window.location.href;
            var rtwmer_withdraw_link = rtwmer_link_current.split("#");
            window.history.replaceState(null, null, rtwmer_home[0] + "#product");
            var rtwmer_prod_data_table;
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
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_product_table',
                            'cond': 'all_prod',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "order": [[2, "asc"]],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 5, 8]
                    }]
                });
            }
            rtwmer_count_ajax();
            $(".rtwmer_div").removeClass("rtwmer-active");
            $(".rtwmer-product").addClass("rtwmer-active");
            $(".rtwmer_endsec").show();
            $(".rtwmer-product-panel").show();
            $(".rtwmer-dashboard-panel").hide();
            $(".rtwmer-orders-panel").hide();
            $(".rtwmer-withdraw-panel").hide();
            $(".rtwmer-Setting-panel").hide();
            $(".rtwmer-payment-panel").hide();
            $(".rtwmer-table").show();
            $(".rtwmer-add-product-div2").hide();
            $(".rtwmer-add-product-div").hide();
        });

        /*       All product button working         */
        $(document).on("click", "#rtwmer_all_product_table", function () {

            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[1];
            if (rtwmer_page_detect != undefined) {
                var rtwmer = $("#table_id").DataTable()
                rtwmer.state.clear();
                $("#table_id").dataTable().fnDestroy();
            }
            var rtwmer_prod_data_table;
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
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_product_table',
                            'cond': 'all_prod',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "order": [[2, "asc"]],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 5, 8]
                    }]
                });
            }
            rtwmer_count_ajax();
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_all_product_table").addClass("rtwmer_active_button");
            $(".rtwmer_div").removeClass("rtwmer-active");
            $(".rtwmer-product").addClass("rtwmer-active");
            $(".rtwmer-dashboard-panel").hide();
            $(".rtwmer-product-panel").show();
            $(".rtwmer-orders-panel").hide();
            $(".rtwmer-withdraw-panel").hide();
            $(".rtwmer-Setting-panel").hide();
            $(".rtwmer-payment-panel").hide();
            $(".rtwmer-add-product-div").hide();
            $(".rtwmer-add-product-div2").hide();
        })

        /*          end of functions of single table                     */




        /*          pending product table                                    */
        $("#rtwmer_pending_product_table").on('click', function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[1];
            if (rtwmer_page_detect != 'pending_product') {
                var rtwmer = $("#table_id").DataTable()
                rtwmer.state.clear();
                $("#table_id").dataTable().fnDestroy();
            }
            var rtwmer_prod_data_table;
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
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_product_table',
                            'cond': 'pending_prod',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "order": [[2, "asc"]],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 5, 8]
                    }]
                });

            }
            $(".rtwmer-add-product-div2").hide();
            $(".rtwmer-add-product-div").hide();
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_pending_product_table").addClass("rtwmer_active_button");
        })



        /*        published product tables               */

        $(document).on('click', "#rtwmer_published_product_table", function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[1];
            if (rtwmer_page_detect != 'published_product') {
                var rtwmer = $("#table_id").DataTable()
                rtwmer.state.clear();
                $("#table_id").dataTable().fnDestroy();
            }
            var rtwmer_prod_data_table;
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
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_product_table',
                            'cond': 'published_prod',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "order": [[2, "asc"]],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 5, 8]
                    }]
                });

            }

            $(".rtwmer-add-product-div2").hide();
            $(".rtwmer-add-product-div").hide();
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_published_product_table").addClass("rtwmer_active_button");
        })




        /*   trash product Section*/
        $(document).on('click', '.rtwmer_listing_button', function (e) {
            $(".rtwmer_restore_op").css("display", "none");
        })

        $(document).on('click', '.rtwmer-product', function (e) {
            $(".rtwmer_restore_op").css("display", "none");
        })

        $(document).on('click', '#rtwmer_trash_product_table', function (e) {
            $(".rtwmer_restore_op").css("display", "block");
        })

        $(document).on('click', '#rtwmer_parent_table_bulk_check', function (e) {
            if ($("#rtwmer_parent_table_bulk_check").prop("checked")) {
                $(".rtwmer_table_trash_bulk_check").prop("checked", true);
            } else {
                $(".rtwmer_table_trash_bulk_check").prop("checked", false);
            }
        })





        $(document).on("click", '#rtwmer_bulk_action', function () {
            var bulk = $(".rtwmer_table_bulk_check");
            var id_array = [];
            for (var i = 0; i < bulk.length; i++) {
                if ($(bulk[i]).prop("checked")) {
                    id_array.push(($(bulk[i]).attr("data-id")));
                }
            }

            if (($("#rtwmer_select_box").val() == "Delete_multiple") && $("#rtwmer_trash_product_table").hasClass("rtwmer_active_button")) {
               

                if (id_array.length != 0) {
                    $(".rtwmer_loader").show();
                    var data = {
                        'action': 'delete_product_bulk_ajax',
                        'rtwmer_prod_ID_array': id_array,
                        'rtwmer_cond': 'Delete_multiple',
                        'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                    };
                    jQuery.post(
                        rtwmer_ajax_object.rtwmer_ajax_url,
                        data,
                        function (response) {
                           
                            if(response){
                                $(".rtwmer_loader").hide();
                            }
                            if (response == 1) {
                               
                                $('.notifyjs-wrapper').remove();
                                $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_delete_success, { className: 'rtwmer_success', position: "right bottom" });
                                setTimeout(function () { rtwmer_count_ajax(); $('#table_id').DataTable().ajax.reload(null, false); }, 100);
                               
                                $(document).find('#rtwmer_parent_table_bulk_check').prop('checked',false);
                                return;
                            }
                        }, 'json')
                }
            } else if ($("#rtwmer_select_box").val() == "Delete_multiple") {

                if (id_array.length != 0) {
                    $(".rtwmer_loader").show();
                    var data = {
                        'action': 'delete_product_bulk_ajax',
                        'rtwmer_prod_ID_array': id_array,
                        'rtwmer_cond': 'Trash_multiple',
                        'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                    };
                    jQuery.post(
                        rtwmer_ajax_object.rtwmer_ajax_url,
                        data,
                        function (response) {
                            if(response){
                                $(".rtwmer_loader").hide();
                            }
                            if (response == 1) {
                                $('.notifyjs-wrapper').remove();
                                $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_trash_success, { className: 'rtwmer_success', position: "right bottom" });
                                setTimeout(function () { rtwmer_count_ajax(); $('#table_id').DataTable().ajax.reload(null, false); }, 500);
                                $(document).find('#rtwmer_parent_table_bulk_check').prop('checked',false);
                                return;
                            }
                        })
                }
            } else if ($("#rtwmer_select_box").val() == "Restore_multiple") {
                if (id_array.length != 0) {
                    $(".rtwmer_loader").show();
                    var data = {
                        'action': 'delete_product_bulk_ajax',
                        'rtwmer_prod_ID_array': id_array,
                        'rtwmer_cond': 'Restore_multiple',
                        'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                    };
                    jQuery.post(
                        rtwmer_ajax_object.rtwmer_ajax_url,
                        data,
                        function (response) {
                            if(response){
                                $(".rtwmer_loader").hide();
                            }
                            if (response == 1) {
                                $('.notifyjs-wrapper').remove();
                                $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_restore_success, { className: 'rtwmer_success', position: "right bottom" });
                                setTimeout(function () { rtwmer_count_ajax(); $('#table_id').DataTable().ajax.reload(null, false); }, 500);
                                $(document).find('#rtwmer_parent_table_bulk_check').prop('checked',false);
                                return;
                            }
                        })
                }
            }
        })

        /*     bulk action select box  */






        $(document).on('click', '.rtwmer_restore_button', function (e) {
            e.preventDefault();
            var rtwmer_ID = $(this).attr("data-id");
            $(".rtwmer_loader").show();
            var data = {
                'action': 'restore_prod_ajax',
                'rtwmer_data_ID': rtwmer_ID,
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            jQuery.post(
                rtwmer_ajax_object.rtwmer_ajax_url,
                data,
                function (response) {
                    if(response){
                        $(".rtwmer_loader").hide();
                    }
                    if (response == "restore successfully") {
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_restore_success, { className: 'rtwmer_success', position: "right bottom" });
                        setTimeout(function () { rtwmer_count_ajax(); $('#table_id').DataTable().ajax.reload(null, false); }, 1000);
                    }
                }, 'json')
        })


        $(document).on('click', '.rtwmer_trash_delete_button', function (e) {
            e.preventDefault();
            if (confirm("Are you sure you want to delete it permanently?")) {
                var rtwmer_ID = $(this).attr("data-id");
                $(".rtwmer_loader").show();
                var data = {
                    'action': 'delete_permanently_product_ajax',
                    'rtwmer_prod_ID': rtwmer_ID,
                    'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                };
                jQuery.post(
                    rtwmer_ajax_object.rtwmer_ajax_url,
                    data,
                    function (response) {
                        if(response){
                            $(".rtwmer_loader").hide();
                        }
                        if (response == "deleted successfully") {
                            $('.notifyjs-wrapper').remove();
                            $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_delete_success, { className: 'rtwmer_success', position: "right bottom" });
                            setTimeout(function () { rtwmer_count_ajax(); $('#table_id').DataTable().ajax.reload(null, false); }, 1000);

                        }
                    })
            } else {
                return;
            }
        })


        $(document).on('click', "#rtwmer_trash_product_table", function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[1];
            if (rtwmer_page_detect != 'trashed_product') {
                var rtwmer = $("#table_id").DataTable()
                rtwmer.state.clear();
                $("#table_id").dataTable().fnDestroy();
            }
            var rtwmer_prod_data_table;
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
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_product_table',
                            'cond': 'trash_prod',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "order": [[2, "asc"]],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 5, 8]
                    }]
                });

            }
            $(".rtwmer-add-product-div2").hide();
            $(".rtwmer-add-product-div").hide();
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_trash_product_table").addClass("rtwmer_active_button");
        })



        $(document).on('click', "#rtwmer_product_filter", function () {
            var rtwmer_date = $("#rtwmer_archieve_filter option:selected").text();
            if ($("#rtwmer_published_product_table").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "published_prod";
            } else if ($("#rtwmer_pending_product_table").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "pending_prod";
            } else if ($("#rtwmer_trash_product_table").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "trash_prod";
            } else {
                var rtwmer_cond = "all_prod";
            }
            var rtwmer_filter_cat = $("#rtwmer_filter_cat").val();
            var rtwmer = $("#table_id").DataTable()
            rtwmer.state.clear();
            $("#table_id").dataTable().fnDestroy();

            var rtwmer_prod_data_table;
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
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_product_table',
                            'rtwmer_date': rtwmer_date,
                            'cond': rtwmer_cond,
                            'rtwmer_cat_filter': rtwmer_filter_cat,
                            'rtwmer_filter': true,
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "order": [[2, "asc"]],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 5, 8]
                    }]
                });
            }
        })
    })
})(jQuery);
