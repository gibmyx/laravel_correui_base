<template>
    <tr>
        <td width="10%" class="text-center">
            <button type="button" class="btn btn-warning btn-sm" @click.prevent="EditarCategoria">
                <i class="icon-pencil"></i>
            </button>
            <button v-if="o.condicion"  type="button" class="btn btn-danger btn-sm" @click.prevent="DesactivarCategoria">
                <i class="icon-trash"></i>
            </button>
            <button v-else type="button" class="btn btn-info btn-sm" @click.prevent="DesactivarCategoria">
                <i class="icon-check"></i>
            </button>
        </td>
        <td width="20%" v-html="o.nombre"></td>
        <td width="30%" v-html="o.descripcion"></td>
        <td width="20%" class="text-center">
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
            DesactivarCategoria() {

                this.$emit('EliminarCategoria', this.o);
            }
        },
        watch: {
            id(val){
                this.o['id'] = val;
            },
            nombre(val){
                this.o['nombre'] = val;
            },
            descripcion(val){
                this.o['descripcion'] = val;
            },
            condicion(val){
                this.o['condicion'] = val;
            },
        }
    }
</script>

<style scoped>

</style>
