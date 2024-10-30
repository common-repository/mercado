<?php 

use Stripe\Stripe;
use Stripe\Transfer;

/** This file contains code of php which used for integration of stripe */

    class Rtwmer_Stripe_Gateway{

        private $rtwmer_withdraw_method;
        private $rtwmer_withdraw_user;
        private $rtwmer_withdraw_amount;
        private $rtwmer_withdraw_id;
        private $rtwmer_stripe_client_id;
        private $rtwmer_stripe_secret_key;
        private $rtwmer_stripe_publishable_key;
        private $rtwmer_api_url;
        private $rtwmer_token_url;
        private $rtwmer_vendor_paypal_email;

        function rtwmer_process_payment($rtwmer_withdraw_method,$rtwmer_withdraw_user,$rtwmer_withdraw_amount,$rtwmer_withdraw_id)
        {
            if( $rtwmer_withdraw_method == 'stripe' )
            {
                $this->rtwmer_withdraw_method = $rtwmer_withdraw_method;
                $this->rtwmer_withdraw_user = $rtwmer_withdraw_user;
                $this->rtwmer_withdraw_amount = $rtwmer_withdraw_amount;
                $this->rtwmer_withdraw_id = $rtwmer_withdraw_id;
                $rtwmer_validate_return = $this->rtwmer_validate_request();
                return $rtwmer_validate_return;
            }
        }

        function rtwmer_validate_request()
        {
            if( !empty(get_option('rtwmer_payment_gateway')))
            {
                $rtwmer_withdraw_option_data = get_option('rtwmer_payment_gateway');
                
                if(is_array($rtwmer_withdraw_option_data) && !empty($rtwmer_withdraw_option_data) )
                {
                    if(isset($rtwmer_withdraw_option_data['rtwmer_withdraw_stripe']) )
                    {
                        $rtwmer_withdraw_stripe  = $rtwmer_withdraw_option_data['rtwmer_withdraw_stripe'];
                    }
                    if( isset($rtwmer_withdraw_option_data['rtwmer_stripe_client_id']) )
                    {
                        $this->rtwmer_stripe_client_id  = $rtwmer_withdraw_option_data['rtwmer_stripe_client_id'];
                    }
                    if( isset($rtwmer_withdraw_option_data['rtwmer_stripe_secret_key']) )
                    {
                        $this->rtwmer_stripe_secret_key  = $rtwmer_withdraw_option_data['rtwmer_stripe_secret_key'];
                    }
                    if( isset($rtwmer_withdraw_option_data['rtwmer_withdraw_stripe_test_box']) )
                    {
                        $rtwmer_withdraw_stripe_test_box  = $rtwmer_withdraw_option_data['rtwmer_withdraw_stripe_test_box'];
                    }
                    if( isset($rtwmer_withdraw_option_data['rtwmer_stripe_publishable_key']) )
                    {
                        $this->rtwmer_stripe_publishable_key  = $rtwmer_withdraw_option_data['rtwmer_stripe_publishable_key'];
                    }
                    if( isset($rtwmer_withdraw_stripe) && !empty($rtwmer_withdraw_stripe) && ($rtwmer_withdraw_stripe == 1) )
                    {
                        if( isset($this->rtwmer_stripe_client_id) && !empty($this->rtwmer_stripe_client_id) && isset($this->rtwmer_stripe_secret_key) && !empty($this->rtwmer_stripe_secret_key) && isset($this->rtwmer_stripe_publishable_key) && !empty($this->rtwmer_stripe_publishable_key) )
                        {
                            if( isset($rtwmer_withdraw_stripe_test_box) && !empty($rtwmer_withdraw_stripe_test_box) && ($rtwmer_withdraw_stripe_test_box == 1) )
                            {
                                $rtwmer_stripe_test_mode = 'true';
                            }
                            
                            $this->rtwmer_vendor_stripe_id = get_user_meta($this->rtwmer_withdraw_user,'rtwmer_vendor_stripe_id',true);
                            
                            if( isset($this->rtwmer_vendor_stripe_id) && !empty($this->rtwmer_vendor_stripe_id) )
                            {
                                $rtwmer_generate_return = $this->rtwmer_stripe_payment_process();
                                
                                return $rtwmer_generate_return;
                            }
                            else
                            {
                                return('Please ask vendor to update his stripe id as mentioned in Stripe to receive payment');
                            }
                        }
                        else
                        {
                            return('Please Configure Stripe to Send Payment to Vendors');
                        }
                    }
                    else
                    {
                        return('Please Enable Stripe from setting to Send Payment to Vendors');
                    }
                }
            }
        }
    
        function rtwmer_stripe_payment_process()
        {
            if( !class_exists("Stripe\Stripe") ) {
                require_once( RTWMER_ASSETS.'/sdk/Stripe/init.php');
            }

            Stripe::setApiKey($this->rtwmer_stripe_secret_key);

            $this->rtwmer_currency = get_woocommerce_currency();
            
                try {
                    Stripe::setApiKey($this->rtwmer_stripe_secret_key);
        
                    $rtwmer_transfer_args = array(
                            'amount'              => $this->rtwmer_calculate_stripe_amount($this->rtwmer_currency,$this->rtwmer_withdraw_amount),
                            'currency'            => $this->rtwmer_currency,
                            'destination'         => $this->rtwmer_vendor_stripe_id,
                            'description'         => esc_html__('Payout for withdrawal ID #', 'rtwmer-mercado') . sprintf( '%06u', $this->rtwmer_withdraw_id )
                    );
        
                    $rtwmer_transfer = Transfer::create($rtwmer_transfer_args);
                    $result_array = $rtwmer_transfer->jsonSerialize();
        
                    $rtwmer_payment_processed_array = array(
                        'rtwmer_payment_made_via' => 'stripe',
                        'rtwmer_withdraw_amount' => $this->rtwmer_withdraw_amount,
                        'rtwmer_payment_currency' => $this->rtwmer_currency,
                        'rtwmer_transaction_id' => $result_array['id'],
                        'rtwmer_sender_batch_id' => $result_array['balance_transaction'],
                    );
        
                    global $wpdb;
        
                    $rtwmer_withdraw_query = "UPDATE ".$wpdb->prefix."rtwmer_withdraw SET payment_processed_stmt=%s WHERE `id`=%d";
        
                    $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,json_encode($rtwmer_payment_processed_array),$this->rtwmer_withdraw_id ));
        
                    $rtwmer_stripe_response = 'done';
        
                } catch (\Stripe\Error\InvalidRequest $e) {
                    $rtwmer_stripe_response = sprintf( 'Failed : %s', $e->getMessage() );
                    
                } catch (\Stripe\Error\Authentication $e) {
                    $rtwmer_stripe_response = sprintf( 'Failed : %s', $e->getMessage() );
                    
                } catch (\Stripe\Error\ApiConnection $e) {
                    $rtwmer_stripe_response = sprintf( 'Failed : %s', $e->getMessage() );
        
                } catch (\Stripe\Error\Base $e) {
                    $rtwmer_stripe_response = sprintf( 'Failed : %s', $e->getMessage() );
        
                } catch (Exception $e) {
                    $rtwmer_stripe_response = sprintf( 'Failed : %s', $e->getMessage() );
                }
            
            return $rtwmer_stripe_response;
        }

        function rtwmer_calculate_stripe_amount() {

            switch( strtoupper( $this->rtwmer_currency ) ) {
                
                case 'BIF' :
                case 'CLP' :
                case 'DJF' :
                case 'GNF' :
                case 'JPY' :
                case 'KMF' :
                case 'KRW' :
                case 'MGA' :
                case 'PYG' :
                case 'RWF' :
                case 'VND' :
                case 'VUV' :
                case 'XAF' :
                case 'XOF' :
                case 'XPF' :
                    $rtwmer_amount_to_be_paid = absint( $this->rtwmer_withdraw_amount );
                    break;
                default :
                    $rtwmer_amount_to_be_paid = round( $this->rtwmer_withdraw_amount, 2 ) * 100;
                    break;
            }
            return $rtwmer_amount_to_be_paid;
        }

    }

?>