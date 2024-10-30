jQuery(document).ready(function($) {
  
    // Intercept the deactivation link

    $(document).find('tr[data-slug="mercado"] td span.deactivate').on('click', function(e) {
    
        // $('tr[data-slug="' + deactivationFeedback.pluginSlug + '"] .deactivate').on('click', function(e) {
        e.preventDefault(); // Prevent the default deactivation behavior
        // Display the feedback modal

        let deactivationModal = `
            <div id="deactivation-modal" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 20px; z-index: 10000; border-radius: 8px; border: 1px solid #ccc; width: 500px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);  opacity: 0; transition: opacity 1.5s ease;">
                <span id="close-modal" style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size: 20px; font-weight: bold;">&times;</span>
                <h3 style="margin-bottom: 15px; font-size: 24px;">We'd love your feedback</h3>
                <p style="font-size: 16px; color: #666; margin-bottom: 20px;">Please let us know why you are deactivating? Your feedback helps us improve!</p>

                <!-- Radio button options -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px;">
                        <input type="radio" name="deactivation-reason" value="Not Needed" style="margin-right: 10px;"> I no longer need the plugin
                    </label>
                    <label style="display: block; margin-bottom: 8px; font-size: 14px;">
                        <input type="radio" name="deactivation-reason" value="Bug/Problem" style="margin-right: 10px;"> I encountered a bug or problem
                    </label>
                    <label style="display: block; margin-bottom: 8px; font-size: 14px;">
                        <input type="radio" name="deactivation-reason" value="Temporary Deactivation" style="margin-right: 10px;"> It’s a temporary deactivation
                    </label>
                    <label style="display: block; margin-bottom: 8px; font-size: 14px;">
                        <input type="radio" name="deactivation-reason" id="rtwmer_oth_reason" value="Other" style="margin-right: 10px;"> Other
                    </label>
                </div>

                <!-- Additional comments textarea -->
                <textarea id="additional-comments" placeholder="Any additional comments?" style="width: 100%; display:none; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;"></textarea>

                <!-- Submit and Skip buttons -->
                <div style="text-align: right;">
                    <button id="submit-feedback" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">Submit Feedback</button>
                    <button id="skip-feedback" style="background-color: #f44336; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; margin-left: 10px;">Skip</button>
                </div>
            </div>
            <div id="deactivation-modal-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;"></div>
        `;


        $('body').append(deactivationModal);
        $('#deactivation-modal-overlay').fadeIn(200);  // Fade in overlay
        $('#deactivation-modal').fadeIn(200).css('opacity', 1);  // Fade in modal with smooth opacity transition
        // $('#deactivation-modal').css('background-color','blue');  // Fade in modal with smooth opacity transition

        var flag = true;

        // Handle feedback submission
        if (flag) {
            $('#submit-feedback').on('click', function() {
                let reason = $('#deactivation-reason').val();
                let comments = $('#additional-comments').val();
                // console.log(comments);
                // return;
                
                if (comments != '' && flag) {
                    flag = false;
                    $.post(deactivationFeedback.rtwmer_ajax_url, {
                        action: 'send_deactivation_feedback',
                        reason: reason,
                        comments: comments
                    }, function(response) {
        
                        // Proceed with plugin deactivation
                        window.location.href = $('tr[data-slug="mercado"] .deactivate a').attr('href');
                    });
                } else {
                    // Proceed with plugin deactivation
                    window.location.href = $('tr[data-slug="mercado"] .deactivate a').attr('href');
                }
           
            });
        }
        $('#rtwmer_oth_reason').on('click', function() {
            $('#additional-comments').show();
        });

      

        // Handle skipping feedback
        $('#skip-feedback').on('click', function() {
            // Proceed with plugin deactivation
            $('#deactivation-modal, #deactivation-modal-overlay').fadeOut(300, function() {
                $(this).remove();  // Remove modal after fade out
            });
            window.location.href = $(document).find('tr[data-slug="mercado"] .deactivate a').attr('href');
        });

                // Insert the modal into the DOM
        // document.body.insertAdjacentHTML('beforeend', deactivationModal);

        // Add event listener to close the modal when the close button is clicked
        $('#close-modal').on('click', function() {
        // document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('deactivation-modal').remove();
            document.getElementById('deactivation-modal-overlay').remove();
            $('#deactivation-modal, #deactivation-modal-overlay').fadeOut(300, function() {
                $(this).remove();  // Remove modal after fade out
            }); 
        });

        // Optional: Add event listener to close the modal when the overlay is clicked
        $('#deactivation-modal-overlay').on('click', function() {
        // document.getElementById('deactivation-modal-overlay').addEventListener('click', function() {
            document.getElementById('deactivation-modal').remove();
            document.getElementById('deactivation-modal-overlay').remove();
        });
    });
});
