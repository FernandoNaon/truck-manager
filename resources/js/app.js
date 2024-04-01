import "bootstrap/dist/css/bootstrap.min.css"; 
import { createApp } from "vue";
import app from "./components/app.vue";
import router from "./router/index";

createApp(app).use(router).mount("#app");
