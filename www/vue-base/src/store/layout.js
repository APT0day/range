import { defineStore } from 'pinia'
import settings from '@/settings'
import { menuListRoutes } from '@/router/routes'

// 根据 menu 配置的权限，过滤菜单
function filterRoutes(routes) {
    const res = []

    routes.forEach(route => {
        const tmp = {...route}
        if(tmp.children) {
            tmp.children = filterRoutes(tmp.children)
        }
        if(!tmp.isHide) {
            res.push(tmp)
        }
    })

    return res
}

function updateRoutesRedirect(routes) {
    routes.forEach(route => {
      if (route.children) {
        route.redirect = { name: route.children[0].name }
        updateRoutesRedirect(route.children)
      }
    })
}

export const useLayoutStore = defineStore('layout', {
    state: () => ({
        ...settings.layout,
        // 侧边栏菜单
        siderMenuList: [],
        // 激活菜单的 name 值
        activeName: [],
        // 展开的 Submenu 的 name 集合
        openNames: []
    }),
    getters: {
        getRoute: (state) => {
            const routes = filterRoutes(menuListRoutes)
            updateRoutesRedirect(routes)
            state.siderMenuList = routes
            return routes
        }
    },
    actions: {
        getRoutes(state) {
            const routes = filterRoutes(menuListRoutes)
            updateRoutesRedirect(routes)
            this.siderMenuList = routes
            return routes
        }
    }
})