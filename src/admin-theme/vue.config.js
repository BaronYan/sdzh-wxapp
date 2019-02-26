// 配置指南
// https://cli.vuejs.org

module.exports = {
  // 生产环境构建文件的目录
  outputDir: '../../public/vue',
  // 相对于 outputDir 的放置生成的静态资源的目录
  // assetsDir: '',
  // 去掉文件名中的 hash
  filenameHashing: false,
  // 删除 HTML 相关的 webpack 插件
  chainWebpack: config => {
    config.plugins.delete('html')
    config.plugins.delete('preload')
    config.plugins.delete('prefetch')
  },
  // 
  pages: {
    login: {
      entry: './src/login.js'
    },
    cate: {
      entry: './src/cate.js'
    }
  }
}