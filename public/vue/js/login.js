(function(t){function r(r){for(var o,s,i=r[0],u=r[1],l=r[2],f=0,m=[];f<i.length;f++)s=i[f],n[s]&&m.push(n[s][0]),n[s]=0;for(o in u)Object.prototype.hasOwnProperty.call(u,o)&&(t[o]=u[o]);c&&c(r);while(m.length)m.shift()();return a.push.apply(a,l||[]),e()}function e(){for(var t,r=0;r<a.length;r++){for(var e=a[r],o=!0,i=1;i<e.length;i++){var u=e[i];0!==n[u]&&(o=!1)}o&&(a.splice(r--,1),t=s(s.s=e[0]))}return t}var o={},n={login:0},a=[];function s(r){if(o[r])return o[r].exports;var e=o[r]={i:r,l:!1,exports:{}};return t[r].call(e.exports,e,e.exports,s),e.l=!0,e.exports}s.m=t,s.c=o,s.d=function(t,r,e){s.o(t,r)||Object.defineProperty(t,r,{enumerable:!0,get:e})},s.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},s.t=function(t,r){if(1&r&&(t=s(t)),8&r)return t;if(4&r&&"object"===typeof t&&t&&t.__esModule)return t;var e=Object.create(null);if(s.r(e),Object.defineProperty(e,"default",{enumerable:!0,value:t}),2&r&&"string"!=typeof t)for(var o in t)s.d(e,o,function(r){return t[r]}.bind(null,o));return e},s.n=function(t){var r=t&&t.__esModule?function(){return t["default"]}:function(){return t};return s.d(r,"a",r),r},s.o=function(t,r){return Object.prototype.hasOwnProperty.call(t,r)},s.p="/";var i=window["webpackJsonp"]=window["webpackJsonp"]||[],u=i.push.bind(i);i.push=r,i=i.slice();for(var l=0;l<i.length;l++)r(i[l]);var c=u;a.push([0,"chunk-vendors"]),e()})({0:function(t,r,e){t.exports=e("352f")},"352f":function(t,r,e){"use strict";e.r(r);e("cadf"),e("551c"),e("097d");var o=e("2b0e"),n=function(){var t=this,r=t.$createElement,e=t._self._c||r;return e("form",{staticClass:"login-form",on:{submit:t.formSubmit}},[e("div",{staticClass:"form-group"},[e("label",{staticClass:"sr-only",attrs:{for:"username"}},[t._v("用户名")]),e("div",{staticClass:"input-group"},[t._m(0),e("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.username,expression:"formData.username"}],staticClass:"form-control input-lg",attrs:{type:"text",placeholder:"请输入管理员账号",autocomplete:"off"},domProps:{value:t.formData.username},on:{input:function(r){r.target.composing||t.$set(t.formData,"username",r.target.value)}}})])]),e("div",{staticClass:"form-group"},[e("label",{staticClass:"sr-only",attrs:{for:"password"}},[t._v("密码")]),e("div",{staticClass:"input-group"},[t._m(1),e("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.password,expression:"formData.password"}],staticClass:"form-control input-lg",attrs:{type:"password",placeholder:"请输入您的密码",autocomplete:"off"},domProps:{value:t.formData.password},on:{input:function(r){r.target.composing||t.$set(t.formData,"password",r.target.value)}}})])]),e("div",{staticClass:"form-group"},[e("label",{staticClass:"sr-only",attrs:{for:"verify"}},[t._v("验证码")]),e("div",{staticClass:"input-group"},[t._m(2),e("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.verify,expression:"formData.verify"}],staticClass:"form-control input-lg login-verify-input",attrs:{type:"text",placeholder:"请输入验证码",autocomplete:"off"},domProps:{value:t.formData.verify},on:{input:function(r){r.target.composing||t.$set(t.formData,"verify",r.target.value)}}}),e("img",{ref:"login-verify-img",staticClass:"login-verify-img",attrs:{src:"/admin/verify",alt:"验证码",onclick:"this.src='/admin/verify'"}})])]),e("div",{staticClass:"form-group"},[e("button",{staticClass:"btn btn-primary btn-block btn-lg",attrs:{type:"button"},on:{click:t.formSubmit}},[t._v("登录")])]),t.formError?e("div",{staticClass:"alert alert-danger"},[t._v("\n    "+t._s(t.formError)+"\n  ")]):t._e()])},a=[function(){var t=this,r=t.$createElement,e=t._self._c||r;return e("div",{staticClass:"input-group-addon"},[e("i",{staticClass:"iconfont icon-username"})])},function(){var t=this,r=t.$createElement,e=t._self._c||r;return e("div",{staticClass:"input-group-addon"},[e("i",{staticClass:"iconfont icon-password"})])},function(){var t=this,r=t.$createElement,e=t._self._c||r;return e("div",{staticClass:"input-group-addon"},[e("i",{staticClass:"iconfont icon-verify"})])}],s=e("b775"),i=e("3d20"),u=e.n(i),l={name:"loginForm",data:function(){return{formError:"",formData:{username:"",password:"",verify:""}}},methods:{formSubmit:function(t){var r=this,e=this.formData;return this.formError="",e.username?e.password?e.verify?(t.preventDefault(),void Object(s["a"])("/admin/checklogin",{username:e.username,password:e.password,verify:e.verify}).then(function(t){t.data.status>0?(u()({title:"登陆成功",text:t.data.message,type:"success",timer:3e3}),t.data.url&&setTimeout(function(){window.location.href=t.data.url},1500)):(r.$refs["login-verify-img"].click(),u()({title:"登录失败",text:t.data.message,type:"error",timer:3e3}))})):(this.formError="验证码不能为空",!1):(this.formError="密码不能为空",!1):(this.formError="用户名不能为空",!1)}}},c=l,f=e("2877"),m=Object(f["a"])(c,n,a,!1,null,null,null);m.options.__file="login.vue";var p=m.exports;new o["a"]({render:function(t){return t(p)}}).$mount("#loginForm")},b775:function(t,r,e){"use strict";e.d(r,"a",function(){return l});var o=e("bc3a"),n=e.n(o),a=e("4328"),s=e.n(a),i=e("323e"),u=e.n(i);n.a.interceptors.request.use(function(t){return u.a.start(),t},function(t){return Promise.reject(t)}),n.a.interceptors.response.use(function(t){return u.a.done(),u.a.remove(),t},function(t){return u.a.remove(),Promise.reject(t)});var l=function(t,r){return n()({method:"post",url:t,data:s.a.stringify(r),timeout:3e4,headers:{"X-Requested-With":"XMLHttpRequest","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}})}}});
//# sourceMappingURL=login.js.map