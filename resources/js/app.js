import './bootstrap';


import Vue from 'vue';
import Base from './components/Base.vue'
import router from "./routes";



// Vue.config.productionTip = false;
// Vue.use(Vuesax, {});

new Vue({
    el: '#app',
    router,
    render: h => h(Base)
 }).$mount('app')
