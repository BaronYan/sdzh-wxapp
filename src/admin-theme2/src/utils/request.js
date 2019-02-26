import axios from 'axios'
import NProgress from 'nprogress'
import qs from 'qs'

axios.interceptors.request.use(
  config => {
    NProgress.start()
    return config
  },
  error => {
    NProgress.done()
    setTimeout(() => {
      NProgress.remove()
    }, 500)
    return Promise.reject(error)
  }
)

axios.interceptors.response.use(
  response => {
    NProgress.done()
    setTimeout(() => {
      NProgress.remove()
      }, 500)
    return response
  },
  error => {
    NProgress.done()
    setTimeout(() => {
      NProgress.remove()
    }, 500)
    return Promise.reject(error)
  }
)

export const get = (url, params) => {
  return axios({
    method: 'get',
    url: url,
    params,
    timeout: 30000,
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
}

export const post = (url, data) => {
  return axios({
    method: 'post',
    url: url,
    data: qs.stringify(data),
    timeout: 30000,
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
    }
  })
}