FROM ubuntu:latest

RUN apt-get update
RUN apt-get -y install nginx

COPY index.php /var/www/php/index.php

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
