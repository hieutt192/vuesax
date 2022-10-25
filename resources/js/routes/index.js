import { createRouter, createWebHistory } from "vue-router";

//admin
import dashboard from '../components/admin/home/index.vue'
import homeAboutIndex from '../components/admin/about/index.vue'
import UserIndex from '../components/admin/users/index.vue'

//page
import homePageIndex from '../components/pages/home/index.vue'
//login
import login from '../components/auth/login.vue'
import register from '../components/auth/register.vue'

import notFound from '../components/notFound.vue'


const routes = [
    //admin
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: dashboard,
        meta:{
            requiresAuth:true
        }
    },

    {
        path: '/admin/about',
        name: 'adminAbout',
        component: homeAboutIndex,
        meta:{
            requiresAuth:true
        }
    },

    {
        path: '/admin/user',
        name: 'adminUser',
        component: UserIndex,
        meta:{
            requiresAuth:true
        }
    },




    //Pages
    {
        path: '/',
        name: 'Home',
        component: homePageIndex,
        meta:{
            requiresAuth:false
        }
    },

    //login
    {
        path: '/login',
        name: 'Login',
        component: login,
        meta:{
            requiresAuth:false
        }
    },
    // register
    {
        path: '/register',
        name: 'Register',
        component: register,
        meta:{
            requiresAuth:false
        }
    },

    // not Found
    {
        path: '/:pathMatch(.*)*',
        name: 'notFound',
        component: notFound,
        meta:{
            requiresAuth:false
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to,from)=>{
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        return { name: 'Login'}
    }

    if (to.meta.requiresAuth == false && localStorage.getItem('token')) {
        return { name: 'Dashboard'}
    }


})

export default router
