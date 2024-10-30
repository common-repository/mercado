
<!-- This file contains the html for the withdraw section on vendor dashboard -->
<?php global $rtwmer_user_id_for_dashboard; ?>
<div class="rtwmer-withdraw-wrap card">
    <?php

    $rtwmer_withdraw_count = get_user_meta($rtwmer_user_id_for_dashboard, "rtwmer_counting_array", true);
    ?>
    <div class="rtwmer_amount_detail">
        <p id="rtwmer_balance">
            <?php esc_html_e("Balance : ", "rtwmer-mercado");
            $rtwmer_currency =  "<span class='rtwmer_curency_symbol'>" . get_woocommerce_currency_symbol() . "</span>";
            echo $rtwmer_currency;  // This variable holds html
            ?>
            <span id="rtwmer_curent_bal">
                <?php 
                if (get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_total_amount', true)) {
                    esc_html(get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_total_amount', true));
                } else {
                    esc_html_e(0, "rtwmer-mercado");
                }     ?>
            </span>
        </p>
        <p id="rtwmer_balance">
            <?php esc_html_e("Withdraw Balance Request : ", "rtwmer-mercado");
            $rtwmer_currency =  "<span class='rtwmer_curency_symbol'>" . get_woocommerce_currency_symbol() . "</span>";
            echo $rtwmer_currency;  // This variable holds html
            ?>
            <span id="rtwmer_curent_bal">
                <?php 
                $table_name = $wpdb->prefix.'rtwmer_withdraw';
                $results = $wpdb->get_results("SELECT amount,status FROM $table_name where user_id = $rtwmer_user_id_for_dashboard");
                $amount = 0;
                foreach($results as $row)
                {
                    if($row->status == 'pending'){
                        $amount +=  $row->amount;
                    }
                   
                }
                 esc_html_e($amount,"rtwmer-mercado");
                // esc_html_e("Min. Amount can be withdrawn  ", "rtwmer-mercado");
                // if (get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_total_amount', true)) {
                //     esc_html(get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_total_amount', true));
                // } else {
                //     esc_html_e(0, "rtwmer-mercado");
                // }     ?>
            </span>
        </p>
     
        <p id="rtwmer_min_amount">
            <?php
            esc_html_e("Min. Amount can be withdrawn  ", "rtwmer-mercado");
            echo ": " . $rtwmer_currency;    // This variable holds html
            ?>
            <span id="rtwmer_min_bal">
                <?php $rtwmer_temp_var = (isset(get_option("rtwmer_withdraw_option")["rtwmer_minimum_withdraw"]) && is_array(get_option("rtwmer_withdraw_option"))) ? get_option("rtwmer_withdraw_option")["rtwmer_minimum_withdraw"] : 0; 
                echo $rtwmer_temp_var;
                ?></span>
        </p>
    </div>
    <div class="rtwmer-head">
        <div class="mdc-tab-bar rtwmer-tab-bar" role="tablist">
            <div class="mdc-tab-scroller">
                <div class="mdc-tab-scroller__scroll-area mdc-tab-scroller__scroll-area--scroll">
                    <div class="mdc-tab-scroller__scroll-content">
                        <a class="mdc-tab mdc-tab--stacked mdc-tab--active listing_button rtwmer_active_button" role="tab" aria-selected="true" tabindex="0" id="rtwmer_withdraw_request" href="#withdraw?request">
                            <span class="mdc-tab__content">
                                <span class="mdc-tab__icon material-icons" aria-hidden="true">
                                    <?php echo get_woocommerce_currency_symbol(); ?></span>
                                <span class="mdc-tab__text-label rtwmer_withdraw_req">
                                    <?php esc_html_e(" Withdraw Request", "rtwmer-mercado");
                                    echo "(" ;
                                     $rtwmer_temp_var = isset($rtwmer_withdraw_count["rtwmer_withdraw_count_array"]["rtwmer_withdraw_pending_count"]) ? $rtwmer_withdraw_count["rtwmer_withdraw_count_array"]["rtwmer_withdraw_pending_count"] : 0 ;
                                     esc_html_e($rtwmer_temp_var ,"rtwmer-mercado");
                                     echo ")"; ?>
                                </span>
                                <span class="mdc-tab-indicator mdc-tab-indicator--active">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_approved_request" href="#withdraw?approved">
                            <span class="mdc-tab__content">
                                <span class="mdc-tab__icon material-icons" aria-hidden="true">publish</span>
                                <span class="mdc-tab__text-label rtwmer_withdraw_approv">
                                    <?php esc_html_e("Approved Requests", "rtwmer-mercado");
                                    echo "(" ;
                                     $rtwmer_temp_var = isset($rtwmer_withdraw_count["rtwmer_withdraw_count_array"]["rtwmer_withdraw_approved_count"]) ? $rtwmer_withdraw_count["rtwmer_withdraw_count_array"]["rtwmer_withdraw_approved_count"] : 0 ;
                                     esc_html_e($rtwmer_temp_var,"rtwmer-mercado");
                                     echo ")"; ?>
                                </span>
                                <span class="mdc-tab-indicator">
                                    <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                </span>
                            </span>
                            <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                        </a>
                        <a class="mdc-tab mdc-tab--stacked listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_cancel_request" href="#withdraw?cancelled">
                            <span class="mdc-tab__content">
                                <span class="fa fa-times mdc-tab__icon" aria-hidden="true"></span>
                                <span class="mdc-tab__text-label rtwmer_withdraw_cancel">
                                    <?php esc_html_e("Cancelled Requests", "rtwmer-mercado");
                                    echo "(" ;
                                    $rtwmer_temp_var = isset($rtwmer_withdraw_count["rtwmer_withdraw_count_array"]["rtwmer_withdraw_cancelled_count"]) ? $rtwmer_withdraw_count["rtwmer_withdraw_count_array"]["rtwmer_withdraw_cancelled_count"] : 0; 
                                    esc_html_e($rtwmer_temp_var,"rtwmer-mercado")  ;
                                    echo ")"; ?>
                                </span>
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
    <div class="rtwmer-withdraw-table">
        <div class="rtwmer_req_table">
            <?php if($this->rtwmer_user_can_access("rtwmer_withdraw_manage_cap")){ ?>
            <div class="rtwmer_add_new_req"><button class="rtwmer_add_req_button mdc-button mdc-button--raised rtwmer-footer-btn mdc-ripple-upgraded" id="rtwmer_add_new_withdraw_req"><?php esc_html_e("Add New Withdraw Request", "rtwmer-mercado") ?></button></div>
            <?php } ?>
            <div class="rtwmer_modal" id="rtwmer_withdraw_form">
                <div class="rtwmer-modal-dialog">
                    <div class="rtwmer-modal-content">
                        <div class="rtwmer-modal-header">
                            <h4 class="rtwmer-modal-title">
                                <?php esc_html_e("Withdraw Request Form", "rtwmer-mercado") ?>
                            </h4>
                            <a class="rtwmer-modal-close mdc-icon-button material-icons mdc-ripple-upgraded mdc-ripple-upgraded--unbounded mdc-icon-button--on" aria-pressed="true">highlight_off</a>
                        </div>
                        <div class="rtwmer-modal-body">
                            <div class="rtwmer_withdraw_request_form mdc-card mdc-elevation--z9">
                                <div class="rtwmer_withdraw_amount">
                                    <label class="rtwmer_form_field_label">
                                        <?php esc_html_e("Withdraw Amount", "rtwmer-mercado") ?>
                                    </label>
                                    <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                                        <input type="number" class="mdc-text-field__input rtwmer_vendor_withdraw_amount" id="rtwmer_ven_with_amount">
                                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                            <div class="mdc-notched-outline__leading"></div>
                                            <div class="mdc-notched-outline__notch">
                                                <span class="mdc-floating-label"><?php esc_html_e("Withdraw Amount", "rtwmer-mercado") ?></span>
                                            </div>
                                            <div class="mdc-notched-outline__trailing"></div>
                                        </div>
                                    </label></div>
                                <div class="rtwmer_payment_methods">
                                    <label class="rtwmer_form_field_label">
                                        <?php esc_html_e(" Payment Methods", "rtwmer-mercado") ?>
                                    </label>
                                    <select id="rtwmer_paymet_method">
                                        <option></option>
                                        <?php
                                        $rtwmer_method = get_option("rtwmer_payment_gateway");
                                        if($rtwmer_method && !empty($rtwmer_method)){
                                            $rtwrre_paypal = (isset($rtwmer_method['rtwmer_withdraw_paypal']) && $rtwmer_method['rtwmer_withdraw_paypal'] == 1) ? True : False;
                                            $rtwrre_bank_transfer = (isset($rtwmer_method['rtwmer_withdraw_bank']) && $rtwmer_method['rtwmer_withdraw_bank'] == 1) ? True : False;
                                            $rtwrre_stripe = (isset($rtwmer_method['rtwmer_withdraw_stripe']) && $rtwmer_method['rtwmer_withdraw_stripe'] == 1) ?  True : False;
                                        }else{
                                            $rtwrre_paypal = False;
                                            $rtwrre_bank_transfer = False;
                                            $rtwrre_stripe = False;
                                        }
                                       
                                        $rtwrre_payment_array = array();
                                        if($rtwrre_paypal){
                                            $rtwrre_payment_array["paypal"] = "Paypal";
                                        }
                                        if($rtwrre_bank_transfer){
                                            $rtwrre_payment_array["bank_transfer"] = "Bank Transfer";
                                        }
                                        if($rtwrre_stripe){
                                            $rtwrre_payment_array["stripe"] = "Stripe";
                                        }
                                        $rtwrre_payment_array = apply_filters("rtwmer_withdraw_payment_methods",$rtwrre_payment_array);
                                        if(isset($rtwrre_payment_array) && !empty($rtwrre_payment_array) && is_array($rtwrre_payment_array)){
                                            foreach ($rtwrre_payment_array as $rtwmer_key => $rtwmer_value) {
                                                echo "<option value='".esc_attr($rtwmer_key)."'>".esc_html__($rtwmer_value,"rtwmer-mercado")."</option>";
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                                <p>
                                    <button type="button" id="rtwmer_submit_request_button" class="mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer_submit_request">
                                        <span class="mdc-button__label"><?php esc_html_e("Submit", "rtwmer-mercado") ?></span>
                                        <div class="mdc-button__ripple"></div>
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="rtwmer-modal-footer">
                        <button type="button" class="rtwmer-modal-close mdc-button mdc-button--raised rtwmer-footer-btn" data-dismiss="modal">
                            <?php esc_html_e("Close", "rtwmer-mercado") ?>
                        </button>
                    </div>
                </div>
            </div>
            <table id="rtwmer-withdraw-table-id" class="display mdl-data-table">
                <thead>
                    <tr>
                        <th><?php esc_html_e("Amount", "rtwmer-mercado") ?></th>
                        <th><?php esc_html_e("Method", "rtwmer-mercado") ?></th>
                        <th><?php esc_html_e("Date", "rtwmer-mercado") ?></th>
                        <th><?php esc_html_e("Remove", "rtwmer-mercado") ?></th>
                        <th><?php esc_html_e("Status", "rtwmer-mercado") ?></th>
                    </tr>
                </thead>
                <tbody id="rtwmer_withdraw_body">
                </tbody>
            </table>
        </div>
        <div class="rtwmer_status_table">
        <div class="rtwmer_modal" id="rtwmer_method_detail_modal">
                <div class="rtwmer-modal-dialog">
                    <div class="rtwmer-modal-content">
                        <div class="rtwmer-modal-header">
                            <h4 class="rtwmer-modal-title">
                                <?php esc_html_e("Withdraw Details", "rtwmer-mercado") ?>
                            </h4>
                            <a class="rtwmer-modal-close rtwmer_close_method_details mdc-icon-button material-icons mdc-ripple-upgraded mdc-ripple-upgraded--unbounded mdc-icon-button--on" aria-pressed="true">highlight_off</a>
                        </div>
                        <div class="rtwmer-modal-body">
                            <div class="rtwmer_method_details_append"></div>
                        </div>
                    </div>
                    <div class="rtwmer-modal-footer">
                    </div>
                </div>
            </div>
            <table id="rtwmer-withdraw-status" class="display mdl-data-table">
                <thead>
                    <tr>
                        <th><?php esc_html_e("Amount", "rtwmer-mercado") ?></th>
                        <th><?php esc_html_e("Method", "rtwmer-mercado") ?></th>
                        <th><?php esc_html_e("Date", "rtwmer-mercado") ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>