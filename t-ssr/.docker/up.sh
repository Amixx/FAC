docker compose up --build --pull always -d --wait
docker exec t-ssr-php-1 sh -c "composer install --no-dev --optimize-autoloader \
  && APP_ENV=prod APP_DEBUG=0 bin/console cache:clear \
  && bin/console tailwind:build && bin/console asset-map:compile"