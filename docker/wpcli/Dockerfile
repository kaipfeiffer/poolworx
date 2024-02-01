FROM wordpress:cli

# ARG WORDPRESS_DB_HOST WORDPRESS_DB_USER WORDPRESS_DB_PASSWORD WORDPRESS_DB_NAME

COPY scripts/test-server.sh /tmp/test-server.sh

CMD ["sh" "-c" "/tmp/test-server.sh"]