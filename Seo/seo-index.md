1. Redirect 301 when change page url
2. Title, desc, h1 - он должен быть. В моделях эти поля required.
3. Сайт открывается для индескации только после production
4. url хранить в bd.
5. rel canonical должен быть всегда, добавляем в шаблон на фронт
   {rel: 'caononical', href: `http://localhost:3000${this.$route.path}`}
6. og title, url, description, image
7. Метрика
8. Sitemap, exclude admin https://i.imgur.com/fzERq20.png

#no-index
«Ноиндекс» – тег и атрибут HTML-страницы. Можно пометить им страницу целиком, придав ей определенные свойства, либо выбрать отдельный участок кода и применить атрибут к нему.
Функция noindex заключается в «сокрытии» контента от поисковых роботов, машин, анализирующих и индексирующих веб-сайты. Они собирают базу данных для поисковых служб и предоставляют пользователям релевантные результаты поиска.
Если какая-то часть контента на странице помечена тегом noindex, то робот ее проигнорирует и в поиске она учтена не будет, что прямо повлияет на SEO-продвижение ресурса, на котором были произведены соответствующие изменения.

С таким кодом индексация страницы разрешается:

<meta name="robots" content="index"/> 
А с таким индексация запрещается:
<meta name="robots" content="noindex"/>

#no-follow
Что такое nofollow
Атрибут, вставляющийся перед ссылками и запрещающий по ним переходить.

Вес страницы — это своего рода уровень авторитетности сайтов, один из факторов, учитываемых при ранжировании страниц в поисковых запросах. Чтобы не передавать вес страницы другим сайтам по размещенным на них ссылкам, данные ссылки оборачивают в тег nofollow.

Какой контент помечается этим атрибутом?
Ссылки. Но не все ссылки, а те, что могут как-то негативно повлиять на вес ресурса. Это касается автоматических ссылок, появляющихся в тех или иных участках сайта. Атрибут nofollow стоило бы приписывать любым внешним ссылкам, за которые вы не можете ручаться. Добавленные на ресурс другими пользователями через секцию комментариев или в графу профиля БИО.

С таким тегом индексирование страницы разрешается, но запрещается переход по всем ссылкам:

<meta name="robots" content="nofollow"/>  
Как и в случае с <noindex>, правило можно задать для конкретного поискового робота:
<meta name="googlebot" content="nofollow"/>
Если мы говорим о конкретных ссылках, то переход на них можно запретить прямо внутри разметки.
<a href=“page.html” rel=“nofollow”>Гиперссылка</a>

<meta name="robots" content="index, follow"/>
А это полный запрет на контент и ссылки:
<meta name="robots" content="noindex, nofollow"/>

# Удалить полность страницу из индекса

<meta name="robots" content="noindex, nofollow"/> 
robots.txt
 Disallow: /index_test.php
 Disallow: /products/test_product.html
 Disallow: /products/
