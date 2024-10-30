
<!-- This file contains the html for the payment section -->
<?php global $rtwmer_user_id_for_dashboard; ?>
<div class="rtwmer-payment-section-wrapper">
    <?php
    $rtwmer_payment_html[] = '<h4 class="rtwmer_section_heading">'. esc_html__("Payment Settings", "rtwmer-mercado") .'</h4>';
    $rtwmer_payment_html[] = '<p class="rtwmer-text-margin">
            '. esc_html__("These are the withdraw methods available for you. Please update your payment information below to submit withdraw requests and get your store payments seamlessly.", "rtwmer-mercado")  .'
    </p><div class="mdc-elevation--z4 rtwmer-payment-input-box">';
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
    $rtwmer_payment_html[] = '<ul class="rtwmer_payment_tabs_list">';
    $rtwmer_payment_html[] =  '<div class="rtwmer_tab_slider"></div>';
    if( $rtwrre_paypal ){
    $rtwmer_payment_html[] = '<li><a href="#payment?paypal" data-section="rtwmer_paypal_field" class="rtwmer_tab_active rtwmer_payment_tab rtwmer_paypal_menu">'.esc_html__("Paypal","rtwmer-mercado").'</a></li>';
    }
    if( $rtwrre_stripe ){
    $rtwmer_payment_html[] = '<li><a href="#payment?stripe" data-section="rtwmer_stripe_field" class="rtwmer_payment_tab rtwmer_stripe_menu">'.esc_html__("Stripe","rtwmer-mercado").'</a></li>';
    }
    if( $rtwrre_bank_transfer ){
    $rtwmer_payment_html[] = '<li><a href="#payment?bank" data-section="rtwmer_bank_field" class="rtwmer_payment_tab rtwmer_bank_menu">'.esc_html__("Bank","rtwmer-mercado").'</a></li>';
    }
    $rtwmer_payment_html[] = '</ul>';
      if( $rtwrre_paypal ){
        $rtwmer_payment_html[] = '<div class="rtwmer-input-padding rtwmer_paypal_field">
        <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
            <input class="mdc-text-field__input" id="rtwmer_payment_paypal_email" name="paypal" 
            value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_paypal_email",true)) .'">
            <div class="mdc-line-ripple"></div>
            <label class="mdc-floating-label">'. esc_html__("Paypal Email", "rtwmer-mercado")  .'</label>
        </div>
    </div>';
      }
      if( $rtwrre_stripe ){
             $rtwmer_payment_html[] = '<div class="rtwmer-input-padding rtwmer_stripe_field">
        <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
            <input class="mdc-text-field__input" id="rtwmer_payment_stripe_id" name="paypal" 
            value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_stripe_id",true)) .'">
            <div class="mdc-line-ripple"></div>
            <label class="mdc-floating-label">'. esc_html__("Stripe ID", "rtwmer-mercado")  .'</label>
        </div>
     </div>';
      }
        if( $rtwrre_bank_transfer ){
            $rtwmer_payment_html[] = '<div class="rtwmer-input-padding rtwmer_bank_field">
            <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
                <input class="mdc-text-field__input  " id="rtwmer_payment_account_name" name="account_name" value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_bank_account_name",true)) .'">
                <div class="mdc-line-ripple"></div>
                <label class="mdc-floating-label">'. esc_attr__("Account name","rtwmer-mercado").'</label>
            </div>
        </div>';
        $rtwmer_payment_html[] =  '<div class="rtwmer-input-padding rtwmer_bank_field">
            <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
                <input class="mdc-text-field__input" id="rtwmer_payment_account_no" class=" " name="account_no"
                value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_bank_account_no",true)) .'">
                <div class="mdc-line-ripple"></div>
                <label class="mdc-floating-label">'. esc_attr__("Account no","rtwmer-mercado").'</label>
            </div>
        </div>';
        $rtwmer_payment_html[] = '<div class="rtwmer-input-padding rtwmer_bank_field">
            <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
                <input class="mdc-text-field__input  " id="rtwmer_payment_bank_name"  name="bank_name"  
                value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_bank_name",true)) .'">
                <div class="mdc-line-ripple"></div>
                <label class="mdc-floating-label">'. esc_attr__("Bank name","rtwmer-mercado").'</label>
            </div>
        </div>';
        $rtwmer_payment_html[] = '<div class="rtwmer-input-padding rtwmer_bank_field">
            <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
                <input class="mdc-text-field__input  " id="rtwmer_payment_bank_place"  name="bank_place" 
            value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_bank_address",true)) .'">
                <div class="mdc-line-ripple"></div>
                <label class="mdc-floating-label">'. esc_attr__("Bank place","rtwmer-mercado").'</label>
            </div>
        </div>';
        $rtwmer_payment_html[] = '<div class="rtwmer-input-padding rtwmer_bank_field">
            <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
                <input class="mdc-text-field__input  " id="rtwmer_payment_routing_no" name="routing_no."  value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_routing_number",true)) .'">
                <div class="mdc-line-ripple"></div>
                <label class="mdc-floating-label">'. esc_attr__("Routing No.","rtwmer-mercado").'</label>
            </div>
        </div>';
        $rtwmer_payment_html[] = '<div class="rtwmer-input-padding rtwmer_bank_field">
            <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
                <input class="mdc-text-field__input  " id="rtwmer_payment_iban" name="IBAN" value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_bank_iban",true)) .'">
                <div class="mdc-line-ripple"></div>
                <label class="mdc-floating-label">'. esc_attr__("IBAN","rtwmer-mercado").'</label>
            </div>
        </div>';
        $rtwmer_payment_html[] = '<div class="rtwmer-input-padding rtwmer_bank_field">
            <div class="mdc-text-field rtwmer-payment-text-field mdc-ripple-upgraded">
                <input class="mdc-text-field__input  " id="rtwmer_payment_swift_code"  name="swift_code"  
                value="'. esc_attr(get_user_meta($rtwmer_user_id_for_dashboard,"rtwmer_vendor_bank_swift",true)) .'">
                <div class="mdc-line-ripple"></div>
                <label class="mdc-floating-label">'. esc_attr__("Swift_code","rtwmer-mercado").'</label>
            </div>
        </div>';
        }
        $rtwmer_payment_html[] = '<a class="mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_payment_submit_button" id="rtwmer_payment_submit" >
            <div class="mdc-button__ripple"></div>
            <span class="mdc-button__label">'. esc_html__("Submit", "rtwmer-mercado") .'</span>
        </a>
        <div class="rtwmer_nothing_found"><strong>'. esc_html__("No Payment method Found", "rtwmer-mercado") .'</strong></div>
       
    </div>';
    $rtwmer_payment_html = apply_filters( "rtwmer_payment_html" , $rtwmer_payment_html);
   
    foreach ($rtwmer_payment_html as $key => $value) {
        echo $value;    // This variable holds html
    }
    ?>
     <!-- <div class="rtwmer_nothing_found"><strong>'. esc_html__("Only cash on delivery available no other Payment method Found", "rtwmer-mercado") .'</strong></div> -->
</div>














		
	
				
				
				
				
				
			
				
			
              
		
		