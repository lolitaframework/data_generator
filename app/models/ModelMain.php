<?php
namespace data_generator;

use \data_generator\LolitaFramework\Core\Arr;

class ModelMain
{
    /**
     * Get post types to select control
     *
     * @return array
     */
    public static function postTypes()
    {
        $types = get_post_types(array(), 'objects');
        $types = Arr::pluck($types, 'label', 'name');
        $types = Arr::except($types, array('attachment', 'revision', 'nav_menu_item'));
        return $types;
    }

    /**
     * Get taxonomies to select control
     * @return array
     */
    public static function taxonomies()
    {
        $taxonomies = get_taxonomies(array(), false);
        $taxonomies = Arr::pluck($taxonomies, 'label', 'name');
        $taxonomies = Arr::except($taxonomies, array('nav_menu', 'link_category', 'post_format'));
        return $taxonomies;
    }
}