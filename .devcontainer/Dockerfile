ARG ZSH_THEME="/home/vscode/zsh"
ARG PHP="1-8.2-bullseye"

FROM mcr.microsoft.com/devcontainers/php:${PHP}

# Install MariaDB client
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client apt-utils git libzip-dev zip unzip zlib1g-dev libpng-dev imagemagick libmagickwand-dev expect\ 
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# install NodeJS
RUN curl -sL https://deb.nodesource.com/setup_16.x | sudo bash -
RUN sudo apt -y install nodejs


# Install required PHP extensions manually
RUN pecl install imagick
RUN docker-php-ext-enable imagick
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install gd
RUN docker-php-ext-install mysqli pdo pdo_mysql zip iconv

COPY vsmoddb.conf /etc/apache2/sites-available/
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini
COPY policy.xml /etc/ImageMagick-6/policy.xml
# COPY 99-php.ini /home/ababu/git/docker-php/php/conf.d/99-custom.ini/99-php.ini
COPY 99-php.ini /usr/local/etc/php/php.ini
COPY custom.cnf /etc/mysql/conf.d/custom.cnf

# Download and install Oh-My-Zsh
RUN rm -rf /root/.oh-my-zsh
ENV ZSH_THEME=${ZSH_THEME}
RUN wget https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh -O - | zsh
RUN sed -i "s#ZSH_THEME=.*#ZSH_THEME=\"$ZSH_THEME\"#" /home/vscode/.zshrc
RUN usermod -s /bin/zsh vscode


# enable apache rewrite module
RUN a2enmod rewrite
RUN a2dissite 000-default.conf
RUN a2ensite vsmoddb.conf