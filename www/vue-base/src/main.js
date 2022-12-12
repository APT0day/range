import { createApp } from "vue";
import App from "./App.vue";

import "./assets/main.css";

import ViewUIPlus from "view-ui-plus";
import "view-ui-plus/dist/styles/viewuiplus.css";

// import Setting from "./setting";
// import plugins from "@/plugins";

// createApp(App).mount('#app')

const app = createApp(App);

app.use(ViewUIPlus).mount("#app");
