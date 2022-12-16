<template>
    <div class="layout">
        <Layout>
            <!-- 侧边栏 -->
            <Sider class="sider-container" />
            <!-- 右侧内容区 -->
            <Layout>
                <div>
                    <!-- 顶部导航栏 -->
                    <!-- <Navbar /> -->
                    <!-- 内容区 -->
                    <!-- <AppMain /> -->
                </div>
            </Layout>
        </Layout>
    </div>
</template>

<script setup>
import Sider from '@/layouts/components/Sider/index.vue';
// import AppMain from '@/layouts/components/AppMain.vue'
// import Navbar from '@/layouts/components/navbar.vue'
</script>