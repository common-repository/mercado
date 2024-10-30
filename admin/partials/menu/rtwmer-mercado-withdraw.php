<?php 

//================= Page is used to show admin withdraw requests of vendors=======================//
//================= Page is used to show admin withdraw requests of vendors=======================//

    if(!empty(get_option('rtwmer_withdraw_status')))
    {
        $rtwmer_withdraw_status = get_option('rtwmer_withdraw_status');
        if( isset($rtwmer_withdraw_status) && !empty($rtwmer_withdraw_status) )
        {
            ?>
                <input type="hidden" id="rtwmer_withdraw_active" value="<?php echo esc_attr( $rtwmer_withdraw_status ) ?>">
            <?php
        }
    } 
 
?>    

    <div class = "rtwmer_bulk_action">
        <div class = "rtwmer_prod_sorting" id="rtwmer-withdraw-sorting-tabs">
            <?php 
                $rtwmer_withdraw_sorting_tab = array(
                    "<a href = '#withdraw' data-value = 'pending' id = 'rtwmer_withdraw_pending' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_withdraw' >".esc_html__('Pending','rtwmer-mercado')."</a>",
                    "<a href = '#withdraw' data-value = 'approved' id = 'rtwmer_withdraw_approved' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_withdraw' >".esc_html__('Approved','rtwmer-mercado')."</a>",
                    "<a href = '#withdraw' data-value = 'cancelled' id = 'rtwmer_withdraw_cancelled' class = 'mdc-button mdc-button--raised mdc-theme--primary mdc-ripple-upgraded rtwmer_withdraw' >".esc_html__('Cancelled','rtwmer-mercado')."</a>"
                );
                if( isset($rtwmer_withdraw_sorting_tab) && is_array($rtwmer_withdraw_sorting_tab) )
                {
                    $rtwmer_withdraw_sorting_tab = apply_filters('rtwmer_withdraw_sorting_tab',$rtwmer_withdraw_sorting_tab);

                    if( isset($rtwmer_withdraw_sorting_tab) && is_array($rtwmer_withdraw_sorting_tab) )
                    {
                        foreach($rtwmer_withdraw_sorting_tab  as $tabs)
                        {
                            if( isset($tabs) )
                            {
                                //========$tabs contains html=======//
                                echo $tabs;
                            }
                        }
                    }
                }
            ?>  
        </div>
        <div class='rtwmer_select_box'>
            <select name="action" id="rtwmer_withdraw_action" class="rtwmer-select-text">
                <option value = "rtwmer_not_selected"><?php esc_html_e( 'Bulk Actions','rtwmer-mercado' ); ?></option>
                <option value = "approved" class="rtwmer_withdraw_pending_page"><?php esc_html_e( 'Approve','rtwmer-mercado' ); ?></option>
                <option value = "cancelled" class="rtwmer_withdraw_pending_page"><?php esc_html_e( 'Cancel','rtwmer-mercado' ); ?></option>
                <option value = "pending" class="rtwmer_withdraw_cancel_page"><?php esc_html_e( 'Pending','rtwmer-mercado' ); ?></option>
                <option value = "delete"><?php esc_html_e( 'Delete','rtwmer-mercado' ); ?></option>
            </select>
            <button class="mdc-button mdc-button--outlined mdc-ripple-upgraded rtwmer_withdraw_apply_bulk" id="rtwmer_withdraw_apply_bulk">
                <span class="mdc-button__label"><?php esc_html_e('Apply', 'rtwmer-mercado'); ?></span>
                <div class="mdc-button__ripple"></div>
            </button>   
        </div>
    </div>

        <table id="rtwmer_withdraw_table" class="rtwmer_withdraw_table mdl-data-table">
 
        <thead>
            <tr>
                <th class="mdc-data-table__cell mdc-data-table__cell--checkbox">
					<div class="mdc-checkbox mdc-data-table__row-checkbox">
						<input type="checkbox" class="mdc-checkbox__native-control rtwmer_withdraw_outer_checkbox" id="rtwmer-select-all-vendor-row" aria-labelledby="u0">
						<div class="mdc-checkbox__background">
						<svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
							<path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
						</svg>
						<div class="mdc-checkbox__mixedmark"></div>
                        </div>
                        <div class="mdc-checkbox__ripple"></div>
					</div>
				</th>
                <th><?php esc_html_e( 'Vendor','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Amount','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Status','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Method','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Details','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Note','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Date','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Actions.','rtwmer-mercado' ); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="mdc-data-table__cell mdc-data-table__cell--checkbox">
					<div class="mdc-checkbox mdc-data-table__row-checkbox">
						<input type="checkbox" class="mdc-checkbox__native-control rtwmer_withdraw_outer_checkbox" id="rtwmer-select-all-vendor-row" aria-labelledby="u0">
						<div class="mdc-checkbox__background">
						<svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
							<path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
						</svg>
						<div class="mdc-checkbox__mixedmark"></div>
                        </div>
                        <div class="mdc-checkbox__ripple"></div>
					</div>
				</th>
                <th><?php esc_html_e( 'Vendor','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Amount','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Status','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Method','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Details','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Note','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Date','rtwmer-mercado' ); ?></th>
                <th><?php esc_html_e( 'Actions.','rtwmer-mercado' ); ?></th>
            </tr>
        </tfoot>
    </table> 

    <div class='rtwmer-modal' id='rtwmer_withdraw_add_note' tabindex="-1">
		<div class='rtwmer-modal-dialog rtwmer_modal_dialog'>
			<div class='rtwmer-modal-content'>

				<div class='rtwmer-modal-header'>
					<h4 class='rtwmer-modal-title'><?php esc_html_e('Add Note', 'rtwmer-mercado'); ?></h4>
                    <button class='mdc-button rtwmer-modal-close'>
                        <i class="material-icons rtwvsm-list-item" aria-hidden="true"><?php echo esc_html('highlight_off'); ?></i>
                    </button>
                </div>
                
				<div class='rtwmer-modal-body'>
					<div class="rtwmer-section-content card min-width-100">
						<div clas="rtwmer-setting-heading">
							<div class="rtwmer-subsetting-content">
								<textarea rows="6" cols="62" id="rtwmer_withdraw_add_note_text"></textarea>
							</div>

						</div>
					</div>
				</div>

				<!-- Modal footer -->
				<div class='rtwmer-modal-footer'>
					<button type='button' class='mdc-button mdc-button--raised mdc-ripple-upgraded rtwmer_withdraw_add_note_btn' data-id=''><?php esc_html_e('Update Note', 'rtwmer-mercado'); ?> </button>
				</div>

			</div>
		</div>
	</div>