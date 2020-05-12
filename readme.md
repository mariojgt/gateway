Create a clean Laravel Install

Create a database connection and update the .env file

php artisan make:auth

add to composer.json

````
 "repositories": [
        {
            "type" : "path",
            "url": "../packages/gateway",
            "options": {
                "symlink": true
            }
        }
    ],
    "require": {
        "mariojgt/gateway": "dev-master"
    },
 ````

 composer update

 php artisan vendor:publish

check the config > auth directory has an admin handler

if not delete it and run

php artisan vendor:publish

it should copy the correct config file across.

Edit config > variables.php
