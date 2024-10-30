//This file is used for privacy policy inside setting section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url ,rtwmer_setting_privacy_page, rtwmer_setting_privacy_content;
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    }
        $(document).ready(function( $ ){
            if(rtwmer_split_url[1] == 'privacy-policy'){
                // id's of each menu to intially hide them
                $(document).find('#wpbody-content').show();

                $('#rtw-mercado-withdraw').css('display','none');
                $('#rtw-mercado-vendor').css('display','none');
                $('#rtw-mercado-dashboard').css('display','none');
                $('#rtw-mercado-settings').css('display','block');
                $('#rtwmer-admin-settings').addClass('nav-tab-active');
                $('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $('#rtw-mercado-report').css('display','none');
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                $('#rtwmer-general').css('display','none');
                $('#rtwmer-privacy-policy').css('display','block');
                $('#rtwmer-appearence').css('display','none');
                $('#rtwmer-page-setting').css('display','none');
                $('#rtwmer-selling-options').css('display','none');
                $('#rtwmer-withdraw-options').css('display','none');
                $(document).find('#rtwmer-payment-gateway-options').css('display','none');
                $('#rtwmer-default').css('display','none');
                $('#rtwmer-setting-privacy-policy').addClass('submenu-tab-active');
                $('.rtwmer-submenu').css('display','block');
                $('#rtwmer-loader-image').fadeIn(100);
                $('#rtwmer-loader-image').fadeOut();
            }
			$('#rtwmer-setting-privacy-policy').on('click',function(){
                $(document).find('#wpbody-content').show();

				// $('#rtwmer-privacy-policy').css('display','block');
				// $('#rtwmer-appearence').css('display','none');
				// $('#rtwmer-page-setting').css('display','none');
                // $('#rtwmer-withdraw-options').css('display','none');
                // $(document).find('#rtwmer-payment-gateway-options').css('display','none');
				// $('#rtwmer-selling-options').css('display','none');
                // $('#rtwmer-general').css('display','none');
                // $('#rtw-mercado-report').css('display','none');
                // $(document).find('.rtwmer_settings_submenus').removeClass('submenu-tab-active');
                // $(this).addClass('submenu-tab-active');
                $('#rtwmer-loader-image').fadeIn(100);
                $('#rtwmer-loader-image').fadeOut();
            })
            
            $('#rtwmer-privacy-submit').on('click',function(){
                $('#rtwmer-loader-image').css('display','block');

                var rtwmer_privacy_policy_page_data_array = {}
               
                $(document).find('.rtwmer_privacy_policy_page_data').each(function(rtwmer_serial, rtwmer_type){
 
                    if($(this).is("input"))
                    {
                        if($(this).attr('type') == 'text' )
                        {
                            rtwmer_privacy_policy_page_data_array[$(this).attr('id')] = $(this).val();
                        }
                        if($(this).attr('type') == 'hidden' )
                        {
                            rtwmer_privacy_policy_page_data_array[$(this).attr('id')] = $(this).val();
                        }
                        else if($(this).attr('type') == 'checkbox' )
                        {
                            if($(this).is(':checked'))
                            {
                                rtwmer_privacy_policy_page_data_array[$(this).attr('id')] = 1;
                            }
                            else
                            {
                                rtwmer_privacy_policy_page_data_array[$(this).attr('id')] = 0;
                            }
                        }
                    }
                    else if($(this).is("select"))
                    {
                        rtwmer_privacy_policy_page_data_array[$(this).attr('id')] = $(this).children('option:selected').val();
                    }
                })

                rtwmer_setting_privacy_page = $('#rtwmer-setting-privacy-page').children(':selected').val();
                rtwmer_setting_privacy_content = $('#rtwmer-setting-privacy-content').val();

                var rtwmer_setting_privacy_policy = {
                        'action' : 'rtwmer_setting_privacy',
                        'rtwmer_privacy_page[rtwmer_setting_privacy_page]' : rtwmer_setting_privacy_page,
                        'rtwmer_privacy_page[rtwmer_setting_privacy_content]' : rtwmer_setting_privacy_content,
                        'rtwmer_privacy_page' : rtwmer_privacy_policy_page_data_array,
                        'rtwmer_privacy_policy_page_nonce_verify' : rtwmer_privacy_policy_object.rtwmer_privacy_nonce,
                }

                jQuery.post( rtwmer_privacy_policy_object.rtwmer_ajax_url, rtwmer_setting_privacy_policy, function(response){
                    
                    $('#rtwmer-loader-image').css('display','none');
                    if(response == 1)
                    {
                        $('.notifyjs-wrapper').remove();
                        $.notify(
                            rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved, {
                                className : 'privacy_success',
                                position : 'right bottom'
                            }
                        );
                    }
                    else
                    {
                        $('.notifyjs-wrapper').remove();
                        $.notify(
                            rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg , {
                                className : 'privacy_error',
                                position : 'right bottom'
                            }
                        );
                    }
                },'json')

            })

    })
})( jQuery );