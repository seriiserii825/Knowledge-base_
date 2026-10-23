# Bing Webmaster Tools + Rank Math — настройка для GEO

Практическая инструкция к п. 9.2 из [[GEO-generative-engine-optimization]].

Проверено на ecomacchine.it и blueline.md (октябрь 2026).

---

## 1. Предварительная проверка из терминала

Перед регистрацией в Bing убедиться, что сайт вообще доступен роботам.

```bash
U=https://example.com

# bingbot / OAI-SearchBot не закрыты, указан Sitemap:
curl -sL $U/robots.txt

# Ответ на user-agent бота (должно быть 200)
curl -s -o /dev/null -w '%{http_code}\n' -A "Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)" $U/

# Верификации, meta robots, canonical
curl -sL $U/ | grep -oiE '<meta[^>]+(msvalidate|google-site-verification|robots)[^>]*>|<link[^>]+canonical[^>]*>'

# Сайтмап
curl -sL $U/sitemap_index.xml | grep -oE '<loc>[^<]+'

# SEO-плагин
curl -sL $U/ | grep -oiE 'rank math|yoast seo' | sort -u
```

Ответ 200 на UA бота не гарантирует, что WAF/CDN не режет **реальные IP** Bing — это видно уже в Bing WMT (Crawl / URL Inspection).

---

## 2. Добавление сайта в Bing Webmaster Tools

https://www.bing.com/webmasters/

### Вариант A — импорт из Google Search Console

Если сайт есть в **твоём** GSC: **Import your sites from GSC** → войти тем же Google-аккаунтом → выбрать сайт → Import.

Верификация и сайтмапы подтянутся автоматически.

### Вариант B — вручную через Meta Tag (через Rank Math)

1. **Add site manually** → URL сайта → способ **HTML Meta Tag**.
2. Скопировать значение `content="..."` из тега `msvalidate.01`.
3. WordPress → **Rank Math → General Settings → Webmaster Tools** → поле **Bing Webmaster Tools** → вставить **только код**, без `<meta>`.
   Нет вкладки Webmaster Tools → переключить Rank Math из Easy в **Advanced** mode.
4. Сохранить, **сбросить кеш** (плагин кеширования / nginx / хостинг).
5. Проверить, что тег отдаётся:
   ```bash
   curl -sL https://example.com/ | grep -i msvalidate
   ```
6. **Verify** в Bing.

### Важно

- Код `msvalidate.01` **один на Bing-аккаунт** — одинаковый для всех сайтов этого аккаунта.
- Не вставлять в `header.php` — слетит при обновлении темы, а тег нельзя удалять после верификации. Если без Rank Math — через хук `wp_head` в child-теме / mu-plugin.
- Не трогать поле Google в Rank Math: `google-site-verification` на сайте может принадлежать чужому аккаунту (клиент/агентство), замена сломает им верификацию.
- `MS=ms...` в DNS TXT — это верификация Microsoft 365, **не** Bing.

---

## 3. Сайтмапы

1. Bing → **Sitemaps** → добавить `https://example.com/sitemap_index.xml`.
2. **Мультиязычный сайт** (TranslatePress и т.п.): у каждого языка свой индекс, например `https://example.com/en/sitemap_index.xml`. В robots.txt указан только основной — дополнительные добавлять в Bing вручную.
3. **Rank Math → Sitemap Settings**: проверить, что все публичные типы записей включены (**Include in Sitemap**).
4. Проверить, нет ли битых URL в сайтмапе:
   ```bash
   U=https://example.com
   for sm in $(curl -sL $U/sitemap_index.xml | grep -oE 'https://[^<]+sitemap\.xml'); do
     curl -sL "$sm" | grep -oE '<loc>[^<]+' | sed 's/<loc>//'
   done | while read u; do
     printf '%s %s\n' "$(curl -s -o /dev/null -m 15 -w '%{http_code}' "$u")" "$u"
   done | grep -v '^200'
   ```

**Кейс ecomacchine.it:**
- CPT **Production** / **Progetti** (страницы продуктов — самые ценные для GEO) не были в сайтмапе ни IT, ни EN.
- В `/en/category-sitemap.xml` — `/en/category//` (404) из-за непереведённого слага категорий.

---

## 4. IndexNow (Rank Math → Instant Indexing)

IndexNow мгновенно уведомляет Bing (и Yandex, Seznam, Naver) о новых/изменённых URL.

### Включение

1. **Rank Math → Dashboard → Modules** → **Instant Indexing** → включить.
2. **Нет модуля** → Rank Math очень старый (признак: модуль называется «Search Console», а не «Analytics»):
   - бэкап (All-in-One WP Migration / UpdraftPlus);
   - обновить Rank Math (и Rank Math PRO, если есть — вместе);
   - проверить title/description, сайтмап, редиректы.

   Альтернатива без обновления — официальный плагин **IndexNow** от Microsoft (потом удалить, чтобы не было дублей).

### Настройка

**Rank Math → Instant Indexing → Settings:**

- **Auto-Submit Post Types:** Posts, Pages + публичные CPT (Events, Jobs, Products...).
  Не отмечать: Media, «тонкие» CPT без самостоятельной ценности (Testimonials).
- **API Key** генерируется автоматически, файл ключа: `https://example.com/<key>.txt`.
  ```bash
  curl -s https://example.com/<key>.txt   # должен вернуть сам ключ, 200
  ```
- **Submit URLs** → один раз отправить главную и ключевые страницы.
- **History** → статусы **200/202**. `202` = принято, ключ ещё проверяется (норма для первой отправки). `403` = ключ не найден/не совпал, `422` = URL не с этого домена, `429` = слишком часто.

Рекомендация «Set up IndexNow» на Home в Bing **не обновляется сразу** — висит красной ещё 1–2 дня после успешной отправки. Сначала URL появляются в Bing → **IndexNow** (через несколько часов), потом уходит рекомендация. Пусто через 2–3 дня → проверять, что WAF/кеш отдают Bing файл ключа.

---

## 5. AI Performance (BETA)

Bing → **AI Performance**. Источник цитирований: Microsoft Copilot и партнёры.

| Метрика           | Что значит                                                  |
| ----------------- | ----------------------------------------------------------- |
| Total Citations   | Сколько раз страницы сайта использовались как источник      |
| Avg. Cited Pages  | Среднее число разных цитируемых страниц в день              |
| Grounding Queries | Запросы, по которым Copilot искал источники и нашёл сайт    |
| Pages             | Какие именно страницы цитируются                            |

- Данные копятся примерно с конца сентября 2026, даже если выбран период 3M.
- Avg. Cited Pages ≈ 1 → ИИ берёт одну страницу, остальные не используются — точка роста.
- **List By → Grounding Queries / Pages → Download all** (CSV). Скачать **обе** вкладки.

### Проверка цитируемых URL

```bash
tail -n +2 ~/Downloads/example.com_AIPageStatsReport_*.csv | cut -d'"' -f2 | while read u; do
  curl -s -o /dev/null -m 20 -L -w "%{http_code} %{num_redirects}redir -> %{url_effective}   ($u)\n" "$u"
done
```

Плохо:
- **404** — Copilot цитирует несуществующую страницу.
- **Редирект на главную** — soft-404: сигнал о конкретном продукте теряется.

**Кейс ecomacchine.it:** 23 из 42 цитирований — URL старого сайта (Joomla: `/it/produzione/dissabbiatura/15-dissabbiatura/108-em40a`, `/en/24-produzione-eng/.../180-em51`). Часть отдаёт 404, часть редиректит на главную.

→ **Rank Math → Redirections**: 301 со старых URL на **соответствующие** новые страницы (EM40A → новая страница EM40A), не на главную.

Grounding Queries показывают реальные формулировки пользователей — по ним дописывать контент (п. 4.3 в [[GEO-generative-engine-optimization]]). На ecomacchine Copilot интересуют технические характеристики конкретных машин.

---

## 6. Recommendations (Home)

Типичные рекомендации Bing:
- Too many pages with identical titles / meta descriptions.
- Titles / meta descriptions too short.
- Set up IndexNow.

**Investigate** → точный список URL (там могут быть страницы вне сайтмапа).

### Аудит title из терминала

```bash
U=https://example.com
OUT=titles.tsv
for sm in $(curl -sL $U/sitemap_index.xml | grep -oE 'https://[^<]+sitemap\.xml'); do
  curl -sL "$sm" | grep -oE '<loc>[^<]+' | sed 's/<loc>//'
done | while read u; do
  t=$(curl -sL -m 15 "$u" | tr '\n' ' ' | grep -oiE '<title>[^<]*' | head -1 | sed 's/<title>//I')
  printf '%s\t%s\t%s\n' "${#t}" "$t" "$u"
done > $OUT

echo "== duplicates"; cut -f2 $OUT | sort | uniq -c | sort -rn | awk '$1>1'
echo "== short (<30)"; awk -F'\t' '$1<30' $OUT
```

Что исправлять:
- Единый шаблон в **Rank Math → Titles & Meta**. Разные разделители (`|` и ` - `) и регистр бренда = title, заданные вручную.
- Дубли страниц вида `slug-2` (на ecomacchine: `/sistemi-di-trattamento-2/`) — удалить или сделать 301.
- У EN-страниц итальянские слаги — не ошибка, но переведённые лучше для англоязычных запросов.

---

## 7. Чек-лист на сайт

- [ ] robots.txt не закрывает bingbot / OAI-SearchBot, UA бота → 200, meta robots `index`, canonical корректный
- [ ] Bing: сайт добавлен и верифицирован (msvalidate через Rank Math)
- [ ] Сайтмапы всех языков добавлены в Bing
- [ ] Все публичные CPT включены в сайтмап, в сайтмапе нет 404
- [ ] Rank Math актуальной версии
- [ ] Instant Indexing включён, нужные типы записей отмечены, ключ отдаётся, History 200/202
- [ ] AI Performance: CSV (Pages + Grounding Queries) скачан
- [ ] Цитируемые URL отдают 200 (не 404, не редирект на главную), для старых — 301 на аналог
- [ ] Recommendations разобраны (title / description / дубли)

---

## 8. Для 300+ сайтов

- Один `msvalidate.01` на Bing-аккаунт → можно раскатывать массово (WP-CLI / GEO-плагин).
- Для GSC удобнее Domain property через DNS TXT или общий агентский Google-аккаунт → тогда работает массовый импорт в Bing.
- Версии плагинов на сайтах разъехались (на blueline.md был Rank Math ~2020 года) — проверка версии Rank Math и наличия IndexNow-ключа должна быть в Technical Audit (п. 7.1).
- Автоматизируемо: сайтмапы по языкам, 404 в сайтмапах, статусы URL из AI-отчёта, аудит title.
- Данные AI Performance — только в Bing WMT (по каждому сайту, CSV).
