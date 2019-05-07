<?php

namespace Laravolt\Cms\Events;

use Laravolt\Cms\Models\Post;

class ContentCreated
{
    public $post;

    public $data = [];

    /**
     * ContentUpdated constructor.
     *
     * @param $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
