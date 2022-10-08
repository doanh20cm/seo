<?php
$share_type = isset($share_type) ? $share_type : 'dropdown';
?>
<?php if( cocco_mikado_core_plugin_installed() && cocco_mikado_options()->getOptionValue('enable_social_share') === 'yes' && cocco_mikado_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="mkdf-blog-share">
        <?php echo cocco_mikado_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>