#!/bin/bash
. /usr/local/bin/porcentage.sh

echo "[ ${PORCENTAGE_0} ] Back - Iniciando o Endpoint da Aplicação"

echo "[ ${PORCENTAGE_10} ] Validando arquivo '.env' e no caso de inexistência gerando arquivo"
if ! [ -f ".env" ]; then
    cp .env.example .env
fi

echo "[ ${PORCENTAGE_25} ] Instalando as dependências com o composer..."
if ! [ -f vendor ]; then
    composer install
fi

if [ -f vendor ]; then
    composer update
fi

echo "[ ${PORCENTAGE_50} ] DB Migration"
php artisan migrate --seed

echo "[ ${PORCENTAGE_80} ]Limpando o cache das rotas e views"
php artisan view:clear

echo "[ ${PORCENTAGE_85} ]Configurando o cache da aplicação"
php artisan key:generate
php artisan config:cache

echo "[ ${PORCENTAGE_90} ]Permissões de acesso a pasta vendor"
chmod -R 777 vendor

echo "[ ${PORCENTAGE_95} ] Permissões de acesso a pasta storage"
chmod -R 777 storage

echo "[ ${PORCENTAGE_100} ] Back - Finzalizando o Endpoint da Application"
