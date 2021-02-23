<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Flat extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tb_flat';

}
