<template>
    <div>
        <Submenu :name="menu.path">
            <template #title>
                <i-item-title :icon="menu.meta.icon" :title="menu.meta.title" :hideTitle="hideTitle" />
            </template>
            <item v-for="child in menu.children" :menu="child" />
        </Submenu>
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
