<template>
    <div class="layout">
        <Layout>
            <!-- 侧边栏 -->
            <Sider class="layout-sider" :width="settings.layout.sidebarWidth" ref="sider" hide-trigger collapsible
                :collapsed-width="78" v-model="isCollapsed">
                <i-sidebar :collapsed="isCollapsed" />
            </Sider>
            <!-- 右侧内容区 -->
            <Layout>
                <Header class="layout-header">
                    <!-- 顶部导航栏 -->
                    <div class="layout-header-left">
                        <!-- 顶部导航栏左侧 -->
                        <Icon @click="collapsedSider" :class="rotateIcon" type="md-menu" size="24" />
                        <i-breadcrumb />
                    </div>
                    <div class="layout-header-right">
                        <!-- 顶部导航栏右侧 -->
                        <i-header-user />
                    </div>
                </Header>
                <Content class="layout-content">
                    <!-- 内容区 -->
                    <!-- <keep-alive>
                        <router-view />
                    </keep-alive> -->
                </Content>
            </Layout>
        </Layout>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import iSidebar from '@/layouts/components/Sidebar/index.vue'
import iBreadcrumb from '@/layouts/components/Header/breadcrumb.vue'
import iHeaderUser from '@/layouts/components/Header/user.vue'
import settings from '@/settings'

const isCollapsed = ref(false)

function collapsedSider() {
    isCollapsed.value = !isCollapsed.value
    // sider.toggleCollapse();
}

const rotateIcon = computed(() => {
    return isCollapsed.value ? 'layout-header-left-rotateIcon' : ''
})
</script>