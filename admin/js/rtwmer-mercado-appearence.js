//This file is used for appearence inside setting section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url, rtwmer_current_using_map;
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    }
        $(document).ready(function( $ ){
            if(rtwmer_split_url[1] == 'appearence'){
                // id's of each menu to intially hide them
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
                $(document).find('#rtwmer-appearence').css('display','block');
                $(document).find('#rtwmer-page-setting').css('display','none');
                $(document).find('#rtwmer-selling-options').css('display','none');
                $(document).find('#rtwmer-withdraw-options').css('display','none');
                $(document).find('#rtwmer-payment-gateway-options').css('display','none');
                $(document).find('#rtwmer-default').css('display','none');
                $(document).find('#rtwmer-setting-appearence').addClass('submenu-tab-active');
                $(document).find('.rtwmer-submenu').css('display','block');
                $(document).find('.rtwmer_store_setup_skip_btn').hide();
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
            }
			$('#rtwmer-setting-appearence').on('click',function(){
                $(document).find('#wpbody-content').show();

				// $(document).find('#rtwmer-appearence').css('display','block');
				// $(document).find('#rtwmer-privacy-policy').css('display','none');
				// $(document).find('#rtwmer-page-setting').css('display','none');
                // $(document).find('#rtwmer-withdraw-options').css('display','none');
                // $(document).find('#rtwmer-payment-gateway-options').css('display','none');
				// $(document).find('#rtwmer-selling-options').css('display','none');
                // $(document).find('#rtwmer-general').css('display','none');
                // $(document).find('#rtw-mercado-report').css('display','none');
                // $(document).find('.rtwmer_settings_submenus').removeClass('submenu-tab-active');
                // $(this).addClass('submenu-tab-active');
                $(document).find('.rtwmer_store_setup_skip_btn').hide();
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
            })

            if( $('#rtwmer-google-map').is(':checked') )
            {
                $('.rtwmer-mercado-mapbox').css('display','none');
                $('.rtwmer-mercado-map-api').css('display','block')
            }
            if( $('#rtwmer-mapbox').is(':checked') )
            {
                $('.rtwmer-mercado-mapbox').css('display','none');
                $('.rtwmer-mercado-map-api').css('display','block')
            }

            $('#rtwmer-google-map').on('click',function(){
                $('.rtwmer-mercado-mapbox').css('display','none');
                $('.rtwmer-mercado-map-api').css('display','block');
            })

            $('#rtwmer-mapbox').on('click',function(){
                $('.rtwmer-mercado-mapbox').css('display','block');
                $('.rtwmer-mercado-map-api').css('display','none');
            })

//==================== when clicks on submit button of appearence ======================================//

            $('#rtwmer-appearence-submit').on('click',function(e){
                e.preventDefault();
                // alert('launnn');
                
                $('#rtwmer-loader-image').css('display','block');

                var rtwmer_appearence_page_data_array = {}
               
                $(document).find('.rtwmer_appearence_page_data').each(function(rtwmer_serial, rtwmer_type){
 
                    if($(this).is("input"))
                    {
                        if($(this).attr('type') == 'text' )
                        {
                            rtwmer_appearence_page_data_array[$(this).attr('id')] = $(this).val();
                        }
                        if($(this).attr('type') == 'hidden' )
                        {
                            rtwmer_appearence_page_data_array[$(this).attr('id')] = $(this).val();
                        }
                        else if($(this).attr('type') == 'checkbox' )
                        {
                            if($(this).is(':checked'))
                            {
                                rtwmer_appearence_page_data_array[$(this).attr('id')] = 1;
                            }
                            else
                            {
                                rtwmer_appearence_page_data_array[$(this).attr('id')] = 0;
                            }
                        }
                    }
                    else if($(this).is("select"))
                    {
                        rtwmer_appearence_page_data_array[$(this).attr('id')] = $(this).children('option:selected').val();
                    }
                    if($(this).is("textarea") )
                    {
                        rtwmer_appearence_page_data_array[$(this).attr('id')] = $(this).val();
                    }
                })

                if($('#rtwmer-google-map').is(':checked'))
                {
                    rtwmer_current_using_map = 'google_map';
                }
                if($('#rtwmer-mapbox').is(':checked'))
                {   
                    rtwmer_current_using_map = 'mapbox';
                }

                var rtwmer_appearence_data = {
                    'action' : 'rtwmer_appearence_page_action',
                    'rtwmer_appearence_page[rtwmer_current_using_map]' : rtwmer_current_using_map,
                    'rtwmer_appearence_page' :   rtwmer_appearence_page_data_array,
                    'rtwmer_appearence_nonce_verify' : rtwmer_appearence_page_object.rtwmer_appearence_nonce,
                }
                jQuery.post( rtwmer_appearence_page_object.rtwmer_ajax_url, rtwmer_appearence_data, function(response){

                    if(response.status==true){
                        $('#rtwmer-loader-image').css('display','none');
                        $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved,{
                                    className : 'appearence_success',
                                    position : 'right bottom',
                                }
                            )
                        window.location.replace(response.url);
                    }

                    // if( $('.rtwmer_store_setup_skip_btn').css('display') == 'none' )
                    // {
                    //     $('#rtwmer-loader-image').css('display','none');
                    //     if( response==1 )
                    //     {
                    //         $('.notifyjs-wrapper').remove();
                    //         $.notify(
                    //             rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved,{
                    //                 className : 'appearence_success',
                    //                 position : 'right bottom',
                    //             }
                    //         )
                    //     }
                    //     else
                    //     {
                    //         $('.notifyjs-wrapper').remove();
                    //         $.notify(
                    //             rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg,{
                    //                 className : 'appearence_error',
                    //                 position : 'right bottom',
                    //             }
                    //         )
                    //     }
                    // }
                },'json' )
            })
    })
})( jQuery );