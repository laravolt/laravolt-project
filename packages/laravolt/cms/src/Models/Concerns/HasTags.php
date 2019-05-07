<?php

namespace Laravolt\Cms\Models\Concerns;

trait HasTags
{
    use \Spatie\Tags\HasTags;

    protected function getTagsArrayAttribute()
    {
        return $this->tags->pluck('name')->toArray();
    }
}
