<template lang="pug">
.public-header
	.logo
		span 后台管理系统
	ul.header-nav
		<li><a href="">首页</a></li>
		<li><a href="">代购</a></li>
		<li><a href="">转运</a></li>
		<li><a href="">关于</a></li>
		<li><a href="">安全退出</a></li>
</template>
<script>
export default {
  name: "PublicHeader",
  data(){
    return {
      nav:[]
    }
  },
  methods:{

  }
}
</script>
<style lang="scss" scoped>
@import "../../style/index.scss";
.public-header{
	background-color: $nav-bg-color;
	height: $nav-h;
	color: $nav-color;
	line-height: $nav-h;
	padding:$nav-p;
	// overflow: hidden;
}
.logo{
	float: left;
}
ul{
	margin: 0;
	list-style: none;
	float: right;
	li{
		float: left;
		margin:0 5px;
		a{
			text-decoration: none;
			color: $nav-color;
		}
		a:hover{
			color: rgba($nav-color,.6);
		}
	}
}
</style>
