<?php 
//===================This File contain report section of the plugin shown in report tab=================//
    if( isset($_GET['rtwmer_action']) && !empty($_GET['rtwmer_action']) )

    {

        if( $_GET['rtwmer_action'] == 'rtwmer_store_setup' )

        {

            include_once( RTWMER_ADMIN_PARTIAL.'/admin-includes/rtwmer-mercado-store-setup.php' );

        }

    }

    else

    {

?>

    <div class="rtwmer_dashboard_content_wrappper rtwmer_wrappers">

            <?php do_action('rtwmer_add_pre_meta_data_for_reports'); ?>
            <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell mdc-card rtwmer-grid-cell">
                    <div class="inner-padding">
                        <div class="rtwmer-card-row">
                            <div class="rtwmer-left rtwmer-card1">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="rtwmer-right">
                                <a id='rtwmer_report_box' class='rtwmer_report_box' href="#report">
                                    <p class="p-text"><?php esc_html_e('Total Sale','rtwmer-mercado') ?></p>
                                </a>
                            </div>
                        </div>
                        <div class='rtwmer-total-sale-contents'>
                                <p class="card-text m-0"><?php esc_html_e('This Month','rtwmer-mercado') ?></p>
                                <h5 class="mdc-typography--headline5 rtwmer-price"><?php echo get_woocommerce_currency_symbol(); ?><span id="rtwmer_total_sold_product_amount"></span></h5>
                        </div>
                        <div class="rtwmer-progress">
                            <div class="rtwmer-progress-bar" role="rtwmer-progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-card rtwmer-grid-cell">
                    <div class="inner-padding">
                        <div class="rtwmer-card-row">
                            <div class="rtwmer-left rtwmer-card2">
                                <i class="fab fa-product-hunt"></i>
                            </div>
                            <div class="rtwmer-right">
                                <a id='rtwmer_report_box' class='rtwmer_report_box' href="#report">
                                    <p class="p-text"><?php esc_html_e('New Product Created','rtwmer-mercado') ?></p>
                                </a>
                            </div>
                        </div>
                        <div class='rtwmer-total-sale-contents'>
                            <p class="card-text m-0"><?php esc_html_e('This Month','rtwmer-mercado'); ?></p>
                            <h5 class="mdc-typography--headline5 rtwmer-price"><span id="rtwmer_get_monthly_created_product"></span><span class="rtwmer_unapproved_vendors"><?php esc_html_e('Products','rtwmer-mercado'); ?></span></h5>
                        </div>
                        <div class="rtwmer-progress">
                            <div class="rtwmer-progress-bar" role="rtwmer-progressbar" ></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-card rtwmer-grid-cell">
                    <div class="inner-padding">
                        <div class="rtwmer-card-row">
                            <div class="rtwmer-left rtwmer-card3">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="rtwmer-right">
                                <a id="rtwmer_vendor_signup_box" class='rtwmer_report_box' href="#/vendor">
                                    <p class="p-text"><?php esc_html_e('Vendor SignUp','rtwmer-mercado') ?></p>
                                </a>
                            </div>
                        </div>
                        <div class='rtwmer-total-sale-contents'>
                            <p class="card-text m-0"><?php esc_html_e('This Month','rtwmer-mercado') ?></p>
                            <h5 class="mdc-typography--headline5 rtwmer-price"><span id="rtwmer_get_monthly_created_vendor"></span><span class="rtwmer_unapproved_vendors"><?php esc_html_e('Vendors','rtwmer-mercado') ?></span></h5>
                        </div>
                        <div class="rtwmer-progress">
                            <div class="rtwmer-progress-bar" role="rtwmer-progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-card rtwmer-grid-cell">
                    <div class="inner-padding">
                        <div class="rtwmer-card-row">
                            <div class="rtwmer-left rtwmer-card4">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="rtwmer-right">
                                <a id="rtwmer_vendor_signup_box" class='rtwmer_report_box' href="#/vendor">
                                    <p class="p-text"><?php esc_html_e('Awaiting Approval','rtwmer-mercado') ?></p>
                                </a>
                            </div>
                        </div>
                        <div class='rtwmer-total-sale-contents'>
                            <p class="card-text m-0"><?php esc_html_e('Total','rtwmer-mercado'); ?></p>
                            <h5 class="mdc-typography--headline5 rtwmer-price"><span class="" id="rtwmer_unapproved_vendors"></span><span class="rtwmer_unapproved_vendors"><?php esc_html_e(' Vendors','rtwmer-mercado') ?></span></h5>
                        </div>
                        <div class="rtwmer-progress">
                            <div class="rtwmer-progress-bar" role="rtwmer-progressbar"></div>
                        </div>
                    </div>    
                </div>
                <div class="mdc-layout-grid__cell mdc-card rtwmer-grid-cell">
                    <div class="inner-padding">
                        <div class="rtwmer-card-row">
                            <div class="rtwmer-left rtwmer-card4">
                                <i class="far fa-handshake"></i>
                            </div>
                            <div class="rtwmer-right">
                                <a id="rtwmer_order_all_box" class='rtwmer_report_box' href="#/orders_all">
                                    <p class="p-text"><?php esc_html_e('Total Orders','rtwmer-mercado') ?></p>
                                </a>
                            </div>
                        </div>
                        <div class='rtwmer-total-sale-contents'>
                            <p class="card-text m-0"><?php esc_html_e('This Month','rtwmer-mercado') ?></p>
                            <h5 class="mdc-typography--headline5 rtwmer-price"><span class="" id="rtwmer_total_orders_count"></span><span class="rtwmer_unapproved_vendors"><?php esc_html_e('Orders','rtwmer-mercado') ?></span></h5>
                        </div>
                        <div class="rtwmer-progress">
                            <div class="rtwmer-progress-bar" role="rtwmer-progressbar"></div>
                        </div>
                    </div>    
                </div>
                <div class="mdc-layout-grid__cell mdc-card rtwmer-grid-cell">
                    <div class="inner-padding">
                        <div class="rtwmer-card-row">
                            <div class="rtwmer-left rtwmer-card3">
                                <i class="far fa-money-bill-alt"></i>
                            </div>
                            <div class="rtwmer-right">
                                <a id='rtwmer_report_box' class='rtwmer_report_box' href="#report">
                                    <p class="p-text"><?php esc_html_e('Commission Earned','rtwmer-mercado') ?></p>
                                </a>
                            </div>
                        </div>
                        <div class='rtwmer-total-sale-contents'>
                            <p class="card-text m-0"><?php esc_html_e('This Month','rtwmer-mercado') ?></p>
                            <h5 class="mdc-typography--headline5 rtwmer-price"><?php echo get_woocommerce_currency_symbol(); ?><span id="rtwmer_admin_commission_value"></span></h5>
                        </div>
                        <div class="rtwmer-progress">
                            <div class="rtwmer-progress-bar" role="rtwmer-progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-card rtwmer-grid-cell">
                    <div class="inner-padding">
                        <div class="rtwmer-card-row">
                            <div class="rtwmer-left rtwmer-card2">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="rtwmer-right">
                                <a id='rtwmer_report_box' class='rtwmer_report_box' href="#report">
                                    <p class="p-text"><?php esc_html_e('Total Product Sold','rtwmer-mercado') ?></p> 
                                </a>
                            </div>
                        </div>
                        <div class='rtwmer-total-sale-contents'>
                            <p class="card-text m-0"><?php esc_html_e('This Month','rtwmer-mercado') ?></p>
                            <h5 class="mdc-typography--headline5 rtwmer-price"><span class="" id="rtwmer_total_sold_product"></span><span class="rtwmer_unapproved_vendors"><?php esc_html_e('Products','rtwmer-mercado') ?></span></h5>
                        </div>
                        <div class="rtwmer-progress">
                            <div class="rtwmer-progress-bar" role="rtwmer-progressbar"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell mdc-card rtwmer-grid-cell">
                    <div class="inner-padding">
                        <div class="rtwmer-card-row">
                            <div class="rtwmer-left rtwmer-card1">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="rtwmer-right">
                                <a id="rtwmer_withdraw_requests_box" class='rtwmer_report_box' href="#withdraw">
                                    <p class="p-text"><?php esc_html_e('Awaiting Approval','rtwmer-mercado') ?></p>
                                </a>
                            </div>
                        </div>
                        <div class='rtwmer-total-sale-contents'>
                            <p class="card-text m-0"><?php esc_html_e('Total','rtwmer-mercado') ?></p>
                            <h5 class="mdc-typography--headline5 rtwmer-price"><span class="" id="rtwmer_unapproved_withdraw_requests"></span><span class="rtwmer_unapproved_vendors"><?php esc_html_e(' Withdraw Requests','rtwmer-mercado') ?></span></h5>
                        </div>
                        <div class="rtwmer-progress">
                            <div class="rtwmer-progress-bar" role="rtwmer-progressbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php do_action('rtwmer_mercado_dashboard_card'); ?>

        
        <div class="rtwmer_hide_for_sort_by_vendor">
           <h4 class="rtwmer_dash_page_heading"><span><i class="fas fa-retweet mr-1"></i> <?php esc_html_e('Best Product and Sellers','rtwmer-mercado') ?></span></h4>
        </div>

        <div class="rtwmer_hide_for_sort_by_vendor">
            <div class="mdc-card">
                <div class="rtwmer-table-responsive">
                    <h3><?php esc_html_e('Top Selling Products of the Month', 'rtwmer-mercado'); ?></h3>
                    <div id="rtwmer_dashboard_top_selling_products"></div>
                </div>
            </div>
        </div> 
        <div class="rtwmer_hide_for_sort_by_vendor">
            <div class="mdc-card">
                <div class="rtwmer-table-responsive">
                    <h3><?php esc_html_e('Top Sellers of the Month', 'rtwmer-mercado'); ?></h3>
                    <div id="rtwmer_dashboard_top_sellers"></div>
                </div>
            </div>
        </div>

    </div>

    <div class='rtwmer_admin_reports_heading'>
        <h4 class="rtwmer_dash_page_heading"><span><i class="fas fa-users mr-1"></i> <?php esc_html_e('Admin Reports','rtwmer-mercado') ?></span></h4>
    </div>
    <div class='rtwmer_other_reports_product_stats'>
       <div class="rtwmer-card-chart">
             <canvas  id="rtwmer_product_as_bar_chart" ></canvas>
        </div>
            
       <div class="rtwmer_hide_for_sort_by_vendor">
            <div class="rtwmer-card-chart">
                <canvas id="rtwmer_vendor_as_pie_chart"></canvas>
            </div>
        </div>
    </div>

    <?php

        $rtwmer_mercado_report_chart = array(

            '<div class="rtwmer_order_sales_prod_chart_box">

                <div>

                    <div class="rtwmer-card-chart">

                        <canvas id="rtwmer_total_sales_per_day"></canvas>

                    </div>

                </div>

            </div>'

        );

        $rtwmer_mercado_report_chart = apply_filters('rtwmer_mercado_report_chart',$rtwmer_mercado_report_chart);
        if( isset($rtwmer_mercado_report_chart) && is_array($rtwmer_mercado_report_chart) )

        {

            foreach($rtwmer_mercado_report_chart as $chart)

            {

                // variable contains html, due to not used escaping of html
                echo $chart;

            }

        }

    ?>

    <div id="rtwmer_report_or_dashboard"></div>

<?php } ?>