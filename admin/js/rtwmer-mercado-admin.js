(function( $ ) {

	'use strict';

	/**

	 * All of the code for your admin-facing JavaScript source

	 * should reside in this file.

	 *

	 * Note: It has been assumed you will write jQuery code here, so the

	 * $ function reference has been prepared for usage within the scope

	 * of this function.

	 *

	 * This enables you to define handlers, for when the DOM is ready:

	 *

	 * $(function() {

	 *

	 * });

	 *

	 * When the window is loaded:

	 *

	 * $( window ).load(function() {

	 *

	 * });

	 *

	 * ...and/or other possibilities.

	 *

	 * Ideally, it is not considered best practise to attach more than a

	 * single DOM-ready or window-load handler for a particular page.

	 * Although scripts in the WordPress core, Plugins and Themes may be

	 * practising this, we should strive to set a better example in our own work.

	 */

		var rtwmer_url, rtwmer_split_url;

		if(window.location.href != "")
		{

			rtwmer_url = window.location.href;

			rtwmer_split_url = rtwmer_url.split("#");

			var rtwmer_store_setup_page_url  =  rtwmer_url.split("&");
		}

		$(document).ready(function( $ ){
			var rtwmer_time_interval = 600000;
			var rtwmer_set_interval = '';
			if($("#rtwmer_offer_icon").hasClass("rtwmer_auto_open")){
				  $(".rtwmer_features_modal").addClass("rtwmer-modal-open");
				  $("body").css("overflow","hidden");
			  }
		
			  if($("#rtwmer_offer_icon").hasClass("rtwmer_show_offer_modal")){
				  $(".rtwmer_features_modal").addClass("rtwmer-modal-open");
				  $("body").css("overflow","hidden");
			  }
			  $(document).find('.rtwmer_close_offer_sec').on('click', function(){
				if($("#rtwmer_prevent_popup").is(":checked")){
				}else{
					$(document).find('#rtwmer-loader-image').show();
					var rtwmer_dashboard_data = {
						'action' : 'rtwmer_pop_up_notification',
						'rtwmer_condition':"save_time_stamp",
						'rtwmer_dashboard_page_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
					};
					jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_dashboard_data,
						function( response )
						{
							$('#rtwmer-loader-image').hide();
							if(response != "")
							{
		
							}
						},"json");
				}
			  });

			  $(document).on('click','.rtwmer_main_menu_class',function(){
				$('.rtwmer_main_menu_class').removeClass("nav-tab-active");
				$(this).addClass("nav-tab-active");
				$(".rtwmer_wrapper_div").hide();
				$(".rtwmer-submenu").hide();
				if($(this).attr("data-submenu") != "true"){
					$($(this).attr("data-tab")).show();
					$('.rtwmer_settings_submenus').removeClass("submenu-tab-active");
				}else{
					$('.rtwmer_settings_submenus').removeClass("submenu-tab-active");
					$(this).next().show();
					$("#"+$(this).next().attr("id")+" li:first-child").children("a").addClass("submenu-tab-active");
					$($("#"+$(this).next().attr("id")+" li:first-child").children("a").attr("data-tab")).show();
				}
			})
			$(document).on('click','.rtwmer_settings_submenus',function(){
				$('.rtwmer_main_menu_class').removeClass("nav-tab-active");
				$($(this).attr("data-parent")).addClass("nav-tab-active");
				$('.rtwmer_settings_submenus').removeClass("submenu-tab-active");
				$(this).addClass("submenu-tab-active");
				$(".rtwmer-submenu").hide();
				$(this).closest('ul').show();
				$(".rtwmer_wrapper_div").hide();
				$($(this).attr("data-tab")).show();
			})


			$(document).find('#rtwmer_offer_icon').on('click', function(){
				$(document).find(".rtwmer_features_modal").addClass("rtwmer-modal-open");
				$("body").css("overflow","hidden");
			  });

			  $(document).find("#rtwmer_prevent_popup").click(function(){
				  if($(this).is(":checked")){
					$(document).find('#rtwmer-loader-image').show();
					var rtwmer_dashboard_data = {
						'action' : 'rtwmer_pop_up_notification',
						'rtwmer_condition':"checked",
						'rtwmer_dashboard_page_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
					};
					jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_dashboard_data,
						function( response )
						{
							$('#rtwmer-loader-image').hide();
							if(response != "")
							{
		
							}
						},"json");
				  }else{
					 $(document).find('#rtwmer-loader-image').show();
					 var rtwmer_dashboard_data = {
						 'action' : 'rtwmer_pop_up_notification',
						 'rtwmer_condition':"unchecked",
						 'rtwmer_dashboard_page_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
					 };
					 jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_dashboard_data,
						 function( response )
						 {
							 $('#rtwmer-loader-image').hide();
							 if(response != "")
							 {
		 
							 }
						 },"json");
				  }
			  })

		if(rtwmer_split_url[1]==""){

			$(document).find('#wpbody-content').show();

			$(document).find('#rtw-mercado-withdraw').css('display','none');

			$(document).find('#rtw-mercado-vendor').css('display','none');

			$(document).find('#rtw-mercado-dashboard').css('display','block');

			$(document).find('#rtw-mercado-settings').css('display','none');

			$(document).find('#rtwmer-admin-dashboard').addClass('nav-tab-active');

			$(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');

			$(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');

			$(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');

			$(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');

			rtwmer_dashboard_report();

			rtmwer_dashboard_chart();

		}

		else if(rtwmer_store_setup_page_url[1] == "rtwmer_action=rtwmer_store_setup"){

			$(document).find('#wpbody-content').show();

			$(document).find('.rtwmer_settings_tab_wrapper').css('display','none');

			$(document).find('.rtwmer_sidbar_wrapper').css('display','none');

			$(document).find('#rtwmer-loader-image').hide();

			$(document).find('.rtwmer_store_page_section').addClass('rtwmer_store_page_section_margin');

			$(document).find('#rtw-mercado-withdraw').css('display','none');

			$(document).find('#rtw-mercado-vendor').css('display','none'); 

			$(document).find('#rtw-mercado-dashboard').css('display','none');

			$(document).find('#rtw-mercado-settings').css('display','none');

			$(document).find('#rtwmer-general').css('display','none');

			$(document).find('#rtwmer-appearence').css('display','none');

			$(document).find('#rtwmer-selling-options').css('display','none');

			$(document).find('#rtwmer-withdraw-options').css('display','none');

			$(document).find('#rtwmer-payment-gateway-options').css('display','none');

		}

		else
		{
			if(rtwmer_url.indexOf('#') != -1)

			{

			}

			else

			{

				$(document).find('#wpbody-content').show();

				$(document).find('#rtw-mercado-withdraw').css('display','none');

				$(document).find('#rtw-mercado-vendor').css('display','none');

				$(document).find('#rtw-mercado-dashboard').css('display','none');

				$(document).find('#rtw-mercado-settings').css('display','none');

				$(document).find('#rtw-mercado-report').css('display','block');

				$(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');

				$(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');

				$(document).find('#rtwmer-admin-dashboard').addClass('nav-tab-active');

				$(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');

				$(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');

				$(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');

				$(document).find('#rtwmer-loader-image').show();

				$(document).find('#rtwmer_report_or_dashboard').attr('data-value','dashboard');

				rtwmer_dashboard_report();

				rtmwer_dashboard_chart();

			}

			$(document).find('.rtwmer_other_reports_product_stats').hide();

		}

			$(document).on('click','.rtwmer_launch_setup_btn',function(e){

				e.preventDefault();

				$(document).find('#rtwmer-loader-image').hide();

				$(document).find('#rtw-mercado-withdraw').css('display','none');

				$(document).find('.rtwmer_setup_welcome_page').hide();

				$(document).find('.rtwmer_store_page_section').removeClass('rtwmer_store_page_section_margin');

				$(document).find('#rtw-mercado-vendor').css('display','none'); 

				$(document).find('#rtw-mercado-dashboard').css('display','none');

				$(document).find('#rtw-mercado-settings').css('display','block');

				$(document).find('#rtwmer-general').css('display','block');

				$(document).find('#rtwmer-appearence').css('display','none');

				$(document).find('#rtwmer-selling-options').css('display','none');

				$(document).find('#rtwmer-withdraw-options').css('display','none');

				$(document).find('#rtwmer-payment-gateway-options').css('display','none');

				$(document).find('.rtwmer_store_setup_menus').show();

				$(document).find('.rtwmer_store_setup_skip_btn').show();

				$(document).find('#rtwmer-general-page-submit').val(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);

				$(document).find('#rtwmer-general-page-submit').addClass('rtwmer_store_setup_page_btn_general');

				$(document).find('.rtwmer_store_setup_general_tab').addClass('rtwmer_setup_chng_background');	

				$(document).find('.rtwmer_settings_tab_wrapper').css('display','none');

				$(document).find('.rtwmer_sidbar_wrapper').css('display','none');

			})

			
			

			$(document).on('click','.rtwmer_store_setup_general_tab',function(){

				$(document).find('.rtwmer_store_setup_general_tab').addClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_withdraw_options_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_appreance_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('#rtwmer-loader-image').hide();

				$(document).find('.rtwmer_setup_welcome_page').hide();

				$(document).find('.rtwmer_store_page_section').removeClass('rtwmer_store_page_section_margin');

				$(document).find('.rtwmer_store_setup_seeling_options_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('#rtw-mercado-settings').css('display','block');

				$(document).find('.rtwmer_store_setup_menus').show();

				$(document).find('#rtwmer-general').css('display','block');

				$(document).find('#rtwmer-appearence').css('display','none');

				$(document).find('#rtwmer-selling-options').css('display','none');

				$(document).find('#rtwmer-withdraw-options').css('display','none');

				$(document).find('#rtwmer-payment-gateway-options').css('display','none');

				$(document).find('#rtwmer-selling-page-submit').addClass('rtwmer_store_setup_page_btn_selling');

				$(document).find('.rtwmer_store_setup_skip_btn').show();

				$(document).find('#rtwmer-selling-page-submit').val(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);

			});

			$(document).on('click','.rtwmer_store_setup_seeling_options_tab',function(){

				$(document).find('.rtwmer_store_setup_general_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_withdraw_options_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_appreance_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('#rtwmer-loader-image').hide();

				$(document).find('.rtwmer_setup_welcome_page').hide();

				$(document).find('.rtwmer_store_page_section').removeClass('rtwmer_store_page_section_margin');

				$(document).find('.rtwmer_store_setup_seeling_options_tab').addClass('rtwmer_setup_chng_background');

				$(document).find('#rtw-mercado-settings').css('display','block');

				$(document).find('.rtwmer_store_setup_menus').show();

				$(document).find('#rtwmer-general').css('display','none');

				$(document).find('#rtwmer-appearence').css('display','none');

				$(document).find('#rtwmer-selling-options').css('display','block');

				$(document).find('#rtwmer-withdraw-options').css('display','none');

				$(document).find('#rtwmer-payment-gateway-options').css('display','none');

				$(document).find('#rtwmer-selling-page-submit').addClass('rtwmer_store_setup_page_btn_selling');

				$(document).find('.rtwmer_store_setup_skip_btn').show();

				$(document).find('#rtwmer-selling-page-submit').val(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);

			});

			$(document).on('click','.rtwmer_store_setup_withdraw_options_tab',function(){

				$(document).find('.rtwmer_store_setup_general_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_withdraw_options_tab').addClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_appreance_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_seeling_options_tab').removeClass('rtwmer_setup_chng_background');
				$(document).find('#rtwmer-loader-image').hide();

				$(document).find('.rtwmer_setup_welcome_page').hide();

				$(document).find('.rtwmer_store_page_section').removeClass('rtwmer_store_page_section_margin');

				$(document).find('#rtw-mercado-settings').css('display','block');

				$(document).find('.rtwmer_store_setup_menus').show();

				$(document).find('#rtwmer-general').css('display','none');

				$(document).find('#rtwmer-appearence').css('display','none');

				$(document).find('#rtwmer-selling-options').css('display','none');

				$(document).find('#rtwmer-withdraw-options').css('display','block');

				$(document).find('#rtwmer-payment-gateway-options').css('display','none');

				$(document).find('#rtwmer-withdraw-option-submit').addClass('rtwmer_store_setup_page_btn_withdraw');

				$(document).find('.rtwmer_store_setup_skip_btn').show();

				$(document).find('#rtwmer-withdraw-option-submit').val(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);

			});

			$(document).on('click','.rtwmer_store_appreance_tab',function(){

				$(document).find('.rtwmer_store_setup_general_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_withdraw_options_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_appreance_tab').addClass('rtwmer_setup_chng_background');

				$(document).find('#rtwmer-loader-image').hide();

				$(document).find('.rtwmer_setup_welcome_page').hide();

				$(document).find('.rtwmer_store_page_section').removeClass('rtwmer_store_page_section_margin');

				$(document).find('.rtwmer_store_setup_seeling_options_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('#rtw-mercado-settings').css('display','block');

				$(document).find('.rtwmer_store_setup_menus').show();

				$(document).find('#rtwmer-general').css('display','none');

				$(document).find('#rtwmer-appearence').css('display','block');

				$(document).find('#rtwmer-selling-options').css('display','none');

				$(document).find('#rtwmer-withdraw-options').css('display','none');

				$(document).find('#rtwmer-payment-gateway-options').css('display','none');

				//$(document).find('#rtwmer-selling-page-submit').addClass('rtwmer_store_setup_page_btn_selling');

				$(document).find('.rtwmer_store_setup_skip_btn').show();

				$(document).find('#rtwmer-appearence-submit').val(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_launch_mercado);ß
			});

			
			$(document).on('click','.rtwmer_store_setup_page_btn_general',function(){

				$(document).find('.rtwmer_store_setup_general_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('#rtwmer-loader-image').hide();

				$(document).find('.rtwmer_setup_welcome_page').hide();

				$(document).find('.rtwmer_store_page_section').removeClass('rtwmer_store_page_section_margin');

				$(document).find('.rtwmer_store_setup_seeling_options_tab').addClass('rtwmer_setup_chng_background');

				$(document).find('#rtw-mercado-settings').css('display','block');

				$(document).find('.rtwmer_store_setup_menus').show();

				$(document).find('#rtwmer-general').css('display','none');

				$(document).find('#rtwmer-appearence').css('display','none');

				$(document).find('#rtwmer-selling-options').css('display','block');

				$(document).find('#rtwmer-withdraw-options').css('display','none');

				$(document).find('#rtwmer-payment-gateway-options').css('display','none');

				$(document).find('#rtwmer-selling-page-submit').addClass('rtwmer_store_setup_page_btn_selling');

				$(document).find('.rtwmer_store_setup_skip_btn').show();

				$(document).find('#rtwmer-selling-page-submit').val(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);

			})

			$(document).on('click','.rtwmer_store_setup_page_btn_selling',function(){

				$(document).find('.rtwmer_store_setup_general_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('#rtwmer-loader-image').hide();

				$(document).find('.rtwmer_setup_welcome_page').hide();

				$(document).find('.rtwmer_store_page_section').removeClass('rtwmer_store_page_section_margin');

				$(document).find('.rtwmer_store_setup_seeling_options_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_withdraw_options_tab').addClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_menus').show();

				$(document).find('#rtw-mercado-settings').css('display','block');

				$(document).find('#rtwmer-general').css('display','none');

				$(document).find('#rtwmer-appearence').css('display','none');

				$(document).find('#rtwmer-selling-options').css('display','none');

				$(document).find('#rtwmer-withdraw-options').css('display','block');

				$(document).find('#rtwmer-withdraw-option-submit').addClass('rtwmer_store_setup_page_btn_withdraw');

				$(document).find('.rtwmer_store_setup_skip_btn').show();

				$(document).find('#rtwmer-withdraw-option-submit').val(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_next);

			})

			$(document).on('click','.rtwmer_store_setup_page_btn_withdraw',function(){

				$(document).find('.rtwmer_store_setup_general_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('#rtwmer-loader-image').hide();

				$(document).find('.rtwmer_setup_welcome_page').hide();

				$(document).find('.rtwmer_store_page_section').removeClass('rtwmer_store_page_section_margin');

				$(document).find('.rtwmer_store_setup_seeling_options_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_withdraw_options_tab').removeClass('rtwmer_setup_chng_background');

				$(document).find('.rtwmer_store_setup_menus').show();

				$(document).find('.rtwmer_store_appreance_tab').addClass('rtwmer_setup_chng_background');

				$(document).find('#rtw-mercado-settings').css('display','block');

				$(document).find('#rtwmer-general').css('display','none');

				$(document).find('#rtwmer-appearence').css('display','block');

				$(document).find('#rtwmer-selling-options').css('display','none');

				$(document).find('#rtwmer-withdraw-options').css('display','none');

				$(document).find('#rtwmer-payment-gateway-options').css('display','none');

				$(document).find('#rtwmer-appearence-submit').addClass('rtwmer_store_setup_page_btn_appreance');

				$(document).find('.rtwmer_store_setup_skip_btn').show();

				$(document).find('#rtwmer-appearence-submit').val(rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_launch_mercado);

			})

			$(document).on('click','#rtwmer-appearence-submit',function(){

				if( $(document).find('.rtwmer_store_setup_skip_btn').css('display') == 'inline-block' || $(document).find('.rtwmer_store_setup_skip_btn').css('display') == 'inline' || $(document).find('.rtwmer_store_setup_skip_btn').css('display') == 'block' )
                {
					var rtwmer_setup_page_data = {

						'action' : 'rtwmer_setup_page_action',

						'rtwmer_setup_page_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce

					};

					jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_setup_page_data,

						function( response )

						{

							window.location.href = response;

						},"json")
				}

			})

		})

		$(document).find('.submitdelete').hide();

		function rtwmer_dashboard_report()
		{

			var rtwmer_dashboard_data = {

				'action' : 'rtwmer_dashboard_page_action',

				'rtwmer_dashboard_page_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce

			};

			jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_dashboard_data,

				function( response )

				{
					
					$('#rtwmer-loader-image').hide();

					if(response != "")

					{

						$(document).find('#rtwmer_total_sold_product_amount').html(response['rtwmer_dashboard_report_section_data']['rtwmer_total_sold_product_amount']);

						$(document).find('#rtwmer_get_monthly_created_product').html(response['rtwmer_dashboard_report_section_data']['rtwmer_get_monthly_created_product']);

						$(document).find('#rtwmer_get_monthly_created_vendor').html(response['rtwmer_dashboard_report_section_data']['rtwmer_get_monthly_created_vendor']);

						$(document).find('#rtwmer_unapproved_vendors').html(response['rtwmer_dashboard_report_section_data']['rtwmer_unapproved_vendors']);

						$(document).find('#rtwmer_unapproved_withdraw_requests').html(response['rtwmer_dashboard_report_section_data']['rtwmer_unapproved_withdraw_requests']);

						$(document).find('#rtwmer_admin_commission_value').html(response['rtwmer_dashboard_report_section_data']['rtwmer_admin_commission_value']);

						$(document).find('#rtwmer_total_sold_product').html(response['rtwmer_dashboard_report_section_data']['rtwmer_total_sold_product']);

						$(document).find('#rtwmer_total_orders_count').html(response['rtwmer_dashboard_report_section_data']['rtwmer_total_orders_count']);

						var i, rtwmer_table = "<table class=' mdl-data-table'>";

						rtwmer_table += "<thead><tr><th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_name+"</strong></th>";

						rtwmer_table += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_vendor+"</strong></th>";

						rtwmer_table += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_sold+"</strong></th>";

						rtwmer_table += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_total_sale_amount+"</strong></th>";

						rtwmer_table += "</tr></thead>";
						
						for( i=0; i < response['rtwmer_top_selling_products_array'].length; i++ )
						{

							rtwmer_table += '<tr><td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_title'] + '</strong></td>';

							rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_user_store_name'] + '</strong></td>'

							rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_quantity'] + '</strong></td>'

							rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_price'] + '</strong></td>'

							rtwmer_table += '</tr>';

						}

						rtwmer_table += "</table>";

						$(document).find('#rtwmer_dashboard_top_selling_products').html(rtwmer_table);

						var j, rtwmer_table1 = "<table class='widefat'>";

						rtwmer_table1 += "<thead><tr><th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_vendor_store_name+"</strong></th>";

						rtwmer_table1 += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_completed+"</strong></th>";

						rtwmer_table1 += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_sold+"</strong></th>";

						rtwmer_table1 += "</tr></thead>";

						for( j=0; j < response['rtwmer_top_sellers'].length; j++ )

						{

							rtwmer_table1 += '<tr><td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_user_store_name'] + '</strong></td>';

							rtwmer_table1 += '<td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_number_of_orders_by_vendors_count'] + '</strong></td>'

							rtwmer_table1 += '<td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_item_count_by_top_sellers_data'] + '</strong></td>'

							rtwmer_table1 += '</tr>';

						}

						rtwmer_table1 += "</table>";

						$(document).find('#rtwmer_dashboard_top_sellers').html(rtwmer_table1);

					}

				},"json");

		}

		function rtmwer_dashboard_chart()

		{

			var date = new Date(); 

			var month = date.getMonth();

			date.setDate(1);

			var all_days = [];

			while (date.getMonth() == month) {

			  var d = date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate().toString().padStart(2, '0');

			  all_days.push(d);

			  date.setDate(date.getDate() + 1); 

			}

			/* line chart */

			var rtwmer_count_data = {

			  'action' : 'rtwmer_chart_data_action',

			  'rtwmer_chart_data_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce

		  };

		  jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_count_data,

			  function( response ){

				if( response != "" )

				{

				  if (jQuery("#rtwmer_total_sales_per_day").length) {

					var ctx = document.getElementById("rtwmer_total_sales_per_day").getContext('2d');

					var bar = new Chart(ctx, {

					  type: 'line',

					  data: {

						labels: all_days,

						datasets: [{

						  label: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_number_of_orders],

						  data: response['rtwmer_order_count'],

						  backgroundColor:["rgba(255,255,255,0)"],

						  borderColor: [

						  '#058fd2'

						  ],

						  borderWidth: 2,

						},

						{

						  label: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_total_product],

						  data: response['rtwmer_product_count'],

						  backgroundColor:["rgba(255,255,255,0)"],

						  borderColor: [

						  '#28a745'

						  ],

						  borderWidth: 2,

						},

						{

						label: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_commission],

						data: response['rtwmer_commission_count'],

						backgroundColor:["rgba(255,255,255,0)"],

						borderColor: [

						'#ffc107'

						],

						borderWidth: 2,

					  }]

					  },

					  options: {

						responsive: true,
						maintainAspectRatio: false,

						scales: {

						  yAxes: [{

							barPercentage: .1,

							ticks: {

							  beginAtZero:true,

							}

						  }],

						  xAxes: [{

							type: 'time',

							time: {

								unit: 'day'

							}

						}]

						}

					  }

					});

				  }

				}

			  },'json');
		}

})( jQuery );

