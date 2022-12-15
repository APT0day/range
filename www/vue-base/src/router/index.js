import { createRouter, createWebHashHistory } from 'vue-router'

// 工厂函数创建 router 实例
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('@/views/Home.vue')
        }
    ]
})

export default router