import Vue from "vue"
import Router from "vue-router"
// import store from "@/store/index.js"

Vue.use(Router)

function route(path, file, name, auth, children) {
  return {
    path,
    name,
    children,
    component: () => import(`@/${file}.vue`),
    meta:{
      requiresAuth:auth?true:false
    }
  }
}

const router = new Router({
  mode: "hash",
  routes: [
    route("/", "view/home", "home"),
  ]
})
export default router