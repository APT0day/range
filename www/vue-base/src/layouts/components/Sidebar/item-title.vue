<template>
    <div>
        <Icon v-if="menu.meta != undefined && menu.meta.icon != undefined" :type="menu.meta.icon" />
        <span v-if="menu.meta != undefined && menu.meta.title != undefined && !hideTitle">{{ menu.meta.title }}</span>
    </div>
</template>

<script setup>
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
    },
})
</script>
