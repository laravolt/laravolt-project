<?php

namespace Laravolt\Cms\Models\Concerns;

trait Searchable
{
    public function scopeSearch($query, $keyword)
    {
        return $query->when(
            $keyword,
            function ($q) use ($keyword) {
                $q->withAnyTags($keyword, 'category')
                    ->orWhereRaw('LOWER(`title`) like ?', '%'.( strtolower($keyword)).'%')
                    ->orWhereRaw('LOWER(`content`) like ?', '%'.( strtolower($keyword)).'%')
                    ->orWhereRaw('LOWER(`slug`) like ?', '%'.( strtolower($keyword)).'%')
                    ->orWhereHas(
                        'author',
                        function ($q2) use ($keyword) {
                            $q2->whereRaw('LOWER(`name`) like ?', '%'.( strtolower($keyword)).'%');
                        }
                    )->orWhereHas(
                        'menu',
                        function ($q2) use ($keyword) {
                            $q2->whereRaw('LOWER(`title`) like ?', '%'.( strtolower($keyword)).'%');
                        }
                    )->orWhereHas(
                        'tags',
                        function ($q2) use ($keyword) {
                            $q2->whereRaw('LOWER(`name`) like ?', '%'.( strtolower($keyword)).'%');
                        }
                    );
            }
        );
    }
}
