FROM node:14-alpine as build

WORKDIR /app
COPY . .
RUN yarn && yarn build

FROM nginx:alpine as production
LABEL org.opencontainers.image.source="https://github.com/YnovSchoolProjects/wholetrip"

COPY ./deploy/nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=build /app/dist /var/www/wholetrip
