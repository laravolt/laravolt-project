<?php

namespace Laravolt\Collab\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'collab_projects';

    protected $guarded = [];

    protected $casts = [
        'members' => 'array'
    ];
}
