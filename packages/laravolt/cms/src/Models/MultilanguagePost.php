<?php

namespace Laravolt\Cms\Models;

use Laravolt\Cms\Models\Concerns\HasTranslations;

class MultilanguagePost extends Post
{
    use HasTranslations;

    protected static function boot()
    {
        parent::boot();
    }
}
