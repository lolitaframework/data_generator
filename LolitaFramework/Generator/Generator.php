<?php
namespace data_generator\LolitaFramework\Generator;

use \data_generator\LolitaFramework\Core\Str;
use \data_generator\LolitaFramework\Generator\Modules\Post;
use \data_generator\LolitaFramework\Generator\Modules\Term;

class Generator
{
    /**
     * Create few posts
     *
     * @return array
     */
    public static function posts($count, $args = array(), $unique = true, $image_args = array(), $meta_data = array())
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
            $post     = new Post($new_args, $image_args, $meta_data);
            $return[] = $post->insert($unique);
        }
        return $return;
    }

    /**
     * Create few terms
     *
     * @param  integer  $count
     * @param  array    $args
     * @param  boolean  $unique 
     * @param  array    $meta_data 
     * @return array
     */
    public static function terms($count, $title, $taxonomy, $args = array(), $meta_data = array())
    {
        $return = array();
        $count  = max(1, (int) $count);
        for($i = 0; $i < $count; $i++) {
            $insert_title     = str_replace('{n}', $i, $title);
            $new_args         = $args;
            $new_args['slug'] = Str::slug($title, '_');
            $term             = new Term($insert_title, $taxonomy, $args, $meta_data);
            $return[]         = $term->insert();
        }
        return $return;
    }
}
