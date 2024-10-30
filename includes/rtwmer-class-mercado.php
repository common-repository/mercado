<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/includes
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwmer_Mercado
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Rtwmer_Mercado_Loader    $rtwmer_loader    Maintains and registers all hooks for the plugin.
	 */
	protected $rtwmer_loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $rtwmer_plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $rtwmer_plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $rtwmer_version    The current version of the plugin.
	 */
	protected $rtwmer_version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('RTWMER_MERCADO_VERSION')) {
			$this->rtwmer_version = RTWMER_MERCADO_VERSION;
		} else {
			$this->rtwmer_version = '1.0.0';
		}
		$this->rtwmer_plugin_name = 'mercado';

		$this->rtwmer_load_dependencies();
		$this->rtwmer_set_locale();
		$this->rtwmer_define_admin_hooks();
		$this->rtwmer_define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Rtwmer_Mercado_Loader. Orchestrates the hooks of the plugin.
	 * - Rtwmer_Mercado_i18n. Defines internationalization functionality.
	 * - Rtwmer_Mercado_Admin. Defines all hooks for the admin area.
	 * - Rtwmer_Mercado_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rtwmer_load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/rtwmer-class-mercado-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/rtwmer-class-mercado-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/rtwmer-class-mercado-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/rtwmer-class-mercado-public.php';

		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/rtwmer_functions.php';

		$this->rtwmer_loader = new Rtwmer_Mercado_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Rtwmer_Mercado_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rtwmer_set_locale()
	{

		$rtwmer_plugin_i18n = new Rtwmer_Mercado_i18n();

		$this->rtwmer_loader->rtwmer_add_action('plugins_loaded', $rtwmer_plugin_i18n, 'rtwmer_load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rtwmer_define_admin_hooks()
	{


		if (is_admin()) {

			$rtwmer_plugin_admin = new Rtwmer_Mercado_Admin($this->rtwmer_get_plugin_name(), $this->rtwmer_get_version());

			$this->rtwmer_loader->rtwmer_add_action('profile_update', $rtwmer_plugin_admin, 'rtwmer_profile_update', 10, 3);


			$this->rtwmer_loader->rtwmer_add_action('admin_enqueue_scripts', $rtwmer_plugin_admin, 'rtwmer_enqueue_styles');
			$this->rtwmer_loader->rtwmer_add_action('admin_enqueue_scripts', $rtwmer_plugin_admin, 'rtwmer_enqueue_scripts');
			$this->rtwmer_loader->rtwmer_add_action('in_admin_header', $rtwmer_plugin_admin, 'rtwmer_remove_notice',1);
			$this->rtwmer_loader->rtwmer_add_action('admin_menu', $rtwmer_plugin_admin, 'rtwmer_add_admin_menu');
			$this->rtwmer_loader->rtwmer_add_action('admin_menu', $rtwmer_plugin_admin, 'rtwmer_store_setp_on_activation');
			$this->rtwmer_loader->rtwmer_add_action('admin_notices', $rtwmer_plugin_admin, 'rtwmer_show_notices_on_admin');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_pop_up_notification', $rtwmer_plugin_admin, 'rtwmer_pop_up_notification_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_admin_withdraw', $rtwmer_plugin_admin, 'rtwmer_admin_withdraw_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_general_page', $rtwmer_plugin_admin, 'rtwmer_general_page_cb');
			// for
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_send_deactivation_feedback', $rtwmer_plugin_admin, 'rtwmer_plugin_send_feedback');

			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_selling_options_page', $rtwmer_plugin_admin, 'rtwmer_selling_options_page_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_withdraw_option_page', $rtwmer_plugin_admin, 'rtwmer_withdraw_option_page_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_payment_gateway_page', $rtwmer_plugin_admin, 'rtwmer_payment_gateway_page_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_page_setting', $rtwmer_plugin_admin, 'rtwmer_page_setting_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_appearence_page_action', $rtwmer_plugin_admin, 'rtwmer_appearence_page_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_setting_privacy', $rtwmer_plugin_admin, 'rtwmer_setting_privacy_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_vendors_table_action', $rtwmer_plugin_admin, 'rtwmer_vendors_table_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_vendor_status', $rtwmer_plugin_admin, 'rtwmer_vendor_status_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_vendor_upload_product', $rtwmer_plugin_admin, 'rtwmer_vendor_upload_product_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_vendor_bulk', $rtwmer_plugin_admin, 'rtwmer_vendor_bulkrtwmer_vendor_bulk');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_vendors_data', $rtwmer_plugin_admin, 'rtwmer_vendors_data_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_vendor_selected_country', $rtwmer_plugin_admin, 'rtwmer_vendor_selected_country_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_edit_vendors_data', $rtwmer_plugin_admin, 'rtwmer_edit_vendors_data_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_vendors_product', $rtwmer_plugin_admin, 'rtwmer_vendors_product_cb');
			$this->rtwmer_loader->rtwmer_add_action('user_register', $rtwmer_plugin_admin, 'rtwmer_user_register_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_tab_count', $rtwmer_plugin_admin, 'rtwmer_prod_tab_count_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_edit', $rtwmer_plugin_admin, 'rtwmer_prod_edit_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_admin_withdraw_count', $rtwmer_plugin_admin, 'rtwmer_admin_withdraw_count_cb');
			$this->rtwmer_loader->rtwmer_add_action('add_meta_boxes', $rtwmer_plugin_admin, 'rtwmer_add_meta_boxes_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_add_new', $rtwmer_plugin_admin, 'rtwmer_prod_add_new_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_quick_edit', $rtwmer_plugin_admin, 'rtwmer_prod_quick_edit_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_quick_edit_action', $rtwmer_plugin_admin, 'rtwmer_prod_quick_edit_action_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_trash_action', $rtwmer_plugin_admin, 'rtwmer_prod_trash_action_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_preview_action', $rtwmer_plugin_admin, 'rtwmer_prod_preview_action_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_restore_action', $rtwmer_plugin_admin, 'rtwmer_prod_restore_action_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_checkboxes_action', $rtwmer_plugin_admin, 'rtwmer_prod_checkboxes_action_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_prod_delete_action', $rtwmer_plugin_admin, 'rtwmer_prod_delete_action_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_duplicate_prod', $rtwmer_plugin_admin, 'rtwmer_duplicate_prod_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_empty_trash_action', $rtwmer_plugin_admin, 'rtwmer_empty_trash_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_fav_prod_action', $rtwmer_plugin_admin, 'rtwmer_fav_prod_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_vendors_count_action', $rtwmer_plugin_admin, 'rtwmer_vendors_count_action_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_add_new_vend_generate_pass_action', $rtwmer_plugin_admin, 'rtwmer_add_new_vend_generate_pass_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_addnew_vend_country_action', $rtwmer_plugin_admin, 'rtwmer_addnew_vend_country_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_withdraw_status_action', $rtwmer_plugin_admin, 'rtwmer_withdraw_status_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_withdraw_status_note_action', $rtwmer_plugin_admin, 'rtwmer_withdraw_status_note_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_order_table_action', $rtwmer_plugin_admin, 'rtwmer_order_table_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_order_count_action', $rtwmer_plugin_admin, 'rtwmer_order_count_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_edit_order_action', $rtwmer_plugin_admin, 'rtwmer_edit_order_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_view_order_action_1', $rtwmer_plugin_admin, 'rtwmer_view_order_cb_1');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_view_order_action_2', $rtwmer_plugin_admin, 'rtwmer_view_order_cb_2');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_process_order_request_action', $rtwmer_plugin_admin, 'rtwmer_process_order_request_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_order_checkboxes_action', $rtwmer_plugin_admin, 'rtwmer_order_checkboxes_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_show_sub_order_action', $rtwmer_plugin_admin, 'rtwmer_show_sub_order_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_chart_data_action', $rtwmer_plugin_admin, 'rtwmer_chart_data_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_dashboard_page_action', $rtwmer_plugin_admin, 'rtwmer_dashboard_page_cb');
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_setup_page_action', $rtwmer_plugin_admin, 'rtwmer_setup_page_cb');
			$this->rtwmer_loader->rtwmer_add_filter('admin_url', $rtwmer_plugin_admin, 'rtwmer_admin_url_cb', '', 3);
			$this->rtwmer_loader->rtwmer_add_filter('redirect_post_location', $rtwmer_plugin_admin, 'rtwmer_mercado_redirect_post_location_cb', '', 3);
			$this->rtwmer_loader->rtwmer_add_action('woocommerce_order_status_changed', $rtwmer_plugin_admin, 'rtwmer_order_status_changes_cb', 10, 3);
			$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_chart_data_action_for_product_stats', $rtwmer_plugin_admin, 'rtwmer_chart_data_action_for_product_stats_cb');
			$this->rtwmer_loader->rtwmer_add_filter('plugin_action_links_', $rtwmer_plugin_admin, 'wkmp_add_plugin_setting_links');



			//==============Public end functions get calls when order distributed and order updated=========////

			$rtwmer_plugin_public = new Rtwmer_Mercado_Public($this->rtwmer_get_plugin_name(), $this->rtwmer_get_version());
			$this->rtwmer_loader->rtwmer_add_action('woocommerce_new_order', $rtwmer_plugin_public, 'rtwmer_order_handler', 10, 1);
			// $this->rtwmer_loader->rtwmer_add_action('woocommerce_api_create_order', $rtwmer_plugin_public, 'rtwmer_order_handler', 10, 1);

		}
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rtwmer_define_public_hooks()
	{
		// die('jdfj');

		$rtwmer_plugin_public = new Rtwmer_Mercado_Public($this->rtwmer_get_plugin_name(), $this->rtwmer_get_version());

		add_shortcode('Vendor_Dashboard', array($rtwmer_plugin_public, 'Vendors_dashboards'));

		add_shortcode('Vendor_Store', array($rtwmer_plugin_public, 'Vendors_Store_cb'));

		// $this->rtwmer_loader->rtwmer_add_action('woocommerce_thankyou', $rtwmer_plugin_public, 'rtwmer_order_handler', 10, 1);
		$this->rtwmer_loader->rtwmer_add_action('woocommerce_store_api_checkout_order_processed', $rtwmer_plugin_public, 'rtwmer_order_handler', 10, 1);
		// $this->rtwmer_loader->rtwmer_add_action('woocommerce_new_order', $rtwmer_plugin_public, 'rtwmer_order_handler', 10, 1);
		$this->rtwmer_loader->rtwmer_add_action('woocommerce_checkout_order_processed', $rtwmer_plugin_public, 'rtwmer_order_handler', 10, 1);

		$this->rtwmer_loader->rtwmer_add_filter('woocommerce_registration_redirect', $rtwmer_plugin_public, 'rtwmer_redirect_to_Custom', 2);

		$this->rtwmer_loader->rtwmer_add_filter('template_include', $rtwmer_plugin_public, 'rtwmer_load_plugin_template');

		$this->rtwmer_loader->rtwmer_add_filter('theme_page_templates', $rtwmer_plugin_public, 'rtwmer_add_template_to_select', 10, 4);

		$this->rtwmer_loader->rtwmer_add_filter('ajax_query_attachments_args', $rtwmer_plugin_public, 'rtwmer_manager',  10, 1);

		$this->rtwmer_loader->rtwmer_add_filter('query_vars', $rtwmer_plugin_public, 'custom_endpoint',  10, 1);

		$this->rtwmer_loader->rtwmer_add_filter('list_cats', $rtwmer_plugin_public, 'rtwmer_category_list_filter', 10, 2);

		$this->rtwmer_loader->rtwmer_add_filter('woocommerce_product_tabs', $rtwmer_plugin_public,  'rtwmer_action_woocommerce_after_single_product_summary', 10, 3);

		$this->rtwmer_loader->rtwmer_add_filter('woocommerce_get_breadcrumb', $rtwmer_plugin_public,  'rtwmer_woocommerce_breadcrumb');

		$this->rtwmer_loader->rtwmer_add_action('wp_enqueue_scripts', $rtwmer_plugin_public, 'rtwmer_enqueue_styles', 999);

		$this->rtwmer_loader->rtwmer_add_action('wp_enqueue_scripts', $rtwmer_plugin_public, 'rtwmer_enqueue_scripts');

		$this->rtwmer_loader->rtwmer_add_action('wp_enqueue_scripts', $rtwmer_plugin_public, 'rtwmer_control_scripts',999);

		$this->rtwmer_loader->rtwmer_add_action('init', $rtwmer_plugin_public, 'rtwmer_rewrite_endpoints');

		$this->rtwmer_loader->rtwmer_add_action('admin_init', $rtwmer_plugin_public, 'rtwmer_restrict_vendors');

		$this->rtwmer_loader->rtwmer_add_action('wp', $rtwmer_plugin_public, 'rtwmer_views_update');

		$this->rtwmer_loader->rtwmer_add_action('woocommerce_product_meta_end', $rtwmer_plugin_public, 'rtwmer_vendor_reviews');

		$this->rtwmer_loader->rtwmer_add_action('woocommerce_register_form', $rtwmer_plugin_public, 'rtwmer_extra_register_fields', 10, 0);

		$this->rtwmer_loader->rtwmer_add_action('woocommerce_register_post', $rtwmer_plugin_public, 'rtwmer_validate_extra_register_fields', 10, 3);

		$this->rtwmer_loader->rtwmer_add_action('woocommerce_created_customer', $rtwmer_plugin_public, 'rtwmer_save_extra_register_fields');

		$this->rtwmer_loader->rtwmer_add_action('woocommerce_account_dashboard', $rtwmer_plugin_public, 'rtwmer_action_woocommerce_account_dashboard', 10, 0);



		// $this->rtwmer_loader->rtwmer_add_action('woocommerce_order_status_changed', $rtwmer_plugin_public, 'rtwmer_order_status_change_cb', 10, 3);

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_add_product_ajax', $rtwmer_plugin_public, 'add_product_ajax');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_add_product_ajax', $rtwmer_plugin_public, 'add_product_ajax');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_product_table', $rtwmer_plugin_public, 'rtwmer_product_table');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_product_table', $rtwmer_plugin_public, 'rtwmer_product_table');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_edit_product_ajax', $rtwmer_plugin_public, 'rtwmer_edit_product_ajax');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_edit_product_ajax', $rtwmer_plugin_public, 'rtwmer_edit_product_ajax');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_delete_product_ajax', $rtwmer_plugin_public, 'rtwmer_delete_product_ajax');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_delete_product_ajax', $rtwmer_plugin_public, 'rtwmer_delete_product_ajax');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_delete_product_bulk_ajax', $rtwmer_plugin_public, 'delete_product_bulk_ajax');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_delete_product_bulk_ajax', $rtwmer_plugin_public, 'delete_product_bulk_ajax');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_delete_permanently_product_ajax', $rtwmer_plugin_public, 'rtwmer_trash_delete_product');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_delete_permanently_product_ajax', $rtwmer_plugin_public, 'rtwmer_trash_delete_product');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_order_all_table', $rtwmer_plugin_public, 'rtwmer_order_all_datatable');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_order_all_table', $rtwmer_plugin_public, 'rtwmer_order_all_datatable');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_status_change_ajax', $rtwmer_plugin_public, 'status_change_ajax_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_status_change_ajax', $rtwmer_plugin_public, 'status_change_ajax_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_restore_prod_ajax', $rtwmer_plugin_public, 'restore_prod_ajax_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_restore_prod_ajax', $rtwmer_plugin_public, 'restore_prod_ajax_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_withdraw_request_ajax', $rtwmer_plugin_public, 'withdraw_request_ajax_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_withdraw_request_ajax', $rtwmer_plugin_public, 'withdraw_request_ajax_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_view_order_full_details', $rtwmer_plugin_public, 'order_full_details_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_view_order_full_details', $rtwmer_plugin_public, 'order_full_details_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_withdraw_all_table', $rtwmer_plugin_public, 'rtwmer_withdraw_all_table_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_withdraw_all_table', $rtwmer_plugin_public, 'rtwmer_withdraw_all_table_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_withdraw_request_cancel_ajax', $rtwmer_plugin_public, 'withdraw_request_cancel_ajax_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_withdraw_request_cancel_ajax', $rtwmer_plugin_public, 'withdraw_request_cancel_ajax_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_store_setting', $rtwmer_plugin_public, 'rtwmer_store_setting_callback');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_store_setting', $rtwmer_plugin_public, 'rtwmer_store_setting_callback');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_payment_ajax', $rtwmer_plugin_public, 'rtwmer_payment_ajax_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_payment_ajax', $rtwmer_plugin_public, 'rtwmer_payment_ajax_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_update_count', $rtwmer_plugin_public, 'rtwmer_update_count_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_update_count', $rtwmer_plugin_public, 'rtwmer_update_count_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_store_listing_preview', $rtwmer_plugin_public, 'rtwmer_store_listing_preview');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_store_listing_preview', $rtwmer_plugin_public, 'rtwmer_store_listing_preview');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_endpoint_email', $rtwmer_plugin_public, 'rtwmer_email_vendor');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_endpoint_email', $rtwmer_plugin_public, 'rtwmer_email_vendor');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_get_data', $rtwmer_plugin_public, 'rtwmer_get_data_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_get_data', $rtwmer_plugin_public, 'rtwmer_get_data_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_export_orders', $rtwmer_plugin_public, 'rtwmer_export_orders_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_export_orders', $rtwmer_plugin_public, 'rtwmer_export_orders_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwmer_search_reg_users', $rtwmer_plugin_public, 'rtwmer_search_reg_users_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwmer_search_reg_users', $rtwmer_plugin_public, 'rtwmer_search_reg_users_cb');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_check_if_sku_exists', $rtwmer_plugin_public, 'check_if_sku_exists');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_check_if_sku_exists', $rtwmer_plugin_public, 'check_if_sku_exists');

		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_rtwrre_withdraw_method_detail_ajax', $rtwmer_plugin_public, 'rtwrre_withdraw_method_detail_ajax_cb');
		$this->rtwmer_loader->rtwmer_add_action('wp_ajax_nopriv_rtwrre_withdraw_method_detail_ajax', $rtwmer_plugin_public, 'rtwrre_withdraw_method_detail_ajax_cb');

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'rtwmer_additon_prod_info/rtwmer_additional_prod_info.php' ) ) {
			// add extar tab on single product page
			$this->rtwmer_loader->rtwmer_add_action('woocommerce_product_tabs', $rtwmer_plugin_public, 'rtwmer_woo_custom_product_tabs');
			$this->rtwmer_loader->rtwmer_add_action( 'woocommerce_created_customer', $rtwmer_plugin_public, 'rtwmer_woocommerce_created_customer_admin_notification' );
		}

	}	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin on init.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function rtwmer_run()
	{
		$this->rtwmer_loader->rtwmer_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function rtwmer_get_plugin_name()
	{
		return $this->rtwmer_plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Mercado_Loader    Orchestrates the hooks of the plugin.
	 */
	public function rtwmer_get_loader()
	{
		return $this->rtwmer_loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function rtwmer_get_version()
	{
		return $this->rtwmer_version;
	}
}
