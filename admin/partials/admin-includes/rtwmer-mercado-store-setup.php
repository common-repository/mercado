<?php 

    //============This File includeds details for setup the store page when plugin activated first time=============//

    if( isset($_GET['rtwmer_action']) && !empty($_GET['rtwmer_action']) )
    {
        if( $_GET['rtwmer_action'] == 'rtwmer_store_setup' )
        {
                $rtwmer_mercado_home_url = add_query_arg( array(

                    'page' => 'rtwmer-mercado#dashboard'

                ),admin_url('admin.php'));

            ?>

            <div class="rtwmer_store_page_section"> 

                <div class="rtwmer-welcome-page">

                    <div class="rtwmer_setup_welcome_page">

                        <div>

                            <h4><?php esc_html_e('Welcome to Mercado Multivendor Marketplace!','rtwmer-mercado'); ?></h4>  

                            <p><?php esc_html_e('Thank you for choosing Mercado to create your marketplace with! This is a short section to setup your marketplace with Mercado.','rtwmer-mercado'); ?><span><?php esc_html_e('Its completely optional and should not take longer than three minutes'); ?></span></p>

                            <p><?php esc_html_e('Not right now, No worry, if you do not want to do it for now, come back later, we will love to help you for setup your multivendor Marketplace ','rtwmer-mercado'); ?></p>

                            <h5><a class='rtwmer_store_not_right_btn' href="<?php echo isset($rtwmer_mercado_home_url) ? esc_url($rtwmer_mercado_home_url) : ""; ?>"><?php esc_html_e('Not Right Now','rtwmer-mercado'); ?></a><span><a href="#" class='mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer_launch_setup_btn'><?php esc_html_e("Let's Go",'rtwmer-mercado'); ?></a></span></h5>

                        </div>

                    </div>

                    <div class="rtwmer_store_setup_menus">

                        <p><span class="rtwmer_store_setup_general_tab"><?php esc_html_e('General','rtwmer-mercado'); ?></span><span class="rtwmer_store_setup_seeling_options_tab"><?php esc_html_e('Selling Options','rtwmer-mercado'); ?></span><span class="rtwmer_store_setup_withdraw_options_tab"><?php esc_html_e('Withdraw Options','rtwmer-mercado'); ?></span><span class="rtwmer_store_appreance_tab"><?php esc_html_e('Appearence','rtwmer-mercado'); ?></span></p>

                    </div>

                    <?php

                        include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-general-setting.php' );

                        include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-selling-option.php' );

                        include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-withdraw-option.php' );

                        include_once( RTWMER_ADMIN_PARTIAL_SUBMENU.'rtwmer-mercado-appearence.php' );

                    ?>

                </div>

            </div>

            <?php

            do_action('rtwmer_store_setup_page_intro');

        }

    }

?>