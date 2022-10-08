<?php if (cocco_mikado_options()->getOptionValue('blog_single_navigation') == 'yes') { ?>
    <?php $navigation_blog_through_category = cocco_mikado_options()->getOptionValue('blog_navigation_through_same_category') ?>
    <div class="mkdf-blog-single-navigation">
        <div class="mkdf-blog-single-navigation-inner">
            <?php if (get_previous_post() != "") {
                if ($navigation_blog_through_category == 'yes') {
                    if (get_previous_post(true) != "") {
                        $prev_post = get_previous_post(true);
                    }
                } else {
                    if (get_previous_post() != "") {
                        $prev_post = get_previous_post();
                    }
                }

                $prev_post_ID = $prev_post->ID;
                $prev_background_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post_ID));
                $prev_post_thumbnail = $prev_background_image_src[0];
                $prev_classes = '';

                if ($prev_post_thumbnail == '') {
                    $prev_classes = 'mkdf-nav-no-img';
                }

                $prev_post_title = '';

                if ($prev_post->post_title != '') {
                    $prev_post_title = $prev_post->post_title;
                }

                $prev_html = '<div class="mkdf-nav-holder ' . esc_attr($prev_classes) . '">';
                $prev_html .= '<div class="mkdf-nav-image" style="background-image:url(' . esc_url($prev_post_thumbnail) . ');">';
                $prev_html .= '</div>';
                $prev_html .= '<span class="mkdf-blog-single-nav-label mkdf-btn mkdf-btn-medium mkdf-btn-simple mkdf-btn-underline"><span class="mkdf-btn-text">'.esc_html__("Previous Post", "cocco").'</span></span>';
                $prev_html .= '</div>';

                ?>
                <div class="mkdf-blog-single-prev">
                    <?php
                    if ($navigation_blog_through_category == 'yes') {
                        previous_post_link('%link', $prev_html, true, '', 'category');

                    } else {
                        previous_post_link('%link', $prev_html);
                    }
                    ?>
                </div><!-- close div.blog_prev -->
            <?php } else { ?>
                <div class="mkdf-blog-single-prev"></div>
            <?php } ?>

            <?php if (get_next_post() != "") {
                if ($navigation_blog_through_category == 'yes') {
                    if (get_next_post(true) != "") {
                        $next_post = get_next_post(true);
                    }
                } else {
                    if (get_next_post() != "") {
                        $next_post = get_next_post();
                    }
                }

                $next_post_ID = $next_post->ID;
                $next_background_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($next_post_ID));
                $next_post_thumbnail = $next_background_image_src[0];
                $next_classes = '';

                if ($next_post_thumbnail == '') {
                    $next_classes = 'mkdf-nav-no-img';
                }

                $next_post_title = '';

                if ($next_post->post_title != '') {
                    $next_post_title = $next_post->post_title;
                }

                $next_html = '<div class="mkdf-nav-holder ' . esc_attr($next_classes) . '">';
                $next_html .= '<span class="mkdf-blog-single-nav-label mkdf-btn mkdf-btn-medium mkdf-btn-simple mkdf-btn-underline"><span class="mkdf-btn-text">'.esc_html__("Next Post", "cocco").'</span></span>';
                $next_html .= '<div class="mkdf-nav-image" style="background-image:url(' . esc_url($next_post_thumbnail) . ');">';
                $next_html .= '</div>';
                $next_html .= '</div>';

                ?>
                <div class="mkdf-blog-single-next">
                    <?php
                    if ($navigation_blog_through_category == 'yes') {
                        next_post_link('%link', $next_html, true, '', 'category');
                    } else {
                        next_post_link('%link', $next_html);
                    }
                    ?>
                </div>
            <?php } else { ?>
                <div class="mkdf-blog-single-next"></div>
            <?php } ?>
        </div>
    </div>
<?php } ?>