import axios from "axios";
import submit from '../../http/http';

/**
 * Store - authentication module
 */
const state = {
    status: false
};
const getters = {
    getStatus(state) {
        return state.status;
    }
};
const mutations = {
    changeStatus(state) {
        state.status = state.status !== true;
    },

};

export default {
    state,
    getters,
    mutations
}