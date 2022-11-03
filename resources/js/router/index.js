import Vue from 'vue';
import VueRouter from 'vue-router';

// auth
import Login from '@/components/auth/Login.vue'
import Register from '@/components/auth/Register.vue'

//Manger
import User from '../components/func/User.vue'

// error page
import notFound from '@/components/errors/notFound.vue'


Vue.use(VueRouter)
const route = new VueRouter({
    mode: 'history',
    routes: [

    //auth
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta:{
            requiresAuth:false
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta:{
            requiresAuth:false
        }
    },
    {
        path: '/',
        name: 'User',
        component: User,
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
    },

    ]
})

route.beforeEach((to, from, next) => {
    const accessToken = localStorage.getItem('token');

    if (!accessToken) {
        if (to.name === 'Login' || to.name === 'Register') {
            return next()
        } else {
            return next({
                name: 'Login'
            })
        }

    }

    if (to.name === 'Login' && accessToken) {
        return next({
            name: 'User'
        })
    }


    next()

})



export default route
