import { createRouter, createWebHistory } from "vue-router";
import AppLayout from '../components/AppLayout.vue';
import Login from "../views/Login.vue";
import Dashboard from "../views/Dashboard.vue";
import Products from "../views/Products/Products.vue";
import ProductView from "../views/Products/ProductView.vue";
import Categories from "../views/Categories/Categories.vue";
import Types from "../views/Types/Types.vue";
import Materials from "../views/Materials/Materials.vue";
import Units from "../views/Units/Units.vue";
import Colors from "../views/Colors/Colors.vue";
import ThreadDensities from "../views/ThreadDensities/ThreadDensities.vue";
import ThreadDirections from "../views/ThreadDirections/ThreadDirections.vue";
import Orders from "../views/Orders/Orders.vue";
import OrderView from "../views/Orders/OrderView.vue";
import RequestPassword from "../views/RequestPassword.vue";
import ResetPassword from "../views/ResetPassword.vue";
import NotFound from "../views/NotFound.vue";
import store from "../store";

const routes = [
    {
        path: '/app',
        name: 'app',
        component: AppLayout,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: 'dashboard',
                name: 'app.dashboard',
                component: Dashboard
            },
            {
                path: 'products',
                name: 'app.products',
                component: Products
            },
            {
                path: 'products/:id',
                name: 'app.product.view',
                component: ProductView
            },
            {
                path: 'categories',
                name: 'app.categories',
                component: Categories
            },
            {
                path: 'types',
                name: 'app.types',
                component: Types
            },
            {
                path: 'materials',
                name: 'app.materials',
                component: Materials
            },
            {
                path: 'units',
                name: 'app.units',
                component: Units
            },
            {
                path: 'colors',
                name: 'app.colors',
                component: Colors
            },
            {
                path: 'thread-densities',
                name: 'app.threadDensities',
                component: ThreadDensities
            },
            {
                path: 'thread-directions',
                name: 'app.threadDirections',
                component: ThreadDirections
            },
            {
                path: 'orders',
                name: 'app.orders',
                component: Orders
            },
            {
                path: 'orders/:id',
                name: 'app.orders.view',
                component: OrderView
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresGuest: true
        },
    },
    {
        path: '/request-password',
        name: 'requestPassword',
        component: RequestPassword,
        meta: {
            requiresGuest: true
        },
    },
    {
        path: '/reset-password/:token',
        name: 'resetPassword',
        component: ResetPassword,
        meta: {
            requiresGuest: true
        },
    },
    {
        path: '/:pathMatch(.*)',
        name: 'notfound',
        component: NotFound,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if(to.meta.requiresAuth && !store.state.user.token) {
        next({name: 'login'})
    } else if (to.meta.requiresGuest && store.state.user.token) {
        next({name: 'app.dashboard'})
    } else {
        next();
    }
})

export default router;