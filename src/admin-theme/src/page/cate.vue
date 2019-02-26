<template lang="pug">
.modal.fade(id="modalCateOptModal" tabindex="-1" role="dialog" aria-labelledby="modalCateOptLabel")
  .modal-dialog(role="document")
    .modal-content
      .modal-header
        button.close(type="button" data-dismiss="modal" aria-label="关闭")
          span(aria-hidden="true") &times;
        h4.modal-title(id="modalCateOptLabel") {{formData.modalTitle}}
      .modal-body
        form#cateOptForm
          .form-group
            label(for="cateName") 分类名称
            input.form-control(type="text" id="cateName" v-model='formData.title' placeholder="分类名称不能重复")
          .form-group
            label(for="cateSort") 分类排序
            input.form-control(type="number" id="cateSort" v-model='formData.sort' placeholder="分类排序")
        .alert.alert-danger(v-if="formData.formError") {{formData.formError}}
      .modal-footer
        button.btn.btn-default(type="button" data-dismiss="modal") 关闭
        button.btn.btn-primary(type="button" @click='submit') {{formData.btnSubmit}}
</template>
<script>
import {post} from '@/utils/request.js'
import swal from 'sweetalert2'
let cateFormData = {
  modalTitle: '新增分类',
  btnSubmit: '确认新增',
  formType: 'add',
  formError: '',
  id: '',
  title: '',
  sort: 0,
  pid: 0
}
window.cateFormData = cateFormData
export default {
  name: "cateForm",
  data(){
    return {
      formData:cateFormData
    }
  },
  methods: {
    submit(e){
      let self = this.formData, url = '', data = {}
      self.formError = ''
      if (!self.title) {
        self.formError = "分类名称不能为空"
        return false
      }
      if(self.formType == 'add'){
        url = '/admin/addcate'
        data = {
          title: self.title,
          sort: self.sort,
          pid: self.pid
        }
      }else{
        url = '/admin/editcate'
        data = {
          sccid: self.id,
          title: self.title,
          sort: self.sort,
          pid: self.pid
        }
      }
      e.preventDefault()
      post(url,data).then(ret => {
        if(ret.data.status > 0){
            swal({
              title: '操作成功',
              text: ret.data.message,
              type: 'success'
            })
          }else{
            swal({
              title: '操作失败',
              text: ret.data.message,
              type: 'error'
            })
          }
      })
    }
  }
}
</script>
