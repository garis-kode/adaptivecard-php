FROM gariskode/php:8.4-node24

ARG WWWGROUP=1000

RUN install-php-extensions xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d/zz-xdebug-devcontainer.ini

RUN userdel -r ubuntu 2>/dev/null || true
RUN groupadd --force -g $WWWGROUP laravel
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 laravel

USER laravel

RUN git config --global --add safe.directory /var/www/html

