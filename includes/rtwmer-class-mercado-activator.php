<?php

/**
 * Fired during plugin activation
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rtwmer_Mercado
 * @subpackage Rtwmer_Mercado/includes
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwmer_Mercado_Activator {


	/**
	 * Short Description. (use period)
	 *
	 * Long Description. 
	 *
	 * @since    1.0.0
	 */
	function rtwmer_activate() {

		$this->rtwmer_check_woocommerce_active();

	}

//=================Check wheather woocommerce is active or not?==================//

	function rtwmer_check_woocommerce_active()
	{
		if ( class_exists( 'WooCommerce' ) )
		{
			$this->rtwmer_vendor_dashboard_page();

			$this->rtwmer_vendor_store_page();

			$this->rtwmer_vendor_privacy_policy_page();
	
			$this->rtwmer_add_vendor_role();
	
			$this->rtwmer_add_usermeta();
	
			$this->rtwmer_add_cap_for_admin();
	
			$this->rtwmer_create_withdraw_table();
	
			$this->rtwmer_create_setup_page();

			do_action('rtwmer_mercado_activator_hook');
		}
		// else
		// {
		// 	// wp_die('hola');
		// 	exit(esc_html__('Woocommerce must be installed and activated for this plugin','rtwmer-mercado'));
		// }
	}

	
	//=========Function to add vendor dashboard page & Store page================//

	function rtwmer_vendor_dashboard_page() {
		
		if(!post_exists("Vendor Dashboard")){
			$rtwmer_create_dashboard_page = array(

				'post_title'    => wp_strip_all_tags( "Vendor Dashboard"),
				'post_content'  => '[Vendor_Dashboard]',
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type'     => 'page',
				
			);
			  
			$rtwmer_dashboard_page = wp_insert_post( $rtwmer_create_dashboard_page );
			if ( is_int($rtwmer_dashboard_page) ) 
			{
				$rtwmer_page_setting_option = get_option('rtwmer_page_setting',array());
				if ( !empty($rtwmer_page_setting_option) && isset($rtwmer_page_setting_option['rtwmer_page_setting_dashboard']) ) 
				{
					$rtwmer_page_setting_option['rtwmer_page_setting_dashboard'] = $rtwmer_dashboard_page;
					update_option('rtwmer_page_setting', $rtwmer_page_setting_option);
				}	
			}
		}
	}

	function rtwmer_vendor_store_page() {
		
		if(!post_exists("Vendor Store")){
			$rtwmer_create_dashboard_page = array(

				'post_title'    => wp_strip_all_tags( "Vendor Store"),
				'post_content'  => '[Vendor_Store]',
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type'     => 'page',
			);
			  
			$rtwmer_store_page = wp_insert_post( $rtwmer_create_dashboard_page );
			if ( is_int($rtwmer_store_page) ) 
			{
				$rtwmer_page_setting_option = get_option('rtwmer_page_setting',array());
				if ( !empty($rtwmer_page_setting_option) && isset($rtwmer_page_setting_option['rtwmer_page_store_listing']) ) 
				{
					$rtwmer_page_setting_option['rtwmer_page_store_listing'] = $rtwmer_store_page;
					update_option('rtwmer_page_setting', $rtwmer_page_setting_option);
				}	
			}
		}

	}

	function rtwmer_vendor_privacy_policy_page() {
		
		if(!post_exists("Store Privacy Policy")){
			$rtwmer_create_dashboard_page = array(

				'post_title'    => wp_strip_all_tags("Store Privacy Policy"),
				'post_content'  => esc_html__('Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our Mercado Privacy & Policy','rtwmer-mercado'),
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type'     => 'page',
			);
			  
			wp_insert_post( $rtwmer_create_dashboard_page );
		}

	}

//============= Function to add vendor role================================//

	function rtwmer_add_vendor_role() {
	
		remove_role( 'rtwmer_vendor' );
		add_role('rtwmer_vendor', 'Vendor', array(
			'read' => true,
			'publish_posts' => true,
			'edit_posts' => true,
			'manage_categories' => true,
			'upload_files' => true,
			'edit_shop_orders' => true,
			'edit_products' => true,
			'publish_products' => true,
			'manage_product_terms' => true,
			'edit_product_terms' => true,
			'assign_product_terms' => true,
			'delete_product_terms' => true,
			'mercador' => true,
		));

		do_action('rtwmer_mercado_add_vendor_role_to_wp');

	}

//========================Function to add usermeta for admin to show as a vendor========================//

	function rtwmer_add_usermeta() {

		$rtwmer_admin_usermata = get_users('role=administrator');

		if( isset($rtwmer_admin_usermata) && is_array($rtwmer_admin_usermata) )
		{
			foreach( $rtwmer_admin_usermata as $keys ) 
			{
				if( isset($keys) && isset($keys->ID) && isset($keys->user_email) )
				{
					$rtwmer_admins_id = $keys->ID;
		
					$rtwmer_admins_email = $keys->user_email;

					if( isset($rtwmer_admins_id) && isset($rtwmer_admins_email) )
					{
						update_user_meta( $rtwmer_admins_id,'rtwmer_email',$rtwmer_admins_email );
			
						update_user_meta( $rtwmer_admins_id,'rtwmer_store_name','(no name)' );
				
						update_user_meta( $rtwmer_admins_id,'rtwmer_vendor_status',0 );
				
						update_user_meta( $rtwmer_admins_id,'rtwmer_role','rtwmer_vendor' );
				
						update_user_meta( $rtwmer_admins_id, 'rtwmer_vendor_store_img', 0 );
				
						do_action('rtwmer_mercado_add_previous_admin_as_vendor');
					}
				}
			}
		}
	}

//===================Function to add extra capability for admin=============================//

	function rtwmer_add_cap_for_admin() {

		$rtwmer_add_cap_admin = get_role( 'administrator' );

		if( isset($rtwmer_add_cap_admin) && is_object($rtwmer_add_cap_admin) )
		{
			$rtwmer_add_cap_admin->add_cap('mercador');
			do_action('rtwmer_mercado_adding_extra_cap_to_admin_and_vendor');
		}

	}

//=====================function is used to create withdraw table into db================//	

	function rtwmer_create_withdraw_table() {

		global $wpdb;

		$table_name = $wpdb->prefix . "rtwmer_withdraw";

		$charset_collate = $wpdb->get_charset_collate();

		if( isset($table_name) && isset($charset_collate) )
		{
			$sql = "CREATE TABLE $table_name (
				id int(55) NOT NULL AUTO_INCREMENT,
				user_id int NOT NULL,
				rtwmer_vendor_store varchar(255),
				amount float NOT NULL,
				date timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
				modified_date timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
				status varchar(55),
				method varchar(155),
				rtwmer_vendor_email varchar(255),
				note text,
				payment_processed_stmt text,
				ip varchar(255) DEFAULT '' NOT NULL,
				PRIMARY KEY  (id)
			  ) $charset_collate;";
	
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			
			if( isset($sql) )
			{
				dbDelta( $sql );
			}
		}
	}

	//========================This Function is used to setup store page========================//
	
	function rtwmer_create_setup_page()
	{
		add_option('rtwmer_plugin_activated_for_store_setup','rtwmer_yes');
	}

}
