<?php

// This file Contains the code for splitting the taxes of order according to the vendor

$rtwmer_shipping  = $rtwmer_order_obj->get_items( 'rtwmer_shipping' );
$rtwmer_tax_total = 0;
if(!empty($rtwmer_products) && is_array($rtwmer_products)){
    foreach ( $rtwmer_products as $rtwmer_item ) {
        $rtwmer_tax_total += $rtwmer_item->get_total_tax();
    }
}
if(!empty($rtwmer_parent_order->get_taxes()) && is_array($rtwmer_parent_order->get_taxes())){
    foreach ( $rtwmer_parent_order->get_taxes() as $rtwmer_tax ) {
        $rtwmer_vendor_shipping = reset( $rtwmer_shipping );
        $rtwmer_item = new WC_Order_Item_Tax();
        $rtwmer_item->set_props( array(
            'rate_id'            => $rtwmer_tax->get_rate_id(),
            'label'              => $rtwmer_tax->get_label(),
            'compound'           => $rtwmer_tax->get_compound(),
            'rate_code'          => WC_Tax::get_rate_code( $rtwmer_tax->get_rate_id() ),
            'rtwmer_tax_total'          => $rtwmer_tax_total,
            'shipping_tax_total' => is_bool( $rtwmer_vendor_shipping ) ? '' : $rtwmer_vendor_shipping->get_total_tax()
        ) );
        $rtwmer_order_obj->add_item( $rtwmer_item );
    }
}
$rtwmer_order_obj->save();