<template>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" :id="name + 'Modal'" tabindex="-1" role="dialog" :aria-labelledby="name + 'ModalLabel'"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <form action="" @submit.prevent="GuardarCategoria" method="post" enctype="multipart/form-data"
                      class="form-horizontal">

                <div class="modal-header">
                    <h4 v-text="detalle.id == '' ? 'Agregar artículo' : 'Actualizar artículo'" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre <span style="color: red">*</span></label>
                        <div class="col-md-9">
                            <input type="text" id="nombre" name="nombre" class="form-control"
                                   v-model.trim="$v.detalle.nombre.$model" :class="{ 'is-invalid': submitStatus && $v.detalle.nombre.$error }"
                                   placeholder="Nombre del articulo">
                            <div class="invalid-feedback" v-if="!$v.detalle.nombre.required && submitStatus">El nombre es requerido</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Codigo <span style="color: red">*</span></label>
                        <div class="col-md-auto">
                            <input type="text" id="codigo" name="codigo" class="form-control"
                                   v-model.trim="$v.detalle.codigo.$model" :class="{ 'is-invalid': submitStatus && $v.detalle.codigo.$error }"
                                   placeholder="codigo del articulo">
                            <div class="invalid-feedback" v-if="!$v.detalle.codigo.required && submitStatus">El codigo es requerido</div>
                        </div>
                        <div class="col-md-auto">
                            <barcode :value="detalle.codigo" :options="{format: 'EAN-13'}">
                                Generando código de barras
                            </barcode>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Categoria <span style="color: red">*</span></label>
                        <div class="col-md-9">
                            <select class="form-control" name="categoria_id" v-model.trim="$v.detalle.categoria_id.$model" :class="{ 'is-invalid': submitStatus && $v.detalle.categoria_id.$error }" >
                                <option value="">Seleccione</option>
                                <option v-for="o in catalogos.categorias" :value="o.id" :key="o.id"
                                        v-html="o.nombre"></option>
                            </select>
                            <div class="invalid-feedback" v-if="!$v.detalle.categoria_id.required && submitStatus">La categoria es requerido</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Precio de venta <span style="color: red">*</span></label>
                        <div class="col-md-9">
<!--                            <div class="input-group">-->
<!--                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>-->
                            <vue-numeric
                                class="form-control"
                                :class="{ 'is-invalid': submitStatus && $v.detalle.precio_venta.$error }"
                                currency=""
                                separator=","
                                v-model.trim="$v.detalle.precio_venta.$model"
                                :precision="2"
                            ></vue-numeric>
                            <div class="invalid-feedback" v-if="!$v.detalle.precio_venta.required && submitStatus">El precio es requerido</div>
<!--                            </div>-->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                        <div class="col-md-9">
                            <input type="text" id="descripcion" name="descripcion" class="form-control"
                                   v-model="detalle.descripcion"
                                   placeholder="Descripcion">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="email-input">Stock <span style="color: red">*</span></label>
                        <div class="col-md-9">
                            <input type="text" id="stock" name="stock" class="form-control" v-model.trim="$v.detalle.stock.$model"
                                   placeholder="Stock" :class="{ 'is-invalid': submitStatus && $v.detalle.stock.$error }">
                            <div class="invalid-feedback" v-if="!$v.detalle.stock.required && submitStatus">El stock es requerido</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" v-text="detalle.id == '' ? 'Guardar' : 'Actualizar'"></button>
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

    import {required, between} from "vuelidate/lib/validators";
    import VueBarcode from 'vue-barcode';

    export default {
        props: ['name'],

        name: "ModalArticulo",

        data() {
            return {
                detalle: {
                    id: '',
                    nombre: '',
                    codigo: '',
                    precio_venta: 0,
                    categoria_id: '',
                    descripcion: '',
                    condicion: '',
                    stock: '',
                },
                catalogos: [],
                submitStatus: false,
            }
        },

        validations: {
            detalle: {
                nombre: {
                    required
                },
                codigo: {
                    required
                },
                categoria_id: {
                    required
                },
                precio_venta: {
                    required
                },
                stock: {
                    required
                },
            },
        },

        mounted() {
            this.getCatalogo()
        },

        methods: {
            hide() {
                let modal = $('#' + this.name + 'Modal');
                modal.modal('hide');
            },
            show(articulo = null) {
                this.asignarDatos(articulo);
                let modal = $('#' + this.name + 'Modal');
                modal.modal('show');
            },
            getCatalogo(articulo = null) {
                axios.post('/articulos/ajax_get_catalogos').then((response) => {
                    this.catalogos = response.data;
                })
            },
            GuardarCategoria() {

                this.$v.$touch();
                if (this.$v.$invalid) {
                    this.submitStatus = true
                }else{
                    this.submitStatus = false

                    let formData = new FormData();
                    formData.append("id", this.detalle.id);
                    formData.append("nombre", this.detalle.nombre);
                    formData.append("codigo", this.detalle.codigo);
                    formData.append("precio_venta", this.detalle.precio_venta);
                    formData.append("descripcion", this.detalle.descripcion);
                    formData.append("categoria_id", this.detalle.categoria_id);
                    formData.append("stock", this.detalle.stock);
                    formData.append("condicion", this.detalle.condicion);

                    //PARA PETICION NORMAR VER ARCHIVO: ROUTER => WEB
                    Vue.http.post('/articulos/ajax_guardar', formData).then((response) => {
                        let mensaje = response.data.message;
                        this.$toast.success({
                            title: 'Éxito',
                            message: mensaje,
                        });
                        this.$emit('listarArticulo');
                    }).catch((error) => {
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

            asignarDatos(articulo) {
                this.detalle.id = _.isNull(articulo) ? '' : articulo.id;
                this.detalle.nombre = _.isNull(articulo) ? '' : articulo.nombre;
                this.detalle.codigo = _.isNull(articulo) ? '' : articulo.codigo;
                this.detalle.categoria_id = _.isNull(articulo) ? '' : articulo.categoria_id;
                this.detalle.precio_venta = _.isNull(articulo) ? '' : articulo.precio_venta;
                this.detalle.descripcion = _.isNull(articulo) ? '' : articulo.descripcion;
                this.detalle.stock = _.isNull(articulo) ? '' : articulo.stock;
                this.detalle.condicion = _.isNull(articulo) ? '' : articulo.condicion;
            }
        },
        components: {
            'barcode': VueBarcode
        }
    }
</script>

<style scoped>

</style>
