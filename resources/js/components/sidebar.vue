<template>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link"  href="#" @click.prevent="router_link('escritorio')" ><i class="icon-speedometer"></i> Escritorio</a>
                </li>
                <li class="nav-title">
                    Mantenimiento
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Almacén</a>
                    <ul class="nav-dropdown-items">
                        <li  class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('categorias')" ><i class="icon-bag"></i> Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('articulos')" ><i class="icon-bag"></i> Artículos</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Compras</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('ingresos')" ><i class="icon-wallet"></i> Ingresos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('proveedores')" ><i class="icon-notebook"></i> Proveedores</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('ventas')" ><i class="icon-basket-loaded"></i> Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('clientes')" ><i class="icon-notebook"></i> Clientes</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('usuarios')" ><i class="icon-user"></i> Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('roles')" ><i class="icon-user-following"></i> Roles</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item active">
                            <a class="nav-link"  href="#" @click.prevent="router_link('repotes_ingresos')" ><i class="icon-chart"></i> Reporte de ingresos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#" @click.prevent="router_link('repotes_ventas')" ><i class="icon-chart"></i> Reporte Ingresos</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span
                        class="badge badge-danger">PDF</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span
                        class="badge badge-info">IT</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="#" @click.prevent="router_link('herramientas')" ><i class="icon-info"></i> Herramientas</a>
                </li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
</template>

<script>
    export default {
        name: "sidebar",
        methods: {
            router_link(direction) {
                this.$router.push({
                    name: direction,
                });
            },
        },
    }
</script>

<style scoped>

</style>
