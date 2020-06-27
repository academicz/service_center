import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import spinner from './modules/spinner';

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        auth,
        spinner
    }
});