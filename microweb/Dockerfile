FROM ubuntu:latest
RUN apt update \
&& apt install -y nginx \
&& apt clean \
&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
COPY html/* /var/www/html
VOLUME /var/www/html/
ENTRYPOINT ["nginx", "-g", "daemon off;"]