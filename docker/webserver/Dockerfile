FROM httpd:2.4.33-alpine
RUN apk update && apk upgrade;

# Zertifikate kopieren
COPY ./ssl/localhost.key /usr/local/apache2/conf/server.key
COPY ./ssl/localhost.crt /usr/local/apache2/conf/server.crt

# Copy apache vhost file to proxy php requests to php-fpm container
COPY apache_with_extern_php.conf /usr/local/apache2/conf/apache_with_extern_php.conf

# SSL-Konfiguration kopieren
COPY httpd-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf

RUN echo "Include /usr/local/apache2/conf/apache_with_extern_php.conf" >> /usr/local/apache2/conf/httpd.conf
RUN sed -i \
        -e 's/^#\(Include .*httpd-ssl.conf\)/\1/' \
        -e 's/^#\(LoadModule .*mod_ssl.so\)/\1/' \
        -e 's/^#\(LoadModule .*mod_socache_shmcb.so\)/\1/' \
        conf/httpd.conf