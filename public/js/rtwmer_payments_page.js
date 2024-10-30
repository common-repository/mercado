(function ($) {
    'use strict';
    $(document).ready( function () {
    
      //  for payment tabs
      $(".rtwmer_payment_tabs_list a").click(function() {

        var position = $(this).parent().position();
        var width = $(this).parent().width();
          $(".rtwmer_payment_tabs_list .rtwmer_tab_slider").css({"left":+ position.left,"width":width});
      });
      var actWidth = $(".rtwmer_tab_active").parent().width();
      var actPosition = $(".rtwmer_tab_active").parent().position();
      if(actPosition != undefined ){
        $(".rtwmer_tab_slider").css({"left":+ actPosition.left,"width": actWidth});
      }
      $("."+$(".rtwmer_tab_active").attr("data-section")).show();


      $(document).on("click",".rtwmer_payment_tab",function(e){
        $(".rtwmer-input-padding").hide();
        $("."+$(this).attr("data-section")).show();
        $(".rtwmer_payment_tab").removeClass("rtwmer_tab_active");
        $(this).addClass("rtwmer_tab_active");
      });
     

      if($(".rtwmer-input-padding").length == 0){
        $(".rtwmer_nothing_found").show();
        $(".rtwmer_payment_submit_button").hide();
        $(".rtwmer_payment_tabs_list").hide();
        $(".rtwmer-payment-input-box").addClass("rtwmer_payment_after_disable_inputs");
      }
      
     $(document).on("click","#rtwmer_payment_submit",function(e){
        e.preventDefault;
        var rtwmer_paypal_email    =   $("#rtwmer_payment_paypal_email").val();
        var rtwrre_stripe_id       =   $("#rtwmer_payment_stripe_id").val();
        var rtwmer_account_name    =   $("#rtwmer_payment_account_name").val();
        var rtwmer_account_no      =   $("#rtwmer_payment_account_no").val();
        var rtwmer_bank_name       =   $("#rtwmer_payment_bank_name").val();
        var rtwmer_bank_place      =   $("#rtwmer_payment_bank_place").val();
        var rtwmer_routing_no      =   $("#rtwmer_payment_routing_no").val();
        var rtwmer_iban            =   $("#rtwmer_payment_iban").val();
        var rtwmer_swift_code      =   $("#rtwmer_payment_swift_code").val();  
        var rtwmer_extra = $(".rtwmer_payment_extra_field");
        if(rtwmer_extra.length>0){
             var rtw_obj={};
        $.each(rtwmer_extra, function(index,event) {
          rtw_obj[event.name]=event.value;
          });
        }
        var rtwmer_multiple_select = $(document).find(".rtwmer_payment_multiple_data");
        if (rtwmer_multiple_select.length > 0) {
           var extra_multi_data = {};
           $.each(rtwmer_multiple_select, function (index, event) {
               extra_multi_data[event.name] = getSelectValues(event);
           });
       }
       var rtwmer_image_src = $(".rtwmer_payment_image_src");
       if (rtwmer_image_src.length > 0) {
           var rtwmer_image_src_path = {};
           $.each(rtwmer_image_src, function (index, event) {
               rtwmer_image_src_path[event.name] = event.src;
           });
       }
        var rtwmer_extra_check = $(".rtwmer_payment_checkbox");
        if(rtwmer_extra_check.length>0){
          var rtw_check_obj={};
         $.each(rtwmer_extra_check, function(index,event) {
           rtw_check_obj[event.name]= $("#"+event.id).is(":checked");
          });
          }
        $(".rtwmer_loader").show();
        var data = {
            'action': 'rtwmer_payment_ajax',
            'rtwmer_paypal_email':rtwmer_paypal_email,
            'rtwmer_stripe_id' : rtwrre_stripe_id,
            'rtwmer_account_name': rtwmer_account_name,
            'rtwmer_account_no':rtwmer_account_no,
            'rtwmer_bank_name':rtwmer_bank_name,
            'rtwmer_bank_place':rtwmer_bank_place,
            'rtwmer_routing_no':rtwmer_routing_no,
            'rtwmer_iban':rtwmer_iban,
            'rtwmer_swift_code':rtwmer_swift_code,
            'rtwmer_nonce':rtwmer_ajax_object.rtwmer_ajax_nonce
        };
           if(rtwmer_extra.length>0){
             var data={...rtw_obj,...data};
           }
           if (rtwmer_multiple_select.length > 0) {
            var data = { ...extra_multi_data, ...data };
           }
          if (rtwmer_image_src.length > 0) {
            var data = { ...rtwmer_image_src_path, ...data };
           }
           if(rtwmer_extra_check.length>0){
            var data={...rtw_check_obj,...data};
          }
        jQuery.post(
            rtwmer_ajax_object.rtwmer_ajax_url, 
            data,
            function (response) {
              if(response){
                $(".rtwmer_loader").hide();
              }
                if(response=="successfull"){
                    $('.notifyjs-wrapper').remove();
                    $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_success, { className: 'rtwmer_success', position: "right bottom" });
                }
          },"json")
     })

 })   
})(jQuery);