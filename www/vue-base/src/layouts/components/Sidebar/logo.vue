<template>
    <div class="layout-sider-logo">
        <img :src="store.settings.logo" class="layout-sider-logo-img" alt="logo" />
        <div v-show="!collapsed" class="layout-sider-logo-title">
            <span>{{ store.settings.title }}</span>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { layoutStore } from '@/store/layout'

const props = defineProps({
    collapsed: {
        type: Boolean,
        default: false
    }
})

const store = layoutStore()
</script>
