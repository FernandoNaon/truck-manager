import { createRouter, createWebHistory } from "vue-router";
import vehicleIndex from "../components/index.vue";
import notFound from "../components/NotFound.vue";

const routes = [
    {
        path: "/",
        component: vehicleIndex,
    },
    {
        path: "/:pathMatch(.*)*",
        component: notFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
