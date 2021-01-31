#!/bin/bash
. /usr/local/bin/porcentage.sh

echo "[ ${PORCENTAGE_0} ] Service - Application service container installation started"

echo "[ ${PORCENTAGE_10} ] Validating the existence of the '.env' file"
if ! [ -f ".env" ]; then
    cp .env.application-connect .env
fi

rm -rf vendor
echo "[ ${PORCENTAGE_15} ] Installation of container dependencies by the composer..."
composer install

echo "[ ${PORCENTAGE_50} ] DB Migration"
php artisan migrate --seed

echo "[ ${PORCENTAGE_80} ] Clearing the cache of routes and views"
php artisan view:clear

echo "[ ${PORCENTAGE_85} ] Configuring the application cache"
php artisan key:generate
php artisan config:cache

echo "[ ${PORCENTAGE_90} ] Vendor folder access permissions"
chmod -R 777 vendor

echo "[ ${PORCENTAGE_95} ] Storage folder access permissions"
chmod -R 777 storage

echo "[ ${PORCENTAGE_100} ] Service - Finalizing the Application Endpoint"
