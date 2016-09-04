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
        $unique = (bool) Arr::get($request, 'unique', true);
        $result = Generator::posts($count, $args, $unique, $image_args, $meta);

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
        $request = $_POST;
        $result  = Generator::deletePosts(
            array(
                'post_type' => Arr::get($request, 'post_type', 'post'),
            )
        );
        wp_send_json_success($result);
    }

    /**
     * Generate new terms
     *
     * @return void
     */
    public static function generateTerms()
    {
        check_ajax_referer('Lolita Framework', 'nonce');
        $request  = $_POST;
        $count    = (int) Arr::get($request, 'count', 1);
        $title    = (string) Arr::get($request, 'title');
        $taxonomy = (string) Arr::get($request, 'taxonomy');
        $meta     = (array) Arr::get($request, 'meta', array());
        $meta     = Arr::pluck($meta, 'value', 'name');
        $args     = (array) Arr::only(
            $request,
            array(
                'alias_of',
                'description',
                'parent',
                'slug',
            )
        );

        $result = Generator::terms($count, $title, $taxonomy, $args, $meta);

        wp_send_json_success($result);
    }

    /**
     * Delete generated posts
     *
     * @return void
     */
    public static function deleteTerms()
    {
        check_ajax_referer('Lolita Framework', 'nonce');
        $request = $_POST;
        $result  = Generator::deleteTerms(
            array(
                'taxonomy' => Arr::get($request, 'taxonomy', 'category'),
            )
        );
        wp_send_json_success($result);
    }
}