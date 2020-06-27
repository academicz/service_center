import Vue from 'vue';
import Router from 'vue-router';

// Containers
const Container = () => import(/* webpackChunkName: "accounting/components/containers/DefaultContainer" */ '../components/Container');
const CashBook = () => import(/* webpackChunkName: "accounting/components/CashBook" */ '../components/CashBook');
const Particulars = () => import(/* webpackChunkName: "accounting/components/Particulars" */ '../components/Particulars');
const ParticularCategories = () => import(/* webpackChunkName: "accounting/components/ParticularCategories" */ '../components/ParticularCategories');
const Receipt = () => import(/* webpackChunkName: "accounting/components/Receipt" */ '../components/Receipt');
const Voucher = () => import(/* webpackChunkName: "accounting/components/Voucher" */ '../components/Voucher');
const Bill = () => import(/* webpackChunkName: "accounting/components/Bill" */ '../components/Bill');

Vue.use(Router);

export default new Router({
    mode: 'hash', // https://router.vuejs.org/api/#mode
    linkActiveClass: 'open active',
    scrollBehavior: () => ({y: 0}),
    routes: [
        {
            path: '/',
            redirect: '/cash-book',
            name: 'Home',
            component: Container,
            children: [
                {
                    path: 'cash-book',
                    name: 'doctorSpecialization',
                    component: CashBook,
                    meta: {
                        label: 'Cash Book',
                        title: 'Cash Book'
                    },
                },
                {
                    path: 'particulars',
                    name: 'particulars',
                    component: Particulars,
                    meta: {
                        label: 'Particulars',
                        title: 'Particulars'
                    },
                },
                {
                    path: 'particular-categories',
                    name: 'particularCategories',
                    component: ParticularCategories,
                    meta: {
                        label: 'Particular Categories',
                        title: 'Particular Categories'
                    },
                },
                {
                    path: 'print-receipt',
                    name: 'printReceipt',
                    component: Receipt,
                    meta: {
                        label: 'Print Receipts',
                        title: 'Print Receipts'
                    },
                    children: [
                        {
                            path: '/',
                            redirect: {name: 'voucher'},
                            component: {
                                render(c) {
                                    return c('router-view')
                                }
                            },
                            children: [
                                {
                                    path: 'voucher',
                                    name: 'voucher',
                                    component: Voucher,
                                    meta: {
                                        label: 'Voucher',
                                        title: 'Voucher'
                                    },
                                },
                                {
                                    path: 'bill',
                                    name: 'bill',
                                    component: Bill,
                                    meta: {
                                        label: 'Bill',
                                        title: 'Bill'
                                    },
                                }
                            ],
                        },
                    ]
                }
            ]
        },
    ]
});

