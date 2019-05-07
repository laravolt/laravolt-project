<?php

namespace Laravolt\Cms\Events;

use Laravolt\Cms\Models\Post;

class ContentUpdated
{
    public $post;

    public $data;

    /**
     * ContentUpdated constructor.
     *
     * @param $post
     */
    public function __construct(Post $post, array $data = null)
    {
        $this->post = $post;
        $this->data = $data;
    }
}
