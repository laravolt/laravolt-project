<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSort;
use Sofa\Eloquence\Eloquence;

class Post extends Model
{
    use AutoSort, AutoFilter;
    use Eloquence;

    protected $guarded = [];

    protected $searchableColumns = ["title", "content",];
}
