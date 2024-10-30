//This file is used for admin payment gateway inside setting section jquery and javascript

(function( $ ) {
    'use strict';

    var rtwmer_url, rtwmer_split_url;
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    }

    $(document).ready(function( $ ){
            
            if(rtwmer_split_url[1] == 'payment-gateway'){

                $(document).find('#wpbody-content').show();
                $(document).find('#rtw-mercado-withdraw').css('display','none');
                $(document).find('#rtw-mercado-vendor').css('display','none');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('#rtw-mercado-settings').css('display','block');
                $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-settings').addClass('nav-tab-active');
                $(document).find('#rtwmer-general').css('display','none');
                $(document).find('#rtwmer-privacy-policy').css('display','none');
                $(document).find('#rtwmer-appearence').css('display','none');
                $(document).find('#rtwmer-page-setting').css('display','none');
                $(document).find('#rtwmer-selling-options').css('display','none');
                $(document).find('#rtwmer-withdraw-options').css('display','none');
                $(document).find('#rtwmer-payment-gateway-options').css('display','block');
                $(document).find('#rtwmer-default').css('display','none');
                $(document).find('#rtwmer-setting-withdraw').removeClass('submenu-tab-active');
                $(document).find('#rtwmer-setting-payment-gateway').addClass('submenu-tab-active');
                $(document).find('.rtwmer-submenu').css('display','block');
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
                $(document).find('.rtwmer_store_setup_skip_btn').hide();
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
            }

			$(document).on('click','#rtwmer-setting-payment-gateway',function(){
                // console.log('asdfjdsk');
                $(document).find('#wpbody-content').show();
                // $(document).find('#rtwmer-withdraw-options').css('display','none');
                // $(document).find('#rtwmer-payment-gateway-options').css('display','block');
				// $(document).find('#rtwmer-privacy-policy').css('display','none');
				// $(document).find('#rtwmer-appearence').css('display','none');
				// $(document).find('#rtwmer-page-setting').css('display','none');
				// $(document).find('#rtwmer-selling-options').css('display','none');
				// $(document).find('#rtwmer-general').css('display','none');
                // $(document).find('.rtwmer_settings_submenus').removeClass('submenu-tab-active');
                // $(this).addClass('submenu-tab-active');
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
                // $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('.rtwmer_store_setup_skip_btn').hide();

            })

            $(document).on('click','#rtwmer-payment-gateway-submit',function(e)
            {
                e.preventDefault();
                // console.log('dsfjdl');

                $('#rtwmer-loader-image').css('display','block');

                var rtwmer_payment_method_data_array = {}
                var i = 1;
                $(document).find('.rtwmer_payment_gateway_page_data').each(function(rtwmer_serial, rtwmer_type){
                    if($(this).is("input"))
                    {
                        if($(this).attr('type') == 'text' )
                        {  
                            rtwmer_payment_method_data_array[$(this).attr('id')] = $(this).val();
                        }
                        if($(this).attr('type') == 'hidden' )
                        {
                            rtwmer_payment_method_data_array[$(this).attr('id')] = $(this).val();
                        }
                        else if($(this).attr('type') == 'checkbox' )
                        {
                            if($(this).is(':checked'))
                            {
                                rtwmer_payment_method_data_array[$(this).attr('id')] = 1;
                            }
                            else
                            {
                                rtwmer_payment_method_data_array[$(this).attr('id')] = 0;
                            }
                        }
                    }
                    else if($(this).is("select"))
                    {
                        rtwmer_payment_method_data_array[$(this).attr('id')] = $(this).children('option:selected').val();
                    }
                
                })

                var rtwmer_payment_gateway_data = {
                        'action' : 'rtwmer_payment_gateway_page',
                        'rtwmer_payment_gateway' : rtwmer_payment_method_data_array,
                        'rtwmer_withdraw_page_nonce' : rtwmer_withdraw_option_object.rtwmer_withdraw_option_nonce
                }
               
                jQuery.post(rtwmer_withdraw_option_object.rtwmer_ajax_url, rtwmer_payment_gateway_data, 
                    function( response ){

                        $('#rtwmer-loader-image').css('display','none');
                        if(response == 1)
                        {
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved, {
                                className : 'withdraw_success',
                                position : 'right bottom',
                                }
                            )
                        }
                        else
                        {
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg, {
                                    className : 'withdraw_error',
                                    position : 'right bottom',
                                }
                            )
                        }

                    },'json')
            })
    })
    
})( jQuery )