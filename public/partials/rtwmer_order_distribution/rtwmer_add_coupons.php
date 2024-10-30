<?php

// This file has the function for adding coupon to the suborder

$rtwmer_redeemed_vouchers = $rtwmer_parent_order->get_items( 'coupon' );
$rtwmer_product_ids = array_map( function( $rtwmer_item ) {
    return $rtwmer_item->get_product_id();
}, $rtwmer_products );
if ( ! $rtwmer_redeemed_vouchers ) {
    return;
}
if(!empty($rtwmer_redeemed_vouchers) && (is_array($rtwmer_redeemed_vouchers)  ||  is_object($rtwmer_redeemed_vouchers))){
    foreach ( $rtwmer_redeemed_vouchers as $rtwmer_item ) {
    $rtwmer_coupon = new WC_Coupon( $rtwmer_item->get_code() );  
        if ( $rtwmer_coupon && !is_wp_error( $rtwmer_coupon ) && array_intersect( $rtwmer_product_ids, $rtwmer_coupon->get_product_ids() ) ) {
            $rtwmer_new_item = new WC_Order_Item_Coupon();
            $rtwmer_new_item->set_props( array(
                'code'         => $rtwmer_item->get_code(),
                'discount'     => $rtwmer_item->get_discount(),
                'discount_tax' => $rtwmer_item->get_discount_tax(),
            ) );
            $rtwmer_new_item->add_meta_data( 'coupon_data', $rtwmer_coupon->get_data() );
            $rtwmer_order_obj->add_item( $rtwmer_new_item );
        }
    }
} 

$rtwmer_order_obj->save();