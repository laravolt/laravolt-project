<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravolt\Epicentrum\Models\User as Authenticatable;
use Laravolt\Suitable\AutoSort;

class User extends Authenticatable
{
    use Notifiable, AutoSort;
}
