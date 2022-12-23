<template>
    <div>
        <Submenu :name="item.path">
            <template #title>
                <Icon :type="item.meta.icon" />
                {{ item.meta.title }}
            </template>
            <Item v-if="item.children" v-for="child in item.children" :key="child.path" :item="child" :base-path="child.path"  />
        </Submenu>
    </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    item: {
        type: Object,
        require: true
    },
    basePath: {
        type: String,
        default: ''
    }
})

</script>