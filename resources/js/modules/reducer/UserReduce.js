import axios from 'axios';

const state = {

}

const actions = {

    async loginUser({commit},data){
        const response = await axios.post('api/login', data)
        return response
    },

    async RegisterUser({commit},data){
        const response = await axios.post('api/register', data)
        return response
    },

}

const mutations = {}
const getters ={}

export default {
    state,
    actions,
    mutations,
    getters,
}
