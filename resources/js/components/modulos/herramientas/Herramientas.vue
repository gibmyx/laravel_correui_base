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
                            <label>Editor de texto "wysiwyg" <span required="" aria-required="true">*</span></label>
                            <wysiwyg />
                        </div>
                    </div> <div class="form-group row">
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
                    title:'Probando Toast',
                    message:'esto es un toast de prueba'
                });
            },
            infoToast() {
                this.$toast.info({
                    title:'Probando Toast',
                    message:'esto es un toast de prueba'
                });
            },
            warnToast() {
                this.$toast.warn({
                    title:'Probando Toast',
                    message:'esto es un toast de prueba'
                });
            },
            errorToast() {
                this.$toast.error({
                    title:'Probando Toast',
                    message:'esto es un toast de prueba'
                });
            },
        }
    }
</script>

<style scoped>

</style>
