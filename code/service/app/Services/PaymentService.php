<?php

namespace App\Services;

use App\Models\Payment;
use App\Traits\ServiceSoftDelete;

class PaymentService extends Service
{
    use ServiceSoftDelete;

    /** @var Payment $model */
    public $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;
        parent::__construct();
        $this->setSoftDelete();
    }

}
