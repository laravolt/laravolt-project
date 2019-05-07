<?php

namespace Laravolt\Cms\Models\Concerns;

use Kalnoy\Nestedset\NodeTrait;
use Laravolt\Cms\Models\Post;

trait HasHierarchy
{
    use NodeTrait;

    protected function getScopeAttributes()
    {
        return ['type'];
    }

    protected function setParentAttribute($parent)
    {
        $this->parent()->associate($parent);
    }
}
