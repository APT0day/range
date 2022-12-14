<template>
    <div>
        <!-- 侧边栏 -->
        <Sidebar class="sidebar-container" />
        <!-- 右侧内容区 -->
        <div>
            <!-- 顶部导航栏 -->
            <Navbar />
            <!-- 内容区 -->
            <AppMain />
        </div>
    </div>
</template>

<script setup>
import AppMain from './components/AppMain.vue'
import Navbar from './components/navbar.vue'
import Sidebar from './components/Sidebar.vue';
</script>