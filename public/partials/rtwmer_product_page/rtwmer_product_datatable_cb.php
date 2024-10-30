<?php

// This file contains the code for product table


if (check_ajax_referer("rtwmer_mercado_check_nonce", 'rtwmer_nonce')) {
    if (isset($_POST) && !empty($_POST)) {
        global $wpdb;
        global $rtwmer_user_id_for_dashboard;
        $rtwmer_table = $wpdb->prefix . 'posts';
        $rtwmer_primaryKey = 'ID';
        $rtwmer_author_ID = $rtwmer_user_id_for_dashboard;
        if (isset($_POST['cond']) && !empty($_POST['cond'])) {
            $rtwmer_cond = sanitize_text_field($_POST['cond']);
        }
        if (isset($_POST["rtwmer_date"]) && $_POST["rtwmer_date"] != "-None-") {
            $rtwmer_time    = strtotime($_POST["rtwmer_date"]);
            $rtwmer_first_date = date('Y-m-d', $rtwmer_time);
            $rtwmer_last_date  = date('Y-m-t', $rtwmer_time);
        }
        if (isset($_POST["rtwmer_cat_filter"]) && $_POST["rtwmer_cat_filter"] != "Uncategorized") {
            $rtwmer_cat  =   sanitize_text_field($_POST["rtwmer_cat_filter"]);
        }
        $columns = array(
            array('db' => 'ID', 'dt' => 0, 'field' => 'ID'),
            array('db' => '_thumbnail_id', 'dt' => 1, 'field' => '_thumbnail_id'),
            array('db' => 'post_title',  'dt' => 2, 'field' => 'post_title'),
            array('db' => 'post_status',   'dt' => 3, 'field' => 'post_status'),
            array('db' => '_sku',     'dt' => 4, 'field' => '_sku'),
            array('db' => '_stock_status',     'dt' => 5, 'field' => '_stock_status'),
            array('db' => '_sale_price',     'dt' => 6, 'field' => '_sale_price'),
            array('db' => '_regular_price',     'dt' => 7, 'field' => '_regular_price'),
            array('db' => 'post_excerpt',     'dt' => 8, 'field' => 'post_excerpt'),
            array('db' => 'rtwmer_product_view_count',     'dt' => 9, 'field' => 'rtwmer_product_view_count'),
            array('db' => 'post_date',     'dt' => 10, 'field' => 'post_date'),
        );
        $sql_details = array(
            'user' => DB_USER,
            'pass' => DB_PASSWORD,
            'db'   => DB_NAME,
            'host' => DB_HOST
        );
        $where = "`post_author`=" . $rtwmer_author_ID;
        $equals = "`post_type`='product'";
        $where .= ' AND ' . $equals;
        if (isset($rtwmer_cond)) {
            if ($rtwmer_cond == "all_prod") {
                $equal1 = "`post_status`='publish'";
                $equal2 = "`post_status`='pending'";
                $equal3 = "`post_status`='draft'";
                $equal4 = "`post_status`='private'";
                $where .= ' AND (' . $equal1 . ' OR ' . $equal2 . ' OR ' . $equal3 . ' OR ' . $equal4 . ')';
            } elseif ($rtwmer_cond == "pending_prod") {
                $pending = "`post_status`='pending'";
                $where .= ' AND ' . $pending;
            } elseif ($rtwmer_cond == "published_prod") {
                $publish = "`post_status`='publish'";
                $where .= ' AND ' . $publish;
            } elseif ($rtwmer_cond == "trash_prod") {
                $pending = "`post_status`='trash'";
                $where .= ' AND ' . $pending;
            }
        }
        $rtwmer_cat_query = false;
        if (isset($rtwmer_cat) && !empty($rtwmer_cat)) {
            $rtwmer_cat_query = true;
            $cat_condition = "wp_terms.`term_id` = '" . $rtwmer_cat . "'";
            $where .= ' AND (' . $cat_condition . ')';
        }
        if ((isset($rtwmer_first_date) && !empty($rtwmer_first_date)) && (isset($rtwmer_last_date) && !empty($rtwmer_last_date))) {
            $rtwmer_date = "`post_date`>'" . $rtwmer_first_date . "' AND `post_date`<'" . $rtwmer_last_date . "'";
            $where .= ' AND (' . $rtwmer_date . ')';
        }
        $rtwmer_posts = $wpdb->prefix . "posts";
        $rtwmer_postmeta = $wpdb->prefix . "postmeta";
        if (isset($_POST["rtwmer_filter"]) && $_POST["rtwmer_filter"] && $rtwmer_cat_query) {
            $join = "FROM " . $wpdb->prefix . "posts" . " LEFT JOIN (SELECT post_id,
        MAX(CASE WHEN meta_key = '_thumbnail_id' THEN meta_value END) _thumbnail_id,
        MAX(CASE WHEN meta_key = '_sku' THEN meta_value END) _sku,
        MAX(CASE WHEN meta_key = '_stock_status' THEN meta_value END) _stock_status,
        MAX(CASE WHEN meta_key = '_regular_price' THEN meta_value END) _regular_price,
        MAX(CASE WHEN meta_key = 'rtwmer_product_view_count' THEN meta_value END) rtwmer_product_view_count,
        MAX(CASE WHEN meta_key = '_sale_price' THEN meta_value END) _sale_price
        FROM " . $wpdb->prefix . "postmeta" . " GROUP BY post_id) rtw_selected_table ON " . $wpdb->prefix . "posts" . ".`ID`= rtw_selected_table.`post_id` JOIN " . $wpdb->prefix . "term_relationships" . " ON " . $wpdb->prefix . "posts" . ".`ID` = " . $wpdb->prefix . "term_relationships" . ".`object_id` JOIN (SELECT term_id,
        MAX(CASE WHEN taxonomy = 'product_cat' THEN term_id END) rtw_prod_cat,
        MAX(CASE WHEN taxonomy = 'product_type' THEN term_id END) rtw_prod_type
        FROM " . $wpdb->prefix . "term_taxonomy" . " GROUP BY term_id) rtw_prod_taxonomy ON " . $wpdb->prefix . "term_relationships" . ".`term_taxonomy_id` = rtw_prod_taxonomy.`term_id` JOIN " . $wpdb->prefix . "terms" . " ON rtw_prod_taxonomy.`term_id` = " . $wpdb->prefix . "terms" . ".`term_id` ";
        } else {
            $join = "FROM `$rtwmer_posts` LEFT JOIN (SELECT post_id, 
            MAX(CASE WHEN meta_key = '_sku' THEN meta_value END) _sku,
            MAX(CASE WHEN meta_key = '_stock_status' THEN meta_value END) _stock_status,
            MAX(CASE WHEN meta_key = '_regular_price' THEN meta_value END) _regular_price,
            MAX(CASE WHEN meta_key = '_sale_price' THEN meta_value END) _sale_price,
            MAX(CASE WHEN meta_key = 'rtwmer_product_view_count' THEN meta_value END) rtwmer_product_view_count,
            MAX(CASE WHEN meta_key = '_thumbnail_id' THEN meta_value END) _thumbnail_id
            FROM `$rtwmer_postmeta`
            GROUP BY `post_id`) rtwprod ON " . $rtwmer_posts . ".ID = rtwprod.post_id";
        }
        include_once(RTWMER_ADMIN_PARTIAL . '/ssp/ssp.customized.class.php');
        if (!empty($rtwmer_cond)) {
            $rtwmer_all_ssp   =    SSP::simple($_POST, $sql_details, $rtwmer_table,                                         $rtwmer_primaryKey, $columns, $join, $where);
            $i = 0;
            if (!empty($rtwmer_all_ssp['data'])) {
                foreach ($rtwmer_all_ssp['data'] as $rtwmer_data) {
                    $attach_id    =        $rtwmer_data[1];
                    $rtwmer_checkbox = "<div class='mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded'>
                    <input type='checkbox' name='rtwmer_bulk_check' class='mdc-checkbox__native-control rtwmer_table_bulk_check' data-id='" . $rtwmer_data[0] . "' aria-labelledby='u0'>
                    <div class='mdc-checkbox__background'>
                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                    </svg><div class='mdc-checkbox__mixedmark'></div></div><div class='mdc-checkbox__ripple'></div></div>";

                    $rtwmer_product_title   =  $rtwmer_data[2] . "<div class='rtwmer_action'>";
                    if($this->rtwmer_user_can_access("rtwmer_delete_prod_cap")){
                    $rtwmer_product_title  .= "<div class='rtwmer_delete'><div class='rtwmer_tooltip rtwmer_delete_button' data-val='trash' data-id='" . $rtwmer_data[0] . "'><span class='material-icons'>delete</span>
                  <span class='rtwmer_tooltiptext rtwmer_prod_tool'>" . esc_html__('Delete', 'rtwmer-mercado') . "</span>
                </div></div>";
                    }

                if($this->rtwmer_user_can_access("rtwmer_edit_prod_cap")){
                $rtwmer_product_title .= "<div class='rtwmer_edit'><div class='rtwmer_tooltip rtwmer_edit_button' data-id='" . $rtwmer_data[0] . "'><span class='material-icons'>edit</span><span class='rtwmer_tooltiptext rtwmer_prod_tool'>" . esc_html__('Edit', 'rtwmer-mercado') . "</span>
                </div></div>";
                }
             
                    $rtwmer_product_title = apply_filters("rtwmer_product_title", $rtwmer_product_title, $rtwmer_data[0], $rtwmer_data[2]);
                    $rtwmer_product  =   wc_get_product($rtwmer_data[0]);
                   
                        
                    $rtwmer_price = $rtwmer_product->get_price();
                    $sale_price    =    $rtwmer_product->get_sale_price();

                    // if($rtwmer_product->is_type('variable')){
                    //     $rtwmer_var_min_price = $rtwmer_product->get_variation_price('min', true);
                    //     $rtwmer_var_max_price = $rtwmer_product->get_variation_price('max', true);
                    //     $main_price = $rtwmer_var_min_price ." - ". $rtwmer_var_max_price;

                    // }

                   

                    $reg_price    =    $rtwmer_product->get_regular_price();
                    if ((float) $rtwmer_price == (float) $sale_price) {
                        $sale_price =  $rtwmer_price;
                    } else if ((float) $rtwmer_price == (float) $reg_price) {
                        $sale_price = 0;
                    }
                    $reg_date    =    $rtwmer_data[10];
                    $rtwmer_views_count    =    $rtwmer_data[9];
                    if (empty($rtwmer_views_count)) {
                        $rtwmer_views_count = 0;
                    } else {
                        $rtwmer_views_count  =  intval($rtwmer_views_count);
                    }
                    $rtwmer_date    =    date('d-m-Y', strtotime($reg_date));

                    if($rtwmer_product->is_type('variable')){
                        $rtwmer_var_min_price = $rtwmer_product->get_variation_price('min', true);
                        $rtwmer_var_max_price = $rtwmer_product->get_variation_price('max', true);
                        $main_price = wc_price($rtwmer_var_min_price) ." - ". wc_price($rtwmer_var_max_price);
                        // echo '<pre>';
                        // print_r($main_price);
                        // echo '</pre>';

                    }else{
                        if (!empty($sale_price)) {
                            $main_price    =        wc_price($sale_price);
    
                            if (!empty($reg_price)) {
                                $main_price    =    "<del>" . wc_price($reg_price) . "</del>" . wc_price($sale_price);
                            }
                        } elseif (!empty($reg_price)) {
                            $main_price    =    wc_price($reg_price);
                        } else {
                            $main_price    =    "-";
                        }
                    }
                    if($rtwmer_product->is_type('variable')){
                        $rtwmer_var_min_price = $rtwmer_product->get_variation_price('min', true);
                      
                        $rtwmer_saving_commission = $this->rtwmer_commission($rtwmer_user_id_for_dashboard, $rtwmer_var_min_price);
                        $rtwmer_saving_1    =    (float) $rtwmer_var_min_price - (float) $rtwmer_saving_commission[0];
                        // echo '<pre>';
                        // print_r($rtwmer_saving);
                        // echo '</pre>';
                        // die('asdffdafdsaf');

                        $rtwmer_var_max_price = $rtwmer_product->get_variation_price('max', true);

                        $rtwmer_saving_commission = $this->rtwmer_commission($rtwmer_user_id_for_dashboard, $rtwmer_var_max_price);
                        $rtwmer_saving_2   =    (float) $rtwmer_var_max_price - (float) $rtwmer_saving_commission[0];

                        $rtwmer_var_saving = wc_price(round($rtwmer_saving_1,2)) ." - ".wc_price(round($rtwmer_saving_2 , 2));

                    }else{
                        $rtwmer_saving_commission = $this->rtwmer_commission($rtwmer_user_id_for_dashboard, $rtwmer_price);
                        $rtwmer_saving    =    (float) $rtwmer_price - (float) $rtwmer_saving_commission[0];
                    }
                    
                    $rtwmer_saving_commission = $this->rtwmer_commission($rtwmer_user_id_for_dashboard, $rtwmer_price);
                    $rtwmer_saving    =    (float) $rtwmer_price - (float) $rtwmer_saving_commission[0];
                    $rtwmer_downloadable    =        get_post_meta($rtwmer_data[0], '_downloadable', TRUE);
                    $rtwmer_virtual    =    get_post_meta($rtwmer_data[0], '_virtual', TRUE);
                    if ($rtwmer_downloadable    ==    "yes") {
                        $rtwmer_type        =        "downloadable";
                    } elseif ($rtwmer_virtual    ==    "yes") {
                        $rtwmer_type    =    "virtual";
                    } else {
                        $rtwmer_product =     wc_get_product($rtwmer_data[0]);
                        $rtwmer_type     =    $rtwmer_product->get_type();
                    }
                    if ($rtwmer_data[3] == "publish") {
                        $rtwmer_status = "<span class='rtwmer_published'>" . $rtwmer_data[3] . "</span>";
                    } elseif ($rtwmer_data[3] == "pending") {
                        $rtwmer_status = "<span class='rtwmer_pending'>" . $rtwmer_data[3] . "</span>";
                    } elseif ($rtwmer_data[3] == "trash") {
                        $rtwmer_status = "<span class='rtwmer_product_trash'>" . $rtwmer_data[3] . "</span>";
                    } elseif ($rtwmer_data[3] == "draft") {
                        $rtwmer_status = "<span class='rtwmer_draft'>" . $rtwmer_data[3] . "</span>";
                    }
                    // $image    =    wp_get_attachment_image(intval($attach_id), array('100', '100'), "", array("class" => "rtwmer_product_img"));
                    $test = wp_get_attachment_image_src($attach_id);
                    $plugins_url = plugins_url();
                    $my_plugin_dir = $plugins_url . '/mercado';
                    if($test){
                        $image    =    wp_get_attachment_image(intval($attach_id), array('100', '100'), "", array("class" => "rtwmer_product_img"));
                    }else{
                        $src    =    $my_plugin_dir."/assets/images/image_not_available.jpg";
                      $image = '<img width="100" height="100" src="'.$src.'" class="rtwmer_product_img" alt="" decoding="async" loading="lazy" sizes="(max-width: 100px) 100vw, 100px">';
                    }
                    // echo '<pre>';
                    // print_r($attach_id);
                    // echo '</pre>';
                    // die('amma');
                    $rtwmer_all_ssp['data'][$i][0]    =    $rtwmer_checkbox;
                    $rtwmer_all_ssp['data'][$i][1]    =    $image;
                    $rtwmer_all_ssp['data'][$i][2]    =    $rtwmer_product_title;
                    $rtwmer_all_ssp['data'][$i][3]    =    $rtwmer_status;
                    $rtwmer_all_ssp['data'][$i][6]    =    $main_price;
                    if($rtwmer_product->is_type('variable')){
                        $rtwmer_all_ssp['data'][$i][7]    =    $rtwmer_var_saving;
                    }else{
                        $rtwmer_all_ssp['data'][$i][7]    =    wc_price(round($rtwmer_saving, 2));
                    }
                    $rtwmer_all_ssp['data'][$i][8]    =    $rtwmer_type;
                    $rtwmer_all_ssp['data'][$i][9]    =    $rtwmer_views_count;
                    $rtwmer_all_ssp['data'][$i][10]    =    $rtwmer_date;
                    $i++;
                }
            }
            echo json_encode($rtwmer_all_ssp);
        }
    }
}
wp_die();
