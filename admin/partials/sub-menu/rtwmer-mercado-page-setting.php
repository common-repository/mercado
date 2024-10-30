<!-- File contain displaying page settings section of setting tab -->

<?php 

    // Default Data if variables are not set.

    $rtwmer_page_setting_dashboard = 'not_selected';
    $rtwmer_page_setting_my_orders = 'not_selected';
    $rtwmer_page_terms_conditions = 'not_selected';
    $rtwmer_page_store_listing = 'not_selected';
   
    //Getting data from options table

    if( current_user_can('manage_options') )
    {
        if( !empty( get_option('rtwmer_page_setting' )) )
        {
            $rtwmer_page_setting_option = get_option('rtwmer_page_setting');
            
            if(is_array($rtwmer_page_setting_option) && !empty($rtwmer_page_setting_option) )
            {   
                if( isset($rtwmer_page_setting_option['rtwmer_page_setting_dashboard']) )
                {
                    $rtwmer_page_setting_dashboard = $rtwmer_page_setting_option['rtwmer_page_setting_dashboard'];
                }
                if( isset($rtwmer_page_setting_option['rtwmer_page_my_orders']) )
                {
                    $rtwmer_page_my_orders = $rtwmer_page_setting_option['rtwmer_page_my_orders'];
                }
                if( isset($rtwmer_page_setting_option['rtwmer_page_terms_conditions']) )
                {
                    $rtwmer_page_terms_conditions = $rtwmer_page_setting_option['rtwmer_page_terms_conditions'];   
                }
                if( isset($rtwmer_page_setting_option['rtwmer_page_store_listing']) )
                {
                    $rtwmer_page_store_listing = $rtwmer_page_setting_option['rtwmer_page_store_listing'];
                }
            }
        }
    }?>

    <div class = "rtwmer-section-content rtwmer_card rtwmer_wrapper_div" id = "rtwmer-page-setting">
        <h3 class = "rtwmer-setting-heading"><?php esc_html_e('Page Settings','rtwmer-mercado'); ?></h3>
        <div class = "rtwmer-subsetting-content">
        <ul>
            <li><label><?php esc_html_e('Dashboard','rtwmer-mercado'); ?></label><span>
                <?php
                if( isset( $rtwmer_page_setting_dashboard ) && !empty( $rtwmer_page_setting_dashboard ) )
                {
                    ?>
                        <div class='rtwmer_select_box'>
                            <?php
                                wp_dropdown_pages( array(
                                'show_option_none' => 'select page',
                                'name' => 'rtwmer_page_setting_dashboard',
                                'id' => 'rtwmer_page_setting_dashboard',
                                'class' => 'rtwmer-select-text',
                                'option_none_value' => 'not_selected',
                                'selected' => $rtwmer_page_setting_dashboard,
                                ));
                            ?>
                            <label class='rtwmer_select_label'><?php esc_html_e( 'Dashboard Page','rtwmer-mercado' ); ?></label>
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div class='rtwmer_select_box'>
                            <?php
                                wp_dropdown_pages( array(
                                'show_option_none' => 'select page',
                                'name' => 'rtwmer_page_setting_dashboard',
                                'id' => 'rtwmer_page_setting_dashboard',
                                'class' => 'rtwmer-select-text',
                                'option_none_value' => 'not_selected',
                                ) );
                            ?>
                            <label class='rtwmer_select_label'><?php esc_html_e( 'Dashboard Page','rtwmer-mercado' ); ?></label>
                        </div>
                    <?php
                }    
                ?> 
                <p class="rtwer-notice"><?php esc_html_e('Select a page to show Vendor Dashboard','rtwmer-mercado'); ?><p></span>
            </li>

            <li><label><?php esc_html_e('My Orders','rtwmer-mercado'); ?></label><span>
                <?php 
                if(isset($rtwmer_page_my_orders) && !empty($rtwmer_page_my_orders))
                {
                    ?>
                        <div class='rtwmer_select_box'>
                            <?php
                                wp_dropdown_pages( array(
                                'show_option_none' => 'select page',
                                'option_none_value' => 'not_selected',
                                'name' => 'rtwmer_page_my_orders',
                                'class' => 'rtwmer-select-text',
                                'id' => 'rtwmer_page_my_orders',
                                'selected' => $rtwmer_page_my_orders,
                                ));
                            ?>
                            <label class='rtwmer_select_label'><?php esc_html_e( 'My Orders Page','rtwmer-mercado' ); ?></label>
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div class='rtwmer_select_box'>
                            <?php
                                wp_dropdown_pages( array(
                                'show_option_none' => 'select page',
                                'option_none_value' => 'not_selected',
                                'name' => 'rtwmer_page_my_orders',
                                'class' => 'rtwmer-select-text',
                                'id' => 'rtwmer_page_my_orders',
                                ) );
                            ?>
                            <label class='rtwmer_select_label'><?php esc_html_e( 'My Orders Page','rtwmer-mercado' ); ?></label>
                        </div>
                    <?php
                }
                ?> 
                <p class="rtwer-notice"><?php esc_html_e('Select a page to show My Orders','rtwmer-mercado'); ?><p></span>
            </li>

            <li><label><?php esc_html_e('Store Listing','rtwmer-mercado'); ?></label><span>
                <?php 
                if(isset($rtwmer_page_store_listing) && !empty($rtwmer_page_store_listing))
                {
                    ?>
                        <div class='rtwmer_select_box'>
                            <?php
                                wp_dropdown_pages( array(
                                'show_option_none' => 'select page',
                                'option_none_value' => 'not_selected',
                                'name' => 'rtwmer_page_store_listing',
                                'class' => 'rtwmer-select-text',
                                'id' => 'rtwmer_page_store_listing',
                                'selected' => $rtwmer_page_store_listing,
                                ));
                            ?>
                            <label class='rtwmer_select_label'><?php esc_html_e( 'Store Listing Page','rtwmer-mercado' ); ?></label>
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div class='rtwmer_select_box'>
                            <?php
                                wp_dropdown_pages( array(
                                'show_option_none' => 'select page',
                                'option_none_value' => 'not_selected',
                                'name' => 'rtwmer_page_store_listing',
                                'class' => 'rtwmer-select-text',
                                'id' => 'rtwmer_page_store_listing',
                                ) );
                            ?>
                            <label class='rtwmer_select_label'><?php esc_html_e( 'Store Listing Page','rtwmer-mercado' ); ?></label>
                        </div>
                    <?php
                }
                ?> 
                <p class="rtwer-notice"><?php esc_html_e('Select a page to show all Stores','rtwmer-mercado'); ?><p></span>
            </li>

            <li><label><?php esc_html_e('Terms and Conditions Page','rtwmer-mercado'); ?></label><span>
                <?php
                if(isset($rtwmer_page_my_orders) && !empty($rtwmer_page_my_orders))
                {
                    ?>
                        <div class='rtwmer_select_box'>
                            <?php
                                wp_dropdown_pages( array(
                                'show_option_none' => 'select page',
                                'option_none_value' => 'not_selected',
                                'name' => 'rtwmer_page_terms_conditions',
                                'class' => 'rtwmer-select-text',
                                'id' => 'rtwmer_page_terms_conditions',
                                'selected' => $rtwmer_page_terms_conditions,
                                ) );
                            ?>
                            <label class='rtwmer_select_label'><?php esc_html_e( 'Terms & Conditions Page','rtwmer-mercado' ); ?></label>
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div class='rtwmer_select_box'>
                            <?php
                                wp_dropdown_pages( array(
                                'show_option_none' => 'select page',
                                'option_none_value' => 'not_selected',
                                'name' => 'rtwmer_page_terms_conditions',
                                'class' => 'rtwmer-select-text',
                                'id' => 'rtwmer_page_terms_conditions',
                                ) );
                                ?>
                            <label class='rtwmer_select_label'><?php esc_html_e( 'Terms & Conditions Page','rtwmer-mercado' ); ?></label>
                        </div>
                    <?php
                }
                ?>
                <p class = "rtwer-notice"><?php esc_html_e( 'Select where you want to add Mercado pages','rtwmer-mercado' ); ?> <a href="<?php echo esc_attr( 'https://redefiningtheweb.com/' ); ?>"> <?php esc_html_e( 'Learn More','rtwmer-mercado' ); ?></a><p></span>
            </li>
            <?php
                $rtwmer_page_setting_array = array(
                    
                );
                $rtwmer_page_setting_array = apply_filters('rtwmer_page_setting_meta_data',$rtwmer_page_setting_array);
                if( isset($rtwmer_page_setting_array) && !empty($rtwmer_page_setting_array) && is_array($rtwmer_page_setting_array) )
                {
                    foreach($rtwmer_page_setting_array as $key => $value)
                    {
                        if( isset($value) && !empty($value) )
                        {
                            //$value holds html
                            echo $value;
                        }
                    }
                }
            ?>
            <p class = "submit"><input type = "submit" name = "submit" id = "rtwmer-page-setting-submit" class = "mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer-button" value = "<?php esc_html_e('Save Changes','rtwmer-mercado') ?>"></p>
        </ul>
        </div>
        <?php do_action('rtwmer_mercado_page_setting_page'); ?>
    </div>