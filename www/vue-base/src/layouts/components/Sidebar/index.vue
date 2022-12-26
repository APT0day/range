<template>
    <div>
        <div v-if="settings.layout.showLogo" class="layout-sider-logo" @click="$router.push('/')">
            <template v-if="!collapsed">
                <img :src="settings.layout.logo" class="layout-sider-logo-img" alt="logo" />
                <h1 class="layout-sider-logo-title">{{ settings.layout.title }}</h1> 
            </template>
            <template v-else>
                <img :src="settings.layout.logo" class="layout-sider-logo-img" alt="logo" />
            </template>
        </div>
        <Menu mode="vertical" theme="dark" :active-name="activeMenu" width="auto">
            <template v-if="!collapsed" v-for="route in routes">
                <i-item v-if="route.children === undefined || !route.children.length" :menu="route" />
                <i-item-sub v-else :menu="route" />
            </template>
            <template v-else>
                <i-item v-for="route in routes" :menu="route" hideTitle />
            </template>
        </Menu>
    </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';
import { useRoute } from 'vue-router'
import { routes } from '@/router/routes'
import iItem from './item.vue'
import iItemSub from './item-sub.vue'
import settings from '@/settings'

const props = defineProps({
    collapsed: {
        type: Boolean,
        require: true
    }
})

const activeMenu = computed(() => {
  const route = useRoute();
  const { meta, path } = route;
  if (meta.activeMenu) {
    return meta.activeMenu;
  }
  return path;
});
</script>
