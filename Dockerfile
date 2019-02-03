# To turn this file into a working environment, install docker & type this in terminal in this dir:
# $ docker build -t pidelo:1.0.0 .
# $ docker run -dP pidelo

# To start a shell in a container, type:
# $ docker exec -it [container-id] bash

# Base image (offical ubuntu docker image therefore trustworthy)
FROM pidelo/php:7.1

RUN mkdir -p /var/www/pidelo
COPY . /var/www/pidelo

RUN cd /var/www/pidelo && \
    composer install && \
    chown -R www-data:www-data /var/www

# Expose ports 80 (HTTP) and 443 (HTTPS) to host (as long as -P or equivalent is used with docker run)
EXPOSE 80 443

# Run these commands when a container is spun up based on this image build
CMD service php7.1-fpm start && nginx -g 'daemon off;'