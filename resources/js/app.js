require('./bootstrap');

import router from './routes';
import wysiwyg from "vue-wysiwyg";
import VueNumeric from 'vue-numeric';
import CxltToastr from 'cxlt-vue2-toastr'
import VueResource from 'vue-resource';

window.Vue = require('vue');
window.tkn = document.head.querySelector('meta[name="csrf-token"]').content;

//importacion de estilos
import "vue-wysiwyg/dist/vueWysiwyg.css";
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css';

//components
Vue.component('select2', require('./components/helpers/Select2'));
Vue.component('date', require('./components/helpers/Datepicker'));
Vue.component('date-simple', require('./components/helpers/DatepickerSimple'));
Vue.component('clockpicker', require('./components/helpers/Clockpicker'));

//filters
Vue.filter('currency', (value) => {
    return accounting.formatNumber(value, 2, ",");
});

const toastrConfigs = {
    position: 'top right',
    showDuration: 2000,
    timeOut: 5000,
    progressBar: true,
    successColor: 'green',
    infoColor: 'blue',
    warningColor: 'orange',
    errorColor: 'red',
};

Vue.use(wysiwyg, {});
Vue.use(VueNumeric);
Vue.use(CxltToastr, toastrConfigs);
Vue.use(VueResource);


Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', document.head.querySelector('meta[name="csrf-token"]').content);
    next();
});

Vue.component('sidebar', require('./components/sidebar.vue').default);


const app = new Vue({
    el: '#app',
    router,
    data: {
        menu: 0,
    }
});
