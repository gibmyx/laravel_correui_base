<template>
    <input type="text"
           :value="value"
           :id="attributes.id"
           :name="attributes.name || ''"
           :disabled="attributes.disabled"
           :class="classv"
           v-on:input="updateValue($event.target.value)"
           :required="attributes.required && attributes.required !== 'no'"/>
</template>

<script>
    export default {
        name: "DatepickerSimple",

        props: {
            value: {required: true, default: ''},
            config: {type: Object, required: true},
            icon: {type: String, default: 'fa fa-calendar'},
            classv: {type: String, default: 'form-control'},
            attributes: {
                type: Object, default: function () {
                    return {}
                }
            },
            debug: {type: Boolean, default: false}
        },
        mounted() {
            this.init();
        },

        destroyed() {
            $(this.$el).daterangepicker('destroy');
        },

        methods: {
            init() {
                let scope = this;
                let ele = $(this.$el).daterangepicker(this.config).on('apply.daterangepicker', function (ev, picker) {
                    let format = typeof scope.config.locale !== 'undefined' ? scope.config.locale.format : 'DD/MM/YYYY';

                    if (scope.config.hasOwnProperty('singleDatePicker') && !_.isUndefined(scope.config.singleDatePicker) && scope.config.singleDatePicker == false) {
                        let fecha = picker.startDate.format(format) + ' - ' + picker.endDate.format(format);
                        scope.updateValue(fecha);
                    } else {
                        scope.updateValue(picker.startDate.format(format));
                    }

                });

                if(!(this.value && this.value.length)){
                    ele.val('');
                }

                return this;
            },

            destroy() {
                $(this.$el).datepicker('destroy');
                return this;
            },

            updateValue(value) {
                this.$emit('input', value);
            },
        },
        watch: {
            value(val) {
                this.$nextTick(function () {
                    $(this.$el).val(val);
                    $(this.$el).trigger('change');
                });
            },
        }
    }
</script>

<style scoped>

</style>