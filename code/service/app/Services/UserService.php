<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ServiceSoftDelete;

class UserService extends Service
{
    use ServiceSoftDelete;

    /** @var User $model */
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct();
        $this->setSoftDelete();
    }

}
