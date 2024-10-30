<?php

// This file contains the code for splitting the shipping of order according to the vendor

$rtwmer_shipping_method = $rtwmer_parent_order->get_shipping_methods();
$rtwmer_order_vendor_id  = $rtwmer_seller_id;
$applied_shipping_method = '';
if ($rtwmer_shipping_method && !empty($rtwmer_shipping_method)) {
    foreach ($rtwmer_shipping_method as $rtwmer_item_id => $rtwmer_shipping_obj) {
        $rtwmer_ship_vendor_id = wc_get_order_item_meta($rtwmer_item_id, 'seller_id', true);
        if ($rtwmer_order_vendor_id == $rtwmer_ship_vendor_id) {
            $applied_shipping_method = $rtwmer_shipping_obj;
            break;
        }
    }
}

$rtwmer_ship_mode = apply_filters('rtwmer_shipping_method', $applied_shipping_method, $rtwmer_order_obj->get_id(), $rtwmer_parent_order);

if (!$rtwmer_ship_mode) {
    return;
}

if (is_a($rtwmer_ship_mode, 'WC_Order_Item_Shipping')) {
    $rtwmer_item = new WC_Order_Item_Shipping();
    $rtwmer_metadata = $rtwmer_ship_mode->get_meta_data();
    if ($rtwmer_metadata && !empty($rtwmer_metadata)) {
        foreach ($rtwmer_metadata as $rtwmer_meta) {
            $rtwmer_item->add_meta_data($rtwmer_meta->rtwmer_keys, $rtwmer_meta->value);
        }
    }
    $rtwmer_item->set_props(array(
        'method_title' => $rtwmer_ship_mode->get_name(),
        'method_id'    => $rtwmer_ship_mode->get_method_id(),
        'total'        => $rtwmer_ship_mode->get_total(),
        'taxes'        => $rtwmer_ship_mode->get_taxes(),
    ));
    
    $rtwmer_order_obj->add_item($rtwmer_item);
    $rtwmer_order_obj->set_shipping_total($rtwmer_ship_mode->get_total());
    $rtwmer_order_obj->save();
}
