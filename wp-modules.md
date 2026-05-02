● На основе того что сделали в этом проекте — вот минимальный чеклист для любой темы:

---

1. Vite — добавить alias @

   // vite.config.js
   resolve: {
   alias: {
   '@': path.resolve(\_\_dirname, '.'),
   }
   }

2. TypeScript — добавить paths

   // tsconfig.json
   {
   "compilerOptions": {
   "baseUrl": ".",
   "paths": { "@/_": ["./_"] }
   },
   "include": ["src/**/*.ts", "src/**/*.vue", "modules/**/*.ts", "shims-vue.d.ts"]
   }

3. Создать модуль

   modules/feature-name/
   feature-name.php ← PHP шаблон (get_template_part)
   feature-name.scss ← стили
   feature-name.ts ← JS/анимация (если нужен)
   FeatureName.vue ← Vue компонент (если нужен)
   IFeatureResponse.ts ← TypeScript интерфейсы
   feature-api.php ← REST API (если нужен)

4. Подключить каждый тип файла

   PHP шаблон — в нужном template файле:
   get_template_part('modules/feature-name/feature-name');

   PHP API — в functions.php:
   require_once **DIR** . '/modules/feature-name/feature-api.php';

   SCSS — в src/scss/my.scss:
   @use '@/modules/feature-name/feature-name';

   TS — в src/js/my.ts:
   import featureAnimation from '@/modules/feature-name/featureAnimation';
   // в DOMContentLoaded:
   featureAnimation();

   Vue — в src/vue/vue-app.ts:
   import FeatureView from '@/modules/feature-name/FeatureView.vue';
   createVueApp('#vueFeature', FeatureView);

---

Что остаётся в src/

    src/ = инфраструктура
    modules/ = фичи

    scss/partials/ — переменные, миксины, base
    js/modules/helpers/ — mount, utils
    vue/utils/ — axios, helpers
    vue/vue-app.ts — точка входа

Что переезжает в modules/

    стили конкретных блоков
    JS конкретных блоков
    Vue компоненты и интерфейсы
    API файлы
