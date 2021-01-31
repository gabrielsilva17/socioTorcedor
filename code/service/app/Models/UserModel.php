<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tb_user';

}
