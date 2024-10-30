<?php
/*          Ajax Request callback for the addition of products                 */
/*          Ajax Request callback for the addition of products                 */

if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
   
    global $rtwmer_user_id_for_dashboard;
    $rtwmer_user_permision = get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_vendor_status', true);

    $rtwmer_user = wp_get_current_user();
    
    if ($rtwmer_user_permision == "1") {
        $rtwmer_permission = true;
    } else {
        $rtwmer_permission = false;
    }
    if(in_array('administrator', $rtwmer_user->roles))
    {
        $rtwmer_permission = true;
    }
    if( !empty(get_option('rtwmer_selling_page')) )
    {
        $test = get_option('rtwmer_selling_page');
        $product_status = $test['rtwmer_new_product_status'];
    }
    if ($rtwmer_permission) {
        if ((isset($_POST) && !empty($_POST))) {
           

            if (empty($_POST['pname']) && (empty($_POST['pprice']) || (empty($_POST['dprice'])))) {
                echo json_encode("unsuccessful");
                wp_die();
            }
            if ((!empty($_POST['pname']) && isset($_POST['pname']))) {
                if($_POST['rtwer_prod_type'] == 'Variable'){
                    $rtwmer_post_id = $_POST['rtwmer_product_id'];
                }else{
                    if(isset($_POST['rtwmer_id']) && !empty($_POST['rtwmer_id'])){

                        $rtwmer_product_array = array(
                            'ID' =>  sanitize_text_field($_POST['rtwmer_id']),
                            // 'post_type'  => 'product',
                            // 'post_status' => 'pending',
                            'post_title' =>  sanitize_text_field($_POST['pname']),
                            'post_author'   => $rtwmer_user_id_for_dashboard,
                            'post_content' => sanitize_text_field($_POST['desc']),
                            // 'post_date_gmt' => gmdate("Y-m-d H:i:s"),
                            'post_modified_gmt' => gmdate("Y-m-d H:i:s")
                        );
                        $rtwmer_post_id = wp_update_post( $rtwmer_product_array);
                        // $rtwmer_post_id = $_POST['rtwmer_id'];
                    }else{
                        $rtwmer_product_array = array(
                            'post_type'  => 'product',
                            'post_status' => 'pending',
                            'post_title' =>  sanitize_text_field($_POST['pname']),
                            'post_author'   => $rtwmer_user_id_for_dashboard,
                            'post_content' => sanitize_text_field($_POST['desc']),
                            'post_date_gmt' => gmdate("Y-m-d H:i:s"),
                            'post_modified_gmt' => gmdate("Y-m-d H:i:s")
                        );
                        $rtwmer_post_id = wp_insert_post($rtwmer_product_array);
                    }

                }
                  
            }
            $rtwmer_term = get_terms(array(
                'taxonomy' => 'product_tag',
                'hide_empty' => false,
            ));
            $term_array = array();
            if (!empty($rtwmer_term) && !is_wp_error($rtwmer_term)) {
                foreach ($rtwmer_term as $term) {    
                    $term_array[] = $term->term_id;
                }
            }
            $rtwmer_tags_array = array();
            $rtwmer_not_tag = array(); 
           
            if(isset($_POST['tags']) && isset($_POST['tags'][0]) && !empty($_POST['tags'][0])){
                foreach ($_POST['tags'][0] as $key => $tags) {
                    if( !empty($tags) && in_array( $tags , $term_array)){
                        $rtwmer_tags_array[] = sanitize_text_field($tags);
                    }
                }
            }
            $rtwmer_prod_obj = wc_get_product($rtwmer_post_id);
            $rtwmer_prod_obj->set_tag_ids(array_merge($rtwmer_tags_array));
            $rtwmer_prod_obj->save();
           
            if (!empty($_POST['image']) && isset($_POST['image'])) {
                update_post_meta($rtwmer_post_id, '_thumbnail_id', sanitize_text_field($_POST['image']));
            }
            if (!empty($_POST['rtwmer_schedule_from']) && isset($_POST['rtwmer_schedule_from'])) {
                update_post_meta($rtwmer_post_id, '_sale_price_dates_from', sanitize_text_field(strtotime($_POST['rtwmer_schedule_from'])));
            }
            if (!empty($_POST['rtwmer_schedule_to']) && isset($_POST['rtwmer_schedule_to'])) {
                update_post_meta($rtwmer_post_id, '_sale_price_dates_to', sanitize_text_field(strtotime($_POST['rtwmer_schedule_to'])));
            }

            if (!empty($_POST['pprice']) && isset($_POST['pprice'])) {
                update_post_meta($rtwmer_post_id, '_price', sanitize_text_field($_POST['pprice']));
            }

            if (!empty($_POST['pprice']) && isset($_POST['pprice'])) {
                update_post_meta($rtwmer_post_id, '_regular_price', sanitize_text_field($_POST['pprice']));

                update_post_meta($rtwmer_post_id, '_price', sanitize_text_field($_POST['pprice']));
            }

            if ( isset($_POST['dprice']) && !empty($_POST['dprice']) ) {
                update_post_meta($rtwmer_post_id, '_sale_price', sanitize_text_field($_POST['dprice']));
                
                update_post_meta($rtwmer_post_id, '_price', sanitize_text_field($_POST['dprice']));
            }
            elseif( isset($_POST['dprice']) && empty($_POST['dprice']) )
            {
                delete_post_meta($rtwmer_post_id, '_sale_price', '');
            }

            if (!empty($_POST['category']) && isset($_POST['category'])) {
                $product = wc_get_product($rtwmer_post_id);
                $product->set_category_ids($_POST['category']);
                $product->save();
            }
            if ($_POST['cond'] == 'add_detailed') {
                if (!empty($_POST['sku']) && isset($_POST['sku'])) {
                    update_post_meta($rtwmer_post_id, '_sku', sanitize_text_field($_POST['sku']));
                }
                if (!empty($_POST['virtual_product']) && isset($_POST['virtual_product'])) {
                    update_post_meta($rtwmer_post_id, '_virtual', sanitize_text_field($_POST['virtual_product']));
                }
                if (!empty($_POST['download_product']) && isset($_POST['download_product'])) {
                    update_post_meta($rtwmer_post_id, '_downloadable', sanitize_text_field($_POST['download_product']));
                }
                if (!empty($_POST['stock_status']) && isset($_POST['stock_status'])) {
                    update_post_meta($rtwmer_post_id, '_stock_status', sanitize_text_field($_POST['stock_status']));
                }
                if (!empty($_POST['stock_manage']) && isset($_POST['stock_manage'])) {
                    update_post_meta($rtwmer_post_id, '_manage_stock', sanitize_text_field($_POST['stock_manage']));
                }                
                if(!empty($_POST['rtwmer_download_prod_array']) && isset($_POST['rtwmer_download_prod_array'])){
                    foreach ($_POST['rtwmer_download_prod_array'] as $key => $rtwmer_val) {
                        $rtwmer_id = $rtwmer_val[0]; 
                        $rtwmer_file_name = $rtwmer_val[1];
                        $rtwmer_file_url  = $rtwmer_val[2];
                        $rtwmer_download_ids = md5( $rtwmer_file_url );
                        $rtwmer_download_obj = new WC_Product_Download();
                        $rtwmer_download_obj->set_id( $rtwmer_download_ids );
                        $rtwmer_download_obj->set_name( $rtwmer_file_name );
                        $rtwmer_download_obj->set_file( $rtwmer_file_url );
                        $product = wc_get_product( $rtwmer_post_id ); 
                        $rtwmer_downloads = $product->get_downloads();
                        $rtwmer_downloads[$rtwmer_download_ids] = $rtwmer_download_obj;
                        $product->set_downloads($rtwmer_downloads);
                        $product->save();
                    }
                }
                if(!empty($_POST['rtwmer_prod_download_limit']) && isset($_POST['rtwmer_prod_download_limit'])){
                    update_post_meta($rtwmer_post_id, '_download_limit', sanitize_text_field($_POST['rtwmer_prod_download_limit']));
                }
                if(!empty($_POST['rtwmer_prod_download_expiry']) && isset($_POST['rtwmer_prod_download_expiry'])){
                    update_post_meta($rtwmer_post_id, '_download_expiry', sanitize_text_field($_POST['rtwmer_prod_download_expiry']));
                }
                if (!empty($_POST['rtwmer_single_product_permission']) && isset($_POST['rtwmer_single_product_permission'])) {
                    update_post_meta($rtwmer_post_id, '_sold_individually', sanitize_text_field($_POST['rtwmer_single_product_permission']));
                }
                if (!empty($_POST['purchase_note_field']) && isset($_POST['purchase_note_field'])) {
                    update_post_meta($rtwmer_post_id, '_purchase_note', sanitize_text_field($_POST['purchase_note_field']));
                }
                
                if (!empty($_POST['pname']) && (!empty($_POST['short_description'])) && (!empty($_POST['product_reviews']))) {
                    $rtwmer_product_details = array(
                        'ID' =>   $rtwmer_post_id,
                        'post_title' => sanitize_text_field($_POST['pname']),
                        'post_excerpt' => sanitize_text_field($_POST['short_description']),
                        'comment_status' => sanitize_text_field($_POST['product_reviews']),
                    );
                    wp_update_post($rtwmer_product_details);
                }

                ////////////// add extra product option in meta ///////////////////
                if (!empty($_POST['rtwmer_extra_note']) && isset($_POST['rtwmer_extra_note'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_extra_note', sanitize_text_field($_POST['rtwmer_extra_note']));
                }
                if (!empty($_POST['rtwmer_other_details']) && isset($_POST['rtwmer_other_details'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_other_details', sanitize_text_field($_POST['rtwmer_other_details']));
                }
                if (!empty($_POST['rtwmer_excluded']) && isset($_POST['rtwmer_excluded'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_excluded', sanitize_text_field($_POST['rtwmer_excluded']));
                }
                if (!empty($_POST['rtwmer_included']) && isset($_POST['rtwmer_included'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_included', sanitize_text_field($_POST['rtwmer_included']));
                }
                if (!empty($_POST['rtwmer_days_and_desc']) && isset($_POST['rtwmer_days_and_desc'])) {
                    //delete_post_meta( $rtwmer_post_id, '_rtwmer_days_and_desc');
                    update_post_meta($rtwmer_post_id, '_rtwmer_days_and_desc', ($_POST['rtwmer_days_and_desc']));
                }
                if (!empty($_POST['rtwmer_timeto_visit']) && isset($_POST['rtwmer_timeto_visit'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_timeto_visit', sanitize_text_field($_POST['rtwmer_timeto_visit']));
                }
                if (!empty($_POST['rtwmer_weather']) && isset($_POST['rtwmer_weather'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_weather', sanitize_text_field($_POST['rtwmer_weather']));
                }
                if (!empty($_POST['rtwmer_tour_leader']) && isset($_POST['rtwmer_tour_leader'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_tour_leader', sanitize_text_field($_POST['rtwmer_tour_leader']));
                }
                if (!empty($_POST['rtwmer_start_date']) && isset($_POST['rtwmer_start_date'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_start_date', sanitize_text_field($_POST['rtwmer_start_date']));
                }
                if (!empty($_POST['rtwmer_end_date']) && isset($_POST['rtwmer_end_date'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_end_date', sanitize_text_field($_POST['rtwmer_end_date']));
                }
                if (!empty($_POST['rtwmer_experience']) && isset($_POST['rtwmer_experience'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_experience', sanitize_text_field($_POST['rtwmer_experience']));
                }
                if (!empty($_POST['rtwmer_duration']) && isset($_POST['rtwmer_duration'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_duration', sanitize_text_field($_POST['rtwmer_duration']));
                }
                if (!empty($_POST['rtwmer_destination_include']) && isset($_POST['rtwmer_destination_include'])) {
                    update_post_meta($rtwmer_post_id, '_rtwmer_destination_include', sanitize_text_field($_POST['rtwmer_destination_include']));
                }

            }
            if (!empty($_POST['purchase_note_field']) && isset($_POST['purchase_note_field'])) {
                update_post_meta($rtwmer_post_id, '_purchase_note', sanitize_text_field($_POST['purchase_note_field']));
            }
            if (!empty($_POST['pname']) && (!empty($_POST['short_description'])) && (!empty($_POST['product_reviews']))) {
                $rtwmer_product_details = array(
                    'ID' =>   $rtwmer_post_id,
                    'post_title' => sanitize_text_field($_POST['pname']),
                    'post_excerpt' => sanitize_text_field($_POST['short_description']),
                    'comment_status' => sanitize_text_field($_POST['product_reviews']),
                );
                wp_update_post($rtwmer_product_details);
            }
        }
        // print_r($rtwmer_post_id);die('hekkll');
        $rtwmer_post_id = apply_filters("rtwmer_vendor_product_extra_data",$rtwmer_post_id);
        
        echo json_encode('successful');
        wp_die();

    } else {
        // echo json_encode(esc_html__('unsuccessful',"rtwmer-mercado"));
        echo json_encode(esc_html__('The Administrator has not yet given you permission to upload products.',"rtwmer-mercado"));
        wp_die();
    }
}
else{
    echo json_encode(esc_html__("You are not allowed to add products","rtwmer-mercado"));
}
wp_die();
