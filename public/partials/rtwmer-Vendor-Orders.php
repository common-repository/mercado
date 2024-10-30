
<!-- This file contains the html for order section -->
<?php global $rtwmer_user_id_for_dashboard; ?>
<div class="rtwmer-order-wrap card">
    <?php $rtwmer_meta = get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_counting_array', true);
    if (is_array($rtwmer_meta)) {
        $rtwmer_order_meta = $rtwmer_meta['rtwmer_order_count_array'];
        $rtwmer_order_all  =  $rtwmer_order_meta['rtwmer_order_all_count'];
        $rtwmer_order_complete = $rtwmer_order_meta['rtwmer_order_complete_count'];
        $rtwmer_order_processing = $rtwmer_order_meta['rtwmer_order_processing_count'];
        $rtwmer_order_on_hold = $rtwmer_order_meta['rtwmer_order_on_hold_count'];
        $rtwmer_order_pending = $rtwmer_order_meta['rtwmer_order_pending_count'];
        $rtwmer_order_cancelled = $rtwmer_order_meta['rtwmer_order_cancelled_count'];
        $rtwmer_order_refunded = $rtwmer_order_meta['rtwmer_order_refunded_count'];
        $rtwmer_order_failed = $rtwmer_order_meta['rtwmer_order_failed_count'];
    } else {
        $rtwmer_order_meta = '';
        $rtwmer_order_all = 0;
        $rtwmer_order_complete = 0;
        $rtwmer_order_processing = 0;
        $rtwmer_order_on_hold = 0;
        $rtwmer_order_pending = 0;
        $rtwmer_order_cancelled = 0;
        $rtwmer_order_refunded = 0;
        $rtwmer_order_failed = 0;
    }
    ?>
    <div class="rtwmer-head">
        <div class="mdc-tab-bar" role="tablist">
            <div class="mdc-tab-scroller rtwmer-tab-scroller">
                <div class="mdc-tab-scroller__scroll-area mdc-tab-scroller__scroll-area--scroll">
                    <div class="mdc-tab-scroller__scroll-content" id="rtwmer_tabs_wrapper">
                        <a class="mdc-tab mdc-tab--stacked mdc-tab--active listing_button rtwmer_active_button" role="tab" aria-selected="true" tabindex="0" id="rtwmer_order_all_button" href="#orders">
                            <span class="mdc-tab__content">
                                <span class="mdc-tab__icon material-icons" aria-hidden="true">apps</span>
                                <span class="mdc-tab__text-label rtwmer_status_all"><?php esc_html_e("All", "rtwmer-mercado");
                                echo "(" ;
                                 esc_html_e($rtwmer_order_all,"rtwmer-mercado");
                                 echo ")"; ?></span>
                                <span class="mdc-tab-indicator mdc-tab-indicator--active">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_order_complete_button" href="#orders?completed">
                            <span class="mdc-tab__content">
                                <span class="mdc-tab__icon material-icons" aria-hidden="true">check_circle</span>
                                <span class="mdc-tab__text-label rtwmer_status_completed"><?php esc_html_e("Completed", "rtwmer-mercado");
                                echo "(" ;
                                  esc_html_e($rtwmer_order_complete,"rtwmer-mercado");
                                   echo ")"; ?></span>
                                <span class="mdc-tab-indicator">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_order_processing_button" href="#orders?processing">
                            <span class="mdc-tab__content">
                                <span class="fa fa-spinner mdc-tab__icon" aria-hidden="true"></span>
                                <span class="mdc-tab__text-label rtwmer_status_processing"><?php esc_html_e("Processing", "rtwmer-mercado");
                                echo "(" ;
                                esc_html_e($rtwmer_order_processing,"rtwmer-mercado");
                                echo ")"; ?></span>
                                <span class="mdc-tab-indicator">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_order_On_hold_button" href="#orders?onhold">
                            <span class="mdc-tab__content">
                                <span class="mdc-tab__icon material-icons" aria-hidden="true">pause_circle_filled</span>
                                <span class="mdc-tab__text-label rtwmer_status_onhold"><?php esc_html_e("On-hold", "rtwmer-mercado");
                                echo "(" ;
                                esc_html_e( $rtwmer_order_on_hold ,"rtwmer-mercado");
                                echo ")"; ?></span>
                                <span class="mdc-tab-indicator">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_order_Pending_button" href="#orders?pending">
                            <span class="mdc-tab__content">
                                <span class="mdc-tab__icon material-icons" aria-hidden="true">access_time</span>
                                <span class="mdc-tab__text-label rtwmer_status_pending"><?php esc_html_e("Pending", "rtwmer-mercado");
                                echo "(" ;
                                esc_html_e($rtwmer_order_pending,"rtwmer-mercado");
                                echo ")"; ?></span>
                                <span class="mdc-tab-indicator">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_order_Cancelled_button" href="#orders?cancelled">
                            <span class="mdc-tab__content">
                                <span class="mdc-tab__icon material-icons" aria-hidden="true">cancel</span>
                                <span class="mdc-tab__text-label rtwmer_status_cancelled"><?php esc_html_e("Cancelled", "rtwmer-mercado");
                                echo "(" ;
                                 esc_html_e($rtwmer_order_cancelled,"rtwmer-mercado");
                                 echo ")"; ?></span>
                                <span class="mdc-tab-indicator">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_order_Refunded_button" href="#orders?refunded">
                            <span class="mdc-tab__content">
                                <span class="fas fa-hand-holding-usd mdc-tab__icon" aria-hidden="true"></span>
                                <span class="mdc-tab__text-label rtwmer_status_refunded"><?php esc_html_e("Refunded", "rtwmer-mercado");
                                echo "(" ;
                                esc_html_e($rtwmer_order_refunded,"rtwmer-mercado");  
                                echo ")"; ?></span>
                                <span class="mdc-tab-indicator">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_order_Failed_button" href="#orders?failed">
                            <span class="mdc-tab__content">
                                <span class="mdc-tab__icon material-icons" aria-hidden="true">sms_failed</span>
                                <span class="mdc-tab__text-label rtwmer_status_failed"><?php esc_html_e("Failed", "rtwmer-mercado");
                                echo "(" ;
                                 esc_html_e($rtwmer_order_failed,"rtwmer-mercado") ;
                                 echo ")"; ?></span>
                                <span class="mdc-tab-indicator">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rtwmer-order-all-table">
        <div class="rtwmer_order_actions_box">
            <div class="rtwmer_order_filter">
                <div class="rtwmer-date-input-box">
                    <input type="text" class="rtwmer_order_filter_date" name="rtwmer_order_filter_date" placeholder="<?php esc_attr_e("Select Date", "rtwmer_mercado_pro") ?>">
                    <i class="fas fa-calendar-check rtwmer_calender_icon" aria-hidden="true"></i>
                </div>
                <div class="rtwmer_select_customer"><select class="rtwmer_order_filter_cust" name="rtwmer_order_filter_customer"></select></div>
                <button type="button" id="rtwmer_filter_order" class="mdc-button mdc-button--raised mdc-ripple-upgraded">
                    <span class="mdc-button__label"><?php esc_html_e("Filter Order", "rtwmer-mercado") ?></span>
                    <div class="mdc-button__ripple"></div>
                </button>
            </div>
            <?php if($this->rtwmer_user_can_access("rtwmer_export_options_cap")){ ?>
            <div class="rtwmer_export_sec">
                <button type="button" id="rtwmer_export_all" class="mdc-button mdc-button--raised mdc-ripple-upgraded">
                    <span class="mdc-button__label"><?php esc_html_e("Export All", "rtwmer-mercado") ?></span>
                    <div class="mdc-button__ripple"></div>
                </button>
                <button type="button" id="rtwmer_export_select" class="mdc-button mdc-button--raised mdc-ripple-upgraded">
                    <span class="mdc-button__label"><?php esc_html_e("Export Selected", "rtwmer-mercado") ?></span>
                    <div class="mdc-button__ripple"></div>
                </button>
            </div>
            <?php } ?>
        </div>
        <?php
        $rtwmer_status_permission = get_option('rtwmer_selling_page');
        if (is_array($rtwmer_status_permission)) {
            $rtwmer_permission = $rtwmer_status_permission['rtwmer_order_status_change'];
        } else {
            $rtwmer_permission = 0;
        }

        if ($rtwmer_permission == "1" && $this->rtwmer_user_can_access("rtwmer_manage_orders_cap")) {
        ?>
            <div class="rtwmer_bulk_action_area">
                <div class="rtwmer_select_action">
                    <select id="rtwmer_bulk_action_order_check">
                        <option value=""><?php esc_html_e("Select action", "rtwmer-mercado") ?></option>
                        <option value="wc-on-hold"><?php esc_html_e("Change to on_hold", "rtwmer-mercado") ?></option>
                        <option value="wc-processing"><?php esc_html_e("Change to processing", "rtwmer-mercado") ?></option>
                        <option value="wc-completed"><?php esc_html_e("Change to Complete", "rtwmer-mercado") ?></option>
                    </select>
                </div>

                <input type="button" name="submit" id="rtwmer_bulk_button" class="rtwmer_bulk_butt mdc-button mdc-button--raised mdc-ripple-upgraded" value="Ok">
            </div>
        <?php
        }
        do_action("rtwmer_before_order_extra_fields"); ?>
        <table id="rtwmer-order-all-table-id" class="display mdl-data-table">
            <thead>
                <tr>
                    <th class="mdc-data-table__cell mdc-data-table__cell--checkbox sorting_disabled rtwmer_datatable_checkbox" tabindex="0" rowspan="1" colspan="1">
                        <div class="mdc-checkbox mdc-data-table__row-checkbox">
                            <input type="checkbox" class="mdc-checkbox__native-control rtwmer_order_all_bulk_check_class" id="rtwmer_order_all_table_bulk_action" aria-labelledby="u0">
                            <div class="mdc-checkbox__background">
                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                </svg>
                                <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                            <div class="mdc-checkbox__ripple"></div>
                        </div>
                    </th>
                    <th><?php esc_html_e("Order no.", "rtwmer-mercado") ?></th>
                    <th><?php esc_html_e("Order Total", "rtwmer-mercado") ?></th>
                    <th><?php esc_html_e("Status", "rtwmer-mercado") ?></th>
                    <th><?php esc_html_e("Customer", "rtwmer-mercado") ?></th>
                    <th><?php esc_html_e("Date", "rtwmer-mercado") ?></th>
                    <th><?php esc_html_e("Action", "rtwmer-mercado") ?></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="rtwmer_order_details_section">
        <div class="rtwmer_modal  rtwmer_order_modal">
            <div class="rtwmer-modal-dialog rtwmer_order_dialog mdc-elevation--z3">
                <div class="rtwmer-modal-content">
                    <div class="rtwmer-modal-header">
                        <h5 class="rtwmer-modal-title"><?php esc_html_e("Order", "rtwmer-mercado") ?></h5>
                        <a class="rtwmer-close-btn mdc-icon-button material-icons mdc-ripple-upgraded rtwmer-modal-close mdc-ripple-upgraded--unbounded mdc-icon-button--on" aria-pressed="true">highlight_off</a>
                    </div>
                    <div class="rtwmer-modal-body">
                        <?php
                        $rtwmer_vendor_order[] = '<div class="rtwmer-row">
                            <div class="rtwmer-prdct-detail">
                                <div class="rtwmer_left">
                                    <div class="rtwmer_order_items_details">
                                        <ul class="order-head">
                                            <li>' . esc_html__("Order items", "rtwmer-mercado") . '</li>
                                        </ul>';
                        $rtwmer_vendor_order[] = '<table id="rtwmer_modal_order_table_content">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        ' . esc_html__("Items", "rtwmer-mercado") . '
                                                    </th>';
                        $rtwmer_vendor_order[] =   '<th>
                                                    ' . esc_html__("Name", "rtwmer-mercado") . '
                                                    </th>';
                        $rtwmer_vendor_order[] =    '<th>
                                                        ' . esc_html__("Qty", "rtwmer-mercado") . '
                                                    </th>';
                        $rtwmer_vendor_order[] =   '<th>
                                                        ' . esc_html__("Totals", "rtwmer-mercado") . '
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="rtwmer_order_item_detail">

                                            </tbody>
                                            <tfoot>';
                        $rtwmer_vendor_order[] = '<tr>
                                                    <th> ' . esc_html__("Subtotal:", "rtwmer-mercado") . '</th>
                                                    <td id="rtwmer_subtotal"></td>
                                                </tr>';
                        $rtwmer_vendor_order[] =  '<tr>
                                                    <th> ' . esc_html__("Shipping:", "rtwmer-mercado") . '</th>
                                                    <td id="rtwmer_shippings"></td>
                                                </tr>';
                        $rtwmer_vendor_order[] = '<tr>
                                                    <th> ' . esc_html__("Payment method:", "rtwmer-mercado") . '</th>
                                                    <td id="rtwmer_payment_methods"></td>
                                                </tr>';
                        $rtwmer_vendor_order[] = '<tr>
                                                    <th>' . esc_html__("Total:", "rtwmer-mercado") . '</th>
                                                    <td id="rtwmer_total"></td>
                                                </tr>';
                        $rtwmer_vendor_order[] = '</tfoot>
                                        </table>
                                    </div>';
                        $rtwmer_vendor_order[] = '<div class="rtwmer_billing_address_details">
                                        <div class="rtwmer-row">
                                            <div class="rtwmer-billing-section">
                                                <div class="rtwmer_billing_address">
                                                    <ul class="order-head">
                                                        <li>
                                                            ' . esc_html__("Billing Address", "rtwmer-mercado") . '
                                                        </li>
                                                    </ul>';
                        $rtwmer_vendor_order[] = '<div class="rtwmer-shipping-body">
                                                        <span id="rtwmer_billing_details"></span></div>
                                                </div>
                                            </div>
                                            <div class="rtwmer-shipping-section">
                                                <div class="rtwmer_shipping_address">
                                                    <ul class="order-head">
                                                        <li>
                                                            ' . esc_html__("Shipping Address", "rtwmer-mercado") . '
                                                        </li>
                                                    </ul>
                                                    <div class="rtwmer-shipping-body">
                                                        <span id="rtwmer_shipping_details"></span>
                                                    </div>
                                                </div>';
                        $rtwmer_vendor_order[] = '</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rtwmer-general-detail">
                                <div class="rtwmer_right">';
                        $rtwmer_vendor_order[] = '<div class="rtwmer_general_detail_box border rounded mb-3">
                                        <ul class="order-head">
                                            <li>
                                                ' . esc_html__("General details", "rtwmer-mercado") . '
                                            </li>
                                        </ul>
                                        <ul class="order-head">';
                        $rtwmer_vendor_order[] =  '<li>
                                                <span>
                                                    ' . esc_html__("Order Status:", "rtwmer-mercado") . '
                                                </span>
                                                <label id="rtwmer_order_status"></label>
                                            </li>';
                        $rtwmer_vendor_order[] = '<li>
                                                <span>
                                                    ' . esc_html__("Order Date: ", "rtwmer-mercado") . '
                                                </span>
                                                <label id="rtwmer_order_date"></label>
                                            </li>';
                        $rtwmer_vendor_order[] = '<li>
                                                <span>
                                                    ' . esc_html__("Earning From Order:", "rtwmer-mercado") . '
                                                </span>
                                                <label id="rtwmer_order_earning"></label>
                                            </li>';
                        $rtwmer_vendor_order[] = '<div class="rtwmer_customer_details">
                                                <li>
                                                <span>
                                                    ' . esc_html__("Customer:", "rtwmer-mercado") . '
                                                </span>
                                                <label id="rtwmer_customer_name"></label>
                                            </li>';
                        $rtwmer_vendor_order[] = '<li>
                                                <span>
                                                    ' . esc_html__("Email:", "rtwmer-mercado") . '
                                                </span>
                                                <label id="rtwmer_customer_email"></label>
                                            </li>';
                        $rtwmer_vendor_order[] = '<li>
                                                <span>
                                                    ' . esc_html__("Phone:", "rtwmer-mercado") . '
                                                </span>
                                                <label id="rtwmer_phone"></label>
                                            </li>';
                        $rtwmer_vendor_order[] = '<li>
                                                <span>
                                                    ' . esc_html__("Customer IP:", "rtwmer-mercado") . '
                                                </span><label id="rtwmer_customer_ip"></label>
                                            </li></div>';
                        $rtwmer_vendor_order[] = '</ul>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        $rtwmer_vendor_order[] = '<div class="rtwmer_note_detail_box">
                                <label>
                                        ' . esc_html__("Customer Note", "rtwmer-mercado") . '
                                </label>
                                <p id="rtwmer_customer_note"></p>
                            </div>';
                        $rtwmer_vendor_order = apply_filters("rtwmer_order_view_html", $rtwmer_vendor_order);

                        foreach ($rtwmer_vendor_order as $key => $value) {
                            echo $value;    // This variable holds html
                        }
                        ?>
                    </div>
                    <div class="rtwmer-modal-footer">
                        <button type="button" class="rtwmer-modal-close rtwmer-footer-btn mdc-button mdc-button--raised mdc-ripple-upgraded">
                            <span class="mdc-button__label">Close</span>
                            <div class="mdc-button__ripple"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>