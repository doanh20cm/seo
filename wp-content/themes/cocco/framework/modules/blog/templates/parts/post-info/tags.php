<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="mkdf-tags-holder">
    <div class="mkdf-tags">
        <span class="dripicons-tags"></span>
        <?php the_tags('', ', ', ''); ?>
    </div>
</div>
<?php } ?>