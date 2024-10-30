
<!-- This file contains the code for store listing page -->

<?php

global $wp_query;

$rtwmer_number = 9;


if (isset($_COOKIE["rtwmer_store_listing_view"])) {
    $rtwmer_view_option = $_COOKIE["rtwmer_store_listing_view"];
}


if (isset($_GET)  &&  !empty($_GET) && $_GET['rtwmer_most_pop']) {

    $rtwmer_filter_cond = $_GET['rtwmer_most_pop'];

    $rtwmer_sort = "DESC";
} else {

    $rtwmer_filter_cond = 0;

    $rtwmer_sort = "ASC";
}

if (isset($_POST['rtwmer_name']) && !empty($_POST['rtwmer_name'])) {
    $rtwmer_vendor_name = sanitize_text_field($_POST['rtwmer_name']);
} else {
    $rtwmer_vendor_name = "";
}

$rtwmer_paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 

$rtwmer_offset = ($rtwmer_paged - 1) * $rtwmer_number; 


$rtwmer_users = get_users(array('role__in'    => array('rtwmer_vendor', 'administrator')));

$rtwmer_argss = array(
    'role__in'    => array('rtwmer_vendor', 'administrator'),
    'search' =>  $rtwmer_vendor_name,
    'search_columns' => array('user_login', 'user_email', 'user_nicename'),
    'orderby' => 'user_nicename',
    'offset' => $rtwmer_offset,
    'number' => $rtwmer_number,
    'order'   => $rtwmer_sort,
    'fields' => array('ID', 'user_login', 'user_nicename', 'user_email')
);

$rtwmer_vendors_list = get_users($rtwmer_argss);
$vendorss = $rtwmer_vendors_list;
if(!empty($rtwmer_vendors_list))
{
    foreach ($rtwmer_vendors_list as $vendors => $vendor) {
        $active = get_user_meta($vendor->ID, 'rtwmer_vendor_status');
        if($active[0] == 0)
        {
            unset($vendorss[$vendors]);
        }
    }
}
$rtwmer_vendors_list = $vendorss;
$rtwmer_total_users = count($rtwmer_users);

$rtwmer_total_query = count($rtwmer_vendors_list); 

$rtwmer_total_pages = ($rtwmer_total_users / $rtwmer_number); 

$rtwmer_total_pages = is_float($rtwmer_total_pages) ? intval($rtwmer_total_users / $rtwmer_number) + 1 : intval($rtwmer_total_users / $rtwmer_number);

$rtwmer_options_array  =  get_option('rtwmer_general_setting');

$rtwmer_endpoint_page = $rtwmer_options_array['rtwmer_store_url'];

if (empty($rtwmer_total_users)) {

    esc_html_e("Sorry No Vendor Available.", "rtwmer-mercado");
}
$rtwmer_stores[] = '<div class="rtwmer_store_list_map"></div>';
$rtwmer_stores[] = '<section class="rtwmer_store_section">';
$rtwmer_stores[] = '<nav>
    <div class="rtwmer-wrapper-row">';
    $rtwmer_stores[] = '<div class="rtwmer-total-showing">
            <ul class="rtwmer-store-list">';
    $rtwmer_stores[] = '<li>'.esc_html__("Total store showing: " , "rtwmer-mercado").'<span>'. $rtwmer_total_query.'</span></li>';
    $rtwmer_stores[] = '</ul>
        </div>
    <div class="rtwmer_filter_fields">
            <form method="post">
                <input type="text" name="rtwmer_name" class="rtwmer_vendor_name_field" placeholder="'.esc_html__("Search by vendor username","rtwmer-mercado").'">
                <button type="submit" name="rtwmer_submit_form" class="rtwmer_form_submit mdc-button">
                <i class="fas fa-search"></i>
                </button>
            </form>
     </div>
     <div class="rtwmer-filter-wrapper">';

   
        $rtwmer_stores[] = '<ul class="rtwmer-store-list rtwmer-listing">';
   
  
      
        $rtwmer_stores[] = '<li class="rtwmer_sort_box">
                    '. esc_html__("Sort by:", "rtwmer-mercado") .'
                    <select class="rtwmer_select_box" id="rtwmer_select_filter">
                        <option value="rtwmer_most_recent">'. esc_html__("Most Recent", "rtwmer-mercado").'</option>';
                        $rtwmer_temp_var = '<option value="rtwmer_most_pop"';
                         if ($rtwmer_filter_cond) {
                            $rtwmer_temp_var .= "selected";
                        } 
                        $rtwmer_temp_var .= '>'. esc_html__("Most popular", "rtwmer-mercado").'</option>';
                        $rtwmer_stores[] =  $rtwmer_temp_var;
                        $rtwmer_stores[] = '</select>
                </li>';
                $rtwmer_temp_var = '<li>';
                 if (!isset($rtwmer_view_option)) {
                    $rtwmer_temp_var .= "<a class='rtwmer_grid_button rtwmer_looks_buttons rtwmer_current_active'>";
                    } elseif (isset($rtwmer_view_option) && $rtwmer_view_option == "grid_view") {
                        $rtwmer_temp_var .= "<a class='rtwmer_grid_button rtwmer_looks_buttons rtwmer_current_active'>";
                    } else {
                        $rtwmer_temp_var .=  "<a class='rtwmer_grid_button rtwmer_looks_buttons'>";
                    } 
                    $rtwmer_temp_var .= '<i class="fa fa-th-large"></i>
                </a>
            </li>';
            $rtwmer_stores[] =  $rtwmer_temp_var;
            $rtwmer_temp_var = '<li class="nav-item px-3">
                <a class="rtwmer_row_button rtwmer_looks_buttons';
                 if (isset($rtwmer_view_option) && $rtwmer_view_option == "row_view") {
                    $rtwmer_temp_var .= " rtwmer_current_active";
                } 
                $rtwmer_temp_var .= '">
                <i class="fas fa-bars"></i>
            </a>
        </li>';
        $rtwmer_stores[] =  $rtwmer_temp_var;
    
    $rtwmer_stores[] = '</ul>
    </div>
</div>
</nav>';



if(isset($rtwmer_vendors_list) && !empty($rtwmer_vendors_list) && is_array($rtwmer_vendors_list)){
    $rtwmer_temp_var = '<div>
    <div class=" rtwmer_grid_look '; 
     if (isset($rtwmer_view_option) && $rtwmer_view_option == "row_view") {
        $rtwmer_temp_var .= "rtwmer_display";
    } 
    $rtwmer_temp_var .=  '">';
    $rtwmer_stores[] =  $rtwmer_temp_var;
    foreach ($rtwmer_vendors_list as $rtwmer_vendor_objec) {
        $rtwmer_single_store = [];
        $rtwmer_ven_id  =   $rtwmer_vendor_objec->ID;

        if ($rtwmer_ven_name = get_user_meta($rtwmer_ven_id, 'rtwmer_store_name', true)) {
        } else {
            $rtwmer_ven_name = "No name";
        }
        $rtwmer_ven_phone = get_user_meta($rtwmer_ven_id, 'rtwmer_phone', true);

        $rtwmer_van_nicename = $rtwmer_vendor_objec->user_nicename;

        $rtwmer_single_store[] = '<div class="rtwmer-store-prdct-box">
            <div class="rtwmer-inner-div mdc-elevation--z9"><div class="rtwmer_store_content">';
 
         $rtwmer_image = get_user_meta($rtwmer_ven_id, "rtwmer_vendor_store_img", true);

         if (!empty($rtwmer_image)) {
                         $rtwmer_single_store[] = "<div class='rtwmer-store-image'>".wp_get_attachment_image($rtwmer_image, "", "",  array("class" => "card-img rtwmer-img"))."</div>";
                    } else {
                        $rtwmer_single_store[] = "<div class='rtwmer-store-image'><img src='" . RTWMER_PUBLIC_IMAGES_URL . "store.jpg'></div>";
                    }
                    $rtwmer_single_store[] = '<span class="rtwmer-animated-check">
                    </span><div class="rtwmer_overlay">';
                    $rtwmer_single_store[] = '<a href="'. esc_url(home_url() . "/" . $rtwmer_endpoint_page . "/" . $rtwmer_van_nicename).'" class="rtwmer_vendor_name">'.
                     esc_html__($rtwmer_ven_name, "rtwmer-mercado").'
                        </a>';
                    $rtwmer_single_store[] = '<p class="store-phone rtwmer_vendor_phone">
                            <i class="fas fa-phone"></i>'. esc_html__($rtwmer_ven_phone, "rtwmer-mercado") .'
                        </p></div>';

                        $rtwmer_vendor_rating = get_user_meta($rtwmer_ven_id,"rtwmer_vendor_rating",true);
                        $rtwmer_single_store[] = $rtwmer_vendor_rating;

                       $rtwmer_store_url = $this->rtwmer_vendor_store_url();

                    $rtwmer_single_store[] = '</div>
                    <div class="rtwmer-store-footer">
                        <a href="'. esc_url(home_url() . "/" . $rtwmer_endpoint_page . "/" . $rtwmer_van_nicename)   .'" class="rtwmer-visit-btn">
                            <i class="fas fa-chevron-right"></i>
                        </a>';

                        $rtwmer_single_store[] = '<div class="rtwmer-store-img"><img src="'. get_avatar_url($rtwmer_ven_id).'" class="img-fluid rtwmer-avator rounded-circle"></div>';
                        $rtwmer_single_store[] = '</div>
                </div>  
        </div>';

        $rtwmer_single_store_html[] = apply_filters("rtwmer_single_store_grid_html",$rtwmer_single_store,$rtwmer_ven_id);
    }
}
else{
    $rtwmer_stores[] = "<div class='rtwmer_no_vendor'><i class='rtwmer_alert fa fa-exclamation-triangle' aria-hidden='true'></i>".esc_html__("No Match Found","rtwmer-mercado")."</div>";
}
    if(isset($rtwmer_single_store_html) && !empty($rtwmer_single_store_html) && is_array($rtwmer_single_store_html)){
        foreach($rtwmer_single_store_html as $rtwmer_value){
            $rtwmer_stores[] = implode("",$rtwmer_value);
        }
    }  
    
 $rtwmer_stores[] = '</div>';
$rtwmer_temp_var = '<div class="rtwmer_row_look ';
 if (!isset($_COOKIE["rtwmer_store_listing_view"])) {
    $rtwmer_temp_var .= "rtwmer_display";
    } elseif ($rtwmer_view_option == "grid_view") {
        $rtwmer_temp_var .= "rtwmer_display";
    }   
    $rtwmer_temp_var .= '">';
    $rtwmer_stores[] =  $rtwmer_temp_var;
    if(isset($rtwmer_vendors_list) && !empty($rtwmer_vendors_list) && is_array($rtwmer_vendors_list)){
        foreach ($rtwmer_vendors_list as $rtwmer_vendor_objec) {
            $rtwmer_single_store_grid = [];
            
            $rtwmer_ven_id  =   $rtwmer_vendor_objec->ID;
    
            if ($rtwmer_ven_name = get_user_meta($rtwmer_ven_id, 'rtwmer_store_name', true)) {
            } else {
                $rtwmer_ven_name = "No name";
            }
            $rtwmer_ven_phone = get_user_meta($rtwmer_ven_id, 'rtwmer_phone', true);
    
            $rtwmer_van_nicename = $rtwmer_vendor_objec->user_nicename;
    
            $rtwmer_single_store_grid[] = '<div class="rtwmer-row-look-wrapper mdc-elevation--z9">';
               
                $rtwmer_single_store_grid[] = '<div class="rtwmer-banner-image">';
    
                        $rtwmer_store_url = $this->rtwmer_vendor_store_url();
    
                        $rtwmer_single_store_grid[] = '<a href="'. esc_url($rtwmer_store_url).'">';
                        $rtwmer_image = get_user_meta($rtwmer_ven_id, "rtwmer_vendor_store_img", true);
                            if (!empty($rtwmer_image)) {
                                $rtwmer_single_store_grid[] = wp_get_attachment_image($rtwmer_image, "", "",  array("class" => "card-img rtwmer-img"));
                            } else {
                                $rtwmer_single_store_grid[] = "<img src='" . RTWMER_PUBLIC_IMAGES_URL . "store.jpg'>";
                            }
                            $rtwmer_single_store_grid[] = '</a>';
                            $rtwmer_single_store_grid[] = '
                    </div>';
                    $rtwmer_single_store_grid[] = '<div class="rtwmer-store-data-wrapper">
                        <div class="rtwmer-store-data">';
                        $rtwmer_single_store_grid[] = '<h2><a href="'. esc_url(home_url() . "/" . $rtwmer_endpoint_page . "/" . $rtwmer_van_nicename).'">'. esc_html__($rtwmer_ven_name, "rtwmer-mercado").'</a></h2>';
                             $args_top_rating1 = array(
                                'post_type' => 'product',
                                'meta_key' => '_wc_average_rating',
                                'orderby' => 'meta_value',
                                'author'  =>  $rtwmer_ven_id,
                                'posts_per_page' => -1,
                                'status' => 'publish',
                                'catalog_visibility' => 'visible',
                                'stock_status' => 'instock'
                            );
    
                            $top_rating = new WP_Query($args_top_rating1);
    
                            $rtwmer_count = 0;
                            $rtwmer_total_reviews = 0;
                            $rtwmer_total_no_of_review = 0;
                            while ($top_rating->have_posts()) : $top_rating->the_post();
                                global $product;
    
                                $urltop_rating = get_permalink($top_rating->post->ID);
    
                                $rating_count = $product->get_rating_count();
    
                                $average_rating = $product->get_average_rating();
    
                                $rtwmer_total_reviews  =  $average_rating + $rtwmer_total_reviews;
    
                                $rtwmer_total_no_of_review = $rating_count + $rtwmer_total_no_of_review;
                                if (!empty($rating_count)) {
                                    $rtwmer_count++;
                                }
    
                            endwhile;
                            if (!empty($rtwmer_count)) {
    
                                $rtwmer_reviews = $rtwmer_total_reviews / $rtwmer_count;
    
                                $rtwmer_single_store_grid[] =  wc_get_rating_html($rtwmer_reviews, $rtwmer_total_no_of_review);
                            } else {
                                $rtwmer_single_store_grid[] = esc_html__("The vendor is not rated yet", "rtwmer-mercado");
                            }  
                            $rtwmer_single_store_grid[] = '</div>
                </div>';
    
                $rtwmer_single_store_grid[] = '<div class="rtwmer-button">
                <div class="rtwmer-btn">';
                $rtwmer_single_store_grid[] = '<a href="'. esc_url(home_url() . "/" . $rtwmer_endpoint_page . "/" . $rtwmer_van_nicename).'" class="rtwmer-visit-btn">
                        <i class="fas fa-chevron-right"></i>
                    </a>';
                    $rtwmer_single_store_grid[] = '</div>
           </div>
           </div>';
           $rtwmer_single_store_grid_html[] = apply_filters("rtwmer_single_store_list_html",$rtwmer_single_store_grid,$rtwmer_ven_id);
             } 
    }
   

         if(isset($rtwmer_single_store_grid_html) && !empty($rtwmer_single_store_grid_html) && is_array($rtwmer_single_store_grid_html)){
            foreach($rtwmer_single_store_grid_html as $rtwmer_value){
                $rtwmer_stores[] = implode("",$rtwmer_value);
            }
         }
      
         $rtwmer_stores[] = '</div>';
  
    if (empty($_POST['rtwmer_name'])) {
        if ($rtwmer_total_users > $rtwmer_total_query) {
            $rtwmer_temp_var = '<div id="rtwmer_ven_pagination" class="clearfix">';
            $current_page = max(1, get_query_var('paged'));
            $rtwmer_temp_var .= paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%/',
                'current' => $current_page,
                'total' => $rtwmer_total_pages,
                'prev_next' => true,
                'type' => 'list',
            ));
        }
        $rtwmer_temp_var .= '</div>';
        $rtwmer_stores[] = $rtwmer_temp_var;
    }

$rtwmer_stores[] = '</div></section>';

$rtwmer_store_html = implode("",$rtwmer_stores);
