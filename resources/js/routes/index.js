import Vue from 'vue';
import VueRouter from 'vue-router';
import BaseHome from '@/components/home/BaseHome.vue'
import BaseAbout from '@/components/about/BaseAbout.vue'

// auth
import LoginPage from '@/components/auth/BaseLogin.vue'
import Signup from '@/components/auth/BaseSignup.vue'


// error page
import notFound from '../components/errors/notFound.vue'


Vue.use(VueRouter)

const routes = [
    //base
    {
        path: '/',
        component: BaseHome
    },

    {
        path: '/about',
        component: BaseAbout
    },

    //auth
    {
        path: '/login',
        component: LoginPage
    },
    {
        path: '/signup',
        component: Signup
    },

    // not Found
    {
        path: '/:pathMatch(.*)*',
        name: 'notFound',
        component: notFound,
        meta:{
            requiresAuth:false
        }
    },

];


export default new VueRouter({
    routes
})
