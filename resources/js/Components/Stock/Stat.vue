<template>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2" v-if="gabs[0]">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">GABs Hors service</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{gabs[0].service}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calculator fa-2x text-gray-300"></i><br>
                            <button v-if="gabs[0]" class="btn btn-info btn-sm" @click="showService">Détails</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">GABS À APPROVISIONNER</div>
                            <div class="row no-gutters align-items-center" v-if="gabs[0]">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{gabs[0].lowmoney}}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-warning" role="progressbar" v-bind:style="[{ width: gabs[0].lowmoneyp+'%' }]" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill fa-2x text-gray-300"></i><br>
                            <button v-if="gabs[0]" class="btn btn-info btn-sm" @click="showLowmoney">Détails</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="show-service" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 class="title largeModalLabel text-center"><span class="text-primary">Lite des GABs </span><span class="text-danger"> "HORS SERVICE"</span></h4>
                        <button type="button" class="close" aria-label="Fermer" @click.prevent="closeAnalytics">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>GAB</th>
                                <th>AGENCE</th>
                                <th>INTITULÉ</th>
                                <th>SOLDE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-if="service_data">
                                <tr v-for="(s, index) in service_data">
                                    <td>{{s.idgab}}</td>
                                    <td>{{s.agency.libelleagence}}</td>
                                    <td>{{s.intitule}}</td>
                                    <td>{{total(s.solde)}} FCFA</td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-simple btn-round" @click.prevent="closeAnalytics">FERMER</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="show-lowmoney" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 class="title largeModalLabel text-center"><span class="text-primary">Lite des GABs </span><span class="text-warning"> "À APPROVISIONNER"</span></h4>
                        <button type="button" class="close" aria-label="Fermer" @click.prevent="closeAnalytics">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>GAB</th>
                                <th>AGENCE</th>
                                <th>INTITULÉ</th>
                                <th>SOLDE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-if="lowmoney_data">
                                <tr v-for="(s, index) in lowmoney_data">
                                    <td>{{s.idgab}}</td>
                                    <td>{{s.agency.libelleagence}}</td>
                                    <td>{{s.intitule}}</td>
                                    <td>{{total(s.solde)}} FCFA</td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-simple btn-round" @click.prevent="closeAnalytics">FERMER</button>
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
                gabs:[],
                service_data :[],
                lowmoney_data :[],
            }
        },
        mounted() {
            this.fetchGabs();
            setInterval(function(){
                axios.get('/stats').then(response => {
                    this.gabs = response.data.data;
                    this.service_data = response.data.data[0].service_data;
                    this.lowmoney_data = response.data.data[0].lowmoney_data;
                }).catch(error => {
                    this.toast(error);
                })
            }, 6000);
        },
        methods: {
            fetchGabs(){
                axios.get('/stats').then(response => {
                    this.gabs = response.data.data;
                    this.service_data = response.data.data[0].service_data;
                    this.lowmoney_data = response.data.data[0].lowmoney_data;
                }).catch(error => {
                    this.toast(error);
                })
            },
            showService(){
                $('#show-service').appendTo('body').modal('show');
            },
            showLowmoney(){
                $('#show-lowmoney').appendTo('body').modal('show');
            },
            closeAnalytics(){
                $('#show-lowmoney').modal('hide');
                $('#show-service').modal('hide');
            },
            total(solde){
                let t = 0;
                if (solde[0]){
                    t += parseInt(solde[0].montant);
                }
                if (solde[1]){
                    t += parseInt(solde[1].montant);
                }
                if (solde[2]){
                    t += parseInt(solde[2].montant);
                }
                if (solde[3]){
                    t += parseInt(solde[3].montant);
                }
                return this.formatNumber(t);
            },
            formatNumber(num) {
                return num.toLocaleString('de-DE');
            }
        }
    }
</script>

<style>
    .alert{
        border-radius: 0px;
    }
</style>
