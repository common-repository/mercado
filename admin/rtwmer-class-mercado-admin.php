<?php
use Automattic\WooCommerce\Utilities\OrderUtil;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/admin
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwmer_Mercado_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rtwmer_plugin_name    The ID of this plugin.
	 */
	private $rtwmer_plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rtwmer_version    The current version of this plugin.
	 */
	private $rtwmer_version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rtwmer_plugin_name       The name of this plugin.
	 * @param      string    $rtwmer_version    The version of this plugin.
	 */
	public function __construct($rtwmer_plugin_name, $rtwmer_version)
	{
		$this->rtwmer_plugin_name = $rtwmer_plugin_name;
		$this->rtwmer_version = $rtwmer_version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function rtwmer_enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the rtwmer_run() function
		 * defined in Mercado_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mercado_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$rtwmer_current_screen = get_current_screen();

		if ($rtwmer_current_screen->id == "toplevel_page_rtwmer-mercado") {
			wp_enqueue_style('rtwmer-bundle-css', RTWMER_URL . 'assets/bundle/css/bundle.css', array(), $this->rtwmer_version, 'all');
			wp_enqueue_style('rtwmer-material_icon-css', "https://fonts.googleapis.com/icon?family=Material+Icons", array(), $this->rtwmer_version, 'all' );		// This file has the material design icons pack
			wp_enqueue_style('rtwmer-select2-cdn-css', RTWMER_ASSETS_COMMON_CSS."select2.min.css", array(), $this->rtwmer_version, 'all' );

			if(is_rtl())
			{
				wp_enqueue_style($this->rtwmer_plugin_name, plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-admin-rtl.css', array(), $this->rtwmer_version, 'all');
				wp_enqueue_style('rtwmer_admin-dashboard', plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-admin-dashboard-rtl.css', array(), $this->rtwmer_version, 'all');
			}else{
				wp_enqueue_style($this->rtwmer_plugin_name, plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-admin.css', array(), $this->rtwmer_version, 'all');
				wp_enqueue_style('rtwmer_admin-dashboard', plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-admin-dashboard.css', array(), $this->rtwmer_version, 'all');
			}

			wp_enqueue_style('rtwmer-material-datatable-ajax-css',plugin_dir_url(__FILE__) . 'css/material.min.css', array(), $this->rtwmer_version, 'all');
			wp_enqueue_style('rtwmer-material-datatables-css', plugin_dir_url(__FILE__) . 'css/dataTables.material.min.css', array(), $this->rtwmer_version, 'all');

		}
	}	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function rtwmer_enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the rtwmer_run() function
		 * defined in Mercado_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mercado_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//This Function is used to enqueue all js files


		$rtwmer_current_screen = get_current_screen();

		wp_enqueue_script('deactivation-feedback', plugin_dir_url(__FILE__) . 'js/deactivation-feedback.js', array('jquery'), $this->rtwmer_version, false);
		wp_localize_script('deactivation-feedback', 'deactivationFeedback', array(
			'rtwmer_ajax_url' => admin_url('admin-ajax.php'),
			'pluginSlug' => 'rtwmer-mercado' // Replace with your plugin slug
		));

		if ($rtwmer_current_screen->id == "toplevel_page_rtwmer-mercado") {

			wp_enqueue_script('rtwmer-bundle-js', RTWMER_URL . 'assets/bundle/js/bundle.js', array(), $this->rtwmer_version, 'all');
			wp_enqueue_script('rtwmer-nicescroll', RTWMER_URL . 'assets/jquery.nicescroll.js', array(), $this->rtwmer_version, 'all');
			wp_enqueue_script( 'select2' );
			wp_enqueue_script('rtwmer-material-datatable-js', RTWMER_ASSETS_COMMON_JS . "dataTables.material.min.js", array(), $this->rtwmer_version, 'all');
			wp_enqueue_script($this->rtwmer_plugin_name, plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-admin.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_media();
			wp_enqueue_script('rtwmer-dashboard', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-dashboard.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-report', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-report.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-vendor', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-vendor.js', array('jquery','select2'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-vendor_product', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-vendor_product.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-vendor_order', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-vendor_order.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-settings', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-settings.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-general-setting', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-general-setting.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-selling-option', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-selling-option.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-withdraw-option', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-withdraw-option.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-page-setting', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-page-setting.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-appearence', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-appearence.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-privacy-policy', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-privacy-policy.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('notice-js', RTWMER_ASSETS_URL . '/notify.min.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer_datatable_js', plugin_dir_url(__FILE__) . 'js/jquery.dataTables.min.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer_datatable_buttons', plugin_dir_url(__FILE__).'js/csv-button.min.js', array('jquery','rtwmer_datatable_js'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer_button_html', plugin_dir_url(__FILE__).'js/csv-button-datatable.min.js', array('jquery','rtwmer_datatable_js'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer_dashboard_chart_bundle_js', RTWMER_ASSETS_COMMON_JS . 'Chart.min.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-withdraw', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-withdraw.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer-payment-gateway', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-payment-gateway.js', array('jquery'), $this->rtwmer_version, false);

			//================== this function used to send data through ajax request===============///

			wp_localize_script(
				'rtwmer-dashboard',
				'rtwmer_general_page_object',
				array('rtwmer_ajax_url' => admin_url('admin-ajax.php'), 'rtwmer_general_page_nonce' => wp_create_nonce("rtwmer-mercado-general"), 'rtwmer_translatable_js_strings'=> $this->rtwmer_mercado_translatable_js_strings())
			);

			wp_localize_script(
				'rtwmer-selling-option',
				'rtwmer_sellings_options_object',
				array( 'rtwmer_ajax_url' => admin_url( 'admin-ajax.php' ), 'rtwmer_sellings_option_nonce' => wp_create_nonce('rtwmer-mercado-selling') )
			);

			wp_localize_script(
				'rtwmer-withdraw-option',
				'rtwmer_withdraw_option_object',
				array( 'rtwmer_ajax_url' => admin_url( 'admin-ajax.php' ), 'rtwmer_withdraw_option_nonce' => wp_create_nonce('rtwmer-mercado-withdraw-option') )
			);

			wp_localize_script(
				'rtwmer-page-setting',
				'rtwmer_page_setting_object',
				array( 'rtwmer_ajax_url' => admin_url( 'admin-ajax.php' ), 'rtwmer_page_setting_nonce' => wp_create_nonce('rtwmer-page-settings') )
			);

			wp_localize_script(
				'rtwmer-appearence',
				'rtwmer_appearence_page_object',
				array( 'rtwmer_ajax_url' => admin_url( 'admin-ajax.php' ), 'rtwmer_appearence_nonce' => wp_create_nonce('rtwmer-appearence-nonce') )

			);

			wp_localize_script(
				'rtwmer-privacy-policy',
				'rtwmer_privacy_policy_object',
				array( 'rtwmer_ajax_url' => admin_url( 'admin-ajax.php' ), 'rtwmer_privacy_nonce' => wp_create_nonce('rtwmer-privacy-policy-nonce') )
			);

			wp_localize_script(
				'rtwmer-vendor',
				'rtwmer_vendor_object',
				array( 'rtwmer_ajax_url' => admin_url( 'admin-ajax.php' ), 'rtwmer_vendor_nonce' => wp_create_nonce('rtwmer-vendor-nonce') )
			);

			wp_localize_script(
				'rtwmer-withdraw',
				'ajax_withdraw_object',
				array('rtwmer_ajax_url' => admin_url('admin-ajax.php'), 'rtwmer_withdraw_nonce' => wp_create_nonce('rtwmer-withdraw-nonce'))
			);
		}
	}


//================function is used to remove all notices from mercado dashboard=================//

	function rtwmer_remove_notice(){

		if(is_admin())
		{
			$rtwmer_current_screen = get_current_screen();

			if ($rtwmer_current_screen->id == "toplevel_page_rtwmer-mercado")
			{
				remove_all_actions( 'admin_notices' );
				remove_all_actions('all_admin_notices');
			}
		}
	}

/*=================  Function to add admin menu  ===================*/

	public function rtwmer_add_admin_menu()
	{
		if (current_user_can('manage_options') || is_admin()) {
			global $current_user, $submenu;

			$rtwmer_poosition = '17';
			$rtwmer_function_cb = apply_filters("rtwmer_dashboard_callback", array($this, 'rtwmer_display_admin_section'));
			add_menu_page(esc_html__('Mercado Dashboard', 'rtwmer-mercado'), esc_html__('Mercado', 'rtwmer-mercado'), 'manage_options', 'rtwmer-mercado', $rtwmer_function_cb , RTWMER_URL.'admin/images/mercado_icon.png', $rtwmer_poosition);
		}
	}



	/*=================  Function for popup notification  ===================*/

	function rtwmer_pop_up_notification_cb(){
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_dashboard_page_nonce_verify') )
		{
			if(isset($_POST["rtwmer_condition"]) && ($_POST["rtwmer_condition"] == "checked")){
				update_option("rtwmer_show_offer_popup",False);
				echo json_encode(1);
			}
			if(isset($_POST["rtwmer_condition"]) && ($_POST["rtwmer_condition"] == "unchecked")){
				update_option("rtwmer_show_offer_popup",True);
				echo json_encode(1);
			}
			if(isset($_POST["rtwmer_condition"]) && ($_POST["rtwmer_condition"] == "save_time_stamp")){
				update_option("rtwmer_show_offer_popup_time_stamp",strtotime("now"));
				echo json_encode(1);
			}
		}
		wp_die();
	}

//============== Function to display admin dashboard area =============//

	function rtwmer_display_admin_section()
	{
		 include_once(RTWMER_ADMIN_PARTIAL . 'rtwmer-mercado-admin-display.php');
		?>
		<div id="rtwmer-loader-image">
			<div class="rtwmer-loader-box">
				<div class="rtwmer-reload-loader-img-div">
					<img id="rtwmer-loader-image-tag" src="<?php echo esc_url(RTWMER_URL.'admin/images/loader.gif'); ?>">
				</div>
			</div>
		</div>
		<?php
	}

	//=============Function is used to translate strings/texts which used in javascript======//

	function rtwmer_mercado_translatable_js_strings()
	{
		$rtwmer_mercado_js_translatable_val =  include_once RTWMER_ADMIN_PARTIAL.'/js-translations/rtwmer-mercado-js-translations-string.php';
		return $rtwmer_mercado_js_translatable_val;
	}

	//===================Function when display withdraw section at admin panel=============================//

	function rtwmer_admin_withdraw_cb()
	{
		if( check_ajax_referer('rtwmer-withdraw-nonce','rtwmer_withdraw_nonce_verify') )
		{
			include_once( RTWMER_ADMIN_PARTIAL.'/admin-includes/rtwmer-mercado-withdraw.php' );
		}
	}

//=================Function is used to when withdraw status changed from withdraw status table===============//

	function rtwmer_withdraw_status_cb()
	{
		if( check_ajax_referer('rtwmer-withdraw-nonce','rtwmer_withdraw_status_nonce_verify') )
		{
			include_once( RTWMER_ADMIN_PARTIAL.'/admin-includes/rtwmer-mercado-withdraw-functionality.php' );
		}
	}

//===================Function to get data from withdraw table and shows in note msg===============//

	function rtwmer_withdraw_status_note_cb()
	{
		if( check_ajax_referer('rtwmer-withdraw-nonce','rtwmer_withdraw_status_nonce_verify') )
		{
			if( isset($_POST['rtwmer_withdraw_add_note_id']) && !empty($_POST['rtwmer_withdraw_add_note_id']) )
			{
				global $wpdb;

				$rtwmer_withdraw_note_query = "SELECT note FROM ".$wpdb->prefix."rtwmer_withdraw WHERE id=%d";
				if(isset($rtwmer_withdraw_note_query))
				{
					$rtwmer_withdraw_note_msg = $wpdb->get_results($wpdb->prepare($rtwmer_withdraw_note_query,sanitize_text_field($_POST['rtwmer_withdraw_add_note_id'])));
					if( isset($rtwmer_withdraw_note_msg) && is_array($rtwmer_withdraw_note_msg) )
					{
						if( isset($rtwmer_withdraw_note_msg[0]) )
						{
							if( is_object($rtwmer_withdraw_note_msg[0]) && isset($rtwmer_withdraw_note_msg[0]->note) )
							{
								$rtwmer_withdraw_note_msg = $rtwmer_withdraw_note_msg[0]->note;

								if( isset($rtwmer_withdraw_note_msg) ){
									do_action('rtwmer_withdraw_note_display');
									echo json_encode($rtwmer_withdraw_note_msg,'rtwmer-mercado');
								}
								wp_die();
							}
						}
					}
				}
			}
			wp_die();
		}
	}

//===============Function when display withdraw section's COUNT at admin panel=======================//

	function rtwmer_admin_withdraw_count_cb(){

		if( check_ajax_referer('rtwmer-withdraw-nonce','rtwmer_withdraw_nonce_verify') ) {

			global $wpdb;

			$rtwmer_wp_query = "SELECT COUNT(*) FROM ".$wpdb->prefix."rtwmer_withdraw WHERE `status`=%s";
			if( isset($rtwmer_wp_query) )
			{
				$rtwmer_withdraw_pending_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_wp_query, 'pending' ) );

				$rtwmer_withdraw_approved_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_wp_query, 'approved' ) );

				$rtwmer_withdraw_cancelled_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_wp_query, 'cancelled' ) );

				if( isset($rtwmer_withdraw_pending_count) && isset($rtwmer_withdraw_approved_count) && isset($rtwmer_withdraw_cancelled_count) )
				{
					$rtwmer_withdraw_count = array(
						'rtwmer_withdraw_pending_count' => $rtwmer_withdraw_pending_count,
						'rtwmer_withdraw_approved_count' => $rtwmer_withdraw_approved_count,
						'rtwmer_withdraw_cancelled_count' => $rtwmer_withdraw_cancelled_count
					);
					do_action('rtwmer_withdraw_count',$rtwmer_withdraw_count);
					echo json_encode($rtwmer_withdraw_count);
				}
			}
		}
		wp_die();
	}

//===================== Function which used to ajax request callback of general page==========================//

	function rtwmer_general_page_cb()
	{
		if (check_ajax_referer('rtwmer-mercado-general', 'rtwmer_general_page_nonce_verify'))
		{
			// $_POST['rtwmer_general_settings'] variable holds array

			if (isset($_POST['rtwmer_general_settings']) && is_array($_POST['rtwmer_general_settings']) && !empty($_POST['rtwmer_general_settings']))
			{
				$rtwmer_general_settings_page = $_POST['rtwmer_general_settings'];
				if ( isset($rtwmer_general_settings_page) && is_array($rtwmer_general_settings_page) && !empty($rtwmer_general_settings_page))
				{
					foreach ($rtwmer_general_settings_page as $rtwmer_key => $rtwmer_value)
					{
						if(isset($rtwmer_value))
						{
							$rtwmer_value = sanitize_text_field($rtwmer_value);
							$rtwmer_value = stripslashes($rtwmer_value);
							$rtwmer_general_settings_page[$rtwmer_key] = $rtwmer_value;
						}
					}
					if ( isset($rtwmer_general_settings_page['rtwmer_store_url'] ) && empty($rtwmer_general_settings_page['rtwmer_store_url'] )) {
						$rtwmer_general_settings_page['rtwmer_store_url'] =	'store';
					}
					if ( isset($rtwmer_general_settings_page['rtwmer_wizard_logo_id'] ) && empty($rtwmer_general_settings_page['rtwmer_wizard_logo_id'] )) {
						$rtwmer_general_settings_page['rtwmer_wizard_logo_id'] = get_bloginfo( 'name' );
					}
					update_option('rtwmer_general_setting', $rtwmer_general_settings_page);
					do_action('rtwmer_general_page_setting_data_save');
					echo json_encode(1);
					wp_die();
				}
			}
		}
	}

//===================This Function is callback function of selling options page ajax request===============//

	function rtwmer_selling_options_page_cb()
	{
		if( check_ajax_referer('rtwmer-mercado-selling' , 'rtwmer_sellings_option_nonce_verify' ))
		{
			// $_POST['rtwmer_selling_options'] variable holds array
			if(isset($_POST['rtwmer_selling_options']) && is_array($_POST['rtwmer_selling_options']) && !empty($_POST['rtwmer_selling_options']))
			{
				$rtwmer_selling_options_page = $_POST['rtwmer_selling_options'];
				if( isset($rtwmer_selling_options_page) && is_array($rtwmer_selling_options_page) && !empty($rtwmer_selling_options_page) )
				{
					foreach( $rtwmer_selling_options_page as $rtwmer_key => &$rtwmer_value )
					{
						if(isset($rtwmer_value)){
							$rtwmer_value = sanitize_text_field($rtwmer_value);
							$rtwmer_value = stripslashes($rtwmer_value);
							$rtwmer_selling_options_page[$rtwmer_key] = $rtwmer_value;
						}
					}
					if( isset($rtwmer_selling_options_page['rtwmer_comission_value']) && empty($rtwmer_selling_options_page['rtwmer_comission_value']) )
					{
						$rtwmer_selling_options_page['rtwmer_comission_value'] = 0;
					}
					update_option( 'rtwmer_selling_page', $rtwmer_selling_options_page );
					do_action('rtwmer_selling_option_page_setting_data_save');
					echo json_encode(1);
					wp_die();
				}
			}
		}
	}

//==============This Function is used to manage ajax request of withdraw options tab========================//

	function rtwmer_withdraw_option_page_cb(){

		if( check_ajax_referer('rtwmer-mercado-withdraw-option','rtwmer_withdraw_page_nonce') )
		{
			// $_POST['rtwmer_withdraw_option'] variable holds array

			if( isset($_POST['rtwmer_withdraw_option']) && is_array($_POST['rtwmer_withdraw_option']) && !empty($_POST['rtwmer_withdraw_option']) )
			{
				$rtwmer_withdraw_option_page = $_POST['rtwmer_withdraw_option'];
				if( isset($rtwmer_withdraw_option_page) && is_array($rtwmer_withdraw_option_page) && !empty($rtwmer_withdraw_option_page) )
				{
					foreach( $rtwmer_withdraw_option_page as $rtwmer_key => &$rtwmer_value )
					{
						if(isset($rtwmer_value)){
							$rtwmer_value = sanitize_text_field($rtwmer_value);
							$rtwmer_value = stripslashes($rtwmer_value);
							$rtwmer_withdraw_option_page[$rtwmer_key] = $rtwmer_value;
						}
					}
					if( isset($rtwmer_withdraw_option_page['rtwmer_minimum_withdraw']) && empty($rtwmer_withdraw_option_page['rtwmer_minimum_withdraw']) )
					{
						$rtwmer_withdraw_option_page['rtwmer_minimum_withdraw'] = 0;
					}
					update_option( 'rtwmer_withdraw_option' , $rtwmer_withdraw_option_page );
					do_action('rtwmer_withdraw_option_page_setting_data_save');
					echo json_encode(1);
					wp_die();
				}
			}
		}
	}

//==============================Function is used to manage ajax of payment gateway ppage===================//

	function rtwmer_payment_gateway_page_cb()
	{
		if( check_ajax_referer('rtwmer-mercado-withdraw-option','rtwmer_withdraw_page_nonce') )
		{
			// $_POST['rtwmer_payment_gateway'] variable holds array

			if( isset($_POST['rtwmer_payment_gateway']) && is_array($_POST['rtwmer_payment_gateway']) && !empty($_POST['rtwmer_payment_gateway']) )
			{
				$rtwmer_payment_gateway_page = $_POST['rtwmer_payment_gateway'];
				if( isset($rtwmer_payment_gateway_page) && is_array($rtwmer_payment_gateway_page) && !empty($rtwmer_payment_gateway_page) )
				{
					foreach( $rtwmer_payment_gateway_page as $rtwmer_key => &$rtwmer_value )
					{
						if(isset($rtwmer_value)){
							$rtwmer_value = sanitize_text_field($rtwmer_value);
							$rtwmer_value = stripslashes($rtwmer_value);
							$rtwmer_payment_gateway_page[$rtwmer_key] = $rtwmer_value;
						}
					}
					update_option( 'rtwmer_payment_gateway' , $rtwmer_payment_gateway_page );
					do_action('rtwmer_payment_gateway_page_setting_data_save');
					echo json_encode(1);
					wp_die();
				}
			}
		}
	}

//=====================This Function is used to manage ajax request of page setting tab======================//

	function rtwmer_page_setting_cb(){

		if( check_ajax_referer('rtwmer-page-settings','rtwmer_page_setting_nonce_verify') )
		{
			// $_POST['rtwmer_page_setting'] variable holds array

			if(isset($_POST['rtwmer_page_setting']) && is_array($_POST['rtwmer_page_setting']) && !empty($_POST['rtwmer_page_setting']) )
			{
				$rtwmer_page_setting_data = $_POST['rtwmer_page_setting'];

				if( isset($rtwmer_page_setting_data) && is_array($rtwmer_page_setting_data) && !empty($rtwmer_page_setting_data) )
				{
					foreach ($rtwmer_page_setting_data as $rtwmer_key => $rtwmer_value )
					{
						if(isset($rtwmer_value)){
							$rtwmer_value = sanitize_text_field($rtwmer_value);
							$rtwmer_value = stripslashes($rtwmer_value);
							$rtwmer_page_setting_data[$rtwmer_key] = $rtwmer_value;
						}
					}
					update_option( 'rtwmer_page_setting' , $rtwmer_page_setting_data );
					do_action('rtwmer_page_setting_data_save');

					if(isset($rtwmer_page_setting_data["rtwmer_page_setting_dashboard"]) && !empty($rtwmer_page_setting_data["rtwmer_page_setting_dashboard"])){
						$rtwmer_create_dashboard_page = array(
							'ID'			=>	sanitize_text_field($rtwmer_page_setting_data["rtwmer_page_setting_dashboard"]),
							'post_content'  => '[Vendor_Dashboard]',
							'page_template'  => "rtwmer_vendor_dashboard_template.php"
						);
						wp_update_post( $rtwmer_create_dashboard_page );
					}
					if(isset($rtwmer_page_setting_data["rtwmer_page_store_listing"]) && !empty($rtwmer_page_setting_data["rtwmer_page_store_listing"])){
						$rtwmer_create_store_page = array(
							'ID'			=>	sanitize_text_field($rtwmer_page_setting_data["rtwmer_page_store_listing"]),
							'post_content'  => '[Vendor_Store]',
							'page_template'  => "Vendor-store.php"
						);
						wp_update_post( $rtwmer_create_store_page );
					}
					echo json_encode(1);
					wp_die();
				}
			}
		}
	}

//========================== function to manage ajax request of appearence page================================//

	function rtwmer_appearence_page_cb()
	{
		if( check_ajax_referer( 'rtwmer-appearence-nonce','rtwmer_appearence_nonce_verify' ) )
		{
				// $_POST['rtwmer_appearence_page'] variable holds array
			if( isset($_POST['rtwmer_appearence_page']) && is_array($_POST['rtwmer_appearence_page']) && !empty($_POST['rtwmer_appearence_page']) )
			{
				$rtwmer_appearence_page_data = $_POST['rtwmer_appearence_page'];
				if( isset($rtwmer_appearence_page_data) && is_array($rtwmer_appearence_page_data) && !empty($rtwmer_appearence_page_data) )
				{
					foreach( $rtwmer_appearence_page_data as $rtwmer_key => $rtwmer_value )
					{
						if(isset($rtwmer_value)){
							$rtwmer_value = sanitize_text_field($rtwmer_value);
							$rtwmer_value = stripslashes($rtwmer_value);
							$rtwmer_appearence_page_data[$rtwmer_key] = $rtwmer_value;
						}
					}
					update_option( 'rtwmer_appearence_page', $rtwmer_appearence_page_data );
					do_action('rtwmer_appearence_page_setting_data_save');
					$rtwmer_mercado_url = add_query_arg( array(
                        'page' => 'rtwmer-mercado#dashboard'
                    ),admin_url('admin.php'));

					$url = isset($rtwmer_mercado_url) ? esc_url($rtwmer_mercado_url) : "";
					echo json_encode(array('status'=> true , 'url' => $url ));
					wp_die();
				}
			}
		}
	}

//===================== Function To manage ajax request from privacy policy page============================//

	function rtwmer_setting_privacy_cb(){
		if( check_ajax_referer('rtwmer-privacy-policy-nonce','rtwmer_privacy_policy_page_nonce_verify') )
		{
				// $_POST['rtwmer_privacy_page'] variable holds array
			if( isset($_POST['rtwmer_privacy_page']) && is_array($_POST['rtwmer_privacy_page']) && !empty($_POST['rtwmer_privacy_page']) )
			{
				$rtwmer_privacy_page_data = $_POST['rtwmer_privacy_page'];
				if( isset($rtwmer_privacy_page_data) && is_array($rtwmer_privacy_page_data) && !empty($rtwmer_privacy_page_data) )
				{
					foreach( $rtwmer_privacy_page_data as $rtwmer_key => $rtwmer_value )
					{
						if(isset($rtwmer_value)){
							$rtwmer_value = sanitize_text_field($rtwmer_value);
							$rtwmer_value = stripslashes($rtwmer_value);
							$rtwmer_privacy_page_data[$rtwmer_key] = $rtwmer_value;
						}
					}
					update_option( 'rtwmer_privacy_page', $rtwmer_privacy_page_data );
					do_action('rtwmer_privacy_policy_page_setting_data_save');

					if(isset($rtwmer_privacy_page_data["rtwmer_setting_privacy_page"]) && !empty($rtwmer_privacy_page_data["rtwmer_setting_privacy_page"])){
						$rtwmer_create_dashboard_page = array(
							'ID'			=>	sanitize_text_field($rtwmer_privacy_page_data["rtwmer_setting_privacy_page"]),
							'post_content'  => isset($rtwmer_privacy_page_data["rtwmer_setting_privacy_content"]) ? $rtwmer_privacy_page_data["rtwmer_setting_privacy_content"] : "",
						);
						wp_update_post( $rtwmer_create_dashboard_page );
					}
					echo json_encode(1);
					wp_die();
				}
			}
		}
	}

//===================Function is used to display vendors list at admin panel.==========================//

	function rtwmer_vendors_table_cb() {

		if(check_ajax_referer('rtwmer-vendor-nonce','rtwmer_vendor_nonce_verify'))
		{
			include_once( RTWMER_ADMIN_PARTIAL.'/admin-includes/rtwmer-mercado-vendor-table.php');
		}
	}

// =================Function to be used for showing vendor status active or not.========================//

	function rtwmer_vendor_status_cb()
	{

		if(check_ajax_referer('rtwmer-vendor-nonce','rtwmer_vendor_nonce_verify'))
		{
			if(isset($_POST['rtwmer_vendor_status']) && isset($_POST['rtwmer_vendor_data_id']) )
			{
				$rtwmer_vendor_status = sanitize_text_field($_POST['rtwmer_vendor_status']);
				$rtwmer_vendor_data_id = sanitize_text_field($_POST['rtwmer_vendor_data_id']);
				if( isset($rtwmer_vendor_status) && isset($rtwmer_vendor_data_id) )
				{
					update_user_meta( $rtwmer_vendor_data_id, 'rtwmer_vendor_status' , $rtwmer_vendor_status );
					echo json_encode(1);
					do_action('rtwmer_mercado_vendor_status_changed');
					wp_die();
				}
			}
		}
	}

//============ Function to be used for applying bulk action on vendor's section at admin end====================//

	function rtwmer_vendor_bulk_cb()
	{
		if( check_ajax_referer( 'rtwmer-vendor-nonce','rtwmer_vendor_bulk_nonce_verify' ) )
		{
			// $_POST['rtwmer_vendor_array'] hold array
			if( isset( $_POST['rtwmer_vendor_array'] ) && isset( $_POST['rtwmer_vendor_bulk_action'] ) )
			{
				$rtwmer_vendor_array = $_POST['rtwmer_vendor_array'];
				$rtwmer_vendor_bulk_action = sanitize_text_field($_POST['rtwmer_vendor_bulk_action']);

				if( is_array( $rtwmer_vendor_array ) && !empty( $rtwmer_vendor_array ) )
				{
					foreach( $rtwmer_vendor_array as $rtwmer_key => $rtwmer_value )
					{
						if(isset($rtwmer_value))
						{
							$rtwmer_value = sanitize_text_field( $rtwmer_value );
							$rtwmer_value = stripslashes( $rtwmer_value );
							update_user_meta( $rtwmer_value, 'rtwmer_vendor_status', $rtwmer_vendor_bulk_action ) ;
						}
					}
					echo json_encode(1);
					do_action('rtwmer_mercado_vendor_status_changed');
					wp_die();
				}
			}
		}
	}

	//================display data when click to Edit button from vendorlist section==================//

	function rtwmer_vendors_data_cb() {

		if( check_ajax_referer( 'rtwmer-vendor-nonce','rtwmer_vendors_data_verify' ) )
		{
			if( isset( $_POST['rtwmer_vendor_data_id'] ) )
			{
				$rtwmer_vendors_id = sanitize_text_field($_POST['rtwmer_vendor_data_id']);

				if( isset($rtwmer_vendors_id) && !empty($rtwmer_vendors_id) )
				{
					$rtwmer_vendors_data_db = get_user_meta($rtwmer_vendors_id);

					if(isset($rtwmer_vendors_data_db))
					{
						$rtwmer_vendor_store_img = $rtwmer_vendors_data_db['rtwmer_vendor_store_img'];

						if(isset($rtwmer_vendor_store_img[0]))
						{
							$rtwmer_vendors_data_db['rtwmer_vendor_store_img'] = wp_get_attachment_url( $rtwmer_vendor_store_img[0] );
						}
						if(isset($rtwmer_vendors_data_db['rtwmer_vendor_country'][0]))
						{
							$rtwmer_vendor_sel_country = $rtwmer_vendors_data_db['rtwmer_vendor_country'][0];
							$rtwmer_countries_value  = new WC_Countries();
							if(isset($rtwmer_vendor_sel_country) && isset($rtwmer_countries_value) && is_object($rtwmer_countries_value) )
							{
								$rtwmer_state = $rtwmer_countries_value->get_states($rtwmer_vendor_sel_country);

								if(isset($rtwmer_state))
								{
									$rtwmer_html = '';
									if(is_array($rtwmer_state) && !empty($rtwmer_state) )
									{
										$rtwmer_html = '<select class = rtwmer_vendor_state>';
										$rtwmer_html .= '<option value="">'.esc_html__( 'Select State', 'rtwmer-mercado' ).'</option>';
										foreach( $rtwmer_state as $rtwmer_key_states => $rtwmer_val_state )
										{
											$rtwmer_html .= '<option value="'.esc_attr( $rtwmer_key_states ).'">'.esc_html__( $rtwmer_val_state, 'rtwmer-mercado' ).'</option>';
										}
										$rtwmer_html .= '</select>';
									}
									if( isset($rtwmer_html) )
									{
										$rtwmer_vendors_data_db['rtwmer_vendor_all_state'] = $rtwmer_html;
									}
									if(isset($rtwmer_vendors_data_db))
									{
										do_action('rtwmer_country_changes_to_state');
										echo json_encode($rtwmer_vendors_data_db);
									}
									wp_die();
								}
							}
						}
					}
				}
			}
			wp_die();
		}
	}

//=========function used to select country and state in edit vendor details section at admin panel in vendor========//

	function rtwmer_vendor_selected_country_cb() {

		if( check_ajax_referer( 'rtwmer-vendor-nonce','rtwmer_vendor_sel_count_nonce' ) )
		{
			if( isset($_POST['rtwmer_vendor_selected_country']) )
			{
				$rtwmer_vendor_sel_country = sanitize_text_field($_POST['rtwmer_vendor_selected_country']);
				$rtwmer_countries_value  = new WC_Countries();
				if( isset($rtwmer_vendor_sel_country) && isset($rtwmer_countries_value) )
				{
					$rtwmer_state = $rtwmer_countries_value->get_states($rtwmer_vendor_sel_country);

					$rtwmer_html = '';

					if( isset($rtwmer_state) && is_array($rtwmer_state) && !empty($rtwmer_state) )
					{
						$rtwmer_html = '<select class = rtwmer_vendor_state>';
						$rtwmer_html .= '<option value="">'.esc_html__( 'Select State', 'rtwmer-mercado' ).'</option>';
						foreach( $rtwmer_state as $states => $state )
						{
							$rtwmer_html .= '<option value="'.esc_attr( $states ).'">'.esc_html__( $state, 'rtwmer-mercado' ).'</option>';
						}
						$rtwmer_html .= '</select>';
					}
					do_action('rtwmer_country_changes_to_state');
					echo json_encode( $rtwmer_html );
				}
				wp_die();
			}
		}
	}

//=================== Function used when admin update any vendor's data from admin panel=======================//

	function rtwmer_edit_vendors_data_cb() {

		if( check_ajax_referer( 'rtwmer-vendor-nonce','rtwmer_vendors_data_verify' ) )
		{
			include_once( RTWMER_ADMIN_PARTIAL.'/admin-includes/rtwmer-mercado-vendor-edit.php' );
		}
	}

//===============Function views when product table gets Launch at admin dashboard========================//

	function rtwmer_vendors_product_cb() {

		if(check_ajax_referer('rtwmer-vendor-nonce','rtwmer_vendor_nonce_verify'))
		{
			include_once( RTWMER_ADMIN_PARTIAL.'/admin-includes/rtwmer-mercado-product-table.php' );
		}
	}

//==================================Fires when create an user form admin panel===============================//

	function rtwmer_user_register_cb($rtwmer_current_registerd_user)
	{
		$rtwmer_current_registerd_user_data = get_userdata($rtwmer_current_registerd_user);

		if( isset($rtwmer_current_registerd_user_data) )
		{
			$rtwmer_current_registerd_user_role = $rtwmer_current_registerd_user_data->roles;
			if( isset($rtwmer_current_registerd_user_role[0]) )
			{
				if( in_array('administrator',$rtwmer_current_registerd_user_role) || in_array('rtwmer_vendor',$rtwmer_current_registerd_user_role) )
				{
					if( !empty(get_option('rtwmer_selling_page')) )
					{
						$rtwmer_selling_page = get_option('rtwmer_selling_page');

						if(isset($rtwmer_selling_page))
						{
							if( isset($rtwmer_selling_page['rtwmer_allow_add_product']) )
							{
								if( $rtwmer_selling_page['rtwmer_allow_add_product'] == 1 )
								{
									update_user_meta($rtwmer_current_registerd_user, 'rtwmer_vendor_status', 1);
								}
								else
								{
									update_user_meta($rtwmer_current_registerd_user, 'rtwmer_vendor_status', 0);
								}
							}
						}
					}
					do_action('rtwmer_creating_new_vendor');
					update_user_meta( $rtwmer_current_registerd_user, 'rtwmer_vendor_store_img', 0 );
					update_user_meta( $rtwmer_current_registerd_user, 'rtwmer_store_name', '(no name)' );
					update_user_meta( $rtwmer_current_registerd_user, 'rtwmer_role', 'rtwmer_vendor' );
				}
			}
		}

	}

//=============Function is used to product tab count at product table=======================///

	function rtwmer_prod_tab_count_cb() {

		if(check_ajax_referer('rtwmer-vendor-nonce','rtwmer_vendor_nonce_verify'))
		{
			global $wpdb;

			if( isset( $_POST['rtwmer_product_author_id'] ) && !empty( $_POST['rtwmer_product_author_id'] ) )
            {
				$rtwmer_prod_auth_id = sanitize_text_field($_POST['rtwmer_product_author_id']);

				if(isset($rtwmer_prod_auth_id))
				{
					$rtwmer_prod_query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = '%s' AND post_author = ".$rtwmer_prod_auth_id." AND (post_status = 'draft' OR post_status = 'private' OR post_status = 'publish' OR post_status = 'pending' ) " ;
					if( isset($rtwmer_prod_query) )
					{
						$rtwmer_prod_all_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_prod_query, 'product' ) );
					}

					$rtwmer_prod_query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = ".$rtwmer_prod_auth_id."";

					if( isset($rtwmer_prod_query ) )
					{
						$rtwmer_prod_publish_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_prod_query, 'publish' ),0 );

						$rtwmer_prod_private_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_prod_query, 'private' ),0 );

						$rtwmer_prod_draft_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_prod_query, 'draft' ),0 );

						$rtwmer_prod_pending_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_prod_query, 'pending' ),0 );

						$rtwmer_prod_trash_count = $wpdb->get_var( $wpdb->prepare( $rtwmer_prod_query, 'trash' ),0 );

						$rtwmer_prod_count_array = array(
							'rtwmer_prod_auth_id' => isset($rtwmer_prod_auth_id) ? $rtwmer_prod_auth_id : 0,
							'rtwmer_prod_all_count' => isset($rtwmer_prod_all_count) ? $rtwmer_prod_all_count : 0,
							'rtwmer_prod_publish_count' => isset($rtwmer_prod_publish_count) ? $rtwmer_prod_publish_count : 0,
							'rtwmer_prod_draft_count' => isset($rtwmer_prod_draft_count) ? $rtwmer_prod_draft_count : 0,
							'rtwmer_prod_pending_count' => isset($rtwmer_prod_pending_count) ? $rtwmer_prod_pending_count : 0,
							'rtwmer_prod_trash_count' => isset($rtwmer_prod_trash_count) ? $rtwmer_prod_trash_count : 0,
							'rtwmer_prod_private_count' => isset($rtwmer_prod_private_count) ? $rtwmer_prod_private_count : 0
						);

						update_option( 'rtwmer_prod_count_vend_id',$rtwmer_prod_count_array['rtwmer_prod_auth_id'] );
						do_action('rtwmer_product_counts',$rtwmer_prod_count_array);
						echo json_encode($rtwmer_prod_count_array);
					}
				}
				wp_die();
			}
		}

	}

//=================Function activates when admin clicks on product edit, to generate link for edit partiucular=======//

	function rtwmer_prod_edit_cb()
	{
		if(check_ajax_referer('rtwmer-vendor-nonce','rtwmer_vendor_nonce_verify'))
		{
			if( current_user_can('manage_options') )
			{
				if( isset($_POST['rtwmer_edit_prod_id']) && !empty($_POST['rtwmer_edit_prod_id']))
				{
					$rtwmer_edit_prod_id = sanitize_text_field($_POST['rtwmer_edit_prod_id']);

					if( isset($rtwmer_edit_prod_id) && !empty($rtwmer_edit_prod_id) )
					{
						$rtwmer_prod_edit_url = add_query_arg( array(
							'post' => $rtwmer_edit_prod_id,
							'action' => 'edit',
							'rtwmer_prod_hide' => 'true'
							),admin_url('post.php'));

						$rtwmer_edit_prod_author_id = get_post_field('post_author',$rtwmer_edit_prod_id);
						if( isset($rtwmer_edit_prod_author_id) && isset($rtwmer_prod_edit_url) )
						{
							$rtwmer_edit_prod_array = array(
								'rtwmer_prod_edit_url' => $rtwmer_prod_edit_url,
								'rtwmer_edit_prod_author_id' => $rtwmer_edit_prod_author_id
							);
							if( isset($rtwmer_edit_prod_array) )
							{
								do_action('rtwmer_edit_product_redirected_url',$rtwmer_edit_prod_array);
								echo json_encode($rtwmer_edit_prod_array);
							}
						}
						wp_die();
					}
				}
			}
		}
	}

//============================This function is used to enqueue css in iframes=========================//

	function rtwmer_add_meta_boxes_cb()
	{
		add_meta_box( 'rtwmer_meta_box','Assign To', array($this,'rtwmer_add_meta_cb' ),'product');

		if( isset($_GET['rtwmer_prod_hide']) && !empty($_GET['rtwmer_prod_hide']) )
		{
			$rtwmer_hide_url = sanitize_text_field($_GET['rtwmer_prod_hide']);

			if( isset($rtwmer_hide_url) )
			{
				if($_GET['rtwmer_prod_hide'] == $rtwmer_hide_url)
				{
					wp_enqueue_style($this->rtwmer_plugin_name, plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-admin.css', array(), $this->rtwmer_version, 'all');
					wp_enqueue_script('rtwmer-vendor_product', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-vendor_product.js', array('jquery'), $this->rtwmer_version, false);
				}
			}
		}
		do_action('rtwmer_add_meta_box_for_assigining_vendor_to_product');
	}

//============function used to assign product according to vendors while creating a new product==============//

	function rtwmer_add_meta_cb() {

		if( isset($_GET['rtwmer_assigning_vendor']) )
		{
			global $post;

			$rtwmer_meta_args = array(
				'role__in' => array( 'rtwmer_vendor','administrator' ),
				'id' => 'rtwmer_metaboxes_vend_id',
				'selected' => sanitize_text_field($_GET['rtwmer_assigning_vendor']),
				'name'	=> 'rtwmer_assigning_user'
			);
			wp_dropdown_users($rtwmer_meta_args);
		}
		else
		{
			global $post;

			$rtwmer_meta_args = array(
				'role__in' => array( 'rtwmer_vendor','administrator' ),
				'id' => 'rtwmer_metaboxes_vend_id',
				'selected' => $post->post_author,
				'name'	=> 'rtwmer_assigning_user'
			);
			wp_dropdown_users($rtwmer_meta_args);
		}
		do_action("rtwmer_add_field_in_vendor_metabox");
	}

//=============================This function triggers when admin clicks to add new product================//

	function rtwmer_prod_add_new_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_vendor_nonce_verify') )
		{
			do_action("rtwmer_add_query_for_meta_box");
			if( isset($_POST['rtwmer_assigning_vendor']) && !empty($_POST['rtwmer_assigning_vendor']) )
			{
				$rtwmer_prod_add_url = add_query_arg(array('post_type'=>'product','rtwmer_prod_hide' => 'true','rtwmer_assigning_vendor'=>sanitize_text_field($_POST['rtwmer_assigning_vendor'])),admin_url('post-new.php'));

				if( isset($rtwmer_prod_add_url) )
				{
					echo json_encode($rtwmer_prod_add_url);
				}
				wp_die();
			}
		}
	}

//=================Function activates when admin post product/ add new product from iframe=============//

	function rtwmer_mercado_redirect_post_location_cb($rtwmer_prod_location,$rtwmer_prod_id)
	{
		if( isset($_POST) && !empty($_POST) && is_array($_POST))
		{
			if( isset($_POST['rtwmer_assigning_user']) && !empty($_POST['rtwmer_assigning_user']) )
			{
				if( isset($_POST['post_ID']) && !empty($_POST['post_ID']) )
				{
					$rtwmer_update_user = array(
						'ID' => sanitize_text_field($_POST['post_ID']),
						'post_author' => sanitize_text_field($_POST['rtwmer_assigning_user']),
					);

					wp_update_post($rtwmer_update_user);

				}
			}
		}
		if( !empty($_SERVER['HTTP_REFERER']) )
		{
			if( strstr($_SERVER['HTTP_REFERER'],'rtwmer_prod_hide=true') )
			{
				$rtwmer_prod_location = add_query_arg( array(
					'rtwmer_prod_hide' => 'true',
				), $rtwmer_prod_location) ;

				return $rtwmer_prod_location;

			}
			else
			{
				return $rtwmer_prod_location;
			}
		}
		else
		{
			return $rtwmer_prod_location;
		}
	}

//=========== This function is used to display data of quick edit section in product table page	=============//

	function rtwmer_prod_quick_edit_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_vendor_nonce_verify') )
		{
			if( isset($_POST['rtwmer_prod_quick_edit_id']) && !empty($_POST['rtwmer_prod_quick_edit_id']) )
			{
				$rtwmer_prod_quick_edit_id = sanitize_text_field($_POST['rtwmer_prod_quick_edit_id']);
				if( isset($rtwmer_prod_quick_edit_id) && !empty($rtwmer_prod_quick_edit_id) )
				{
					$rtwmer_prod_quick_post = get_post($rtwmer_prod_quick_edit_id);
					if( isset($rtwmer_prod_quick_post) && is_object($rtwmer_prod_quick_post) && !empty( $rtwmer_prod_quick_post ) )
					{
						$rtwmer_post_prod = array(
							'rtwmer_prod_post_title' => isset($rtwmer_prod_quick_post->post_title) ? $rtwmer_prod_quick_post->post_title : '',
							'rtwmer_prod_post_slug' => isset($rtwmer_prod_quick_post->post_name) ? $rtwmer_prod_quick_post->post_name : '',
							'rtwmer_prod_post_date' => date("j/m/Y", strtotime(isset($rtwmer_prod_quick_post->post_date) ? $rtwmer_prod_quick_post->post_date : '')),
							'rtwmer_prod_post_time' => date("h:i:s", strtotime(isset($rtwmer_prod_quick_post->post_date) ? $rtwmer_prod_quick_post->post_date : '')),
							'rtwmer_prod_post_password' => isset($rtwmer_prod_quick_post->post_password) ? $rtwmer_prod_quick_post->post_password : '',
							'rtwmer_prod_post_status' => isset($rtwmer_prod_quick_post->post_status) ? $rtwmer_prod_quick_post->post_status : '',
							'rtwmer_prod_comment_status' => isset($rtwmer_prod_quick_post->comment_status) ? $rtwmer_prod_quick_post->comment_status : ''
						);
					}

				$rtwmer_prod_tag = wp_get_post_terms( $rtwmer_prod_quick_edit_id, 'product_tag', array( 'fields' => 'names' )  );

					$rtwmer_prod_tag_val = "";

					if( is_array($rtwmer_prod_tag) && !empty($rtwmer_prod_tag) )
					{

						foreach( $rtwmer_prod_tag as $rtwmer_name )
						{
							if( isset($rtwmer_name) && !empty($rtwmer_name) )
							{
								if( !empty($rtwmer_prod_tag_val) && ( !empty($rtwmer_name) ) )
								{
									$rtwmer_prod_tag_val .= ", ". $rtwmer_name;
								}
								else
								{
									$rtwmer_prod_tag_val = $rtwmer_name;
								}
							}

						}
					}

					$rtwmer_prod_shpping_class = wp_get_post_terms( $rtwmer_prod_quick_edit_id,'product_shipping_class',array( 'fields' => 'slugs' ) );

						if( isset($rtwmer_prod_shpping_class) && is_array($rtwmer_prod_shpping_class) && !empty($rtwmer_prod_shpping_class) )
						{
							if( isset($rtwmer_prod_shpping_class[0]) )
							{
								$rtwmer_prod_shpping_class_val = $rtwmer_prod_shpping_class[0];
							}
						}

					$rtwmer_prod_prod_visibility = wp_get_post_terms( $rtwmer_prod_quick_edit_id,'product_visibility',array( 'fields' => 'slugs' ) );

						if( isset($rtwmer_prod_prod_visibility) && empty($rtwmer_prod_prod_visibility) )
						{
							$rtwmer_prod_prod_visibile_slug = "visible";
						}
						if( count($rtwmer_prod_prod_visibility) == 1 )
						{
							if( isset($rtwmer_prod_prod_visibility[0]) && !empty($rtwmer_prod_prod_visibility[0]) )
							{
								if( $rtwmer_prod_prod_visibility[0] == 'outofstock' )
								{
									$rtwmer_prod_prod_visibile_slug = "visible";
								}
							}
						}
						if( isset($rtwmer_prod_prod_visibility) && !empty($rtwmer_prod_prod_visibility) )
						{
							if( in_array('exclude-from-search',$rtwmer_prod_prod_visibility) )
							{
								$rtwmer_prod_prod_visibile_slug = "catalog";
							}
							if( in_array('exclude-from-catalog',$rtwmer_prod_prod_visibility) )
							{
								$rtwmer_prod_prod_visibile_slug = "search";
							}
							if( (in_array('exclude-from-search',$rtwmer_prod_prod_visibility)) && (in_array('exclude-from-catalog',$rtwmer_prod_prod_visibility)) )
							{
								$rtwmer_prod_prod_visibile_slug = "hidden";
							}
							if( in_array( 'featured',$rtwmer_prod_prod_visibility ) )
							{
								$rtwmer_prod_prod_featured_slug = "featured";
							}
						}

					$rtwmer_prod_post_cat = wp_get_post_terms( $rtwmer_prod_quick_edit_id,'product_cat',array( 'fields' => 'names' ) );

					$rtwmer_post_meta_prod = array(
						'rtwmer_prod_post_sku' => get_post_meta($rtwmer_prod_quick_edit_id,'_sku',true),
						'rtwmer_prod_post_reg_price' => get_post_meta($rtwmer_prod_quick_edit_id,'_regular_price',true),
						'rtwmer_prod_post_sale_price' => get_post_meta($rtwmer_prod_quick_edit_id,'_sale_price',true),
						'rtwmer_prod_post_stock_qty' => get_post_meta($rtwmer_prod_quick_edit_id,'_stock',true),
						'rtwmer_prod_post_stock_status' => get_post_meta($rtwmer_prod_quick_edit_id,'_stock_status',true),
						'rtwmer_prod_post_weight' => get_post_meta($rtwmer_prod_quick_edit_id,'_weight',true),
						'rtwmer_prod_post_length' => get_post_meta($rtwmer_prod_quick_edit_id,'_length',true),
						'rtwmer_prod_post_width' => get_post_meta($rtwmer_prod_quick_edit_id,'_width',true),
						'rtwmer_prod_post_height' => get_post_meta($rtwmer_prod_quick_edit_id,'_height',true),
						'rtwmer_prod_post_manage_stock' => get_post_meta($rtwmer_prod_quick_edit_id,'_manage_stock',true),
						'rtwmer_prod_post_backorders' => get_post_meta($rtwmer_prod_quick_edit_id,'_backorders',true),
						'rtwmer_prod_tag_val' => (isset($rtwmer_prod_tag_val) ? $rtwmer_prod_tag_val : ""),
						'rtwmer_prod_shpping_class_val' => (isset($rtwmer_prod_shpping_class_val) ? $rtwmer_prod_shpping_class_val : ""),
						'rtwmer_prod_prod_visibile_slug' => (isset($rtwmer_prod_prod_visibile_slug) ? $rtwmer_prod_prod_visibile_slug : ""),
						'rtwmer_prod_prod_featured_slug' => (isset($rtwmer_prod_prod_featured_slug) ? $rtwmer_prod_prod_featured_slug : ""),
						'rtwmer_prod_post_cat' => (isset($rtwmer_prod_post_cat) ? $rtwmer_prod_post_cat : "")
					);

					if( (isset($rtwmer_post_prod) && !empty($rtwmer_post_prod) ) && ( isset($rtwmer_post_meta_prod) && !empty($rtwmer_post_meta_prod) ) )
					{
						$rtwmer_post_prod_all = array_merge($rtwmer_post_prod,$rtwmer_post_meta_prod);
						if( isset($rtwmer_post_prod_all) && !empty($rtwmer_post_prod_all) )
						{
							do_action('rtwmer_product_quick_edit_data',$rtwmer_post_prod_all);
							echo json_encode($rtwmer_post_prod_all);
							wp_die();
						}
					}
				}
			}
		}
	}

//================Function came into action when admin click to quick edit section of product page=============//

	function rtwmer_prod_quick_edit_action_cb() {

		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_prod_quick_edit_nonce_verify') )
		{
			// $_POST['rtwmer_prod_quick_edit'] variable holds array

			if( isset($_POST['rtwmer_prod_quick_edit']) && !empty($_POST['rtwmer_prod_quick_edit']) )
			{
				$rtwmer_prod_quick_edit = $_POST['rtwmer_prod_quick_edit'];

				if( isset($rtwmer_prod_quick_edit) && is_array($rtwmer_prod_quick_edit) && !empty($rtwmer_prod_quick_edit) )
				{
					if( isset($rtwmer_prod_quick_edit['rtwmer_quick_edit_update']) && !empty($rtwmer_prod_quick_edit['rtwmer_quick_edit_update']) )
					{
						$rtwmer_quick_edit_update_id = sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_quick_edit_update']);
						if( isset($rtwmer_quick_edit_update_id) && !empty($rtwmer_quick_edit_update_id) )
						{
							if( (isset($rtwmer_prod_quick_edit['rtwmer_prod_title']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_title'])) && (isset($rtwmer_prod_quick_edit['rtwmer_prod_slug'])) && (isset($rtwmer_prod_quick_edit['rtwmer_prod_publish_date'])) )
							{
								$rtwmer_prod_publish_date = str_replace("/","-", $rtwmer_prod_quick_edit['rtwmer_prod_publish_date']);
								$rtwmer_prod_publish_date_last = date("Y-m-j h:i:s", strtotime($rtwmer_prod_publish_date));

								do_action('rtwmer_quick_edit_section_updatation');

								$rwmer_prod_quick_edit_post = array(
									'ID' => sanitize_text_field($rtwmer_quick_edit_update_id),
									'post_title' => sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_title']),
									'post_name' => sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_slug']),
									'post_date' => (isset($rtwmer_prod_publish_date_last) ? $rtwmer_prod_publish_date_last : "0000-00-00 00:00:00")
								);

								wp_update_post($rwmer_prod_quick_edit_post);
							}

							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_private']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_private']) )
							{
								$rtwmer_prod_status = array(
									'ID' => sanitize_text_field($rtwmer_quick_edit_update_id),
									'post_status' => sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_private']),
								);
								wp_update_post($rtwmer_prod_status);
							}

							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_password']) )
							{
								$rtwmer_prod_pass = array(
									'ID' => sanitize_text_field($rtwmer_quick_edit_update_id),
									'post_password' => sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_password']),
								);
								wp_update_post($rtwmer_prod_pass);
							}

							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_tag']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_tag']) )
							{
								wp_set_object_terms($rtwmer_quick_edit_update_id, $rtwmer_prod_quick_edit['rtwmer_prod_tag'], 'product_tag');
							}

							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_enable_reviews']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_enable_reviews']) )
							{
								$rtwmer_prod_reviews = array(
									'ID' => sanitize_text_field($rtwmer_quick_edit_update_id),
									'comment_status' => sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_enable_reviews']),
								);
								wp_update_post($rtwmer_prod_reviews);
							}
							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_status']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_status']) )
							{
								$rtwmer_prod_reviews = array(
									'ID' => sanitize_text_field($rtwmer_quick_edit_update_id),
									'post_status' => sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_status']),
								);
								wp_update_post($rtwmer_prod_reviews);
							}

							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_sku']) && isset($rtwmer_prod_quick_edit['rtwmer_prod_reg_price']) && isset($rtwmer_prod_quick_edit['rtwmer_prod_sale_price']) && isset($rtwmer_prod_quick_edit['rtwmer_prod_weight']) && isset($rtwmer_prod_quick_edit['rtwmer_prod_length']) && isset($rtwmer_prod_quick_edit['rtwmer_prod_width']) && isset($rtwmer_prod_quick_edit['rtwmer_prod_height']) )
							{
								update_post_meta( $rtwmer_quick_edit_update_id,'_sku',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_sku'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_regular_price',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_reg_price'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_sale_price',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_sale_price'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_weight',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_weight'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_length',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_length'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_width',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_width'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_height',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_height'] ));
							}

							if( (isset($rtwmer_prod_quick_edit['rtwmer_prod_sale_price']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_sale_price']) ) )
							{
								update_post_meta( $rtwmer_quick_edit_update_id,'_price',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_sale_price'] ));
							}
							else
							{
								update_post_meta( $rtwmer_quick_edit_update_id,'_price',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_reg_price'] ));
							}

							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_visibility_array']) )
							{
								wp_set_object_terms( $rtwmer_quick_edit_update_id, $rtwmer_prod_quick_edit['rtwmer_prod_visibility_array'], 'product_visibility' );
							}

							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_shipping_class']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_shipping_class']) )
							{
								wp_set_object_terms( $rtwmer_quick_edit_update_id,$rtwmer_prod_quick_edit['rtwmer_prod_shipping_class'],'product_shipping_class' );
							}

							if( ( isset($rtwmer_prod_quick_edit['rtwmer_prod_stock_status']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_stock_status']) ) && isset($rtwmer_prod_quick_edit['rtwmer_prod_stock_qty']) && isset($rtwmer_prod_quick_edit['rtwmer_prod_backorders']) )
							{
								update_post_meta( $rtwmer_quick_edit_update_id,'_stock_status',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_stock_status'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_stock',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_stock_qty'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_backorders',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_backorders'] ));
								update_post_meta( $rtwmer_quick_edit_update_id,'_manage_stock',sanitize_text_field($rtwmer_prod_quick_edit['rtwmer_prod_backorders'] ));
							}

							if( isset($rtwmer_prod_quick_edit['rtwmer_prod_post_cat_array']) && !empty($rtwmer_prod_quick_edit['rtwmer_prod_post_cat_array']) )
							{
								wp_set_object_terms( $rtwmer_quick_edit_update_id,$rtwmer_prod_quick_edit['rtwmer_prod_post_cat_array'],'product_cat' );
							}

							$rtwmer_quick_edit_author_id = get_post_field('post_author',$rtwmer_quick_edit_update_id);
							if( isset($rtwmer_quick_edit_author_id) )
							{
								do_action('rtwmer_product_quick_edit_update');
								echo json_encode($rtwmer_quick_edit_author_id);
							}
						}
						wp_die();
					}
				}
			}
		}
	}

//===================== Function is used to trash posts from admin panel============================//

	function rtwmer_prod_trash_action_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_prod_trash_verify') )
		{
			if( isset($_POST['rtwmer_prod_trash_id']) && !empty($_POST['rtwmer_prod_trash_id']) )
			{
				$rtwmer_prod_trash_id = sanitize_text_field($_POST['rtwmer_prod_trash_id']);
				if( isset($rtwmer_prod_trash_id) && !empty($rtwmer_prod_trash_id) )
				{
					do_action('rtwmer_product_before_send_to_trash');
					wp_trash_post($rtwmer_prod_trash_id);
					do_action('rtwmer_product_after_send_to_trash');
					$rtwmer_trash_post_author = get_post_field( 'post_author',$rtwmer_prod_trash_id );
					if( isset($rtwmer_trash_post_author) && !empty($rtwmer_trash_post_author) )
					{
						echo json_encode($rtwmer_trash_post_author);
					}
					wp_die();
				}
			}
		}

	}
//============ Function is used to display preivew of products from product page=======//

	function rtwmer_prod_preview_action_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_prod_preview_verify') )
		{
			if( isset($_POST['rtwmer_prod_preview_id']) && !empty($_POST['rtwmer_prod_preview_id']) )
			{
				$rtwmer_prod_preview_id = sanitize_text_field($_POST['rtwmer_prod_preview_id']);
				if( isset($rtwmer_prod_preview_id) && !empty($rtwmer_prod_preview_id) )
				{
					$rtwmer_prod_preview_url = add_query_arg( array(
						'post_type' => 'product',
						'p'	=> $rtwmer_prod_preview_id,
						'preview' => 'true'
					), site_url().'/' );
					if(isset($rtwmer_prod_preview_url))
					{
						do_action('rtwmer_redirect_for_prod_preview',$rtwmer_prod_preview_url);
						echo json_encode($rtwmer_prod_preview_url);
					}
					wp_die();
				}
			}
		}
	}

//===================== Function is used to trash posts from admin panel============================//

	function rtwmer_prod_restore_action_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_prod_restore_verify') )
		{
			if( isset($_POST['rtwmer_prod_restore_id']) && !empty($_POST['rtwmer_prod_restore_id']) )
			{
				$rtwmer_prod_restore_id = sanitize_text_field($_POST['rtwmer_prod_restore_id']);
				if( isset($rtwmer_prod_restore_id) && !empty($rtwmer_prod_restore_id) )
				{
					wp_untrash_post($rtwmer_prod_restore_id);
					do_action('rtwmer_product_restored_from_trash');
					$rtwmer_restore_post_author = get_post_field( 'post_author',$rtwmer_prod_restore_id );
					if( isset($rtwmer_restore_post_author) && !empty($rtwmer_restore_post_author) )
					{
						echo json_encode($rtwmer_restore_post_author);
					}
					wp_die();
				}
			}
		}
	}

//===================== Function is used to Delete Permanentaly from admin panel============================//

	function rtwmer_prod_delete_action_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_prod_delete_verify') )
		{
			if( isset($_POST['rtwmer_prod_delete_id']) && !empty($_POST['rtwmer_prod_delete_id']) )
			{
				$rtwmer_prod_delete_id = sanitize_text_field($_POST['rtwmer_prod_delete_id']);
				if( isset($rtwmer_prod_delete_id) && !empty($rtwmer_prod_delete_id) )
				{
					$rtwmer_delete_post_author = get_post_field( 'post_author',$rtwmer_prod_delete_id );
					if( isset($rtwmer_delete_post_author) && !empty($rtwmer_delete_post_author) )
					{
						echo json_encode($rtwmer_delete_post_author);
					}
					do_action('rtwmer_product_delete');
					wp_delete_post($rtwmer_prod_delete_id);
					wp_die();
				}
			}
		}
	}

//===================== Function is used to apply bulk action from product table============================//

	function rtwmer_prod_checkboxes_action_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_prod_checkboxes_verify') )
		{
			if( isset($_POST['rtwmer_prod_bulk_action_val']) && !empty($_POST['rtwmer_prod_bulk_action_val']) )
			{
				$rtwmer_prod_bulk_action_val = sanitize_text_field($_POST['rtwmer_prod_bulk_action_val']);
				if( isset($rtwmer_prod_bulk_action_val) && !empty($rtwmer_prod_bulk_action_val) )
				{
					// $_POST['rtwmer_prod_checkboxes'] variable holds array

					if( isset($_POST['rtwmer_prod_checkboxes']) && !empty($_POST['rtwmer_prod_checkboxes']) )
					{
						$rtwmer_prod_checkboxes = $_POST['rtwmer_prod_checkboxes'];
						if( isset($rtwmer_prod_checkboxes) && is_array($rtwmer_prod_checkboxes) && !empty($rtwmer_prod_checkboxes) )
						{
							$rtwmer_checkboxes_post_author = get_post_field( 'post_author',sanitize_text_field($rtwmer_prod_checkboxes[0]) );
							if( isset($rtwmer_checkboxes_post_author) && !empty($rtwmer_checkboxes_post_author) )
							{
								echo json_encode($rtwmer_checkboxes_post_author);
							}
							foreach( $rtwmer_prod_checkboxes as $checkbox )
							{
								if( isset($checkbox) && !empty($checkbox) )
								{
									$checkbox = sanitize_text_field($checkbox);

									if( $rtwmer_prod_bulk_action_val == 'rtwmer_bulk_trash_prod' )
									{
										do_action('rtwmer_product_before_send_to_trash');
										wp_trash_post($checkbox);
										do_action('rtwmer_product_after_send_to_trash');
									}
									if( $rtwmer_prod_bulk_action_val == 'rtwmer_bulk_restore_prod' )
									{
										wp_untrash_post($checkbox);
										do_action('rtwmer_product_restored_from_trash');
									}
									if( $rtwmer_prod_bulk_action_val == 'rtwmer_bulk_delete_prod' )
									{
										do_action('rtwmer_product_delete');
										wp_delete_post($checkbox);
									}
								}
							}
						}
					}
					wp_die();
				}
			}
		}
	}

//=============Function is used when duppliacte product gets created from iframe section======================//

	function rtwmer_admin_url_cb($rtwmer_admin_url,$rtwmer_admin_path,$rtwmer_admin_blog_id)
	{
		if( isset($rtwmer_admin_url) )
		{
			if( strstr($rtwmer_admin_url,'action=edit') )
			{
				if( isset($_GET['rtwmer_prod_hide']) && !empty($_GET['rtwmer_prod_hide']) )
				{
					if( $_GET['rtwmer_prod_hide'] == 'true' )
					{
						if( isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) )
						{
							if(strstr($_SERVER['HTTP_REFERER'],'rtwmer-mercado'))
							{
								$rtwmer_admin_url = add_query_arg(array(
									'rtwmer_prod_hide' => 'true',
								),$rtwmer_admin_url);
								return $rtwmer_admin_url;
							}
						}
					}
				}
				if( isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) )
				{
					if(strstr($_SERVER['HTTP_REFERER'],'rtwmer_prod_hide=true'))
					{
						$rtwmer_admin_url = add_query_arg(array(
							'rtwmer_prod_hide' => 'true',
						),$rtwmer_admin_url);
						return $rtwmer_admin_url;
					}
					else
					{
						return $rtwmer_admin_url;
					}
				}
				else
				{
					return $rtwmer_admin_url;
				}

			}
			else
			{
				return $rtwmer_admin_url;
			}
		}
	}

//====================When activates when click on to create duplicate product from product table===========///

	function rtwmer_duplicate_prod_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_duplicate_nonce_verify') )
		{
			if( isset($_POST['rtwmer_prod_dupplicate_id']) && !empty($_POST['rtwmer_prod_dupplicate_id']) )
			{
				$rtwmer_prod_duplicate_author = get_post_field( 'post_author',$_POST['rtwmer_prod_dupplicate_id'] );
				if( isset($rtwmer_prod_duplicate_author) && !empty($rtwmer_prod_duplicate_author) )
				{
					$rtwmer_wc_dup_prod = new WC_Admin_Duplicate_Product;
					$rtwmer_dup_prod = $rtwmer_wc_dup_prod->product_duplicate( wc_get_product( sanitize_text_field($_POST['rtwmer_prod_dupplicate_id'] )) );
					if( isset($rtwmer_dup_prod) && is_object($rtwmer_dup_prod) && isset($rtwmer_dup_prod->id) )
					{
						$rtwmer_duplicate_post = array(
							'ID'  => sanitize_text_field($rtwmer_dup_prod->id),
							'post_author' => sanitize_text_field($rtwmer_prod_duplicate_author)
						);
						wp_update_post( $rtwmer_duplicate_post );

						$rtwmer_prod_dup_add_url = add_query_arg(

							array(
							'action' => 'edit',
							'post' => $rtwmer_dup_prod->id,
							'rtwmer_prod_hide' => 'true',
							),admin_url('post.php'));

						if(isset($rtwmer_prod_dup_add_url))
						{
							do_action('rtwmer_duplicate_product_creation',$rtwmer_prod_dup_add_url);
							echo json_encode($rtwmer_prod_dup_add_url);
						}
						wp_die();
					}
				}

			}
		}
	}

//=================Function is going to call when, empty trash button activates from product listing page=========//

	function rtwmer_empty_trash_cb() {

		if( check_ajax_referer('rtwmer-vendor-nonce','rtmer_empty_trash_nonce') )
		{
			$rtwmer_trash_post = array(
				'numberposts' => -1,
				'post_type' => 'product',
				'post_status' => 'trash',
				'fields' => 'ids'
			);
			$rtwmer_trash_post_id = get_posts($rtwmer_trash_post);

			if( isset($rtwmer_trash_post_id) && is_array($rtwmer_trash_post_id) && !empty($rtwmer_trash_post_id) )
			{
				if( isset($rtwmer_trash_post_id[0]) && !empty($rtwmer_trash_post_id[0]) )
				{
					$rtwmer_del_post_author = get_post_field( 'post_author',$rtwmer_trash_post_id[0] );
					foreach( $rtwmer_trash_post_id as $trash )
					{
						if( isset($trash) && !empty($trash) )
						{
							do_action('rtwmer_product_empty_trash');
							wp_delete_post($trash);
						}
					}
					if( isset($rtwmer_del_post_author) )
					{
						echo json_encode($rtwmer_del_post_author);
					}
				}
			}
			wp_die();
		}

	}

//=========================Function Goes when product set featured from product table page===============//

	function rtwmer_fav_prod_cb() {

		if( check_ajax_referer( 'rtwmer-vendor-nonce','rtwmer_fav_prod_data_nonce' ) )
		{
			if( isset($_POST['rtwmer_fav_prod']) && (isset( $_POST['rtwmer_fav_prod_id'] ) && !empty($_POST['rtwmer_fav_prod_id'])) )
			{
				wp_set_object_terms( sanitize_text_field($_POST['rtwmer_fav_prod_id']),sanitize_text_field($_POST['rtwmer_fav_prod']),'product_visibility' );
				echo json_encode(1);
				wp_die();
			}
		}
	}

//====================Function is used to get count of vendors according their status=====================//

	function rtwmer_vendors_count_action_cb()
	{
		if( check_ajax_referer( 'rtwmer-vendor-nonce','rtwmer_vendors_count_nonce' ) )
		{
			global $wpdb;

			$rtwmer_query = "SELECT COUNT(*) FROM  $wpdb->users as m LEFT JOIN (SELECT user_id, meta_key, meta_value,
			MAX(CASE WHEN meta_key='rtwmer_vendor_status' THEN meta_value END) rtwmer_vendor_status
			FROM $wpdb->usermeta GROUP BY user_id) rtwmer_vendor_table ON m.`ID` = rtwmer_vendor_table.`user_id`
			WHERE (rtwmer_vendor_status = %d) AND rtwmer_vendor_table.`meta_key` = 'wp_capabilities' AND rtwmer_vendor_table.`meta_value` LIKE '%rtwmer_vendor%'";


			$rtwmer_enable_query = "SELECT COUNT(*) FROM  $wpdb->users as m LEFT JOIN (SELECT user_id, meta_key, meta_value,
			MAX(CASE WHEN meta_key='rtwmer_vendor_status' THEN meta_value END) rtwmer_vendor_status
			FROM $wpdb->usermeta GROUP BY user_id) rtwmer_vendor_table ON m.`ID` = rtwmer_vendor_table.`user_id`
			WHERE (rtwmer_vendor_status = %d)";


			if( isset($rtwmer_query) )
			{
				// $rtwmer_approved_vendors = $wpdb->get_var( $wpdb->prepare( $rtwmer_query, 1 ),0);
				// $rtwmer_disabled_vendors = $wpdb->get_var( $wpdb->prepare( $rtwmer_query, 0 ),0);
				$rtwmer_approved_vendors = $wpdb->get_var( $wpdb->prepare( $rtwmer_enable_query, 1 ),0);
				$rtwmer_disabled_vendors = $wpdb->get_var( $wpdb->prepare( $rtwmer_enable_query, 0 ),0);

	// echo '<pre>';
	// print_r($rtwmer_approved_vendors);
	// echo '</pre>';
	// die('adfdsa');
				if( isset($rtwmer_approved_vendors) && isset($rtwmer_disabled_vendors) )
				{
					$rtwmer_vendor_status = array(
						'rtwmer_all_vendors' => $rtwmer_approved_vendors + $rtwmer_disabled_vendors,
						'rtwmer_approved_vendors' => $rtwmer_approved_vendors,
						'rtwmer_disabled_vendors' => $rtwmer_disabled_vendors
					);
				}
				do_action('rtwmer_vendors_with_thier_status');

				if( isset($rtwmer_vendor_status) && is_array($rtwmer_vendor_status) )
				{
					echo json_encode($rtwmer_vendor_status);
				}
			}
			wp_die();
		}
	}

//====================Function is used to generate password when any vendor gets created===============///

	function rtwmer_add_new_vend_generate_pass_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_add_new_vend_generate_pass_nonce') )
		{
			$rtwmer_rtwmer_add_new_vend_generate_pass = wp_generate_password(34,'','true');
			if( isset($rtwmer_rtwmer_add_new_vend_generate_pass) && !empty($rtwmer_rtwmer_add_new_vend_generate_pass) )
			{
				do_action('rtwmer_generate_password_for_new_vendor');
				echo json_encode($rtwmer_rtwmer_add_new_vend_generate_pass);
				wp_die();
			}
		}
	}

//=======================Function is used to get countries state from add new vendor section==============//

	function rtwmer_addnew_vend_country_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_addnew_vend_selected_country_nonce') )
		{
			if( isset($_POST['rtwmer_addnew_vend_selected_country']) && !empty($_POST['rtwmer_addnew_vend_selected_country']) )
			{
				$rtwmer_vendor_sel_country = sanitize_text_field($_POST['rtwmer_addnew_vend_selected_country']);
				$rtwmer_countries_value  = new WC_Countries();
				if( isset($rtwmer_vendor_sel_country) && isset($rtwmer_countries_value) )
				{
					$rtwmer_state = $rtwmer_countries_value->get_states($rtwmer_vendor_sel_country);
					$rtwmer_html = '';
					if(isset($rtwmer_state) && is_array($rtwmer_state) && !empty($rtwmer_state) )
					{
						$rtwmer_html = '<select class = rtwmer_vendor_state>';
						$rtwmer_html .= '<option value="">'.esc_html__( 'Select State', 'rtwmer-mercado' ).'</option>';
						foreach( $rtwmer_state as $states => $state )
						{
							$rtwmer_html .= '<option value="'.esc_attr( $states ).'">'.esc_html__( $state, 'rtwmer-mercado' ).'</option>';
						}
						$rtwmer_html .= '</select>';
					}
					$rtwmer_addnew_vendors_data = $rtwmer_html;

					if( isset($rtwmer_addnew_vendors_data) )
					{
						do_action('rtwmer_country_changes_to_state');
						echo json_encode($rtwmer_addnew_vendors_data);
					}
				}
				wp_die();
			}
		}
	}

//=========================Function is used to create datatable for order section=========================//

	function rtwmer_order_table_cb()
	{
		if( check_ajax_referer( 'rtwmer-vendor-nonce','rtwmer_orders_nonce_verify' ) )
		{
			include_once( RTWMER_ADMIN_PARTIAL.'/admin-includes/rtwmer-mercado-order-table.php' );
		}
	}

//===================Function is used to display count of orders at order table===================//

	function rtwmer_order_count_cb()
	{


		if( check_ajax_referer( 'rtwmer-vendor-nonce','rtwmer_orders_nonce_verify' ) )
		{
			if( isset($_POST['rtwmer_order_vendor_id']) && !empty($_POST['rtwmer_order_vendor_id']) )
			{

				$rtwmer_order_vendor_id = sanitize_text_field($_POST['rtwmer_order_vendor_id']);
				if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
				{
					global $wpdb;

					$rtwmer_order_count_query = "SELECT COUNT(*) FROM $wpdb->posts as m LEFT JOIN (SELECT post_id,
						MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_id
						FROM $wpdb->postmeta GROUP BY post_id) rtmwer_order_count_table ON
						m.`ID`=rtmwer_order_count_table.`post_id` WHERE (rtwmer_order_vendor_id = %d AND `post_type`=%s AND `post_status`!=%s AND `post_status`!=%s)";
					if( isset($rtwmer_order_count_query ))
					{
						$rtwmer_all_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','trash','auto-draft'),0 );
					}

					$rtwmer_order_count_query = "SELECT COUNT(*) FROM $wpdb->posts as m LEFT JOIN (SELECT post_id,
					MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_id
					FROM $wpdb->postmeta GROUP BY post_id) rtmwer_order_count_table ON
					m.`ID`=rtmwer_order_count_table.`post_id` WHERE (rtwmer_order_vendor_id = %d AND `post_type`=%s AND `post_status`=%s)";

					if( isset($rtwmer_order_count_query) )
					{
						$rtwmer_pending_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','wc-pending'),0 );

						$rtwmer_processing_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','wc-processing'),0 );

						$rtwmer_on_hold_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','wc-on-hold'),0 );

						$rtwmer_completed_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','wc-completed'),0 );

						$rtwmer_refunded_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','wc-refunded'),0 );

						$rtwmer_failed_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','wc-failed'),0 );

						$rtwmer_cancelled_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','wc-cancelled'),0 );

						$rtwmer_trash_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','trash'),0 );

						$rtwmer_draft_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,$rtwmer_order_vendor_id,'shop_order','draft'),0 );

						$rtwmer_orders_count = array(
							'rtwmer_all_orders_count'			=>	isset($rtwmer_all_orders_count) ? $rtwmer_all_orders_count : 0,
							'rtwmer_pending_orders_count'		=>	isset($rtwmer_pending_orders_count) ? $rtwmer_pending_orders_count : 0,
							'rtwmer_processing_orders_count'	=>	isset($rtwmer_processing_orders_count) ? $rtwmer_processing_orders_count : 0,
							'rtwmer_completed_orders_count'		=>	isset($rtwmer_completed_orders_count) ? $rtwmer_completed_orders_count : 0,
							'rtwmer_on_hold_orders_count'		=>	isset($rtwmer_on_hold_orders_count) ? $rtwmer_on_hold_orders_count : 0,
							'rtwmer_refunded_orders_count'		=>	isset($rtwmer_refunded_orders_count) ? $rtwmer_refunded_orders_count : 0,
							'rtwmer_cancelled_orders_count'		=>	isset($rtwmer_cancelled_orders_count) ? $rtwmer_cancelled_orders_count : 0,
							'rtwmer_failed_orders_count'		=>	isset($rtwmer_failed_orders_count) ? $rtwmer_failed_orders_count : 0,
							'rtwmer_trash_orders_count'			=>	isset($rtwmer_trash_orders_count) ? $rtwmer_trash_orders_count : 0,
							'rtwmer_draft_orders_count'			=>	isset($rtwmer_draft_orders_count) ? $rtwmer_draft_orders_count : 0,
						);

						if(isset($rtwmer_orders_count))
						{
							do_action('rtwmer_all_orders_count_from_db');
							echo json_encode($rtwmer_orders_count);
						}
					}
					wp_die();
				}
			}
			else
			{


				global $wpdb;
				if(OrderUtil::custom_orders_table_usage_is_enabled()){

					$rtwmer_order_count_query = "SELECT COUNT(*) FROM  " . $wpdb->prefix . "wc_orders as m LEFT JOIN (SELECT order_id,
						MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_id
						FROM " . $wpdb->prefix . "wc_orders_meta GROUP BY order_id) rtmwer_order_count_table ON
						m.`ID`= rtmwer_order_count_table.`order_id` WHERE (`type`=%s AND `status`!=%s AND `status`!=%s AND `status`!=%s )";

					if( isset($rtwmer_order_count_query) )
					{
						$rtwmer_all_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','trash','auto-draft','wc-checkout-draft'),0 );
					}


					$rtwmer_order_count_query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders as m LEFT JOIN (SELECT post_id,
					MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_id
					FROM $wpdb->postmeta GROUP BY post_id) rtmwer_order_count_table ON
					m.`ID`=rtmwer_order_count_table.`post_id` WHERE (`type`=%s AND `status`=%s)";

				}else{

					// $rtwmer_order_count_query = "SELECT COUNT(*) FROM $wpdb->posts as m LEFT JOIN (SELECT post_id,
					// 	MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_id
					// 	FROM $wpdb->postmeta GROUP BY post_id) rtmwer_order_count_table ON
					// 	m.`ID`= rtmwer_order_count_table.`post_id` WHERE (`type`=%s AND `status`!=%s AND `status`!=%s)";

					$rtwmer_order_count_query = "SELECT COUNT(*) FROM wp_posts as m LEFT JOIN (SELECT post_id,
					MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_id
					FROM wp_postmeta GROUP BY post_id) rtmwer_order_count_table ON
					m.`ID`= rtmwer_order_count_table.`post_id` WHERE (`post_type`=%s AND `post_status`!=%s AND `post_status`!=%s)";

					if( isset($rtwmer_order_count_query) )
					{
						$rtwmer_all_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','trash','auto-draft'),0 );
					}


					$rtwmer_order_count_query = "SELECT COUNT(*) FROM wp_posts as m LEFT JOIN (SELECT post_id,
					MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_id
					FROM $wpdb->postmeta GROUP BY post_id) rtmwer_order_count_table ON
					m.`ID`=rtmwer_order_count_table.`post_id` WHERE (`post_type`=%s AND `post_status`=%s)";
				}

					if( isset($rtwmer_order_count_query) )
					{

						$rtwmer_pending_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','wc-pending'),0 );

						$rtwmer_processing_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','wc-processing'),0 );

						$rtwmer_on_hold_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','wc-on-hold'),0 );

						$rtwmer_completed_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','wc-completed'),0 );

						$rtwmer_refunded_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','wc-refunded'),0 );

						$rtwmer_failed_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','wc-failed'),0 );

						$rtwmer_cancelled_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','wc-cancelled'),0 );

						$rtwmer_trash_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','trash'),0 );

						$rtwmer_draft_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_order_count_query,'shop_order','draft'),0 );

						$rtwmer_orders_count = array(
							'rtwmer_all_orders_count'			=>	isset($rtwmer_all_orders_count) ? $rtwmer_all_orders_count : 0,
							'rtwmer_pending_orders_count'		=>	isset($rtwmer_pending_orders_count) ? $rtwmer_pending_orders_count : 0,
							'rtwmer_processing_orders_count'	=>	isset($rtwmer_processing_orders_count) ? $rtwmer_processing_orders_count : 0,
							'rtwmer_completed_orders_count'		=>	isset($rtwmer_completed_orders_count) ? $rtwmer_completed_orders_count : 0,
							'rtwmer_on_hold_orders_count'		=>	isset($rtwmer_on_hold_orders_count) ? $rtwmer_on_hold_orders_count : 0,
							'rtwmer_refunded_orders_count'		=>	isset($rtwmer_refunded_orders_count) ? $rtwmer_refunded_orders_count : 0,
							'rtwmer_cancelled_orders_count'		=>	isset($rtwmer_cancelled_orders_count) ? $rtwmer_cancelled_orders_count : 0,
							'rtwmer_failed_orders_count'		=>	isset($rtwmer_failed_orders_count) ? $rtwmer_failed_orders_count : 0,
							'rtwmer_trash_orders_count'			=>	isset($rtwmer_trash_orders_count) ? $rtwmer_trash_orders_count : 0,
							'rtwmer_draft_orders_count'			=>	isset($rtwmer_draft_orders_count) ? $rtwmer_draft_orders_count : 0
						);

						if(isset($rtwmer_orders_count))
						{
							do_action('rtwmer_all_orders_count_from_db');
							echo json_encode($rtwmer_orders_count);
						}
					}
					wp_die();
			}
		}
	}

///==========================Function is used to get the link of edit order===================//
///==========================Function is used to get the link of edit order===================//

	function rtwmer_edit_order_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_edit_order_nonce_verify') )
		{
			if( isset($_POST['rtwmer_edit_order_id']) && !empty($_POST['rtwmer_edit_order_id']) )
			{
				$rtwmer_edit_order_link = add_query_arg(array(
					'post' => sanitize_text_field($_POST['rtwmer_edit_order_id']),
					'action' => 'edit',
					'rtwmer_prod_hide'=>'true',
					), admin_url('post.php')
				);
				if( isset($rtwmer_edit_order_link) && !empty($rtwmer_edit_order_link) )
				{
					do_action('rtwmer_edit_order_link_redirect',$rtwmer_edit_order_link);
					echo json_encode($rtwmer_edit_order_link);
				}
				wp_die();
			}
			else
			{
				$rtwmer_edit_order_link = add_query_arg(array(
					'post_type' => 'shop_order',
					'rtwmer_prod_hide'=>'true',
					), admin_url('post-new.php')
				);
				if( isset($rtwmer_edit_order_link) && !empty($rtwmer_edit_order_link) )
				{
					do_action('rtwmer_add_order_link_redirect',$rtwmer_edit_order_link);
					echo json_encode($rtwmer_edit_order_link);
				}
				wp_die();
			}
		}
	}

//=======================Function is used to display order details at order section========================.//
//=======================Function is used to display order details at order section========================.//

	function rtwmer_view_order_cb_1()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_view_order_nonce_verify') )
		{
			if( isset($_POST['rtwmer_view_order_id']) && !empty($_POST['rtwmer_view_order_id']) )
			{
				$rtwmer_view_order = new WC_Order( sanitize_text_field($_POST['rtwmer_view_order_id']) );

				if( isset($rtwmer_view_order) && !empty($rtwmer_view_order) && is_object($rtwmer_view_order) )
				{
					$rtwmer_order_status = $rtwmer_view_order->get_status();
					$rtwmer_billing_first_name = $rtwmer_view_order->get_billing_first_name();
					$rtwmer_billing_last_name = $rtwmer_view_order->get_billing_last_name();
					$rtwmer_billing_company = $rtwmer_view_order->get_billing_company();
					$rtwmer_billing_address1 = $rtwmer_view_order->get_billing_address_1();
					$rtwmer_billing_address2 = $rtwmer_view_order->get_billing_address_2();
					$rtwmer_billing_city = $rtwmer_view_order->get_billing_city();
					$rtwmer_billing_state = $rtwmer_view_order->get_billing_state();
					$rtwmer_billing_postcode = $rtwmer_view_order->get_billing_postcode();
					$rtwmer_billing_country = $rtwmer_view_order->get_billing_country();
					$rtwmer_billing_email = $rtwmer_view_order->get_billing_email();
					$rtwmer_billing_phone = $rtwmer_view_order->get_billing_phone();
					$rtwmer_shipping_first_name = $rtwmer_view_order->get_shipping_first_name();
					$rtwmer_shipping_last_name = $rtwmer_view_order->get_shipping_last_name();
					$rtwmer_shipping_company = $rtwmer_view_order->get_shipping_company();
					$rtwmer_shipping_address1 = $rtwmer_view_order->get_shipping_address_1();
					$rtwmer_shipping_address2 = $rtwmer_view_order->get_shipping_address_2();
					$rtwmer_shipping_city = $rtwmer_view_order->get_shipping_city();
					$rtwmer_shipping_state = $rtwmer_view_order->get_shipping_state();
					$rtwmer_shipping_postcode = $rtwmer_view_order->get_shipping_postcode();
					$rtwmer_shipping_country = $rtwmer_view_order->get_shipping_country();
					$rtwmer_payment_method_title = $rtwmer_view_order->get_payment_method_title();
					$rtwmer_shipping_method = $rtwmer_view_order->get_shipping_method();
					$rtwmer_customer_note = $rtwmer_view_order->get_customer_note();

					$rtwmer_order_details = array(
						'rtwmer_order_id'				=>	isset($_POST['rtwmer_view_order_id']) ? sanitize_text_field($_POST['rtwmer_view_order_id']) : '',
						'rtwmer_order_status'			=>	isset($rtwmer_order_status) ? $rtwmer_order_status : '',
						'rtwmer_billing_first_name'		=>	isset($rtwmer_billing_first_name) ? $rtwmer_billing_first_name : '',
						'rtwmer_billing_last_name'		=>	isset($rtwmer_billing_last_name) ? $rtwmer_billing_last_name : '',
						'rtwmer_billing_company'		=>	isset($rtwmer_billing_company) ? $rtwmer_billing_company : '',
						'rtwmer_billing_address1'		=>	isset($rtwmer_billing_address1) ? $rtwmer_billing_address1 : '',
						'rtwmer_billing_address2'		=>	isset($rtwmer_billing_address2) ? $rtwmer_billing_address2 : '',
						'rtwmer_billing_city'			=>	isset($rtwmer_billing_city) ? $rtwmer_billing_city : '',
						'rtwmer_billing_state'			=>	isset($rtwmer_billing_state) ? $rtwmer_billing_state : '',
						'rtwmer_billing_postcode'		=>	isset($rtwmer_billing_postcode) ? $rtwmer_billing_postcode : '',
						'rtwmer_billing_country'		=>	isset($rtwmer_billing_country) ? $rtwmer_billing_country : '',
						'rtwmer_billing_email'			=>	isset($rtwmer_billing_email) ? $rtwmer_billing_email : '',
						'rtwmer_billing_phone'			=>	isset($rtwmer_billing_phone) ? $rtwmer_billing_phone : '',
						'rtwmer_shipping_first_name'	=>	isset($rtwmer_shipping_first_name) ? $rtwmer_shipping_first_name : '',
						'rtwmer_shipping_last_name'		=>	isset($rtwmer_shipping_last_name) ? $rtwmer_shipping_last_name : '',
						'rtwmer_shipping_company'		=>	isset($rtwmer_shipping_company) ? $rtwmer_shipping_company : '',
						'rtwmer_shipping_address1'		=>	isset($rtwmer_shipping_address1) ? $rtwmer_shipping_address1 : '',
						'rtwmer_shipping_address2'		=>	isset($rtwmer_shipping_address2) ? $rtwmer_shipping_address2 : '',
						'rtwmer_shipping_city'			=>	isset($rtwmer_shipping_city) ? $rtwmer_shipping_city : '',
						'rtwmer_shipping_state'			=>	isset($rtwmer_shipping_state) ? $rtwmer_shipping_state : '',
						'rtwmer_shipping_postcode'		=>	isset($rtwmer_shipping_postcode) ? $rtwmer_shipping_postcode : '',
						'rtwmer_shipping_country'		=>	isset($rtwmer_shipping_country) ? $rtwmer_shipping_country : '',
						'rtwmer_payment_method_title'	=>	isset($rtwmer_payment_method_title) ? $rtwmer_payment_method_title : '',
						'rtwmer_shipping_method'		=> isset($rtwmer_shipping_method) ? $rtwmer_shipping_method : '',
						'rtwmer_customer_note'			=>	isset($rtwmer_customer_note) ? $rtwmer_customer_note : ''
					);
					do_action('rtwmer_view_order');
					echo json_encode($rtwmer_order_details);
				}
				wp_die();
			}
		}
	}

//===============Same working as of above function======================

	function rtwmer_view_order_cb_2()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_view_order_nonce_verify') )
		{
			if( isset($_POST['rtwmer_view_order_id']) && !empty($_POST['rtwmer_view_order_id']) )
			{
				$rtwmer_view_order = new WC_Order( sanitize_text_field($_POST['rtwmer_view_order_id'] ));

				if( isset($rtwmer_view_order) && !empty($rtwmer_view_order) && is_object($rtwmer_view_order) )
				{
					$rtwmer_get_items = $rtwmer_view_order->get_items();

					if( isset($rtwmer_get_items) && is_array($rtwmer_get_items) && !empty($rtwmer_get_items) )
					{
						foreach($rtwmer_get_items as $key)
						{
							if( isset($key['name']) )
							{
								$rtwmer_get_product_name = $key['name'];
							}
							$rtwmer_get_product_quantity = $key->get_quantity();
							$rtwmer_get_product_total = $key->get_total();
							if( isset($rtwmer_get_product_name) && isset($rtwmer_get_product_quantity) && isset($rtwmer_get_product_total) )
							{
								$rtwmer_order_product_data = array(
									'rtwmer_get_product_name'		=> $rtwmer_get_product_name,
									'rtwmer_get_product_quantity'	=> $rtwmer_get_product_quantity,
									'rtwmer_get_product_total'		=> $rtwmer_get_product_total,
								);
								$rtwmer_order_product_val[]=$rtwmer_order_product_data;
							}
						}
						if( isset($rtwmer_order_product_val) && is_array($rtwmer_order_product_val) )
						{
							do_action('rtwmer_view_order');
							echo json_encode($rtwmer_order_product_val);
						}
					}
				}
				wp_die();
			}
		}
	}

//=================Function is used to process balance to vendor or send order to trash/Delete============//

	function rtwmer_process_order_request_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_process_orders_nonce_verify') )
		{
			include_once( RTWMER_ADMIN_PARTIAL.'/admin-includes/rtwmer-mercado-order-functionality.php' );
		}
	}

//=================Function is about to apply bulk action at orders table==========================//

	function rtwmer_order_checkboxes_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_order_checkboxes_verify') )
		{
			// $_POST['rtwmer_order_checkboxes'] hold array

			if( (isset($_POST['rtwmer_order_bulk_action_val']) && !empty($_POST['rtwmer_order_bulk_action_val'])) && (isset($_POST['rtwmer_order_checkboxes']) && !empty($_POST['rtwmer_order_checkboxes'])) )
			{
				if( is_array($_POST['rtwmer_order_checkboxes']))
				{
					if( isset($_POST['rtwmer_order_checkboxes'][0]) )
					{

						$rtwmer_order_vendor_id = get_post_meta( $_POST['rtwmer_order_checkboxes'][0],'rtwmer_order_vendor',true );

						$order =  wc_get_order( $_POST['rtwmer_order_checkboxes'][0] );
						$rtwmer_order_vendor_id = $order->get_meta('rtwmer_order_vendor');

						if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
						{
							echo json_encode($rtwmer_order_vendor_id);
						}

						foreach( $_POST['rtwmer_order_checkboxes'] as $key )
						{
							$rtwmer_children_post_args = array(
								'post_parent'	=> 	$key,
								'post_type'		=>	'shop_order',
								'post_status'	=>	'-1'
							);
							$rtwmer_order_children = get_children( $rtwmer_children_post_args );
							if( $rtwmer_order_children )
							{
								foreach($rtwmer_order_children as $children)
								{
									if(isset($children->ID))
									{
										if( $_POST['rtwmer_order_bulk_action_val'] == 'rtwmer_bulk_trash_order' )
										{
											do_action('rtwmer_send_order_to_trash');
											wp_trash_post( $key );
											wp_trash_post( $children->ID );
										}
										if( $_POST['rtwmer_order_bulk_action_val'] == 'rtwmer_bulk_delete_order' )
										{
											do_action('rtwmer_send_order_to_delete');
											wp_delete_post( $key );
											wp_delete_post( $children->ID );
										}
										if( $_POST['rtwmer_order_bulk_action_val'] == 'rtwmer_bulk_restore_order' )
										{
											do_action('rtwmer_send_order_to_restore');
											wp_untrash_post( $key );
											wp_untrash_post( $children->ID );
										}
										if( ($_POST['rtwmer_order_bulk_action_val'] == 'processing') || ($_POST['rtwmer_order_bulk_action_val'] == 'on-hold') || ($_POST['rtwmer_order_bulk_action_val'] == 'completed')  )
										{
											$rtwmer_order_status_chng = 'wc_';
											$rtwmer_order_status_chng .= (sanitize_text_field($_POST['rtwmer_order_bulk_action_val']));
											if( isset($rtwmer_order_status_chng) )
											{
												$rtwmer_order_obj = wc_get_order( $key );

												if( isset($rtwmer_order_obj) && is_object($rtwmer_order_obj) )
												{
													$rtwmer_update_status = $rtwmer_order_obj->update_status(sanitize_text_field($_POST['rtwmer_order_bulk_action_val']));
													$rtwmer_order_obj = wc_get_order( $children->ID );
													$rtwmer_update_status = $rtwmer_order_obj->update_status(sanitize_text_field($_POST['rtwmer_order_bulk_action_val']));
												}
											}
										}
									}
								}
							}
							else
							{
								if( $_POST['rtwmer_order_bulk_action_val'] == 'rtwmer_bulk_trash_order' )
								{

									// $id = $_POST['rtwmer_process_order_request_id'];

									$order = new WC_Order( $key );

									global $wpdb;
									$status = $order->get_status();

									$check = $wpdb->get_results ( "SELECT * FROM " . $wpdb->prefix . "wc_orders_meta WHERE `order_id` = '$key' AND `meta_key` = '_wp_trash_meta_status'" );

									if($check){
										// " . $wpdb->prefix . "
										// die($status);
										$wpdb->update($wpdb->prefix .'wc_orders_meta', array('meta_value'=> 'wc-'.$status), array('order_id' => $key ,'meta_key'=> '_wp_trash_meta_status'));
									}else{
										$wpdb->insert($wpdb->prefix .'wc_orders_meta', array(
											'order_id' => $key,
											'meta_key' => '_wp_trash_meta_status',
											'meta_value' => "wc-".$status
										));
									}
									$test = $order->update_status( 'trash' );
									do_action('rtwmer_send_order_to_trash');
									wp_trash_post( $key );
								}
								if( $_POST['rtwmer_order_bulk_action_val'] == 'rtwmer_bulk_delete_order' )
								{
									do_action('rtwmer_send_order_to_delete');
									wp_delete_post( $key );
								}
								if( $_POST['rtwmer_order_bulk_action_val'] == 'rtwmer_bulk_restore_order' )
								{
									do_action('rtwmer_send_order_to_restore');
									wp_untrash_post( $key );
								}
								if( ($_POST['rtwmer_order_bulk_action_val'] == 'processing') || ($_POST['rtwmer_order_bulk_action_val'] == 'on-hold') || ($_POST['rtwmer_order_bulk_action_val'] == 'completed')  )
								{
									$rtwmer_order_status_chng = 'wc_';
									$rtwmer_order_status_chng .= (sanitize_text_field($_POST['rtwmer_order_bulk_action_val']));
									if( isset($rtwmer_order_status_chng) )
									{
										$rtwmer_order_obj = wc_get_order( $key );
										$rtwmer_update_status = $rtwmer_order_obj->update_status(sanitize_text_field($_POST['rtwmer_order_bulk_action_val']));
									}
								}
							}
						}
						wp_die();
					}
				}
			}
		}
	}

//=======================Function is used to get count of orders======================

	function rtwmer_chart_data_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_chart_data_nonce_verify') )
		{
			global $wpdb;
			$rtwmer_list_prod_start_date = strtotime(date('Y-m', current_time('timestamp')) . '-1 midnight');
			$rtwmer_list_end_date = strtotime('+1month', $rtwmer_list_prod_start_date) - 86400;
			if( isset($rtwmer_list_prod_start_date) && isset($rtwmer_list_end_date) )
			{
				$rtwmer_query = "SELECT COUNT(*) AS rtwmer_count_orders_by_date,post_date FROM ".$wpdb->prefix."posts WHERE post_type='%s' AND post_status='%s' AND post_parent=%d AND post_date >= '%s' AND post_date < '%s' GROUP BY CAST(post_date AS DATE)";
				if( isset($rtwmer_query) )
				{
					$rtwmer_total_orders_val_count = $wpdb->get_results( $wpdb->prepare($rtwmer_query,'shop_order','wc-completed',0,date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );

					if( isset($rtwmer_total_orders_val_count) && is_array($rtwmer_total_orders_val_count) && !empty($rtwmer_total_orders_val_count) )
					{
						foreach($rtwmer_total_orders_val_count as $count)
						{
							if(isset($count) && isset($count->rtwmer_count_orders_by_date) && isset($count->post_date))
							{
								$rtwmer_count_orders_by_date_array[] = $count->rtwmer_count_orders_by_date;
								$rtwmer_post_date = substr($count->post_date, 0,10);
								if( isset($rtwmer_post_date) )
								{
									$rtwmer_post_date_array_last = substr($rtwmer_post_date, 8);
									if( isset($rtwmer_post_date_array_last) )
									{
										if(substr($rtwmer_post_date_array_last,0,1) == 0)
										{
											$rtwmer_post_date_array[] = substr($rtwmer_post_date_array_last, 1);
										}
										else
										{
											$rtwmer_post_date_array[] = $rtwmer_post_date_array_last;
										}
									}
								}
							}
						}
						if( isset($rtwmer_post_date_array) && is_array($rtwmer_post_date_array) && isset($rtwmer_count_orders_by_date_array) && is_array($rtwmer_count_orders_by_date_array) )
						{
							$rtwmer_count_values_datewise = array_combine($rtwmer_post_date_array,$rtwmer_count_orders_by_date_array);
						}

						$rtwmer_key_exsist = 1;

						$rtwmer_last_date = date("Y-m-d",$rtwmer_list_end_date);
						if(isset($rtwmer_last_date))
						{
							$rtwmer_last_date_two_val = substr($rtwmer_last_date,8);
						}

						if( isset($rtwmer_last_date_two_val) && isset($rtwmer_count_values_datewise) && is_array($rtwmer_count_values_datewise) && isset($rtwmer_key_exsist) )
						{
							for( $i=1; $i <= $rtwmer_last_date_two_val; $i++ )
							{
								if(array_key_exists($rtwmer_key_exsist,$rtwmer_count_values_datewise))
								{
									$rtwmer_order_count_main_array[] = $rtwmer_count_values_datewise[$rtwmer_key_exsist];
								}
								else
								{
									$rtwmer_order_count_main_array[] = 0;
								}
								$rtwmer_key_exsist = $rtwmer_key_exsist + 01;
							}
							do_action('rtwmer_dashboard_order_counts',$rtwmer_order_count_main_array);
						}
					}
				}
			}			$rtwmer_list_prod_start_date = strtotime(date('Y-m', current_time('timestamp')) . '-1 midnight');
			$rtwmer_list_end_date = strtotime('+1month', $rtwmer_list_prod_start_date) - 86400;
			if( isset($rtwmer_list_prod_start_date) && isset($rtwmer_list_end_date) )
			{
				$rtwmer_query = "SELECT COUNT(*) AS rtwmer_count_products_by_date,post_date FROM ".$wpdb->prefix."posts WHERE post_type='%s' AND post_status!='%s' AND post_date >= '%s' AND post_date < '%s' GROUP BY CAST(post_date AS DATE)";

				if( isset($rtwmer_query) )
				{
					$rtwmer_get_monthly_created_product = $wpdb->get_results( $wpdb->prepare($rtwmer_query,'product','auto-draft',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );

					if( isset($rtwmer_get_monthly_created_product) && is_array($rtwmer_get_monthly_created_product) && !empty($rtwmer_get_monthly_created_product) )
					{
						foreach($rtwmer_get_monthly_created_product as $prod_count)
						{
							if( isset($prod_count) && isset($prod_count->rtwmer_count_products_by_date) && isset($prod_count->post_date) )
							{
								$rtwmer_count_products_by_date_array[] = $prod_count->rtwmer_count_products_by_date;

								$rtwmer_order_post_date = substr($prod_count->post_date, 0,10);

								if( isset($rtwmer_order_post_date) )
								{
									$rtwmer_prod_post_date_last = substr($rtwmer_order_post_date, 8);

									if( isset($rtwmer_prod_post_date_last) )
									{
										if(substr($rtwmer_prod_post_date_last,0,1) == 0)
										{
											$rtwmer_prod_post_date_array[] = substr($rtwmer_prod_post_date_last, 1);
										}
										else
										{
											$rtwmer_prod_post_date_array[] = $rtwmer_prod_post_date_last;
										}
									}
								}
							}
						}
						if( isset($rtwmer_prod_post_date_array) && is_array($rtwmer_prod_post_date_array) && isset($rtwmer_count_products_by_date_array) && is_array($rtwmer_count_products_by_date_array) )
						{
							$rtwmer_count_prod_values_datewise = array_combine($rtwmer_prod_post_date_array,$rtwmer_count_products_by_date_array);
						}
						if(isset($rtwmer_list_end_date))
						{
							$rtwmer_last_date = date("Y-m-d",$rtwmer_list_end_date);
							if( isset($rtwmer_last_date) )
							{
								$rtwmer_last_date_two_val = substr($rtwmer_last_date,8);
							}
						}

						$rtwmer_prod_key_exsist = 1;

						if( isset($rtwmer_count_prod_values_datewise) && is_array($rtwmer_count_prod_values_datewise) && isset($rtwmer_prod_key_exsist) && isset($rtwmer_last_date_two_val) )
						{
							for( $i=1; $i <= $rtwmer_last_date_two_val; $i++ )
							{
								if(array_key_exists($rtwmer_prod_key_exsist,$rtwmer_count_prod_values_datewise))
								{
									$rtwmer_product_count_main_array[] = $rtwmer_count_prod_values_datewise[$rtwmer_prod_key_exsist];
								}
								else
								{
									$rtwmer_product_count_main_array[] = 0;
								}
								$rtwmer_prod_key_exsist = $rtwmer_prod_key_exsist + 01;
							}
							do_action('rtwmer_dashboard_product_counts',$rtwmer_product_count_main_array);
						}
					}
				}

				$rtwmer_query = "SELECT rtwmer_admin_order_commision_for_vendor,post_date FROM ".$wpdb->prefix."posts as m LEFT JOIN(SELECT post_id,
				MAX(CASE WHEN meta_key='rtwmer_admin_order_commision_for_vendor' THEN meta_value END) rtwmer_admin_order_commision_for_vendor
				FROM ".$wpdb->prefix."postmeta GROUP by post_id) rtwmer_admin_commission_table ON m.ID = rtwmer_admin_commission_table.post_id WHERE `post_type`=%s AND post_status='%s' AND post_date >= '%s' AND post_date < '%s'";

				if( isset($rtwmer_query) )
				{
					$rtwmer_admin_commission_monthly = $wpdb->get_results( $wpdb->prepare($rtwmer_query, 'shop_order','wc-completed',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );

					if( isset($rtwmer_admin_commission_monthly) && !empty($rtwmer_admin_commission_monthly) && is_array($rtwmer_admin_commission_monthly) )
					{
						$rtwmer_order_count_array1 = array();

						foreach($rtwmer_admin_commission_monthly as $key => $value)
						{
							if( isset( $value ) && isset($value->post_date) && isset($value->rtwmer_admin_order_commision_for_vendor) && isset($rtwmer_order_count_array1) )
							{
								$rtwmer_date_by_order  =  date('d', strtotime($value->post_date));

								if( isset($rtwmer_date_by_order) )
								{
									if( empty($rtwmer_order_count_array1))
									{
									$rtwmer_order_count_array1[$rtwmer_date_by_order] = $value->rtwmer_admin_order_commision_for_vendor;
									}
									else
									{
										if(array_key_exists($rtwmer_date_by_order, $rtwmer_order_count_array1 ))
										{
												$rtwmer_order_count_array1[$rtwmer_date_by_order]  =  (int)$rtwmer_order_count_array1[$rtwmer_date_by_order] + (int)$value->rtwmer_admin_order_commision_for_vendor;
										}else
										{
											$rtwmer_order_count_array1[$rtwmer_date_by_order] = $value->rtwmer_admin_order_commision_for_vendor;
										}
									}
								}
							}
						}

						$rtwmer_commission_key_exsist = 1;

						if( isset( $rtwmer_last_date_two_val ) && isset($rtwmer_commission_key_exsist) && isset($rtwmer_order_count_array1) && is_array($rtwmer_order_count_array1) )
						{
							foreach( $rtwmer_order_count_array1 as $day_count => $day_value )
							{
								if( substr( $day_count,0,1 ) == 0 )
								{
									$rtwmer_day_count[] = substr($day_count, 1);
								}
								else
								{
									$rtwmer_day_count[] = $day_count;
								}
								$rtwmer_day_count_value[] = $day_value;
							}

							if( isset( $rtwmer_day_count ) && is_array($rtwmer_day_count) && isset($rtwmer_day_count_value) && is_array($rtwmer_day_count_value) )
							{
								$rtwmer_order_count_array2  = array_combine($rtwmer_day_count,$rtwmer_day_count_value);
							}

							if( isset($rtwmer_order_count_array2) && is_array($rtwmer_order_count_array2) )
							{
								for( $i=1; $i <= $rtwmer_last_date_two_val; $i++ )
								{
									if(array_key_exists($rtwmer_commission_key_exsist,$rtwmer_order_count_array2))
									{
										$rtwmer_commision_count_main_array[] = $rtwmer_order_count_array2[$rtwmer_commission_key_exsist];
									}
									else
									{
										$rtwmer_commision_count_main_array[] = 0;
									}
									$rtwmer_commission_key_exsist = $rtwmer_commission_key_exsist + 01;
								}
								do_action('rtwmer_dashboard_commission_counts',$rtwmer_commision_count_main_array);
							}
						}
					}
				}
			}

			$rtwmer_order_product_count = array(
				'rtwmer_product_count'	=>	isset($rtwmer_product_count_main_array) ? $rtwmer_product_count_main_array : 0,
				'rtwmer_order_count'	=>	isset($rtwmer_order_count_main_array) ? $rtwmer_order_count_main_array : 0,
				'rtwmer_commission_count'=>	isset($rtwmer_commision_count_main_array) ? $rtwmer_commision_count_main_array : 0
			);

			do_action('rtwmer_dashboard_count_chart',$rtwmer_order_product_count);

			echo json_encode($rtwmer_order_product_count);

			wp_die();
		}
	}

//=======================================Function is used load dashboard on click===================================//

	function rtwmer_dashboard_page_cb()
	{

		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_dashboard_page_nonce_verify') )
		{
			global $woocommerce, $wpdb, $product;

			$rtwmer_list_prod_start_date = strtotime(date('Y-m', current_time('timestamp')) . '-1 midnight');
			$rtwmer_list_end_date = strtotime('+1month', $rtwmer_list_prod_start_date) - 86400;
			// if(WC()->version > '8.2.0'){
			if(OrderUtil::custom_orders_table_usage_is_enabled()){
				$rtwmer_query = "SELECT id FROM ".$wpdb->prefix."wc_orders WHERE parent_order_id=%d AND `type`=%s AND status='%s' AND date_created_gmt >= '%s' AND date_created_gmt < '%s'";
			}else{
				$rtwmer_query = "SELECT id FROM ".$wpdb->prefix."posts WHERE post_parent=%d AND `post_type`=%s AND post_status='%s' AND post_date >= '%s' AND post_date < '%s'";
			}

			if( isset($rtwmer_query) )
			{
				$rtwmer_sold_products_previous = $wpdb->get_results( $wpdb->prepare($rtwmer_query,0,'shop_order','wc-completed',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );

				if( empty($rtwmer_sold_products_previous) )
				{
					$rtwmer_sold_products[] = (object)[
						'product_id' => 0,
						'rtwmer_quantity' => 0,
						'rtwmer_gross' => 0,
						'rtwmer_total' => 0,
					];
				}
			}
			if( isset($rtwmer_sold_products_previous) && is_array($rtwmer_sold_products_previous) && !empty($rtwmer_sold_products_previous) )
			{
				$rtwmer_prod_id_qun_array = array();

				foreach ($rtwmer_sold_products_previous as $order_id)
				{
					if( isset($order_id) && isset($order_id->id) )
					{
						$rtwmer_sold_prod_order_obj = wc_get_order($order_id->id);

						if( isset($rtwmer_sold_prod_order_obj) && is_object($rtwmer_sold_prod_order_obj) )
						{
								$rtwmer_sold_prods_obj = $rtwmer_sold_prod_order_obj->get_items();
							}
							if( isset($rtwmer_sold_prods_obj) && is_array($rtwmer_sold_prods_obj) && !empty($rtwmer_sold_prods_obj) )
							{
								foreach($rtwmer_sold_prods_obj as $rtwmer_items)
								{
									$rtwmer_product_id = $rtwmer_items->get_product_id();
									$rtwmer_product_qty = $rtwmer_items->get_quantity();
									$rtwmer_product_total = $rtwmer_items->get_total();

									if( isset($rtwmer_product_id) && isset($rtwmer_product_qty) && isset($rtwmer_product_total) )
									{
										if( empty($rtwmer_prod_id_qun_array) && isset($rtwmer_prod_id_qun_array) )
										{
											$rtwmer_prod_id_qun_array[] = $rtwmer_product_id;

											$rtwmer_sold_products[] = (object)[
												'product_id' => $rtwmer_product_id,
												'rtwmer_quantity' => $rtwmer_product_qty,
												'rtwmer_gross' => $rtwmer_product_total,
												'rtwmer_total' => $rtwmer_product_total,
											];
										}
										else
										{
											if( in_array($rtwmer_product_id,$rtwmer_prod_id_qun_array) )
											{
												$rtwmer_prev_order_key = array_search($rtwmer_product_id,$rtwmer_prod_id_qun_array);
												if( isset($rtwmer_prev_order_key) )
												{
													if( isset($rtwmer_sold_products[$rtwmer_prev_order_key]->rtwmer_quantity) && isset($rtwmer_sold_products[$rtwmer_prev_order_key]->rtwmer_total) )
													{
														$rtwmer_sold_products[$rtwmer_prev_order_key]->rtwmer_quantity += $rtwmer_product_qty;
														$rtwmer_sold_products[$rtwmer_prev_order_key]->rtwmer_total += $rtwmer_product_total;

														$rtwmer_sold_products[$rtwmer_prev_order_key] = (object)[
															'product_id' => $rtwmer_product_id,
															'rtwmer_quantity' => $rtwmer_sold_products[$rtwmer_prev_order_key]->rtwmer_quantity,
															'rtwmer_gross' => $rtwmer_sold_products[$rtwmer_prev_order_key]->rtwmer_total,
															'rtwmer_total' => $rtwmer_sold_products[$rtwmer_prev_order_key]->rtwmer_total,
														];
													}
												}

											}
											else
											{
												$rtwmer_prod_id_qun_array[] = $rtwmer_product_id;
												$rtwmer_product_qty = $rtwmer_product_qty;
												$rtwmer_product_total = $rtwmer_product_total;

												$rtwmer_sold_products[] = (object)[
													'product_id' => $rtwmer_product_id,
													'rtwmer_quantity' => $rtwmer_product_qty,
													'rtwmer_gross' => $rtwmer_product_total,
													'rtwmer_total' => $rtwmer_product_total,
												];
											}
										}
									}
								}
							}
						}
					}
				}

				if(isset($rtwmer_sold_products) && is_array($rtwmer_sold_products))
				{
					$rtwmer_total_sold_product = 0;
                    $rtwmer_total_sold_product_amount = 0;
                    foreach ($rtwmer_sold_products as $product) {
                        if(isset($product))
                        {
                            if(isset($product->rtwmer_quantity))
                            {
                                $rtwmer_total_sold_product = $rtwmer_total_sold_product + $product->rtwmer_quantity;
                            }
                            if(isset($product->rtwmer_gross))
                            {
                                $rtwmer_total_sold_product_amount = $rtwmer_total_sold_product_amount + $product->rtwmer_gross;
                            }
                            if( isset($product->product_id) )
                            {
                                $post = get_post($product->product_id);
                                if( is_object($post) )
                                {
                                    $post->post_author;
                                    if( isset($post->post_author) )
                                    {
                                        $rtwmer_top_selling_vendors[] = $post->post_author;
                                    }
                                }
                            }
                        }
					}
					$rtwmer_query = "SELECT COUNT(*) FROM ".$wpdb->prefix."posts WHERE post_type='%s' AND post_status!='%s' AND post_date >= '%s' AND post_date < '%s'";
                    if( isset($rtwmer_query) )
                    {
                        $rtwmer_get_monthly_created_product = $wpdb->get_var( $wpdb->prepare($rtwmer_query,'product','auto-draft',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );
                    }

                    $rtwmer_query = "SELECT COUNT(*) FROM ".$wpdb->prefix."users as m LEFT JOIN(SELECT user_id,
                    MAX(CASE WHEN meta_key='rtwmer_role' THEN meta_value END) rtwmer_role
                    FROM ".$wpdb->prefix."usermeta GROUP by user_id) rtwmer_vendor_role_table ON m.ID = rtwmer_vendor_role_table.user_id WHERE `rtwmer_role`=%s AND user_registered >= '%s' AND user_registered < '%s'";
                    if( isset($rtwmer_query) )
                    {
                        $rtwmer_get_monthly_created_vendor = $wpdb->get_var( $wpdb->prepare($rtwmer_query,'rtwmer_vendor',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );
                    }

                    $rtwmer_query = "SELECT COUNT(*) FROM ".$wpdb->prefix."users as m LEFT JOIN(SELECT user_id,
                    MAX(CASE WHEN meta_key='rtwmer_vendor_status' THEN meta_value END) rtwmer_vendor_status
                    FROM $wpdb->usermeta GROUP BY user_id) rtwmer_unapproved_vendor_table ON m.`ID` = rtwmer_unapproved_vendor_table.`user_id` WHERE rtwmer_vendor_status=%d";
                    if( isset($rtwmer_query) )
                    {
                        $rtwmer_unapproved_vendors = $wpdb->get_var( $wpdb->prepare( $rtwmer_query,0 ) );
                    }

                    $rtwmer_query = "SELECT COUNT(*) FROM ".$wpdb->prefix."rtwmer_withdraw WHERE `status`=%s";
                    if(isset($rtwmer_query))
                    {
                        $rtwmer_unapproved_withdraw_requests = $wpdb->get_var( $wpdb->prepare( $rtwmer_query,'pending' ) );
                    }


					// if(WC()->version > '8.2.0'){
					if(OrderUtil::custom_orders_table_usage_is_enabled()){
						$rtwmer_query = "SELECT COUNT(*) FROM ".$wpdb->prefix."wc_orders WHERE type='%s' AND status='%s' AND parent_order_id=%d AND date_created_gmt >= '%s' AND date_created_gmt < '%s'";
					}else{
						$rtwmer_query = "SELECT COUNT(*) FROM ".$wpdb->prefix."posts WHERE post_type='%s' AND post_status='%s' AND post_parent=%d AND post_date >= '%s' AND post_date < '%s'";
					}
                    if( isset($rtwmer_query) )
                    {
                        $rtwmer_total_orders_count = $wpdb->get_var( $wpdb->prepare($rtwmer_query,'shop_order','wc-completed',0,date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );
                    }

					if(OrderUtil::custom_orders_table_usage_is_enabled()){
					// if(WC()->version > '8.2.0'){
						$rtwmer_query = "SELECT rtwmer_admin_order_commision_for_vendor FROM ".$wpdb->prefix."wc_orders as m LEFT JOIN(SELECT order_id,
						MAX(CASE WHEN meta_key='rtwmer_admin_order_commision_for_vendor' THEN meta_value END) rtwmer_admin_order_commision_for_vendor
						FROM ".$wpdb->prefix."wc_orders_meta GROUP by order_id) rtwmer_admin_commission_table ON m.id = rtwmer_admin_commission_table.order_id WHERE `type`=%s AND status='%s' AND date_created_gmt >= '%s' AND date_created_gmt < '%s'";
					}else{
						$rtwmer_query = "SELECT rtwmer_admin_order_commision_for_vendor FROM ".$wpdb->prefix."posts as m LEFT JOIN(SELECT post_id,
						MAX(CASE WHEN meta_key='rtwmer_admin_order_commision_for_vendor' THEN meta_value END) rtwmer_admin_order_commision_for_vendor
						FROM ".$wpdb->prefix."postmeta GROUP by post_id) rtwmer_admin_commission_table ON m.ID = rtwmer_admin_commission_table.post_id WHERE `post_type`=%s AND post_status='%s' AND post_date >= '%s' AND post_date < '%s'";
					}


                    if( isset($rtwmer_query) )
                    {
                        $rtwmer_admin_commission_monthly = $wpdb->get_results( $wpdb->prepare($rtwmer_query, 'shop_order','wc-completed',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );


                        if( isset($rtwmer_admin_commission_monthly) && !empty($rtwmer_admin_commission_monthly) && is_array($rtwmer_admin_commission_monthly) )
                        {
                            $rtwmer_admin_commission_value = 0;

                            foreach($rtwmer_admin_commission_monthly as $commission)
                            {
                                if(isset($commission) && isset($commission->rtwmer_admin_order_commision_for_vendor))
                                {
                                     $rtwmer_admin_commission_value += $commission->rtwmer_admin_order_commision_for_vendor;
                                }
                            }
                        }
					}

					$i = 0;

					usort($rtwmer_sold_products, array($this, 'rtwmer_order_sort'));

					?>

					<?php foreach ($rtwmer_sold_products as $product) {

						if( isset($product) )
						{
							$rtwmer_product_title = (isset($product->product_id) ? (get_the_title($product->product_id)) : "" );
							?>
								<?php
								if( isset($product->rtwmer_gross) )
								{
									$price = $product->rtwmer_gross;
									if(isset($price) )
									{
										$product_price = ($price);
									}
								}
								if( isset($product->product_id) )
								{
									$post = get_post($product->product_id);
									if( is_object($post) )
									{
										$post->post_author;
										if( isset($post->post_author) )
										{
											$rtwmer_user_store_name = get_user_meta($post->post_author,'rtwmer_store_name',true);
										}
									}
								}
							$rtwmer_user_store_name = (isset($rtwmer_user_store_name) ? ($rtwmer_user_store_name) : "" );
							$rtwmer_product_quantity = (isset(($product->rtwmer_quantity)) ? ($product->rtwmer_quantity) : 0);
							$rtwmer_product_price = isset($product_price) ? $product_price : 0;;
							$i++;
							if( $i == 5 ) break;
						}
						$rtwmer_top_selling_products = array(
							'rtwmer_product_title' => isset($rtwmer_product_title) ? $rtwmer_product_title : '',
							'rtwmer_user_store_name' => isset($rtwmer_user_store_name) ? $rtwmer_user_store_name : '',
							'rtwmer_product_quantity' => isset($rtwmer_product_quantity) ? $rtwmer_product_quantity : '',
							'rtwmer_product_price' => get_woocommerce_currency_symbol(). isset($rtwmer_product_price) ? $rtwmer_product_price : 0
						);
						$rtwmer_top_selling_products_array[] = $rtwmer_top_selling_products;

						do_action('rtwmer_top_selling_products');

					}

					$rtwmer_dashboard_report_section_data = array(
						'rtwmer_total_sold_product_amount' => isset($rtwmer_total_sold_product_amount) ? $rtwmer_total_sold_product_amount : 0,
						'rtwmer_get_monthly_created_product' => isset($rtwmer_get_monthly_created_product) ? $rtwmer_get_monthly_created_product : 0,
						'rtwmer_get_monthly_created_vendor' => isset($rtwmer_get_monthly_created_vendor) ? $rtwmer_get_monthly_created_vendor : 0,
						'rtwmer_unapproved_vendors' => isset($rtwmer_unapproved_vendors) ? $rtwmer_unapproved_vendors : 0,
						'rtwmer_unapproved_withdraw_requests' => isset($rtwmer_unapproved_withdraw_requests) ? $rtwmer_unapproved_withdraw_requests : 0,
						'rtwmer_admin_commission_value' => isset($rtwmer_admin_commission_value) ? round($rtwmer_admin_commission_value,2) : 0,
						'rtwmer_total_sold_product' => isset($rtwmer_total_sold_product) ? $rtwmer_total_sold_product : 0,
						'rtwmer_total_orders_count' => isset($rtwmer_total_orders_count) ? $rtwmer_total_orders_count : 0,
					);

					do_action('rtwmer_dashboard_report_section_data');

					$i = 0; ?>

					<?php if( isset($rtwmer_top_selling_vendors) && is_array($rtwmer_top_selling_vendors) )
						{

							if( !empty($rtwmer_top_selling_vendors) )
							{

								foreach( array_unique($rtwmer_top_selling_vendors) as $vendors )
								{


									if( isset($vendors) )
									{
										$rtwmer_user_store_name = get_user_meta($vendors,'rtwmer_store_name',true);
										if(OrderUtil::custom_orders_table_usage_is_enabled()){
										// if(WC()->version > '8.2.0'){
											$rtwmer_query = "SELECT id FROM ".$wpdb->prefix."wc_orders as m LEFT JOIN(SELECT order_id,
											MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor
											FROM ".$wpdb->prefix."wc_orders_meta GROUP by order_id) rtwmer_vendor_role_table ON m.id = rtwmer_vendor_role_table.order_id WHERE `rtwmer_order_vendor`=%d AND `type`=%s AND status='%s' AND date_created_gmt >= '%s' AND date_created_gmt < '%s'";
										}else{

											$rtwmer_query = "SELECT post_id FROM ".$wpdb->prefix."posts as m LEFT JOIN(SELECT post_id,
											MAX(CASE WHEN meta_key='rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor
											FROM ".$wpdb->prefix."postmeta GROUP by post_id) rtwmer_vendor_role_table ON m.ID = rtwmer_vendor_role_table.post_id WHERE `rtwmer_order_vendor`=%d AND `post_type`=%s AND post_status='%s' AND post_date >= '%s' AND post_date < '%s'";
										}

										if( isset($rtwmer_query) )
										{
											$rtwmer_number_of_orders_by_vendors = $wpdb->get_results( $wpdb->prepare($rtwmer_query, $vendors, 'shop_order','wc-completed',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );

											if( isset($rtwmer_number_of_orders_by_vendors) && is_array($rtwmer_number_of_orders_by_vendors) )
											{
												$rtwmer_number_of_orders_by_vendors_count = count($rtwmer_number_of_orders_by_vendors);

											}
										}
										if( isset($rtwmer_number_of_orders_by_vendors) && !empty($rtwmer_number_of_orders_by_vendors) && is_array($rtwmer_number_of_orders_by_vendors) )
										{

											$rtwmer_item_count_by_top_sellers_data = 0;
											if(OrderUtil::custom_orders_table_usage_is_enabled()){
											// if(WC()->version > '8.2.0'){

												foreach($rtwmer_number_of_orders_by_vendors as $post_id_array)
												{
													if( isset($post_id_array) && isset($post_id_array->id) )
													{
														$rtwmer_order_details_by_top_sellers = wc_get_order( $post_id_array->id );
														$rtwmer_item_count_by_top_sellers = $rtwmer_order_details_by_top_sellers->get_item_count();
														if( isset($rtwmer_item_count_by_top_sellers) )
														{
															$rtwmer_item_count_by_top_sellers_data += $rtwmer_item_count_by_top_sellers;
														}
													}
												}

											}else{

												foreach($rtwmer_number_of_orders_by_vendors as $post_id_array)
												{
													if( isset($post_id_array) && isset($post_id_array->post_id) )
													{
														$rtwmer_order_details_by_top_sellers = wc_get_order( $post_id_array->post_id );
														$rtwmer_item_count_by_top_sellers = $rtwmer_order_details_by_top_sellers->get_item_count();
														if( isset($rtwmer_item_count_by_top_sellers) )
														{
															$rtwmer_item_count_by_top_sellers_data += $rtwmer_item_count_by_top_sellers;
														}
													}
												}

											}


											$rtwmer_top_sellers = array(
												'rtwmer_user_store_name' => isset($rtwmer_user_store_name) ? ($rtwmer_user_store_name) : "" ,
												'rtwmer_number_of_orders_by_vendors_count' => isset($rtwmer_number_of_orders_by_vendors_count) ? ($rtwmer_number_of_orders_by_vendors_count) : 0,
												'rtwmer_item_count_by_top_sellers_data' => isset($rtwmer_item_count_by_top_sellers_data) ? $rtwmer_item_count_by_top_sellers_data : 0,
											);
											$rtwmer_top_sellers_array[] = $rtwmer_top_sellers;

											do_action('rtwmer_top_sellers');
										}
									}
								}

							}
						}
						// rtwmer_admin_commission_value
						$rtwmer_dashboard_report_page = array(
							'rtwmer_top_selling_products_array' => isset($rtwmer_top_selling_products_array) ? ($rtwmer_top_selling_products_array) : 0,
							'rtwmer_dashboard_report_section_data' => isset($rtwmer_dashboard_report_section_data) ? ($rtwmer_dashboard_report_section_data) : 0,
							'rtwmer_top_sellers' => isset($rtwmer_top_sellers_array) ? ($rtwmer_top_sellers_array) : 0
						);

						do_action('rtwmer_dashboard_report_page',$rtwmer_dashboard_report_page);

						// echo '<pre>';
						// print_r($rtwmer_dashboard_report_page);
						// echo '</pre>';
						// die('fj;dsfaj;jfadsk;l');

						echo json_encode($rtwmer_dashboard_report_page);

					wp_die();
			}
		}
	}

//================function is used to sort an array in descending order=============//

	function rtwmer_order_sort($rtwmer_order_obj, $rtwmer_order_obj1)
	{
		if($rtwmer_order_obj->rtwmer_quantity==$rtwmer_order_obj1->rtwmer_quantity) return 0;
    	return $rtwmer_order_obj->rtwmer_quantity < $rtwmer_order_obj1->rtwmer_quantity?1:-1;
	}

//================This function included store setup working, when plugin installed for very first time================//

	function rtwmer_store_setp_on_activation()
	{
		if( !empty(get_option('rtwmer_plugin_activated_for_store_setup')) )
		{
			if( get_option('rtwmer_plugin_activated_for_store_setup') == 'rtwmer_yes' )
			{
				$rtwmer_setup_store_url = add_query_arg( array(
					'page' => 'rtwmer-mercado',
					'rtwmer_action' => 'rtwmer_store_setup'
				),admin_url('admin.php'));

				if( isset($rtwmer_setup_store_url) )
				{
					do_action('rtwmer_mercado_redirect_to_store_page',$rtwmer_setup_store_url);

					wp_redirect($rtwmer_setup_store_url);
				}

				update_option('rtwmer_plugin_activated_for_store_setup','rtwmer_done');
			}
		}
	}

//======================This function return mercado home page url=========================//

	function rtwmer_setup_page_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_setup_page_nonce_verify') )
		{
			$rtwmer_mercado_home_url = add_query_arg( array('page' => 'rtwmer-mercado#dashboard'),admin_url('admin.php'));
			echo json_encode($rtwmer_mercado_home_url);

			do_action('rtwmer_redirect_dashboard_from_setup_page');

			wp_die();
		}
	}

//==Function came into when order staus change, this function is only used for manage admin end order and balance transfer=//

	function rtwmer_order_status_changes_cb( $rtwmer_order_id, $rtwmer_prev_order_staus, $rtwmer_new_order_status )
	{
		if( isset($rtwmer_order_id) && isset($rtwmer_prev_order_staus) && isset($rtwmer_new_order_status) )
		{
			$rtwmer_order_object = wc_get_order($rtwmer_order_id);

			$rtwmer_order_parent_id = wc_get_order($rtwmer_order_id)->get_parent_id();

			if( isset($rtwmer_order_parent_id) && !empty($rtwmer_order_parent_id) )
			{
				$rtwmer_order_parent_object = wc_get_order($rtwmer_order_parent_id);

				if( isset($rtwmer_order_parent_object) && is_object($rtwmer_order_parent_object) )
				{
					if($rtwmer_order_parent_object->get_status() == 'completed')
					{
						$my_post = array(
							'ID'           => $rtwmer_order_parent_id,
							'post_status'   => 'wc-'.$rtwmer_new_order_status,
						);
						wp_update_post( $my_post );
					}
					else
					{
						$this->rtwmer_order_status_manage_on_change($rtwmer_order_parent_id);
					}
				}
			}

			/* For Woocommerce update start */
			$order = wc_get_order( $rtwmer_order_id );
			if(OrderUtil::custom_orders_table_usage_is_enabled()){
			// if(WC()->version > '8.2.0'){
				(float)$rtwmer_admin_order_commision_for_vendor = $order->get_meta('rtwmer_admin_order_commision_for_vendor');
				$rtwmer_order_vendor_id = $order->get_meta('rtwmer_order_vendor');
			}else{
				(float)$rtwmer_admin_order_commision_for_vendor = get_post_meta($rtwmer_order_id,'rtwmer_admin_order_commision_for_vendor',true );
				$rtwmer_order_vendor_id = get_post_meta( $rtwmer_order_id,'rtwmer_order_vendor',true );
			}
			/* For Woocommerce update end */

			if(!$rtwmer_admin_order_commision_for_vendor){
				$rtwmer_admin_order_commision_for_vendor = (float)0.00;
			}


			if( isset($rtwmer_order_object) && is_object($rtwmer_order_object) )
			{
				$rtwmer_order_total = $rtwmer_order_object->get_total();
			}

			if( !empty(get_option('rtwmer_withdraw_option')) )
			{
				if(isset(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor']))
				{
					if(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor'] == 'rtwmer_order_completed')
					{
						if( ($rtwmer_prev_order_staus != 'completed') && ($rtwmer_new_order_status == 'completed') )
						{

							if( isset($rtwmer_admin_order_commision_for_vendor) && isset($rtwmer_order_vendor_id) && isset($rtwmer_order_total) )
							{

								if(get_post_meta($rtwmer_order_id,'rtwmer_vendor_payment_after_admin_approvale',true ) != 'true')
								{
									update_user_meta( $rtwmer_order_vendor_id,'rtwmer_total_amount',intval(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true)) + ($rtwmer_order_total - $rtwmer_admin_order_commision_for_vendor));

									update_post_meta($rtwmer_order_id,'rtwmer_vendor_payment_after_admin_approvale','true' );

									// echo '<pre>';
									// print_r($rtwmer_order_vendor_id);
									// echo '</pre>';
									// echo '<pre>';
									// print_r(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true));
									// echo '</pre>';
									// echo '<pre>';
									// print_r($rtwmer_order_total);
									// echo '<pre>';
									// print_r($rtwmer_admin_order_commision_for_vendor);
									// echo '</pre>';
									// die('fjjf');
								}
							}
						}
						else if( ($rtwmer_prev_order_staus == 'completed') && ($rtwmer_new_order_status != 'completed') )
						{
							if( isset($rtwmer_admin_order_commision_for_vendor) && (isset($rtwmer_order_vendor_id)) && (isset($rtwmer_order_total)) )
							{
								update_post_meta($rtwmer_order_id,'rtwmer_vendor_payment_after_admin_approvale','false' );

								update_user_meta( $rtwmer_order_vendor_id,'rtwmer_total_amount',intval(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true)) - ((float)$rtwmer_order_total - $rtwmer_admin_order_commision_for_vendor));
							}
						}
					}
					else if(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor'] == 'rtwmer_order_processing')
					{
						if( ($rtwmer_prev_order_staus != 'processing') && ($rtwmer_new_order_status == 'processing') )
						{
							if( isset($rtwmer_admin_order_commision_for_vendor) && isset($rtwmer_order_vendor_id) && isset($rtwmer_order_total) )
							{
								if(get_post_meta($rtwmer_order_id,'rtwmer_vendor_payment_after_admin_approvale',true ) != 'true')
								{
									update_user_meta( $rtwmer_order_vendor_id,'rtwmer_total_amount',intval(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true)) + ($rtwmer_order_total - $rtwmer_admin_order_commision_for_vendor));

									update_post_meta($rtwmer_order_id,'rtwmer_vendor_payment_after_admin_approvale','true' );
								}
							}
						}
						else if( ($rtwmer_prev_order_staus == 'processing') && ($rtwmer_new_order_status != 'processing') )
						{
							if( isset($rtwmer_admin_order_commision_for_vendor) && (isset($rtwmer_order_vendor_id)) && (isset($rtwmer_order_total)) )
							{
								update_post_meta($rtwmer_order_id,'rtwmer_vendor_payment_after_admin_approvale','false' );

								update_user_meta( $rtwmer_order_vendor_id,'rtwmer_total_amount',intval(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true)) - ($rtwmer_order_total - $rtwmer_admin_order_commision_for_vendor));
							}
						}
					}
					else if(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor'] == 'rtwmer_after_admin_approval')
					{

						if( ($rtwmer_prev_order_staus == 'completed') && ($rtwmer_new_order_status != 'completed') && (get_post_meta($rtwmer_order_id,'rtwmer_vendor_payment_after_admin_approvale',true ) == 'true') )
						{
							if( isset($rtwmer_admin_order_commision_for_vendor) && (isset($rtwmer_order_vendor_id)) && (isset($rtwmer_order_total)) )
							{
								update_post_meta($rtwmer_order_id,'rtwmer_vendor_payment_after_admin_approvale','false' );

								update_user_meta( $rtwmer_order_vendor_id,'rtwmer_total_amount',intval(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true)) - ($rtwmer_order_total - $rtwmer_admin_order_commision_for_vendor));
							}
						}
					}
				}
			}
		}
	}

//=========================function is used to manage orders on changing of their orders==================///

	function rtwmer_order_status_manage_on_change($rtwmer_order_parent_id)
	{
		if(isset($rtwmer_order_parent_id))
		{
			$rtwmer_children_post_args = array(
				'post_parent'	=> 	$rtwmer_order_parent_id,
				'post_type'		=>	'shop_order',
				'post_status'	=>	'-1'
			);
			$rtwmer_order_children = get_children( $rtwmer_children_post_args );

			if( isset($rtwmer_order_children) && !empty($rtwmer_order_children) && is_array($rtwmer_order_children) )
			{
				foreach($rtwmer_order_children as $key)
				{
					$rtwmer_each_sub_order_id = $key->ID;

					$rtwmer_each_sub_order_object = wc_get_order($rtwmer_each_sub_order_id);

					$rtwmer_each_sub_order_status[] = $rtwmer_each_sub_order_object->get_status();

					$rtwmer_each_sub_order_status_unique = array_unique($rtwmer_each_sub_order_status);
					if( count($rtwmer_each_sub_order_status_unique) == 1 )
					{
						$my_post = array(
							'ID'           => $rtwmer_order_parent_id,
							'post_status'   => 'wc-'.($rtwmer_each_sub_order_status_unique[0]),
						);
						wp_update_post( $my_post );
					}
				}
			}
		}
	}

	//======================Function is used to display product stats and vendor's data a pie in report section========//

	function rtwmer_chart_data_action_for_product_stats_cb()
	{
		if( check_ajax_referer('rtwmer-vendor-nonce','rtwmer_chart_data_nonce_verify') )
		{
			global $wpdb;

			$rtwmer_list_prod_start_date = strtotime(date('Y-m', current_time('timestamp')) . '-1 midnight');

			$rtwmer_list_end_date = strtotime('+1month', $rtwmer_list_prod_start_date) - 86400;

			$rtwmer_query = "SELECT COUNT(*) FROM ".$wpdb->prefix."posts WHERE post_type='%s' AND post_status!='%s' AND post_status='%s' AND post_date >= '%s' AND post_date < '%s'";

			if( isset($rtwmer_query) )
			{
				$rtwmer_get_online_products = $wpdb->get_var( $wpdb->prepare($rtwmer_query,'product','auto-draft','publish',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );
				$rtwmer_get_draft_products = $wpdb->get_var( $wpdb->prepare($rtwmer_query,'product','auto-draft','draft',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );
				$rtwmer_get_pending_products = $wpdb->get_var( $wpdb->prepare($rtwmer_query,'product','auto-draft','pending',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );
			}
			$rtwmer_query_for_all = "SELECT COUNT(*) FROM ".$wpdb->prefix."posts WHERE post_type='%s' AND post_status!='%s' AND post_date >= '%s' AND post_date < '%s'";

			if( isset($rtwmer_query_for_all) )
			{
				$rtwmer_get_total_products = $wpdb->get_var( $wpdb->prepare($rtwmer_query_for_all,'product','auto-draft',date("Y-m-d",$rtwmer_list_prod_start_date),date("Y-m-d",$rtwmer_list_end_date)) );
			}

			if( isset($rtwmer_get_online_products) && isset($rtwmer_get_draft_products) && isset($rtwmer_get_total_products) && isset($rtwmer_get_pending_products) )
			{
				$rtwmer_product_stats = array($rtwmer_get_online_products,$rtwmer_get_draft_products,$rtwmer_get_pending_products,$rtwmer_get_total_products);
			}

			$rtwmer_query_for_vendors = "SELECT COUNT(*) FROM ".$wpdb->prefix."users as m LEFT JOIN(SELECT user_id,
			MAX(CASE WHEN meta_key='rtwmer_vendor_status' THEN meta_value END) rtwmer_vendor_status
			FROM $wpdb->usermeta GROUP BY user_id) rtwmer_unapproved_vendor_table ON m.`ID` = rtwmer_unapproved_vendor_table.`user_id` WHERE rtwmer_vendor_status=%d";

			if( isset($rtwmer_query_for_vendors) )
			{
				$rtwmer_approved_vendoors = $wpdb->get_var( $wpdb->prepare($rtwmer_query_for_vendors,1) );
				$rtwmer_unapproved_vendoors = $wpdb->get_var( $wpdb->prepare($rtwmer_query_for_vendors,0) );

				if( isset($rtwmer_approved_vendoors) && isset($rtwmer_unapproved_vendoors) )
				{
					$rtwmer_total_vendors_no = $rtwmer_approved_vendoors + $rtwmer_unapproved_vendoors;
					if( isset($rtwmer_total_vendors_no) )
					{
						$rtwmer_total_vendoors = array($rtwmer_approved_vendoors,$rtwmer_unapproved_vendoors);
					}
				}
			}

			if( isset($rtwmer_product_stats) && isset($rtwmer_total_vendoors) )
			{
				$rtwmer_vendors_and_product_stats = array(
					'rtwmer_product_stats' => $rtwmer_product_stats,
					'rtwmer_total_vendoors' => $rtwmer_total_vendoors
				);
				if( isset($rtwmer_vendors_and_product_stats) )
				{
					do_action('rtwmer_vendors_and_product_stats_from_db',$rtwmer_vendors_and_product_stats);
					echo json_encode($rtwmer_vendors_and_product_stats);
				}
				wp_die();
			}
			wp_die();
		}
	}

	public function rtwmer_profile_update( $user_id, $old_user_data, $userdata )
	{
		if(isset($userdata['role']) && $userdata['role'] == 'rtwmer_vendor')
		{
			$rtwmer_current_registerd_user_data = get_userdata($user_id);

			if( isset($rtwmer_current_registerd_user_data) )
			{
				$rtwmer_current_registerd_user_role = $rtwmer_current_registerd_user_data->roles;
				if( isset($rtwmer_current_registerd_user_role[0]) )
				{
					if( in_array('administrator',$rtwmer_current_registerd_user_role) || in_array('rtwmer_vendor',$rtwmer_current_registerd_user_role) )
					{
						if( !empty(get_option('rtwmer_selling_page')) )
						{
							$rtwmer_selling_page = get_option('rtwmer_selling_page');

							if(isset($rtwmer_selling_page))
							{
								if( isset($rtwmer_selling_page['rtwmer_allow_add_product']) )
								{
									if( $rtwmer_selling_page['rtwmer_allow_add_product'] == 1 )
									{
										$user_meta1 = get_user_meta($user_id, 'rtwmer_vendor_status');
										if(empty($user_meta1))
										{
											update_user_meta($user_id, 'rtwmer_vendor_status', 1);
										}
									}
									else
									{
										$user_meta1 = get_user_meta($user_id, 'rtwmer_vendor_status');
										if(empty($user_meta1))
										{
											update_user_meta($user_id, 'rtwmer_vendor_status', 0);
										}
									}
								}
							}
						}
						// do_action('rtwmer_creating_new_vendor');
						$user_meta2 = get_user_meta($user_id, 'rtwmer_vendor_store_img');
						if(empty($user_meta2))
						{
							update_user_meta( $user_id, 'rtwmer_vendor_store_img', 0 );
						}

						$user_meta3 = get_user_meta($user_id, 'rtwmer_store_name');
						if(empty($user_meta3))
						{
							update_user_meta( $user_id, 'rtwmer_store_name',  '(no name)' );
						}

						// update_user_meta( $user_id, 'rtwmer_store_name', '(no name)' );
						update_user_meta( $user_id, 'rtwmer_role', 'rtwmer_vendor' );
					}
				}
			}
		}
		else{
			update_user_meta( $user_id, 'rtwmer_role', $userdata['role'] );
		}
	}

	public function rtwmer_show_notices_on_admin(){
		if ( 'no' === get_option( 'woocommerce_enable_myaccount_registration', 'no' ) ) { // For my-account registration disabled.
			$account_url = admin_url( 'admin.php?page=wc-settings&tab=account' );
			$message     = wp_sprintf( /* translators: %s Settings test, %s: Setting page link */ esc_html__( 'To allow vendor registration %1$s setting must be checked from %2$s ', 'rtwmer-mercado' ), '<b>' . esc_html__( 'Allow customers to create an account on the My account page', 'rtwmer-mercado' ) . '</b>', '<a href="' . esc_url( $account_url ) . '">' . esc_html__( 'WooCommerce Account Settings', 'rtwmer-mercado' ) . '</a>' );
			$this->rtwmer_show_notice_on_admin( $message, 'error' );
		}
	}

	/**
	 * Wrapper for admin notice.
	 *
	 * @param  string $message The notice message.
	 * @param  string $type Notice type like info, error, success.
	 * @param  array  $args Additional arguments for wp-6.4.
	 *
	 * @return void
	 */
	public static function rtwmer_show_notice_on_admin( $message = '', $type = 'error', $args = array() ) {
		if ( ! empty( $message ) ) {
			if ( function_exists( 'wp_admin_notice' ) ) {
				$args         = is_array( $args ) ? $args : array();
				$args['type'] = empty( $args['type'] ) ? $type : $args['type'];

				wp_admin_notice( $message, $args );
			} else {
				?>
			<div class="<?php echo esc_attr( $type ); ?>"><p><?php echo wp_kses_post( $message ); ?></p></div>
				<?php
			}
		}
	}


	function rtwmer_plugin_send_feedback() {
		
		global $rtwmer_user_id_for_dashboard;
		if ( !empty($_POST['comments']) && isset($_POST['comments'])) {
			
			$rtwwwap_from 			= get_user_by( 'ID', $rtwmer_user_id_for_dashboard );
			$rtwmer_user_email 	= esc_html( $rtwwwap_from->user_email );
			$rtwmer_user_name      = esc_html( $rtwwwap_from->user_login );

			$reason = sanitize_text_field($_POST['reason']);
			$comments = sanitize_textarea_field($_POST['comments']);
			$to = 'alexrtw1403@gmail.com';
			$subject = 'Plugin Deactivation Feedback';

			$rtwmer_site_data     = explode('://', get_site_url());
			$rtwmer_site_domain 	= $rtwmer_site_data[1];
			$rtwmer_plugin_name 	= 'Mercado - Turn your WooCommerce into MultiVendor MarketPlace';
			$rtwmer_plugin_text_domain 	= 'rtwmer-mercado';

			$rtwmer_post_array = array(
				'site_domain' => $rtwmer_site_domain,
				'admin_email' => $rtwmer_user_email,
				'admin_name' => $rtwmer_user_name,
				'plugin_name' => $rtwmer_plugin_name,
				'text_domain' => $rtwmer_plugin_text_domain,
				'comment' => $_POST['comments']
			);
			$args = array(
				'method' => 'POST',
				'headers'  => array(
					'Content-type: application/x-www-form-urlencoded'
				),
				'sslverify' => false,
				'body' => $rtwmer_post_array
			);
	
			$response = wp_remote_post('https://demo.redefiningtheweb.com/license-verification/license-verification.php', $args);
			wp_send_json_success($response);

		}
		wp_die(); // this is required to terminate immediately and return a proper response
	}
}
