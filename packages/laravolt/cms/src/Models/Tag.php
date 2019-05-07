<?php

namespace Laravolt\Cms\Models;

use Illuminate\Database\Eloquent\Builder;
use Laravolt\Suitable\AutoSort;
use Portal\Site\Concern\FilterByCurrentUser;
use Spatie\Tags\Tag as BaseTag;

class Tag extends BaseTag
{
    use AutoSort, FilterByCurrentUser;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(
            'default',
            function (Builder $builder) {
                $builder->autoSort();
            }
        );
    }

    public function scopeWithType(Builder $query, string $type = null): Builder
    {
        if (is_null($type)) {
            return $query;
        }

        return $query->where('type', $type);
    }
}
