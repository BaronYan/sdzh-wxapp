<template lang="pug">
	nav.navbar.navbar-default
		.container-fluid
			.navbar-header
				button.navbar-toggle.collapsed(type="button"
				data-toggle="collapse" data-target="#topnav" aria-expanded="false")
					span.icon-bar
					span.icon-bar
					span.icon-bar
				a.navbar-brand(href="/admin") 舍德智慧
			.collapse.navbar-collapse(id="topnav")
				ul.nav.navbar-nav
					li.active
						a(href="#") Dashboard
					li
						a(href="#") Pages
					li
						a(href="#") Posts
					li
						a(href="#") Users
				ul.nav.navbar-nav.navbar-right
					li
						a(href='#') Admin
					li
						a(href="#") Log out
</template>
<script>
export default {
  data(){
  	
  },
  methods: {

  }
}
</script>
