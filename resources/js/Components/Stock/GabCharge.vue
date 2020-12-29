<template>
    <div class="container-fluid">
        <div class="header">
            <h4><strong>Historique des chargements du GAB (<span class="text-lg text-primary">{{idgab}}</span>)</strong></h4>
        </div>
        <div class="row bg-white">
            <div class="col-sm-4">
                <label>De</label>
                <input type="date" v-model="searches.from" class="form-control" />
            </div>
            <div class="col-sm-4">
                <label>À</label>
                <input type="date" v-model="searches.to" class="form-control" />
            </div>
            <div class="col-sm-4">
                <button class="btn mt-4 btn-default btn-secondary float-right ml-3"  v-on:click="searchCharge()"><i class="fa fa-search"></i> Rechercher</button>
                <button class="btn mt-4 btn-default btn-warning float-right "  v-on:click="cancel()"><i class="fa fa-times-circle"></i> Annuler</button>
            </div>
        </div>
        <div class="row bg-white mt-4 mb-4">
            <div class="col-sm-12">
                <button type="button" class="btn  btn-primary mb-4 float-right" @click="back">Retrouner aux GABs <i class="fa fa-reply"></i></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>DATE CHARGEMENT</th>
                            <th>MONTANT</th>
                            <th>CASSETTE</th>
                            <th>BILLETERIE</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center" v-show="chargements.length" v-for="(charge, index) in chargements" :key="charge.idgab">
                                <td>{{charge.idgab}}</td>
                                <td>{{charge.chardate}}</td>
                                <td>{{charge.montant}}</td>
                                <td>{{charge.cassette.libellecassette}}</td>
                                <td>{{charge.nbrebillet}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination v-if="pagination.last_page >= 1"
                                :pagination="pagination"
                                :offset="5"
                                @paginate="fetchCharge()"
                    ></pagination>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props:['data_idgab'],
        data () {
            return {
                idgab: '',
                chargements: [],
                searches:{from: '',to: ''},
                pagination:{current_page: 1},
                loading: false,
            }
        },
        mounted() {
            this.idgab = this.data_idgab;
            this.fetchCharge();
        },
        methods: {
            fetchCharge(){
                axios.get('/gabs/'+this.idgab+'/chargements?page='+this.pagination.current_page).then(response => {
                    this.chargements = response.data.data;
                    this.pagination = response.data.meta;
                }).catch(error => {
                    this.toast(error);
                })
            },
            searchCharge(){
                this.$Progress.start();
                let url = 'undefined/undefined';
                if (this.searches.from != '' && this.searches.to != ''){
                    url = this.searches.from +'/'+this.searches.to;
                }

                axios.get('/gabs/'+this.idgab+'/'+url+'/search/chargements?page='+this.pagination.current_page).then(response => {
                    this.chargements = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.finish();
                    this.toast(error);
                })
            },
            back(){
                window.location.replace(`/gabs`);
            },
            cancel(){
                this.searches.from = '';
                this.searches.to = '';
                this.fetchCharge();
            },
            logFrom(){
                document.getElementById('from').value;
            }
        }

    }
</script>

<style>
    .alert{
        border-radius: 0px;
    }
</style>
