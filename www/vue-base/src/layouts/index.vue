<template>
    <div class="layout">
        <Layout>
            <!-- 侧边栏 -->
            <Sider class="layout-sider" :width="settings.layout.sidebarWidth">
                <Sidebar />
            </Sider>
            <!-- 右侧内容区 -->
            <Layout>
                <Header class="layout-header">
                    <!-- 顶部导航栏 -->
                    <!-- <Navbar /> -->
                    <div class="layout-header-right">
                        <header-user />
                    </div>
                </Header>
                <Content class="layout-content">
                    <!-- 内容区 -->
                    <!-- <AppMain /> -->
                </Content>
            </Layout>
        </Layout>
    </div>
</template>

<script setup>
import Sidebar from '@/layouts/components/Sidebar/index.vue'
import Navbar from '@/layouts/components/Header/index.vue'
// import AppMain from '@/layouts/components/AppMain.vue'
import headerUser from '@/layouts/components/Header/User.vue'
import settings from '@/settings'
</script>