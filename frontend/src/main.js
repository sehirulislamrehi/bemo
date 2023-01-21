import Vue from 'vue'
import App from './App.vue'
import router from './router'
Vue.config.productionTip = false

Vue.prototype.$apiURL = 'https://kanban-back.sehirulislamrehi.com/api/'


// Vue.prototype.$apiURL = 'http://localhost:8000/api/'

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
