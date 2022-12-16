import { createRouter, createWebHashHistory } from 'vue-router'
import routes from './routes'

// 工厂函数创建 router 实例
const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router