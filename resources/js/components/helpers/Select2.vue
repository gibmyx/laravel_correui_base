<template>
    <select :multiple="!!attr.multiple">
        <slot></slot>
    </select>
</template>

<script>
    export default {
        props: ['config', 'value', 'attr'],

        data() {
            return {
                contador: 0,
                myConfig: {
                    minimumInputLength: 0,
                    width: '100%'
                },

                myAjax: {
                    delay: 700,
                    dataType: 'json',
                    processResults(data) {

                        return {
                            results: data
                        };
                    },
                    data(params) {
                        return {
                            q: params.term
                        }
                    }
                }
            }
        },

        mounted() {
            let vm = this;

            this.myConfig = $.extend(this.myConfig, this.config);
            if (this.config.ajax)
                this.myConfig.ajax = $.extend(this.myAjax, this.config.ajax);

            $(this.$el)
            // init select2
                .select2(this.myConfig)
                .val(this.value)
                .trigger('change')
                // emit event on change.
                .on('change', function () {
                    vm.$emit('input', $(vm.$el).val());
                })
        },

        watch: {
            value(value, oldValue) {
                let self = this;
                let isValidValue = (value) => {
                    if (typeof value === 'object' && !_.isEmpty(value)) return true;
                    if (typeof value === 'string' && value.length) return true;
                    if (typeof value === 'number' && value) return true;
                    return false;
                };

                $(this.$el).val(value);
                if ($(this.$el).val() === null && isValidValue(value)) {
                    let datos = $.extend({erptkn: window.tkn}, {id: value});
                    $.ajax({
                        url: self.config.ajax.url(),
                        type: "POST",
                        data: datos,
                        dataType: "json",
                        success(data) {
                            if (!_.isEmpty(data)) {
                                if (typeof data[0] === 'object') {
                                    _.forEach(data, (row) => {
                                        let text = typeof row.nombre !== 'undefined' ? row.nombre : row.text;
                                        $(self.$el).append('<option value="' + row.id + '" selected>' + text + '</option>');
                                    });
                                    setTimeout(function () {
                                        $(self.$el).val(value).trigger('change');
                                    }, 1000);
                                } else {
                                    let text = typeof data.nombre !== 'undefined' ? data.nombre : data.text;
                                    $(self.$el).append('<option value="' + data.id + '" selected>' + text + '</option>');

                                    setTimeout(function () {
                                        $(self.$el).val(data.id != '' ? value : '').trigger('change');
                                    });
                                }
                            }
                        }
                    });
                } else {
                    let aux = $(this.$el).val();

                    if (_.isArray(aux) && aux.length === _.toArray(value).length && this.contador > 0) {
                        this.contador = 0;
                        return;
                    }

                    this.contador += 1;
                    $(this.$el).val(value).trigger('change');
                }
            }
        },

        destroyed() {
            $(this.$el).off().select2('destroy');
        }
    };
</script>