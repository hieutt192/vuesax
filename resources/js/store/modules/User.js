import axios from "axios";

const state = () => ({
    items: [],
    item: [],
    validate: false,
});

const actions = {

    async fetchData({commit}) {
        const response = await axios.get('api/user/').then((res) => {
            commit('LOAD_USER', res.data.data);
            // console.log(res.data.data)
        });

        return response;
    },

    async getUser({commit},data) {
        const response = await axios.get(`api/user/${data}`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });

        return response;
    },

    async createUser({commit}, data) {
        const response = await axios.post('api/user/store', data, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });

        return response;
    },

    async deleteUser({commit}, data){
        const response = await axios.delete(`api/user/${data}`, {
            headers: {
                'Authorization' : `Bearer ${localStorage.getItem('token')}`
            }
        })

        return response
    },

    async updateUser({commit}, data){
        const response = await axios.put(`api/user/${data.id}`,data,
         {
            headers: {
                'Authorization' : `Bearer ${localStorage.getItem('token')}`
            }
        });

        return response
    },


};

const mutations = {
    LOAD_USER: (users, data) => (users.items = data),
    CREATE_USER: (users, data) => users.items.unshift(data),
    DELETE_USER: (user,pk) => (user.items= user.items.filter(function(x){
        return x.id !== pk
    })),
    UPDATE_USER: (user,data) => (user.item= user.item.map((x) => x.id == data.id ? data: x)),

};

const getters = {
    fetchUser: (user) => user.items,
};

export default {
    state,
    getters,
    mutations,
    actions,
};
