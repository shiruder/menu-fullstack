# Menu Fullstack

## Install the Application

Run these commands from the directory to install dependencies.
```bash
cd [my-app-name]/api/public
composer install

cd [my-app-name]/app/public
composer install
```


Use `docker-compose` to run the app and api with `docker`, so you can run these commands:
```bash
cd [my-app-name]
docker-compose up --build
```

After that, open `http://localhost:8092` in your browser for app and `http://localhost:8092` for api.

## Config hostname mysql
```bash
cd [my-app-name]
docker docker inspect menu-fullstack_mysql_1 | grep \"IPAddress\"
```
and find: "IPAddress", after this change config host in:
```bash
vim [my-app-name]/api/public/config/development.php
```

## Run test suite
Run this command in the application directory to run the test suite 

```bash
cd [my-app-name]/api/public
vendor/bin/phpunit
```

## What you will get
The APIs will respond to:

###Orders
GET  ->   http://localhost:8091/api/v1/orders
GET  ->   http://localhost:8091/api/v1/orders/{id}
POST ->   http://localhost:8091/api/v1/orders
PUT ->   http://localhost:8091/api/v1/orders/{id}
DELETE -> http://localhost:8091/api/v1/orders/{id}

###Clients
GET  ->   http://localhost:8091/api/v1/users
GET  ->   http://localhost:8091/api/v1/users/{id}
POST ->   http://localhost:8091/api/v1/users
PUT ->   http://localhost:8091/api/v1/users/{id}
DELETE -> http://localhost:8091/api/v1/users/{id}

## Run test suite
 - Migrate Test Controller to Behat
 - Pie Chart -> http://jsfiddle.net/8LdJj/
 - API api/v1/orders group by status
 - API api/v1/orders order by date