# How to Develop a Simple Web Application Using Docker, Nginx, PHP and MongoDB 

The repository contains files for preparing the environment and running a simple PHP script. 

The application runs with Nginx + PHP-fpm 8.2 + MongoDB 6, the environment is run with Docker compose. It also uses Composer to include the required MongoDB packages. 

The application gets access data from environment variables, connects to the database and writes 1000 documents to the database. 

That's it! However, it's a good starting point to do something more.

## Installation

1. Clone the repository and navigate to the project folder.

2. Run Image build from Dockerfile

```
docker build -t php8.2-fpm-mongo .
```

3. Run docker-compose

```
docker-compose up -d
```

4. Connect to a container with PHP-fpm

```
docker exec -it [php-fpm-container-name] bash
```

5. Install the Composer packages needed for the application (composer.json)

```
composer install
```

6. Open localhost in your browser

7. Enjoy modifying the index.php script and checking the result by simply reloading the localhost page in your browser

8. Stop docker-compose after experimenting

```
docker-compose down
```



# API Documentation

## Overview
Этот API предоставляет функциональность для управления пользователями, визитками и историей просмотров. Все данные хранятся в MongoDB. API поддерживает стандартные CRUD-операции (Create, Read, Update, Delete) для каждой сущности.

---

## Base URL
`http://yourdomain.com/api`

---

## Authentication
API не требует аутентификации для выполнения запросов.

---

## Endpoints

### 1. **User Management**

#### 1.1. Create a User
**URL:** `/api/index.php?action=user.create`

**Method:** `POST`

**Description:** Создает нового пользователя.

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john.doe@example.com"
}
```

**Response:**
```json
{
    "id": "651a1b2c3d4e5f6a7b8c9d0e"
}
```

---

#### 1.2. Get a User
**URL:** `/api/index.php?action=user.read&id=651a1b2c3d4e5f6a7b8c9d0e`

**Method:** `GET`

**Description:** Возвращает данные пользователя по его ID.

**Response:**
```json
{
    "_id": "651a1b2c3d4e5f6a7b8c9d0e",
    "name": "John Doe",
    "email": "john.doe@example.com"
}
```

---

#### 1.3. Get All Users
**URL:** `/api/index.php?action=user.read`

**Method:** `GET`

**Description:** Возвращает список всех пользователей.

**Response:**
```json
[
    {
        "_id": "651a1b2c3d4e5f6a7b8c9d0e",
        "name": "John Doe",
        "email": "john.doe@example.com"
    },
    {
        "_id": "651a1b2c3d4e5f6a7b8c9d0f",
        "name": "Jane Doe",
        "email": "jane.doe@example.com"
    }
]
```

---

#### 1.4. Update a User
**URL:** `/api/index.php?action=user.update&id=651a1b2c3d4e5f6a7b8c9d0e`

**Method:** `PUT`

**Description:** Обновляет данные пользователя.

**Request Body:**
```json
{
    "name": "John Smith"
}
```

**Response:**
```json
{
    "modifiedCount": 1
}
```

---

#### 1.5. Delete a User
**URL:** `/api/index.php?action=user.delete&id=651a1b2c3d4e5f6a7b8c9d0e`

**Method:** `DELETE`

**Description:** Удаляет пользователя по его ID.

**Response:**
```json
{
    "deletedCount": 1
}
```

---

### 2. **Business Card Management**

#### 2.1. Create a Business Card
**URL:** `/api/index.php?action=businessCard.create`

**Method:** `POST`

**Description:** Создает новую визитку.

**Request Body:**
```json
{
    "title": "Business Card 1",
    "content": "Sample content"
}
```

**Response:**
```json
{
    "id": "651a1b2c3d4e5f6a7b8c9d0e"
}
```

---

#### 2.2. Get a Business Card
**URL:** `/api/index.php?action=businessCard.read&id=651a1b2c3d4e5f6a7b8c9d0e`

**Method:** `GET`

**Description:** Возвращает данные визитки по её ID.

**Response:**
```json
{
    "_id": "651a1b2c3d4e5f6a7b8c9d0e",
    "title": "Business Card 1",
    "content": "Sample content"
}
```

---

#### 2.3. Get All Business Cards
**URL:** `/api/index.php?action=businessCard.read`

**Method:** `GET`

**Description:** Возвращает список всех визиток.

**Response:**
```json
[
    {
        "_id": "651a1b2c3d4e5f6a7b8c9d0e",
        "title": "Business Card 1",
        "content": "Sample content"
    },
    {
        "_id": "651a1b2c3d4e5f6a7b8c9d0f",
        "title": "Business Card 2",
        "content": "Another content"
    }
]
```

---

#### 2.4. Update a Business Card
**URL:** `/api/index.php?action=businessCard.update&id=651a1b2c3d4e5f6a7b8c9d0e`

**Method:** `PUT`

**Description:** Обновляет данные визитки.

**Request Body:**
```json
{
    "title": "Updated Business Card"
}
```

**Response:**
```json
{
    "modifiedCount": 1
}
```

---

#### 2.5. Delete a Business Card
**URL:** `/api/index.php?action=businessCard.delete&id=651a1b2c3d4e5f6a7b8c9d0e`

**Method:** `DELETE`

**Description:** Удаляет визитку по её ID.

**Response:**
```json
{
    "deletedCount": 1
}
```

---

### 3. **View History Management**

#### 3.1. Add a View
**URL:** `/api/index.php?action=viewHistory.addView&userId=651a1b2c3d4e5f6a7b8c9d0e&cardId=651a1b2c3d4e5f6a7b8c9d0f`

**Method:** `POST`

**Description:** Добавляет запись о просмотре визитки пользователем.

**Response:**
```json
{
    "status": "success"
}
```

---

#### 3.2. Get Views by User
**URL:** `/api/index.php?action=viewHistory.getViews&userId=651a1b2c3d4e5f6a7b8c9d0e`

**Method:** `GET`

**Description:** Возвращает историю просмотров визиток для пользователя.

**Response:**
```json
[
    {
        "card_id": "651a1b2c3d4e5f6a7b8c9d0f",
        "last_viewed_at": "2023-10-01T12:34:56Z"
    },
    {
        "card_id": "651a1b2c3d4e5f6a7b8c9d0e",
        "last_viewed_at": "2023-10-02T14:20:10Z"
    }
]
```

---

## Error Handling

### Common Errors

- **400 Bad Request**: Неверный формат запроса или отсутствуют обязательные параметры.
- **404 Not Found**: Запрашиваемый ресурс не найден.
- **500 Internal Server Error**: Внутренняя ошибка сервера.

**Error Response Example:**
```json
{
    "error": "Resource not found"
}
```

---

## Testing
Для запуска тестов добавьте параметр `test=1` в URL:
```
http://yourdomain.com/api/index.php?test=1
```

---

## Dependencies
- PHP 7.4 или выше.
- MongoDB (версия 1.6 или выше).
- Библиотека `mongodb/mongodb` для работы с MongoDB.

---

## Support
Для вопросов или проблем, свяжитесь с разработчиком.

---

Если нужно что-то уточнить или дополнить, дайте знать!

