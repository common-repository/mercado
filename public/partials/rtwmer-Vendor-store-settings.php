
<!-- This file contains the html for store setting section -->
<?php global $rtwmer_user_id_for_dashboard; ?>
<div class="rtwmer_store_setting_wrap">
    <div class="rtwmer_store_settings_box">
        <div class="rtwmer-vendor-store-setting-wrapper">
            <h4 class="rtwmer_section_heading"><?php esc_html_e("Store Setting", "rtwmer-mercado") ?></h4>
            <?php
            $rtwmer_banner_sec = ' <div class="rtwmer-store-banner-section mdc-layout-grid">
            <img class="mdc-image-list__image"';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_store_img", true)) {
                $rtwmer_banner_sec .= "src='" . esc_url(wp_get_attachment_image_src(intval(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_store_img", true)))[0]) . "'";
                $rtwmer_bannewr_button_text = "Change Banner";
                $rtwmer_banner_img_id = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_store_img", true);
            } else {
                $rtwmer_banner_sec .= 'src=""';
                $rtwmer_banner_img_id = "";
                $rtwmer_bannewr_button_text = "Upload Banner";
            }
            $rtwmer_banner_sec .= 'id="rtwmer_store_img_preview">
            <div class="rtwmer_banner_remove">
                <span class="rtwmer_banner_remove_button material-icons">
                    clear
                </span>
            </div>
            <div class="rtwmer-banner-btn">
                <button type="button" id="rtwmer_store_upload_button" class="mdc-button mdc-button--raised mdc-ripple-upgraded">
                    <span class="mdc-button__label">' . esc_html__($rtwmer_bannewr_button_text, "rtwmer-mercado") . '</span>
                    <div class="mdc-button__ripple"></div>
                </button>
                <input type="hidden" name="rtwmer_store_banner_id" id="rtwmer_store_img_id" value="' . $rtwmer_banner_img_id . '">
            </div>
            </div>';
            $rtwmer_store_html[] = $rtwmer_banner_sec;
            $rtwmer_profile_sec = '<div class="rtwmer-profile-section">       
            <div class="rtwmer-profile-div">
                <img id="rtwmer_profile_img_preview" ';
                        if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_profile_img", true)) {
                            $rtwmer_profile_sec .= "src='" . esc_url(wp_get_attachment_image_src(intval(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_profile_img", true)))[0]) . "'";
                            $rtwmer_profile_button_text = "Change Profile";
                            $rtwmer_profile_img_id = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_profile_img", true);
                        } else {
                            $rtwmer_profile_sec .= 'src="'.RTWMER_ASSETS_URL.'/images/profile-picture.png"';
                            $rtwmer_profile_img_id = "";
                            $rtwmer_profile_button_text = "Upload Profile";
                        }
                        $rtwmer_profile_sec .= '>
                        </div>
                        
                        <input type="hidden" name="rtwmer_profile_id" id="rtwmer_profile_img_id" value="' . $rtwmer_profile_img_id . '">
            <button type="button" id="rtwmer_profile_upload_button" class="mdc-button mdc-button--raised mdc-ripple-upgraded">
                <span class="mdc-button__label">' . esc_html__($rtwmer_profile_button_text, "rtwmer-mercado") . '</span>
                <div class="mdc-button__ripple"></div>
            </button>
            <button style="display:none;" type="button"  id="rtwmer_remove_profile_btn" class="mdc-button mdc-button--raised mdc-ripple-upgraded">
                <span class="mdc-button__label">' . esc_html__("Remove profile", "rtwmer-mercado") . '</span>
                <div class="mdc-button__ripple"></div>
            </button>
            </div>';
            $rtwmer_store_html[] = $rtwmer_profile_sec;
            $rtwmer_store_html[] = '<div class="rtwmer-store-form mdc-elevation--z4 mdc-layout-grid">           
            <ul class="mdc-list">';
                $rtwmer_store_html[] = '<li>
                <label>' . esc_html__("Store Product Per Page", "rtwmer-mercado") . '</label>
                <span>
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="number" class="mdc-text-field__input" id="rtwmer_store_ppp" name="store_ppp" value="' . esc_attr__(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_prod_per_page", true)) . '">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">' . esc_html__("Store Product Per Page", "rtwmer-mercado") . '</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                </span>
                </li>';
                            $rtwmer_store_html[] = ' <li>
                <label>' . esc_html__("Street", "rtwmer-mercado") . '</label>
                <span>
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="text" class="mdc-text-field__input"  id="rtwmer_address_one" name="address[street_1]" value="' . esc_attr__(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_address1", true)) . '">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">' . esc_html__("Street", "rtwmer-mercado") . '</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                </span>
                </li>';

                            $rtwmer_store_html[] = ' <li>
                <label>' . esc_html__("Street 2t", "rtwmer-mercado") . '</label>
                <span>
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="text" class="mdc-text-field__input"  id="rtwmer_address_two" name="address[street_2]" value="' . esc_attr__(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_address2", true)) . '">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">' . esc_html__("Street 2t", "rtwmer-mercado") . '</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                </span>
                </li>';

                $rtwmer_store_html[] = '<li>
                <label>' . esc_html__("Phone", "rtwmer-mercado") . '</label>
                <span>
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="text" class="mdc-text-field__input" id="rtwmer_vendor_phone" name="rtwmer_vendor_phone" value="' . esc_attr((int) get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_phone", true)) . '">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">' . esc_html__("Phone", "rtwmer-mercado") . '</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                </span>
                </li>';
                            $rtwmer_country_html =  '<li>
                <label>' . esc_html__('Countries', 'rtwmer-mercado') . '</label>
                <span>';

                            global $woocommerce;
                            $countries_obj   = new WC_Countries();
                            $countries   = $countries_obj->__get('countries');
                            $default_country = $countries_obj->get_base_country();
                            $default_county_states = $countries_obj->get_states($default_country);
                            ob_start();
                            woocommerce_form_field(
                                'rtwmer_country',
                                array(
                                    'type'       => 'select',
                                    'class'      => array('rtwmer_country'),
                                    'placeholder'    => esc_attr__('Enter something',"rtwmer-mercado"),
                                    'return'  => false,
                                    'options'    => $countries
                                ),
                                get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_country", true)
                            );
                            $rtwmer_country_html .= ob_get_clean();
                            $rtwmer_country_html .= '</span>
                </li>';
                            $rtwmer_store_html[] = $rtwmer_country_html;
                            $rtwmer_store_html[] = '<li>
                <label>' . esc_html__("State", "rtwmer-mercado") . '</label>
                <span>
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="text" class="mdc-text-field__input" id="rtwmer_calc_shipping_state" name="address[state]" value="' . esc_attr(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_state", true)) . '">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">' . esc_html__("State", "rtwmer-mercado") . '</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                </span>
                </li>';

                $rtwmer_store_html[] =  '<li>
                <label>' . esc_html__("City", "rtwmer-mercado") . '</label>
                <span>
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="text" class="mdc-text-field__input" id="rtwmer_address_city" name="address[city]" value="' . esc_attr(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_city", true)) . '">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">' . esc_html__("City", "rtwmer-mercado") . '</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                </span>
                </li>';

                $rtwmer_store_html[] = ' <li>
                <label>' . esc_html__("Post/Zip Code", "rtwmer-mercado") . '</label>
                <span>
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="text" class="mdc-text-field__input" id="rtwmer_address_zip" name="address[zip]" value="' . esc_attr(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_zip", true)) . '">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">' . esc_html__("Post/Zip Code", "rtwmer-mercado") . '</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                </span>
                </li>';
                
                $rtwmer_store_html[] =  '<li>
                <label>' . esc_html__("Map", "rtwmer-mercado") . '</label>
                <span>
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="text" class="mdc-text-field__input rtwmer_map_key" id="rtwmer_map_api_key" name="rtwmer_map_key" value="' . esc_attr(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_map_api_key", true)) . '">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">' . esc_html__("Map", "rtwmer-mercado") . '</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                    <div class="rtwmer_vendor_map"></div>
                </span>
                </li>';
            $rtwmer_show_email_checkbox = '<li>
            <label>' . esc_html__("Email", "rtwmer-mercado") . '</label>
            <span class="rtwmer-d-flex">
                <div class="mdc-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded rtwmer_default_checkbox_css">
                    <input type="checkbox" class="mdc-checkbox__native-control switch-input" name="show_email" id="rtwmer_show_email" ';
                        if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_vendor_show_email", true)) {
                            $rtwmer_show_email_checkbox .= "checked";
                        }
                        $rtwmer_show_email_checkbox .= '><div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                </div>
                <p>' . esc_html__("Show email address in store", "rtwmer-mercado") . '</p>
            </span>
            </li>';
            $rtwmer_store_html[] = $rtwmer_show_email_checkbox;
            $rtwmer_show_more_tabs = '<li class="rtwmer-w-100">
            <label>' . esc_html__("Show more tab", "rtwmer-mercado") . '</label>
            <span class="rtwmer-d-flex">
                <div class="mdc-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded rtwmer_default_checkbox_css">
                    <input type="checkbox" name="show_email" id="rtwmer_show_more_tab" class="mdc-checkbox__native-control" ';
                        if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_show_more_tab", true)) {
                            $rtwmer_show_more_tabs .= "checked";
                        }
                        $rtwmer_show_more_tabs .= '><div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                </div>
                <p>' . esc_html__("Enable tab on product single page view", "rtwmer-mercado") . '</p>
            </span>
            </li>';
            $rtwmer_store_html[] = $rtwmer_show_more_tabs;

            $rtwmer_show_widget =  '<li class="rtwmer-w-100">
            <label>' . esc_html__("Store Opening Closing Time", "rtwmer-mercado") . '</label>
            <span class="rtwmer-d-flex">
                <div class="mdc-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded rtwmer_default_checkbox_css">
                    <input type="checkbox" class="mdc-checkbox__native-control rtwmer_switch-input" name="show_time_widget" id="rtwmer_show_time_widget"';
                    $rtwmer_shop = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_show_time_widget");

                    if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_show_time_widget", true) == true && $rtwmer_shop[0] != 'false'  ) {        
                        $rtwmer_show_widget .= "checked";
                    }
                $rtwmer_show_widget .= '><div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                </div>
                <p>' . esc_html__("Show store opening closing time widget in store page", "rtwmer-mercado") . '</p>
            </span>
            </li>';
            $rtwmer_store_html[] = $rtwmer_show_widget;
            $rtwmer_modal_time = '<div class="rtwmer_modal" id="rtwmer_timming_modal">
<div class="rtwmer_setup_days_box mdc-elevation--z9 rtwmer-modal-dialog">
<div class="rtwmer-store-close-btn rtwmer-modal-header">
      <a class="mdc-icon-button material-icons mdc-ripple-upgraded rtwmer-modal-close mdc-ripple-upgraded--unbounded" aria-pressed="false">highlight_off</a>
    </div>
  <div class="rtwmer-date-modal-content">
      <div class="rtwmer_setup_day_row">
      <span class="rtwmer_days_span">
       ' . esc_html__("Sunday", "rtwmer-mercado") . '
      </span>';
            $rtwmer_modal_time .= '<select class="rtwmer_days" id="rtwmer_sunday">
    <option value="close">' . esc_html__("close", "rtwmer-mercado") . '</option>
    <option value="open"';
            if (isset($rtwmer_sun_state)  && $rtwmer_sun_state['status'] == 'open') {
                $rtwmer_modal_time .= "selected";
            }
            $rtwmer_modal_time .= '> ' . esc_html__("Open", "rtwmer-mercado") . '</option>
</select>';
            $rtwmer_modal_time .=  '<div class="rtwmer_setup_timing"><input type="text" class="rtwmer_timing_input" id="rtwmer_sunday_open_time" name="rtwmer_sunday_open_time" placeholder="Select time From" value="';
            if (isset($rtwmer_sun_state['store_open-time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_sun_state['store_open-time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '"><input type="text" class="rtwmer_timing_input" id="rtwmer_sunday_close_time" name="rtwmer_sunday_close_time" placeholder="Select time To" value="';
            if (isset($rtwmer_sun_state['store_close_time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_sun_state['store_close_time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">';
            $rtwmer_modal_time .= '</div>
    </div>
    <div class="rtwmer_setup_day_row">
      <span class="rtwmer_days_span">
        ' . esc_html__("Monday", "rtwmer-mercado") . '
      </span>';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)) {
                $rtwmer_mon_state = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)['Monday'];
            }
            $rtwmer_modal_time .= '<select class="rtwmer_days" id="rtwmer_monday">
    <option value="open">' . esc_html__("Open", "rtwmer-mercado") . '</option>
    <option value="close"';
            if (isset($rtwmer_mon_state) && $rtwmer_mon_state['status'] == 'close') {
                $rtwmer_modal_time .= "selected";
            }
            $rtwmer_modal_time .= '>' . esc_html__("close", "rtwmer-mercado") . '</option>
</select>';
            $rtwmer_modal_time .= '<div class="rtwmer_setup_timing"><input type="text" class="rtwmer_timing_input" id="rtwmer_monday_open_time" name="rtwmer_monday_open_time" placeholder="Select time From" value="';
            if (isset($rtwmer_mon_state['store_open-time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_mon_state['store_open-time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">
                          <input type="text" class="rtwmer_timing_input" id="rtwmer_monday_close_time" name="rtwmer_monday_close_time" placeholder="Select time To" value="';
            if (isset($rtwmer_mon_state['store_close_time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_mon_state['store_close_time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">';
            $rtwmer_modal_time .= '</div>
    </div>
    <div class="rtwmer_setup_day_row">
      <span class="rtwmer_days_span">
        ' . esc_html__("Tuesday", "rtwmer-mercado") . '
      </span>';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)) {
                $rtwmer_tues_state = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)['Tuesday'];
            }
            $rtwmer_modal_time .= '<select class="rtwmer_days" id="rtwmer_tuesday">
                        <option value="open">' . esc_html__("Open", "rtwmer-mercado") . '</option>
                        <option value="close"';
            if (isset($rtwmer_tues_state) && $rtwmer_tues_state['status'] == 'close') {
                $rtwmer_modal_time .= "selected";
            }
            $rtwmer_modal_time .= '>' . esc_html__("close", "rtwmer-mercado") . '</option>
                    </select>';
            $rtwmer_modal_time .= '<div class="rtwmer_setup_timing">';
            $rtwmer_modal_time .= '<input type="text" class="rtwmer_timing_input" id="rtwmer_tuesday_open_time" name="rtwmer_tuesday_open_time" placeholder="Select time From" value="';
            if (isset($rtwmer_tues_state['store_open-time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_tues_state['store_open-time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">
                         <input type="text" class="rtwmer_timing_input" id="rtwmer_tuesday_close_time" name="rtwmer_tuesday_close_time" placeholder="Select time To" value="';
            if (isset($rtwmer_tues_state['store_close_time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_tues_state['store_close_time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">';
            $rtwmer_modal_time .= '</div>
    </div>
    <div class="rtwmer_setup_day_row">
      <span class="rtwmer_days_span">
        ' . esc_html__("Wednesday", "rtwmer-mercado") . '
      </span>';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)) {
                $rtwmer_wed_state = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)['Wednesday'];
            }
            $rtwmer_modal_time .= '<select class="rtwmer_days" id="rtwmer_wednesday">
                        <option value="open">' . esc_html__("Open", "rtwmer-mercado") . '</option>
                        <option value="close"';
            if (isset($rtwmer_wed_state) && $rtwmer_wed_state['status'] == 'close') {
                $rtwmer_modal_time .= "selected";
            }
            $rtwmer_modal_time .= '>' . esc_html__("close", "rtwmer-mercado") . '</option>
                    </select>';
            $rtwmer_modal_time .= '<div class="rtwmer_setup_timing">';
            $rtwmer_modal_time .= '<input type="text" class="rtwmer_timing_input" id="rtwmer_wednesday_open_time" name="rtwmer_wednesday_open_time" placeholder="Select time From" value="';
            if (isset($rtwmer_wed_state['store_open-time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_wed_state['store_open-time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">
                     <input type="text" class="rtwmer_timing_input" id="rtwmer_wednesday_close_time" name="rtwmer_wednesday_close_time" placeholder="Select time To" value="';
            if (isset($rtwmer_wed_state['store_close_time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_wed_state['store_close_time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">';
            $rtwmer_modal_time .=  '</div>
    </div>
    <div class="rtwmer_setup_day_row">
      <span class="rtwmer_days_span">
        ' . esc_html__("Thursday", "rtwmer-mercado") . '
      </span>';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)) {
                $rtwmer_thurs_state = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)['Thursday'];
            }
            $rtwmer_modal_time .= '<select class="rtwmer_days" id="rtwmer_thursday">
                        <option value="open">' . esc_html__("Open", "rtwmer-mercado") . '</option>
                        <option value="close"';
            if (isset($rtwmer_thurs_state) && $rtwmer_thurs_state['status'] == 'close') {
                $rtwmer_modal_time .= "selected";
            }
            $rtwmer_modal_time .= '>' . esc_html__("close", "rtwmer-mercado") . '</option>
                    </select>';
            $rtwmer_modal_time .= '<div class="rtwmer_setup_timing">';
            $rtwmer_modal_time .= '<input type="text" class="rtwmer_timing_input" id="rtwmer_thursday_open_time" name="rtwmer_thursday_open_time" placeholder="Select time From" value="';
            if (isset($rtwmer_thurs_state['store_open-time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_thurs_state['store_open-time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '"><input type="text" class="rtwmer_timing_input" id="rtwmer_thursday_close_time" name="rtwmer_thursday_close_time" placeholder="Select time To" value="';
            if (isset($rtwmer_thurs_state['store_close_time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_thurs_state['store_close_time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">';
            $rtwmer_modal_time .= '</div></div>
    <div class="rtwmer_setup_day_row">
      <span class="rtwmer_days_span">
        ' . esc_html__("Friday", "rtwmer-mercado") . '
      </span>';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)) {
                $rtwmer_fri_state = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)['Friday'];
            }
            $rtwmer_modal_time .= '<select class="rtwmer_days" id="rtwmer_friday">
                                        <option value="open">' . esc_html__("Open", "rtwmer-mercado") . '</option>
                                        <option value="close"';
            if (isset($rtwmer_fri_state) && $rtwmer_fri_state['status'] == 'close') {
                $rtwmer_modal_time .= "selected";
            }
            $rtwmer_modal_time .= '>' . esc_html__("close", "rtwmer-mercado") . '</option>
                                    </select>';
            $rtwmer_modal_time .= '<div class="rtwmer_setup_timing">';

            $rtwmer_modal_time .= '<input type="text" class="rtwmer_timing_input" id="rtwmer_friday_open_time" name="rtwmer_friday_open_time" placeholder="Select time From" value="';
            if (isset($rtwmer_fri_state['store_open-time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_fri_state['store_open-time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '"><input type="text" class="rtwmer_timing_input" id="rtwmer_friday_close_time" name="rtwmer_friday_close_time" placeholder="Select time To" value="';
            if (isset($rtwmer_fri_state['store_close_time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_fri_state['store_close_time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">';
            $rtwmer_modal_time .= '</div>
    </div>
    <div class="rtwmer_setup_day_row">
      <span class="rtwmer_days_span">
        ' . esc_html__("Saturday", "rtwmer-mercado") . '
      </span>';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)) {
                $rtwmer_sat_state = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)['Saturday'];
            }
            $rtwmer_modal_time .= '<select class="rtwmer_days" id="rtwmer_saturday">
                                        <option value="open">' . esc_html__("Open", "rtwmer-mercado") . '</option>
                                        <option value="close"';
            if (isset($rtwmer_sat_state) && $rtwmer_sat_state['status'] == 'close') {
                $rtwmer_modal_time .= "selected";
            }
            $rtwmer_modal_time .= '>' . esc_html__("close", "rtwmer-mercado") . '</option>
                                    </select>';
            $rtwmer_modal_time .= '<div class="rtwmer_setup_timing">
      <input type="text" class="rtwmer_timing_input" id="rtwmer_saturday_open_time" name="rtwmer_saturday_open_time" placeholder="Select time From" value="';
            if (isset($rtwmer_sat_state['store_open-time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_sat_state['store_open-time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '"><input type="text" class="rtwmer_timing_input" id="rtwmer_saturday_close_time" placeholder="Select time To" name="rtwmer_saturday_close_time" value="';
            if (isset($rtwmer_sat_state['store_close_time'])) {
                $rtwmer_modal_time .= esc_attr__($rtwmer_sat_state['store_close_time'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '">';
            $rtwmer_modal_time .= '</div>
    </div>
    <div class="rtwmer-d-flex">
      <label class="rtwmer_time_widgets">
      ' . esc_html__("Store Open Notice", "rtwmer-mercado") . '
      </label>
        <span><label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
            <input type="text" class="mdc-text-field__input" id="rtwmer_store_open_notice" name="rtwmer_store_open_notice" value="';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)) {
                $rtwmer_modal_time .= esc_attr__(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)['Store_open_notice'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '"><div class="mdc-notched-outline mdc-notched-outline--upgraded">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__notch">
                <span class="mdc-floating-label">' . esc_html__("Store Open Notice", "rtwmer-mercado") . '</span>
                </div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>
        </label>';
            $rtwmer_modal_time .= '</span>
    </div>
    <div class="rtwmer-d-flex">
      <label class="rtwmer_time_widgets">
      ' . esc_html__("Store close notice", "rtwmer-mercado") . '</label>
        <span><label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
       <input type="text" class="mdc-text-field__input" id="rtwmer_store_close_notice" name="rtwmer_store_close_notice" value="';
            if (get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)) {
                $rtwmer_modal_time .= esc_attr__(get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_store_time_widget", true)['Store_close_notice'], "rtwmer-mercado");
            }
            $rtwmer_modal_time .= '"><div class="mdc-notched-outline mdc-notched-outline--upgraded">
           <div class="mdc-notched-outline__leading"></div>
           <div class="mdc-notched-outline__notch">
           <span class="mdc-floating-label">' . esc_html__("Store close notice", "rtwmer-mercado") . '</span>
           </div>
           <div class="mdc-notched-outline__trailing"></div>
       </div>
   </label>';
            $rtwmer_modal_time .= '</span>
    </div>
   </div>
   <div class="rtwmer-store-submit-btn rtwmer-modal-footer"> <button class="rtwmer-modal-close mdc-button mdc-button--raised mdc-button--upgraded">' . esc_html__("Save", "rtwmer-mercado") . '</button></div>
</div>
</div>';
            $rtwmer_store_html[] =  $rtwmer_modal_time;
            $rtwmer_store_html[] =  '</ul>
    </div>
    </div>
    </div>
        <div class="rtwmer_store_submit_box">
        <button type="button" data-id="' . esc_attr($rtwmer_user_id_for_dashboard) . '" id="rtwmer_store_submit" class="mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer_submit_button_store">
            <span class="mdc-button__label">' . esc_html__("Submit", "rtwmer-mercado") . '</span>
            <div class="mdc-button__ripple"></div>
        </button>
      </div>';
            $rtwmer_store_html = apply_filters("rtwmer_store_html", $rtwmer_store_html);
            if (isset($rtwmer_store_html) && !empty($rtwmer_store_html)) {
                foreach ($rtwmer_store_html as $key => $rtwmer_value) {
                    echo $rtwmer_value; // This variable holds html
                }
            }
            ?>
        </div>