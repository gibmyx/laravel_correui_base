<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Almacén</li>
            <li class="breadcrumb-item active">Artículos</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Artículos
                    <button type="button" class="btn btn-secondary" @click.prevent="ModalArticulo(null)">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" id="opcion" name="opcion" v-model="opcion">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Descripción</option>
                                </select>
                                <input type="text" id="texto" name="texto" class="form-control" v-model="texto"
                                       @keyup.enter="listarArticulo(1)"
                                       placeholder="Texto a buscar">
                                <button class="btn btn-primary" @click.prevent="listarArticulo(1)"><i
                                    class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th width="10%" class="text-center">Opciones</th>
                            <th width="10%" class="text-center">Codigo</th>
                            <th width="10%" class="text-center">Nombre</th>
                            <th width="15%" class="text-center">Descripcion</th>
                            <th width="10%" class="text-center">Categoria</th>
                            <th width="15%" class="text-center">Precio de venta</th>
                            <th width="10%" class="text-center">Stock</th>
                            <th width="10%" class="text-center">Estado</th>
                        </tr>
                        </thead>
                        <tbody v-if="articulos.length >= 1">
                        <tr
                            v-bind:is="'articulo'"
                            v-for="o in articulos"
                            :o="o"
                            v-on:editarCategoria="ModalArticulo($event)"
                            v-on:EliminarCategoria="ModalDeshabilitar($event)"
                            :key="o.id">
                        </tr>
                        </tbody>
                        <tbody v-else>
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-warning text-center" role="alert">
                                    No se encontraron resultados
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <nav class="d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" v-if="pagination.current_page > 1"
                                   @click.prevent="cambiarPagina(pagination.current_page - 1 )">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page"
                                :class="page == isActived ? 'active' : ''">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" v-if="pagination.current_page < pagination.last_page"
                                   @click.prevent="cambiarPagina(pagination.current_page + 1 )">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>

        <!--Modal de agregar categoria-->
        <modal-articulo :name="'ModalArticulo'" v-on:listarArticulo="listarArticulo(pagination.current_page)"
                        ref="modalarticulo"></modal-articulo>
        <!--Modal de eliminar categoria-->
        <modal-estado :name="'ModalEstado'" v-on:listarArticulo="listarArticulo(pagination.current_page)"
                      ref="modalestado"></modal-estado>
    </main>
</template>

<script>
    import ModalEstado from "./modal/ModalEstado";
    import ModalArticulo from "./modal/ModalArticulo";
    import Articulo from "./Articulo";

    export default {
        name: "Articulos",

        data () {
            return {
                opcion: 'nombre',
                texto: '',
                articulos: [],

                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 1
            }
        },

        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },

            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }

                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                let pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },


        },

        mounted() {
            this.listarArticulo();
        },

        methods: {
            listarArticulo(page = 1) {
                let opcion = this.opcion;
                axios.get('/articulos/ajax_listar_articulos?page=' + page + '&' + this.opcion + '=' + this.texto).then((response) => {
                    this.articulos = response.data.articulos;
                    this.pagination = response.data.pagination;
                });
            },
            cambiarPagina(page) {
                let me = this;
                me.pagination.current_page = page;
                me.listarArticulo(page)
            },
            ModalArticulo(articulo = null) {
                this.$refs.modalarticulo.show(articulo);
            },
            ModalDeshabilitar(articulo = null) {
                this.$refs.modalestado.show(articulo);
            },
        },

        components: {
            ModalArticulo,
            ModalEstado,
            Articulo,
        },
    }
</script>

<style scoped>

</style>
