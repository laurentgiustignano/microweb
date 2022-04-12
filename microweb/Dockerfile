FROM ubuntu:latest
RUN apt update \
&& apt install -y nginx \
&& apt clean \
&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
RUN mkdir /var/www/html/js && mkdir /var/www/html/css
COPY html/*.html /var/www/html/
COPY html/js /var/www/html/js
COPY html/css /var/www/html/css
VOLUME /var/www/html/
ENTRYPOINT ["nginx", "-g", "daemon off;"]