import { createApp } from "vue";
import App from "@/App.vue";

// 路由
import router from '@/router'

// vuex
import store from '@/store'

// 全局样式
import '@/styles/index.scss'

import ViewUIPlus from '@/plugins/iview'

const app = createApp(App);

app.use(router).use(store).use(ViewUIPlus).mount("#app");
