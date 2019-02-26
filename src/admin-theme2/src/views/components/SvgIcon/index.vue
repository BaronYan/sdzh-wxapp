<template lang="pug">
  svg(:class="svgClass" aria-hidden="true")
    use(:xlink:href="iconName")
</template>
<script>
export default {
  name: "svg-icon",
  props: {
    iconClass: {
      type: String,
      required: true
    },
    className: {
      type: String
    }
  },
  computed: {
    iconName() {
      return `#icon-${this.iconClass}`
    },
    svgClass() {
      if(this.className){
        return `svg-icon ${this.className}`
      } else {
        return 'svg-icon'
      }
    }
  }
}
</script>

