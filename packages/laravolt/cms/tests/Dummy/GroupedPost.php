<?php

namespace Laravolt\Cms\Tests\Dummy;

use Laravolt\Cms\Models\Post;

class GroupedPost extends Post
{
    protected static $sortable = [
        'group_by' => 'type',
    ];
}
