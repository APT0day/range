<template>
    <div>
        <div v-if="settings.layout.showLogo" style="display: flex; justify-content: center;"
            @click="router.push('/')">
            <i-logo :collapsed="collapsed" />
        </div>
        <Menu mode="vertical" theme="light" accordion :active-name="router.name" :open-names="['dashboard-console']" width="auto">
            <div v-for="route in store.siderMenuList">
                <template v-if="!collapsed">
                    <i-item v-if="route.children === undefined || !route.children.length" :menu="route" />
                    <i-item-sub v-else :menu="route" />
                </template>
                <template v-else>
                    <Tooltip :content="route.name" placement="right"
                        v-if="route.children === undefined || !route.children.length">
                        <i-item :menu="route" hideTitle />
                    </Tooltip>
                    <template v-else>defef</template>
                </template>
            </div>
        </Menu>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRouter, useRoute } from 'vue-router'
import settings from '@/settings'
import iLogo from './logo'
import iItem from './item'
import iItemSub from './item-sub'
import { useLayoutStore } from '@/store/layout'

const router = useRouter()
const store = useLayoutStore()

const props = defineProps({
    collapsed: {
        type: Boolean,
        default: false
    }
})

const activeName = computed(() => {
    const route = useRoute();
    return route.name;
});

</script>
<style lang="scss" scop>
// 去除 iview menu 组件下的下划线
.ivu-menu-light {
   &:after {
     height: 0px !important;
   }
}
</style>