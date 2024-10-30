<?php 

//========================This File is used to withdraw table functionality========================//

    if( (isset($_POST['rtwmer_withdraw_status']) && !empty($_POST['rtwmer_withdraw_status']) ) && (isset($_POST['rtwmer_withdraw_status_id']) && !empty($_POST['rtwmer_withdraw_status_id'])) )
    {
        $rtwmer_withdraw_status = sanitize_text_field($_POST['rtwmer_withdraw_status']);
        $rtwmer_withdraw_status_id = sanitize_text_field($_POST['rtwmer_withdraw_status_id']);
        if( (isset($rtwmer_withdraw_status) && !empty($rtwmer_withdraw_status)) && (isset($rtwmer_withdraw_status_id) && !empty($rtwmer_withdraw_status_id)) )
        {
            global $wpdb;
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';
            // die('jdfasdfjf');
            
            if( $rtwmer_withdraw_status == 'delete' )
            {
                $rtwmer_withdraw_query = "DELETE FROM ".$wpdb->prefix."rtwmer_withdraw WHERE `id`=%d";
                $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,$rtwmer_withdraw_status_id ));
                do_action('rtwmer_withdraw_delete_request');
                echo json_encode(1);
                wp_die();
            }
            else if( $rtwmer_withdraw_status == 'add_note' )
            {
                if( isset($_POST['rtwmer_withdraw_add_note_msg']) )
                {
                    $rtwmer_withdraw_query = "UPDATE ".$wpdb->prefix."rtwmer_withdraw SET note=%s WHERE id=%d";
                    $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,sanitize_text_field($_POST['rtwmer_withdraw_add_note_msg']),$rtwmer_withdraw_status_id ));
                }
                do_action('rtwmer_withdraw_add_note_request');
                echo json_encode(1);
                wp_die();
            }
            else if( $rtwmer_withdraw_status == 'approved' )
            {
                $rtwmer_withdraw_query = "SELECT user_id,amount,method FROM ".$wpdb->prefix."rtwmer_withdraw WHERE id=%d";
                $rtwmer_withdraw_approve_data = $wpdb->get_results($wpdb->prepare($rtwmer_withdraw_query,$rtwmer_withdraw_status_id));
                // echo '<pre>';
                // print_r($rtwmer_withdraw_approve_data);
                // echo '</pre>';
                // die('mejto');
                
                if( isset($rtwmer_withdraw_approve_data) && is_array($rtwmer_withdraw_approve_data) )
                {
                    if( isset($rtwmer_withdraw_approve_data[0]) )
                    {
                        if( is_object($rtwmer_withdraw_approve_data[0]) && isset($rtwmer_withdraw_approve_data[0]->user_id) && isset($rtwmer_withdraw_approve_data[0]->amount) && isset($rtwmer_withdraw_approve_data[0]->method) )
                        {
                            $rtwmer_withdraw_approve_user = $rtwmer_withdraw_approve_data[0]->user_id;
                            $rtwmer_withdraw_approve_amount = $rtwmer_withdraw_approve_data[0]->amount;
                            $rtwmer_withdraw_approve_method = $rtwmer_withdraw_approve_data[0]->method;
                           
                            if(empty($rtwmer_withdraw_approve_method)){
                                echo json_encode('Payment method not selected');
                                wp_die();
                            }
                            
                            if( isset($rtwmer_withdraw_approve_user) && isset($rtwmer_withdraw_approve_amount) && isset($rtwmer_withdraw_approve_method) )
                            {
                                $rtwmer_vendor_amount = get_user_meta($rtwmer_withdraw_approve_user,'rtwmer_total_amount',true);
                                
                                if( isset($rtwmer_vendor_amount) && !empty($rtwmer_vendor_amount) )
                                {
                                    $rtwmer_withdraw_approve_amount = round($rtwmer_withdraw_approve_amount,2);

                                    if( $rtwmer_vendor_amount >= $rtwmer_withdraw_approve_amount )
                                    {
                                        require_once(RTWMER_ADMIN_PARTIAL.'admin-includes/rtwmer-load-payment-method.php');

                                        $rtwmer_payment_obj = new Rtwmer_Payment_Gateways;
                                        $rtwmer_payement_msg = $rtwmer_payment_obj->rtwmer_load_avail_method($rtwmer_withdraw_approve_method,$rtwmer_withdraw_approve_user,$rtwmer_withdraw_approve_amount,$rtwmer_withdraw_status_id);

                                        // echo '<pre>';
                                        // print_r($rtwmer_payement_msg);
                                        // echo '</pre>';
                                        // die('mejto');

                                        if($rtwmer_payement_msg == 'done')
                                        {
                                            $rtwmer_withdraw_query = "UPDATE ".$wpdb->prefix."rtwmer_withdraw SET status=%s, modified_date=%s WHERE `id`=%d";
                                            
                                            $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,$rtwmer_withdraw_status, date("Y-m-d H:i:s"), $rtwmer_withdraw_status_id ));
                                            
                                            do_action('rtwmer_withdraw_stmt_for_vand',$rtwmer_withdraw_status_id,$rtwmer_withdraw_status);
                                            
                                            update_user_meta( $rtwmer_withdraw_approve_user,'rtwmer_total_amount',($rtwmer_vendor_amount - $rtwmer_withdraw_approve_amount) );
                                            
                                            echo json_encode(1);
                                            wp_die();
                                        }
                                        else
                                        {
                                            echo json_encode($rtwmer_payement_msg);
                                            wp_die();
                                        }
                                    }
                                    else
                                    {
                                        echo json_encode(esc_html__('withdrawl Amount should be greater than Vendor balance'),'rtwmer-mercado');
                                        wp_die();
                                    }
                                    do_action('rtwmer_withdraw_approve_request');
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                $rtwmer_withdraw_query = "UPDATE ".$wpdb->prefix."rtwmer_withdraw SET status=%s, modified_date=%s WHERE `id`=%d";
                $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,$rtwmer_withdraw_status, date("Y-m-d H:i:s"), $rtwmer_withdraw_status_id ));
                do_action('rtwmer_withdraw_stmt_for_vand',$rtwmer_withdraw_status_id,$rtwmer_withdraw_status);
                echo json_encode(1);
                wp_die();
            }
        }
    }

    // Code goes when request come for bulk action
    
    // $_POST['rtwmer_withdraw_status_id_array'] hold array

    if( (isset($_POST['rtwmer_withdraw_status']) && !empty($_POST['rtwmer_withdraw_status']) ) && (isset($_POST['rtwmer_withdraw_status_id_array']) && !empty($_POST['rtwmer_withdraw_status_id_array'])) )
    {
        $rtwmer_withdraw_status = sanitize_text_field($_POST['rtwmer_withdraw_status']);
        $rtwmer_withdraw_status_id = $_POST['rtwmer_withdraw_status_id_array'];     
       
        if( (isset($rtwmer_withdraw_status) && !empty($rtwmer_withdraw_status)) && (isset($rtwmer_withdraw_status_id) && is_array($rtwmer_withdraw_status_id)) )
        {
            foreach($rtwmer_withdraw_status_id as $id)
            {
                global $wpdb;

                if( $rtwmer_withdraw_status == 'delete' )
                {
                    $rtwmer_withdraw_query = "DELETE FROM ".$wpdb->prefix."rtwmer_withdraw WHERE `id`=%d";
                    $wpdb->get_var($wpdb->prepare($rtwmer_withdraw_query,$id));
                    do_action('rtwmer_withdraw_delete_request');
                }
                else if( $rtwmer_withdraw_status == 'approved' )
                {
                    $rtwmer_withdraw_query = "SELECT user_id,amount,method FROM ".$wpdb->prefix."rtwmer_withdraw WHERE id=%d";
                    $rtwmer_withdraw_approve_data = $wpdb->get_results($wpdb->prepare($rtwmer_withdraw_query,$id));

                    if( isset($rtwmer_withdraw_approve_data) && is_array($rtwmer_withdraw_approve_data) )
                    {
                        if( isset($rtwmer_withdraw_approve_data[0]) )
                        {
                            if( is_object($rtwmer_withdraw_approve_data[0]) && isset($rtwmer_withdraw_approve_data[0]->user_id) && isset($rtwmer_withdraw_approve_data[0]->amount) && isset($rtwmer_withdraw_approve_data[0]->method) )
                            {
                                $rtwmer_withdraw_approve_user = $rtwmer_withdraw_approve_data[0]->user_id;
                                $rtwmer_withdraw_approve_amount = $rtwmer_withdraw_approve_data[0]->amount;
                                $rtwmer_withdraw_approve_method = $rtwmer_withdraw_approve_data[0]->method;

                                if( isset($rtwmer_withdraw_approve_user) && isset($rtwmer_withdraw_approve_amount) && isset
                                ($rtwmer_withdraw_approve_method) )
                                {
                                    $rtwmer_withdraw_approve_amount = round($rtwmer_withdraw_approve_amount,2);
                                    
                                    $rtwmer_vendor_amount = get_user_meta($rtwmer_withdraw_approve_user,'rtwmer_total_amount',true);

                                    if( isset($rtwmer_vendor_amount) && !empty($rtwmer_vendor_amount) )
                                    {
                                        if( $rtwmer_vendor_amount > $rtwmer_withdraw_approve_amount )
                                        {
                                            require_once(RTWMER_ADMIN_PARTIAL.'admin-includes/rtwmer-load-payment-method.php');                             
                                            $rtwmer_payment_obj = new Rtwmer_Payment_Gateways;
                                            $rtwmer_payement_msg = $rtwmer_payment_obj->rtwmer_load_avail_method($rtwmer_withdraw_approve_method,$rtwmer_withdraw_approve_user,$rtwmer_withdraw_approve_amount,$id);

                                            if( $rtwmer_payement_msg == 'done')
                                            {
                                                $rtwmer_withdraw_query = "UPDATE ".$wpdb->prefix."rtwmer_withdraw SET status=%s, modified_date=%s WHERE `id`=%d";
                                                
                                                $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,$rtwmer_withdraw_status,date("Y-m-d H:i:s"),$id ));
    
                                                update_user_meta( $rtwmer_withdraw_approve_user,'rtwmer_total_amount',($rtwmer_vendor_amount - $rtwmer_withdraw_approve_amount) );
    
                                                do_action('rtwmer_withdraw_stmt_for_vand',$id,$rtwmer_withdraw_status);
                                            }
                                            else
                                            {
                                                $rtwmer_withdraw_error = $rtwmer_payement_msg;
                                            }
                                        }
                                        else
                                        {
                                            $rtwmer_withdraw_error = esc_html__('Only sufficient requests are accepted else are neglected','rtwmer-mercado');
                                        }
                                        do_action('rtwmer_withdraw_approve_request');
                                    }
                                }
                            }
                        }
                    }
                }
                else
                {
                    $rtwmer_withdraw_query = "UPDATE ".$wpdb->prefix."rtwmer_withdraw SET status=%s, modified_date=%s WHERE `id`=%d";                        
                    $wpdb->get_var($wpdb->prepare( $rtwmer_withdraw_query,$rtwmer_withdraw_status,date("Y-m-d H:i:s"),$id ));
                    do_action('rtwmer_withdraw_stmt_for_vand',$id,$rtwmer_withdraw_status);
                }
            }
            
            if( isset($rtwmer_withdraw_error) && !empty($rtwmer_withdraw_error) )
            {
                echo json_encode($rtwmer_withdraw_error);
            }
            else
            {
                echo json_encode(1);
            }
            wp_die();
        }
    }