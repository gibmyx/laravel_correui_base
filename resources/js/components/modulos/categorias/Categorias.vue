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
        <modal-categoria :name="'ModalCategoria'"
                           ref="modalcategoria"></modal-categoria>
    </main>
</template>

<script>
    import Categoria from "./Categoria";
    import ModalCategoria from "./modal/ModalCategoria";

    export default {
        name: "Categorias",

        data () {
            return {
                nombre: '',
                descripcion: '',
                categorias: [],
            }
        },

        mounted () {
            this.listarCategoria();
        },

        methods: {
            listarCategoria () {
                Vue.http.post('/categorias/ajax_listar_categoria').then((response) => {
                    this.categorias = response.body.data;
                }).catch((error) => {
                });
            },

            ModalCategoria(categoria = null) {
                this.$refs.modalcategoria.show(categoria);
            },
        },

        components: {
            Categoria,
            ModalCategoria,
        },
    }
</script>

<style scoped>

</style>
