<!-- File contain displaying selling options section of setting tab -->
<?php 

$rtwmer_commission_type = 'percentage';
$rtwmer_comission_value = 0;
$rtwmer_shipping_recipient = 'admin';
$rtwmer_tax_recipient = 'admin';
$rtwmer_allow_add_product = 1;
$rtwmer_disable_product_popup = 0;
$rtwmer_order_status_change = 0;

//==========Getting data from options table===================//

    if( current_user_can('manage_options'))
    {
        if( !empty(get_option('rtwmer_selling_page')) )
        {
            $rtwmer_selling_page_options = get_option('rtwmer_selling_page');
            if( is_array($rtwmer_selling_page_options) && !empty($rtwmer_selling_page_options) )
            {
                if( isset($rtwmer_selling_page_options['rtwmer_commission_type']) )
                {
                    $rtwmer_commission_type = $rtwmer_selling_page_options['rtwmer_commission_type'];
                }
                if( isset($rtwmer_selling_page_options['rtwmer_comission_value']) )
                {
                    $rtwmer_comission_value = $rtwmer_selling_page_options['rtwmer_comission_value'];
                }
                if( isset($rtwmer_selling_page_options['rtwmer_shipping_recipient']) )
                {
                    $rtwmer_shipping_recipient = $rtwmer_selling_page_options['rtwmer_shipping_recipient'];
                }
                if( isset($rtwmer_selling_page_options['rtwmer_tax_recipient']) )
                {
                    $rtwmer_tax_recipient = $rtwmer_selling_page_options['rtwmer_tax_recipient'];
                }
                if( isset($rtwmer_selling_page_options['rtwmer_allow_add_product']) )
                {
                    $rtwmer_allow_add_product = $rtwmer_selling_page_options['rtwmer_allow_add_product'];
                }
                if( isset($rtwmer_selling_page_options['rtwmer_disable_product_popup']) )
                {
                    $rtwmer_disable_product_popup = $rtwmer_selling_page_options['rtwmer_disable_product_popup'];
                }
                if( isset($rtwmer_selling_page_options['rtwmer_order_status_change']) )
                {
                    $rtwmer_order_status_change = $rtwmer_selling_page_options['rtwmer_order_status_change'];
                }
            }
        }
    } 
?>     <div class = "rtwmer-section-content rtwmer_card rtwmer_wrapper_div" id = "rtwmer-selling-options">
        <h3 class = "rtwmer-setting-heading rtwmer_selling_option_setting_updated"><?php esc_html_e( 'Commission','rtwmer-mercado' ); ?></h3>
        <form class = "rtwmer-subsetting-content" method = "post" action = "">
        <ul>
            <?php 
                $rtwmer_selling_page_fields_array = array(
                "<li><label> ".esc_html__( 'Commission Type','rtwmer-mercado' )." </label><span>
                    <div class='rtwmer_select_box'>
                        <select class = 'rtwmer-select-text rtwmer_selling_option_page_data rtwmer_commission_type' id='rtwmer_commission_type' name = 'rtwmer_commission_type'>
                            <option value = flat ".(isset($rtwmer_commission_type) ? (( $rtwmer_commission_type == 'flat') ? "selected" : "" ) : "" )." > ".esc_attr__( "Flat","rtwmer-mercado" )." </option>
                            <option value = percentage ".(isset($rtwmer_commission_type) ? (( $rtwmer_commission_type == 'percentage') ? "selected" : "" ) : "" )." > ".esc_attr__( 'Percentage','rtwmer-mercado' )." </option>
                        </select>
                        <label class='rtwmer_select_label'>".esc_html__( 'Commission Type','rtwmer-mercado' )."</label>
                    </div>
                    <p class = rtwer-notice> ".esc_html__( 'Select a commission type for Vendor','rtwmer-mercado' )."<p></span>
                </li>",
                "<li><label> ".esc_html__( 'Admin Commission','rtwmer-mercado' )." </label>
                    <span>
                        <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                            <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_selling_option_page_data' id='rtwmer_comission_value' name='rtwmer_comission_value' value = ".(isset($rtwmer_comission_value) ? ($rtwmer_comission_value) : "" ).">
                            <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                <div class='mdc-notched-outline__leading'></div>
                                    <div class='mdc-notched-outline__notch' >
                                        <span class='mdc-floating-label' >".esc_html__('Admission Commision','rtwmer-mercado')."</span>
                                    </div>
                                <div class=' mdc-notched-outline__trailing'></div>
                            </div>
                        </label>
                    </span>
                </li>",
                "<li><label> ".esc_html__( 'Shipping Fee Recipient','rtwmer-mercado' )." </label><span>
                    <div class='rtwmer_select_box'>
                        <select id = 'rtwmer_shipping_recipient' name = 'rtwmer_shipping_fees' class='rtwmer-select-text rtwmer_selling_option_page_data'>
                            <option value = vendor ".(isset($rtwmer_shipping_recipient) ? (( $rtwmer_shipping_recipient == 'vendor') ? "selected" : "" ) : "" )." > ".esc_html__( 'Vendor','rtwmer-mercado' )." </option>
                            <option value = admin ".(isset($rtwmer_shipping_recipient) ? (( $rtwmer_shipping_recipient == 'admin') ? "selected" : "" ) : "" )." > ".esc_html__( 'Admin','rtwmer-mercado' )." </option>
                        </select>
                        <label class='rtwmer_select_label'>".esc_html__( 'Shipping Fee Recipient','rtwmer-mercado' )."</label>
                    </div>
                    <p class = 'rtwer-notice'> ".esc_html__( 'Who will be receiving the Shipping fees','rtwmer-mercado' )." <p></span>
                </li>",
                "<li><label> ".esc_html__( 'Tax Fee Recipient','rtwmer-mercado' )." </label><span>
                    <div class='rtwmer_select_box'>
                        <select id = 'rtwmer_tax_recipient' name = 'rtwmer_tax_fees' class = 'rtwmer-select-text rtwmer_selling_option_page_data'>
                            <option value = vendor ".(isset($rtwmer_tax_recipient) ? (( $rtwmer_tax_recipient == 'vendor') ? "selected" : "" ) : "" )." >".esc_html__( 'Vendor','rtwmer-mercado' )." </option> 
                            <option value = admin ".(isset($rtwmer_tax_recipient) ? (( $rtwmer_tax_recipient == 'admin') ? "selected" : "" ) : "" )." > ".esc_html__( 'Admin','rtwmer-mercado' )." </option>
                        </select>
                        <label class='rtwmer_select_label'>".esc_html__( 'Tax Fee Recipient','rtwmer-mercado' )."</label>
                    </div>
                    <p class = 'rtwer-notice'> ".esc_html__( 'Who will be receiving the tax fees','rtwmer-mercado' )." <p></span>
                </li>",
                "<h5 class = 'rtwmer-setting-heading'> ".esc_html__( 'Vendor Capability','rtwmer-mercado' )." </h5>",
                "<li><label> ".esc_html__( 'New Vendor Product Upload','rtwmer-mercado' )." </label>
                    <span class='rtwmer-general-setting-span'>
                        <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                            <input type='checkbox' id='rtwmer_allow_add_product' class='mdc-checkbox__native-control rtwmer_selling_option_page_data rtwmer_allow_add_product' name='rtwmer_allow_add_product'".(isset( $rtwmer_allow_add_product ) ? ( ($rtwmer_allow_add_product == 1) ? "checked='checked'" : "" ) : "")."
                        name = ''> 
                            <div class='mdc-checkbox__background'>
                                <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                    <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                </svg>
                                <div class='mdc-checkbox__mixedmark'></div>
                            </div>
                            <div class='mdc-checkbox__ripple'></div>
                        </div>
                        <p>".esc_html__( 'Allow newly registered vendors to add products','rtwmer-mercado' )."</p>
                    </span>
                </li>",
                "<li><label> ".esc_html__( 'Disable Product Popup','rtwmer-mercado' )." </label>
                    <span class='rtwmer-general-setting-span'>
                        <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                            <input type='checkbox' id='rtwmer_disable_product_popup' class='mdc-checkbox__native-control rtwmer_selling_option_page_data rtwmer_disable_product_popup' name='rtwmer_disable_product_popup'".(isset( $rtwmer_disable_product_popup ) ? ( ($rtwmer_disable_product_popup == 1) ? "checked='checked'" : "" ) : "")."
                        name = ''> 
                            <div class='mdc-checkbox__background'>
                                <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                    <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                </svg>
                                <div class='mdc-checkbox__mixedmark'></div>
                            </div>
                            <div class='mdc-checkbox__ripple'></div>
                        </div>
                        <p>".esc_html__( 'Disable add new product in popup view','rtwmer-mercado' )."</p>
                    </span>
                </li>",
                "<li><label> ".esc_html__( 'Order Status Change','rtwmer-mercado' )." </label>
                    <span class='rtwmer-general-setting-span'>
                        <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                            <input type='checkbox' id='rtwmer_order_status_change' class='mdc-checkbox__native-control rtwmer_selling_option_page_data rtwmer_order_status_change' name='rtwmer_order_status_change'".(isset( $rtwmer_order_status_change ) ? ( ($rtwmer_order_status_change == 1) ? "checked='checked'" : "" ) : "")."
                        name = ''> 
                            <div class='mdc-checkbox__background'>
                                <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                    <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                </svg>
                                <div class='mdc-checkbox__mixedmark'></div>
                            </div>
                            <div class='mdc-checkbox__ripple'></div>
                        </div>
                        <p>".esc_html__( 'Allow/Disallow vendor to update order status','rtwmer-mercado' )."</p>
                    </span>
                </li>"
                );
                $rtwmer_selling_page_fields_array = apply_filters("rtwmer_selling_option_meta_data",$rtwmer_selling_page_fields_array);

                if( isset($rtwmer_selling_page_fields_array) )
                {
                    foreach($rtwmer_selling_page_fields_array as $key => $value)
                    {
                        if( isset($value) )
                        {
                            // $value conntains html==//
                            
                            echo $value;
                        }
                    }   
                }

            ?>
            <p class="button-wrapper"><input type = "submit" name = "submit" id = "rtwmer-selling-page-submit" class = "rtwmer-button mdc-button mdc-button--raised mdc-ripple-upgraded" value = "<?php esc_html_e('Save Changes','rtwmer-mercado') ?>"><span><a href="<?php echo isset($rtwmer_mercado_url) ? esc_url($rtwmer_mercado_url) : ""; ?>" class = "mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_store_setup_skip_btn"><?php esc_html_e('Skip For Now','rtwmer-mercado'); ?></a></span></p>           
        </ul>
        </form>
        <?php do_action('rtwmer_mercado_selling_option_page'); ?>
    </div> 