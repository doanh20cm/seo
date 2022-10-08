<?php

cocco_mikado_get_single_post_format_html($blog_single_type);

do_action('cocco_mikado_action_after_article_content');

cocco_mikado_get_module_template_part('templates/parts/single/single-navigation', 'blog');

cocco_mikado_get_module_template_part('templates/parts/single/author-info', 'blog');

cocco_mikado_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

cocco_mikado_get_module_template_part('templates/parts/single/comments', 'blog');