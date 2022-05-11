# October CMS Boilerplate
> By VhiWEB

## Stack

- PHP 7.4
- MySQL 5.7
- Redis

## Run Locally Using Docker

1. For the first time, run:

```
docker compose up -d --build && docker compose exec php php artisan october:migrate
```

2. Open http://localhost:8022

## Development Guide

### Updating Composer

```
docker compose exec php composer update
```

### Migrating Database

```
docker compose exec php php artisan october:migrate
```

### Clearing Cache

```
docker compose exec php php artisan cache:clear
```