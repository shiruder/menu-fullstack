# Menu Fullstack

## Install the Application

Run thess commands from the directory to install dependencies.
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


## Run test suite
Run this command in the application directory to run the test suite

```bash
cd [my-app-name]/api/public
vendor/bin/phpunit
```