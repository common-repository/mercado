
<!-- This file contains the code for store page -->

<?Php
global $wpdb;
global $wp;

$rtwmer_options_page_array  =  get_option('rtwmer_page_setting');

$rtwmer_options_array  =  get_option('rtwmer_general_setting');

if(is_array($rtwmer_options_array)){
    $rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];
}
else{
    $rtwmer_endpoint_page = "";
}
$rtwmer_var  =  get_query_var('rtwmer_nicename');
$rtwmer_vendor_detail_obj  =  get_user_by('slug', $rtwmer_var);
if (is_object($rtwmer_vendor_detail_obj)) {
    $rtwmer_vendor_id = $rtwmer_vendor_detail_obj->data->ID;
}
if (isset($rtwmer_vendor_id)) {
    $rtwmer_cap = user_can($rtwmer_vendor_id, "mercador");

    $rtwmer_args = array(
        'author'        =>  $rtwmer_vendor_id,
        'post_type'     => 'product',
        'posts_per_page' => -1
    );

    $rtwmer_current_user_posts = get_posts($rtwmer_args);

    if (is_user_logged_in()) {
        $rtwmer_user = wp_get_current_user();
        $rtwmer_user_name = $rtwmer_user->data->user_nicename;
        $rtwmer_user_email = $rtwmer_user->data->user_email;
    } else {
        $rtwmer_user_name = "";
        $rtwmer_user_email = "";
    }

$rtwmer_endpoint  =  get_query_var('rtwmer_pagename');

    get_header();
    if ($rtwmer_cap) {
        $args = array(
                    'taxonomy'   => "product_cat",
                    'title_li'            => "",
                    'orderby'    => "",
                    'order'      => "ASC",
                    'hide_empty' => "",
                    'echo'   => 0
                );
  $rtwmer_map_per = get_option('rtwmer_appearence_page');

  if (is_array($rtwmer_map_per)) {
                    $rtwmer_map_show = $rtwmer_map_per['rtwmer_enable_map'];
                } else {
                    $rtwmer_map_show = 0;
                }

        $rtwmer_endpoint_html[] = '<div class="rtwmer_store_wrappeer_row gp-container">';
        $rtwmer_endpoint_html[] = '<div class="rtwmer-d-flex">';
           $rtwmer_endpoint_html[] = '<div class="rtwmer_store_sidebar">
           <div class="rtwmer_category_box mdc-elevation--z3">
                <h5 class="text-black-50">
                    <input type="hidden" id="rtwmer_url_path" data-value="'. esc_url(home_url() . "/" . $rtwmer_endpoint_page . "/" . $rtwmer_var).'">';
                     if (!empty($rtwmer_current_user_posts)) {
                     $rtwmer_endpoint_html[]= esc_html__("Store Product Category", "rtwmer-mercado");
                     $rtwmer_endpoint_html[] =  '</h5>
                <div class="rtwmer-border-bottom"></div>'. 
                wp_list_categories($args).'</div>';
                    } else {
                      $rtwmer_endpoint_html[] .=  esc_html__(" No category Found ", "rtwmer-mercado");
                      $rtwmer_endpoint_html[] =  '</div>';
                    } 
                if ($rtwmer_map_show == 1) {
                   $rtwmer_current_map = $rtwmer_map_per['rtwmer_current_using_map'];
                   if($rtwmer_current_map=="googlemap"){
                    
                    $rtwmer_endpoint_html[] = '<div class="rtwmer_map_box mdc-elevation--z3">
                        <h5>'. esc_html__("Store Location", "rtwmer-mercado")  .'</h5>
                        <div class="rtwmer-border-bottom"></div>
                        <div class="rtwmer_map"></div>
                    </div>';
                }else{
                    $rtwmer_mapbox = get_user_meta(get_current_user_id(),"rtwmer_map_api_key",true);
                    $rtwmer_endpoint_html[] = '<div class="rtwmer_map_box mdc-elevation--z3" data-value="'. esc_attr__( $rtwmer_mapbox ,"rtwmer-mercado").'">
                        <h5>'. esc_html__("Store Location", "rtwmer-mercado")  .'</h5>
                        <div class="rtwmer-border-bottom"></div>
                        <div class="rtwmer_map">
                        </div>
                    </div>';  
                } 
            }
            $rtwmer_widget = get_user_meta($rtwmer_vendor_id, "rtwmer_show_time_widget", true);
            if ($rtwmer_widget == '1') {
                $rtwmer_widget_array = get_user_meta($rtwmer_vendor_id, "rtwmer_store_time_widget", true);
                if (is_array($rtwmer_widget_array)) {
                    if ($rtwmer_widget_array['Sunday']['status'] == 'close') {
                        $rtwmer_sun_status = "Close";
                    } else {
                        $rtwmer_sun_status = $rtwmer_widget_array['Sunday']['store_open-time'] . "-" . $rtwmer_widget_array['Sunday']['store_close_time'];
                    }
                    if ($rtwmer_widget_array['Monday']['status'] == 'close') {
                        $rtwmer_mon_status = "Close";
                    } else {
                        $rtwmer_mon_status = $rtwmer_widget_array['Monday']['store_open-time'] . "-" . $rtwmer_widget_array['Monday']['store_close_time'];
                    }
                    if ($rtwmer_widget_array['Tuesday']['status'] == 'close') {
                        $rtwmer_tues_status = "Close";
                    } else {
                        $rtwmer_tues_status = $rtwmer_widget_array['Tuesday']['store_open-time'] . "-" . $rtwmer_widget_array['Tuesday']['store_close_time'];
                    }
                    if ($rtwmer_widget_array['Wednesday']['status'] == 'close') {
                        $rtwmer_weds_status = "Close";
                    } else {
                        $rtwmer_weds_status = $rtwmer_widget_array['Wednesday']['store_open-time'] . "-" . $rtwmer_widget_array['Wednesday']['store_close_time'];
                    }
                    if ($rtwmer_widget_array['Thursday']['status'] == 'close') {
                        $rtwmer_thurs_status = "Close";
                    } else {
                        $rtwmer_thurs_status = $rtwmer_widget_array['Thursday']['store_open-time'] . "-" . $rtwmer_widget_array['Thursday']['store_close_time'];
                    }
                    if ($rtwmer_widget_array['Friday']['status'] == 'close') {
                        $rtwmer_fri_status = "Close";
                    } else {
                        $rtwmer_fri_status = $rtwmer_widget_array['Friday']['store_open-time'] . "-" . $rtwmer_widget_array['Friday']['store_close_time'];
                    }
                    if ($rtwmer_widget_array['Saturday']['status'] == 'close') {
                        $rtwmer_sat_status = "Close";
                    } else {
                        $rtwmer_sat_status = $rtwmer_widget_array['Saturday']['store_open-time'] . "-" . $rtwmer_widget_array['Saturday']['store_close_time'];
                    }
                }
                $rtwmer_endpoint_html[] = '<div class="rtwmer_widget_box text-black-50 mt-4 mdc-elevation--z3">
                    <h5>'. esc_html__("Store Time", "rtwmer-mercado") .'</h5>
                    <div class="rtwmer-border-bottom"></div>
                    <div class="rtwmer-date-time"><p>'. esc_html__("Sunday" , "rtwmer-mercado") .':</p>
                    <p>'. $rtwmer_sun_status.'</p></div>
                    <div class="rtwmer-date-time"><p>'. esc_html__("Monday" , "rtwmer-mercado") .':</p>
                    <p>'. $rtwmer_mon_status.'</p></div>
                    <div class="rtwmer-date-time"><p>'. esc_html__("Tuesday" , "rtwmer-mercado") .':</p>
                    <p>'. $rtwmer_tues_status.'</p></div>
                    <div class="rtwmer-date-time"><p>'. esc_html__("Wednesday" , "rtwmer-mercado") .':</p>
                    <p>'. $rtwmer_weds_status.'</p></div>
                    <div class="rtwmer-date-time"><p>'. esc_html__("Thursday" , "rtwmer-mercado") .':</p>
                    <p>'. $rtwmer_thurs_status.'</p></div>
                    <div class="rtwmer-date-time"><p>'. esc_html__("Friday" , "rtwmer-mercado") .':</p>
                    <p>'. $rtwmer_fri_status.'</p></div>
                    <div class="rtwmer-date-time"><p>'. esc_html__("Saturday" , "rtwmer-mercado") .':</p>
                    <p>'. $rtwmer_sat_status.'</p></div>
                </div>';
            } 
            $rtwmer_temp_var = '<div class="rtwmer_contact_vendor mdc-elevation--z3">
            <h5>
                 '.esc_html__("Contact Vendor", "rtwmer-mercado") .'
            </h5>
            <div class="rtwmer-border-bottom"></div>
            <p class="rtwmer_notify"></p>
            <form method="POST" class="rtwmer-form">
                <div class="rtwmer-user-detail-box">
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                            <input type="text" class="mdc-text-field__input rtwmer_user_name_class" id="rtwmer_user_name">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                <div class="mdc-notched-outline__leading"></div>
                                <div class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label">Your Name</span>
                                </div>
                                <div class="mdc-notched-outline__trailing"></div>
                            </div>
                        </label>
                </div>
                <div class="rtwmer-user-detail-box">
                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                        <input type="email" class="mdc-text-field__input rtwmer_user_email" id="rtwmer_user_email_id">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label">Your Email</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </label>
                </div>
                <p>
                    <label class="mdc-text-field rtwmer-w-100 mdc-text-field--textarea mdc-text-field--no-label ">
                        <textarea class=" mdc-text-field__input rtwmer_user_message_class"   id="rtwmer_user_message">'.esc_attr__("Type your message here","rtwmer-mercado").'</textarea>
                        <span class="mdc-notched-outline mdc-notched-outline--no-label">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                    </label>
                </p>
                <p>';
                $rtwmer_temp_var .= esc_html__("Your personal data will be used to process your order, support your experience throughout this website.", "rtwmer-mercado");

                     $rtwmer_privacy = get_option('rtwmer_privacy_page');
                    if (isset($rtwmer_privacy['rtwmer_enable_privacy_policy']) && $rtwmer_privacy['rtwmer_enable_privacy_policy'] == "1") {
                       $rtwmer_temp_var .= esc_html__("For other purposes described in our ", "rtwmer-mercado");
                       $rtwmer_policy_page =  get_page_link((int) $rtwmer_privacy["rtwmer_setting_privacy_page"]) ;
                       $rtwmer_temp_var  .= "<a href='".esc_url($rtwmer_policy_page)."'>Mercado Privacy & Policy</a>";
                    }
                    $rtwmer_temp_var .= '</p>
                    <p class="submit">
                    <input type="button" name="submit" id="rtwmer_endpoint_submit" class="mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer_submit_store_message" data-id="'.$rtwmer_vendor_id.'" value="submit">
                    </p></form>
            </div>';
            $rtwmer_appearence_page_data = get_option('rtwmer_appearence_page');
            if( isset($rtwmer_appearence_page_data['rtwmer_vendor_contact_form']) && $rtwmer_appearence_page_data['rtwmer_vendor_contact_form'] == '1' )
            {
                $rtwmer_endpoint_html[] = $rtwmer_temp_var;
            }
            
            $rtwmer_endpoint_html[] = '</div>
        <div class="rtwmer_store_banner_wrapper">
            <div class="rtwmer-card-banner">';
            $rtwmer_temp_val = '<div class="rtwmer_store_banner">';
            $rtwmer_image = get_user_meta($rtwmer_vendor_id, "rtwmer_vendor_store_img", true);
                    if (!empty((int) $rtwmer_image)) {
                        $rtwmer_temp_val .= wp_get_attachment_image($rtwmer_image, "", "",  array("class" => "card-img rtwmer-img"));
                    } else {
                       $rtwmer_temp_val .= "<img src='" . RTWMER_PUBLIC_IMAGES_URL . "\store.jpg'>";
                    }
                $rtwmer_temp_val .= '</div>
                <div class="rtwmer-card-img">';
                    $rtwmer_image = get_user_meta($rtwmer_vendor_id, "rtwmer_vendor_profile_img", true);
                    if (!empty($rtwmer_image)) {
                    $rtwmer_temp_val .= wp_get_attachment_image($rtwmer_image, "", "",  array("class" => "img-fluid rtwmer-avator rounded-circle"));
                    } else {
                    $rtwmer_temp_val .= "<img src='". esc_attr__(get_avatar_url($rtwmer_vendor_id),'rtwmer-mercado') ."' class='img-fluid rtwmer-avator rounded-circle'>";
                    }
                    
                $rtwmer_temp_val .= '</div>
                <div class="rtwmer_vendor_details"><p><label id="rtwmer_store_name">
                            '. esc_html(get_user_meta($rtwmer_vendor_id, "rtwmer_store_name", true))  .'
                        </label>
                    </p>';
                    $rtwmer_extra_data = "";
                    if (get_user_meta($rtwmer_vendor_id, "rtwmer_vendor_show_email", true) == '1') {
                        $rtwmer_extra_data .= '<p>'.
                            esc_html__(get_userdata($rtwmer_vendor_id)->user_email, "rtwmer-mercado") .'
                        </p>';
                     } 
                    $rtwmer_extra_data .= '<p>
                        <label id="rtwmer_phone">
                            '. esc_html__(get_user_meta($rtwmer_vendor_id, "rtwmer_phone", true), "rtwmer-mercado")  .'
                        </label>
                    </p>
                    <p>
                        <span id="rtwmer_reviews">';
                        $rtwmer_extra_data .= get_user_meta($rtwmer_vendor_id,"rtwmer_vendor_rating",true);

                        $rtwmer_widget = get_user_meta($rtwmer_vendor_id, "rtwmer_show_time_widget", true);
                            if ($rtwmer_widget == '1') {
                                $rtwmer_widget_array = get_user_meta($rtwmer_vendor_id, "rtwmer_store_time_widget", true);
                                if (is_array($rtwmer_widget_array)) {
                                    if (get_user_meta($rtwmer_vendor_id, "rtwmer_vendor_status", true)) {
                                        $rtwmer_store_state = $rtwmer_widget_array['Store_open_notice'];
                                    } else {
                                        $rtwmer_store_state = $rtwmer_widget_array['Store_close_notice'];
                                    }
                                }
                            } else {
                                $rtwmer_store_state = "";
                            }  
                        $rtwmer_extra_data .=  '</span>
                    </p>';
                     $rtwmer_address1 = get_user_meta($rtwmer_vendor_id, "rtwmer_vendor_address1", true);
                    $rtwmer_address2 = get_user_meta($rtwmer_vendor_id, "rtwmer_vendor_address2", true);
                    $rtwmer_city = get_user_meta($rtwmer_vendor_id, "rtwmer_vendor_city", true);
                    if ($rtwmer_address1 || $rtwmer_address2) {
                        $rtwmer_extra_data .= '<p>';
                             if ($rtwmer_address1) {
                                $rtwmer_extra_data .= esc_html__($rtwmer_address1, "rtwmer-mercado");
                            }
                            if ($rtwmer_address1 && $rtwmer_address2) {
                                $rtwmer_extra_data .=  ",";
                            }
                            if ($rtwmer_address2) {
                                $rtwmer_extra_data .=  esc_html__($rtwmer_address2, "rtwmer-mercado");
                            } 
                        $rtwmer_extra_data .= '</p>';
                     }
                    if ($rtwmer_city) { 
                       $rtwmer_extra_data .=  '<p>'.esc_html__($rtwmer_city, "rtwmer-mercado").'</p>';
                     } 
                    $rtwmer_extra_data .= '<p>
                        <span id="rtwmer_status">'.
                            esc_html__($rtwmer_store_state, "rtwmer-mercado")  .'
                        </span>
                    </p>';
            $rtwmer_extra_data = apply_filters("rtwmer_show_vndr_extra_data_store",$rtwmer_extra_data);
            $rtwmer_endpoint_html[] = $rtwmer_temp_val.$rtwmer_extra_data."</div>
            </div>";
            $rtwmer_endpoint_html[] = '<div class="rtwmer_prod">
            <button type="button"  class="mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer-prdct-btn">
            <span class="mdc-button__label">' .esc_html__("Products", "rtwmer-mercado") .'</span>
            <div class="mdc-button__ripple"></div>
            </button>
            </div>
            <div class="rtwmer-prdct-row rtwmer-d-flex">';
                if(get_user_meta($rtwmer_vendor_id,"rtwmer_vendor_prod_per_page",true)){
                   $rtwmer_ppp = get_user_meta($rtwmer_vendor_id,"rtwmer_vendor_prod_per_page",true);
               }
               else{
                $rtwmer_ppp = 6;
            }
            $paged = (get_query_var('rtwmer_page')) ? get_query_var('rtwmer_page') : 1;
            $rtwmer_prod_cat_ids = (get_query_var('rtwmer_cat_ids')) ? get_term_by('term_id', get_query_var('rtwmer_cat_ids'), 'product_cat')->slug : "";
            $args = array(
                'post_type' => 'product',
                'product_cat' => $rtwmer_prod_cat_ids,
                'posts_per_page' =>  $rtwmer_ppp,
                'paged'     => $paged,
                'orderby' => 'asc',
                'author'  => $rtwmer_vendor_id,
            );
            $rtwmer_loop = new WP_Query($args);
            global $wp_query;
            $tmp_query = $wp_query;
            $wp_query = null;
            $wp_query = $rtwmer_loop;
            if ($rtwmer_loop->have_posts()) :
                while ($rtwmer_loop->have_posts()) : $rtwmer_loop->the_post();
                    global $product;
                    $rtwmer_rating_count = $product->get_rating_count();
                    $rtwmer_average = $product->get_average_rating();
                    
                    $rtwmer_temp_prod = '<div class="rtwmer-main rtwmer-prdct-box">
                        <div class="rtwmer_inner_border ">
                            <a href="'.get_permalink($rtwmer_loop->post->ID) .'" title="'. esc_attr($rtwmer_loop->post->post_title ? $rtwmer_loop->post->post_title : $rtwmer_loop->post->ID) .'">';
                                 if (has_post_thumbnail($rtwmer_loop->post->ID))  $rtwmer_temp_prod .= get_the_post_thumbnail($rtwmer_loop->post->ID, 'shop_catalog', array("class" => "img-fluid"));
                                else  $rtwmer_temp_prod .= '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />'; 
                                 $rtwmer_temp_prod .= '<div class="rtwmer-product-details">
                                    <p>'. Get_the_title() .'</p>
                                    <p>'. wc_get_rating_html($rtwmer_average, $rtwmer_rating_count) .'</p>
                                    <p>'.$product->get_price_html().'</p>
                                </a>';
                                ob_start();
                     woocommerce_template_loop_add_to_cart($rtwmer_loop->post, $product);
                            $rtwmer_temp_prod .= ob_get_clean();          
                           $rtwmer_temp_prod .= '</div>
                        </div>
                    </div>';
                    $rtwmer_endpoint_html[] = $rtwmer_temp_prod;
                endwhile; 
                $rtwmer_endpoint_html[] = '</div>';


                $rtwmer_endpoint_html[] = '</div>'; 
                
                $rtwmer_endpoint_html[] = '</div>';

                $rtwmer_sidebar_opt = get_option('rtwmer_appearence_page');
                $rtwmer_show_sidebar = (isset($rtwmer_sidebar_opt['rtwmer_show_store_sidebar']))?$rtwmer_sidebar_opt['rtwmer_show_store_sidebar'] : 0;
                if ($rtwmer_show_sidebar == '1') {

                    $rtwmer_endpoint_html[] = '<div class="rtwmer_store_sidebar_for_widgets">'; 
                    ob_start();
                    get_sidebar();
                    $rtwmer_endpoint_html[] = ob_get_clean();
                }
              
                    $rtwmer_endpoint_html[] = '</div>';
                $rtwmer_endpoint_html[] = '</div>'; 
                $rtwmer_endpoint_html[] = '<div class="rtwmer_pagination gp-container">
                            '. get_the_posts_pagination().'
                        </div>';
            else :
                $rtwmer_endpoint_html[] = esc_html__("Vendor Have posted no product yet.", "rtwmer-mercado");
                $rtwmer_endpoint_html[] = "</div></div></div>";
            endif;
            $rtwmer_endpoint_html[] = "</div>";
            $wp_query = null;
            $wp_query = $tmp_query; 
       
               
    $rtwmer_endpoint_html = apply_filters("rtwmer_vendor_store_html",$rtwmer_endpoint_html,$rtwmer_vendor_id);
    foreach ($rtwmer_endpoint_html as $key => $value) {
        echo $value;    // This variable holds html
    }
} else {
    ?>
    <div class="rtwmer_nothing_found">
        <label><?php esc_html_e("No Vendor exist of that name.", "rtwmer-mercado")  ?></label>
    </div>
    <?php
}

get_footer();
} else {
    wp_redirect(get_permalink($rtwmer_options_page_array['rtwmer_page_store_listing']));
}
?>
