import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';
import store from '@/store'
import Axios from 'axios'

Vue.config.productionTip = false

Vue.use(
  {
    install (Vue) {
      Vue.prototype.$axios = Axios.create()
    }
  }
)

new Vue({
  router,
  vuetify,
  store,
  beforeMount: () => {
  },
  render: h => h(App)
}).$mount('#app')
