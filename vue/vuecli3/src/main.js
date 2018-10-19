import Vue from 'vue'
import App from './App.vue'
import router from './router'

Vue.config.productionTip = false

import Navigation from 'vue-navigation'
Vue.use(Navigation,{router})

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
