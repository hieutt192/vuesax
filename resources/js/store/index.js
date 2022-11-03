import Vue from "vue";
import Vuex from 'vuex';
import auth from "./modules/Auth";
import user from './modules/User'


Vue.use(Vuex)

export default new Vuex.Store({
    modules:{
        auth,
        user,

    }
})
