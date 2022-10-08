<?php if($show_category_filter == 'yes'){ ?>
<div class="mkdf-pl-categories">
	<ul>
        <?php echo cocco_mikado_get_module_part($this_object->getProductCategoriesList($params)); ?>
    </ul>
</div>
<?php } ?>