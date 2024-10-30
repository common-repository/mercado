(function ($) {
    'use strict';
    $(document).on('ready', function () {
        if($(document).find("#secondary").hasClass("widget-area")){
            $(document).find(".rtwmer-d-flex").css("width","75%");
            $('.rtwmer_store_sidebar_for_widgets:first-child').css("width","25%");
            $(document).find(".rtwmer-prdct-row").css("width","100%"); 
            $(document).find(".rtwmer-prdct-box").css("width","50%");
        }else{
            $(document).find(".rtwmer-d-flex").css("width","100%");
            $(document).find(".rtwmer-prdct-row").css("width","100%"); 
        }
        var rtwmer_element_obj = $(document).find(".cat-item");
        var rtwmer_url = window.location.href;

        var rtwmer_html = $(".cat-item-" + rtwmer_url.split("/")[6]).text();
        if (rtwmer_url.split("/")[6] != NaN) {
            $(".cat-item-" + rtwmer_url.split("/")[6]).addClass("rtwmer_active_category");
        }

        if ($.fn.googleMap) {
            $(".rtwmer_map").googleMap({
                zoom: 10, 
                coords: [48.895651, 2.290569], 
                type: "ROADMAP"
            });
            $(".rtwmer_map_box").show(); 
        }
        if ($.fn.mapbox) {
            L.mapbox.accessToken = $(document).find(".rtwmer_map_box").attr("data-value");
            var map = L.mapbox.map('map')
                .setView([40, -74.50], 9)
                .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
                $(".rtwmer_map_box").show();
            }

        $(document).find("#rtwmer_endpoint_submit").on("click", function (e) {
            e.preventDefault();
            var rtwmer_user_name = $(document).find("#rtwmer_user_name").val();
            var rtwmer_user_email = $(document).find("#rtwmer_user_email_id").val();
            var rtwmer_user_message = $(document).find("#rtwmer_user_message").val();
            var rtwmer_current_vendor_id = $(this).attr("data-id");
            $(".rtwmer_loader").show();
            var data = {
                'action': 'rtwmer_endpoint_email',
                'rtwmer_user_name': rtwmer_user_name,
                'rtwmer_user_email': rtwmer_user_email,
                'rtwmer_user_message': rtwmer_user_message,
                'rtwmer_current_vendor_id': rtwmer_current_vendor_id,
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (response) {
                if(response){
                    $(".rtwmer_loader").hide();
                }
                if (response == "Sent successfully") {
                    $(document).find(".rtwmer_notify").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_sent_successfull);
                    $(document).find(".rtwmer_notify").fadeIn();
                    setTimeout(function () { $(document).find(".rtwmer_notify").fadeOut(); }, 1000);
                    $(document).find("#rtwmer_user_message").val("");
                } else {
                    $(document).find(".rtwmer_notify").html(rtwmer_ajax_object.rtwmer_translation.rtwmer_try_again);
                    $(document).find(".rtwmer_notify").fadeIn();
                    setTimeout(function () { $(document).find(".rtwmer_notify").fadeOut(); }, 1000);
                }
            }, 'json');
        })
        $(document).on("click", ".cat-item", function (e) {
            e.preventDefault();
            var rtwmer_cat = $(this).attr("class");
            var page = rtwmer_cat.split("-")[3];
            var url = $("#rtwmer_url_path").attr("data-value");
            window.location.replace(url + "/" + page);
            e.stopPropagation();
        })
    })
})(jQuery);
