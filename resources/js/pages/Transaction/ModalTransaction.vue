<template>
    <div id="modal-transactions" class="modal-light-dark modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white">Visita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                    <grouped-errors :errors="errors"/>
                    <div class="row">
                        <div class="form-group mb-3 required col-md-6 col-xs-12">

                        </div>
                        <div class="form-group mb-3 required col-md-6 col-xs-12">

                        </div>
                    </div>

                    <div class="row">

                    </div>

                    <div class="row">
                        <div class="form-group col-xl-6 col-md-12">
                            <label for="date_scheduled">Data Visita</label>
                            <input type="text" id="date_scheduled" class="form-control" required autocomplete="off" placeholder="" ref="date_scheduled">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-md-12 col-xs-12">
                            <label for="observations">Observações</label>
                            <textarea id="observations" name="observations" rows="2" class="form-control">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Sair</button>
                    <button type="button" class="btn btn-info waves-effect waves-light" @click="submit">Gravar</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</template>

<script>
    import flatpickr from 'flatpickr';
    import GroupedErrors from "../../components/GroupedErrors";

    export default {
        name: "ModalTransaction",
        components: {GroupedErrors},
        data() {
            return {
                errors: [],
                shops: [],
                quarterSelected: '',
                quarters: [
                    {quarter: 1, name: '1º Trimestre: de Janeiro a Março'},
                    {quarter: 2, name: '2º Trimestre: de Abril a Junho'},
                    {quarter: 3, name: '3º Trimestre: de Julho a Setembro'},
                    {quarter: 4, name: '4º Trimestre: de Outubro a Dezembro'}
                ],
                yearSelected: '',
                years: [],
                routing: []
            }
        },
        props: {
            action: String,
            showModal: {
                type: Boolean,
                required: true
            },
        },
        mounted(){
        },
        watch: {
            showModal(newValue, oldValue){
                if(newValue){
                    //
                }
            }
        },
        methods: {
            initFlatpickr() {
                let self = this;
                flatpickr('#suggestion_visit_date', {
                    weekNumbers: true,
                    altInput: true,
                    altFormat: "d/m/Y",
                    dateFormat: "Y-m-d",
                    onChange: function(selectedDates, dateStr, instance) {
                        self.$nextTick()
                    }
                });

                flatpickr('#date_scheduled', {
                    weekNumbers: true,
                    altInput: true,
                    altFormat: "d/m/Y",
                    dateFormat: "Y-m-d",
                    onChange: function(selectedDates, dateStr, instance) {
                        self.$nextTick()
                    }
                });
            },
            submit(){
                let link = '';
                let method = '';

                if(this.action === 'store'){
                    link = route('api.visit.store');
                    method = 'post';
                    this.visit.classNames = 'scheduled';
                    this.$parent.calendarEvents.push(this.visit)
                } else if(this.action === 'update'){
                    console.log(this.visit.id);
                    link = route('api.visit.update', this.visit.id);
                    method = 'put'
                }

                console.log(momentJS(this.visit.date_scheduled).isoWeekday());

                if(link !== '' && method !== ''){
                    this.persistSubmit(method, link, this.visit)
                }
            },
            persistSubmit(method, uri, form) {
                this.errors = [];

                axios[method](uri, form).then(response => {
                    //location.reload()
                    //this.$parent.eventServer.push(form)
                    console.log(form)
                }).catch(error => {
                    if (typeof error.response.data === 'object') {
                        this.errors = formatterErrors(error.response.data.errors);
                    } else {
                        this.errors = ['Something went wrong. Please try again.'];
                    }

                    $('html,body').animate({ scrollTop: 0 }, 400);
                });
            },
        }
    }
</script>

<style lang="scss">
</style>
