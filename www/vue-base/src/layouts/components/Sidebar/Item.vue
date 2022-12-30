<template>
    <div>
        <MenuItem :name="menu.path" :to="menu.path">
            <i-item-title :menu="menu" :hideTitle="hideTitle" />
        </MenuItem>
    </div>
</template>

<script setup>
import iItemTitle from './item-title'

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