<?php

namespace Laravolt\Cms\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravolt\Cms\Events\ContentCreated;
use Laravolt\Cms\Events\ContentUpdated;
use Laravolt\Cms\Exceptions\CmsException;
use Laravolt\Cms\Models\Post;

class PostService
{
    protected $model;

    protected $attributes;

    protected $type;

    protected $status;

    protected $author;

    protected $menu;

    protected $meta = [];

    public function bind(Post $model)
    {
        $this->model = $model;
        $this->type($model->type);

        return $this;
    }

    public function create($data = null)
    : Post {
        $post = $this->resolveModel();
        $post->fill(
            [
                'type'   => config('laravolt.cms.default_type'),
                'status' => config('laravolt.cms.default_status'),
                'author' => Auth::user(),
            ]
        );

        $post = $this->savePost($post, $data);

        event(new ContentCreated($post));

        return $post;
    }

    public function update(Post $post, ?array $data = null)
    : Post {
        $post = $this->savePost($post, $data);

        event(new ContentUpdated($post, $data));

        return $post;
    }

    public function delete(Post $post)
    : bool {
        return $post->delete();
    }

    public function title($title)
    : self {
        $this->attributes['title'] = $title;

        return $this;
    }

    public function slug($slug)
    : self {
        $this->attributes['slug'] = $slug;

        return $this;
    }

    public function content($content)
    : self {
        $this->attributes['content'] = $content;

        return $this;
    }

    public function author($author)
    : self {
        $this->author = $author;

        return $this;
    }

    public function menu($menu)
    : self {
        $this->menu = $menu;

        return $this;
    }

    public function type(string $type)
    : self {
        $this->type = $type;

        return $this;
    }

    public function status(string $status)
    : self {
        $this->status = $status;

        return $this;
    }

    public function category(?string $category)
    : self {
        $this->attributes['category'] = $category;

        return $this;
    }

    public function tags(?array $tags)
    : self {
        $this->attributes['tags'] = $tags;

        return $this;
    }

    public function meta($meta)
    : self {
        $this->meta = $meta + $this->meta;

        return $this;
    }

    public function position(?int $position)
    : self {
        $this->attributes['position'] = $position;

        return $this;
    }

    public function parent($parent)
    : self {
        $this->attributes['parent'] = $parent;

        return $this;
    }

    public function addMeta($key, $value = null)
    : self {
        if (is_array($key)) {
            $meta = $key;
        } elseif (is_string($key) && $value !== null) {
            $meta = [$key => $value];
        }

        $this->meta = $meta + $this->meta;

        return $this;
    }

    public function removeMeta($key)
    : self {
        array_forget($this->meta, $key);

        return $this;
    }

    public function sort(array $ids, int $startPosition = 1)
    : void {
        Post::sort($ids, $startPosition);
    }

    public function replicate(Post $post, $status = null)
    {
        if ($post->hasReplica()) {
            throw new CmsException('Content already sent to Content Writer');
        }

        $replica = $post->replicate(['title_default', 'content_default']);
        $replica->reference_id = $post->getKey();
        $replica->status = $status;
        $replica->type = $post->type;
        $replica->category = $post->category;

        $replica->save();

        return $replica;
    }

    public function merge(Post $post)
    {
        if (!$post->isReplica()) {
            throw new CmsException("Content doesn't have reference, cannot merge back");
        }

        return DB::transaction(
            function () use ($post) {
                /* @var Post $originalContent */
                $originalContent = $post->reference;

                $attributes = collect($post->getOriginal())
                    ->except('title_default', 'content_default')
                    ->put('id', $originalContent->getKey())
                    ->toArray();

                $originalContent->setRawAttributes($attributes);
                $originalContent->category = $post->category;
                $originalContent->save();

                $post->delete();

                return $originalContent;
            }
        );
    }

    protected function savePost($post, $data = null)
    {
        $this->fillAttributes($data);

        $this->validateAttributes($post);

        $post->type = array_get($data, 'type', $this->type ?? $post->type);
        $post->status = array_get($data, 'status', $this->status ?? $post->status);
        $post->author = array_get($data, 'author', $this->author ?? $post->author);
        $post->menu = array_get($data, 'menu', $this->menu ?? $post->menu);
        $post->meta = array_get($data, 'meta', $this->meta ?? $post->meta->all()) + $post->meta->all();

        // sory meta alphabetically
        $post->meta = collect($post->meta->all())->sortKeys()->toArray();

        if (array_has($this->attributes, 'title')) {
            $post->title = array_get($this->attributes, 'title');
        }

        if (array_has($this->attributes, 'slug')) {
            $post->slug = array_get($this->attributes, 'slug');
        }

        if (array_has($this->attributes, 'content')) {
            $post->content = array_get($this->attributes, 'content');
        }

        if (array_has($this->attributes, 'position')) {
            $post->position = array_get($this->attributes, 'position');
        }

        if (array_has($this->attributes, 'parent')) {
            $post->parent = array_get($this->attributes, 'parent');
        }

        $updatingPosition = $post->exists && $post->isDirty('position');
        $post->save();

        if (array_has($this->attributes, 'category')) {
            $category = array_get($this->attributes, 'category');
            $post->category = $category;
        }

        if (array_has($this->attributes, 'tags')) {
            $tags = array_get($this->attributes, 'tags');
            $post->syncTagsWithType((array)$tags, 'tags');
        }

        if ($updatingPosition) {
            $post->reposition();
        }

        return $post->fresh();
    }

    protected function fillAttributes($data)
    {
        if (is_string($data)) {
            $this->title($data);
        } elseif (is_array($data)) {
            $whitelistAttributes = [
                'title',
                'slug',
                'content',
                'author',
                'category',
                'tags',
                'position',
                'parent',
                'menu',
            ];
            foreach ($whitelistAttributes as $attribute) {
                if (array_has($data, $attribute)) {
                    $this->$attribute(array_get($data, $attribute));
                }
            }
        }
    }

    protected function validateAttributes(Post $post)
    {
        if (is_null(array_get($this->attributes, 'title', $post->title))) {
            throw new \InvalidArgumentException('Post title cannot be null');
        }
    }

    protected function resolveModel()
    {
        if (!$this->model) {
            $this->model = app(config('laravolt.cms.binding.post'));
        }

        if (!$this->model instanceof Post) {
            throw new \InvalidArgumentException('Cannot resolve model binding');
        }

        return $this->model;
    }
}
