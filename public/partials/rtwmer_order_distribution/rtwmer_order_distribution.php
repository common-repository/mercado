<?php


// This file contains the code for Splitting the order into suborder for vendors

$rtwmer_billing = WC()->countries->get_address_fields(WC()->countries->get_base_country(), 'billing_');
$rtwmer_shipping = WC()->countries->get_address_fields(WC()->countries->get_base_country(), 'shipping_');

$rtwmer_billing_and_shipping = array_merge(array_keys($rtwmer_billing),array_keys($rtwmer_shipping));


$rtwmer_order_obj = new WC_Order();
if(is_object($rtwmer_order_obj)){
    foreach ( $rtwmer_billing_and_shipping as $rtwmer_keys ) {
        if ( is_callable( array( $rtwmer_order_obj, "set_{$rtwmer_keys}" ) ) ) {
            $rtwmer_order_obj->{"set_{$rtwmer_keys}"}( $rtwmer_parent_order->{"get_{$rtwmer_keys}"}() );
        }
    }

    $this->rtwmer_add_line_items( $rtwmer_order_obj, $rtwmer_seller_products );
    $this->rtwmer_add_taxes( $rtwmer_order_obj, $rtwmer_parent_order, $rtwmer_seller_products );
    $this->rtwmer_add_coupons( $rtwmer_order_obj, $rtwmer_parent_order, $rtwmer_seller_products );
    $rtwmer_order_obj->set_created_via( 'rtwmer' );
    $rtwmer_order_obj->update_meta_data( 'rtwmer_order_vendor', $rtwmer_seller_id );
    $rtwmer_commision_val = $class->rtwmer_commission($rtwmer_seller_id,$rtwmer_order_obj->get_total());
    $rtwmer_order_obj->update_meta_data( 'rtwmer_admin_order_commision_for_vendor', $rtwmer_commision_val[0] );
    $rtwmer_order_obj->set_cart_hash( $rtwmer_parent_order->get_cart_hash() );
    $rtwmer_order_obj->set_customer_id( $rtwmer_parent_order->get_customer_id() );
    $rtwmer_order_obj->set_customer_note( $rtwmer_parent_order->get_customer_note() );
    $rtwmer_order_obj->set_prices_include_tax( $rtwmer_parent_order->get_prices_include_tax() );
    $rtwmer_order_obj->set_status( "wc-on-hold" );
    $rtwmer_order_obj->set_customer_user_agent( $rtwmer_parent_order->get_customer_user_agent() );
    $rtwmer_order_obj->set_customer_ip_address( $rtwmer_parent_order->get_customer_ip_address() );
    $rtwmer_order_obj->set_payment_method( $rtwmer_parent_order->get_payment_method() );
    $rtwmer_order_obj->set_payment_method_title( $rtwmer_parent_order->get_payment_method_title() );
    $rtwmer_order_obj->set_currency( $rtwmer_parent_order->get_currency() );
    $rtwmer_order_obj->calculate_totals();
    $rtwmer_price = $rtwmer_order_obj->get_total();
    $rtwmer_order_obj->set_parent_id( $rtwmer_parent_order->get_id() );
    $rtwmer_sub_id= $rtwmer_order_obj->get_id();
    $rtwmer_my_post = array(
        'ID'           =>  $rtwmer_sub_id,
        'post_author'   => $rtwmer_seller_id,
    );
    wp_update_post($rtwmer_my_post, true);
    $rtwmer_order_id = $rtwmer_order_obj->save();
    wc_update_total_sales_counts( $rtwmer_order_id );
    $this->rtwmer_add_shipping( $rtwmer_order_obj, $rtwmer_parent_order,$rtwmer_seller_id );
    do_action('rtwmer_commission_value_created',$rtwmer_order_obj,$rtwmer_commision_val[0],$rtwmer_price);
    do_action('rtwmer_vendor_balance_statement',$rtwmer_order_obj,$rtwmer_seller_id);
}else{
    return;
}