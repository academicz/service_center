require('./bootstrap');




import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import VModal from 'vue-js-modal';

import middleware from './router/middleware';
import router from "./router/routes";
import {store} from "./store/store";

import App from './App';
import {ENV} from "./config/config";



Vue.use(VModal, {dialog: true});
Vue.use(VueRouter);
Vue.use(BootstrapVue);

router.beforeEach(middleware);

new Vue({
    el: '#app',
    router,
    store,
    template: '<App/>',
    components: {
        App
    }
});
