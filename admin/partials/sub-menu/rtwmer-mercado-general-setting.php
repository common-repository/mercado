<!-- File contain displaying general section of setting tab -->

<?php

    //Code to get data from options table

    $rtwmer_access_admin_area = 1;
    $rtwmer_store_url = 'store';
    $rtwmer_wizard_logo_id = get_bloginfo( 'name' );
    $rtwmer_welcome_wizard = 0;
    $rtwmer_store_terms = 1;

    if( current_user_can('manage_options' ))
    {
        if( ! empty(get_option('rtwmer_general_setting')) )
        {
            $rtwmer_general_page_options = get_option('rtwmer_general_setting');

                if( is_array($rtwmer_general_page_options) && ! empty($rtwmer_general_page_options) )
                {
                    if( isset($rtwmer_general_page_options['rtwmer_access_admin_area']) )
                    {
                        $rtwmer_access_admin_area = $rtwmer_general_page_options['rtwmer_access_admin_area'];
                    }
                    if( isset($rtwmer_general_page_options['rtwmer_store_url']) )
                    {
                        $rtwmer_store_url = $rtwmer_general_page_options['rtwmer_store_url'];
                    }
                    if( isset($rtwmer_general_page_options['rtwmer_store_setup_instruction']) )
                    {
                        $rtwmer_store_setup_instructions = $rtwmer_general_page_options['rtwmer_store_setup_instruction'];
                    }
                    if( isset($rtwmer_general_page_options['rtwmer_wizard_logo_id']) )
                    {
                        $rtwmer_wizard_logo_id = $rtwmer_general_page_options['rtwmer_wizard_logo_id'];
                    }
                    if( isset($rtwmer_general_page_options['rtwmer_welcome_wizard']) )
                    {
                        $rtwmer_welcome_wizard = $rtwmer_general_page_options['rtwmer_welcome_wizard'];
                    }
                    if( isset($rtwmer_general_page_options['rtwmer_store_terms']) )
                    {
                        $rtwmer_store_terms = $rtwmer_general_page_options['rtwmer_store_terms'];
                    }
                    if( isset($rtwmer_general_page_options['rtwmer_hide_cust_info_form_order']) )
					{
						$rtwmer_hide_cust_info_form_order = $rtwmer_general_page_options['rtwmer_hide_cust_info_form_order'];
					}
                }
        }
    }
?>

    <div class = "rtwmer-section-content rtwmer_card rtwmer_wrapper_div" id = "rtwmer-general">
        <h5 class = "rtwmer-setting-heading rtwmer_general_setting_updated "><?php esc_html_e( 'Site Options','rtwmer-mercado' ); ?></h5>
        <form class = "rtwmer-subsetting-content" method = "post" action = "">
            <ul>
            <?php
                $rtwmer_general_page_fields_array  = array(
                    "<li><label> ".esc_html__( 'Admin area access','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' class='mdc-checkbox__native-control rtwmer_general_setting_page_data' id = 'rtwmer_access_admin_area' ".(isset( $rtwmer_access_admin_area ) ? ( ($rtwmer_access_admin_area == 1) ? "checked='checked'" : "" ) : "")."
                                name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__('Disallow Vendors from accessing the wp-admin dashboard area','rtwmer-mercado' )."</p>
                        </span>
                    </li>",
                    "<li><label> ".esc_html__('Vendor Store URL','rtwmer-mercado')."</label>
                        <span>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_general_setting_page_data' id='rtwmer_store_url' value=".(isset($rtwmer_store_url) ? (esc_attr ($rtwmer_store_url)) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                    <div class='mdc-notched-outline__notch' >
                                    <span class='mdc-floating-label' >".esc_html__('Vendor Store URL','rtwmer-mercado')."</span>
                                    </div>
                                    <div class='mdc-notched-outline__trailing'></div>
                                </div>
							</label>
                            <p class='rtwer-notice py-1'> ".esc_html__('Define the Vendor store URL (http://localhost/wc/wordpress/[this-text]/[vendor-name])','rtwmer-mercado')." <p>
                        </span>
                    </li>",
                    "<input type = 'hidden' id='rtwmer_wizard_logo_id' class='rtwmer_general_setting_page_data' value = ".(isset($rtwmer_wizard_logo_id) ? (esc_attr($rtwmer_wizard_logo_id)) : "").">",
                    "<li><label> ".esc_html__( 'Vendor Setup Wizard Logo','rtwmer-mercado' )." </label>
                        <span>
                            <label class='mdc-text-field mdc-text-field--outlined rtwmer-w-50'>
                                <input type='text' class='mdc-text-field__input rtwmer_textbox_width rtwmer_edit_vendor_details_data' id='rtwmer_vendor_wizard_logo' value = ".(isset($rtwmer_wizard_logo_id) ? (esc_url( wp_get_attachment_url($rtwmer_wizard_logo_id) )) : "" ).">
                                <div class='mdc-notched-outline mdc-notched-outline--upgraded'>
                                    <div class='mdc-notched-outline__leading'></div>
                                    <div class='mdc-notched-outline__notch' >
                                    <span class='mdc-floating-label' >".esc_html__('Wizard Logo Url','rtwmer-mercado')."</span>
                                    </div>
                                    <div class=' mdc-notched-outline__trailing'></div>
                                </div>
                            </label>
                            <button class='mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_upload_wizard_logo_button' id = 'rtwmer_upload_logo_button'>
                                <span class='mdc-button__label'>".esc_html__('Upload','rtwmer-mercado')."</span>
                                <div class='mdc-button__ripple'></div>
                            </button>
                            <p class = 'rtwer-notice'> ".esc_html__( 'Recommended Logo size ( 270px X 90px ). If no logo is uploaded, site title is shown by default.','rtwmer-mercado' )."<p>
                        </span>
                    </li>",
                    "<li><label> ".esc_html__( 'Disable Welcome Wizard','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_welcome_wizard' class='mdc-checkbox__native-control rtwmer_general_setting_page_data' ".(isset( $rtwmer_welcome_wizard ) ? ( ($rtwmer_welcome_wizard == 1) ? "checked='checked'" : "" ) : "")."
                            name = ''> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'Disable welcome wizard for newly registered vendors','rtwmer-mercado' )."</p>
                        </span>
                    </li>",
                    "<h5 class = 'rtwmer-setting-heading'> ".esc_html__( 'Vendor Store Options','rtwmer-mercado' )." </h5>",
                    "<li><label> ".esc_html__( 'Store Terms and Conditions','rtwmer-mercado' )." </label>
                        <span class='rtwmer-general-setting-span'>
                            <div class='mdc-checkbox  mdc-data-table__row-checkbox'>
                                <input type='checkbox' id='rtwmer_store_terms' class='mdc-checkbox__native-control rtwmer_general_setting_page_data' ".(isset( $rtwmer_store_terms ) ? ( ($rtwmer_store_terms == 1) ? "checked='checked'" : "" ) : "")."> 
                                <div class='mdc-checkbox__background'>
                                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                                    </svg>
                                    <div class='mdc-checkbox__mixedmark'></div>
                                </div>
                                <div class='mdc-checkbox__ripple'></div>
                            </div>
                            <p>".esc_html__( 'Enable Terms and Conditions for vendor stores','rtwmer-mercado' )."</p>
                        </span>
                    </li>",
                    "<li><label class = 'rtwmer_privacy_policy'>". esc_html__( 'Store Setup Instructions','rtwmer-mercado' ) ."</label>
                    <span>
                        <label class='mdc-text-field  rtwmer-w-50 mdc-text-field--textarea mdc-text-field--no-label'>
                            <textarea  class=' mdc-text-field__input rtwmer_textbox_width rtwmer_general_setting_page_data' id='rtwmer_store_setup_instruction' aria-label='Label'>". esc_html( isset($rtwmer_store_setup_instructions) ? $rtwmer_store_setup_instructions : "") ."</textarea>
                            <span class='mdc-notched-outline'>
                                <span class='mdc-notched-outline__leading'></span>
                                <span class='mdc-notched-outline__trailing'></span>
                            </span>
                        </label>
                    </span>
                    </li>",
                    "<li><label> ".esc_html__( 'Hide Customer info',"rtwmer-mercado" )." </label>
				<span class='rtwmer-general-setting-span'>
					<div class='mdc-checkbox  mdc-data-table__row-checkbox'>
						<input type='checkbox' id='rtwmer_hide_cust_info_form_order' class='mdc-checkbox__native-control rtwmer_selling_option_page_data'".(isset( $rtwmer_hide_cust_info_form_order ) ? ( ($rtwmer_hide_cust_info_form_order == 1) ? "checked='checked'" : "" ) : "")."
					name = ''> 
						<div class='mdc-checkbox__background'>
							<svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
								<path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
							</svg>
							<div class='mdc-checkbox__mixedmark'></div>
						</div>
						<div class='mdc-checkbox__ripple'></div>
					</div>
					<p>".esc_html__( 'Hide customer information from order details of vendors',"rtwmer-mercado" )."</p>
				</span>
			</li>"
                );
                
                $rtwmer_general_page_fields_array = apply_filters('rtwmer_general_page_meta_data',$rtwmer_general_page_fields_array);

                if( isset($rtwmer_general_page_fields_array) && is_array($rtwmer_general_page_fields_array) )
                {
                    foreach($rtwmer_general_page_fields_array as $key => $value)
                    {
                        // $value conntains html==//
                        
                        echo $value;
                    }
                }
                ?>
            </ul>
                <?php
                    $rtwmer_mercado_url = add_query_arg( array(
                        'page' => 'rtwmer-mercado#dashboard'
                    ),admin_url('admin.php'));
                ?>
            <p class="button-wrapper"><input type = "submit" name = "submit" id = "rtwmer-general-page-submit" class = "rtwmer-button mdc-button mdc-button--raised mdc-ripple-upgraded" value = "<?php esc_html_e('Save Changes','rtwmer-mercado') ?>"><span><a href="<?php echo isset($rtwmer_mercado_url) ? esc_url($rtwmer_mercado_url) : ""; ?>" class = "mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_store_setup_skip_btn"><?php esc_html_e('Skip For Now','rtwmer-mercado'); ?></a></span></p>
                   
        </form>
        <?php do_action('rtwmer_mercado_general_page'); ?>
    </div>


 
