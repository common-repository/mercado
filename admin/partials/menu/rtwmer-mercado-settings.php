<!-- This page is to to show setting section at admin end-->
<!-- <div class="rtwmer-setting-section"> -->
    <?php 
    // File to include for all sub section of setting section
    
    include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-general-setting.php' );
    include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-selling-option.php' );
    include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-withdraw-option.php' );
    include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-payment-gateway.php' );
    include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-page-setting.php' );
    include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-appearence.php' );
    include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-privacy-policy.php' );
    do_action('rtwmer_setting_submenu_add_file_or_content');

    ?>
    
<!-- </div> -->
 