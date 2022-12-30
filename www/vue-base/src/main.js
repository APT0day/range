import { createApp } from "vue";
import App from "@/App.vue";

// 全局样式
import './styles/index.scss'

const app = createApp(App)

// 路由
import router from '@/router'
app.use(router)

// 插件
import setupPlugins from '@/plugins'
setupPlugins(app)

app.mount("#app");
