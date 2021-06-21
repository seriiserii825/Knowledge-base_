##install
npm install nuxt-i18n

### nuxt-config-modules
 ['nuxt-i18n', {
      detectBrowserLanguage: {
        useCookie: true,
        cookieKey: 'i18n_redirected',
        onlyOnRoot: true,  // recommended
        alwaysRedirect: false,
        fallbackLocale: 'en'
      },
      locales: [
        {
          name: 'Italiano',
          code: 'it',
          iso: 'it-IT',
          file: 'it-IT.js'
        },
        {
          name: 'English',
          code: 'en',
          iso: 'en-US',
          file: 'en-US.js'
        },
      ],
      parsePages: false,   // Disable babel parsing
      pages: {
        ['index']: {
          it: '/', // -> accessible at /about-us (no prefix since it's the default locale)
          en: '/', // -> accessible at /about-us (no prefix since it's the default locale)
        },
        ['clienti']: {
          it: '/clienti', // -> accessible at /about-us (no prefix since it's the default locale)
          en: '/clients', // -> accessible at /about-us (no prefix since it's the default locale)
        },
        ['contatti']: {
          it: '/contatti', // -> accessible at /about-us (no prefix since it's the default locale)
          en: '/contacts', // -> accessible at /about-us (no prefix since it's the default locale)
        },
        ['chi-siamo']: {
          it: '/chi-siamo', // -> accessible at /about-us (no prefix since it's the default locale)
          en: '/about-us', // -> accessible at /about-us (no prefix since it's the default locale)
        },
        ['web-e-digital']: {
          it: '/web-e-digital', // -> accessible at /about-us (no prefix since it's the default locale)
          en: '/web-and-digital', // -> accessible at /about-us (no prefix since it's the default locale)
        },
      },
      lazy: true,
      langDir: 'lang/',
      defaultLocale: 'it',
    }]

### menu
li
    nuxt-link(:to="localePath('/web-e-digital')" @click.native="closeMenu") {{ $t('pages.webAndDigital') }}

### en-US.js
export default {
  hello: 'Hello world',
  pages: {
    home: 'Home',
    webAndDigital: 'Web & Digital',
    outsourcing: 'Outsourcing',
    about: 'About',
    portfolio: 'Portfolio',
    clients: 'Clients',
    contacts: 'Contacts'
  },
}
