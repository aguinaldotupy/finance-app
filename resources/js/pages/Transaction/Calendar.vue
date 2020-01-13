<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!--        <div class="col-lg-2">-->
                <!--        </div>-->
                <div class="col-lg-12">
                    <FullCalendar
                        class='app-calendar'
                        ref="fullCalendar"
                        :plugins="calendarPlugins"
                        :events="calendarEvents"
                        :header="calendarHeader"
                        defaultView="dayGridMonth"
                        locale="pt"
                        weekends="false"
                        minTime="06:00:00"
                        maxTime="21:00:00"
                        eventLimit="true"
                        eventLimitText="Ver mais"
                        editable="true"
                        selectable="true"
                        droppable="true"
                        handleWindowResize="true"
                        @dateClick="createEvent"
                        @eventDrop="eventDrop"
                        @eventClick="eventClickToUpdate"
                        :event-render="renderEvent"
                    />
                </div>
            </div>
            <modal v-if="showModal" @close="showModal = false">
                <h3 slot="header">Movimentação</h3>
                <div class="row" slot="body">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input id="name" type="text" class="form-control" placeholder="Identificação da movimentação" v-model="form.name"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <multiselect
                                v-model="form.status"
                                deselect-label="Can't remove this value"
                                placeholder="Select one"
                                :options="status"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Categoria</label>
                            <multiselect
                                v-model="categorySelected"
                                deselect-label="Can't remove this value"
                                placeholder="Select one"
                                track-by="id"
                                label="name"
                                :options="categories"
                                @select="selectCategory"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tipo</label>
                            <multiselect
                                v-model="form.type"
                                deselect-label="Can't remove this value"
                                placeholder="Select one"
                                :options="types"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="date">Data da movimentação</label>
                            <input type="date" name="date" id="date" class="form-control" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Empresa</label>
                            <multiselect
                                v-model="companySelected"
                                deselect-label="Can't remove this value"
                                track-by="id"
                                label="name"
                                placeholder="Select one"
                                :options="companies"
                                @select="selectedCompany"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Conta</label>
                            <multiselect
                                v-model="accountSelected"
                                deselect-label="Can't remove this value"
                                track-by="id"
                                label="name"
                                placeholder="Select one"
                                :options="bankAccounts"
                                @select="selectAccount"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="amount">Valor</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" v-if="accountSelected">{{ accountSelected.currency}} </span>
                                    <span class="input-group-text" v-else>€</span>
                                </div>
                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Quanto gastou?" v-model="form.amount"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="observations">Observações</label>
                            <textarea class="form-control" name="observations" id="observations" v-model="form.observations" rows="2" placeholder="Descreve as observações necessárias referente a movimentação" />
                        </div>
                    </div>
                </div>
                <div class="" slot="footer">
                    <button type="button" class="btn btn-success" @click="submit" v-if="this.form.id === undefined">Gravar</button>
                    <button type="button" class="btn btn-success" @click="update" v-else>Atualizar</button>
                </div>
            </modal>
        </div>
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import interactionPlugin from '@fullcalendar/interaction';
    import Modal from "../../components/Modal";
    import Multiselect from 'vue-multiselect';
    import JQuery from "jquery";

    let $ = JQuery;

    export default {
        name: "Calendar",
        components: {
            Multiselect,
            Modal,
            FullCalendar, // make the <FullCalendar> tag available
        },
        data() {
            const self = this;

            return {
                calendarHeader: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                filters: '',
                calendarEvents: [],
                calendarPlugins: [ // plugins must be defined in the JS
                    dayGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                showModal: false,
                actionModal: 'store',
                bankAccounts: [],
                accountSelected: undefined,
                companies: [],
                companySelected: undefined,
                status: ['Pago', 'Pendente', 'Agendado'],
                types: ['Crédito', 'Débito'],
                categories: [],
                categorySelected: undefined,
                form: {}
            }
        },
        watch: {
            showModal(newVal, oldVal){
                if(newVal){
                    setTimeout(() => {
                        this.initFlatpickr()
                    });
                }
            }
        },
        created() {
            this.resetForm();
            this.getEvents();
            this.getCategories();
            this.getAccounts();
            this.form.owner_id = this.auth.id;
            this.form.created_by = this.auth.id;
            this.form.updated_by = this.auth.id;
            this.getCompanies();
        },
        mounted() {
            //
        },
        methods: {
            renderEvent(info){
                const vm = new window.Constructor({
                    propsData: {
                        event: info.event,
                        element: info.el,
                        view: info.view
                    }
                }).$mount();
                $(info.el).html(vm.$el);

            },
            selectAccount(selected){
                this.form.account_id = selected.id;
                this.form.entity_id = selected.entity.id
            },
            selectedCompany(selected){
                this.form.company_id = selected.id;
            },
            selectCategory(selected){
                this.form.category_id = selected.id
            },
            getAccounts(){
                axios.get(route('api.accounts.list')).then(({data}) => {
                    this.bankAccounts = data.accounts
                }).catch(error => {
                    console.log(error)
                })
            },
            getCompanies(){
                axios.get(route('api.company.search')).then(({data}) => {
                    this.companies = data.companies
                }).catch(error => {
                    console.log(error)
                })
            },
            getEvents(){
                axios.get(route('api.transactions.calendar')).then(({data}) => {
                    this.calendarEvents = data.data;
                }).catch(error => {
                    console.log(error);
                })
            },
            getCategories(){
                axios.get(route('api.category.search')).then(({data}) => {
                    this.categories = data.categories;
                }).catch(error => {
                    console.log(error);
                })
            },
            filterEvent(ref){
                this.$refs[ref].checked = !this.$refs[ref].checked;
                this.filtering();
            },
            filtering(){
                let filters = '';
                for(let key = 1; key <= 5; key++){
                    let filter = `filter_${key}`;
                    let element = this.$refs[filter];
                    if(element.checked){
                        if(filters !== ''){
                            filters = `${filters},${element.value}`;
                        } else {
                            filters = `${element.value}`
                        }
                    }
                }

                this.filters = filters;
                localStorage.setItem('filter_calendar', filters);

                let calendarApi = this.$refs.fullCalendar.getApi();
                //calendarApi.removeAllEventSources();
                setTimeout(() => {
                    calendarApi.refetchEvents();
                }, 500);

                //console.log(calendarApi)
            },
            createEvent: function(arg) {
                this.showModal = true;
                console.log(arg.date, arg);
            },
            eventDrop: function(selected){
                console.log(selected);

                let dateDrop = momentJS(selected.event.start);

                let form = {
                    name: selected.event.title,
                    amount: selected.event.extendedProps.amount,
                    date: dateDrop.format('YYYY-MM-DD'),
                };

                console.log(form);

                this.persistUpdate(selected.event.id, form);
            },
            eventClickToUpdate: function(selected) {
                // console.log(selected.event);
                this.form = selected.event.extendedProps.form;
                this.accountSelected = selected.event.extendedProps.bankAccount;
                this.companySelected = selected.event.extendedProps.company;
                this.categorySelected = selected.event.extendedProps.category;
                this.showModal = true;
            },
            persistUpdate(id, form){
                let calendarApi = this.$refs.fullCalendar.getApi();

                this.persistSubmit('put', route('api.transactions.update', id), form, true);

                this.showModal = false;

                setTimeout(() => {
                    calendarApi.refetchEvents();
                }, 500);
            },
            update(){
                this.persistUpdate(this.form.id, this.form);
            },
            initFlatpickr(){
                let self = this;
                flatpickr('#date', {
                    weekNumbers: true,
                    altInput: true,
                    altFormat: "d/m/Y",
                    dateFormat: "Y-m-d",
                    defaultDate: self.form.date,
                    onChange: function(selectedDates, dateStr, instance) {
                        self.form.date = dateStr;
                        self.$nextTick()
                    }
                });
            },
            submit(){
                let calendarApi = this.$refs.fullCalendar.getApi();
                this.form.amount = parseFloat(this.form.amount);

                this.persistSubmit('post', route('api.transactions.store'), this.form, true);

                this.showModal = false;

                setTimeout(() => {
                    calendarApi.refetchEvents();
                }, 500);
            },
            resetForm(){
                this.form = {
                    id: undefined,
                    name: undefined,
                    amount: undefined,
                    account_id: undefined,
                    owner_id: undefined,
                    entity_id: undefined,
                    observations: undefined,
                    type: undefined,
                    status: undefined,
                    created_by: undefined,
                    updated_by: undefined,
                    company_id: undefined,
                    date: undefined,
                    category_id: undefined,
                }
            }
        }
    }
</script>

<style lang="scss">
    @import "../../../sass/plugins/_full_calendar.scss";
    @import "../../../sass/plugins/flatpickr";



    .tooltip {
        display: block !important;
        z-index: 10000;
    }

    .tooltip .tooltip-inner {
        background: black;
        color: white;
        border-radius: 16px;
        padding: 5px 10px 4px;
    }

    .tooltip .tooltip-arrow {
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
        margin: 5px;
        border-color: black;
        z-index: 1;
    }

    .tooltip[x-placement^="top"] {
        margin-bottom: 5px;
    }

    .tooltip[x-placement^="top"] .tooltip-arrow {
        border-width: 5px 5px 0 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        bottom: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .tooltip[x-placement^="bottom"] {
        margin-top: 5px;
    }

    .tooltip[x-placement^="bottom"] .tooltip-arrow {
        border-width: 0 5px 5px 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-top-color: transparent !important;
        top: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .tooltip[x-placement^="right"] {
        margin-left: 5px;
    }

    .tooltip[x-placement^="right"] .tooltip-arrow {
        border-width: 5px 5px 5px 0;
        border-left-color: transparent !important;
        border-top-color: transparent !important;
        border-bottom-color: transparent !important;
        left: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    .tooltip[x-placement^="left"] {
        margin-right: 5px;
    }

    .tooltip[x-placement^="left"] .tooltip-arrow {
        border-width: 5px 0 5px 5px;
        border-top-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        right: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    .tooltip.popover .popover-inner {
        background: #f9f9f9;
        color: black;
        padding: 24px;
        border-radius: 5px;
        box-shadow: 0 5px 30px rgba(black, 0.1);
    }

    .tooltip.popover .popover-arrow {
        border-color: #f9f9f9;
    }

    .tooltip[aria-hidden="true"] {
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.15s, visibility 0.15s;
    }

    .tooltip[aria-hidden="false"] {
        visibility: visible;
        opacity: 1;
        transition: opacity 0.15s;
    }
</style>
