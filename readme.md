# readme.md

## Новостной портал

Веб-сайт на Laravel, написанный студентом для курсовой работы 2026-го года в колледже.

## Changelog

Историю изменений можно посмотреть [здесь](changelog.md).

## Как установить и использовать

1. Клонировать репозиторий в Вашу выбранную директорию и зайти:
```bash
git clone https://github.com/tapotheslipper/news-letter
или
git clone git@github.com:tapotheslipper/news-letter.git

cd news-letter
```

2. Заполучить необходимые зависимости через composer и npm и запустить vite
```bash
composer install
npm install
npm run dev
```

3. Скопировать .env.example в .env и заполнить необходимые параметры окружения, включая токен.

4. Запустить с помощью php artisan serve.

## Технологии

```
php         -> 8.3.33
laravel     -> 12.12.2
laravel/ui  -> 4.6.3
bootstrap   -> 4
```