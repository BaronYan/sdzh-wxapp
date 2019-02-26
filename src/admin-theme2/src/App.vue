<template lang="pug">
#app
	PublicHeader
	PublicFooter
</template>

<script>
import PublicHeader from "@/views/common/PublicHeader.vue"
import PublicFooter from "@/views/common/PublicFooter.vue"
export default {
	components: {
		PublicHeader,
		PublicFooter
	}
}
</script>
<style lang="scss">
@import "style/variable.scss";

</style>