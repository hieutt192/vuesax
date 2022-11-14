import axios from 'axios';


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

    async logout({commit}){
        const response = await axios.post('api/logout')
        localStorage.removeItem('token')
        return response
    },



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
