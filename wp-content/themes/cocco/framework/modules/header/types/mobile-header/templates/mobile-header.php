<?php do_action('cocco_mikado_action_before_mobile_header'); ?>

<header class="mkdf-mobile-header">
	<?php do_action('cocco_mikado_action_after_mobile_header_html_open'); ?>
	
	<div class="mkdf-mobile-header-inner">
		<div class="mkdf-mobile-header-holder">
			<div class="mkdf-grid">
				<div class="mkdf-vertical-align-containers">
					<div class="mkdf-vertical-align-containers">
						<div class="mkdf-position-left"><!--
						 --><div class="mkdf-position-left-inner">
								<?php cocco_mikado_get_mobile_logo(); ?>
							</div>
						</div>
						<div class="mkdf-position-right"><!--
						 --><div class="mkdf-position-right-inner">
                                <div <?php cocco_mikado_class_attribute( $mobile_icon_class ); ?>>
                                    <a href="javascript:void(0)">
									<span class="mkdf-mobile-menu-icon">
                                        <?php echo cocco_mikado_get_icon_sources_html( 'mobile_icon' ); ?>
									</span>
										<?php if(!empty($mobile_menu_title)) { ?>
                                            <h5 class="mkdf-mobile-menu-text"><?php echo esc_attr($mobile_menu_title); ?></h5>
										<?php } ?>
                                    </a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php cocco_mikado_get_mobile_nav(); ?>
	
	<?php do_action('cocco_mikado_action_before_mobile_header_html_close'); ?>
</header>

<?php do_action('cocco_mikado_action_after_mobile_header'); ?>