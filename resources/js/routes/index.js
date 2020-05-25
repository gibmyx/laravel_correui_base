import Vue from 'vue';
import VueRouter from "vue-router";
import not404 from "../components/404"
Vue.use(VueRouter);

import Escritorio from "../components/modulos/escritorio/router";
import Categorias from "../components/modulos/categorias/router";
import Articulos from "../components/modulos/articulos/router";
import Clientes from "../components/modulos/clientes/router";
import Ingresos from "../components/modulos/ingresos/router";
import Proveedores from "../components/modulos/proveedores/router";
import Ventas from "../components/modulos/ventas/router";
import Roles from "../components/modulos/roles/router";
import Usuarios from "../components/modulos/usuarios/router";
import ReporteIngreso from "../components/modulos/reporte_ingresos/router";
import ReporteVentas from "../components/modulos/reporte_ventas/router";

const router = new VueRouter({
    mode: 'history',
    routes: [
        ...Escritorio,
        ...Categorias,
        ...Articulos,
        ...Clientes,
        ...Ingresos,
        ...Proveedores,
        ...Ventas,
        ...Roles,
        ...Usuarios,
        ...ReporteIngreso,
        ...ReporteVentas,
        //mensaje 404
        {
            path: '*',
            component: not404
        }
    ],
});

export default router;
