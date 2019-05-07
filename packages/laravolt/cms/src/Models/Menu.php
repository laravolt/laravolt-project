<?php

namespace Laravolt\Cms\Models;

class Menu extends MultilanguagePost
{
    protected $attributes = [
        'type' => 'MENU',
    ];

    public function dropdownTree($placeholder = true)
    {
        $menu = $this
            ->withDepth()
            ->get()
            ->toFlatTree()
            ->pluck('title_indented', 'id');

        if ($placeholder) {
            $menu->prepend(__('[TOP LEVEL]'), 0);
        }

        return $menu;
    }

    public function getTitleIndentedAttribute()
    {
        return sprintf('%s %s', str_repeat('----', $this->depth), $this->title);
    }
}
