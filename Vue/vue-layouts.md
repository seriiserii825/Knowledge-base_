## src/router/index.js

Главный файл для роутов

```javscript
import { createRouter, createWebHistory } from 'vue-router';
import { loadLayoutMiddleware } from './middleware/loadLayout.middelware';
import { AppLayoutsEnum } from '../layouts/types';
import HomeView from '../views/HomeView.vue';

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: '/',
			name: 'home',
			component: HomeView,
		},
		{
			path: '/menu',
			name: 'menu',
			component: () => import('../views/MenuView.vue'),
			// meta: {
			// 	layout: AppLayoutsEnum.admin,
			// },
		},
	],
});

router.beforeEach(loadLayoutMiddleware);

export default router;
```

## src/layouts/types.js

```javascript
export const AppLayoutsEnum = {
	default: 'default',
	admin: 'admin',
	login: 'login',
	error: 'error',
};

export const AppLayoutToFileMap = {
	default: 'AppLayoutDefault.vue',
	admin: 'AppLayoutAdmin.vue',
	login: 'AppLayoutLogin.vue',
	error: 'AppLayoutError.vue',
};
```

## src/router/middleware/loadLayout.middleware.js

```javascript
import { AppLayoutsEnum, AppLayoutToFileMap } from '@/layouts/types.js';

export async function loadLayoutMiddleware(route) {
	const { layout } = route.meta;
	const normalizedLayoutName = layout || AppLayoutsEnum.default;
	const fileName = AppLayoutToFileMap[normalizedLayoutName];
	const fileNameWithoutExtension = fileName.split('.vue')[0];

	const component = await import(
		`../../layouts/${fileNameWithoutExtension}.vue`
	);
	route.meta.layoutComponent = component.default;
}
```

## src/App.vue

```javascript
<script setup>
	import { RouterView } from 'vue-router';
	import AppLayout from '@/layouts/AppLayout.vue';
</script>
<template>
	<AppLayout>
		<RouterView />
	</AppLayout>
</template>

```

##

```javascript
<script setup>
	import { useRoute } from 'vue-router';
	const route = useRoute();
</script>

<template>
	<component :is="route.meta.layoutComponent">
		<slot />
	</component>
</template>

<style scoped></style>

```

## src/layouts/AppLayoutDefault.vue

```javascript
<script setup>
	import { useLifecycleLogger } from '@/common/hooks/lifecycleLogger';
	useLifecycleLogger({ name: 'AppLayoutDefault' });
</script>

<template>
	<header class="main-header">
		<nav>
			<RouterLink to="/">Home</RouterLink>
			<RouterLink to="/menu">Menu</RouterLink>
		</nav>
	</header>
	<div class="wrapper">
		<div>AppLayoutDefault</div>
		<slot />
	</div>
</template>

```
