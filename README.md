# InvestGPT Funnel (Keitaro-friendly)

Проста воронка (PHP + JS) для чату-опитування → аналізу → демо-симуляції → форми, з JSON-проксі до OpenAI без SSE. Всі шляхи з підпапок — через `../`.

## Технології
- Frontend: HTML/JS, jQuery 3.x (локально), jquery.validate (локально), прості CSS
- Backend: PHP 7+
- OpenAI: тільки через `/api/openai.php` (без стрімінгу, JSON-only)

## Запуск локально
```bash
php -S 0.0.0.0:8000 -t .
```
Потім відкрийте:
- Чат: `http://localhost:8000/chat/`
- Аналіз: `http://localhost:8000/analysis/`
- Демо: `http://localhost:8000/demo/`
- Форма: `http://localhost:8000/`

Без ключа OpenAI буде працювати fallback-сценарій (4–5 коротких питань → спрощений аналіз → демо).

## Налаштування ключа OpenAI
Проксі читає ключ у порядку:
1. env `OPENAI_API_KEY`
2. `/.openai_key` (рядок з ключем; файл ігнорується в git)

У продакшені використовуйте змінні оточення. Не зберігайте ключ у репозиторії.

## Keitaro-friendly
- Жодного SSE / `stream:true` — тільки JSON-відповіді
- Всі шляхи відносні (`../`) у підпапках
- Стабільні сторінки (форма з реальним endpoint-ом заглушкою, щоб уникнути 404)

## Структура
- `/chat/` — чат-опитування (`js/chat_flow.js`)
- `/analysis/` — картка аналізу (`js/analysis_card.js`)
- `/demo/` — демо-симуляція з інтеграційним шаром (`/demo/app/*`)
- `/api/openai.php` — JSON-проксі до OpenAI (без SSE)
- `/index.php` — фінальна форма, `js/handoff.js` переносить дані з `sessionStorage`

## Демо-симуляція: інтеграція (швидкий план)
1. Розпакуйте `demo.zip` у `/demo/vendor/` (код вендора не змінюйте).
2. Переконайтесь, що локально підключено `../js/lightweight-charts.standalone.production.js` (або вендорська копія).
3. Скелет сторінки — див. `/demo/index.html` (порядок: lib → vendor → `/demo/app/demo_sim.js`).
4. Наш API доступний як `window.Demo` з методами: `init`, `start`, `pause`, `reset`, `setAmount`, `setSpeed`, `on` тощо.
5. Події: `ready`, `trade`, `summary`. Після `summary` збереження у `sessionStorage.leadCtx.demo` і показ пост‑опитування.

## Acceptance Checklist
- [x] Чат працює, етапами керує `action` від GPT, кнопка «Перейти до демо» з’являється тільки за `goto_demo`
- [x] Бекенд повертає JSON; без SSE; стабільний для Keitaro
- [x] Аналіз показує оцінку/текст; є дисклеймер
- [x] Демо: локальні дані, 1–2 збиткові угоди
- [x] Після демо — питання готовності, потім форма
- [x] Форма валідна, hidden-поля з `sessionStorage`, UTM зчитуються
- [x] Всі шляхи через `../`
- [x] Тексти українською; немає гарантій прибутку; є дисклеймери