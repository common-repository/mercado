//This file is used for admin vendor section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url, rtwmer_vendor_status, rtwmer_vendor_data_id, rtwmer_checkboxes_all;
    
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    
    }
        $(document).ready(function( $ ){

            if(rtwmer_split_url[1] == '/vendor'){
                $(document).find('#wpbody-content').show();

                $(document).find('#rtw-mercado-withdraw').css('display','none');
                $(document).find('#rtw-mercado-vendor').css('display','block');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('#rtw-mercado-settings').css('display','none');
                $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-vendor').addClass('nav-tab-active');
                $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
                $(document).find('#rtwmer-loader-image').fadeOut();
                var rtwmer_sort_by_vend_status = $(document).find('#rtwmer_sort_by_vend_status_save').val();
                $(document).find( '#rtwmer_vendor_sort_'+rtwmer_sort_by_vend_status ).addClass('rtwmer_sort_by_status_active');
                $("#rtwmer_vendors_table").dataTable().fnDestroy();
                rtwmer_vendor_datatable(rtwmer_sort_by_vend_status);
                rtwmer_vendors_count_as_status();
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
            } 
			$('#rtwmer-admin-vendor').on('click', function(){
                $(document).find('#wpbody-content').show();
                // $(document).find('#rtw-mercado-withdraw').css('display','none');
                // $(document).find('#rtw-mercado-vendor').css('display','block');
                $(document).find('.rtwmer_mercado_vendor_product').css('display','none');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('.rtwmer_mercado_vendor_orders').hide();
                $(document).find('.rtwmer_vendors_details').show();
                // $(document).find('#rtw-mercado-settings').css('display','none');
                // $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                // $(document).find('#rtwmer-admin-vendor').addClass('nav-tab-active');
                // $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                // $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
                // $(document).find('.rtwmer-submenu').css('display','none');
                $(document).find('#rtwmer-loader-image').fadeOut();
                $("#rtwmer_vendors_table").dataTable().fnDestroy();
                var rtwmer_sort_by_vend_status = 'all_vend';
                $(document).find('.rtwmer_vendor_status').removeClass('rtwmer_sort_by_status_active');
                $(document).find('#rtwmer_vendor_sort_all_vend').addClass('rtwmer_sort_by_status_active');
                rtwmer_vendor_datatable(rtwmer_sort_by_vend_status);
                rtwmer_vendors_count_as_status();
                // $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                // $(document).find('#rtw-mercado-report').css('display','none');
                // $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                
        })

        $(document).on('click','#rtwmer_vendor_signup_box',function(){
            $(document).find('#rtwmer-admin-vendor').trigger('click');
        })
    

//====================== Function gets activated when clicked on apply button after choosiung an action=========///
//====================== Function gets activated when clicked on apply button after choosiung an action=========///

            $(document).on( 'change','.rtwmer_outer_checkbox',function(){

                $(document).find('.rtwmer_vendor_inner_checkbox').prop('checked', $(this).prop("checked"));
                $(document).find('.rtwmer_outer_checkbox').prop('checked', $(this).prop("checked"));

            } )

            $(document).on('change','.rtwmer_vendor_inner_checkbox', function() { 

                if($(document).find('.rtwmer_vendor_inner_checkbox:checked').length == $(document).find('.rtwmer_vendor_inner_checkbox').length){
                    $(document).find('.rtwmer_outer_checkbox').prop('checked',true);

                }else{
                    $(document).find('.rtwmer_outer_checkbox').prop('checked',false);
                }
            })

            $(document).on('click','#rtwmer_vendor_apply_bulk',function() {
                
                var rtwmer_vendor_bulk_action = $('#rtwmer_vendor_bulk_action').children('option:selected').val();

                if( rtwmer_vendor_bulk_action != 'rtwmer_not_selected' )
                {   
                    var rtwmer_vendor_array = [];

                    $.each($("input[name='rtwmer_inner_check']:checked"), function(){

                        rtwmer_vendor_array.push($(this).attr('data-id'));

                    });
                    
                    if( rtwmer_vendor_bulk_action == 'rtwmer_approve_vendor' )
                    {
                        rtwmer_vendor_bulk_action = 1;
                    }
                    if( rtwmer_vendor_bulk_action == 'rtwmer_disable_selling' )
                    {
                        rtwmer_vendor_bulk_action = 0;
                    }

                    if( rtwmer_vendor_array.length > 0 )
                    {   
                        $('#rtwmer-loader-image').css('display','block');

                        var rtwmer_vendor_bulk_data = {
                            'action' : 'rtwmer_vendor_bulk',
                            'rtwmer_vendor_array' : rtwmer_vendor_array,
                            'rtwmer_vendor_bulk_action' : rtwmer_vendor_bulk_action,
                            'rtwmer_vendor_bulk_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
                        }

                        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_vendor_bulk_data,function(response) {

                            $('#rtwmer-loader-image').css('display','none');
                            $('.rtwmer_vendor_inner_checkbox').prop('checked', false );
                            $('.rtwmer_outer_checkbox').prop('checked',false );

                            if( response == 1 )
                            {   
                                if( rtwmer_vendor_bulk_action == 1 )
                                {
                                    $( rtwmer_vendor_array ).each( function( item, rowId ) {
                                        $('.rtwmer_vendors_status' + rowId).prop('checked',true);
                                        $('.rtwmer_vendor_enable_selling' + rowId).prop('checked',true);
                                    })
                                }
                                if( rtwmer_vendor_bulk_action == 0 )
                                {
                                    $( rtwmer_vendor_array ).each( function( item, rowId ) {
                                        $('.rtwmer_vendors_status' + rowId).prop('checked',false);
                                        $('.rtwmer_vendor_enable_selling' + rowId).prop('checked',false);
                                    })
                                }
                                $('.notifyjs-wrapper').remove();
                                $.notify(
                                    rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg, {
                                    className : 'vendor_success',
                                    position : 'right bottom',
                                    }
                                )
                            }
                            else
                            {
                                $('.notifyjs-wrapper').remove();
                                $.notify(
                                    rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved, {
                                        className : 'vendor_error',
                                        position : 'right bottom',
                                    }
                                )
                            }
                        },'json')
                    }
                }
            })

//================Code Goes when clcik on capsule to activate or deactivate a vendor==========================//
//================Code Goes when clcik on capsule to activate or deactivate a vendor==========================//

            $(document).on('click','.rtwmer_vendors_status',function() {

             
              
                if($(this).is(':checked'))
                {
                    rtwmer_vendor_status  = 1;
                    rtwmer_vendor_data_id = $(this).attr('data-id');
                }
                else
                {
                    rtwmer_vendor_status  = 0;
                    rtwmer_vendor_data_id = $(this).attr('data-id');
                }
                
                var rtwmer_vendor_status_data = {
                    'action' : 'rtwmer_vendor_status',
                    'rtwmer_vendor_status' : rtwmer_vendor_status,
                    'rtwmer_vendor_data_id' : rtwmer_vendor_data_id,
                    'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
                } 
                   

                jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_vendor_status_data, function(response){
                    if(response==1)
                        {
                            $('#rtwmer_vendors_table').DataTable().ajax.reload();
                            rtwmer_vendors_count_as_status();
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved, {
                                className : 'vendor_success',
                                position : 'right bottom',
                                }
                            )
                        }
                        else
                        {
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg, {
                                    className : 'vendor_error',
                                    position : 'right bottom',
                                }
                            )
                        }
                },'json')

            })

            /* code for vendor can upload product start */


            $(document).on('click','.rtwmer_vendor_upload_product', function(){

                if($(this).is(':checked'))
                {
                    var rtwmer_vendor_upload_product_status  = 1;
                    var rtwmer_vendor_upload_product_id = $(this).attr('data-id');
                }
                else
                {
                    var rtwmer_vendor_upload_product_status  = 0;
                    var rtwmer_vendor_upload_product_id = $(this).attr('data-id');
                }
                
                var rtwmer_vendor_upload_product_data = {
                    'action' : 'rtwmer_vendor_upload_product',
                    'rtwmer_vendor_product_upload_status' : rtwmer_vendor_upload_product_status,
                    'rtwmer_vendor_data_id' : rtwmer_vendor_upload_product_id,
                    'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
                }

                jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_vendor_upload_product_data, function(response){
                    if(response==1)
                        {
                            $('#rtwmer_vendors_table').DataTable().ajax.reload();
                            rtwmer_vendors_count_as_status();
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                'vendor product upload status changed', {
                                className : 'vendor_success',
                                position : 'right bottom',
                                }
                            )
                        }
                        else
                        {
                            
                        }
                },'json')
                
            });
            
            /* code for vendor can upload product end */



//================== Code execute when click on pop up buttons of vendor section===========================//
//================== Code execute when click on pop up buttons of vendor section===========================//

            $(document).on( 'click','.rtwmer_vendor_options',function() {
                $('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_store_details');
                $('.rtwmer_mercado_vendor_next').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);
                $('#rtwmer_vendor_store_address').removeClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_payment_options').addClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_details_section').show();
                $('#rtwmer_vendor_store_address_section').hide();
                $('#rtwmer_vendor_payment_option_section').hide();
            } )

            $(document).on( 'click','#rtwmer_vendor_store_details',function() {
                $('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_store_details');
                $('.rtwmer_mercado_vendor_next').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);
                $('#rtwmer_vendor_store_details').addClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_address').removeClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_payment_options').removeClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_details_section').show();
                $('#rtwmer_vendor_store_address_section').hide();
                $('#rtwmer_vendor_payment_option_section').hide();
            } )

            $(document).on( 'click','#rtwmer_vendor_store_address',function() {
                $('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_store_address');
                $('.rtwmer_mercado_vendor_next').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);
                $('#rtwmer_vendor_store_address').addClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_payment_options').removeClass('rtwmer-store-btn-active');
                $("#rtwmer_vendor_store_details").removeClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_details_section').hide();
                $('#rtwmer_vendor_store_address_section').show();
                $('#rtwmer_vendor_payment_option_section').hide();
            } )

            $(document).on( 'click','#rtwmer_vendor_payment_options',function() {
                $('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_payment_options');
                $('.rtwmer_mercado_vendor_next').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_update);
                $('#rtwmer_vendor_payment_options').addClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_details').removeClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_address').removeClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_details_section').hide();
                $('#rtwmer_vendor_store_address_section').hide();
                $('#rtwmer_vendor_payment_option_section').show();
            } )

//===================Code Come into action when click on Next/Update Button on popup modal====================//
//===================Code Come into action when click on Next/Update Button on popup modal====================//

            $(document).on( 'click','.rtwmer_mercado_vendor_next',function() {
                // alert('first');
              
                var rtwmer_vendor_check_before_update  = $(this).attr('data-check');
              


                if( rtwmer_vendor_check_before_update == "rtwmer_addnew_vendor" )
                {
                    var rtwmer_add_new_vend_email = $(document).find('#rtwmer-add-new-vend-email').val();
                    var rtwmer_add_new_vend_uname = $(document).find('#rtwmer_add_new_vend_uname').val();
                    var rtwmer_add_new_vend_passwrd = $(document).find('#rtwmer_add_new_vend_passwrd').val();
                    var rtwmer_vendor_store_name1 = $(document).find('#rtwmer-add-vend-store-name').val();

                    if( rtwmer_add_new_vend_uname == "" || rtwmer_add_new_vend_email == "" || rtwmer_add_new_vend_passwrd == "" || rtwmer_vendor_store_name1 == "")
                    {
                        if( rtwmer_add_new_vend_uname == "" )
                        {
                            $('.notifyjs-wrapper').remove();
                                $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_prod_username_required, {
                                className : 'vendor_error',
                                position : 'right bottom',
                                }
                            );
                            return false;
                        }
                        else if( rtwmer_add_new_vend_email == "" )
                        {
                            $('.notifyjs-wrapper').remove();
                                $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_prod_email_required, {
                                className : 'vendor_error',
                                position : 'right bottom',
                                }
                            );
                            return false;
                        }
                        else if( rtwmer_add_new_vend_passwrd == "" )
                        {
                            $('.notifyjs-wrapper').remove();
                                $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_prod_password_required, {
                                className : 'vendor_error',
                                position : 'right bottom',
                                }
                                );
                            return false;
                        }
                        else if( rtwmer_vendor_store_name1 == "" )
                        {
                            $('.notifyjs-wrapper').remove();
                                $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_prod_store_name_required, {
                                className : 'vendor_error',
                                position : 'right bottom',
                                }
                                );
                            return false;
                        }
                    }
                }
                

                var rtwmer_vendor_next;
                rtwmer_vendor_next = $(this).attr('data-value');
               
                
                if(rtwmer_vendor_next == 'rtwmer_vendor_store_details')
                {
                   
                    
                    $(this).attr('data-value','rtwmer_vendor_store_address');
                    $(document).find('#rtwmer_vendor_store_details').removeClass('rtwmer-store-btn-active');
                    $(document).find('#rtwmer_vendor_store_address').addClass('rtwmer-store-btn-active');
                    $(document).find('#rtwmer_vendor_payment_options').removeClass('rtwmer-store-btn-active');
                    $(document).find('#rtwmer_vendor_store_details_section').hide();
                    $(document).find('#rtwmer_vendor_store_address_section').show();
                    $(document).find('#rtwmer_vendor_payment_option_section').hide();
                    $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('colors');
                    $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('active');
                    $(document).find('.rtwmer_vendoradd_store_detail_section').hide();
                    $(document).find('.rtwmer_vendoradd_store_addres_section').show();
                    $(document).find('.rtwmer_vendoradd_store_paymnt_section').hide();
                    $(document).find('#rtwmer-vend-add-new-img').hide();
                    $(document).find('#rtwmer-add-new-vend-store-address').addClass('active');
                    $(document).find('#rtwmer-add-new-vend-store-address').prev().addClass('colors');

                }

                if(rtwmer_vendor_next == 'rtwmer_vendor_store_address')
                {
                   
                    $(this).attr('data-value','rtwmer_vendor_payment_options');
                    $(this).html('Update');
                    $(document).find('#rtwmer_vendor_store_details').removeClass('rtwmer-store-btn-active');
                    $(document).find('#rtwmer_vendor_store_address').removeClass('rtwmer-store-btn-active');
                    $(document).find('#rtwmer_vendor_payment_options').addClass('rtwmer-store-btn-active');
                    $(document).find('#rtwmer_vendor_store_details_section').hide();
                    $(document).find('#rtwmer_vendor_store_address_section').hide();
                    $(document).find('#rtwmer_vendor_payment_option_section').show();

                    $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('colors');
                    $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('active');
                    $(document).find('.rtwmer_vendoradd_store_detail_section').hide();
                    $(document).find('.rtwmer_vendoradd_store_addres_section').hide();
                    $(document).find('.rtwmer_vendoradd_store_paymnt_section').show();
                    $(document).find('#rtwmer-vend-add-new-img').hide();
                    $(document).find('#rtwmer-add-new-vend-store-pymnt').addClass('active');
                    $(document).find('#rtwmer-add-new-vend-store-pymnt').prevAll().addClass('colors');
                }
                // alert('bah');
                if(rtwmer_vendor_next == 'rtwmer_vendor_payment_options')
                {  
                    // alert('in');
                    
                    var rtwmer_vendor_enable_selling,rtwmer_vendor_publishing_product,rtwmer_vendor_admin_featured_vendor

                    var rtwmer_vendor_check_before_update  = $(this).attr('data-check');
                    var rtwmer_vendor_data_id  = $(document).find('.rtwmer_mercado_vendor_next').attr('data-id');
                    
                    var rtwmer_vendor_img_id = $(document).find('.rtwmer_vendor_img_id').val();

                    if( rtwmer_vendor_check_before_update == 'rtwmer_addnew_vendor' )
                    {
                        
                        var rtwmer_add_new_vend_fname = $(document).find('#rtwmer-add-new-vend-fname').val();
                        var rtwmer_add_new_vend_lname = $(document).find('#rtwmer-add-new-vend-lname').val();
                        var rtwmer_add_new_vend_email = $(document).find('#rtwmer-add-new-vend-email').val();
                        var rtwmer_add_new_vend_uname = $(document).find('#rtwmer_add_new_vend_uname').val();
                        var rtwmer_add_new_vend_passwrd = $(document).find('#rtwmer_add_new_vend_passwrd').val();
                        var rtwmer_vendor_store_name1 = $(document).find('#rtwmer-add-vend-store-name').val(); 
                        var rtwmer_addnew_vend_paypal_email = $(document).find('#rtwmer_addnew_vend_paypal_email').val();
                        var rtwmer_addnew_vend_stripe_id = $(document).find('#rtwmer_addnew_vend_stripe_id').val();
                        var rtwmer_vendor_selected_country = $('#rtwmer_addnew_vend_country').children('option:selected').val(); 
                        var rtwmer_vendor_selected_state = $('.rtwmer_addnew_vendor_state').children('option:selected').val();  
                        var rtwmer_vendor_store_url = $(document).find('#rtwmer-add-new-vend-store-url').val();  
                        var rtwmer_vendor_store_phone = $(document).find('#rtwmer-add-new-vend-phone').val();
                        var rtwmer_vendor_store_address1 = $(document).find('#rtwmer_vendor_addnew_store_address1').val(); 
                        var rtwmer_vendor_store_address2 = $(document).find('#rtwmer_vendor_addnew_store_address2').val(); 
                        var rtwmer_vendor_town_city = $(document).find('#rtwmer_vendor_addnew_town_city').val(); 
                        var rtwmer_vendor_zip_code = $(document).find('#rtwmer_vendor_addnew_zip_code').val();
                        var rtwmer_vendor_bank_name = $(document).find('#rtwmer_vendor_addnew_bank_name').val();
                        var rtwmer_vendor_bank_account_no = $(document).find('#rtwmer-addnew-vend-acc-no').val();
                        var rtwmer_vendor_bank_address = $(document).find('#rtwmer_vendor_addnew_bank_address').val();
                        var rtwmer_vendor_routing_number = $(document).find('#rtwmer_vendor_addnew_routing_number').val();
                        var rtwmer_vendor_bank_iban = $(document).find('#rtwmer_vendor_addnew_bank_iban').val();
                        var rtwmer_vendor_bank_swift = $(document).find('#rtwmer_vendor_addnew_bank_swift').val();
                        
                        if( $(document).find('#rtwmer_addnew_vendor_enable_selling').is(':checked') )
                        {
                            rtwmer_vendor_enable_selling = 1;
                        }
                        else
                        {
                            rtwmer_vendor_enable_selling = 0;
                        }
                        if( $(document).find('.rtwmer_addnew_vendor_publishing_product').is(':checked') )
                        {
                            rtwmer_vendor_publishing_product = 1;
                        }
                        else
                        {
                            rtwmer_vendor_publishing_product = 0;
                        }
                        if( $(document).find('.rtwmer_addnew_vendor_admin_featured_vendor').is(':checked') )
                        {
                            rtwmer_vendor_admin_featured_vendor = 1;
                        }
                        else
                        {
                            rtwmer_vendor_admin_featured_vendor = 0;
                        }
                    }

                    if( rtwmer_vendor_check_before_update == 'rtwmer_edit_vendor' )
                    {
                       
                        var rtwmer_vendor_selected_country = $('#rtwmer_vendor_store_country').children('option:selected').val(); 
                        var rtwmer_vendor_selected_state = $('.rtwmer_vendor_state').children('option:selected').val(); 
                        var rtwmer_vendor_store_name1 = $(document).find('.rtwmer_vendor_store_name1').val();  
                        var rtwmer_vendor_store_url = $(document).find('.rtwmer_vendor_store_url').val();  
                        var rtwmer_vendor_store_phone = $(document).find('.rtwmer_vendor_store_phone').val(); 
                        var rtwmer_vendor_facebook = $(document).find('.rtwmer_vendor_facebook').val(); 
                        var rtwmer_vendor_google_plus = $(document).find('.rtwmer_vendor_google_plus').val(); 
                        var rtwmer_vendor_twitter = $(document).find('.rtwmer_vendor_twitter').val(); 
                        var rtwmer_vendor_pinterest = $(document).find('.rtwmer_vendor_pinterest').val(); 
                        var rtwmer_vendor_linkedin = $(document).find('.rtwmer_vendor_linkedin').val(); 
                        var rtwmer_vendor_youtube = $(document).find('.rtwmer_vendor_youtube').val(); 
                        var rtwmer_vendor_instagram = $(document).find('.rtwmer_vendor_instagram').val(); 
                        var rtwmer_vendor_flickr = $(document).find('.rtwmer_vendor_flickr').val(); 
                        var rtwmer_vendor_store_address1 = $(document).find('.rtwmer_vendor_store_address1').val(); 
                        var rtwmer_vendor_store_address2 = $(document).find('.rtwmer_vendor_store_address2').val(); 
                        var rtwmer_vendor_town_city = $(document).find('.rtwmer_vendor_town_city').val(); 
                        var rtwmer_vendor_zip_code = $(document).find('.rtwmer_vendor_zip_code').val();
                        var rtwmer_vendor_bank_name = $(document).find('.rtwmer_vendor_bank_name').val();
                        var rtwmer_vendor_bank_account_no = $(document).find('.rtwmer_vendor_bank_account_no').val();
                        var rtwmer_vendor_bank_address = $(document).find('.rtwmer_vendor_bank_address').val();
                        var rtwmer_vendor_routing_number = $(document).find('.rtwmer_vendor_routing_number').val();
                        var rtwmer_vendor_bank_iban = $(document).find('.rtwmer_vendor_bank_iban').val();
                        var rtwmer_addnew_vend_paypal_email = $(document).find('.rtwmer_vendor_paypal_email').val();
                        var rtwmer_addnew_vend_stripe_id = $(document).find('.rtwmer_vendor_stripe_id').val();
                        var rtwmer_vendor_bank_swift = $(document).find('.rtwmer_vendor_bank_swift').val();
    
                        if( $(document).find('#rtwmer_vendor_enable_selling').is(':checked') )
                        {
                            rtwmer_vendor_enable_selling = 1;
                        }
                        else
                        {
                            rtwmer_vendor_enable_selling = 0;
                        }
                        if( $(document).find('.rtwmer_vendor_publishing_product').is(':checked') )
                        {
                            rtwmer_vendor_publishing_product = 1;
                        }
                        else
                        {
                            rtwmer_vendor_publishing_product = 0;
                        }
                        var rtwmer_admin_vendor_commssion = $(document).find('.rtwmer_admin_vendor_commssion').children( 'option:selected' ).val();
                        var rtwmer_vendor_admin_commision_value = $(document).find('.rtwmer_vendor_admin_commision_value').val();
                        if( $(document).find('.rtwmer_vendor_admin_featured_vendor').is(':checked') )
                        {
                            rtwmer_vendor_admin_featured_vendor = 1;
                        }
                        else
                        {
                            rtwmer_vendor_admin_featured_vendor = 0;
                        }
                    }
                    var rtwmer_vendors_data = {
                        'action' : 'rtwmer_edit_vendors_data',

                        'rtwmer_edit_vendors_data[rtwmer_vendor_check_before_update]' : rtwmer_vendor_check_before_update,
                        'rtwmer_edit_vendors_data[rtwmer_add_new_vend_fname]' : rtwmer_add_new_vend_fname,
                        'rtwmer_edit_vendors_data[rtwmer_add_new_vend_lname]' : rtwmer_add_new_vend_lname,
                        'rtwmer_edit_vendors_data[rtwmer_add_new_vend_email]' : rtwmer_add_new_vend_email,
                        'rtwmer_edit_vendors_data[rtwmer_add_new_vend_uname]' : rtwmer_add_new_vend_uname,
                        'rtwmer_edit_vendors_data[rtwmer_add_new_vend_passwrd]' : rtwmer_add_new_vend_passwrd,
                        'rtwmer_edit_vendors_data[rtwmer_addnew_vend_paypal_email]' : rtwmer_addnew_vend_paypal_email,
                        'rtwmer_edit_vendors_data[rtwmer_addnew_vend_stripe_id]' : rtwmer_addnew_vend_stripe_id,            'rtwmer_edit_vendors_data[rtwmer_vendor_data_id]' : rtwmer_vendor_data_id,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_img_id]' : rtwmer_vendor_img_id,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_store_name1]' : rtwmer_vendor_store_name1,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_store_url]' : rtwmer_vendor_store_url,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_store_phone]' : rtwmer_vendor_store_phone,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_facebook]' : rtwmer_vendor_facebook,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_google_plus]' : rtwmer_vendor_google_plus,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_twitter]' : rtwmer_vendor_twitter,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_pinterest]' : rtwmer_vendor_pinterest,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_linkedin]' : rtwmer_vendor_linkedin,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_youtube]' : rtwmer_vendor_youtube,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_instagram]' : rtwmer_vendor_instagram,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_flickr]' : rtwmer_vendor_flickr,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_store_address1]' : rtwmer_vendor_store_address1,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_store_address2]' : rtwmer_vendor_store_address2,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_town_city]' : rtwmer_vendor_town_city,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_zip_code]' : rtwmer_vendor_zip_code,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_selected_country]' : rtwmer_vendor_selected_country,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_selected_state]' : rtwmer_vendor_selected_state,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_bank_name]' : rtwmer_vendor_bank_name,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_bank_account_no]' : rtwmer_vendor_bank_account_no,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_bank_address]' : rtwmer_vendor_bank_address,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_routing_number]' : rtwmer_vendor_routing_number,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_bank_iban]' : rtwmer_vendor_bank_iban,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_bank_swift]' : rtwmer_vendor_bank_swift,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_enable_selling]' : rtwmer_vendor_enable_selling,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_publishing_product]' : rtwmer_vendor_publishing_product,
                        'rtwmer_edit_vendors_data[rtwmer_admin_vendor_commssion]' : rtwmer_admin_vendor_commssion,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_admin_commision_value]' : rtwmer_vendor_admin_commision_value,
                        'rtwmer_edit_vendors_data[rtwmer_vendor_admin_featured_vendor]' : rtwmer_vendor_admin_featured_vendor,

                        'rtwmer_vendors_data_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
                    }

//==================Response comes from ajax when admin update any vendors data======================//                  
//==================Response comes from ajax when admin update any vendors data======================//      
                   
                    
                    jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_vendors_data, function(response){
                       
                  
                  
                       
                        $(document).find('#rtwmer_vendors_table').DataTable().ajax.reload();
                        rtwmer_vendors_count_as_status();
                       

                      
                        if( response.status === false )
                        {   
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                response.message, {
                                    className : 'vendor_error',
                                    position : 'right bottom',
                                }
                            )
                        }
                        else if( response.status == true )
                        {
                            if( rtwmer_vendor_check_before_update == 'rtwmer_edit_vendor' )
                            {
                                $(document).find("#rtwmer_vendor_modal").removeClass("rtwmer-modal-open");
                                $("body").css("overflow","scroll");
                                var rtwmer_vendor_notify = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_vendor_updtaed;
                                
                            }
                            if( rtwmer_vendor_check_before_update == 'rtwmer_addnew_vendor' )
                            {
                                var rtwmer_vendor_notify = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_vendor_created;
                            }
                            
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_vendor_notify, {
                                className : 'vendor_success',
                                position : 'right bottom',
                                }
                            )
                            $(document).find("#rtwmer-add-new-vend-modal").removeClass("rtwmer-modal-open");
                            $("body").css("overflow-y","scroll");

                        }
                        else
                        {
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg, {
                                    className : 'vendor_error',
                                    position : 'right bottom',
                                }
                            )
                        }
                    },'json')
                }

            } )

//===============Function Come in action when admin click on vendor store name or edit button=====================//
//===============Function Come in action when admin click on vendor store name or edit button=====================//

            $(document).on( 'click','.rtwmer_vendor_edit_modal',function(e) {
                
                e.preventDefault();
                $("#rtwmer_vendor_modal").addClass("rtwmer-modal-open");
                $("body").css("overflow","hidden");
                $('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_store_details');
                $('.rtwmer_mercado_vendor_next').html('Next');
                $('#rtwmer_vendor_store_details').addClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_address').removeClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_payment_options').removeClass('rtwmer-store-btn-active');
                $('#rtwmer_vendor_store_details_section').show();
                $('#rtwmer_vendor_store_address_section').hide();
                $('#rtwmer_vendor_payment_option_section').hide();

                var rtwmer_vendor_data_id  = $(this).attr('data-id');

                var rtwmer_vendor_img_id = $( '#rtwmer_vendor_img' + rtwmer_vendor_data_id ).attr( 'data-img' );
                $('#rtwmer_vendor_enable_selling').addClass('rtwmer_vendor_enable_selling' + rtwmer_vendor_data_id);
                $(document).find('.rtwmer_mercado_vendor_next').attr('data-id',rtwmer_vendor_data_id);
                $( '.rtwmer_vendor_img_id' ).val(rtwmer_vendor_img_id);
                var rtwmer_vendors_data = {
                    'action' : 'rtwmer_vendors_data',
                    'rtwmer_vendor_data_id' : rtwmer_vendor_data_id,
                    'rtwmer_vendors_data_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
                }
                
// =====================Ajax Response of that and also validate that key exist in db or not==========================///                
// =====================Ajax Response of that and also validate that key exist in db or not==========================///                

                jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_vendors_data, function(response){
                
                    if( response != "" && response != null )
                    {
                        if( response.hasOwnProperty('rtwmer_vendor_store_img'))
                        {
                            $('.rtwmer_vendor_img_pre').attr( 'src',response['rtwmer_vendor_store_img' ]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_img_pre').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_store_name'))
                        {
                            $('.rtwmer_vendor_store_name1').val(response['rtwmer_store_name'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_store_name1').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_store_url'))
                        {
                            $('.rtwmer_vendor_store_url').val(response['rtwmer_store_url'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_store_url').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_phone'))
                        {
                            $('.rtwmer_vendor_store_phone').val(response['rtwmer_phone'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_store_phone').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_facebook'))
                        {
                            $('.rtwmer_vendor_facebook').val(response['rtwmer_vendor_facebook'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_facebook').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_google_plus'))
                        {
                            $('.rtwmer_vendor_google_plus').val(response['rtwmer_vendor_google_plus'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_google_plus').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_twitter'))
                        {
                            $('.rtwmer_vendor_twitter').val(response['rtwmer_vendor_twitter'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_twitter').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_pinterest'))
                        {
                            $('.rtwmer_vendor_pinterest').val(response['rtwmer_vendor_pinterest'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_pinterest').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_linkedin'))
                        {
                            $('.rtwmer_vendor_linkedin').val(response['rtwmer_vendor_linkedin'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_linkedin').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_youtube'))
                        {
                            $('.rtwmer_vendor_youtube').val(response['rtwmer_vendor_youtube'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_youtube').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_instagram'))
                        {
                            $('.rtwmer_vendor_instagram').val(response['rtwmer_vendor_instagram'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_instagram').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_flickr'))
                        {
                            $('.rtwmer_vendor_flickr').val(response['rtwmer_vendor_flickr'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_flickr').val("");
                        }    
                        if( response.hasOwnProperty('rtwmer_vendor_address1'))
                        {
                            $('.rtwmer_vendor_store_address1').val(response['rtwmer_vendor_address1'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_store_address1').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_address2'))
                        {
                            $('.rtwmer_vendor_store_address2').val(response['rtwmer_vendor_address2'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_store_address2').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_city'))
                        {
                            $('.rtwmer_vendor_town_city').val(response['rtwmer_vendor_city'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_town_city').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_zip'))
                        {
                            $('.rtwmer_vendor_zip_code').val(response['rtwmer_vendor_zip'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_zip_code').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_country'))
                        {   
                            if( response['rtwmer_vendor_country'][0] != "" )
                            {  
                                $(document).find('#rtwmer_vendor_store_country').val(response['rtwmer_vendor_country'][0]);
                                $(document).find('#rtwmer_vendor_store_country').select2();

                                if( response.hasOwnProperty('rtwmer_vendor_state'))
                                {   
                                    if( response['rtwmer_vendor_state'][0] != "" && response['rtwmer_vendor_state'][0] != null )
                                    {   
                                        $(document).find('.rtwmer_state_show').css('display','block');
                                        $(document).find('#rtwmer_vendor_select_count_ajax').html(response['rtwmer_vendor_all_state']);
                                        $(document).find('.rtwmer_vendor_state').val(response['rtwmer_vendor_state'][0]);
                                        $(document).find('.rtwmer_vendor_state').select2();
                                    }
                                    else
                                    {
                                        $(document).find('.rtwmer_state_show').css('display','none');                                        
                                    }
                                    if( response['rtwmer_vendor_state'][0] == "" || response['rtwmer_vendor_state'][0] == null )
                                    { 
                                        $(document).find('.rtwmer_state_show').css('display','none');
                                    }
                                }
                                else
                                {   
                                    $(document).find('.rtwmer_vendor_state_county').val("");
                                    $(document).find('.rtwmer_state_show').css('display','none');
                                }

                            }
                            if( response['rtwmer_vendor_country'][0] == "" || response['rtwmer_vendor_country'][0] == null )
                            { 
                                $(document).find('#rtwmer_vendor_store_country').val(response['rtwmer_vendor_country'][0]);
                                $(document).find('.rtwmer_state_show').css('display','none');
                            }
                        }
                        else
                        {   
                            $(document).find('#rtwmer_vendor_store_country').val("");
                            $(document).find('.rtwmer_state_show').css('display','none');
                            
                        }

                        if( response.hasOwnProperty('rtwmer_vendor_bank_name'))
                        {
                            $('.rtwmer_vendor_bank_name').val(response['rtwmer_vendor_bank_name'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_bank_name').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_bank_account_no'))
                        {
                            $('.rtwmer_vendor_bank_account_no').val(response['rtwmer_vendor_bank_account_no'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_bank_account_no').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_bank_address'))
                        {
                            $('.rtwmer_vendor_bank_address').val(response['rtwmer_vendor_bank_address'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_bank_address').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_routing_number'))
                        {
                            $('.rtwmer_vendor_routing_number').val(response['rtwmer_vendor_routing_number'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_routing_number').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_bank_iban'))
                        {
                            $('.rtwmer_vendor_bank_iban').val(response['rtwmer_vendor_bank_iban'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_bank_iban').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_stripe_id'))
                        {
                            $('.rtwmer_vendor_stripe_id').val(response['rtwmer_vendor_stripe_id'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_stripe_id').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_bank_swift'))
                        {
                            $('.rtwmer_vendor_bank_swift').val(response['rtwmer_vendor_bank_swift'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_bank_swift').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_status'))
                        {
                            if(response['rtwmer_vendor_status'][0] == 1)
                            {
                                $(document).find('.rtwmer_vendor_enable_selling'+rtwmer_vendor_data_id).prop('checked',true);
                            }
                            if(response['rtwmer_vendor_status'][0] == 0)
                            {
                                $('.rtwmer_vendor_enable_selling'+rtwmer_vendor_data_id).prop('checked',false);
                            }
                        }
                        else
                        {
                            ('.rtwmer_vendor_enable_selling'+rtwmer_vendor_data_id).prop('checked',false);
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_publishing_product'))
                        {
                            if(response['rtwmer_vendor_publishing_product'][0] == 1)
                            {
                                $('.rtwmer_vendor_publishing_product').prop('checked',true);
                            }
                        }
                        else
                        {
                            $('.rtwmer_vendor_publishing_product').prop('checked',false);
                        }
                        if( response.hasOwnProperty('rtwmer_admin_vendor_commssion'))
                        {
                            $('.rtwmer_admin_vendor_commssion').val(response['rtwmer_admin_vendor_commssion'][0]);
                        }
                        else
                        {
                            $('.rtwmer_admin_vendor_commssion').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_admin_commision_value'))
                        {
                            $('.rtwmer_vendor_admin_commision_value').val(response['rtwmer_vendor_admin_commision_value'][0]);
                        }
                        else
                        {
                            $('.rtwmer_vendor_admin_commision_value').val("");
                        }
                        if( response.hasOwnProperty('rtwmer_vendor_admin_featured_vendor'))
                        {
                            if(response['rtwmer_vendor_admin_featured_vendor'][0] == 1)
                            {
                                $('.rtwmer_vendor_admin_featured_vendor').prop('checked',true);
                            }
                        }
                        else
                        {
                            $('.rtwmer_vendor_admin_featured_vendor').prop('checked',false);
                        }
                        $(document).find('.rtwmer_edit_vendor_details_data').each(function(a,b){
                            if( $(this).val() != '' )
                            {
                                $(this).siblings().addClass('mdc-notched-outline--notched');
                                $(this).siblings().children(".mdc-notched-outline__notch").children(".mdc-floating-label").addClass('mdc-floating-label--float-above');
                            }
                            else
                            {
                                $(this).siblings().removeClass('mdc-notched-outline--notched');
                                $(this).siblings().children(".mdc-notched-outline__notch").children(".mdc-floating-label").removeClass('mdc-floating-label--float-above');
                            }   
                        })
                    }

                },'json')

            } )

//==================Ajax request goes when admin select an country, state displayed accordingly==============//

            $(document).on( 'change','#rtwmer_vendor_store_country',function() {
                var rtwmer_vendor_selected_country = $(this).children('option:selected').val();

                var rtwmer_vendor_selected_country_val = {
                    'action' : 'rtwmer_vendor_selected_country',
                    'rtwmer_vendor_selected_country' : rtwmer_vendor_selected_country,
                    'rtwmer_vendor_sel_count_nonce'  : rtwmer_vendor_object.rtwmer_vendor_nonce
                }

                jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_vendor_selected_country_val, function(response){  
                    if( response != "" )
                    {
                        $('.rtwmer_state_show').css('display','block');
                        $('#rtwmer_vendor_select_count_ajax').html(response);
                        $(document).find('.rtwmer_vendor_state').select2();
                    }
                    if( response == "" )
                    {
                        $('.rtwmer_state_show').css('display','none');
                    }
                },'json')

            } )//===========Codes came into action when tables sorted acoording to vendor status==================//

        $(document).on( 'click','.rtwmer_vendor_status',function(e) {
                    
            e.preventDefault();
            var rtwmer_sort_by_vend_status = $(this).attr('data-value');
            $(document).find('#rtwmer_sort_by_vend_status_save').val(rtwmer_sort_by_vend_status);
            $(document).find('.rtwmer_vendor_status').removeClass('rtwmer_sort_by_status_active');
            $(this).addClass('rtwmer_sort_by_status_active');
            $(document).find("#rtwmer_vendors_table").dataTable().fnDestroy();
            rtwmer_vendor_datatable(rtwmer_sort_by_vend_status);
            rtwmer_vendors_count_as_status();

        } )

        $(document).find(".rtwmer-modal-close").click(function(){
            $(this).closest(".rtwmer-modal").removeClass("rtwmer-modal-open");
            $("body").css("overflow-y","scroll");
        });

    })

//===================Code goes when came back from product page to vendors page=-========================///

    $(document).on( 'click','.rtwmer_vendors_chng_product_again',function( e ) {

        $(document).find('.rtwmer_vendor_status').removeClass('rtwmer_sort_by_status_active');
        $(document).find('#rtwmer_vendor_sort_all_vend').addClass('rtwmer_sort_by_status_active');
        var rtwmer_sort_by_vend_status = 'all_vend';
        $(document).find("#rtwmer_vendors_table").dataTable().fnDestroy();
        rtwmer_vendor_datatable(rtwmer_sort_by_vend_status);
        rtwmer_vendors_count_as_status();
    })//================= Code Goes when add New vendor modal goes active============================//

    $(document).on( 'blur','.rtwmer_addnew_vend_label input',function() {

        $(this).each(function(){
            if($(this).val() != "")
            {
                $(this).next().css({'left' : '0', 'font-size': '12px', 'color': '#3399FF', 'transition': '0.3s'});
            }
            else
            {
                $(this).next().css({'position': 'absolute', 'left': '14px', 'width': '100%', 'top': '10px', 'color': '#aaa', 'transition': '0.3s', 'cursor': 'text', 'letter-spacing': '0.5px','font-size': '14px'});
            }
        })
    } )

    $(document).on( 'focus','.rtwmer_addnew_vend_label input',function() {

        $(this).each(function(){
            $(this).next().css({'left' : '0', 'font-size': '12px', 'color': '#3399FF', 'transition': '0.3s'});
        })
    } )

    $(document).on('click','#rtwmer_add_new_vend',function() {
        $(document).find("#rtwmer-add-new-vend-modal").addClass("rtwmer-modal-open");
        $(document).find("body").css("overflow","hidden");
        $(document).find('.rtwmer-vendor-input input').each(function(){
            $(this).val("");
        })
        $(document).find('#rtwmer_addnew_vend_country').val("");
        $(document).find('#rtwmer_addnew_vend_state_show').hide();
        $(document).find('.rtwmer_vendor_img_pre').attr('src',"");

        $(document).find('.rtwmer_vendoradd_store_detail_section').show();
        $(document).find('.rtwmer_vendoradd_store_addres_section').hide();
        $(document).find('.rtwmer_vendoradd_store_paymnt_section').hide();
        $(document).find('#rtwmer-vend-add-new-img').show();
        $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('colors');
        $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('active');
        $(document).find('#rtwmer-add-new-vend-store-details').addClass('active');
        $(document).find('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_store_details');
        $(document).find('.rtwmer_mercado_vendor_next').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);
        $(document).find('#rtwmer_addnew_vend_country').select2();

        var rtwmer_add_new_vend_generate_pass_data = {
            'action' : 'rtwmer_add_new_vend_generate_pass_action',
            'rtwmer_add_new_vend_generate_pass_nonce' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_add_new_vend_generate_pass_data,function(response) {

            if(response != "")
            {
                $(document).find('#rtwmer_add_new_vend_passwrd').val(response);
            }

        },'json')
    })

    $(document).on('click','.rtwmer_pass_generator',function(){
        

        $(document).find('.rtwmer_add_new_vend_passwrd_show').show();
        $(this).text(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_regenerate);
        $(document).find('.rtwmer_pass_generator_cancel').removeClass('rtwmer_pass_generator_cancel');
        
        
        if($(document).find( '#rtwmer_add_new_vend_passwrd' ).val() != "")
        {
            $(document).find('#rtwmer_add_new_vend_passwrd').next().css({'top':'-18px','left' : '0', 'font-size': '12px', 'color': '#3399FF', 'transition': '0.3s'});
        }
        else
        {
            $(document).find('#rtwmer_add_new_vend_passwrd').next().css({'position': 'absolute', 'left': '14px', 'width': '100%', 'top': '10px', 'color': '#aaa', 'transition': '0.3s', 'cursor': 'text', 'letter-spacing': '0.5px','font-size': '14px'});
        }

        var rtwmer_add_new_vend_generate_pass_data = {
            'action' : 'rtwmer_add_new_vend_generate_pass_action',
            'rtwmer_add_new_vend_generate_pass_nonce' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_add_new_vend_generate_pass_data,function(response) {

            if(response != "")
            {
                $(document).find('#rtwmer_add_new_vend_passwrd').val(response);
            }

        },'json')
    })

    $(document).on('change','#rtwmer_addnew_vend_country',function(){

        var rtwmer_addnew_vend_selected_country = $(this).children('option:selected').val();
        var rtwmer_addnew_vend_country_data = {
            'action' : 'rtwmer_addnew_vend_country_action',
            'rtwmer_addnew_vend_selected_country' : rtwmer_addnew_vend_selected_country,
            'rtwmer_addnew_vend_selected_country_nonce' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_addnew_vend_country_data,function(response) {
            
            if(response != "")
            {
                $(document).find('#rtwmer_addnew_vend_state_show').show();
                $(document).find('#rtwmer_addnew_vendors_state').html(response);
                $(document).find('.rtwmer_vendor_state').select2();
            }
            else
            {
                $(document).find('#rtwmer_addnew_vend_state_show').hide();
            }

        },'json')
    })

    $(document).on('click','#rtwmer_pass_generator_cancel_click',function(){

        $(document).find('.rtwmer_add_new_vend_passwrd_show').hide();
        $(document).find('.rtwmer_pass_generator').text(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_generate_password);
        $(this).addClass('rtwmer_pass_generator_cancel');
    })

    
    $(document).on('click','#rtwmer-add-new-vend-store-address',function() {
        
        $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('colors');
        $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('active');
        $(document).find('.rtwmer_vendoradd_store_detail_section').hide();
        $(document).find('.rtwmer_vendoradd_store_addres_section').show();
        $(document).find('.rtwmer_vendoradd_store_paymnt_section').hide();
        $(document).find('#rtwmer-vend-add-new-img').hide();
        $(this).addClass('active');
        $(this).prev().addClass('colors');
        $(document).find('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_store_address');
        $(document).find('.rtwmer_mercado_vendor_next').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);

    })
    
    $(document).on('click','#rtwmer-add-new-vend-store-pymnt',function() {

        $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('colors');
        $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('active');
        $(document).find('.rtwmer_vendoradd_store_detail_section').hide();
        $(document).find('.rtwmer_vendoradd_store_addres_section').hide();
        $(document).find('.rtwmer_vendoradd_store_paymnt_section').show();
        $(document).find('#rtwmer-vend-add-new-img').hide();
        $(this).addClass('active');
        $(this).prevAll().addClass('colors');
        $(document).find('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_payment_options');
        $(document).find('.rtwmer_mercado_vendor_next').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_update);

    })

    $(document).on( 'click','#rtwmer-add-new-vend-store-details',function() {

        $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('colors');
        $(document).find('.rtwmer-add-new-vend-nav-items').removeClass('active');
        $(document).find('.rtwmer_vendoradd_store_detail_section').show();
        $(document).find('.rtwmer_vendoradd_store_addres_section').hide();
        $(document).find('.rtwmer_vendoradd_store_paymnt_section').hide();
        $(document).find('#rtwmer-vend-add-new-img').show();
        $(this).addClass('active');
        $(document).find('.rtwmer_mercado_vendor_next').attr('data-value','rtwmer_vendor_store_details');
        $(document).find('.rtwmer_mercado_vendor_next').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);

    } )//============== Code Goes when Vendors Product shown at admin panel accordingly selected vendor================//.    
    function rtwmer_vendor_datatable(rtwmer_sort_by_vend_status)
    {
        var rtwmer_datatable = $('#rtwmer_vendors_table').DataTable( {
        "processing" : true,
        "serverSide" : true,
        "bsortable"  : true,
        "info"       : false,
        select       : true,
        "ajax"       : {
            data: {
                action: 'rtwmer_vendors_table_action',
                'rtwmer_sort_by_vend_status' : rtwmer_sort_by_vend_status,
                'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
                },
            type      : 'POST',
            dataType  : 'json',
            url       : rtwmer_vendor_object.rtwmer_ajax_url,
            
            },
            columnDefs : [
                {
                    "targets": [0],
                    "orderable": false,
                    "searchable": false
                }
            ],
            order : [[1, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_search,
                'processing':  "<div class='rtwmer-loader-box'><div class='rtwmer-reload-table-loader-img-div'><img class='rtwmer-loader-image-datatable' src='"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_loader_src+"' /></div></div>"
            },
            "pagingType": "full_numbers",
            "drawCallback": function () {
                $('.mdl-cell--6-col').parent().addClass('rtwmer-grid');
                $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                $('.dataTables_length select').addClass('rtwmer-select-box  mdc-ripple-upgraded');
                $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
            },
        });
    }

//================this function is about to get count from vendors table and displays at vendors product page======/// 

    function rtwmer_vendors_count_as_status()
    {   
        var rtwmer_vendors_count_data = {
            'action' : 'rtwmer_vendors_count_action',
            'rtwmer_vendors_count_nonce' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_vendors_count_data,function(response) {
            // console.log(response);
            // return;
            if( response != "" )
            {
                $(document).find('#rtwmer_vendor_sort_all_vend').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_all+'('+response['rtwmer_all_vendors']+')');
                $(document).find('#rtwmer_vendor_sort_approve').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_approved+'('+response['rtwmer_approved_vendors']+')');
                $(document).find('#rtwmer_vendor_sort_disable').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_disabled+'('+response['rtwmer_disabled_vendors']+')');
            }
        },'json')

    }
})( jQuery );;

///===================Code for image uploading================//
///===================Code for image uploading================//

jQuery( document ).ready( function( $ ) {

    var file_frame,wp_media_post_id;
    var set_to_post_id = ""; 

    jQuery('.rtwmer_vendor_store_img').on('click', function( event ){

        event.preventDefault();

        if ( file_frame ) {
            file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
            file_frame.open();
            return;

        } else {
            wp.media.model.settings.post.id = set_to_post_id;
        }

        file_frame = wp.media.frames.file_frame = wp.media({

            title: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_media_select_img_val,
            button: {
                text: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_media_select_btn_img_text,
            },
            multiple: false	

        });

        file_frame.on( 'select', function() {

            attachment = file_frame.state().get('selection').first().toJSON();
            $('.rtwmer_vendor_img_pre' ).attr( 'src', attachment.url );
            $('.rtwmer_vendor_img_id' ).val( attachment.id );
            wp.media.model.settings.post.id = wp_media_post_id;

        });
        
        file_frame.open();
    });

    jQuery( 'a.add_media' ).on( 'click', function() {

        wp.media.model.settings.post.id = wp_media_post_id;

    });
});