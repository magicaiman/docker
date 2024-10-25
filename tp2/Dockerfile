FROM php:8.2-cli

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y curl libjpeg-dev && \
    ( curl -sSLf https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o install-php-extensions || echo 'return 1' ) && \
    bash install-php-extensions gd && \
    rm -rf /var/lib/apt/lists/* install-php-extensions

VOLUME /images

COPY imageConverter.php /imageConverter.php

CMD ["php", "/imageConverter.php"]
