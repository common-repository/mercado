<?php 

//=========== This file get included when need to show vendor's product as table on at admin end============//
//=========== This file get included when need to show vendor's product as table on at admin end============//

    if( !empty(get_option( 'rtwmer_sort_table_temp' )) )
    {
       
        $rtwmer_sort_table = get_option( 'rtwmer_sort_table_temp' );
        if(isset($rtwmer_sort_table) && !empty($rtwmer_sort_table))
        {
            ?>
                <input type = "hidden" id = "rtwmer_sort_table" value = "<?php 
                if(isset($rtwmer_sort_table))
                {
                    echo esc_attr($rtwmer_sort_table);
                }
                else 
                {
                    echo "all";
                } ?>" >
            <?php
        }
    }
    else
    {
        ?>
            <input type = "hidden" id = "rtwmer_sort_table" value = <?php esc_html_e('all','rtwmer-mercado') ?> >
        <?php
    }
    ?>
        
        
    <?php

    if( !empty(get_option('rtwmer_prod_count_vend_id')) )
        {
            $rtwmer_prod_count_vend_id = get_option('rtwmer_prod_count_vend_id');
            ?>
                <input type = "hidden" id = "rtwmer_pord_table" value = "<?php 
                if(isset($rtwmer_prod_count_vend_id))
                {
                    echo esc_attr($rtwmer_prod_count_vend_id);
                }
                else 
                {
                    echo 1;
                } ?>" >

                <?php

                global $wpdb;

                if( isset( $rtwmer_prod_count_vend_id ) && !empty( $rtwmer_prod_count_vend_id ) )
                {		
                    $rtwmer_prod_auth_id  = $rtwmer_prod_count_vend_id;
    
                    $where = get_posts_by_author_sql( 'product' );
    
                    $query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = '%s' AND post_author = ".$rtwmer_prod_auth_id." AND (post_status = 'draft' OR post_status = 'private' OR post_status = 'publish' OR post_status = 'pending' ) " ;
                    $rtwmer_prod_all_count = $wpdb->get_var( $wpdb->prepare( $query, 'product' ) );
    
                    $query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = ".$rtwmer_prod_auth_id."";
                    $rtwmer_prod_publish_count = $wpdb->get_var( $wpdb->prepare( $query, 'publish' ) );
                    
                    $query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = ".$rtwmer_prod_auth_id."";
                    $rtwmer_prod_private_count = $wpdb->get_var( $wpdb->prepare( $query, 'private' ) );
                    
                    $query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = ".$rtwmer_prod_auth_id."";
                    $rtwmer_prod_draft_count = $wpdb->get_var( $wpdb->prepare( $query, 'draft' ) );
                    
                    $query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = ".$rtwmer_prod_auth_id."";
                    $rtwmer_prod_pending_count = $wpdb->get_var( $wpdb->prepare( $query, 'pending' ) );

                    $query = "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = '%s' AND post_type = 'product' AND post_author = ".$rtwmer_prod_auth_id."";
                    $rtwmer_prod_trash_count = $wpdb->get_var( $wpdb->prepare( $query, 'trash' ) );
    
                    $rtwmer_prod_count_array = array(
                        'rtwmer_prod_auth_id' => isset($rtwmer_prod_auth_id) ? $rtwmer_prod_auth_id : 0,
                        'rtwmer_prod_all_count' => isset($rtwmer_prod_all_count) ? $rtwmer_prod_all_count : 0,
                        'rtwmer_prod_publish_count' => isset($rtwmer_prod_publish_count) ? $rtwmer_prod_publish_count : 0,
                        'rtwmer_prod_draft_count' => isset($rtwmer_prod_draft_count) ? $rtwmer_prod_draft_count : 0,
                        'rtwmer_prod_pending_count' => isset($rtwmer_prod_pending_count) ? $rtwmer_prod_pending_count : 0,
                        'rtwmer_prod_private_count' => isset($rtwmer_prod_private_count) ? $rtwmer_prod_private_count : 0
                    );
    
                    update_option( 'rtwmer_prod_count_vend_id',$rtwmer_prod_count_array['rtwmer_prod_auth_id'] );
                }
        }
                $all = isset($rtwmer_prod_all_count) ? $rtwmer_prod_all_count : 0 ;
                $public = isset($rtwmer_prod_publish_count) ? $rtwmer_prod_publish_count : 0 ;
                $draft = isset($rtwmer_prod_draft_count) ? $rtwmer_prod_draft_count : 0 ;
                $pending = isset($rtwmer_prod_pending_count) ? $rtwmer_prod_pending_count : 0 ;
                $trash = isset($rtwmer_prod_trash_count) ? $rtwmer_prod_trash_count : 0 ;
                $private = isset($rtwmer_prod_private_count) ? $rtwmer_prod_private_count : 0 ; 
                $vendor = isset($rtwmer_prod_count_vend_id) ? $rtwmer_prod_count_vend_id : 1 ; 
        
    ?>
    
    <div class = "rtwmer_bulk_action">
   
        <div class = "rtwmer_prod_sorting" id="rtwmer-prod-sorting-tabs">
            <?php 
                $rtwmer_product_sorting_tabs = array(
                    "<a href = '#' id = 'rtwmer_sort_all' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_status' data-value = 'all' > ".esc_html__('All('. $all .')','rtwmer-mercado')."</a>",
                    "<a href = '#' id = 'rtwmer_sort_publish' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_status' data-value = 'publish' > ".esc_html__('Published('. $public .')','rtwmer-mercado')."</a>",
                    "<a href = '#' id = 'rtwmer_sort_draft' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_status' data-value = 'draft' > ".esc_html__('Draft('. $draft .')','rtwmer-mercado')."</a>",
                    "<a href = '#' id = 'rtwmer_sort_pending' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_status' data-value = 'pending' > ".esc_html__('Pending('. $pending .')','rtwmer-mercado')."</a>",
                    "<a href = '#' id = 'rtwmer_sort_trash' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_status' data-value = 'trash' > ".esc_html__('Trash('. $trash .')','rtwmer-mercado')."</a>",
                    "<a href = '#' id = 'rtwmer_sort_private' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_sort_by_status' data-value = 'private' > ".esc_html__('Private('. $private .')','rtwmer-mercado')."</a>"
                );

                if( isset($rtwmer_product_sorting_tabs) && is_array($rtwmer_product_sorting_tabs) )
                {
                    $rtwmer_product_sorting_tabs = apply_filters('rtwmer_product_sorting_tabs',$rtwmer_product_sorting_tabs);
                    if( isset($rtwmer_product_sorting_tabs) && is_array($rtwmer_product_sorting_tabs) )
                    {
                        foreach($rtwmer_product_sorting_tabs as $tabs)
                        {
                            if( isset($tabs) )
                            {
                                //====$tabs contains html===========//
                                echo $tabs;
                            }
                        }
                    }
                }

            ?>
            
        </div>
        <select name="action" id="rtwmer_prod_bulk_action">
            <option value = "rtwmer_not_selected"><?php esc_html_e( 'Bulk Actions','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_prod_bul_trash" value = "rtwmer_bulk_trash_prod"><?php esc_html_e( 'Move To Trash','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_prod_bul_untrash" value = "rtwmer_bulk_restore_prod"><?php esc_html_e( 'Restore','rtwmer-mercado' ); ?></option>
            <option class = "rtwmer_prod_bul_untrash" value = "rtwmer_bulk_delete_prod"><?php esc_html_e( 'Delete Permanently','rtwmer-mercado' ); ?></option>
        </select>
        <button class="mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_vendor_apply_bulk" id="rtwmer_vendor_apply_bulk">
            <span class="mdc-button__label"><?php esc_html_e('Apply', 'rtwmer-mercado'); ?></span>
            <div class="mdc-button__ripple"></div>
        </button> 
        <?php $rtwmer_prod_cat = array(
            'show_option_all'  => '',
            'show_option_none' => 'Select Category',
            'taxonomy'         => 'product_cat',
            'id'               => 'rtwmer_filter_by_cat' 
        );
        wp_dropdown_categories($rtwmer_prod_cat); 
        
        $rtwmer_prod_typ = array(
            'show_option_all'  => '',
            'show_option_none' => 'Filter By Product Type',
            'taxonomy'         => 'product_type',
            'id'               => 'rtwmer_filter_by_prod_type' 
        );
        wp_dropdown_categories($rtwmer_prod_typ); 

        $rtwmer_prod_stock = array(
            'show_option_all'  => '',
            'show_option_none' => 'Filter By Product Stock',
            'taxonomy'         => 'product_visibility',
            'id'               => 'rtwmer_filter_by_prod_stock' 
        );
        wp_dropdown_categories($rtwmer_prod_stock); 
        ?>
        <input type = "submit" id = "rtwmer_prod_filter_button" class = "mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_border_color_btn" value = "Filter">
        <input type = "submit" id = "rtwmer_empty_trash" class = "mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_border_color_btn" value = "Empty Trash">
        <a href="#/product" data-id = "<?php echo esc_attr($vendor); ?>" id="rtwmer_add_new_prod" class="mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_add_new_prod "><?php esc_html_e('Add New','rtwmer-mercado') ?></a>
    </div>

        <table id="rtwmer_vendors_product_table" class="rtwmer_vendors_product_table mdl-data-table">

            <thead>
                <tr>
                <th class="mdc-data-table__cell mdc-data-table__cell--checkbox">
                        <div class="mdc-checkbox mdc-data-table__row-checkbox">
                            <input type="checkbox" class="mdc-checkbox__native-control rtwmer_product_outer_checkbox">
                            <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                            <div class="mdc-checkbox__ripple"></div>
                        </div>
				    </th>
                    <th><?php esc_html_e( 'Image','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Name','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'SKU','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Stock','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Price','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Categories','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Tags','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Featured','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Date','rtwmer-mercado' ); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th class="mdc-data-table__cell mdc-data-table__cell--checkbox">
                        <div class="mdc-checkbox mdc-data-table__row-checkbox">
                            <input type="checkbox" class="mdc-checkbox__native-control rtwmer_product_outer_checkbox">
                            <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                            <div class="mdc-checkbox__ripple"></div>
                        </div>
				    </th>
                    <th><?php esc_html_e( 'Image','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Name','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'SKU','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Stock','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Price','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Categories','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Tags','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Featured','rtwmer-mercado' ); ?></th>
                    <th><?php esc_html_e( 'Date','rtwmer-mercado' ); ?></th>
                </tr>
            </tfoot>
        </table> 

    <div class='rtwmer-modal' id='rtwmer_prod_edit_modal'>
        <div class='rtwmer-modal-dialog rtwmer_modal_dialog_for_prod'>

            <div class='rtwmer-modal-content rtwmer_fix_height_content_for_iframe'>
                <div class='rtwmer-modal-header'>
                    <h4 class='rtwmer-modal-title rtwmer_hide_edit_frame'><?php esc_html_e( 'Edit Product','rtwmer-mercado' ); ?></h4>
                    <h4 class='rtwmer-modal-title rtwmer_hide_add_frame'><?php esc_html_e( 'Add Product','rtwmer-mercado' ); ?></h4>
                    <h4 class='rtwmer-modal-title rtwmer_duplicate_add_frame'><?php esc_html_e( 'Duplicate Product','rtwmer-mercado' ); ?></h4>
                    <button  class="mdc-button rtwmer-modal-close">
					    <i class="material-icons" aria-hidden="true"><?php echo esc_html('highlight_off'); ?></i>
					</button>
  
                </div>
                 
                <div class = 'rtwmer-modal-body rtwmer_fix_height_body_for_iframe'>
                    <iframe class="rtwmer_prod_frame rtwmer_hide_edit_frame" id="rtwmer_vend_prod_frame">
                    <?php do_action('rtwmer_edit_product'); ?>                        
                    </iframe>
                    <iframe class="rtwmer_prod_frame rtwmer_hide_add_frame" id="rtwmer_add_prod_frame" src=>
                    <?php do_action('rtwmer_add_product'); ?>                        
                    </iframe>
                    <iframe class="rtwmer_prod_frame rtwmer_duplicate_add_frame" id="rtwmer_duplicate_frame" >               
                    <?php do_action('rtwmer_duplicate_product'); ?>                                 
                    </iframe>
                </div>
                <div class="loader"></div>
            </div>
        </div>
    </div>

    <div class='rtwmer-modal' id='rtwmer_prod_quick_edit_modal'>
        <div class='rtwmer-modal-dialog rtwmer_modal_dialog_for_quick_edit'>
            <div class='rtwmer-modal-content'>
            
                <div class='rtwmer-modal-header'>
                    <h4 class='rtwmer-modal-title'><?php esc_html_e( 'Edit Product','rtwmer-mercado' ); ?></h4>
                    <button  class="mdc-button rtwmer-modal-close">
					    <i class="material-icons" aria-hidden="true"><?php echo esc_html('highlight_off'); ?></i>
					</button>
                </div>
                
                <?php do_action('rtwmer_product_quick_edit_section'); ?>
               <div class = 'rtwmer-modal-body'>
                    <div class = "rtwmer-section-content ">
                        <div clas = "rtwmer-setting-heading">
                            <div class = "rtwmer-subsetting-content" id="">
                                <div class="rtwmer_prod_headings"><?php esc_html_e('Quick Edit','rtwmer-mercado'); ?></div>
                                <ul class = "">
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Title','rtwmer-mercado' ); ?></label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_title">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_html_e('Product Title','rtwmer-mercado'); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
								        </span>
						            </li>
                                  
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Slug','rtwmer-mercado' ); ?> </label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_slug">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_html_e('Product Slug','rtwmer-mercado'); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Date','rtwmer-mercado' ); ?> </label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_published_date">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_html_e('Date','rtwmer-mercado'); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
                                            <?php esc_html_e('at','rtwmer-mercado'); ?>
                                            <label class="mdc-text-field mdc-text-field--outlined">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_published_time">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label"><?php esc_html_e('Time','rtwmer-mercado'); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'password','rtwmer-mercado' ); ?> </label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_password">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_html_e('Enter your password','rtwmer-mercado'); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
                                            <?php esc_html_e('-OR-','rtwmer-mercado'); ?>
                                            <div class="mdc-checkbox mdc-data-table__row-checkbox  mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded rtwmer-margin-top" >
                                                <input type="checkbox" class="mdc-checkbox__native-control" id='rtwmer_prod_private'>
                                                <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                                </div>
                                                <div class="mdc-checkbox__ripple"></div>
									        </div><?php esc_html_e('Private','rtwmer-mercado'); ?>
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Product Tags','rtwmer-mercado' ); ?> </label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--textarea mdc-text-field--no-label">
                                                <textarea class="mdc-text-field__input"  aria-label="Label" id="rtwmer_prod_tag"></textarea>
                                                <span class="mdc-notched-outline">
                                                    <span class="mdc-notched-outline__leading"></span>
                                                    <span class="mdc-notched-outline__trailing"></span>
                                                </span>
                                            </label>
                                            <p><?php esc_html_e('Separate tags with commas','rtwmer-mercado'); ?></p>
                                        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Enable Reviews','rtwmer-mercado' ); ?> </label>
                                        <span class="rtwmer-d-flex-enable-span">
                                            <div class="mdc-checkbox mdc-data-table__row-checkbox  mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                                                <input type="checkbox" class="mdc-checkbox__native-control" id = "rtwmer_prod_enable_reviews">
                                                <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                                </div>
                                                <div class="mdc-checkbox__ripple"></div>
                                            </div> 
                                            <span><?php esc_html_e( 'Enable Reviews','rtwmer-mercado' ); ?></span>
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Status?','rtwmer-mercado' ); ?> </label>
                                        <div class="rtwmer_select_box">
                                            <select class="rtwmer-select-text"  id = "rtwmer_prod_status">
                                                <option value="publish"><?php esc_html_e( 'Published','rtwmer-mercado' ); ?></option>
                                                <option value="pending"><?php esc_html_e( 'Pending Review ','rtwmer-mercado' ); ?></option>
                                                <option value="draft"><?php esc_html_e( 'Draft ','rtwmer-mercado' ); ?></option>
                                            </select>
                                            <label class="rtwmer_select_label"><?php esc_html_e( 'Product Status','rtwmer-mercado' ); ?></label>
                                        </div>
                                    </li>
                                    <div class="rtwmer_prod_headings"><?php esc_html_e('Product Data','rtwmer-mercado'); ?></div>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'SKU','rtwmer-mercado' ); ?> </label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_sku">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_html_e( 'Product SKU','rtwmer-mercado' ); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Price','rtwmer-mercado' ); ?> </label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_price">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_html_e( 'Regular Price','rtwmer-mercado' ); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Sale','rtwmer-mercado' ); ?> </label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_sale_price">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_attr_e('Sale Price','rtwmer-mercado'); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Weight','rtwmer-mercado' ); ?> </label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined w-100">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_weight">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_html_e( 'Weight','rtwmer-mercado' ); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'L/W/H','rtwmer-mercado' ); ?> </label>
                                        <span class="rtwmer_lwh_span">
                                           
                                            <label class="mdc-text-field mdc-text-field--outlined">
                                                <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id="rtwmer_prod_length">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label" ><?php esc_attr_e('Length','rtwmer-mercado'); ?></span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
                                            
                                            <label class="mdc-text-field mdc-text-field--outlined">
                                                    <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id="rtwmer_prod_width">
                                                    <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                        <div class="mdc-notched-outline__leading"></div>
                                                        <div class="mdc-notched-outline__notch">
                                                        <span class="mdc-floating-label" ><?php esc_attr_e('Width','rtwmer-mercado'); ?></span>
                                                        </div>
                                                        <div class="mdc-notched-outline__trailing"></div>
                                                    </div>
                                            </label>
                                            
                                            <label class="mdc-text-field mdc-text-field--outlined">
                                                    <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id="rtwmer_prod_height">
                                                    <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                        <div class="mdc-notched-outline__leading"></div>
                                                        <div class="mdc-notched-outline__notch">
                                                        <span class="mdc-floating-label" ><?php esc_attr_e('Height','rtwmer-mercado'); ?></span>
                                                        </div>
                                                        <div class="mdc-notched-outline__trailing"></div>
                                                    </div>
                                            </label>
                                             
								        </span>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Shipping Class','rtwmer-mercado' ); ?> </label>
                                        <div class="rtwmer_select_box">
                                            <?php 
                                                $rtwmer_shipping_classes = get_terms( array('taxonomy' => 'product_shipping_class', 'hide_empty' => false ) );
                                                if( is_array($rtwmer_shipping_classes) && isset($rtwmer_shipping_classes) )
                                                {
                                                    $rtwmer_ship_class_html = '<select class="rtwmer_prod_quick_size rtwmer-select-text" id="rtwmer_prod_shipping_class">';
                                                    $rtwmer_ship_class_html .= '<option value="'.esc_attr('_no_shipping_class').'">'.esc_attr__('No shipping class','rtwmer-mercado').'</option>';
                                                    foreach($rtwmer_shipping_classes as $key)
                                                    {
                                                        $rtwmer_ship_class_html .= '<option value="'.esc_attr($key->slug).'">'.esc_html__($key->description).'</option>';
                                                    } 
                                                    $rtwmer_ship_class_html .= '</select>';
                                                    $rtwmer_ship_class_html .= '<label class="rtwmer_select_label">'.esc_html__('Shipping Class','rtwmer-mercado').'</label>';

                                            ///========"$rtwmer_ship_class_html" Variable Holds html==//                                              
                                                    echo($rtwmer_ship_class_html);
                                                }
                                            ?>
                                        </div>
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e( 'Visibility','rtwmer-mercado' ); ?> </label>
                                        <div class="rtwmer_select_box rtwmer-select-left-margin">
                                            <select class="rtwmer-select-text" required id = "rtwmer_prod_visibility">
                                                <option value="visible"><?php esc_html_e( 'Catalog & Search','rtwmer-mercado' ); ?></option>
                                                <option value="catalog"><?php esc_html_e( 'Catalog ','rtwmer-mercado' ); ?></option>
                                                <option value="search"><?php esc_html_e( 'Search','rtwmer-mercado' ); ?></option>
                                                <option value="hidden"><?php esc_html_e( 'Hidden','rtwmer-mercado' ); ?></option>
                                            </select>
                                            <label class="rtwmer_select_label"><?php esc_html_e( 'Select','rtwmer-mercado' ); ?></label>
                                        </div>
                                            <span class ="rtwmer-d-flex-enable-span">
                                                <div class="mdc-checkbox mdc-data-table__row-checkbox  mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                                                    <input type="checkbox" class="mdc-checkbox__native-control" id = "rtwmer_prod_prod_featured_slug">
                                                    <div class="mdc-checkbox__background">
                                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                            <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                        </svg>
                                                    <div class="mdc-checkbox__mixedmark"></div>
                                                    </div>
                                                    <div class="mdc-checkbox__ripple"></div>
                                                </div>
                                                <span><?php esc_html_e('Featured','rtwmer-mercado'); ?></span>
                                            </span>
                                            
                                       
                                    </li>
                                    <li class="rtwmer-d-flex">
                                        <label><?php esc_html_e('Manage Stock','rtwmer-mercado' ); ?> </label>
                                        <span class ="rtwmer-d-flex-enable-span">
                                            <div class="mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                                                <input type="checkbox" class="mdc-checkbox__native-control" id="rtwmer_prod_manage_stock">
                                                    <div class="mdc-checkbox__background">
                                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                            <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                        </svg>
                                                        <div class="mdc-checkbox__mixedmark"></div>
                                                    </div>
                                                <div class="mdc-checkbox__ripple"></div>
                                               
                                            </div> 
                                            <span><?php esc_html_e( 'Manage Stock','rtwmer-mercado' ); ?></span>
								        </span>
                                    </li>
                                    <div id="rtwmer_prod_stock_manage">
                                        <li class="rtwmer-d-flex">
                                            <label><?php esc_html_e( 'Stock qty','rtwmer-mercado' ); ?> </label>
                                            <span>
                                                <label class="mdc-text-field mdc-text-field--outlined w-100">
                                                    <input type="text" class="rtwmer_quick_edit_modal_data mdc-text-field__input" id = "rtwmer_prod_stock_qty">
                                                    <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                        <div class="mdc-notched-outline__leading"></div>
                                                        <div class="mdc-notched-outline__notch">
                                                        <span class="mdc-floating-label" ><?php esc_html_e( 'Quantity','rtwmer-mercado' ); ?></span>
                                                        </div>
                                                        <div class="mdc-notched-outline__trailing"></div>
                                                    </div>
                                                </label>
                                            </span>
                                        </li>
                                        <li class="rtwmer-d-flex">
                                            <label><?php esc_html_e( 'Backorders','rtwmer-mercado' ); ?> </label>
                                            <div class="rtwmer_select_box">
                                                <select class="rtwmer-select-text"  id = "rtwmer_prod_backorders">
                                                    <option value="no"><?php esc_html_e( 'Do not allow','rtwmer-mercado' ); ?></option>
                                                    <option value="notify"><?php esc_html_e( 'Allow, but notify customer ','rtwmer-mercado' ); ?></option>
                                                    <option value="yes"><?php esc_html_e( 'Allow','rtwmer-mercado' ); ?></option>
                                                </select>
                                                <label class="rtwmer_select_label"><?php esc_html_e( 'Backorders','rtwmer-mercado' ); ?></label>
                                             </div>
                                        </li>
                                    </div>
                                    <div id="rtwmer_prod_stock_status_div">
                                        <li class="rtwmer-d-flex">
                                            <label><?php esc_html_e( 'In stock?','rtwmer-mercado' ); ?> </label>
                                            <div class="rtwmer_select_box">
                                                <select class="rtwmer-select-text"  id = "rtwmer_prod_stock_status">
                                                    <option value="instock"><?php esc_html_e( 'In stock','rtwmer-mercado' ); ?></option>
                                                    <option value="outofstock"><?php esc_html_e( 'Out of stock ','rtwmer-mercado' ); ?></option>
                                                    <option value="onbackorder"><?php esc_html_e( 'On backorder ','rtwmer-mercado' ); ?></option>
                                                </select>
                                                <label class="rtwmer_select_label"><?php esc_html_e( 'In Stock?','rtwmer-mercado' ); ?></label>
                                             </div>
                                        </li>
                                    </div>
                                    
                                    <li>
                                        <label for = "rtwmer_prod_category" class='rtwmer_prod_cat_label'> <?php esc_html_e( 'Product Category','rtwmer-mercado' ); ?> </label>
                                        <span class="rtwmer-catagory-section">
                                            <?php 
                                            $taxonomy     = 'product_cat';
                                            $orderby      = 'name';
                                            $empty        = 0;
                                            
                                            $args = array(
                                                'taxonomy'     => $taxonomy,
                                                'orderby'      => $orderby,
                                                'hide_empty'   => $empty
                                            );
                                            
                                            $all_categories = get_categories( $args );
                                            if( is_array($all_categories) && isset($all_categories) && !empty($all_categories) )
                                            {
                                                foreach ($all_categories as $cat) {
                                                    
                                                    if( isset($cat) && is_object($cat) && !empty($cat) )
                                                    {
                                                        if( isset($cat->category_parent) && isset($cat->term_id) )
                                                        {
                                                            if($cat->category_parent == 0) {
                                                        
                                                                $category_id = $cat->term_id;

                                                                if( isset($category_id) && !empty($category_id) )
                                                                {
                                                                    ?>
                                                                        <p>
                                                                            <div class="mdc-checkbox mdc-data-table__row-checkbox ">
                                                                                <input type="checkbox" class="mdc-checkbox__native-control rtwmer_prod_post_cat" value="<?php echo esc_attr( $cat->name ); ?>" aria-labelledby="u0"><span class='rtwmer_prod_cat_display_input'><?php esc_html_e($cat->name,'rtwmer-mercado'); ?></span>
                                                                                <div class="mdc-checkbox__background">
                                                                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                                                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                                                    </svg>
                                                                                <div class="mdc-checkbox__mixedmark"></div>
                                                                                </div>
                                                                                <div class="mdc-checkbox__ripple"></div>
                                                                            </div>
                                                                        </p>
                                                                    <?php
                                                            
                                                                    $args2 = array(
                                                                        'taxonomy'     => $taxonomy,
                                                                        'parent'       => $category_id,
                                                                        'orderby'      => $orderby,
                                                                        'hide_empty'   => $empty
                                                                    );
                                                            
                                                                    $sub_cats = get_categories( $args2 );
                                                                    if( isset($sub_cats) && !empty($sub_cats)) {
                                                            
                                                                        foreach($sub_cats as $sub_category) {

                                                                            if( isset($sub_category) && !empty($sub_category) )
                                                                            {
                                                                                ?>
                                                                                    <p class="rtwmer_prod_child_cat ">
                                                                                        <div class="mdc-checkbox mdc-data-table__row-checkbox rtwmer_prod_child_cat">
                                                                                            <input type="checkbox" class="mdc-checkbox__native-control rtwmer_prod_post_cat" value="<?php echo esc_attr( $sub_category->name ); ?>" aria-labelledby="u0"><span class='rtwmer_prod_cat_display_input'><?php esc_html_e($sub_category->name,'rtwmer-mercado'); ?></span>
                                                                                            <div class="mdc-checkbox__background">
                                                                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                                                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                                                                </svg>
                                                                                            <div class="mdc-checkbox__mixedmark"></div>
                                                                                            </div>
                                                                                            <div class="mdc-checkbox__ripple"></div>
                                                                                        </div>
                                                                                    </p>
                                                                                <?php

                                                                                $args3 = array(
                                                                            'taxonomy'     => $taxonomy,
                                                                            'parent'       => $sub_category->term_id,
                                                                            'orderby'      => $orderby,
                                                                            'hide_empty'   => $empty
                                                                        );
                                                                
                                                                        $sub_cats3 = get_categories( $args3 );
                                                                        if( isset($sub_cats3) && !empty($sub_cats3) ) {
                                                                
                                                                            foreach($sub_cats3 as $sub_category3) {
                                                                                
                                                                                if( isset($sub_category3) && !empty($sub_category3) )
                                                                                {
                                                                                    ?>
                                                                                        <p class="rtwmer_prod_sub_child_cat ">
                                                                                            <div class="mdc-checkbox mdc-data-table__row-checkbox">
                                                                                                <input type="checkbox" class="mdc-checkbox__native-control rtwmer_prod_post_cat" value="<?php echo esc_attr( $sub_category3->name ); ?>" aria-labelledby="u0"><span class='rtwmer_prod_cat_display_input'><?php esc_html_e($sub_category3->name,'rtwmer-mercado'); ?></span>
                                                                                                <div class="mdc-checkbox__background">
                                                                                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                                                                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                                                                    </svg>
                                                                                                <div class="mdc-checkbox__mixedmark"></div>
                                                                                                </div>
                                                                                            <div class="mdc-checkbox__ripple"></div>
                                                                                            </div>
                                                                                        </p>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }       
                                                            }
                                                        }       
                                                    }
                                                }
                                            } ?>
                                        </span> 
                                    </li>
                                </ul>
                                <?php do_action('rtwmer_addmeta_for_quick_edit_of_product'); ?>
                            </div>
                        </div>
                    </div>
                </div>                <div class='rtwmer-modal-footer'>
                    <input type="hidden" id="rtwmer_quick_edit_update" data-id="">                                            
                    <input type="hidden" id="rtwmer_edit_update" data-id="">
                    <button type="button" id="rtwmer_prod_quick_edit_update" class="mdc-button mdc-button--raised mdc-ripple-upgraded">
                        <span class="mdc-button__label"><?php esc_html_e( 'Update','rtwmer-mercado' ); ?></span>
                        <div class="mdc-button__ripple"></div>
					</button>                       
                </div>
                
            </div>
        </div>
    </div>