<?php

// This file contains the html for vendor dashboard page
global $rtwmer_user_id_for_dashboard;
$rtwmer_options = get_option("rtwmer_page_setting");

if (!empty($rtwmer_options) && is_array($rtwmer_options)) {
	$rtwmer_title = $rtwmer_options['rtwmer_page_setting_dashboard'];
} else {
	$rtwmer_title = '';
}
$rtwmer_options_array  =  get_option('rtwmer_general_setting');
if (!empty($rtwmer_options_array) && is_array($rtwmer_options_array)) {
	$rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];
} else {
	$rtwmer_endpoint_page = '';
}
$rtwmer_current_usr_nicename = wp_get_current_user()->user_nicename;
global $wp_query;
global $pagenow;
if (($pagenow != 'post.php') && (is_object($wp_query->post)) && ($wp_query->post->ID == $rtwmer_title) && current_user_can("mercador")) {
	$rtwmer_user_meta = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_store_setup", true);
	if (filter_var($rtwmer_user_meta, FILTER_VALIDATE_BOOLEAN)) {
		$rtwmer_mercado_default_loader = apply_filters("rtwmer_mercado_default_loader",RTWMER_PUBLIC_IMAGES_URL."rtwmer_loader.gif");
?>
<html>
<div class="rtwmer_loader">
	<div class="rtwmer_loader_box">
		<div class="rtwmer-loader-img-div">
			<img id="rtwmer_loader_gif" class="rtwmer_datatble_loader" src='<?php echo esc_url($rtwmer_mercado_default_loader) ?>'>
		</div>
	</div>
</div>
		<div class="rtwmer_wrap">
			<aside class="mdc-drawer rtwmer_vendor_drawer rtwmer_sidebar_list">
				<div class="mdc-drawer__content" id="rtwmer_drawer_content">
					<div class="rtwmer-sidebar-close"><i class="fas fa-times"></i></div>
					<?php
					$rtwmer_menu_array[] = '<nav class="mdc-list rtwmer_vendor_main_menu">';
					if($this->rtwmer_user_can_access("rtwmer_dashboard_cap")){
						$rtwmer_menu_array[] = 	'<li class="rtwmer-active rtwmer_div rtwmer-dashboard  rtwmer_sidebar_list_item">
						<a class="mdc-list-item rtwmer-dash-button rtwmer-href" href="#dashboard" aria-current="page">
							<i class="material-icons mdc-list-item__graphic" aria-hidden="true">dashboard</i>
							<span class="mdc-list-item__text">' . esc_html__("Dashboard", "rtwmer-mercado") . '</span>
						</a>
					</li>';
					}
					if($this->rtwmer_user_can_access("rtwmer_product_cap")){
					$rtwmer_menu_array[] = '<li class="rtwmer_div  rtwmer_sidebar_list_item rtwmer-product">
									<a class="mdc-list-item rtwmer-dash-button rtwmer-href" href="#product">
									<i class="fas fa-box-open mdc-list-item__graphic rtwmer-font-icon" aria-hidden="true"></i>
										<span class="mdc-list-item__text">' . esc_html__("Product", "rtwmer-mercado") . '</span>
									</a>
									</li>';
					}
					if($this->rtwmer_user_can_access("rtwmer_order_cap")){
					$rtwmer_menu_array[] = '<li class="rtwmer_div  rtwmer_sidebar_list_item rtwmer-orders">
									<a class="mdc-list-item rtwmer-dash-button rtwmer-href" href="#orders">
										<i class="material-icons mdc-list-item__graphic" aria-hidden="true">redeem</i>
										<span class="mdc-list-item__text">' . esc_html__("Orders", "rtwmer-mercado") . '</span>
									</a>
									</li>';
					}
					if($this->rtwmer_user_can_access("rtwmer_withdraw_cap")){
					$rtwmer_menu_array[] = '<li class="rtwmer_div  rtwmer_sidebar_list_item rtwmer-withdraw">
									<a class="mdc-list-item rtwmer-dash-button rtwmer-href" href="#withdraw">
										<i class="mdc-list-item__graphic material-icons">account_balance_wallet</i>
										<span class="mdc-list-item__text">' . esc_html__("Withdraws", "rtwmer-mercado") . '</span>
									</a>
									</li>';
					}
					if($this->rtwmer_user_can_access("rtwmer_store_settings_cap")){
					$rtwmer_menu_array[] = '<li class="rtwmer_div  rtwmer_sidebar_list_item rtwmer-setting">
									<a class="mdc-list-item rtwmer-dash-button rtwmer-href" href="#Setting">
										<i class="material-icons mdc-list-item__graphic" aria-hidden="true">settings</i>
										<span class="mdc-list-item__text">' . esc_html__("Store-Settings", "rtwmer-mercado") . '</span>
									</a>
									</li>';
					}
					if($this->rtwmer_user_can_access("rtwmer_payment_option_cap")){
					$rtwmer_menu_array[] = '<li class="rtwmer_div  rtwmer_sidebar_list_item rtwmer-payments">
									<a class="mdc-list-item rtwmer-dash-button rtwmer-href" href="#payment">
										<i class="material-icons mdc-list-item__graphic" aria-hidden="true">payment</i>
										<span class="mdc-list-item__text">' . esc_html__("Payments", "rtwmer-mercado") . '</span>
									</a>
									</li>';
					}
					
					$rtwmer_menu_array = apply_filters("rtwmer_vendor_dashboard_between_menu", $rtwmer_menu_array);

					$rtwmer_url = $this->rtwmer_vendor_store_url();
					$rtwmer_menu_array[] = '<li class="rtwmer-bottom-icons">
										<a class="mdc-icon-button material-icons mdc-ripple-upgraded" title="' . esc_attr__("Go to Store", "rtwmer-mercado") . '" href="' . esc_url($rtwmer_url) . '">store</a>
										<a class="mdc-icon-button material-icons mdc-ripple-upgraded" title="' . esc_attr__("Edit Profile", "rtwmer-mercado") . '" href="' . wc_customer_edit_account_url() . '">account_circle
										</a>
										<a class="mdc-icon-button material-icons mdc-ripple-upgraded" title="' . esc_attr__("Log Out", "rtwmer-mercado") . '" href="' . wp_logout_url(get_home_url())  . '">
											<i class="fas fa-sign-out-alt"></i>
										</a>
									</li>';
					$rtwmer_menu_array[] = '</nav>';
					$rtwmer_menu_array = apply_filters("rtwmer_vendor_dashboard_menu", $rtwmer_menu_array);
					foreach ($rtwmer_menu_array as $key => $value) {
						echo $value;	// This variable holds html
					}
					?>
				</div>
			</aside>
			<div class="rtwmer_mercado_main_body rtwmer-panels" id="rtwmer_pannels">
				<?php 
				if($this->rtwmer_user_can_access("rtwmer_dashboard_cap")){
					?>
				<div class="rtwmer-dashboard-panel rtwmer_panel">
					<?php include_once RTWMER_PUBLIC_PARTIAL . "rtwmer_dashboard.php";  ?>
				</div>
				<?php 
				}
				if($this->rtwmer_user_can_access("rtwmer_product_cap")){
				?>
				<div class="rtwmer-product-panel rtwmer_panel rtwmer_cards">
					<?php include_once RTWMER_PUBLIC_PARTIAL . "rtwmer-mercado-shortcode-product.php"; ?>
				</div>
				<?php 
				}
				if($this->rtwmer_user_can_access("rtwmer_order_cap")){
				?>
				<div class="rtwmer-orders-panel rtwmer_panel rtwmer_cards">
					<?php include_once RTWMER_PUBLIC_PARTIAL . "rtwmer-Vendor-Orders.php";	?>
				</div>
				<?php 
				}
				if($this->rtwmer_user_can_access("rtwmer_withdraw_cap")){
				?>
				<div class="rtwmer-withdraw-panel rtwmer_panel rtwmer_cards">
					<?php include_once RTWMER_PUBLIC_PARTIAL . "rtwmer-Vendor-withdraw.php";	?>
				</div>
				<?php 
				}
				if($this->rtwmer_user_can_access("rtwmer_store_settings_cap")){
				?>
				<div class="rtwmer-Setting-panel rtwmer_panel rtwmer_cards">
					<?php include_once RTWMER_PUBLIC_PARTIAL . "rtwmer-Vendor-store-settings.php";	?>
				</div>
				<?php 
				}
				if($this->rtwmer_user_can_access("rtwmer_payment_option_cap")){
				?>
				<div class="rtwmer-payment-panel rtwmer_panel rtwmer_cards">
					<?php include_once RTWMER_PUBLIC_PARTIAL . "rtwmer-Vendor-Payments.php";	?>
				</div>
				<?php 
				}
				?>
				<?php do_action("rtwmer_vendor_dashboard_pannel"); ?>
			</div>
		</div>
<?php
	do_action("rtwmer_dashboard_after_main_div");
	} else {
		include_once RTWMER_PUBLIC_PARTIAL . "rtwmer_store_setup.php";
	}
}
?></html>