<?php 

/**This File contains methods of payment gateways and thier initial class */

class Rtwmer_Payment_Gateways
{

    public function __construct() {

        include_once(RTWMER_ADMIN_PARTIAL.'admin-includes/rtwmer-paypal-integration.php');
        include_once(RTWMER_ADMIN_PARTIAL.'admin-includes/rtwmer-stripe-integration.php');
        include_once(RTWMER_ADMIN_PARTIAL.'admin-includes/rtwmer-bank-transfer.php');
        do_action('rtwmer_load_payment_classes');
    }
    
    public function rtwmer_load_avail_method($rtwmer_withdraw_approve_method,$rtwmer_withdraw_approve_user,$rtwmer_withdraw_approve_amount,$rtwmer_withdraw_status_id)
    {
        $rtwmer_load_gateways = array(
            'paypal' => 'Rtwmer_Paypal_Gateway',
            'stripe' => 'Rtwmer_Stripe_Gateway',
            'bank_transfer' => 'Rtwmer_Bank_Transfer'
        );

        $rtwmer_load_gateways = apply_filters( 'rtwmer_add_custom_payment_gateways', $rtwmer_load_gateways );
        foreach ( $rtwmer_load_gateways as $rtwmer_gate_key => $rtwmer_gateway ) {
			if (is_string( $rtwmer_gateway ) && $rtwmer_gate_key == $rtwmer_withdraw_approve_method && class_exists( $rtwmer_gateway ) ) {
                $rtwmer_gateway = new $rtwmer_gateway();
                $rtwmer_return_msg = $rtwmer_gateway->rtwmer_process_payment($rtwmer_withdraw_approve_method,$rtwmer_withdraw_approve_user,$rtwmer_withdraw_approve_amount,$rtwmer_withdraw_status_id);
                if( isset($rtwmer_return_msg) && !empty($rtwmer_return_msg) )
                {
                    return $rtwmer_return_msg;
                }
            }
        }
    }
}


?>