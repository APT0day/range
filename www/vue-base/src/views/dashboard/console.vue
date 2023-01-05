<template>
    <div>
        {{ store.getRoute }}
        <Button type="primary" @click="store.getRoutes()"></Button>
        {{ store.siderMenuList }}
        <br><br>
        {{ route.path }}
        {{ router.options.routes }}
    </div>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { useLayoutStore } from '@/store/layout'
const store = useLayoutStore()

const route = useRoute()
const router = useRouter()
</script>
