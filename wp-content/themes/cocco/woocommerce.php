<?php
/*
Template Name: WooCommerce
*/
?>
<?php
$mkdf_sidebar_layout = cocco_mikado_sidebar_layout();

get_header();
cocco_mikado_get_title();
get_template_part( 'slider' );
do_action('cocco_mikado_action_before_main_content');

//WooCommerce content
if ( ! is_singular( 'product' ) ) { ?>
	<div class="mkdf-container">
		<div class="mkdf-container-inner clearfix">
			<div class="mkdf-grid-row mkdf-grid-large-gutter">
				<div <?php echo cocco_mikado_get_content_sidebar_class(); ?>>
					<?php cocco_mikado_woocommerce_content(); ?>
				</div>
				<?php if ( $mkdf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo cocco_mikado_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="mkdf-container">
		<div class="mkdf-container-inner clearfix">
			<?php cocco_mikado_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>