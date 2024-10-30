//This file is used for admin dashboard section jquery and javascript

(function( $ ) {
    'use strict';
    var rtwmer_url, rtwmer_split_url;


    // rtwmer_offer_icon
  // open features model


    if(window.location.href != ""){
    rtwmer_url = window.location.href;
    rtwmer_split_url = rtwmer_url.split("#");
    }
        $(document).ready(function( $ ){
		    if(rtwmer_split_url[1] == 'dashboard'){
                // id's of each menu to intially hide them
                $(document).find('#wpbody-content').show();
                $(document).find('.rtwmer_dash_page_heading').show();
                $(document).find('#rtw-mercado-withdraw').css('display','none');
                $(document).find('#rtw-mercado-vendor').css('display','none');
                $(document).find('#rtw-mercado-dashboard').css('display','none');
                $(document).find('#rtw-mercado-settings').css('display','none');
                $(document).find('#rtw-mercado-report').css('display','block');
                $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-dashboard').addClass('nav-tab-active');
                $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                $(document).find('#rtwmer-loader-image').show();
                $(document).find('.rtwmer_dashboard_content_wrappper').show();
                $(document).find('#rtwmer_report_or_dashboard').attr('data-value','dashboard');
                $(document).find('.rtwmer_other_reports_product_stats').hide();
                rtwmer_dashboard_report();
                rtmwer_dashboard_chart();
            }
                // when click on toggle button
                $(document).find(".rtwmer-toggle").click(function(){
                  $(".rtwmer_sidbar_wrapper").addClass("rtwmer-show-sidebar");
                });
                $(document).find(".rtwmer-sidebar-close").click(function(){
                  $(".rtwmer_sidbar_wrapper").removeClass("rtwmer-show-sidebar");
                });
    
                // when click on any menu item in navbar
                $(document).find(".rtwmer-navbar li").click(function(){
                  $(".rtwmer_sidbar_wrapper").removeClass("rtwmer-show-sidebar");
                });

			$('#rtwmer-admin-dashboard').on('click', function(){
                $(document).find('#wpbody-content').show();
                $(document).find('.rtwmer_dash_page_heading').show();
                $('.rtwmer_order_sales_prod_chart_box').css('display','none');
                $('.rtwmer_admin_reports_heading').css('display','none');
                // $(document).find('#rtw-mercado-withdraw').css('display','none');
                // $(document).find('#rtw-mercado-vendor').css('display','none');
                // $(document).find('#rtw-mercado-dashboard').css('display','none');
                // $(document).find('#rtw-mercado-settings').css('display','none');
                $(document).find('#rtw-mercado-report').css('display','block');
                $(document).find('.rtwmer_other_reports_product_stats').hide();
                // $(document).find('#rtwmer-admin-withdraw').removeClass('nav-tab-active');
                // $(document).find('#rtwmer-admin-vendor').removeClass('nav-tab-active');
                $(document).find('#rtwmer-admin-dashboard').addClass('nav-tab-active');
                // $(document).find('#rtwmer-admin-settings').removeClass('nav-tab-active');
                // $(document).find('#rtwmer-admin-reports').removeClass('nav-tab-active');
                // $(document).find('#rtwmer-admin-all-orders').removeClass('nav-tab-active');
                // $(document).find('.rtwmer-submenu').css('display','none');
                $(document).find('#rtwmer-loader-image').show();
                $(document).find('.rtwmer_dashboard_content_wrappper').show();
                $(document).find('#rtwmer_report_or_dashboard').attr('data-value','dashboard');
                rtwmer_dashboard_report();
                rtmwer_dashboard_chart();
        })
    })

    function rtwmer_dashboard_report()
    {
        var rtwmer_dashboard_data = {
            'action' : 'rtwmer_dashboard_page_action',
            'rtwmer_dashboard_page_nonce_verify' : rtwmer_vendor_object.rtwmer_vendor_nonce
        };
        jQuery.post(rtwmer_vendor_object.rtwmer_ajax_url, rtwmer_dashboard_data,
            function( response )
            {
              // console.log(response);
					    // return;

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
                    if((response['rtwmer_top_selling_products_array'].length == 1) && (response['rtwmer_top_selling_products_array'][0].rtwmer_product_title == "")  && (response['rtwmer_top_selling_products_array'][0].rtwmer_user_store_name == "")  && (response['rtwmer_top_selling_products_array'][0].rtwmer_product_price == 0)  && (response['rtwmer_top_selling_products_array'][0].rtwmer_product_quantity == 0) ){
                      
                      rtwmer_table += '<tr><td colspan="4">'+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_no_data_found+'</td></tr>';
                      
                    }else{
                     for( i=0; i < response['rtwmer_top_selling_products_array'].length; i++ )
                     {
                         rtwmer_table += '<tr><td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_title'] + '</strong></td>';
                         rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_user_store_name'] + '</strong></td>'
                        rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_quantity'] + '</strong></td>'
                        rtwmer_table += '<td scope="col"><strong>' + response['rtwmer_top_selling_products_array'][i]['rtwmer_product_price'] + '</strong></td>'
                      rtwmer_table += '</tr>';
                      }
                    }
                  
                    rtwmer_table += "</table>";
                    $(document).find('#rtwmer_dashboard_top_selling_products').html(rtwmer_table);

                    var j, rtwmer_table1 = "<table class='widefat mdl-data-table'>";
                    rtwmer_table1 += "<thead><tr><th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_vendor_store_name+"</strong></th>";
                    rtwmer_table1 += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_orders_completed+"</strong></th>";
                    rtwmer_table1 += "<th scope='col'><strong>"+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_text_product_sold+"</strong></th>";
                    rtwmer_table1 += "</tr></thead>";
                   
                    if(response['rtwmer_top_sellers'] == 0){
                      rtwmer_table1 += '<tr><td colspan="3">'+rtwmer_general_page_object.rtwmer_translatable_js_strings.rtwmer_no_data_found+'</td></tr>';
                    }else{
                      for( j=0; j < response['rtwmer_top_sellers'].length; j++ )
                      {
                          rtwmer_table1 += '<tr><td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_user_store_name'] + '</strong></td>';
                          rtwmer_table1 += '<td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_number_of_orders_by_vendors_count'] + '</strong></td>'
                          rtwmer_table1 += '<td scope="col"><strong>' + response['rtwmer_top_sellers'][j]['rtwmer_item_count_by_top_sellers_data'] + '</strong></td>'
                          rtwmer_table1 += '</tr>';
                      }
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
                if (jQuery("#rtwmer_total_sales_per_day_and_save").length) {
                new Chart(document.getElementById("rtwmer_total_sales_per_day_and_save"), {
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
                        borderColor: ['#058fd2'],
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
                    title: {
                      display: true,
                      maintainAspectRatio: false,
                    }
                  }
                });
                }
            }
          },'json');
    }

})( jQuery );