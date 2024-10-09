// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: false },
  css: ['~/assets/css/main.css', '~/assets/css/global.css'],

  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },

  devServer:{
    host: 'http://backend.test/'
  },

  modules: ['nuxt-auth-sanctum'],

  sanctum:{
    baseUrl: 'http://backend.test', 
    redirect:{
      onLogin: '/dashboard',
      onAuthOnly: '/auth/login',
      onGuestOnly: '/dashboard',
      // onLogout: '/',

    }
  }
})