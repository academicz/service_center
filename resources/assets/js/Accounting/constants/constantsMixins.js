import * as constant from "./constants";

export const getConstants = {
    methods: {
        getConstant(key) {
            return constant[key];
        }
    }
};