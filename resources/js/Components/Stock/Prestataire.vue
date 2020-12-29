<template>
    <div class="container-fluid">
        <div class="header">
            <h4><strong>Gestion des prestataires</strong></h4>
        </div>
        <div class="row bg-white">
            <div class="col-sm-2 mt-2">
                <strong class="">Recherche : </strong>
            </div>
            <div class="col-sm-3">
                <select v-model="queryFiled" class="form-control">
                    <option v-for="q in queryOptions" :value="q.field">{{q.value}}</option>
                </select>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <div class="input-group mb-0">
                        <input v-model="query" @keyup.enter="searchPrestataires" type="text" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <span class="input-group-text" @click.prevent="searchPrestataires"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-white mt-4 mb-4">
            <div class="col-sm-12">
                <button type="button" class="btn  btn-secondary mb-4 float-left" @click="back">Retourner aux prestations <i class="fa fa-reply"></i></button>
                <button type="button" class="btn  btn-primary mb-4 float-right" @click="create">Ajouter un prestataire <i class="fa fa-user-cog"></i></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>NOM</th>
                            <th>TELEPHONE</th>
                            <th>ADRESSE</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-show="prestataires.length" v-for="(prestataire, index) in prestataires" :key="prestataire.id">
                            <td class="align-middle">{{ prestataire.libelleprestataire}}</td>
                            <td class="align-middle">{{ prestataire.telephone}}</td>
                            <td class="align-middle">{{ prestataire.address}}</td>
                            <td class="align-middle">
                                <button @click.prevent="edit(prestataire)" class="btn btn-warning btn-sm" style="width:30px;"><i class="fa fa-edit"></i></button>
                                <button @click.prevent="destroy(prestataire)" class="btn btn-danger btn-sm" style="width:30px;"><i class="fa fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="prestataire-store" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 v-if="!isEditing" class="title largeModalLabel">Création d'un prestataire</h4>
                        <h4 v-if="isEditing" class="title largeModalLabel">Modifier un prestataire</h4>
                        <button type="button" class="close" @click.prevent="resetForm" aria-label="Fermer" :disabled="loading">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nom du prestataire</label>
                                    <input type="text" v-model="form.libelleprestataire" class="form-control" placeholder="Entrer le nom" />
                                    <span class="text-danger" v-if="getErrors.libelleprestataire">
                                        {{ getErrors.libelleprestataire[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Téléphone du prestataire</label>
                                    <input type="text" v-model="form.telephone" class="form-control" placeholder="Entrer le téléphone" />
                                    <span class="text-danger" v-if="getErrors.telephone">
                                        {{ getErrors.telephone[0] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix mt-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Adresse du prestataire</label>
                                    <input type="text" v-model="form.address" class="form-control" placeholder="Entrer l'adresse" />
                                    <span class="text-danger" v-if="getErrors.address">
                                        {{ getErrors.address[0] }}
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
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props:[],
        data () {
            return {
                errors: [],
                queryOptions: [{field: 'libelleprestataire', value: 'Nom du prestataire'},{field: 'telephone' ,value: 'Téléphone'}],
                queryFiled: 'libelleprestataire',
                query:'',
                prestataires: [],
                form:{libelleprestataire: '',telephone: '',address: '',idprestataire: ''},
                pagination:{current_page: 1},
                loading: false,
                isEditing:false,
            }
        },
        mounted() {
            this.fetchPrestataires();
        },
        methods: {
            fetchPrestataires(){
                axios.get('/prestataires/?page='+this.pagination.current_page).then(response => {
                    this.prestataires = response.data.data;
                    this.pagination = response.data.meta;
                }).catch(error => {
                    this.toast(error);
                })
            },
            searchPrestataires(){
                if (this.query == ''){
                    toastr['warning']('Le champ rechercher est requit!', 'Oops', {timeOut: 5000, closeButton: true});
                } else {
                    this.$Progress.start();
                    axios.get('/prestataires/search/'+this.queryFiled+'/'+this.query+'?page='+this.pagination.current_page).then(response => {
                        this.prestataires = response.data.data;
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
                    url = '/prestataires/nouveau';
                }else {
                    url = '/prestataires/'+this.form.idprestataire+'/edition';
                }
                this.loading = true;
                this.errors = [];
                axios.post(url, this.form).then(response => {
                    this.resetForm();
                    toastr['success'](this.isEditing ? "Le prestataire a bien été créé" : "Le prestataire a bien été mis à jour", '', {timeOut: 5000, closeButton: true});
                    this.loading = false;
                    this.isEditing = false;
                    this.fetchPrestataires();
                }).catch(error => {
                    this.loading = false;
                    this.toast(error);
                });
            },
            edit(prestataire){
                this.isEditing = true;
                this.form = prestataire;
                $('#prestataire-store').appendTo('body').modal('show');
            },
            reload() {
                this.query = '';
                this.queryFiled = 'libelleprestataire';
                this.$Progress.start();
                this.fetchPrestataires();
                this.$Progress.finish();
            },
            create(){
                $('#prestataire-store').appendTo('body').modal('show');
            },
            destroy(prestataire){
                swal({
                    title: "Êtes-vous sûr?",
                    text: "Vous ne pourrez pas récupérer ce prestataire après supression!",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }, () => {
                    axios.get('/prestataires/'+prestataire.idprestataire+'/supression').then(response => {
                        this.fetchPrestataires();
                        toastr['success']("Le prestataire a bien été supprimé", '', {timeOut: 5000, closeButton: true});
                    }).catch(error => {
                        this.toast(error);
                    });
                });
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
                this.form = {libelleprestataire: '',telephone: '',address: '',idprestataire: ''},
                this.fetchPrestataires();
                $('#prestataire-store').modal('hide');
            },
            back(){
                window.location.replace(`/prestations`);
            },
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
