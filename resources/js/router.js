import { createWebHistory, createRouter } from "vue-router"
const routes = [
    {
        path: "/",
        name: "Home",
        component: () => import("./Pages/Home.vue")
    },
    {
        path: "/questions",
        name: "Questions",
        component: () => import("./Pages/Questions.vue")
    },
    ]

const router = createRouter({
    history: createWebHistory(`/`),
    linkExactActiveClass: "active",
    routes
});
export default router
