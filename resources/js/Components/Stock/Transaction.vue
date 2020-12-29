<template>
    <div class="container-fluid">
        <div class="header">
            <h4><strong>Liste des transactions sur nos GABs</strong></h4>
        </div>
        <div class="ro bg-white mb-2">
            <div class="row">
                <div class="col-sm-3">
                    <label>Filtre</label>
                    <select v-model="queryFiled" class="form-control">
                        <option v-for="q in queryOptions" :value="q.field">{{q.value}}</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Mot clé</label>
                        <input v-model="query" type="text" class="form-control" placeholder="Rechercher...">
                    </div>
                </div>
                <div class="col-sm-2">
                    <label>Type</label>
                    <select v-model="searches.typetr" class="form-control">
                        <option v-for="s in typeOptions" :value="s.typetr">{{s.value}}</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>Réconciliation</label>
                    <select v-model="searches.r_flag" class="form-control">
                        <option v-for="q in reconcilationOptions" :value="q.r_flag">{{q.value}}</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>Etat</label>
                    <select v-model="searches.rescode" class="form-control">
                        <option v-for="r in rescodeOptions" :value="r.rescode">{{r.value}}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3" style="margin-top: 35px;">
                    <label>Date
                        <input style="margin-right: 30px;" type="radio" v-model="date" value="date">
                    </label>
                    <label>Date et Heure
                        <input type="radio" v-model="date" value="datetime">
                    </label>
                </div>
                <template v-if="date === 'date'">
                    <div class="col-sm-3">
                        <label>De</label>
                        <input type="date" v-model="searches.from" class="form-control" />
                    </div>
                    <div class="col-sm-3">
                        <label>À</label>
                        <input type="date" v-model="searches.to" class="form-control" />
                    </div>
                </template >
                <template v-if="date === 'datetime'">
                    <div class="col-sm-3">
                        <label>De</label>
                        <input type="datetime-local" v-model="searches.from" class="form-control" />
                    </div>
                    <div class="col-sm-3">
                        <label>À</label>
                        <input type="datetime-local" v-model="searches.to" class="form-control" />
                    </div>
                </template>
            </div>
        </div>
        <div class="row bg-white">
            <div class="col-sm-3">
                <button v-on:click="downloadExcel" class="btn btn-success mr-2"> <i class="fa fa-download"></i> EXCEL</button>
                <button v-on:click="downloadCsv" class="btn btn-info mr-2"> <i class="fa fa-download"></i> CSV</button>
            </div>
            <div class="col-sm-6 text-center">
                <p>Transactions de type RETRAIT et ABOUTI</p>
                <p v-if="transactions[0]" class="text-info text-lg">Total : {{transactions[0].count}} Trs / Montant : {{transactions[0].amount}} FCFA</p>
            </div>
            <div class="col-sm-3">
                <button class="btn btn-default btn-secondary float-right ml-3"  v-on:click="searchTransactions()"><i class="fa fa-search"></i> Rechercher</button>
                <button class="btn btn-default btn-warning float-right "  v-on:click="cancel()"><i class="fa fa-times-circle"></i> Annuler</button>
            </div>
        </div>
        <div class="row bg-white mt-4 mb-4">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>NUM</th>
                            <th>GAB</th>
                            <th>CARTE</th>
                            <th>DATE</th>
                            <th>OPERATION</th>
                            <th>COMPTE</th>
                            <th>BILLETS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-show="transactions.length >= 1" v-for="(transaction, index) in transactions" :key="transaction.id">
                            <td class="align-middle">
                                <p>{{transaction.idtransaction}}</p>
                                <p><button type="button" class="btn btn-sm btn-info" @click="detailTrs(transaction)">Détails</button></p>
                            </td>
                            <td class="align-middle">
                                <p><strong>ID: </strong> {{transaction.idgab}}</p>
                                <p><strong>Intitulé: </strong> {{transaction.gab.intitule}}</p>
                            </td>
                            <td class="align-middle">{{transaction.numerocarte}}</td>
                            <td class="align-middle">{{transaction.datetransaction}}</td>
                            <td class="align-middle">
                                <template v-if="transaction.typetr=='RETRAIT' && transaction.rescode=='1'">
                                    {{transaction.typetr}}
                                    <span style="background-color:#f6c23e;color:#FFFFFF;padding:4px;">RETRACTÉ</span>
                                </template>
                                <template v-else>
                                    {{transaction.typetr}}
                                </template>
                            </td>
                            <td class="align-middle">
                                <p><strong>Numero: </strong> {{transaction.ncp}}</p>
                                <p><strong>Montant: </strong> {{transaction.montant}}</p>
                            </td>
                            <td class="align-middle">
                                <p><button type="button" class="btn btn-sm btn-info" @click="detailBills(transaction)">Détails</button></p>
                                <!--<p><strong>C1: </strong> {{transaction.nbrecass1}}</p>
                                <p><strong>C2: </strong> {{transaction.nbrecass2}}</p>
                                <p><strong>C3: </strong> {{transaction.nbrecass3}}</p>
                                <p><strong>C4: </strong> {{transaction.nbrecass4}}</p>-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination v-if="pagination.last_page >= 1"
                                :pagination="pagination"
                                :offset="5"
                                @paginate="query === '' && searches.from === '' && searches.to === '' ? fetchTransactions() : searchTransactions()"
                    ></pagination>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="show-detailTrs" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 class="title largeModalLabel">Détails de la transaction (<span class="text-primary">{{current_transaction.idtransaction}}</span>)</h4>
                        <button type="button" class="close" aria-label="Fermer" @click.prevent="closeTrs">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ARN</th>
                                <th>AUTORISATION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-success text-lg">{{current_transaction.arn}}</td>
                                <td class="text-success text-lg">{{current_transaction.code_auto}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-simple btn-round" @click.prevent="closeTrs">FERMER</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="show-detailBills" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 class="title largeModalLabel">Détails de la billeterie par cassette</h4>
                        <button type="button" class="close" aria-label="Fermer" @click.prevent="closeBills">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Cassette 1</th>
                                <th>Cassette 2</th>
                                <th>Cassette 3</th>
                                <th>Cassette 4</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{current_transaction.c1}}</td>
                                <td>{{current_transaction.c2}}</td>
                                <td>{{current_transaction.c3}}</td>
                                <td>{{current_transaction.c4}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-simple btn-round" @click.prevent="closeBills">FERMER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props:[],
        data () {
            return {
                typeOptions: [{typetr: 'ALL', value: 'Toutes'},{typetr: 'RETRAIT' ,value: 'Retrait'},{typetr: 'DEMANDE SOLDE', value: 'Demande solde'}],
                reconcilationOptions:[{r_flag: 'ALL', value: 'Toutes'},{r_flag: '1', value: 'Réconciliées'},{r_flag: '0', value: 'Non réconciliées'},],
                rescodeOptions:[{rescode: 'ALL', value: 'Toutes'},{rescode: '0', value: 'Abouti'},{rescode: '2', value: 'Non abouti'},{rescode: '1', value: 'Retracté'}],
                queryOptions: [{field: 'idtransaction', value: 'Num transaction'},{field: 'idgab' ,value: 'Num GAB'},{field: 'numerocarte', value: 'Num carte'},{field: 'ncp', value: 'Num compte'},{field: 'libelleagence', value: 'Agence'}],
                queryFiled: 'idtransaction',
                query:'',
                searches:{from: '',to: '',query: '',r_flag:'ALL',typetr: 'ALL',rescode:'ALL'},
                transactions: [],
                current_transaction:{idtransaction: '',arn: '',c1:0,c2:0,c3:0,c4:0, code_auto: ''},
                filterDate:false,
                pagination:{current_page: 1},
                loading: false,
                date: 'date',
            }
        },
        updated: function(){
        },
        mounted() {
            this.fetchTransactions();
        },
        methods: {
            fetchTransactions(){
                this.$Progress.start();
                axios.get('/transactions/?page='+this.pagination.current_page).then(response => {
                    this.transactions = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
                }).catch(error => {
                    this.toast(error);
                    this.$Progress.finish();
                })
            },
            toast(error){
                if(error.response.status === 422){
                    this.errors = error.response.data.errors;
                }else if(error.response.status === 403){
                    toastr['warning'](error.response.data.message, 'Vous n\'êtes pas autorisé!', {timeOut: 5000, closeButton: true});
                }else{
                    toastr['error']('Une érreur est survenue!', 'Réessayez plus tard...', {timeOut: 5000, closeButton: true});
                }
            },
            searchTransactions(){
                let url = this.prepareLink();
                this.$Progress.start();
                axios.get('/transactions/search/'+url+'?page='+this.pagination.current_page).then(response => {
                    this.transactions = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.finish();
                    this.toast(error);
                })
            },
            prepareLink(){
                let url = '';
                if(this.query != ''){
                    url += this.queryFiled+'/'+this.query;
                }else {
                    url += 'undefined/undefined';
                }

                if(this.searches.from && this.searches.to) {
                    url += '/'+this.searches.from+'/'+this.searches.to;
                }else {
                    url += '/undefined/undefined';
                }

                return url+'/'+this.searches.typetr+'/'+this.searches.r_flag+'/'+this.searches.rescode;
            },
            cancel(){
                this.query = '';
                this.queryFiled = 'idtransaction';
                this.searches.from = '';
                this.searches.to = '';
                this.searches.typetr = 'ALL';
                this.searches.r_flag = 'ALL';
                this.searches.rescode = 'ALL';
                this.fetchTransactions();
            },
            downloadExcel(){
                let url = this.prepareLink();
                //this.$Progress.start();
                window.open('/transactions/download-excel/'+url, '_blank');
                /*axios.get('/transactions/download/'+url).then(response => {
                    /let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    let fileLink = document.createElement('a');
                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', 'transactions.xlsx');
                    document.body.appendChild(fileLink);
                    fileLink.click();
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.finish();
                    this.toast(error);
                })*/
            },
            downloadCsv(){
                let url = this.prepareLink();
                window.open('/transactions/download-csv/'+url, '_blank');
            },
            detailTrs(trs){
                this.current_transaction.idtransaction = trs.idtransaction;
                this.current_transaction.arn = trs.lis ? trs.lis.arn : '***';
                this.current_transaction.code_auto = trs.lis ? trs.lis.code_auto : '***';
                $('#show-detailTrs').appendTo('body').modal('show');
            },
            detailBills(trs){
                this.current_transaction.c1 = trs.nbrecass1 ? trs.nbrecass1 : 0;
                this.current_transaction.c2 = trs.nbrecass2 ? trs.nbrecass2 : 0;
                this.current_transaction.c3 = trs.nbrecass3 ? trs.nbrecass3 : 0;
                this.current_transaction.c4 = trs.nbrecass4 ? trs.nbrecass4 : 0;
                $('#show-detailBills').appendTo('body').modal('show');
            },
            closeTrs(){
                $('#show-detailTrs').modal('hide');
            },
            closeBills(){
                $('#show-detailBills').modal('hide');
            },
        }

    }
</script>

<style>
    .alert{
        border-radius: 0px;
    }
</style>
