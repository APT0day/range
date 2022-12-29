import { createApp } from "vue";
import App from "@/App.vue";

// 路由
import router from '@/router'

// 全局样式
import './styles/index.scss'

import setupPlugins from '@/plugins'

const app = createApp(App)

setupPlugins(app)

app.use(router).mount("#app");
