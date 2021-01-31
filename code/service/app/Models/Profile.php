<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tb_profile';

}
