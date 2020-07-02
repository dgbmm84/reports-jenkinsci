#!/bin/bash

cd reports || exit

echo "----------- Launching Database migration -----------"
php bin/console --no-interaction do:mi:mi

echo "----------- Cleaning Cache -------------------------"
php bin/console --no-interaction cache:clear --env=prod

ls -lrt
