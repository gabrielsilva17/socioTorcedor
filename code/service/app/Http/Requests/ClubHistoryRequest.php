<?php

namespace App\Http\Requests;

use App\Constants\Constants;

class ClubHistoryRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ds_changed_field' => Constants::REQUIRED,
            'vl_new_value' => Constants::REQUIRED,
            'vl_old_value' => '',
            'cd_club' => Constants::REQUIRED,
            'cd_author' => Constants::REQUIRED
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
            'ds_changed_field' => 'Campo modificado',
            'vl_new_value' => 'Novo valor do campo',
            'vl_old_value' => 'Valor antigo do campo',
            'cd_club' => 'Identificador do clube',
            'cd_author' => 'Identificador do autor da modificação'
        ];
    }
}
