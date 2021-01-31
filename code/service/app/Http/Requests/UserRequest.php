<?php

namespace App\Http\Requests;

use App\Constants\Constants;

class UserRequest extends Request
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
            'nm_nickname' => Constants::REQUIRED,
            'nm_name_dad' => Constants::REQUIRED,
            'nm_name_mom' => Constants::REQUIRED,
            'nu_cpf' => Constants::REQUIRED,
            'nu_home_phone' => Constants::REQUIRED,
            'nu_business_phone' => Constants::REQUIRED,
            'nu_cell_phone' => Constants::REQUIRED,
            'ds_address' => Constants::REQUIRED,
            'nu_uf' => Constants::REQUIRED,
            'nm_municipality' => Constants::REQUIRED,
            'nm_neighborhood' => Constants::REQUIRED,
            'ds_add_address' => Constants::REQUIRED,
            'ar_photo_user' => Constants::REQUIRED,
            'ts_user_birth' => Constants::REQUIRED,
            'ps_password' => Constants::REQUIRED,
            'nu_attempts' => Constants::REQUIRED,
            'cd_profile' => Constants::REQUIRED,
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
            'nm_name' => 'Nome do usuário',
            'nm_nickname' => 'Nickname do usuário',
            'nm_name_dad' => 'Nome do pai',
            'nm_name_mom' => 'Nome da mãe',
            'nu_cpf' => 'Número do cpf',
            'nu_home_phone' => 'Número do telefone residencial',
            'nu_business_phone' => 'Número comercial',
            'nu_cell_phone' => 'Número do celular',
            'ds_address' => 'Endereço',
            'nu_uf' => 'UF',
            'nm_municipality' => 'Município',
            'nm_neighborhood' => 'Bairro',
            'ds_add_address' => 'Complemento',
            'ar_photo_user' => 'Foto do usuário',
            'ts_user_birth' => 'Data de aniversário do usuário',
            'ps_password' => 'Senha do usuário',
            'nu_attempts' => 'Número de tentativas de acesso',
            'cd_profile' => 'Perfil do usuário',
        ];
    }
}
