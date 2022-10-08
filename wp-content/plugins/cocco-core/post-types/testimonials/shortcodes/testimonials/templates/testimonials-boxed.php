<div class="mkdf-testimonial-content" id="mkdf-testimonials-<?php echo esc_attr( $current_id ) ?>" <?php cocco_mikado_inline_style( $box_styles ); ?>>
    <div class="mkdf-testimonial-text-holder">
        <?php if ( ! empty( $text ) ) { ?>
            <p class="mkdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
        <?php } ?>
        <span class="mkdf-testimonial-triangle">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="53px" height="39.5px"
             viewBox="0 0 53 39.5" enable-background="new 0 0 53 39.5" xml:space="preserve">
            <path fill="currentColor" d="M17.125,6.74h31.75c0,0-7,26.92-44.75,25.997C4.125,32.737,23.875,26.063,17.125,6.74z"/>
        </svg>
        </span>
        <?php if ( has_post_thumbnail() || ! empty( $author ) ) { ?>
            <div class="mkdf-testimonials-author-holder clearfix">
                <?php if (has_post_thumbnail()) { ?>
                    <div class="mkdf-testimonial-image">
                        <?php echo get_the_post_thumbnail(get_the_ID(), array(150, 150)); ?>
                    </div>
                <?php } ?>
                <?php if ( ! empty( $author ) ) { ?>
                    <div class="mkdf-testimonial-author">
						<h5 class="mkdf-testimonials-author-name"><?php echo esc_html( $author ); ?></h5>
                        <?php if ( ! empty( $position ) ) { ?>
                            <span class="mkdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                        <?php } ?>
					</div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>