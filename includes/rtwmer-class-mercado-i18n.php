<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/includes
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwmer_Mercado_i18n {	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function rtwmer_load_plugin_textdomain() {

		load_plugin_textdomain(
			'rtwmer-mercado',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
