<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-heading">
            <?php cocco_mikado_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-info-top">
                    <?php cocco_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php cocco_mikado_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php cocco_mikado_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php cocco_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <div class="mkdf-post-text-main">
                    <?php cocco_mikado_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php cocco_mikado_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php do_action('cocco_mikado_action_single_link_pages'); ?>
                    <?php cocco_mikado_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>