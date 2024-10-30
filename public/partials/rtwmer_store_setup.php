
<!-- This file contains the html for store setup page -->



<input type="hidden" name="none" class="rtwmer_setup" id="rtwmer_setup_page">
<div class="rtwmer_store_setup_wizzard_body">
	<img id="rtwmer_store_setup_image" src="<?php echo RTWMER_PUBLIC_IMAGES_URL.'store-setup-banner.jpg' ?>">
	<div class="rtwmer_start_up">
		<h2 class="rtwmer_heading_store"><?php esc_html_e("Welcome to " . get_bloginfo('name'), "rtwmer-mercado")  ?></h2>
		<h3 class="rtwmer-sub-heading-1"><?php esc_html_e(get_bloginfo('description'), "rtwmer-mercado") ?></h3>
		<?php 
		$rtwmer_general_page_options = get_option('rtwmer_general_setting');
		$rtwmer_store_setup_instructions = "";
		if( is_array($rtwmer_general_page_options) && ! empty($rtwmer_general_page_options) )
		{
			if( isset($rtwmer_general_page_options['rtwmer_store_setup_instruction']) )
			{
				$rtwmer_store_setup_instructions = $rtwmer_general_page_options['rtwmer_store_setup_instruction'];
			}
		}
			
		echo esc_html($rtwmer_store_setup_instructions); 
		?>
		<button class="rtwmer_start_setup mdc-button mdc-button--raised mdc-button--upgraded"><?php esc_html_e("Let's Start!", "rtwmer-mercado"); ?></button>
  	</div>
  	<div class="rtwmer_store_setup_settings_sec rtwmer_hide_imp">
		<div class="mdc-tab-bar" role="tablist">
			<div class="mdc-tab-scroller">
				<div class="mdc-tab-scroller__scroll-area mdc-tab-scroller__scroll-area--scroll">
					<div class="mdc-tab-scroller__scroll-content">
						<button class="mdc-tab mdc-tab--active rtwmer_tab_active rtwmer_store_tabs rtwmer_general_details_btn"
						 role="tab" aria-selected="true" tabindex="0" data-section="rtwmer_store_setup_general">
							<span class="mdc-tab__content">
								<span class="mdc-tab__icon material-icons" aria-hidden="true"><?php esc_html_e("store", "rtwmer-mercado")?></span>
								<span class="mdc-tab__text-label"><?php esc_html_e("General", "rtwmer-mercado")?></span>
							</span>
							<span class="mdc-tab-indicator mdc-tab-indicator--active">
								<span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
							</span>
							<span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
						</button>
						<button class="mdc-tab rtwmer_store_tabs rtwmer_payment_details_btn" role="tab" aria-selected="false" tabindex="-1" data-section="rtwmer_store_setup_payment">
							<span class="mdc-tab__content">
								<span class="mdc-tab__icon material-icons" aria-hidden="true"><?php esc_html_e("payment", "rtwmer-mercado")?></span>
							<span class="mdc-tab__text-label"><?php esc_html_e("Payment", "rtwmer-mercado")?></span></span>
							<span class="mdc-tab-indicator">
								<span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
							</span><span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="rtwmer_setup_section_wrapper">
			<h2 class="rtwmer_store_setup_heading">Setup your store</h2>
			<div class="rtwmer_store_setup_general rtwmer_setup_section">
				<div id="rtwmer_store_setting_setup">
					<!-- store setup form -->
					<div class="rtwmer-store-form">           
						<ul class="mdc-list">
							<li class="rtwmer-w-100">
								<div class="rtwmer_store_banner_sec">
									<div class="rtwmer_store_setup_banner">
										<img id='rtwmer_store_banner_preview' src=''>
									</div>
									<div class="rtwmer_store_banner_box">
										<input id="rtwmer_store_banner_upload_button" name="rtwmer_banner_image_upload" type="button" class="mdc-button mdc-button--raised mdc-button--upgraded button" value="<?php esc_html_e('Upload image', "rtwmer_mercado"); ?>" />
										<input type='hidden' name='rtwmer_store_setup_banner_id' id='rtwmer_store_setup_img_id'>
									</div>
								</div>
							</li>
							<li class="rtwmer-w-100">
								<div class="rtwmer_store_setup_image_sec">
									<div class="rtwmer_store_setup_profile">
									<img id='rtwmer_store_setup_profile' src=''>
									</div>
										<div class="rtwmer_store_profile_box">
											<input id="rtwmer_store_profile_upload_button" name="rtwmer_image_profile_upload" type="button" class="mdc-button mdc-button--raised mdc-button--upgraded button" value="<?php esc_html_e('Upload image', "rtwmer-mercado"); ?>" />
											<input type='hidden' name='rtwmer_store_profile_id' id='rtwmer_store_profile_id' value=''>
										</div>
								</div>
							</li>
							<li class="rtwmer-w-100">
								<label><?php esc_html_e("Store Product Per Page","rtwmer-mercado") ?></label>
								<input type="number" class="rtwmer_store_setup_field" id="rtwmer_store_setup_ppp" name="store_ppp" value="">
							</li> 
							<li>
								<label><?php esc_html_e("Street 1st","rtwmer-mercado") ?></label>
								<input type="text" class="rtwmer_store_setup_field" id="rtwmer_setup_address_one" name="address[street_1]" value="">
							</li> 
							<li>
								<label><?php esc_html_e("Street 2nd","rtwmer-mercado") ?></label>
								<input type="text" class="rtwmer_store_setup_field" id="rtwmer_setup_address_two" name="address[street_2]" value="">
							</li>
							
							<li>
								<label><?php esc_html_e("Countries","rtwmer-mercado") ?></label>
								<span><div class="form-row rtwmer_country" id="rtwmer_setup_country_field" data-priority="">
									<span class="woocommerce-input-wrapper">
									<?php

								
										global $woocommerce;
									$countries_obj   = new WC_Countries();
									$countries   = $countries_obj->__get('countries');

									woocommerce_form_field('rtwmer_setup_country', array(
									'type'       => 'select',
									'class'      => array( 'rtwmer_country' ),
									'options'    => $countries
									)
									);

								?>
								
							</li>
							<li>
								<label><?php esc_html_e("State","rtwmer-mercado") ?></label>
								<input type="text" class="rtwmer_store_setup_field" id="rtwmer_setup_calc_shipping_state" name="address[state]" value="">
							</li>
							<li>
								<label><?php esc_html_e("City","rtwmer-mercado") ?></label>
								<input type="text" class="rtwmer_store_setup_field" id="rtwmer_setup_address_city" name="address[city]" value="">
							</li> 
							<li>
								<label><?php esc_html_e("Post/Zip Code","rtwmer-mercado") ?></label>
								<input type="text" class="rtwmer_store_setup_field" id="rtwmer_setup_address_zip" name="address[zip]" value="">
							</li>
							<li class="rtwmer-w-100">
								<label><?php esc_html_e("Phone","rtwmer-mercado") ?></label>
								<input type="text" class="rtwmer_store_setup_field" id="rtwmer_setup_vendor_phone" name="rtwmer_vendor_phone" value="0">
							</li>
							
							<li>
								<label><?php esc_html_e("Store notice","rtwmer-mercado") ?></label>
								<input type="text" class="rtwmer_store_setup_field rtwmer_notice rtwmer_store_extra_field" id="rtwmer_notice_setting" name="rtwmer_notice" value="">
							</li>
							<li>
								<label><?php esc_html_e("Map","rtwmer-mercado") ?></label>
								<input type="text" class="rtwmer_store_setup_field rtwmer_map_key" id="rtwmer_setup_map_api_key" name="rtwmer_map_key" value="">
							</li>
							<li class="rtwmer-w-100">
								<span class="rtwmer-d-flex">
									<div class="mdc-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
										<input type="checkbox" class="mdc-checkbox__native-control switch-input" name="show_email" id="rtwmer_setup_show_email"><div class="mdc-checkbox__background">
										<svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
											<path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
										</svg>
										<div class="mdc-checkbox__mixedmark"></div>
										</div>
										<div class="mdc-checkbox__ripple"></div>
									</div>
									<p><?php esc_html_e("Show email address in store","rtwmer-mercado") ?></p>
								</span>
							</li>
							<li class="rtwmer-w-100">
								<span class="rtwmer-d-flex">
									<div class="mdc-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
										<input type="checkbox" name="show_email" id="rtwmer_setup_show_more_tab" class="mdc-checkbox__native-control"><div class="mdc-checkbox__background">
										<svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
											<path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
										</svg>
										<div class="mdc-checkbox__mixedmark"></div>
										</div>
										<div class="mdc-checkbox__ripple"></div>
									</div>
									<p><?php esc_html_e("Enable tab on product single page view","rtwmer-mercado") ?></p>
								</span>
							</li>
							
							<li class="rtwmer-w-100">
								<span class="rtwmer-d-flex">
									<div class="mdc-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
										<input type="checkbox" class="mdc-checkbox__native-control rtwmer_switch-input" name="show_time_widget" id="rtwmer_setup_show_time_widget"><div class="mdc-checkbox__background">
										<svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
											<path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
										</svg>
										<div class="mdc-checkbox__mixedmark"></div>
										</div>
										<div class="mdc-checkbox__ripple"></div>
									</div>
									<p><?php esc_html_e("Show store opening closing time widget in store page","rtwmer-mercado") ?></p>
								</span>
							</li>
							<div class="rtwmer_modal">
								<div class="rtwmer_setup_days_box mdc-elevation--z9 rtwmer-modal-dialog">
									<div class="rtwmer-store-close-btn rtwmer-modal-header">
										<a class="mdc-icon-button material-icons mdc-ripple-upgraded rtwmer-modal-close mdc-ripple-upgraded--unbounded" aria-pressed="false">highlight_off</a>
									</div>
									<div class="rtwmer-date-modal-content">
										<div class="rtwmer_setup_day_row">
											<span class="rtwmer_days_span"><?php esc_html_e("Sunday","rtwmer-mercado") ?></span>
											<select class="rtwmer_setup_days" id="rtwmer_setup_sunday">
												<option value="close"><?php esc_html_e("close","rtwmer-mercado") ?></option>
												<option value="open"><?php esc_html_e("Open","rtwmer-mercado") ?></option>
											</select>
											<div class="rtwmer_setup_timing" style="display: none;">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_sunday_open_time" name="rtwmer_sunday_open_time" placeholder="Select time From" value="">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_sunday_close_time" name="rtwmer_sunday_close_time" placeholder="Select time To" value="">
											</div>
										</div>
										<div class="rtwmer_setup_day_row">
											<span class="rtwmer_days_span"><?php esc_html_e("Monday","rtwmer-mercado") ?></span>
											<select class="rtwmer_setup_days" id="rtwmer_setup_monday">
												<option value="open"><?php esc_html_e("Open","rtwmer-mercado") ?></option>
												<option value="close"><?php esc_html_e("close","rtwmer-mercado") ?></option>
											</select>
											<div class="rtwmer_setup_timing"><input type="text" class="rtwmer_timing_input" id="rtwmer_monday_open_time" name="rtwmer_monday_open_time" placeholder="Select time From" value="">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_monday_close_time" name="rtwmer_monday_close_time" placeholder="Select time To" value="">
											</div>
										</div>
										<div class="rtwmer_setup_day_row">
											<span class="rtwmer_days_span">
												<?php esc_html_e("Tuesday","rtwmer-mercado") ?>
											</span>
											<select class="rtwmer_days" id="rtwmer_setup_tuesday">
												<option value="open"><?php esc_html_e("open","rtwmer-mercado") ?></option>
												<option value="close"><?php esc_html_e("close","rtwmer-mercado") ?></option>
											</select>
											<div class="rtwmer_setup_timing">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_tuesday_open_time" name="rtwmer_tuesday_open_time" placeholder="Select time From" value="">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_tuesday_close_time" name="rtwmer_tuesday_close_time" placeholder="Select time To" value="">
											</div>
										</div>
										<div class="rtwmer_setup_day_row">
											<span class="rtwmer_days_span">
												<?php esc_html_e("Wednesday","rtwmer-mercado") ?>
											</span>
											<select class="rtwmer_days" id="rtwmer_setup_wednesday">
												<option value="open"><?php esc_html_e("Open","rtwmer-mercado") ?></option>
												<option value="close"><?php esc_html_e("close","rtwmer-mercado") ?></option>
											</select>
											<div class="rtwmer_setup_timing">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_wednesday_open_time" name="rtwmer_wednesday_open_time" placeholder="Select time From" value="">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_wednesday_close_time" name="rtwmer_wednesday_close_time" placeholder="Select time To" value="">
											</div>
										</div>
										<div class="rtwmer_setup_day_row">
											<span class="rtwmer_days_span">
												<?php esc_html_e("Thursday","rtwmer-mercado") ?>
											</span>
											<select class="rtwmer_days" id="rtwmer_setup_thursday">
												<option value="open"><?php esc_html_e("Open","rtwmer-mercado") ?></option>
												<option value="close"><?php esc_html_e("close","rtwmer-mercado") ?></option>
											</select>
											<div class="rtwmer_setup_timing">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_thursday_open_time" name="rtwmer_thursday_open_time" placeholder="Select time From" value="">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_thursday_close_time" name="rtwmer_thursday_close_time" placeholder="Select time To" value="">
											</div>
										</div>
										<div class="rtwmer_setup_day_row">
											<span class="rtwmer_days_span">
												<?php esc_html_e("Friday","rtwmer-mercado") ?>
											</span>
											<select class="rtwmer_days" id="rtwmer_setup_friday">
												<option value="open"><?php esc_html_e("open","rtwmer-mercado") ?></option>
												<option value="close"><?php esc_html_e("close","rtwmer-mercado") ?></option>
											</select>
											<div class="rtwmer_setup_timing">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_friday_open_time" name="rtwmer_friday_open_time" placeholder="Select time From" value="">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_friday_close_time" name="rtwmer_friday_close_time" placeholder="Select time To" value="">
											</div>
										</div>

										<div class="rtwmer_setup_day_row">
											<span class="rtwmer_days_span">
												<?php esc_html_e("Saturday","rtwmer-mercado") ?>
											</span>
											<select class="rtwmer_days" id="rtwmer_setup_saturday">
												<option value="open"><?php esc_html_e("open","rtwmer-mercado") ?></option>
												<option value="close"><?php esc_html_e("close","rtwmer-mercado") ?></option>
											</select>
											<div class="rtwmer_setup_timing">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_saturday_open_time" name="rtwmer_saturday_open_time" placeholder="Select time From" value="">
												<input type="text" class="rtwmer_timing_input" id="rtwmer_saturday_close_time" placeholder="Select time To" name="rtwmer_saturday_close_time" value="">
											</div>
										</div>
										<div class="rtwmer-d-flex">
											<label class="rtwmer_time_widgets">
											<?php esc_html_e("Store Open Notice","rtwmer-mercado") ?>
											</label>
											<span>
												<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
													<input type="text" class="mdc-text-field__input" id="rtwmer_store_open_notice" name="rtwmer_store_open_notice" value="Store is open"><div class="mdc-notched-outline mdc-notched-outline--upgraded mdc-notched-outline--notched">
														<div class="mdc-notched-outline__leading"></div>
														<div class="mdc-notched-outline__notch" style="width: 95.75px;">
														<span class="mdc-floating-label mdc-floating-label--float-above" style=""><?php esc_html_e("Store Open Notice","rtwmer-mercado") ?></span>
														</div>
														<div class="mdc-notched-outline__trailing"></div>
													</div>
												</label>
											</span>
										</div>
										<div class="rtwmer-d-flex">
											<label class="rtwmer_time_widgets">
											<?php esc_html_e("Store close notice","rtwmer-mercado") ?></label>
											<span>
												<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
													<input type="text" class="mdc-text-field__input" id="rtwmer_store_close_notice" name="rtwmer_store_close_notice" value="Store is close"><div class="mdc-notched-outline mdc-notched-outline--upgraded mdc-notched-outline--notched">
														<div class="mdc-notched-outline__leading"></div>
														<div class="mdc-notched-outline__notch" style="width: 93.5px;">
														<span class="mdc-floating-label mdc-floating-label--float-above" style=""><?php esc_html_e("Store close notice","rtwmer-mercado") ?></span>
														</div>
														<div class="mdc-notched-outline__trailing"></div>
													</div>
												</label>
											</span>
										</div>
									</div>
									<div class="rtwmer-store-submit-btn rtwmer-modal-footer">
										<button class="rtwmer-modal-close mdc-button mdc-button--raised mdc-button--upgraded mdc-ripple-upgraded"><?php esc_html_e("Save","rtwmer-mercado") ?></button>
									</div>
								</div>
							</div>
						</ul>
					</div>
				</div>
			</div>
			<div class="mdc-elevation--z4 rtwmer_store_setup_payment rtwmer_setup_section">
				<p class="rtwmer-text-margin">
				<?php esc_html_e("These are the withdraw methods available for you. Please update your payment information below to submit withdraw requests and get your store payments seamlessly.", "rtwmer-mercado")  ?>
				</p>
				<div class="mdc-elevation--z4 rtwmer-payment-input-box">
					<?php
					$rtwmer_method = get_option("rtwmer_payment_gateway");
					// $gateways = WC()->payment_gateways->get_available_payment_gateways();

					if($rtwmer_method && !empty($rtwmer_method)){
						$rtwrre_paypal = (isset($rtwmer_method['rtwmer_withdraw_paypal']) && $rtwmer_method['rtwmer_withdraw_paypal'] == 1) ? True : False;
						$rtwrre_bank_transfer = (isset($rtwmer_method['rtwmer_withdraw_bank']) && $rtwmer_method['rtwmer_withdraw_bank'] == 1) ? True : False;
						$rtwrre_stripe = (isset($rtwmer_method['rtwmer_withdraw_stripe']) && $rtwmer_method['rtwmer_withdraw_stripe'] == 1) ?  True : False;
					}else{
						$rtwrre_paypal = true;
						$rtwrre_bank_transfer = true;
						$rtwrre_stripe = true;
					}
					if($rtwrre_stripe){
						?>
						<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
							<input type="text" class="mdc-text-field__input rtwmer-setup-stripe-paypal" id="rtwmer_setup_payment_stripe" name="stripe">
							<div class="mdc-notched-outline mdc-notched-outline--upgraded">
								<div class="mdc-notched-outline__leading"></div>
								<div class="mdc-notched-outline__notch">
								<span class="mdc-floating-label"><?php esc_html_e("Stripe", "rtwmer-mercado") ?></span>
								</div>
								<div class="mdc-notched-outline__trailing"></div>
							</div>
						</label>
					</div>
					<?php 
					}
					if($rtwrre_paypal){
					?>
					<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
						<input type="text" class="mdc-text-field__input rtwmer-setup-payment-paypal" id="rtwmer_setup_payment_paypal_email" name="paypal">
						<div class="mdc-notched-outline mdc-notched-outline--upgraded">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							<span class="mdc-floating-label"><?php esc_html_e("Email", "rtwmer-mercado") ?></span>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						</div>
						</label>
					</div>
					<?php
					}
					if($rtwrre_bank_transfer){
					?>
					<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
						<input type="text" class="mdc-text-field__input rtwmer-setup-payment-body" id="rtwmer_setup_payment_account_name" name="account_name">
						<div class="mdc-notched-outline mdc-notched-outline--upgraded">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							<span class="mdc-floating-label"><?php esc_html_e("Account name", "rtwmer-mercado") ?></span>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						</div>
						</label>
					</div>
					<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
						<input type="text" class="mdc-text-field__input rtwmer-setup-payment-body" id="rtwmer_setup_payment_account_no" name="account_no">
						<div class="mdc-notched-outline mdc-notched-outline--upgraded">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							<span class="mdc-floating-label"><?php esc_html_e("Account no", "rtwmer-mercado") ?></span>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						</div>
						</label>
					</div>
					<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
						<input type="text" class="mdc-text-field__input rtwmer-setup-payment-body" id="rtwmer_setup_payment_bank_name" name="bank_name">
						<div class="mdc-notched-outline mdc-notched-outline--upgraded">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							<span class="mdc-floating-label"><?php esc_html_e("Bank name", "rtwmer-mercado") ?></span>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						</div>
						</label>
					</div>
					<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
						<input type="text" class="mdc-text-field__input rtwmer-setup-payment-body" id="rtwmer_setup_payment_bank_place" name="bank_place">
						<div class="mdc-notched-outline mdc-notched-outline--upgraded">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							<span class="mdc-floating-label"><?php esc_html_e("Bank place", "rtwmer-mercado") ?></span>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						</div>
						</label>
					</div>
					<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
						<input type="text" class="mdc-text-field__input rtwmer-setup-payment-body" id="rtwmer_setup_payment_routing_no" name="routing_no">
						<div class="mdc-notched-outline mdc-notched-outline--upgraded">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							<span class="mdc-floating-label"><?php esc_html_e("Routing no.", "rtwmer-mercado") ?></span>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						</div>
						</label>
					</div>
					<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
						<input type="text" class="mdc-text-field__input rtwmer-setup-payment-body" id="rtwmer_setup_payment_iban" name="IBAN">
						<div class="mdc-notched-outline mdc-notched-outline--upgraded">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							<span class="mdc-floating-label"><?php esc_html_e("IBAN", "rtwmer-mercado") ?></span>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						</div>
						</label>
					</div>
					<div class="rtwmer-input_padding_setup">
						<label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100 rtwmer_payment_field">
						<input type="text" class="mdc-text-field__input rtwmer-setup-payment-body" id="rtwmer_setup_payment_swift_code" name="swift_code">
						<div class="mdc-notched-outline mdc-notched-outline--upgraded">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							<span class="mdc-floating-label"><?php esc_html_e("swift_code", "rtwmer-mercado") ?></span>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						</div>
						</label>
					</div>
					<?php
					} 
					?>
					<div class="rtwmer_setup_submit">
						<button href="#payment" id="rtwmer_setup_payment_submit" class="rtwmer_setup_payment_submit_button mdc-button mdc-button--raised mdc-button--upgraded">
						<?php esc_html_e("Submit", "rtwmer-mercado") ?>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="rtwmer_store_next_btn_wrapper">
			<button  class="rtwmer_store_tabs rtwmer_store_next_btn  mdc-button mdc-button--raised mdc-button--upgraded" data-section="rtwmer_store_setup_payment">
				<?php esc_html_e("Next", "rtwmer-mercado") ?>
			</button>
		</div>
  	</div>
</div>