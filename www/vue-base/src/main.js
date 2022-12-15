import { createApp } from "vue";
import App from "@/App.vue";

import "@/assets/main.css";

// 路由
import router from '@/router'

// vuex
import store from '@/store'

// 全局样式
import '@/styles/index.css'

import ViewUIPlus from '@/plugins/iview'

// import Setting from "./setting";

const app = createApp(App);

app.use(router).use(store).use(ViewUIPlus).mount("#app");
