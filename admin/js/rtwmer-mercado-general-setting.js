//This file is used for admin general settings inside setting section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url;
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    }
        $(document).ready(function( $ ){
			if(rtwmer_split_url[1] == 'general-setting'){

        // id's of each menu to intially hide them and show the same page on page reload
                $(document).find('#wpbody-content').show();

                $(document).find('#rtw-mercado-withdraw').css('display','none');
                $(document).find('#rtw-mercado-vendor').css('display','none');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('#rtw-mercado-settings').css('display','block');
                $(document).find('#rtwmer-admin-settings').addClass('nav-tab-active');
                $(document).find('#rtwmer-general').css('display','block');
                $(document).find('.rtwmer-submenu').css('display','block');
                $(document).find('#rtwmer-privacy-policy').css('display','none');
                $(document).find('#rtwmer-appearence').css('display','none');
                $(document).find('#rtwmer-page-setting').css('display','none');
                $(document).find('#rtwmer-selling-options').css('display','none');
                $(document).find('#rtwmer-withdraw-options').css('display','none');
                $(document).find('#rtwmer-payment-gateway-options').css('display','none');
                $(document).find('#rtwmer-default').css('display','none');
                $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('.rtwmer_store_setup_skip_btn').hide();
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $(document).find('#rtwmer-setting-general').addClass('submenu-tab-active');
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
            }
			$('#rtwmer-setting-general').on('click',function(){
                $(document).find('#wpbody-content').show();
				// $(document).find('#rtwmer-general').css('display','block');
				// $(document).find('#rtwmer-privacy-policy').css('display','none');
				// $(document).find('#rtwmer-appearence').css('display','none');
				// $(document).find('#rtwmer-page-setting').css('display','none');
				// $(document).find('#rtwmer-selling-options').css('display','none');
                // $(document).find('#rtwmer-withdraw-options').css('display','none');
                // $(document).find('#rtwmer-payment-gateway-options').css('display','none');
                // $(document).find('.rtwmer_settings_submenus').removeClass('submenu-tab-active');
                // $(this).addClass('submenu-tab-active');
                // $(document).find('#rtw-mercado-report').css('display','none');
                $(document).find('.rtwmer_store_setup_skip_btn').hide();
                $(document).find('#rtwmer-loader-image').fadeIn(100);
                $(document).find('#rtwmer-loader-image').fadeOut();
            })
            $('#rtwmer-general-page-submit').on('click',function(e){
                e.preventDefault();

                $(document).find('#rtwmer-loader-image').css('display','block');
                
                var rtwmer_general_setting_data_array = {}
               
                $(document).find('.rtwmer_general_setting_page_data').each(function(rtwmer_serial, rtwmer_type){
 
                    if($(this).is("input"))
                    {
                        if($(this).attr('type') == 'text' )
                        {
                            rtwmer_general_setting_data_array[$(this).attr('id')] = $(this).val();
                        }
                        if($(this).attr('type') == 'hidden' )
                        {
                            rtwmer_general_setting_data_array[$(this).attr('id')] = $(this).val();
                        }
                        else if($(this).attr('type') == 'checkbox' )
                        {
                            if($(this).is(':checked'))
                            {
                                rtwmer_general_setting_data_array[$(this).attr('id')] = 1;
                            }
                            else
                            {
                                rtwmer_general_setting_data_array[$(this).attr('id')] = 0;
                            }
                        }
                    }
                    else if($(this).is("select"))
                    {
                        rtwmer_general_setting_data_array[$(this).attr('id')] = $(this).children('option:selected').val();
                    }
                })
                var rtwmer_store_setup_instruction = $("#rtwmer_store_setup_instruction").val();

        // Sending ajax request to admin-ajax.php and handling on root file

                var rtwmer_general_data = {
                    'action' : 'rtwmer_general_page',
                    'rtwmer_general_settings' : rtwmer_general_setting_data_array,
                    'rtwmer_general_settings[rtwmer_store_setup_instruction]':rtwmer_store_setup_instruction,
                    'rtwmer_general_page_nonce_verify' : rtwmer_general_page_object.rtwmer_general_page_nonce
                };
                jQuery.post(rtwmer_general_page_object.rtwmer_ajax_url, rtwmer_general_data,function( response ){
                    if( $('.rtwmer_store_setup_skip_btn').css('display') == 'none' )
                    {
                        $('#rtwmer-loader-image').css('display','none');
                        if(response == 1){
                            $('.notifyjs-wrapper').remove();
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_setting_saved, {
                                className: 'general_success',
                                position : 'right bottom',
                            }
                            );
                        }
                        else{
                            $.notify(
                                rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_some_error_msg,{
                                    className: 'general_error',
                                    position : 'right bottom',
                                }
                            );
                        }
                    }
                },'json');
                    
            })
    })
    
})( jQuery );

// to send logo of vendor store.

jQuery( document ).ready( function( $ ) {
    var file_frame,wp_media_post_id;
    var set_to_post_id = "";
    jQuery('#rtwmer_upload_logo_button').on('click', function( event ){
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
        file_frame.on('select', function() {
            attachment = file_frame.state().get('selection').first().toJSON();
            $( '#rtwmer_vendor_wizard_logo' ).attr( 'value', attachment.url );
            $( '#rtwmer_wizard_logo_id' ).val( attachment.id );
            wp.media.model.settings.post.id = wp_media_post_id;
            $(document).find('.rtwmer_edit_vendor_details_data').siblings().addClass('mdc-notched-outline--notched');
            $(document).find('.rtwmer_edit_vendor_details_data').siblings().children(".mdc-notched-outline__notch").children(".mdc-floating-label").addClass('mdc-floating-label--float-above');
        });
            file_frame.open();
    });
    jQuery( 'a.add_media' ).on( 'click', function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });
});