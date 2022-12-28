import { createApp } from "vue";
import App from "@/App.vue";

// 路由
import router from '@/router'

// pinia
import { createPinia } from 'pinia'

// 全局样式
import './styles/index.scss'

import ViewUIPlus from '@/plugins/iview'

createApp(App).use(router).use(createPinia()).use(ViewUIPlus).mount("#app");
