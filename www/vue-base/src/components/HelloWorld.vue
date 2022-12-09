<script setup>
import Login from './Login.vue'
defineProps({
  msg: {
    type: String,
    required: true
  }
})
</script>

<template>
  <!-- <h1>Hello World!</h1> -->
  <Login />
</template>

<style scoped>
h1 {
  font-weight: 500;
  font-size: 2.6rem;
  top: -10px;
}
</style>
