FROM wordpress:php7.4

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        msmtp \
        msmtp-mta \
        npm \
        unzip \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY msmtprc /etc/msmtprc
COPY mailhog-sendmail.ini /usr/local/etc/php/conf.d/mailhog-sendmail.ini

RUN chmod 0644 /etc/msmtprc

# COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

# RUN /usr/local/bin/composer global require jeffreyvanrossum/tailpress-installer 
# RUN git config --global user.email "kai@gasthauspfeiffer.com" 
# RUN git config --global user.name "Kai Pfeiffer"
# ENV PATH /usr/local/go/bin:/usr/local/bin/composer:/root/.config/composer/vendor/bin:$PATH
# COPY ./adminer.php /var/www/html/adminer.php
# COPY ./rewrite_log.conf /etc/apache2/mods-enabled/
