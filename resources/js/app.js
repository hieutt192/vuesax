import './bootstrap';
import Vue from 'vue';
import App from './components/App.vue';
import router from "./router";
import Vuesax from 'vuesax'
import store from './store/index'

// import library
import 'boxicons/css/boxicons.min.css'
import 'vuesax/dist/vuesax.css' //Vuesax styles



Vue.config.productionTip = false;
Vue.use(Vuesax, {});

new Vue({
    store,
    router,
    render: h => h(App)
 }).$mount('#app')
