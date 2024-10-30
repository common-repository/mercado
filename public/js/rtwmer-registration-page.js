(function ($) {
	'use strict';
	$(document).ready(function () {

		$(document).on("click", "#rtwmer-radio-vendor", function () {

			$(".rtwmer-vendor-registration").removeClass("rtwmer-none");
		})
		$(document).on("click", "#rtwmer-radio-customer", function () {

			$(".rtwmer-vendor-registration").addClass("rtwmer-none");
		})

		$(document).on("click", ".rtwmer_Dashboard_button", function (event) {

			var hrefValue = $(this).attr('href');
			var checkHref = hrefValue.indexOf('/my-account/');

			if (!hrefValue) {
				event.preventDefault(); // Prevent the default action (navigation)
				alert('Admin has not selected Vendor Dashboard from the Page Settings option list');
			}else if(checkHref !== -1){
				event.preventDefault(); // Prevent the default action (navigation)
				alert('Admin has not selected Vendor Dashboard from the Page Settings option list');
			}
		});

	});
})(jQuery);
