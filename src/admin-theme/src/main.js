import Vue from 'vue'
import App from './page/main.vue'
// import store from "@/store/index.js"// vuex

Vue.config.productionTip = false

new Vue({
  // store,
  render: h => h(App),
}).$mount('#app')
