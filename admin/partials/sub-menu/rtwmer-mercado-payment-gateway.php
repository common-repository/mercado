<!-- File contain displaying payment gateway section of setting tab -->
<?php
    
    // initializing custom data, if no data found from db

    $rtwmer_withdraw_paypal = 0;
    $rtwmer_withdraw_bank = 1;
    $rtwmer_withdraw_stripe = 0;
    $rtwmer_withdraw_paypal = 0;
    $rtwmer_withdraw_paypal_test_box = 1;
    $rtwmer_paypal_client_id = '';
    $rtwmer_paypal_secret_key = '';
    $rtwmer_withdraw_stripe_test_box = 1;
    $rtwmer_stripe_client_id = '';
    $rtwmer_stripe_secret_key = '';
    $rtwmer_stripe_publishable_key = '';

    // Getting data from database

    if(current_user_can('manage_options'))
    {
        if( !empty(get_option('rtwmer_payment_gateway')))
        {
            $rtwmer_withdraw_option_data = get_option('rtwmer_payment_gateway');
            
            if(is_array($rtwmer_withdraw_option_data) && !empty($rtwmer_withdraw_option_data) )
            {
                if(isset($rtwmer_withdraw_option_data['rtwmer_withdraw_paypal']))
                {
                    $rtwmer_withdraw_paypal  = $rtwmer_withdraw_option_data['rtwmer_withdraw_paypal'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_withdraw_bank']) )
                {
                    $rtwmer_withdraw_bank  = $rtwmer_withdraw_option_data['rtwmer_withdraw_bank'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_withdraw_stripe']) )
                {
                    $rtwmer_withdraw_stripe  = $rtwmer_withdraw_option_data['rtwmer_withdraw_stripe'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_withdraw_paypal_test_box']) )
                {
                    $rtwmer_withdraw_paypal_test_box  = $rtwmer_withdraw_option_data['rtwmer_withdraw_paypal_test_box'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_paypal_client_id']) )
                {
                    $rtwmer_paypal_client_id  = $rtwmer_withdraw_option_data['rtwmer_paypal_client_id'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_paypal_secret_key']) )
                {
                    $rtwmer_paypal_secret_key  = $rtwmer_withdraw_option_data['rtwmer_paypal_secret_key'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_withdraw_stripe_test_box']) )
                {
                    $rtwmer_withdraw_stripe_test_box  = $rtwmer_withdraw_option_data['rtwmer_withdraw_stripe_test_box'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_stripe_client_id']) )
                {
                    $rtwmer_stripe_client_id  = $rtwmer_withdraw_option_data['rtwmer_stripe_client_id'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_stripe_secret_key']) )
                {
                    $rtwmer_stripe_secret_key  = $rtwmer_withdraw_option_data['rtwmer_stripe_secret_key'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_stripe_publishable_key']) )
                {
                    $rtwmer_stripe_publishable_key  = $rtwmer_withdraw_option_data['rtwmer_stripe_publishable_key'];
                }
            }
        }
    }
?> 

<div class = "rtwmer-section-content rtwmer_card rtwmer_wrapper_div" id = "rtwmer-payment-gateway-options">
        <h3 class = "rtwmer-setting-heading rtwmer_withdraw_option_setting_updated"><?php esc_html_e('Payment Gateway','rtwmer-mercado'); ?></h3>

        <form class = "rtwmer-subsetting-content" method = "post" action = "">
            <ul>
                <?php 
                    $rtwmer_withdraw_option_array = array(
                    "<li><label> ".esc_html__( 'Payment Methods','rtwmer-mercado')." </label>
                        <span class='rtwmer-general-setting-span rtwmer_withdraw_payment_close'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_withdraw_paypal' class='mdc-checkbox__native-control rtwmer_payment_gateway_page_data rtwmer_withdraw_paypal' name='rtwmer_withdraw_paypal'".(isset( $rtwmer_withdraw_paypal ) ? ( ($rtwmer_withdraw_paypal == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'PayPal','rtwmer-mercado' )."</p>
                        </span>
                        <span class='rtwmer-general-setting-span rtwmer_withdraw_payment_close'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_withdraw_stripe' class='mdc-checkbox__native-control rtwmer_payment_gateway_page_data rtwmer_withdraw_stripe' name='rtwmer_withdraw_stripe'".(isset( $rtwmer_withdraw_stripe ) ? ( ($rtwmer_withdraw_stripe == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'Stripe','rtwmer-mercado' )."</p>
                        </span>
                        <span class='rtwmer-general-setting-span rtwmer_withdraw_payment_close'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_withdraw_bank' class='mdc-checkbox__native-control rtwmer_payment_gateway_page_data rtwmer_withdraw_bank' name='rtwmer_withdraw_bank'".(isset( $rtwmer_withdraw_bank ) ? ( ($rtwmer_withdraw_bank == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'Bank Transfer','rtwmer-mercado' )."</p>
                        </span>
                        ".do_action('rtwmer_add_payment_gateway')."
                    </li>",
                    "<li class='rtwmer_payment_setting_paypal rtwmer_payment_setting_initial'><label> ".esc_html__( 'Enable Sandbox Mode','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_withdraw_paypal_test_box' class='mdc-checkbox__native-control rtwmer_payment_gateway_page_data rtwmer_withdraw_paypal_test_box' name='rtwmer_withdraw_paypal_test_box'".(isset( $rtwmer_withdraw_paypal_test_box ) ? ( ($rtwmer_withdraw_paypal_test_box == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( '( PayPal )','rtwmer-mercado' )."</p>
                        </span>
                    </li>",
                    "<li class='rtwmer_payment_setting_paypal rtwmer_payment_setting_initial'><label> ".esc_html__( 'PayPal Client ID','rtwmer-mercado' )." </label>
                        <span>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_payment_gateway_page_data' id='rtwmer_paypal_client_id' name='rtwmer_paypal_client_id' value = ".(isset($rtwmer_paypal_client_id) ? ($rtwmer_paypal_client_id) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                        <div class='mdc-notched-outline__notch' >
                                            <span class='mdc-floating-label' >".esc_html__('PayPal Client ID','rtwmer-mercado')."</span>
                                        </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                        </span>
                    </li>",
                    "<li class='rtwmer_payment_setting_paypal rtwmer_payment_setting_initial'><label> ".esc_html__( 'PayPal Secret Key','rtwmer-mercado' )." </label>
                        <span>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_payment_gateway_page_data' id='rtwmer_paypal_secret_key' name='rtwmer_paypal_secret_key' value = ".(isset($rtwmer_paypal_secret_key) ? ($rtwmer_paypal_secret_key) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                        <div class='mdc-notched-outline__notch' >
                                            <span class='mdc-floating-label' >".esc_html__('PayPal Secret Key','rtwmer-mercado')."</span>
                                        </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                        </span>
                    </li>",
                    "<li class='rtwmer_payment_setting_stripe rtwmer_payment_setting_initial'><label> ".esc_html__( 'Enable Sandbox Mode','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_withdraw_stripe_test_box' class='mdc-checkbox__native-control rtwmer_payment_gateway_page_data rtwmer_withdraw_stripe_test_box' name='rtwmer_withdraw_stripe_test_box'".(isset( $rtwmer_withdraw_stripe_test_box ) ? ( ($rtwmer_withdraw_stripe_test_box == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( '( Stripe )','rtwmer-mercado' )."</p>
                        </span>
                    </li>",
                    "<li class='rtwmer_payment_setting_stripe rtwmer_payment_setting_initial'><label> ".esc_html__( 'Stripe Client ID','rtwmer-mercado' )." </label>
                        <span>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_payment_gateway_page_data' id='rtwmer_stripe_client_id' name='rtwmer_stripe_client_id' value = ".(isset($rtwmer_stripe_client_id) ? ($rtwmer_stripe_client_id) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                        <div class='mdc-notched-outline__notch' >
                                            <span class='mdc-floating-label' >".esc_html__('Stripe Client ID','rtwmer-mercado')."</span>
                                        </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                        </span>
                    </li>",
                    "<li class='rtwmer_payment_setting_stripe rtwmer_payment_setting_initial'><label> ".esc_html__( 'Stripe Secret Key','rtwmer-mercado' )." </label>
                        <span>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_payment_gateway_page_data' id='rtwmer_stripe_secret_key' name='rtwmer_stripe_secret_key' value = ".(isset($rtwmer_stripe_secret_key) ? ($rtwmer_stripe_secret_key) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                        <div class='mdc-notched-outline__notch' >
                                            <span class='mdc-floating-label' >".esc_html__('Stripe Secret Key','rtwmer-mercado')."</span>
                                        </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                        </span>
                    </li>",
                    "<li class='rtwmer_payment_setting_stripe rtwmer_payment_setting_initial'><label> ".esc_html__( 'Stripe Publishable key','rtwmer-mercado' )." </label>
                        <span>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_payment_gateway_page_data' id='rtwmer_stripe_publishable_key' name='rtwmer_stripe_publishable_key' value = ".(isset($rtwmer_stripe_publishable_key) ? ($rtwmer_stripe_publishable_key) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                        <div class='mdc-notched-outline__notch' >
                                            <span class='mdc-floating-label' >".esc_html__('Stripe Publishable Key','rtwmer-mercado')."</span>
                                        </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                        </span>
                    </li>",
                    );
                    
                    $rtwmer_withdraw_option_array = apply_filters('rtmwer_payment_gateway_meta_data',$rtwmer_withdraw_option_array);

                    if( isset($rtwmer_withdraw_option_array) && is_array($rtwmer_withdraw_option_array) )
                    {
                        foreach($rtwmer_withdraw_option_array as $key => $value)
                        {
                            // $value conntains html==//

                            echo $value;
                        }
                    }
                ?>

            <p class = "submit"><input type = "submit" name = "submit" id = "rtwmer-payment-gateway-submit" class = "mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer-button" value = "<?php esc_html_e('Save Changes','rtwmer-mercado') ?>"></p>
            
            </ul>
        </form> 
        <?php do_action('rtwmer_payment_gateway_page'); ?>
    </div>