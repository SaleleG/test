<template>
    <div class="container-fluid">
        <div class="header">
            <h4><strong>Historique des érreurs du GAB (<span class="text-lg text-primary">{{errors[0]}}</span>)</strong></h4>
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
                <button class="btn mt-4 btn-default btn-secondary float-right ml-3"  v-on:click="searchError()"><i class="fa fa-search"></i> Rechercher</button>
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
                            <th>STATUT</th>
                            <th>DATE</th>
                            <th>ETAT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-show="errors.length" v-for="(error, index) in errors" :key="error.idgab">
                            <td>{{error.idstatut}}</td>
                            <td>{{error.date}}</td>
                            <td>{{error.alerte}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination v-if="pagination.last_page >= 1"
                                :pagination="pagination"
                                :offset="5"
                                @paginate="fetchError()"
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
                errors: [],
                searches:{from: '',to: ''},
                pagination:{current_page: 1},
                loading: false,
            }
        },
        mounted() {
            this.idgab = this.data_idgab;
            this.fetchError();
        },
        methods: {
            fetchError(){
                axios.get('/gabs/'+this.idgab+'/erreurs?page='+this.pagination.current_page).then(response => {
                    this.errors = response.data.data;
                    this.pagination = response.data.meta;
                }).catch(error => {
                    this.toast(error);
                })
            },
            searchError(){
                this.$Progress.start();
                let url = 'undefined/undefined';
                if (this.searches.from != '' && this.searches.to != ''){
                    url = this.searches.from +'/'+this.searches.to;
                }

                axios.get('/gabs/'+this.idgab+'/'+url+'/search/erreurs?page='+this.pagination.current_page).then(response => {
                    this.errors = response.data.data;
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
                this.fetchError();
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
