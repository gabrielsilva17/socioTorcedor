<?php

namespace App\Http\Requests;

use App\Constants\Constants;

class FrequencyRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nm_name' => Constants::REQUIRED
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
            'nm_name' => 'Name frequency'
        ];
    }
}
