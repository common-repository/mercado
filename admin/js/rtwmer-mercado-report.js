//This file is used for admin dashboard section jquery and javascript
(function( $ ) {

    'use strict';

    var rtwmer_url, rtwmer_split_url;

    if(window.location.href != ""){

    rtwmer_url = window.location.href;

    rtwmer_split_url = rtwmer_url.split("#");

    }

        $(document).ready(function( $ ){

		    if(rtwmer_split_url[1] == 'report'){

          // id's of each menu to intially hide them

          $(document).find('#wpbody-content').show();
          $(document).find('.rtwmer_dash_page_heading').show();
          $(document).find('.rtwmer_sidbar_wrapper').show();
          $('.rtwmer_order_sales_prod_chart_box').show();

          $('.rtwmer_admin_reports_heading').show();
          $('#rtw-mercado-withdraw').css('display','none');

          $('#rtw-mercado-vendor').css('display','none');

          $(document).find('#rtw-mercado-dashboard').css('display','none');

          $('#rtw-mercado-settings').css('display','none');

          $(document).find('#rtw-mercado-report').css('display','block');

          $('#rtwmer-admin-withdraw').removeClass('nav-tab-active');

          $('#rtwmer-admin-vendor').removeClass('nav-tab-active');

          $('#rtwmer-admin-dashboard').removeClass('nav-tab-active');

          $('#rtwmer-admin-settings').removeClass('nav-tab-active');

          $(document).find('#rtwmer-admin-reports').addClass('nav-tab-active');

          $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');

          $('#rtwmer-loader-image').show();

          $(document).find('#rtwmer_report_or_dashboard').attr('data-value','report');

          $(document).find('.rtwmer_other_reports_product_stats').show();

          $(document).find('.rtwmer_dashboard_content_wrappper').hide();

          rtwmer_dashboard_report();

          rtmwer_dashboard_chart();

          rtwmer_bar_chert_for_product_stats();

      }

      $('#rtwmer-admin-reports').on('click', function(){

        $(document).find('.rtwmer_dash_page_heading').show();

        // $('#rtw-mercado-withdraw').css('display','none');

        $('.rtwmer_order_sales_prod_chart_box').show();

        $('.rtwmer_admin_reports_heading').show();
        
        // $('#rtw-mercado-vendor').css('display','none');

        // $('#rtw-mercado-dashboard').css('display','none');

        // $('#rtw-mercado-settings').css('display','none');

        $('#rtw-mercado-report').css('display','block');

        // $('#rtwmer-admin-withdraw').removeClass('nav-tab-active');

        // $('#rtwmer-admin-vendor').removeClass('nav-tab-active');

        // $('#rtwmer-admin-dashboard').removeClass('nav-tab-active');

        // $('#rtwmer-admin-settings').removeClass('nav-tab-active');

        // $(document).find('#rtwmer-admin-reports').addClass('nav-tab-active');

        // $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');

        // $('.rtwmer-submenu').css('display','none');

        $('#rtwmer-loader-image').show();

        $(document).find('#rtwmer_report_or_dashboard').attr('data-value','report');

        $(document).find('.rtwmer_other_reports_product_stats').show();

        $(document).find('.rtwmer_dashboard_content_wrappper').hide();

        rtwmer_dashboard_report();

        rtmwer_dashboard_chart();

        rtwmer_bar_chert_for_product_stats();

      })
      $(document).on('click','#rtwmer_report_box',function(){
          if($(document).find('#rtwmer_report_or_dashboard').attr('data-value') == 'dashboard')

          {

              $('#rtwmer-admin-reports').trigger('click');

          }
      })    })
    function rtwmer_dashboard_report()

    {

        var rtwmer_dashboard_data = {

            'action' : 'rtwmer_dashboard_page_action',

            'rtwmer_dashboard_page_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce

        };

        jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_dashboard_data,

            function( response )

            {

                $('#rtwmer-loader-image').hide();

                if(response != "")

                {

                    $(document).find('#rtwmer_total_sold_product_amount').html(response['rtwmer_dashboard_report_section_data']['rtwmer_total_sold_product_amount']);

                    $(document).find('#rtwmer_get_monthly_created_product').html(response['rtwmer_dashboard_report_section_data']['rtwmer_get_monthly_created_product']);

                    $(document).find('#rtwmer_get_monthly_created_vendor').html(response['rtwmer_dashboard_report_section_data']['rtwmer_get_monthly_created_vendor']);

                    $(document).find('#rtwmer_unapproved_vendors').html(response['rtwmer_dashboard_report_section_data']['rtwmer_unapproved_vendors']);

                    $(document).find('#rtwmer_unapproved_withdraw_requests').html(response['rtwmer_dashboard_report_section_data']['rtwmer_unapproved_withdraw_requests']);

                    $(document).find('#rtwmer_admin_commission_value').html(response['rtwmer_dashboard_report_section_data']['rtwmer_admin_commission_value']);

                    $(document).find('#rtwmer_total_sold_product').html(response['rtwmer_dashboard_report_section_data']['rtwmer_total_sold_product']);

                    $(document).find('#rtwmer_total_orders_count').html(response['rtwmer_dashboard_report_section_data']['rtwmer_total_orders_count']);
                    var i, rtwmer_table = "<table class='widefat mdl-data-table'>";

                    rtwmer_table += "<thead><tr><th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_name+"</strong></th>";

                    rtwmer_table += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_vendor+"</strong></th>";

                    rtwmer_table += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_sold+"</strong></th>";

                    rtwmer_table += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_total_sale_amount+"</strong></th>";

                    rtwmer_table += "</tr></thead>";
                    for( i=0; i < response['rtwmer_top_selling_products_array'].length; i++ )

                    {

                        rtwmer_table += '<tr><td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_title'] + '</strong></td>';

                        rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_user_store_name'] + '</strong></td>'

                        rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_quantity'] + '</strong></td>'

                        rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_price'] + '</strong></td>'

                        rtwmer_table += '</tr>';

                    }

                    rtwmer_table += "</table>";

                    $(document).find('#rtwmer_dashboard_top_selling_products').html(rtwmer_table);
                    var j, rtwmer_table1 = "<table class='widefat mdl-data-table'>";

                    rtwmer_table1 += "<thead><tr><th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_vendor_store_name+"</strong></th>";

                    rtwmer_table1 += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_completed+"</strong></th>";

                    rtwmer_table1 += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_sold+"</strong></th>";

                    rtwmer_table1 += "</tr></thead>";
                    for( j=0; j < response['rtwmer_top_sellers'].length; j++ )

                    {

                        rtwmer_table1 += '<tr><td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_user_store_name'] + '</strong></td>';

                        rtwmer_table1 += '<td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_number_of_orders_by_vendors_count'] + '</strong></td>'

                        rtwmer_table1 += '<td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_item_count_by_top_sellers_data'] + '</strong></td>'

                        rtwmer_table1 += '</tr>';

                    }

                    rtwmer_table1 += "</table>";

                    $(document).find('#rtwmer_dashboard_top_sellers').html(rtwmer_table1);
                }
            },"json");

    }
    function rtmwer_dashboard_chart()

    {

        var date = new Date(); 

        var month = date.getMonth();

        date.setDate(1);

        var all_days = [];

        while (date.getMonth() == month) {

          var d = date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate().toString().padStart(2, '0');

          all_days.push(d);

          date.setDate(date.getDate() + 1); 

        }

        /* line chart */

        var rtwmer_count_data = {

          'action' : 'rtwmer_chart_data_action',

          'rtwmer_chart_data_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce

      };

      jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_count_data,

          function( response ){

            if( response != "" )

            {

              if ($("#rtwmer_total_sales_per_day").length) {


                new Chart(document.getElementById("rtwmer_total_sales_per_day"), {
                  type: 'line',
                  data: {
                    labels: all_days,
                    datasets: [{ 
                        data: response['rtwmer_order_count'],
                        label: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_number_of_orders],
                        backgroundColor:["rgba(255,255,255,0)"],
                        borderColor: ['#058fd2' ],
                        fill: false
                      }, { 
                        data: response['rtwmer_product_count'],
                        label:  [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_total_product],
                        backgroundColor:["rgba(255,255,255,0)"],
                        borderColor: ['#28a745'],
                        fill: false
                      }, { 
                        data: response['rtwmer_commission_count'],
                        label:  [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_commission],
                        backgroundColor:["rgba(255,255,255,0)"],
                        borderColor: ['#ffc107'],
                        fill: false
                      },
                    ]
                  },
                  options: {
                    responsive:true,
                    maintainAspectRatio: false,
                    title: {
                      display: true,
                    }
                  }
                });


                // var ctx = document.getElementById("rtwmer_total_sales_per_day").getContext('2d');

                // var bar = new Chart(ctx, {

                //   type: 'line',

                //   data: {

                //     labels: all_days,

                //     datasets: [{

                //       label: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_number_of_orders],

                //       data: response['rtwmer_order_count'],

                //       backgroundColor:["rgba(255,255,255,0)"],

                //       borderColor: [

                //       '#058fd2'

                //       ],

                //       borderWidth: 2,

                //     },

                //     {

                //       label: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_total_product],

                //       data: response['rtwmer_product_count'],

                //       backgroundColor:["rgba(255,255,255,0)"],

                //       borderColor: [

                //       '#28a745'

                //       ],

                //       borderWidth: 2,

                //     },

                //     {

                //     label: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_commission],

                //     data: response['rtwmer_commission_count'],

                //     backgroundColor:["rgba(255,255,255,0)"],

                //     borderColor: [

                //     '#ffc107'

                //     ],

                //     borderWidth: 2,

                //   }]

                //   },

                //   options: {

                //     responsive: true,

                //     scales: {

                //       yAxes: [{

                //         barPercentage: .1,

                //         ticks: {

                //           beginAtZero:true,

                //         }

                //       }],

                //       xAxes: [{

                //         type: 'time',

                //         time: {

                //             unit: 'day'

                //         }

                //       }]

                //     }

                //   }

                // });

              }

            }

          },'json');

    }

  function rtwmer_bar_chert_for_product_stats()

  {

    var rtwmer_count_data = {

      'action' : 'rtwmer_chart_data_action_for_product_stats',

      'rtwmer_chart_data_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce

  };

  jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_count_data,

      function( response ){

        if( response != "" )

        {

          if (jQuery("#rtwmer_product_as_bar_chart").length) {

            var ctx = document.getElementById("rtwmer_product_as_bar_chart");

            var bar = new Chart(ctx, {
              type: 'bar',

              width: 800,

              data: {

                labels: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_online, rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_draft,rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_pending,rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_total],

                datasets: [{

                  label: rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_stats,

                  data: response['rtwmer_product_stats'],

                  backgroundColor: ['#058fd2', '#fc466b','#fc466b', '#058fd2'],

                  borderWidth: 0,

                }]

              },

              options: {

                responsive: true,
                maintainAspectRatio: false,
                scales: {

                  yAxes: [{

                    barPercentage: .1,

                    ticks: {

                      beginAtZero:true,

                    }

                  }]

                }

              }

            });

          }

          if (jQuery("#rtwmer_vendor_as_pie_chart").length) {

          var ctx = document.getElementById("rtwmer_vendor_as_pie_chart");

          var myChart = new Chart(ctx, {

            type: 'pie',

            data: {

              labels: [rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_approved_vendors, rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_waiting_for_awaiting_approval],

              datasets: [{

                data: response['rtwmer_total_vendoors'],

                backgroundColor:["#058fd2", "#6c757d", "#e3eaef"],

                hoverBackgroundColor:["#06a8b5", "#f1556c", "#e3eaef"],

                borderColor: [

                '#ffffff'

                ],

                borderWidth: 0,

              }]

            },

            options: {
              maintainAspectRatio: false,
              responsive:true,
            }

          });

        }

      }

    },'json');

  }
})( jQuery );

