<?php
namespace data_generator\LolitaFramework\Generator\Modules;

use \data_generator\LolitaFramework\Core\Arr;

class Post
{
    /**
     * Post properties
     * @var array
     */
    private $properties = array();

    /**
     * Meta data to add in to post
     * @var array
     */
    private $meta_data = array();

    /**
     * Inserted post id
     * @var null
     */
    private $inserted_id = null;

    /**
     * Class constructor
     *
     * @param array $properties
     */
    public function __construct($properties, $meta_data = array())
    {
        $this->properties = $properties;
        $this->meta_data  = array_merge(
            array(
                'lf_generator' => true,
            ),
            $meta_data
        );
    }

    /**
     * Insert post with all sutf ( meta, terms, images )
     *
     * @param  boolean $unique
     * @return Post instance
     */
    public function insert($unique = false)
    {
        $this->properties['post_type'] = Arr::get($this->properties, 'post_type', 'post');
        if ($unique && array_key_exists('post_title', $this->properties)) {
            $post = get_page_by_path(sanitize_title($this->properties['post_title']), OBJECT, $post_type);
            if ( null !== $post ) {
                $this->properties['ID'] = $post->ID;
            }
        }
        $this->inserted_id = wp_insert_post($this->properties);
        if (!is_wp_error($this->inserted_id) && 0 < $this->inserted_id) {
            $this->addMeta();
        }
        return $this->inserted_id;
    }

    /**
     * Add meta to post
     *
     * @return Post instance
     */
    public function addMeta()
    {
        foreach ($this->meta_data as $key => $value) {
            update_post_meta($this->inserted_id, $key, $value);
        }
        return $this;
    }
}
