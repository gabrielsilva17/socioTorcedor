<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ClubHistory extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tb_club_history';

}
