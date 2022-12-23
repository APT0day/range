<template>
    <div>
        <div v-if="settings.layout.showLogo" class="layout-sider-logo" @click="$router.push('/')">
            <template v-if="!collapsed">
                <img :src="settings.layout.logo" class="layout-sider-logo-img" />
                <h1 class="layout-sider-logo-title">{{ settings.layout.title }}</h1> 
            </template>
            <template v-else>
                <img :src="settings.layout.logo" class="layout-sider-logo-img" />
            </template>        
        </div>
        <Menu mode="vertical" theme="dark" width="auto">
            <template v-if="!collapsed">
                <i-item v-for="route in routes" :key="route.path" :item="route" :base-path="route.path" />
            </template>
            <template v-else>
                ded
                <!-- <i-item v-for="route in routes" :key="route.path" :item="route" :base-path="route.path" /> -->
            </template>
        </Menu>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { routes } from '@/router/routes'
import iItem from './item.vue'
import settings from '@/settings'

const props = defineProps({
    collapsed: {
        type: Boolean,
        require: true
    }
})
</script>
