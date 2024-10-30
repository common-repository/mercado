<?php

//==================File includes When Update vendor after click to edit section of vendors===========//    

// $_POST['rtwmer_edit_vendors_data'] holds array
    if( isset($_POST['rtwmer_edit_vendors_data']) )
    {
    //    echo '<pre>';
    //    print_r($_POST['rtwmer_edit_vendors_data']);
    //    echo '</pre>';
       
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        $rtwmer_edit_vendors_data = $_POST['rtwmer_edit_vendors_data'];    
        
        if( is_array($rtwmer_edit_vendors_data) && isset($rtwmer_edit_vendors_data) && !empty($rtwmer_edit_vendors_data) )
        {
            // foreach($rtwmer_edit_vendors_data as $data)
            // {
            //     if(isset($data))
            //     {
            //         $data = sanitize_text_field($data);
            //         $data = stripslashes($data);
            //     }
            // }
            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_check_before_update']) && !empty($rtwmer_edit_vendors_data['rtwmer_vendor_check_before_update']) )
            {
                if( $rtwmer_edit_vendors_data['rtwmer_vendor_check_before_update'] == 'rtwmer_addnew_vendor' )
                {
                    $rtwmer_addnew_vend = array(
                        'first_name' 	=> 	isset($rtwmer_edit_vendors_data['rtwmer_add_new_vend_fname']) ? $rtwmer_edit_vendors_data['rtwmer_add_new_vend_fname'] : "",
                        'last_name' 	=> 	isset($rtwmer_edit_vendors_data['rtwmer_add_new_vend_lname']) ? $rtwmer_edit_vendors_data['rtwmer_add_new_vend_lname'] : "",
                        'user_email' 	=> 	isset($rtwmer_edit_vendors_data['rtwmer_add_new_vend_email']) ? $rtwmer_edit_vendors_data['rtwmer_add_new_vend_email'] : "",
                        'user_login' 	=> 	isset($rtwmer_edit_vendors_data['rtwmer_add_new_vend_uname']) ? $rtwmer_edit_vendors_data['rtwmer_add_new_vend_uname'] : "",
                        'user_pass' 	=> 	isset($rtwmer_edit_vendors_data['rtwmer_add_new_vend_passwrd']) ? $rtwmer_edit_vendors_data['rtwmer_add_new_vend_passwrd'] : "",
                        'role'			=> 	'rtwmer_vendor',
                        'show_admin_bar_front' => 0,
                    );

                    $rtwmer_newly_created_vend_id = wp_insert_user($rtwmer_addnew_vend);

                    if ( is_wp_error( $rtwmer_newly_created_vend_id  ) ) 
                    {
                        echo json_encode( array( 'status' => false, 'message' => $rtwmer_newly_created_vend_id->get_error_message() ) );
                        wp_die();
                    }
                    else if( is_int($rtwmer_newly_created_vend_id) )
                    {
                        //do_action('rtwmer_creating_new_vendor',$rtwmer_newly_created_vend_id);

                        $rtwmer_edit_vend_id = $rtwmer_newly_created_vend_id;
                       

                        if( isset( $rtwmer_edit_vend_id ) && !empty( $rtwmer_edit_vend_id ) )
                        {
                            
                            if(isset($rtwmer_edit_vendors_data['rtwmer_addnew_vend_paypal_email']))
                            {
                                $test = update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_paypal_email',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_addnew_vend_paypal_email'] ));
        
                            }
                            if(isset($rtwmer_edit_vendors_data['rtwmer_addnew_vend_stripe_id']))
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_stripe_id',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_addnew_vend_stripe_id'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_add_new_vend_email']) && $rtwmer_edit_vendors_data['rtwmer_add_new_vend_uname'] )
                            {
                                $to 		= 	sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_add_new_vend_email']);
                                $subject 	= 	esc_html__('Notification about your vendor account','rtwmer-mercado');
                                $message 	= esc_html__('Dear','rtwmer-mercado'). ' ' .sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_add_new_vend_uname']). ' ' .esc_html__(', Your Vendor Account created with','rtwmer-mercado'). ' ' .get_bloginfo('name'). ' ' .esc_html__(',Please Contact Administrator for further reference','rtwmer-mercado');
                                wp_mail( $to, $subject, $message );
                            }
                           
                          
                        }
                    }
                }
                if( $rtwmer_edit_vendors_data['rtwmer_vendor_check_before_update'] == 'rtwmer_edit_vendor' )
                {
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_data_id']) )
                    {
                        $rtwmer_edit_vend_id = sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_data_id']);
                        
                        if( isset( $rtwmer_edit_vend_id ) && !empty( $rtwmer_edit_vend_id ) )
                        {
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_facebook']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_facebook',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_facebook'] ));
                                
                                do_action('rtwmer_editing_vendor',$rtwmer_edit_vend_id);
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_google_plus']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_google_plus',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_google_plus'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_twitter']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_twitter',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_twitter'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_pinterest']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_pinterest',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_pinterest'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_linkedin']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_linkedin',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_linkedin'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_youtube']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_youtube',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_youtube'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_instagram']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_instagram',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_instagram'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_flickr']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_flickr',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_flickr'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_admin_vendor_commssion']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_admin_vendor_commssion',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_admin_vendor_commssion'] ));
                            }
                            if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_admin_commision_value']) )
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_admin_commision_value',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_admin_commision_value'] ));
                            }
                            if(isset($rtwmer_edit_vendors_data['rtwmer_addnew_vend_paypal_email']))
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_paypal_email',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_addnew_vend_paypal_email'] ));
                            }
                            if(isset($rtwmer_edit_vendors_data['rtwmer_addnew_vend_stripe_id']))
                            {
                                update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_stripe_id',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_addnew_vend_stripe_id'] ));
                            }
                        }
                    }
                }
                if( isset( $rtwmer_edit_vend_id ) && !empty( $rtwmer_edit_vend_id ) )
                {
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_img_id']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_store_img',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_img_id'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_store_name1']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_store_name',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_store_name1'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_store_url']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_store_url',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_store_url'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_store_phone']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_phone',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_store_phone'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_store_address1']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_address1',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_store_address1'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_store_address2']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_address2',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_store_address2'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_town_city']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_city',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_town_city'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_zip_code']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_zip',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_zip_code'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_selected_country']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_country',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_selected_country'] ));
                    }
                    if(isset($rtwmer_edit_vendors_data['rtwmer_vendor_selected_state']))
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_state',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_selected_state'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_bank_name']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_bank_name',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_bank_name'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_bank_account_no']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_bank_account_no',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_bank_account_no'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_bank_address']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_bank_address',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_bank_address'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_routing_number']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_routing_number',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_routing_number'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_bank_iban']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_bank_iban',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_bank_iban'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_bank_swift']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_bank_swift',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_bank_swift'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_enable_selling']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_status',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_enable_selling'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_publishing_product']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_publishing_product',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_publishing_product'] ));
                    }
                    if( isset($rtwmer_edit_vendors_data['rtwmer_vendor_admin_featured_vendor']) )
                    {
                        update_user_meta( $rtwmer_edit_vend_id,'rtwmer_vendor_admin_featured_vendor',sanitize_text_field($rtwmer_edit_vendors_data['rtwmer_vendor_admin_featured_vendor'] ));
                    }

                    $message = "vendor created successfully";
                    echo json_encode( array( 'status' => true, 'message' => $message ) );
                    wp_die();
                }
            }
        }
    }