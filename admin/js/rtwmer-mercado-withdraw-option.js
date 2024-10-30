//This file is used for admin withdraw options inside setting section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url, rtwmer_minimum_withdraw;
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    }

        $(document).ready(function( $ ){
            if(rtwmer_split_url[1] == 'withdraw-option'){
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
                $(document).find('#rtwmer-general').css('display','none');
                $(document).find('#rtwmer-privacy-policy').css('display','none');
                $(document).find('#rtwmer-appearence').css('display','none');
                $(document).find('#rtwmer-page-setting').css('display','none');
                $(document).find('#rtwmer-selling-options').css('display','none');
                $(document).find('#rtwmer-withdraw-options').css('display','block');
                $(document).find('#rtwmer-payment-gateway-options').css('display','none');
                $(document).find('#rtwmer-default').css('display','none');
                $(document).find('#rtwmer-setting-withdraw').addClass('submenu-tab-active');
                $(document).find('.rtwmer-submenu').css('display','block');
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
                $(document).find('.rtwmer_store_setup_skip_btn').hide();
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
            }

			$('#rtwmer-setting-withdraw').on('click',function(){

                $(document).find('#wpbody-content').show();
                // $(document).find('#rtwmer-withdraw-options').css('display','block');
                // $(document).find('#rtwmer-payment-gateway-options').css('display','none');
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

            if($(document).find('#rtwmer_withdraw_stripe').is(':checked'))
            {
                $(document).find('.rtwmer_payment_setting_stripe').removeClass('rtwmer_payment_setting_initial');
            }
            if($(document).find('#rtwmer_withdraw_paypal').is(':checked'))
            {
                $(document).find('.rtwmer_payment_setting_paypal').removeClass('rtwmer_payment_setting_initial');
            }

            $(document).on('click','#rtwmer_withdraw_stripe',function(){

                if( $(this).is(':checked') )
                {
                    $(document).find('.rtwmer_payment_setting_stripe').removeClass('rtwmer_payment_setting_initial');
                }
                else
                {
                    $(document).find('.rtwmer_payment_setting_stripe').addClass('rtwmer_payment_setting_initial');
                }
            })
            $(document).on('click','#rtwmer_withdraw_paypal',function(){
                
                if( $(this).is(':checked') )
                {
                    $(document).find('.rtwmer_payment_setting_paypal').removeClass('rtwmer_payment_setting_initial')
                }
                else
                {
                    $(document).find('.rtwmer_payment_setting_paypal').addClass('rtwmer_payment_setting_initial');
                }
            })

            $( '#rtwmer-withdraw-option-submit').on('click',function(e){
                e.preventDefault();

                $('#rtwmer-loader-image').css('display','block');
                var rtwmer_withdraw_option_data_array = {}
               
                $(document).find('.rtwmer_withdraw_option_page_data').each(function(rtwmer_serial, rtwmer_type){
 
                    if($(this).is("input"))
                    {
                        if($(this).attr('type') == 'text' )
                        {
                            rtwmer_withdraw_option_data_array[$(this).attr('id')] = $(this).val();
                        }
                        if($(this).attr('type') == 'hidden' )
                        {
                            rtwmer_withdraw_option_data_array[$(this).attr('id')] = $(this).val();
                        }
                        else if($(this).attr('type') == 'checkbox' )
                        {
                            if($(this).is(':checked'))
                            {
                                rtwmer_withdraw_option_data_array[$(this).attr('id')] = 1;
                            }
                            else
                            {
                                rtwmer_withdraw_option_data_array[$(this).attr('id')] = 0;
                            }
                        }
                    }
                    else if($(this).is("select"))
                    {
                        rtwmer_withdraw_option_data_array[$(this).attr('id')] = $(this).children('option:selected').val();
                    }
                })

                rtwmer_minimum_withdraw = $('#rtwmer_minimum_withdraw').val();

                var rtwmer_withdraw_option_data = {
                        'action' : 'rtwmer_withdraw_option_page',
                        'rtwmer_withdraw_option' : rtwmer_withdraw_option_data_array,
                        'rtwmer_withdraw_page_nonce' : rtwmer_withdraw_option_object.rtwmer_withdraw_option_nonce
                }

                jQuery.post(rtwmer_withdraw_option_object.rtwmer_ajax_url, rtwmer_withdraw_option_data, 
                    function( response ){

                        if( $('.rtwmer_store_setup_skip_btn').css('display') == 'none' )
                        {
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
                        }
                    },'json')
            })
    })
    
})( jQuery );