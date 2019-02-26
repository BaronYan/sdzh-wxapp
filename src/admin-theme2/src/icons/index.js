import Vue from 'vue'
import SvgIcon from '@/views/components/SvgIcon'

Vue.component('svg-icon',SvgIcon)



// require 是 node.js 的一个 api，用于导入模块/JSON/本地文件。
// 模块可以从 node_modules 中导入，本地模块 和 JSON 文件可以使用相对路径
// 
// require.context 为 webpack 的特定方法
// require.context 通过正则匹配引入相应的文件模块
// require.context(directory, useSubdirectories, regExp)
// directory:         需要检索的目录
// useSubdirectories: 是否检索子目录
// regExp:            匹配文件的正则表达式
const req = require.context('./icon',false,/\.svg$/)

const requireAll = requireContent => requireContent.keys().map(requireContent)

requireAll(req)
