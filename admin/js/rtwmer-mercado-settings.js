//This file is used for admin setting section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url;
    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#"); 
    }
        $(document).ready(function( $ ){  
            if(rtwmer_split_url[1] == 'settings'){
				// id's of each menu to intially hide them
				$(document).find('#wpbody-content').show();
				$(document).find('.rtwmer_sidbar_wrapper').show();
                $('#rtw-mercado-withdraw').css('display','none');
                $('#rtw-mercado-vendor').css('display','none');
                $('#rtw-mercado-dashboard').css('display','none');
                $('#rtw-mercado-settings').css('display','block');
                $('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
                $('#rtwmer-admin-settings').addClass('nav-tab-active');
                $('#rtwmer-setting-general').addClass('submenu-tab-active');
                $('#rtwmer-setting-selling').removeClass('submenu-tab-active');
                $('#rtwmer-setting-withdraw').removeClass('submenu-tab-active');
                $('#rtwmer-setting-page-setting').removeClass('submenu-tab-active');
                $('#rtwmer-setting-appearence').removeClass('submenu-tab-active');
				$('#rtwmer-setting-privacy-policy').removeClass('submenu-tab-active');
				$(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
				$(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
				$('#rtwmer-general').css('display','block');
				$('#rtw-mercado-report').css('display','none');
                $('#rtwmer-privacy-policy').css('display','none');
                $('#rtwmer-appearence').css('display','none');
                $('#rtwmer-page-setting').css('display','none');
                $('#rtwmer-selling-options').css('display','none');
				$('#rtwmer-withdraw-options').css('display','none');
				$('.rtwmer-submenu').css('display','block');
				$('#rtwmer-loader-image').fadeIn(100);
				$('#rtwmer-loader-image').fadeOut();
				$(document).find('.rtwmer_store_setup_skip_btn').hide();
            }
			// $('#rtwmer-admin-settings').on('click', function(){
			// 	$(document).find('#wpbody-content').show();
			// 	$(document).find('.rtwmer_sidbar_wrapper').show();
			// 		$('#rtw-mercado-withdraw').css('display','none');
			// 		$('#rtw-mercado-vendor').css('display','none');
			// 		$('#rtw-mercado-dashboard').css('display','none');
			// 		$('#rtw-mercado-settings').css('display','block');
			// 		$('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
			// 		$('#rtwmer-admin-vendor').removeClass('nav-tab-active');
			// 		$('#rtwmer-admin-dashboard').removeClass('nav-tab-active');
			// 		$('#rtwmer-admin-settings').addClass('nav-tab-active');
			// 		$(document).find('.rtwmer_settings_submenus').removeClass('submenu-tab-active');
			// 		$('#rtwmer-setting-general').addClass('submenu-tab-active');
			// 		$('#rtwmer-setting-selling').removeClass('submenu-tab-active');
			// 		$('#rtwmer-setting-withdraw').removeClass('submenu-tab-active');
			// 		$('#rtwmer-setting-page-setting').removeClass('submenu-tab-active');
			// 		$('#rtwmer-setting-appearence').removeClass('submenu-tab-active');
			// 		$('#rtw-mercado-report').css('display','none');
			// 		$('#rtwmer-setting-privacy-policy').removeClass('submenu-tab-active');
			// 		$(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
			// 		$(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
			// 		$('#rtwmer-general').css('display','block');
			// 		$('#rtwmer-privacy-policy').css('display','none');
			// 		$('#rtwmer-appearence').css('display','none');
			// 		$('#rtwmer-page-setting').css('display','none');
			// 		$('#rtwmer-selling-options').css('display','none');
			// 		$('#rtwmer-withdraw-options').css('display','none');
			// 		$('.rtwmer-submenu').css('display','block');
			// 		$('#rtwmer-loader-image').fadeIn(100);
			// 		$('#rtwmer-loader-image').fadeOut();
			// 		$(document).find('.rtwmer_store_setup_skip_btn').hide();
			// })

    })
})( jQuery );