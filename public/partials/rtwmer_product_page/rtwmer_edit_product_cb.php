<?php 

// This file contains the code for edit product

if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
	/* for default image */
	$plugins_url = plugins_url();
	$my_plugin_dir = $plugins_url . '/mercado';
	$src    =    $my_plugin_dir."/assets/images/image_not_available.jpg";

	/* for default image end */

	
	$rtwmer_edit_product_ID = sanitize_text_field($_POST['rtwmer_data_ID']);
	$rtwmer_product_data = wc_get_product($rtwmer_edit_product_ID);
	$rtwmer_temp_attach_id =  $rtwmer_product_data->get_image_id();
	if(wp_get_attachment_image_src($rtwmer_temp_attach_id)){
		$rtwmer_temp_attach_src = wp_get_attachment_image_src($rtwmer_temp_attach_id)[0];
	}else{
		$rtwmer_temp_attach_src = "";
		
	}
	$rtwmer_temp_name  =  $rtwmer_product_data->get_name();
	$rtwmer_temp_reg_price  =  $rtwmer_product_data->get_regular_price();
	$rtwmer_temp_sale_price  =  $rtwmer_product_data->get_sale_price();
	$rtwmer_temp_cat  =  $rtwmer_product_data->get_category_ids();
	$rtwmer_temp_tag  =  $rtwmer_product_data->get_tag_ids();
	$rtwmer_temp_desc   =  $rtwmer_product_data->get_description();
	$rtwmer_temp_short_desc = $rtwmer_product_data->get_short_description();
	$rtwmer_temp_sku = $rtwmer_product_data->get_sku();
	$rtwmer_is_downloadable = $rtwmer_product_data->get_downloadable();
	$rtwmer_temp_downloadable = $rtwmer_product_data->get_downloads();
	$rtwmer_temp_stock_status = $rtwmer_product_data->get_stock_status();
	$rtwmer_down_name = array();
	$rtwmer_down_path = array();
	$rtwmer_down_id = array();
	global $wpdb;
	$wp_query = "SELECT ID FROM $wpdb->posts WHERE guid='%s'";
	if(!empty($rtwmer_temp_downloadable) && is_array($rtwmer_temp_downloadable)){
		foreach ($rtwmer_temp_downloadable as $key => $value) {
			$attachment = $wpdb->get_col($wpdb->prepare($wp_query, $value->get_file() ));
			$attachment = (!empty($attachment))? $attachment[0]: 0;
			$rtwmer_down_name[] = array($value->get_name(),$value->get_file(),$attachment);
		}
	}
	$rtwmer_prod_array = array(
		'temp_src' => $src,
		'temp_attach_id' => $rtwmer_temp_attach_id,
		'temp_name' => esc_html__($rtwmer_temp_name,"rtwmer-mercado"),
		'temp_reg_price' => esc_html__($rtwmer_temp_reg_price,"rtwmer-mercado"), 
		'temp_sale_price' => esc_html__($rtwmer_temp_sale_price,"rtwmer-mercado"),
		'temp_cat' => $rtwmer_temp_cat,
		'rtwmer_temp_tag'	=>	$rtwmer_temp_tag,
		'temp_desc' => esc_html__($rtwmer_temp_desc,"rtwmer-mercado"),
		'temp_short_desc' => esc_html__($rtwmer_temp_short_desc,"rtwmer-mercado"),
		'temp_sku' => esc_html__($rtwmer_temp_sku,"rtwmer-mercado"),
		'temp_stock_status' =>  esc_html__($rtwmer_temp_stock_status,"rtwmer-mercado"),
		'temp_attach_src' =>  $rtwmer_temp_attach_src,
		'rtwmer_temp_downloadable' =>  $rtwmer_down_name,
		'rtwmer_extra_note' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_extra_note' , true ),
		'rtwmer_other_details' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_other_details' , true ),
		'rtwmer_excluded' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_excluded' , true ),
		'rtwmer_included' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_included' , true ),
		'rtwmer_days' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_days' , true ),
		'rtwmer_weather' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_weather' , true ),
		'rtwmer_tour_leader' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_tour_leader' , true ),
		'rtwmer_start_date' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_start_date' , true ),
		'rtwmer_end_date' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_end_date' , true ),
		'rtwmer_experience' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_experience' , true ),
		'rtwmer_duration' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_duration' , true ),
		'rtwmer_destination_include' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_destination_include' , true ),
		'rtwmer_days_and_desc' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_days_and_desc',true ),
		'rtwmer_timeto_visit' => get_post_meta( $rtwmer_edit_product_ID, '_rtwmer_timeto_visit' , true ),
	);
	$rtwmer_detail_array = apply_filters("rtwmer_vendor_edit_request",$rtwmer_prod_array,$rtwmer_edit_product_ID);
	echo json_encode($rtwmer_detail_array);
}
wp_die();
