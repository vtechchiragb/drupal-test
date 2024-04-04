FROM nginx:1.19

RUN mkdir -p /app && chmod -R g+rwX /app

COPY default.conf /etc/nginx/conf.d/default.conf

RUN chmod -R g+rwX /var/log
RUN chmod -R g+rwX /var/cache/nginx
RUN chmod -R g+rwX /var/run
RUN chmod -R g+rwX /etc/nginx

EXPOSE 8443
