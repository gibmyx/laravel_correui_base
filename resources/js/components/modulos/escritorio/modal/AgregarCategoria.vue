<template>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" :id="name + 'Modal'" tabindex="-1" role="dialog" :aria-labelledby="name + 'ModalLabel'"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" id="nombre" name="nombre" class="form-control"
                                       placeholder="Nombre de categoría">
                                <span class="help-block">(*) Ingrese el nombre de la categoría</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="email" id="descripcion" name="descripcion" class="form-control"
                                       placeholder="Enter Email">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
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

        name: "AgregarCategoria",

        methods: {
            hide() {
                let modal = $('#' + this.name + 'Modal');
                modal.modal('hide');
            },
            show() {
                let modal = $('#' + this.name + 'Modal');
                modal.modal('show');
            },
        }
    }
</script>

<style scoped>

</style>
