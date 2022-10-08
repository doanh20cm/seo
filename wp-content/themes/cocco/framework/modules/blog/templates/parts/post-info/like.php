<?php if(cocco_mikado_core_plugin_installed()) { ?>
    <div class="mkdf-blog-like">
        <?php if( function_exists('cocco_mikado_get_like') ) cocco_mikado_get_like(); ?>
    </div>
<?php } ?>