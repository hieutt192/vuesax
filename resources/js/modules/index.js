import Vue from "vue";
import Vuex from 'vuex';
import userReducer from "./reducer/UserReduce";
import postReducer from "./reducer/PostReducer";


Vue.use(Vuex)

export default new Vuex.Store({
    modules:{
        userReducer,
        postReducer,
    }
})
