FROM composer/composer

RUN git clone https://github.com/erikdubbelboer/phpRedisAdmin.git /src/app
WORKDIR /src/app

RUN composer install
COPY config.inc.php includes/config.inc.php

ENV REDIS_0_NAME "local server"
ENV REDIS_0_HOST 127.0.0.1
ENV REDIS_0_PORT 6379

EXPOSE 80

ENTRYPOINT [ "php", "-S", "0.0.0.0:80" ]
