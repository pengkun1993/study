<template>
    <button v-on:click="count++">You clicked me {{ count }} times.</button>
</template>

<script>
// 定义一个名为 button-counter 的新组件
export default {
  name: 'HelloWorld',
  data () {
    return {
      count:0,
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
