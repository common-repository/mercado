
<?php

// This file contains all the translations string which will used in JS

$rtwmer_options = get_option("rtwmer_page_setting");
if (isset($rtwmer_options['rtwmer_page_setting_dashboard'])) {
    $rtwmer_dashboard_url = $rtwmer_options['rtwmer_page_setting_dashboard'];
    $rtwmer_dashboard_url = get_permalink($rtwmer_dashboard_url);
}else{
    $rtwmer_dashboard_url = "";
}
$rtwmer_mercado_default_loader = apply_filters("rtwmer_mercado_default_loader",RTWMER_PUBLIC_IMAGES_URL."rtwmer_loader.gif");

$rtwmer_genral_option = get_option("rtwmer_general_setting");
$rtwmer_show_customer_details = 	(isset($rtwmer_genral_option["rtwmer_hide_cust_info_form_order"]))
			?	(int) $rtwmer_genral_option["rtwmer_hide_cust_info_form_order"]	:	0;

$rtwmer_mercado_lite = array(
    "rtwmer_select_img"                                 => esc_html__("Select a image to upload", "rtwmer-mercado"),
    "rtwmer_use_this_img"                               => esc_html__("Use this image", "rtwmer-mercado"),
    "rtwmer_all"                                        => esc_html__("All", "rtwmer-mercado"),
    "rtwmer_complete"                                   => esc_html__("Completed", "rtwmer-mercado"),
    "rtwmer_online"                                     => esc_html__("Online", "rtwmer-mercado"),
    "rtwmer_pending"                                    => esc_html__("Pending", "rtwmer-mercado"),
    "rtwmer_trash"                                      => esc_html__("Trash", "rtwmer-mercado"),
    "rtwmer_processing"                                 => esc_html__("Processing", "rtwmer-mercado"),
    "rtwmer_on_hold"                                    => esc_html__("On-hold", "rtwmer-mercado"),
    "rtwmer_pending"                                    => esc_html__('Pending', "rtwmer-mercado"),
    "rtwmer_cancelled"                                  => esc_html__("Cancelled", "rtwmer-mercado"),
    "rtwmer_refunded"                                   => esc_html__("Refunded", "rtwmer-mercado"),
    "rtwmer_failed"                                     => esc_html__("Failed", "rtwmer-mercado"),
    "rtwmer_withdraw_req"                               => esc_html__("Withdraw Request", "rtwmer-mercado"),
    "rtwmer_approved_req"                               => esc_html__("Approved Requests", "rtwmer-mercado"),
    "rtwmer_cancelled_req"                              => esc_html__("Cancelled Requests", "rtwmer-mercado"),
    "rtwmer_success"                                    => esc_html__("Successful", "rtwmer-mercado"),
    "rtwmer_unsuccessfull"                              => esc_html__("Unsuccessfull", "rtwmer-mercado"),
    "rtwmer_prod_deleted"                               => esc_html__("Products have been deleted", "rtwmer-mercado"),
    "rtwmer_select_file"                                => esc_html__("Select a file to upload", "rtwmer-mercado"),
    "rtwmer_use_file"                                   => esc_html__("Use this file", "rtwmer-mercado"),
    "rtwmer_delete"                                     => esc_html__("Delete", "rtwmer-mercado"),
    "rtwmer_sku_exist"                                  => esc_html__("Sku already exists", "rtwmer-mercado"),
    "rtwmer_enter_prod_name"                            => esc_html__("Please enter product name", "rtwmer-mercado"),
    "rtwmer_reg_should_great"                           => esc_html__("Sale Price should be less than regular price", "rtwmer-mercado"),
    "rtwmer_trash_warning"                              => esc_html__("Are you sure you want to trash it?", "rtwmer-mercado"),
    "rtwmer_trash_success"                              => esc_html__("Trashed successfully", "rtwmer-mercado"),
    "rtwmer_delete_success"                             => esc_html__("Deleted successfully", "rtwmer-mercado"),
    "rtwmer_restore_success"                            => esc_html__("Restore successfully", "rtwmer-mercado"),
    "rtwmer_sent_successfull"                           => esc_html__("Sent Successfully", "rtwmer-mercado"),
    "rtwmer_try_again"                                  => esc_html__("Try Again!!", "rtwmer-mercado"),
    "rtwmer_total_sales"                                => esc_html__("Total Sales", "rtwmer-mercado"),
    "rtwmer_total_order"                                => esc_html__('Total Order', "rtwmer-mercado"),
    "rtwmer_total_sales_this_month"                     => esc_html__('Total sales this months', "rtwmer-mercado"),
    "rtwmer_select_state"                               => esc_html__("Select a state", "rtwmer-mercado"),
    "rtwmer_for_reg_customer"                           => esc_html__("Filter for registered customer", "rtwmer-mercado"),
    "rtwmer_total_order"                                => esc_html__("Total Completed Orders","rtwmer-mercado"),
    "rtwmer_order"                                      => esc_html__("Orders","rtwmer-mercado"),
    "rtwmer_search"                                     => esc_html__("Search","rtwmer-mercado"),
    "rtwmer_select_payment"                             => esc_html__("Select a Payment Method","rtwmer-mercado"),
    "rtwmer_select_cat"                             => esc_html__("Select Category","rtwmer-mercado"),
    "rtwmer_change_banner"                             =>  esc_html__("Change Banner","rtwmer-mercado"),
    "rtwmer_upload_banner"                             =>  esc_html__("Upload Banner","rtwmer-mercado"),
    "rtwmer_change_profile"                             =>  esc_html__("Change Profile","rtwmer-mercado"),
    "rtwmer_upload_profile"                             =>  esc_html__("Upload Profile","rtwmer-mercado"),
     "rtwmer_file_name"                             =>  esc_html__("Name","rtwmer-mercado"),
     "rtwmer_file_url"                             =>  esc_html__("URL","rtwmer-mercado"),
     "rtwmer_select_tag"                             =>  esc_html__("Select tags","rtwmer-mercado"),
     "rtwmer_remove"                                    =>  esc_html__("Remove","rtwmer-mercado"),
     "rtwmer_no_order_found"                            =>  esc_html__("No order found","rtwmer-mercado"),
     "rtwmer_no_prod_sales_found"                            =>  esc_html__("No Product is selled yet","rtwmer-mercado"),
     "rtwmer_loader_gif"                                => esc_url($rtwmer_mercado_default_loader),
     "rtwmer_dashboard_url"                             =>  $rtwmer_dashboard_url,
     'rtwmer_show_customer_details'                     =>   $rtwmer_show_customer_details,
);


return $rtwmer_mercado_lite; 
