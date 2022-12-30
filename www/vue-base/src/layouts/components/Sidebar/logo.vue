<template>
    <div class="layout-sider-logo">
        <img :src="settings.layout.logo" class="layout-sider-logo-img" alt="logo" />
        <div v-show="!collapsed" class="layout-sider-logo-title">
            <span>{{ settings.layout.title }}</span>
        </div>
    </div>
</template>

<script setup>
import settings from '@/settings'

const props = defineProps({
    collapsed: {
        type: Boolean,
        default: false
    }
})
</script>
