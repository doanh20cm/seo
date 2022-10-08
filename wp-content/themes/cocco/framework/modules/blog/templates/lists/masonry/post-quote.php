<?php
$post_classes[] = 'mkdf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes);?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-text-main">
                    <div class="mkdf-post-mark">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="167.5px" height="146.5px" viewBox="0 0 167.5 146.5" enable-background="new 0 0 167.5 146.5" xml:space="preserve">
                            <path fill="#F16F95" d="M34.558,46.648c0,0-23.75,38.75,21.75,87.5c0,0,1.5,6.225-5,4.25c0,0-57.75-49.75-35-109
	c0,0,12.25-29.398,40.714-21.25c0,0,28.286,11.102,15.036,37.5C72.058,45.648,58.308,66.5,34.558,46.648z"/>
                            <path fill="#F16F95" d="M118.558,46.648c0,0-23.75,38.75,21.75,87.5c0,0,1.5,6.225-5,4.25c0,0-57.75-49.75-35-109
	c0,0,12.25-29.398,40.714-21.25c0,0,28.286,11.102,15.036,37.5C156.058,45.648,142.308,66.5,118.558,46.648z"/>
                        </svg>
                    </div>
                    <?php cocco_mikado_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>