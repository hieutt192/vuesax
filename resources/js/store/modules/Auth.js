import axios from 'axios';
import router from '../../router/index';


const state = () => ({
    token: null,
})

const actions = {

    async loginUser({commit},data){
        const response = await axios.post('api/login', data)
        return response
    },

    async RegisterUser({commit},data){
        const response = await axios.post('api/register', data)
        return response
    },

    async Dashboard({commit}, data){
        const response = await axios.post('api/user', data)
        return response
    },

    async logout({dispatch} ){
        const response = await axios.get('api/logout')
        if (response) {
            dispatch('setToken')
            router.push('/login')
        }
    },

    setToken({commit},data = undefined){
        if (!data) {
            commit('SET_TOKEN', null)
            localStorage.removeItem('tokenClient')
          } else {
            commit('SET_TOKEN', data.token.access_token)
            localStorage.setItem('tokenClient', data.token.access_token)
          }
    }

}

const mutations = {
    SET_TOKEN(state,token){
        state.token = token
    }
}
const getters ={}

export default {
    state,
    actions,
    mutations,
    getters,
}
