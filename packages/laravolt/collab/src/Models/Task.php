<?php

namespace Laravolt\Collab\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'collab_tasks';

    protected $guarded = [];

    protected $casts = [
        'attachments' => 'array',
        'labels' => 'array',
    ];
}
