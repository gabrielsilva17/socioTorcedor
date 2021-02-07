<?php

namespace App\Http\Requests;

use App\Constants\Constants;

class ClubRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nm_social_reason' => Constants::REQUIRED,
            'nm_fantasy' => Constants::REQUIRED,
            'nu_cnpj' => Constants::REQUIRED,
            'nu_cpf_responsible' => Constants::REQUIRED,
            'nm_responsible_person' => Constants::REQUIRED,
            'nu_business_phone' => '',
            'nu_cell_phone' => '',
            'ds_address' => Constants::REQUIRED,
            'nu_uf' => Constants::REQUIRED,
            'nm_municipality' => Constants::REQUIRED,
            'nm_neighborhood' => Constants::REQUIRED,
            'ds_add_address' => Constants::REQUIRED,
            'ts_user_birth' => Constants::REQUIRED,
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
            'nm_social_reason' => 'Razão social',
            'nm_fantasy' => 'Nome fantasia',
            'nu_cnpj' => 'CNPJ',
            'nu_cpf_responsible' => 'CPF do responsável',
            'nm_responsible_person' => 'Nome do responsável',
            'nu_business_phone' => 'Telefone comercial',
            'nu_cell_phone' => 'Tefelone celular',
            'ds_address' => 'Endereço',
            'nu_uf' => 'UF',
            'nm_municipality' => 'Municipio',
            'nm_neighborhood' => 'Bairro',
            'ds_add_address' => 'Complemento do endereço',
            'ts_user_birth' => 'Data aniversário do clube'
        ];
    }
}
