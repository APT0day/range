export const routes = [
    {
        path: '/',
        // redirect: {
        //     name: 'home'
        // },
        component: () => import('@/layouts/index.vue'),
        alwaysShow: true,
        meta: { title: '首页', icon: 'ios-paper' },
        children: [
            {
                path: '',
                name: 'home',
                meta: { title: '工作台' },
                component: () => import('@/views/Home.vue')
            }
        ]
    },
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