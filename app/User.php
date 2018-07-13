<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravolt\Epicentrum\Models\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
}
