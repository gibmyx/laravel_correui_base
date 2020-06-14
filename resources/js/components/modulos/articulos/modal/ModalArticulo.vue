<template>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" :id="name + 'Modal'" tabindex="-1" role="dialog" :aria-labelledby="name + 'ModalLabel'"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 v-text="id == '' ? 'Agregar artículo' : 'Actualizar artículo'" class="modal-title"></h4>
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
                                       placeholder="Nombre del articulo">
                                <span class="help-block">(*) Ingrese el nombre de la artículo</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Codigo</label>
                            <div class="col-md-9">
                                <input type="text" id="codigo" name="codigo" class="form-control" v-model="codigo"
                                       placeholder="codigo del articulo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Categoria</label>
                            <div class="col-md-9">
                                <input type="text" id="categoria" name="categoria" class="form-control" v-model="categoria_id"
                                       placeholder="Categoria">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Precio de venta</label>
                            <div class="col-md-9">
                                <input type="text" id="precio_venta" name="precio_venta" class="form-control" v-model="precio_venta"
                                       placeholder="Precio de venta">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="email" id="descripcion" name="descripcion" class="form-control" v-model="descripcion"
                                       placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Stock</label>
                            <div class="col-md-9">
                                <input type="email" id="stock" name="stock" class="form-control" v-model="stock"
                                       placeholder="Stock">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click.prevent="GuardarCategoria" v-text="id == '' ? 'Guardar' : 'Actualizar'"></button>
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
                id: '',
                nombre: '',
                codigo: '',
                precio_venta: '',
                categoria_id: '',
                descripcion: '',
                condicion: '',
                stock: '',


                select2categoria: {
                    ajax: {
                        url() {
                            return 'http://127.0.0.1:8000/proveedores/ajax_get_proveedores';
                        }
                    }
                },
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
            GuardarCategoria() {

                let formData = new FormData();
                formData.append("id", this.id);
                formData.append("nombre", this.nombre);
                formData.append("codigo", this.codigo);
                formData.append("precio_venta", this.precio_venta);
                formData.append("descripcion", this.descripcion);
                formData.append("categoria_id", this.categoria_id);
                formData.append("stock", this.stock);
                formData.append("condicion", this.condicion);

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
            asignarDatos(categoria) {
                if(categoria == null){
                    this.id = '';
                    this.nombre = '';
                    this.codigo = '';
                    this.precio_venta = '';
                    this.categoria_id = '';
                    this.descripcion = '';
                    this.stock = '';
                    this.condicion = '';
                }else{
                    this.id = categoria.id;
                    this.nombre = categoria.nombre;
                    this.codigo = categoria.codigo;
                    this.categoria_id = categoria.categoria_id;
                    this.precio_venta = categoria.precio_venta;
                    this.descripcion = categoria.descripcion;
                    this.stock = categoria.stock;
                    this.condicion = categoria.condicion;
                }
            }
        },
        watch: {
            id(val){
            },
            nombre(val){
            },
            codigo(val){
            },
            precio_venta(val){
            },
            categoria_id(val){
            },
            descripcion(val){
            },
            stock(val){
            },
            condicion(val){
            },
        }
    }
</script>

<style scoped>

</style>
