<!-- File contain displaying withdraw options section of setting tab -->
<?php
    
    // initializing custom data, if no data found from db

    $rtwmer_withdraw_bank  = 1;
    $rtwmer_minimum_withdraw  = 0;
    $rtwmer_withdraw_to_vendor = 'rtwmer_after_admin_approval';

    // Getting data from database

    if(current_user_can('manage_options'))
    {
        if( !empty(get_option('rtwmer_withdraw_option')))
        {
            $rtwmer_withdraw_option_data = get_option('rtwmer_withdraw_option');
            
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
                if( isset($rtwmer_withdraw_option_data['rtwmer_minimum_withdraw']) )
                {
                    $rtwmer_minimum_withdraw  = $rtwmer_withdraw_option_data['rtwmer_minimum_withdraw'];
                }
                if( isset($rtwmer_withdraw_option_data['rtwmer_withdraw_to_vendor']) )
                {
                    $rtwmer_withdraw_to_vendor  = $rtwmer_withdraw_option_data['rtwmer_withdraw_to_vendor'];
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
    <div class = "rtwmer-section-content rtwmer_card rtwmer_wrapper_div" id = "rtwmer-withdraw-options">
        <h3 class = "rtwmer-setting-heading rtwmer_withdraw_option_setting_updated"><?php esc_html_e('Withdraw Options','rtwmer-mercado'); ?></h3>

        <form class = "rtwmer-subsetting-content" method = "post" action = "">
            <ul>
                <?php 
                    $rtwmer_withdraw_option_array = array(
                    "<li><label> ".esc_html__('Minimum Withdraw Limit','rtwmer-mercado')." </label>
                        <span>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_withdraw_option_page_data' id='rtwmer_minimum_withdraw' name='rtwmer_minimum_withdraw' value = ".(isset($rtwmer_minimum_withdraw) ? ($rtwmer_minimum_withdraw) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                        <div class='mdc-notched-outline__notch' >
                                            <span class='mdc-floating-label' >".esc_html__('Minimum Withdraw Limit','rtwmer-mercado')."</span>
                                        </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                            <p class = 'rtwer-notice'> ".esc_html__('Minimum balance required to make a withdraw request. Leave blank to set no minimum limits.','rtwmer-mercado')." </p>
                        </span>
                    </li>",
                    "<li><label> ".esc_html__( "Amount add to vendor's Account",'rtwmer-mercado' )." </label>
                        <span>
                            <div class='rtwmer_select_box'>
                                <select id = 'rtwmer_withdraw_to_vendor' class = 'rtwmer-select-text rtwmer_withdraw_option_page_data rtwmer_select_textbox_width'>
                                    <option value = ' '> ".esc_html__('Select Option','rtwmer-mercado')." </option>
                                    <option value = 'rtwmer_after_admin_approval' ".(isset( $rtwmer_withdraw_to_vendor ) ? ( ($rtwmer_withdraw_to_vendor == 'rtwmer_after_admin_approval') ? "selected" : "" ) : "")." > ".esc_html__('After Admin Approval','rtwmer-mercado')." </option>
                                    <option value='rtwmer_order_completed' ".(isset( $rtwmer_withdraw_to_vendor ) ? ( ($rtwmer_withdraw_to_vendor == 'rtwmer_order_completed') ? "selected" : "" ) : "")."> ".esc_html__('On Order Completed','rtwmer-mercado')." </option>
                                    <option value='rtwmer_order_processing' ".(isset( $rtwmer_withdraw_to_vendor ) ? ( ($rtwmer_withdraw_to_vendor == 'rtwmer_order_processing') ? "selected" : "" ) : "")."> ".esc_html__('On Order Processing','rtwmer-mercado')."</option>
                                </select>
                                <label class='rtwmer_select_label'>".esc_html__( 'Add Amount','rtwmer-mercado' )."</label>
                            </div>
                            <p class = 'rtwer-notice'> ".esc_html__('When vendor receive Balance? , Default set to after admin Approval','rtwmer-mercado')." </p>
                        </span>
                    </li>"
                    );
                    
                    $rtwmer_withdraw_option_array = apply_filters('rtmwer_withdraw_option_meta_data',$rtwmer_withdraw_option_array);

                    if( isset($rtwmer_withdraw_option_array) && is_array($rtwmer_withdraw_option_array) )
                    {
                        foreach($rtwmer_withdraw_option_array as $key => $value)
                        {
                            // $value conntains html==//

                            echo $value;
                        }
                    }
                ?>

            <p class="button-wrapper"><input type = "submit" name = "submit" id = "rtwmer-withdraw-option-submit" class = "mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer-button" value = "<?php esc_html_e('Save Changes','rtwmer-mercado') ?>"><span><a href="<?php echo isset($rtwmer_mercado_url) ? esc_url($rtwmer_mercado_url) : ""; ?>" class = "mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_store_setup_skip_btn"><?php esc_html_e('Skip For Now','rtwmer-mercado'); ?></a></span></p>
            
            </ul>
        </form> 
        <?php do_action('rtwmer_mercado_withdraw_option_page'); ?>
    </div>