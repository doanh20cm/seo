<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes);?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-text-main">
                    <div class="mkdf-post-mark">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="143px" height="143px" viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve">
                        <path fill="#d9dd80" d="M90.8,63.9L67,40.1c-1.6-1.6-4.1-1.6-5.7,0l-7.8,7.8l-9.4-9.4l7.8-7.8c1.6-1.6,1.6-4.1,0-5.7L28.1,1.2
                            c-1.6-1.6-4.1-1.6-5.7,0L1.2,22.5C0.4,23.2,0,24.2,0,25.3c0,1.1,0.4,2.1,1.2,2.8L25,51.9c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2
                            l7.8-7.8l9.4,9.4l-7.8,7.8c-1.6,1.6-1.6,4.1,0,5.7l23.8,23.8c0.8,0.8,1.8,1.2,2.8,1.2c1.1,0,2.1-0.4,2.8-1.2l21.3-21.3
                            C92.4,68,92.4,65.4,90.8,63.9z M27.8,43.4L9.7,25.3L25.3,9.7l18.1,18.1l-5,5l-3-3c-1.6-1.6-4.1-1.6-5.7,0c-1.6,1.6-1.6,4.1,0,5.7
                            l3,3L27.8,43.4z M66.7,82.3L48.6,64.2l5-5l3,3c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-3-3l5-5l18.1,18.1
                            L66.7,82.3z"/>
                        </svg>
                    </div>
                    <?php cocco_mikado_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>