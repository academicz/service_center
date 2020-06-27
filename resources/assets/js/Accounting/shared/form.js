import forIn from 'lodash/forIn';
import mixin from 'lodash/mixin';
import indexOf from 'lodash/indexOf';
import _ from 'lodash/wrapperLodash';

mixin(_, {
    forIn,
    indexOf
});
export default class Form {
    constructor(data) {
        this.orginalData = data;
        _.forIn(data, (value, key) => {
            this[key] = data[key];
        });
        this.errors = new Errors();
    }

    /*
     * Reset the form
     */
    reset(clearExcept = []) {
        _.forIn(this.orginalData, (value, key) => {
            if (_.indexOf(clearExcept, key) === -1)
                this[key] = '';
        });
    }

    /*
     * Data given to post request
     */

    data() {
        let data = Object.assign({}, this);
        delete data.orginalData;
        delete data.errors;
        return data;
    }

    onSuccess(data) {
        this.errors.clear();
    }

    onFail(error) {
        this.errors.record(error);
    }

    /*
     * Checking if a field has error
     */

    has(field) {
        if (field) {
            if (this.errors.errors[field]) {
                return false;
            } else if (this[field].length > 0 || this[field].toString().length > 0) {
                return true;
            } else {
                return null;
            }
        } else {
            return Object.keys(this.errors.errors).length > 0;
        }

    }

}

/*
 * Class to handle validation errors
 */
class Errors {
    constructor() {
        this.errors = {};
    }

    /*
     *  Getting error message
     */

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    /*
     * Save errors get from post request
     */

    record(errors) {
        this.errors = errors;
    }

    /*
     * Clear validation errors of given field or all fields
     */

    clear(field) {
        if (field) {
            delete this.errors[field];
            return;
        }
        this.errors = {};
    };

    errorClass(field) {
        if (this.errors[field]) {
            return 'input-error'
        } else {
            return '';
        }
    }
}