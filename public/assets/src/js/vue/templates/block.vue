<template>
  <div id="block">
    <h1>{{ title }}</h1>
    <p>{{ text }}</p>
  </div>
</template>

<script>
module.exports = {
  el: '#block',
  data: {
    title: 'Lorem ipsum',
    text: 'Dolor sit amet'
  }
}
</script>

<style lang="sass" scoped>
#block {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  h1 {
    font-weight: normal;
  }
}
</style>
