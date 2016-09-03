<?php
namespace data_generator\LolitaFramework\Generator;

use \data_generator\LolitaFramework\Core\Loc;
use \data_generator\LolitaFramework\Core\Cls;
use \data_generator\LolitaFramework\Generator\Modules\Post;

class Generator
{
    /**
     * Create few posts
     *
     * @return array
     */
    public static function posts($count, $args = array(), $image_args = array())
    {
        $count  = max(1, (int) $count);
        $return = array();
        $args   = array_merge(
            array(
                'post_type'    => 'post',
                'post_title'   => 'Sample post {n}',
                'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, magnam.',
                'post_status'  => 'publish',
                'post_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, magnam',
            ),
            $args
        );
        $image_args = array_merge(
            array(
                'image_type' => 'random',
                'image_id'   => '',
            ),
            $image_args
        );

        for($i = 0; $i < $count; $i++) {
            $new_args = $args;
            $new_args['post_title'] = str_replace('{n}', $i, $new_args['post_title']);
            $post     = new Post($new_args, $image_args);
            $return[] = $post->insert();
        }
        return $return;
    }
}
