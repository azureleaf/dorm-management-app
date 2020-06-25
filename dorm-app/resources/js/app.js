/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Vuetify from "vuetify";
import VueRouter from "vue-router";

window.Vue = require("vue");

Vue.use(Vuetify);
Vue.use(VueRouter);

Vue.mixin({
    methods: {
        formatCurrency(number) {
            return new Intl.NumberFormat("ja-JP", {
                style: "currency",
                currency: "JPY"
            }).format(number);
        },
        formatDate(date) {
            var dd = String(date.getDate()).padStart(2, "0");
            var mm = String(date.getMonth() + 1).padStart(2, "0");
            var yyyy = date.getFullYear();
            return `${yyyy}-${mm}-${dd}`;
        }
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);


import Introduction from './components/introduction/Introduction';
import Users from './components/Users';
import Accounting from './components/Accounting';

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/intro",
            name: "intro",
            component: Introduction
        },
        {
            path: "/users",
            name: "users",
            component: Users
        },
        {
            path: "/accounting",
            name: "accounting",
            component: Accounting
        },
    ]
});

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify({
        icons: {
            iconfont: "mdi" // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
        }
    }),
    router
});
