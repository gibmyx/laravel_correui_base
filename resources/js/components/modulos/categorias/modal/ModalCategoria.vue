<template>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" :id="name + 'Modal'" tabindex="-1" role="dialog" :aria-labelledby="name + 'ModalLabel'"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 v-text="id == '' ? 'Agregar categoría' : 'Actualizar categoría'" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" id="nombre" name="nombre" class="form-control" v-model="nombre"
                                       placeholder="Nombre de categoría">
                                <span class="help-block">(*) Ingrese el nombre de la categoría</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="email" id="descripcion" name="descripcion" class="form-control" v-model="descripcion"
                                       placeholder="Enter Email">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" v-text="id == '' ? 'Guardar' : 'Actualizar'"></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>

<script>
    import params from "./params";

    export default {
        props: ['name'],

        name: "ModalCategoria",

        data () {
            return {
                id: '',
                nombre: '',
                descripcion: '',
                condicion: '',
            }
        },

        methods: {
            hide() {
                let modal = $('#' + this.name + 'Modal');
                modal.modal('hide');
            },
            show(categoria  = null) {
                this.asignarDatos(categoria);
                let modal = $('#' + this.name + 'Modal');
                modal.modal('show');
            },
            asignarDatos(categoria) {
                if(categoria == null){
                    this.id = '';
                    this.nombre = '';
                    this.descripcion = '';
                    this.condicion = '';
                }else{
                    this.id = categoria.id;
                    this.nombre = categoria.nombre;
                    this.descripcion = categoria.descripcion;
                    this.condicion = categoria.condicion;
                }
            }
        },
        watch: {
            id(val){
                console.log('id ', val);
            },
            nombre(val){
                console.log('nombre ', val);
            },
            descripcion(val){
                console.log('descripcion ', val);
            },
            condicion(val){
                console.log('condicion ', val);
            },
        }
    }
</script>

<style scoped>

</style>
