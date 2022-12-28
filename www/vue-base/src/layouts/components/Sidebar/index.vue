<template>
    <div>
        <div v-if="store.settings.showLogo" style="display: flex; justify-content: center;"
            @click="$router.push('/dashboard')">
            <i-logo :collapsed="collapsed" />
        </div>
        <Menu mode="vertical" theme="light" accordion :active-name="activeName" :open-names="openNames" width="auto">
            <div v-for="route in routes">
                <template v-if="!collapsed">
                    <i-item v-if="route.children === undefined || !route.children.length" :menu="route" />
                    <i-item-sub v-else :menu="route" />
                </template>
                <template v-else>
                    <Tooltip :content="route.meta.title" placement="right"
                        v-if="route.children === undefined || !route.children.length">
                        <i-item v-for="route in routes" :menu="route" hideTitle />
                    </Tooltip>

                </template>
            </div>
        </Menu>
    </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';
import { useRoute } from 'vue-router'
import { routes } from '@/router/routes'
import { layoutStore } from '@/store/layout'
import iLogo from './logo.vue'
import iItem from './item.vue'
import iItemSub from './item-sub.vue'

const store = layoutStore()

const props = defineProps({
    collapsed: {
        type: Boolean,
        default: false
    }
})

const activeName = computed(() => {
    const route = useRoute();
    const { meta, path } = route;
    if (meta.activeMenu) {
        return meta.activeMenu;
    }
    return path;
});

const openNames = computed(() => {
    const route = useRoute()
    const { path } = route
    return '[' + path + ']'
})
</script>
<style lang="scss" scop>
.ivu-menu-light {
   &:after {
     height: 0px !important;
   }
}
</style>