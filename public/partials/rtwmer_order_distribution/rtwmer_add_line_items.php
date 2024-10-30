<?php

// This file contains the code for the adding the line item in suborders


if(!empty($rtwmer_products) && is_array($rtwmer_products)){
    foreach ( $rtwmer_products as $rtwmer_units ) {
        $rtwmer_prod_units = new WC_Order_Item_Product(); 
        $rtwmer_metadata = $rtwmer_units->get_meta_data();
        if ( $rtwmer_metadata ) {
            foreach ( $rtwmer_metadata as $rtwmer_meta ) {
                $rtwmer_prod_units->add_meta_data( $rtwmer_meta->rtwmer_keys, $rtwmer_meta->value );
            }
        }
        $rtwmer_prod_units->set_quantity( $rtwmer_units->get_quantity() );
        $rtwmer_prod_units->set_total( $rtwmer_units->get_total() );
        $rtwmer_prod_units->set_product_id( $rtwmer_units->get_product_id() );
        $rtwmer_prod_units->set_variation_id( $rtwmer_units->get_variation_id() );
        $rtwmer_prod_units->set_taxes( $rtwmer_units->get_taxes() );
        $rtwmer_prod_units->set_subtotal( $rtwmer_units->get_subtotal() );
        $rtwmer_prod_units->set_subtotal_tax( $rtwmer_units->get_subtotal_tax() );
        $rtwmer_prod_units->set_total_tax( $rtwmer_units->get_total_tax() ); 
        $rtwmer_prod_units->set_tax_class( $rtwmer_units->get_tax_class() );
        $rtwmer_prod_units->set_name( $rtwmer_units->get_name() );
        
        $rtwmer_order_obj->add_item( $rtwmer_prod_units );
    }
} 
$rtwmer_order_obj->save();