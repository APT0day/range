<template>
    <div>
        deffe
        {{ store.count }}
        {{ store.settings }}
    </div>
</template>

<script setup>
import { userStore } from '@/store/user'
const store = userStore()

</script>

<style scoped>

</style>