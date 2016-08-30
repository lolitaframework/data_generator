<?php
namespace data_generator;

use \data_generator\LolitaFramework\Core\Arr;
use \data_generator\LolitaFramework\Generator;

class ModelActions
{
    public static function generatePosts()
    {
        check_ajax_referer('Lolita Framework', 'nonce');
        $request = $_GET;
        $count   = (int) Arr::get($request, 'count', 1);
        $args    = (array) Arr::only(
            $request,
            array(
                'post_type',
                'post_title',
                'post_content',
                'post_excerpt',
                'meta',
            )
        );

        $image_args  = (array) Arr::only(
            $request,
            array(
                'image_type',
                'image_id',
            )
        );

        $result = Generator::posts($count, $args, $image_args);
        wp_send_json_success($result);
    }
}