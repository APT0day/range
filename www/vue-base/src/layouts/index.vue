<template>
    <div class="layout">
        <Layout>
            <!-- 侧边栏 -->
            <Sider class="layout-sider" :width="store.settings.sidebarWidth" hide-trigger collapsible
                :collapsed-width="70" v-model="isCollapsed">
                <i-sidebar :collapsed="isCollapsed" />
            </Sider>
            <!-- 右侧内容区 -->
            <Layout>
                <Header class="layout-header" style="height: 60px; padding: 0 20px;">
                    <!-- 顶部导航栏 -->
                    <div class="layout-header-left">
                        <!-- 顶部导航栏左侧 -->
                        <div class="layout-header-left-collapsedIcon">
                            <Icon @click="collapsedSider" :class="rotateCollapsedIcon" type="md-menu" size="24" />
                        </div>
                        <i-breadcrumb class="layout-header-left-breadcrumb" />
                    </div>
                    <div class="layout-header-right">
                        <!-- 顶部导航栏右侧 -->
                        <i-header-user />
                    </div>
                </Header>
                <Content class="layout-content">
                    <!-- 内容区 -->
                    <router-view v-slot="{ Component }">
                        <keep-alive>
                            <component :is="Component" />
                        </keep-alive>
                    </router-view>
                </Content>
            </Layout>
        </Layout>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { layoutStore } from '@/store/layout'
import iSidebar from '@/layouts/components/Sidebar/index.vue'
import iBreadcrumb from '@/layouts/components/Header/breadcrumb.vue'
import iHeaderUser from '@/layouts/components/Header/user.vue'

const isCollapsed = ref(false)
const store = layoutStore()

function collapsedSider() {
    isCollapsed.value = !isCollapsed.value
}

const rotateCollapsedIcon = computed(() => {
    return isCollapsed.value ? 'layout-header-left-rotateCollapsedIcon' : ''
})
</script>
<style lang="scss" scoped>
.layout {
    &-sider {
        background-color: #fff;
    }

    &-header {
        color: #f6ca9d;
        background-color: #fff;
    }
}
</style>