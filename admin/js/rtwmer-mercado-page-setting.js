//This file is used for admin page settings inside setting section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url, rtwmer_page_setting_dashboard, rtwmer_page_my_orders, rtwmer_page_terms_conditions
    ,rtwmer_page_store_listing;
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    }
        $(document).ready(function( $ ){
            if(rtwmer_split_url[1] == 'page-setting'){
                // id's of each menu to intially hide them
                $(document).find('#wpbody-content').show();

                $(document).find('#rtw-mercado-withdraw').css('display','none');
                $(document).find('#rtw-mercado-vendor').css('display','none');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('#rtw-mercado-settings').css('display','block');
                $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-settings').addClass('nav-tab-active');
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                $(document).find('#rtwmer-general').css('display','none');
                $(document).find('#rtwmer-privacy-policy').css('display','none');
                $(document).find('#rtwmer-appearence').css('display','none');
                $(document).find('#rtwmer-page-setting').css('display','block');
                $(document).find('#rtwmer-selling-options').css('display','none');
                $(document).find('#rtwmer-withdraw-options').css('display','none');
                $(document).find('#rtwmer-payment-gateway-options').css('display','none');
                $(document).find('#rtwmer-default').css('display','none');
                $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('#rtwmer-setting-page-setting').addClass('submenu-tab-active');
                $(document).find('.rtwmer-submenu').css('display','block');
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
            }
			$('#rtwmer-setting-page-setting').on('click',function(){
                $(document).find('#wpbody-content').show();

				// $(document).find('#rtwmer-page-setting').css('display','block');
				// $(document).find('#rtwmer-appearence').css('display','none');
                // $(document).find('#rtwmer-withdraw-options').css('display','none');
                // $(document).find('#rtwmer-payment-gateway-options').css('display','none');
				// $(document).find('#rtwmer-selling-options').css('display','none');
				// $(document).find('#rtwmer-privacy-policy').css('display','none');
				// $(document).find('#rtwmer-general').css('display','none');
                // $(document).find('.rtwmer_settings_submenus').removeClass('submenu-tab-active');
                // $(this).addClass('submenu-tab-active');
                // $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
            })
            
            // when clicked on save changes button

            $('#rtwmer-page-setting-submit').on('click',function(){
                $('#rtwmer-loader-image').css('display','block');
                rtwmer_page_setting_dashboard = $('#rtwmer_page_setting_dashboard').children('option:selected').val();
                rtwmer_page_my_orders = $('#rtwmer_page_my_orders').children('option:selected').val();
                rtwmer_page_terms_conditions = $('#rtwmer_page_terms_conditions').children('option:selected').val();
                rtwmer_page_store_listing = $('#rtwmer_page_store_listing').children('option:selected').val();

                var rtwmer_page_setting_data_array = {}
               
                $(document).find('.rtwmer_page_setting_page_data').each(function(rtwmer_serial, rtwmer_type){
 
                    if($(this).is("input"))
                    {
                        if($(this).attr('type') == 'text' )
                        {
                            rtwmer_page_setting_data_array[$(this).attr('id')] = $(this).val();
                        }
                        if($(this).attr('type') == 'hidden' )
                        {
                            rtwmer_page_setting_data_array[$(this).attr('id')] = $(this).val();
                        }
                        else if($(this).attr('type') == 'checkbox' )
                        {
                            if($(this).is(':checked'))
                            {
                                rtwmer_page_setting_data_array[$(this).attr('id')] = 1;
                            }
                            else
                            {
                                rtwmer_page_setting_data_array[$(this).attr('id')] = 0;
                            }
                        }
                    }
                    else if($(this).is("select"))
                    {
                        rtwmer_page_setting_data_array[$(this).attr('id')] = $(this).children('option:selected').val();
                    }
                })
 
                var rtwmer_page_setting_data = {
                    'action' : 'rtwmer_page_setting', 
                    'rtwmer_page_setting[rtwmer_page_setting_dashboard]' : rtwmer_page_setting_dashboard,
                    'rtwmer_page_setting[rtwmer_page_my_orders]' : rtwmer_page_my_orders,
                    'rtwmer_page_setting[rtwmer_page_store_listing]' : rtwmer_page_store_listing,
                    'rtwmer_page_setting[rtwmer_page_terms_conditions]' : rtwmer_page_terms_conditions,
                    'rtwmer_page_setting' : rtwmer_page_setting_data_array,
                    'rtwmer_page_setting_nonce_verify' : rtwmer_page_setting_object.rtwmer_page_setting_nonce,

                }

                jQuery.post( rtwmer_page_setting_object.rtwmer_ajax_url, rtwmer_page_setting_data, function(response){
                    
                    $('#rtwmer-loader-image').css('display','none');
                    if( response==1 )
                    {
                        $('.notifyjs-wrapper').remove();
                        $.notify(
                            rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved,{
                                className : 'page_setting_success',
                                position : 'right bottom',
                            }
                        )
                    }
                    else
                    {
                        $('.notifyjs-wrapper').remove();
                        $.notify(
                            rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg,{
                                className : 'page_setting_error',
                                position : 'right bottom',
                            }
                        )
                    }
                },'json')
            })

    })
})( jQuery );