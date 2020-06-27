import axios from "axios/index";
import {store} from "../store/store";
import swal from 'sweetalert';
import {SUCCESS_STATUS} from "../constants/constants";
import {ENV} from "../config/config";


/**
 * Http Request
 * @param type - type of request
 * @param url - url
 * @param data - data to send
 * @param config - headers if any
 * @param form - true if data from form or false
 * @param clearExcept - array of form data keys to not delete after form submission
 * @returns {Promise<any>}
 */
export default function submit({type, url, data = null, config = null, form = false, clearExcept = []}) {

    /**
     * Setting authorisation header for all request
     * @type {string}
     */

    axios.defaults.baseURL = ENV.ACCOUNTING.END_POINT;

    return new Promise((resolve, reject) => {
        /*
        * Axios post request
         */

        /**
         * Spinner status change
         */
        store.commit('changeStatus');

        /**
         * If current request is a form submit
         */
        if (type === 'post' && form === true) {
            axios.post(url, data.data(), config)
                .then(response => {

                    if (response.data.status === SUCCESS_STATUS) {
                        /**
                         * Handle form submit success in form class
                         */
                        data.onSuccess(response.data);

                        /**
                         * Reset form
                         */
                        data.reset(clearExcept);
                    }

                    /**
                     * Showing status message
                     */
                    showMessage({
                        title: response.data.status === SUCCESS_STATUS ? "Done" : "Oops!",
                        text: response.data.data.message,
                        icon: response.data.status,
                    });

                    /**
                     * Change loading spinner
                     */
                    store.commit('changeStatus');

                    resolve(response);
                }).catch(error => {

                /**
                 * Handling validation errors in form class
                 */
                data.onFail(error.response.data.errors);

                /**
                 * Change loading spinner
                 */
                store.commit('changeStatus');
                reject(error.response);
            });
        } else if (type === 'post') {
            axios.post(url, data, config)
                .then(response => {
                    if (response.data.status === SUCCESS_STATUS) {

                        /**
                         * Showing status message
                         */
                        showMessage({
                            title: response.data.status === "success" ? "Done" : "Oops!",
                            text: response.data.data.message,
                            icon: response.data.status,
                        });

                        /**
                         * Change loading spinner
                         */
                        store.commit('changeStatus');
                        resolve(response);
                    } else {

                        /**
                         * Showing status message
                         */
                        showMessage({
                            title: response.data.status === "success" ? "Done" : "Oops!",
                            text: response.data.data.message,
                            icon: response.data.status,
                        });

                        /**
                         * Change loading spinner
                         */
                        store.commit('changeStatus');
                        reject(response.data);
                    }

                }).catch(error => {

                /**
                 * Change loading spinner
                 */
                store.commit('changeStatus');
                reject(error.response);
            });
        } else if (type === 'get') {

            if (data !== null) {
                axios.get(url, {
                    params: data
                }, config)
                    .then(response => {

                        /**
                         * Showing status message
                         */
                        showMessage({
                            title: response.data.status === SUCCESS_STATUS ? "Done" : "Oops!",
                            text: response.data.data.message,
                            icon: response.data.status,
                        });

                        if (response.data.status === SUCCESS_STATUS) {

                            /**
                             * Change loading spinner
                             */
                            store.commit('changeStatus');
                            resolve(response);
                        } else {

                            /**
                             * Change loading spinner
                             */
                            store.commit('changeStatus');
                            reject(response.data);
                        }

                    }).catch(error => {

                    /**
                     * Change loading spinner
                     */
                    store.commit('changeStatus');
                    reject(error.response);
                });
            } else {
                axios.get(url, config)
                    .then(response => {

                        /**
                         * Showing status message
                         */
                        showMessage({
                            title: response.data.status === SUCCESS_STATUS ? "Done" : "Oops!",
                            text: response.data.data.message,
                            icon: response.data.status,
                        });

                        if (response.data.status === SUCCESS_STATUS) {

                            /**
                             * Change loading spinner
                             */
                            store.commit('changeStatus');
                            resolve(response);
                        } else {
                            /**
                             * Change loading spinner
                             */
                            store.commit('changeStatus');
                            reject(response.data);
                        }
                    }).catch(error => {

                    /**
                     * Change loading spinner
                     */
                    store.commit('changeStatus');
                    reject(error.response);
                });
            }
        }

    });
}

let showMessage = (message) => {
    if (message.text !== undefined)
        swal(message);
};