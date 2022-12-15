<template>
    <div class="layout">
        <Layout>
            <!-- 侧边栏 -->
            <Sider class="sider-container" />
            <!-- 右侧内容区 -->
            <div>
                <!-- 顶部导航栏 -->
                <Navbar />
                <!-- 内容区 -->
                <AppMain />
            </div>
        </Layout>
    </div>
</template>

<script setup>
import Sider from '@/components/Sider.vue';
import AppMain from '@/components/AppMain.vue'
import Navbar from '@/components/navbar.vue'
</script>