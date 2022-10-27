// import file
import './bootstrap';
import Vue from 'vue';
import Base from './components/Base.vue'
import router from "./routes";
import Vuesax from 'vuesax'
import store from './modules/index'

// import library
// import 'material-icons/iconfont/material-icons.css';
import 'boxicons/css/boxicons.min.css'
import 'vuesax/dist/vuesax.css' //Vuesax styles



Vue.config.productionTip = false;
Vue.use(Vuesax, {});

new Vue({
    el: '#app',
    store,
    router,
    render: h => h(Base)
 }).$mount('app')
