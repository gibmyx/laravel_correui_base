import Vue from 'vue';
import VueRouter from "vue-router";
import Escritorio from "../components/Escritorio";
import Categorias from "../components/Categorias";
import not404 from "../components/404"

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/escritorio',
            name: 'escritorio',
            component: Escritorio
        },
        {
            path: '/categorias',
            name: 'categorias',
            component: Categorias
        },
        {
            path: '*',
            component: not404
        }
    ],
});

export default router;
