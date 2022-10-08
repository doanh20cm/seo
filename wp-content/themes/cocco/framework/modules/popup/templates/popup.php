<div class="mkdf-popup-holder <?php echo esc_attr( $holder_classes ); ?>">
    <div class="mkdf-popup-table">
        <div class="mkdf-popup-table-cell">
            <div class="mkdf-popup-inner">
                <a class="mkdf-popup-close" href="javascript:void(0)">
                    <span class="icon_close"></span>
                </a>
                <div class="mkdf-popup-background" style="background-image: url('<?php echo esc_url( $popup_background_image ); ?>')"></div>
                <div class="mkdf-popup-content-container">
                    <?php if(!empty($title)) { ?>
                        <div class="mkdf-popup-title-holder">
                            <h1 class="mkdf-popup-title"><?php echo esc_html($title); ?></h1>
                        </div>
                    <?php } ?>
                    <div class="mkdf-popup-subtitle">
                        <p><?php echo esc_html($subtitle); ?></p>
                    </div>
                    <?php echo do_shortcode('[contact-form-7 id="' . $contact_form .'" html_class="'. $contact_form_style .'"]'); ?>
	                <?php if ( $enable_popup_prevent === 'yes' ) { ?>
		                <div class="mkdf-popup-prevent">
			                <div class="mkdf-popup-prevent-inner">
				                <span class="mkdf-popup-prevent-input" data-value="no">
					                <span class="icon dripicons-checkmark"></span>
				                </span>
				                <label class="mkdf-popup-prevent-label"><?php esc_html_e( 'Prevent This Pop-up', 'cocco' ); ?></label>
			                </div>
		                </div>
	                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
