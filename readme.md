# **Бэкенд на PHP для вэб формы**

## **Требования**

* Docker
* Docker-compose
* make

## **Установка**

* Выполнить `make init` команду
* Выполнить `make composer update`
* Переименовать файл `.env.example` в файл `.env`
* Выполнить `make migrate` команду
* Перейти по адресу `localhost:8081/form`

## **Формат принимаемых данных**

* Тип запроса: `POST`

### Поля:

##### email
- *Обязательное поле
- Email
- Максимум 255 символов
##### phone
- *Обязательное поле
- Строка
- Максимум 15 символов
##### message
- Не обязательное поле
- Текст
---
* Форма находится по адресу `localhost:8081/form`
* Обработчик запроса по адресу `localhost:8081/form-action`

## **Формат ответа**

* При ошибке валидации
формат ответа: `{ "errors": ["Текст ошибки"] }`
* При удачном сохранении в БД формат ответа: `{ "status": "ok" }`
* Если сохранить не удалось формат ответа: `{ "status": "error" }`

## **Примеры запросов**

* Запрос: `localhost:8081/form-action`
* Параметры: phone=555321312 email=sdsa@mail.ru message=
* Ответ: `{ "status": "ok" }`
---
* Запрос: `localhost:8081/form-action`
* Параметры: phone=55532131254454523 email=sdsa@mail.ru message=
* Ответ: `{ "errors": ["This value is too long. It should have 15 characters or less."] }`
---
* Запрос: `localhost:8081/form-action`
* Параметры: phone= email= message=
* Ответ: ` {"errors": ["This value should not be blank.", "This value should not be blank."] }`