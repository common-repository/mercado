<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.redefiningtheweb.com
 * @since             1.0.0
 * @package           Rtwmer_Mercado
 *
 * @wordpress-plugin
 * Plugin Name:       Mercado Lite - Revolutionize Your eCommerce Store into Multifaceted Sales Platform
 * Plugin URI:        www.redefiningtheweb.com/plugins/
 * Description:       Turn your Woocommerce into MultiVendor MarketPlace, A Woocommerce Extension, which convert your store into a Multivendor Marketplace.
 * Version:           2.1.8
 * Author:            RedefiningTheWeb
 * Author URI:        www.redefiningtheweb.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rtwmer-mercado
 * Domain Path:       /languages
 * WC requires at least: 4.2.0
 * WC tested up to: 9.3.3
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Currently plugin version.rtwmer_run_mercado
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
if ( ! defined( 'RTWMER_MERCADO_VERSION' ) ) {
define( 'RTWMER_MERCADO_VERSION', '2.1.8' );
}

function rtwwpge_check_run_allows()
{
	$rtwwpge_pro_status = true;

		if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			$rtwwpge_pro_status = false;
		}
	
	return $rtwwpge_pro_status;
}

	if(rtwwpge_check_run_allows() != true){
	
		function rtwwpge_error_notice()
		{
		?>
			<div class="error notice is-dismissible">
				<p id="rtwwpge_act_error">
					<?php esc_html_e('In order to activate and use the Mercado plugin', 'rtwmer-mercado'); ?>

					<strong><a target="_blank" href="<?php echo esc_url("https://wordpress.org/plugins/woocommerce/"); ?>"><?php esc_html_e('"WooCommerce"', 'WooCommerce') ?></a></strong>


					<?php esc_html_e('must be installed and activated. Please install and activate WooCommerce to proceed.', 'rtwmer-mercado'); ?>

					<!-- <p><?php _e('In order to activate and use the Mercado plugin, WooCommerce must be installed and activated. Please install and activate WooCommerce to proceed.', 'your-plugin-textdomain'); ?></p> -->


				</p>
			</div>
			<style type="text/css">
				#message {
					display: none;
				}

				#rtwwpge_act_error a {
					text-decoration: none;
				}
			</style>
		<?php
		}

		/**
		 * Deactivate the plugin if Elementor or PDFMentor lite plugin is not installed/active
		 * @since 1.0.0
		 */
		function rtwwpge_deactivate_wordpress_pdf_generator_for_elementor()
		{
			require_once(ABSPATH . 'wp-admin/includes/plugin.php');
			deactivate_plugins(plugin_basename(__FILE__));
			add_action('admin_notices', 'rtwwpge_error_notice');
		}
		add_action('admin_init', 'rtwwpge_deactivate_wordpress_pdf_generator_for_elementor');
	}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/rtwmer-class-mercado-activator.php
 */
function rtwmer_activate_mercado() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/rtwmer-class-mercado-activator.php';
	$rtwmer_mercado_activator = new Rtwmer_Mercado_Activator();
	$rtwmer_mercado_activator->rtwmer_activate();}

 /**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/rtwmer-class-mercado-deactivator.php
 */

register_activation_hook( __FILE__, 'rtwmer_activate_mercado' );/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

//Plugin Constant
function rtwmer_constants(){
	if( ! defined('RTWMER_DIR')){
		define('RTWMER_DIR', plugin_dir_path( __FILE__ ) );
	}
	if( ! defined('RTWMER_ADMIN_PARTIAL')){
		define('RTWMER_ADMIN_PARTIAL', plugin_dir_path( __FILE__ ).'admin/partials/' );
	}
	if( ! defined('RTWMER_ADMIN_PARTIAL_MENU')){
		define('RTWMER_ADMIN_PARTIAL_MENU', plugin_dir_path( __FILE__ ).'admin/partials/menu/' );
	}
	if( ! defined('RTWMER_ADMIN_PARTIAL_SUBMENU')){
		define('RTWMER_ADMIN_PARTIAL_SUBMENU', plugin_dir_path( __FILE__ ).'admin/partials/sub-menu/' );
	}
	if( ! defined('RTWMER_URL')){
		define('RTWMER_URL', plugin_dir_url( __FILE__ ) );
	}
	if( ! defined('RTWMER_ADMIN_PARTIAL_MENU_URL')){
		define('RTWMER_ADMIN_PARTIAL_MENU_URL', plugin_dir_url( __FILE__ ).'admin/partials/menu/' );
		// Custom Code code for plugin update with Woocommerce HPOS
		add_action( 'before_woocommerce_init', function() {
			if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
				\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
			}
		} );
		/// HPOS end
	}
	if( ! defined('RTWMER_HOME')){
		define('RTWMER_HOME', home_url() );
	}
	if( ! defined('RTWMER_ASSETS')){
		define('RTWMER_ASSETS', plugin_dir_path( __FILE__ ).'assets' );
	}
	if( ! defined('RTWMER_ASSETS_URL')){
		define('RTWMER_ASSETS_URL', plugin_dir_url( __FILE__ ).'assets' );
	}

	if( ! defined('RTWMER_PUBLIC_PARTIAL')){
		define('RTWMER_PUBLIC_PARTIAL', plugin_dir_path( __FILE__ ).'public/partials/' );
	}

	if( ! defined('RTWMER_PUBLIC_ORDER_DISTRIBUTION')){
		define('RTWMER_PUBLIC_ORDER_DISTRIBUTION', plugin_dir_path( __FILE__ ).'public/partials/rtwmer_order_distribution/' );
	}

	if( ! defined('RTWMER_PUBLIC_PARTIAL_URL')){
		define('RTWMER_PUBLIC_PARTIAL_URL', plugin_dir_url( __FILE__ ).'public/partials/' );
	}

	if( ! defined('RTWMER_PUBLIC_IMAGES')){
		define('RTWMER_PUBLIC_IMAGES', plugin_dir_path( __FILE__ ).'public/images/' );
	}

	if( ! defined('RTWMER_PUBLIC_IMAGES_URL')){
		define('RTWMER_PUBLIC_IMAGES_URL', plugin_dir_url( __FILE__ ).'public/images/' );
	}
	if( ! defined('RTWMER_ASSETS_COMMON_JS')){
		define('RTWMER_ASSETS_COMMON_JS', plugin_dir_url( __FILE__ ).'assets/common-js/' );
	}
	if( ! defined('RTWMER_ASSETS_BUNDLE_JS')){
		define('RTWMER_ASSETS_BUNDLE_JS', plugin_dir_url( __FILE__ ).'assets/bundle/' );
	}
	if( ! defined('RTWMER_ASSETS_COMMON_CSS')){
		define('RTWMER_ASSETS_COMMON_CSS', plugin_dir_url( __FILE__ ).'assets/common-css/' );
	}
	if( ! defined('RTWMER_ASSETS_NICESCROLL')){
		define('RTWMER_ASSETS_NICESCROLL', plugin_dir_url( __FILE__ ).'assets/nicescroll/' );
	}
}

rtwmer_constants();
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
require plugin_dir_path( __FILE__ ) . 'includes/rtwmer-class-mercado.php';

function rtwmer_run_mercado() {

	$plugin = new Rtwmer_Mercado();
	$plugin->rtwmer_run();

}

rtwmer_run_mercado();