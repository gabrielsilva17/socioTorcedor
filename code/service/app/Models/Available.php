<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Available extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tb_available';

}
