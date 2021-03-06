
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('task-index', require('./components/Taskindex.vue'));
Vue.component('task-create', require('./components/Taskcreate.vue'));
Vue.component('task-edit', require('./components/Taskedit.vue'));
Vue.component('admin-home', require('./components/Adminhome.vue'));


Vue.component('user-create', require('./components/Usercreate.vue'));
Vue.component('user-edit', require('./components/Useredit.vue'));

const app = new Vue({
    el: '#app'
});
