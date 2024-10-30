//This file is used for admin selling options inside setting section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url;
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    }
        $(document).ready(function( $ ){

            if(rtwmer_split_url[1] == 'selling-option'){

                $(document).find('#wpbody-content').show();

                $(document).find('#rtw-mercado-withdraw').css('display','none');
                $(document).find('#rtw-mercado-vendor').css('display','none');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('#rtw-mercado-settings').css('display','block');
                $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-settings').addClass('nav-tab-active');
                $(document).find('#rtwmer-general').css('display','none');
                $(document).find('#rtwmer-privacy-policy').css('display','none');
                $(document).find('#rtwmer-appearence').css('display','none');
                $(document).find('#rtwmer-page-setting').css('display','none');
                $(document).find('#rtwmer-selling-options').css('display','block');
                $(document).find('#rtwmer-withdraw-options').css('display','none');
                $(document).find('#rtwmer-payment-gateway-options').css('display','none');
                $(document).find('#rtwmer-default').css('display','none');
                $(document).find('#rtwmer-setting-selling').addClass('submenu-tab-active');
                $(document).find('.rtwmer-submenu').css('display','block');
                $(document).find('.rtwmer_store_setup_skip_btn').hide();
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
            }
            
			$('#rtwmer-setting-selling').on('click',function(){
                $(document).find('#wpbody-content').show();

				// $(document).find('#rtwmer-selling-options').css('display','block');
				// $(document).find('#rtwmer-privacy-policy').css('display','none');
				// $(document).find('#rtwmer-appearence').css('display','none');
				// $(document).find('#rtwmer-page-setting').css('display','none');
				// $(document).find('#rtwmer-general').css('display','none');
                // $(document).find('#rtwmer-withdraw-options').css('display','none');
                // $(document).find('#rtwmer-payment-gateway-options').css('display','none');
                // $(document).find('#rtw-mercado-report').css('display','none');
                // $(document).find('.rtwmer_settings_submenus').removeClass('submenu-tab-active');
                // $(this).addClass('submenu-tab-active');
                $(document).find('.rtwmer_store_setup_skip_btn').hide();
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
            })
            // To click on save changes button

            $('#rtwmer-selling-page-submit').on('click',function(e){
                e.preventDefault();

                $('#rtwmer-loader-image').css('display','block');

               var rtwmer_selling_option_data_array = {}
               
               $(document).find('.rtwmer_selling_option_page_data').each(function(rtwmer_serial, rtwmer_type){

                if($(this).is("input"))
                {
                    if($(this).attr('type') == 'text' )
                    {
                        rtwmer_selling_option_data_array[$(this).attr('id')] = $(this).val();
                    }
                    else if($(this).attr('type') == 'checkbox' )
                    {
                        if($(this).is(':checked'))
                        {
                            rtwmer_selling_option_data_array[$(this).attr('id')] = 1;
                        }
                        else
                        {
                            rtwmer_selling_option_data_array[$(this).attr('id')] = 0;
                        }
                    }
                }
                else if($(this).is("select"))
                {
                    rtwmer_selling_option_data_array[$(this).attr('id')] = $(this).children('option:selected').val();
                }
               })
	 
               var rtwmer_selling_option_data = {
                   'action' : 'rtwmer_selling_options_page',
                   'rtwmer_selling_options' : rtwmer_selling_option_data_array,
                   'rtwmer_sellings_option_nonce_verify' : rtwmer_sellings_options_object.rtwmer_sellings_option_nonce
               }
            
               jQuery.post( rtwmer_sellings_options_object.rtwmer_ajax_url, rtwmer_selling_option_data,
                function( response ){

                    if( $('.rtwmer_store_setup_skip_btn').css('display') == 'none' )
                    {
                        $('#rtwmer-loader-image').css('display','none');
                        if(response == 1){
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved, {
                                    className: 'selling_success',
                                    position : 'right bottom',
                                }
                            )
                        }
                        else{
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg, {
                                    className: 'selling_error',
                                    position : 'right bottom',
                                }
                            )
                        }
                    }
                },'json')
            })
    })

})( jQuery );