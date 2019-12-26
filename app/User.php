<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravolt\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
}
