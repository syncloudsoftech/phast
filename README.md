# phast

Simple PHP skeleton because not every project needs [Laravel](https://laravel.com/).
The structure is shared hosting friendly, includes [Medoo](https://medoo.in/) for database, [PHPMailer](https://github.com/PHPMailer) for emails, [Plates](https://platesphp.com/engine/overview/) for template etc.

It also includes essential security configuration against common PHP application vulnerabilities.

## Development

To set up project, install [Docker](https://www.docker.com/) on your workstation and run below commands in project folder.

```shell
# copy the sample constants
$ cp constants.dist.php constants.php

# start the services
$ docker compose up -d

# install dependencies
$ docker compose exec web composer install

# run database migrations
$ curl -X POST http://127.0.0.1:8000/migrate
```

## Code-style

Before committing change, make sure to format your code properly using below command:

```shell
$ docker run --rm -v $PWD:/workspace syncloudsoftech/pinter
```

The project should be accessible at [http://127.0.0.1:8000/](http://127.0.0.1:8000/) address.
