# docker/production/Dockerfile
FROM node:18 as frontend
WORKDIR /app
COPY package*.json .
RUN npm install
COPY . .
RUN npm run build

FROM php:8.2-fpm as backend
WORKDIR /var/www
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .
RUN composer install --optimize-autoloader --no-dev

FROM nginx:alpine
COPY --from=frontend /app/public/build /var/www/public/build
COPY --from=backend /var/www /var/www
COPY docker/production/nginx.conf /etc/nginx/conf.d/default.conf
