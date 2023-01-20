import Vue from "vue"
import VueRouter from "vue-router"
import Login from "./components/LoginComponent"
import Register from "./components/RegisterComponent"
import MainComponent from "./components/MainComponent"

Vue.use(VueRouter)

const routes = [
    {
        path: "/register",
        name: "register",
        component: Register,
        beforeEnter: (to, from,next) => {
            if( localStorage.getItem("token") ){
                next("/dashboard");
            }
            else{
                next();
            }
        }
    },
    {
        path: "/",
        name: "login",
        component: Login,
        beforeEnter: (to, from,next) => {
            if( localStorage.getItem("token") ){
                next("/dashboard");
            }
            else{
                next();
            }
        }
    },
    {
        path: "/dashboard",
        name: "main_component",
        component: MainComponent,
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem("token")) {
                
                next();
            } 
            else {
                next("/");
            }
        },
    },
]

const router = new VueRouter({
    mode: "history",
    routes
})

export default router