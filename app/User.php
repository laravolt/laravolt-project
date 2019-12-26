<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravolt\Platform\Models\User as Authenticatable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSort;

class User extends Authenticatable
{
    use AutoSort;
    use AutoFilter;
    use Notifiable;
}
