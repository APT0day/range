<template>
    <div>
        <div v-if="settings.layout.showLogo" class="layout-sider-logo" @click="$router.push('/')">
            <img :src="settings.layout.logo" class="logo" />
            <h1 class="title">{{ settings.layout.title }}</h1>           
        </div>
        <Menu mode="vertical" theme="dark" width="auto">
            <Item v-for="route in routes" :key="route.path" :item="route" :base-path="route.path" />
        </Menu>
    </div>
</template>

<script setup>
import { routes } from '@/router/routes'
import Item from './Item.vue'
import settings from '@/settings'
</script>
