<template>
    <div>
        <Menu active-name="1-2" theme="light" width="auto" :open-names="['1']">
            <Item v-for="route in routes" :key="route.path" :item="route" :base-path="route.path" />
        </Menu>
    </div>
</template>

<script setup>
import Item from '@/layouts/components/Sider/Item.vue'
</script>

<style scoped>

</style>