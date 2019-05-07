<?php

namespace Laravolt\Cms\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\SchemalessAttributes;

trait HasMeta
{
    public function getMetaAttribute(): SchemalessAttributes
    {
        return SchemalessAttributes::createForModel($this, 'meta');
    }

    public function scopeWithMeta(): Builder
    {
        return SchemalessAttributes::scopeWithSchemalessAttributes('meta');
    }
}
