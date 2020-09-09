FROM nginx:stable-alpine

RUN rm /etc/nginx/conf.d/default.conf
RUN rm /etc/nginx/conf.d/examplessl.conf

ADD nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /etc/nginx
CMD ["nginx"]