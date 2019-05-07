<?php

namespace Laravolt\Cms\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Sluggable\SlugOptions;

trait HasSlug
{
    use \Spatie\Sluggable\HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function scopeBySlug(Builder $builder, $slug)
    {
        return $builder->where("slug", $slug);
    }
}
