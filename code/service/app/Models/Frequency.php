<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Frequency extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tb_frequency';

}
