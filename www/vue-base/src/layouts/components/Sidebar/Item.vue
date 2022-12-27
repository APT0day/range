<template>
    <div>
        <MenuItem :name="menu.path" :to="menu.path">
            <i-item-title :icon="menu.meta.icon" :title="menu.meta.title" />
        </MenuItem>
    </div>
</template>

<script setup>
import { defineProps } from 'vue'
import iItemTitle from './item-title.vue'

const props = defineProps({
    menu: {
        type: Object,
        require: true
    },
    hideTitle: {
        type: Boolean,
        default: false
    }
})
</script>