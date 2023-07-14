# src/hooks/life-cycle-logger.ts
import {onMounted, onUnmounted} from "vue";

export function useLifecycleLogger(payload) {
    onMounted(() => {
        //eslint-disable-next-line no-console
        console.log(payload, "mounted");
    });

    onUnmounted(() => {
        //eslint-disable-next-line no-console
        console.log(payload, "unmounted");
    });
}

# layouts/AppLayout.vue ============================================
<script setup lang="ts">
import {useRoute} from 'vue-router';

const route = useRoute();
</script>

<template>
  <component :is="route.meta.layout_component">
    <slot/>
  </component>
</template>

# App.vue ==========================================================
<script setup lang="ts">
import {RouterView} from 'vue-router'
import AppLayout from "@/layouts/AppLayout.vue";
</script>

<template>
  <AppLayout>
    <RouterView/>
  </AppLayout>
</template>

# E_Layouts.ts
export enum E_Layouts {
    DEFAULT = 'default',
    USER = 'user'
}

export enum E_LayoutToFileMap {
    default = 'DefaultLayout.vue',
    user = 'UserLayout.vue'
}

export enum E_LayoutName {
    DEFAULT = 'DefaultLayout',
    USER = 'UserLayout'
}

# layouts/DefaultLayout
<script lang="ts" setup="">
import {useLifecycleLogger} from "@/hooks/life-cicle-logger";
import {E_LayoutName} from "@/enum/E_Layouts";
useLifecycleLogger(E_LayoutName.DEFAULT);
</script>
<template>
  <div class='default-layout'>
    <h3>Default layout</h3>
    <slot/>
  </div>
</template>
<style lang="scss" scoped>
.default-layout {
}
</style>

# router/index.ts
import {createRouter, createWebHistory} from 'vue-router'
// @ts-ignore
import {E_Router} from '@/enum/E_Router';
import LoginView from '@/views/LoginView.vue'
// @ts-ignore
import {E_Layouts} from "@/enum/E_Layouts";
// @ts-ignore
import {loadLayoutMiddleware} from "@/router/middleware/loadLayout.middleware";

const router = createRouter({
// @ts-ignore
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: E_Router.LOGIN,
            component: LoginView,
            meta: {
                layout: E_Layouts.USER
            }
        },
    ]
})

router.beforeEach(loadLayoutMiddleware);

export default router

# router/middleware/loadLayout.middleware.ts
// @ts-ignore
import {E_Layouts, E_LayoutToFileMap} from "@/enum/E_Layouts";

export async function loadLayoutMiddleware(route) {
    const {layout} = route.meta;
    const normalizedLayoutName = layout || E_Layouts.DEFAULT;
    const fileName = E_LayoutToFileMap[normalizedLayoutName];
    const fileNameWithoutExtension = fileName.split('.vue')[0];

    const component = await import(
        `../../layouts/${fileNameWithoutExtension}.vue`
        );
    route.meta.layout_component = component.default;
}
