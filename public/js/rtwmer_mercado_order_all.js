(function ($) {
    'use strict';
    $(document).ready(function() {

        
        var rip = window.location.href;
        var rtwmer_link = rip.split("?");
        var rtwmer_withdraw_link = rip.split("#");
        var rtwmer_home = rtwmer_link[0].split("#");

        $(document).on("click", "#rtwmer_filter_order", function () {
            if ($("#rtwmer_order_complete_button").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "complete_table";
            } else if ($("#rtwmer_order_processing_button").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "processing_table";
            } else if ($("#rtwmer_order_On_hold_button").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "On_hold_table";
            } else if ($("#rtwmer_order_Pending_button").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "pending_table";
            } else if ($("#rtwmer_order_Cancelled_button").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "cancel_table";
            } else if ($("#rtwmer_order_Refunded_button").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "refunded_table";
            } else if ($("#rtwmer_order_Failed_button").hasClass("rtwmer_active_button")) {
                var rtwmer_cond = "failed_table";
            } else {
                var rtwmer_cond = "All_table";
            }

            if (rtwmer_ajax_object.rtwmer_show_customer_details == 1) {
                $(".rtwmer_customer_details").hide();
            }
            var rtwmer_date = $(".rtwmer_order_filter_date").val();

            var rtwmer_customer = $('.rtwmer_order_filter_cust').val();

            var rtwmer = $("#rtwmer-order-all-table-id").DataTable();
          
            rtwmer.state.clear();
            $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            var rtwmer_order_data_table;
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': rtwmer_cond,
                            'rtwmer_date': rtwmer_date,
                            'rtwmer_customer': rtwmer_customer,
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }
                    ],
                    "order": [1, 'asc']
                });
            }
        })

        /*        working of all orders page                               */
        $(document).on("click", "#rtwmer_bulk_button", function () {
           
           
            var rtwmer_action = $("#rtwmer_bulk_action_order_check").val();
          
            var bulk = $(".rtwmer_order_bulk_check");
           
            var id_array = [];
            for (var i = 0; i < bulk.length; i++) {
                if ($(bulk[i]).prop("checked")) {
                    id_array.push(($(bulk[i]).attr("data-id")));
                }
            }
       
            $(".rtwmer_loader").show();
            var data = {
                'action': 'status_change_ajax',
                'status': rtwmer_action,
                'rtwmer_order_id': id_array,
                'rtwmer_order_cond': 'bulk',
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            jQuery.post(
                rtwmer_ajax_object.rtwmer_ajax_url,
                data,
                function (response) {
                    // console.log(response);
                    // false;
                    $(".rtwmer_loader").hide();
                    // if(response){
                    //     $(".rtwmer_loader").hide();
                    // }
                    if (response.status == "success") {
                        //$(".rtwmer_loader").hide();
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_success, { className: 'rtwmer_success', position: "right bottom" });

                        setTimeout(function () {
                            rtwmer_count_ajax();
                            $('#rtwmer-order-all-table-id').DataTable().ajax.reload(null, false);
                            $("#rtwmer_order_all_table_bulk_action").prop("checked", false);
                        }, 100);

                    } else {
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_unsuccessfull, { className: 'rtwmer_error', position: "right bottom" });
                    }
                }, 'json')
        })


        $(document).on('click', '#rtwmer_order_all_table_bulk_action', function (e) {
            if ($("#rtwmer_order_all_table_bulk_action").prop("checked")) {
                $(".rtwmer_order_bulk_check").prop("checked", true);
            } else {
                $(".rtwmer_order_bulk_check").prop("checked", false);
            }
        })


        $(document).on('click', '.rtwmer_order_view', function (e) {
            e.preventDefault();
            $(".rtwmer_order_modal").addClass("rtwmer-modal-open");
            $("body").css("overflow","hidden");
            var rtwmer_ids = $(this).attr("data-id");
            $(".rtwmer_loader").show();
            var data = {
                'action': 'view_order_full_details',
                'rtwmer_order_id': rtwmer_ids,
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            jQuery.post(
                rtwmer_ajax_object.rtwmer_ajax_url,
                data,
                function (response) {
                    // console.log(response);
                    // return;
                    if(response){
                        $(".rtwmer_loader").hide();
                    }
                    if (!response) {
                        alert(rtwmer_ajax_object.rtwmer_translation.rtwmer_prod_deleted);
                    }
                    $(document).trigger("rtwmer_order_view_details",response);
                    response = response.rtwmer_response;
                    var i;
                    var rtwmer_display = "";
                    for (i = 0; i < response[0].length; i++) {
                        rtwmer_display += "<tr><td><img src='" + response[2][i] + "' class='rtwmer_order_prod_image'></td>";
                        // rtwmer_display += "<span class='rtwmer-td-span'>" + response[0][i] + "</span>" + response[4] + "</td>";
                        rtwmer_display += "<td>" + response[0][i] + "</td>";
                        rtwmer_display += "<td>" + response[1][i] + "</td>";
                        rtwmer_display += "<td>" + response[3][i] + "</td></tr>";
                    }
                    
                    
                    $("#rtwmer_order_item_detail").html(rtwmer_display);
                    $("#rtwmer_subtotal").html(response[5]);
                    $("#rtwmer_shippings").html(response[6]);
                    $("#rtwmer_payment_methods").html(response[7]);
                    $("#rtwmer_total").html(response[8]);
                    $("#rtwmer_billing_details").html(response[9]);
                    $("#rtwmer_shipping_details").html(response[10]);
                    $("#rtwmer_order_status").html(response[11]);
                    $("#rtwmer_order_date").html(response[12]);
                    $("#rtwmer_order_earning").html(response[13]);
                    $("#rtwmer_customer_name").html(response[14]);
                    $("#rtwmer_customer_email").html(response[15]);
                    $("#rtwmer_phone").html(response[16]);
                    $("#rtwmer_customer_ip").html(response[17]);
                    if(response[18] != ''){
                        $(".rtwmer_note_detail_box").css('display','block');
                        $("#rtwmer_customer_note").html(response[18]);
                    }else{
                        $(".rtwmer_note_detail_box").css('display','none');
                    }
                    
                }, 'json')
        })




        $(document).on('click', '.rtwmer_order_complete', function (e) {
            e.preventDefault();
            var rtwmer_ids = $(this).attr("data-id");
            $(".rtwmer_loader").show();
            var data = {
                'action': 'status_change_ajax',
                'rtwmer_order_id': rtwmer_ids,
                'rtwmer_order_cond': 'complete',
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            jQuery.post(
                rtwmer_ajax_object.rtwmer_ajax_url,
                data,
                function (response) {
                    if(response){
                        $(".rtwmer_loader").hide();
                    }
                    if (response == "success") {
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_success, { className: 'rtwmer_success', position: "right bottom" });
                        setTimeout(function () {
                            rtwmer_count_ajax();
                            $('#rtwmer-order-all-table-id').DataTable().ajax.reload(null, false)
                        }, 1000);
                    } else {
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_unsuccessfull, { className: 'rtwmer_error', position: "right bottom" });
                    }
                }, 'json')
        })

        $(document).on('click', '.rtwmer_order_processing', function (e) {
            e.preventDefault();
            var rtwmer_ids = $(this).attr("data-id");
            $(".rtwmer_loader").show();
            var data = {
                'action': 'status_change_ajax',
                'rtwmer_order_id': rtwmer_ids,
                'rtwmer_order_cond': 'processing',
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            jQuery.post(
                rtwmer_ajax_object.rtwmer_ajax_url,
                data,
                function (response) {
                    if(response){
                        $(".rtwmer_loader").hide();
                    }
                    if (response == "success") {
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_success, { className: 'rtwmer_success', position: "right bottom" });
                        rtwmer_count_ajax();
                        $('#rtwmer-order-all-table-id').DataTable().ajax.reload(null, false);
                    }
                    else {
                        $('.notifyjs-wrapper').remove();
                        $.notify(rtwmer_ajax_object.rtwmer_translation.rtwmer_unsuccessfull, { className: 'rtwmer_error', position: "right bottom" });
                    }
                }, 'json')
        })


        $(document).on("click", "#rtwmer_order_all_button", function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[0];
            window.history.replaceState(null, null, rtwmer_page_detect);
            if (rtwmer_page_detect != undefined) {
                var rtwmer = $("#rtwmer-order-all-table-id").DataTable()
                rtwmer.state.clear();
                $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            }
            var rtwmer_order_data_table;
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'All_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }
                    ],
                    "order": [1, 'asc']
                });
            }

            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_order_all_button").addClass("rtwmer_active_button");
        })
        $(document).on("click", ".rtwmer-orders", function () {

            var rtwmer_link_current = window.location.href;
            
            // return false;
            var rtwmer_withdraw_link = rtwmer_link_current.split("?");
            
           
            var rtwmer_state = rtwmer_withdraw_link[0].split("#");
            
          
            window.history.replaceState(null, null, rtwmer_home[0] + "#orders");
            var rtwmer_order_data_table;
            
            var rtwmer_ID = $('#rtwmer-order-all-table-id').attr("data-id");
        
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'All_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce,
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }],
                    "order": [1, 'asc']
                });
            }
            $(".rtwmer_div").removeClass("rtwmer-active");
            $(".rtwmer-orders").addClass("rtwmer-active");
            $(".rtwmer-order-complete-table,.rtwmer-order-processing-table,.rtwmer-order-on-hold-table,.rtwmer-order-pending-table,.rtwmer-order-cancelled-table,.rtwmer-order-refunded-table,.rtwmer-order-failed-table").hide();
            $(".rtwmer-product-panel").hide();
            $(".rtwmer-dashboard-panel").hide();
            $(".rtwmer-orders-panel").show();
            $(".rtwmer-withdraw-panel").hide();
            $(".rtwmer-Setting-panel").hide();
            $(".rtwmer-payment-panel").hide();
        });


        /*     functions for cancel table            */
        $(document).on("click", "#rtwmer_order_Cancelled_button", function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            window.history.replaceState(null, null, rtwmer_link[0] + "#orders?cancelled");
            var rtwmer_page_detect = rtwmer_link[1];
            if (rtwmer_page_detect != 'cancelled') {
                var rtwmer = $("#rtwmer-order-all-table-id").DataTable()
                rtwmer.state.clear();
                $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            }
            var rtwmer_order_data_table;
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'cancel_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }],
                    "order": [1, 'asc']

                });
            }
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_order_Cancelled_button").addClass("rtwmer_active_button");

        })

        /*order complete table*/

        $(document).on("click", "#rtwmer_order_complete_button", function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[1];
            window.history.replaceState(null, null, rtwmer_link[0] + "#orders?completed");
            if (rtwmer_page_detect != 'completed') {
                var rtwmer = $("#rtwmer-order-all-table-id").DataTable()
                rtwmer.state.clear();
                $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            }
            var rtwmer_order_data_table;
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'complete_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }],
                    "order": [1, 'asc']

                });

            }
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_order_complete_button").addClass("rtwmer_active_button");
        })

        /*    function for order failure table  */
        $(document).on("click", "#rtwmer_order_Failed_button", function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[1];
            window.history.replaceState(null, null, rtwmer_link[0] + "#orders?failed");
            if (rtwmer_page_detect != 'failed') {
                var rtwmer = $("#rtwmer-order-all-table-id").DataTable()
                rtwmer.state.clear();
                $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            }
            var rtwmer_order_data_table;
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'failed_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }],
                    "order": [1, 'asc']

                });

            }
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_order_Failed_button").addClass("rtwmer_active_button");
        })



        /*        functions for order on hold table         */
        $(document).on("click", "#rtwmer_order_On_hold_button", function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[1];
            window.history.replaceState(null, null, rtwmer_link[0] + "#orders?onhold");
            if (rtwmer_page_detect != 'onhold') {
                var rtwmer = $("#rtwmer-order-all-table-id").DataTable()
                rtwmer.state.clear();
                $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            }
            var rtwmer_order_data_table;
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'On_hold_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }],
                    "order": [1, 'asc']

                });

            }
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_order_On_hold_button").addClass("rtwmer_active_button");
        })



        /*                  functions for order pending table                              */
        $(document).on("click", "#rtwmer_order_Pending_button", function () {
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            window.history.replaceState(null, null, rtwmer_link[0] + "#orders?pending");
            var rtwmer_page_detect = rtwmer_link[1];
            if (rtwmer_page_detect != 'pending') {
                var rtwmer = $("#rtwmer-order-all-table-id").DataTable()
                rtwmer.state.clear();
                $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            }
            var rtwmer_order_data_table;

            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'pending_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }],
                    "order": [1, 'asc']
                });

            }
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_order_Pending_button").addClass("rtwmer_active_button");
        })


        /*          functions for order processing table            */
        $(document).on("click", "#rtwmer_order_processing_button", function () {
          
            var rip = window.location.href;
            var rtwmer_link = rip.split("?");
            var rtwmer_page_detect = rtwmer_link[1];
            window.history.replaceState(null, null, rtwmer_link[0] + "#orders?processing");
            if (rtwmer_page_detect != 'processing') {
                var rtwmer = $("#rtwmer-order-all-table-id").DataTable()
                rtwmer.state.clear();
                $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            }
            var rtwmer_order_data_table;
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'processing_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }],
                    "order": [1, 'asc']
                });
            }
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_order_processing_button").addClass("rtwmer_active_button");
        })




        /*    functions for order refunded table    */
        var rip = window.location.href;
        var rtwmer_link = rip.split("?");
        var rtwmer_page_detect = rtwmer_link[1];

        $(document).on("click", "#rtwmer_order_Refunded_button", function () {
            if (rtwmer_page_detect != 'refunded') {
                var rtwmer = $("#rtwmer-order-all-table-id").DataTable()
                rtwmer.state.clear();
                $("#rtwmer-order-all-table-id").dataTable().fnDestroy();
            }
            var rtwmer_order_data_table;
            if (!$.fn.DataTable.isDataTable('#rtwmer-order-all-table-id')) {
                rtwmer_order_data_table = $('#rtwmer-order-all-table-id').DataTable({
                    'processing': true,
                    'stateSave': true,
                    'info': false,
                    'sortable': true,
                    'serverSide': true,
                    "select": true,
                    'responsive': true,
                    'language': {
                        search: "_INPUT_",
                        searchPlaceholder: rtwmer_ajax_object.rtwmer_translation.rtwmer_search,
                        'processing':  "<div class=rtwmer_loader_box><img class='rtwmer_datatble_loader' src='"+rtwmer_ajax_object.rtwmer_translation.rtwmer_loader_gif+"' /></div>"
                    },
                    "drawCallback": function () {
                        $('.dataTables_filter input').addClass('rtwmer-input-search-field');
                        $('.dataTables_length select').addClass('rtwmer-select-box');
                        $('.dataTables_paginate > .pagination .mdl-button--raised').addClass('rtwmer-pagination-btn-radius');
                        $("<span class='rtwmer-focus-border'></span>").insertAfter(".dataTables_filter input");
                    },
                    'ajax': {
                        'url': rtwmer_ajax_object.rtwmer_ajax_url,
                        'data': {
                            'action': 'rtwmer_order_all_table',
                            'cond': 'refunded_table',
                            'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
                        },
                        'type': 'POST',
                        "dataType": 'json',
                    },
                    "columnDefs": [{
                        "targets": [0, 6],
                        "orderable": false,
                    }],
                    "order": [1, 'asc']
                });
            }
            $(".rtwmer_listing_button").removeClass("rtwmer_active_button");
            $("#rtwmer_order_Refunded_button").addClass("rtwmer_active_button");
        })

        var rip = window.location.href;
        var rtwmer_link = rip.split("?");
        var rtwmer_withdraw_link = rip.split("#");

        $(document).on("click", "#rtwmer_export_all", function () {
            $(".rtwmer_loader").show();
            var data = {
                'action': 'rtwmer_export_orders',
                'rtwmer_nonce': rtwmer_ajax_object.rtwmer_ajax_nonce
            };
            jQuery.post(
                rtwmer_ajax_object.rtwmer_ajax_url,
                data,
                function (response) {
                   
                    if(response){
                        $(".rtwmer_loader").hide();
                    }
                    window.history.replaceState(null, null, rtwmer_withdraw_link[0] + "?rtwmer_order_id_csv=" + response.toString());
                    location.reload();
                }, 'json')
        })

       

        $(document).on("click", "#rtwmer_export_select", function () {
            var bulk = $(".rtwmer_order_bulk_check");
            var id_array = [];
            for (var i = 0; i < bulk.length; i++) {
                if ($(bulk[i]).prop("checked")) {
                    id_array.push(($(bulk[i]).attr("data-id")));
                }
            }
            window.history.replaceState(null, null, rtwmer_withdraw_link[0] + "?rtwmer_order_id_csv=" + id_array.toString(id_array));
            location.reload();
        })


    })
})(jQuery);
