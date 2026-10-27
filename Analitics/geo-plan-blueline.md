# GEO-план — blueline.md

Пошаговое внедрение [[GEO-generative-engine-optimization]] на https://blueline.md/.
Практика по Bing — [[geo-bing-rankmath]].

Сайт: WordPress + Rank Math, языки RO (основной) / RU / EN, тематика — BPO-аутсорсинг и IT, Кишинёв.

---

## 0. Уже сделано

- [x] SEO: исправлены title / meta description (Rank Math)
- [x] Сайт добавлен и верифицирован в Bing Webmaster Tools (`msvalidate.01` отдаётся)

## Состояние на 2026-10-27 (проверка из терминала)

| Проверка                         | Результат                                                  |
| -------------------------------- | ---------------------------------------------------------- |
| robots.txt                       | ок — закрыт только `/wp-admin/`, указан Sitemap            |
| bingbot / OAI-SearchBot UA       | 200                                                        |
| meta robots / canonical          | `index, follow`, canonical корректный                      |
| hreflang                         | ro / ru / en + x-default                                   |
| Сайтмапы                         | `/sitemap_index.xml`, `/ru/…`, `/en/…` — все 200           |
| JSON-LD                          | Organization + WebSite + WebPage (Rank Math)               |
| **Organization.name**            | **`"Bueline"` — опечатка**, нет адреса, телефона, sameAs   |
| Аналитика (GA4 / GTM / Metrika)  | на главной не найдено                                      |
| llms.txt                         | 404                                                        |

---

## 1. Bing Webmaster Tools — довести до конца (п. 9.2)

- [ ] Sitemaps: добавить все три — `https://blueline.md/sitemap_index.xml`, `https://blueline.md/ru/sitemap_index.xml`, `https://blueline.md/en/sitemap_index.xml`
- [ ] Rank Math → Sitemap Settings: проверить, что все публичные типы записей включены (сейчас только `page` и `events`)
- [ ] Прогнать проверку на 404 в сайтмапах (скрипт в [[geo-bing-rankmath]] §3)
- [ ] Rank Math обновлён (был ~2020 года) → Instant Indexing включён
- [ ] IndexNow: файл ключа отдаётся 200, Submit URLs — главная + ключевые страницы, History 200/202
- [ ] Через 2–3 дня: URL появились в Bing → IndexNow, рекомендация «Set up IndexNow» ушла
- [ ] Recommendations на Home разобраны (Investigate → список URL)
- [ ] URL Inspection главной — Bing видит страницу, нет блокировок WAF/CDN

## 2. Google Search Console (п. 9.1)

- [ ] Сайт есть в GSC (Domain property через DNS TXT — покрывает все языки)
- [ ] Отправлены сайтмапы всех трёх языков
- [ ] Pages → нет массовых «Crawled – not indexed» / «Duplicate without canonical»
- [ ] Зафиксировать базовые показатели (показы, клики, топ-запросы за 3 мес.)

## 3. Web Analytics — AI-трафик (п. 9.3)

- [ ] Выяснить, стоит ли аналитика (на главной GA4/GTM/Metrika не найдены) — если нет, поставить GA4 (через Site Kit или GTM)
- [ ] GA4: Explore → сегмент по `session source` с regex
      `chatgpt\.com|chat\.openai\.com|perplexity\.ai|copilot\.microsoft\.com|bing\.com/chat|gemini\.google\.com|claude\.ai`
- [ ] Сохранить отчёт «AI referrals», смотреть раз в месяц
- [ ] Учитывать: часть AI-переходов приходит без referrer (Direct)

## 4. Structured Data (п. 4.2)

- [ ] Rank Math → Titles & Meta → Local SEO / Knowledge Graph: исправить имя **Bueline → Blueline**
- [ ] Заполнить: legalName, адрес (Chișinău), телефон, email, foundingDate (2008), parentOrganization (AR Group)
- [ ] `sameAs`: LinkedIn, Facebook, Instagram, профили на rabota.md / jobs и т.п.
- [ ] Страницы услуг (Back Office, Front Office, IT) → схема `Service` (только если есть отдельные страницы)
- [ ] Вакансии (`/cariere/`) → `JobPosting`, если вакансии публикуются отдельными страницами
- [ ] Проверить без дублей: https://validator.schema.org/ и Rich Results Test

## 5. Контент для AI-поиска (п. 4.3)

- [ ] Составить 10–15 вопросов, которые реально задают ИИ (RO / RU / EN), например:
  - `Companii BPO / outsourcing în Chișinău`
  - `Аутсорсинг колл-центра в Молдове — какие компании?`
  - `Back office outsourcing Moldova for European companies`
  - `Blueline Moldova — отзывы, вакансии, условия`
- [ ] Для каждой услуги — отдельная страница со структурой H2-вопросов: что делаем, для каких стран/языков, сколько сотрудников, процесс, безопасность данных (GDPR), кейсы, FAQ
- [ ] Страница «О компании» (`/company-blueline/`): факты — год основания, число сотрудников, языки, клиенты по странам, AR Group
- [ ] `/events/` — поздравления с праздниками (`sarbatori-fericite`, `paste-fericit`…) — малоценный для GEO контент: noindex или убрать из сайтмапа; полезные статьи оставить
- [ ] Даты публикации/обновления и автор на статьях
- [ ] Внутренние ссылки: статьи → страницы услуг → контакты

## 6. Репутация / внешние источники (п. 4.4)

- [ ] NAP (название, адрес, телефон) одинаковые на сайте, Google Business Profile, Bing Places, LinkedIn, Facebook, каталогах
- [ ] Google Business Profile — создан/проверен
- [ ] Bing Places for Business — создан (можно импортировать из GBP)
- [ ] LinkedIn-страница компании заполнена, ссылка на сайт
- [ ] Отзывы сотрудников / клиентов (Google, LinkedIn)
- [ ] Упоминания в местных СМИ / отраслевых каталогах (BPO Moldova, ATIC, AmCham и т.п.)

## 7. llms.txt (п. 5 — низкий приоритет)

- [ ] Создать `https://blueline.md/llms.txt`: описание компании + ссылки на услуги, о компании, карьеру, контакты (RO/EN)
- [ ] Проверить, что отдаётся 200 и `text/plain`

## 8. AI Visibility Monitoring (п. 9.4)

- [ ] Baseline: прогнать список вопросов из §5 в ChatGPT (с поиском), Perplexity, Copilot, Gemini, Google AI Mode
- [ ] Для каждого ответа записать: упомянута ли Blueline, есть ли ссылка, какая страница, какие конкуренты, корректны ли факты
- [ ] Хранить результаты в таблице (дата / сервис / вопрос / упоминание / URL / конкуренты)
- [ ] Bing → AI Performance: раз в месяц скачивать CSV (Pages + Grounding Queries), цитируемые URL проверять на 200
- [ ] Повторять раз в месяц, сравнивать с baseline

## 9. Итог / ревизия через 1–2 месяца

- [ ] Сравнить: GSC (показы/клики), Bing AI Performance (citations), GA4 AI referrals, ручной мониторинг
- [ ] Записать выводы, что сработало → перенести в шаблон для остальных сайтов (п. 11 Pilot Audit)
