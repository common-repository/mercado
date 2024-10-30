(function( $ ) {
    'use strict';

        if(window.location.href != ""){
           var rtwmer_url = window.location.href;
            var rtwmer_split_url = rtwmer_url.split("#"); 
        }

    $(document).ready(function( $ ){ 
        
        var rtwmer_sort_by_status = "all";
        var rtwmer_product_author_id;

//===============Function activates when click on product butoon from admin panel========================//
//===============Function activates when click on product butoon from admin panel========================//

    $(document).on( 'click','.rtwmer_vendor_products',function() {
     

        $(document).find('#wpbody-content').show();
        $(document).find('.rtwmer_sidbar_wrapper').show();
        rtwmer_sort_by_status = "all";
        $(document).find('#rtwmer-loader-image').fadeOut();
        $(document).find('.rtwmer_mercado_vendor_product').show();
        $(document).find('.rtwmer_vendors_details').hide();
        rtwmer_vendors_prod_href = $(document).find('.rtwmer_vendors_chng_product').attr('href');
        $(document).find('.rtwmer_vendors_chng_product').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_vl);
        $(document).find('.rtwmer_vendors_chng_product').attr('href','#/vendor');
        $(document).find('.rtwmer_vendors_chng_product').addClass('rtwmer_vendors_chng_product_again');
        rtwmer_product_author_id = $(this).attr('data-id');
        $(document).find('#rtwmer_add_new_prod').attr('data-id',rtwmer_product_author_id);
        $(document).find('.rtwmer_sort_by_status').removeClass('rtwmer_sort_by_status_active');
        $(document).find('#rtwmer_sort_all').addClass('rtwmer_sort_by_status_active');
        $(document).find('#rtwmer_sort_table').val(rtwmer_sort_by_status);
        var rtwmer_sort_table = $(document).find('#rtwmer_sort_table').val();
        $(document).find('#rtwmer_pord_table').val(rtwmer_product_author_id);
        $("#rtwmer_vendors_product_table").dataTable().fnDestroy();

        $(document).find('#rtwmer_empty_trash').hide();
       
        rtwmer_vendors_prod_count(rtwmer_product_author_id);
        
        rtwmer_product_datatable( rtwmer_product_author_id,rtwmer_sort_table,rtwmer_sort_by_status );
        
    } )//===================Function activates when click on go back to vendors list===========================//
//===================Function activates when click on go back to vendors list===========================//
       
$(document).on( 'click','.rtwmer_vendors_chng_product_again',function( e ) {
            
    e.preventDefault();
    $(document).find('#wpbody-content').show();
    $(document).find('.rtwmer_sidbar_wrapper').show();
    window.location.href = rtwmer_split_url[0]+'#/vendor';
    $(document).find('#rtwmer-loader-image').fadeOut();
    $(document).find('.rtwmer_mercado_vendor_product').hide();
    $(document).find('.rtwmer_vendors_details').show();
    $(document).find('.rtwmer_vendors_chng_product_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
    $(document).find('.rtwmer_vendors_chng_product_again').attr('href',rtwmer_vendors_prod_href);

    
    $(document).find('.rtwmer_vendors_chng_product_again').removeClass('rtwmer_vendors_chng_product_again');
    
})

// Code to remove extra class and send back to wordpress heading

    $('#rtwmer-admin-dashboard').on('click', function(){
        $(document).find('.rtwmer_vendors_chng_product_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $(document).find('.rtwmer_vendors_chng_product_again').attr('href',rtwmer_vendors_prod_href);
        $(document).find('.rtwmer_vendors_chng_product_again').removeClass('rtwmer_vendors_chng_product_again');
    })

    $('#rtwmer-admin-withdraw').on('click', function(){
        $(document).find('.rtwmer_vendors_chng_product_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $(document).find('.rtwmer_vendors_chng_product_again').attr('href',rtwmer_vendors_prod_href);
        $(document).find('.rtwmer_vendors_chng_product_again').removeClass('rtwmer_vendors_chng_product_again');
    })

    $('#rtwmer-admin-vendor').on('click', function(){
        $(document).find('.rtwmer_vendors_chng_product_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $(document).find('.rtwmer_vendors_chng_product_again').attr('href',rtwmer_vendors_prod_href);
        $(document).find('.rtwmer_vendors_chng_product_again').removeClass('rtwmer_vendors_chng_product_again');
    })

    $('#rtwmer-admin-settings').on('click', function(){
        $(document).find('.rtwmer_vendors_chng_product_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $(document).find('.rtwmer_vendors_chng_product_again').attr('href',rtwmer_vendors_prod_href);
        $(document).find('.rtwmer_vendors_chng_product_again').removeClass('rtwmer_vendors_chng_product_again');
    })

    $('#rtwmer-admin-all-orders').on('click', function(){
        $(document).find('.rtwmer_vendors_chng_product_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $(document).find('.rtwmer_vendors_chng_product_again').attr('href',rtwmer_vendors_prod_href);
        $(document).find('.rtwmer_vendors_chng_product_again').removeClass('rtwmer_vendors_chng_product_again');
    })

    $('#rtwmer-admin-reports').on('click', function(){
        $(document).find('.rtwmer_vendors_chng_product_again').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_wp);
        $(document).find('.rtwmer_vendors_chng_product_again').attr('href',rtwmer_vendors_prod_href);
        $(document).find('.rtwmer_vendors_chng_product_again').removeClass('rtwmer_vendors_chng_product_again');
    })

//===============Function invokes when click on sorting buttons at admin panel=======================//

        $(document).on('click',".rtwmer-hide-modal",function(){

            $(document).find("#rtwmer_vendor_modal").addClass("rtwmer-animation-left");

        });
    
        $(document).on( 'click','.rtwmer_sort_by_status',function(e) {
            
            e.preventDefault();
            $(document).find('#rtwmer-loader-image').fadeOut();
            rtwmer_sort_by_status = $(this).attr('data-value');
            $(document).find('.rtwmer_sort_by_status').removeClass('rtwmer_sort_by_status_active');
            $(this).addClass('rtwmer_sort_by_status_active');
            $(document).find('#rtwmer_sort_table').val(rtwmer_sort_by_status);
            $("option:selected").prop("selected", false);
            var rtwmer_sort_table = $(document).find('#rtwmer_sort_table').val();

            if(rtwmer_sort_by_status == 'trash')
            {
                $(document).find('#rtwmer_empty_trash').show();
            }
            else{
                $(document).find('#rtwmer_empty_trash').hide();
            }

            rtwmer_product_datatable( rtwmer_product_author_id,rtwmer_sort_table,rtwmer_sort_by_status );

        } )

        var rtwmer_vendors_prod_href;
                
        if(rtwmer_split_url[1] == '/product'){
        
            $(document).find('#wpbody-content').show();
            $(document).find('.rtwmer_sidbar_wrapper').show();
            $(document).find('#rtw-mercado-withdraw').css('display','none');
            $(document).find('#rtw-mercado-vendor').css('display','block');
            $(document).find('.rtwmer_mercado_vendor_product').show();
            $(document).find('.rtwmer_vendors_details').hide();
            rtwmer_vendors_prod_href = $(document).find('.rtwmer_vendors_chng_product').attr('href');
            $(document).find('.rtwmer_vendors_chng_product').html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_go_back_to_vl);
            $(document).find('.rtwmer_vendors_chng_product').attr('href','#/vendor');
            $(document).find('.rtwmer_vendors_chng_product').addClass('rtwmer_vendors_chng_product_again');
            $(document).find('.rtwmer_sort_by_status').removeClass('rtwmer_sort_by_status_active');
            var rtwmer_sort_table = $(document).find('#rtwmer_sort_table').val();
            rtwmer_sort_by_status = rtwmer_sort_table;
            $(document).find('#rtwmer_sort_'+rtwmer_sort_table).addClass('rtwmer_sort_by_status_active');
            var rtwmer_product_author_id = $(document).find('#rtwmer_pord_table').val();

            if(rtwmer_sort_by_status == 'trash')
            {
                $(document).find('#rtwmer_empty_trash').show();
            }
            else{
                $(document).find('#rtwmer_empty_trash').hide();
            }
            rtwmer_product_datatable( rtwmer_product_author_id,rtwmer_sort_table,rtwmer_sort_by_status );
            
            $(document).find('#rtw-mercado-dashboard').css('display','none');
            $(document).find('#rtw-mercado-settings').css('display','none');
            $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
            $(document).find('#rtwmer-admin-vendor').addClass('nav-tab-active');
            $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
            $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
            $(document).find('#rtwmer-loader-image').fadeOut();
            $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
            $(document).find('#rtw-mercado-report').css('display','none');
			$(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
        }

        $('#rtwmer-admin-vendor').on('click', function(){
            $(document).find('#rtw-mercado-withdraw').css('display','none');
            $(document).find('#rtw-mercado-vendor').css('display','block');
            $(document).find('.rtwmer_mercado_vendor_product').css('display','none');
            $(document).find('#rtw-mercado-dashboard').css('display','none');
            $(document).find('.rtwmer_vendors_details').show();
            $(document).find('#rtw-mercado-settings').css('display','none');
            $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
            $(document).find('#rtwmer-admin-vendor').addClass('nav-tab-active');
            $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
            $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
            $(document).find('.rtwmer-submenu').css('display','none');
            $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
            $(document).find('#rtw-mercado-report').css('display','none');
			$(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
            
    })//=====================Function activates when click on filter button from product displaying sectin at admin end=====//        

        var rtwmer_prod_cat_filter_val,rtwmer_filter_by_prod_type,rtwmer_filter_by_prod_stock;

        $(document).on( 'click','#rtwmer_prod_filter_button',function() {

            rtwmer_prod_cat_filter_val = $(document).find('#rtwmer_filter_by_cat').children('option:selected').val();
            rtwmer_filter_by_prod_type = $(document).find('#rtwmer_filter_by_prod_type').children('option:selected').val();
            rtwmer_filter_by_prod_stock = $(document).find('#rtwmer_filter_by_prod_stock').children('option:selected').val();
            
            if( rtwmer_prod_cat_filter_val >= 0 || rtwmer_filter_by_prod_type >= 0 || rtwmer_filter_by_prod_stock >=0 )
            {
                $("#rtwmer_vendors_product_table").dataTable().fnDestroy();

                var rtwmer_datatable = $(document).find('#rtwmer_vendors_product_table').DataTable( {
                    "processing" : true,
                    "serverSide" : true,
                    "bsortable"  : true,
                    "info"       : false,
                    select       : true,
                    "ajax"       : {
                        data: {
                            action: 'rtwmer_vendors_product',
                            'rtwmer_product_author_id'   : rtwmer_product_author_id,
                            'rtwmer_sort_by_status'      : rtwmer_sort_by_status,
                            'rtwmer_filter_by_prod_stock'  : rtwmer_filter_by_prod_stock,
                            'rtwmer_filter_by_prod_type'  : rtwmer_filter_by_prod_type,
                            'rtwmer_prod_cat_filter_val' : rtwmer_prod_cat_filter_val,
                            'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
                            },
                            
                        type      : 'POST',
                        dataType  : 'json',
                        url       : rtwmer_vendor_object.rtwmer_ajax_url,
                        
                    },
                    
                    columnDefs : [
                        {
                            "targets": [0,1,6,7,8],
                            "orderable": false,
                            "searchable": false
                        }
                    ],
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_search,
                        'processing':  "<div class='rtwmer-loader-box'><div class='rtwmer-reload-table-loader-img-div'><img class='rtwmer-loader-image-datatable' src='"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_loader_src+"' /></div></div>"
                    },
                    order : [[2, 'asc']]  
                });
            }

        } )

        //======When click on edit prod button

        $(document).on( 'click','.rtwmer_prod_edit',function() {

            $(document).find('#rtwmer_prod_edit_modal').addClass('rtwmer-modal-open');
            $(document).find('body').css('overflow','hidden');
            $(document).find("#rtwmer_prod_edit_modal").removeClass("rtwmer-animation-left");
            var rtwmer_edit_prod_id = $(this).attr('data-id');
            rtwmer_edit_product_frame(rtwmer_edit_prod_id);
            
        } )

        //when click on add new prod button

        $(document).on( 'click','#rtwmer_add_new_prod',function() {
            
            $(document).find('#rtwmer_prod_edit_modal').addClass('rtwmer-modal-open');
            $(document).find('body').css('overflow','hidden');
            $(document).find("#rtwmer_prod_edit_modal").removeClass("rtwmer-animation-left");
            rtwmer_change_product_iframe_url();

        })

//==========  All data's send to next ajax request

        $(document).find('#sample-permalink').children().attr('target','_blank');

        $(document).on( 'click','#rtwmer_prod_private',function() {
            
            if( $(this).is(':checked') )
            {
                $(document).find( '#rtwmer_prod_password' ).val('');
                $(document).find( '#rtwmer_prod_password' ).prop('disabled','true');
            }
            else
            {   
                $(document).find( '#rtwmer_prod_password' ).removeAttr('disabled','false');
            }
        })

        $(document).on( 'click','#rtwmer_prod_manage_stock',function() {
            if( $(this).is(':checked') )
            {
                $(document).find( '#rtwmer_prod_stock_manage' ).show();
                $(document).find( '#rtwmer_prod_stock_status_div' ).hide();
            }
            else
            {
                $(document).find( '#rtwmer_prod_stock_manage' ).hide();
                $(document).find( '#rtwmer_prod_stock_status_div' ).show();
            }
        } )

//==================== When click on product quick edit button to display data============================//

        $(document).on( 'click','.rtwmer_prod_quick_edit',function() {

            $(document).find('#rtwmer_prod_quick_edit_modal').addClass('rtwmer-modal-open');
            $(document).find('body').css('overflow','hidden');
            $(document).find("#rtwmer_prod_quick_edit_modal").removeClass("rtwmer-animation-left");

            var rtwmer_prod_quick_edit_id = $(this).attr('data-id');
            $(document).find('#rtwmer_quick_edit_update').attr('data-id',rtwmer_prod_quick_edit_id);

            var rtwmer_prod_quick_edit_data = {
                'action' : 'rtwmer_prod_quick_edit', 
                'rtwmer_prod_quick_edit_id' : rtwmer_prod_quick_edit_id,
                'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
            }
            jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_prod_quick_edit_data,function( response ) {

                if( response != "" )
                {
                    $(document).find('#rtwmer_prod_title').val(response['rtwmer_prod_post_title']);
                    $(document).find('#rtwmer_prod_slug').val(response['rtwmer_prod_post_slug']);
                    $(document).find('#rtwmer_prod_published_date').val(response['rtwmer_prod_post_date']);
                    $(document).find('#rtwmer_prod_published_time').val(response['rtwmer_prod_post_time']);
                    if( response['rtwmer_prod_post_status'] == 'private' )
                    {
                        $(document).find('#rtwmer_prod_password').prop('disabled','true');
                        $(document).find('#rtwmer_prod_private').prop('checked','true');
                    }
                    else
                    {
                        $(document).find('#rtwmer_prod_private').removeAttr('checked'); 
                        $(document).find('#rtwmer_prod_password').removeAttr('disabled');
                        $(document).find('#rtwmer_prod_password').val(response['rtwmer_prod_post_password']) ;
                    }
                    $(document).find('#rtwmer_prod_status').val(response['rtwmer_prod_post_status']);
                    $(document).find('#rtwmer_prod_sku').val(response['rtwmer_prod_post_sku']);
                    $(document).find('#rtwmer_prod_price').val(response['rtwmer_prod_post_reg_price']);
                    $(document).find('#rtwmer_prod_sale_price').val(response['rtwmer_prod_post_sale_price']);
                    $(document).find('#rtwmer_prod_tag').val(response['rtwmer_prod_tag_val']);
                    if( response['rtwmer_prod_comment_status'] == "open" )
                    {
                        $(document).find('#rtwmer_prod_enable_reviews').prop('checked','false');
                    }
                    if( response['rtwmer_prod_comment_status'] == "closed" )
                    {
                        $(document).find('#rtwmer_prod_enable_reviews').removeAttr('checked'); 
                    }
                    $(document).find('#rtwmer_prod_weight').val(response['rtwmer_prod_post_weight']);
                    $(document).find('#rtwmer_prod_length').val(response['rtwmer_prod_post_length']);
                    $(document).find('#rtwmer_prod_width').val(response['rtwmer_prod_post_width']);
                    $(document).find('#rtwmer_prod_height').val(response['rtwmer_prod_post_height']);
                    if(response['rtwmer_prod_shpping_class_val'] != "")
                    {
                        $(document).find('#rtwmer_prod_shipping_class').val(response['rtwmer_prod_shpping_class_val']);
                    }
                    else
                    {
                        $(document).find('#rtwmer_prod_shipping_class').val('_no_shipping_class');
                    }
                    if( response['rtwmer_prod_prod_visibile_slug'] == "" )
                    {
                        $(document).find('#rtwmer_prod_visibility').val("visible");
                    }
                    else
                    {
                        $(document).find('#rtwmer_prod_visibility').val(response['rtwmer_prod_prod_visibile_slug']);
                    }
                    $(document).find('#rtwmer_prod_stock_status').val(response['rtwmer_prod_post_stock_status']);
                    $(document).find('#rtwmer_prod_stock_qty').val(response['rtwmer_prod_post_stock_qty']);
                    $(document).find('#rtwmer_prod_backorders').val(response['rtwmer_prod_post_backorders']);
                    if( response['rtwmer_prod_prod_featured_slug'] == "featured" )
                    {
                        $(document).find('#rtwmer_prod_prod_featured_slug').prop('checked','false');
                    }
                    else
                    {
                        $(document).find('#rtwmer_prod_prod_featured_slug').removeAttr('checked'); 
                    }
                    if( response['rtwmer_prod_post_manage_stock'] == 'yes' )
                    {
                        $(document).find('#rtwmer_prod_manage_stock').prop('checked','true');
                        $(document).find( '#rtwmer_prod_stock_manage' ).show();
                        $(document).find( '#rtwmer_prod_stock_status_div' ).hide();
                    }
                    if( response['rtwmer_prod_post_manage_stock'] == 'no' )
                    {
                        $(document).find('#rtwmer_prod_manage_stock').removeAttr('checked');
                        $(document).find( '#rtwmer_prod_stock_manage' ).hide();
                        $(document).find( '#rtwmer_prod_stock_status_div' ).show();
                    }
                    if( $(document).find( '#rtwmer_prod_private' ).is(':checked') )
                    {
                        $(document).find('#rtwmer_prod_status').val('publish');
                    }
                    $(document).find('.rtwmer_prod_post_cat').each(function(a,b) {

                        $(this).val(response['rtwmer_prod_post_cat']);

                    })
                    $(document).find('.rtwmer_quick_edit_modal_data').each(function(a,b){
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

// ================== When clcik on quick edit product button to open iframe and send data to ddb======//

        $(document).on( 'click','#rtwmer_prod_quick_edit_update',function() {

            var rtwmer_quick_edit_update = $(document).find('#rtwmer_quick_edit_update').attr('data-id');
            var rtwmer_prod_title = $(document).find('#rtwmer_prod_title').val();
            var rtwmer_prod_slug = $(document).find('#rtwmer_prod_slug').val();
            var rtwmer_prod_published_date = $(document).find('#rtwmer_prod_published_date').val();
            var rtwmer_prod_published_time = $(document).find('#rtwmer_prod_published_time').val();
            var rtwmer_prod_publish_date = rtwmer_prod_published_date + " " + rtwmer_prod_published_time;
            var rtwmer_prod_tag = $(document).find('#rtwmer_prod_tag').val();
            var rtwmer_prod_tag_split =  rtwmer_prod_tag.split(',');

            if( $(document).find( '#rtwmer_prod_private' ).is(':checked') )
            {
               var rtwmer_prod_private = "private";
               var rtwmer_prod_password = "";
            }
            else
            {
                var rtwmer_prod_password = $(document).find('#rtwmer_prod_password').val();
                var rtwmer_prod_status = $(document).find('#rtwmer_prod_status').children('option:selected').val();
            }
            if( $(document).find('#rtwmer_prod_enable_reviews').is(':checked') )
            {
                var rtwmer_prod_enable_reviews = 'open';
            }
            else
            {
                var rtwmer_prod_enable_reviews = 'closed';
            }
            var rtwmer_prod_sku = $(document).find('#rtwmer_prod_sku').val();
            var rtwmer_prod_reg_price = $(document).find('#rtwmer_prod_price').val();
            var rtwmer_prod_sale_price = $(document).find('#rtwmer_prod_sale_price').val();
            var rtwmer_prod_weight = $(document).find('#rtwmer_prod_weight').val();
            var rtwmer_prod_length = $(document).find('#rtwmer_prod_length').val();
            var rtwmer_prod_width = $(document).find('#rtwmer_prod_width').val();
            var rtwmer_prod_height = $(document).find('#rtwmer_prod_height').val();
            var rtwmer_prod_visibility = $(document).find('#rtwmer_prod_visibility').children('option:selected').val();

            if( rtwmer_prod_visibility == 'visible' )
            {
                var rtwmer_prod_visibility_array = [];
            }
            if( rtwmer_prod_visibility == 'catalog' )
            {
                var rtwmer_prod_visibility_array = ['exclude-from-search'];
            }
            if( rtwmer_prod_visibility == 'search' )
            {
                var rtwmer_prod_visibility_array = ['exclude-from-catalog'];
            }
            if( rtwmer_prod_visibility == 'hidden' )
            {
                var rtwmer_prod_visibility_array = ['exclude-from-search','exclude-from-catalog'];
            }
            if( $(document).find('#rtwmer_prod_prod_featured_slug').is(':checked') )
            {
                rtwmer_prod_visibility_array.push('featured');
            }
            var rtwmer_prod_shipping_class = $(document).find('#rtwmer_prod_shipping_class').children('option:selected').val();

            if( $(document).find('#rtwmer_prod_manage_stock').is(':checked') )
            {
                var rtwmer_prod_stock_status = 'instock';
                var rtwmer_prod_stock_qty = $(document).find('#rtwmer_prod_stock_qty').val();
                var rtwmer_prod_backorders = $(document).find('#rtwmer_prod_backorders').children('option:selected').val();
            }
            else
            {
                var rtwmer_prod_stock_status = $(document).find('#rtwmer_prod_stock_status').children('option:selected').val();
                var rtwmer_prod_stock_qty = "";
                var rtwmer_prod_backorders = "no";
            }
            var rtwmer_prod_quick_edit;
            var rtwmer_prod_post_cat_array = [];
            $(document).find('.rtwmer_prod_post_cat').each(function( ){
                if($(this).is(':checked'))
                {
                    var rtwmer_prod_post_cat = $(this).val();
                    rtwmer_prod_post_cat_array.push(rtwmer_prod_post_cat);
                }   
                
            })
            var rtwmer_prod_quick_edit_data = {
                'action' : 'rtwmer_prod_quick_edit_action',
                'rtwmer_prod_quick_edit[rtwmer_quick_edit_update]' : rtwmer_quick_edit_update,
                'rtwmer_prod_quick_edit[rtwmer_prod_title]' : rtwmer_prod_title,
                'rtwmer_prod_quick_edit[rtwmer_prod_slug]' : rtwmer_prod_slug,
                'rtwmer_prod_quick_edit[rtwmer_prod_publish_date]' : rtwmer_prod_publish_date,
                'rtwmer_prod_quick_edit[rtwmer_prod_private]' : rtwmer_prod_private,
                'rtwmer_prod_quick_edit[rtwmer_prod_password]' : rtwmer_prod_password,
                'rtwmer_prod_quick_edit[rtwmer_prod_tag]' : rtwmer_prod_tag_split,
                'rtwmer_prod_quick_edit[rtwmer_prod_status]' : rtwmer_prod_status,
                'rtwmer_prod_quick_edit[rtwmer_prod_enable_reviews]' : rtwmer_prod_enable_reviews,
                'rtwmer_prod_quick_edit[rtwmer_prod_sku]' : rtwmer_prod_sku,
                'rtwmer_prod_quick_edit[rtwmer_prod_reg_price]' : rtwmer_prod_reg_price,
                'rtwmer_prod_quick_edit[rtwmer_prod_sale_price]' : rtwmer_prod_sale_price,
                'rtwmer_prod_quick_edit[rtwmer_prod_weight]' : rtwmer_prod_weight,
                'rtwmer_prod_quick_edit[rtwmer_prod_length]' : rtwmer_prod_length,
                'rtwmer_prod_quick_edit[rtwmer_prod_width]' : rtwmer_prod_width,
                'rtwmer_prod_quick_edit[rtwmer_prod_height]' : rtwmer_prod_height,
                'rtwmer_prod_quick_edit[rtwmer_prod_visibility_array]' : rtwmer_prod_visibility_array,
                'rtwmer_prod_quick_edit[rtwmer_prod_shipping_class]' : rtwmer_prod_shipping_class,
                'rtwmer_prod_quick_edit[rtwmer_prod_stock_status]' : rtwmer_prod_stock_status,
                'rtwmer_prod_quick_edit[rtwmer_prod_stock_qty]' : rtwmer_prod_stock_qty,
                'rtwmer_prod_quick_edit[rtwmer_prod_backorders]' : rtwmer_prod_backorders,
                'rtwmer_prod_quick_edit[rtwmer_prod_post_cat_array]' : rtwmer_prod_post_cat_array,
                'rtwmer_prod_quick_edit_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
            }
            jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_prod_quick_edit_data,function(response) {
                if(response != "")
                {
                    $('#rtwmer_prod_quick_edit_modal').removeClass('rtwmer-modal-open');
                    $('body').css('overflowY', 'auto'); 

                    if( $(document).find( '#rtwmer_prod_private' ).is(':checked') )
                    {
                        $(document).find('#rtwmer_prod_status').val('publish');
                    }

                    $('#rtwmer_vendors_product_table').DataTable().ajax.reload();
                    rtwmer_vendors_prod_count(response);
                    $('.notifyjs-wrapper').remove();
                    $.notify(
                        rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_updated, {
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

            },'json' )

        } )

    })

//========================When click on trash product button==========================//

    $(document).on( 'click','.rtwmer_prod_trash',function() {

        $(document).find('#rtwmer-loader-image').show();
        var rtwmer_prod_trash_id = $(this).siblings('.rtwmer_prod_quick_edit').attr('data-id');
        var rtwmer_prod_trash_data = {
                'action' : 'rtwmer_prod_trash_action',
                'rtwmer_prod_trash_id' : rtwmer_prod_trash_id,
                'rtwmer_prod_trash_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_prod_trash_data,function(response) {

            $(document).find('#rtwmer-loader-image').hide();
            if(response != "")
            {
                $('#rtwmer_vendors_product_table').DataTable().ajax.reload();
                rtwmer_vendors_prod_count(response);
                $('.notifyjs-wrapper').remove();
                $.notify(
                    rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_trashed, {
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
        },'json' )
        
    } )

//============= When click on preview button from product tables=================//

    $(document).on( 'click','.rtwmer_prod_preview',function() {

        var rtwmer_prod_preview_id = $(this).siblings('.rtwmer_prod_quick_edit').attr('data-id');
        var rtwmer_prod_preview_data = {
            'action' : 'rtwmer_prod_preview_action',
            'rtwmer_prod_preview_id' : rtwmer_prod_preview_id,
            'rtwmer_prod_preview_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_prod_preview_data,function(response) {
            if(response != "")
            {
                window.open(response,'_blank');
            }
        },'json' )
    })

//============= When click on Restore button from product Trash tables=================//

    $(document).on( 'click','.rtwmer_prod_restore',function() {

        $(document).find('#rtwmer-loader-image').show();
        var rtwmer_prod_restore_id = $(this).attr('data-id');
        var rtwmer_prod_restore_data = {
            'action' : 'rtwmer_prod_restore_action',
            'rtwmer_prod_restore_id' : rtwmer_prod_restore_id,
            'rtwmer_prod_restore_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_prod_restore_data,function(response) {

            $(document).find('#rtwmer-loader-image').hide();
            if(response != "")
            {
                $('#rtwmer_vendors_product_table').DataTable().ajax.reload();
                rtwmer_vendors_prod_count(response);
                $('.notifyjs-wrapper').remove();
                $.notify(
                    rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_restored, {
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

//============= When click on Delete Permanently button from product Trash tables=================//

    $(document).on( 'click','.rtwmer_prod_del_permanent',function() {

        var rtwmer_confirm__delete_prod = confirm('Are you sure want to delete this product');
        if( rtwmer_confirm__delete_prod )
        {
            $(document).find('#rtwmer-loader-image').show();
            var rtwmer_prod_delete_id = $(this).attr('data-id');
        }
        else
        {
            return;
        }
        var rtwmer_prod_delete_data = {
            'action' : 'rtwmer_prod_delete_action',
            'rtwmer_prod_delete_id' : rtwmer_prod_delete_id,
            'rtwmer_prod_delete_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_prod_delete_data,function(response) {

            $(document).find('#rtwmer-loader-image').hide();
            if(response != "")
            {
                $('#rtwmer_vendors_product_table').DataTable().ajax.reload();
                rtwmer_vendors_prod_count(response);
                $('.notifyjs-wrapper').remove();
                $.notify(
                    rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_deleted, {
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

//===============When click on outer checkbox to select all inner chckboxes=================//

    $(document).on( 'change','.rtwmer_product_outer_checkbox',function() {

        $(document).find( '.rtwmer_prod_inner_checkbox' ).prop('checked',$(this).prop('checked'));
        $(document).find( '.rtwmer_product_outer_checkbox' ).prop('checked',$(this).prop('checked'));

    } )

    $(document).on( 'change','.rtwmer_prod_inner_checkbox',function() {

        if( $(document).find('.rtwmer_prod_inner_checkbox:checked').length == $(document).find('.rtwmer_prod_inner_checkbox').length)
        {
            $(document).find(' .rtwmer_product_outer_checkbox ').prop('checked',true);
        }
        else
        {
            $(document).find(' .rtwmer_product_outer_checkbox ').prop('checked',false);
        }

    } )

//=============When click on apply button after selecting bulk action=======================//

    $(document).on( 'click','#rtwmer_vendor_apply_bulk',function() {

        
        var rtwmer_prod_bulk_action = $(document).find('#rtwmer_prod_bulk_action').children('option:selected').val();
        if( (rtwmer_prod_bulk_action != 'rtwmer_not_selected') &&  ($(document).find( '.rtwmer_prod_inner_checkbox' ).is(':checked')))
        {
            var rtwmer_prod_checkboxes_array = [];
            $(document).find( '.rtwmer_prod_inner_checkbox' ).each(function() {
                if( $(this).is(':checked') )
                {
                    var rtwmer_prod_checkboxes =  $(this).attr('data-class');
                    rtwmer_prod_checkboxes_array.push(rtwmer_prod_checkboxes);
                }
            })
            $(document).find('#rtwmer-loader-image').show();
            var rtwmer_prod_checkboxes_data = {
                'action' : 'rtwmer_prod_checkboxes_action',
                'rtwmer_prod_bulk_action_val' : rtwmer_prod_bulk_action,
                'rtwmer_prod_checkboxes' : rtwmer_prod_checkboxes_array,
                'rtwmer_prod_checkboxes_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
            }
    
            jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_prod_checkboxes_data,function(response) {

                $(document).find('#rtwmer-loader-image').hide();
                if(response != "")
                {
                    $('#rtwmer_vendors_product_table').DataTable().ajax.reload();
                    rtwmer_vendors_prod_count(response);

                    if( rtwmer_prod_bulk_action == 'rtwmer_bulk_trash_prod' )
                    {
                        var rtwmer_prod_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_products_trashed;
                    }
                    if( rtwmer_prod_bulk_action == 'rtwmer_bulk_restore_prod' )
                    {
                        var rtwmer_prod_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_products_restored;
                    }
                    if( rtwmer_prod_bulk_action == 'rtwmer_bulk_delete_prod' )
                    {
                        var rtwmer_prod_msg = rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_products_deleted;
                    }
                    

                    $(document).find('.rtwmer_product_outer_checkbox').prop('checked',false);
                    $("option:selected").prop("selected", false);
                    $('.notifyjs-wrapper').remove();
                    $.notify(
                        rtwmer_prod_msg, {
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
            },'json')
        }
    })

//=========================code goes when iframe gets closes by admin=======================//

    var rtwmer_edit_update;

    $(document).on('click','#rtwmer_iframe_close',function() {

        $(document).find('#rtwmer_vendors_product_table').DataTable().ajax.reload();
        rtwmer_edit_update = $(document).find('#rtwmer_edit_update').attr('data-id');

        rtwmer_vendors_prod_count(rtwmer_edit_update);

    } )

//==============Code goes when cick to create duplicate product from product table=========================//

    $(document).on('click','.rtwmer_prod_duplicate',function(){

        $(document).find('#rtwmer_prod_edit_modal').addClass('rtwmer-modal-open');
        $(document).find('body').css('overflow','hidden');
        $(document).find("#rtwmer_prod_edit_modal").removeClass("rtwmer-animation-left");
        
        var rtwmer_duplicate_prod_id = $(this).siblings('.rtwmer_prod_edit').attr('data-id');
        $('.loader').css('display','block');

        var rtwmer_dup_prod_table_data = {
            'action' : 'rtwmer_duplicate_prod',
            'rtwmer_prod_dupplicate_id' : rtwmer_duplicate_prod_id,
            'rtwmer_duplicate_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
        }  

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_dup_prod_table_data, function(response){
            
        if( response != "" )            
            {
                $(document).find('.rtwmer_hide_edit_frame').hide();
                $(document).find('.rtwmer_hide_add_frame').hide();
                $(document).find('.rtwmer_duplicate_add_frame').show();

                $(document).find('#rtwmer_duplicate_frame').attr('src',response);
                $('.loader').fadeIn(700);
                $('.loader').fadeOut();
            }

        },'json')
        

    })

//====================Code Goes when Show Empty trash button and working on that========================//
    
    $(document).on( 'click','#rtwmer_empty_trash',function(){

        var rtwmer_confirm_for_empty_trash = confirm(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_confirm_empty_trash);

        if( rtwmer_confirm_for_empty_trash )
        {
            var rtwmer_empty_trash_data = {
                'action' : 'rtwmer_empty_trash_action',
                'rtmer_empty_trash_nonce' : rtwmer_vendor_object.rtwmer_vendor_nonce
            }
    
            jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_empty_trash_data,function(response) {
                if( response != "" )
                {
                    $('#rtwmer_vendors_product_table').DataTable().ajax.reload();
                    rtwmer_vendors_prod_count(response);
                    $('.notifyjs-wrapper').remove();
                        $.notify(
                            rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg, {
                            className : 'vendor_success',
                            position : 'right bottom'
                            }
                        )
                }
                else
                {
                    $('.notifyjs-wrapper').remove();
                        $.notify(
                            rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_products_deleted, {
                                className : 'vendor_error',
                                position : 'right bottom',
                            }
                        )
                }
            } ,'json')
        }
        else
        {
            return;
        }

    })

//=================Code Executes When product goes featured from product listing page================//

    $(document).on( 'change','.rtwmer_fav_prod',function() {

        $(document).find('#rtwmer-loader-image').show();
        var rtwmer_fav_prod_id = $(this).attr('data-id');
        if( $(this).is(':checked') )
        {
            // alert('check');
            var rtwmer_fav_prod = "featured";
        }
        else
        {
            // alert('noncheck');
            var rtwmer_fav_prod = "";
        }

        var rtwmer_fav_prod_data = {

            'action' : 'rtwmer_fav_prod_action',
            'rtwmer_fav_prod' : rtwmer_fav_prod,
            'rtwmer_fav_prod_id' : rtwmer_fav_prod_id,
            'rtwmer_fav_prod_data_nonce' : rtwmer_vendor_object.rtwmer_vendor_nonce
        }

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url,rtwmer_fav_prod_data,function(response){

            $(document).find('#rtwmer-loader-image').hide();
            if( response == 1 )
            {
                $('#rtwmer_vendors_product_table').DataTable().ajax.reload();
                $('.notifyjs-wrapper').remove();
                    $.notify(
                        rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_prod_visibility, {
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

        } )

    } )

//===============Function is used to launch datatatable at product table section=======================//

    function rtwmer_product_datatable(rtwmer_product_author_id,rtwmer_sort_table,rtwmer_sort_by_status)
    {
        if( rtwmer_sort_by_status == 'trash' )
        {
            $(document).find('.rtwmer_prod_bul_untrash').show();
            $(document).find('.rtwmer_prod_bul_trash').hide();
        }
        else
        {
            $(document).find('.rtwmer_prod_bul_untrash').hide();
            $(document).find('.rtwmer_prod_bul_trash').show();
        }

        $("#rtwmer_vendors_product_table").dataTable().fnDestroy();    
        $(document).find('#rtwmer_vendors_product_table').DataTable( {
            "processing" : true,
            "serverSide" : true,
            "bsortable"  : true,
            "info"       : false,
            select       : true,
            "ajax"       : {
                data: {
                    action: 'rtwmer_vendors_product',
                    'rtwmer_product_author_id'   : rtwmer_product_author_id,
                    'rtwmer_sort_table'          : rtwmer_sort_table,
                    'rtwmer_sort_by_status'      : rtwmer_sort_by_status,
                    'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
                    },
                type      : 'POST',
                dataType  : 'json',
                url       : rtwmer_vendor_object.rtwmer_ajax_url,
                
            },
            columnDefs : [
                {
                    "targets": [0,1,6,7,8],
                    "orderable": false,
                    "searchable": false,
                    
                },
                {
                    "width": "20%", "targets": 2
                }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_search,
                'processing':  "<div class='rtwmer-loader-box'><div class='rtwmer-reload-table-loader-img-div'><img class='rtwmer-loader-image-datatable' src='"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_loader_src+"' /></div></div>"
            },
            "pagingType": "full_numbers",
            "drawCallback": function () {
                $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                $('.mdl-cell--6-col').parent().addClass('rtwmer-grid');
                $('.dataTables_length select').addClass('rtwmer-select-box  mdc-ripple-upgraded');
                $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
            },
            order : [[9, 'desc']]  
        });
    }

//================This function is used when admin view/edit any product from admin panel===============//
//================This function is used when admin view/edit any product from admin panel===============//

    function rtwmer_change_product_iframe_url()
    {
        $('.loader').css('display','block');
        var rtwmer_assigning_vendor = $(document).find('#rtwmer_add_new_prod').attr('data-id');
        var rtwmer_add_prod_table_data = {
            'action' : 'rtwmer_prod_add_new',
            'rtwmer_assigning_vendor' : rtwmer_assigning_vendor,
            'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
        }  

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_add_prod_table_data, function(response){
            
        if( response != "" )            
            {
                $(document).find('#wpbody-content').show();
                $(document).find('.rtwmer_hide_edit_frame').hide();
                $(document).find('.rtwmer_hide_add_frame').show();
                $(document).find('.rtwmer_duplicate_add_frame').hide();
                $(document).find('#rtwmer_add_prod_frame').attr('src',response);
                $(document).find('#rtwmer_edit_update').attr('data-id',rtwmer_assigning_vendor);
                $('.loader').fadeIn(700);
                $('.loader').fadeOut();
            }

        },'json')
    }

   

//================Function activates when clicks on edit/update button==========================//
//================Function activates when clicks on edit/update button==========================//

    function rtwmer_edit_product_frame(rtwmer_edit_prod_id) {
        $('.loader').css('display','block');
        var rtwmer_prod_table_data = {
            'action' : 'rtwmer_prod_edit',
            'rtwmer_edit_prod_id' : rtwmer_edit_prod_id,
            'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
        }  

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_prod_table_data, function(response){

        if( response != "" )            
            {
                $(document).find('#wpbody-content').show();
                $(document).find('.rtwmer_hide_add_frame').hide();
                $(document).find('.rtwmer_hide_edit_frame').show();
                $(document).find('.rtwmer_duplicate_add_frame').hide();
                $(document).find('#rtwmer_vend_prod_frame').attr('src',response['rtwmer_prod_edit_url']);
                $(document).find('#rtwmer_edit_update').attr('data-id',response['rtwmer_edit_prod_author_id'])
                $('.loader').fadeIn(700);
                $('.loader').fadeOut();
            }

        },'json')
    }//Function used to count the values in no. of product available in table

    function rtwmer_vendors_prod_count(rtwmer_product_author_id)
    {
        var rtwmer_prod_table_data = {
            'action' : 'rtwmer_prod_tab_count',
            'rtwmer_product_author_id' : rtwmer_product_author_id,
            'rtwmer_vendor_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce,
        }  

        jQuery.post( rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_prod_table_data, function(response){

          
            if( response != "" )            
            {
                $( '#rtwmer_sort_all' ).html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_all+'('+response['rtwmer_prod_all_count']+')');
                $( '#rtwmer_sort_publish' ).html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_published+'('+response['rtwmer_prod_publish_count']+')');
                $( '#rtwmer_sort_draft' ).html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_draft+'('+response['rtwmer_prod_draft_count']+')');
                $( '#rtwmer_sort_pending' ).html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_pending+'('+response['rtwmer_prod_pending_count']+')');
                $( '#rtwmer_sort_trash' ).html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_trash+'('+response['rtwmer_prod_trash_count']+')');
                $( '#rtwmer_sort_private' ).html(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_private+'('+response['rtwmer_prod_private_count']+')');
            }

        },'json')
    }

})( jQuery );

