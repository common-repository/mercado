<!-- File contain displaying appearence section of setting tab -->

<?php    

    // Default data for variables

    $rtwmer_enable_map = 1;
    $rtwmer_current_using_map = 'google_map';
    $rtwmer_google_map_value = 0;
    $rtwmer_mapbox_value = 0;
    $rtwmer_vendor_contact_form = 0;
    $rtwmer_store_timing_widget = 1;
    $rtwmer_show_store_sidebar = 0; 
    
    // Get data from options table   
    
    if( current_user_can('manage_options') )
    {
        if( !empty(get_option('rtwmer_appearence_page')) )
        {
            $rtwmer_appearence_page_data = get_option('rtwmer_appearence_page');
            if( is_array($rtwmer_appearence_page_data) && !empty($rtwmer_appearence_page_data) )
            {
                if( isset($rtwmer_appearence_page_data['rtwmer_enable_map']) )
                {
                    $rtwmer_enable_map = $rtwmer_appearence_page_data['rtwmer_enable_map'];
                }
                if( isset($rtwmer_appearence_page_data['rtwmer_current_using_map']) )
                {
                    $rtwmer_current_using_map = $rtwmer_appearence_page_data['rtwmer_current_using_map'];
                }
                if( isset($rtwmer_appearence_page_data['rtwmer_google_map_value']) )
                {
                    $rtwmer_google_map_value = $rtwmer_appearence_page_data['rtwmer_google_map_value'];   
                }
                if( isset($rtwmer_appearence_page_data['rtwmer_mapbox_value']) )
                {
                    $rtwmer_mapbox_value = $rtwmer_appearence_page_data['rtwmer_mapbox_value'];
                }
                if( isset($rtwmer_appearence_page_data['rtwmer_vendor_contact_form']) )
                {
                    $rtwmer_vendor_contact_form = $rtwmer_appearence_page_data['rtwmer_vendor_contact_form'];   
                }
                if( isset($rtwmer_appearence_page_data['rtwmer_store_timing_widget']) )
                {
                    $rtwmer_store_timing_widget = $rtwmer_appearence_page_data['rtwmer_store_timing_widget'];
                }
                if( isset($rtwmer_appearence_page_data['rtwmer_show_store_sidebar']) )
                {
                    $rtwmer_show_store_sidebar = $rtwmer_appearence_page_data['rtwmer_show_store_sidebar'];
                }
            }
        }
    }
     
    ?>
    <div class = "rtwmer-section-content rtwmer_card rtwmer_wrapper_div" id = "rtwmer-appearence">
        <h3 class = "rtwmer-setting-heading"><?php esc_html_e( 'Appearance','rtwmer-mercado' ) ?></h3>
        <div class = "rtwmer-subsetting-content rtwmer_subsetting_apperance rtwmer-apperance">
            <ul>
            <?php 
                $rtwmer_appearence_page_data_array = array(
                    "<li><label> ".esc_html__( 'Show Map on Store Page','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_enable_map' class='mdc-checkbox__native-control rtwmer_appearence_page_data rtwmer_enable_map' name='rtwmer_enable_map'".(isset( $rtwmer_enable_map ) ? ( ($rtwmer_enable_map == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'Enable Map of the Store Location in the store sidebar','rtwmer-mercado' )."</p>
                        </span>
                    </li>",
                    "<li>
                        <label> ".esc_html__( 'Map API Source','rtwmer-mercado' )." </label>
                        <div class = 'rtwmer-right-side'>
 
                            <span><input type = 'radio' id = 'rtwmer-google-map' ".(isset( $rtwmer_current_using_map ) ? ( ($rtwmer_current_using_map == 'google_map') ? "checked='checked'" : "" ) : "")." name = 'rtwmer_map_api'> ".esc_html__( 'Google Maps','rtwmer-mercado' )." </span>
                            <span><input type = 'radio' id = 'rtwmer-mapbox' ".(isset( $rtwmer_current_using_map ) ? ( ($rtwmer_current_using_map == 'mapbox') ? "checked='checked'" : "" ) : "")." name = 'rtwmer_map_api'> ".esc_html__( 'Mapbox','rtwmer-mercado' )." </span>
                            <p class = 'rtwer-notice'> ".esc_html__( 'Which Map API source you want to use in your site?','rtwmer-mercado' )." </p>
                        </div>
                    </li>",
                    "<li class='rtwmer-mercado-map-api'>
                    <label> ".esc_html__( 'Map API Source','rtwmer-mercado' )." </label>
                        <span class='rtwmer_map_api_span'>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50 rtwmer_map_api_label'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_appearence_page_data' id='rtwmer_google_map_value' name='rtwmer_google_map_value' value = ".(isset($rtwmer_google_map_value) ? ($rtwmer_google_map_value) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                        <div class='mdc-notched-outline__notch' >
                                            <span class='mdc-floating-label'>".esc_html__('Map API Source','rtwmer-mercado')."</span>
                                        </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                            <p class = 'rtwer-notice rtwmer_notice_margin'><a href = ".esc_url( 'https://developers.google.com/maps/documentation/javascript/tutorial/' )." target='_blank'> ".esc_html__('API Key','rtwmer-mercado')." </a> ".esc_html__( 'is needed to display map on store page' , 'rtwmer-mercado' )." </p>
                        </span>
                    </li>",
                    "<li class = 'rtwmer-mercado-mapbox'><label> ".esc_html__( 'Mapbox Access Token','rtwmer-mercado' )." </label>
                        <span class='rtwmer_map_api_span'>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50 rtwmer_map_api_label'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_appearence_page_data' id='rtwmer_mapbox_value' name='rtwmer_mapbox_value' value = ".(isset($rtwmer_mapbox_value) ? ($rtwmer_mapbox_value) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                        <div class='mdc-notched-outline__notch' >
                                            <span class='mdc-floating-label' >".esc_html__('Mapbox Access Token','rtwmer-mercado')."</span>
                                        </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                            <p class = 'rtwer-notice rtwmer_notice_margin'><a href = ".esc_url( 'https://docs.mapbox.com/help/how-mapbox-works/access-tokens/' ) ." target='_blank'> ".esc_html__( 'Access Token','rtwmer-mercado' ) ."</a> ".esc_html__( 'is needed to display map on store page','rtwmer-mercado' ) ."</p>
                        </span>
                    </li>",
                    "<li><label> ".esc_html__( 'Show Contact Form on Store Page','rtwmer-mercado' )." </label>
                        <div>
                            <span class='rtwmer-general-setting-span'>
                                <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                    <input type='checkbox' id='rtwmer_vendor_contact_form' class='mdc-checkbox__native-control rtwmer_appearence_page_data rtwmer_vendor_contact_form' name='rtwmer_vendor_contact_form'".(isset( $rtwmer_vendor_contact_form ) ? ( ($rtwmer_vendor_contact_form == 1) ? "checked='checked'" : "" ) : "")."
                                name = ''> 
                                    <div class='mdc-checkbox__background'>
                                        <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                            <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                        </svg>
                                        <div class='mdc-checkbox__mixedmark'></div>
                                    </div>
                                    <div class='mdc-checkbox__ripple'></div>
                                </div>
                                <p>".esc_html__( 'Display a vendor contact form in the store sidebar','rtwmer-mercado' )."</p>
                            </span>
                        </div>
                    </li>",
                    "<li><label> ".esc_html__( 'Store Opening Closing Time Widget','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_store_timing_widget' class='mdc-checkbox__native-control rtwmer_appearence_page_data rtwmer_store_timing_widget' name='rtwmer_store_timing_widget'".(isset( $rtwmer_store_timing_widget ) ? ( ($rtwmer_store_timing_widget == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'Enable store opening & closing time widget in the store sidebar','rtwmer-mercado' )."</p>
                        </span>
                    </li>",
                    "<li><label> ".esc_html__( 'Enable Store Sidebar From Theme','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_show_store_sidebar' class='mdc-checkbox__native-control rtwmer_appearence_page_data rtwmer_show_store_sidebar' name='rtwmer_show_store_sidebar'".(isset( $rtwmer_show_store_sidebar ) ? ( ($rtwmer_show_store_sidebar == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'Enable showing Store Sidebar From Your Theme','rtwmer-mercado' )."</p>
                        </span>
                    </li>"
                );
                $rtwmer_appearence_page_data_array = apply_filters('rtwmer_appearence_page_add_meta_data',$rtwmer_appearence_page_data_array);
                if( isset($rtwmer_appearence_page_data_array) && is_array($rtwmer_appearence_page_data_array) )
                {
                    foreach($rtwmer_appearence_page_data_array as $key => $value)
                    {
                        if( isset($value) && !empty($value) )
                        {
                            // $value conntains html==//

                            echo $value;
                        }
                    }
                }
            ?>

                <p class="button-wrapper"><input type = "submit" name = "submit" id = "rtwmer-appearence-submit" class = "mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer-button" value = "<?php esc_html_e('Save Changes','rtwmer-mercado') ?>"><span><a href="<?php echo isset($rtwmer_mercado_url) ? esc_url($rtwmer_mercado_url) : ""; ?>" class = "mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_store_setup_skip_btn"><?php esc_html_e('Skip For Now','rtwmer-mercado'); ?></a></span></p>
            </ul>
        </div>
        <?php do_action('rtwmer_mercado_appearence_page'); ?>
    </div>