(function ($) {
    'use strict';
    $(document).on('ready', function () {

        if ($.fn.googleMap) {
            if($('html').hasClass("rtwmer_store_list_map")){
                $(".rtwmer_store_list_map").googleMap({
                    zoom: 10,
                    coords: [48.895651, 2.290569], 
                    type: "ROADMAP"
                });
            }
        }
        if($.fn.mapbox){
            if($('html').hasClass("rtwmer_store_list_map")){
                L.mapbox.accessToken = $(document).find(".rtwmer_store_list_map").attr("data-value");
                var map = L.mapbox.map('map')
                .setView([40, -74.50], 9)
                .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
            }
       }

       $(document).find("#rtwmer_show_filter").on("click", function () {
        $(".rtwmer_filter_fields").show();
    })

       if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $(document).find("#rtwmer_select_filter").on("change", function () {

        var rtwmer_select_val = $(this).val();
        var rtwmer_current_link = window.location.href;
        var rtwmer_query = rtwmer_current_link.split("?");

        if (rtwmer_select_val == "rtwmer_most_pop") {

            if (rtwmer_query[1] != "rtwmer_most_pop") {

                window.location.assign(window.location.href + "?rtwmer_most_pop=1");

            }

        } else if (rtwmer_select_val == "rtwmer_most_recent") {

            window.location.assign(rtwmer_query[0]);
        }

    })



    $(document).find(".rtwmer_grid_button").on("click", function () {


        $(document).find(".rtwmer_looks_buttons").removeClass('rtwmer_current_active');
        $(this).addClass('rtwmer_current_active');
        $(document).find(".rtwmer_grid_look").removeClass('rtwmer_display');
        $(".rtwmer_row_look").addClass('rtwmer_display');

        var data = {
            'action': 'store_listing_preview',
            'rtwmer_looks': 'grid_view',
            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
        };
        jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (response) { }, 'json');
    })




    $(document).find(".rtwmer_row_button").on("click", function () {
        $(document).find(".rtwmer_looks_buttons").removeClass('rtwmer_current_active');
        $(this).addClass('rtwmer_current_active');
        $(document).find(".rtwmer_row_look").removeClass('rtwmer_display');
        $(".rtwmer_grid_look").addClass('rtwmer_display');

        var data = {
            'action': 'store_listing_preview',
            'rtwmer_looks': 'row_view',
            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
        };
        jQuery.post(rtwmer_ajax_object.rtwmer_ajax_url, data, function (response) { }, 'json');

    })




})
})(jQuery);