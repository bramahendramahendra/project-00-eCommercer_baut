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
import Users from "../views/Users/Users.vue";
import Customers from "../views/Customers/Customers.vue";
import CustomerView from "../views/Customers/CustomerView.vue";
import ContactUses from "../views/ContactUses/ContactUses.vue";
import ContactUsView from "../views/ContactUses/ContactUsView.vue";
import Newsletters from "../views/Newsletters/Newsletters.vue";
import InformationCompanies from "../views/InformationCompanies/InformationCompanies.vue";
import FrequentlyAskedQuestions from "../views/FrequentlyAskedQuestions/FrequentlyAskedQuestions.vue";
import TermAndConditions from "../views/TermAndConditions/TermAndConditions.vue";
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
            {
                path: 'users',
                name: 'app.users',
                component: Users
            },
            {
                path: 'customers',
                name: 'app.customers',
                component: Customers
            },
            {
                path: 'customers/:id',
                name: 'app.customers.view',
                component: CustomerView
            },
            {
                path: 'contact-uses',
                name: 'app.contactUses',
                component: ContactUses
            },
            {
                path: 'contact-uses/:id',
                name: 'app.contactUses.view',
                component: ContactUsView
            },
            {
                path: 'newsletters',
                name: 'app.newsletters',
                component: Newsletters
            },
            {
                path: 'information-companies',
                name: 'app.informationCompanies',
                component: InformationCompanies
            },
            {
                path: 'frequently-asked-questions',
                name: 'app.frequentlyAskedQuestions',
                component: FrequentlyAskedQuestions
            },
            {
                path: 'term-and-conditions',
                name: 'app.termAndConditions',
                component: TermAndConditions
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