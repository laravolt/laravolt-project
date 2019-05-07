<?php

namespace Laravolt\Cms\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Featurable
{
    public static function allFeatured()
    {
        return static::featured()->published()->get()->sortBy(
            function ($item) {
                return $item->featured_position;
            }
        );
    }

    public static function updateFeatured(?array $ids)
    {
        static::featured()->get()->each->removeFromFeatured();

        collect($ids)->each(
            function ($id, $index) {
                if ((($model = static::find($id)) !== null) && $model->is_published) {
                    $model->featured = true;
                    $model->featured_position = $index;
                    $model->save();
                }
            }
        );
    }

    public function scopeFeatured(Builder $builder)
    {
        // $builder->withMeta('featured', true);
        $builder->where(
            function ($query) {
                $table = $this->getTable();
                $query->where("$table.meta->featured", 1)
                    ->orWhere("$table.meta->featured", "1")
                    ->orWhere("$table.meta->featured", true)
                    ->orWhere("$table.meta->featured", "true");
            }
        );
    }

    protected function setFeaturedAttribute(bool $featured)
    {
        $this->meta['featured'] = $featured;
    }

    protected function getFeaturedAttribute()
    {
        return $this->meta['featured'];
    }

    protected function setFeaturedPositionAttribute(int $position)
    {
        $this->meta['featured_position'] = $position;
    }

    protected function getFeaturedPositionAttribute()
    {
        // If featured position not set, assume it has last position
        return $this->meta['featured_position'] ?? 999;
    }

    public function removeFromFeatured()
    {
        $this->featured = false;

        return $this->save();
    }
}
