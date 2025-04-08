FROM dunglas/frankenphp:1.5.0-php8.4.5-alpine

RUN apk add --update nodejs npm && \
    npm install chokidar && \
    install-php-extensions \
    pcntl \
    redis \
    bcmath

ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--watch", "--poll"]
