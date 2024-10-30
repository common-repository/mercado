<?php


// This file contains the code for making product trash


if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
    if (isset($_POST) && !empty($_POST)) {   
        if(isset($_POST['rtwmer_prod_ID'])){
            $rtwmer_product_ID=sanitize_text_field(intval($_POST['rtwmer_prod_ID']));
        $rtwmer_status  =  wp_trash_post( $rtwmer_product_ID );
        $rtwmer_counter  =    $this->rtwmer_count_function();
        if (!empty($rtwmer_status)) {
            echo json_encode("Trashed successfully");
        }
    }
        wp_die();
    }
}
wp_die();
