<?php

namespace App\Services;

use App\Models\Available;
use App\Traits\ServiceSoftDelete;

class AvailableService extends Service
{
    use ServiceSoftDelete;

    /** @var Available $model */
    public $model;

    public function __construct(Available $model)
    {
        $this->model = $model;
        parent::__construct();
        $this->setSoftDelete();
    }

}
