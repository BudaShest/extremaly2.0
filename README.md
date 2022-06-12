# Extremly
## Extremly - сайт туристической компании, предлагающий только экстремальный и нестандартный отдых!

### Для того чтобы развернуть проект локально, следуйте инструкциям ниже:

Для начала, у Вас должен быть установлен и сконфигурирован docker и docker-compose.
Находясь в корневой директории проекта, выполните:
```console
docker-compose up
```

Далее Вам необходимо установить все необходимые пакеты для работы серверной части. Выполните:
```console
docker-compose exec php bash
```
И внутри контейнера выполните:
```console
composer install
```

### Тестовые данные

Для того чтобы заполнить базу данными, зайдите по адресу [localhost:8081](http://localhost:8081), 
выберите в качестве СУБД - Postgres и авторизуйтесь, указав логин и пароль пользователя БД (см в [файле
с переменными окружения](.env) POSTGRES_USER и POSTGRES_PASSWORD). Также, для удобства, можно здесь же указать
и название базы, к которой планируется подключение (см в [файле с переменными окружения](.env) POSTGRES_DB).

![Авторизация в БД](/manual/step_1.png)

Далее, находясь в базе данных проекта, выберите в меню справа пункт импорт. Откроется окно выбора файла, 
где Вам нужно будет выбрать [файл с sql-инструкциями](extremaly.sql) и нажать на кнопку "Выполнить", после
чего база данных будет заполнена тестовыми данными.

![Импорт базы данных](/manual/step_2.png)

### Удачи вам!





