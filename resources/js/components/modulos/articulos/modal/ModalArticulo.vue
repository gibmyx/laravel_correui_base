<template>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" :id="name + 'Modal'" tabindex="-1" role="dialog" :aria-labelledby="name + 'ModalLabel'"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 v-text="detalle.id == '' ? 'Agregar artículo' : 'Actualizar artículo'" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" id="nombre" name="nombre" class="form-control" v-model="detalle.nombre"
                                       placeholder="Nombre del articulo">
                                <span class="help-block">(*) Ingrese el nombre de la artículo</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Codigo</label>
                            <div class="col-md-9">
                                <input type="text" id="codigo" name="codigo" class="form-control" v-model="detalle.codigo"
                                       placeholder="codigo del articulo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Categoria</label>
                            <div class="col-md-9">
                                <select class="form-control"  name="categoria_id"  v-model="detalle.categoria_id">
                                    <option value="">Seleccione</option>
                                    <option v-for="o in catalogos.categorias" :value="o.id" :key="o.id" v-html="o.nombre"></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Precio de venta</label>
                            <div class="col-md-9">
                                <input type="text" id="precio_venta" name="precio_venta" class="form-control" v-model="detalle.precio_venta"
                                       placeholder="Precio de venta">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="email" id="descripcion" name="descripcion" class="form-control" v-model="detalle.descripcion"
                                       placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Stock</label>
                            <div class="col-md-9">
                                <input type="email" id="stock" name="stock" class="form-control" v-model="detalle.stock"
                                       placeholder="Stock">
                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click.prevent="GuardarCategoria" v-text="detalle.id == '' ? 'Guardar' : 'Actualizar'"></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>

<script>

    export default {
        props: ['name'],

        name: "ModalArticulo",

        data () {
            return {
                detalle: {
                    id: '',
                    nombre: '',
                    codigo: '',
                    precio_venta: '',
                    categoria_id: '',
                    descripcion: '',
                    condicion: '',
                    stock: '',
                },
                catalogos: [],
            }
        },

        mounted() {
            this.getCatalogo()
        },

        methods: {
            hide() {
                let modal = $('#' + this.name + 'Modal');
                modal.modal('hide');
            },
            show(articulo  = null) {
                this.asignarDatos(articulo);
                let modal = $('#' + this.name + 'Modal');
                modal.modal('show');
            },
            getCatalogo(articulo  = null) {
                axios.post('/articulos/ajax_get_catalogos').then((response) => {
                    console.log(response.data);
                    this.catalogos = response.data;
                })
            },
            GuardarCategoria() {
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
            },

            asignarDatos(articulo) {
                this.detalle.id = _.isNull(articulo)? '' : articulo.id;
                this.detalle.nombre = _.isNull(articulo)? '' : articulo.nombre;
                this.detalle.codigo = _.isNull(articulo)? '' : articulo.codigo;
                this.detalle.categoria_id = _.isNull(articulo)? '' : articulo.categoria_id;
                this.detalle.precio_venta = _.isNull(articulo)? '' : articulo.precio_venta;
                this.detalle.descripcion = _.isNull(articulo)? '' : articulo.descripcion;
                this.detalle.stock = _.isNull(articulo)? '' : articulo.stock;
                this.detalle.condicion = _.isNull(articulo)? '' : articulo.condicion;
            }
        },
        watch: {
        }
    }
</script>

<style scoped>

</style>
