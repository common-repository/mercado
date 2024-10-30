<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//==================This File is about to manage withdraw requests of vendors at admin panel=====================//

    if( isset($_POST['rtwmer_withdraw_status']) && !empty($_POST['rtwmer_withdraw_status']) )
    {
        $rtwmer_withdraw_status = sanitize_text_field($_POST['rtwmer_withdraw_status']);
        
        if( isset($rtwmer_withdraw_status) && !empty($rtwmer_withdraw_status) )
        {
            update_option('rtwmer_withdraw_status',$rtwmer_withdraw_status);

            global $wpdb;

            $table = $wpdb->prefix.'rtwmer_withdraw';

            $primaryKey = 'id';

            $columns = array(
                array( 'db' => 'id',  'dt' => 0 , 'field' => 'id' ),
                array( 'db' => 'rtwmer_vendor_store', 'dt' => 1 , 'field' => 'rtwmer_vendor_store' ),
                array( 'db' => 'amount', 'dt' => 2 , 'field' => 'amount' ),
                array( 'db' => 'status',  'dt' => 3 , 'field' => 'status' ),
                array( 'db' => 'method',  'dt' => 4 , 'field' => 'method' ),
                array( 'db' => 'rtwmer_vendor_email',  'dt' => 5 , 'field' => 'rtwmer_vendor_email' ),
                array( 'db' => 'note',  'dt' => 6 , 'field' => 'note' ),
                array( 'db' => 'date',  'dt' => 7 , 'field' => 'date' ),
                array( 'db' => 'user_id',  'dt' => 8 , 'field' => 'user_id' ),
            ); 

            $sql_details = array(
                'user' => DB_USER,
                'pass' => DB_PASSWORD,
                'db'   => DB_NAME,
                'host' => DB_HOST
            );
            
            $where = "`status`= '".$rtwmer_withdraw_status."'";
            
            include_once( RTWMER_ADMIN_PARTIAL.'/ssp/ssp.customized.class.php' );

            $rtwmer_withdraw_data_ssp =  SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns,'', $where );

            if( isset($rtwmer_withdraw_data_ssp) && !empty($rtwmer_withdraw_data_ssp) )
            {
                if( isset($rtwmer_withdraw_data_ssp['data']) && is_array($rtwmer_withdraw_data_ssp['data']) && !empty($rtwmer_withdraw_data_ssp['data']) )
                {
                    $i = 0;
                    {
                        if( isset($rtwmer_withdraw_data_ssp['data'][$i]) )
                        {
                            foreach( $rtwmer_withdraw_data_ssp['data'] as $rtwmer_withdraw )
                            {
                                $rtwmer_action_array = array();
                                if( isset($rtwmer_withdraw) && !empty($rtwmer_withdraw) )
                                {
                                    if( isset($rtwmer_withdraw[8]) && !empty($rtwmer_withdraw[8]) )
                                    {
                                        $rtwmer_withdraw_user_id = $rtwmer_withdraw[8];
                                    }
                                    if( isset($rtwmer_withdraw[0]) && !empty($rtwmer_withdraw[0]) )
                                    {
                                        $rtwmer_withdraw_id = $rtwmer_withdraw[0];
                                        if( isset($rtwmer_withdraw_id) )
                                        {
                                            $rtwmer_withdraw_data_ssp['data'][$i][0] = '<td class="mdc-data-table__cell mdc-data-table__cell--checkbox">
                                            <div class="mdc-checkbox mdc-data-table__row-checkbox">
                                                <input type="checkbox" class="mdc-checkbox__native-control rtwmer_withdraw_inner_checkbox" aria-labelledby="u0" data-id="'.$rtwmer_withdraw_id.'">
                                                <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                                </div>
                                            </div>
                                        </td>';
                                        }
                                    }
                                    if( isset($rtwmer_withdraw[1]) && !empty($rtwmer_withdraw[1]) )
                                    {
                                        $rtwmer_vendor_withdraw_img = get_user_meta($rtwmer_withdraw_user_id);
                                        if( isset($rtwmer_vendor_withdraw_img) && !empty($rtwmer_vendor_withdraw_img) && isset($rtwmer_vendor_withdraw_img['rtwmer_vendor_store_img']) )
                                        {
                                            $rtwmer_vendor_withdraw_img_id = $rtwmer_vendor_withdraw_img['rtwmer_vendor_store_img'][0];
                                        }
                                        if( isset($rtwmer_vendor_withdraw_img_id) && !empty($rtwmer_vendor_withdraw_img_id) )
                                        {
                                            $rtwmer_withdraw_vendor_img = wp_get_attachment_url($rtwmer_vendor_withdraw_img_id);
                                        }
                                        else{
                                            if(isset($rtwmer_withdraw_id))
                                            {
                                                $rtwmer_withdraw_vendor_img = get_avatar_url($rtwmer_withdraw_id);
                                            }
                                        }
                                        if( isset($rtwmer_withdraw[3]) && !empty($rtwmer_withdraw[3]) )
                                        {
                                            if( isset($rtwmer_withdraw_id) && $rtwmer_withdraw[3] == 'pending' )
                                            {
                                                $rtwmer_withdraw_data_ssp['data'][$i][1] = '<div class="rtwmer_withdraw_all">
                                                        <img class="rtwmer_withdraw_vend_img" src='.esc_attr($rtwmer_withdraw_vendor_img).'>
                                                        <div class="rtwmer-withdraw_content">
                                                            <div class="rtwmer_withdraw_vend_name">
                                                                <a href="#withdraw">'.esc_html__($rtwmer_withdraw[1],'rtwmer-mercado').'</a>	
                                                            </div>
                                                            <div class="rtwmer-withdraw_content2">
                                                                <a href="#withdraw" data-id="'.$rtwmer_withdraw_id.'" class="rtwmer_withdraw_delete rtwmer_withdraw_status_chng" data-value="delete">'.esc_html__('Delete','rtwmer-mercado').'</a>
                                                                <a href="#withdraw" data-id="'.$rtwmer_withdraw_id.'" class="rtwmer_withdraw_status_chng" data-value="cancelled">'.esc_html__('Cancel','rtwmer-mercado').'</a>
                                                            </div>
                                                        </div>
                                                </div>';
                                            }
                                            if( isset($rtwmer_withdraw_id) && $rtwmer_withdraw[3] == 'approved' )
                                            {
                                                $rtwmer_withdraw_data_ssp['data'][$i][1] = '<div class="rtwmer_withdraw_all">
                                                        <img class="rtwmer_withdraw_vend_img" src='.esc_attr($rtwmer_withdraw_vendor_img).'>
                                                        <div class="rtwmer-withdraw_content">
                                                            <div class="rtwmer_withdraw_vend_name">
                                                                <a href="#withdraw">'.esc_html__($rtwmer_withdraw[1],'rtwmer-mercado').'</a>	
                                                            </div>
                                                        </div>
                                                </div>';
                                            }
                                            if( isset($rtwmer_withdraw_id) && $rtwmer_withdraw[3] == 'cancelled' )
                                            {
                                                $rtwmer_withdraw_data_ssp['data'][$i][1] = '<div class="rtwmer_withdraw_all">
                                                        <img class="rtwmer_withdraw_vend_img" src='.esc_attr($rtwmer_withdraw_vendor_img).'>
                                                        <div class="rtwmer-withdraw_content">
                                                            <div class="rtwmer_withdraw_vend_name">
                                                                <a href="#withdraw">'.esc_html__($rtwmer_withdraw[1],'rtwmer-mercado').'</a>	
                                                            </div>
                                                            <div class="rtwmer-withdraw_content2">
                                                                <a href="#withdraw" data-id="'.$rtwmer_withdraw_id.'" class="rtwmer_withdraw_delete rtwmer_withdraw_status_chng" data-value="delete">'.esc_html__('Delete','rtwmer-mercado').'</a>
                                                                <a href="#withdraw" data-id="'.$rtwmer_withdraw_id.'" class="rtwmer_withdraw_status_chng" data-value="pending">'.esc_html__('Pending','rtwmer-mercado').'</a>
                                                            </div>
                                                        </div>
                                                </div>';
                                            }
                                        }
                                    }
                                    if( isset($rtwmer_withdraw[2]) && !empty($rtwmer_withdraw[1]) )
                                    {
                                        $rtwmer_withdraw_data_ssp['data'][$i][2] = wc_price($rtwmer_withdraw[2]);
                                    }
                                    if( isset($rtwmer_withdraw[3]) && !empty($rtwmer_withdraw[3]) )
                                    {
                                        $rtwmer_withdraw_data_ssp['data'][$i][3] = esc_html__(ucwords($rtwmer_withdraw[3]),'rtwmer-mercado');
                                    }
                                    if( isset($rtwmer_withdraw[4]) && !empty($rtwmer_withdraw[4]) )
                                    {
                                        $rtwmer_withdraw_data_ssp['data'][$i][4] = esc_html__(ucwords(str_replace('_',' ',$rtwmer_withdraw[4])),'rtwmer-mercado');
                                    }
                                    if( isset($rtwmer_withdraw[5]) && !empty($rtwmer_withdraw[5]) )
                                    {
                                        $rtwmer_withdraw_data_ssp['data'][$i][5] = esc_html__(ucwords($rtwmer_withdraw[5]),'rtwmer-mercado');
                                    }
                                    if( isset($rtwmer_withdraw[6]) && !empty($rtwmer_withdraw[6]) )
                                    {
                                        $rtwmer_withdraw_data_ssp['data'][$i][6] = esc_html__(ucwords($rtwmer_withdraw[6]),'rtwmer-mercado');
                                    }
                                    if( isset($rtwmer_withdraw[7]) && !empty($rtwmer_withdraw[7]) )
                                    {
                                        $rtwmer_withdraw_data_ssp['data'][$i][7] = date( "j/m/Y", strtotime($rtwmer_withdraw[7]));
                                    }
                                    if( isset($rtwmer_withdraw[8]) && !empty($rtwmer_withdraw[8]) )
                                    {
                                        if( isset($rtwmer_withdraw[3]) && !empty($rtwmer_withdraw[3]) )
                                        {
                                            $rtwmer_action_array[] = '<div class="rtwmer-button-group">';
                                            if( $rtwmer_withdraw[3] == 'pending' )
                                            {
                                            $rtwmer_action_array[] = '<button title="'.esc_attr__('Approve Request','rtwmer-mercado').'" class="mdc-button rtwmer_withdraw_status_chng" data-id="'.$rtwmer_withdraw_id.'" data-value="approved">
                                                <span class="material-icons">done</span>
                                                <div class="mdc-button__ripple"></div>
                                            </button>';
                                            $rtwmer_action_array[] = '<button title="'.esc_attr__('Add Note','rtwmer-mercado').'" class="mdc-button  rtwmer_withdraw_add_note" data-target = #rtwmer_withdraw_add_note data-toggle = modal data-id="'.$rtwmer_withdraw_id.'">
                                            <span class="material-icons">note_add</span>
                                            <div class="mdc-button__ripple"></div>
                                        </button>';
                                            }
                                            if( $rtwmer_withdraw[3] == 'approved' )
                                            {
                                                $rtwmer_action_array[] = '<button title="'.esc_attr__('Add Note','rtwmer-mercado').'" class="mdc-button  rtwmer_withdraw_add_note" data-target = #rtwmer_withdraw_add_note data-toggle = modal data-id="'.$rtwmer_withdraw_id.'">
                                                <span class="material-icons">note_add</span>
                                                <div class="mdc-button__ripple"></div>
                                                </button>';
                                            }
                                            if( $rtwmer_withdraw[3] == 'cancelled' )
                                            {
                                                $rtwmer_action_array[] = '<button title="'.esc_attr__('Mark as Pending','rtwmer-mercado').'" class="mdc-button rtwmer_withdraw_status_chng" data-id="'.$rtwmer_withdraw_id.'" data-value="pending">
                                                <span class="material-icons">restore</span>
                                                <div class="mdc-button__ripple"></div>
                                                </button> ';
                                                $rtwmer_action_array[] = '<button title="'.esc_attr__('Add Note','rtwmer-mercado').'" class="mdc-button 
                                                 rtwmer_withdraw_add_note" data-target = #rtwmer_withdraw_add_note data-toggle = modal data-id="'.$rtwmer_withdraw_id.'">
                                                 <span class="material-icons">note_add</span>
                                                 <div class="mdc-button__ripple"></div>
                                                 </button>';
                                            }
                                            $rtwmer_action_array[] = '</div>';
                                            $rtwmer_action_array = apply_filters("rtwmer_wthdraw_action_buttons",$rtwmer_action_array,$rtwmer_withdraw_id,$rtwmer_withdraw);
                                            $rtwmer_withdraw_data_ssp['data'][$i][8] = implode("",$rtwmer_action_array);
                                        }
                                    }
                                }
                                $i++;


                            }
                        }
                    }
                }
            }
            echo json_encode($rtwmer_withdraw_data_ssp);

            do_action('rtwmer_mercado_launching_withdraw_table');

            wp_die();
        }
    }
?>