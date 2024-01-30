FROM php:8-fpm AS standard-phpfpm

RUN apt-get update && apt-get upgrade -y  && apt-get install -y  ca-certificates curl git npm unzip zip

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# install desired php extensions
RUN install-php-extensions gd pdo_mysql bcmath zip intl opcache mysqli


COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

FROM standard-phpfpm

# golang herunterladen
RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local' -xvzf -


#RUN mkdir /root/go

# pfad anpassen
 ENV PATH /usr/local/go/bin:/usr/local/bin/composer:$PATH
#ENV GOPATH=/root/go
#ENV PATH=$PATH:$GOPATH/bin

# mit golang mhsendmail herunterladen und nach /user/bin kopieren
RUN go get github.com/mailhog/mhsendmail
RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail

# Zeile für mhsendmail in php.ini eintragen, damit das native "mail"-Kommando von PHP an Mailhog sendet
RUN echo 'sendmail_path = "/usr/bin/mhsendmail --smtp-addr=mailhog:1025"' > /usr/local/etc/php/php.ini

# Passende Composer-Version installieren
# Install-Skript kopieren
# COPY install-composer.sh /usr/local/bin/install-composer.sh 

# Composer installieren + Laravel-Installer installieren

# pfad anpassen
ENV PATH /root/.composer/vendor/bin:$PATH

# Laravel-Projekt installieren
WORKDIR /var/www/

# RUN composer global require laravel/helpers && \
#     composer create-project laravel/laravel project && \
#     cd project && \
#     chmod -R 777 ./storage/framework/* && \
#     chmod -R 777 ./storage/logs && \
#     git config --global user.email "kaipfeiffer@gasthauspfeiffer.de" && \
#     git config --global user.name "kaipfeiffer" && \
#     git init && \
#     git add . && \
#     git commit -m "Erster Commit"

EXPOSE 8000

WORKDIR /var/www/html
