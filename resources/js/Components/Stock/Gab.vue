<template>
    <div class="container-fluid">
        <div class="header">
            <h4><strong>Gestion des GABs</strong></h4>
        </div>
        <div class="row bg-white">
            <div class="col-sm-1 text-center">
                <strong class=""><i class="far fa-times-circle" @click="cancel()" style="font-size: 40px; cursor: pointer; margin-top: 25px;"></i> </strong>
            </div>
            <div class="col-sm-2">
                <label>Caméra</label>
                <select v-model="searches.cam" class="form-control">
                    <option value="3">Tous</option>
                    <option value="1">Avec caméra</option>
                    <option value="0">Sans caméra</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label>Monitoring</label>
                <select v-model="searches.alerte_flag" class="form-control">
                    <option value="3">Tous</option>
                    <option value="1">Avec monitoring</option>
                    <option value="0">Sans monitoring</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label>Filtre</label>
                <select v-model="queryFiled" class="form-control">
                    <option v-for="q in queryOptions" :value="q.field">{{q.value}}</option>
                </select>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Mot clé</label>
                    <div class="input-group mb-0">
                        <input v-model="query"  type="text" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <span class="input-group-text" @click="searchGabs"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-white mt-4 mb-4">
            <div class="col-sm-12">
                <button type="button" class="btn  btn-primary mb-4 float-right" @click="create">Ajouter un GAB <i class="fa fa-calculator"></i></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>AGENCE</th>
                            <th>INTITULÉ</th>
                            <th>MARQUE</th>
                            <th>MONTANT</th>
                            <th>DATE SERVICE</th>
                            <th>INFORMATION</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-show="gabs.length" v-for="(gab, index) in gabs" :key="gab.id">
                            <td class="align-middle">{{ gab.agence.libelleagence}}</td>
                            <td class="align-middle">{{ gab.intitule}}</td>
                            <td class="align-middle">{{ gab.marque}}</td>
                            <td class="align-middle">{{ gab.monacq}}</td>
                            <td class="align-middle">{{ gab.misdate}}</td>
                            <td class="align-middle">
                                <button class="btn btn-info btn-sm" @click="detail(gab)">Détails</button>
                            </td>
                            <td class="align-middle">
                                <button @click.prevent="edit(gab)" class="btn btn-warning btn-sm" style="width:30px;"><i class="fa fa-edit"></i></button>
                                <button @click.prevent="charge(gab.idgab)" class="btn btn-success btn-sm">Chargements</button>
                                <button @click.prevent="error(gab.idgab)" class="btn btn-danger btn-sm">Érreurs</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination v-if="pagination.last_page >= 1"
                                :pagination="pagination"
                                :offset="5"
                                @paginate="query === '' ? fetchGabs() : searchGabs()"
                    ></pagination>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="gab-store" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 v-if="!isEditing" class="title largeModalLabel">Création d'un GAB</h4>
                        <h4 v-if="isEditing" class="title largeModalLabel">Modifier un GAB</h4>
                        <button type="button" class="close" @click.prevent="resetForm" aria-label="Fermer" :disabled="loading">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Agence</label>
                                    <select v-model="form.idagence" ref="select" class="form-control">
                                        <option value="">Selectionnez...</option>
                                        <option v-for="a in agencies" :value="a.idagence">{{a.libelleagence}}</option>
                                    </select>
                                    <span class="text-danger" v-if="getErrors.idagence">
                                        {{ getErrors.idagence[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Intitulé</label>
                                    <input type="email" v-model="form.intitule" class="form-control" placeholder="Entrer l'intitulé" />
                                    <span class="text-danger" v-if="getErrors.intitule">
                                        {{ getErrors.intitule[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Marque</label>
                                    <input type="email" v-model="form.marque" class="form-control" placeholder="Entrer la marque" />
                                    <span class="text-danger" v-if="getErrors.marque">
                                        {{ getErrors.marque[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>OS</label>
                                    <input type="email" v-model="form.os" class="form-control" placeholder="Entrer l'os" />
                                    <span class="text-danger" v-if="getErrors.os">
                                        {{ getErrors.os[0] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Montant d'acquisition</label>
                                    <input type="email" v-model="form.monacq" class="form-control" placeholder="Montant"/>
                                    <span class="text-danger" v-if="getErrors.monacq">
                                        {{ getErrors.monacq[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date de mise en service</label>
                                    <input type="date" v-model="form.misdate" class="form-control" />
                                    <span class="text-danger" v-if="getErrors.misdate">
                                        {{ getErrors.misdate[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Etat</label>
                                    <select v-model="form.etat" ref="select" class="form-control">
                                        <option  value="NEUF">Neuf</option>
                                        <option value="OCCASION">Occasion</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Caméra de surveillance</label>
                                    <select v-model="form.cam" ref="select" class="form-control">
                                        <option  value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Adresse IP</label>
                                    <input type="email" v-model="form.adresip" class="form-control" placeholder="Adresse IP"/>
                                    <span class="text-danger" v-if="getErrors.adresip">
                                        {{ getErrors.adresip[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Être monitoré</label>
                                    <select v-model="form.alerte_flag" ref="select" class="form-control">
                                        <option  value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>IDentifiant GAB</label>
                                    <input type="email" v-model="form.idgab" class="form-control" placeholder="Numéro Unique ID"/>
                                    <span class="text-danger" v-if="getErrors.idgab">
                                        {{ getErrors.idgab[0] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-if="isEditing" type="button" class="btn btn-success btn-round btn-default" @click.prevent="save" :disabled="loading">
                            <template v-if="!loading">METTRE À JOUR</template>
                            <template v-if="loading"><i class='fa fa-spin fa-spinner'></i> EN COURS DE MISE À JOUR...</template>
                        </button>
                        <button v-if="!isEditing" type="button" class="btn btn-default btn-round btn-success" @click.prevent="save" :disabled="loading">
                            <template v-if="!loading">SAUVEGARDER</template>
                            <template v-if="loading"><i class='fa fa-spin fa-spinner'></i> EN COURS DE SAUVEGARDE...</template>
                        </button>
                        <button type="button" class="btn btn-warning btn-simple btn-round" @click.prevent="resetForm" :disabled="loading">ANNULER</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="show-detail" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 class="title largeModalLabel">Détails du GAB (<span class="text-primary">{{current_gab.idgab}}</span>)</h4>
                        <button type="button" class="close" aria-label="Fermer" @click.prevent="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>IP</th>
                                <th>MONITORÉ</th>
                                <th>CAMÉRA</th>
                                <th>ETAT</th>
                                <th>OS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{current_gab.adresip}}</td>
                                <td>{{current_gab.alerte_flag}}</td>
                                <td>{{current_gab.cam}}</td>
                                <td>{{current_gab.etat}}</td>
                                <td>{{current_gab.os}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-simple btn-round" @click.prevent="close">FERMER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props:['data_agencies'],
        data () {
            return {
                errors: [],
                queryOptions: [{field: 'idgab', value: 'Identifiant'},{field: 'idagence', value: 'Agence'},{field: 'intitule', value: 'Intitulé'}],
                queryFiled: 'idgab',
                query:'',
                searches:{query:'',cam:'3',alerte_flag: '3'},
                agencies: [],
                gabs: [],
                form:{idagence: '',intitule: '',marque: '',os: '',monacq: '',misdate: '',etat:'NEUF',cam:'1',adresip:'',alerte_flag:'1',idgab:''},
                pagination:{current_page: 1},
                loading: false,
                isEditing:false,
                current_gab: {idgab:'',os:'',etat:'',cam:'',adresip:'',alerte_flag:''}
            }
        },
        mounted() {
            this.fetchGabs();
            this.agencies = this.data_agencies;
        },
        methods: {
            fetchGabs(){
                axios.get('/gabs/?page='+this.pagination.current_page).then(response => {
                    this.gabs = response.data.data;
                    this.pagination = response.data.meta;
                }).catch(error => {
                    this.toast(error);
                })
            },
            searchGabs(){
                if (this.query == ''){
                    toastr['warning']('Le champ rechercher est requit!', 'Oops', {timeOut: 5000, closeButton: true});
                } else {
                    this.$Progress.start();
                    axios.get('/gabs/search/'+this.queryFiled+'/'+this.query+'?page='+this.pagination.current_page).then(response => {
                        this.gabs = response.data.data;
                        this.pagination = response.data.meta;
                        this.$Progress.finish();
                    }).catch(error => {
                        this.$Progress.finish();
                        this.toast(error);
                    })
                }
            },
            save(){
                let url = '';
                if(!this.isEditing){
                    url = '/gabs/nouveau';
                }else {
                    url = '/gabs/'+this.form.idgab+'/edition';
                }
                this.loading = true;
                this.errors = [];
                axios.post(url, this.form).then(response => {
                    this.resetForm();
                    toastr['success'](this.isEditing ? "Le gab a bien été créé" : "Le gab a bien été mis à jour", '', {timeOut: 5000, closeButton: true});
                    this.loading = false;
                    this.isEditing = false;
                    this.fetchGabs();
                }).catch(error => {
                    this.loading = false;
                    this.toast(error);
                });
            },
            edit(gab){
                this.isEditing = true;
                this.form = gab;
                $('#gab-store').appendTo('body').modal('show');
            },
            reload() {
                this.query = '';
                this.queryFiled = 'name';
                this.$Progress.start();
                this.fetchGabs();
                this.$Progress.finish();
            },
            create(){
                $('#gab-store').appendTo('body').modal('show');
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
            resetForm(){
                this.isEditing = false;
                this.errors = [];
                this.fetchGabs();
                $('#gab-store').modal('hide');
            },
            prepareLink(){
                console.log(this.queryFiled);
                let url = '';
                if(this.query != ''){
                    url += this.queryFiled+'/'+this.query;
                }else {
                    url += 'undefined/undefined';
                }
                return url+'/'+this.searches.cam+'/'+this.searches.alerte_flag;
            },
            searchGabs(){
                let url = this.prepareLink();
                this.$Progress.start();
                axios.get('/gabs/search/'+url+'?page='+this.pagination.current_page).then(response => {
                    this.gabs = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.finish();
                    this.toast(error);
                })
            },
            detail(gab){
                this.current_gab.idgab = gab.idgab;
                this.current_gab.etat = gab.etat;
                this.current_gab.os = gab.os;
                this.current_gab.cam = gab.cam_print;
                this.current_gab.adresip = gab.adresip;
                this.current_gab.alerte_flag = gab.alerte_flag_print;
                $('#show-detail').appendTo('body').modal('show');
            },
            close(){
                $('#show-detail').modal('hide');
            },
            charge(id){
                window.location.replace(`/gabs/${id}/chargements`);
            },
            error(id){
                window.location.replace(`/gabs/${id}/erreurs`);
            },
            cancel(){
                this.query = '';
                this.searches.cam = '3';
                this.searches.alerte_flag = '3';
                this.queryFiled = 'idgab';
                this.fetchGabs();
            }
        },
        computed: {
            getErrors() {
                return this.errors;
            }
        }

    }
</script>

<style>
    .alert{
        border-radius: 0px;
    }
</style>
