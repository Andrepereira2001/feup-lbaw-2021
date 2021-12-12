# MediaLibrary

MediaLibrary is an information system available through the web for the management of collections of books, films, music albums, slides and their users.

## Setup

### Local development

For local development, use the Docker Compose setup at `docker-compose.yml`. This setup launches the following services:
- `php`, created from the provided [Dockerfile](Dockerfile). Runs server software (nginx) with PHP+Laravel.
- `postgres`, created from a ready-made PostgreSQL image, so you can have a local development database.
- `pgadmin`, to view DBs in a user-friendly way
- `mailhog`, which is an email testing tool. It behaves like a legit SMTP server on port 1025 but allows you to check all sent mail from port 8025.

This setup uses environment file [app/.env](app/.env).

To launch this setup, run the following command in the repository root:

```sh
docker-compose up --build
```

The following ports are accessible:
- `localhost:8000`: PHP+Laravel server.
- `localhost:5432`: The local development database (not very useful to access it via browser, but can be accessed using pgAdmin)
- `localhost:4321`: pgAdmin.
- `localhost:8025`: MailHog HTTP server, allows you to check sent mail.

### Local development with remote database

It may be useful for you to test if the remote database is working properly, or just to run some maintenance procedures ([seeding](app/database/seeders) or performing [migrations](app/database/migrations)) on the remote database.

All the local development services are also launched on this setup, except for the PostgreSQL image. Instead, the fact this setup uses [app/.env_production](app/.env_production) configures the PHP server to connect to the remote DB.

You can open a shell on the PHP container by running `docker exec -it lbaw_php /bin/bash` on your host shell. Because this server has already been configured to connect to the remote database, you can easily run the database setup commands you want. For instance, when running your system for the first time the remote database will be empty, so you can enter the local PHP container (which is configured to connect to the remote DB) to run the seeding and migration steps manually:

```sh
php artisan db:seed
php artisan migrate:refresh
php artisan db:seed --class=WorksPopulator
```

The third command runs a special seeder which populated the `work` table with a massive amount of values from a Wikimedia dump file.

:warning: **WARNING:** Commands run from inside the PHP container of this setup must be very carefully run, because they interact with the remote (production) database. As such, you don't want to seed your database lightheartedly (unless you don't mind losing your whole data).

:information_source: **INFO:** If you don't have access to the medialibrary database at <db.fe.up.pt> but you still want to test this website with a remote DB that you can access, you may want to change [app/.env_production](app/.env_production) to match valid credentials and a database you can access with those credentials.

## Sending the Docker image to DockerHub

When compiling the Docker image to send it to DockerHub (so it can then be pulled by the LBAW server), you should set the proper remote database password in the [app/.env_production](app/.env_production) file.
