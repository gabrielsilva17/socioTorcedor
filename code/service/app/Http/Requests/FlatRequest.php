<?php

namespace App\Http\Requests;

use App\Constants\Constants;

class FlatRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nm_name' => Constants::REQUIRED,
            'vl_monthly_value' => Constants::REQUIRED,
            'vl_annual_value' => Constants::REQUIRED,
            'ds_description' => '',
            'fl_authenticate_document' => '',
            'cd_available' => '',
            'cd_payment' => '',
            'cd_frequency' => ''
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'nm_name' => 'Name payment',
            'vl_monthly_value' => 'Monthy value',
            'vl_annual_value' => 'Annual value',
            'ds_description' => 'Description flat',
            'fl_authenticate_document' => 'Authenticate document',
            'cd_available' => 'Identity avaible PK',
            'cd_payment' => 'Identity payment type PK',
            'cd_frequency' => 'Identity frequency type PK'
        ];
    }
}
