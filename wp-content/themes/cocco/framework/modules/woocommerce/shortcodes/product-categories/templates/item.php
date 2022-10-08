<div class="mkdf-product-category <?php echo esc_attr($item_classes) ?>">

    <div class="mkdf-product-category-inner">
        <a class="mkdf-link" href="<?php echo esc_url($link); ?>"></a>

        <?php
        if (isset($img_url) && $img_url !== '') { ?>

            <div class="mkdf-product-category-img-wrapper">
                <div class="mkdf-pcw-inner">
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($term->name); ?>">
                </div>
            </div>

        <?php }
        ?>

        <div class="mkdf-product-category-content">

            <h6 class="mkdf-category-title">
                <?php
                echo esc_attr($term->name);
                ?>
            </h6>
        </div>

    </div>
</div>
