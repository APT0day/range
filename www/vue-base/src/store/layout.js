import { defineStore } from 'pinia'
import settings from '@/settings'
import router from '@/router'

// 根据 menu 配置的权限，过滤菜单
function filterMenu(menuList, access, lastList) {
    menuList.forEach(menu => {
        let menuAccess = menu.auth

        if (!menuAccess || includeArray(menuAccess, access)) {
            let newMenu = {};
            for (let i in menu) {
                if (i !== 'children') newMenu[i] = cloneDeep(menu[i]);
            }
            if (menu.children && menu.children.length) newMenu.children = [];

            lastList.push(newMenu);
            menu.children && filterMenu(menu.children, access, newMenu.children);
        }
    });
    return lastList
}

export const useLayoutStore = defineStore('layout', {
    state: () => ({
        ...settings.layout,
        // 侧边栏菜单
        siderMenus: [],
        // 当前所在菜单的 path
        activeName: [],
        // 展开的子菜单 name 集合
        openNames: []
    }),
    getters: () => ({
        getMenuByRoute(state) {
            state.siderMenus = router.getRoutes()
        },
        filterSider(state, root) {
            return filterMenu(state.siderMenus, access, [])
        },
        // 在当前 header 下，是否隐藏 sider（及折叠按钮）
        hideSider (state, getters) {
            let visible = false;
            if (getters.currentHeader && 'hideSider' in getters.currentHeader) visible = getters.currentHeader.hideSider;
            return visible;
        }
    }),
    actions: () => ({
        // 设置侧边栏菜单
        setSiderMenus(state, menu) {
            state.siderMenus = menu
        },
        // 设置当前所在菜单的 path，用于侧边栏菜单高亮显示当前项
        setActivePath (state, path) {
            state.activePath = path;
        },
        // 设置当前所在菜单的全部展开父菜单的 names 集合
        setOpenNames (state, names) {
            state.openNames = names;
        },
    })
})