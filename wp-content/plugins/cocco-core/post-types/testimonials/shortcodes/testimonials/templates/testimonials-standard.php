<div class="mkdf-testimonial-content" id="mkdf-testimonials-<?php echo esc_attr( $current_id ) ?>">
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="mkdf-testimonial-image">
            <?php echo get_the_post_thumbnail( get_the_ID(), array( 150, 150 ) ); ?>
        </div>
    <?php } ?>
	<div class="mkdf-testimonial-text-holder">
		<?php if ( ! empty( $title ) ) { ?>
			<h2 itemprop="name" class="mkdf-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h2>
		<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
			<p class="mkdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
		<?php } ?>
		<?php if ( ! empty( $author ) ) { ?>
			<h5 class="mkdf-testimonial-author">
				<span class="mkdf-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
            </h5>
				<?php if ( ! empty( $position ) ) { ?>
					<span class="mkdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
				<?php } ?>
		<?php } ?>
	</div>
</div>