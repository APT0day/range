const routes = [
    // {
    //     path: '/',
    //     redirect: {
    //         name: 'home'
    //     },
    //     component: () => import('@/layouts/index.vue'),
    //     alwaysShow: true,
    //     meta: { title: '导航' },
    //     children: [
    //         {
    //             path: '/',
    //             name: 'home',
    //             component: () => import('@/views/Home.vue'),
    //             meta: { title: '首页' }
    //         }
    //     ]
    // },
    {
        path: '/',
        redirect: '/login',
        component: () => import('@/views/account/Login.vue')
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('@/views/account/Login.vue')
    },
    {
        path: '/home',
        name: 'home',
        component: () => import('@/views/Home.vue')
    },
]

export default routes