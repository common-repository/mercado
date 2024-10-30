<?php 
//===========================This file is used to process order request==================//
use Automattic\WooCommerce\Utilities\OrderUtil;


    if( isset($_POST['rtwmer_process_order_request_id']) && !empty($_POST['rtwmer_process_order_request_id']) )
    {
       
   
        if( isset($_POST['rtwmer_process_order_request_value']) && !empty($_POST['rtwmer_process_order_request_value']) )
        {
            if( $_POST['rtwmer_process_order_request_value'] == 'send_payment' )
            {
               
                $rtwmer_children_post_args = array(
                    'post_parent'	=> 	sanitize_text_field($_POST['rtwmer_process_order_request_id']),
                    'post_type'		=>	'shop_order',
                    'post_status'	=>	'-1'
                );
                $rtwmer_order_children = get_children( $rtwmer_children_post_args );
                
                if($rtwmer_order_children)
                {
                    $rtwmer_process_main_order = wc_get_order($_POST['rtwmer_process_order_request_id']);
                    if( isset($rtwmer_process_main_order) && is_object($rtwmer_process_main_order) )
                    {
                        if($rtwmer_process_main_order->get_status() != 'completed')
                        {
                            echo json_encode(esc_html__('Order Status should be completed to Tranfer amount to vendors.','rtwmer-mercado'));
                            wp_die();
                        }
                        if($rtwmer_process_main_order->get_status() == 'completed')
                        {
                            foreach($rtwmer_order_children as $children)
                            {
                                if(isset($children->ID))
                                {
                                    $rtwmer_process_order = wc_get_order($children->ID);

                                    if( isset($rtwmer_process_order) && is_object($rtwmer_process_order) )
                                    {
                                        if($rtwmer_process_order->get_status() != 'completed')
                                        {
                                            echo json_encode(esc_html__('Each sub Order Status should be completed to Tranfer amount to vendors.','rtwmer-mercado'));
                                            wp_die();
                                        }
                                        if($rtwmer_process_order->get_status() == 'completed')
                                        {
                                            if( !empty(get_option('rtwmer_withdraw_option')) )
                                            {
                                                if(isset(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor']))
                                                {
                                                    if(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor'] == 'rtwmer_after_admin_approval')
                                                    {
                                                        $rtwmer_order_total = $rtwmer_process_order->get_total();
                                                        $rtwmer_order_total_main = $rtwmer_process_main_order->get_total();
                                                        $rtwmer_order_vendor_id = get_post_meta( $children->ID,'rtwmer_order_vendor',true );
            
                                                        if( isset ($rtwmer_order_vendor_id))
                                                        {
                                                            if( !empty(get_post_meta($children->ID,'rtwmer_vendor_payment_after_admin_approvale' )) )
                                                            {
                                                                if( isset($rtwmer_order_total_main) )
                                                                {
                                                                    if($rtwmer_order_total_main == 0)
                                                                    {
                                                                        echo json_encode(esc_html__('Amount Should be Greater than 0','rtwmer-mercado'));
                                                                        wp_die();
                                                                    }
                                                                }
                                                                if(get_post_meta($children->ID,'rtwmer_vendor_payment_after_admin_approvale',true ) == 'true')
                                                                {
                                                                    $rtwmer_response_for_already_transferred = esc_html__("Request are neglected whom you already assgined balance, else are approved.",'rtwmer-mercado');
                                                                }
                                                                else
                                                                {
                                                                    $rtwmer_admin_order_commision_for_vendor = get_post_meta($children->ID,'rtwmer_admin_order_commision_for_vendor',true );
                                                                    if( isset($rtwmer_admin_order_commision_for_vendor) )
                                                                    {
                                                                        do_action('rtwmer_send_order_balance_to_vendor');

                                                                        update_user_meta( $rtwmer_order_vendor_id,'rtwmer_total_amount',intval(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true)) + ($rtwmer_order_total - $rtwmer_admin_order_commision_for_vendor));
                                                                        update_post_meta($children->ID,'rtwmer_vendor_payment_after_admin_approvale','true' );
                                                                        $rtwmer_request_done = 1;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if( isset($rtwmer_response_for_already_transferred) && !empty($rtwmer_response_for_already_transferred) )
                    {
                        echo json_encode(2);
                    }
                    else
                    {
                        echo json_encode(1);
                    }
                    wp_die();
                }
                else
                {
                    
                    $rtwmer_process_order = wc_get_order($_POST['rtwmer_process_order_request_id']);
                    
                    if( isset($rtwmer_process_order) && is_object($rtwmer_process_order) )
                    {
                        if($rtwmer_process_order->get_status() != 'completed')
                        {
                            echo json_encode(esc_html__('Order Status should be completed to Tranfer amount to vendor.','rtwmer-mercado'));
                            wp_die();
                        }
                        if($rtwmer_process_order->get_status() == 'completed')
                        {
                           
                            if( !empty(get_option('rtwmer_withdraw_option')) )
                            {
                               
                                if(isset(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor']))
                                {
                                    if(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor'] == 'rtwmer_after_admin_approval')
                                    {   
                                      
                                        $order = wc_get_order( sanitize_text_field($_POST['rtwmer_process_order_request_id']));
                                        // $test = $order->get_meta('rtwmer_order_vendor',true);

                                        $rtwmer_order_total = $rtwmer_process_order->get_total();
                                        // $rtwmer_order_vendor_id = get_post_meta( sanitize_text_field($_POST['rtwmer_process_order_request_id']),'rtwmer_order_vendor',true );
                                        $rtwmer_order_vendor_id = $order->get_meta('rtwmer_order_vendor',true);
                                      
                                        if( isset ($rtwmer_order_vendor_id))
                                        {
                                            $test = get_post_meta($_POST['rtwmer_process_order_request_id'],'rtwmer_vendor_payment_after_admin_approvale' );
                                           
                                            
                                            if( !empty(get_post_meta($_POST['rtwmer_process_order_request_id'],'rtwmer_vendor_payment_after_admin_approvale' )) )
                                            {
                                            
                                                if( isset($rtwmer_order_total) )
                                                {
                                                    if($rtwmer_order_total == 0)
                                                    {
                                                        echo json_encode(esc_html__('Amount Should be Greater than 0','rtwmer-mercado'));
                                                        wp_die();
                                                    }
                                                }
                                                if(get_post_meta($_POST['rtwmer_process_order_request_id'],'rtwmer_vendor_payment_after_admin_approvale',true ) == 'true')
                                                {
                                                    echo json_encode(esc_html__('Amount Already Transferred for this order','rtwmer-mercado'));
                                                    wp_die();
                                                }
                                            }

                                            // $rtwmer_admin_order_commision_for_vendor = get_post_meta($_POST['rtwmer_process_order_request_id'],'rtwmer_admin_order_commision_for_vendor',true );
                                            $rtwmer_admin_order_commision_for_vendor = $order->get_meta('rtwmer_admin_order_commision_for_vendor',true);
                                            if( isset($rtwmer_admin_order_commision_for_vendor) )
                                            {
                                                do_action('rtwmer_send_order_balance_to_vendor');
                                                // print_r($rtwmer_order_vendor_id);  
                                                // $test =  intval(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true)) + ($rtwmer_order_total - $rtwmer_admin_order_commision_for_vendor);

                                                update_user_meta( $rtwmer_order_vendor_id,'rtwmer_total_amount',intval(get_user_meta($rtwmer_order_vendor_id,'rtwmer_total_amount',true)) + ($rtwmer_order_total - $rtwmer_admin_order_commision_for_vendor));
                                                update_post_meta(sanitize_text_field($_POST['rtwmer_process_order_request_id']),'rtwmer_vendor_payment_after_admin_approvale','true' );
                                                echo json_encode(1);
                                                wp_die();
                                            }
                                        }
                                    }
                                }
                            }
                            wp_die();
                        }
                    }
                }
            }
      

            $rtwmer_children_post_args = array(
                'post_parent'	=> 	sanitize_text_field($_POST['rtwmer_process_order_request_id']),
                'post_type'		=>	'shop_order',
                'post_status'	=>	'-1'
            );

            
            $rtwmer_order_children = get_children( $rtwmer_children_post_args );
           
            if( $rtwmer_order_children )
            {
               
                foreach($rtwmer_order_children as $children)
                {
                    if(isset($children->ID))
                    {
                        if( $_POST['rtwmer_process_order_request_value'] == 'trash' )
                        {
                           
                            
                            do_action('rtwmer_send_order_to_trash');
                            wp_trash_post( $children->ID );
                            wp_trash_post( sanitize_text_field($_POST['rtwmer_process_order_request_id']) );
                            $rtwmer_order_vendor_id = get_post_meta( $children->ID[0],'rtwmer_order_vendor',true );
    
                            if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
                            {
                                echo json_encode($rtwmer_order_vendor_id);
                            }
                        }
                        if( $_POST['rtwmer_process_order_request_value'] == 'restore' )
                        {
                            do_action('rtwmer_send_order_to_restore');
                            wp_untrash_post( $children->ID );
                            wp_untrash_post( sanitize_text_field($_POST['rtwmer_process_order_request_id']) );
                            $rtwmer_order_vendor_id = get_post_meta( $children->ID[0],'rtwmer_order_vendor',true );
                            
                            // $order = new WC_Order( $_POST['rtwmer_process_order_request_id'] );
                            // $test = $order->update_status( 'trash' );
                           

                            if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
                            {
                                echo json_encode($rtwmer_order_vendor_id);
                            }
                        }
                        if( $_POST['rtwmer_process_order_request_value'] == 'delete' )
                        {
                           
                            do_action('rtwmer_send_order_to_delete');
                            $rtwmer_order_vendor_id = get_post_meta( $children->ID[0],'rtwmer_order_vendor',true );
                            if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
                            {
                                echo json_encode($rtwmer_order_vendor_id);
                            }
                            wp_delete_post( $children->ID );
                            wp_delete_post( sanitize_text_field($_POST['rtwmer_process_order_request_id']) );
                        }
                    }
                }
                wp_die();
            }
            else
            {
                if( $_POST['rtwmer_process_order_request_value'] == 'trash' )
                {
                    
                   
                    do_action('rtwmer_send_order_to_trash');
                    wp_trash_post( sanitize_text_field($_POST['rtwmer_process_order_request_id']) );
                    $rtwmer_order_vendor_id = get_post_meta( sanitize_text_field($_POST['rtwmer_process_order_request_id']),'rtwmer_order_vendor',true );
                    
                    $id = $_POST['rtwmer_process_order_request_id'];

                    $order = new WC_Order( $id );

                    global $wpdb;
                    $status = $order->get_status();

                    $check = $wpdb->get_results ( "SELECT * FROM ".$wpdb->prefix."wc_orders_meta WHERE `order_id` = '$id' AND `meta_key` = '_wp_trash_meta_status'" ); 

                    if($check){
                        $wpdb->update($wpdb->prefix.'wc_orders_meta', array('meta_value'=> "wc-".$status), array('order_id' => $id ,'meta_key'=> '_wp_trash_meta_status'));
                    }else{
                        $wpdb->insert($wpdb->prefix.'wc_orders_meta', array(
                            'order_id' => $id,
                            'meta_key' => '_wp_trash_meta_status',
                            'meta_value' => "wc-".$status
                        ));
                    }
                    
                    $test = $order->update_status( 'trash' );
                   
                    $result = $wpdb->get_results ( "SELECT * FROM ".$wpdb->prefix."wc_orders_meta WHERE `order_id` = '$id' AND `meta_key` = 'rtwmer_order_vendor'" );  
            
                    if( isset($result[0]) && !empty($result[0]) )
                    {
                        echo json_encode($result[0]);
                        wp_die();
                    }
                }
                if( $_POST['rtwmer_process_order_request_value'] == 'restore' )
                {
                    do_action('rtwmer_send_order_to_restore');
                    wp_untrash_post( sanitize_text_field($_POST['rtwmer_process_order_request_id']) );
                    $rtwmer_order_vendor_id = get_post_meta( sanitize_text_field($_POST['rtwmer_process_order_request_id']),'rtwmer_order_vendor',true );

                    $id = $_POST['rtwmer_process_order_request_id'];
                    $order =  wc_get_order( $id );
                    $order->get_meta('rtwmer_order_vendor');
                    global $wpdb;
                    

                   

                    $check = $wpdb->get_results ( "SELECT * FROM ".$wpdb->prefix."wc_orders_meta WHERE `order_id` = '$id' AND `meta_key` = '_wp_trash_meta_status'" ); 
                    $status = $check[0]->meta_value;


                    $rtwmer_order_vendor_id = $order->get_meta('rtwmer_order_vendor');

                    if($check){
                        $wpdb->update($wpdb->prefix.'wc_orders', array('status'=> $status), array('id' => $id));
                        echo json_encode($rtwmer_order_vendor_id);
                        wp_die();
                    }

                    // if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
                    // {
                    //     echo json_encode($rtwmer_order_vendor_id);
                    //     wp_die();
                    // }
                }
                if( $_POST['rtwmer_process_order_request_value'] == 'delete' )
                {
                            // echo '<pre>';
                            // print_r($_POST);
                            // echo '</pre>';
                            // die('aaaaaaaaa');
                    do_action('rtwmer_send_order_to_delete');
                 
                    $id = $_POST['rtwmer_process_order_request_id'];
                    // ".$wpdb->prefix."
                    global $wpdb;
                    if(OrderUtil::custom_orders_table_usage_is_enabled()){ 
                        $rtwmer_order_vendor_id = $wpdb->get_results ( "SELECT * FROM ".$wpdb->prefix."wc_orders_meta WHERE `order_id` = '$id' AND `meta_key` = 'rtwmer_order_vendor'" ); 
                        $rtwmer_order_vendor_id = $rtwmer_order_vendor_id[0];
                        $table1 = $wpdb->prefix.'wc_orders';
                        $table = $wpdb->prefix.'wc_orders_meta';
                        $wpdb->delete( $table, array( 'order_id' => $id ) );
                        $wpdb->delete( $table1, array( 'id' => $id ) );
                        echo json_encode($rtwmer_order_vendor_id);
                     
                        wp_die();
                    }else{
                        $rtwmer_order_vendor_id = $wpdb->get_results ( "SELECT * FROM wp_postmeta WHERE `post_id` = '$id' AND `meta_key` = 'rtwmer_order_vendor'" ); 
                          
                        // $rtwmer_order_vendor_id = $rtwmer_order_vendor_id[0];
                        $rtwmer_order_vendor_id = get_post_meta( sanitize_text_field($_POST['rtwmer_process_order_request_id']),'rtwmer_order_vendor',true );
                      
                        if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
                        {
                        wp_delete_post( sanitize_text_field($_POST['rtwmer_process_order_request_id']) );
                        echo json_encode($rtwmer_order_vendor_id);
                        }
                    }

                    // if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
                    // {
                    //     echo json_encode($rtwmer_order_vendor_id);

                    // }
                   
                    wp_die();
                }
                // echo '<pre>';
                // print_r('hhhsdfh');
                // echo '</pre>';
                // die('fjffjsdf');
                echo json_encode(1);
                wp_die();
            }
        }
    }

?>