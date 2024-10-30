<!-- File contain displaying privacy policy section of setting tab -->

<?php

    // Default data, if not set.

    $rtwmer_enable_privacy_policy = 1;
    $rtwmer_setting_privacy_page = 'not_selected';
    $rtwmer_setting_privacy_content = 'Your Privacy Policy Content';

    // Getting data from options table

    if( !empty( get_option('rtwmer_privacy_page') ) )
    {
        $rtwmer_privacy_page_data = get_option('rtwmer_privacy_page');
        if( is_array( $rtwmer_privacy_page_data ) && !empty( $rtwmer_privacy_page_data ) )
        {
            $rtwmer_enable_privacy_policy = $rtwmer_privacy_page_data['rtwmer_enable_privacy_policy'];
            $rtwmer_setting_privacy_page = $rtwmer_privacy_page_data['rtwmer_setting_privacy_page'];
            $rtwmer_setting_privacy_content = $rtwmer_privacy_page_data['rtwmer_setting_privacy_content'];
        }
    }

?>

    <div class = "rtwmer-section-content rtwmer_card rtwmer_wrapper_div" id = "rtwmer-privacy-policy">
        <h3 class = "rtwmer-setting-heading"><?php esc_html_e( 'Privacy Policy','rtwmer-mercado' ) ?></h3>
        <div class = "rtwmer-subsetting-content">
            <ul>
            <?php 
                $rtwmer_privacy_policy_page_array = array(
                    "<li><label> ".esc_html__( 'Enable Privacy Policy','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_enable_privacy_policy' class='mdc-checkbox__native-control rtwmer_privacy_policy_page_data rtwmer_enable_privacy_policy' name='rtwmer_enable_privacy_policy'".(isset( $rtwmer_enable_privacy_policy ) ? ( ($rtwmer_enable_privacy_policy == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'Enable privacy policy for Vendor store contact form','rtwmer-mercado' )."</p>
                        </span>
                    </li>"
                );
                $rtwmer_privacy_policy_page_array = apply_filters('rtwmer_privacy_policy_add_meta_data',$rtwmer_privacy_policy_page_array);
                if( isset($rtwmer_privacy_policy_page_array) && is_array($rtwmer_privacy_policy_page_array) && !empty($rtwmer_privacy_policy_page_array) )
                {
                    foreach($rtwmer_privacy_policy_page_array as $key => $value)
                    {
                        if( isset($value) && !empty($value) )
                        {
                            // $value holds html
                            echo $value;
                        }
                    }
                }
            ?>
                <li><label><?php esc_html_e( 'Privacy Policy Page','rtwmer-mercado' ) ?></label><span>
                    <?php 
                        if( isset( $rtwmer_setting_privacy_page ) && !empty( $rtwmer_setting_privacy_page ) )
                        {
                            ?>
                                <div class='rtwmer_select_box'>
                                    <?php
                                        wp_dropdown_pages(array(
                                        'show_option_none' => 'Select Page',
                                        'option_none_value' => 'not_selected',
                                        'name' => 'rtwmer-setting-privacy-page',
                                        'id' => 'rtwmer-setting-privacy-page',
                                        'class' => 'rtwmer-select-text',
                                        'selected' => $rtwmer_setting_privacy_page
                                        ));
                                    ?>
                                    <label class='rtwmer_select_label'><?php esc_html_e( 'Privacy & Policy Page','rtwmer-mercado' ); ?></label>
                                </div>
                            <?php
                        }
                        else
                        {
                            ?>
                                <div class='rtwmer_select_box'>
                                    <?php
                                        wp_dropdown_pages(array(
                                        'show_option_none' => 'Select Page',
                                        'option_none_value' => 'not_selected',
                                        'name' => 'rtwmer-setting-privacy-page',
                                        'id' => 'rtwmer-setting-privacy-page',
                                        'class' => 'rtwmer-select-text'
                                        ));
                                    ?>
                                    <label class='rtwmer_select_label'><?php esc_html_e( 'Privacy & Policy Page','rtwmer-mercado' ); ?></label>
                                </div>
                            <?php
                        }
                    ?>
                    <p class = "rtwer-notice"><?php esc_html_e( 'Select a page to show your privacy policy','rtwmer-mercado' ) ?><p></span>
                </li>

                <li><label class = "rtwmer_privacy_policy"><?php esc_html_e( 'Privacy Policy','rtwmer-mercado' ) ?></label>
                <span>
                    <label class="mdc-text-field  rtwmer-w-50 mdc-text-field--textarea mdc-text-field--no-label">
                        <textarea  class=" mdc-text-field__input rtwmer_privacy_policy_content" name='rtwmer_privacy_policy' aria-label="Label" id="rtwmer-setting-privacy-content"><?php esc_html( isset($rtwmer_setting_privacy_content) ? $rtwmer_setting_privacy_content : "") ?></textarea>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                    </label>
                </span>
                </li>
                <p class = "submit"><input type = "submit" name = "submit" id = "rtwmer-privacy-submit" class = "mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer-button" value = "<?php esc_html_e('Save Changes','rtwmer-mercado') ?>"></p>
            </ul>    
        </div>
        <?php do_action('rtwmer_mercado_privacy_policy_page'); ?>
    </div>