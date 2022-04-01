import {createRouter,createWebHistory} from "vue-router";
import Container from "./view/layout/Container";
import Register from "./view/Auth/Register";
import Login from "./view/Auth/Login";
import Dashboard from "./view/pages/Dashboard";
import UserProfile from "./view/pages/UserProfile";



const routes = [
    {
        path: "/",
        name: Container,
        component: Container
    },
    {
        path: "/login",
        name: Login,
        component: Login
    },
    {
        path: "/register",
        name: Register,
        component: Register
    },
    {
        path: "/dashboard",
        name: Dashboard,
        component: Dashboard
    },
    {
        path: "/user-profile",
        name: UserProfile,
        component: UserProfile
    },
]

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
})

export default router
