import Vue from 'vue';
import VueRouter from 'vue-router';
import BaseHome from '@/components/home/BaseHome.vue'
import BaseAbout from '@/components/about/BaseAbout.vue'

// auth
import LoginPage from '@/components/auth/BaseLogin.vue'



Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: BaseHome
    },

    {
        path: '/about',
        component: BaseAbout
    },

    {
        path: '/login',
        component: LoginPage
    },

];


export default new VueRouter({
    routes
})
