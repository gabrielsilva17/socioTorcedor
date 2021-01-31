<?php

namespace App\Services;

use App\Models\Profile;
use App\Traits\ServiceSoftDelete;

class ProfileService extends Service
{
    use ServiceSoftDelete;

    /** @var Profile $model */
    public $model;

    public function __construct(Profile $model)
    {
        $this->model = $model;
        parent::__construct();
        $this->setSoftDelete();
    }

}
