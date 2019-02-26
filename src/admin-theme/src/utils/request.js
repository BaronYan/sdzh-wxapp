import axios from "axios"
import qs from "qs"
import NProgress from "nprogress"

// 请求时的拦截器
axios.interceptors.request.use(config=>{
  // 这里可以加一些动作, 比如来个进度条开始动作
  NProgress.start()
  return config
},error=>{
  return Promise.reject(error)
})

// 请求完成后的拦截器
axios.interceptors.response.use(response => {
  NProgress.done()
  NProgress.remove()
  return response
}, error => {
  NProgress.remove()
  // 这里我们把错误信息扶正, 后面就不需要写 catch 了
  return Promise.reject(error)
})

// 创建一个 post 实例
export const post = (url,data) => {
  return axios({
    method: "post",
    url: url,
    data: qs.stringify(data),
    timeout: 30000, // 超时时间, 单位毫秒
    headers: {
      "X-Requested-With": "XMLHttpRequest",
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
    }
  })
}