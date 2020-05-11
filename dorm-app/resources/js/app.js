/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vuetify from 'vuetify';

window.Vue = require('vue');

Vue.use(Vuetify);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// common component
Vue.component('app-header', require('./components/Header.vue').default);

// summary page
Vue.component('outline', require('./components/Outline.vue').default);
Vue.component('penalty-table', require('./components/PenaltyTable.vue').default);
Vue.component('arrears-table', require('./components/ArrearsTable.vue').default);

// user list page
Vue.component('user-table', require('./components/UserTable.vue').default);
Vue.component('role-table', require('./components/RoleTable.vue').default);
Vue.component('room-table', require('./components/RoomTable.vue').default);

// personal accounting page
Vue.component('billing-table', require('./components/BillingTable.vue').default);

// dorm accounting page
Vue.component('payment-table', require('./components/PaymentTable.vue').default);
Vue.component('closing-table', require('./components/ClosingTable.vue').default);

Vue.component('accounting-processor', require('./components/AccountingProcessor.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({}),
});
