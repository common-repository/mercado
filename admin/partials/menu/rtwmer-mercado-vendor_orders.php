<?php 

//================File is used to show product orders to the admin====================//

    if( !empty(get_option( 'rtwmer_order_vendor_id' )) )
    {
        ?>
            <input type="hidden" id="rtwmer_order_vendor_id" value="<?php echo esc_attr(get_option( 'rtwmer_order_vendor_id' )); ?>">
        <?php  
    }
    if( !empty(get_option( 'rtwmer_sort_order_by' )) )
    {
        ?>
            <input type="hidden" id="rtwmer_sort_order_by" value="<?php echo esc_attr(get_option( 'rtwmer_sort_order_by' )); ?>">
        <?php  
    }
    if( !empty(get_option( 'rtwmer_order_or_order_all' )) )
    {
        ?>
            <input type="hidden" id="rtwmer_order_or_order_all" value="<?php echo esc_attr(get_option( 'rtwmer_order_or_order_all' )); ?>">
        <?php  
    }
?>
    <div class = "rtwmer_bulk_action">
       
        <div class = "rtwmer_prod_sorting" id = "rtwmer-order-sorting-tabs">
            
            <?php
                $rtwmer_order_sorting_tab = array(
                    '<a href = "#" id = "rtwmer_sort_order_all" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "all" >'.esc_html__("All","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_pending" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "pending" >'.esc_html__("Pending Payment","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_draft" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "draft" >'.esc_html__("Draft","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_processing" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "processing" >'.esc_html__("Processing","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_on-hold" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "on-hold" >'.esc_html__("On hold","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_completed" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "completed" >'.esc_html__("Completed","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_refunded" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "refunded" >'.esc_html__("Refunded","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_cancelled" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "cancelled" >'.esc_html__("Cancelled","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_failed" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "failed" >'.esc_html__("Failed","rtwmer-mercado").'</a>',
                    '<a href = "#" id = "rtwmer_sort_order_trash" class = "mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_order_status" data-value = "trash" >'.esc_html__("Trash","rtwmer-mercado").'</a>'
                );
                if( isset($rtwmer_order_sorting_tab) && is_array($rtwmer_order_sorting_tab) )
                {
                    $rtwmer_order_sorting_tab = apply_filters('rtwmer_order_sorting_tab',$rtwmer_order_sorting_tab);

                    if( isset($rtwmer_order_sorting_tab) && is_array($rtwmer_order_sorting_tab) )
                    {
                        foreach($rtwmer_order_sorting_tab as  $tabs)
                        {
                            if( isset($tabs) )
                            {
                                //======$tabs conntains html========
                                
                                echo $tabs;
                            }
                        }
                    }
                }
            ?>
            
        </div>
        <select name="action" id="rtwmer_order_bulk_action" class='rtwmer-select-text'>
            <option value = "rtwmer_not_selected"><?php esc_html_e( 'Bulk Actions','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_order_bul_trash" value = "rtwmer_bulk_trash_order"><?php esc_html_e( 'Move To Trash','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_order_bul_restore" value = "rtwmer_bulk_restore_order"><?php esc_html_e( 'Restore','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_order_bul_delete" value = "rtwmer_bulk_delete_order"><?php esc_html_e( 'Delete Permanently','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_order_bul_chng_processing" value = "processing"><?php esc_html_e( 'Change Status to Processing','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_order_bul_chng_onhold" value = "on-hold"><?php esc_html_e( 'Change Status to On-hold','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_order_bul_chng_completed" value = "completed"><?php esc_html_e( 'Change Status to Completed','rtwmer-mercado' ); ?></option>
        </select>

        <button class="mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_order_apply_bulk" id="rtwmer_order_apply_bulk">
			<span class="mdc-button__label"><?php esc_html_e('Apply', 'rtwmer-mercado'); ?></span>
			<div class="mdc-button__ripple"></div>
        </button>
        <a href="#/orders" data-id = "<?php echo esc_attr($vendor); ?>" id="rtwmer_add_new_order" class="mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_add_new_order "><?php esc_html_e('Add New','rtwmer-mercado') ?></a>
    </div>

        <table id="rtwmer_order_table" class="rtwmer_orders_table mdl-data-table">
            <thead>
                <tr>
                    <th class="mdc-data-table__cell mdc-data-table__cell--checkbox">
                        <div class="mdc-checkbox mdc-data-table__row-checkbox">
                            <input type="checkbox" class="mdc-checkbox__native-control rtwmer_orders_outer_checkbox">
                            <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                            <div class="mdc-checkbox__ripple"></div>
                        </div>
				    </th>
                    <th><?php esc_html_e( 'Order','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Date','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Status','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Total','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Vendor','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Sub Order','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Actions','rtwmer-mercado' ); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="mdc-data-table__cell mdc-data-table__cell--checkbox">
                        <div class="mdc-checkbox mdc-data-table__row-checkbox">
                            <input type="checkbox" class="mdc-checkbox__native-control rtwmer_orders_outer_checkbox">
                            <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                            <div class="mdc-checkbox__ripple"></div>
                        </div>
				    </th>
                    <th><?php esc_html_e( 'Order','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Date','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Status','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Total','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Vendor','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Sub Order','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Actions','rtwmer-mercado' ); ?></th>
                </tr>
            </tfoot>
        </table>

        <div class='rtwmer-modal' id='rtwmer_order_edit_modal'>
            <div class='rtwmer-modal-dialog rtwmer_modal_dialog_for_prod'>
                <div class='rtwmer-modal-content rtwmer_fix_height_content_for_iframe'>
                
                    <div class='rtwmer-modal-header'>
                        <h4 class='rtwmer-modal-title'><?php esc_html_e('Edit Order','rtwmer-mercado'); ?></h4>
                        <button class="close rtwmer_edit_order_iframe_close rtwmer-modal-close mdc-button">
                            <i class="material-icons rtwvsm-list-item" aria-hidden="true"><?php echo esc_html('highlight_off') ?></i>
                        </button>
                    </div>
                    
                    <div class = 'rtwmer-modal-body rtwmer_fix_height_body_for_iframe'>
                        <iframe class="rtwmer_prod_frame" id="rtwmer_edit_order_frame">     
                        </iframe>
                    </div>
                    <div class="loader"></div>
                </div>
            </div>
        </div>

        <div class="rtwmer-modal" id="rtwmer_order_detail_modal">
        <div class="rtwmer-modal-dialog rtwmer-dialog" role="document">
          <div class="rtwmer-modal-content">
            <div class="rtwmer-modal-header">
              <h3 class="rtwmer-modal-title rtwmer_order_id"></h3>
              <span class="rounded py-1 px-3 ml-5 rtwmer_order_status"></span>
              <button  class="mdc-button rtwmer-modal-close rtwmer_close_view_order_btn">
              <i class="material-icons rtwvsm-list-item"><?php echo esc_html('highlight_off'); ?></i>
              </button>
            </div>
            <div class="rtwmer-modal-body rtwmer_edit_order_view_text">
                <div class="rtwmer_orders_row">
                    <div class="rtwmer-col-6">
                        <h5 class="rtwmer-order-modal-title"><?php esc_html_e('Billing Details','rtwmer-mercado'); ?></h5>
                        <p class="rtwmer_billing_first_name"></p>
                        <p class="rtwmer_billing_last_name"></p>
                        <p class="rtwmer_billing_company"></p>
                        <p class="rtwmer_billing_address1"></p>
                        <p class="rtwmer_billing_address2"></p>
                        <p class="rtwmer_billing_city"></p>
                        <p class="rtwmer_billing_state"></p>
                        <p class="rtwmer_billing_postcode"></p>
                        <p class="rtwmer_billing_country"></p>
                        <div>
                            <h6 class="rtwmer-order-email-title">
                            <?php esc_html_e('Email','rtwmer-mercado')?></h6>
                            <a class="nav-link  rtwmer_billing_email" href="#orders"></a>
                        </div>
                        <div>
                            <h6 class="rtwmer-order-phone-title"><?php esc_html_e('Phone','rtwmer-mercado') ?></h6>
                            <a class="nav-link  rtwmer_billing_phone"></a>
                        </div>
                        <div>
                            <h6 class="rtwmer-order-payment-title"><?php esc_html_e('Payment Via','rtwmer-mercado') ?></h6>
                            <p class="nav-link  rtwmer_payment_method_title"></p>
                        </div>
                    </div>
                     <div class="rtwmer-col-6">
                        <h5 class="rtwmer-order-modal-title"><?php esc_html_e('Shipping Details','rtwmer-mercado') ?></h5>
                            <p class="m-0 rtwmer_shipping_first_name"></p>
                            <p class="m-0 rtwmer_shipping_last_name"></p>
                            <p class="m-0 rtwmer_shipping_company"></p>
                            <p class="m-0 rtwmer_shipping_address1"></p>
                            <p class="m-0 rtwmer_shipping_address2"></p>
                            <p class="m-0 rtwmer_shipping_city"></p>
                            <p class="m-0 rtwmer_shipping_state"></p>
                            <p class="m-0 rtwmer_shipping_postcode"></p>
                            <p class="m-0 rtwmer_shipping_country"></p>
                        
                        <div class="col-md-6">
                            <h6 class="rtwmer-order-titles"><?php esc_html_e('Shipping Methods','rtwmer-mercado') ?></h6>
                            <p class="rtwmer_shipping_method"></p>
                            <h6 class="rtwmer-order-titles"><?php esc_html_e('Note','rtwmer-mercado') ?></h6>
                            <p class="rtwmer_customer_note"></p>
                        </div>
                       
                    </div>
                </div>
                
                <div id="rtwmer_order_prod_table">
                </div>

            </div>
            <div class="rtwmer-modal-footer d-block">
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6 text-right">
                        <input type="hidden" id="rtwmer_current_order_id">
                        <button type="button" class=" rtwmer_edit_order_modal rtwmer-modal-close mdc-button mdc-button--raised mdc-ripple-upgraded close">
							<span class="mdc-button__label"><?php esc_html_e('Edit','rtwmer-mercado'); ?></span>
							<div class="mdc-button__ripple"></div>
						</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>