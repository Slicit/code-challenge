#!/bin/sh

# install dependencies
composer install --no-interaction

exec "$@"