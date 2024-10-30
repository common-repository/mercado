<?php 

/** This file contains code of php which used for integration of bank transfer */

    class Rtwmer_Bank_Transfer{

        function rtwmer_process_payment($rtwmer_withdraw_method,$rtwmer_withdraw_user,$rtwmer_withdraw_amount,$rtwmer_withdraw_id)
        {
            if( $rtwmer_withdraw_method == 'bank_transfer' )
            {
                $rtwmer_currency = get_woocommerce_currency();
                
                $rtwmer_payment_processed_array = array(
                    'rtwmer_payment_made_via' => 'bank_transfer',
                    'rtwmer_withdraw_amount' => $rtwmer_withdraw_amount,
                    'rtwmer_payment_currency' => $rtwmer_currency
                );
                
                global $wpdb;
                
                $rtwmer_withdraw_query = "UPDATE ".$wpdb->prefix."rtwmer_withdraw SET payment_processed_stmt=%s WHERE `id`=%d";
                
                $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,json_encode($rtwmer_payment_processed_array),$rtwmer_withdraw_id ));
                
                return 'done';
                
            }
        }

    }

?>