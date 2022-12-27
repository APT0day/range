<template>
    <div>
        <div v-if="showLogo" class="layout-sider-logo" @click="$router.push('/')">
            {{ store }}
            <template v-if="!collapsed">
                <img :src="logo" class="layout-sider-logo-img" alt="logo" />
                <h1 class="layout-sider-logo-title">{{ title }}</h1> 
            </template>
            <template v-else>
                <img :src="logo" class="layout-sider-logo-img" alt="logo" />
            </template>
        </div>
        <Menu mode="vertical" theme="dark" :active-name="activeMenu" width="auto">
            <template v-if="!collapsed" v-for="route in routes">
                <i-item v-if="route.children === undefined || !route.children.length" :menu="route" />
                <i-item-sub v-else :menu="route" />
            </template>
            <template v-else v-for="route in routes">
                <Tooltip :content="route.meta.title" placement="right" v-if="route.children === undefined || !route.children.length">
                    <i-item v-for="route in routes" :menu="route" hideTitle />
                </Tooltip>
                
            </template>
        </Menu>
    </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';
import { useRoute } from 'vue-router'
import { routes } from '@/router/routes'
import { layoutStore } from '@/store/layout'
import iItem from './item.vue'
import iItemSub from './item-sub.vue'

const store = layoutStore()
// const { showLogo, logo, title } = layoutStore()

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
