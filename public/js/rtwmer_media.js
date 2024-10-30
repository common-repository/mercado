(function ($) {
	'use strict';
	$(document).ready(function(){

		
			$("#rtwmer-image-preview").hide();
			var file_frame;
			var attachment;
			var wp_media_post_id ; 
			var set_to_post_id = $("#rtwmer-upload_image_button").attr("data-id"); // Set this
			jQuery(document).on('click','#rtwmer-upload_image_button', function( event ){
				event.preventDefault();
				
				
				if ( file_frame ) {
				
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
				
					file_frame.open();
					return;
				} else {
				
					wp.media.model.settings.post.id = set_to_post_id;
				}

				file_frame = wp.media.frames.file_frame = wp.media({
					title: rtwmer_ajax_object.rtwmer_translation.rtwmer_select_img,
					button: {
						text: rtwmer_ajax_object.rtwmer_translation.rtwmer_use_this_img,
					},
					multiple: false	
				});
				
				file_frame.on( 'select', function() {
					$("#rtwmer-image-preview").show();
					$(".rtwmer_remove_prod_image").show();
					$(".rtwmer_upload_box").hide();
				
					attachment = file_frame.state().get('selection').first().toJSON();
					
					$( '#rtwmer-image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#rtwmer-image_attachment_id' ).val( attachment.id );
					
					wp.media.model.settings.post.id = wp_media_post_id;
				});
				
					file_frame.open();
				});
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		})



})(jQuery);