CODEEX hh task
=

[Ссылка на задание](http://codeex.ru/tests/back-end.pdf)

***

###Начальная настройка:
1. Клонирование репозитория: `git clone https://github.com/artem0071/hh-codeex.git .`
2. Загрузка пакетов: `composer install`
3. Выполнить `php -r "file_exists('.env') || copy('.env.example', '.env');"`
4. Сгенерировать ключ: `php artisan key:generate --ansi`
5. Выполнить `php artisan storage:link`
6. Заполнить поля БД в `.env`
7. Вписать в переменную `DADATA_API_KEY` ключ от DADATA
8. Выполнить `php artisan migrate`
