import {store} from "../store/store";

/**
 * Authentication middleware
 * @param to
 * @param from
 * @param next
 */
export default (to, from, next) => {

    document.title = to.meta.title;

    if (to.matched.some(record => record.meta.requiresAuth)) {

        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters.loggedIn) {
            next({
                name: 'adminLogin',
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }

}