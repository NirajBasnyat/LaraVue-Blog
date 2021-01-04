import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Login from "../components/login/Login";
import Logout from "../components/login/Logout";
import Signup from "../components/login/Signup";
import Forum from "../components/forum/Forum";
import Single from "../components/forum/Single";
import AskQuestion from "../components/forum/AskQuestion";
import CreateCategory from "../components/category/CreateCategory";

//import EditQuestion from "../components/forum/EditQuestion";

const routes = [
    {path: "/login", component: Login},
    {path: "/logout", component: Logout},
    {path: "/signup", component: Signup},
    {path: "/forum", component: Forum, name: "Forum"},
    {path: "/ask", component: AskQuestion, name: "AskQuestion"},
    {path: "/question/:slug", component: Single, name: "Single"},
    {
        path: "/question/edit/:slug",
        component: AskQuestion,
        name: "EditQuestion"
    },
    {path: "/category", component: CreateCategory, name: "CreateCategory"}
];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;
