<?php

namespace Laravolt\Cms\Models\Concerns;

use Laravolt\Cms\Models\Post;
use Portal\Support\Enum\ContentStatus;

trait HasReplica
{
    public function replica()
    {
        return $this->hasOne(static::class, 'reference_id')
            ->whereIn(
                'posts.status',
                [
                    ContentStatus::DRAFT,
                    ContentStatus::SUBMITTED,
                    ContentStatus::APPROVED,
                ]
            );
    }

    public function reference()
    {
        return $this->belongsTo(static::class, 'reference_id');
    }

    public function hasReplica()
    {
        return $this->replica()->exists();
    }

    public function isReplica()
    {
        return $this->reference()->exists();
    }
}
