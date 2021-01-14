<?php

namespace App\Constants;

final class Constants
{
    const INTEGER     = 'integer';
    const STRING      = 'string';
    const DATA        = 'data';
    const HOUR        = 'Hora';
    const PIPES       = '||';
    const REQUIRED    = 'required';
    const FORMATDATE  = 'Y-m-d';
    const DATEPT      = 'd/m/Y';
    const CPF         = 'CPF';
    const CNPJ        = 'CNPJ';
    const PHONE       = 'PHONE';
    const MAIL        = 'MAIL';


    const TS_UPDATE  = 'ts_atualizado';
    const TS_CREATE  = 'ts_criado';
    const TS_REMOVED = 'ts_removido';
    const PATTERN    = '^[a-zA-Z0-9\._-]+@"."[a-zA-Z0-9\._-]+."."([a-zA-Z]{2,4})$';

}
