export enum E_Layouts {
    DEFAULT = 'default',
    USER = 'user'
}

export enum E_LayoutToFileMap {
    default = 'DefaultLayout.vue',
    user = 'UserLayout.vue'
}

type NormalizedKey = keyof typeof E_LayoutToFileMap;
const normalizedLayoutName: NormalizedKey = layout || E_Layouts.DEFAULT;
