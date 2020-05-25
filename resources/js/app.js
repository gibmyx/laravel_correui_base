require('./bootstrap');

window.Vue = require('vue');

Vue.component('sidebar', require('./components/sidebar.vue').default);

import router from './routes';

const app = new Vue({
    el: '#app',
    router,
    data: {
        menu: 0,
    }
});
