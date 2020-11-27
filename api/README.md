# API CPU/GPU

List CPU and GPU.

#### Doc URL

http://localhost/api/doc

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them?

- [Docker CE](https://www.docker.com/community-edition)
- [Docker Compose](https://docs.docker.com/compose/install)

#### Init

```bash
cp .env.dist .env
docker-compose up -d
docker-compose exec --user=application web composer install
docker-compose exec --user=application web php bin/console d:s:u --force
```

#### Scraping with php

```bash
docker-compose exec --user=application web php bin/console app:scraping
```
#### Create admi to use POST and DELETE

```bash
docker-compose exec --user=application web php bin/console app:create-admin admin@mail.fr
```