<template>
    <div>
        <Submenu :name="menu.path">
            <template #title>
                <i-item-title :menu="menu" :hideTitle="hideTitle" />
            </template>
            <template v-for="child in menu.children">
                <i-item v-if="child.children === undefined || !child.children.length" :menu="child" />
                <item-sub v-else :menu="child" />
            </template>
        </Submenu>
    </div>
</template>

<script setup>
import iItemTitle from './item-title'
import iItem from './item'

const props = defineProps({
    menu: {
        type: Object,
        default() {
            return {}
        }
    },
    hideTitle: {
        type: Boolean,
        default: false
    }
})
</script>
