<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tb_club';

}
