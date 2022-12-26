export const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('@/layouts/index.vue'),
        meta: { title: '首页', icon: 'ios-paper' },
        children: [
            {
                path: '/dashboard',
                name: 'Dashboard',
                meta: { title: '工作台' },
                component: () => import('@/views/dashboard/dashboard.vue')
            }
        ]
    },
    {
        path: '/sql',
        name: 'Sql',
        component: () => import('@/views/sql/sql1.vue'),
        meta: { title: 'SQL', icon: 'ios-paper' }
    },
    {
        path: '/xss',
        name: 'XSS',
        component: () => import('@/layouts/index.vue'),
        meta: { title: 'XSS', icon: 'ios-paper' },
        children: [
            {
                path: '/xss1',
                name: 'xss1',
                component: () => import('@/views/xss/xss1.vue'),
                meta: { title: 'XSS1' },
            }
        ]
    }
    // {
    //     path: '/',
    //     redirect: '/login',
    //     component: () => import('@/views/account/Login.vue')
    // },
    // {
    //     path: '/login',
    //     name: 'Login',
    //     component: () => import('@/views/account/Login.vue')
    // },
    // {
    //     path: '/home',
    //     name: 'home',
    //     component: () => import('@/views/Home.vue')
    // },
]

export default routes