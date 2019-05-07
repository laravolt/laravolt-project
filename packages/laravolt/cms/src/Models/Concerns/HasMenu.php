<?php

namespace Laravolt\Cms\Models\Concerns;

use Laravolt\Cms\Models\Menu;

trait HasMenu
{
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    protected function setMenuAttribute($menu)
    {
        if (!$menu instanceof Menu) {
            $menu = Menu::find($menu);
        }

        $this->menu()->associate($menu);
    }
}
