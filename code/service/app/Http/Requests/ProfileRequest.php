<?php

namespace App\Http\Requests;

use App\Constants\Constants;

class ProfileRequest extends Request
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
            'ds_profile' => Constants::REQUIRED
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
            'nm_name' => 'Nome do perfil',
            'ds_profile' => 'Descrição do perfil'
        ];
    }
}
