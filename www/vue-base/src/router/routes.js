import dashboard from './modules/dashboard'
import sql from './modules/sql'

// 主框架内显示
const frameIn = [
    {
        path: '/',
        redirect: {
            name: 'dashboard-console'
        },
        component: () => import('@/layouts/index.vue'),
        meta: {
            title: ''
        }
    },
    dashboard,
    sql
]

// 主框架外显示
const frameOut = [
    // 登录
    {
        path: '/login',
        name: 'login',
        meta: {
            title: 'login'
        },
        component: () => import('@/views/account/login.vue')
    },
    // 忘记密码
    {
        path: '/forgetPwd',
        name: 'forgetPwd',
        meta: {
            title: 'forgetPwd'
        },
        component: () => import('@/views/account/forgetPwd.vue')
    },
    // 注册
    {
        path: '/register',
        name: 'register',
        meta: {
            title: 'register'
        },
        component: () => import('@/views/account/register.vue')
    },
    // 注册结果
    {
        path: '/register/result',
        name: 'register-result',
        meta: {
            auth: true,
            title: 'register-result'
        },
        component: () => import('@/views/account/registerResult.vue')
    }
]

// 错误页面
const errorPage = [
    {
        path: '/403',
        name: '403',
        meta: {
            title: '403'
        },
        component: () => import('@/views/errors/403.vue')
    },
    {
        path: '/500',
        name: '500',
        meta: {
            title: '500'
        },
        component: () => import('@/views/errors/500.vue')
    },
    {
        path: '/*',
        name: '404',
        meta: {
            title: '404'
        },
        component: () => import('@/views/errors/404.vue')
    }
]

// 导出显示菜单的路由
export const routes = frameIn

// 重新组织后导出
export default [
    ...frameIn,
    ...frameOut,
    ...errorPage
]