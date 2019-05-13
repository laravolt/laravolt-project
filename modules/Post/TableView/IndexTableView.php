<?php

namespace Modules\Post\TableView;

use App\User;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\Headers\Search\SelectHeader;
use Laravolt\Suitable\TableView;

class IndexTableView extends TableView
{
    protected function columns()
    {
        return [
            Numbering::make('No'),
            Text::make('title')->sortable(false)->searchable(),
            Text::make('content')->sortable()->searchable(),
            Text::make('author_id')->sortable()->searchable(
                'author_id',
                SelectHeader::make('author_id', User::pluck('name', 'id')->prepend('All')->toArray())
            ),
            RestfulButton::make('post'),
        ];
    }
}
