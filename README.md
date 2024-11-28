# afranga-app

Установка:

    git clone git@github.com:Orlac/afranga-app.git
--

    cd ./afranga-app
--

    cp .env.example .env
Можно изменить настройки в .env

    docker compose -f ./docker-compose.yml build
--

    docker compose -f ./docker-compose.yml up -d
--

    docker exec -it laravel-test-1 composer install
--

    ./vendor/bin/sail artisan migrate:fresh --seed --seeder=ClientsSeeder
--

    docker compose -f ./docker-compose.yml down
    docker compose -f ./docker-compose.yml up -d
При экспорте больших файлов надо запусить обработчик очереди. Файл будет отправлен по почте:

    ./vendor/bin/sail artisan queue:work
Настройка почтового клиента находится в .env . По умолчанию письиа будут уходить в лог. Подробнее тут https://laravel.com/docs/11.x/mail .

url страницы:

http://0.0.0.0:80
