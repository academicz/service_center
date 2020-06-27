/**
 * Helper functions
 */
import {Stretch} from '../components/loading-spinner/spinner';
import kebabCase from 'lodash/kebabCase';
import moment from 'moment';

/**
 * user asset urls
 * @type {{methods: {asset(*): string}}}
 */
export const asset = {
    methods: {
        /**
         * Return fully qualified url of given path
         * @param path
         * @returns {string}
         */
        asset(path) {
            if (location.hostname === 'localhost') {
                return window.location.protocol + '//' + location.hostname + ':' + location.port + '/' + path;
            } else {
                return window.location.protocol + '//' + location.hostname + '/' + path;
            }
        }
    },
};


/**
 * spinner
 * @type {{computed: {loading(): *}}}
 */
export const spinner = {
    components: {
        spinner: Stretch
    },
    computed: {
        loading() {
            return this.$store.getters.getStatus;
        }
    },
};

export const dashCase = {
    methods: {
        /**
         * Change sentance to dash case
         * @param value
         */
        dashCase(value) {
            return kebabCase(value);
        }
    }
};

export const dateTimeFormatter = {
    methods: {
        /**
         * change time format to h:m:s a
         * @param time
         */
        formatTime(time) {
            return moment(time, 'HH:mm:ss').format('h:mm:ss a');
        },
        /**
         * Change dateformat to dd-mm-yyyy
         * @param date
         */
        formatDate(date) {
            return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
        }
    }
};