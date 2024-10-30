<?php
/**

 * Provide a admin area view for the plugin

 *

 * This file is used to markup the admin-facing aspects of the plugin.

 *

 * @link       my author uri my

 * @since      1.0.0

 *

 * @package    Rtwmer_Mercado

 * @subpackage Rtwmer_Mercado/admin/partials

 */

?> 
<header class="rtwmer_settings_tab_wrapper">

<?php

$rtwmer_prev_page = "?page=rtwmer-mercado&rtwmer_action=rtwmer_store_setup";
$rtwmer_auto_open = "";
if(isset($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], $rtwmer_prev_page) !== false){
	$rtwmer_auto_open = "rtwmer_auto_open";
}

$rtwmer_dnd = get_option("rtwmer_show_offer_popup");
$rtwmer_time_stamp = get_option("rtwmer_show_offer_popup_time_stamp");

$rtwmer_show_modal = "";
$rtwmer_checkbox_checked = "checked";
if($rtwmer_dnd){
	$rtwmer_checkbox_checked = "";
	if($rtwmer_time_stamp && strtotime('+30 minutes', $rtwmer_time_stamp) <= strtotime("now")){
		$rtwmer_show_modal = "rtwmer_show_offer_modal";
	}
}

?>
	<!-- desktop view header -->
	<nav class="rtwmer-top-header rtwmer-desktop-header">
		<div style="display: flex;">
			<div class=" rtwmer-toggle">
				<i class="fas fa-bars"></i>
			</div>
			<a  href="<?php echo esc_url(admin_url().'admin.php?page=rtwmer-mercado') ?>"><?php esc_html_e('Mercado','rtwmer-mercado'); ?></a>
		</div>
		<?php do_action("rtwmer_merado_admin_header"); ?>	
		<div class='rtwmer_header_right_text'>
			
		<?php 
		$rtwmer_active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
		$rtwmer_show_offer = true;
		if(in_array("rtwmer-mercado-pro/rtwmer-mercado-pro.php",$rtwmer_active_plugins)){
			$rtwmer_show_offer = false;
		}
		$rtwmer_show_offer = apply_filters("rtwmer_show_enterprise_popup", $rtwmer_show_offer);
			if($rtwmer_show_offer){
				?>
				<button class="mdc-button mdc-button--raised mdc-button--upgraded rtwmer_show_offer <?php echo esc_html($rtwmer_auto_open); ?> <?php echo esc_html($rtwmer_show_modal); ?> " id='rtwmer_offer_icon'><?php esc_html_e("Sale is live - ", "rtwmer-mercado") ?><span> $79</span></button>
				<?php 
			}
			?>
				<a class="mdc-button mdc-button--raised mdc-button--upgraded" href="<?php echo esc_url (admin_url().'admin.php?page=rtwmer-mercado&rtwmer_action=rtwmer_store_setup'); ?>"><?php esc_html_e('Store Setup','rtwmer-mercado'); ?></a>
				<a class="rtwmer_vendors_chng_product" target="_blank" href="<?php echo esc_url( admin_url() ); ?>"><?php esc_html_e('Go back to WordPress','rtwmer-mercado'); ?></a>
		</div>
	</nav>
	<nav class="rtwmer-top-header rtwmer-mobile-header">
		<div style="display: flex;">
			<div class=" rtwmer-toggle">
				<i class="fas fa-bars"></i>
			</div>
			<a href="http://localhost/wordpress/wp-admin/admin.php?page=rtwmer-mercado">Mercado</a>
    	</div>
		<div>
			<a class="mdc-button mdc-button--raised mdc-button--upgraded mdc-ripple-upgraded" href="http://localhost/wordpress/wp-admin/admin.php?page=rtwmer-mercado&amp;rtwmer_action=rtwmer_store_setup">Store Setup</a>
			<a href="http://localhost/wordpress/wp-admin/"><i class="fas fa-home"></i></a>
		</div>	
			<?php do_action("rtwmer_merado_admin_header"); ?>	
	</nav>
	<!-- mobile view header content -->
</header>
<?php 
if($rtwmer_show_offer){ 
	$rtwmer_pro_url = "https://codecanyon.net/item/mercado-pro-turn-your-woocommerce-into-multi-vendor-marketplace/28986182";
	?>
<div class="rtwmer-modal  rtwmer_features_modal">
			<div class="rtwmer_features_modal_dialog  mdc-elevation--z3">
                <div class="rtwmer-modal-content">
                    <div class="rtwmer-modal-header">
						<h3 class="rtwmer-modal-title"><?php esc_html_e("Upgrade to Mercado Pro - just in", "rtwmer-mercado") ?><span class="rtwmer_cross"><strike>$99</strike></span><span> $79</span></h3>
						<a class="mdc-button mdc-button--raised mdc-button--upgraded rtwmer_buy_now_button" href='<?php echo esc_url($rtwmer_pro_url)?>'><?php esc_html_e("Buy Now", "rtwmer-mercado") ?></a>
                        <a class="rtwmer-close-btn rtwmer_close_offer_sec mdc-icon-button material-icons mdc-ripple-upgraded rtwmer-modal-close mdc-ripple-upgraded--unbounded" aria-pressed="true">highlight_off</a>
                    </div>
                    <div class="rtwmer-modal-body">
                        <div class="rtwmer_features_div">
							<h5><?php esc_html_e("Key Features", "rtwmer-mercado") ?></h5>
							<!-- <div class="rtwmer_bottom_line"></div> -->
							<ul>
								<li><?php esc_html_e("Safe and Trustworthy", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Flexibility and Customization", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Multiple Payment Gateways", "rtwmer-mercado") ?></li>
			
								<li><?php esc_html_e("WPML Integration", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Social Media Logins", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("No reload dashboards", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Announcements", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Separate Store", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Privacy", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("User-Friendly and Individual Dashboard for Sellers", "rtwmer-mercado") ?></li>
							</ul>
							<h5><?php esc_html_e("Admin End Features", "rtwmer-mercado") ?></h5>
							<!-- <div class="rtwmer_bottom_line"></div> -->
							<ul>
								<li><?php esc_html_e("Authoritarian Admin Dashboard ", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Global and Individual Commissions", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Unlimited Vendors for Unlimited Earnings", "rtwmer-mercado") ?></li>
			
								<li><?php esc_html_e("View and Manage Orders", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Live Reports and Statements ", "rtwmer-mercado") ?></li>

								<li><?php esc_html_e("Shipping and Tax Management", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Track Each Individual Vendor Record", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Assign Products to Vendors ", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Add Payment to Vendor’s Account", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Live AJAX Search with Sort and Filter Functions", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Set Withdraw Time Limit", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Absolute Flexibility for All Settings ", "rtwmer-mercado") ?></li>
							</ul>
							<h5><?php esc_html_e("Vendor End Features", "rtwmer-mercado") ?></h5>
							<!-- <div class="rtwmer_bottom_line"></div> -->
							<ul>
								<li><?php esc_html_e("Light and Dark Themes", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Create Products", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Manage and View Orders", "rtwmer-mercado") ?></li>
			
								<li><?php esc_html_e("Duplicate Products ", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Generate Coupons", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Manage Reviews", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Create Reports", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Vendor Balance", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Vendor store ratings", "rtwmer-mercado") ?></li>
								<li><?php esc_html_e("Vendor store setup wizard", "rtwmer-mercado") ?></li>
							</ul>
						</div>
                    </div>
                    <div class="rtwmer-modal-footer">
					<div class='rtwmer_prevent_popup'>
							<input type='checkbox' name='rtwmer_hide_popup' id='rtwmer_prevent_popup' <?php echo esc_html($rtwmer_checkbox_checked) ?>><?php esc_html_e("Disable This Offer Notification","rtwmer-mercado") ?>
						</div>
                        <button type="button" class="rtwmer-modal-close rtwmer_close_offer_sec rtwmer-footer-btn mdc-button mdc-button--raised mdc-ripple-upgraded">
                            <span class="mdc-button__label"><?php esc_html_e("Close","rtwmer-mercado") ?></span>
                            <div class="mdc-button__ripple"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
<?php } 

?>
<aside class="mdc-drawer rtwmer_sidbar_wrapper">
	<div class="rtwmer-sidebar-close">
			<i class="fas fa-times"></i>
	</div>
	<div class="mdc-drawer__header rtwmer_logo">

		<h4 class="mdc-drawer__title rtwmer-title"><?php global $current_user;

		echo esc_html__('Hello, ','rtwmer-mercado') . esc_html(isset($current_user->user_login) ? $current_user->user_login : ''); ?></h4>

		<a  href="#"><img src="<?php echo esc_url( get_avatar_url(get_current_user_id()) ) ?>" class="img-fluid" alt="image"></a>

	</div>

	<div class="mdc-drawer__content rtwmer-drawer-content" id="rtwmer-sidebar">

		<nav class="mdc-list rtwmer-navbar">
	
			<?php


				$rtwmer_settings_submenu = array(
					array("<li class='mdc-list-item'><a class='rtwmer_settings_submenus' id='rtwmer-setting-general' data-tab='#rtwmer-general' data-parent='#rtwmer-admin-settings' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#general-setting') ."'>".esc_html__( 'General','rtwmer-mercado') ."</a></li>",10),
					array("<li class='mdc-list-item'><a class='rtwmer_settings_submenus' id='rtwmer-setting-selling' data-tab='#rtwmer-selling-options' data-parent='#rtwmer-admin-settings' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#selling-option') ."'>".esc_html__( 'Sellling Options','rtwmer-mercado') ."</a></li>",20),
					array("<li class='mdc-list-item'><a class='rtwmer_settings_submenus' id='rtwmer-setting-withdraw' data-tab='#rtwmer-withdraw-options' data-parent='#rtwmer-admin-settings' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#withdraw-option') ."'>".esc_html__( 'Withdraw Options','rtwmer-mercado') ."</a></li>",30),
					array("<li class='mdc-list-item'><a class='rtwmer_settings_submenus' id='rtwmer-setting-payment-gateway' data-tab='#rtwmer-payment-gateway-options  ' data-parent='#rtwmer-admin-settings' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#payment-gateway') ."'>".esc_html__( 'Payment Gateway','rtwmer-mercado') ."</a></li>",40),
					array("
					<li class='mdc-list-item'><a class='rtwmer_settings_submenus' id='rtwmer-setting-page-setting' data-tab='#rtwmer-page-setting' data-parent='#rtwmer-admin-settings' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#page-setting') ."'>".esc_html__( 'Page Settings','rtwmer-mercado') ."</a></li>",50),
					array("<li class='mdc-list-item'><a class='rtwmer_settings_submenus' id='rtwmer-setting-appearence' data-tab='#rtwmer-appearence' data-parent='#rtwmer-admin-settings' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#appearence') ."'>".esc_html__( 'Appearence','rtwmer-mercado') ."</a></li>",60),
					array("<li class='mdc-list-item'><a class='rtwmer_settings_submenus' id='rtwmer-setting-privacy-policy' data-tab='#rtwmer-privacy-policy' data-parent='#rtwmer-admin-settings' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#privacy-policy') ."'>".esc_html__( 'Privacy Policy','rtwmer-mercado') ."</a></li>",70),
				);

				$rtwmer_settings_submenu = apply_filters('rtwmer_admin_setting_submenu',$rtwmer_settings_submenu);

				if( isset($rtwmer_settings_submenu) && is_array($rtwmer_settings_submenu) )
				{
					foreach($rtwmer_settings_submenu as $rtwmer_setting_submenus_array)
					{
						//==$rtwmer_menus, Variable contains html==//
						if( isset($rtwmer_setting_submenus_array) && is_array($rtwmer_setting_submenus_array) && isset($rtwmer_setting_submenus_array[0]) )
						{
							if( isset($rtwmer_setting_submenus_array[1]) )
							{
								if( $rtwmer_setting_submenus_array[1] == '' || $rtwmer_setting_submenus_array[1] == 0 || $rtwmer_setting_submenus_array[1] == null )
								{
									$rtwmer_setting_submenu_display_array[] = $rtwmer_setting_submenus_array[0];
								}
								else
								{
									$rtwmer_setting_submenu_display_array[$rtwmer_setting_submenus_array[1]] = $rtwmer_setting_submenus_array[0];
								}
							}
							else
							{
								$rtwmer_setting_submenu_display_array[] = $rtwmer_setting_submenus_array[0];
							}
						}
					}
					ksort($rtwmer_setting_submenu_display_array);

					if( isset($rtwmer_setting_submenu_display_array) && is_array($rtwmer_setting_submenu_display_array) )

					{
						$rtwmer_setting_submenu_display_array = implode("",$rtwmer_setting_submenu_display_array);
					}
				}

				$rtwmer_admin_main_menus = array(
					array("<li>
						<a class='mdc-list-item rtwmer_main_menu_class' data-tab='.rtwmer_report_top' id='rtwmer-admin-dashboard' href=".esc_url(admin_url().'admin.php?page=rtwmer-mercado#dashboard')."><span class='rtwmer_setup_menu_image rtwmer_dashboard_image'><i class='material-icons  rtwvsm-list-item' aria-hidden='true'>dashboard</i></span> ".esc_html__('Dashboard','rtwmer-mercado')." </a>
					</li>",10),
					array("<li>
						<a class='mdc-list-item rtwmer_main_menu_class' data-tab='.rtwmer_report_top' id='rtwmer-admin-reports' href= '".esc_url(admin_url().'admin.php?page=rtwmer-mercado#report')."'><span class='rtwmer_setup_menu_image rtwmer_dashboard_image'><i class='fa fa-file'></i> </span> ".esc_html__( 'Report','rtwmer-mercado')." </a>
					</li>",20),
					array("<li>
						<a class='mdc-list-item rtwmer_main_menu_class' data-tab='#rtw-mercado-withdraw' id='rtwmer-admin-withdraw' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#withdraw')."'><span class='rtwmer_setup_menu_image rtwmer_dashboard_image'><i class='fas fa-money-check'></i> </span> ".esc_html__( 'Withdraw','rtwmer-mercado')." </a>
					</li>",30),
					array("<li>
						<a class='mdc-list-item rtwmer_main_menu_class' data-tab='#rtw-mercado-vendor' id='rtwmer-admin-vendor' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#/vendor')."'><span class='rtwmer_setup_menu_image rtwmer_dashboard_image'><i class='fas fa-users mr-1'></i> </span> ".esc_html__( 'Vendor','rtwmer-mercado')." </a>

					</li>",40),
					array("<li>
						<a class='mdc-list-item rtwmer_main_menu_class' data-tab='#rtw-mercado-vendor' id='rtwmer-admin-all-orders' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#/orders_all')."'><span class='rtwmer_setup_menu_image rtwmer_dashboard_image'><i class='fa fa-shopping-cart'></i> </span>".esc_html__( 'Orders','rtwmer-mercado')." </a>
					</li>",50),
					array("<li>
						<a class='mdc-list-item rtwmer_main_menu_class' data-tab='.rtwmer-submenu' id='rtwmer-admin-settings' data-submenu='true' href='".esc_url(admin_url().'admin.php?page=rtwmer-mercado#settings') ."'><span class='rtwmer_setup_menu_image rtwmer_dashboard_image'><i class='fas fa-cogs'></i> </span>".esc_html__( 'Settings','rtwmer-mercado') ."</a>

						<ul class='rtwmer-submenu mdc-list' id='rtwmer_settings_submenu_ul'>
							".$rtwmer_setting_submenu_display_array."
						</ul>
					</li>",99999)
				);
			$rtwmer_admin_main_menus = apply_filters('rtwmer_admin_main_menus',$rtwmer_admin_main_menus);
				if( isset($rtwmer_admin_main_menus) && is_array($rtwmer_admin_main_menus) )

				{
					foreach($rtwmer_admin_main_menus as $rtwmer_menus_array)

					{

						//==$rtwmer_menus, Variable contains html==//
						if( isset($rtwmer_menus_array) && is_array($rtwmer_menus_array) && isset($rtwmer_menus_array[0]) )

						{

							if( isset($rtwmer_menus_array[1]) )

							{

								if( $rtwmer_menus_array[1] == '' || $rtwmer_menus_array[1] == 0 || $rtwmer_menus_array[1] == null )

								{

									$rtwmer_menus_display_array[] = $rtwmer_menus_array[0];

								}

								else

								{
									$rtwmer_menus_display_array[$rtwmer_menus_array[1]] = $rtwmer_menus_array[0];

								}

							}

							else

							{

								$rtwmer_menus_display_array[] = $rtwmer_menus_array[0];

							}

						}

					}
					ksort($rtwmer_menus_display_array);

					if( isset($rtwmer_menus_display_array) && is_array($rtwmer_menus_display_array) )

					{
						echo implode("",$rtwmer_menus_display_array);
					}

				}

				
			?>

		</nav>

	</div>
	<?php
		$rtwmer_active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
		if(!in_array("rtwmer-mercado-pro/rtwmer-mercado-pro.php",$rtwmer_active_plugins) && !in_array("rtwmer-mercado-enter/rtwmer-mercado-enter.php",$rtwmer_active_plugins)){ ?>
			<button class="mdc-button mdc-button--raised mdc-button--upgraded rtwmer_show_offer rtwmer_auto_open mdc-ripple-upgraded rtwmer_upgrade_pro_btn_mobile_view" id="rtwmer_offer_icon">Sale is live - <span> $79</span></button>
	<?php	}

	?>
	

</aside>
<div class="rtwmer_settings_content_wrapper">
	<div id="rtw-mercado-withdraw"  class='rtwmer_wrapper_div'><?php

		do_action('rtwmer_mercado_including_withdraw_page');

		include_once( RTWMER_ADMIN_PARTIAL_MENU.'rtwmer-mercado-withdraw.php' );

	?></div>
	<div id="rtw-mercado-report" class='rtwmer_report_top rtwmer_wrapper_div'><?php

		do_action('rtwmer_mercado_including_dashboard_and_report_page');

		include_once( RTWMER_ADMIN_PARTIAL_MENU.'rtwmer-mercado-report.php' );

	?></div>
	<div id="rtw-mercado-vendor" class='rtwmer_wrapper_div'><?php

		do_action('rtwmer_mercado_including_vendor_page');

		include_once( RTWMER_ADMIN_PARTIAL_MENU.'rtwmer-mercado-vendor.php' );

	?></div>
	<div id="rtw-mercado-dashboard" class='rtwmer_wrapper_div'><?php

		include_once( RTWMER_ADMIN_PARTIAL_MENU.'rtwmer-mercado-dashboard.php' );

	?></div>
	
	<?php

		do_action('rtwmer_mercado_including_setting_page');
		include_once( RTWMER_ADMIN_PARTIAL_MENU.'rtwmer-mercado-settings.php' );
		

	?>
	<!-- <div id="rtw-mercado-settings" class='rtwmer_wrapper_div'></div> -->
		<?php do_action('rtwmer_add_file_for_main_menus'); ?>
	</div>

	