# GEO-план — blueline.md

Пошаговое внедрение [[GEO-generative-engine-optimization]] на https://blueline.md/. Практика по Bing —
[[geo-bing-rankmath]].

Сайт: WordPress + Rank Math, языки RO (основной) / RU / EN, тематика — BPO-аутсорсинг и IT, Кишинёв.

---

## 0. Уже сделано

- [x] SEO: исправлены title / meta description (Rank Math)
- [x] Сайт добавлен и верифицирован в Bing Webmaster Tools (`msvalidate.01` отдаётся)

## Состояние на 2026-10-27 (проверка из терминала)

| Проверка                        | Результат                                                |
| ------------------------------- | -------------------------------------------------------- |
| robots.txt                      | ок — закрыт только `/wp-admin/`, указан Sitemap          |
| bingbot / OAI-SearchBot UA      | 200                                                      |
| meta robots / canonical         | `index, follow`, canonical корректный                    |
| hreflang                        | ro / ru / en + x-default                                 |
| Сайтмапы                        | `/sitemap_index.xml`, `/ru/…`, `/en/…` — все 200         |
| JSON-LD                         | Organization + WebSite + WebPage (Rank Math)             |
| **Organization.name**           | **`"Bueline"` — опечатка**, нет адреса, телефона, sameAs |
| Аналитика (GA4 / GTM / Metrika) | на главной не найдено                                    |
| llms.txt                        | 404                                                      |

---

## 1. Bing Webmaster Tools — довести до конца (п. 9.2)

https://www.bing.com/webmasters/

- [x] Sitemaps: добавить все три — `https://blueline.md/sitemap_index.xml`, `https://blueline.md/ru/sitemap_index.xml`,
      `https://blueline.md/en/sitemap_index.xml` https://www.bing.com/webmasters/sitemaps?siteUrl=https://blueline.md/
      Добавить sitemap для каждого языка через кнопку **Submit Sitemap**. Проверить, что все 3 sitemap отдают 200.
- [x] Rank Math → Sitemap Settings: проверить, что все публичные типы записей включены (сейчас только `page` и `events`)
- [x] Прогнать проверку на 404 в сайтмапах (скрипт в [[geo-bing-rankmath]] §3)
- [x] Rank Math обновлён (был ~2020 года) → Instant Indexing включён
- [x] IndexNow: файл ключа отдаётся 200, Submit URLs — главная + ключевые страницы, History 200/202
- [ ] Через 2–3 дня: URL появились в Bing → IndexNow, рекомендация «Set up IndexNow» ушла

### IndexNow — как делали (2026-10-28)

Общая инструкция — [[geo-bing-rankmath]] §4. Здесь — специфика blueline.md.

Админка на румынском: **Panou control → Indexare imediată** (= Instant Indexing). Вкладки: **Trimite URL-uri** (Submit
URLs), **Setări** (Settings), **Istoric** (History). Кнопки: «Trimite URL-uri» — отправить, «Salvează modificările» —
сохранить.

1. **Setări:** отметить авто-отправку для Pagini + Events, сохранить. Скопировать ключ → проверить файл ключа:
   ```bash
   curl -sI https://blueline.md/<key>.txt | head -1   # HTTP/2 200
   ```
2. **Список URL** — собирать из сайтмапов всех трёх языков (а не только RO — на 2026-10-28 это 96 URL: 32 RO + 32 RU +
   32 EN):
   ```bash
   for lang in "" ru/ en/; do curl -s "https://blueline.md/${lang}sitemap_index.xml"; done \
     | grep -o '<loc>[^<]*</loc>' | sed 's/<\/\?loc>//g' \
     | while read -r sm; do curl -s "$sm"; done \
     | grep -o '<loc>[^<]*</loc>' | sed 's/<\/\?loc>//g' | grep -v '/wp-content/' | sort -u
   ```
   Поздравления из `/events/` (см. §5) лучше не отправлять, если их собираемся закрыть noindex.
3. **Trimite URL-uri:** вставить список (по одному на строку, до 10 000) → «Trimite URL-uri».
4. **Istoric:** 200/202 — ок; 403 — Bing не прочитал файл ключа; 422 — URL не с этого домена; 429 — слишком часто.
5. Дальше вручную ничего не нужно — новые/изменённые страницы уходят автоматически (п. 1). Ручная отправка — только
   после массовых правок (title/description, переезд URL).

**Почему IndexNow не первым пунктом**, хотя в Bing он красный: красный цвет — приоритет самого Bing (продвигает свой
протокол), а не критичность для сайта. IndexNow только ускоряет обход, он ничего не чинит. Сначала сайтмапы и проверка
на 404 — иначе мы мгновенно «пингуем» битые/лишние URL. Плюс без обновления Rank Math модуля Instant Indexing не было
вовсе.

- [x] Recommendations на Home разобраны (Investigate → список URL)
- [ ] URL Inspection главной — Bing видит страницу, нет блокировок WAF/CDN

### Testimonials — убрать из Bing (2026-10-28)

**Проблема:** отзывы (CPT Testimonial, `/testimonials/…` на RO/RU/EN) попали в Bing — в т.ч. отправлены через IndexNow.
Это «тонкий» контент (см. [[geo-bing-rankmath]] §4), плюс title не переведены → одинаковый title на трёх языках («Igor
Profir - Blueline», «Testimonial - Blueline»), Bing считает это identical titles.

**Ошибка:** сначала выключили **Setări hărți site → Testimonial → Include în hărți site**. Это убирает тип только из
сайтмапа, но не из индекса — страницы по-прежнему отдавали `index, follow`.

**Как правильно:**

- [x] **Titluri și meta → Testimonial → Robots Meta personalizat → No Index** (+ архив `/testimonials/`), сохранить,
      сбросить кеш. WPGlobus — robots общий для всех языков. Если отдельная запись всё ещё `index` — в ней Rank Math →
      Advanced переопределяет robots
- [x] Проверить, что noindex реально отдаётся на всех языках:
  ```bash
  for u in \
    https://blueline.md/testimonials/igor-profir/ \
    https://blueline.md/ru/testimonials/igor-profir/ \
    https://blueline.md/en/testimonials/igor-profir/ \
    https://blueline.md/testimonials/
  do
    echo "$u -> $(curl -s "$u" | grep -oi '<meta name="robots"[^>]*>')"
  done
  ```
  Ожидается `follow, noindex` (на 2026-10-28 — ок). Цикл без `;` — при вставке в zsh `;` экранировался (`\;`) →
  `parse error near 'done'`.
- [x] Testimonial убран из сайтмапа (Include în hărți site — выкл.)
- [x] IndexNow → Trimite URL-uri: отправить все testimonial-URL всех языков (архивы `/testimonials/`, `/ru/…`, `/en/…` +
      каждый отзыв) — Bing переобойдёт и увидит noindex. Istoric: 200/202
- [x] Indexare imediată → Setări: снять Testimonial с авто-отправки
- [x] (по желанию, быстрее) Bing → Configuration → **Block URLs** → Directory, «Block URL and cache»:
      `https://blueline.md/testimonials/`, `/ru/testimonials/`, `/en/testimonials/` — три записи, блок каталога не
      распространяется на другие языковые префиксы. Действует 90 дней, дальше держит только noindex
- [x] Через 1–2 недели: Bing → URL Inspection `https://blueline.md/testimonials/igor-profir/` → «Excluded by noindex»;
      поиск `site:blueline.md/testimonials` пустой

**Не делать:** закрывать `/testimonials/` в robots.txt — Bing не сможет зайти, не увидит noindex и оставит URL в индексе
без описания.

**Вывод для шаблона:** «убрать из сайтмапа» ≠ «убрать из индекса». Для удаления — noindex → проверить curl'ом → IndexNow
на эти URL (→ Block URLs для скорости). Тонкие CPT закрывать noindex _до_ первой отправки в IndexNow.

## 2. Google Search Console (п. 9.1)

- [ ] Сайт есть в GSC (Domain property через DNS TXT — покрывает все языки)
- [ ] Отправлены сайтмапы всех трёх языков
- [ ] Pages → нет массовых «Crawled – not indexed» / «Duplicate without canonical»
- [ ] Зафиксировать базовые показатели (показы, клики, топ-запросы за 3 мес.)

## 3. Web Analytics — AI-трафик (п. 9.3)

- [ ] Выяснить, стоит ли аналитика (на главной GA4/GTM/Metrika не найдены) — если нет, поставить GA4 (через Site Kit или
      GTM)
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
- [ ] Для каждой услуги — отдельная страница со структурой H2-вопросов: что делаем, для каких стран/языков, сколько
      сотрудников, процесс, безопасность данных (GDPR), кейсы, FAQ
- [ ] Страница «О компании» (`/company-blueline/`): факты — год основания, число сотрудников, языки, клиенты по странам,
      AR Group
- [ ] `/events/` — поздравления с праздниками (`sarbatori-fericite`, `paste-fericit`…) — малоценный для GEO контент:
      noindex или убрать из сайтмапа; полезные статьи оставить
- [ ] Даты публикации/обновления и автор на статьях
- [ ] Внутренние ссылки: статьи → страницы услуг → контакты

## 6. Репутация / внешние источники (п. 4.4)

- [ ] NAP (название, адрес, телефон) одинаковые на сайте, Google Business Profile, Bing Places, LinkedIn, Facebook,
      каталогах
- [ ] Google Business Profile — создан/проверен
- [ ] Bing Places for Business — создан (можно импортировать из GBP)
- [ ] LinkedIn-страница компании заполнена, ссылка на сайт
- [ ] Отзывы сотрудников / клиентов (Google, LinkedIn)
- [ ] Упоминания в местных СМИ / отраслевых каталогах (BPO Moldova, ATIC, AmCham и т.п.)

## 7. llms.txt (п. 5 — низкий приоритет)

- [ ] Создать `https://blueline.md/llms.txt`: описание компании + ссылки на услуги, о компании, карьеру, контакты
      (RO/EN)
- [ ] Проверить, что отдаётся 200 и `text/plain`

## 8. AI Visibility Monitoring (п. 9.4)

- [ ] Baseline: прогнать список вопросов из §5 в ChatGPT (с поиском), Perplexity, Copilot, Gemini, Google AI Mode
- [ ] Для каждого ответа записать: упомянута ли Blueline, есть ли ссылка, какая страница, какие конкуренты, корректны ли
      факты
- [ ] Хранить результаты в таблице (дата / сервис / вопрос / упоминание / URL / конкуренты)
- [ ] Bing → AI Performance: раз в месяц скачивать CSV (Pages + Grounding Queries), цитируемые URL проверять на 200
- [ ] Повторять раз в месяц, сравнивать с baseline

## 9. Итог / ревизия через 1–2 месяца

- [ ] Сравнить: GSC (показы/клики), Bing AI Performance (citations), GA4 AI referrals, ручной мониторинг
- [ ] Записать выводы, что сработало → перенести в шаблон для остальных сайтов (п. 11 Pilot Audit)
