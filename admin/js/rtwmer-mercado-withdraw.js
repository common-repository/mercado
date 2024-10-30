//This file is used for admin withdraw section jquery and javascript

(function( $ ) {

    'use strict';
    var rtwmer_url, rtwmer_split_url;
    if(window.location.href != ""){

    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");

    }
    var rtwmer_withdraw_status = 'pending';

        $(document).ready(function( $ ){
            
            $(document).on('click','.rtwvsm-list-item',function(e){
               
               $(document).find("#rtwmer_withdraw_add_note").addClass("rtwmer-animation-left")
            })

            if(rtwmer_split_url[1] == 'withdraw'){

                // id's of each menu to intially hide them
                $(document).find('#wpbody-content').show();

                $(document).find('#rtw-mercado-withdraw').css('display','block');
                $(document).find('#rtw-mercado-vendor').css('display','none');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('#rtw-mercado-settings').css('display','none');
                $(document).find('#rtwmer-admin-withdraw').addClass('nav-tab-active');
                $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                $(document).find('#rtwmer-loader-image').fadeOut();

                rtwmer_withdraw_status = $('#rtwmer_withdraw_active').val();
                
                rtwmer_withdraw_function(rtwmer_withdraw_status);
                rtwmer_withdraw_requests_count();
                rtwmer_withdraw_status_with_bulk_action(rtwmer_withdraw_status);
            }  
			$('#rtwmer-admin-withdraw').on('click', function(){

                $(document).find('#wpbody-content').show();
                $(document).find('#rtwmer-loader-image').fadeOut(); 

                rtwmer_withdraw_status = "pending";

                rtwmer_withdraw_function(rtwmer_withdraw_status);
                rtwmer_withdraw_requests_count();
                rtwmer_withdraw_status_with_bulk_action(rtwmer_withdraw_status);
            })

    $(document).on('click','#rtwmer_withdraw_requests_box',function(){
        $(document).find('#rtwmer-admin-withdraw').trigger('click');
    })

    $(document).on('click','.rtwmer_withdraw',function(){

        $(document).find('.rtwmer_withdraw').removeClass('rtwmer_sort_by_status_active');
        $(this).addClass('rtwmer_sort_by_status_active');
        rtwmer_withdraw_status = $(this).attr('data-value');

        rtwmer_withdraw_function(rtwmer_withdraw_status);
        rtwmer_withdraw_status_with_bulk_action(rtwmer_withdraw_status);

    })//=======================Code goes when Withdraw Status get changes from admin panel==========================//
//=======================Code goes when Withdraw Status get changes from admin panel==========================//

    $(document).on( 'click','.rtwmer_withdraw_status_chng',function() {
        // alert('adf');
        // return;
        var rtwmer_withdraw_status = $(this).attr('data-value');
        
        var rtwmer_withdraw_status_id = $(this).attr('data-id');
        
        var rtwmer_withdraw_status_data = {

            'action'  : 'rtwmer_withdraw_status_action',
            'rtwmer_withdraw_status' : rtwmer_withdraw_status,
            'rtwmer_withdraw_status_id' : rtwmer_withdraw_status_id,
            'rtwmer_withdraw_status_nonce_verify' : ajax_withdraw_object.rtwmer_withdraw_nonce,

        }

        jQuery.post( ajax_withdraw_object.rtwmer_ajax_url,rtwmer_withdraw_status_data,function(response){
            $(document).trigger("rtwmer_payment_gateway",response);
            if(response == 1)
            {
                $(document).find('#rtwmer_withdraw_table').DataTable().ajax.reload();
                rtwmer_withdraw_requests_count();
                $('.notifyjs-wrapper').remove();
                if( rtwmer_withdraw_status == 'pending' )
                {
                    var rtwmer_withdraw_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_request_back_to_pending;
                }
                if( rtwmer_withdraw_status == 'delete' )
                {
                    var rtwmer_withdraw_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_request_deleted;
                }
                if( rtwmer_withdraw_status == 'cancelled' )
                {
                    var rtwmer_withdraw_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_request_cancelled;
                }
                if( rtwmer_withdraw_status == 'approved' )
                {
                    var rtwmer_withdraw_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_request_approved;
                }
                $.notify(
                    rtwmer_withdraw_msg, {
                    className : 'vendor_success',
                    position : 'right bottom'
                    }
                )
            }
            else if( response != 1 && response != "" )
            {
                $(document).find('#rtwmer_withdraw_table').DataTable().ajax.reload();
                rtwmer_withdraw_requests_count();
                $('.notifyjs-wrapper').remove();
                $('.notifyjs-wrapper').remove();
                    $.notify(
                        response, {
                            className : 'vendor_error',
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

        },'json' )

    } )

//=======================Code goes when Withdraw Status get changes using bulk action==========================//
//=======================Code goes when Withdraw Status get changes using bulk action==========================//

    $(document).on('change','.rtwmer_withdraw_outer_checkbox',function() {

        $(document).find('.rtwmer_withdraw_inner_checkbox').prop( 'checked',$(this).prop('checked') );
        $(document).find('.rtwmer_withdraw_outer_checkbox').prop( 'checked',$(this).prop('checked') );
    })

    $(document).on('change','.rtwmer_withdraw_inner_checkbox',function() {

        if( $(document).find('.rtwmer_withdraw_inner_checkbox:checked').length == $(document).find('.rtwmer_withdraw_inner_checkbox').length )
        {
            $(document).find('.rtwmer_withdraw_outer_checkbox').prop( 'checked',true );
        }
        else
        {
            $(document).find('.rtwmer_withdraw_outer_checkbox').prop( 'checked',false );
        }
    })

    $(document).on('click','#rtwmer_withdraw_apply_bulk',function(){

        var rtwmer_withdraw_action = $(document).find('#rtwmer_withdraw_action').val();
        
        if( rtwmer_withdraw_action != 'rtwmer_not_selected' && $(document).find('.rtwmer_withdraw_inner_checkbox').is(':checked') )
        {
            var rtwmer_withdraw_action_array = [];
            
            $(document).find('.rtwmer_withdraw_inner_checkbox').each(function(a,b){
                if( $(this).is(':checked') )
                {
                    rtwmer_withdraw_action_array.push($(this).attr('data-id'));
                }
            })
            var rtwmer_withdraw_status_data = {

                'action'  : 'rtwmer_withdraw_status_action',
                'rtwmer_withdraw_status' : rtwmer_withdraw_action,
                'rtwmer_withdraw_status_id_array' : rtwmer_withdraw_action_array,
                'rtwmer_withdraw_status_nonce_verify' : ajax_withdraw_object.rtwmer_withdraw_nonce,
    
            }
    
            jQuery.post( ajax_withdraw_object.rtwmer_ajax_url,rtwmer_withdraw_status_data,function(response){
                
                if(response == 1)
                {   
                    $(document).find('#rtwmer_withdraw_table').DataTable().ajax.reload();
                    rtwmer_withdraw_requests_count();
                    $(document).find('.rtwmer_withdraw_inner_checkbox').prop( 'checked',false );
                    $(document).find('.rtwmer_withdraw_outer_checkbox').prop( 'checked',false );
                    $("option:selected").prop("selected", false);
                    $('.notifyjs-wrapper').remove();

                    if( rtwmer_withdraw_status == 'pending' )
                {
                    var rtwmer_withdraw_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_requests_back_to_pending;
                }
                if( rtwmer_withdraw_status == 'delete' )
                {
                    var rtwmer_withdraw_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_requests_deleted;
                }
                if( rtwmer_withdraw_status == 'cancelled' )
                {
                    var rtwmer_withdraw_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_requests_cancelled;
                }
                if( rtwmer_withdraw_status == 'approved' )
                {
                    var rtwmer_withdraw_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_requests_approved;
                }

                    $.notify(
                        rtwmer_withdraw_msg, {
                        className : 'vendor_success',
                        position : 'right bottom'
                        }
                    )
                }
                else if( response != 1 && response != "" )
                {
                    $(document).find('#rtwmer_withdraw_table').DataTable().ajax.reload();
                    rtwmer_withdraw_requests_count();
                    $(document).find('.rtwmer_withdraw_inner_checkbox').prop( 'checked',false );
                    $(document).find('.rtwmer_withdraw_outer_checkbox').prop( 'checked',false );
                    $("option:selected").prop("selected", false);
                    $('.notifyjs-wrapper').remove();
                        $.notify(
                            response, {
                                className : 'vendor_error',
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
    
            },'json' )
        }
    })
    
    $(document).on( 'click','.rtwmer_withdraw_add_note',function(){

        $(document).find('#rtwmer_withdraw_add_note').addClass('rtwmer-modal-open');
        $(document).find('body').css('overflow','hidden');
        $(document).find("#rtwmer_withdraw_add_note").removeClass("rtwmer-animation-left");
        var rtwmer_withdraw_add_note_id = $(this).attr('data-id');
        $(document).find('.rtwmer_withdraw_add_note_btn').attr('data-id',$(this).attr('data-id'));

        var rtwmer_withdraw_status_data = {

            'action'  : 'rtwmer_withdraw_status_note_action',
            'rtwmer_withdraw_add_note_id' : rtwmer_withdraw_add_note_id,
            'rtwmer_withdraw_status_nonce_verify' : ajax_withdraw_object.rtwmer_withdraw_nonce,

        }

        jQuery.post( ajax_withdraw_object.rtwmer_ajax_url,rtwmer_withdraw_status_data,function(response){
            
            if(response != "")
            {   
                $(document).find('#rtwmer_withdraw_add_note_text').val(response);
            }

        },'json' )
    } )

    $(document).on( 'click','.rtwmer_withdraw_add_note_btn',function(){

        var rtwmer_withdraw_action_id = $(this).attr('data-id');
        var rtwmer_withdraw_add_note_msg = $(document).find('#rtwmer_withdraw_add_note_text').val();
        var rtwmer_withdraw_status_data = {

            'action'  : 'rtwmer_withdraw_status_action',
            'rtwmer_withdraw_status' : 'add_note',
            'rtwmer_withdraw_status_id' : rtwmer_withdraw_action_id,
            'rtwmer_withdraw_add_note_msg' : rtwmer_withdraw_add_note_msg,
            'rtwmer_withdraw_status_nonce_verify' : ajax_withdraw_object.rtwmer_withdraw_nonce,

        }

        jQuery.post( ajax_withdraw_object.rtwmer_ajax_url,rtwmer_withdraw_status_data,function(response){
            
            if(response == 1)
            {   
                $(document).find('#rtwmer_withdraw_table').DataTable().ajax.reload();
                rtwmer_withdraw_requests_count();
                $('.notifyjs-wrapper').remove();
                $.notify(
                    rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_note_updtaed, {
                    className : 'vendor_success',
                    position : 'right bottom'
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

        },'json' )
    } )

//========================== Function is used to display bulk action select option======================//
})

    function rtwmer_withdraw_status_with_bulk_action(rtwmer_withdraw_status)
    {
        if( rtwmer_withdraw_status == 'approved' )
        {
            $(document).find('#rtwmer_withdraw_action option').hide();
        }
        if( rtwmer_withdraw_status == 'pending' )
        {
            $(document).find('#rtwmer_withdraw_action option').show();
            $(document).find('.rtwmer_withdraw_pending_page').show();
            $(document).find('.rtwmer_withdraw_cancel_page').hide();
        }
        if( rtwmer_withdraw_status == 'cancelled' )
        {
            $(document).find('#rtwmer_withdraw_action option').show();
            $(document).find('.rtwmer_withdraw_pending_page').hide();
            $(document).find('.rtwmer_withdraw_cancel_page').show();
        }
    }

//========================== Function is used to admin withdraw requests COUNT of vendors======================//

    function rtwmer_withdraw_requests_count(){
        
        var rtmwer_withdraw_req_count = {

            'action' : 'rtwmer_admin_withdraw_count',
            'rtwmer_withdraw_nonce_verify' : ajax_withdraw_object.rtwmer_withdraw_nonce,

        }

        jQuery.post( ajax_withdraw_object.rtwmer_ajax_url,rtmwer_withdraw_req_count,function(response){
            
            if(response != '')
            {
                $('#rtwmer_withdraw_pending').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_pending+'('+response['rtwmer_withdraw_pending_count']+')');
                $('#rtwmer_withdraw_approved').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_approved+'('+response['rtwmer_withdraw_approved_count']+')');
                $('#rtwmer_withdraw_cancelled').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_cancelled+'('+response['rtwmer_withdraw_cancelled_count']+')');
            }

        },'json' )

    }

//========================== Function is used to admin withdraw requests of vendors======================//

function rtwmer_withdraw_function(rtwmer_withdraw_status)
{
    $("#rtwmer_withdraw_table").dataTable().fnDestroy();
    $(document).find('.rtwmer_withdraw').removeClass('rtwmer_sort_by_status_active');
    $(document).find('#rtwmer_withdraw_'+rtwmer_withdraw_status).addClass('rtwmer_sort_by_status_active');
    
    var rtwmer_datatable = $(document).find('#rtwmer_withdraw_table').DataTable( {
        "processing" : true,
        "serverSide" : true,
        "bsortable"  : true,
        "info"       : false,
        select       : true,
        "ajax"       : {
            data: {
                action: 'rtwmer_admin_withdraw',
                'rtwmer_withdraw_status' : rtwmer_withdraw_status,
                'rtwmer_withdraw_nonce_verify' : ajax_withdraw_object.rtwmer_withdraw_nonce,
                },
            type      : 'POST',
            dataType  : 'json',
            url       : ajax_withdraw_object.rtwmer_ajax_url,
            
        },
        language: {
            search: "_INPUT_",
            searchPlaceholder: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_search,
            'processing':  "<div class='rtwmer-loader-box'><div class='rtwmer-reload-table-loader-img-div'><img class='rtwmer-loader-image-datatable' src='"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_loader_src+"' /></div></div>"
        },
        columnDefs : [
            {
                "targets": [0,1,5,6,8],
                "orderable": false,
                "searchable": false,
            },
            {    
                "width" : "5%","targets":0,
                "width" : "20%","targets":1,
                "width" : "10%","targets":2,
                "width" : "10%","targets":3,
                "width" : "10%","targets":4,
                "width" : "10%","targets":5,
                "width" : "12%","targets":6,
                "width" : "12%","targets":7,
                "width" : "11%","targets":8
            }
        ],
        order : [[2, 'asc']],
        "pagingType": "full_numbers",
        "drawCallback": function () {
        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
        $('.mdl-cell--6-col').parent().addClass('rtwmer-grid');
        $('.dataTables_length select').addClass('rtwmer-select-box custom-enhanced-select-width mdc-ripple-upgraded');
        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");

        }
    });
}})( jQuery );