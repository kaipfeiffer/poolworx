FROM wordpress:cli

ARG WP1_SLUG, WP1_TITLE, WP2_SLUG, WP2_TITLE, WP3_SLUG, WP3_TITLE, WP4_SLUG, WP4_TITLE, WP_SCHEME, WP_PORT , WP_IP

COPY scripts/wp-multisite-setup.php /tmp/wp-multisite-setup.php 

# CMD ["sh" "-c" "/tmp/test-server.sh"]