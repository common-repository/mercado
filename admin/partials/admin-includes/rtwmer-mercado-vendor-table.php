<?php

//========================This File is used to Display vendors list===============//
	
	if( isset($_POST['rtwmer_sort_by_vend_status']) && !empty($_POST['rtwmer_sort_by_vend_status']) )
	{
		update_option('rtwmer_sort_by_vend_status',sanitize_text_field($_POST['rtwmer_sort_by_vend_status']));
	}
	
	global $wpdb;
	$table = $wpdb->prefix.'users';
	
	$primaryKey = 'ID';

	$columns = array(
		array( 'db' => 'ID', 'dt' => 0 , 'field' => 'ID' ),
		array( 'db' => 'rtwmer_store_name', 'dt' => 1 , 'field' => 'rtwmer_store_name' ),
		array( 'db' => 'user_email',  'dt' => 2 , 'field' => 'user_email' ),
		array( 'db' => 'rtwmer_phone',  'dt' => 3 , 'field' => 'rtwmer_phone' ),
		array( 'db' => 'user_registered',  'dt' => 4 , 'field' => 'user_registered' ),
		array( 'db' => 'rtwmer_vendor_status',  'dt' => 5 , 'field' => 'rtwmer_vendor_status' ),
		array( 'db' => 'ID',  'dt' => 6 , 'field' => 'ID' ),
	); 

	$sql_details = array(
		'user' => DB_USER,
		'pass' => DB_PASSWORD,
		'db'   => DB_NAME,
		'host' => DB_HOST
	);

	$where = "`rtwmer_role`='rtwmer_vendor'";

	if( isset($_POST['rtwmer_sort_by_vend_status']) )
	{
		$rtmwer_vend_sort = sanitize_text_field($_POST['rtwmer_sort_by_vend_status']);
		if( isset($rtmwer_vend_sort) )
		{
			if( $rtmwer_vend_sort == "disable" )
			{
				$where = "`rtwmer_role`='rtwmer_vendor'";

				$equals = "`rtwmer_vendor_status`='0'";

				$where = $equals. ' AND ' .$where;
			}
			if( $rtmwer_vend_sort == 'approve' )
			{
				$where = "`rtwmer_role`='rtwmer_vendor'";

				$equals = "`rtwmer_vendor_status`='1'";

				$where = $equals. ' AND ' .$where;
			}
		}
	}

	$join = "FROM ".$wpdb->prefix."users"." LEFT JOIN (SELECT user_id,
	MAX(CASE WHEN meta_key = 'rtwmer_store_name' THEN meta_value END) rtwmer_store_name,
	MAX(CASE WHEN meta_key = 'rtwmer_phone' THEN meta_value END) rtwmer_phone,
	MAX(CASE WHEN meta_key = 'rtwmer_vendor_status' THEN meta_value END) rtwmer_vendor_status,
	MAX(CASE WHEN meta_key = 'rtwmer_role' THEN meta_value END) rtwmer_role,
	MAX(CASE WHEN meta_key = 'rtwmer_vendor_product_upload' THEN meta_value END) rtwmer_vendor_product_upload
	FROM ".$wpdb->prefix."usermeta"." GROUP BY user_id) rtw_selected_table ON ".$wpdb->prefix."users".".`ID`=rtw_selected_table.`user_id`";
	
	include_once( RTWMER_ADMIN_PARTIAL.'/ssp/ssp.customized.class.php' );

	$rtwmer_vendors_data_ssp =  SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $join, $where );
	

	$i=0;


	if( isset($rtwmer_vendors_data_ssp) )
	{
		
		if( is_array($rtwmer_vendors_data_ssp['data']) && !empty($rtwmer_vendors_data_ssp['data']) && isset($rtwmer_vendors_data_ssp['data'][$i]) )
		{
			foreach( $rtwmer_vendors_data_ssp['data'] as $rtwmer_vendors_data )
			{		
				if( isset($rtwmer_vendors_data[4]) )
				{
					
					$rtwmer_vendor_reg_date = $rtwmer_vendors_data[4];
					if( isset($rtwmer_vendor_reg_date) )	
					{
						$rtwmer_vendor_reg_date = date( "j/ m/ Y", strtotime( $rtwmer_vendor_reg_date ) );

						if( isset($rtwmer_vendors_data_ssp['data'][$i][4]) )
						{
							$rtwmer_vendors_data_ssp['data'][$i][4] = $rtwmer_vendor_reg_date;

							if( isset($rtwmer_vendors_data[5]) )
							{
								$rtwmer_vendor_status = $rtwmer_vendors_data[5];

								if( isset($rtwmer_vendors_data_ssp['data'][$i][5]) && isset($rtwmer_vendors_data[6]) )
								{	
									if( $rtwmer_vendors_data_ssp['data'][$i][5] == 1 )
									{
										$rtwmer_vendors_data_ssp['data'][$i][5] = "<label class='rtwmer_switch'>
										<input type='checkbox' class='rtwmer_vendors_status rtwmer_vendors_status".esc_attr($rtwmer_vendors_data[6])."' ".'checked'." data-id='".esc_attr($rtwmer_vendors_data[6])."'>
										<span class='rtwmer_slider rtwmer_round'></span>
										</label>";
									}
									else
									{
										$rtwmer_vendors_data_ssp['data'][$i][5] = "<label class='rtwmer_switch'>
										<input type='checkbox' class='rtwmer_vendors_status rtwmer_vendors_status".esc_attr($rtwmer_vendors_data[6])."' data-id='".esc_attr($rtwmer_vendors_data[6])."'>
										<span class='rtwmer_slider rtwmer_round'></span>
										</label>";
									}
								}
							}
							
						}
					}
				}

				if( isset($rtwmer_vendors_data[0]) && isset($rtwmer_vendors_data[1]) && isset($rtwmer_vendors_data[6]))
				{

					$rtwmer_vendor_store = $rtwmer_vendors_data[1];

					if( isset( $rtwmer_vendor_store ) )
					{
						$rtwmer_vendors_img = get_user_meta( $rtwmer_vendors_data[0] );

						if( isset( $rtwmer_vendors_img ) && isset($rtwmer_vendors_img['rtwmer_vendor_store_img'][0]) )
						{
							if( empty( $rtwmer_vendors_img['rtwmer_vendor_store_img'][0] ) )
							{
								$rtwmer_vendors_img_url = get_avatar_url($rtwmer_vendors_data[0]);
							}
							else
							{
								$rtwmer_vendors_img_url = wp_get_attachment_url($rtwmer_vendors_img['rtwmer_vendor_store_img'][0]);
							}
							if( isset( $rtwmer_vendors_data_ssp['data'][$i][1] ) && isset($rtwmer_vendors_img_url) )
							{
								$rtwmer_vendors_data_ssp['data'][$i][1] = "<div class = rtwmer_vendor_store>
									<span class = rtwmer_vendor_store_upper>
										<img src = ".esc_attr($rtwmer_vendors_img_url)." class = 'rtwmer_vendore_store_img' data-img = '". esc_attr($rtwmer_vendors_img['rtwmer_vendor_store_img'][0]) ."' id = 'rtwmer_vendor_img".esc_attr($rtwmer_vendors_data[0])."' >
										<div class = 'rtwmer_vendor_tabs'>
										<a href = # data-target = #rtwmer_vendor_display_modal id='rtwmer_vendor_profile_display' data-toggle = modal class = 'rtwmer_vendor_store_name' data-id = " .esc_attr($rtwmer_vendors_data[6]). "> ".esc_attr($rtwmer_vendor_store)." </a>
									</span>
										<div class = rtwmer_vendor_option>
											<a href = # data-target = #rtwmer_vendor_modal data-toggle = modal class = 'rtwmer_vendor_edit_modal rtwmer_vendor_options' data-id = " .esc_attr($rtwmer_vendors_data[6]). "> Edit </a>
											<a href = #/product class = 'rtwmer_vendor_options rtwmer_vendor_products' data-id = " .esc_attr($rtwmer_vendors_data[6]). "> Products </a>
											<a href = #orders class = 'rtwmer_vendor_options rtwmer_vendors_orders'>Order</a>
										</div>
									</div>
								</div>";
							}
						}
					}	
				}
				if( isset($rtwmer_vendors_data[2]) && isset($rtwmer_vendors_data[6]))
				{
					$rtwmer_vendors_mail = $rtwmer_vendors_data[2];
					
					if( isset( $rtwmer_vendors_mail ) && !empty($rtwmer_vendors_mail) )
					{
						if( isset( $rtwmer_vendors_data_ssp['data'][$i][2] ) )
						{
							$rtwmer_vendors_data_ssp['data'][$i][2] = '<a class = "rtwmer_vendor_mail" href = mailto:'.esc_url($rtwmer_vendors_mail).'>'.esc_attr($rtwmer_vendors_mail).'</a>';
						}
					}
				}
				if( isset($rtwmer_vendors_data[0]) && isset($rtwmer_vendors_data[6]) && isset($rtwmer_vendors_data_ssp['data'][$i][0]) )
				{
					$rtwmer_vendors_data_ssp['data'][$i][0] = '<td class="mdc-data-table__cell mdc-data-table__cell--checkbox">
						<div class="mdc-checkbox mdc-data-table__row-checkbox">
							<input type="checkbox" class="mdc-checkbox__native-control rtwmer_vendor_inner_checkbox" name="rtwmer_inner_check" data-id='.esc_attr($rtwmer_vendors_data[6]).'>
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

				$i++;
			}	
		
		}

		// do_action('rtwmer_mercado_onload_vendor_table');
	
		echo json_encode( $rtwmer_vendors_data_ssp );
	}

	wp_die();
	
