<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Categorías
                    <button type="button" class="btn btn-secondary" @click.prevent="AgregarCategoria">
<!--                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">-->
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
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm"  @click.prevent="ModalDeshabilitar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>Equipos</td>
                            <td>Dispositivos electrónicos</td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>Equipos</td>
                            <td>Dispositivos electrónicos</td>
                            <td>
                                <span class="badge badge-secondary">Inactivo</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>Equipos</td>
                            <td>Dispositivos electrónicos</td>
                            <td>
                                <span class="badge badge-secondary">Inactivo</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button>&nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>Equipos</td>
                            <td>Dispositivos electrónicos</td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
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
        <agregar-categoria :name="'AgregarCategoria'"
                           ref="agregarcategoria"></agregar-categoria>
        <modal-deshabilitar :name="'ModalDeshabilitar'"
        ref="modaldeshabilitar"></modal-deshabilitar>

    </main>
</template>

<script>
    import AgregarCategoria from "./modal/AgregarCategoria";
    import ModalDeshabilitar from "./modal/ModalDeshabilitar";

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            AgregarCategoria,
            ModalDeshabilitar,
        },
        methods: {
            AgregarCategoria() {
                this.$refs.agregarcategoria.show();
            },
            ModalDeshabilitar() {
                this.$refs.modaldeshabilitar.show();
            },

        },
    }
</script>
