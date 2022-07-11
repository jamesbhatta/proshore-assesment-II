import { createWebHistory, createRouter } from "vue-router";
// import Login from "./views/Login.vue";
// import store from "./store";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("./views/Home.vue"),
    },

    {
        path: "/events/create",
        name: "events.create",
        component: () => import("./views/event/Form.vue"),
    },
    {
        path: "/events/:id/show",
        name: "events.show",
        component: () => import("./views/event/Show.vue"),
    },
    {
        path: "/events/:id/edit",
        name: "events.edit",
        component: () => import("./views/event/Form.vue"),
    },

    {
        path: "/:catchAll(.*)",
        component: () => import("./views/404.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem("user");

    // if (to.matched.some((record) => record.meta.auth) && !loggedIn) {
    //     next("/login");
    //     return;
    // }
    next();
});

export default router;
