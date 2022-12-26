<template>
    <div>
        <Icon v-if="icon" :type="icon" />
        <span v-if="!hideTitle">{{ title }}</span>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    icon: {
        type: String,
        default: ''
    },
    title: {
        type: String,
        default: ''
    },
    hideTitle: {
        type: Boolean,
        default: false
    },
})
</script>
