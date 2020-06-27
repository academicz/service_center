import axios from "axios";
import submit from '../../http/http';

/**
 * Store - authentication module
 */
const state = {
    token: localStorage.getItem('access_token') || null,
};
const getters = {
    loggedIn(state) {
        return state.token !== null;
    },
    getToken(state) {
        return state.token;
    }
};
const mutations = {
    retrieveToken(state, token) {
        state.token = token;
    },
    removeToken(state) {
        state.token = null;
    }

};
const actions = {
    retrieveToken(context, credentials) {

        return new Promise((resolve, reject) => {

            axios.post('http://localhost:8000/api/admin/login', credentials)
                .then((response) => {
                    let token = response.data.token;
                    localStorage.setItem('access_token', token);
                    context.commit('retrieveToken', token);
                    resolve(response);
                })
                .catch((error) => {
                    reject(error);
                })
        });
    },
    removeToken(context) {
        return new Promise((resolve, reject) => {

            submit({type: 'post', url: 'logout'})
                .then((response) => {
                    localStorage.removeItem('access_token');
                    context.commit('removeToken');
                    resolve(response);
                })
                .catch((error) => {
                    localStorage.removeItem('access_token');
                    context.commit('removeToken');
                    reject(error);
                })
        });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
}