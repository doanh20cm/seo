<?php do_action('cocco_mikado_action_before_page_header'); ?>

<aside class="mkdf-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
	<div class="mkdf-vertical-menu-area-inner">
		<div class="mkdf-vertical-area-background"></div>
		<?php if(!$hide_logo) {
			cocco_mikado_get_logo();
		} ?>
		<?php cocco_mikado_get_header_vertical_main_menu(); ?>
		<div class="mkdf-vertical-area-widget-holder">
			<?php cocco_mikado_get_header_vertical_widget_areas(); ?>
		</div>
	</div>
</aside>

<?php do_action('cocco_mikado_action_after_page_header'); ?>