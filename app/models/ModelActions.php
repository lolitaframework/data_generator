<?php
namespace data_generator;

use \data_generator\LolitaFramework\Core\Arr;
use \data_generator\LolitaFramework\Generator\Generator;

class ModelActions
{
    /**
     * Generate new posts
     *
     * @return void
     */
    public static function generatePosts()
    {
        check_ajax_referer('Lolita Framework', 'nonce');
        $request = $_POST;
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

        $meta   = (array) Arr::get($request, 'meta', array());
        $meta   = Arr::pluck($meta, 'value', 'name');
        $result = Generator::posts($count, $args, $image_args, $meta);

        wp_send_json_success($result);
    }

    /**
     * Delete generated posts
     *
     * @return void
     */
    public static function deletePosts()
    {
        check_ajax_referer('Lolita Framework', 'nonce');
        $request   = $_POST;
        $result    = array();
        $post_type = Arr::get($_POST, 'post_type', 'post');
        $args      = array(
            'posts_per_page'   => -1,
            'meta_key'         => 'lf_generator',
            'post_type'        => $post_type,
            'post_status'      => 'publish',
        );

        $items = get_posts($args);
        foreach ($items as $item) {
            $result[] = false !== wp_delete_post($item->ID);
        }
        wp_send_json_success($result);
    }
}