<?php

namespace CoccoCore\CPT\Shortcodes\ProductCategories;

use CoccoCore\Lib;

class ProductCategories implements Lib\ShortcodeInterface
{
    private $base;

    function __construct()
    {
        $this->base = 'mkdf_product_categories';

        add_action('vc_before_init', array($this, 'vcMap'));

        //Portfolio category filter
        add_filter('vc_autocomplete_mkdf_product_categories_category_callback', array(&$this, 'productCategoryAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //Portfolio category render
        add_filter('vc_autocomplete_mkdf_product_categories_category_render', array(&$this, 'productCategoryAutocompleteRender',), 10, 1); // Get suggestion(find). Must return an array
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        vc_map(array(
            'name' => esc_html__('Mikado Product Categories', 'cocco'),
            'base' => $this->base,
            'icon' => 'icon-wpb-product-categories extended-custom-icon',
            'category' => esc_html__('by COCCO', 'cocco'),
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'number_of_categories',
                    'heading' => esc_html__('Number of Product Categories', 'cocco')
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'number_of_columns',
                    'heading' => esc_html__('Number of Columns', 'cocco'),
                    'value' => array(
                        esc_html__('Two', 'cocco') => '2',
                        esc_html__('Three', 'cocco') => '3',
                        esc_html__('Four', 'cocco') => '4',
                        esc_html__('Five', 'cocco') => '5',
                        esc_html__('Six', 'cocco') => '6'
                    ),
                    'save_always' => true
                ),
                array(
                    'type' => 'autocomplete',
                    'param_name' => 'category',
                    'heading' => esc_html__('Show Only Listed Categories', 'cocco'),
                    'settings' => array(
                        'multiple' => true,
                        'sortable' => true,
                        'unique_values' => true
                    ),
                    'description' => esc_html__('Delimit Categories by comma (leave empty for all)', 'cocco')
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'space_between_items',
                    'heading' => esc_html__('Space Between Items', 'cocco'),
                    'value' => array(
                        esc_html__('Normal', 'cocco') => 'normal',
                        esc_html__('Large', 'cocco') => 'large',
                        esc_html__('Small', 'cocco') => 'small',
                        esc_html__('Tiny', 'cocco') => 'tiny',
                        esc_html__('No Space', 'cocco') => 'no'
                    ),
                    'save_always' => true
                )
            )
        ));
    }

    public function render($atts, $content = null)
    {
        $default_atts = array(
            'number_of_categories' => '',
            'number_of_columns' => '',
            'category' => '',
            'space_between_items' => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        $results = $this->getCategories($params);
        $params['query_result'] = $results;
        $params['holder_clases'] = $this->getHolderClasses($params);
        $params['this_object'] = $this;

        $html = cocco_mikado_get_woo_shortcode_module_template_part('templates/holder', 'product-categories', '', $params);

        return $html;
    }

    private function getCategories($params)
    {
        $tax_args = array(
            'hide_empty' => true,
            'orderby' => 'name',
            'order' => 'ASC'
        );
        if (isset($params['category']) && $params['category'] !== '') {

            $cats = explode(',', $params['category']);
            $choosen_taxes = array();
            foreach ($cats as $cat_slug) {
                $tax = get_term_by('slug', $cat_slug, 'product_cat');
                $choosen_taxes[] = $tax->term_id;
            };

            $tax_args['include'] = $choosen_taxes;
            $tax_args['number'] = count($cats);
            $tax_args['orderby'] = 'include';

        } else {
            $tax_args['number'] = $params['number_of_categories'];
        }
        $taxes = get_terms('product_cat', $tax_args);

        if (!empty($taxes) && !is_wp_error($taxes)) {
            return $taxes;
        } else {
            return array();
        }

        return array();

    }

    /**
     * Generates holder classes
     *
     * @param $params
     *
     * @return string
     */
    private function getHolderClasses($params)
    {
        $holderClasses = array();
        if ($params['space_between_items'] !== '') {
            $holderClasses[] = 'mkdf-' . $params['space_between_items'] . '-space';
        }

        $holderClasses[] = $this->getColumnNumberClass($params);

        return implode(' ', $holderClasses);
    }

    /**
     * Generates columns number classes for product list holder
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params)
    {

        $columns = $params['number_of_columns'];

        switch ($columns) {
            case 2:
                $columnsNumber = 'mkdf-two-columns';
                break;
            case 3:
                $columnsNumber = 'mkdf-three-columns';
                break;
            case 4:
                $columnsNumber = 'mkdf-four-columns';
                break;
            case 5:
                $columnsNumber = 'mkdf-five-columns';
                break;
            case 6:
                $columnsNumber = 'mkdf-six-columns';
                break;
            default:
                $columnsNumber = 'mkdf-six-columns';
                break;
        }

        return $columnsNumber;
    }

    /**
     * Filter product categories
     *
     * @param $query
     *
     * @return array
     */
    public function productCategoryAutocompleteSuggester($query)
    {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'product_cat' AND a.name LIKE '%%%s%%'", stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['slug'];
                $data['label'] = ((strlen($value['category_title']) > 0) ? esc_html__('Category', 'cocco') . ': ' . $value['category_title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    /**
     * Find product category by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function productCategoryAutocompleteRender($query)
    {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get product category
            $product_category = get_term_by('slug', $query, 'product_cat');
            if (is_object($product_category)) {

                $category_slug = $product_category->slug;
                $category_title = $product_category->name;

                $category_title_display = '';
                if (!empty($category_title)) {
                    $category_title_display = esc_html__('Category', 'cocco') . ': ' . $category_title;
                }

                $data = array();
                $data['value'] = $category_slug;
                $data['label'] = $category_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }

}