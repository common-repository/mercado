
<!-- This file contains the html for the product section -->
<?php global $rtwmer_user_id_for_dashboard; ?>
<div class="wrap rtwmer_product_container card">
    <?php $rtwmer_meta = get_user_meta($rtwmer_user_id_for_dashboard, 'rtwmer_counting_array', true);

    if (is_array($rtwmer_meta)) {
        $rtwmer_order_meta = $rtwmer_meta['rtwmer_prod_count_array'];
        $rtwmer_all = $rtwmer_order_meta['rtwmer_prod_all_count'];
        $rtwmer_published = $rtwmer_order_meta['rtwmer_prod_publish_count'];
        $rtwmer_pending = $rtwmer_order_meta['rtwmer_prod_pending_count'];
        $rtwmer_trash = $rtwmer_order_meta['rtwmer_prod_trash_count'];
    } else {
        $rtwmer_order_meta = '';
        $rtwmer_all = 0;
        $rtwmer_published = 0;
        $rtwmer_pending = 0;
        $rtwmer_trash = 0;
    }
    ?>
    <div class="rtwmer-top">
        <div class="rtwmer-head">
            <div class="mdc-tab-bar rtwmer-tab-bar" role="tablist">
                <div class="mdc-tab-scroller">
                    <div class="mdc-tab-scroller__scroll-area mdc-tab-scroller__scroll-area--scroll">
                        <div class="mdc-tab-scroller__scroll-content">
                            <a class="mdc-tab mdc-tab--stacked mdc-tab--active rtwmer_listing_button rtwmer_active_button" role="tab" aria-selected="true" tabindex="0" id="rtwmer_all_product_table" href="#product">
                                <span class="mdc-tab__content">
                                    <span class="mdc-tab__icon material-icons" aria-hidden="true">apps</span>
                                    <span class="mdc-tab__text-label rtwmer_all_prod"><?php esc_html_e("All", "rtwmer-mercado");
                                    echo "(" ;
                                    esc_html_e($rtwmer_all,"rtwmer-mercado");  
                                    echo ")"; 
                                    ?></span>
                                    <span class="mdc-tab-indicator mdc-tab-indicator--active">
                                        <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                    </span>
                                </span>
                                <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                            </a>
                            <a class="mdc-tab mdc-tab--stacked rtwmer_listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_published_product_table" href="#product?published_product">
                                <span class="mdc-tab__content">
                                    <span class="mdc-tab__icon material-icons" aria-hidden="true">publish</span>
                                    <span class="mdc-tab__text-label rtwmer_publish_prod"><?php esc_html_e("Online", "rtwmer-mercado");
                                    echo "(" ;
                                    esc_html_e($rtwmer_published,"rtwmer-mercado");  
                                    echo ")"; ?></span>
                                    <span class="mdc-tab-indicator">
                                        <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                    </span>
                                </span>
                                <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                            </a>
                            <a class="mdc-tab mdc-tab--stacked rtwmer_listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_pending_product_table" href="#product?pending_product">
                                <span class="mdc-tab__content">
                                    <span class="mdc-tab__icon material-icons" aria-hidden="true">access_time</span>
                                    <span class="mdc-tab__text-label rtwmer_pendin_prod"><?php esc_html_e("Pending", "rtwmer-mercado");
                                    echo "(" ;
                                    esc_html_e($rtwmer_pending,"rtwmer-mercado");  
                                    echo ")"; ?></span>
                                    <span class="mdc-tab-indicator">
                                        <span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                    </span>
                                </span>
                                <span class="mdc-tab__ripple mdc-ripple-upgraded"></span>
                            </a>
                            <a class="mdc-tab mdc-tab--stacked rtwmer_listing_button" role="tab" aria-selected="false" tabindex="-1" id="rtwmer_trash_product_table" href="#product?trashed_product">
                                <span class="mdc-tab__content">
                                    <span class="mdc-tab__icon material-icons" aria-hidden="true">delete</span>
                                    <span class="mdc-tab__text-label rtwmer_trash_prod"><?php esc_html_e("Trash", "rtwmer-mercado");
                                    echo "(" ;
                                    esc_html_e($rtwmer_trash,"rtwmer-mercado") ;
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

        <?php
        $rtwmer_modal_permission = get_option('rtwmer_selling_page');
       
        if (is_array($rtwmer_modal_permission)) {
            if ($rtwmer_modal_permission['rtwmer_disable_product_popup'] != 1) {
                $rtwmer_class = "";
            } else {
                $rtwmer_class =  "rtwmer_popup";
            }
        } else {
            $rtwmer_class = "";
        }
        ?>
        <?php $rtwmer_product_permission =  ''?>
        <div id="rtwmer-button" class="rtwmer-icon32 <?php esc_attr_e($rtwmer_class, 'rtwmer-mercado')  ?>">
            <?php if($this->rtwmer_user_can_access("rtwmer_add_prod_cap")){ ?>
            <a class="mdc-button mdc-button--raised mdc-button--upgraded"   id="rtwmer-add-product" href="#product"><?php esc_html_e("Add New Product", "rtwmer-mercado") ?></a>
            <?php } ?>
        </div>
        <?php do_action("rtwmer_after_add_prod_button"); ?>
    </div>
    <div class="rtwmer-body">
        <?php include_once  RTWMER_PUBLIC_PARTIAL . "rtwmer-Vendor-product-add.php"; ?>
        <div class="rtwmer-table">
            <div class="rtwmer_bulk_action_and_filter">
                <div class="rtwmer_bulk_action_box"><select id="rtwmer_select_box">
                        <option value=""><?php esc_html_e("Bulk Action", "rtwmer-mercado")  ?></option>
                        <option value="Delete_multiple"><?php esc_html_e("Delete", "rtwmer-mercado")  ?></option>
                        <option value="Restore_multiple" class="rtwmer_restore_op"><?php esc_html_e("Restore", "rtwmer-mercado")  ?></option>
                    </select>
                    <button class="rtwmer_action_button mdc-button mdc-button--raised rtwmer-footer-btn" id="rtwmer_bulk_action" name="Bulk_action"><?php esc_html_e("Select", "rtwmer-mercado")  ?></button>
                </div>
                <div class="rtwmer_filter_box">
                    <select id='rtwmer_archieve_filter'>
                        <option value=""><?php esc_html_e("-None-", "rtwmer-mercado") ?></option>
                        <?php echo wp_get_archives(array(
                            'type'            => 'monthly',
                            'format'          => 'html',
                            'before'          => '<option>',
                            'after'           => '</option>',
                            'post_type'       => 'product',
                        )); ?>
                    </select>
                    <?php
                    $rtwmer_cat_args = array(
                        "id"        => "rtwmer_filter_cat",
                        "name"      => "category",
                        "class"     => "rtwmer_productrs_filter",
                        "option_none_value" => "Uncategorized",
                        "show_option_none" => "Select category",
                        "taxonomy"     => "product_cat",
                        "orderby"      => "name",
                        "show_count"   => 0,
                        "pad_counts"   => 0,
                        "hierarchical" => 1,
                        "title_li"     => '',
                        "hide_empty"   => 1,
                        "echo"   => 1
                    );
                    wp_dropdown_categories($rtwmer_cat_args);
                    ?>
                    <button type="button" class="mdc-button mdc-button--raised rtwmer-footer-btn" id="rtwmer_product_filter">
                        <?php esc_html_e("Filter", "rtwmer-mercado") ?>
                    </button>

                </div>
            </div>
            <?php do_action("rtwmer_before_product_table"); ?>
            <table id="table_id" class="display mdl-data-table">
                <thead>
                    <tr>
                        <th class="mdc-data-table__cell mdc-data-table__cell--checkbox sorting_disabled rtwmer_datatable_checkbox" tabindex="0" rowspan="1" colspan="1">
                            <div class="mdc-checkbox mdc-data-table__row-checkbox">
                                <input type="checkbox" name='rtwmer_bulk_check' class="mdc-checkbox__native-control rtwmer_table_bulk_check_class" id="rtwmer_parent_table_bulk_check" aria-labelledby="u0">
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                                <div class="mdc-checkbox__ripple"></div>
                            </div>
                        </th>
                        <th><?php esc_html_e("Image", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("Name", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("Status", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("SKU", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("Stock", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("Price", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("Earning", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("Type", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("Views", "rtwmer-mercado")  ?></th>
                        <th><?php esc_html_e("Date", "rtwmer-mercado")  ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>