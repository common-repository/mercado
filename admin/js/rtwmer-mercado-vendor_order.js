//This file is used to display Order section of vendors to admin jquery and javascript

(function( $ ) {

    'use strict';
    var rtwmer_url, rtwmer_split_url, rtwmer_vendors_order_href, rtwmer_order_or_order_all;
    if(window.location.href != ""){

    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");

    }
        $(document).ready(function( $ ){  

            if(rtwmer_split_url[1] == 'orders' || rtwmer_split_url[1] == '/orders_all'){

                // id's of each menu to intially hide them
                $(document).find('#wpbody-content').show();

                $(document).find('#rtw-mercado-withdraw').css('display','none');
                $(document).find('#rtw-mercado-vendor').css('display','block');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('#rtw-mercado-settings').css('display','none');
                $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $('#rtw-mercado-report').css('display','none');
                if(rtwmer_split_url[1] == '/orders_all')
                {
                    $(document).find('#rtwmer-admin-all-orders').addClass('nav-tab-active');
                    $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                }
                else
                {
                    $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                    $(document).find('#rtwmer-admin-vendor').addClass('nav-tab-active');
                }
            
                $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
                $(document).find('#rtwmer-loader-image').fadeOut();

                $(document).find('.rtwmer_mercado_vendor_orders').show();
                $(document).find('.rtwmer_vendors_details').hide();
                
                var rtwmer_order_vendor_id = $(document).find('#rtwmer_order_vendor_id').val();
                var rtwmer_sort_order_by = $(document).find('#rtwmer_sort_order_by').val();
                if( rtwmer_sort_order_by == 'trash' )
                {
                    var rtwmer_sort_active = 'trash';
                }
                if( rtwmer_sort_order_by == 'draft' )
                {
                    var rtwmer_sort_active = 'draft';
                }
                else if( rtwmer_sort_order_by != 'all' )
                {
                    var rtwmer_sort_active = rtwmer_sort_order_by.replace('wc-','');
                }
                else
                {
                    rtwmer_sort_active = 'all';
                }

                $(document).find('.rtwmer_sort_by_order_status').removeClass('rtwmer_sort_by_status_active');
                $(document).find('#rtwmer_sort_order_'+rtwmer_sort_active).addClass('rtwmer_sort_by_status_active');
                $(document).find('#rtwmer_order_table').dataTable().fnDestroy();
                if(rtwmer_split_url[1] == '/orders_all')
                {
                    var rtwmer_order_or_order_all = 'isexist';
                    rtwmer_order_datatable('',rtwmer_sort_order_by,rtwmer_order_or_order_all);
                    rtwmer_orders_count();
                }
                else
                {
                    var rtwmer_order_or_order_all = 'isnotexist';
                    rtwmer_order_datatable(rtwmer_order_vendor_id,rtwmer_sort_order_by,rtwmer_order_or_order_all);
                    rtwmer_orders_count(rtwmer_order_vendor_id);
                }
            }          //=================code goes when click on order btn to view order table=================================//

            $(document).on( 'click','.rtwmer_vendors_orders',function(){

                $(document).find('#wpbody-content').show();

                rtwmer_vendors_order_href = $('.rtwmer_vendors_chng_product').attr('href');
                $(document).find('.rtwmer_vendors_chng_product').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_vl);
                $(document).find('.rtwmer_vendors_chng_product').attr('href','#/vendor');
                $(document).find('.rtwmer_vendors_chng_product').addClass('rtwmer_vendors_chng_order_again');
                $(document).find('#rtwmer-loader-image').fadeOut();
                $(document).find('.rtwmer_mercado_vendor_orders').show();
                $(document).find('.rtwmer_vendors_details').hide();
                $(document).find('.rtwmer_sort_by_order_status').removeClass('rtwmer_sort_by_status_active');
                $(document).find('#rtwmer_sort_order_all').addClass('rtwmer_sort_by_status_active');
                var rtwmer_order_vendor_id = $(this).siblings('.rtwmer_vendor_products').data('id');
                $(document).find('#rtwmer_order_vendor_id').val(rtwmer_order_vendor_id);
                var rtwmer_sort_order_by = 'all';
                $(document).find('#rtwmer_order_or_order_all').val('isnotexist');
                var rtwmer_order_or_order_all = 'isnotexist';
                $(document).find('#rtwmer_order_table').dataTable().fnDestroy();
                rtwmer_order_datatable(rtwmer_order_vendor_id,rtwmer_sort_order_by,rtwmer_order_or_order_all);
                rtwmer_orders_count(rtwmer_order_vendor_id);
            }) 

//===============code goes when click on to go back wordpress button clicks========================//

            $(document).on( 'click','.rtwmer_vendors_chng_order_again',function( e ) {
            
                e.preventDefault();
                window.location.href = rtwmer_split_url[0]+'#/vendor';
                $('#rtwmer-loader-image').fadeIn(100);
                $('#rtwmer-loader-image').fadeOut();
                $('.rtwmer_vendors_details').show();
                $(document).find('.rtwmer_mercado_vendor_orders').hide();
                $('.rtwmer_vendors_chng_order_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
                $('.rtwmer_vendors_chng_order_again').attr('href',rtwmer_vendors_order_href);
                $('.rtwmer_vendors_chng_order_again').removeClass('rtwmer_vendors_chng_order_again');
                
            })

// Code to remove extra class and send back to wordpress heading //

    $('#rtwmer-admin-dashboard').on('click', function(){
        $('.rtwmer_vendors_chng_order_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $('.rtwmer_vendors_chng_order_again').attr('href',rtwmer_vendors_order_href);
        $('.rtwmer_vendors_chng_order_again').removeClass('rtwmer_vendors_chng_order_again');
    })

    $('#rtwmer-admin-withdraw').on('click', function(){
        $('.rtwmer_vendors_chng_order_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $('.rtwmer_vendors_chng_order_again').attr('href',rtwmer_vendors_order_href);
        $('.rtwmer_vendors_chng_order_again').removeClass('rtwmer_vendors_chng_order_again');
    })

    $('#rtwmer-admin-vendor').on('click', function(){
        $('.rtwmer_vendors_chng_order_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $('.rtwmer_vendors_chng_order_again').attr('href',rtwmer_vendors_order_href);
        $('.rtwmer_vendors_chng_order_again').removeClass('rtwmer_vendors_chng_order_again');
    })

    $('#rtwmer-admin-settings').on('click', function(){
       
        $('.rtwmer_vendors_chng_order_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $('.rtwmer_vendors_chng_order_again').attr('href',rtwmer_vendors_order_href);
        $('.rtwmer_vendors_chng_order_again').removeClass('rtwmer_vendors_chng_order_again');
    })

    $('#rtwmer-admin-all-orders').on('click', function(){
        $('.rtwmer_vendors_chng_order_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $('.rtwmer_vendors_chng_order_again').attr('href',rtwmer_vendors_order_href);
        $('.rtwmer_vendors_chng_order_again').removeClass('rtwmer_vendors_chng_order_again');
    })

    $('#rtwmer-admin-reports').on('click', function(){
        $('.rtwmer_vendors_chng_order_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $('.rtwmer_vendors_chng_order_again').attr('href',rtwmer_vendors_order_href);
        $('.rtwmer_vendors_chng_order_again').removeClass('rtwmer_vendors_chng_order_again');
    })

//=======================code goes when order sorted according status=================================//

            $(document).on( 'click','.rtwmer_sort_by_order_status',function(e) {
               
                e.preventDefault();
                $(document).find('#rtwmer-loader-image').fadeOut();
                var rtwmer_order_vendor_id = $(document).find('#rtwmer_order_vendor_id').val();
                var rtwmer_sort_order_by = $(this).data('value');
                // console.log(rtwmer_order_vendor_id);
                // console.log(rtwmer_sort_order_by);
                
                $(document).find('#rtwmer_sort_order_by').val(rtwmer_sort_order_by);
                if( rtwmer_sort_order_by != 'all' && rtwmer_sort_order_by != 'trash' && rtwmer_sort_order_by != 'draft' )
                {
                    
                    rtwmer_sort_order_by = 'wc-'+rtwmer_sort_order_by;
                    $(document).find('#rtwmer_order_table').dataTable().fnDestroy();
                }
                else if( rtwmer_sort_order_by == 'trash' )
                {

                    rtwmer_sort_order_by = 'trash';
                    $(document).find('#rtwmer_order_table').dataTable().fnDestroy();
                }
                else if( rtwmer_sort_order_by == 'draft' )
                {

                    rtwmer_sort_order_by = 'draft';
                    $(document).find('#rtwmer_order_table').dataTable().fnDestroy();
                }
                else
                {
                    console.log('allz');
                    rtwmer_sort_order_by = 'all';
                    $(document).find('#rtwmer_order_table').dataTable().fnDestroy();   
                }
                if( $(document).find('#rtwmer_order_or_order_all').val() == 'isexist' )
                {
                    
                    rtwmer_order_datatable('',rtwmer_sort_order_by,'isexist');
                }
                else
                {
                    rtwmer_order_datatable(rtwmer_order_vendor_id,rtwmer_sort_order_by,'isnotexist');
                }
                $(document).find('.rtwmer_sort_by_order_status').removeClass('rtwmer_sort_by_status_active');
                $(document).find(this).addClass('rtwmer_sort_by_status_active');
            } )

//=======================code goes when click to view order by clicking on name=================================//

            $(document).on( 'click','.rtwmer_order_name',function(e) {

                e.preventDefault();
                $(document).find('#rtwmer_order_edit_modal').addClass('rtwmer-modal-open');
                $(document).find('body').css('overflow','hidden');
                $(document).find("#rtwmer_order_edit_modal").removeClass("rtwmer-animation-left");
                $(document).find('.loader').css('display','block');
                var rtwmer_edit_order_id = $(this).data('id');
                $(document).find('#rtwmer_order_edit_modal .rtwmer-modal-title').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_edit_order);
                $('.rtwmer_vendors_chng_order_again').attr('href',rtwmer_vendors_order_href);
                rtwmer_edit_order_iframe(rtwmer_edit_order_id);

                $(document).on( 'click','.rtwmer_edit_order_iframe_close',function(){

                    $(document).find('#rtwmer_order_table').dataTable().fnDestroy();

                    if( $(document).find('#rtwmer_order_or_order_all').val() == 'isexist' )
                    {
                        rtwmer_order_datatable('',$(document).find('#rtwmer_sort_order_by').val(),'isexist');
                        rtwmer_orders_count();
                    }
                    else
                    {
                        rtwmer_order_datatable($(document).find('#rtwmer_order_vendor_id').val(),$(document).find('#rtwmer_sort_order_by').val(),'isnotexist');
                        rtwmer_orders_count($(document).find('#rtwmer_order_vendor_id').val());
                    }
                } )

            } )

//=======================code goes when click to view order by clicking on eye=================================//

            $(document).on( 'click','.rtwmer_order_view_icon',function(e) {

                e.preventDefault();
                $(document).find('#rtwmer_order_detail_modal').addClass('rtwmer-modal-open');
                $(document).find('body').css('overflow','hidden');
                $(document).find("#rtwmer_order_detail_modal").removeClass("rtwmer-animation-left");
                var rtwmer_view_order_id = $(this).siblings('.rtwmer_order_name').data('id');
                $(document).find('#rtwmer_current_order_id').val(rtwmer_view_order_id);

                var rtwmer_view_order_data = {
                    'action' : 'rtwmer_view_order_action_1',
                    'rtwmer_view_order_id' : rtwmer_view_order_id,
                    'rtwmer_view_order_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
                }
                jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_view_order_data,function(response) {

                    if( response != "" )
                    {
                        $(document).find('.rtwmer_order_id').html('Order'+' #'+response['rtwmer_order_id']);
                        $(document).find('.rtwmer_order_status').html(response['rtwmer_order_status']);
                        $(document).find('.rtwmer_order_status').addClass('rtmwer_order_'+response['rtwmer_order_status']);
                        $(document).find('.rtwmer_billing_first_name').html(response['rtwmer_billing_first_name']);
                        $(document).find('.rtwmer_billing_last_name').html(response['rtwmer_billing_last_name']);
                        $(document).find('.rtwmer_billing_company').html(response['rtwmer_billing_company']);
                        $(document).find('.rtwmer_billing_address1').html(response['rtwmer_billing_address1']);
                        $(document).find('.rtwmer_billing_address2').html(response['rtwmer_billing_address2']);
                        $(document).find('.rtwmer_billing_city').html(response['rtwmer_billing_city']);
                        $(document).find('.rtwmer_billing_state').html(response['rtwmer_billing_state']);
                        $(document).find('.rtwmer_billing_postcode').html(response['rtwmer_billing_postcode']);
                        $(document).find('.rtwmer_billing_country').html(response['rtwmer_billing_country']);
                        $(document).find('.rtwmer_shipping_first_name').html(response['rtwmer_shipping_first_name']);
                        $(document).find('.rtwmer_shipping_last_name').html(response['rtwmer_shipping_last_name']);
                        $(document).find('.rtwmer_shipping_company').html(response['rtwmer_shipping_company']);
                        $(document).find('.rtwmer_shipping_address1').html(response['rtwmer_shipping_address1']);
                        $(document).find('.rtwmer_shipping_address2').html(response['rtwmer_shipping_address2']);
                        $(document).find('.rtwmer_shipping_city').html(response['rtwmer_shipping_city']);
                        $(document).find('.rtwmer_shipping_state').html(response['rtwmer_shipping_state']);
                        $(document).find('.rtwmer_shipping_postcode').html(response['rtwmer_shipping_postcode']);
                        $(document).find('.rtwmer_shipping_country').html(response['rtwmer_shipping_country']);
                        $(document).find('.rtwmer_billing_email').html(response['rtwmer_billing_email']);
                        $(document).find('.rtwmer_billing_email').attr('href','mailto:'+response['rtwmer_billing_email']);
                        $(document).find('.rtwmer_billing_phone').html(response['rtwmer_billing_phone']);
                        $(document).find('.rtwmer_shipping_method').html(response['rtwmer_shipping_method']);
                        $(document).find('.rtwmer_payment_method_title').html(response['rtwmer_payment_method_title']);
                        $(document).find('.rtwmer_customer_note').html(response['rtwmer_customer_note']);
                    }
                },'json')

                var rtwmer_view_order_data = {
                    'action' : 'rtwmer_view_order_action_2',
                    'rtwmer_view_order_id' : rtwmer_view_order_id,
                    'rtwmer_view_order_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
                }
                jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_view_order_data,function(response) {
                    
                    if( response == "" || response == null)
                    {
                        $(document).find('#rtwmer_order_prod_table').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_no_products_found);
                    }
                    else
                    {
                        var i, rtwmer_table = "<table class='table table-striped mdl-data-table rtwmer_order_showing_list_table'>";
                        rtwmer_table += "<thead><tr><th scope='col'>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_products+"</th>";
                        rtwmer_table += "<th scope='col'>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_quantity+"</th>";
                        rtwmer_table += "<th scope='col'>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_total+"</th>";
                        rtwmer_table += "</tr></thead>";

                        for( i=0; i < response.length; i++ )
                        {
                            rtwmer_table += '<tr><td scope="col">' + response[i]['rtwmer_get_product_name'] + '</td>';
                            rtwmer_table += '<td scope="col">' + response[i]['rtwmer_get_product_quantity'] + '</td>'
                            rtwmer_table += '<td scope="col">' + response[i]['rtwmer_get_product_total'] + '</td>'
                        }
                        rtwmer_table += '</tr>';
                        rtwmer_table += "</table>";
                        $(document).find('#rtwmer_order_prod_table').html(rtwmer_table);
                    }

                },'json')

            } )

//=======================code goes when click to cancel btn while viewing an order=================================//

                $(document).on('click','.rtwmer_close_view_order_btn',function() {

                    $(document).find('.rtwmer_order_status').removeClass('rtmwer_order_cancelled');
                    $(document).find('.rtwmer_order_status').removeClass('rtmwer_order_completed');
                    $(document).find('.rtwmer_order_status').removeClass('rtmwer_order_on-hold');
                    $(document).find('.rtwmer_order_status').removeClass('rtmwer_order_processing');
                    $(document).find('.rtwmer_order_status').removeClass('rtmwer_order_failed');
                    $(document).find('.rtwmer_order_status').removeClass('rtmwer_order_refunded');
                    $(document).find('.rtwmer_order_status').removeClass('rtmwer_order_pending');
                    $(document).find('.rtwmer_order_status').removeClass('rtmwer_order_trash');
            })

            $(document).on('click','.rtwmer_edit_order_modal',function() {

                $(document).find('#rtwmer_order_edit_modal').addClass('rtwmer-modal-open');
                $(document).find('body').css('overflow','hidden');
                $(document).find("#rtwmer_order_edit_modal").removeClass("rtwmer-animation-left");
                $(document).find('#rtwmer_order_edit_modal .rtwmer-modal-title').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_edit_order);
                rtwmer_edit_order_iframe($(document).find('#rtwmer_current_order_id').val());
            })

            $(document).on('click','#rtwmer_add_new_order',function(e){

                e.preventDefault();
                $(document).find('#rtwmer_order_edit_modal').addClass('rtwmer-modal-open');
                $(document).find('body').css('overflow','hidden');
                $(document).find("#rtwmer_order_edit_modal").removeClass("rtwmer-animation-left");
                $(document).find('#rtwmer_order_edit_modal .rtwmer-modal-title').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_add_order);
                rtwmer_edit_order_iframe();
            })
            
//==============When Admin process amount request for vendor or for send to trash or delete orders============//

            $(document).on( 'click','.rtwmer_change_order_status',function() {
                
                var rtwmer_process_order_request_id = $(this).data('id');
                var rtwmer_process_order_request_value = $(this).data('value');
               
                
                if( rtwmer_process_order_request_value == 'delete' )
                {
                   
                    var rtwmer_order_for_delete = rtwmer_process_order_request_value;
                    var rtwmer_confirm_delete = confirm(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_confirmation_order_del);
                    // console.log(rtwmer_order_for_delete);
                    // console.log(rtwmer_confirm_delete);
                    // return false;
                    if( rtwmer_confirm_delete )
                    {
                        rtwmer_process_order_request_value = rtwmer_order_for_delete;
                    }
                    else
                    {
                        return;
                    }
                }
                
                $(document).find('#rtwmer-loader-image').show();
               
                var rtwmer_process_order_request_data = {
                    'action' : 'rtwmer_process_order_request_action',
                    'rtwmer_process_order_request_id' : rtwmer_process_order_request_id,
                    'rtwmer_process_order_request_value' : rtwmer_process_order_request_value,
                    'rtwmer_process_orders_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
                }
               
                jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_process_order_request_data,function(response) {
                    
                    // response = response.meta_value;
                    // console.log(response);
               
                    $(document).find('#rtwmer-loader-image').hide();
                    if( rtwmer_process_order_request_value == 'send_payment' )
                    {
                        if(response != "" && response != 1  && response != 2)
                        {
                       
                        // console.log(response);
                        // return false;
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                response, {
                                className : 'vendor_error',
                                position : 'right bottom',
                                }
                            )
                        }
                        else if(response == 1)
                        {
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_amnt_transfer_msg, {
                                    className : 'vendor_success',
                                    position : 'right bottom',
                                }
                            ) 
                        }
                        else if(response == 2)
                        {
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_already_approved_msg, {
                                    className : 'vendor_success',
                                    position : 'right bottom',
                                }
                            ) 
                        }
                    }

                    else if( rtwmer_process_order_request_value != 'send_payment' )
                    {
                        
                        $(document).find('#rtwmer_order_table').DataTable().ajax.reload();
                        if( $(document).find('#rtwmer_order_or_order_all').val() == 'isexist' )
                        {
                        
                            rtwmer_orders_count();
                        }
                        else
                        {
                            rtwmer_orders_count(response);
                        }
                        $('.notifyjs-wrapper').remove();
                        if( rtwmer_process_order_request_value == 'restore' )
                        {
                            var rtwmer_order_display_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_order_restored;
                        }
                        if( rtwmer_process_order_request_value == 'delete' )
                        {
                            var rtwmer_order_display_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_order_deleted;
                        }
                        if( rtwmer_process_order_request_value == 'trash' )
                        {
                            //  console.log('jsdffkj');
                            var rtwmer_order_display_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_order_trashed;
                        }   
                        $.notify(
                            rtwmer_order_display_msg, {
                            className : 'vendor_success',
                            position : 'right bottom',
                            }
                        )
                    }
                    
                },'json')

            } )

//===============When click on outer checkbox to select all inner chckboxes=================//

    $(document).on( 'change','.rtwmer_orders_outer_checkbox',function() {

        $(document).find( '.rtwmer_orders_inner_checkbox' ).prop('checked',$(this).prop('checked'));
        $(document).find( '.rtwmer_orders_outer_checkbox' ).prop('checked',$(this).prop('checked'));

    } )

    $(document).on( 'change','.rtwmer_orders_inner_checkbox',function() {

        if( $(document).find('.rtwmer_orders_inner_checkbox:checked').length == $(document).find('.rtwmer_orders_inner_checkbox').length)
        {
            $(document).find(' .rtwmer_orders_outer_checkbox ').prop('checked',true);
        }
        else
        {
            $(document).find(' .rtwmer_orders_outer_checkbox ').prop('checked',false);
        }

    } )

//=============When click on apply button after selecting bulk action=======================//

    $(document).on( 'click','#rtwmer_order_apply_bulk',function() {

        
        var rtwmer_order_bulk_action = $(document).find('#rtwmer_order_bulk_action').children('option:selected').val();
       
        if( (rtwmer_order_bulk_action != 'rtwmer_not_selected') &&  ($(document).find( '.rtwmer_orders_inner_checkbox' ).is(':checked')))
        {
            if( rtwmer_order_bulk_action == 'rtwmer_bulk_delete_order' )
            {
                var rtwmer_confirmation_msg = confirm(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_confirmation_orders_del);
                if( ! rtwmer_confirmation_msg )
                {
                    return;
                }
            }
            var rtwmer_order_checkboxes_array = [];
            $(document).find( '.rtwmer_orders_inner_checkbox' ).each(function() {
                if( $(this).is(':checked') )
                {
                    var rtwmer_order_checkboxes =  $(this).attr('data-id');
                    rtwmer_order_checkboxes_array.push(rtwmer_order_checkboxes);
                }
            })
            $(document).find('#rtwmer-loader-image').show();
            var rtwmer_order_checkboxes_data = {
                'action' : 'rtwmer_order_checkboxes_action',
                'rtwmer_order_bulk_action_val' : rtwmer_order_bulk_action,
                'rtwmer_order_checkboxes' : rtwmer_order_checkboxes_array,
                'rtwmer_order_checkboxes_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
            }
    
            jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_order_checkboxes_data,function(response) {
               
                $(document).find('#rtwmer-loader-image').hide();
                $("option:selected").prop("selected", false);
                $(document).find('.rtwmer_orders_outer_checkbox').prop('checked',false);

                if( rtwmer_order_bulk_action == 'rtwmer_bulk_trash_order' )
                {
                    var rtwmer_response_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_trashed;
                }
                if( rtwmer_order_bulk_action == 'processing' )
                {
                    var rtwmer_response_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_sent_to_processing;
                }
                if( rtwmer_order_bulk_action == 'on-hold' )
                { 
                    
                    var rtwmer_response_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_sent_to_on_hold;
                }
                if( rtwmer_order_bulk_action == 'completed' )
                {
                    var rtwmer_response_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_sent_to_complete;
                }
                if( rtwmer_order_bulk_action == 'rtwmer_bulk_delete_order' )
                {
                    var rtwmer_response_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_deleted;
                }
                if( rtwmer_order_bulk_action == 'rtwmer_bulk_restore_order' )
                {
                    var rtwmer_response_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_restored;
                }
              
                $(document).find('#rtwmer_order_table').DataTable().ajax.reload();

                if( $(document).find('#rtwmer_order_or_order_all').val() == 'isexist' )
                {
                    rtwmer_orders_count();
                }
                else
                {
                    rtwmer_orders_count(response);
                }
                $('.notifyjs-wrapper').remove();
                $.notify(
                    rtwmer_response_msg, {
                    className : 'vendor_success',
                    position : 'right bottom',
                    }
                )

            },'json')
        }
    })
})//=================================When click on button to display orders==================//

$(document).ready(function( $ ){ 
    $(document).on('click','#rtwmer-admin-all-orders',function(){

        // id's of each menu to intially hide them

        // $(document).find('#rtw-mercado-withdraw').css('display','none');
        $(document).find('#rtw-mercado-vendor').css('display','block');
        // $(document).find('#rtw-mercado-dashboard').css('display','none');
        // $(document).find('#rtw-mercado-settings').css('display','none');
        $(document).find('.rtwmer_sort_by_order_status').removeClass('rtwmer_sort_by_status_active');
        $(document).find('#rtwmer_sort_order_all').addClass('rtwmer_sort_by_status_active');
        // $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
        // $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
        // $(document).find('#rtw-mercado-report').css('display','none');
        // $(document).find('#rtwmer-admin-all-orders').addClass('nav-tab-active');
        // $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
        // $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
        // $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
        $(document).find('#rtwmer-loader-image').fadeOut();
        // $(document).find('.rtwmer-submenu').css('display','none');
        $(document).find('#rtwmer_order_or_order_all').val('isexist');
        $(document).find('.rtwmer_mercado_vendor_orders').show();
        $(document).find('.rtwmer_vendors_details').hide();
        $(document).find('.rtwmer_mercado_vendor_product').hide();
        $(document).find('#rtwmer_order_table').dataTable().fnDestroy();
        var rtwmer_sort_order_by = 'all';
        rtwmer_order_or_order_all = 'isexist';
        rtwmer_order_datatable('',rtwmer_sort_order_by,rtwmer_order_or_order_all);
        rtwmer_orders_count();

    })

    $(document).on('click','#rtwmer_order_all_box',function(){
        $("#rtwmer-admin-all-orders").trigger('click');
    })

})

//==============================Displaying Sub Order========================//

    $(document).on('click','.rtwmer_show_sub_order',function(){

        var rtwmer_show_sub_main_order_id = $(this).data('id');
        
        if( $(this).data('value') == 'hide' )
        {
            rtwmer_order_datatable('',$(document).find('#rtwmer_sort_order_by').val(),'isexist','');

            $('#rtwmer_order_table').on( 'init.dt', function () {
                $(document).find('.rtwmer_show_sub_order').text(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_show_sub_order);
                $(document).find('.rtwmer_show_sub_order').attr('data-value','show');
    
            } )

            $('#rtwmer_order_table').on( 'init.dt', function () {
            
                $(document).find('.rtwmer_show_hide_order'+rtwmer_show_sub_main_order_id).text(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_show_sub_order);
                $(document).find('.rtwmer_show_hide_order'+rtwmer_show_sub_main_order_id).attr('data-value','show');
    
            } )
        }
        else
        {   
            rtwmer_order_datatable('',$(document).find('#rtwmer_sort_order_by').val(),'isexist',rtwmer_show_sub_main_order_id);

            $('#rtwmer_order_table').on( 'init.dt', function () {

                $(document).find('.rtwmer_show_hide_order'+rtwmer_show_sub_main_order_id).text(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_hide_sub_order);
                $(document).find('.rtwmer_show_hide_order'+rtwmer_show_sub_main_order_id).attr('data-value','hide');
    
            } )
        }
        
    })

//===========================Function to launch datatable on order section=========================//

    function rtwmer_order_datatable(rtwmer_order_vendor_id,rtwmer_sort_order_by,rtwmer_order_or_order_all,rtwmer_show_sub_main_order_id)
    {
        $(document).find('#rtwmer_order_table').dataTable().fnDestroy();
        
        if(rtwmer_sort_order_by == 'trash')
        {
            $(document).find('.rtwmer_order_bul_restore').show();
            $(document).find('.rtwmer_order_bul_delete').show();
            $(document).find('.rtwmer_order_bul_trash').hide();
        }
        else
        {
       
            $(document).find('.rtwmer_order_bul_trash').show();
            $(document).find('.rtwmer_order_bul_restore').hide();
            $(document).find('.rtwmer_order_bul_delete').hide();
        }
        if( rtwmer_order_or_order_all == 'isexist' )
        {
            $(document).find( '#rtwmer_order_table' ).DataTable({
                "processing"    : true,
                "serverSide"    : true,
                'orderable'     : true,
                "bsortable"     : true,
                "info"          : false,
                select          : true,
                ajax            : {
                    data   :  {
                        action : 'rtwmer_order_table_action',
                        'rtwmer_order_vendor_id' : rtwmer_order_vendor_id,
                        'rtwmer_sort_order_by'   : rtwmer_sort_order_by,
                        'rtwmer_order_or_order_all' : rtwmer_order_or_order_all,
                        'rtwmer_show_sub_main_order_id' : rtwmer_show_sub_main_order_id,
                        'rtwmer_orders_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
                    },
                    type        : 'POST',
                    dataType    : 'json',
                    url         : rtwmer_vendor_object.rtwmer_ajax_url, 
                },
                columnDefs : [
                    {
                        "targets": [0,3,7],
                        "orderable": false,
                        "searchable": false
                    },
                    {
                        "targets": [0], "width" :   "5%",
                        "targets": [1], "width" :   "25%",
                        "targets": [2], "width" :   "20%",
                        "targets": [3], "width" :   "10%",
                        "targets": [4], "width" :   "10%",
                        "targets": [5], "width" :   "10%",
                        "targets": [6], "width" :   "10%",
                        "targets": [7], "width" :   "10%"
                    },
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_search,
                    'processing':  "<div class='rtwmer-loader-box'><div class='rtwmer-reload-table-loader-img-div'><img class='rtwmer-loader-image-datatable' src='"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_loader_src+"' /></div></div>"
                },
                "pagingType": "full_numbers",
                "drawCallback": function () {
                    $(document).find('.mdl-cell--6-col').parent().addClass('rtwmer-grid');
                    $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                    $('.dataTables_length select').addClass('rtwmer-select-box  mdc-ripple-upgraded');
                    $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                    $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                },
                order : [[1, 'DESC']],
                stateSave: true
            })
        }
        if(rtwmer_order_or_order_all == 'isnotexist')
        {
            $(document).find( '#rtwmer_order_table' ).DataTable({
                "processing"    : true,
                "serverSide"    : true,
                'orderable'     : true,
                "bsortable"     : true,
                "info"          : false,
                select          : true,
                ajax            : {
                    data   :  {
                        action : 'rtwmer_order_table_action',
                        'rtwmer_order_vendor_id' : rtwmer_order_vendor_id,
                        'rtwmer_sort_order_by'   : rtwmer_sort_order_by,
                        'rtwmer_order_or_order_all' : rtwmer_order_or_order_all,
                        'rtwmer_orders_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
                    },
                    type        : 'POST',
                    dataType    : 'json',
                    url         : rtwmer_vendor_object.rtwmer_ajax_url,   
                },
                columnDefs : [
                    {
                        "targets": [0,3,7],
                        "orderable": false,
                        "searchable": false
                    },
                    {
                        "targets": [5,6],
                        "orderable": false,
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [0], "width" :   "5%",
                        "targets": [1], "width" :   "25%",
                        "targets": [2], "width" :   "20%",
                        "targets": [3], "width" :   "10%",
                        "targets": [4], "width" :   "10%",
                        "targets": [5], "width" :   "10%",
                        "targets": [6], "width" :   "10%",
                        "targets": [7], "width" :   "10%"
                    },
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_search,
                    'processing':  "<div class='rtwmer-loader-box'><div class='rtwmer-reload-table-loader-img-div'><img class='rtwmer-loader-image-datatable' src='"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_loader_src+"' /></div></div>"
                },
                "pagingType": "full_numbers",
                "drawCallback": function () {
                    $(document).find('.mdl-cell--6-col').parent().addClass('rtwmer-grid');
                    $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                    $('.dataTables_length select').addClass('rtwmer-select-box  mdc-ripple-upgraded');
                    $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                    $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                },
                order : [[1, 'DESC']]
            })
        }
    }

//==================Function to get count of orders according their status==============================//

    function rtwmer_orders_count(rtwmer_order_vendor_id)
    {
        var rtwmer_order_count_data = {
            'action' : 'rtwmer_order_count_action',
            'rtwmer_order_vendor_id' : rtwmer_order_vendor_id,
            'rtwmer_orders_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }
        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_order_count_data,function(response) {
            // console.log(response);
            // console.log(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_all);
            // return ;
            $(document).find('#rtwmer_sort_order_all').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_all+ ' ' + '(' + response.rtwmer_all_orders_count +')');
            
            $(document).find('#rtwmer_sort_order_pending').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_pending_payment+'('+response['rtwmer_pending_orders_count']+')');
            $(document).find('#rtwmer_sort_order_processing').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_processing+'('+response['rtwmer_processing_orders_count']+')');
            $(document).find('#rtwmer_sort_order_on-hold').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_on_hold+'('+response['rtwmer_on_hold_orders_count']+')');
            $(document).find('#rtwmer_sort_order_completed').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_completed+'('+response['rtwmer_completed_orders_count']+')');
            $(document).find('#rtwmer_sort_order_refunded').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_refunded+'('+response['rtwmer_refunded_orders_count']+')');
            $(document).find('#rtwmer_sort_order_cancelled').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_cancelled+'('+response['rtwmer_cancelled_orders_count']+')');
            $(document).find('#rtwmer_sort_order_failed').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_failed+'('+response['rtwmer_failed_orders_count']+')');
            $(document).find('#rtwmer_sort_order_trash').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_trash+'('+response['rtwmer_trash_orders_count']+')');
            $(document).find('#rtwmer_sort_order_draft').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_draft+'('+response['rtwmer_draft_orders_count']+')');

        },'json')
    }

//======================Function to open edit order section=========================//

    function rtwmer_edit_order_iframe(rtwmer_edit_order_id)
    {
        var rtwmer_edit_order_data = {
            'action' : 'rtwmer_edit_order_action',
            'rtwmer_edit_order_id' : rtwmer_edit_order_id,
            'rtwmer_edit_order_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }
        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_edit_order_data,function(response) {
            
            if( response != "" )
            {
                $(document).find('#rtwmer_edit_order_frame').attr('src',response);
                $(document).find('.loader').fadeIn(700);
                $(document).find('.loader').fadeOut();
            }
        },'json')
    }

})( jQuery );