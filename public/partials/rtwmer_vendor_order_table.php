<?php
use Automattic\WooCommerce\Utilities\OrderUtil;
// This file contains the code for order table working


if(OrderUtil::custom_orders_table_usage_is_enabled()){
    // WC()->version > '8.2.0'
    // die('fdhjjafdjk');
 
    global $wpdb;
    global $rtwmer_user_id_for_dashboard;
    $rtwmer_author_ID =  $rtwmer_user_id_for_dashboard;

    /* testing for ssp::simple */

    if (isset($_POST['cond'])) {
        $rtwmer_order_table_cond = sanitize_text_field($_POST['cond']);
    }
    if (isset($_POST['rtwmer_date'])) {
        $rtwmer_dates = sanitize_text_field($_POST['rtwmer_date']);
    }
    if (isset($_POST['rtwmer_customer'])) {
        $rtwmer_customer =  sanitize_text_field($_POST['rtwmer_customer']);
    }


    $sql_details = array(
        'user' => DB_USER,
        'pass' => DB_PASSWORD,
        'db'   => DB_NAME,
        'host' => DB_HOST
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

        $rtwmer_posts = $wpdb->prefix . "wc_orders";
        $rtwmer_postmeta = $wpdb->prefix . "wc_orders_meta";


        $join = "FROM ".$table." as m LEFT JOIN(SELECT order_id,
        MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor,
        MAX(CASE WHEN meta_key = 'rtwmer_sub_order' THEN meta_value END) rtwmer_sub_order,
        MAX(CASE WHEN meta_key = '_billing_first_name' THEN meta_value END) rtwmer_billing_first_name,
        MAX(CASE WHEN meta_key = '_billing_address_index' THEN meta_value END) rtwmer_billing_last_name,
        MAX(CASE WHEN meta_key = '_order_total' THEN meta_value END) rtwmer_order_total
        FROM ".$wpdb->prefix."wc_orders_meta GROUP BY order_id) rtwmer_order_table on m.id=rtwmer_order_table.order_id";

        $where = "`type`='shop_order'";
    
        // $where = "`post_type` IN('shop_order_placehold','shop_order')";
    
        $equals = "`status`!='auto-draft'";
    
        // $equals2 = "`post_parent`='0'";
    
        $equals2 = "`parent_order_id`='0'";

        $equals3 = "`rtwmer_order_vendor`='".$rtwmer_author_ID."'";

        $where .= ' AND ' .$equals3;

        if (isset($rtwmer_order_table_cond)) {
            if ($rtwmer_order_table_cond == "complete_table") {
                $equals2 = "`status`='wc-completed'";
                $where .= ' AND ' . $equals2;
            } elseif ($rtwmer_order_table_cond == "processing_table") {
                $equals2 = "`status`='wc-processing'";
                $where .= ' AND ' . $equals2;
            } elseif ($rtwmer_order_table_cond == "On_hold_table") {
                $equals2 = "`status`='wc-on-hold'";
                $where .= ' AND ' . $equals2;
            } elseif ($rtwmer_order_table_cond == "pending_table") {
                $equals2 = "`status`='wc-pending'";
                $where .= ' AND ' . $equals2;
            } elseif ($rtwmer_order_table_cond == "cancel_table") {
                $equals2 = "`status`='wc-cancelled'";
                $where .= ' AND ' . $equals2;
            } elseif ($rtwmer_order_table_cond == "refunded_table") {
                $equals2 = "`status`='wc-refunded'";
                $where .= ' AND ' . $equals2;
            } elseif ($rtwmer_order_table_cond == "failed_table") {
                $equals2 = "`status`='wc-failed'";
                $where .= ' AND ' . $equals2;
            }
        }

        if (isset($rtwmer_dates) && !empty($rtwmer_dates)) {
            $equals2 = "DATE(date_created_gmt) = '" . $rtwmer_dates . "'";
            $where .= ' AND ' . $equals2;
        }
        
        if (isset($rtwmer_customer) && !empty($rtwmer_customer)) {
            $equals2 = "`customer_id`=" . $rtwmer_customer;
            $where .= ' AND ' . $equals2;
        }

        include_once(RTWMER_ADMIN_PARTIAL . '/ssp/ssp.customized.class.php');

        if (!empty($rtwmer_order_table_cond)) {
            $rtwmer_order_all_ssp = SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $join, $where );
           
            $i = 0;
           
            $rtwmer_status_permission = get_option('rtwmer_selling_page');
            if (!empty($rtwmer_status_permission) && is_array($rtwmer_status_permission)) {
                $rtwmer_permission = $rtwmer_status_permission['rtwmer_order_status_change'];
            } else {
                $rtwmer_permission = '';
            }
        
            if (!empty($rtwmer_order_all_ssp['data'])) {
                foreach ($rtwmer_order_all_ssp['data'] as $rtwmer_data) {
                    $rtwmer_check  =  "<div class='mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded'>
                        <input type='checkbox' class='mdc-checkbox__native-control rtwmer_order_bulk_check' data-id='" . $rtwmer_data[0] . "' aria-labelledby='u0'>
                        <div class='mdc-checkbox__background'>
                        <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                            <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                        </svg>
                        <div class='mdc-checkbox__mixedmark'></div>
                        </div>
                        <div class='mdc-checkbox__ripple'></div>
                     </div>";
                    $rtwmer_order  = $rtwmer_data[1];
                    $rtwmer_order_total  =  wc_price($rtwmer_data[4]);

                   
        
                    if ($rtwmer_data[3] == "trash") {
                        $rtwmer_substr = $rtwmer_data[3];
                    } else {
                        $rtwmer_substr = substr($rtwmer_data[3], 3);
                    }
                    if ($rtwmer_substr == "completed") {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_completed'>" . $rtwmer_substr . "</span>";
                    } elseif ($rtwmer_substr == "processing") {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_process'>" . $rtwmer_substr . "</span>";
                    } elseif ($rtwmer_substr == "on-hold") {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_on-hold'>" . $rtwmer_substr . "</span>";
                    } elseif ($rtwmer_substr == "pending") {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_pending'>" . $rtwmer_substr . "</span>";
                    } elseif ($rtwmer_substr == "cancelled") {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_cancelled'>" . $rtwmer_substr . "</span>";
                    } elseif ($rtwmer_substr == "refunded") {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_refunded'>" . $rtwmer_substr . "</span>";
                    } elseif ($rtwmer_substr == "failed") {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_failed'>" . $rtwmer_substr . "</span>";
                    } elseif ($rtwmer_substr == "trash") {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_trash'>" . $rtwmer_substr . "</span>";
                    } else {
                        $rtwmer_order_status  =  "<span class='rtwmer_order_status_notif'>" . $rtwmer_substr . "</span>";
                    }
                   
                    if ($rtwmer_data[4] == "0") {
        
                        $rtwmer_order_customer = esc_html__("guest", "rtwmer-mercado");
                    } else {
        
                        $rtwmer_user_obj  =  wc_get_order($rtwmer_data[0]);
        
                        if (is_object($rtwmer_user_obj)) {
                            $rtwmer_order_customer = $rtwmer_user_obj->get_billing_first_name() . " " . $rtwmer_user_obj->get_billing_last_name();
                        }
                    }
                  
                    $rtwmer_order_date    =    date('d-m-Y', strtotime($rtwmer_data[2]));
                    if ($rtwmer_permission == '1' && $this->rtwmer_user_can_access("rtwmer_manage_orders_cap")) {
                        $rtwmer_order_complete = "<a href='#' data-id='" . $rtwmer_data[0] . "' class='rtwmer_order_complete rtwmer_tooltip'><i class='fa fa-check' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Complete", "rtwmer-mercado") . "</span></i></a>";
                        $rtwmer_order_processing = "<a href='#' data-id='" . $rtwmer_data[0] . "' class='rtwmer_order_processing rtwmer_tooltip'><i class='fas fa-clock'><span class='rtwmer_tooltiptext'>" . esc_html__("processing", "rtwmer-mercado") . "<span></i></a>";
                    } else {
                        $rtwmer_order_complete = '';
                        $rtwmer_order_processing = '';
                    }
                    if($this->rtwmer_user_can_access("rtwmer_view_order_cap")){
                    $rtwmer_order_view = "<a href='#' data-id='" . $rtwmer_data[0] . "' data-toggle='modal' data-target='#exampleModal' class='rtwmer_order_view rtwmer_tooltip'><i class='fas fa-eye'><span class='rtwmer_tooltiptext'>" . esc_html__("View", "rtwmer-mercado") . "</span></i></a>";
                    }else{
                        $rtwmer_order_view = "";
                    }
                    if ($rtwmer_data[3] == "wc-on-hold") {
                        $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_complete . $rtwmer_order_processing . $rtwmer_order_view ;
                    } elseif ($rtwmer_data[3] == "wc-processing") {
                        $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_complete . $rtwmer_order_view ;
                    } else {
                        $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_view ;
                    }
                    $rtwmer_actions_buttons = apply_filters("rtwmer_order_table_action_buttons", $rtwmer_order_action, $rtwmer_data[0]);
                    if(!empty($rtwmer_actions_buttons)){
                        $rtwmer_order_all_ssp['data'][$i][6] = $rtwmer_actions_buttons;
                    }    
                    $rtwmer_order_all_ssp['data'][$i][0] = $rtwmer_check;
                    $rtwmer_order_all_ssp['data'][$i][1] = $rtwmer_order;
                    $rtwmer_order_all_ssp['data'][$i][2] = $rtwmer_order_total;
                    $rtwmer_order_all_ssp['data'][$i][3] = $rtwmer_order_status;
                    $rtwmer_order_all_ssp['data'][$i][4] = $rtwmer_order_customer;
                    $rtwmer_order_all_ssp['data'][$i][5] = $rtwmer_order_date;
                    $i++;
                }
            }
            echo json_encode($rtwmer_order_all_ssp);
        }
    /* testing for ssp::simple end */


    // $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;

    // // echo '<pre>';
    // // print_r($draw);
    // // echo '</pre>';
    // // die('fjfasjdf');

    // if (isset($_POST['cond'])) {
    //     $rtwmer_order_table_cond = sanitize_text_field($_POST['cond']);
    // }
    // if (isset($_POST['rtwmer_date'])) {
    //     $rtwmer_dates = sanitize_text_field($_POST['rtwmer_date']);
    // }
    // if (isset($_POST['rtwmer_customer'])) {
    //     $rtwmer_customer =  sanitize_text_field($_POST['rtwmer_customer']);
    // }

    // $where = "o.type ='shop_order'";
    // $equals = "m.meta_value =" .$rtwmer_author_ID;
    // $where .= ' AND ' . $equals;

    

    // if (isset($rtwmer_order_table_cond)) {
    //     if ($rtwmer_order_table_cond == "complete_table") {
    //         $equals2 = "o.status='wc-completed'";
    //         $where .= ' AND ' . $equals2;
    //     } elseif ($rtwmer_order_table_cond == "processing_table") {
    //         $equals2 = "o.status='wc-processing'";
    //         $where .= ' AND ' . $equals2;
    //     } elseif ($rtwmer_order_table_cond == "On_hold_table") {
    //         $equals2 = "o.status='wc-on-hold'";
    //         $where .= ' AND ' . $equals2;
    //     } elseif ($rtwmer_order_table_cond == "pending_table") {
    //         $equals2 = "o.status='wc-pending'";
    //         $where .= ' AND ' . $equals2;
    //     } elseif ($rtwmer_order_table_cond == "cancel_table") {
    //         $equals2 = "o.status='wc-cancelled'";
    //         $where .= ' AND ' . $equals2;
    //     } elseif ($rtwmer_order_table_cond == "refunded_table") {
    //         $equals2 = "o.status='wc-refunded'";
    //         $where .= ' AND ' . $equals2;
    //     } elseif ($rtwmer_order_table_cond == "failed_table") {
    //         $equals2 = "o.status='wc-failed'";
    //         $where .= ' AND ' . $equals2;
    //     }
    // }


    // if (isset($rtwmer_dates) && !empty($rtwmer_dates)) {
    //     $equals2 = "DATE(date_created_gmt) = '" . $rtwmer_dates . "'";
    //     $where .= ' AND ' . $equals2;
    // }

    // if (isset($rtwmer_customer) && !empty($rtwmer_customer)) {
    //     $equals2 = "`_customer_user`=" . $rtwmer_customer;
    //     $where .= ' AND ' . $equals2;
    // }

    // $sql_details = array(
    //     'user' => DB_USER,
    //     'pass' => DB_PASSWORD,
    //     'db'   => DB_NAME,
    //     'host' => DB_HOST
    // );
    // $conn = new mysqli($sql_details['host'],$sql_details['user'],$sql_details['pass'],$sql_details['db']);


    // $order = 'wp_wc_orders';
    // $meta = 'wp_wc_orders_meta';
    // $order_id = 'wp_wc_orders.id';
    // $meta_id = 'wp_wc_orders_meta.order_id';

    // $select = "SELECT o.id , o.status, o.currency, o.customer_id ,m.meta_value ,o.total_amount,o.date_created_gmt, m.meta_key FROM `wp_wc_orders` o JOIN `wp_wc_orders_meta` m ON o.id = m.order_id  WHERE $where " ;

    // $result = $conn->query($select);
        
    //     $rtwmer_order_all_ssp['draw'] = $draw;
    //     $rtwmer_order_all_ssp['recordsTotal'] = $result->num_rows;
    //     $rtwmer_order_all_ssp['recordsFiltered'] = $result->num_rows;
        
        
        
    //     if($result->num_rows > 0 ){
           
    //         while($row = $result->fetch_assoc()){

    //             $temp[0] = $row['id'];
    //             $temp[1] = $row['id'];
    //             $temp[2] = $row['total_amount'];
    //             $temp[3] = $row['status'];
    //             $temp[4] = $row['customer_id'];
    //             $temp[5] = $row['date_created_gmt'];
    //             $temp[6] = $row['id'];
                
    //             $rtwmer_order_all_ssp['data'][] = $temp;

    //         }
    //     }else{
    //         $rtwmer_order_all_ssp['data'] = array();
    //     }
    //     if (!empty($rtwmer_order_table_cond)) {
    //             if(OrderUtil::custom_orders_table_usage_is_enabled()){
    //             // if(WC()->version > '8.2.0'){
    //                 // $rtwmer_order_all_ssp   =    SSP::simple($_POST, $sql_details, $rtwmer_table, $rtwmer_primaryKey, $columns, $join, $where);
   
    //             }else{
    //                 $rtwmer_order_all_ssp   =    SSP::simple($_POST, $sql_details, $rtwmer_table, $rtwmer_primaryKey, $columns, $join, $where);

    //             }
    //             // echo '<pre>';
    //             // print_r($rtwmer_order_all_ssp);
    //             // echo '</pre>';
    //             // die('fjj');
                           
    //             $i = 0;
            
    //         $rtwmer_status_permission = get_option('rtwmer_selling_page');
    //         if (!empty($rtwmer_status_permission) && is_array($rtwmer_status_permission)) {
    //             $rtwmer_permission = $rtwmer_status_permission['rtwmer_order_status_change'];
    //         } else {
    //             $rtwmer_permission = '';
    //         }
            
    //         // echo '<pre>';
    //         // print_r($rtwmer_order_all_ssp['data']);
    //         // echo '</pre>';
    //         // die('jasdjfd');
    //         if (!empty($rtwmer_order_all_ssp['data'])) {
                
    //             foreach ($rtwmer_order_all_ssp['data'] as $rtwmer_data) {
                    
    //                 $rtwmer_check  =  "<div class='mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded'>
    //                     <input type='checkbox' class='mdc-checkbox__native-control rtwmer_order_bulk_check' data-id='" . $rtwmer_data[0] . "' aria-labelledby='u0'>
    //                     <div class='mdc-checkbox__background'>
    //                     <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
    //                         <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
    //                     </svg>
    //                     <div class='mdc-checkbox__mixedmark'></div>
    //                     </div>
    //                     <div class='mdc-checkbox__ripple'></div>
    //                     </div>";
    //                 $rtwmer_order  = $rtwmer_data[1];
    //                 $rtwmer_order_total  =  wc_price($rtwmer_data[2]);
                    

    //                 if ($rtwmer_data[3] == "trash") {
    //                     $rtwmer_substr = $rtwmer_data[3];
    //                 } else {
    //                     $rtwmer_substr = substr($rtwmer_data[3], 3);
    //                 }

                    
    //                 if ($rtwmer_substr == "completed") {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_completed'>" . $rtwmer_substr . "</span>";
    //                 } elseif ($rtwmer_substr == "processing") {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_process'>" . $rtwmer_substr . "</span>";
    //                 } elseif ($rtwmer_substr == "on-hold") {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_on-hold'>" . $rtwmer_substr . "</span>";
    //                 } elseif ($rtwmer_substr == "pending") {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_pending'>" . $rtwmer_substr . "</span>";
    //                 } elseif ($rtwmer_substr == "cancelled") {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_cancelled'>" . $rtwmer_substr . "</span>";
    //                 } elseif ($rtwmer_substr == "refunded") {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_refunded'>" . $rtwmer_substr . "</span>";
    //                 } elseif ($rtwmer_substr == "failed") {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_failed'>" . $rtwmer_substr . "</span>";
    //                 } elseif ($rtwmer_substr == "trash") {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_trash'>" . $rtwmer_substr . "</span>";
    //                 } else {
    //                     $rtwmer_order_status  =  "<span class='rtwmer_order_status_notif'>" . $rtwmer_substr . "</span>";
    //                 }

    //                 if ($rtwmer_data[4] == "0") {
    //                     $rtwmer_order_customer = esc_html__("guest", "rtwmer-mercado");
    //                 } else {
    //                     $rtwmer_user_first = get_user_meta($rtwmer_data[4],'billing_first_name');
    //                     $rtwmer_user_last = get_user_meta($rtwmer_data[4],'billing_last_name');
    //                     $rtwmer_order_customer = $rtwmer_user_first[0]. " " .$rtwmer_user_last[0];
                        
    //                 }
                    
    //                 $rtwmer_order_date    =    date('d-m-Y', strtotime($rtwmer_data[5]));
    //                 if ($rtwmer_permission == '1' && $this->rtwmer_user_can_access("rtwmer_manage_orders_cap")) {
    //                     $rtwmer_order_complete = "<a href='#' data-id='" . $rtwmer_data[0] . "' class='rtwmer_order_complete rtwmer_tooltip'><i class='fa fa-check' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Complete", "rtwmer-mercado") . "</span></i></a>";
    //                     $rtwmer_order_processing = "<a href='#' data-id='" . $rtwmer_data[0] . "' class='rtwmer_order_processing rtwmer_tooltip'><i class='fas fa-clock'><span class='rtwmer_tooltiptext'>" . esc_html__("processing", "rtwmer-mercado") . "<span></i></a>";
    //                 } else {
    //                     $rtwmer_order_complete = '';
    //                     $rtwmer_order_processing = '';
    //                 }
    //                 if($this->rtwmer_user_can_access("rtwmer_view_order_cap")){
    //                 $rtwmer_order_view = "<a href='#' data-id='" . $rtwmer_data[0] . "' data-toggle='modal' data-target='#exampleModal' class='rtwmer_order_view rtwmer_tooltip'><i class='fas fa-eye'><span class='rtwmer_tooltiptext'>" . esc_html__("View", "rtwmer-mercado") . "</span></i></a>";
    //                 }else{
    //                     $rtwmer_order_view = "";
    //                 }
    //                 if ($rtwmer_data[3] == "wc-on-hold") {
    //                     $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_complete . $rtwmer_order_processing . $rtwmer_order_view ;
    //                 } elseif ($rtwmer_data[3] == "wc-processing") {
    //                     $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_complete . $rtwmer_order_view ;
    //                 } else {
    //                     $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_view ;
    //                 }
    //                 $rtwmer_actions_buttons = apply_filters("rtwmer_order_table_action_buttons", $rtwmer_order_action, $rtwmer_data[0]);
    //                 if(!empty($rtwmer_actions_buttons)){
    //                     $rtwmer_order_all_ssp['data'][$i][6] = $rtwmer_actions_buttons;
    //                 }
                        
    //                 $rtwmer_order_all_ssp['data'][$i][0] = $rtwmer_check;
    //                 $rtwmer_order_all_ssp['data'][$i][1] = $rtwmer_order;
    //                 $rtwmer_order_all_ssp['data'][$i][2] = $rtwmer_order_total;
    //                 $rtwmer_order_all_ssp['data'][$i][3] = $rtwmer_order_status;
    //                 $rtwmer_order_all_ssp['data'][$i][4] = $rtwmer_order_customer;
    //                 $rtwmer_order_all_ssp['data'][$i][5] = $rtwmer_order_date;
    //                 $i++;
    //             }
    //         }
    //     //     echo '<pre>';
    //     // print_r($rtwmer_order_all_ssp);
    //     // echo '</pre>';
    //     // die('sdfjdsjdf');   

    //         echo json_encode($rtwmer_order_all_ssp);
    //     }


     }
else{
//   die('ffjjf');
    global $wpdb;
    global $rtwmer_user_id_for_dashboard;
    $rtwmer_table = $wpdb->prefix . 'posts';
    $rtwmer_primaryKey = 'ID';
    if (isset($_POST['cond'])) {
        $rtwmer_order_table_cond = sanitize_text_field($_POST['cond']);
    }
    if (isset($_POST['rtwmer_date'])) {
        $rtwmer_dates = sanitize_text_field($_POST['rtwmer_date']);
    }
    if (isset($_POST['rtwmer_customer'])) {
        $rtwmer_customer =  sanitize_text_field($_POST['rtwmer_customer']);
    }
    $rtwmer_author_ID =  $rtwmer_user_id_for_dashboard;
    $columns = array(
        array('db' => 'ID', 'dt' => 0, 'field' => 'ID'),
        array('db' => 'ID', 'dt' => 1, 'field' => 'ID'),
        array('db' => '_order_total',   'dt' => 2, 'field' => '_order_total'),
        array('db' => 'post_status',   'dt' => 3, 'field' => 'post_status'),
        array('db' => '_customer_user',     'dt' => 4, 'field' => '_customer_user'),
        array('db' => 'post_date',     'dt' => 5, 'field' => 'post_date'),
        array('db' => 'ID',     'dt' => 6, 'field' => 'ID'),
    );
    $sql_details = array(
        'user' => DB_USER,
        'pass' => DB_PASSWORD,
        'db'   => DB_NAME,
        'host' => DB_HOST
    );

    $where = "`post_type`='shop_order'";
    $equals = "`rtwmer_order_vendor`=" . $rtwmer_author_ID;
    $where .= ' AND ' . $equals;
    if (isset($rtwmer_order_table_cond)) {
        if ($rtwmer_order_table_cond == "complete_table") {
            $equals2 = "`post_status`='wc-completed'";
            $where .= ' AND ' . $equals2;
        } elseif ($rtwmer_order_table_cond == "processing_table") {
            $equals2 = "`post_status`='wc-processing'";
            $where .= ' AND ' . $equals2;
        } elseif ($rtwmer_order_table_cond == "On_hold_table") {
            $equals2 = "`post_status`='wc-on-hold'";
            $where .= ' AND ' . $equals2;
        } elseif ($rtwmer_order_table_cond == "pending_table") {
            $equals2 = "`post_status`='wc-pending'";
            $where .= ' AND ' . $equals2;
        } elseif ($rtwmer_order_table_cond == "cancel_table") {
            $equals2 = "`post_status`='wc-cancelled'";
            $where .= ' AND ' . $equals2;
        } elseif ($rtwmer_order_table_cond == "refunded_table") {
            $equals2 = "`post_status`='wc-refunded'";
            $where .= ' AND ' . $equals2;
        } elseif ($rtwmer_order_table_cond == "failed_table") {
            $equals2 = "`post_status`='wc-failed'";
            $where .= ' AND ' . $equals2;
        }
    }

    if (isset($rtwmer_dates) && !empty($rtwmer_dates)) {
        $equals2 = "DATE(post_date) = '" . $rtwmer_dates . "'";
        $where .= ' AND ' . $equals2;
    }

    if (isset($rtwmer_customer) && !empty($rtwmer_customer)) {
        $equals2 = "`_customer_user`=" . $rtwmer_customer;
        $where .= ' AND ' . $equals2;
    }

    $rtwmer_posts = $wpdb->prefix . "posts";
    $rtwmer_postmeta = $wpdb->prefix . "postmeta";
    $join = "FROM `$rtwmer_posts` LEFT JOIN (SELECT post_id, 
    MAX(CASE WHEN meta_key = '_customer_user' THEN meta_value END) _customer_user,
    MAX(CASE WHEN meta_key = '_order_total' THEN meta_value END) _order_total,
    MAX(CASE WHEN meta_key = 'rtwmer_order_vendor' THEN meta_value END) rtwmer_order_vendor
    FROM `$rtwmer_postmeta`
    GROUP BY `post_id`) rtwprod ON " . $rtwmer_posts . ".ID = rtwprod.post_id";

    include_once(RTWMER_ADMIN_PARTIAL . '/ssp/ssp.customized.class.php');

    if (!empty($rtwmer_order_table_cond)) {
            if(OrderUtil::custom_orders_table_usage_is_enabled()){
            // if(WC()->version > '8.2.0'){
                
            }else{
                $rtwmer_order_all_ssp   =    SSP::simple($_POST, $sql_details, $rtwmer_table, $rtwmer_primaryKey, $columns, $join, $where);

            }

        $i = 0;
      

        $rtwmer_status_permission = get_option('rtwmer_selling_page');
        if (!empty($rtwmer_status_permission) && is_array($rtwmer_status_permission)) {
            $rtwmer_permission = $rtwmer_status_permission['rtwmer_order_status_change'];
        } else {
            $rtwmer_permission = '';
        }
 
    
        if (!empty($rtwmer_order_all_ssp['data'])) {
        
            foreach ($rtwmer_order_all_ssp['data'] as $rtwmer_data) {
                
                $rtwmer_check  =  "<div class='mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded'>
                    <input type='checkbox' class='mdc-checkbox__native-control rtwmer_order_bulk_check' data-id='" . $rtwmer_data[0] . "' aria-labelledby='u0'>
                    <div class='mdc-checkbox__background'>
                    <svg class='mdc-checkbox__checkmark' viewBox='0 0 24 24'>
                        <path class='mdc-checkbox__checkmark-path' fill='none' d='M1.73,12.91 8.1,19.28 22.79,4.59'></path>
                    </svg>
                    <div class='mdc-checkbox__mixedmark'></div>
                    </div>
                    <div class='mdc-checkbox__ripple'></div>
                </div>";
                $rtwmer_order  = $rtwmer_data[1];
                $rtwmer_order_total  =  wc_price($rtwmer_data[2]);
                

                if ($rtwmer_data[3] == "trash") {
                    $rtwmer_substr = $rtwmer_data[3];
                } else {
                    $rtwmer_substr = substr($rtwmer_data[3], 3);
                }

            
                if ($rtwmer_substr == "completed") {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_completed'>" . $rtwmer_substr . "</span>";
                } elseif ($rtwmer_substr == "processing") {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_process'>" . $rtwmer_substr . "</span>";
                } elseif ($rtwmer_substr == "on-hold") {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_on-hold'>" . $rtwmer_substr . "</span>";
                } elseif ($rtwmer_substr == "pending") {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_pending'>" . $rtwmer_substr . "</span>";
                } elseif ($rtwmer_substr == "cancelled") {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_cancelled'>" . $rtwmer_substr . "</span>";
                } elseif ($rtwmer_substr == "refunded") {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_refunded'>" . $rtwmer_substr . "</span>";
                } elseif ($rtwmer_substr == "failed") {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_failed'>" . $rtwmer_substr . "</span>";
                } elseif ($rtwmer_substr == "trash") {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_trash'>" . $rtwmer_substr . "</span>";
                } else {
                    $rtwmer_order_status  =  "<span class='rtwmer_order_status_notif'>" . $rtwmer_substr . "</span>";
                }

                if ($rtwmer_data[4] == "0") {
                    $rtwmer_order_customer = esc_html__("guest", "rtwmer-mercado");
                } else {
                    $rtwmer_user_first = get_user_meta($rtwmer_data[4],'billing_first_name');
                    $rtwmer_user_last = get_user_meta($rtwmer_data[4],'billing_last_name');
                    $rtwmer_order_customer = $rtwmer_user_first[0]. " " .$rtwmer_user_last[0];
                }
            
                $rtwmer_order_date    =    date('d-m-Y', strtotime($rtwmer_data[5]));
                if ($rtwmer_permission == '1' && $this->rtwmer_user_can_access("rtwmer_manage_orders_cap")) {
                    $rtwmer_order_complete = "<a href='#' data-id='" . $rtwmer_data[0] . "' class='rtwmer_order_complete rtwmer_tooltip'><i class='fa fa-check' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Complete", "rtwmer-mercado") . "</span></i></a>";
                    $rtwmer_order_processing = "<a href='#' data-id='" . $rtwmer_data[0] . "' class='rtwmer_order_processing rtwmer_tooltip'><i class='fas fa-clock'><span class='rtwmer_tooltiptext'>" . esc_html__("processing", "rtwmer-mercado") . "<span></i></a>";
                } else {
                    $rtwmer_order_complete = '';
                    $rtwmer_order_processing = '';
                }
                if($this->rtwmer_user_can_access("rtwmer_view_order_cap")){
                $rtwmer_order_view = "<a href='#' data-id='" . $rtwmer_data[0] . "' data-toggle='modal' data-target='#exampleModal' class='rtwmer_order_view rtwmer_tooltip'><i class='fas fa-eye'><span class='rtwmer_tooltiptext'>" . esc_html__("View", "rtwmer-mercado") . "</span></i></a>";
                }else{
                    $rtwmer_order_view = "";
                }
                if ($rtwmer_data[3] == "wc-on-hold") {
                    $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_complete . $rtwmer_order_processing . $rtwmer_order_view ;
                } elseif ($rtwmer_data[3] == "wc-processing") {
                    $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_complete . $rtwmer_order_view ;
                } else {
                    $rtwmer_order_action = "<div class='rtwmer_order_action_buttons'>" . $rtwmer_order_view ;
                }
                $rtwmer_actions_buttons = apply_filters("rtwmer_order_table_action_buttons", $rtwmer_order_action, $rtwmer_data[0]);
                if(!empty($rtwmer_actions_buttons)){
                    $rtwmer_order_all_ssp['data'][$i][6] = $rtwmer_actions_buttons;
                }
                
                $rtwmer_order_all_ssp['data'][$i][0] = $rtwmer_check;
                $rtwmer_order_all_ssp['data'][$i][1] = $rtwmer_order;
                $rtwmer_order_all_ssp['data'][$i][2] = $rtwmer_order_total;
                $rtwmer_order_all_ssp['data'][$i][3] = $rtwmer_order_status;
                $rtwmer_order_all_ssp['data'][$i][4] = $rtwmer_order_customer;
                $rtwmer_order_all_ssp['data'][$i][5] = $rtwmer_order_date;
                $i++;
            }
        }
        echo json_encode($rtwmer_order_all_ssp);
        
    }


}