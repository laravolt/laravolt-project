<?php

namespace Laravolt\Cms\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Laravolt\Cms\Models\Tag;

trait HasCategory
{
    public static function createCategory($name)
    {
        $tag = new Tag();
        $tag->name = $name;
        $tag->type = static::categoryType();
        $tag->save();

        return $tag;
    }

    public static function categories($keyword = null)
    {
        $categories = Tag::filterByCurrentUser()->withType(static::categoryType())->get();

        if ($keyword) {
            $keyword = strtolower($keyword);
            $categories = $categories->filter(function ($item, $key) use ($keyword) {
                return str_contains(strtolower($item->name), $keyword)
                    || str_contains(strtolower($item->slug), $keyword);
            });
        }

        return $categories;
    }

    public static function categoriesDropdown()
    {
        return static::categories()->pluck('name', 'name');
    }

    public static function publishedCategories()
    {
        return Tag::withType(static::categoryType())->get();
    }

    public function scopeByCategory(Builder $builder, $category = null)
    {
        if ($category) {
            $builder->whereHas(
                'tags',
                function (Builder $query) use ($category) {
                    $tagIds = Tag::whereSlugDefault($category)->pluck('id');

                    $query->whereIn('tags.id', $tagIds);
                }
            );
        }
    }

    protected static function categoryType()
    {
        return 'category';
    }

    protected function getCategoryAttribute()
    {
        return optional($this->tags->last())->name;
    }

    protected function setCategoryAttribute(?string $category)
    {
        if ($category === null) {
            $this->tags()->sync([]);
            return;
        }

        if ($this->exists) {
            $this->syncTagsWithType([Tag::findOrCreate($category, static::categoryType())], static::categoryType());
        } else {
            $this->queuedTags = [Tag::findOrCreate($category, static::categoryType())];
        }
    }
}
