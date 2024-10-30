<?php 

//=====================file used to launch product table according to products at admin panel================//

    if( isset($_POST['rtwmer_sort_table']) && !empty($_POST['rtwmer_sort_table']) )
    {
        $rtwmer_sort_table = sanitize_text_field($_POST['rtwmer_sort_table']);
        update_option('rtwmer_sort_table_temp',$rtwmer_sort_table);
    }
    if( isset( $_POST['rtwmer_product_author_id'] ) && !empty( $_POST['rtwmer_product_author_id'] ) && isset( $_POST['rtwmer_sort_by_status'] ) && !empty( $_POST['rtwmer_sort_by_status'] ) )
    {	
        $rtwmer_prod_auth_id  = sanitize_text_field($_POST['rtwmer_product_author_id']);

        $rtwmer_sort_by_status  = sanitize_text_field($_POST['rtwmer_sort_by_status']);
        
        if( isset( $rtwmer_prod_auth_id ) && isset( $rtwmer_sort_by_status ) )
        {
            
        global $wpdb;

        $table = $wpdb->prefix.'posts';

        $primaryKey = 'ID';

        $columns = array(
            array( 'db' => 'ID', 'dt' => 0 , 'field' => 'ID' ),
            array( 'db' => 'rtwmer_prod_img_id', 'dt' => 1 , 'field' => 'rtwmer_prod_img_id' ),
            array( 'db' => 'post_title', 'dt' => 2 , 'field' => 'post_title' ),
            array( 'db' => 'rtwmer_prod_sku',  'dt' => 3 , 'field' => 'rtwmer_prod_sku' ),
            array( 'db' => 'rtwmer_prod_status',  'dt' => 4 , 'field' => 'rtwmer_prod_status' ),
            array( 'db' => 'rtwmer_prod_reg_price',  'dt' => 5 , 'field' => 'rtwmer_prod_reg_price' ),
            array( 'db' => 'post_status',  'dt' => 6 , 'field' => 'post_status' ),
            array( 'db' => 'post_password',  'dt' => 7 , 'field' => 'post_password' ),
            array( 'db' => 'rtwmer_prod_sale_price',  'dt' => 8 , 'field' => 'rtwmer_prod_sale_price' ),
            array( 'db' => 'post_date',  'dt' => 9 , 'field' => 'post_date' ),
            array( 'db' => 'ID',  'dt' => 10 , 'field' => 'ID' ),
        ); 

        $sql_details = array(
            'user' => DB_USER,
            'pass' => DB_PASSWORD,
            'db'   => DB_NAME,
            'host' => DB_HOST
        );
        
        if( $rtwmer_sort_by_status == 'all' )
        {
            $where = "`post_type`='product'";

            $condition = "`post_status`= 'publish'";

            $condition2 = "`post_status`= 'draft'";

            $condition3 = "`post_status`= 'pending'";

            $condition4 = "`post_status`= 'private'";

            $where .= ' AND (' .$condition. ' OR ' .$condition2. ' OR ' .$condition4. ' OR ' .$condition3.")";

            $equals = "`post_author`= ".$rtwmer_prod_auth_id;

            $where .= ' AND ' .$equals;
        }

        else
        {	
            $where = "`post_type`='product'";

            $equals = "`post_author`= ".$rtwmer_prod_auth_id."";

            $condition = "`post_status`= '".$rtwmer_sort_by_status."'";

            $where .= ' AND '. ($equals. ' AND ' .$condition);
        }
        
        $join = "FROM ".$wpdb->prefix."posts"." LEFT JOIN (SELECT post_id,
        MAX(CASE WHEN meta_key = '_thumbnail_id' THEN meta_value END) rtwmer_prod_img_id,
        MAX(CASE WHEN meta_key = '_sku' THEN meta_value END) rtwmer_prod_sku,
        MAX(CASE WHEN meta_key = '_stock_status' THEN meta_value END) rtwmer_prod_status,
        MAX(CASE WHEN meta_key = '_regular_price' THEN meta_value END) rtwmer_prod_reg_price,
        MAX(CASE WHEN meta_key = '_sale_price' THEN meta_value END) rtwmer_prod_sale_price
        FROM ".$wpdb->prefix."postmeta"." GROUP BY post_id) rtw_selected_table ON ".$wpdb->prefix."posts".".`ID`= rtw_selected_table.`post_id` ";


        if( (isset($_POST['rtwmer_prod_cat_filter_val']) && !empty($_POST['rtwmer_prod_cat_filter_val'])) && (isset($_POST['rtwmer_filter_by_prod_type']) && !empty($_POST['rtwmer_filter_by_prod_type'])) && (isset($_POST['rtwmer_filter_by_prod_stock']) && !empty($_POST['rtwmer_filter_by_prod_stock'])))
        {
            $rtwmer_prod_cat_filter_val = sanitize_text_field($_POST['rtwmer_prod_cat_filter_val']);

            $rtwmer_filter_by_prod_type = sanitize_text_field($_POST['rtwmer_filter_by_prod_type']);

            $rtwmer_filter_by_prod_stock = sanitize_text_field($_POST['rtwmer_filter_by_prod_stock']);

            if( (isset($rtwmer_prod_cat_filter_val) && !empty($rtwmer_prod_cat_filter_val)) && (isset($rtwmer_filter_by_prod_type) && !empty($rtwmer_filter_by_prod_type)) && (isset($rtwmer_filter_by_prod_stock) && !empty($rtwmer_filter_by_prod_stock)) )

            {
                if( (($rtwmer_filter_by_prod_type != -1) && ($rtwmer_prod_cat_filter_val == -1) && ($rtwmer_filter_by_prod_stock == -1) ) || (($rtwmer_filter_by_prod_type == -1) && ($rtwmer_prod_cat_filter_val != -1) && ($rtwmer_filter_by_prod_stock == -1) ) || (($rtwmer_filter_by_prod_type == -1) && ($rtwmer_prod_cat_filter_val == -1) && ($rtwmer_filter_by_prod_stock != -1) )  )	
                {
                    if($rtwmer_filter_by_prod_type != -1)
                    {
                        $rtwmmer_main_cat_filter = $rtwmer_filter_by_prod_type;
                    }
                    if($rtwmer_prod_cat_filter_val != -1)
                    {
                        $rtwmmer_main_cat_filter = $rtwmer_prod_cat_filter_val;
                    }
                    if($rtwmer_filter_by_prod_stock != -1)
                    {
                        $rtwmmer_main_cat_filter = $rtwmer_filter_by_prod_stock;
                    }
                    if( $rtwmer_sort_by_status == 'all' )
                    {
                        $where = "`post_type`='product'";

                        $equals = "`post_author`= ".$rtwmer_prod_auth_id."";
    
                        $where .= ' AND '. $equals;

                        $condition = "`post_status`= 'publish'";

                        $condition2 = "`post_status`= 'draft'";

                        $condition3 = "`post_status`= 'pending'";

                        $condition4 = "`post_status`= 'private'";
    
                        $where .= ' AND (' . $condition . ' OR ' . $condition2 . ' OR ' . $condition3 .  ' OR ' . $condition4 . ')';

                        if( isset($rtwmmer_main_cat_filter) )
                        {
                            $cat_condition = "wp_terms.`term_id` = '".$rtwmmer_main_cat_filter."'";
                        }

                        if( isset($cat_condition) )
                        {
                            $where .= ' AND ('. $cat_condition . ')';
                        }
                    }
                    else
                    {
                        $where = "`post_type`='product'";

                        $equals = "`post_author`= ".$rtwmer_prod_auth_id."";

                        $condition = "`post_status`= '".$rtwmer_sort_by_status."'";

                        $taxonomy = "`taxonomy`= 'product_cat'";

                        if( isset($rtwmmer_main_cat_filter) )
                        {
                            $cat_condition = "wp_terms.`term_id` = '".$rtwmmer_main_cat_filter."'";
                        }
    
                        $where .= ' AND '. $equals. ' AND ' .$cat_condition. ' AND ' .$condition;
                    }

                        $join = "FROM ".$wpdb->prefix."posts"." LEFT JOIN (SELECT post_id,
                        MAX(CASE WHEN meta_key = '_thumbnail_id' THEN meta_value END) rtwmer_prod_img_id,
                        MAX(CASE WHEN meta_key = '_sku' THEN meta_value END) rtwmer_prod_sku,
                        MAX(CASE WHEN meta_key = '_stock_status' THEN meta_value END) rtwmer_prod_status,
                        MAX(CASE WHEN meta_key = '_regular_price' THEN meta_value END) rtwmer_prod_reg_price,
                        MAX(CASE WHEN meta_key = '_sale_price' THEN meta_value END) rtwmer_prod_sale_price
                        FROM ".$wpdb->prefix."postmeta"." GROUP BY post_id) rtw_selected_table ON ".$wpdb->prefix."posts".".`ID`= rtw_selected_table.`post_id` JOIN ".$wpdb->prefix."term_relationships"." ON ".$wpdb->prefix."posts".".`ID` = ".$wpdb->prefix."term_relationships".".`object_id` JOIN (SELECT term_id,
                        MAX(CASE WHEN taxonomy = 'product_cat' THEN term_id END) rtw_prod_cat,
                        MAX(CASE WHEN taxonomy = 'product_type' THEN term_id END) rtw_prod_type
                        FROM ".$wpdb->prefix."term_taxonomy"." GROUP BY term_id) rtw_prod_taxonomy ON ".$wpdb->prefix."term_relationships".".`term_taxonomy_id` = rtw_prod_taxonomy.`term_id` JOIN ".$wpdb->prefix."terms"." ON rtw_prod_taxonomy.`term_id` = ".$wpdb->prefix."terms".".`term_id` ";
                }

            }
        }
        
        include_once( RTWMER_ADMIN_PARTIAL.'/ssp/ssp.customized.class.php' );

        $rtwmer_products_data_ssp =  SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $join, $where);

        
        if( isset( $rtwmer_products_data_ssp ) && !empty( $rtwmer_products_data_ssp ) )
        {
            if( is_array( $rtwmer_products_data_ssp['data'] ) && !empty( $rtwmer_products_data_ssp['data'] ) )
            {
                $rtwmer_products_data = $rtwmer_products_data_ssp['data'];

                if( isset( $rtwmer_products_data ) && !empty( $rtwmer_products_data ) && is_array( $rtwmer_products_data ) )
                {   
                    $j = 0;
                    
                    foreach( $rtwmer_products_data as $rtwmer_prod )
                    {
                        
        
                        if( isset( $rtwmer_products_data_ssp['data'][$j] ) )
                        {
                            if( isset($rtwmer_products_data_ssp['data'][$j][4]) )
                            {
                                if( $rtwmer_prod[4] == 'instock' )
                                {
                                    $rtwmer_products_data_ssp['data'][$j][4] = '<p class="rtwmer_mark_instock">'.esc_html__('In stock','rtwmer-mercado').'</p>';
                                }
                                if( empty($rtwmer_prod[4] ))
                                {
                                    $rtwmer_products_data_ssp['data'][$j][4] = '<p class="rtwmer_mark_instock">'.esc_html__('In stock','rtwmer-mercado').'</p>';
                                }
                                if( $rtwmer_prod[4] == 'outofstock' )
                                {
                                    $rtwmer_products_data_ssp['data'][$j][4] = '<p class="rtwmer_mark_outofstock">'.esc_html__('Out Of Stock','rtwmer-mercado').'</p>';
                                }
                                if( $rtwmer_prod[4] == 'onbackorder' )
                                {
                                    $rtwmer_products_data_ssp['data'][$j][4] = '<p class="rtwmer_mark_onbackorder">'.esc_html__('On backorder','rtwmer-mercado').'</p>';
                                }
                            }
                            else
                            {
                                $rtwmer_products_data_ssp['data'][$j][4] = '<p class="rtwmer_mark_instock">'.esc_html__('In stock','rtwmer-mercado').'</p>';
                            }
                            

                            if( isset($rtwmer_products_data_ssp['data'][$j][5]) || isset($rtwmer_products_data_ssp['data'][$j][8]) )
                            {
                               
                                if( !empty($rtwmer_prod[8]) )
                                {
                                    $rtwmer_products_data_ssp['data'][$j][5] = '<p><del>'.wc_price($rtwmer_products_data_ssp['data'][$j][5]).'</del></p>
                                    <p>'.wc_price($rtwmer_products_data_ssp['data'][$j][8]).'</p>';
                                }
                                if( empty($rtwmer_prod[8]) )
                                {
                                    // die('ar');
                                    $rtwmer_products_data_ssp['data'][$j][5] = '<p>'.wc_price($rtwmer_products_data_ssp['data'][$j][5]).'</p>';
                                }

                                if( ($rtwmer_prod[8] > $rtwmer_prod[5]) )
                                {
                                    $rtwmer_products_data_ssp['data'][$j][5] = '<p>'.wc_price($rtwmer_products_data_ssp['data'][$j][8]).'</p>';
                                }
                            }
                            $product1 =  wc_get_product($rtwmer_products_data_ssp['data'][$j][0]);
                            if($product1->is_type('variable')){
                                $product = new WC_Product_Variable($rtwmer_products_data_ssp['data'][$j][0]);
                                $min = $product->get_variation_price('min', true);
                                $max = $product->get_variation_price('max', true);

                                $price = wc_price($min) . ' - ' . wc_price($max);

                                $rtwmer_products_data_ssp['data'][$j][5] = $price;

                                // echo '<pre>';
                                // print_r($rtwmer_products_data_ssp['data']);
                                // echo '</pre>';
                                // die('afdsdfjsadkjsdjf');

                            }
                            // $mini = $product->get_variation_price();
                            
                            // echo '<pre>';
                            // // print_r($mini);
                            // // print_r($max);
                            // print_r($type);
                            // echo '</pre>';
                            // die('sdjkdfsj');
                            // echo '<pre>';
                            // print_r($rtwmer_products_data_ssp['data'][$j][5]);
                            // echo '</pre>';
                            // die('sdafjdjaf');

                            // if( isset($rtwmer_products_data_ssp['data'][$j][5]) )
                            // {
                            //     if( !empty($rtwmer_prod[8]) )
                            //     {
                            //         $rtwmer_products_data_ssp['data'][$j][5] = '<p><del>'.wc_price($rtwmer_products_data_ssp['data'][$j][5]).'</del></p>
                            //         <p>'.wc_price($rtwmer_products_data_ssp['data'][$j][8]).'</p>';
                            //     }
                            //     if( empty($rtwmer_prod[8]) )
                            //     {
                            //         $rtwmer_products_data_ssp['data'][$j][5] = '<p>'.wc_price($rtwmer_products_data_ssp['data'][$j][5]).'</p>';
                            //     }

                            //     if( ($rtwmer_prod[8] > $rtwmer_prod[5]) )
                            //     {
                            //         $rtwmer_products_data_ssp['data'][$j][5] = '<p>'.wc_price($rtwmer_products_data_ssp['data'][$j][8]).'</p>';
                            //     }
                            // }

                            // This variable is holding product's ids.

                            $rtwmer_vendor_prod_id = $rtwmer_products_data_ssp['data'][$j][0];

                            // echo '<pre>';
                            // print_r($rtwmer_products_data_ssp['data']);
                            // echo '</pre>';
                            // die('afdsdfjsadkjsdjf');

                            $rtwmer_products_data_ssp['data'][$j][0] = '<td class="mdc-data-table__cell mdc-data-table__cell--checkbox">
                                <div class="mdc-checkbox mdc-data-table__row-checkbox">
                                    <input type="checkbox" class="mdc-checkbox__native-control rtwmer_prod_inner_checkbox" data-class = "'.$rtwmer_vendor_prod_id.'" name = "rtwmer_prod_inner_check" />
                                    <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                    </div>
                                    <div class="mdc-checkbox__ripple"></div>
                                </div>
                            </td>';

                            $src = esc_url(wp_get_attachment_url($rtwmer_prod[1]));
                            $plugins_url = plugins_url();
                            $my_plugin_dir = $plugins_url . '/mercado';

                            if(empty($src)){
                                $src =  $my_plugin_dir."/assets/images/image_not_available.jpg";
                            }
                            // die('zfedd');
                            // $rtwmer_products_data_ssp['data'][$j][1] = "<img src = ".esc_url(wp_get_attachment_url($rtwmer_prod[1]))." class = 'rtwmer_prod_store_img' >";

                            $rtwmer_products_data_ssp['data'][$j][1] = "<img src = ".$src." class = 'rtwmer_prod_store_img' >";

                            $rtwmer_prod_cat = wp_get_post_terms( $rtwmer_vendor_prod_id, 'product_cat', array( 'fields' => 'names' )  );

                            //This variable is holding product post status

                            $rtwmer_prod_post_status = $rtwmer_products_data_ssp['data'][$j][6];

                            $rtwmer_products_data_ssp['data'][$j][6] = "";
                            
                            if( is_array($rtwmer_prod_cat) && !empty($rtwmer_prod_cat) )
                            {
                                foreach( $rtwmer_prod_cat as $name ) 
                                {
                                    if( isset($name) && !empty($name) )
                                    {
                                        if( !empty($rtwmer_products_data_ssp['data'][$j][6]) && ( !empty($name) ) ) 
                                        {
                                            $rtwmer_products_data_ssp['data'][$j][6] .= ", ". esc_html__($name,'rtwmer-mercado');
                                        }
                                        else
                                        {
                                            $rtwmer_products_data_ssp['data'][$j][6] = esc_html__($name,'rtwmer-mercado');
                                        }
                                    }
                                }   
                            }
                            $rtwmer_prod_tag = wp_get_post_terms( $rtwmer_vendor_prod_id, 'product_tag', array( 'fields' => 'names' )  );

                            $rtwmer_post_password = $rtwmer_products_data_ssp['data'][$j][7];
                            $rtwmer_products_data_ssp['data'][$j][7] = "";

                            if( is_array($rtwmer_prod_tag) && !empty($rtwmer_prod_tag) )
                            {	
                                
                                foreach( $rtwmer_prod_tag as $name ) 
                                {
                                    if( isset($name) && !empty($name) )
                                    {
                                        if( !empty($rtwmer_products_data_ssp['data'][$j][7]) && ( !empty($name) ) ) 
                                        {
                                            $rtwmer_products_data_ssp['data'][$j][7] .= ", ". esc_html__($name,'rtwmer-mercado');
                                        }
                                        else
                                        {
                                            $rtwmer_products_data_ssp['data'][$j][7] = esc_html__($name,'rtwmer-mercado');
                                        }
                                    }
                                    
                                }
                            }

                            $rtwmer_prod_visibility = wp_get_post_terms( $rtwmer_vendor_prod_id,'product_visibility',array('fields' => 'slugs' ) );

                            if( isset($rtwmer_prod_visibility) && is_array($rtwmer_prod_visibility) && !empty($rtwmer_prod_visibility) )
                            {
                                if( in_array('featured',$rtwmer_prod_visibility ))
                                {
                                    $rtwmer_products_data_ssp['data'][$j][8] = '<input type = "checkbox" checked class = "rtwmer_fav_prod" data-id="'.$rtwmer_vendor_prod_id.'" >';
                                }
                                else
                                {
                                    $rtwmer_products_data_ssp['data'][$j][8] = '<input type = "checkbox" class = "rtwmer_fav_prod" data-id="'.$rtwmer_vendor_prod_id.'" >';
                                }
                            }
                            else
                            {
                                $rtwmer_products_data_ssp['data'][$j][8] = '<input type = "checkbox" class = "rtwmer_fav_prod" data-id="'.$rtwmer_vendor_prod_id.'" >';
                            }

                            if( isset($rtwmer_prod[9]) && !empty($rtwmer_prod[9]) )
                            {
                                $rtwmer_products_data_ssp['data'][$j][9] = date( "j/m/Y", strtotime( $rtwmer_prod[9]) );
                            }

                            if( !empty($rtwmer_prod[2]))
                            {
                                $rtwmer_prod_name = $rtwmer_products_data_ssp['data'][$j][2];
                                if( (!empty($rtwmer_prod_name)) && ( isset($rtwmer_prod_post_status) && !empty($rtwmer_prod_post_status) ) )
                                {
                                    if( isset($rtwmer_post_password) && isset($rtwmer_sort_table) )
                                    {
                                        if( !empty($rtwmer_post_password) && (($rtwmer_sort_table == "draft") || ($rtwmer_sort_table == "pending") || ($rtwmer_sort_table == "private") || ($rtwmer_sort_table == "trash") || ($rtwmer_sort_table == "publish") ) )
                                        {
                                            $rtwmer_prod_name = $rtwmer_prod_name.'<span> - '.esc_html__(' Password protected','rtwmer-mercado').'</span>';
                                        }

                                        if( isset($rtwmer_sort_table) && !empty($rtwmer_sort_table) )
                                        {
                                            if( ($rtwmer_prod_post_status == "draft") && ($rtwmer_sort_table == "all") && empty($rtwmer_post_password) )
                                            {
                                                $rtwmer_prod_name = $rtwmer_prod_name.'<span> - '.esc_html__('Draft','rtwmer-mercado').'</span>';
                                            }
                                            if( ($rtwmer_prod_post_status == "draft") && ($rtwmer_sort_table == "all") && !empty($rtwmer_post_password) )
                                            {
                                                $rtwmer_prod_name = $rtwmer_prod_name.'<span> - '.esc_html__('Password Protected, Draft','rtwmer-mercado').'</span>';
                                            }
                                            if( ($rtwmer_prod_post_status == "private") && ($rtwmer_sort_table == "all") )
                                            {
                                                $rtwmer_prod_name = $rtwmer_prod_name.'<span> - '.esc_html__('Private','rtwmer-mercado').'</span>';
                                            }
                                            if( ($rtwmer_prod_post_status == "publish") && ($rtwmer_sort_table == "all") && !empty($rtwmer_post_password) )
                                            {
                                                $rtwmer_prod_name = $rtwmer_prod_name.'<span> - '.esc_html__('Password Protected','rtwmer-mercado').'</span>';
                                            }
                                            if( ($rtwmer_prod_post_status == "pending") && ($rtwmer_sort_table == "all") && empty($rtwmer_post_password) )
                                            {
                                                $rtwmer_prod_name = $rtwmer_prod_name.'<span> - '.esc_html__('Pending','rtwmer-mercado').'</span>';
                                            }
                                            if( ($rtwmer_prod_post_status == "pending") && ($rtwmer_sort_table == "all") && !empty($rtwmer_post_password) )
                                            {
                                                $rtwmer_prod_name = $rtwmer_prod_name.'<span> - '.esc_html__('Password Protected, Pending','rtwmer-mercado').'</span>';
                                            }
                                        }
                                    }

                                    if($rtwmer_prod_post_status == 'trash')
                                    {
                                        $rtwmer_products_data_ssp['data'][$j][2] = '<div class = "rtwmer_prod_name_box">
                                        <div>
                                            <a href = "#/product" class = "rtwmer_prod_name">'.$rtwmer_prod_name.'</a>
                                        </div>
                                        <div class = "rtwmer_prod_status_action">
                                            <a class = "rtwmer_prod_name_color">'.esc_html__('ID : '.$rtwmer_vendor_prod_id,'rtwmer-mercado').'</a>
                                            <a href = "#/product" class="rtwmer_prod_restore rtwmer_prod_edit" data-id='.esc_attr($rtwmer_vendor_prod_id).'>'.esc_html__('Restore','rtwmer-mercado').'</a>
                                            <a href = "#/product" class = "rtwmer_prod_trash_color rtwmer_prod_del_permanent" data-id='.esc_attr($rtwmer_vendor_prod_id).' >'.esc_html__('Delete Permanentaly','rtwmer-mercado').'</a>
                                            <a class = "rtwmer_prod_duplicate" href = "#/product">'.esc_html__('Duplicate','rtwmer-mercado').'</a>
                                        </div>	
                                    </div>';
                                }
                                    
                                    // $rtwmer_prod_no_name, This variable holds html.

                                else{
                                    $rtwmer_products_data_ssp['data'][$j][2] = '<div class = "rtwmer_prod_name_box">
                                        <div>
                                            <a href = "#/product" class = "rtwmer_prod_name">'.$rtwmer_prod_name.'</a>
                                        </div>
                                        <div class = "rtwmer_prod_status_action">
                                            <a class = "rtwmer_prod_name_color">'.esc_html__('ID : '.$rtwmer_vendor_prod_id,'rtwmer-mercado').'</a>
                                            <a href = "#/product" class="rtwmer_prod_edit" data-id='.esc_attr($rtwmer_vendor_prod_id).'>'.esc_html__('Edit','rtwmer-mercado').'</a>
                                            <a href = "#/product" class="rtwmer_prod_quick_edit" data-id='.esc_attr($rtwmer_vendor_prod_id).' data-target = #rtwmer_prod_quick_edit_modal data-toggle = modal>'.esc_html__('Quick Edit','rtwmer-mercado').'</a>
                                            <a class = "rtwmer_prod_trash_color rtwmer_prod_trash" href = "#/product">'.esc_html__('Trash','rtwmer-mercado').'</a>';
                                            if( $rtwmer_prod_post_status == 'publish' || $rtwmer_prod_post_status == 'private' )
                                            {$rtwmer_products_data_ssp['data'][$j][2].='<a class = "rtwmer_prod_preview" href = "#/product">'.esc_html__('View','rtwmer-mercado').'</a>';}
                                            else{
                                            $rtwmer_products_data_ssp['data'][$j][2].='<a class = "rtwmer_prod_preview" href = "#/product">'.esc_html__('Preview','rtwmer-mercado').'</a>';}
                                            $rtwmer_products_data_ssp['data'][$j][2].='<a href = "#/product" class="rtwmer_prod_duplicate">'.esc_html__('Duplicate','rtwmer-mercado').'</a>
                                        </div>
                                    </div>';
                                    }
                                }
                            }
                            else
                                {
                                    if( (empty($rtwmer_prod[2]))  )
                                    {
                                        $rtwmer_prod_no_name = '(no title)';

                                        if( isset($rtwmer_post_password) )
                                        {
                                            if( !empty($rtwmer_post_password) && (($rtwmer_sort_table == "draft") || ($rtwmer_sort_table == "pending") || ($rtwmer_sort_table == "private") || ($rtwmer_sort_table == "trash") || ($rtwmer_sort_table == "publish") ) )
                                            {
                                                $rtwmer_prod_no_name = $rtwmer_prod_no_name.'<span> - '.esc_html__(' Password protected','rtwmer-mercado').'</span>';
                                            }

                                            if( isset($rtwmer_sort_table) && !empty($rtwmer_sort_table) )
                                            {
                                                if( ($rtwmer_prod_post_status == "draft") && ($rtwmer_sort_table == "all") && empty($rtwmer_post_password) )
                                                {
                                                    $rtwmer_prod_no_name = $rtwmer_prod_no_name.'<span> - '.esc_html__('Draft','rtwmer-mercado').'</span>';
                                                }
                                                if( ($rtwmer_prod_post_status == "publish") && ($rtwmer_sort_table == "all") && !empty($rtwmer_post_password) )
                                                {
                                                    $rtwmer_prod_name = $rtwmer_prod_name.'<span> - '.esc_html__('Password Protected','rtwmer-mercado').'</span>';
                                                }
                                                if( ($rtwmer_prod_post_status == "draft") && ($rtwmer_sort_table == "all") && !empty($rtwmer_post_password) )
                                                {
                                                    $rtwmer_prod_no_name = $rtwmer_prod_no_name.'<span> - '.esc_html__('Password Protected, Draft','rtwmer-mercado').'</span>';
                                                }
                                                if( ($rtwmer_prod_post_status == "private") && ($rtwmer_sort_table == "all") )
                                                {
                                                    $rtwmer_prod_no_name = $rtwmer_prod_no_name.'<span> - '.esc_html__('Private','rtwmer-mercado').'</span>';
                                                }
                                                if( ($rtwmer_prod_post_status == "pending") && ($rtwmer_sort_table == "all") && empty($rtwmer_post_password) )
                                                {
                                                    $rtwmer_prod_no_name = $rtwmer_prod_no_name.'<span> - '.esc_html__('Pending','rtwmer-mercado').'</span>';
                                                }
                                                if( ($rtwmer_prod_post_status == "pending") && ($rtwmer_sort_table == "all") && !empty($rtwmer_post_password) )
                                                {
                                                    $rtwmer_prod_no_name = $rtwmer_prod_no_name.'<span> - '.esc_html__('Password Protected, Pending','rtwmer-mercado').'</span>';
                                                }
                                            }
                                        }

                                        if($rtwmer_prod_post_status == 'trash')
                                        {
                                            $rtwmer_products_data_ssp['data'][$j][2] = '<div class = "rtwmer_prod_name_box">
                                            <div>
                                                <a href = "#/product" class = "rtwmer_prod_name">'.$rtwmer_prod_no_name.'</a>
                                            </div>
                                            <div class = "rtwmer_prod_status_action">
                                                <a class = "rtwmer_prod_name_color">'.esc_html__('ID : '.$rtwmer_vendor_prod_id,'rtwmer-mercado').'</a>
                                                <a href = "#/product" class="rtwmer_prod_restore rtwmer_prod_edit" data-id='.esc_attr($rtwmer_vendor_prod_id).'>'.esc_html__('Restore','rtwmer-mercado').'</a>
                                                <a href = "#/product" class = "rtwmer_prod_trash_color rtwmer_prod_del_permanent" data-id='.esc_attr($rtwmer_vendor_prod_id).' >'.esc_html__('Delete Permanentaly','rtwmer-mercado').'</a>
                                                <a class = "rtwmer_prod_duplicate" href = "#/product">'.esc_html__('Duplicate','rtwmer-mercado').'</a>
                                            </div>	
                                        </div>';
                                        }

                                    // $rtwmer_prod_no_name, This variable holds html.
                                        else
                                        {
                                            $rtwmer_products_data_ssp['data'][$j][2] = '<div class = "rtwmer_prod_name_box">
                                                <div>
                                                    <a href = "#/product" class = "rtwmer_prod_name">'.($rtwmer_prod_no_name).'</a>
                                                </div>
                                                <div class = "rtwmer_prod_status_action">
                                                    <a class = "rtwmer_prod_name_color">'.esc_html__('ID : '.$rtwmer_vendor_prod_id,'rtwmer-mercado').'</a>
                                                    <a href = "#/product" class="rtwmer_prod_edit" data-id='.$rtwmer_vendor_prod_id.'>'.esc_html__('Edit','rtwmer-mercado').'</a>
                                                    <a href = "#/product" class="rtwmer_prod_quick_edit" data-id='.$rtwmer_vendor_prod_id.' data-target = #rtwmer_prod_quick_edit_modal data-toggle = modal>'.esc_html__('Quick Edit','rtwmer-mercado').'</a>
                                                    <a class = "rtwmer_prod_trash_color rtwmer_prod_trash" href = "#/product">'.esc_html__('Trash','rtwmer-mercado').'</a>
                                                    <a href = "#/product">'.esc_html__('View','rtwmer-mercado').'</a>
                                                    <a href = "#/product" class="rtwmer_prod_duplicate">'.esc_html__('Duplicate','rtwmer-mercado').'</a>
                                                </div>
                                            </div>';
                                        }
                                    }
                                }

                            $j++;
                        }
                    }
                }

            } 
        }
        echo json_encode( $rtwmer_products_data_ssp );
        do_action('rtwmer_mercado_vendors_product_table_loaded');
        wp_die();

        } 
    }