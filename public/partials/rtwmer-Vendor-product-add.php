<?php

// This file contains the html for the add producdt section
global $rtwmer_user_id_for_dashboard;
$rtwmer_modal_permission = get_option('rtwmer_selling_page', array());

$args = array(
    "id"        => "rtwmer_category",
    "name"      => "category",
    "class"     => "rtwmer_product_multiple_data",
    "option_none_value" => "",
    "show_option_none" => "Select category",
    "taxonomy"     => "product_cat",
    "orderby"      => "name",
    "show_count"   => 0,
    "pad_counts"   => 0,
    "hierarchical" => 1,
    "title_li"     => '',
    "hide_empty"   => 0,
    "echo"   => 0
);
$args = apply_filters("rtwmer_add_product_category", $args);
$rtwmer_category_drop = wp_dropdown_categories($args);
$rtwmer_content   = '';
$rtwmer_editor_id = 'rtwmer_short_description_field';
$rtwmer_argsss = array(
    'tinymce'       => array(
        'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo'
    ),
);
ob_start();
wp_editor($rtwmer_content, $rtwmer_editor_id, $rtwmer_argsss);
$rtwmer_wp_editor = ob_get_clean();

$rtwmer_main_image = '<div class="rtwmer-row">
        <div class="rtwmer-image-add-wrapper">
            <div class="rtwmer_card">
                <div class="rtwmer_card_header">' . esc_html__("Product Image", "rtwmer-mercado") . '</div>
                <div class="rtwmer_card_body">
                    <div class="rtwmer-image-add">
                        <img id="rtwmer-image-preview" src="">
                        <div class="rtwmer_remove_prod_image">
                            <span class="rtwmer_remove_prod_img material-icons">clear</span>
                        </div>
                        <div class="rtwmer_upload_box">
                            <input id="rtwmer-upload_image_button" name="rtwmer_image_upload" type="button" class="mdc-button mdc-button--raised mdc-button--upgraded" value=" ' . esc_html__("Upload image", "rtwmer-mercado") . '" />
                            <input type="hidden" name="rtwmer-image_attachment_id" id="rtwmer-image_attachment_id" value="">
                            <input type="hidden" name="rtwmer_product_id" id="rtwmer_product_id" value="">
                        </div>
                    </div>
                </div>
            </div>';
$rtwmer_main_image = apply_filters("rtwmer_add_gallery_html", $rtwmer_main_image);
$rtwmer_purchase_code_details = get_option('rtwmer_verification_done'); 

if (is_plugin_active('rtwmer-mercado-pro/rtwmer-mercado-pro.php')) { 
		if ($rtwmer_purchase_code_details) {
			 $rtwmer_html = array();
             global $wc_product_attributes;

		$rtwmer_type_box = '<div class="rtwmer_form_group"><label class="rtwmer_form_field_label rtwmer_design_ptype">' . esc_html__("Product Type", "rtwmer-mercado-pro") . '</label><select id ="rtwer_prod_type" name="rtwer_prod_type" class="rtwmer_product_data">
			<option></option>
			<option value="Simple">' . esc_html__("Simple", "rtwmer-mercado-pro") . '</option>
			<option value="Grouped">' . esc_html__("Grouped", "rtwmer-mercado-pro") . '</option>
			<option value="Variable">' . esc_html__("Variable", "rtwmer-mercado-pro") . '</option>
			</select></div>';
		
		array_splice($rtwmer_html, 1, 0, $rtwmer_type_box);
		}
    }
    if(empty($rtwmer_type_box)){
        $rtwmer_type_box = '';
    }
$rtwmer_price_schedule = ' </div>
        <div class="rtwmer-upper-input-fields">
            <div class="rtwmer_card">
                <div class="rtwmer_card_header">' . esc_html__("General Information", "rtwmer-mercado") . '</div>
                <div class="rtwmer_card_body">
                    <div class="rtwmer_form_group">
                        <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                            <input type="text" name="product_name" class="mdc-text-field__input" id="rtwmer_product_name">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                <div class="mdc-notched-outline__leading"></div>
                                <div class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label"> ' . esc_attr__("Product Name", "rtwmer-mercado") . '</span>
                                </div>
                                <div class="mdc-notched-outline__trailing"></div>
                            </div>
                        </label>
                    </div>
                    <div class="rtwmer-d-flex rtwmer-justify-between rtwmer_align_items_stretch">
                        <div class="rtwmer-upper-input-field1 input-fields">
                            <div class="rtwmer-d-flex rtwmer_align_items_stretch">
                                <div class="rtwmer-doller-box">
                                    <label>' . get_woocommerce_currency_symbol() . '</label>
                                </div>
                                <label class="mdc-text-field mdc-text-field--outlined rtwmer-prdct-price-label">
                                    <input type="number" class="mdc-text-field__input noscroll" id="rtwmer_product_price">
                                    <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                        <div class="mdc-notched-outline__leading border-radius-0"></div>
                                        <div class="mdc-notched-outline__notch">
                                        <span class="mdc-floating-label">' . esc_html__("Regular Price", 'rtwmer-mercado') . '</span>
                                        </div>
                                        <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                </label>
                            </div>    
                        </div>
                        <div class="rtwmer-upper-input-field2 input-fields">
                            <div class="rtwmer-d-flex rtwmer_align_items_stretch">
                                <div class="rtwmer-doller-box">
                                    <label>' . get_woocommerce_currency_symbol() . '</label>
                                </div>
                                <label class="mdc-text-field mdc-text-field--outlined rtwmer-prdct-price-label">
                                    <input type="number" class="mdc-text-field__input" id="rtwmer_discounted-price">
                                    <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                        <div class="mdc-notched-outline__leading border-radius-0"></div>
                                        <div class="mdc-notched-outline__notch">
                                        <span class="mdc-floating-label">' . esc_html__("Sale Price", 'rtwmer-mercado') . '</span>
                                        </div>
                                        <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                </label>
                            </div> 
                            <a href="#" id="rtwmer_schedule_button" class="rtwmer-product_buttons Schedule">
                            ' . esc_html__("Schedule", "rtwmer-mercado") . '
                            </a>
                            <a href="#" id="rtwmer_schedule_cancel_button" class="rtwmer-product_buttons schedule_cancel">X</a>
                            <div class="rtwmer_schedule_box">
                                <div class="rtwmer-schedule-from">
                                    <span class="rtwmer-doller-box2">
                                        <label>' . esc_html__("From", "rtwmer-mercado") . '</label>
                                    </span>
                                    <input type="text" id="rtwmer_schedule_from" name="from_date" placeholder="' . esc_attr__("DD/MM/YYYY", "rtwmer-mercado") . '">
                                </div>
                                <div class="rtwmer-schedule-to">
                                    <span class="rtwmer-doller-box2">
                                        <label>' . esc_html__("To", "rtwmer-mercado") . '</label>
                                    </span>
                                    <input type="text" id="rtwmer_schedule_to" name="to_date" placeholder="' . esc_attr__("DD/MM/YYYY", "rtwmer-mercado") . '">
                                </div>
                            </div>
                        </div>
                    </div>'.$rtwmer_type_box.'
                    
                    <div class="rtwmer_form_group">
                        <label class="rtwmer_form_field_label">' . esc_html__("Select Category", "rtwmer-mercado-pro") . '</label>
                        '.$rtwmer_category_drop.'
                    </div>';
           

                    $rtwmer_price_schedule .= '<div class="rtwmer_form_group">';
                    $rtwmer_tags = '<label class="rtwmer_form_field_label">' . esc_html__("Select Tags", "rtwmer-mercado-pro") . '</label><select id="rtwmer_product_tags" multiple="multiple">';

                    $rtwmer_tags .= '<option></option>';
                    $rtwmer_term = get_terms(array(
                        'taxonomy' => 'product_tag',
                        'hide_empty' => false,
                    ));
                    $term_array = array();
                    if (!empty($rtwmer_term) && !is_wp_error($rtwmer_term)) {
                        foreach ($rtwmer_term as $term) {
                    
                            $term_array[$term->term_id] = $term->name;
                        }
                    }
                    foreach ($term_array as $rtwmer_tag_id => $rtwmer_tag) {
                        $rtwmer_tags .= '<option value=' . $rtwmer_tag_id . '>' . $rtwmer_tag . '</option>';
                    }
                    $rtwmer_tags .= "</select>";
                        
                    $rtwmer_price_schedule .= '
                    ' . $rtwmer_tags . '</div>
                    <div class="rtwmer_form_group">
                        <label class="rtwmer_form_field_label">' . esc_html__("Product Descriptions", "rtwmer-mercado-pro") . '</label>
                        <label class="mdc-text-field mdc-text-field--textarea mdc-text-field--no-label rtwmer-w-100">
                            <textarea class="mdc-text-field__input" aria-label="Label" placeholder="' . esc_attr__("Description", "rtwmer-mercado") . '" id="rtwmer_description"></textarea>
                            <span class="mdc-notched-outline mdc-notched-outline--no-label">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="rtwmer_endsec">
                <span id="warning"></span>
                <a class="rtwmer-Create_new" href="#product">
                    ' . esc_html__("Add More Details", "rtwmer-mercado") . '
                </a>
                <input_type="hidden" class="rtwmer_prod_new" id="rtwmer_prod_exist">
                <a id="rtwmer-create-product" class="rtwmer-create_add_new" data-id="' . $rtwmer_user_id_for_dashboard . '" href="">
                    ' . esc_html__("Create & Add _New", "rtwmer-mercado") . '
                </a>
            </div>
        </div>
    </div>';

$rtwmer_price_schedule = apply_filters("rtwmer_add_gallery_section", $rtwmer_price_schedule);


$rtwmer_prod_array[] = '<div class="rtwmer_prdct_top_fields">' . $rtwmer_main_image . $rtwmer_price_schedule . '</div>';

$rtwmer_prod_array[] = '<div class="rtwmer-lower-input-fields">';

// $rtwmer_term = get_terms(array(
//     'taxonomy' => 'product_tag',
//     'hide_empty' => false,
// ));
// $term_array = array();
// if (!empty($rtwmer_term) && !is_wp_error($rtwmer_term)) {
//     foreach ($rtwmer_term as $term) {

//         $term_array[$term->term_id] = $term->name;
//     }
// }
// $rtwmer_tags = '<label class="rtwmer_design_label rtwmer_design_ptype">' . esc_html__("Select Tags", "rtwmer-mercado-pro") . '</label><select id="rtwmer_product_tags" multiple="multiple">';

// $rtwmer_tags .= '<option></option>';

// foreach ($term_array as $rtwmer_tag_id => $rtwmer_tag) {
//     $rtwmer_tags .= '<option value=' . $rtwmer_tag_id . '>' . $rtwmer_tag . '</option>';
// }
// $rtwmer_tags .= "</select><p>
// ' . $rtwmer_tags . '
// </p>";


// $rtwmer_prod_array[] = '<div class="rtwmer_endsec">
//                         <span id="warning"></span>
//                         <a class="rtwmer-Create_new" href="#product">
//                             ' . esc_html__("Add More Details", "rtwmer-mercado") . '
//                         </a>
//                         <input_type="hidden" class="rtwmer_prod_new" id="rtwmer_prod_exist">
//                         <a id="rtwmer-create-product" class="rtwmer-create_add_new" data-id="' . $rtwmer_user_id_for_dashboard . '" href="">
//                               ' . esc_html__("Create & Add _New", "rtwmer-mercado") . '
//                         </a>
//                     </div>';
$rtwmer_prod_array[] = '<div class="rtwmer-add-product-div2">
                            <div class="rtwmer_card">
                                <div class="rtwmer_card_header">' . esc_html__("Extra Details", "rtwmer-mercado") . '</div>';
$rtwmer_prod_array[] = '<div class="rtwmer_card_body">
                                <div class="rtwmer-short_description mdc-elevation--z5">
                                    <h3 class="rtwmer-sub-heading">
                                    ' . esc_html__("Product type and Short description", "rtwmer-mercado") . '
                                    </h3>
                                    <div class="rtwmer-product-head">
                                        <div class="rtwmer-product-type">
                                            <div class="rtwmer-download-type">
                                            
                                                <div class="mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                                                    <input type="checkbox"  class="mdc-checkbox__native-control" id="rtwmer-downloadable" aria-labelledby="u0">
                                                    <div class="mdc-checkbox__background">
                                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                            <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                        </svg>
                                                        <div class="mdc-checkbox__mixedmark"></div>
                                                    </div>
                                                    <div class="mdc-checkbox__ripple"></div>
                                                </div>
                                                <span>' . esc_html__("Download", "rtwmer-mercado") . '</span>
                                            </div>
                                            <div class="rtwmer-virtual-type">
                                                <div class="mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                                                    <input type="checkbox"  class="mdc-checkbox__native-control" id="rtwmer-virtual" aria-labelledby="u0">
                                                    <div class="mdc-checkbox__background">
                                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                            <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                        </svg>
                                                        <div class="mdc-checkbox__mixedmark"></div>
                                                    </div>
                                                    <div class="mdc-checkbox__ripple"></div>
                                                </div>
                                                <span>' . esc_html__("Virtual", "rtwmer-mercado") . '</span>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rtwmer_prdct_short_desc_wrapper">
                                        <span>
                                        ' . esc_html__("Short_Description", "rtwmer-mercado") . '
                                        </span>
                                        ' .  $rtwmer_wp_editor . '
                                    </div>
                                </div>';
$rtwmer_prod_array[] = '<div class="rtwmer_inventory_box mdc-elevation--z5">
                                <div class="rtwmer_inventory">
                                    <h3 class="rtwmer-sub-heading">
                                        ' . esc_html__("Invenory", "rtwmer-mercado") . '
                                    </h3>
                                    <label class="rtwmer_small_heading">
                                        <?php esc_html__("Manage inventory for this product.", "rtwmer-mercado") ?>
                                    </label>
                                </div>';
$rtwmer_prod_array[] = '<div class="rtwmer_SKU">
                                        <label>
                                            ' . esc_html__("SKU", "rtwmer-mercado") . '
                                            <span>
                                                (' . esc_html__("Stock Keeping Unit", "rtwmer-mercado") . ')
                                            </span>
                                        </label>
                                        <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                                        <input type="text" name="product_name" class="mdc-text-field__input" id="rtwmer_sku_field">
                                        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                            <div class="mdc-notched-outline__leading"></div>
                                            <div class="mdc-notched-outline__notch">
                                            <span class="mdc-floating-label"> ' . esc_attr__("sku", "rtwmer-mercado") . '</span>
                                            </div>
                                            <div class="mdc-notched-outline__trailing"></div>
                                        </div>
                                    </label>
                                    </div>';
$rtwmer_prod_array[] = '<div class="rtwmer_stock_status">
                                        <label>
                                            ' . esc_html__("Stock status", "rtwmer-mercado") . '
                                        </label>
                                        <select id="rtwmer_stock_status">
                                            <option value="' . esc_attr__("instock", "rtwmer-mercado") . '" selected="selected">
                                                ' . esc_html__("In Stock", "rtwmer-mercado") . '
                                            </option>
                                            <option value="' . esc_attr__("outstock", "rtwmer-mercado") . '">
                                                ' . esc_html__("Out of Stock", "rtwmer-mercado") . '
                                            </option>
                                            <option value="' . esc_attr__("backorder", "rtwmer-mercado") . '">
                                                ' . esc_html__("Back order", "rtwmer-mercado") . '
                                            </option>
                                        </select>
                                    </div>';

///////////////////  custom code starts  ///////////////////

$rtwwcfp_html = '';
$rtwwcfp_html = apply_filters( 'rtwmer_extar_products_fields_html',  $rtwwcfp_html );

$rtwmer_prod_array[] = $rtwwcfp_html;
                                   

/////////////////////// custom code ends here  /////////////////////////

$rtwmer_prod_array[] = '<div class="rtwmer-virtual-type">
                                    <div class="mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                                        <input type="checkbox"  class="mdc-checkbox__native-control" id="rtwmer_stock_manage" aria-labelledby="u0">
                                        <div class="mdc-checkbox__background">
                                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                            </svg>
                                            <div class="mdc-checkbox__mixedmark"></div>
                                        </div>
                                        <div class="mdc-checkbox__ripple"></div>
                                    </div>
                                    <span> ' . esc_html__("Enable product stock management", "rtwmer-mercado") . '</span>
                                </div>';

   $rtwmer_prod_array[] = '<div class="rtwmer-virtual-type">
                                    <div class="mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                                        <input type="checkbox"  class="mdc-checkbox__native-control" id="rtwmer_single_product_permission" aria-labelledby="u0">
                                        <div class="mdc-checkbox__background">
                                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                            </svg>
                                            <div class="mdc-checkbox__mixedmark"></div>
                                        </div>
                                        <div class="mdc-checkbox__ripple"></div>
                                    </div>
                                    <span>' . esc_html__("Allow only one quantity of this product to be bought in a single order", "rtwmer-mercado") . '</span>
                                </div>      
                        </div>';
$rtwmer_prod_array[] = '<div class="rtwmer_downloadable_box mdc-elevation--z5">
                                    <h3 class="rtwmer-sub-heading">' . esc_html__("Downloadable Options", "rtwmer-mercado")  . '</h3>
                                    <div class="rtwmer-downlodable_prod">
                                        <div id="rtwmer_prod_download_file">
                                        </div>
                                        <div class="rtwmer_downloadable_prod">
                                         <input name="rtwmer_upload[]" type="button" class="rtwmer-prod_upload_file button mdc-button mdc-button--raised mdc-button--upgraded" value="' . esc_html__("Add file", "rtwmer-mercado") . '" /> <p class="rtwmer_info">'. esc_html__("More than one file can be attached", "rtwmer-mercado") . '</p>
                                    </div>
                                    <div class="rtwmer_download_limit_box">
                                        <label class="rtwmer_down_lim_label" for="rtwmer_download_limit">' . esc_html__("Download limit", "rtwmer-mercado") . '</label>
                                        <span>
                                            <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                                                <input type="text" class="mdc-text-field__input rtwmer_prod_download_limit"  name="rtwmer_download_limit">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label">' . esc_attr__("download limit", "rtwmer-mercado") . '</span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
                                        </span>
                                    </div>
                                    <div class="rtwmer_download_expiry_box">
                                       <label class="rtwmer_down_exp_label" for="rtwmer_download_expiry">' . esc_html__("Download expiry", "rtwmer-mercado") . '</label>
                                       <span>
                                            <label class="mdc-text-field mdc-text-field--outlined rtwmer-w-100">
                                                <input type="text" class="mdc-text-field__input rtwmer_prod_download_expiry"  name="rtwmer_download_expiry">
                                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                                    <div class="mdc-notched-outline__leading"></div>
                                                    <div class="mdc-notched-outline__notch">
                                                    <span class="mdc-floating-label">' . esc_attr__("download expiry", "rtwmer-mercado") . '</span>
                                                    </div>
                                                    <div class="mdc-notched-outline__trailing"></div>
                                                </div>
                                            </label>
                                            <p> ' . esc_html__("Enter the number of days before a download link expires, or leave blank.", "rtwmer-mercado") . ' </p>
                                        </span>
                                       
                                    </div>
                               </div>
                           </div>';
$rtwmer_prod_array[] = '<div class="rtwmer_other_options_fields mdc-elevation--z5">
                            <h3 class="rtwmer-sub-heading">
                            ' . esc_html__("Set your extra product options", "rtwmer-mercado") . '
                            </h3>';
$rtwmer_prod_array[] =   ''; 
$rtwmer_prod_array[] =  '<div class="rtwmer_stock_status">
                                <label>
                                    ' . esc_html__("Visibility", "rtwmer-mercado") . '
                                </label>
                                <select id="rtwmer_visibility">
                                    <option value="' . esc_attr__("Visible", "rtwmer-mercado") . '" selected="selected">
                                        ' . esc_html__("Visible", "rtwmer-mercado") . '
                                    </option>
                                    <option value="' . esc_attr__("Catalog", "rtwmer-mercado") . '">
                                        ' . esc_html__("Catalog", "rtwmer-mercado") . '
                                    </option>
                                    <option value="' . esc_attr__("Search", "rtwmer-mercado") . '">
                                        ' . esc_html__("Search", "rtwmer-mercado") . '
                                    </option>
                                    <option value="' . esc_attr__("Hidden", "rtwmer-mercado") . '">
                                        ' . esc_html__("Hidden", "rtwmer-mercado") . '
                                    </option>
                                </select>
                            </div>';
$rtwmer_prod_array[] = '<div class="rtwmer_purchase_note">
                            <label>
                                ' . esc_html__("Purchase Note", "rtwmer-mercado") . '
                            </label>
                            <label class="mdc-text-field mdc-text-field--textarea mdc-text-field--no-label rtwmer-w-100">
                                <textarea class=" mdc-text-field__input" aria-label="Label" id="rtwmer_purchase_note_field"></textarea>
                                <span class="mdc-notched-outline mdc-notched-outline--no-label">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                            </label>
                        </div>
                        <div class="rtwmer_product_review">
                            <span class="rtwmer_product_review_field">
                                <div class="rtwmer-virtual-type">
                                    <div class="mdc-checkbox mdc-data-table__row-checkbox mdc-checkbox--upgraded mdc-ripple-upgraded mdc-ripple-upgraded--unbounded">
                                        <input type="checkbox" name="product_reviews"  class="mdc-checkbox__native-control" id="rtwmer_product_reviews" aria-labelledby="u0">
                                        <div class="mdc-checkbox__background">
                                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                            </svg>
                                            <div class="mdc-checkbox__mixedmark"></div>
                                        </div>
                                        <div class="mdc-checkbox__ripple"></div>
                                    </div>
                                    <span>' . esc_html__("Enable product reviews", "rtwmer-mercado") . '</span>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="button" name="submit" id="rtwmer_product_add" class="mdc-button mdc-button--raised mdc-ripple-upgraded" value="Submit">
        </div>';
      

         $rtwmer_prod_array = apply_filters("rtwmer_product_html_array", $rtwmer_prod_array);

         if (isset($rtwmer_modal_permission['rtwmer_disable_product_popup']) && $rtwmer_modal_permission['rtwmer_disable_product_popup'] != 1) { 
   
?>


    <div class="rtwmer_modal" id="rtwmer_prdct_modal">
        <div class="rtwmer-modal-dialog">
            <div class="rtwmer-modal-content">
                <div class="rtwmer-modal-header">
                    <h4 class="rtwmer-modal-title">
                        <?php esc_html_e("Add New Product", "rtwmer-mercado") ?>
                    </h4>
                    <a class=" rtwmer_close_product_modal rtwmer-modal-close mdc-icon-button material-icons mdc-ripple-upgraded rtwmer-modal-close mdc-ripple-upgraded--unbounded mdc-icon-button--on" aria-pressed="true">highlight_off</a>
                </div>

                <div class="rtwmer-modal-body">
                    <?php
                    if (isset($rtwmer_prod_array) && !empty($rtwmer_prod_array)) {
                       
                        foreach ($rtwmer_prod_array as $key => $value) {
                         
                     
                            echo $value;    // This variable holds html
                        }
                        // die('zzz');
                    }
                    ?>
                </div>
            </div>
            <div class="rtwmer-modal-footer">
                <button type="button" class="rtwmer-modal-close rtwmer_close_product_modal mdc-button mdc-button--raised rtwmer-footer-btn" data-dismiss="modal">
                    <?php esc_html_e("Close", "rtwmer-mercado") ?>
                </button>
            </div>
        </div>
    </div>
    <!-- end modal -->
    </div>
<?php
} else { ?>



    <!--====================================== body for no modal =========================================== -->


    <div class="rtwmer_no_modal_add_prod mdc-elevation--z9">
        <div class="rtwmer_no_modal_head">
            <h4>
                <?php esc_html_e("Add New Product", "rtwmer-mercado") ?>
            </h4>
        </div>
        <div class="rtwmer_no_modal_body">
            <?php
            if (isset($rtwmer_prod_array) && !empty($rtwmer_prod_array)) {
                foreach ($rtwmer_prod_array as $key => $value) {
                    echo $value;    // This variable holds html
                }
            }
            ?>
        </div>
    </div>
    <div class="rtwmer_go_back">
        <button class="rtwmer_back_prod mdc-button mdc-button--raised mdc-button--upgraded">
            <?php esc_html_e("Back", "rtwmer-mercado") ?>
        </button>
    </div>
    </div>
<?php
}
?>
