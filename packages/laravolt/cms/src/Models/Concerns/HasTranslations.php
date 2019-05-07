<?php

namespace Laravolt\Cms\Models\Concerns;

trait HasTranslations
{
    use \Spatie\Translatable\HasTranslations;

    public $translatable = ['title', 'content'];
}
