<?php
// This File used to display vendor's list at admin dashboard end
?>
<div class="rtwmer_mercado_vendor_product">
	
	<?php
	do_action('rtwmer_mercado_vendors_product');
		include_once(RTWMER_ADMIN_PARTIAL_MENU . 'rtwmer-mercado-vendor_product.php');
	?>

</div>
<div class="rtwmer_mercado_vendor_orders">

	<?php
	do_action('rtwmer_mercado_order_page');
		include_once(RTWMER_ADMIN_PARTIAL_MENU . 'rtwmer-mercado-vendor_orders.php');
	?>

</div>
<?php

if (!empty(get_option('rtwmer_sort_by_vend_status'))) {

	$rtwmer_sort_by_vend_status = get_option('rtwmer_sort_by_vend_status');

	if (isset($rtwmer_sort_by_vend_status) && !empty($rtwmer_sort_by_vend_status)) {
?>
		<input type="hidden" id="rtwmer_sort_by_vend_status_save" value="<?php echo esc_html($rtwmer_sort_by_vend_status); ?>">
<?php
	}
}

?>
<div class="rtwmer_vendors_details">
	<div class="rtwmer_bulk_action">
		

		<div class="rtwmer_prod_sorting rtwmer_vendor_chang" id="rtwmer-prod-sorting-tabs">

			<?php
			
			$rtwmer_vendor_sorting_tab = array(
				"<a href='#' id='rtwmer_vendor_sort_all_vend' class='mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_vendor_status' data-value='all_vend'>".esc_html__('All', 'rtwmer-mercado')."</a>",
				"<a href='#' id='rtwmer_vendor_sort_approve' class='mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_vendor_status' data-value='approve'>".esc_html__('Approved', 'rtwmer-mercado')."</a>",
				"<a href='#' id='rtwmer_vendor_sort_disable' class='mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_vendor_status' data-value='disable'>".esc_html__('Disabled', 'rtwmer-mercado')."</a>"
			);
			if( isset($rtwmer_vendor_sorting_tab) && is_array($rtwmer_vendor_sorting_tab) )
			{
				$rtwmer_vendor_sorting_tab = apply_filters('rtwmer_vendor_sorting_tab',$rtwmer_vendor_sorting_tab);
				if( isset($rtwmer_vendor_sorting_tab) && is_array($rtwmer_vendor_sorting_tab) )
				{
					foreach($rtwmer_vendor_sorting_tab as  $tabs)
					{
						if( isset($tabs) )
						{
							//====$tabs contains html==//
							echo $tabs;						
						}
					}
				}
			}
			?>

		</div>

		<select name="action" id="rtwmer_vendor_bulk_action" class='rtwmer-select-text'>
			<option value="rtwmer_not_selected"><?php esc_html_e('Bulk Actions', 'rtwmer-mercado'); ?></option>
			<option value="rtwmer_approve_vendor"><?php esc_html_e('Approve Vendors', 'rtwmer-mercado'); ?></option>
			<option value="rtwmer_disable_selling"><?php esc_html_e('Disable Vendors', 'rtwmer-mercado'); ?></option>
		</select>
		<button class="mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_vendor_apply_bulk" id="rtwmer_vendor_apply_bulk">
			<span class="mdc-button__label"><?php esc_html_e('Apply', 'rtwmer-mercado'); ?></span>
			<div class="mdc-button__ripple"></div>
        </button>
		<a href="#/vendor" id="rtwmer_add_new_vend" class="rtwmer_add_new_vend mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded" data-target="#rtwmer-add-new-vend-modal"><?php esc_html_e('Add New', 'rtwmer-mercado'); ?></a>
		<?php do_action('rtwmer_add_extra_features_btn'); ?>
	</div>

	<table id="rtwmer_vendors_table" class="rtwmer_vendors_table mdl-data-table">

		<thead>
			<tr>
				<th class="mdc-data-table__cell mdc-data-table__cell--checkbox">
					<div class="mdc-checkbox  mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
						<input type="checkbox" class="mdc-checkbox__native-control rtwmer_outer_checkbox">
						<div class="mdc-checkbox__background">
						<svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
							<path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
						</svg>
						<div class="mdc-checkbox__mixedmark"></div>
						</div>
						<div class="mdc-checkbox__ripple"></div>
					</div>
				</th>
				<th><?php esc_html_e('Store', 'rtwmer-mercado'); ?></th>
				<th><?php esc_html_e('Email', 'rtwmer-mercado'); ?></th>
				<th><?php esc_html_e('Phone', 'rtwmer-mercado'); ?></th>
				<th><?php esc_html_e('Registered', 'rtwmer-mercado'); ?></th>
				<th><?php esc_html_e('Status', 'rtwmer-mercado'); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="mdc-data-table__cell mdc-data-table__cell--checkbox">
					<div class="mdc-checkbox  mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
						<input type="checkbox" class="mdc-checkbox__native-control rtwmer_outer_checkbox">
						<div class="mdc-checkbox__background">
						<svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
							<path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
						</svg>
						<div class="mdc-checkbox__mixedmark"></div>
						</div>
						<div class="mdc-checkbox__ripple"></div>
					</div>
				</th>
				<th><?php esc_html_e('Store', 'rtwmer-mercado'); ?></th>
				<th><?php esc_html_e('Email', 'rtwmer-mercado'); ?></th>
				<th><?php esc_html_e('Phone', 'rtwmer-mercado'); ?></th>
				<th><?php esc_html_e('Registered', 'rtwmer-mercado'); ?></th>
				<th><?php esc_html_e('Status', 'rtwmer-mercado'); ?></th>
			</tr>
		</tfoot>
	</table>

	<div class="rtwmer-modal" id="rtwmer-add-new-vend-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="rtwmer-modal-dialog rtwmer-add-new-modal-dialog" role="document">
			<div class="rtwmer-modal-content">
				<div class="rtwmer-modal-header">
					<h5 class="rtwmer-modal-title"><?php esc_html_e('Add New Vendor', 'rtwmer-mercado'); ?></h5>
					<button  class="mdc-button rtwmer-modal-close">
					<i class="material-icons" aria-hidden="true"><?php echo esc_html('highlight_off'); ?></i>
					</button>
				</div>
				<div class="rtwmer-modal-body">
					<div id="rtwmer-btn-section">
						<button type='button' id="rtwmer-add-new-vend-store-details" class="mdc-button mdc-button--raised  mdc-ripple-upgraded rtwmer-add-new-vend-nav-items active">
							<span class="mdc-button__label"><?php esc_html_e('Store Details', 'rtwmer-mercado'); ?></span>
							<div class="mdc-button__ripple"></div>
						</button>
						<button type='button' id="rtwmer-add-new-vend-store-address" class="mdc-button mdc-button--raised  mdc-ripple-upgraded rtwmer-add-new-vend-nav-items">
							<span class="mdc-button__label"><?php esc_html_e('Store Address', 'rtwmer-mercado'); ?></span>
							<div class="mdc-button__ripple"></div>
						</button>
						<button type='button' id="rtwmer-add-new-vend-store-pymnt" class="mdc-button mdc-button--raised  mdc-ripple-upgraded rtwmer-add-new-vend-nav-items">
							<span class="mdc-button__label"><?php esc_html_e('Payments & Commission', 'rtwmer-mercado'); ?></span>
							<div class="mdc-button__ripple"></div>
						</button>
					</div>

					<div class="py-4 px-3" id="rtwmer-vend-add-new-img">
						<div class="rtwmer-row">
							<div class="rtwmer-col-4">
								<div class="rtwmer-out-border">
									<div class="rtwmer-inner-div">
										<div class="rtwmer-gravitor-section">
										<img src="http://2.gravatar.com/avatar/5d196920be0c3ceda0f9e266aeef4bfe?s=96&amp;d=mm&amp;r=g" class="rtwmer-gravitor" alt="image">
										</div>
										<p> <?php esc_html_e('You can change your picture on ', 'rtwmer-mercado'); ?><a href="https://gravatar.com/" target="_blank" class="text-success"><?php esc_html_e('Gravitor '); ?></a></p>
									</div>
								</div>
							</div>	
							<div class="rtwmer-col-8">
								<div class="rtwmer-out-border">
									<div class="rtwmer-vendor-inner-div">
										<div class="rtwmer-img-vrndor-store">
										<img class='rtwmer_vendor_img_pre' src='<?php echo esc_url(wp_get_attachment_url()); ?>'>
										</div>
										<a  href="#" class="mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_vendor_store_img rtwmer_store_img_chng"  role="button" aria-pressed="true">
											<div class="mdc-button__ripple"></div>
											<span class="mdc-button__label">  <?php esc_html_e('Upload Banner', 'rtwmer-mercado'); ?></span>
        								</a>
										<input type="hidden" class="rtwmer_vendor_img_id" value="">
										<p> <?php esc_html_e('Upload banner for your store. Banner size is (625x300)pixels.', 'rtwmer-mercado'); ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="py-4 px-3 rtwmer_vendoradd_store_detail_section">
						<div class="mdc-elevation--z3 rtwmer-vendor-store-section-page">
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer-add-new-vend-fname">
									<input type="text" class="mdc-text-field__input" id='rtwmer-add-new-vend-fname'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('First name', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer-add-new-vend-lname">
									<input type="text" class="mdc-text-field__input" id='rtwmer-add-new-vend-lname'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
											<span class="mdc-floating-label"><?php esc_html_e('Last name', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for='rtwmer-add-vend-store-name'>
									<input type="text" class="mdc-text-field__input" id='rtwmer-add-vend-store-name'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Store name', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer-add-new-vend-store-url">
									<input type="text" class="mdc-text-field__input" id="rtwmer-add-new-vend-store-url">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Store URL', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer-add-new-vend-phone">
									<input type="text" class="mdc-text-field__input" id="rtwmer-add-new-vend-phone">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Phone Number', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer-add-new-vend-email">
									<input type="text" class="mdc-text-field__input" id='rtwmer-add-new-vend-email'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Email', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_add_new_vend_uname">
									<input type="text" class="mdc-text-field__input" id='rtwmer_add_new_vend_uname'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Username', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<div class= "rtwmer_addnew_vend_label">
									<div class="rtwmer_add_new_vend_passwrd_show position-relative">
										<input type="text" class="p-2 effect-21 rounded shadow-none border" id="rtwmer_add_new_vend_passwrd">
										<label for="rtwmer_add_new_vend_passwrd"><?php esc_html_e('Password', 'rtwmer-mercado'); ?></label>
										<span class="focus-border">
										</span>
									</div>
									<div class="password-generator">
										<button class="mdc-button mdc-button--outlined inline-demo-button mdc-ripple-upgraded rtwmer_pass_generator">
											<span class="mdc-button__label"><?php esc_html_e('Generate Password', 'rtwmer-mercado'); ?></span>
											<div class="mdc-button__ripple"></div>
										</button>
										<button class="mdc-button mdc-button--outlined inline-demo-button mdc-ripple-upgraded  rtwmer_pass_generator_cancel" id="rtwmer_pass_generator_cancel_click">
											<span class="mdc-button__label"><?php esc_html_e('Cancel', 'rtwmer-mercado'); ?></span>
											<div class="mdc-button__ripple"></div>
										</button>
									</div>
								</div>
							</div>
							<div class="col-md-12 my-3">
								<div class= "rtwmer_addnew_vend_label">
									<div class="position-relative">
										<span><?php esc_html_e('Send the vendor an email about their account.', 'rtwmer-mercado'); ?></span>
										<label class="rtwmer_switch">
											<input type="checkbox" class="" data-id="">
											<span class="rtwmer_slider rtwmer_round"></span>
										</label>
									</div>
								</div>
							</div>
							
						</div>
					</div>

					<!-- address section -->

					<div class="py-4 px-3 rtwmer_vendoradd_store_addres_section">
						<div class="mdc-elevation--z3 rtwmer-vendor-store-section-page">
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_addnew_store_address1">
									<input type="text" class="mdc-text-field__input" id='rtwmer_vendor_addnew_store_address1'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Address line 1', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_addnew_store_address2">
									<input type="text" class="mdc-text-field__input" id='rtwmer_vendor_addnew_store_address2'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Address line 2', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for='rtwmer_vendor_addnew_town_city'>
									<input type="text" class="mdc-text-field__input" id='rtwmer_vendor_addnew_town_city'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Town/City', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>						
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_addnew_zip_code">
									<input type="text" class="mdc-text-field__input" id="rtwmer_vendor_addnew_zip_code">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Zip Code', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<div class= "rtwmer_addnew_vend_label">
									<div class="position-relative">
										<label for="rtwmer_addnew_vend_country" class='rtwmer_addnew_vend_country_css'><?php esc_html_e('Country', 'rtwmer-mercado'); ?></label>
										<?php 
											$rtwmer_addnew_vend_country = new WC_Countries;
											$rtwmer_addnew_vend_all_country = $rtwmer_addnew_vend_country->get_allowed_countries();
											woocommerce_form_field( 'rtwmer_addnew_vend_country_field', array(
												'type' 		=> 'select',
												'id' 		=> 'rtwmer_addnew_vend_country',
												'class' 	=> array('rtwmer_addnew_vend_country_select'),
												'options' 	=> array("" => esc_html__('Select A Country','rtwmer-mercado')) + $rtwmer_addnew_vend_all_country,
												'clear' 	=> true
											) );
										?>
										<span class="focus-border">
										</span>
									</div>
								</div>
							</div>
							<div class="rtwmer-vendor-input" id="rtwmer_addnew_vend_state_show">
								<div class= "rtwmer_addnew_vend_label">
									<div class="position-relative">
										<label for="rtwmer_addnew_vend_state"><?php esc_html_e('State / County', 'rtwmer-mercado'); ?></label>
										<span class="focus-border">
											<div id="rtwmer_addnew_vendors_state">
												<select>
													<option></option>
												</select>
											</div>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Payment section -->

					<div class="py-4 px-3 rtwmer_vendoradd_store_paymnt_section">					
						<div class="mdc-elevation--z3 rtwmer-vendor-store-section-page">
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer-addnew-vend-acc-no">
									<input type="text" class="mdc-text-field__input" id='rtwmer-addnew-vend-acc-no'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Account Number', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_addnew_bank_name">
									<input type="text" class="mdc-text-field__input" id='rtwmer_vendor_addnew_bank_name'>
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Bank name', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100">
									<input type="text" class="mdc-text-field__input" id="rtwmer_vendor_addnew_bank_address">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Bank Address', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_addnew_routing_number">
									<input type="text" class="mdc-text-field__input" id="rtwmer_vendor_addnew_routing_number">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Routing Number', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_addnew_bank_iban">
									<input type="text" class="mdc-text-field__input" id="rtwmer_vendor_addnew_bank_iban">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Bank IBAN', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_addnew_bank_swift">
									<input type="text" class="mdc-text-field__input" id="rtwmer_vendor_addnew_bank_swift">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Bank Swift', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>	
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_addnew_vend_paypal_email">
									<input type="text" class="mdc-text-field__input" id="rtwmer_addnew_vend_paypal_email">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('PayPal Email', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-vendor-input">
								<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_addnew_vend_stripe_id">
									<input type="text" class="mdc-text-field__input" id="rtwmer_addnew_vend_stripe_id">
									<div class="mdc-notched-outline mdc-notched-outline--upgraded">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__notch">
										<span class="mdc-floating-label"><?php esc_html_e('Stripe Id', 'rtwmer-mercado'); ?></span>
										</div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</label>
							</div>
							<div class="rtwmer-enable-toggle">
								<div class="position-relative">
									<span><?php esc_html_e('Enable Selling', 'rtwmer-mercado'); ?></span>
									<label class="rtwmer_switch rtwmer_switch1">
										<input type="checkbox" class="rtwmer_addnew_vend_enable_selling" id="rtwmer_addnew_vendor_enable_selling">
										<span class="rtwmer_slider rtwmer_round"></span>
									</label>
								</div>
							</div>
							<div class="rtwmer-enable-toggle">
								<div class="position-relative">
									<span><?php esc_html_e('Publish Product Directly', 'rtwmer-mercado'); ?></span>
									<label class="rtwmer_switch rtwmer_switch2">
										<input type="checkbox" class="rtwmer_addnew_vendor_publishing_product" >
										<span class="rtwmer_slider rtwmer_round"></span>
									</label>
								</div>
							</div>
							<div class="rtwmer-enable-toggle">
								<div class="position-relative">
									<span><?php esc_html_e('Make Vendor Featured', 'rtwmer-mercado'); ?></span>
									<label class="rtwmer_switch rtwmer_switch3">
										<input type="checkbox" class="rtwmer_addnew_vendor_admin_featured_vendor" >
										<span class="rtwmer_slider rtwmer_round"></span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="rtwmer-modal-footer">
					<button type="button" class="mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer_mercado_vendor_next" data-value="rtwmer_vendor_store_details" data-check = "rtwmer_addnew_vendor"><?php esc_html_e('Next', 'rtwmer-mercado'); ?></button>
				</div>
			</div>
		</div>
		<?php do_action('rtwmer_add_metadata_for_add_new_vendor'); ?>
	</div>	<div class='rtwmer-modal' id='rtwmer_vendor_modal' tabindex="-1">
		<div class='rtwmer-modal-dialog'>
			<div class='rtwmer-modal-content'>
				
				<div class='rtwmer-modal-header'>
					<h4 class='modal-title'><?php esc_html_e('Edit Vendor Detail', 'rtwmer-mercado'); ?></h4>
					<button class="mdc-button rtwmer-modal-close">
                        <i class="material-icons"><?php echo esc_html('highlight_off'); ?></i>
					</button>
				</div>

				<div class='rtwmer-modal-body'>
					<div id="rtwmer-btn-section">
						<button type='button' id="rtwmer_vendor_store_details" class="mdc-button mdc-button--raised  mdc-ripple-upgraded rtwmer-store-btn-active">
							<span class="mdc-button__label"><?php esc_html_e('Store Details', 'rtwmer-mercado'); ?></span>
							<div class="mdc-button__ripple"></div>
						</button>
						<button type='button' id="rtwmer_vendor_store_address" class="mdc-button mdc-button--raised  mdc-ripple-upgraded">
							<span class="mdc-button__label"><?php esc_html_e('Store Address', 'rtwmer-mercado'); ?></span>
							<div class="mdc-button__ripple"></div>
						</button>
						<button type='button' id="rtwmer_vendor_payment_options" class="mdc-button mdc-button--raised  mdc-ripple-upgraded">
							<span class="mdc-button__label"><?php esc_html_e('Payments & Commission', 'rtwmer-mercado'); ?></span>
							<div class="mdc-button__ripple"></div>
						</button>
					</div>
					<div class="rtwmer-section-content">
						<div class="">
							<div class="rtwmer-subsetting-content rtwmer_vendor_sections" id="rtwmer_vendor_store_details_section">
								<p><?php esc_html_e('Store Details', 'rtwmer-mercado') ?></p>
								<div class="rtwmer_vendor_store">
									<label for="rtwmer_vendor_store_banner" class="rtwmer_store_banner"> <?php esc_html_e('Banner', 'rtwmer-mercado'); ?> </label>
									<div class='rtwmer-image-preview-wrapper'>
										<img class='rtwmer_vendor_img_pre' src='<?php echo esc_url(wp_get_attachment_url()); ?>'>
									</div>
									<input type="button" class="button rtwmer_vendor_store_img mdc-button mdc-button--raised  mdc-ripple-upgraded" value="<?php esc_html_e('Upload image'); ?>" />
									<input type='hidden' class='rtwmer_vendor_img_id'>
								</div>
								<div class="mdc-elevation--z3 rtwmer-vendor-store-section-page">
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_store_name1">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Store Name', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_store_url">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Store URL', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_vendor_store_phone rtwmer_edit_vendor_details_data">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Phone Number', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for='rtwmer_vendor_facebook'>
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_facebook">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Facebook', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_vendor_google_plus rtwmer_edit_vendor_details_data">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Google Plus', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_vendor_twitter rtwmer_edit_vendor_details_data">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Twitter', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_vendor_pinterest rtwmer_edit_vendor_details_data">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Pinterest', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_vendor_linkedin rtwmer_edit_vendor_details_data">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('LinkedIn', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_vendor_youtube rtwmer_edit_vendor_details_data">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Youtube', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_vendor_instagram rtwmer_edit_vendor_details_data">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Instagram', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100">
											<input type="text" class="mdc-text-field__input rtwmer_vendor_flickr rtwmer_edit_vendor_details_data">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Flickr', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
								</div>
							</div>

							<div class="rtwmer-subsetting-content rtwmer_vendor_sections" id="rtwmer_vendor_store_address_section">
								<p><?php esc_html_e('Store Address', 'rtwmer-mercado') ?></p>
								<div class="rtwmer-stor-input">
									<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_store_address1">
										<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_store_address1">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch">
											<span class="mdc-floating-label"><?php esc_html_e('Address 1', 'rtwmer-mercado'); ?></span>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</label>
								</div>
								<div class="rtwmer-stor-input">
									<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_store_address2">
										<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_store_address2">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch">
											<span class="mdc-floating-label"><?php esc_html_e('Address 2', 'rtwmer-mercado'); ?></span>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</label>
								</div>
								<div class="rtwmer-stor-input">
									<label class="mdc-text-field mdc-text-field--outlined w-100  " for="rtwmer_vendor_town_city">
										<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_town_city">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch">
											<span class="mdc-floating-label"><?php esc_html_e('Town/City', 'rtwmer-mercado'); ?></span>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</label>
								</div>
								<div class="rtwmer-stor-input">
									<label class="mdc-text-field mdc-text-field--outlined w-100  " for="rtwmer_vendor_zip_code">
										<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_zip_code">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch">
											<span class="mdc-floating-label"><?php esc_html_e('Zip Code', 'rtwmer-mercado'); ?></span>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</label>
								</div>
								<div class="rtwmer-stor-input">
									<span>
										<?php
										$rtwmer_countries_value  = new WC_Countries();
										$rtwmer_countries      = $rtwmer_countries_value->get_allowed_countries();
										woocommerce_form_field('rtwmer_vendor_country', array(
											'type'      => 'select',
											'id'        => 'rtwmer_vendor_store_country',
											'class'     => array('rtwmer_vendor_store_country'),
											'options'   => array('' => esc_html__('Select a country', 'rtwmer-mercado')) + $rtwmer_countries,
											'clear'     => true
										));
										?>
									</span>
								</div>
								<div class="rtwmer-stor-input rtwmer_state_show">
									<label for="rtwmer_vendor_state_county"></label>
									<span>
										<div id="rtwmer_vendor_select_count_ajax">
											<select>
												<option></option>
											</select>
										</div>
									</span>
								</div>
							</div>

							<div class="rtwmer-subsetting-content rtwmer_vendor_sections" id="rtwmer_vendor_payment_option_section">
								<p><?php esc_html_e('Payments & Commission', 'rtwmer-mercado') ?></p>
								<div class="rtwmer-vendor-store-section-page">
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_bank_name">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_bank_name">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Bank Name', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_bank_account_no">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_bank_account_no">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Account Number', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_bank_address">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_bank_address">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Bank Address', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_routing_number">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_routing_number">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Routing Number', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_bank_iban">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_bank_iban">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Bank IBAN', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_bank_swift">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_bank_swift">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Bank Swift', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_paypal_email">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_paypal_email">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('PayPal Email', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
									<div class="rtwmer-stor-input">
										<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_stripe_id">
											<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_stripe_id">
											<div class="mdc-notched-outline mdc-notched-outline--upgraded">
												<div class="mdc-notched-outline__leading"></div>
												<div class="mdc-notched-outline__notch">
												<span class="mdc-floating-label"><?php esc_html_e('Stripe Id', 'rtwmer-mercado'); ?></span>
												</div>
												<div class="mdc-notched-outline__trailing"></div>
											</div>
										</label>
									</div>
								</div>
								<ul class="rtwmer-store-details-all">
								<li>
									<label for="rtwmer_vendor_enable_selling"><?php esc_html_e('Selling', 'rtwmer-mercado'); ?></label>
									<span>
										<div class='mdc-checkbox mdc-data-table__row-checkbox'>
											<input type='checkbox' class='mdc-checkbox__native-control'  id='rtwmer_vendor_enable_selling'> 
											<div class='mdc-checkbox__background'>
												<svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
													<path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
												</svg>
												<div class='mdc-checkbox__mixedmark'></div>
											</div>
											<div class='mdc-checkbox__ripple'></div>
										</div>
										<span class="rtwmer_margin_back"><?php esc_html_e('Enable Adding Products', 'rtwmer-mercado') ?></span>
										<p class="rtwer-notice"><?php esc_html_e('Enable or disable product adding capability', 'rtwmer-mercado') ?></p>
									</span>
									</li>
									<li>
										<label for="rtwmer_vendor_publishing_product"> <?php esc_html_e('Publishing', 'rtwmer-mercado'); ?> </label>
										<span>
											<div class='mdc-checkbox mdc-data-table__row-checkbox'>
												<input type='checkbox' class='mdc-checkbox__native-control rtwmer_vendor_publishing_product'> 
												<div class='mdc-checkbox__background'>
													<svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
														<path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
													</svg>
													<div class='mdc-checkbox__mixedmark'></div>
												</div>
												<div class='mdc-checkbox__ripple'></div>
											</div>
											<span class="rtwmer_margin_back"><?php esc_html_e('Publish product directly', 'rtwmer-mercado') ?></span>
											<p class="rtwer-notice"><?php esc_html_e('Bypass pending, publish products directly', 'rtwmer-mercado') ?></p>
										</span>
									</li>
									<li>
										<label for="rtwmer_vendor_admin_commission_type"> <?php esc_html_e('Admin Commission Type', 'rtwmer-mercado'); ?> </label>
										<span>
											<div class="rtwmer_select_box">
												<select class="rtwmer_admin_vendor_commssion rtwmer-select-text">
													<option value="flat"> <?php esc_html_e('Flat', 'rtwmer-mercado') ?> </option>
													<option value="percentage"> <?php esc_html_e('Percentage', 'rtwmer-mercado') ?> </option>
													<p class="rtwer-notice"><?php esc_html_e('Set the commmission type admin gets from this seller', 'rtwmer-mercado'); ?></p>
												</select>
											</div>
										</span>
									</li>
									<li>
										<label for="rtwmer_vendor_admin_commision_value"> <?php esc_html_e('Admin Commission', 'rtwmer-mercado'); ?> </label>
										<span>
											<label class="mdc-text-field mdc-text-field--outlined w-100" for="rtwmer_vendor_admin_commision_value">
												<input type="text" class="mdc-text-field__input rtwmer_edit_vendor_details_data rtwmer_vendor_admin_commision_value">
												<div class="mdc-notched-outline mdc-notched-outline--upgraded">
													<div class="mdc-notched-outline__leading"></div>
													<div class="mdc-notched-outline__notch">
													<span class="mdc-floating-label"><?php esc_html_e('Admin Commission', 'rtwmer-mercado'); ?></span>
													</div>
													<div class="mdc-notched-outline__trailing"></div>
												</div>
											</label>
											<p class="rtwer-notice"><?php esc_html_e('It will override the default commission admin gets from each sales', 'rtwmer-mercado'); ?></p>
										</span>
									</li>
									<li>
										<label for="rtwmer_vendor_admin_featured_vendor"> <?php esc_html_e('Featured vendor', 'rtwmer-mercado'); ?> </label>
										<span class="rtwmer_mercado_vendor_last_span">
											<div class='mdc-checkbox mdc-data-table__row-checkbox'>
												<input type='checkbox' class='mdc-checkbox__native-control rtwmer_vendor_admin_featured_vendor'> 
												<div class='mdc-checkbox__background'>
													<svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
														<path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
													</svg>
													<div class='mdc-checkbox__mixedmark'></div>
												</div>
												<div class='mdc-checkbox__ripple'></div>
											</div>
											<span class="rtwmer_margin_back"><?php esc_html_e('Mark as featured vendor', 'rtwmer-mercado') ?></span>
											<p class="rtwer-notice"><?php esc_html_e('This vendor will be marked as a featured vendor.', 'rtwmer-mercado') ?></p>
										</span>
									</li>
								</ul>
							</div>

						</div>
					</div>
				</div>

				<!-- Modal footer -->
				<div class='rtwmer-modal-footer'>
					<button type='button' class='mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer_mercado_vendor_next' data-id='' data-value="rtwmer_vendor_store_details" data-check = "rtwmer_edit_vendor"> <?php esc_html_e('Next', 'rtwmer-mercado'); ?> </button>
				</div>

			</div>
		</div>
	</div>
	
	<?php do_action('rtwmer_add_metadata_for_edit_vendor'); ?>

</div>