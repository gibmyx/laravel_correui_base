require('./bootstrap');

window.Vue = require('vue');

Vue.component('app', require('./components/AppComponents.vue').default);
Vue.component('escritorio', require('./components/Escritorio.vue').default);
Vue.component('sidebar', require('./components/sidebar.vue').default);

import router from './routes';

const app = new Vue({
    el: '#app',
    router,
    data: {
        menu: 0,
    }
});
