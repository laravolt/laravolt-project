<?php

namespace Laravolt\Cms\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Cms\Models\Concerns\FullTextSearch;

class SearchablePost extends Model
{
    use FullTextSearch;

    public $incrementing = false;

    protected $table = 'posts_searchable';

    protected $guarded = [];

    protected $searchable = ['title', 'content'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(
            'default',
            function (Builder $builder) {
                $builder->where('locale', '=', app()->getLocale());
            }
        );
    }

    public function scopeByType(Builder $builder, $type = null)
    {
        if ($type) {
            $builder->whereRaw(sprintf("LOWER(type) = '%s'", strtolower($type)));
        }
    }

    public static function generateCloudTags($searchablePosts)
    {
        $languageContents = [];
        foreach ($searchablePosts as $post) {
            if (isset($languageContents[$post->locale])) {
                $languageContents[$post->locale] .= $post->title.' '.$post->content.' ';
            } else {
                $languageContents[$post->locale] = $post->title.' '.$post->content.' ';
            }
        }

        return $languageContents;
    }
}
