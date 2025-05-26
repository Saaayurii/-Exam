
# 📰 Laravel News API

API-проект на Laravel для управления новостями с поддержкой кэширования через Redis и хранением сессий в базе данных.

## 🚀 Возможности

- 📄 CRUD-операции для новостей
- ⚡ Кэширование списка новостей на Redis (1 час)
- 🔄 Автоматический сброс кэша при добавлении новой новости
- 🧠 Валидация данных на стороне сервера
- 🐘 Использование MySQL в качестве основной базы данных
- 🔐 Сессии хранятся в базе данных
- 📦 Гибкая настройка окружения через `.env`

---

## 📂 Структура API

### `GET /api/news`

Получить список новостей (с пагинацией).

**Параметры (опционально):**

- `page` — номер страницы (по умолчанию 1)
- `per_page` — количество новостей на страницу (по умолчанию 10)

### `POST /api/news`

Создать новую новость.

**Пример тела запроса:**

```json
{
  "title": "Новая новость",
  "content": "Подробности новой новости здесь..."
}
````

---

## ⚙️ Установка

1. Клонируй репозиторий:

```bash
git clone https://github.com/your-username/news-api.git
cd news-api
```

2. Установи зависимости:

```bash
composer install
```

3. Скопируй файл `.env` и настрой:

```bash
cp .env.example .env
php artisan key:generate
```

4. Настрой подключение к БД и Redis в `.env`.

5. Примени миграции:

```bash
php artisan migrate
```

6. (Опционально) Установи клиент Redis:

```bash
sudo apt install php-redis
# или вместо этого
composer require predis/predis
```

7. Запусти сервер:

```bash
php artisan serve
```

---

## 🧪 Тестирование

Проверь работу:

```bash
curl http://localhost:8000/api/news
```

Или используй Postman / Insomnia.

---

## 🗃 Пример .env (фрагмент)

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=news
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

---

## 🛠 Используемые технологии

* Laravel 10.x
* PHP 8.1+
* MySQL
* Redis
* Laravel Cache / Session
* REST API

---

## 🤝 Авторы

* Roman — разработка и архитектура API

---

## 📄 Лицензия

Этот проект распространяется под лицензией MIT.

