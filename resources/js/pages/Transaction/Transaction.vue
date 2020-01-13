<template>
    <div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"/></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Current balance</span>
                        <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-alt"/></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Debits</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="far fa-money-bill-alt"/></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Credits</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-check-alt"/></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-12 pb-4">
                <a @click="showModalNew=true" class="btn btn-info">Novo</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 table-responsive dataTables_wrapper dt-bootstrap4">
                            <table class="table table-bordered table-hover" id="datatable-transaction">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Nome</th>
                                    <th>Valor</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <th>Responsável</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <modal-transaction v-model="showModalNew"></modal-transaction>
    </div>
</template>

<script>
    import 'datatables.net-fixedheader-bs4';
    import 'datatables.net-responsive-bs4';
    import 'datatables.net-autofill-bs4';
    import 'datatables.net-bs4';
    import 'datatables.net-colreorder-bs4';
    import 'datatables.net-scroller-bs4';
    import $ from 'jquery';
    import ModalTransaction from "./ModalTransaction";

    export default {
        name: "Transaction",
        components: {ModalTransaction},
        data() {
            return {
                selectorDatatable: '#datatable-transaction',
                showModalNew: false,
            }
        },
        mounted(){
            this.initDatatable();
        },
        methods: {
            initDatatable() {
                $(this.selectorDatatable).DataTable({
                    ajax: {
                        url: route('api.transactions.search'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {

                        },
                    },
                    type: "GET",
                    columns: [
                        { data: 'date', name: 'date', searchable: true, orderable: true },
                        { data: 'name', name: 'name', searchable: true, orderable: true },
                        { data: 'amount', name: 'amount', searchable: true, orderable: true },
                        { data: 'type', name: 'type', searchable: true, orderable: true },
                        { data: 'status', name: 'status', searchable: true, orderable: true },
                        { data: 'created_by.name', name: 'created_by.name', searchable: true, orderable: true },
                    ],
                    order: [[0, 'desc']],
                    processing: true,
                    serverSide: true,
                    searchDelay: 100,
                    responsive: true,
                    pageLength: 25,
                    colReorder: true,
                    paging: true,
                    info: true,
                    ordering: true,
                    fixedHeader: {
                        header: true,
                        footer: false
                    },
                    language: {
                        sProcessing: "<i class='fa fa-spinner fa-spin fa-2x fa-fw'></i><br>Processing",
                        sLengthMenu: " _MENU_ registros",
                        sZeroRecords: "Sem Resultados",
                        sInfo: "<span>A mostrar de _START_ a _END_ | Total:  _TOTAL_ registros </span>",
                        sInfoEmpty: "<span ></span>0 registros",
                        sInfoFiltered: "<span>(filtrado de _MAX_ total)</span>",
                        sSearch: "<span class=''> <i class='fa fa-search lightblue'></i></span>",
                        searchPlaceholder: "Pesquisar",
                        sUrl: "",
                        oPaginate: {
                            sFirst: "Primeiro",
                            sPrevious: "Anterior",
                            sNext: "Próximo",
                            sLast: "Último"
                        }
                    },
                });

                HelperJS.commonFunctionDatatable(this.selectorDatatable);
            }
        }
    }
</script>

<style lang="scss">
    @import '~datatables.net-bs4/css/dataTables.bootstrap4.css';
    @import '~datatables.net-autofill-bs4/css/autoFill.bootstrap4.css';
    @import '~datatables.net-buttons-bs4/css/buttons.bootstrap4.css';
    @import '~datatables.net-colreorder-bs4/css/colReorder.bootstrap4.css';
    @import '~datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.css';
    @import '~datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.css';
    @import '~datatables.net-keytable-bs4/css/keyTable.bootstrap4.css';
    @import '~datatables.net-responsive-bs4/css/responsive.bootstrap4.css';
    @import '~datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.css';
    @import '~datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.css';
    @import '~datatables.net-scroller-bs4/css/scroller.bootstrap4.css';
    @import '~datatables.net-select-bs4/css/select.bootstrap4.css';
</style>
