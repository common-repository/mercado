<?php

/**
 * 
 *
 * This is the template for Vendor store setup And vendor store page which can override any theme template
 *
 * 
 *
 * 
 */
global $rtwmer_user_id_for_dashboard;
$rtwmer_user_meta = get_user_meta(get_current_user_id(), "rtwmer_vendor_store_setup", true);
$user_meta = get_userdata($rtwmer_user_id_for_dashboard);
$roles = $user_meta->roles;
if ($roles[0] != 'administrator') {
    if (current_user_can("mercador")) {
        if (filter_var($rtwmer_user_meta, FILTER_VALIDATE_BOOLEAN)) {
?>   <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta content="width=device-width, initial-scale=1.0" name="viewport">
               
                <?php wp_head(); ?>
            </head>
            <div class="rtwmer-home-wrap">
                <div class="rtwmer-site-title">
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')) ?>"><?php bloginfo('name'); ?></a>
                </div>
                <?php do_action("rtwmer_template_header"); ?>
                <div class="rtwmer-toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="rtwmer-back">
                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="rtwmer-Url">
                        <span class="material-icons">home</span>
                    </a>
                </div>
            </div>
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            wp_footer();
       
            ?>
              <!-- <script type="text/javascript" id="bundleJs-js" src="<?php // echo RTWMER_ASSETS_BUNDLE_JS .'js/bundle.js?ver=2.1.0'; ?>"></script> -->
            </html>
        <?php
        } else {
        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <?php wp_head(); ?>
            </head>

            <body class="rtwmer_store_setup_body">
                <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
                wp_footer();
                ?>
               
            </body>

            </html>
<?php
        }
    } else {
        $rtwmer_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
        header("Location:" . $rtwmer_link);
    }
} else {
    wp_die(__('Sorry, you are not authorized to access this page.'));
} ?>