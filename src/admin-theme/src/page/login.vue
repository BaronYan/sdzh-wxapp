<template>
  <form class="login-form" @submit="formSubmit">
    <div class="form-group">
      <label for="username" class="sr-only">用户名</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="iconfont icon-username"></i>
        </div>
        <input
          type="text"
          class="form-control input-lg"
          placeholder="请输入管理员账号"
          autocomplete="off"
          v-model="formData.username"
        >
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="sr-only">密码</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="iconfont icon-password"></i>
        </div>
        <input
          type="password"
          class="form-control input-lg"
          placeholder="请输入您的密码"
          autocomplete="off"
          v-model="formData.password"
        >
      </div>
    </div>
    <div class="form-group">
      <label for="verify" class="sr-only">验证码</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="iconfont icon-verify"></i>
        </div>
        <input
          type="text"
          class="form-control input-lg login-verify-input"
          placeholder="请输入验证码"
          v-model="formData.verify"
          autocomplete="off"
        >
        <img ref='login-verify-img' class="login-verify-img" src="/admin/verify" alt="验证码" onclick="this.src='/admin/verify'">
      </div>
    </div>
    <div class="form-group">
      <button type="button" class="btn btn-primary btn-block btn-lg" @click="formSubmit">登录</button>
    </div>
    <div class="alert alert-danger" v-if="formError">
      {{formError}}
    </div>
  </form>
</template>

<script>
import {post} from '@/utils/request.js'
import swal from 'sweetalert2'
export default {
  name: "loginForm",
  data() {
    return {
      formError: '',
      formData: {
        username: "",
        password: "",
        verify: ""
      }
    };
  },
  methods: {
    formSubmit(e) {
      let form = this.formData;
      this.formError = ''
      if (!form.username) {
        this.formError = "用户名不能为空"
        return false
      }
      if (!form.password) {
        this.formError = "密码不能为空"
        return false
      }
      if (!form.verify) {
         this.formError = "验证码不能为空"
         return false
      }
      e.preventDefault()
      post('/admin/checklogin',{
          username: form.username,
          password: form.password,
          verify: form.verify
        }).then(ret => {
          if(ret.data.status > 0){
            swal({
              title: '登陆成功',
              text: ret.data.message,
              type: 'success',
              timer:3000
            })
            if(ret.data.url){
              setTimeout(function(){
                window.location.href=ret.data.url
              },1500)
            }
          }else{
            this.$refs['login-verify-img'].click()
            swal({
              title: '登录失败',
              text: ret.data.message,
              type: 'error',
              timer:3000
            })
          }
        })
    },

  }
};
</script>
