<?php

namespace Laravolt\Cms\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Laravolt\Cms\Contracts\Sortable;
use Laravolt\Cms\Models\Concerns\Featurable;
use Laravolt\Cms\Models\Concerns\HasAuthor;
use Laravolt\Cms\Models\Concerns\HasCategory;
use Laravolt\Cms\Models\Concerns\HasFeaturedImage;
use Laravolt\Cms\Models\Concerns\HasHierarchy;
use Laravolt\Cms\Models\Concerns\HasMenu;
use Laravolt\Cms\Models\Concerns\HasMeta;
use Laravolt\Cms\Models\Concerns\HasReplica;
use Laravolt\Cms\Models\Concerns\HasSlug;
use Laravolt\Cms\Models\Concerns\HasStatuses;
use Laravolt\Cms\Models\Concerns\HasTags;
use Laravolt\Cms\Models\Concerns\Presenter;
use Laravolt\Cms\Models\Concerns\Searchable;
use Laravolt\Cms\Models\Concerns\Shortcode;
use Laravolt\Cms\Models\Concerns\Sortable as SortableTrait;
use Laravolt\Suitable\AutoSort;
use MadWeb\Enum\EnumCastable;
use OwenIt\Auditing\Auditable;
use Portal\Site\Concern\VisibleToUser;
use Portal\Support\Enum\ContentStatus;

class Post extends Model implements Sortable, \OwenIt\Auditing\Contracts\Auditable
{
    use HasAuthor,
        HasSlug,
        HasMeta,
        HasMenu,
        HasFeaturedImage,
        HasCategory,
        HasTags,
        HasStatuses,
        Presenter,
        SortableTrait,
        Shortcode,
        SoftDeletes,
        HasHierarchy,
        HasReplica,
        Searchable,
        AutoSort,
        Auditable,
        Featurable,
        EnumCastable,
        VisibleToUser;

    protected $table = 'posts';

    protected $guarded = ['id'];

    protected $casts = [
        'meta'  => 'array',
    ];

    protected $with = ['author'];

    protected $autoSort = true;

    protected static function boot()
    {
        parent::boot();

        // Relation::morphMap(["POST" => get_called_class()]);
        static::addGlobalScope(
            'default',
            function (Builder $builder) {
                $model = new static;

                if ($builder->getModel()->autoSort) {
                    $builder->autoSort()->latest();
                }

                if (($type = $model->getAttribute('type')) !== null) {
                    $builder->whereType($type);
                }
            }
        );
    }

    public function scopePublished(Builder $builder)
    {
        return $builder->where('posts.status', '=', ContentStatus::PUBLISHED);
    }

    public static function getPublishedPostByIds(string $ids)
    {
        $idsArray = (array)explode(',', $ids);

        if (empty($idsArray)) {
            return collect([]);
        }

        return (new static)->published()->whereIn('id', $idsArray)->orderByRaw(DB::raw("FIELD(id, $ids)"))->get();
    }
}
