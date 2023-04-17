# Prueba tecnica ClickBus

Prueba tecnica que convierte monedas consumiendo un api y guardadndo los resultados en base de datos.

![CI](https://github.com/dunglas/symfony-docker/workflows/CI/badge.svg)

## Requirements
1. Docker
2. PHP >= 8.1
2. Symfony (https://symfony.com/download)
3. Node
4. yarn

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up` (the logs will be displayed in the current shell) or docker compose up -d (not displaying)
4. Go to your directory `cd vue-symfony` and `symfony server:start -d` (the logs will not be displaying)
5. Run `yarn install`
6. Run `composer install and/or composer update`
7. Run `php bin/console doctrine:database:create` to migrate database
8. Run `yarn run encore dev --watch `
9. Open `https://localhost:8000/index` in your favorite web browser.
10. Run `docker compose down --remove-orphans` to stop the Docker containers.



## Features

## Docs

## License