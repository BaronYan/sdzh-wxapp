import Vue from "vue"
import Vuex from "vuex"

import publics from "./modules/publics"
Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    publics
  }
})