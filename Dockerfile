FROM ubuntu:22.04

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN export DEBIAN_FRONTEND=noninteractive && \
    apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    openssl \
    libzip-dev \
    php-curl \
    php-mbstring \
    php-pcov \
    php-xdebug \
    php-xml \
    unzip \
    zip \
    jq \
    gawk \
    && rm -rf /var/lib/apt/lists/*

RUN phpenmod xdebug pcov

COPY . /app
WORKDIR /app

RUN composer install

CMD ["/bin/bash"]
