# lumen-auth-example

## Begin
On the MongoDB configuration I see a reference from [Jens Sagers](https://github.com/jenssegers/laravel-mongodb).

## Usage

-   `git clone https://gitlab.com/rizkiunder/lumen-jwt-mongodb.git`
-   `cd auth-api`
-   `composer install`
-   `php artisan jwt:secret`
-   `php artisan migrate`
-   `php -S localhost:8000 -t public`

## Set Env

import your database with name db is mapp
```sh
APP_NAME=Lumen
APP_ENV=local
APP_KEY=base64:xp/QTiqnoFNJY7Ohr2Vir9Q498FIR5/7NPcFLRNqr7Y=
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mongodb
DB_HOST=localhost
DB_PORT=27017
DB_DATABASE=myFirstDB
DB_USERNAME=
DB_PASSWORD=

JWT_SECRET=VyM9bXojxPXh8Vw6QZ1IsjFG7Gwh2UYN4oy3JRVSfah1Qb6cX6Di38cVdAdHvbaV

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

```