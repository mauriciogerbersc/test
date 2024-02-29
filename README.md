Comandos para rodar aplicação

Dentro da pasta raíz

> docker-compose up -d --build
> docker-compose run --rm composer update
> docker-compose run --rm artisan migrate
> docker-compose run --rm artisan db:seed
