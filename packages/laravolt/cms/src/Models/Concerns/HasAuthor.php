<?php

namespace Laravolt\Cms\Models\Concerns;

use Illuminate\Foundation\Auth\User;

trait HasAuthor
{
    public function author()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'author_id');
    }

    protected function setAuthorAttribute(User $author)
    {
        $this->author()->associate($author);
    }
}
