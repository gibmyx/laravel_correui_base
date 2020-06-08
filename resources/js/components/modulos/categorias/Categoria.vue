<template>
    <tr>
        <td>
            <button type="button" class="btn btn-warning btn-sm" @click.prevent="EditarCategoria">
                <i class="icon-pencil"></i>
            </button> &nbsp;
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                    data-target="#modalEliminar">
                <i class="icon-trash"></i>
            </button>
        </td>
        <td v-html="o.nombre"></td>
        <td v-html="o.descripcion"></td>
        <td>
            <span v-if="o.condicion" class="badge badge-success">Activo</span>
            <span v-else class="badge badge-danger">Inactivo</span>
        </td>
    </tr>
</template>

<script>
    export default {
        props:{
            o: Object,
        },

        name: "Categoria",

        data () {
            return {
                id: '',
                nombre: '',
                descripcion: '',
                condicion: '',
            }
        },

        mounted() {
            Vue.nextTick(() => {
                this.id = this.o.id;
                this.nombre = this.o.nombre;
                this.descripcion = this.o.descripcion;
                this.condicion = this.o.condicion;
            });
        },

        methods: {
            EditarCategoria() {
                this.$emit('editarCategoria', this.o);
            },
        },
    }
</script>

<style scoped>

</style>
