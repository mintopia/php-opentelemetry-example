FROM dunglas/frankenphp:1.5.0-php8.4.5-alpine

RUN apk add --update nodejs npm && \
    npm install chokidar && \
    install-php-extensions \
    pcntl \
    redis \
    bcmath \
    xdebug

COPY docker/Caddyfile /

ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--watch", "--poll", "--admin-host=0.0.0.0", "--caddyfile=/Caddyfile", "--log-level=DEBUG"]
