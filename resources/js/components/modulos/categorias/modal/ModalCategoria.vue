<template>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" :id="name + 'Modal'" tabindex="-1" role="dialog" :aria-labelledby="name + 'ModalLabel'"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <form @submit.prevent="GuardarCategoria" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="modal-header">
                        <h4 v-text="id == '' ? 'Agregar categoría' : 'Actualizar categoría'" class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre <span style="color: red">*</span></label>
                                <div class="col-md-9" :class="{ 'form-group--error': $v.nombre.$error }">
                                    <input type="text" id="nombre" :name="'nombre'" class="form-control" v-model.trim="$v.nombre.$model"
                                           placeholder="Nombre de categoría" :class="{ 'is-invalid': submitStatus && $v.nombre.$error }">
                                    <div class="invalid-feedback" v-if="!$v.nombre.required && submitStatus">El nombre es requerido</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                <div class="col-md-9">
                                    <input type="text" id="descripcion" name="descripcion" class="form-control"
                                           v-model="descripcion"
                                           placeholder="Enter Email">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" v-text="id == '' ? 'Guardar' : 'Actualizar'"></button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>

<script>
    import params from "./params";
    import { required, minLength } from 'vuelidate/lib/validators';

    export default {
        props: ['name'],

        name: "ModalCategoria",

        data() {
            return {
                id: '',
                nombre: '',
                descripcion: '',
                condicion: '',

                submitStatus: false,
            }
        },

        methods: {
            hide() {
                let modal = $('#' + this.name + 'Modal');
                modal.modal('hide');
            },
            show(categoria = null) {
                this.asignarDatos(categoria);
                let modal = $('#' + this.name + 'Modal');
                modal.modal('show');
            },
            GuardarCategoria() {

                this.$v.$touch();
                if (this.$v.$invalid) {
                    this.submitStatus = true
                }else{
                    this.submitStatus = false

                    let formData = new FormData();
                    formData.append("id", this.id);
                    formData.append("nombre", this.nombre);
                    formData.append("descripcion", this.descripcion);
                    formData.append("condicion", this.condicion);

                    //PARA PETICION NORMAR VER ARCHIVO: ROUTER => WEB
                    Vue.http.post('/categorias/ajax_guardar', formData).then((response) => {
                        let mensaje = response.data.message;
                        this.$toast.success({
                            title: 'Éxito',
                            message: mensaje,
                        });
                        this.$emit('listarCategoria');
                    }).catch((error) => {
                        console.log(error);
                        let mensaje = error.body.message;
                        this.$toast.error({
                            title: 'Error',
                            message: mensaje,
                        });
                    }).finally(() => {
                        this.hide();
                    });
                }


            },
            asignarDatos(categoria) {
                if (categoria == null) {
                    this.id = '';
                    this.nombre = '';
                    this.descripcion = '';
                    this.condicion = '';
                } else {
                    this.id = categoria.id;
                    this.nombre = categoria.nombre;
                    this.descripcion = categoria.descripcion;
                    this.condicion = categoria.condicion;
                }
            }
        },

        validations: {
            nombre: {
                required
            },
        },

        watch: {
            id(val) {
            },
            nombre(val) {
            },
            descripcion(val) {
            },
            condicion(val) {
            },
        }
    }
</script>

<style scoped>

</style>
