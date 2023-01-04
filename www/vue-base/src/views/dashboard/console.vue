<template>
    <div>
        deffe
        <br><br>
        {{ store.getRoute }}
        <Button type="primary" @click="store.getRoutes()"></Button>
        {{ store.siderMenuList }}
    </div>
</template>

<script setup>
import { useLayoutStore } from '@/store/layout'
const store = useLayoutStore()
</script>
