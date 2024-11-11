FROM wyveo/nginx-php-fpm:latest

COPY . /usr/share/nginx/html
COPY nginx.conf /etc/nginx/nginx.conf

WORKDIR /usr/share/nginx/html

RUN ln -s public html

# Desabilite os repositórios problemáticos antes de rodar apt update
RUN sed -i '/sury/d' /etc/apt/sources.list /etc/apt/sources.list.d/*.list && \
    sed -i '/nginx/d' /etc/apt/sources.list /etc/apt/sources.list.d/*.list && \
    apt update && \
    apt install -y vim curl gnupg

RUN echo "php_admin_value[error_log] = /var/log/php8.2-fpm.log" >> /etc/php/8.2/fpm/pool.d/www.conf && \
    touch /var/log/php8.2-fpm.log && \
    chown www-data:www-data /var/log/php8.2-fpm.log && \
    chmod 644 /var/log/php8.2-fpm.log

EXPOSE 80
