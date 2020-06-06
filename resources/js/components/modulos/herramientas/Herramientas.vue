<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Herramientas</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Herramientas
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Editor de texto "wysiwyg"</label>
                            <wysiwyg/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Notificaciones Toast</label>
                            <div class="col-md-6">
                                <button @click.prevent="successToast">
                                    toastr success
                                </button>
                                <button @click.prevent="infoToast">
                                    toastr info
                                </button>
                                <button @click.prevent="warnToast">
                                    toastr warn
                                </button>
                                <button @click.prevent="errorToast">
                                    toastr error
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Peticion Ajax</label>
                            <div class="col-md-6">
                                <button @click.prevent="enviarConsole">
                                    Peticon
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
    </main>
</template>

<script>

    export default {
        name: "Herramientas",
        methods: {
            successToast() {
                this.$toast.success({
                    title: 'Probando Toast',
                    message: 'esto es un toast de prueba'
                });
            },
            infoToast() {
                this.$toast.info({
                    title: 'Probando Toast',
                    message: 'esto es un toast de prueba'
                });
            },
            warnToast() {
                this.$toast.warn({
                    title: 'Probando Toast',
                    message: 'esto es un toast de prueba'
                });
            },
            errorToast() {
                this.$toast.error({
                    title: 'Probando Toast',
                    message: 'esto es un toast de prueba'
                });
            },
            enviarConsole() {
                let tkn = window.tkn;
                let formData = new FormData();
                formData.append("id", '');
                formData.append("nombre", 'categoria_1');
                formData.append("descripcion", 'se esta probando la peticion ajax');
                formData.append("condicion", 1);

                //PARA PETICION NORMAR VER ARCHIVO: ROUTER => WEB
                Vue.http.post('/categorias/ajax_guardar', formData).then((response) => {
                    let mensaje = response.data.mensaje;
                    this.$toast.error({
                        title: 'Probando Toast',
                        message: mensaje,
                    });
                });

                //PARA PETICIONES API VER ARCHIVO: ROUTER => API
                // Vue.http.post('/api/formulario/prueba_peticion').then((response) => {
                //     let mensaje = response.data.mensaje;
                //     this.$toast.error({
                //         title: 'Probando Toast',
                //         message: mensaje,
                //     });
                // });
            }
        }
    }
</script>

<style scoped>

</style>
