<template>
    <div>
        <Submenu :name="menu.path">
            <template #title>
                <i-item-title :icon="menu.meta.icon" :title="menu.meta.title" />
            </template>
            <template v-for="child in menu.children">
                <i-item v-if="child.children === undefined || !child.children.length" :menu="child" />
                <item-sub v-else :menu="child" />
            </template>
        </Submenu>
    </div>
</template>

<script setup>
import { defineProps } from 'vue'
import iItemTitle from './item-title.vue'
import iItem from './Item.vue'

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
