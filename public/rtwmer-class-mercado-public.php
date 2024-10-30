<?php
use Automattic\WooCommerce\Utilities\OrderUtil;

/**
 * The public-specific functionality of the plugin.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/public
 */

/**
 * The public-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-specific stylesheet and JavaScript.
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/public
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwmer_Mercado_Public
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
	private $rtwwwap_comm_gene = false;

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
		add_shortcode('rtwmer_extra_product_option',array($this,'rtwmer_extra_product_option_callback'));
	}

	/**
	 * Register the stylesheets for the public area.
	 *
	 * @since    1.0.0
	 */
	public function rtwmer_enqueue_styles()
	{
		global $wp_query;
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
		$rtwmer_options = get_option("rtwmer_page_setting");
		wp_enqueue_style('select2_css', RTWMER_ASSETS_COMMON_CSS . 'select2.min.css', array(), $this->rtwmer_version, 'all');
		wp_register_style( 'jquery-ui', plugin_dir_url(__FILE__) . 'css/jquery-ui.min.css', array(), $this->rtwmer_version, 'all' );
		wp_enqueue_style( 'jquery-ui' ); 
		wp_enqueue_style( 'select2css' );
		wp_enqueue_style( 'buttons' );
		wp_enqueue_style( 'imgareaselect' );
		wp_enqueue_style( 'media-views' ) ;
		wp_enqueue_style("rtwmer_time_picker", plugin_dir_url(__FILE__) . 'css/timepicker.min.css', array(), $this->rtwmer_version, 'all');
		wp_enqueue_style("rtwmer_font_awesome", plugin_dir_url(__FILE__) . 'css/font_awesome.css', array(), $this->rtwmer_version, 'all');
		wp_enqueue_style( 'woocommerce_style', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce.css',array(), $this->rtwmer_version, 'all');
		if (!empty($rtwmer_options) && is_array($rtwmer_options)) {
			$rtwmer_title = (int)$rtwmer_options['rtwmer_page_setting_dashboard'];
			$rtwmer_store = $rtwmer_options['rtwmer_page_store_listing'];
		} else {
			$rtwmer_title = "";
			$rtwmer_store = "";
		}
		
		if ($wp_query->get_queried_object_id() == $rtwmer_title && (current_user_can("mercador"))) {
			wp_enqueue_style( "rtwmer_bundleCSS", RTWMER_ASSETS_BUNDLE_JS . 'css/bundle.css', array(), $this->rtwmer_version, 'all' );
			wp_enqueue_style( "rtwmer_material-icons", 'https://fonts.googleapis.com/icon?family=Material+Icons' , array(), $this->rtwmer_version, 'all' );		// This file has the material design icons pack
			wp_enqueue_style('material-datatable-ajax', RTWMER_ASSETS_COMMON_CSS . 'material.min.css', array(), $this->rtwmer_version, 'all');
			wp_enqueue_style('material-datatables', RTWMER_ASSETS_COMMON_CSS . 'dataTables.material.min.css', array(), $this->rtwmer_version, 'all');
			if(is_rtl())
			{
				wp_enqueue_style("rtwmer_mercado_shortcode_page_css", plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-shortcode-page-rtl.css', array(), $this->rtwmer_version, 'all');
				wp_enqueue_style("rtwmer_lite_theme_css", plugin_dir_url(__FILE__) . 'css/rtwmer_lite_material_rtl_css.css', array(), $this->rtwmer_version, 'all');
			}else{
				wp_enqueue_style("rtwmer_mercado_shortcode_page_css", plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-shortcode-page.css', array(), $this->rtwmer_version, 'all');
				wp_enqueue_style("rtwmer_lite_theme_css", plugin_dir_url(__FILE__) . 'css/rtwmer_lite_material_css.css', array(), $this->rtwmer_version, 'all');
			}
			
			global $wp_styles;
			global $wp_themes;
			$wp_get_theme = wp_get_theme();
			$parent_theme = $wp_get_theme->get_stylesheet();
			foreach( $wp_styles->queue as $style ):
				$handle = $wp_styles->registered[$style]->handle;
				$rtw[] = $wp_styles->registered[$style]->handle;
				
				$rtwmer_css_exception = array(
					"wc_block" =>	"wc-block-style",
					"wp_block" =>	"wp-block-library",
					"wp_block_library" =>	"wp-block-library-theme",
					"admin_bar" =>	 "admin-bar",
					"rtwmer_bundle" =>	"rtwmer_bundleCSS",
					"rtwmer_material_icons" =>	 "rtwmer_material-icons" ,
					"rtwmer_material_datatable" =>	"material-datatable-ajax",
					"rtwmer_datatable" =>	 "material-datatables",
					"rtwmer_select2" =>	"select2_css",
					"rtwmer_date_picker" =>	"jquery-ui",
					"rtwmer_lite_theme" =>	"rtwmer_lite_theme_css",
					"rtwmer_vendor_shortcode" =>	"rtwmer_mercado_shortcode_page_css",
					"rtwmer_font_awesome" =>	"rtwmer_font_awesome",
					"rtwmer_woocommerce" =>	"woocommerce-inline",
					"media_view" =>	 "media-views",
					"rtwmer_jquery" =>	"rtwmer_jquery_css",
					"rtwmer_image" =>	"imgareaselect",
					"rtwmer_woocommerce_style" =>	 "woocommerce_style",
					"rtwmer_timepicker_style"	=>	"rtwmer_time_picker",
					"buttons"	=> "buttons",
					"dashicons"	=>	"dashicons",
					"wp-mediaelement" =>	"wp-mediaelement",
				);
				$rtwmer_css_exception = apply_filters("rtwmer_include_css",$rtwmer_css_exception );    
				if( !in_array( $handle, $rtwmer_css_exception ) ){
					wp_dequeue_style( $handle );
					wp_deregister_style( $handle );
				}
			endforeach;
		}
		$rtwmer_var  =  get_query_var('rtwmer_pagename');
		$rtwmer_options_array  =  get_option('rtwmer_general_setting');
		if (!empty($rtwmer_options_array) && is_array($rtwmer_options_array)) {
			$rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];
		} else {
			$rtwmer_endpoint_page = "";
		}
		$rtwmer_current_id =  $wp_query->get_queried_object_id();
		if ($rtwmer_var == $rtwmer_endpoint_page || $rtwmer_current_id == $rtwmer_store) {
			wp_enqueue_style( "rtwmer_bundleCSS", RTWMER_ASSETS_BUNDLE_JS . 'css/bundle.css', array(), $this->rtwmer_version, 'all' );
			wp_enqueue_style( "rtwmer_material-icons", 'https://fonts.googleapis.com/icon?family=Material+Icons' , array(), $this->rtwmer_version, 'all' );		// This file has the material design icons pack
			if(is_rtl())
			{
				wp_enqueue_style("rtwmer_store_css", plugin_dir_url(__FILE__) . 'css/rtwmer_store_rtl.css', array(), $this->rtwmer_version, 'all');
			}else{
				wp_enqueue_style("rtwmer_store_css", plugin_dir_url(__FILE__) . 'css/rtwmer_store.css', array(), $this->rtwmer_version, 'all');
			}
		}
		$rtwmer_map_per = get_option('rtwmer_appearence_page');
		if (is_array($rtwmer_map_per)) {
			$rtwmer_map_show = $rtwmer_map_per['rtwmer_enable_map'];
		} else {
			$rtwmer_map_show = 0;
		}
		if ($rtwmer_map_show == 1) {
			$rtwmer_current_map = $rtwmer_map_per['rtwmer_current_using_map'];
			if ($rtwmer_current_map == "mapbox") {
				wp_enqueue_style("rtwmer_mapbox_css", plugin_dir_url(__FILE__) . 'css/mapbox.css', array(), $this->rtwmer_version, 'all');
			}
		}

		if(is_rtl())
		{
			wp_enqueue_style("rtwmer_mercado_public_css", plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-public-rtl.css', array(), $this->rtwmer_version, 'all');
		}else{
			wp_enqueue_style("rtwmer_mercado_public_css", plugin_dir_url(__FILE__) . 'css/rtwmer-mercado-public.css', array(), $this->rtwmer_version, 'all');
		}

	}

	/**
	 * Register the JavaScript for the public area.
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
		$rtwmer_var  =  get_query_var('rtwmer_pagename');
		$rtwmer_options = get_option("rtwmer_page_setting");
		global $wp;

		// wp_enqueue_script('select2', RTWMER_ASSETS_COMMON_JS . "select2.min.js", array('jquery'), $this->rtwmer_version, 'all');
		wp_enqueue_script( 'select2' );
	
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script("rtwmer_time_picker_js", plugin_dir_url(__FILE__) . 'js/jquery.timepicker.min.js', array('jquery'), $this->rtwmer_version, false);
		wp_enqueue_script('rtwmer_chart', RTWMER_ASSETS_COMMON_JS . 'Chart.min.js', array('jquery'), $this->rtwmer_version, false);
		wp_enqueue_script( "bundleJs", RTWMER_ASSETS_BUNDLE_JS . 'js/bundle.js', array(), $this->rtwmer_version, 'all' );
		wp_enqueue_script('material_dataTable_Js', RTWMER_ASSETS_COMMON_JS . "jquery.dataTables.min.js", array('jquery'), $this->rtwmer_version, 'all');
		wp_enqueue_script('material_dataTable_Js2', RTWMER_ASSETS_COMMON_JS . "dataTables.material.min.js", array('jquery',"material_dataTable_Js"), $this->rtwmer_version, 'all');
		wp_enqueue_script('nicescrolljs', RTWMER_ASSETS_COMMON_JS . 'jquery.nicescroll.min.js', array('jquery'), $this->rtwmer_version, 'all');
		wp_enqueue_script('notify', RTWMER_ASSETS_URL . '/notify.min.js', array('jquery'), $this->rtwmer_version, false);
		wp_localize_script(
			'rtwmer_public_js',
			'rtwmer_public_ajax',
			array('rtwmer_public_ajax_url' => admin_url('admin-ajax.php'),'rtwmer_translation' => $this->rtwmer_mercado_lite_translations(), 'rtwmer_public_ajax_nonce' => wp_create_nonce("rtwmer_mercado_check_nonce"))
		);
		if (!empty($rtwmer_options) && is_array($rtwmer_options)) {
			$rtwmer_title = (int)$rtwmer_options['rtwmer_page_setting_dashboard'];
			$rtwmer_store = $rtwmer_options['rtwmer_page_store_listing'];
		} else {
			$rtwmer_title  =  "";
			$rtwmer_store  =  "";
		}
		$rtwmer_options_array  =  get_option('rtwmer_general_setting');
		if (!empty($rtwmer_options_array) && is_array($rtwmer_options_array)) {
			$rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];
		} else {
			$rtwmer_endpoint_page = "";
		}
		global $wp_query;
		if (($wp_query->get_queried_object_id() == $rtwmer_title && (current_user_can("mercador")))) {
			wp_enqueue_script('ajax-script', plugin_dir_url(__FILE__) . 'js/rtwmer-mercado-public.js', array('jquery',"nicescrolljs","material_dataTable_Js2","select2","rtwmer_time_picker_js"), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer_product_all', plugin_dir_url(__FILE__) . 'js/rtwmer_product_all.js', array('jquery', 'ajax-script'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer_order_all', plugin_dir_url(__FILE__) . 'js/rtwmer_mercado_order_all.js', array('jquery', 'ajax-script'), $this->rtwmer_version, false);
			wp_enqueue_media();
			wp_enqueue_script('rtwmer_mediajs', plugin_dir_url(__FILE__) . 'js/rtwmer_media.js', array('jquery'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer_store_setting', plugin_dir_url(__FILE__) . 'js/rtwmer_vendor_store_page.js', array('jquery', 'ajax-script','rtwmer_time_picker_js'), $this->rtwmer_version, false);
			wp_localize_script(
				'ajax-script',
				'rtwmer_ajax_object',
				array('rtwmer_ajax_url' => admin_url('admin-ajax.php'),	'rtwmer_translation' => $this->rtwmer_mercado_lite_translations(), 'rtwmer_ajax_nonce' => wp_create_nonce("rtwmer_mercado_check_nonce"))
			);
			wp_enqueue_script('rtwmer_withdraw_req', plugin_dir_url(__FILE__) . 'js/rtwmer_Withdraw_page.js', array('jquery', 'ajax-script'), $this->rtwmer_version, false);
			wp_enqueue_script('rtwmer_payment_page', plugin_dir_url(__FILE__) . 'js/rtwmer_payments_page.js', array('jquery', 'ajax-script'), $this->rtwmer_version, false);
			$rtwmer_map_per = get_option('rtwmer_appearence_page');
			if (is_array($rtwmer_map_per)) {
				$rtwmer_map_show = $rtwmer_map_per['rtwmer_enable_map'];
			} else {
				$rtwmer_map_show = 0;
			}
			global $rtwmer_user_id_for_dashboard;
			if ($rtwmer_map_show == 1) {
				$rtwmer_current_map = $rtwmer_map_per['rtwmer_current_using_map'];
				if ($rtwmer_current_map == "googlemap") {
					$rtwmer_vendor_map_key = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_map_api_key", true);
					wp_enqueue_script('rtwmer_endpoint_map',  'https://maps.googleapis.com/maps/api/js?key=' . $rtwmer_vendor_map_key, array('jquery'), $this->rtwmer_version, false);		// This cdn is used for google maps which has the secret key attach to it
				} else {
					wp_enqueue_script(
						'rtwmer_mapbox',
						plugin_dir_url(__FILE__) . 'js/mapbox.js',
						array('jquery', 'ajax-script'),
						$this->rtwmer_version,
						false
					);
				}
			}
		}
		if ($rtwmer_var == $rtwmer_endpoint_page) {
			$rtwmer_var  =  get_query_var('rtwmer_nicename');
			$rtwmer_vendor_detail_obj  =  get_user_by('slug', $rtwmer_var);
			if (is_object($rtwmer_vendor_detail_obj)) {
				$rtwmer_vendor_id = $rtwmer_vendor_detail_obj->data->ID;
				$rtwmer_map_per = get_option('rtwmer_appearence_page');
				if (is_array($rtwmer_map_per)) {
					$rtwmer_map_show = $rtwmer_map_per['rtwmer_enable_map'];
				} else {
					$rtwmer_map_show = 0;
				}
				if ($rtwmer_map_show == 1) {
					$rtwmer_current_map = $rtwmer_map_per['rtwmer_current_using_map'];
					if ($rtwmer_current_map == "googlemap") {
						$rtwmer_vendor_map_key = get_user_meta($rtwmer_vendor_id, "rtwmer_map_api_key", true);
						if (!empty($rtwmer_vendor_map_key)) {
							wp_enqueue_script('rtwmer_endpoint_map',  'https://maps.googleapis.com/maps/api/js?key=' . $rtwmer_vendor_map_key, array('jquery'), $this->rtwmer_version, false);		// This cdn is used for google maps which has the secret key attach to it
						}
					} else {
						wp_enqueue_script(
							'rtwmer_mapbox',
							plugin_dir_url(__FILE__) . 'js/mapbox.js',
							array('jquery', 'ajax-script'),
							$this->rtwmer_version,
							false
						);
					}
				}
			}
			wp_enqueue_script('rtwmer_store_endpoint_js',  plugin_dir_url(__FILE__) . 'js/rtwmer_store_endpoint.js', array('jquery'), $this->rtwmer_version, false);
			wp_localize_script(
				'rtwmer_store_endpoint_js',
				'rtwmer_ajax_object',
				array(
					'rtwmer_ajax_url' => admin_url('admin-ajax.php'),
					'rtwmer_translation' => $this->rtwmer_mercado_lite_translations(), 'rtwmer_ajax_nonce' => wp_create_nonce("rtwmer_mercado_check_nonce")
				)
			);
		}
		$rtwmer_acc_page = get_option('woocommerce_myaccount_page_id');
		if ($wp_query->get_queried_object_id() == (int) $rtwmer_store) {
			$rtwmer_map_key = get_option('rtwmer_appearence_page');
			if (is_array($rtwmer_map_key) && isset($rtwmer_map_key['rtwmer_google_map_value']) && !empty($rtwmer_map_key['rtwmer_google_map_value'])) {
				$rtwmer_key = $rtwmer_map_key['rtwmer_google_map_value'];
				wp_enqueue_script('rtwmer_store_listing_map',  'https://maps.googleapis.com/maps/api/js?key=' . $rtwmer_key, array('jquery'), $this->rtwmer_version, false);	// This cdn is used for google maps which has the secret key attach to it
			}
			wp_enqueue_script('rtwmer_store_listing',  plugin_dir_url(__FILE__) . 'js/rtwmer_store_listing.js', array('jquery'), $this->rtwmer_version, false);
			wp_localize_script(
				'rtwmer_store_listing',
				'rtwmer_ajax_object',
				array(
					'rtwmer_ajax_url' => admin_url('admin-ajax.php'),
					'rtwmer_translation' => $this->rtwmer_mercado_lite_translations(), 'rtwmer_ajax_nonce' => wp_create_nonce("rtwmer_mercado_check_nonce")
				)
			);
		}
		if ($wp_query->get_queried_object_id() == $rtwmer_acc_page) {
			wp_enqueue_script('rtwmer_registration_page_js',  plugin_dir_url(__FILE__) . 'js/rtwmer-registration-page.js', array('jquery'), $this->rtwmer_version, false);
		}
	}

	function rtwmer_control_scripts(){

		global $wp_query;
		$rtwmer_options = get_option("rtwmer_page_setting");
		if (!empty($rtwmer_options) && is_array($rtwmer_options)) {
			$rtwmer_title = (int)$rtwmer_options['rtwmer_page_setting_dashboard'];
			$rtwmer_store = $rtwmer_options['rtwmer_page_store_listing'];
		} else {
			$rtwmer_title  =  "";
			$rtwmer_store  =  "";
		}
		if($wp_query->get_queried_object_id() === $rtwmer_title && (current_user_can("mercador"))){
			global $wp_scripts;
			foreach( $wp_scripts->queue as $style ):
				$handle = $wp_scripts->registered[$style]->handle;
				$rtwmer_js_exception = array(
					"jquery",
					"select2",
					"placeholder",
					"admin-bar",
					"jquery-ui-datepicker",
					"rtwmer_time_picker_js",
					"rtwmer_chart",
					"bundleJs",
					"material_dataTable_Js",
					"material_dataTable_Js2",
					"nicescrolljs",
					"notify",
					"ajax-script",
					"rtwmer_product_all",
					"rtwmer_order_all",
					"media-editor",
					"media-audiovideo",
					"rtwmer_mediajs",
					"rtwmer_store_setting",
					"rtwmer_withdraw_req",
					"rtwmer_payment_page",
				);
				$rtwmer_js_exception = apply_filters("rtwmer_include_js", $rtwmer_js_exception);
				if (!in_array($handle, $rtwmer_js_exception)) {
					wp_dequeue_script($handle);
					wp_deregister_script($handle);
				
				}
			endforeach;
		}
	}



	function rtwmer_user_can_access($rtwmer_user_capability = "")
	{
		if (is_user_logged_in()) {
			$rtwmer_user = wp_get_current_user();
			if (in_array('rtwmer_vendor', (array) $rtwmer_user->roles) || in_array('administrator', (array) $rtwmer_user->roles)) {
				return true;
			} else {
				$rtwmer_capabilities_array = get_user_meta(get_current_user_id(), "rtwmer_user_capabilities", true);
				if ($rtwmer_capabilities_array && isset($rtwmer_capabilities_array[$rtwmer_user_capability]) && !empty($rtwmer_capabilities_array[$rtwmer_user_capability])) {
					return $rtwmer_capabilities_array[$rtwmer_user_capability];
				} else {
					return false;
				}
			}
		}
	}

		//=============   function to retrieve store name from user     ==========================//
	//=============   function to retrieve store name from user    ==========================//
	function rtwmer_get_store_name($rtwmer_user)
	{
		return (!empty($rtwmer_user)) ? get_user_meta($rtwmer_user, "rtwmer_store_name", true) : false;
	}


	//=============   function to retrieve vendor from order     ==========================//
	//=============   function to retrieve vendor from order    ==========================//
	function rtwmer_get_vendor_from_order($rtwmer_order_id){
		$rtwmer_order_vendor = get_post_meta($rtwmer_order_id,"rtwmer_order_vendor",true);
		if($rtwmer_order_vendor){
			return $rtwmer_order_vendor;
		}else{
			$rtwmer_admin_obj = get_user_by( "email", get_bloginfo( 'admin_email' ) );
			return $rtwmer_admin_obj->data->ID;
		}
	}


		//=============   function to calculate the hour range    ==========================//
	//=============   function to calculate the hour range    ==========================//
	function rtwmer_hours_range($rtwmer_lower = 0, $rtwmer_upper = 86400, $rtwmer_step = 3600, $rtwmer_format = '')
	{
		$rtwmer_times = array();

		if (empty($rtwmer_format)) {
			$rtwmer_format = 'g:i a';
		}

		foreach (range($rtwmer_lower, $rtwmer_upper, $rtwmer_step) as $rtwmer_increment) {
			$rtwmer_increment = gmdate('H:i', $rtwmer_increment);

			list($rtwmer_hour, $rtwmer_minutes) = explode(':', $rtwmer_increment);

			$rtwmer_date = new DateTime($rtwmer_hour . ':' . $rtwmer_minutes);

			$rtwmer_times[(string) $rtwmer_increment] = $rtwmer_date->format($rtwmer_format);
		}

		return $rtwmer_times;
	}


	//=============   function for sanitizing the array   ==========================//
	//=============   function for sanitizing the array   ==========================//
	function rtwmer_sanitize_array($rtwmer_data_array)
	{
		if (isset($rtwmer_data_array) && !empty($rtwmer_data_array)) {
			$rtwmer_save_data_array = array();
			foreach ($rtwmer_data_array as $rtwmer_key => $rtwmer_value) {
				if (is_array($rtwmer_value)) {
					$rtwmer_save_data_array[$rtwmer_key] = $this->rtwmer_sanitize_array($rtwmer_value);
				} elseif ($rtwmer_value == "true" || $rtwmer_value == "false" || $rtwmer_value == "yes" || $rtwmer_value == "no") {
					$rtwmer_save_data_array[$rtwmer_key] = filter_var($rtwmer_value, FILTER_VALIDATE_BOOLEAN);
				} else {
					$rtwmer_save_data_array[$rtwmer_key] = sanitize_text_field($rtwmer_value);
				}
			}
			return $rtwmer_save_data_array;
		}
	}


	//=============   function for updating the user meta   ==========================//
	//=============   function for updating the user meta   ==========================//
	function rtwmer_update_user_meta($rtwmer_user_id, $rtwmer_option_key, $rtwmer_data_array)
	{
		if (isset($rtwmer_data_array) && !empty($rtwmer_data_array) && is_array($rtwmer_data_array)) {
			$rtwmer_data_array = $this->rtwmer_sanitize_array($rtwmer_data_array);
			$rtwmer_return = update_user_meta($rtwmer_user_id, $rtwmer_option_key, $rtwmer_data_array);
			return $rtwmer_return;
		} elseif (isset($rtwmer_data_array) && !empty($rtwmer_data_array)) {
			$rtwmer_return = update_user_meta($rtwmer_user_id, $rtwmer_option_key, $rtwmer_data_array);
			return $rtwmer_return;
		} else {
			return false;
		}
	}
	//=============   function to retrieve vendor from product     ==========================//
	//=============   function to retrieve vendor from product    ==========================//
	function rtwmer_get_vendor_from_product($post_id)
	{
		return get_post_field('post_author', $post_id);
	}

	//=============   function for Store page woocommerce breadcrumb     ==========================//
	//=============   function for Store page woocommerce breadcrumb    ==========================//

	function rtwmer_woocommerce_breadcrumb($rtwmer_breadcrumbs)
	{
		$rtwmer_var  =  get_query_var('rtwmer_pagename');
		$rtwmer_nicename  =  get_query_var('rtwmer_nicename');
		$rtwmer_options_array  =  get_option('rtwmer_general_setting');
		if (!empty($rtwmer_options_array) && is_array($rtwmer_options_array)) {
			$rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];
		} else {
			$rtwmer_endpoint_page = "";
		}
		if ($rtwmer_var == $rtwmer_endpoint_page) {
			$rtwmer_breadcrumbs[1] = array(esc_html__($rtwmer_var, "rtwmer-mercado"), esc_url(home_url() . "/" . $rtwmer_endpoint_page));
			$rtwmer_breadcrumbs[2] = array(esc_html__($rtwmer_nicename, "rtwmer-mercado"), "");
		}
		return $rtwmer_breadcrumbs;
	}

	//=============   function for translation text     ==========================//
	//=============   function for translation text    ==========================//

	function rtwmer_mercado_lite_translations()
	{
		$rtwmer_translation_array = require(RTWMER_PUBLIC_PARTIAL . "rtwmer_mercado_translations.php");
		return $rtwmer_translation_array;
	}




	//=============   function for vendor related attachments shown     ==========================//
	//=============   function for vendor related attachments shown     ==========================//

	function rtwmer_manager($rtwmer_query)
	{
		global $rtwmer_user_id_for_dashboard;
		$rtwmer_query['author'] = $rtwmer_user_id_for_dashboard;
		return $rtwmer_query;
	}

	//=============  function for commission      ==========================//
	//=============    function for commission    ==========================//

	function rtwmer_commission($rtwmer_author, $rtwmer_price)
	{
		$rtwmer_meta_commision = get_user_meta($rtwmer_author, 'rtwmer_admin_vendor_commssion', true);
		$rtwmer_meta_value = get_user_meta($rtwmer_author, 'rtwmer_vendor_admin_commision_value', true);
		if (!empty($rtwmer_meta_commision) && !empty($rtwmer_meta_value)) {
			$rtwmer_commision_type = $rtwmer_meta_commision;
			$rtwmer_commision = $rtwmer_meta_value;
		} else {
			$rtwmer_option  =   get_option('rtwmer_selling_page');
			if (isset($rtwmer_option['rtwmer_commission_type'])) {
				$rtwmer_commision_type  =   $rtwmer_option['rtwmer_commission_type'];
			}
			if (isset($rtwmer_option['rtwmer_comission_value'])) {
				$rtwmer_commision   =   $rtwmer_option['rtwmer_comission_value'];
			}
		}
		if (isset($rtwmer_commision_type) && $rtwmer_commision_type ==  "percentage") {
			$rtwmer_saving_commission   =   ((float)$rtwmer_price / 100) *  (float) $rtwmer_commision;
			$rtwmer_saving  =   $rtwmer_saving_commission;
		} elseif (isset($rtwmer_commision_type) && $rtwmer_commision_type == "flat") {
			$rtwmer_saving_commission   =  $rtwmer_commision;
			$rtwmer_saving  =   $rtwmer_saving_commission;
		} else {
			$rtwmer_saving  = 0;
		}
		if (isset($rtwmer_saving) && isset($rtwmer_commision_type) && isset($rtwmer_price)) {
			$rtwmer_saving = apply_filters("rtwmer_commision_array", $rtwmer_saving, $rtwmer_commision_type, $rtwmer_price);
		}
		if (isset($rtwmer_saving) && isset($rtwmer_commision_type)) {
			$rtwmer_array = array($rtwmer_saving, $rtwmer_commision_type);
		} else {
			$rtwmer_array = array(0, "");
		}
		return $rtwmer_array;
	}

	//=============  function for order handling of multiple vendors     ==========================//
	//=============   function for order handling of multiple vendors    ==========================//

	function rtwmer_order_handler($rtwmer_order_id)
	{
		
		if($this->rtwwwap_comm_gene === true) {
			return;
		}
		else {
			$this->rtwwwap_comm_gene = true;
		}

		if(is_object($rtwmer_order_id)){
			$rtwmer_order_id = $rtwmer_order_id->get_id();
		}
		else{
			$rtwmer_order_id = $rtwmer_order_id;
		}
		
		if ((!empty($rtwmer_order_id))) {
			
			$rtwmer_order = wc_get_order($rtwmer_order_id);
			$parent_order = $rtwmer_order->get_items();
			
			if (!empty($parent_order)) {

				foreach ($parent_order as $rtwmer_item) {
					
					$rtwmer_product_id = $rtwmer_item['product_id'];
					$rtwmer_item_id[] = $rtwmer_item['item_id'];
					$rtwmer_author_array[] = get_post_field('post_author', $rtwmer_product_id);
					$rtwmer_auth = get_post_field('post_author', $rtwmer_product_id);
					$rtwmer_array[$rtwmer_auth][] = $rtwmer_item;
				}
				
			}

					
			if (isset($rtwmer_array)) {
				if (count($rtwmer_array) < 2) {
					$rtwmer_order->update_meta_data('rtwmer_order_vendor', $rtwmer_author_array[0]);
					////////// total excluding tax and shipping //////////////
					// $rtwmer_price = $rtwmer_order->get_total();
					$rtwmer_price = $rtwmer_order->get_total() - $rtwmer_order->get_total_tax() - $rtwmer_order->get_total_shipping();
					////////// total excluding tax and shipping ///////////////
					$rtwmer_commision_val = $this->rtwmer_commission($rtwmer_author_array[0], $rtwmer_price);
					$rtwmer_meta_commision = get_user_meta($rtwmer_author_array[0], 'rtwmer_admin_vendor_commssion', true);
					$rtwmer_meta_value = get_user_meta($rtwmer_author_array[0], 'rtwmer_vendor_admin_commision_value', true);
					$rtwmer_order->update_meta_data('rtwmer_admin_order_commision_for_vendor', $rtwmer_commision_val[0]);
					$rtwmer_order->save();
					do_action('rtwmer_commission_value_created', $rtwmer_order, $rtwmer_commision_val[0], $rtwmer_price);
					do_action('rtwmer_vendor_balance_statement', $rtwmer_order, $rtwmer_author_array[0]);
				} else {
					$rtwmer_order->update_meta_data('rtwmer_sub_order', true);
					$rtwmer_order->save();
					if (!empty($rtwmer_array)) {
						foreach ($rtwmer_array as $seller_id => $seller_products) {
							$this->rtwmer_order_distribution($rtwmer_order, $seller_id, $seller_products, $this);
						}
					}
				}
			}
		}
	}
	

	

	//=============  function for order distribution according to vendor    ==========================//
	//=============  function for order distribution according to vendor  ==========================//

	function rtwmer_order_distribution($rtwmer_parent_order, $rtwmer_seller_id, $rtwmer_seller_products, $class)
	{
		include RTWMER_PUBLIC_ORDER_DISTRIBUTION . "rtwmer_order_distribution.php";
	}


	//=============  function for order line item distribution according to vendor    ==========================//
	//=============   function for order line item distribution according to vendor   ==========================//

	function rtwmer_add_line_items($rtwmer_order_obj, $rtwmer_products)
	{
		include RTWMER_PUBLIC_ORDER_DISTRIBUTION . "rtwmer_add_line_items.php";
	}


	//=============  function for order shipping distribution according to vendor    ==========================//
	//=============  function for order shipping distribution according to vendor   ==========================//

	function rtwmer_add_shipping($rtwmer_order_obj, $rtwmer_parent_order,  $rtwmer_seller_id)
	{
		include RTWMER_PUBLIC_ORDER_DISTRIBUTION . "rtwmer_add_split_order_shipping.php";
	}


	//=============  function for order taxes distribution according to vendor     ==========================//
	//=============  function for order taxes distribution according to vendor    ==========================//

	function rtwmer_add_taxes($rtwmer_order_obj, $rtwmer_parent_order, $rtwmer_products)
	{
		include RTWMER_PUBLIC_ORDER_DISTRIBUTION . "rtwmer_add_split_taxes.php";
	}


	//=============  function for order coupons distribution according to vendor     ==========================//
	//=============  function for order coupons distribution according to vendor    ==========================//

	function rtwmer_add_coupons($rtwmer_order_obj, $rtwmer_parent_order, $rtwmer_products)
	{
		include RTWMER_PUBLIC_ORDER_DISTRIBUTION . "rtwmer_add_coupons.php";
	}

	//=============  function for restore products ajax     ==========================//
	//=============   function for restore products ajax    ==========================//


	function restore_prod_ajax_cb()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {

			if (isset($_POST) && !empty($_POST)) {
				if (isset($_POST['rtwmer_data_ID']) && !empty($_POST['rtwmer_data_ID'])) {
					$this->rtwmer_count_function();

					$rtwmer_product_ID = sanitize_text_field(intval($_POST['rtwmer_data_ID']));

					$rtwmer_status  =  wp_untrash_post($rtwmer_product_ID);

					if (!empty($rtwmer_status)) {

						echo json_encode("restore successfully");
					}
				}
			}
		}
		wp_die();
	}


	//=============  function for delete product from product table     ==========================//
	//=============   function for delete product from product table    ==========================//


	function rtwmer_trash_delete_product()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			if (isset($_POST) && !empty($_POST)) {
				if (isset($_POST['rtwmer_data_ID']) && !empty($_POST['rtwmer_data_ID'])) {
					$rtwmer_product_ID = sanitize_text_field($_POST['rtwmer_prod_ID']);
					$rtwmer_status = wp_delete_post(intval($rtwmer_product_ID));
					if ($rtwmer_status != 0) {
						echo json_encode("deleted successfully");
					}
				}
			}
		}
		wp_die();
	}

	//=============  function for order table     ==========================//
	//=============   function for order table    ==========================//

	function rtwmer_order_all_datatable()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			include_once RTWMER_PUBLIC_PARTIAL . "rtwmer_vendor_order_table.php";
		}
		wp_die();
	}




	//=============  function for withdraw table      ==========================//
	//=============   function for withdraw table     ==========================//


	function rtwmer_withdraw_all_table_cb()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			global $wpdb;
			$rtwmer_table = $wpdb->prefix . 'rtwmer_withdraw';
			$rtwmer_primaryKey = 'id';
			if (isset($_POST['cond'])) {
				$rtwmer_whithdraw_table_cond = sanitize_text_field($_POST['cond']);
			}

			$columns = array(
				array('db' => 'amount', 'dt' => 0, 'field' => 'amount'),
				array('db' => 'method', 'dt' => 1, 'field' => 'method'),
				array('db' => 'date',   'dt' => 2, 'field' => 'date'),
				array('db' => 'id',   'dt' => 3, 'field' => 'id'),
				array('db' => 'status',   'dt' => 4, 'field' => 'status'),
			);

			$sql_details = array(
				'user' => DB_USER,
				'pass' => DB_PASSWORD,
				'db'   => DB_NAME,
				'host' => DB_HOST
			);
			global $rtwmer_user_id_for_dashboard;
			$where = "`user_id`=" . $rtwmer_user_id_for_dashboard;
			if (isset($rtwmer_whithdraw_table_cond)) {
				if ($rtwmer_whithdraw_table_cond == "request") {
					$equals2 = "`status`='pending'";
					$where .= ' AND ' . $equals2;
				} elseif ($rtwmer_whithdraw_table_cond == "approved") {
					$equals2 = "`status`='approved'";
					$where .= ' AND ' . $equals2;
				} elseif ($rtwmer_whithdraw_table_cond == "cancelled") {
					$equals2 = "`status`='cancelled'";
					$where .= ' AND ' . $equals2;
				}
			}

			include_once(RTWMER_ADMIN_PARTIAL . '/ssp/ssp.customized.class.php');

			if (!empty($rtwmer_whithdraw_table_cond)) {

				$rtwmer_withdraw_all_ssp   =	SSP::simple($_POST, $sql_details, $rtwmer_table, $rtwmer_primaryKey, $columns, "", $where);

				$i = 0;

				if (!empty($rtwmer_withdraw_all_ssp['data'])) {

					foreach ($rtwmer_withdraw_all_ssp['data'] as $rtwmer_withdraw_data) {

						if ($this->rtwmer_user_can_access("rtwmer_withdraw_manage_cap")) {
							$rtwmer_remove = "<div class='rtwmer_tooltip rtwmer_withdraw_cancel_button' data-id='" . $rtwmer_withdraw_data[3] . "'><span class='material-icons rtwmer_rem_withdraw'>
						clear</span><span class='rtwmer_tooltiptext rtwmer_withdraw_rem'>" . esc_html__('Remove', 'rtwmer-mercado') . "</span></div>";
						} else {
							$rtwmer_remove = "";
						}
						$amount = wc_price($rtwmer_withdraw_data[0]);
						if ($rtwmer_whithdraw_table_cond == "approved") {
							$rtwrre_method_text = "<a href='#method' class='rtwmer-method-details' data-id='" . $rtwmer_withdraw_data[3] . "'>" . apply_filters('wpml_translate_single_string', $rtwmer_withdraw_data[1], 'rtwmer_payment_method context', 'rtwmer-mercado') . "</a>";
						} else {
							$rtwrre_method_text = apply_filters('wpml_translate_single_string', $rtwmer_withdraw_data[1], 'rtwmer_payment_method context', 'rtwmer-mercado');
						}
						$rtwmer_withdraw_all_ssp['data'][$i][1] = $rtwrre_method_text;
						$rtwmer_withdraw_all_ssp['data'][$i][2] = date("d-m-Y", strtotime($rtwmer_withdraw_data[2]));
						$rtwmer_withdraw_all_ssp['data'][$i][3] = $rtwmer_remove;

						$rtwmer_withdraw_all_ssp['data'][$i][4] =	"<span class='rtwmer_withdraw_" . $rtwmer_withdraw_data[4] . "'>" . $rtwmer_withdraw_data[4] . "</span>";

						$rtwmer_withdraw_all_ssp['data'][$i][0] = $amount;
						$i++;
					}
				}

				echo json_encode($rtwmer_withdraw_all_ssp);
			}
		}
		wp_die();
	}

	//=============  function for withdraw requests      ==========================//
	//=============   function for withdraw requests     ==========================//


	function withdraw_request_ajax_cb()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			
			if (isset($_POST) && !empty($_POST)) {

				if (isset($_POST['rtwmer_payment_meth']) && !empty($_POST['rtwmer_payment_meth'])) {

					$rtwmer_payment_meth = sanitize_text_field($_POST['rtwmer_payment_meth']);
					do_action('wpml_register_single_string', 'rtwmer_payment_method context', 'rtwmer-mercado', $rtwmer_payment_meth);
				}

				if (isset($_POST['rtwmer_amount_req']) && !empty($_POST['rtwmer_amount_req'])) {
					$rtwmer_amount_req = sanitize_text_field($_POST['rtwmer_amount_req']);
				}
				if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
					//check ip from share internet
					$rtwmer_ip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					//to check ip is pass from proxy
					$rtwmer_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
					$rtwmer_ip = $_SERVER['REMOTE_ADDR'];
				}
				global $rtwmer_user_id_for_dashboard;

				$rtwmer_store_name =	get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_store_name', true);

				$rtwmer_email =	get_userdata($rtwmer_user_id_for_dashboard)->data->user_email;

				global $wpdb;
				global $rtwmer_user_id_for_dashboard;
				$rtwmer_query = "SELECT amount FROM " . $wpdb->prefix . "rtwmer_withdraw WHERE user_id=%d  AND status=%s ";

				$rtwmer_order_complete_count = $wpdb->get_results($wpdb->prepare($rtwmer_query, $rtwmer_user_id_for_dashboard, 'pending'));

				$rtwmer_total = 0;
				foreach ($rtwmer_order_complete_count as $rtwmer_amount_obj) {
					$rtwmer_amount  =  $rtwmer_amount_obj->amount;
					$rtwmer_total = $rtwmer_amount + $rtwmer_total;
				}
				$rtwmer_vendor_amount =  floatval(get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_total_amount', true));

				if ($rtwmer_total + $rtwmer_amount_req > $rtwmer_vendor_amount) {

					echo json_encode(esc_html__("Balance not available", "rtwmer-mercado"));
					wp_die();
				}

				if (isset($rtwmer_store_name)) {

					$query = "INSERT INTO `" . $wpdb->prefix . "rtwmer_withdraw` (user_id, rtwmer_vendor_store , amount , status , method , rtwmer_vendor_email , note, ip)
					VALUES ( %d , %s , %f , %s ,%s , %s, %s , %s) ";

					$rtwmer_order_complete_count = $wpdb->get_results($wpdb->prepare($query, $rtwmer_user_id_for_dashboard, $rtwmer_store_name, $rtwmer_amount_req,"pending", $rtwmer_payment_meth,  $rtwmer_email, " ", $rtwmer_ip));

					$rtwmer_last_withdraw_effected_id = $wpdb->insert_id;

					if (isset($rtwmer_last_withdraw_effected_id)) {
						do_action('rtwmer_vend_stmt_for_withdraw_creation', $rtwmer_last_withdraw_effected_id, $rtwmer_user_id_for_dashboard, $rtwmer_amount_req);
					}else{
					}
					echo json_encode("successfull");
				}

				wp_die();
			}
		}
		wp_die();
	}

	//=============  function for withdraw request cancellation      ==========================//
	//=============   function for withdraw request cancellation     ==========================//

	function   withdraw_request_cancel_ajax_cb()
	{

		if (isset($_POST) && !empty($_POST)) {

			global $wpdb;

			if (isset($_POST['rtwmer_cancel_id']) && !empty($_POST['rtwmer_cancel_id'])) {

				$rtwmer_cancel_id = apply_filters("rtwmer_withdraw_cancel_request", sanitize_text_field($_POST['rtwmer_cancel_id']));
				$query = "SELECT * FROM " . $wpdb->prefix . "rtwmer_withdraw WHERE id=%d";
				$rtwmer_withdraw_sql = $wpdb->get_results($wpdb->prepare($query, $rtwmer_cancel_id));
			}

			if ($rtwmer_withdraw_sql[0]->status == "pending") {

				$query = "DELETE FROM " . $wpdb->prefix . "rtwmer_withdraw  WHERE id=%d";
				$rtwmer_withdraw_sql = $wpdb->get_results($wpdb->prepare($query, $rtwmer_cancel_id));
			} elseif ($rtwmer_withdraw_sql[0]->status == "approved") {

				$query = "UPDATE " . $wpdb->prefix . "rtwmer_withdraw SET status=%s WHERE id=%d;";

				$rtwmer_withdraw_sql = $wpdb->get_results($wpdb->prepare($query, "vendor_ad", $rtwmer_cancel_id));
			}

			echo json_encode(esc_html__("request deleted successfully", "rtwmer-mercado"));

			wp_die();
		}
	}

	//=============  function for withdraw method details      ==========================//
	//=============  function for withdraw method details     ==========================//

	function rtwrre_withdraw_method_detail_ajax_cb()
	{

		if (isset($_POST) && !empty($_POST) && isset($_POST['rtwmer_withdraw_id']) && !empty($_POST['rtwmer_withdraw_id'])) {

			global $wpdb;

			$query = "SELECT `payment_processed_stmt` FROM " . $wpdb->prefix . "rtwmer_withdraw  WHERE id=%d";
			$rtwmer_withdraw_sql = $wpdb->get_results($wpdb->prepare($query, sanitize_text_field($_POST['rtwmer_withdraw_id'])), ARRAY_A);

			$rtwmer_html = "<div class='rtwmer_method_detail_box'>";
			if (!empty($rtwmer_withdraw_sql)) {
				foreach ($rtwmer_withdraw_sql as $key => $rtwmer_value) {
					$rtwmer_array = json_decode($rtwmer_value['payment_processed_stmt']);
					if (!empty($rtwmer_array)) {
						foreach ($rtwmer_array as $rtwmer_key => $rtwmer_value) {
							$rtwmer_heading = explode("_", $rtwmer_key);
							unset($rtwmer_heading[0]);
							$rtwmer_heading_complete = implode(" ", $rtwmer_heading);
							$rtwmer_html .= "<div class='rtwmer_detail_line'><label>" . $rtwmer_heading_complete . "</label>" . $rtwmer_value . "</div>";
						}
					} else {
						$rtwmer_html .= esc_html__("No details Found", "rtwmer-mercado");
					}
				}
			} else {
				$rtwmer_html .= esc_html__("No details Found", "rtwmer-mercado");
			}
		}else{
			$rtwmer_html .= esc_html__("No details Found","rtwmer-mercado");
		}
		$rtwmer_html .= "</div>";

		echo json_encode($rtwmer_html);

		wp_die();
	}

	//=============  function for order details request      ==========================//
	//=============   function for order details request     ==========================//

	function  order_full_details_cb()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			if (isset($_POST) && !empty($_POST)) {

				if (isset($_POST['rtwmer_order_id']) && !empty($_POST['rtwmer_order_id'])) {
					$order_id = sanitize_text_field($_POST['rtwmer_order_id']);

					$order = new WC_Order(intval($order_id));

					$order_data = $order->get_items();
					if (!empty($order_data)) {
						foreach ($order_data as $item_id => $item) {

							$product_id = $item->get_product_id();
							$product = wc_get_product($product_id);

							$product_name[] = $item['name'];
							$product_quantity[] = $item['quantity'];


							if (is_object($product)) {
								$product_sku = $product->get_sku();
							} else {
								$product_sku =  "";
							}

							$product_thumb[] = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'thumbnail', TRUE)[0];
							$product_total[] = wc_format_decimal($order->get_line_subtotal($item, false, false));
						}
					}
					global $rtwmer_user_id_for_dashboard;
					$rtwmer_subtotal = $order->get_subtotal();
					$rtwmer_payment_method = $order->get_payment_method_title();
					$rtwmer_total = wc_price($order->get_total());
					$rtwmer_billing_details = $order->get_formatted_billing_address();
					$rtwmer_shipping_details = $order->get_formatted_shipping_address();
					$rtwmer_order_status = $order->get_status();
					$rtwmer_order_date = date("d-m-Y", strtotime($order->get_date_created()));
					$rtwmer_author_id = $rtwmer_user_id_for_dashboard;
					$rtwmer_commision_val = $order->get_shipping_total();

					$rtwmer_past_commision = get_post_meta($order_id, "rtwmer_admin_order_commision_for_vendor", true);

					$rtwmer_Earning_From_Order	=	$order->get_total() - (float) $rtwmer_past_commision;

					$rtwmer_customer = $order->get_shipping_first_name() . $order->get_shipping_last_name();
					$rtwmer_email = $order->get_billing_email();
					$rtwmer_phone  =  $order->get_billing_phone();
					$rtwmer_IP = $order->get_customer_ip_address();
					$rtwmer_customer_note = $order->get_customer_note();

					$rtwmer_response = array($product_name, $product_quantity, $product_thumb, $product_total, $product_sku, $rtwmer_subtotal, $rtwmer_commision_val, $rtwmer_payment_method, $rtwmer_total, $rtwmer_billing_details, $rtwmer_shipping_details, $rtwmer_order_status, $rtwmer_order_date, $rtwmer_Earning_From_Order, $rtwmer_customer, $rtwmer_email, $rtwmer_phone, $rtwmer_IP, $rtwmer_customer_note);
					
					$rtwmer_response = (object)array(
						"rtwmer_response" => $rtwmer_response,
					);

					$response_data = apply_filters("rtwmer_vendor_order_details", $rtwmer_response,$order_id,$order);
					if (empty($response_data)) {
						echo json_encode(false);
						wp_die();
					}

					echo json_encode($response_data);
				}

				wp_die();
			}
		}
		wp_die();
	}

	//=============  function for order status change on vendor panel      ==========================//
	//=============   function for order status change on vendor panel     ==========================//


	function status_change_ajax_cb()
	{	
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {

			$error = "asdf";

			if (isset($_POST) && !empty($_POST)) {
				
				if (isset($_POST['rtwmer_order_id']) && !empty($_POST['rtwmer_order_id'])) {
					// $_POST['rtwmer_order_id'] holds array
					$order_id = $_POST['rtwmer_order_id'];	
				}
				

				if (isset($_POST['rtwmer_order_cond']) && !empty($_POST['rtwmer_order_cond'])) {

					$cond = sanitize_text_field($_POST['rtwmer_order_cond']);
				}

				if ($cond == "complete") {

					$rtwmer_status = "wc-completed";
				} elseif ($cond == "processing") {

					$rtwmer_status = "wc-processing";
				} elseif ($cond == "bulk") {

					$rtwmer_status = sanitize_text_field($_POST['status']);
				
					if (!empty($order_id)) {

						foreach ($order_id as $id) {
							$order  =  wc_get_order($id);
							$error  =  $order->update_status($rtwmer_status);
						}
					}

						
					if ($error != 0) {
						$this->rtwmer_count_function();
						echo json_encode(array("status" =>"success"));
					} else {
						echo json_encode("unsuccessfull");
					}

					wp_die();
				}
			}

			$order  =  wc_get_order($order_id);
			$error =  $order->update_status($rtwmer_status);

			$this->rtwmer_count_function();

			if ($error != 0) {
				echo json_encode("success");
			} else {
				echo json_encode("unsuccessfull");
			}
		}
		wp_die();
	}

	//=============  function for adding amount to vendor      ==========================//
	//=============   function for adding amount to vendor     ==========================//

	function rtwmer_balance_add($rtwmer_order)
	{
		$rtwmer_price = get_post_meta($rtwmer_order, '_order_total', true);

		$rtwmer_author_id = get_post_field('post_author', $rtwmer_order);

		$rtwmer_commision_val = $this->rtwmer_commission($rtwmer_author_id, $rtwmer_price);

		$rtwmer_saving	=	$rtwmer_price - $rtwmer_commision_val[0];
		$rtwmer_total  =	get_user_meta($rtwmer_author_id, 'rtwmer_total_amount', true);
		if (!empty($rtwmer_total)) {
			update_user_meta($rtwmer_author_id, 'rtwmer_total_amount', $rtwmer_saving + $rtwmer_total);
		} else {
			update_user_meta($rtwmer_author_id, 'rtwmer_total_amount', $rtwmer_saving);
		}
	}


	//=============  function for substracting amount from vendor      ==========================//
	//=============   function for substracting amount from vendor     ==========================//

	function rtwmer_balance_substract($rtwmer_order)
	{
		$rtwmer_price = get_post_meta($rtwmer_order, '_order_total', true);

		$rtwmer_author_id = get_post_field('post_author', $rtwmer_order);

		$rtwmer_commision_val = $this->rtwmer_commission($rtwmer_author_id, $rtwmer_price);

		$rtwmer_saving	=	(float) $rtwmer_price - (float) $rtwmer_commision_val[0];

		$rtwmer_total  =	get_user_meta($rtwmer_author_id, 'rtwmer_total_amount', true);
		if (intval($rtwmer_total) > intval($rtwmer_saving)) {
			if (!empty($rtwmer_total)) {
				update_user_meta($rtwmer_author_id, 'rtwmer_total_amount', (float) $rtwmer_total - (float) $rtwmer_saving);
			} else {
				update_user_meta($rtwmer_author_id, 'rtwmer_total_amount', (float) $rtwmer_saving);
			}
		}
	}


	//=============  function for store page settings      ==========================//
	//=============   function for store page settings     ==========================//


	function rtwmer_store_setting_callback()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			if (!empty($_POST) && isset($_POST)) {
				global $rtwmer_user_id_for_dashboard;
				$rtwmer_author_ID = $rtwmer_user_id_for_dashboard;

				if (isset($_POST['rtwmer_banner_id'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_store_img', sanitize_text_field($_POST['rtwmer_banner_id']));
				}
				if (isset($_POST['rtwmer_profile_id'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_profile_img', sanitize_text_field($_POST['rtwmer_profile_id']));
				}

				if (isset($_POST['rtwmer_ppp'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_prod_per_page', sanitize_text_field($_POST['rtwmer_ppp']));
				}

				if (isset($_POST['rtwmer_street'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_address1', sanitize_text_field($_POST['rtwmer_street']));
				}

				if (isset($_POST['rtwmer_street2t'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_address2', sanitize_text_field($_POST['rtwmer_street2t']));
				}

				if (isset($_POST['rtwmer_city'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_city', sanitize_text_field($_POST['rtwmer_city']));
				}

				if (isset($_POST['rtwmer_post_zip'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_zip', sanitize_text_field($_POST['rtwmer_post_zip']));
				}

				if (isset($_POST['rtwmer_country'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_country', sanitize_text_field($_POST['rtwmer_country']));
				}

				if (isset($_POST['rtwmer_state'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_state', sanitize_text_field($_POST['rtwmer_state']));
				}

				if (isset($_POST['rtwmer_phone'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_phone', sanitize_text_field($_POST['rtwmer_phone']));
				}

				if (isset($_POST['rtwmer_show_email'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_show_email', sanitize_text_field($_POST['rtwmer_show_email']));
				}

				if (isset($_POST['rtwmer_show_more_tab'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_show_more_tab', sanitize_text_field($_POST['rtwmer_show_more_tab']));
				}

				if (isset($_POST['rtwmer_map_api_key'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_map_api_key', sanitize_text_field($_POST['rtwmer_map_api_key']));
				}

				if (isset($_POST['rtwmer_show_time_widget'])) {
					update_user_meta($rtwmer_author_ID, 'rtwmer_show_time_widget', sanitize_text_field($_POST['rtwmer_show_time_widget']));
				}

				if ($_POST['rtwmer_show_time_widget']) {

					if (!empty($_POST['rtwmer_sunday']) && isset($_POST['rtwmer_sunday'])) {
						$rtwmer_sun = sanitize_text_field($_POST['rtwmer_sunday']);
					} else {
						$rtwmer_sun = 'close';
					}
					if (!empty($_POST['rtwmer_monday']) && isset($_POST['rtwmer_monday'])) {
						$rtwmer_mon = sanitize_text_field($_POST['rtwmer_monday']);
					} else {
						$rtwmer_mon = 'open';
					}
					if (!empty($_POST['rtwmer_tuesday']) && isset($_POST['rtwmer_tuesday'])) {
						$rtwmer_tues = sanitize_text_field($_POST['rtwmer_tuesday']);
					} else {
						$rtwmer_tues = 'open';
					}
					if (!empty($_POST['rtwmer_wednesday']) && isset($_POST['rtwmer_wednesday'])) {
						$rtwmer_weds = sanitize_text_field($_POST['rtwmer_wednesday']);
					} else {
						$rtwmer_weds = 'open';
					}
					if (!empty($_POST['rtwmer_thursday']) && isset($_POST['rtwmer_thursday'])) {
						$rtwmer_thurs = sanitize_text_field($_POST['rtwmer_thursday']);
					} else {
						$rtwmer_thurs = 'open';
					}
					if (!empty($_POST['rtwmer_friday']) && isset($_POST['rtwmer_friday'])) {
						$rtwmer_fri = sanitize_text_field($_POST['rtwmer_friday']);
					} else {
						$rtwmer_fri = 'open';
					}
					if (!empty($_POST['rtwmer_saturday']) && isset($_POST['rtwmer_saturday'])) {
						$rtwmer_sat = sanitize_text_field($_POST['rtwmer_saturday']);
					} else {
						$rtwmer_sat = 'open';
					}
					if (!empty($_POST['rtwmer_store_open_notice']) && isset($_POST['rtwmer_store_open_notice'])) {
						$rtwmer_op_note = sanitize_text_field($_POST['rtwmer_store_open_notice']);
					} else {
						$rtwmer_op_note = 'Store is open';
					}
					if (!empty($_POST['rtwmer_store_close_notice']) && isset($_POST['rtwmer_store_close_notice'])) {
						$rtwmer_close_note = sanitize_text_field($_POST['rtwmer_store_close_notice']);
					} else {
						$rtwmer_close_note = 'Store is close';
					}

					if ($rtwmer_sun == 'open') {
						if (!empty($_POST['rtwmer_sunday_open_time']) && isset($_POST['rtwmer_sunday_open_time'])) {
							$rtwmer_sun_op = sanitize_text_field($_POST['rtwmer_sunday_open_time']);
						} else {
							$rtwmer_sun_op = '';
						}
						if (!empty($_POST['rtwmer_sunday_close_time']) && isset($_POST['rtwmer_sunday_close_time'])) {
							$rtwmer_sun_close = sanitize_text_field($_POST['rtwmer_sunday_close_time']);
						} else {
							$rtwmer_sun_close = '';
						}
					} else {
						$rtwmer_sun_op = '';
						$rtwmer_sun_close = '';
					}
					if ($rtwmer_mon == 'open') {
						if (!empty($_POST['rtwmer_monday_open_time']) && isset($_POST['rtwmer_monday_open_time'])) {
							$rtwmer_mon_op = sanitize_text_field($_POST['rtwmer_monday_open_time']);
						} else {
							$rtwmer_mon_op = '';
						}
						if (!empty($_POST['rtwmer_monday_close_time']) && isset($_POST['rtwmer_monday_close_time'])) {
							$rtwmer_mon_close = sanitize_text_field($_POST['rtwmer_monday_close_time']);
						} else {
							$rtwmer_mon_close = '';
						}
					} else {
						$rtwmer_mon_op = '';
						$rtwmer_mon_close = '';
					}
					if ($rtwmer_tues == 'open') {
						if (!empty($_POST['rtwmer_tuesday_open_time']) && isset($_POST['rtwmer_tuesday_open_time'])) {
							$rtwmer_tues_op = sanitize_text_field($_POST['rtwmer_tuesday_open_time']);
						} else {
							$rtwmer_tues_op = '';
						}
						if (!empty($_POST['rtwmer_tuesday_close_time']) && isset($_POST['rtwmer_tuesday_close_time'])) {
							$rtwmer_tues_close = sanitize_text_field($_POST['rtwmer_tuesday_close_time']);
						} else {
							$rtwmer_tues_close = '';
						}
					} else {
						$rtwmer_tues_op = '';
						$rtwmer_tues_close = '';
					}
					if ($rtwmer_weds == 'open') {
						if (!empty($_POST['rtwmer_wednesday_open_time']) && isset($_POST['rtwmer_wednesday_open_time'])) {
							$rtwmer_weds_op = sanitize_text_field($_POST['rtwmer_wednesday_open_time']);
						} else {
							$rtwmer_weds_op = '';
						}
						if (!empty($_POST['rtwmer_wednesday_close_time']) && isset($_POST['rtwmer_wednesday_close_time'])) {
							$rtwmer_weds_close = sanitize_text_field($_POST['rtwmer_wednesday_close_time']);
						} else {
							$rtwmer_weds_close = '';
						}
					} else {
						$rtwmer_weds_op = '';
						$rtwmer_weds_close = '';
					}
					if ($rtwmer_thurs == 'open') {
						if (!empty($_POST['rtwmer_thursday_open_time']) && isset($_POST['rtwmer_thursday_open_time'])) {
							$rtwmer_thurs_op = sanitize_text_field($_POST['rtwmer_thursday_open_time']);
						} else {
							$rtwmer_thurs_op = '';
						}
						if (!empty($_POST['rtwmer_thursday_close_time']) && isset($_POST['rtwmer_thursday_close_time'])) {
							$rtwmer_thurs_close = sanitize_text_field($_POST['rtwmer_thursday_close_time']);
						} else {
							$rtwmer_thurs_close = '';
						}
					} else {
						$rtwmer_thurs_op = '';
						$rtwmer_thurs_close = '';
					}

					if ($rtwmer_fri == 'open') {
						if (!empty($_POST['rtwmer_friday_open_time']) && isset($_POST['rtwmer_friday_open_time'])) {
							$rtwmer_fri_op = sanitize_text_field($_POST['rtwmer_friday_open_time']);
						} else {
							$rtwmer_fri_op = '';
						}
						if (!empty($_POST['rtwmer_friday_close_time']) && isset($_POST['rtwmer_friday_close_time'])) {
							$rtwmer_fri_close = sanitize_text_field($_POST['rtwmer_friday_close_time']);
						} else {
							$rtwmer_fri_close = '';
						}
					} else {
						$rtwmer_fri_op = '';
						$rtwmer_fri_close = '';
					}
					if ($rtwmer_sat == 'open') {
						if (!empty($_POST['rtwmer_saturday_open_time']) && isset($_POST['rtwmer_saturday_open_time'])) {
							$rtwmer_sat_op = sanitize_text_field($_POST['rtwmer_saturday_open_time']);
						} else {
							$rtwmer_sat_op = "";
						}
						if (!empty($_POST['rtwmer_saturday_close_time']) && isset($_POST['rtwmer_saturday_close_time'])) {
							$rtwmer_sat_close = sanitize_text_field($_POST['rtwmer_saturday_close_time']);
						} else {
							$rtwmer_sat_close = "";
						}
					} else {
						$rtwmer_sat_op = '';
						$rtwmer_sat_close = '';
					}
					$rtwmer_timing_array = array(
						'Sunday' => array(
							'status' => $rtwmer_sun,
							'store_open-time' => $rtwmer_sun_op,
							'store_close_time' => $rtwmer_sun_close,
						),
						'Monday' => array(
							'status' => $rtwmer_mon,
							'store_open-time' => $rtwmer_mon_op,
							'store_close_time' => $rtwmer_mon_close,
						),
						'Tuesday' => array(
							'status' => $rtwmer_tues,
							'store_open-time' => $rtwmer_tues_op,
							'store_close_time' => $rtwmer_tues_close,
						),
						'Wednesday' => array(
							'status' => $rtwmer_weds,
							'store_open-time' => $rtwmer_weds_op,
							'store_close_time' => $rtwmer_weds_close,
						),
						'Thursday' => array(
							'status' => $rtwmer_thurs,
							'store_open-time' => $rtwmer_thurs_op,
							'store_close_time' => $rtwmer_thurs_close,
						),
						'Friday' => array(
							'status' => $rtwmer_fri,
							'store_open-time' => $rtwmer_fri_op,
							'store_close_time' => $rtwmer_fri_close,
						),
						'Saturday' => array(
							'status' => $rtwmer_sat,
							'store_open-time' => $rtwmer_sat_op,
							'store_close_time' => $rtwmer_sat_close,
						),
						'Store_open_notice' => $rtwmer_op_note,
						'Store_close_notice' => $rtwmer_close_note,
					);
					update_user_meta($rtwmer_author_ID, 'rtwmer_store_time_widget',  $rtwmer_timing_array);
				}
				do_action("rtwmer_store_settings_data");

				echo json_encode("successfull");

				wp_die();
			}
		}
	}


	//=============  function for payment page details save      ==========================//
	//=============   function for payment page details save     ==========================//


	function rtwmer_payment_ajax_cb()
	{

		if (!empty($_POST) && isset($_POST)) {
			global $rtwmer_user_id_for_dashboard;
			$rtwmer_author_ID = $rtwmer_user_id_for_dashboard;
			if (isset($_POST['rtwmer_paypal_email'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_paypal_email', sanitize_text_field($_POST['rtwmer_paypal_email']));
			}
			if (isset($_POST['rtwmer_stripe_id'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_stripe_id', sanitize_text_field($_POST['rtwmer_stripe_id']));
			}
			if ( isset($_POST['rtwmer_account_name'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_bank_account_name', sanitize_text_field($_POST['rtwmer_account_name']));
			}
			if (isset($_POST['rtwmer_account_no'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_bank_account_no', sanitize_text_field($_POST['rtwmer_account_no']));
			}
			if (isset($_POST['rtwmer_bank_name'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_bank_name', sanitize_text_field($_POST['rtwmer_bank_name']));
			}
			if (isset($_POST['rtwmer_bank_place'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_bank_address', sanitize_text_field($_POST['rtwmer_bank_place']));
			}
			if (isset($_POST['rtwmer_routing_no'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_routing_number', sanitize_text_field($_POST['rtwmer_routing_no']));
			}
			if (isset($_POST['rtwmer_iban'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_bank_iban', sanitize_text_field($_POST['rtwmer_iban']));
			}
			if ( isset($_POST['rtwmer_irtwmer_swift_codeban'])) {
				update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_bank_swift', sanitize_text_field($_POST['rtwmer_swift_code']));
			}

			if ( isset($_POST['rtwmer_cond'])) {
				if ($_POST['rtwmer_cond'] == "store_setup_request") {
					update_user_meta($rtwmer_author_ID, 'rtwmer_vendor_store_setup', true);
				}
			}

			do_action("rtwmer_payment_method_extra_data");

			echo json_encode("successfull");
			wp_die();
		}
	}

	//=============  function for adding custom template to the page list      ==========================//
	//=============   function for adding custom template to the page list     ==========================//
	/**
	 * Add "Custom" template to page attirbute template section.
	 */

	function rtwmer_add_template_to_select($post_templates, $wp_theme, $post, $post_type)
	{
		$post_templates['rtwmer_vendor_dashboard_template.php'] = esc_html__('Vendor dashboard',"rtwmer-mercado");
		return $post_templates;
	}


	//=============  function for redirection of user to either home page or account page      ==========================//
	//=============   function for redirection of user to either home page or account page     ==========================//


	function rtwmer_redirect_to_Custom()
	{
		global $rtwmer_user_id_for_dashboard;
		$data = get_userdata($rtwmer_user_id_for_dashboard);
		$rtwmer_options = get_option("rtwmer_page_setting");
		if (!empty($rtwmer_options) && is_array($rtwmer_options)) {
			$rtwmer_title = $rtwmer_options['rtwmer_page_setting_dashboard'];
		}
		if (is_object($data)) {
			$current_user_caps = $data->allcaps;
		}
		if (isset($current_user_caps) && array_key_exists("mercador", $current_user_caps)) {
			return get_the_permalink($rtwmer_title);
		}
		return get_permalink(get_option('woocommerce_myaccount_page_id'));
	}


	//=============  function for adding custom field to the register page      ==========================//
	//=============   function for adding custom field to the register page     ==========================//

	function rtwmer_extra_register_fields()
	{ ?>
		<?php update_option('woocommerce_registration_generate_password', 'no'); ?>

		<p class="form-row form-row-first">
			<label for="rtwmer-role">
				<input type="radio" class="input-radio" name="rtwmer-role" id="rtwmer-radio-vendor" value="vendor" />
				<?php esc_html_e('I am a Vendor', 'rtwmer-mercado'); ?>
			</label>
		</p>
		<p class="form-row form-row-last">
			<label for="rtwmer-radio-customer">
				<input type="radio" class="input-radio" name="rtwmer-role" id="rtwmer-radio-customer" value="customer" checked="checked" />
				<?php esc_html_e('I am a Customer', 'rtwmer-mercado'); ?>
			</label>
		</p>
		<div class="rtwmer-vendor-registration rtwmer-none">
			<p class="form-row form-row-wide">
				<label for="rtwmer_reg_first_name">
					<?php esc_html_e('First name', 'rtwmer-mercado'); ?>
					<span class="required">*</span>
				</label>
				<input type="text" class="input-text" name="rtwmer_first_name" id="rtwmer_reg_first_name" value="<?php if (!empty($_POST['rtwmer_first_name'])) esc_attr_e(sanitize_text_field($_POST['rtwmer_first_name'])); ?>" />
			</p>
			<p class="form-row form-row-wide">
				<label for="rtwmer_reg_last_name">
					<?php esc_html_e('Last name', 'rtwmer-mercado'); ?>
					<span class="required">*</span>
				</label>
				<input type="text" class="input-text" name="rtwmer_last_name" id="rtwmer_reg_last_name" value="<?php if (!empty($_POST['rtwmer_last_name'])) esc_attr_e(sanitize_text_field($_POST['rtwmer_last_name'])); ?>" />
			</p>
			<p class="form-row form-row-wide">
				<label for="rtwmer_reg_shop_name">
					<?php esc_html_e('Shop Name', 'rtwmer-mercado'); ?>
				</label>
				<input type="text" class="input-text" name="rtwmer_shop_names" id="rtwmer_reg_shop_name" value="<?php if (!empty($_POST['rtwmer_shop_names'])) esc_attr_e(sanitize_text_field($_POST['rtwmer_shop_names'])); ?>" />
			</p>
			<p class="form-row form-row-wide">
				<label for="rtwmer_reg_shop_url">
					<?php esc_html_e('Shop Url', 'rtwmer-mercado'); ?>
				</label>
				<input type="text" class="input-text" name="rtwmer_shop_url" id="rtwmer_reg_shop_url" value="<?php if (!empty($_POST['rtwmer_shop_url'])) esc_attr_e(sanitize_text_field($_POST['rtwmer_shop_url'])); ?>" />
			</p>
			<p class="form-row form-row-wide">
				<label for="rtwmer_reg_phone">
					<?php esc_html_e('Phone', 'rtwmer-mercado'); ?>
					<span class="required">*</span>
				</label>
				<input type="text" class="input-text" name="rtwmer_phone" id="rtwmer_reg_phone" value="<?php if (!empty($_POST['rtwmer_phone'])) esc_attr_e(sanitize_text_field($_POST['rtwmer_phone'])); ?>" />
			</p>
		</div>
		<div class="clear"></div>
		<?php
	}

	//=============  function for calculating records of every page on vendor dashboard      ==========================//
	//=============   function for calculating records of every page on vendor dashboard     ==========================//

	function  rtwmer_count_function()
	{
		
		global $wpdb;
		global $rtwmer_user_id_for_dashboard;
		$rtwmer_prod_auth_id  = $rtwmer_user_id_for_dashboard;
		if ( OrderUtil::custom_orders_table_usage_is_enabled() ) {
		// if(WC()->version > '8.2.0'){

			$sql_details = array(
				'user' => DB_USER,
				'pass' => DB_PASSWORD,
				'db'   => DB_NAME,
				'host' => DB_HOST
			);

			$conn = new mysqli($sql_details['host'],$sql_details['user'],$sql_details['pass'],$sql_details['db']);

		$where = get_posts_by_author_sql('product');
		$table = $wpdb->prefix."wc_orders_meta";

		$query = "SELECT * FROM $table WHERE meta_key = 'rtwmer_order_vendor' AND meta_value = $rtwmer_prod_auth_id "; 
		$result = $conn->query($query);
		$rtwmer_prod_all_count = $result->num_rows;
			
			// echo '<pre>';
			// print_r($rtwmer_prod_all_count);
			// echo '</pre>';	
			// die('asdfdsf');


		$query = "SELECT COUNT(*) FROM $wpdb->posts $where AND post_author = %d";
		$rtwmer_prod_publish_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id));

		$query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = " . $rtwmer_prod_auth_id . "";
		$rtwmer_prod_trash_count = $wpdb->get_var($wpdb->prepare($query, 'trash'));

		$query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = " . $rtwmer_prod_auth_id . "";
		$rtwmer_prod_pending_count = $wpdb->get_var($wpdb->prepare($query, 'pending'));

		// $query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders LEFT JOIN (SELECT order_id,
		// MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_name
		// FROM " . $wpdb->prefix . "wc_orders_meta GROUP BY order_id) rtw_selected_table ON " . $wpdb->prefix . "wc_orders.`id`= rtw_selected_table.`order_id`  WHERE rtwmer_order_vendor_name IS NOT NULL AND rtwmer_order_vendor_name='%s'";
		// $rtwmer_order_all_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id));

			
		$query = "SELECT * FROM $table WHERE meta_key = 'rtwmer_order_vendor' AND meta_value = $rtwmer_prod_auth_id "; 
		$result = $conn->query($query);
		$rtwmer_order_all_count = $result->num_rows;

		/* order Processing end  */ 

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders o LEFT JOIN " . $wpdb->prefix . "wc_orders_meta rtw_selected_table ON o.id= rtw_selected_table.order_id WHERE rtw_selected_table.meta_value= $rtwmer_prod_auth_id AND o.status='wc-processing' AND rtw_selected_table.meta_key='rtwmer_order_vendor'";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();

		$rtwmer_count_array = array();
		// echo '<pre>';
		// print_r($query);
		// echo '</pre>';
		// die('sdf');
		foreach ($data as $key => $value) {
			$rtwmer_count_array[0] = $value;
		}
		
		// /* order Processing end  */ 

		// /* order pending end  */ 

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders o LEFT JOIN " . $wpdb->prefix . "wc_orders_meta rtw_selected_table ON o.id= rtw_selected_table.order_id WHERE rtw_selected_table.meta_value= $rtwmer_prod_auth_id AND o.status='wc-pending' AND rtw_selected_table.meta_key='rtwmer_order_vendor'";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();
		
		foreach ($data as $key => $value) {
			$rtwmer_count_array[1] = $value;
		}
		
		// /* order pending end  */ 

		// /* order hold end  */ 

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders o LEFT JOIN " . $wpdb->prefix . "wc_orders_meta rtw_selected_table ON o.id= rtw_selected_table.order_id WHERE rtw_selected_table.meta_value= $rtwmer_prod_auth_id AND o.status='wc-on-hold' AND rtw_selected_table.meta_key='rtwmer_order_vendor'";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();
		
		foreach ($data as $key => $value) {
			$rtwmer_count_array[2] = $value;
		}
		
		// /* order hold end  */ 

		// /* order cancelled end  */ 

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders o LEFT JOIN " . $wpdb->prefix . "wc_orders_meta rtw_selected_table ON o.id= rtw_selected_table.order_id WHERE rtw_selected_table.meta_value= $rtwmer_prod_auth_id AND o.status='wc-cancelled' AND rtw_selected_table.meta_key='rtwmer_order_vendor'";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();
		
		foreach ($data as $key => $value) {
			$rtwmer_count_array[3] = $value;
		}
		
		// /* order cancelled end  */ 

		// /* order refunded start  */ 

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders o LEFT JOIN " . $wpdb->prefix . "wc_orders_meta rtw_selected_table ON o.id= rtw_selected_table.order_id WHERE rtw_selected_table.meta_value= $rtwmer_prod_auth_id AND o.status='wc-refunded' ";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();
		
		foreach ($data as $key => $value) {
			$rtwmer_count_array[4] = $value;
		}
		
		// /* order refunded end  */ 

		// /* order failed start  */ 

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders o LEFT JOIN " . $wpdb->prefix . "wc_orders_meta rtw_selected_table ON o.id= rtw_selected_table.order_id WHERE rtw_selected_table.meta_value= $rtwmer_prod_auth_id AND o.status='wc-failed'";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();
		
		foreach ($data as $key => $value) {
			$rtwmer_count_array[5] = $value;
		}
		
		// /* order failed end  */ 

		// /* for order complete */

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "wc_orders o LEFT JOIN " . $wpdb->prefix . "wc_orders_meta rtw_selected_table ON o.id= rtw_selected_table.order_id WHERE rtw_selected_table.meta_value= $rtwmer_prod_auth_id AND o.status='wc-completed' AND rtw_selected_table.meta_key='rtwmer_order_vendor'";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();
		
		foreach ($data as $key => $value) {
			$rtwmer_count_array[6] = $value;
		}
		
		/* order complete end  */	

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "rtwmer_withdraw WHERE user_id=%d AND status=%s";
		$rtwmer_withdraw_pending_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id, 'pending'));

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "rtwmer_withdraw WHERE user_id=%d AND ( status=%s OR status=%s )";
		$rtwmer_withdraw_approved_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id, 'approved', 'admin_ad '));

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "rtwmer_withdraw WHERE user_id=%d AND ( status=%s OR status=%s )";
		$rtwmer_withdraw_cancelled_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id, 'cancelled', 'admin_cd '));

		$rtwmer_prod_count_array = array(
			'rtwmer_prod_auth_id' => $rtwmer_prod_auth_id,
			// 'rtwmer_prod_all_count' => $rtwmer_prod_all_count,
			'rtwmer_prod_all_count' => $rtwmer_prod_publish_count + $rtwmer_prod_pending_count,
			'rtwmer_prod_publish_count' => $rtwmer_prod_publish_count,
			'rtwmer_prod_trash_count' => $rtwmer_prod_trash_count,
			'rtwmer_prod_pending_count' => $rtwmer_prod_pending_count,
		);
		
		$rtwmer_order_count_array = array(
			'rtwmer_prod_auth_id' => $rtwmer_prod_auth_id,
			'rtwmer_order_all_count' => $rtwmer_order_all_count,
			'rtwmer_order_processing_count' => $rtwmer_count_array[0],
			'rtwmer_order_pending_count' => $rtwmer_count_array[1],
			'rtwmer_order_on_hold_count' => $rtwmer_count_array[2],
			'rtwmer_order_cancelled_count' => $rtwmer_count_array[3],
			'rtwmer_order_refunded_count' => $rtwmer_count_array[4],
			'rtwmer_order_failed_count' => $rtwmer_count_array[5],
			'rtwmer_order_complete_count' => $rtwmer_count_array[6],
		);

		$rtwmer_withdraw_count_array = array(
			'rtwmer_withdraw_pending_count' =>  $rtwmer_withdraw_pending_count,
			'rtwmer_withdraw_approved_count' =>  $rtwmer_withdraw_approved_count,
			'rtwmer_withdraw_cancelled_count' => $rtwmer_withdraw_cancelled_count,
		);

		$rtwmer_count_array = array(
			'rtwmer_prod_count_array' => $rtwmer_prod_count_array,
			'rtwmer_order_count_array' => $rtwmer_order_count_array,
			'rtwmer_withdraw_count_array' => $rtwmer_withdraw_count_array,
		);
		// echo '<pre>';
		// print_r($rtwmer_count_array);
		// echo '</pre>';
		// die('asdf');

		$rtwmer_array =  apply_filters("rtwmer_mercado_count", $rtwmer_count_array);

		update_user_meta($rtwmer_prod_auth_id, "rtwmer_counting_array", $rtwmer_array);

		return $rtwmer_array;

		}else{
			/* for older version of woocommerce */
			$where = get_posts_by_author_sql('product');

		$query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = '%s' AND post_author = " . $rtwmer_prod_auth_id . " AND ( post_status = '%s' OR post_status = '%s' OR post_status = '%s' OR post_status = '%s' )";
		$rtwmer_prod_all_count = $wpdb->get_var($wpdb->prepare($query, 'product', 'publish', 'pending', 'draft', 'private'));

		$query = "SELECT COUNT(*) FROM $wpdb->posts $where AND post_author = %d";
		$rtwmer_prod_publish_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id));

		$query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = " . $rtwmer_prod_auth_id . "";
		$rtwmer_prod_trash_count = $wpdb->get_var($wpdb->prepare($query, 'trash'));

		$query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = " . $rtwmer_prod_auth_id . "";
		$rtwmer_prod_pending_count = $wpdb->get_var($wpdb->prepare($query, 'pending'));

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "posts LEFT JOIN (SELECT post_id,
		MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_name
		FROM " . $wpdb->prefix . "postmeta GROUP BY post_id) rtw_selected_table ON " . $wpdb->prefix . "posts.`ID`= rtw_selected_table.`post_id`  WHERE rtwmer_order_vendor_name IS NOT NULL AND rtwmer_order_vendor_name='%s'";
		$rtwmer_order_all_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id));


		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "posts LEFT JOIN (SELECT post_id,
		MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_name
		FROM " . $wpdb->prefix . "postmeta GROUP BY post_id) rtw_selected_table ON " . $wpdb->prefix . "posts.`ID`= rtw_selected_table.`post_id`  
		WHERE rtwmer_order_vendor_name IS NOT NULL AND rtwmer_order_vendor_name='%s' AND post_status='%s'";

		$rtwmer_cond_array = ['wc-processing', 'wc-pending', 'wc-on-hold', 'wc-cancelled', 'wc-refunded', 'wc-failed', 'wc-completed'];
		$rtwmer_count_array = array();
		foreach ($rtwmer_cond_array as $key => $value) {
			$rtwmer_count_array[] = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id, $value));
		}


		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "rtwmer_withdraw WHERE user_id=%d AND status=%s";
		$rtwmer_withdraw_pending_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id, 'pending'));

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "rtwmer_withdraw WHERE user_id=%d AND ( status=%s OR status=%s )";
		$rtwmer_withdraw_approved_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id, 'approved', 'admin_ad '));

		$query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "rtwmer_withdraw WHERE user_id=%d AND ( status=%s OR status=%s )";
		$rtwmer_withdraw_cancelled_count = $wpdb->get_var($wpdb->prepare($query, $rtwmer_prod_auth_id, 'cancelled', 'admin_cd '));

		$rtwmer_prod_count_array = array(
			'rtwmer_prod_auth_id' => $rtwmer_prod_auth_id,
			'rtwmer_prod_all_count' => $rtwmer_prod_all_count,
			'rtwmer_prod_publish_count' => $rtwmer_prod_publish_count,
			'rtwmer_prod_trash_count' => $rtwmer_prod_trash_count,
			'rtwmer_prod_pending_count' => $rtwmer_prod_pending_count,
		);

		$rtwmer_order_count_array = array(
			'rtwmer_prod_auth_id' => $rtwmer_prod_auth_id,
			'rtwmer_order_all_count' => $rtwmer_order_all_count,
			'rtwmer_order_processing_count' => $rtwmer_count_array[0],
			'rtwmer_order_pending_count' => $rtwmer_count_array[1],
			'rtwmer_order_on_hold_count' => $rtwmer_count_array[2],
			'rtwmer_order_cancelled_count' => $rtwmer_count_array[3],
			'rtwmer_order_refunded_count' => $rtwmer_count_array[4],
			'rtwmer_order_failed_count' => $rtwmer_count_array[5],
			'rtwmer_order_complete_count' => $rtwmer_count_array[6],
		);

		$rtwmer_withdraw_count_array = array(
			'rtwmer_withdraw_pending_count' =>  $rtwmer_withdraw_pending_count,
			'rtwmer_withdraw_approved_count' =>  $rtwmer_withdraw_approved_count,
			'rtwmer_withdraw_cancelled_count' => $rtwmer_withdraw_cancelled_count,
		);

		$rtwmer_count_array = array(
			'rtwmer_prod_count_array' => $rtwmer_prod_count_array,
			'rtwmer_order_count_array' => $rtwmer_order_count_array,
			'rtwmer_withdraw_count_array' => $rtwmer_withdraw_count_array,
		);

		$rtwmer_array =  apply_filters("rtwmer_mercado_count", $rtwmer_count_array);

		update_user_meta($rtwmer_prod_auth_id, "rtwmer_counting_array", $rtwmer_array);



		return $rtwmer_array;

		}

		
	}


	//=============  function for getting the data for charts     ==========================//
	//=============  function for getting the data for charts     ==========================//

	function rtwmer_get_data_cb()
	{
		$rtwmer_total_sales = $this->get_sales_data("");
		$rtwmer_dates_array = array();
		$rtwmer_sales_array = array();
		// echo '<pre>';
		// print_r($rtwmer_total_sales);
		// echo '</pre>';
		// die('loll');	
	
		if (!empty($rtwmer_total_sales) && is_array($rtwmer_total_sales)) {

			foreach ($rtwmer_total_sales as $key => $value) {
				$rtwmer_dates_array[] = date('d M y', strtotime($key));
				$rtwmer_sales_array[] = $value;
			}
		}
		$rtwmer_total_sales_array = array(
			"rtwmer_dates" => $rtwmer_dates_array,
			"rtwmer_sales" => $rtwmer_sales_array
		);

		$rtwmer_prod_sales = $this->rtwmer_prod_sales_count();
		$rtwmer_prod_name_array = array();
		$rtwmer_prod_sales_arrray = array();
		$i = 0;
		foreach ($rtwmer_prod_sales as $key => $value) {
			if ($i < 5) {
				$rtwmer_prod_name_array[] = $value["post_title"];
				$rtwmer_prod_sales_arrray[] = $value["total_sales"];
			}
			$i++;
		}

		$rtwmer_prod_name_sales_array = array(
			"rtwmer_prod_title" => $rtwmer_prod_name_array,
			"rtwmer_prod_sales" => $rtwmer_prod_sales_arrray
		);
		$rtwmer_chart_data = array(
			"pie_chart" => $this->rtwmer_count_function(),
			"bar_graph" =>  $rtwmer_total_sales_array,
			"prod_sales_rec" => $rtwmer_prod_name_sales_array
		);

		echo json_encode($rtwmer_chart_data);
		die();
	}


	function rtwmer_prod_sales_count()
	{
		global $wpdb;
		global $rtwmer_user_id_for_dashboard;
		$rtwmer_prod_sales_count_array = array();

		$rtwmer_query = "SELECT post_title,total_sales FROM " . $wpdb->prefix . "posts LEFT JOIN (SELECT post_id,MAX(CASE WHEN meta_key = 'total_sales' THEN meta_value END) total_sales FROM " . $wpdb->prefix . "postmeta GROUP BY post_id) rtw_selected_table ON " . $wpdb->prefix . "posts.`ID`= rtw_selected_table.`post_id` WHERE post_type=%s AND post_author=%s AND post_status=%s ORDER BY 
		total_sales DESC";

		$rtwmer_prod_sales_count_array = $wpdb->get_results($wpdb->prepare($rtwmer_query, 'product', $rtwmer_user_id_for_dashboard, 'publish'), ARRAY_A);



		return $rtwmer_prod_sales_count_array;
	}

	//=============  function for sales and order data     ==========================//
	//=============   function for sales and order data     ==========================//


	function rtwmer_order_and_sales($rtwmer_date)
	{

		global $wpdb;
		global $rtwmer_user_id_for_dashboard;
		$date = date_create($rtwmer_date);
		if (empty($rtwmer_date)) {
			$rtwmer_current = Date('y-m-d h:i:s');
			$rtwmer_current_date = Date('y M d');
			$rtwmer_1st = Date('y-m-d h:i:s', strtotime("-27 days"));
			$rtwmer_1st_date = Date('y M d', strtotime("-27 days"));
			$rtwmer_2nd = Date('y-m-d h:i:s', strtotime("-24 days"));
			$rtwmer_2nd_date = Date('y M d', strtotime("-24 days"));
			$rtwmer_3rd = Date('y-m-d h:i:s', strtotime("-21 days"));
			$rtwmer_3rd_date = Date('y M d', strtotime("-21 days"));
			$rtwmer_4th = Date('y-m-d h:i:s', strtotime("-18 days"));
			$rtwmer_4th_date = Date('y M d', strtotime("-18 days"));
			$rtwmer_5th = Date('y-m-d h:i:s', strtotime("-15 days"));
			$rtwmer_5th_date = Date('y M d', strtotime("-15 days"));
			$rtwmer_6th = Date('y-m-d h:i:s', strtotime("-12 days"));
			$rtwmer_6th_date = Date('y M d', strtotime("-12 days"));
			$rtwmer_7th = Date('y-m-d h:i:s', strtotime("-9 days"));
			$rtwmer_7th_date = Date('y M d', strtotime("-9 days"));
			$rtwmer_8th = Date('y-m-d h:i:s', strtotime("-6 days"));
			$rtwmer_8th_date = Date('y M d', strtotime("-6 days"));
			$rtwmer_9th = Date('y-m-d h:i:s', strtotime("-3 days"));
			$rtwmer_9th_date = Date('y M d', strtotime("-3 days"));
		} else {
			$temp_date = $date;
			$rtwmer_current = date_format($temp_date, 'y-m-d h:i:s');
			$rtwmer_current_date = date_format($temp_date, 'y M d');

			$temp_date9 = $date;
			date_add($temp_date9, date_interval_create_from_date_string("-3 days"));
			$rtwmer_9th = date_format($temp_date9, 'y-m-d h:i:s');
			$rtwmer_9th_date = date_format($temp_date9, 'y M d');

			$temp_date8 = $date;
			date_add($temp_date8, date_interval_create_from_date_string("-3 days"));
			$rtwmer_8th = date_format($temp_date8, 'y-m-d h:i:s');
			$rtwmer_8th_date = date_format($temp_date8, 'y M d');

			$temp_date7 = $date;
			date_add($temp_date7, date_interval_create_from_date_string("-3 days"));
			$rtwmer_7th = date_format($temp_date7, 'y-m-d h:i:s');
			$rtwmer_7th_date = date_format($temp_date7, 'y M d');

			$temp_date6 = $date;
			date_add($temp_date6, date_interval_create_from_date_string("-3 days"));
			$rtwmer_6th = date_format($temp_date6, 'y-m-d h:i:s');
			$rtwmer_6th_date = date_format($temp_date6, 'y M d');

			$temp_date5 = $date;
			date_add($temp_date5, date_interval_create_from_date_string("-3 days"));
			$rtwmer_5th = date_format($temp_date5, 'y-m-d h:i:s');
			$rtwmer_5th_date = date_format($temp_date5, 'y M d');

			$temp_date4 = $date;
			date_add($temp_date4, date_interval_create_from_date_string("-3 days"));
			$rtwmer_4th = date_format($temp_date4, 'y-m-d h:i:s');
			$rtwmer_4th_date = date_format($temp_date4, 'y M d');

			$temp_date3 = $date;
			date_add($temp_date3, date_interval_create_from_date_string("-3 days"));
			$rtwmer_3rd = date_format($temp_date3, 'y-m-d h:i:s');
			$rtwmer_3rd_date = date_format($temp_date3, 'y M d');

			$temp_date2 = $date;
			date_add($temp_date2, date_interval_create_from_date_string("-3 days"));
			$rtwmer_2nd = date_format($temp_date2, 'y-m-d h:i:s');
			$rtwmer_2nd_date = date_format($temp_date2, 'y M d');

			$temp_date1 = $date;
			date_add($temp_date1, date_interval_create_from_date_string("-3 days"));
			$rtwmer_1st = date_format($temp_date1, 'y-m-d h:i:s');
			$rtwmer_1st_date = date_format($temp_date1, 'y M d');
		}
		$rtwmer_query = "SELECT * FROM " . $wpdb->prefix . "posts LEFT JOIN (SELECT post_id,
		MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_name
		FROM " . $wpdb->prefix . "postmeta GROUP BY post_id) rtw_selected_table ON " . $wpdb->prefix . "posts.`ID`= rtw_selected_table.`post_id` JOIN " . $wpdb->prefix . "wc_order_stats ON " . $wpdb->prefix . "posts.ID = " . $wpdb->prefix . "wc_order_stats.order_id WHERE   rtwmer_order_vendor_name IS NOT NULL AND rtwmer_order_vendor_name='%s' AND ( post_status='%s' OR post_status='%s') AND post_modified<%s GROUP BY CAST(post_date as DATE)";


		$rtwmer_date_time = array(
			[$rtwmer_1st, $rtwmer_1st_date],
			[$rtwmer_2nd, $rtwmer_2nd_date],
			[$rtwmer_3rd, $rtwmer_3rd_date],
			[$rtwmer_4th, $rtwmer_4th_date],
			[$rtwmer_5th, $rtwmer_5th_date],
			[$rtwmer_6th, $rtwmer_6th_date],
			[$rtwmer_7th, $rtwmer_7th_date],
			[$rtwmer_8th, $rtwmer_8th_date],
			[$rtwmer_9th, $rtwmer_9th_date],
			[$rtwmer_current, $rtwmer_current_date]
		);
		$rtwmer_total_sales = array();
		foreach ($rtwmer_date_time as $key => $date) {

			$rtwmer_sales_array = $wpdb->get_results($wpdb->prepare($rtwmer_query, $rtwmer_user_id_for_dashboard, 'wc-completed', 'wc-refunded', $date[0]));
			$rtwmer_total_sales[]  =   $this->rtwmer_sales_count($rtwmer_sales_array, $date[1]);

		}

		return $rtwmer_total_sales;
	}

	/**
	 * function for retrieving the array of sales according to date
	 */

	function get_sales_data($rtwmer_date)
	{

		global $wpdb;
		global $rtwmer_user_id_for_dashboard;
		if (empty($rtwmer_date)) {
			$rtwmer_date = date("y-m-d", strtotime('tomorrow'));
		}
		if ( OrderUtil::custom_orders_table_usage_is_enabled() ) {
		// if(WC()->version > '8.2.0'){

		$rtwmer_query = "SELECT DATE(date_created_gmt) as post_date,SUM(total_amount) AS order_total FROM " . $wpdb->prefix . "wc_orders LEFT JOIN (SELECT order_id,MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor,MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) _order_total FROM " . $wpdb->prefix . "wc_orders_meta GROUP BY order_id) rtw_selected_table ON " . $wpdb->prefix . "wc_orders.id= rtw_selected_table.order_id WHERE rtwmer_order_vendor IS NOT NULL AND type=%s AND rtwmer_order_vendor=%s AND status=%s AND (date_created_gmt<%s AND date_created_gmt>%s) GROUP BY DATE(post_date)";
		}else{
			$rtwmer_query = "SELECT DATE(post_date) as post_date,SUM(_order_total) AS order_total FROM " . $wpdb->prefix . "posts LEFT JOIN (SELECT post_id,MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor,MAX(CASE WHEN meta_key = '_order_total' THEN meta_value END) _order_total FROM " . $wpdb->prefix . "postmeta GROUP BY post_id) rtw_selected_table ON " . $wpdb->prefix . "posts.`ID`= rtw_selected_table.`post_id` WHERE rtwmer_order_vendor IS NOT NULL AND post_type=%s AND rtwmer_order_vendor=%s AND post_status=%s AND (post_date<%s AND post_date>%s) GROUP BY DATE(post_date)";

		}
		$rtwmer_date = date_create($rtwmer_date);
		$rtwmer_date_time = date_format($rtwmer_date, 'y-m-d');
		$rtwmer_current_date = date_format($rtwmer_date, 'y-m-d');
		$rtwmer_today_date = date("y-m-d");
		$rtwmer_before_date_time = date('y-m-d', strtotime('-30 days', strtotime($rtwmer_date_time)));
		$rtwmer_before_date = date('Y-m-d', strtotime('-30 days', strtotime($rtwmer_date_time)));
		$rtwmer_sales_array = $wpdb->get_results($wpdb->prepare($rtwmer_query, 'shop_order', $rtwmer_user_id_for_dashboard, 'wc-completed', $rtwmer_date_time, $rtwmer_before_date_time), ARRAY_A);
		

		$rtwrre_sale_temp_array = array();
		if (!empty($rtwmer_sales_array) && is_array($rtwmer_sales_array)) {
			foreach ($rtwmer_sales_array as $key => $value) {
				if (isset($value["post_date"]) && isset($value["order_total"])) {
					$rtwrre_sale_temp_array[$value["post_date"]] = floatval($value["order_total"]);
				}
			}
		}
	

		$date_array = $this->getDatesFromRange($rtwmer_before_date, $rtwmer_today_date);
		$rtwmer_date_array = array();
		foreach ($date_array as $key => $value) {
			if (array_key_exists($value, $rtwrre_sale_temp_array)) {
				$rtwmer_date_array[$value] = $rtwrre_sale_temp_array[$value];
			} else {
				$rtwmer_date_array[$value] = 0;
			}
		}


		return $rtwmer_date_array;
	}

	/**
	 * function for retrieving the array of dates
	 */

	function getDatesFromRange($rtwmer_start_date, $rtwmer_end_date, $rtwmer_format_date = 'Y-m-d')
	{

		$rtwmer_array = array();

		$rtwmer_interval = new DateInterval('P1D');

		$rtwmer_realend = new DateTime($rtwmer_end_date);
		$rtwmer_realend->add($rtwmer_interval);

		$rtwmer_period = new DatePeriod(new DateTime($rtwmer_start_date), $rtwmer_interval, $rtwmer_realend);

		foreach ($rtwmer_period as $date) {
			$rtwmer_array[] = $date->format($rtwmer_format_date);
		}

		return $rtwmer_array;
	}


	//=============  function for sales total      ==========================//
	//=============   function for sales total     ==========================//


	function rtwmer_sales_count($rtwmer_array_order, $rtwmer_day)
	{
		global $rtwmer_user_id_for_dashboard;
		if (!empty($rtwmer_array_order)) {
			$rtwmer_total_sales = 0;
			$rtwmer_order_count = 0;
			foreach ($rtwmer_array_order as $key => $rtwmer_value) {
				$rtwmer_total_sales = $rtwmer_value->net_total + (float) $rtwmer_total_sales;
				$rtwmer_order_count++;
			}

			$rtwmer_price = $rtwmer_total_sales;

			$rtwmer_author_id = $rtwmer_user_id_for_dashboard;

			$rtwmer_commision_val = $this->rtwmer_commission($rtwmer_author_id, $rtwmer_price);

			$rtwmer_saving	=	$rtwmer_price - $rtwmer_commision_val[0];
			$rtwmer_total_sales = array($rtwmer_total_sales, $rtwmer_saving, $rtwmer_order_count, $rtwmer_day);
		} else {
			$rtwmer_total_sales = array(0, 0, 0, $rtwmer_day);
		}
		return  $rtwmer_total_sales;
	}



	//=============  function for calling the view count function      ==========================//
	//=============   function for calling the view count function     ==========================//

	function rtwmer_update_count_cb()
	{
		global $rtwmer_user_id_for_dashboard;
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			$rtwmer_count_array_all = $this->rtwmer_count_function();

			if (isset($_POST['rtwmer_cond']) && $_POST['rtwmer_cond'] == "rtwmer_order_page") {

				$rtwmer_total_balance  =	get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_total_amount', true);
				$rtwmer_total_balance  = (!empty($rtwmer_total_balance)) ? $rtwmer_total_balance : 0;
				$rtwmer_count_array_all['rtwmer_vendor_bal'] =  $rtwmer_total_balance;
			}

			echo json_encode($rtwmer_count_array_all, true);
		}
		wp_die();
	}



	//=============  function for validating extra fields      ==========================//
	//=============   function for validating extra fields     ==========================//

	function rtwmer_validate_extra_register_fields($username, $email, $rtwmer_validation_errors)
	{
	
		if (isset($_POST['rtwmer-role']) && $_POST['rtwmer-role'] == "vendor" && get_role("rtwmer-vendor") != "null") {
			if (isset($_POST['rtwmer_first_name']) && empty($_POST['rtwmer_first_name'])) {
				$rtwmer_validation_errors->add('first_name_error <strong>Error</strong>:', esc_html__('First name is required', 'rtwmer-mercado') . "!");
			}
			if (isset($_POST['rtwmer_last_name']) && empty($_POST['rtwmer_last_name'])) {
				$rtwmer_validation_errors->add('last_name_error <strong>Error</strong>:', esc_html__('Last name is required', 'rtwmer-mercado') . "!");
			}
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( !is_plugin_active( 'rtwmer_additon_prod_info/rtwmer_additional_prod_info.php' ) ) 
			{
				if (isset($_POST['rtwmer_shop_names']) && empty($_POST['rtwmer_shop_names'])) {
					$rtwmer_validation_errors->add('shop_names_error <strong>Error</strong>: ', esc_html__('Shop name is required', 'rtwmer-mercado') . "!");
				}
				if (isset($_POST['rtwmer_shop_url']) && empty($_POST['rtwmer_shop_url'])) {
					$rtwmer_validation_errors->add('first_shop_url <strong>Error</strong>:', esc_html__('Shop url is required', 'rtwmer-mercado') . "!");
				}
			}
		}
		return $rtwmer_validation_errors;
	}

	//=============  function for saving the value of additional fields      ==========================//
	//=============   function for saving the value of additional fields     ==========================//


	function rtwmer_save_extra_register_fields($customer_id)
	{
	
		if (isset($_POST['rtwmer-role'])) {

			update_user_meta($customer_id, 'rtwmer_email', sanitize_text_field($_POST['email']));

			if ($_POST['rtwmer-role'] == 'vendor') {

				$rtwmer_role_vendor = "rtwmer_vendor";
			} else {

				$rtwmer_role_vendor = sanitize_text_field($_POST['rtwmer-role']);
			}

			update_user_meta($customer_id, 'rtwmer_role', sanitize_text_field($rtwmer_role_vendor));

			if ($_POST['rtwmer-role'] == "vendor" && (get_role("vendor") != "null")) {

				$rtwmer_role = new WP_User($customer_id);
				$rtwmer_role->remove_role('customer');
				$rtwmer_role->add_role('rtwmer_vendor');

				$rtwmer_vendor_state = get_option("rtwmer_selling_page");
				if (is_array($rtwmer_vendor_state) &&   $rtwmer_vendor_state['rtwmer_allow_add_product'] == '1') {
					update_user_meta($customer_id, 'rtwmer_vendor_status', '1');
				} else {
					update_user_meta($customer_id, 'rtwmer_vendor_status', '0');
				}

				update_user_meta($customer_id, 'rtwmer_vendor_store_img', "");

				$rtwmer_wizzard = get_option("rtwmer_general_setting");
				if (is_array($rtwmer_wizzard) &&   $rtwmer_wizzard['rtwmer_welcome_wizard'] != '1') {
					update_user_meta($customer_id, 'rtwmer_vendor_store_setup', false);
				} else {
					update_user_meta($customer_id, 'rtwmer_vendor_store_setup', true);
				}

				if (isset($_POST['rtwmer_first_name'])) {

					update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['rtwmer_first_name']));
				}
				if (isset($_POST['rtwmer_last_name'])) {

					update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['rtwmer_last_name']));
				}
				if (isset($_POST['rtwmer_shop_names'])) {

					update_user_meta($customer_id, 'rtwmer_store_name', sanitize_text_field($_POST['rtwmer_shop_names']));
				}
				if (isset($_POST['rtwmer_shop_url'])) {


					update_user_meta($customer_id, 'rtwmer_store_url', sanitize_text_field($_POST['rtwmer_shop_url']));
				}
				if (isset($_POST['rtwmer_phone'])) {

					update_user_meta($customer_id, 'rtwmer_phone', sanitize_text_field($_POST['rtwmer_phone']));
				}
				do_action("rtwmer_add_vendor_meta", $customer_id);
			}
		}
	}


	//=============  function for adding custom button to the woocommerce dashboard      ==========================//
	//=============   function for adding custom button to the woocommerce dashboard     ==========================//


	function rtwmer_action_woocommerce_account_dashboard()
	{
		$rtwmer_options = get_option("rtwmer_page_setting");

		if (!empty($rtwmer_options) && is_array($rtwmer_options)) {
			$rtwmer_title = $rtwmer_options['rtwmer_page_setting_dashboard'];
		} else {
			$rtwmer_title = '';
		}
		$rtwmer_permalink = get_permalink($rtwmer_title);
		$rtw_ID = get_the_ID();
		update_option("rtwmer_last_page_ID", $rtw_ID);
		$rtwmer_user_obj = wp_get_current_user();
		$this->rtwmer_count_function();

		if (current_user_can("mercador")) {
			global $wp_roles;
			$rtwmer_roles = $wp_roles->roles;

			?>
			<a href="<?php echo esc_url($rtwmer_permalink) ?>" class="rtwmer_Dashboard_button">
				<?php echo $rtwmer_roles[$rtwmer_user_obj->roles[0]]['name'] . esc_html__(" Dashboard", "rtwmer-mercado") ?>
			</a>
			<?php 
		}
	}


	//=============  function for adding product      ==========================//
	//=============  function for adding product    ==========================//


	function add_product_ajax()
	{
		include_once RTWMER_PUBLIC_PARTIAL . "rtwmer_product_page/rtwmer_add_product_cb.php";
	}

	//=============  function for product table      ==========================//
	//=============  function for product table    ==========================//


	function rtwmer_product_table()
	{
		include_once RTWMER_PUBLIC_PARTIAL . "rtwmer_product_page/rtwmer_product_datatable_cb.php";
	}

	//=============  function for editing  product      ==========================//
	//=============  function for editing  product    ==========================//


	function rtwmer_edit_product_ajax()
	{
		include_once RTWMER_PUBLIC_PARTIAL . "rtwmer_product_page/rtwmer_edit_product_cb.php";
	}

	//=============  function for delete product      ==========================//
	//=============  function for delete product    ==========================//


	function rtwmer_delete_product_ajax()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
		
			if (isset($_POST) && !empty($_POST)) {
				if (isset($_POST['rtwmer_prod_ID']) && !empty($_POST['rtwmer_prod_ID'])) {
					$product_status = get_post($_POST['rtwmer_prod_ID']);
			

					// get_post($_POST['rtwmer_prod_ID']);
					if (isset($product_status->post_status) && ($product_status->post_status == "trash")) {
						$rtwmer_product_ID = sanitize_text_field($_POST['rtwmer_prod_ID']);
						$rtwmer_status  =  wp_delete_post($rtwmer_product_ID);
						if (!empty($rtwmer_status)) {
							echo json_encode("Deleted successfully");
							wp_die();
						}
					} else {
						$rtwmer_product_ID = sanitize_text_field($_POST['rtwmer_prod_ID']);
						$rtwmer_status  =  wp_trash_post($rtwmer_product_ID);
						if (!empty($rtwmer_status)) {
							echo json_encode("Trashed successfully");
						}
					}
				}
			}
		}
		wp_die();
	}

	//=============  function for searching user      ==========================//
	//=============  function for searching user    ==========================//

	function rtwmer_search_reg_users_cb()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			$args = array(
				'role' => 'customer',
				'order' => 'ASC',
				'orderby' => 'display_name',
				'search' => '*' . esc_attr(sanitize_text_field($_POST["rtwmer_user_name"])) . '*',

			);


			$wp_user_query = new WP_User_Query($args);
			$authors = $wp_user_query->get_results();
			if (!empty($authors)) {
				$rtwmer_list = array();
				foreach ($authors as $author) {

					$author_info = get_userdata($author->ID);
					$rtwmer_list[$author->ID] = $author_info->data->user_nicename;
				}

				echo json_encode($rtwmer_list);
			}
			wp_die();
		}
	}


	//=============  function for sku check      ==========================//
	//=============  function for sku check    ==========================//


	function check_if_sku_exists($rtwmer_check_sku = '')
	{
		global $wpdb;
		$rtwmer_sku = (empty($rtwmer_check_sku)) ? sanitize_text_field($_POST["rtwmer_sku_string"]) : $rtwmer_check_sku;

		$rtwmer_query = "SELECT * FROM `" . $wpdb->prefix . "postmeta` WHERE `meta_key` LIKE '_sku' AND `meta_value` LIKE %s ORDER BY `meta_key` DESC";
		$rtwmer_check_sku_result = $wpdb->get_var($wpdb->prepare($rtwmer_query, $rtwmer_sku));
		$rtwmer_results = (empty($rtwmer_check_sku_result)) ? false : true;
		if (empty($rtwmer_check_sku)) {
			echo json_encode($rtwmer_results);
			wp_die();
		} else {
			return $rtwmer_results;
		}
	}

	//=============  function for deleting product in bulk      ==========================//
	//=============  function for deleting product in bulk    ==========================//
	/*     callback function for deleting product in bulk      */

	function delete_product_bulk_ajax()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			// $_POST['rtwmer_prod_ID_array'] holds array
			$rtwmer_product_ID_array = isset($_POST['rtwmer_prod_ID_array']) ? $_POST['rtwmer_prod_ID_array'] : array();	
			
			if (!empty($rtwmer_product_ID_array)) {
				foreach ($rtwmer_product_ID_array as $rtwmer_product_ID) {
					if ($_POST['rtwmer_cond']  ==  'Trash_multiple') {

						$rtwmer_status  =  wp_trash_post($rtwmer_product_ID);
					} elseif ($_POST['rtwmer_cond']  ==  'Delete_multiple') {

						$rtwmer_status = wp_delete_post(intval($rtwmer_product_ID));
					} elseif ($_POST['rtwmer_cond']  ==  'Restore_multiple') {

						$rtwmer_status = wp_untrash_post(intval($rtwmer_product_ID));
					}
				}
			}
			if (!empty($rtwmer_status)) {
				if ($_POST['rtwmer_cond']  ==  'Trash_multiple') {

					echo json_encode(1);
					wp_die();
				} elseif ($_POST['rtwmer_cond']  ==  'Delete_multiple') {

					echo json_encode(1);
					wp_die();
				} elseif ($_POST['rtwmer_cond']  ==  'Restore_multiple') {

					echo json_encode(1);
					wp_die();
				}
			}
		}
		wp_die();
	}



	//=============  function for adding endpoints      ==========================//
	//=============  function for adding endpoints    ==========================//


	function rtwmer_rewrite_endpoints()
	{

		global $rtwmer_user_id_for_dashboard;
		if (is_user_logged_in()) {
			$rtwmer_user = wp_get_current_user();
			if (in_array('rtwmer_vendor', (array) $rtwmer_user->roles) || in_array('administrator', (array) $rtwmer_user->roles)) {
				$rtwmer_user_id_for_dashboard = get_current_user_id();
			} else {
				if (get_user_meta(get_current_user_id(), "rtwmer_parent_vendor", true)) {
					$rtwmer_user_id_for_dashboard = (int)get_user_meta(get_current_user_id(), "rtwmer_parent_vendor", true);
				} else {
					$rtwmer_user_id_for_dashboard = get_current_user_id();
				}
			}
			$rtwmer_user_id_for_dashboard = apply_filters("rtwmer_mercado_define_user_for_dashboard", $rtwmer_user_id_for_dashboard);
		}


		$rtwmer_options_array  =  get_option('rtwmer_general_setting');

		if (!empty($rtwmer_options_array) && is_array($rtwmer_options_array)) {
			if ($rtwmer_options_array['rtwmer_access_admin_area'] == "1") {
				update_user_meta($rtwmer_user_id_for_dashboard, 'show_admin_bar_front', "false");
			} elseif ($rtwmer_options_array['rtwmer_access_admin_area'] == "0") {
				update_user_meta($rtwmer_user_id_for_dashboard, 'show_admin_bar_front', "true");
			}

			$rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];
		
			global $wp_rewrite; 

			$wp_rewrite->set_permalink_structure('/%postname%/'); 
			
			update_option( "rewrite_rules", FALSE ); 
			
			$wp_rewrite->flush_rules( true );

			add_rewrite_rule($rtwmer_endpoint_page . '/?$', 'index.php?', 'top');

			add_rewrite_rule($rtwmer_endpoint_page . '/([^/]+)/?$', 'index.php?rtwmer_pagename=' . $rtwmer_endpoint_page . '&rtwmer_nicename=$matches[1]', 'top');

			add_rewrite_rule($rtwmer_endpoint_page . '/([^/]+)/page/([1-9]|[1-9][0-9]|[1-9][0-9][0-9])/?$', 'index.php?rtwmer_pagename=' . $rtwmer_endpoint_page . '&rtwmer_nicename=$matches[1]&rtwmer_page=$matches[2]', 'top');

			add_rewrite_rule($rtwmer_endpoint_page . '/([^/]+)/([1-9]|[1-9][0-9]|[1-9][0-9][0-9])/?$', 'index.php?rtwmer_pagename=' . $rtwmer_endpoint_page . '&rtwmer_nicename=$matches[1]&rtwmer_cat_ids=$matches[2]', 'top');

			add_rewrite_rule($rtwmer_endpoint_page . '/([^/]+)/([1-9]|[1-9][0-9]|[1-9][0-9][0-9])/page/([1-9]|[1-9][0-9]|[1-9][0-9][0-9])/?$', 'index.php?rtwmer_pagename=' . $rtwmer_endpoint_page . '&rtwmer_nicename=$matches[1]&rtwmer_cat_ids=$matches[2]&rtwmer_page=$matches[3]', 'top');
		}
	}


	//=============  function for restrict vendors to access admin panel directly     ==========================//
	//=============  function for restrict vendors to access admin panel directly    ==========================//

	function rtwmer_restrict_vendors()
	{
		$rtwmer_options_array  =  get_option('rtwmer_general_setting');

		if (!empty($rtwmer_options_array) && is_array($rtwmer_options_array)) {
			if ($rtwmer_options_array['rtwmer_access_admin_area'] == "1") {
				if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
					wp_safe_redirect( home_url() );
					exit;
				}
			}
		}
	}

	//=============  function for adding query vars      ==========================//
	//=============  function for adding query vars    ==========================//


	function custom_endpoint($rtwmer_qvars)
	{

		$rtwmer_qvars[] = 'rtwmer_nicename';
		$rtwmer_qvars[] = 'rtwmer_pagename';
		$rtwmer_qvars[] = 'rtwmer_page';
		$rtwmer_qvars[] = 'rtwmer_cat_ids';
		return $rtwmer_qvars;
	}



	//=============  function for loading custom templates      ==========================//
	//=============  function for loading custom templates    ==========================//



	function rtwmer_load_plugin_template($template)
	{
		global $wp;

		$rtwmer_options_array  =  get_option('rtwmer_general_setting');

		if (!empty($rtwmer_options_array) && is_array($rtwmer_options_array)) {

			$rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];
		}
		$rtwmer_vendor_slug  =  get_query_var('rtwmer_nicename');

		$rtwmer_options_page_array = get_option("rtwmer_page_setting");
		if (!empty($rtwmer_options_page_array) && is_array($rtwmer_options_page_array)) {

			$rtwmer_title = $rtwmer_options_page_array['rtwmer_page_setting_dashboard'];
		}
		$rtwmer_page_ID = get_the_ID();
		if (isset($rtwmer_title) && ($rtwmer_page_ID == $rtwmer_title)) {

			if (get_page_template_slug() === 'rtwmer_vendor_dashboard_template.php') {

				if ($theme_file = locate_template(array('rtwmer_vendor_dashboard_template.php'))) {
					$template = $theme_file;
				} else {
					$template = RTWMER_ASSETS . '/rtwmer_vendor_dashboard_template.php';
				}
			}
			return $template;
		}
		if (isset($rtwmer_endpoint_page) && isset($rtwmer_options_page_array['rtwmer_page_store_listing']) && ($wp->request  ==  $rtwmer_endpoint_page)) {

			wp_redirect(get_permalink($rtwmer_options_page_array['rtwmer_page_store_listing']));
		}

		$rtwmer_vendor_cond = (empty($rtwmer_vendor_slug))	?	0	:	1;
		if ($rtwmer_vendor_cond) {

			$rtwmer_store_template_url = RTWMER_PUBLIC_PARTIAL . "rtwmer_Vendor_Store/rtwmer_Vendor_store_endpoints.php";
			$rtwmer_store_template_url = apply_filters("rtwmer_store_template_url", $rtwmer_store_template_url);
			if (!empty($rtwmer_store_template_url) && (file_exists($rtwmer_store_template_url))) {
				$template  = $rtwmer_store_template_url;
			} else {
				$template  = RTWMER_PUBLIC_PARTIAL . "rtwmer_Vendor_Store/rtwmer_Vendor_store_endpoints.php";
			}
		}
		return $template;
	}

	//=============  function for product category filtering     ==========================//
	//=============  function for views count of products   ==========================//

	function rtwmer_category_list_filter($output, $args)
	{
		$rtwmer_var  =  get_query_var('rtwmer_nicename');
		if (!empty($rtwmer_var)) {
			$rtwmer_vendor_detail_obj  =  get_user_by('slug', $rtwmer_var);
			if (is_object($rtwmer_vendor_detail_obj)) {
				$rtwmer_vendor_id = $rtwmer_vendor_detail_obj->data->ID;
			}
			$rtwmer_args = array(
				'author'        =>  $rtwmer_vendor_id,
				'post_type'     => 'product',
				'posts_per_page' => -1
			);

			$rtwmer_current_user_posts = get_posts($rtwmer_args);
			if (!empty($rtwmer_current_user_posts)) {
				$all_categories = array();
				foreach ($rtwmer_current_user_posts as $rtwmer_post) {
					$rtwmer_catergories =  wp_get_post_terms($rtwmer_post->ID, 'product_cat');
					foreach ($rtwmer_catergories as $rtwmer_cat) {
						if (!in_array($rtwmer_cat, $all_categories)) {
							$all_categories[] = $rtwmer_cat;
						}
					}
				}
				foreach ($all_categories as  $rtwmer_cats) {
					if (is_object($rtwmer_cats) && $rtwmer_cats->parent != 0) {
						$rtwmer_id[$rtwmer_cats->term_id] =   get_ancestors($rtwmer_cats->term_id, 'product_cat');
					} else {
						$rtwmer_id[$rtwmer_cats->term_id] = 0;
					}
				}
				$rtwmer_arr = array();
				foreach ($rtwmer_id as $id => $val) {
					if (!in_array($id, $rtwmer_arr)) {
						$rtwmer_arr[] = $id;
					}
					if (is_array($val)) {
						for ($i = count($val) - 1; $i >= 0; $i--) {
							if (!in_array($val[$i], $rtwmer_arr)) {
								$rtwmer_arr[] = $val[$i];
							}
						}
					}
				}
			}
			if (isset($rtwmer_arr)) {
				if (is_object($args) && !in_array($args->term_id, $rtwmer_arr)) {
					$output = "";
					$args = "";
				}
			}
		}
		return $output;
	}

	//=============  function for views count of products      ==========================//
	//=============  function for views count of products   ==========================//

	function  rtwmer_views_update()
	{
		if (is_single()) {
			$rtwmer_post_id = get_the_ID();
			$rtwmer_id = [$rtwmer_post_id];

			$rtwmer_cookie = (isset($_COOKIE['rtwmer_single_prod_view']) && !empty($_COOKIE['rtwmer_single_prod_view']))	?	json_decode($_COOKIE['rtwmer_single_prod_view'])	:	array();

			if (isset($rtwmer_cookie) && !in_array($rtwmer_post_id, $rtwmer_cookie)) {

				$rtwmer_merged = array_merge($rtwmer_id, $rtwmer_cookie);

				array_unique($rtwmer_merged);

				setcookie("rtwmer_single_prod_view", json_encode($rtwmer_merged), time() + (86400 * 30));

				$rtwmer_prod_meta  =  get_post_meta($rtwmer_post_id, 'rtwmer_product_view_count', true);

				if (!empty($rtwmer_prod_meta)) {

					$rtwmer_count_update = $rtwmer_prod_meta + 1;
				} else {

					$rtwmer_count_update = 1;
				}

				update_post_meta($rtwmer_post_id, 'rtwmer_product_view_count', $rtwmer_count_update);
			}
		}
		if (isset($_GET["rtwmer_order_id_csv"])) {
			$rtwmer_csv_orders = explode(",", $_GET["rtwmer_order_id_csv"]);
		}

		if (isset($rtwmer_csv_orders) && !empty($rtwmer_csv_orders)) {
			$this->rtwmer_create_csv($rtwmer_csv_orders);
		}
	}

	//=============  function for vendor store listing shortcode callback      ==========================//
	//=============  function for vendor store listing shortcode callback    ==========================//


	function Vendors_Store_cb()
	{
		global $wp_query;

		$rtwmer_options = get_option("rtwmer_page_setting");
		if (!empty($rtwmer_options) && is_array($rtwmer_options)) {
			$rtwmer_store = $rtwmer_options['rtwmer_page_store_listing'];
		}

		$rtwmer_current_id_page  =  $wp_query->get_queried_object_id();

		if (isset($rtwmer_store) && $rtwmer_current_id_page == $rtwmer_store) {

			include_once RTWMER_PUBLIC_PARTIAL . "rtwmer_Vendor_Store/rtwmer_Vendor_Store_shortcode_cb.php";
			return $rtwmer_store_html;
		}
	}

	//=============  function for store listing preview layout      ==========================//
	//=============  function for store listing preview layout    ==========================//


	function rtwmer_store_listing_preview()
	{

		$rtwmer_cookie_name = "rtwmer_store_listing_view";

		$rtwmer_view = sanitize_text_field($_POST['rtwmer_looks']);

		setcookie($rtwmer_cookie_name, $rtwmer_view, time() - 3600, "/");

		setcookie($rtwmer_cookie_name, $rtwmer_view, time() + (86400 * 30), "/");

		wp_die();
	}


	//=============  function for adding custom tabs in single product page      ==========================//
	//=============  function for adding custom tabs in single product page   ==========================//

	function rtwmer_action_woocommerce_after_single_product_summary($rtwmer_tabs)
	{

		$rtwmer_tabs['rtwmer_tab_info'] = array(
			'title'       => esc_html__(' Vendor info ', 'rtwmer-mercado'),
			'priority'    => 50,
			'callback'    => array($this, 'rtwmer_new_product_tab_content'),
		);

		$rtwmer_tabs['rtwmer_tab_list'] = array(
			'title'       => esc_html__(' More Products from Vendor ', 'rtwmer-mercado'),
			'priority'    => 60,
			'callback'    => array($this, 'rtwmer_product_list'),
		);
		return $rtwmer_tabs;
	}



	//=============  function for Vendor info tab content      ==========================//
	//=============  function for Vendor info tab content    ==========================//


	function rtwmer_new_product_tab_content()
	{

		$rtwmer_options_array  =  get_option('rtwmer_general_setting');
		$rtwmer_endpoint_page = (!empty($rtwmer_options_array) && is_array($rtwmer_options_array))	?	$rtwmer_options_array['rtwmer_store_url']	:	'';
		$rtwmer_author_url = (!empty($rtwmer_endpoint_page))	?	home_url() . '/' . $rtwmer_endpoint_page . '/' . get_the_author_meta('user_nicename')	:	home_url();
		$rtwmer_heading =  '<h2>' . esc_html__("Vendor Information", "rtwmer-mercado") . "</h2>";
		echo $rtwmer_heading;  // This variable holds html
		$rtwmer_vendor_link =  '<p>'	. esc_html__("Vendor", "rtwmer-mercado") . ':<a href=' . esc_url($rtwmer_author_url)	. '>';
		echo $rtwmer_vendor_link;	// This variable holds html
		the_author();
		$rtwmer_closing =  "</a></p>";
		echo $rtwmer_closing;	// This variable holds html
		$args_top_rating1 = array(
			'post_type' => 'product',
			'meta_key' => '_wc_average_rating',
			'orderby' => 'meta_value',
			'author'  =>  get_the_author_meta('ID'),
			'posts_per_page' => -1,
			'status' => 'publish',
			'catalog_visibility' => 'visible',
			'stock_status' => 'instock'
		);

		$top_rating = new WP_Query($args_top_rating1);
		$rtwmer_count = 0;
		$rtwmer_total_reviews = 0;
		$rtwmer_total_no_of_review = 0;
		while ($top_rating->have_posts()) : $top_rating->the_post();
			global $product;

			$urltop_rating = get_permalink($top_rating->post->ID);

			$rating_count = $product->get_rating_count();

			$average_rating = $product->get_average_rating();

			$rtwmer_total_reviews  =  $average_rating + $rtwmer_total_reviews;

			$rtwmer_total_no_of_review = $rating_count + $rtwmer_total_no_of_review;
			if (!empty($rating_count)) {
				$rtwmer_count++;
			}

		endwhile;
		wp_reset_query();
		if (!empty($rtwmer_count)) {
			$rtwmer_reviews = $rtwmer_total_reviews / $rtwmer_count;
			echo wc_get_rating_html($rtwmer_reviews, $rtwmer_total_no_of_review);
		} else {
			esc_html_e("The vendor is not rated yet", "rtwmer-mercado");
		}
	}


	//=============  function for More Products from Vendor tab content      ==========================//
	//=============  function for More Products from Vendor tab content    ==========================//


	function rtwmer_product_list()
	{

		$rtwmer_opening_ul =  '<ul class="rtwmer_more_prdct_from_vendor_list">';
		echo $rtwmer_opening_ul;	// This variable holds html
		$args = array(
			'post_type' => 'product',
			'post__not_in' => array(get_the_ID()),
			'posts_per_page' => 6,
			'orderby' => 'rand',
			'author'  => get_the_author_meta('ID'),
		);
		$loop = new WP_Query($args);
		if ($loop->have_posts()) {
			while ($loop->have_posts()) : $loop->the_post();
				wc_get_template_part('content', 'product');
			endwhile;
		} else {
			esc_html_e('No products found', "rtwmer-mercado");
		}
		wp_reset_postdata();

		$rtwmer_closing_ul =  '</ul>';
		echo $rtwmer_closing_ul;	// This variable holds html
	}

	//=============  function for sending email to vendor      ==========================//
	//=============  function for sending email to vendor    ==========================//


	function rtwmer_email_vendor()
	{
		if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
			if (isset($_POST) && !empty($_POST)) {

				$rtwmer_user_name  =  sanitize_text_field($_POST['rtwmer_user_name']);
				$rtwmer_user_email  =  sanitize_text_field($_POST['rtwmer_user_email']);
				$rtwmer_user_message  =  sanitize_text_field($_POST['rtwmer_user_message']);
				$rtwmer_current_vendor_id  =  sanitize_text_field(intval($_POST['rtwmer_current_vendor_id']));
				$rtwmer_vendor_info = get_userdata($rtwmer_current_vendor_id)->data->user_email;
				$headers[] = 'From: ' . $rtwmer_user_name . ' <' . $rtwmer_user_email . '>';
				$rtwmer_mail_response  =  wp_mail($rtwmer_vendor_info, "Customer Reviews", $rtwmer_user_message, $headers, '');
				if ($rtwmer_mail_response) {
					echo json_encode("Sent successfully");
					wp_die();
				}else{
					echo json_encode("Not Sent");
				}
			}
		}
		wp_die();
	}


	//=============  function for vendor reviews according to its product reviews       ==========================//
	//=============  function for vendor reviews according to its product reviews     ==========================//

	function rtwmer_vendor_reviews($rtwmer_vendor)
	{
		$args_top_rating1 = array(
			'post_type' => 'product',
			'meta_key' => '_wc_average_rating',
			'orderby' => 'meta_value',
			'author'  =>  get_the_author_meta('ID'),
			'posts_per_page' => -1,
			'status' => 'publish',
			'catalog_visibility' => 'visible',
			'stock_status' => 'instock'
		);

		$top_rating = new WP_Query($args_top_rating1);

		$rtwmer_count = 0;
		$rtwmer_total_reviews = 0;
		$rtwmer_total_no_of_review = 0;

		global $product;
		$rtwmer_prod_id = $product->get_id();

		while ($top_rating->have_posts()) : $top_rating->the_post();
			global $product;

			$urltop_rating = get_permalink($top_rating->post->ID);

			$rating_count = $product->get_rating_count();

			$average_rating = $product->get_average_rating();

			$rtwmer_total_reviews  =  $average_rating + $rtwmer_total_reviews;

			$rtwmer_total_no_of_review = $rating_count + $rtwmer_total_no_of_review;
			if (!empty($rating_count)) {
				$rtwmer_count++;
			}

		endwhile;
		wp_reset_query();
		if (!empty($rtwmer_count)) {
			$rtwmer_reviews = $rtwmer_total_reviews / $rtwmer_count;
			update_user_meta(get_the_author_meta('ID'), "rtwmer_vendor_rating", wc_get_rating_html($rtwmer_reviews, $rtwmer_total_no_of_review));
		} else {
			update_user_meta(get_the_author_meta('ID'), "rtwmer_vendor_rating", wc_get_rating_html(0, 0));
		}
	}
	//=============  function for order csv      ==========================//
	//=============  function for order csv   ==========================//

	function rtwmer_export_orders_cb()
	{

		global $wpdb;
		$query = "SELECT ID FROM " . $wpdb->prefix . "posts LEFT JOIN (SELECT post_id,
			MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_name
			FROM " . $wpdb->prefix . "postmeta GROUP BY post_id) rtw_selected_table ON " . $wpdb->prefix . "posts.`ID`= rtw_selected_table.`post_id`  WHERE rtwmer_order_vendor_name IS NOT NULL AND rtwmer_order_vendor_name='%s'";
		$rtwmer_order_all = $wpdb->get_results($wpdb->prepare($query, get_current_user_id()), ARRAY_A);
		$rtwmer_new = array();
		foreach ($rtwmer_order_all as $key => $value) {
			$rtwmer_new[] = $value["ID"];
		}
		$rtwmer_order_all = $rtwmer_new;

		echo json_encode($rtwmer_order_all);

		wp_die();
	}


	//=============  function for creating csv      ==========================//
	//=============  function for creating csv    ==========================//


	function rtwmer_create_csv($rtwmer_order_all)
	{
		$rtwmer_content_array = array();
		foreach ($rtwmer_order_all as $rtwmer_order_id) {
			$rtwmer_order_id = (int) $rtwmer_order_id;
			$order = new WC_Order(intval($rtwmer_order_id));

			$rtwmer_items_name = "";
			foreach ($order->get_items() as $key => $item) {
				if (!empty($rtwmer_items_name)) {
					$rtwmer_items_name .=  "," . $item->get_name();
				} else {
					$rtwmer_items_name .=  $item->get_name();
				}
			}

			$rtwmer_array_order = array(
				$order->get_order_number(),
				$rtwmer_items_name,
				$order->get_shipping_method(),
				$order->get_shipping_total(),
				$order->get_payment_method_title(),
				$order->get_total(),
				$order->get_status(),
				$order->get_date_created(),
				$order->get_billing_company(),
				$order->get_billing_first_name(),
				$order->get_billing_last_name(), $order->get_formatted_billing_full_name(), $order->get_billing_email(),
				$order->get_billing_phone(),
				$order->get_billing_address_1(),
				$order->get_billing_address_2(),
				$order->get_billing_city(),
				$order->get_billing_state(),
				$order->get_billing_postcode(),
				$order->get_billing_country(),
				$order->get_shipping_company(),
				$order->get_shipping_first_name(),
				$order->get_shipping_last_name(), $order->get_formatted_shipping_full_name(), $order->get_shipping_address_1(),
				$order->get_shipping_address_2(),
				$order->get_shipping_city(),
				$order->get_shipping_state(),
				$order->get_shipping_postcode(),
				$order->get_shipping_country(),
				$order->get_customer_ip_address(),
				$order->get_customer_note()
			);

			$rtwmer_content_array[] =  $rtwmer_array_order;
		}

		$rtwmer_csv_header = array(
			"Order No",
			"Order Items",
			"Shipping method",
			"Shipping Cost",
			"Payment method",
			"Order Total",
			"Order Status",
			"Order Date",
			"Billing Company",
			"Billing First Name",
			"Billing Last Name",
			"Billing Full Name",
			"Billing Email",
			"Billing Phone",
			"Billing Address 1",
			"Billing Address 2",
			"Billing City",
			"Billing State",
			"Billing Postcode",
			"Billing Country",
			"Shipping Company",
			"Shipping First Name",
			"Shipping Last Name",
			"Shipping Full Name",
			"Shipping Address 1",
			"Shipping Address 2",
			"Shipping City",
			"Shipping State",
			"Shipping Postcode",
			"Shipping Country",
			"Customer IP",
			"Customer Note"
		);



		$rtwmer_path 		= get_temp_dir();
		$rtwmer_filename 	= "rtwmer_mercado" . time() . ".csv";
		$rtwmer_full_path	= $rtwmer_path . $rtwmer_filename;

		$output = fopen($rtwmer_full_path, "w");

		fputcsv($output, $rtwmer_csv_header);

		foreach ($rtwmer_content_array as $rtwmer_key => $rtwmer_value) {
			fputcsv($output, $rtwmer_value);
		}
		fclose($output);
		header("Content-Type: text/csv");
		header("Content-Disposition: attachment; filename=" . $rtwmer_filename);
		readfile($rtwmer_full_path);
		die();
	}

	//=============  function returns the url of the dashboard page     ==========================//
	//=============  function returns the url of the dashboard page    ==========================//

	public function rtwmer_vendor_dashboard_url()
	{
		$rtwmer_options = get_option("rtwmer_page_setting");


		if (!empty($rtwmer_options) && is_array($rtwmer_options)) {
			$rtwmer_title = (int) $rtwmer_options['rtwmer_page_setting_dashboard'];
			return get_permalink($rtwmer_title);
		} else {
			return get_permalink(get_option('woocommerce_myaccount_page_id'));
		}
	}

	//=============  function returns the url of the store page     ==========================//
	//=============  function returns the url of the store page    ==========================//

	public function rtwmer_vendor_store_url()
	{
		$rtwmer_options_array  =  get_option('rtwmer_general_setting');
		if (!empty($rtwmer_options_array) && is_array($rtwmer_options_array)) {
			$rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];
			$rtwmer_current_usr_nicename = wp_get_current_user()->user_nicename;
			return esc_url(home_url() . "/" . $rtwmer_endpoint_page . "/" . $rtwmer_current_usr_nicename);
		} else {
			return get_permalink(get_option('woocommerce_myaccount_page_id'));
		}
	}

	//=============  function for vendor page shortcode      ==========================//
	//=============  function for vendor page shortcode    ==========================//


	function Vendors_dashboards()
	{
		include_once RTWMER_PUBLIC_PARTIAL . "rtwmer_vendor_dashboard_shortcode.php";
	}

	//========== show custom tab on single product page ==========//
	public function rtwmer_woo_custom_product_tabs( $rtwmer_tabs )
	{
		$rtwmer_tabs['rtwmer_extra_prod_info'] = array(
	        'title'     => __( 'Additional Details', 'woocommerce' ),
	        'priority'  => 110,
	        'callback'  => array($this,'rtwmer_extra_product_option_callback')
	    );
	    return $rtwmer_tabs;
	}

	function rtwmer_extra_product_option_callback()
	{
		global $post;
		$extra_prod_opt = array();
		if ( $post->post_type == 'product' ) 
		{
			$extra_prod_opt['days_and_desc'] = get_post_meta( $post->ID, '_rtwmer_days_and_desc',true );
            $extra_prod_opt['Extra notes'] = get_post_meta( $post->ID, '_rtwmer_extra_note',true );
            $extra_prod_opt['Other details'] = get_post_meta( $post->ID, '_rtwmer_other_details',true );
            $extra_prod_opt['Exclusions'] = get_post_meta( $post->ID, '_rtwmer_excluded',true );
            $extra_prod_opt['Inclusions'] = get_post_meta( $post->ID, '_rtwmer_included',true );
            $extra_prod_opt['Best time to visit'] = get_post_meta( $post->ID, '_rtwmer_timeto_visit',true );
            $extra_prod_opt['Weather'] = get_post_meta( $post->ID, '_rtwmer_weather',true );
            $extra_prod_opt['OUR Leader'] = get_post_meta( $post->ID, '_rtwmer_tour_leader',true );
            $extra_prod_opt['Start Date'] = get_post_meta( $post->ID, '_rtwmer_start_date',true );
            $extra_prod_opt['End Date'] = get_post_meta( $post->ID, '_rtwmer_start_date',true );
            $extra_prod_opt['Experiences offered'] = get_post_meta( $post->ID, '_rtwmer_experience',true );
            $extra_prod_opt['Duration'] = get_post_meta( $post->ID, '_rtwmer_duration',true );
            $extra_prod_opt['Destinations included'] = get_post_meta( $post->ID, '_rtwmer_destination_include',true );
            $rtwmer_prod_html = '';
            if(!empty($extra_prod_opt))
            {
            	foreach ($extra_prod_opt as $extra_prod_key => $extra_prod_value) 
            	{
            		if ( is_array($extra_prod_value) && !empty($extra_prod_value) ) 
            		{
            			$rtwmer_text = '<div><table>';
            			$rtw_string = '';
            			foreach ($extra_prod_value as $keys => $values) 
            			{
            				$rtw_string .= '<tr><td style="border: 1px solid black; padding: 10px;">'.esc_html__('Day '.($keys+1),'rtwmer-mercado').'</td>';
            				$rtw_string .= '<td>'.esc_html__(ucfirst($values),'rtwmer-mercado').'</td></tr>';
            			}
            			$rtwmer_text .= $rtw_string;
            			$rtwmer_text .= '</table></div>';
            			$rtwmer_prod_html .= $rtwmer_text;
            		}
            		else
            		{
            			if (strpos($extra_prod_value,'|')!== false) 
	            		{
	            			$rtwmer_prod_html .= '<h4>'.esc_html__(ucfirst($extra_prod_key),'rtwmer-mercado').'</h4>';
	            			$rtwmer_val = explode('|', $extra_prod_value);
	            			if ( !empty($rtwmer_val) ) 
	            			{
	            				$rtwmer_html = '<ul>';
	            				$rtwmer_str = '';
	            				foreach ($rtwmer_val as $k => $val) 
	            				{
	            					$rtwmer_str .= '<li>'.esc_html__(ucfirst($val),'rtwmer-mercado').'</li>';
	            				}
	            				$rtwmer_html .= $rtwmer_str;
	            				$rtwmer_html .= '</ul>';
	            				$rtwmer_prod_html .= $rtwmer_html;
	            			}
	            		}
	            		else
	            		{
	            			$rtwmer_prod_html .= '<h4>'.esc_html__(ucfirst($extra_prod_key),'rtwmer-mercado').'</h4>';
	            			$rtwmer_prod_html .= '<ul><li>'.esc_html__(ucfirst($extra_prod_value),'rtwmer-mercado').'</li></ul>';
	            		}
            		}
            	}
            }
			echo $rtwmer_prod_html;
		}
	}

	/**
	 * Notify admin when a new customer account is created
	 */
	public function rtwmer_woocommerce_created_customer_admin_notification( $rtwmer_customer_id )
	{
		wp_send_new_user_notifications( $customer_id, 'both' );
	}
}
