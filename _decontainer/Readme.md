# Devcontainer for PHP 8.2 and Mariadb Development Environment for ababu application

This is a Devcontainer for setting up a PHP development environment using the [mcr.microsoft.com/devcontainers/php:1-8.2-bullseye](https://mcr.microsoft.com/devcontainers/php:1-8.2-bullseye) base image.

## Prerequisites

Before you begin, you need to have: 
[Docker](https://www.docker.com/) and 
[Docker Compose](https://docs.docker.com/compose/) installed on your system.

## Installation

1. Clone this repository:
```bash
mkdir ababu
cd ababu
git clone https://github.com/oldauntie/ababu ./
sudo apt install nodejs npm -y
npm install --save-dev vite laravel-vite-plugin
```

2. Build the Docker image and start the containers:
```bash
docker build .devcontainer/

```
3. If you need to remove the containers and recreate them again you can use the command: 
```bash
docker build --no-cache .devcontainer/
```

4. Using the "Docker" vscode extension you have access to the graphical interface to manipulate the created containers, delete them and restart them, in addition to accessing the logs of each container and more.

## Services

### ababu `localhost:8080`
We will be able to access the application with `PHP 8.2` and  `Xdebug 3.2` activated, which will facilitate the work of debugging the code. We can also find other vscode extensions installed that make us more productive and one of the best consoles `Oh-My-Zsh` installed and configured.
There is an environment variables file inside the `.devcontainer` directory called `.env` that contains the `environment variables` for accessing the database and others, only for consultation, it is not necessary to modify these environment variables.

### db
This service sets up a MariaDB database server using the official MariaDB image. The container is named `mariadb` and will automatically restart if it crashes.

#### Configuration:

- `MYSQL_ROOT_PASSWORD`: The password for the root user of the MariaDB server. In this case, it is set to `mariadb`.
- `MYSQL_DATABASE`: The name of the database to be created. In this case, it is set to `mariadb`.
- `MYSQL_USER`: The username for the MySQL user with superuser privileges. In this case, it is set to `root`.
- `MYSQL_PASSWORD`: The password for the MySQL user with superuser privileges. In this case, it is set to `mariadb`.

#### Volumes:

The `db` service uses a volume named `mariadb-data` to persist the MariaDB database data. This ensures that the data remains available even if the container is restarted or removed.

### adminer `localhost:8081`

This service sets up an Adminer container, which is a web-based database management tool. The container is named `databaseAdmin` and will automatically restart if it crashes.
Every time you make a change in the database and want to view it in adminer, you will have to login again to refresh the changes in the databases.

#### Ports:

Adminer is accessible through port `8081` on your local machine. The port `8081` on the host machine is mapped to port `8080` on the Adminer container.

### Volumes

#### mariadb-data

This volume is used by the `db` service to store the data of the MariaDB database. As mentioned earlier, it ensures that the data remains available even if the container is restarted or removed.
