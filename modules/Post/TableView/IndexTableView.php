<?php

namespace Modules\Post\TableView;

use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;

class IndexTableView extends TableView
{
    protected function columns()
    {
        return [
            Numbering::make('No'),
                    Text::make('title')->sortable(),
                    Text::make('content')->sortable(),
                    Text::make('author_id')->sortable(),
            RestfulButton::make('post'),
        ];
    }
}
