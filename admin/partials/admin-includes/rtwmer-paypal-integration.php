<?php 

/** This file contains code of php which used for integration of paypal */

    class Rtwmer_Paypal_Gateway{

        private $rtwmer_withdraw_method;
        private $rtwmer_withdraw_user;
        private $rtwmer_withdraw_amount;
        private $rtwmer_withdraw_id;
        private $rtwmer_paypal_client_id;
        private $rtwmer_paypal_secret_key;
        private $rtwmer_api_url;
        private $rtwmer_token_url;
        private $rtwmer_vendor_paypal_email;


        function rtwmer_process_payment($rtwmer_withdraw_method,$rtwmer_withdraw_user,$rtwmer_withdraw_amount,$rtwmer_withdraw_id)
        {
            if( $rtwmer_withdraw_method == 'paypal' )
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
            if( !empty(get_option('rtwmer_payment_gateway')) )
            {
                $rtwmer_withdraw_option_data = get_option('rtwmer_payment_gateway');
                
                if(is_array($rtwmer_withdraw_option_data) && !empty($rtwmer_withdraw_option_data) )
                {
                    if(isset($rtwmer_withdraw_option_data['rtwmer_withdraw_paypal']))
                    {
                        $rtwmer_withdraw_paypal  = $rtwmer_withdraw_option_data['rtwmer_withdraw_paypal'];
                    }
                    if( isset($rtwmer_withdraw_option_data['rtwmer_paypal_client_id']) )
                    {
                        $this->rtwmer_paypal_client_id  = $rtwmer_withdraw_option_data['rtwmer_paypal_client_id'];
                    }
                    if( isset($rtwmer_withdraw_option_data['rtwmer_paypal_secret_key']) )
                    {
                        $this->rtwmer_paypal_secret_key  = $rtwmer_withdraw_option_data['rtwmer_paypal_secret_key'];
                    }
                    if( isset($rtwmer_withdraw_option_data['rtwmer_withdraw_paypal_test_box']) )
                    {
                        $rtwmer_withdraw_paypal_test_box  = $rtwmer_withdraw_option_data['rtwmer_withdraw_paypal_test_box'];
                    }
                    if( isset($rtwmer_withdraw_paypal) && !empty($rtwmer_withdraw_paypal) && ($rtwmer_withdraw_paypal == 1) )
                    {
                        if( isset($this->rtwmer_paypal_client_id) && !empty($this->rtwmer_paypal_client_id) && isset($this->rtwmer_paypal_secret_key) && !empty($this->rtwmer_paypal_secret_key) )
                        {
                            $this->rtwmer_api_url = 'https://api.paypal.com/v1/payments/payouts';
                            $this->rtwmer_token_url = 'https://api.paypal.com/v1/oauth2/token';
    
                            if( isset($rtwmer_withdraw_paypal_test_box) && !empty($rtwmer_withdraw_paypal_test_box) && ($rtwmer_withdraw_paypal_test_box == 1) )
                            {
                                $this->rtwmer_api_url = 'https://api.sandbox.paypal.com/v1/payments/payouts';
                                $this->rtwmer_token_url = 'https://api.sandbox.paypal.com/v1/oauth2/token';
                            }
                            $this->rtwmer_vendor_paypal_email = get_user_meta($this->rtwmer_withdraw_user,'rtwmer_vendor_paypal_email',true);
                            
                            if( isset($this->rtwmer_vendor_paypal_email) && !empty($this->rtwmer_vendor_paypal_email) )
                            {
                                $this->rtwmer_generate_access_token();
                                $rtwmer_payment_return =  $this->rtwmer_process_paypal_payment();
                                return $rtwmer_payment_return;
                            }
                            else
                            {
                                return('Please ask vendor to update his email address as mentioned in paypal to receive payment');
                            }
                        }
                        else
                        {
                            return('Please Configure PayPal to Send Payment to Vendors');
                        }
                    }
                    else
                    {
                        return('Please Enable PayPal from setting to Send Payment to Vendors');
                    }
                }
            }
        }

        function rtwmer_generate_access_token()
        {
            $rtwmer_curl = curl_init();
            curl_setopt($rtwmer_curl, CURLOPT_HEADER, false);
            curl_setopt($rtwmer_curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Accept-Language: en_US'));
            curl_setopt($rtwmer_curl, CURLOPT_VERBOSE, 1);
            curl_setopt($rtwmer_curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($rtwmer_curl, CURLOPT_URL, $this->rtwmer_token_url);
            curl_setopt($rtwmer_curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($rtwmer_curl, CURLOPT_USERPWD, $this->rtwmer_paypal_client_id . ':' . $this->rtwmer_paypal_secret_key);
            curl_setopt($rtwmer_curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
            curl_setopt($rtwmer_curl, CURLOPT_SSLVERSION, 6);
            $rtwmer_curl_response = curl_exec($rtwmer_curl);
            curl_close($rtwmer_curl);
            $rtwmer_curl_response_array = json_decode($rtwmer_curl_response, true);
            $this->rtwmer_access_token = isset($rtwmer_curl_response_array['access_token']) ? $rtwmer_curl_response_array['access_token'] : '';
            $this->rtwmer_token_type = isset($rtwmer_curl_response_array['token_type']) ? $rtwmer_curl_response_array['token_type'] : '';
        }

        function rtwmer_process_paypal_payment()
        {
            $rtwmer_currency = get_woocommerce_currency();
            $rtwmer_api_authorization = "Authorization: {$this->rtwmer_token_type} {$this->rtwmer_access_token}";
            $rtwmer_paypal_note = sprintf( __('Payment recieved from %1$s as selling at %2$s on %3$s', 'rtwmer-mercado'), get_bloginfo('name'), date('H:i:s'), date('d-m-Y'));
            $rtwmer_request_params = '{
                                        "sender_batch_header": {
                                                "sender_batch_id":"' . uniqid() . '",
                                                "email_subject": "Payment Received",
                                                "recipient_type": "EMAIL"
                                        },
                                        "items": [
                                            {
                                                "recipient_type": "EMAIL",
                                                "amount": {
                                                    "value": ' . $this->rtwmer_withdraw_amount . ',
                                                    "currency": "' . $rtwmer_currency . '"
                                                },
                                                "receiver": "' . $this->rtwmer_vendor_paypal_email . '",
                                                "note": "' . $rtwmer_paypal_note . '",
                                                "sender_item_id": "' . $this->rtwmer_withdraw_user . '"
                                            }
                                        ]
                                    }';
                                    $rtwmer_curl = curl_init();
                                    curl_setopt($rtwmer_curl, CURLOPT_HEADER, false);
                                    curl_setopt($rtwmer_curl, CURLOPT_HTTPHEADER, array('Content-type:application/json', $rtwmer_api_authorization));
                                    curl_setopt($rtwmer_curl, CURLOPT_VERBOSE, 1);
                                    curl_setopt($rtwmer_curl, CURLOPT_TIMEOUT, 30);
                                    curl_setopt($rtwmer_curl, CURLOPT_URL, $this->rtwmer_api_url);
                                    curl_setopt($rtwmer_curl, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($rtwmer_curl, CURLOPT_POSTFIELDS, $rtwmer_request_params);
                                    curl_setopt($rtwmer_curl, CURLOPT_SSLVERSION, 6);
                                    $rtwmer_result = curl_exec($rtwmer_curl);
                                    curl_close($rtwmer_curl);
                                    $rtwmer_result_array = json_decode($rtwmer_result, true);
                                    $rtwmer_batch_status = $rtwmer_result_array['batch_header']['batch_status'];
    
                                    $rtwmer_payout_status = apply_filters('rtwmer_paypal_done_status', array('PENDING', 'PROCESSING', 'SUCCESS', 'NEW'));
                                    
                                    if(in_array($rtwmer_batch_status, $rtwmer_payout_status) )
                                    {
                                        $rtwmer_payment_processed_array = array(
                                            'rtwmer_payment_made_via' => 'paypal',
                                            'rtwmer_withdraw_amount' => $this->rtwmer_withdraw_amount,
                                            'rtwmer_receiver_email' => $this->rtwmer_vendor_paypal_email,
                                            'rtwmer_payment_currency' => $rtwmer_currency,
                                            'rtwmer_payout_batch_id' => $rtwmer_result_array['batch_header']['payout_batch_id'],
                                            'rtwmer_payout_batch_status' => $rtwmer_batch_status,
                                            'rtwmer_sender_batch_id' => $rtwmer_result_array['batch_header']['sender_batch_header']['sender_batch_id'],
                                        );
        
                                        global $wpdb;
        
                                        $rtwmer_withdraw_query = "UPDATE ".$wpdb->prefix."rtwmer_withdraw SET payment_processed_stmt=%s WHERE `id`=%d";
        
                                        $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,json_encode($rtwmer_payment_processed_array),$this->rtwmer_withdraw_status_id ));
        
                                        return('done');
                                    }
                                    else
                                    {
                                        return('Some Error Occurred');
                                    }
        }

    }

?>
