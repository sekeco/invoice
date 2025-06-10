export default defineNuxtConfig({
  devtools: { enabled: true },

  modules: ['@nuxt/ui', '@nuxt/eslint', 'nuxt-auth-sanctum', '@pinia/nuxt'],

  css: ['~/assets/css/main.css'],

  app: {
    layoutTransition: { name: 'fade', mode: 'out-in' },
    pageTransition: { name: 'fade', mode: 'out-in' }
  },

  fonts: {
    families: [{
      name: 'Geist',
      provider: 'google'
    }]
  },

  icon: {
    customCollections: [{
      prefix: 'custom',
      dir: './app/assets/icons'
    }]
  },

  future: {
    compatibilityVersion: 4
  },

  compatibilityDate: '2024-11-27',

  sanctum: {
    mode: 'token',
    globalMiddleware: {
      enabled: true,
    },
    redirect: {
      onAuthOnly: '/auth/signin'
    }
  }
})