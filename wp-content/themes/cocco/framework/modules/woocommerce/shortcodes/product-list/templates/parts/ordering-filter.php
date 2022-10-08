<?php if($show_ordering_filter == 'yes'){ ?>
<div class="mkdf-pl-ordering-outer">
    <div class="mkdf-pl-ordering-holder">
        <h6 class="mkdf-pl-ordering-filter-title"><?php esc_html_e('Filter','cocco'); ?></h6>
        <div class="mkdf-pl-ordering">
            <div class="mkdf-pl-ordering-inner">
                <h5 class="mkdf-pl-ordering-title"><?php esc_html_e('Sort By','cocco'); ?></h5>
                <ul>
                    <?php echo cocco_mikado_get_module_part($this_object->getProductOrderingList($params)); ?>
                </ul>
            </div>
            <div class="mkdf-pl-ordering-inner">
                <h5 class="mkdf-pl-ordering-title"><?php esc_html_e('Price Range','cocco'); ?></h5>
                <ul class="mkdf-pl-ordering-price">
                    <?php echo cocco_mikado_get_module_part( $this_object->getProductPricingList($params) ); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php } ?>