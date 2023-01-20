import Vue from 'vue'
import App from './App.vue'
import router from './router'
Vue.config.productionTip = false

// Vue.prototype.$apiURL = 'http://as-associate-back.sehirulislamrehi.com/api'
// Vue.prototype.$baseURL = 'http://as-associate-back.sehirulislamrehi.com/images/resources_file/'


Vue.prototype.$apiURL = 'http://localhost:8000/api/'
Vue.prototype.$baseURL = 'http://localhost:8000/images/resources_file/'

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
