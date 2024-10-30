<?php
use Automattic\WooCommerce\Utilities\OrderUtil;
//===================This File is used to launch order table========================//

    // new update start    
    if(OrderUtil::custom_orders_table_usage_is_enabled()){
        // die('yes');
    // if(WC()->version > '8.2.0'){

        if( isset($_POST['rtwmer_order_or_order_all']) && !empty($_POST['rtwmer_order_or_order_all']) )
        {
            update_option('rtwmer_order_or_order_all', sanitize_text_field($_POST['rtwmer_order_or_order_all']));
        }
       
    
        global $wpdb;
    
        $sql_details = array(
            'user' 	=> 	DB_USER,
            'pass' 	=> 	DB_PASSWORD,
            'db'	=>	DB_NAME,
            'host'	=>	DB_HOST,
        );
        $table = $wpdb->prefix.'wc_orders';

        $primaryKey = 'id';
        
        $columns = array(
            array( 'db' => 'id', 'dt' => 0, 'field' => 'id' ),
            array( 'db' => 'id', 'dt' => 1, 'field' => 'id' ),
            array( 'db' => 'date_created_gmt', 'dt' => 2, 'field' => 'date_created_gmt' ),
            array( 'db' => 'status', 'dt' => 3, 'field' => 'status' ),
            array( 'db' => 'total_amount', 'dt' => 4, 'field' => 'total_amount' ),
            array( 'db' => 'rtwmer_order_vendor', 'dt' => 5, 'field' => 'rtwmer_order_vendor' ),
            array( 'db' => 'rtwmer_sub_order', 'dt' => 6, 'field' => 'rtwmer_sub_order' ),
            array( 'db' => 'customer_id', 'dt' => 7, 'field' => 'customer_id' ),
            array( 'db' => 'rtwmer_billing_last_name', 'dt' => 8, 'field' => 'rtwmer_billing_last_name' )
        ); 
    
    
        $join = "FROM ".$table." as m LEFT JOIN(SELECT order_id,
        MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor,
        MAX(CASE WHEN meta_key = 'rtwmer_sub_order' THEN meta_value END) rtwmer_sub_order,
        MAX(CASE WHEN meta_key = '_billing_first_name' THEN meta_value END) rtwmer_billing_first_name,
        MAX(CASE WHEN meta_key = '_billing_address_index' THEN meta_value END) rtwmer_billing_last_name,
        MAX(CASE WHEN meta_key = '_order_total' THEN meta_value END) rtwmer_order_total
        FROM ".$wpdb->prefix."wc_orders_meta GROUP BY order_id) rtwmer_order_table on m.`id`=rtwmer_order_table.`order_id`";
    
        $where = "`type`='shop_order'";
    
        // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
        $equals = "`status`!='auto-draft'";

        // $equals2 = "`post_parent`='0'";
    
        $equals2 = "`parent_order_id`='0'";

        $equals3 = "`status`!='wc-checkout-draft'";
    
        $where .= 'AND' .$equals. 'AND' .$equals2. 'AND' .$equals3;

      
    
    
        if( isset($_POST['rtwmer_order_vendor_id']) && !empty($_POST['rtwmer_order_vendor_id']) )
        {
            $rtwmer_order_vendor_id = sanitize_text_field($_POST['rtwmer_order_vendor_id']);
            if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
            {
                update_option( 'rtwmer_order_vendor_id',$rtwmer_order_vendor_id );
    
                $where = "`type`='shop_order'";
       
    
                // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                $equals = "`status`!='auto-draft'";
    
                $equals1 = "`rtwmer_order_vendor`='".$rtwmer_order_vendor_id."'";
    
                $where .= 'AND' .$equals. 'AND' .$equals1;
    
                if( isset($_POST['rtwmer_sort_order_by']) && !empty($_POST['rtwmer_sort_order_by']) )
                {
                    update_option( 'rtwmer_sort_order_by',sanitize_text_field($_POST['rtwmer_sort_order_by']) );
    
                    if( $_POST['rtwmer_sort_order_by'] == 'trash' )
                    {
                        $where = "`type`='shop_order'";
    
                        // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`rtwmer_order_vendor`='".$rtwmer_order_vendor_id."'";
    
                        $equals1 = "`status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
    
                        $where .= 'AND' .$equals. 'AND' .$equals1;
                    }
    
                    else if( $_POST['rtwmer_sort_order_by'] != 'all' && $_POST['rtwmer_sort_order_by'] != 'trash' )
                    {
                        $where = "`type`='shop_order'";
    
                        // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`rtwmer_order_vendor`='".$rtwmer_order_vendor_id."'";
    
                        $equals1 = "`status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
    
                        $where .= 'AND' .$equals. 'AND' .$equals1;
                    }
                }
            }
        }
        else if( isset($_POST['rtwmer_show_sub_main_order_id']) && !empty($_POST['rtwmer_show_sub_main_order_id']) )
        {
        
            $rtwmer_order_vendor_id = sanitize_text_field($_POST['rtwmer_show_sub_main_order_id']);
            if(isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id))
            {
                $where = "`type`='shop_order'";
    
                // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                $equals = "`status`!='auto-draft'";

              
    
                $equals1 = "`post_parent`='".$rtwmer_order_vendor_id."'";
    
                // $equals2 = "`post_parent`='0'";
    
                $equals2 = "`parent_order_id`='0'";
    
                $where .= ' AND (' .$equals1. ' OR ' .$equals2.")";
    
                $where .= ' AND ' .$equals;
    
                if( isset($_POST['rtwmer_sort_order_by']) && !empty($_POST['rtwmer_sort_order_by']) )
                {
                    update_option( 'rtwmer_sort_order_by',sanitize_text_field($_POST['rtwmer_sort_order_by']) );
    
                    if( $_POST['rtwmer_sort_order_by'] == 'trash' || $_POST['rtwmer_sort_order_by'] == 'draft' )
                    {
                        $where = "`type`='shop_order'";
    
                        // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`status`!='auto-draft'";
    
                        $equals3 = "`post_status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
            
                        $equals1 = "`post_parent`='".$rtwmer_order_vendor_id."'";
            
                        // $equals2 = "`post_parent`='0'";
    
                        $equals2 = "`parent_order_id`='0'";
            
                        $where .= ' AND (' .$equals1. ' OR ' .$equals2.")";
            
                        $where .= ' AND ' .$equals. 'AND' .$equals3;
                    }
                    else if( $_POST['rtwmer_sort_order_by'] == 'all' )
                    {
                        $where = "`type`='shop_order'";
    
                        // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`status`!='auto-draft'";
            
                        $equals1 = "`post_parent`='".$rtwmer_order_vendor_id."'";
            
                        // $equals2 = "`post_parent`='0'";
    
                        $equals2 = "`parent_order_id`='0'";
            
                        $where .= ' AND (' .$equals1. ' OR ' .$equals2.")";
            
                        $where .= ' AND ' .$equals;
                    }
                    else
                    {
                        $rtwmer_sort_sub_orders = 'wc-';
    
                        $rtwmer_sort_sub_orders .= sanitize_text_field($_POST['rtwmer_sort_order_by']);
    
                        $where = "`type`='shop_order'";
    
                        // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`status`!='auto-draft'";
    
                        $equals3 = "`status`='".$rtwmer_sort_sub_orders."'";
            
                        $equals1 = "`post_parent`='".$rtwmer_order_vendor_id."'";
            
                        // $equals2 = "`post_parent`='0'";
    
                        $equals2 = "`parent_order_id`='0'";
            
                        $where .= ' AND (' .$equals1. ' OR ' .$equals2.")";
            
                        $where .= ' AND ' .$equals. 'AND' .$equals3;
                    }
                }
    
            }
        }
        else
        {
            // echo '<pre>';
            // print_r($where);
            // echo '</pre>';
            // die('asdffsssa');
            if( isset($_POST['rtwmer_sort_order_by']) && !empty($_POST['rtwmer_sort_order_by']) )
            {
                update_option( 'rtwmer_sort_order_by',sanitize_text_field($_POST['rtwmer_sort_order_by']) );
    
                if( $_POST['rtwmer_sort_order_by'] == 'trash' || $_POST['rtwmer_sort_order_by'] == 'draft' )
                {
                    $where = "`type`='shop_order'";
    
                    // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                    $equals1 = "`status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
    
                    // $equals2 = "`post_parent`='0'";
    
                    $equals2 = "`parent_order_id`='0'";
    
                    $where .= 'AND '.$equals1. ' AND ' .$equals2;
    
                }
    
                else if( $_POST['rtwmer_sort_order_by'] == 'all' )
                {
                    $where = "`type`='shop_order'";
    
                    // $equals2 = "`post_parent`='0'";
    
                    $equals2 = "`parent_order_id`='0'";
    
                    $equals3 = "`status`!='auto-draft'";

                    $equals4 = "`status`!='wc-checkout-draft'";
    
                    $where .= ' AND ' .$equals2. 'AND' .$equals3. 'AND' .$equals4;

                    
    
                    // $where .= 'AND' .$equals. 'AND' .$equals2. 'AND' .$equals3;
                }
    
                else
                {
                    if( substr($_POST['rtwmer_sort_order_by'],0,3) == 'wc-' )
                    {
                        $equals1 = "`status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
                    }
                    else
                    {
                        $rtwmer_sort_by_status = 'wc-';
    
                        $rtwmer_sort_by_status .= sanitize_text_field($_POST['rtwmer_sort_order_by']);
    
                        $equals1 = "`status`='".$rtwmer_sort_by_status."'";
                    }
    
                    $where = "`type`='shop_order'";
    
                    // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                    // $equals2 = "`post_parent`='0'";
    
                    $equals2 = "`parent_order_id`='0'";
    
                    $where .= 'AND '.$equals1. ' AND ' .$equals2;
    
                }
            }
        }
    
        include_once( RTWMER_ADMIN_PARTIAL.'/ssp/ssp.customized.class.php' );
    
        $rtwmer_order_table_ssp = SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $join, $where );

        if( isset($rtwmer_order_table_ssp) && !empty($rtwmer_order_table_ssp) )
        {
           
            if( isset($rtwmer_order_table_ssp['data']) && !empty($rtwmer_order_table_ssp['data']) )
            {
               
                $rtwmer_order_table_data = $rtwmer_order_table_ssp['data'];
               
               
                if( isset($rtwmer_order_table_data) && !empty($rtwmer_order_table_data) )
                {
                    $i = 0;
    
                    if( isset($rtwmer_order_table_ssp['data'][$i]) )
                    {
                        foreach($rtwmer_order_table_data as $data)
                        {
                         
                            if( isset($data))
                            {
                                if( isset($rtwmer_order_table_ssp['data'][$i][0]) && isset($data[1]) )
                                {
                                
                                    $rtwmer_order_table_ssp['data'][$i][0] = '<td class="mdc-data-table__cell mdc-data-table__cell--checkbox">
                                    <div class="mdc-checkbox mdc-data-table__row-checkbox">
                                        <input type="checkbox" class="mdc-checkbox__native-control rtwmer_orders_inner_checkbox" data-id = "'.esc_attr($data[1]).'" name = "rtwmer_prod_inner_check" />
                                        <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                        </div>
                                        <div class="mdc-checkbox__ripple"></div>
                                    </div>
                                </td>';
                                }
                                if( isset($rtwmer_order_table_ssp['data'][$i][1]) && isset($data[1]) && isset($data[7]) && isset($data[8]) )
                                {
                                    // $rtwmer_order_table_ssp['data'][$i][1] = "<div class='rtmwer_order_name_section'>
                                    //     <a href = '#orders' class='rtwmer_order_name' data-id=".esc_attr($data[1]).">
                                    //     #".esc_attr($data[1])." ".esc_attr($data[7])." ".esc_attr($data[8])."
                                    //     </a>
                                    //     <a href='#orders' class='rtwmer_order_view_icon' title=".esc_html__('Preview','rtwmer-mercado')."><i class='fa fa-eye' aria-hidden='true'></i></a>
                                    // </div>";
    
                                    /*  old one */
                                    $name = explode(' ' , $data[8]);
                                    $final_name = $name[0] ." ". $name[1];
    
                                    $rtwmer_order_table_ssp['data'][$i][1] = "<div class='rtmwer_order_name_section'>
                                        <a href = '#orders' class='rtwmer_order_name' data-id=".esc_attr($data[1]).">
                                        #".esc_attr($data[1])." ".esc_attr($final_name)."
                                        </a>
                                        <a href='#orders' class='rtwmer_order_view_icon' title=".esc_html__('Preview','rtwmer-mercado')."><i class='fa fa-eye' aria-hidden='true'></i></a>
                                    </div>";
                                }
                                else
                                {
                                    die('else'); 
                                    if( isset($rtwmer_order_table_ssp['data'][$i][1]) && isset($data[1]) )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][1] = "<div class='rtmwer_order_name_section'>
                                            <a href = '#orders' class='rtwmer_order_name' data-id=".esc_attr($data[1]).">
                                            #".esc_attr($data[1])." ".esc_attr($data[7])." ".esc_attr($data[8])."
                                            </a>
                                            <a href='#orders' class='rtwmer_order_view_icon' title=".esc_html__('Preview','rtwmer-mercado')."><i class='fa fa-eye' aria-hidden='true'></i></a>
                                        </div>";
                                    }
                                }
                                if( isset($rtwmer_order_table_ssp['data'][$i][2]) && isset($data[2]) )
                                {
                                    $rtwmer_order_table_ssp['data'][$i][2] = date("M j, Y",strtotime($data[2]));
                                }
                                if( isset($rtwmer_order_table_ssp['data'][$i][3]) && isset($data[3]) )
                                {
                                    if( $data[3] == 'wc-completed' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_completed'>".esc_html__('Completed','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-on-hold' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_on-hold'>".esc_html__('On hold','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-processing' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_processing'>".esc_html__('Processing','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-failed' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_failed'>".esc_html__('Failed','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-refunded' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_refunded'>".esc_html__('Refunded','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-cancelled' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_cancelled'>".esc_html__('Cancelled','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-pending' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_pending'>".esc_html__('Pending Payment','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'trash' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_trash'>".esc_html__('Trash','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'draft' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_draft'>".esc_html__('Draft','rtwmer-mercado')."</mark>";
                                    }
                                }
                                if( isset($rtwmer_order_table_ssp['data'][$i][4]) && isset($data[4]) )
                                {
                                    $rtwmer_order_table_ssp['data'][$i][4] = wc_price($data[4]);
                                }
                                if( isset($data[1]) && $data[3] )
                                {
                                    if( $data[3] == 'trash' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][7] = '
                                        <div class="rtwmer-button-group">
                                            <button title="'.esc_html__('Restore Order','rtwmer-mercado').'" class="mdc-button  rtwmer_change_order_status rtwmer-restore-btn" data-id="'.esc_attr($data[1]).'" data-value="restore">
                                            <span class="material-icons">restore<span>
                                            </button>
                                            <button title="'.esc_html__('Delete Permanently','rtwmer-mercado').'" class="mdc-button rtwmer_change_order_status rtwmer-delete-btn" data-id="'.esc_attr($data[1]).'" data-value="delete">
                                            <span class="material-icons">delete_forever</span>
                                            <div class="mdc-button__ripple"></div>
                                            </button>
                                        </div>';
                                    }
                                    else if( !empty(get_option('rtwmer_withdraw_option')) )
                                    {
                                        if(isset(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor']))
                                        {
                                            if(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor'] == 'rtwmer_after_admin_approval')
                                            {
                                                $rtwmer_order_table_ssp['data'][$i][7] = '
                                                <div class="rtwmer-button-group">
                                                    <button title="'.esc_html__('Send Payment','rtwmer-mercado').'" class="mdc-button  rtwmer_change_order_status rtwmer-done-btn" data-id="'.esc_attr($data[1]).'" data-value="send_payment"><span class=" material-icons">done</span>
                                                    <div class="mdc-button__ripple"></div>
                                                    </button>
                                                    <button title="'.esc_html__('Send to Trash','rtwmer-mercado').'" class="mdc-button rtwmer_change_order_status rtwmer-trash-btn" data-id="'.esc_attr($data[1]).'" data-value="trash">
                                                    <span class="material-icons ">delete</span>
                                                    <div class="mdc-button__ripple"></div>
                                                    </button>
                                                </div>';
                                            }
                                            else
                                            {
                                                $rtwmer_order_table_ssp['data'][$i][7] = '
                                                <div class="rtwmer-button-group">
                                                    <button title="Send to Trash" class="mdc-button  rtwmer_change_order_status rtwmer-trash-btn" data-id="'.esc_attr($data[1]).'" data-value="trash">
                                                    
                                                    <span class="material-icons">delete</span>
                                                    <div class="mdc-button__ripple"></div>
                                                    </button>
                                                </div>';
                                            }
                                        }
                                        else
                                        {
                                            $rtwmer_order_table_ssp['data'][$i][7] = '
                                            <div class="rtwmer-button-group">
                                            <button title="'.esc_html__('Send to Trash','rtwmer-mercado').'" class="mdc-button  rtwmer_change_order_status rtwmer-trash-btn" data-id="'.esc_attr($data[1]).'" data-value="trash">
                                            <span class=" material-icons">delete</span>
                                            <div class="mdc-button__ripple"></div>
                                            </button
                                            </div>';
                                        }
                                    }
                                } 
                                if( isset($data[6]) && isset($data[1]) )
                                {
                                    $rtwmer_order_parent_id = wp_get_post_parent_id($data[1]);
                                    if( isset($rtwmer_order_parent_id) )
                                    {	
                                        if( $rtwmer_order_parent_id == 0 && $data[6] == 1 )
                                        {
                                            $rtwmer_order_table_ssp['data'][$i][5] = '<p>('.esc_html__('no vendor','rtwmer-mercado').')</p>';
                                            $rtwmer_order_table_ssp['data'][$i][6] = '<p><a class="rtwmer_show_sub_order rtwmer_show_hide_order'.esc_attr($data[1]).'" data-value="show" href="#/orders_all" data-id='.esc_attr($data[1]).'>'.esc_html__('Show Sub Order','rtwmer-mercado').'</a></p>';
                                        }
                                    }
                                }
                                if( !isset($data[6]) && isset($data[1]) )
                                {
                                    $rtwmer_order_parent_id = wp_get_post_parent_id($data[1]);
                                    if( isset($rtwmer_order_parent_id) )
                                    {	
                                        if( $rtwmer_order_parent_id != 0 )
                                        {
                                            $rtwmer_order_table_ssp['data'][$i][6] = '<p>'.esc_html__('Sub Order of #','rtwmer-mercado').$rtwmer_order_parent_id.'</p>';
                                        }
                                    }
                                }
                                if( isset($data[5]) && isset($data[1]) )
                                {
                                    $rtwmer_order_table_ssp['data'][$i][5] = '<p>'.get_user_meta( $data[5],"rtwmer_store_name",true ).'</p>';
                                }
                            }
                            $i++;
                        }
                    }
                }
            }
        }
        echo json_encode($rtwmer_order_table_ssp);
        do_action('rtwmer_mercado_orders_table_loaded');
        wp_die();
    
        // SELECT * FROM `wp_wc_orders` as m LEFT JOIN(SELECT `order_id`,
        // MAX(CASE WHEN `meta_key` = 'rtwmer_order_vendor' THEN `meta_value` END) rtwmer_order_vendor,
        // MAX(CASE WHEN `meta_key` = 'rtwmer_sub_order' THEN `meta_value` END) rtwmer_sub_order,
        // MAX(CASE WHEN `meta_key` = '_billing_first_name' THEN `meta_value` END) rtwmer_billing_first_name,
        // MAX(CASE WHEN `meta_key` = '_billing_address_index' THEN `meta_value` END) rtwmer_billing_last_name,
        // MAX(CASE WHEN `meta_key` = '_order_total' THEN `meta_value` END) rtwmer_order_total
        // FROM `wp_wc_orders_meta` GROUP BY `order_id`) `rtwmer_order_table` on m.`id`=`rtwmer_order_table`.`order_id`
        // WHERE `type`='shop_order' AND `parent_order_id`='0'AND`status`!='auto-draft'


    


    }else{
        // for older woocommerce

        if( isset($_POST['rtwmer_order_or_order_all']) && !empty($_POST['rtwmer_order_or_order_all']) )
        {
            update_option('rtwmer_order_or_order_all', sanitize_text_field($_POST['rtwmer_order_or_order_all']));
        }
         
        global $wpdb;
    
        $sql_details = array(
            'user' 	=> 	DB_USER,
            'pass' 	=> 	DB_PASSWORD,
            'db'	=>	DB_NAME,
            'host'	=>	DB_HOST,
        );
    
        $table = $wpdb->prefix.'posts';
    
        $primaryKey = 'ID';
    
        $columns = array(
            array( 'db' => 'ID', 'dt' => 0, 'field' => 'ID' ),
            array( 'db' => 'ID', 'dt' => 1, 'field' => 'ID' ),
            array( 'db' => 'post_date', 'dt' => 2, 'field' => 'post_date' ),
            array( 'db' => 'post_status', 'dt' => 3, 'field' => 'post_status' ),
            array( 'db' => 'rtwmer_order_total', 'dt' => 4, 'field' => 'rtwmer_order_total' ),
            array( 'db' => 'rtwmer_order_vendor', 'dt' => 5, 'field' => 'rtwmer_order_vendor' ),
            array( 'db' => 'rtwmer_sub_order', 'dt' => 6, 'field' => 'rtwmer_sub_order' ),
            array( 'db' => 'rtwmer_billing_first_name', 'dt' => 7, 'field' => 'rtwmer_billing_first_name' ),
            array( 'db' => 'rtwmer_billing_last_name', 'dt' => 8, 'field' => 'rtwmer_billing_last_name' )
        ); 
        
        $join = "FROM ".$wpdb->prefix."posts as m LEFT JOIN(SELECT post_id,
        MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor,
        MAX(CASE WHEN meta_key = 'rtwmer_sub_order' THEN meta_value END) rtwmer_sub_order,
        MAX(CASE WHEN meta_key = '_billing_first_name' THEN meta_value END) rtwmer_billing_first_name,
        MAX(CASE WHEN meta_key = '_billing_last_name' THEN meta_value END) rtwmer_billing_last_name,
        MAX(CASE WHEN meta_key = '_order_total' THEN meta_value END) rtwmer_order_total
        FROM ".$wpdb->prefix."postmeta GROUP BY post_id) rtwmer_order_table on m.`ID`=rtwmer_order_table.`post_id`";
    
        $where = "`post_type`='shop_order'";
    
        // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
    
        $equals = "`post_status`!='auto-draft'";
    
        $equals2 = "`post_parent`='0'";
    
        $where .= 'AND' .$equals. 'AND' .$equals2;
    
    
        if( isset($_POST['rtwmer_order_vendor_id']) && !empty($_POST['rtwmer_order_vendor_id']) )
        {
            $rtwmer_order_vendor_id = sanitize_text_field($_POST['rtwmer_order_vendor_id']);
            if( isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id) )
            {
                update_option( 'rtwmer_order_vendor_id',$rtwmer_order_vendor_id );
    
                // $where = "`post_type`='shop_order'";
    
                $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                $equals = "`post_status`!='auto-draft'";
    
                $equals1 = "`rtwmer_order_vendor`='".$rtwmer_order_vendor_id."'";
    
                $where .= 'AND' .$equals. 'AND' .$equals1;
    
                if( isset($_POST['rtwmer_sort_order_by']) && !empty($_POST['rtwmer_sort_order_by']) )
                {
                    update_option( 'rtwmer_sort_order_by',sanitize_text_field($_POST['rtwmer_sort_order_by']) );
    
                    if( $_POST['rtwmer_sort_order_by'] == 'trash' )
                    {
                        // $where = "`post_type`='shop_order'";
    
                        $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`rtwmer_order_vendor`='".$rtwmer_order_vendor_id."'";
    
                        $equals1 = "`post_status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
    
                        $where .= 'AND' .$equals. 'AND' .$equals1;
                    }
    
                    else if( $_POST['rtwmer_sort_order_by'] != 'all' && $_POST['rtwmer_sort_order_by'] != 'trash' )
                    {
                        // $where = "`post_type`='shop_order'";
    
                        $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`rtwmer_order_vendor`='".$rtwmer_order_vendor_id."'";
    
                        $equals1 = "`post_status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
    
                        $where .= 'AND' .$equals. 'AND' .$equals1;
                    }
                }
            }
        }
        else if( isset($_POST['rtwmer_show_sub_main_order_id']) && !empty($_POST['rtwmer_show_sub_main_order_id']) )
        {
            $rtwmer_order_vendor_id = sanitize_text_field($_POST['rtwmer_show_sub_main_order_id']);
            if(isset($rtwmer_order_vendor_id) && !empty($rtwmer_order_vendor_id))
            {
                // $where = "`post_type`='shop_order'";
    
                $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                $equals = "`post_status`!='auto-draft'";
    
                $equals1 = "`post_parent`='".$rtwmer_order_vendor_id."'";
    
                $equals2 = "`post_parent`='0'";
    
                $where .= ' AND (' .$equals1. ' OR ' .$equals2.")";
    
                $where .= ' AND ' .$equals;
    
                if( isset($_POST['rtwmer_sort_order_by']) && !empty($_POST['rtwmer_sort_order_by']) )
                {
                    update_option( 'rtwmer_sort_order_by',sanitize_text_field($_POST['rtwmer_sort_order_by']) );
    
                    if( $_POST['rtwmer_sort_order_by'] == 'trash' || $_POST['rtwmer_sort_order_by'] == 'draft' )
                    {
                        // $where = "`post_type`='shop_order'";
    
                        $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`post_status`!='auto-draft'";
    
                        $equals3 = "`post_status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
            
                        $equals1 = "`post_parent`='".$rtwmer_order_vendor_id."'";
            
                        $equals2 = "`post_parent`='0'";
            
                        $where .= ' AND (' .$equals1. ' OR ' .$equals2.")";
            
                        $where .= ' AND ' .$equals. 'AND' .$equals3;
                    }
                    else if( $_POST['rtwmer_sort_order_by'] == 'all' )
                    {
                        // $where = "`post_type`='shop_order'";
    
                        $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`post_status`!='auto-draft'";
            
                        $equals1 = "`post_parent`='".$rtwmer_order_vendor_id."'";
            
                        $equals2 = "`post_parent`='0'";
            
                        $where .= ' AND (' .$equals1. ' OR ' .$equals2.")";
            
                        $where .= ' AND ' .$equals;
                    }
                    else
                    {
                        $rtwmer_sort_sub_orders = 'wc-';
    
                        $rtwmer_sort_sub_orders .= sanitize_text_field($_POST['rtwmer_sort_order_by']);
    
                        // $where = "`post_type`='shop_order'";
    
                        $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                        $equals = "`post_status`!='auto-draft'";
    
                        $equals3 = "`post_status`='".$rtwmer_sort_sub_orders."'";
            
                        $equals1 = "`post_parent`='".$rtwmer_order_vendor_id."'";
            
                        $equals2 = "`post_parent`='0'";
            
                        $where .= ' AND (' .$equals1. ' OR ' .$equals2.")";
            
                        $where .= ' AND ' .$equals. 'AND' .$equals3;
                    }
                }
    
            }
        }
        else
        {
            if( isset($_POST['rtwmer_sort_order_by']) && !empty($_POST['rtwmer_sort_order_by']) )
            {
                update_option( 'rtwmer_sort_order_by',sanitize_text_field($_POST['rtwmer_sort_order_by']) );
    
                if( $_POST['rtwmer_sort_order_by'] == 'trash' || $_POST['rtwmer_sort_order_by'] == 'draft' )
                {
                    // $where = "`post_type`='shop_order'";
    
                    $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                    $equals1 = "`post_status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
    
                    $equals2 = "`post_parent`='0'";
    
                    $where .= 'AND '.$equals1. ' AND ' .$equals2;
    
                }
    
                else if( $_POST['rtwmer_sort_order_by'] == 'all' )
                {
                    // $where = "`post_type`='shop_order'";
    
                    $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                    $equals2 = "`post_parent`='0'";
    
                    $equals3 = "`post_status`!='auto-draft'";
    
                    $where .= ' AND ' .$equals2. 'AND' .$equals3;
                }
    
                else
                {
                    if( substr($_POST['rtwmer_sort_order_by'],0,3) == 'wc-' )
                    {
                        $equals1 = "`post_status`='".sanitize_text_field($_POST['rtwmer_sort_order_by'])."'";
                    }
                    else
                    {
                        $rtwmer_sort_by_status = 'wc-';
    
                        $rtwmer_sort_by_status .= sanitize_text_field($_POST['rtwmer_sort_order_by']);
    
                        $equals1 = "`post_status`='".$rtwmer_sort_by_status."'";
                    }
    
                    // $where = "`post_type`='shop_order'";
    
                    $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
                    $equals2 = "`post_parent`='0'";
    
                    $where .= 'AND '.$equals1. ' AND ' .$equals2;
    
                }
            }
        }
    
        include_once( RTWMER_ADMIN_PARTIAL.'/ssp/ssp.customized.class.php' );
    
        $rtwmer_order_table_ssp = SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $join, $where );
        
        if( isset($rtwmer_order_table_ssp) && !empty($rtwmer_order_table_ssp) )
        {
            if( isset($rtwmer_order_table_ssp['data']) && !empty($rtwmer_order_table_ssp['data']) )
            {
                $rtwmer_order_table_data = $rtwmer_order_table_ssp['data'];
                
                if( isset($rtwmer_order_table_data) && !empty($rtwmer_order_table_data) )
                {
                    $i = 0;
    
                    if( isset($rtwmer_order_table_ssp['data'][$i]) )
                    {
                        foreach($rtwmer_order_table_data as $data)
                        {
                            if( isset($data))
                            {
                                if( isset($rtwmer_order_table_ssp['data'][$i][0]) && isset($data[1]) )
                                {
                                    $rtwmer_order_table_ssp['data'][$i][0] = '<td class="mdc-data-table__cell mdc-data-table__cell--checkbox">
                                    <div class="mdc-checkbox mdc-data-table__row-checkbox">
                                        <input type="checkbox" class="mdc-checkbox__native-control rtwmer_orders_inner_checkbox" data-id = "'.esc_attr($data[1]).'" name = "rtwmer_prod_inner_check" />
                                        <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                        </div>
                                        <div class="mdc-checkbox__ripple"></div>
                                    </div>
                                </td>';
                                }
                                if( isset($rtwmer_order_table_ssp['data'][$i][1]) && isset($data[1]) && isset($data[7]) && isset($data[8]) )
                                {
                                    $rtwmer_order_table_ssp['data'][$i][1] = "<div class='rtmwer_order_name_section'>
                                        <a href = '#orders' class='rtwmer_order_name' data-id=".esc_attr($data[1]).">
                                        #".esc_attr($data[1])." ".esc_attr($data[7])." ".esc_attr($data[8])."
                                        </a>
                                        <a href='#orders' class='rtwmer_order_view_icon' title=".esc_html__('Preview','rtwmer-mercado')."><i class='fa fa-eye' aria-hidden='true'></i></a>
                                    </div>";
                                }
                                else
                                {
                                    if( isset($rtwmer_order_table_ssp['data'][$i][1]) && isset($data[1]) )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][1] = "<div class='rtmwer_order_name_section'>
                                            <a href = '#orders' class='rtwmer_order_name' data-id=".esc_attr($data[1]).">
                                            #".esc_attr($data[1])." ".esc_attr($data[7])." ".esc_attr($data[8])."
                                            </a>
                                            <a href='#orders' class='rtwmer_order_view_icon' title=".esc_html__('Preview','rtwmer-mercado')."><i class='fa fa-eye' aria-hidden='true'></i></a>
                                        </div>";
                                    }
                                }
                                if( isset($rtwmer_order_table_ssp['data'][$i][2]) && isset($data[2]) )
                                {
                                    $rtwmer_order_table_ssp['data'][$i][2] = date("M j, Y",strtotime($data[2]));
                                }
                                if( isset($rtwmer_order_table_ssp['data'][$i][3]) && isset($data[3]) )
                                {
                                    if( $data[3] == 'wc-completed' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_completed'>".esc_html__('Completed','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-on-hold' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_on-hold'>".esc_html__('On hold','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-processing' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_processing'>".esc_html__('Processing','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-failed' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_failed'>".esc_html__('Failed','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-refunded' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_refunded'>".esc_html__('Refunded','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-cancelled' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_cancelled'>".esc_html__('Cancelled','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'wc-pending' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_pending'>".esc_html__('Pending Payment','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'trash' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_trash'>".esc_html__('Trash','rtwmer-mercado')."</mark>";
                                    }
                                    if( $data[3] == 'draft' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][3] = "<mark class='rtmwer_order_draft'>".esc_html__('Draft','rtwmer-mercado')."</mark>";
                                    }
                                }
                                if( isset($rtwmer_order_table_ssp['data'][$i][4]) && isset($data[4]) )
                                {
                                    $rtwmer_order_table_ssp['data'][$i][4] = wc_price($data[4]);
                                }
                                if( isset($data[1]) && $data[3] )
                                {
                                    if( $data[3] == 'trash' )
                                    {
                                        $rtwmer_order_table_ssp['data'][$i][7] = '
                                        <div class="rtwmer-button-group">
                                            <button title="'.esc_html__('Restore Order','rtwmer-mercado').'" class="mdc-button  rtwmer_change_order_status rtwmer-restore-btn" data-id="'.esc_attr($data[1]).'" data-value="restore">
                                            <span class="material-icons">restore<span>
                                            </button>
                                            <button title="'.esc_html__('Delete Permanently','rtwmer-mercado').'" class="mdc-button rtwmer_change_order_status rtwmer-delete-btn" data-id="'.esc_attr($data[1]).'" data-value="delete">
                                            <span class="material-icons">delete_forever</span>
                                            <div class="mdc-button__ripple"></div>
                                            </button>
                                        </div>';
                                    }
                                    else if( !empty(get_option('rtwmer_withdraw_option')) )
                                    {
                                        if(isset(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor']))
                                        {
                                            if(get_option('rtwmer_withdraw_option')['rtwmer_withdraw_to_vendor'] == 'rtwmer_after_admin_approval')
                                            {
                                                $rtwmer_order_table_ssp['data'][$i][7] = '
                                                <div class="rtwmer-button-group">
                                                    <button title="'.esc_html__('Send Payment','rtwmer-mercado').'" class="mdc-button  rtwmer_change_order_status rtwmer-done-btn" data-id="'.esc_attr($data[1]).'" data-value="send_payment"><span class=" material-icons">done</span>
                                                    <div class="mdc-button__ripple"></div>
                                                    </button>
                                                    <button title="'.esc_html__('Send to Trash','rtwmer-mercado').'" class="mdc-button rtwmer_change_order_status rtwmer-trash-btn" data-id="'.esc_attr($data[1]).'" data-value="trash">
                                                    <span class="material-icons ">delete</span>
                                                    <div class="mdc-button__ripple"></div>
                                                    </button>
                                                </div>';
                                            }
                                            else
                                            {
                                                $rtwmer_order_table_ssp['data'][$i][7] = '
                                                <div class="rtwmer-button-group">
                                                    <button title="Send to Trash" class="mdc-button  rtwmer_change_order_status rtwmer-trash-btn" data-id="'.esc_attr($data[1]).'" data-value="trash">
                                                    
                                                    <span class="material-icons">delete</span>
                                                    <div class="mdc-button__ripple"></div>
                                                    </button>
                                                </div>';
                                            }
                                        }
                                        else
                                        {
                                            $rtwmer_order_table_ssp['data'][$i][7] = '
                                            <div class="rtwmer-button-group">
                                            <button title="'.esc_html__('Send to Trash','rtwmer-mercado').'" class="mdc-button  rtwmer_change_order_status rtwmer-trash-btn" data-id="'.esc_attr($data[1]).'" data-value="trash">
                                            <span class=" material-icons">delete</span>
                                            <div class="mdc-button__ripple"></div>
                                            </button
                                            </div>';
                                        }
                                    }
                                } 
                                if( isset($data[6]) && isset($data[1]) )
                                {
                                    $rtwmer_order_parent_id = wp_get_post_parent_id($data[1]);
                                    if( isset($rtwmer_order_parent_id) )
                                    {	
                                        if( $rtwmer_order_parent_id == 0 && $data[6] == 1 )
                                        {
                                            $rtwmer_order_table_ssp['data'][$i][5] = '<p>('.esc_html__('no vendor','rtwmer-mercado').')</p>';
                                            $rtwmer_order_table_ssp['data'][$i][6] = '<p><a class="rtwmer_show_sub_order rtwmer_show_hide_order'.esc_attr($data[1]).'" data-value="show" href="#/orders_all" data-id='.esc_attr($data[1]).'>'.esc_html__('Show Sub Order','rtwmer-mercado').'</a></p>';
                                        }
                                    }
                                }
                                if( !isset($data[6]) && isset($data[1]) )
                                {
                                    $rtwmer_order_parent_id = wp_get_post_parent_id($data[1]);
                                    if( isset($rtwmer_order_parent_id) )
                                    {	
                                        if( $rtwmer_order_parent_id != 0 )
                                        {
                                            $rtwmer_order_table_ssp['data'][$i][6] = '<p>'.esc_html__('Sub Order of #','rtwmer-mercado').$rtwmer_order_parent_id.'</p>';
                                        }
                                    }
                                }
                                if( isset($data[5]) && isset($data[1]) )
                                {
                                    $rtwmer_order_table_ssp['data'][$i][5] = '<p>'.get_user_meta( $data[5],"rtwmer_store_name",true ).'</p>';
                                }
                            }
                            $i++;
                        }
                    }
                }
            }
        }
        // echo '<pre>';
        // print_r($rtwmer_order_table_ssp);
        // echo '</pre>';
        // die('fjsdajdskfjfjs');

        echo json_encode($rtwmer_order_table_ssp);
        do_action('rtwmer_mercado_orders_table_loaded');
        wp_die();


    }

   

?>