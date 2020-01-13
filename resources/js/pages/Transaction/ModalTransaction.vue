<template>
    <modal @close="toggleModal" v-show="showModal">
        <h3 slot="header">Movimentação</h3>
        <div class="row" slot="body">
            <div class="col-12">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input class="form-control" id="name" placeholder="Identificação da movimentação" type="text" v-model="form.name"/>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Status</label>
                    <multiselect
                        :options="status"
                        deselect-label="Can't remove this value"
                        placeholder="Select one"
                        v-model="form.status"
                    />
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Categoria</label>
                    <multiselect
                        :options="categories"
                        @select="selectCategory"
                        deselect-label="Can't remove this value"
                        label="name"
                        placeholder="Select one"
                        track-by="id"
                        v-model="categorySelected"
                    />
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Tipo</label>
                    <multiselect
                        :options="types"
                        deselect-label="Can't remove this value"
                        placeholder="Select one"
                        v-model="form.type"
                    />
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="date">Data da movimentação</label>
                    <input class="form-control" id="date" name="date" type="date" />
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Empresa</label>
                    <multiselect
                        :options="companies"
                        @select="selectedCompany"
                        deselect-label="Can't remove this value"
                        label="name"
                        placeholder="Select one"
                        track-by="id"
                        v-model="companySelected"
                    />
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Conta</label>
                    <multiselect
                        :options="bankAccounts"
                        @select="selectAccount"
                        deselect-label="Can't remove this value"
                        label="name"
                        placeholder="Select one"
                        track-by="id"
                        v-model="accountSelected"
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
                        <input class="form-control" id="amount" name="amount" placeholder="Quanto gastou?" type="text" v-model="form.amount"/>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="observations">Observações</label>
                    <textarea class="form-control" id="observations" name="observations" placeholder="Descreve as observações necessárias referente a movimentação" rows="2" v-model="form.observations" />
                </div>
            </div>
        </div>
        <div class="" slot="footer">
            <button @click="toggleModal" class="btn btn-default float-left">
                Fechar
            </button>
            <button @click="submit" class="btn btn-success" type="button" v-if="this.form.id === undefined">Gravar</button>
            <button @click="update" class="btn btn-success" type="button" v-else>Atualizar</button>
        </div>
    </modal>
</template>

<script>
    import GroupedErrors from "../../components/GroupedErrors";
    import Modal from "../../components/Modal";
    import Multiselect from 'vue-multiselect';
    import flat from 'flatpickr';

    const flatpicker = flat;

    export default {
        name: "ModalTransaction",
        components: {
            Multiselect,
            Modal,
            GroupedErrors
        },
        data() {
            return {
                errors: [],
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
        model: {
            prop: 'showModal',
            event: 'toggleModal',
        },
        props: {
            action: String,
            showModal: Boolean,
        },
        mounted(){
            this.resetForm();
            setTimeout(() => {
                this.initFlatpickr()
            }, 200);

            this.getCategories();
            this.getAccounts();
            this.form.owner_id = this.auth.id;
            this.form.created_by = this.auth.id;
            this.form.updated_by = this.auth.id;
            this.getCompanies();
        },
        watch: {
        },
        methods: {
            toggleModal(){
                this.$emit('toggleModal', !this.showModal)
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
            getCategories(){
                axios.get(route('api.category.search')).then(({data}) => {
                    this.categories = data.categories;
                }).catch(error => {
                    console.log(error);
                })
            },
            initFlatpickr() {
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
                this.form.amount = parseFloat(this.form.amount);

                this.persistSubmit('post', route('api.transactions.store'), this.form, true).then(() => {
                    this.$emit('success', this.form);
                    this.toggleModal();
                }).catch((error) => {
                    console.error(error);
                });

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
    @import "../../../sass/plugins/flatpickr";
</style>
