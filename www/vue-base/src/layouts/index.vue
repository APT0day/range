<template>
    <div class="layout">
        <Layout>
            <!-- 侧边栏 -->
            <Sider class="layout-sider" :width="settings.layout.sidebarWidth" hide-trigger collapsible
                :collapsed-width="70" v-model="isCollapsed">
                <i-sidebar :collapsed="isCollapsed" />
            </Sider>
            <!-- 右侧内容区 -->
            <Layout>
                <Header class="layout-header">
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
}

const rotateCollapsedIcon = computed(() => {
    return isCollapsed.value ? 'layout-header-left-rotateCollapsedIcon' : ''
})
</script>