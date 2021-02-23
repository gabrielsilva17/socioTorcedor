<?php

namespace App\Services;

use App\Models\Flat;
use App\Traits\ServiceSoftDelete;

class FlatService extends Service
{
    use ServiceSoftDelete;

    /** @var Flat $model */
    public $model;

    public function __construct(Flat $model)
    {
        $this->model = $model;
        parent::__construct();
        $this->setSoftDelete();
    }

}
