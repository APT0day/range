<template>
    <div>
        <Logo v-if="this.$store." />
        <Menu mode="vertical" theme="dark" width="auto">
            <Item v-for="route in routes" :key="route.path" :item="route" :base-path="route.path" />
        </Menu>
    </div>
</template>

<script setup>
import { routes } from '@/router/routes'
import Item from './Item.vue'
import Logo from './Logo.vue'
</script>

<style scoped>

</style>