<?php

namespace App\Traits;

use App\Constants\Constants;

/**
 * Trait ResponseTrait
 * @package App\Traits
 */
trait ServiceSoftDelete
{
    public function setSoftDelete($status = true) : void
    {
        if ($status) {
            $this->queryBuilder = $this->queryBuilder->whereNull(Constants::TS_REMOVED);
        }
    }
}
