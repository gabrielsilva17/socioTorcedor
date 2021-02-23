<?php

namespace App\Services;

use App\Models\Frequency;
use App\Traits\ServiceSoftDelete;

class FrequencyService extends Service
{
    use ServiceSoftDelete;

    /** @var Frequency $model */
    public $model;

    public function __construct(Frequency $model)
    {
        $this->model = $model;
        parent::__construct();
        $this->setSoftDelete();
    }

}
