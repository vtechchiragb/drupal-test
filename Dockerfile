FROM drupal-base::2.0
COPY src /usr/share/nginx/html
RUN chmod -R g+rwX /usr/share/nginx/html
RUN cd /usr/share/nginx/html && rm -rf .git && composer install && composer update

EXPOSE 8080
