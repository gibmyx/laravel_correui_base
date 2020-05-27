<template>
    <div class="input-group clockpicker">
        <input type="text" class="form-control" :value="value">
        <span class="input-group-addon">
		    <span class="glyphicon glyphicon-time"></span>
	    </span>
    </div>
</template>

<script>
    export default {
        name: "Clockpicker",

        props: {
            value: {required: true, default: ''},
            config: {type: Object, required: true},
            attributes: {
                type: Object, default: () => {
                    return {}
                }
            }
        },
        mounted() {
            this.init();
        },

        destroyed() {
            $(this.$el).clockpicker('destroy');
        },

        methods: {
            init() {
                let scope = this;
                $(this.$el).clockpicker(this.config).find('input').on('change', function() {
                    scope.updateValue(this.value);
                });
            },

            destroy() {
                $(this.$el).datepicker('destroy');
            },

            updateValue(value) {
                this.$emit('input', value);
            },
        },
        watch: {
            value(val, oldVal) {
                this.$nextTick(() => {
                    if(val != oldVal){
                        $(this.$el).val(val);
                        $(this.$el).trigger('change');
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>