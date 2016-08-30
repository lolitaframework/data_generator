<?php
namespace data_generator;

use \data_generator\LolitaFramework\Core\Arr;

class ModelMain
{
    public static function postTypes()
    {
        $types = get_post_types(array(), 'objects');
        $types = Arr::pluck($types, 'label', 'name');
        $types = Arr::except($types, array('attachment', 'revision', 'nav_menu_item'));
        return $types;
    }
}