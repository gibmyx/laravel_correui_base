<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Almacén</li>
            <li class="breadcrumb-item active">Categorias</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Categorías
                    <button type="button" class="btn btn-secondary" @click.prevent="ModalCategoria(null)">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" id="opcion" name="opcion">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Descripción</option>
                                </select>
                                <input type="text" id="texto" name="texto" class="form-control"
                                       placeholder="Texto a buscar">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-bind:is="'categoria'"
                                v-for="o in categorias"
                                :o="o"
                                v-on:editarCategoria="ModalCategoria($event)"
                                v-on:EliminarCategoria="ModalDeshabilitar($event)"
                                :key="o.id">
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">Ant</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>


        <!--Modal de agregar categoria-->
        <modal-categoria :name="'ModalCategoria'" v-on:listarCategoria="listarCategoria"
                           ref="modalcategoria"></modal-categoria>
        <!--Modal de eliminar categoria-->
        <modal-estado :name="'ModalEstado'" v-on:listarCategoria="listarCategoria"
                            ref="modalestado"></modal-estado>
    </main>
</template>

<script>
    import Categoria from "./Categoria";
    import ModalCategoria from "./modal/ModalCategoria";
    import ModalEstado from "./modal/ModalEstado";

    export default {
        name: "Categorias",

        data () {
            return {
                nombre: '',
                descripcion: '',
                categorias: [],

                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3
            }
        },

        computed: {

            isActived: function () {
              return this.pagination.current_page;
            },

            pagesNumber: function () {
                if(!this.pagination.to){
                    return [];
                }

                let from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                let to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                let pagesArray = [];
                while (from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },


        },

        mounted () {
            this.listarCategoria();
        },

        methods: {
            listarCategoria (page = 1) {
                axios.post('/categorias/ajax_listar_categoria').then((response) => {
                    this.categorias = response.data.categorias.data;
                    this.pagination = response.data.pagination;
                });
            },
            cambiarPagina(page){
                let me = this;
                me.pagination.current_page = page;
                me.listarCategoria(page)
            },
            ModalCategoria(categoria = null) {
                this.$refs.modalcategoria.show(categoria);
            },
            ModalDeshabilitar(categoria = null) {
                this.$refs.modalestado.show(categoria);
            },
        },

        components: {
            Categoria,
            ModalCategoria,
            ModalEstado,
        },
    }
</script>

<style scoped>

</style>
