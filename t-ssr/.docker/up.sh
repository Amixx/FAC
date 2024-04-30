docker compose up --build --pull always -d --wait
docker exec t-ssr-php-1 bin/console tailwind:build