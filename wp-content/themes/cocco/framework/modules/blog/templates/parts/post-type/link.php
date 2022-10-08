<?php
$title_tag = isset($link_tag) ? $link_tag : 'h5';
$post_link_meta = get_post_meta(get_the_ID(), "mkdf_post_link_link_meta", true );

if(cocco_mikado_get_blog_module() == 'list') {
    $post_link = get_the_permalink();
    $link_target = '_self';
} else {
    if(!empty($post_link_meta)) {
        $post_link = esc_html($post_link_meta);
        $link_target = '_blank';
    }
}
?>

<div class="mkdf-post-link-holder">
    <div class="mkdf-post-link-holder-inner">
        <<?php echo esc_attr($title_tag);?> itemprop="name" class="mkdf-link-title mkdf-post-title">
        <?php if(isset($post_link) && $post_link != '') { ?>
        <a itemprop="url" href="<?php echo esc_url($post_link); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo esc_attr($link_target);?>">
            <?php } ?>
            <?php echo get_the_title(); ?>
            <?php if(isset($post_link) && $post_link != '') { ?>
        </a>
        <?php } ?>
        </<?php echo esc_attr($title_tag);?>>
    </div>
</div>