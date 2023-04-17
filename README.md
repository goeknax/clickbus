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
3. Run `docker compose up` (the logs will be displayed in the current shell) or `docker compose up -d` (quiet mode)
4. Go to your directory `cd clickbus` and `symfony server:start -d` (the logs will not be displaying) by default gives you port 8000 if not, change it in #9
5. Run `yarn install`
6. Run `composer install and/or composer update`
7. Run `php bin/console doctrine:migrations:migrate` to migrate database
8. Run `yarn run encore dev --watch `
9. Open `http://127.0.0.1:8000/index/` in your favorite web browser.
10. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Notes

Check all ports if something is not working, please change them.
Web Server `8000`
DataBase in Docker `5432`
In order to change web server `symfony server:start --port=8080`
Change database ports in docker-compose.yml and modify conecction in .env


## Images
![Pantalla de inicio](https://raw.githubusercontent.com/goeknax/clickbus/master/assets/img/index.png)
![Consulta de conversion ](https://raw.githubusercontent.com/goeknax/clickbus/master/assets/img/index1.png)
![Historial de conversion](https://raw.githubusercontent.com/goeknax/clickbus/master/assets/img/log.png)

## Docs

## License