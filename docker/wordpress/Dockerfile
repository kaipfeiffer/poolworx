FROM wordpress

RUN apt-get update && apt-get upgrade -y  && apt-get install -y curl git npm unzip zip

# COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

# RUN /usr/local/bin/composer global require jeffreyvanrossum/tailpress-installer 
# RUN git config --global user.email "kai@gasthauspfeiffer.com" 
# RUN git config --global user.name "Kai Pfeiffer"
# ENV PATH /usr/local/go/bin:/usr/local/bin/composer:/root/.config/composer/vendor/bin:$PATH
# COPY ./adminer.php /var/www/html/adminer.php
# COPY ./rewrite_log.conf /etc/apache2/mods-enabled/