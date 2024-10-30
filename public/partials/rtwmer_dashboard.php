<?php
use Automattic\WooCommerce\Utilities\OrderUtil;
// This file contains the html for Vendor dashboard
global $rtwmer_user_id_for_dashboard;
// $prod = wc_get_products(109);
// echo '<pre>';
// print_r($prod);
// echo '</pre>';
// die('proddd');
$rtwmer_count = $this->rtwmer_count_function();
global $wpdb;

	if ( OrderUtil::custom_orders_table_usage_is_enabled() ) {
	// if(WC()->version > '8.2.0'){
		$query = "SELECT id FROM " . $wpdb->prefix . "wc_orders LEFT JOIN (SELECT order_id,
		MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_name
		FROM " . $wpdb->prefix . "wc_orders_meta GROUP BY order_id) rtw_selected_table ON " . $wpdb->prefix . "wc_orders.id= rtw_selected_table.order_id WHERE rtwmer_order_vendor_name IS NOT NULL AND rtwmer_order_vendor_name= %s AND ( status=%s OR status=%s)";
	}else{
		$query = "SELECT ID FROM " . $wpdb->prefix . "posts LEFT JOIN (SELECT post_id,
		MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor_name
		FROM " . $wpdb->prefix . "postmeta GROUP BY post_id) rtw_selected_table ON " . $wpdb->prefix . "posts.`ID`= rtw_selected_table.`post_id`WHERE rtwmer_order_vendor_name IS NOT NULL AND rtwmer_order_vendor_name='%s' AND ( post_status='%s' OR post_status='%s')";
	}

$rtwmer_order_pending_count = $wpdb->get_results($wpdb->prepare($query, $rtwmer_user_id_for_dashboard, 'wc-completed', 'wc-refunded'));

// -------------------------------for admin start-----------------------------
$admin_query = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wc_order_product_lookup");


$rtw_admin_total = 0;
$rtw_admin_order_total = 0;
foreach ($admin_query as $key => $value) {
	$rtw_admin_total += $value->product_net_revenue;
	$rtw_admin_order_total++;
}
// -------------------------------for admin end-----------------------------

foreach ($rtwmer_order_pending_count as $key => $value) {
	
	
	$query = "SELECT * FROM " . $wpdb->prefix . "wc_order_stats WHERE order_id=%d";
	if ( OrderUtil::custom_orders_table_usage_is_enabled() ) {
	// if(WC()->version > '8.2.0'){
		$rtwmer_order_stats_Array[] = $wpdb->get_results($wpdb->prepare($query, $value->id));
	}else{
		$rtwmer_order_stats_Array[] = $wpdb->get_results($wpdb->prepare($query, $value->ID));
	}
	
}
$rtwmer_total_sales = 0;
$rtwmer_order_count = 0;
$rtwmer_total_saves = 0;


if (!empty($rtwmer_order_stats_Array)) {
	foreach ($rtwmer_order_stats_Array as $key => $value) {
		if (isset($value) && !empty($value)) {
			if($value[0]->status != 'wc-refunded')
			{
				$rtwmer_total_sales = (float) $value[0]->net_total + (float) $rtwmer_total_sales;
				$rtwmer_price = (float) $value[0]->net_total;
				$rtwmer_author_id = $rtwmer_user_id_for_dashboard;
				$rtwmer_commision_val = $this->rtwmer_commission($rtwmer_author_id, (float) $value[0]->net_total);
				$rtwmer_total_saves = $rtwmer_commision_val[0] + $rtwmer_total_saves;
				$rtwmer_order_count++;
			}
		} else {
			$rtwmer_total_sales = 0;
			$rtwmer_total_saves = 0;
			$rtwmer_order_count = 0;
		}
	}
	$rtwmer_total_saves = $rtwmer_total_sales - $rtwmer_total_saves;
}
$args = array(
	'author'        => $rtwmer_user_id_for_dashboard,
	'orderby'       =>  'post_date',
	'order'         =>  'ASC',
	'posts_per_page' => -1,
	'post_type'        => 'product',
	'post_status'      => 'published',
);
$rtwmer_posts = get_posts($args);
if (!empty($rtwmer_posts) && is_array($rtwmer_posts)) {
	$rtwmer_total_view = '0';
	foreach ($rtwmer_posts as $key => $value) {
		$rtwmer_views_count = get_post_meta($value->ID, 'rtwmer_product_view_count', true);
		if ($rtwmer_views_count) {
			$rtwmer_total_view =  (int) $rtwmer_views_count + (int) $rtwmer_total_view;
			$rtwmer_all_view[$value->ID] = (int) $rtwmer_views_count;
		}
	}
}
if($this->rtwmer_user_can_access("rtwmer_sales_overview_cap")){
?>
<div class="rtwmer-card-section">
	<div class="mdc-layout-grid__inner">
		<div class="mdc-layout-grid__cell mdc-card rtwmer_tot_card1 rtwmer-price-cards rtwmer-sales-card">
			<div class="inner-padding ">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
					<?php if($rtwmer_user_id_for_dashboard == 1){
						echo (isset($rtw_admin_total) && !empty($rtw_admin_total)) ? wc_price($rtw_admin_total) : wc_price(0); 	
					}else{
						echo (isset($rtwmer_total_sales) && !empty($rtwmer_total_sales)) ? wc_price($rtwmer_total_sales) : wc_price(0); 	
					}
					
					?>
					</div>
					<div class="rtwmer-progress">
						<div class="rtwmer-progress-bar rtwmer_tot_progress_bar rtwmer_progress1" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text rtwmer-sales-text">
					<p><?php esc_html_e("Total Sales", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
		<div class="mdc-layout-grid__cell mdc-card rtwmer_tot_card2 rtwmer-price-cards  rtwmer-saving-card">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
					<?php
					if($rtwmer_user_id_for_dashboard == 1){
						
					}else{
						echo (isset($rtwmer_total_saves) && !empty($rtwmer_total_saves)) ? wc_price($rtwmer_total_saves) : wc_price(0); 
					}
					
					?>
					</div>
					<div class="rtwmer-progress">
						<div class="rtwmer-progress-bar rtwmer_tot_progress_bar rtwmer_progress2" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text rtwmer-sales-text">
					<p><?php esc_html_e("Total Savings", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
		<div class="mdc-layout-grid__cell mdc-card rtwmer_tot_card3 rtwmer-price-cards  rtwmer-order-total-card">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
					<?php
					if($rtwmer_user_id_for_dashboard == 1){
						$rtwmer_temp_var = (isset($rtw_admin_order_total) && !empty($rtw_admin_order_total)) ? $rtw_admin_order_total : 0;
						esc_html_e($rtw_admin_order_total,"rtwmer-mercado");
					}else{
						$rtwmer_temp_var = (isset($rtwmer_order_count) && !empty($rtwmer_order_count)) ? $rtwmer_order_count : 0;
						esc_html_e($rtwmer_temp_var,"rtwmer-mercado");
					}
					
					?></div>
					<div class="rtwmer-progress">
						<div class="rtwmer-progress-bar rtwmer_tot_progress_bar rtwmer_progress3" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text rtwmer-sales-text">
					<p><?php esc_html_e("Total Orders", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
 } 
?>
<div class="rtwmer-chart-wrapper">
 <?php  
 if($this->rtwmer_user_can_access("rtwmer_order_chart_cap")){
 ?>
	<div class="mdc-elevation--z9 rtwmer-order-chart-container">
		<div id="rtwmer-chart-circle">
		<canvas id="rtwmer_order_chart"></canvas>
		</div>
	</div>
	<?php 
 }
 if($this->rtwmer_user_can_access("rtwmer_product_no_chart_cap")){
	?>
	<div class="mdc-elevation--z9 rtwmer_prod_sales_chart_box">
		<canvas id="rtwmer_prod_sales_chart"></canvas>
	</div>
	<?php } ?>
</div>
<?php 
	if($this->rtwmer_user_can_access("rtwmer_sales_chart_cap")){
?>
<div class="mdc-layout-grid mdc-card rtwmer-card-section">
		<canvas id="rtwmer_sales_chart"></canvas>
</div>
	<?php }
	if($this->rtwmer_user_can_access("rtwmer_order_details_cap")){
	?>
<div class=" mdc-layout-grid mdc-card rtwmer-card-section">
	<h2 class="rtwmer-card-header"><?php esc_html_e("Order  Details","rtwmer-mercado") ?>  </h2>
	<div class="mdc-layout-grid__inner">
		<div class="mdc-layout-grid__cell rtwmer-demo-cell rtwmer_order_card1 mdc-card rtwmer-orders-cards">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
					<?php $rtwmer_temp_var = isset($rtwmer_count['rtwmer_order_count_array']['rtwmer_order_complete_count']) ? $rtwmer_count['rtwmer_order_count_array']['rtwmer_order_complete_count'] : 0;
					esc_html_e($rtwmer_temp_var,"rtwmer-mercado");
					?></div>
					<div class="rtwmer-progress">
					<div class="rtwmer-progress-bar rtwmer_orders_progress_bar rtwmer_progress4" id="rtwmer_completed_orders_progress" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total completed order of vendor", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
		<div class="mdc-layout-grid__cell rtwmer-demo-cell rtwmer_order_card2 mdc-card rtwmer-orders-cards rtwmer-order-card-2">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
						<?php $rtwmer_temp_var = isset($rtwmer_count['rtwmer_order_count_array']['rtwmer_order_processing_count']) ? $rtwmer_count['rtwmer_order_count_array']['rtwmer_order_processing_count'] : 0;
						esc_html_e($rtwmer_temp_var,"rtwmer-mercado"); ?>
					</div>
					<div class="rtwmer-progress">
					<div class="rtwmer-progress-bar rtwmer_orders_progress_bar rtwmer_progress5" id="rtwmer_process_orders_progress" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total processing order of vendor", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
		<div class="mdc-layout-grid__cell rtwmer-demo-cell rtwmer_order_card3 mdc-card rtwmer-orders-cards rtwmer-order-card-3">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
						<?php $rtwmer_temp_var = isset($rtwmer_count['rtwmer_order_count_array']['rtwmer_order_on_hold_count']) ? $rtwmer_count['rtwmer_order_count_array']['rtwmer_order_on_hold_count'] : 0 ; 
						esc_html_e($rtwmer_temp_var,"rtwmer-mercado");
						?>
					</div>
					<div class="rtwmer-progress">
					<div class="rtwmer-progress-bar rtwmer_orders_progress_bar rtwmer_progress7" id="rtwmer_on_hold_orders_progress" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total on-hold order  of vendor", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
		<div class="mdc-layout-grid__cell rtwmer-demo-cell rtwmer_order_card4 mdc-card rtwmer-orders-cards rtwmer-order-card-4">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
					<?php $rtwmer_temp_var = isset($rtwmer_count['rtwmer_order_count_array']['rtwmer_order_pending_count']) ? $rtwmer_count['rtwmer_order_count_array']['rtwmer_order_pending_count'] : 0; 
					esc_html_e($rtwmer_temp_var,"rtwmer-mercado") ?></div>
					<div class="rtwmer-progress">
					<div class="rtwmer-progress-bar rtwmer_orders_progress_bar rtwmer_progress8" id="rtwmer_pending_orders_progress" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total pending order  of vendor", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
}
if($this->rtwmer_user_can_access("rtwmer_product_details_cap")){
?>
<div class=" mdc-layout-grid rtwmer-card-section mdc-card">
	<h2 class="rtwmer-card-header"><?php esc_html_e("Product Details","rtwmer-mercado") ?> </h2>
	<div class="mdc-layout-grid__inner">
		<div class="mdc-layout-grid__cell rtwmer_prod_card1  mdc-card rtwmer-prdct-cards ">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
					<?php $rtwmer_temp_var = (isset($rtwmer_total_view) && !empty($rtwmer_total_view)) ? $rtwmer_total_view : 0;
					esc_html_e($rtwmer_temp_var,"rtwmer-mercado"); ?>
					</div>
					<div class="rtwmer-progress">
						<div class="rtwmer-progress-bar rtwmer_prod_progress_bar" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total views of all products", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
		<div class="mdc-layout-grid__cell rtwmer_prod_card2  mdc-card rtwmer-prdct-cards rtwmer-prdct-card-2">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
						<?php
						 $rtwmer_temp_var =  isset($rtwmer_count['rtwmer_prod_count_array']['rtwmer_prod_publish_count']) ? $rtwmer_count['rtwmer_prod_count_array']['rtwmer_prod_publish_count'] : 0; 
						esc_html_e($rtwmer_temp_var,"rtwmer-mercado");
						?>
					</div>
					<div class="rtwmer-progress">
						<div class="rtwmer-progress-bar rtwmer_prod_progress_bar rtwmer_progress9" id="rtwmer_published_product_progress" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total published products of vendor", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
		<div class="mdc-layout-grid__cell rtwmer_prod_card3  mdc-card rtwmer-prdct-cards rtwmer-prdct-card-3">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
						<?php
						 $rtwmer_temp_var_var = isset($rtwmer_count['rtwmer_prod_count_array']['rtwmer_prod_pending_count']) ? $rtwmer_count['rtwmer_prod_count_array']['rtwmer_prod_pending_count'] : 0; 
						esc_html_e($rtwmer_temp_var_var);
						?>
					</div>
					<div class="rtwmer-progress">
						<div class="rtwmer-progress-bar rtwmer_prod_progress_bar rtwmer_progress10" id="rtwmer_pending_prod_progress" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total pending products of vendor", "rtwmer-mercado") ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  
}
 if($this->rtwmer_user_can_access("rtwmer_withdraw_details_cap")){
 ?>
<div class=" mdc-layout-grid mdc-card rtwmer-withdra-card">
	<h2 class="rtwmer-card-header"><?php esc_html_e(" Withdraw  Details ","rtwmer-mercado") ?></h2>
	<div class="mdc-layout-grid__inner">
		<div class="mdc-layout-grid__cell rtwmer_withdraw_card1 rtwmer-withdraw-cell mdc-card rtwmer-withdraw-cards">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number"><?php $rtwmer_temp_var = isset($rtwmer_count['rtwmer_withdraw_count_array']['rtwmer_withdraw_pending_count']) ? $rtwmer_count['rtwmer_withdraw_count_array']['rtwmer_withdraw_pending_count']: 0; 
					esc_html_e($rtwmer_temp_var ,"rtwmer-mercado");
					?></div>
					<div class="rtwmer-progress">
						<div class="rtwmer-progress-bar rtwmer_withdraw_progress_bar rtwmer_progress11" id="rtwmer_pend_withdraw_progress" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total pending withdraw request of vendor","rtwmer-mercado"); ?></p>
				</div>
			</div>
		</div>
		<div class="mdc-layout-grid__cell rtwmer_withdraw_card2 rtwmer-withdraw-cell  mdc-card rtwmer-withdraw-cards rtwmer-withdraw-card-2">
			<div class="inner-padding">
				<div class="rtwmer-card-progress-wrapper-row">
					<div class="rtwmer-card-number">
					<?php $rtwmer_temp_var = isset($rtwmer_count['rtwmer_withdraw_count_array']['rtwmer_withdraw_approved_count']) ? $rtwmer_count['rtwmer_withdraw_count_array']['rtwmer_withdraw_approved_count'] : 0; 
					esc_html_e($rtwmer_temp_var,"rtwmer-mercado");
					?>
					</div>
					<div class="rtwmer-progress">
						<div class="rtwmer-progress-bar rtwmer_withdraw_progress_bar rtwmer_progress12" id="rtwmer_approved_withdraw_progress" role="progressbar"></div>
					</div>
				</div>
				<div class="rtwmer-card-text">
					<p><?php esc_html_e("Total approved withdraw request of vendor","rtwmer-mercado"); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
 }
do_action("rtwmer_dashboard_extra_fields");
?>