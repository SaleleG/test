<template>
    <div class="container-fluid">
        <div class="header">
            <h4><strong>Gestion des chemins</strong></h4>
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
                        <input v-model="query" @keyup.enter="searchPaths" type="text" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <span class="input-group-text" @click.prevent="searchPaths"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-white mt-4 mb-4">
            <div class="col-sm-12">
                <button type="button" class="btn  btn-primary mb-4 float-right" @click="create">Ajouter un chemin <i class="fa fa-link"></i></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>NOM</th>
                            <th>LIEN</th>
                            <th>TYPE</th>
                            <th>ETAT</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-show="paths.length" v-for="(path, index) in paths" :key="path.id">
                            <td class="align-middle">{{ path.name}}</td>
                            <td class="align-middle">{{ path.link}}</td>
                            <td class="align-middle">{{ path.type}}</td>
                            <td class="align-middle">{{path.status_print}}</td>
                            <td class="align-middle">
                                <button @click.prevent="edit(path)" class="btn btn-warning btn-sm" style="width:30px;"><i class="fa fa-edit"></i></button>
                                <button @click.prevent="destroy(path)" class="btn btn-danger btn-sm" style="width:30px;"><i class="fa fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="path-store" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 v-if="!isEditing" class="title largeModalLabel">Création d'un chemin</h4>
                        <h4 v-if="isEditing" class="title largeModalLabel">Modifier un chemin</h4>
                        <button type="button" class="close" @click.prevent="resetForm" aria-label="Fermer" :disabled="loading">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nom du chemin</label>
                                    <input type="text" v-model="form.name" class="form-control" placeholder="Entrer le nom" />
                                    <span class="text-danger" v-if="getErrors.name">
                                        {{ getErrors.name[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Lien</label>
                                    <input type="email" v-model="form.link" class="form-control" placeholder="Entrer le lien" />
                                    <span class="text-danger" v-if="getErrors.link">
                                        {{ getErrors.link[0] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix mt-4">
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select v-model="form.type" ref="select" class="form-control">
                                        <option v-for="s in typesOptions" :value="s.type">{{s.value}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Statut du chemin</label>
                                    <select v-model="form.status" ref="select" class="form-control">
                                        <option v-for="s in statusOptions" :value="s.status">{{s.value}}</option>
                                    </select>
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
                queryOptions: [{field: 'link', value: 'Lien'},{field: 'status' ,value: 'Etat'},{field: 'type', value: 'Type'}],
                statusOptions: [{status: 'ENABLED', value: 'Activé'},{status: 'DISABLED' ,value: 'Désactivé'}],
                typesOptions: [{type: 'LIS', value: 'Lis'},{type: 'JOURNAL' ,value: 'Journal'},{type: 'LOG' ,value: 'Log'}],
                queryFiled: 'link',
                query:'',
                paths: [],
                form:{name: '',link: '',status: 'ENABLED',type: 'LIS'},
                pagination:{current_page: 1},
                loading: false,
                isEditing:false,
            }
        },
        mounted() {
            this.fetchPaths();
        },
        methods: {
            fetchPaths(){
                axios.get('/chemins/?page='+this.pagination.current_page).then(response => {
                    this.paths = response.data.data;
                    this.pagination = response.data.meta;
                }).catch(error => {
                    this.toast(error);
                })
            },
            searchPaths(){
                if (this.query == ''){
                    toastr['warning']('Le champ rechercher est requit!', 'Oops', {timeOut: 5000, closeButton: true});
                } else {
                    this.$Progress.start();
                    axios.get('/chemins/search/'+this.queryFiled+'/'+this.query+'?page='+this.pagination.current_page).then(response => {
                        this.paths = response.data.data;
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
                    url = '/chemins/nouveau';
                }else {
                    url = '/chemins/'+this.form.id+'/edition';
                }
                this.loading = true;
                this.errors = [];
                axios.post(url, this.form).then(response => {
                    this.resetForm();
                    toastr['success'](this.isEditing ? "Le chemin a bien été créé" : "Le chemin a bien été mis à jour", '', {timeOut: 5000, closeButton: true});
                    this.loading = false;
                    this.isEditing = false;
                    this.fetchPaths();
                }).catch(error => {
                    this.loading = false;
                    this.toast(error);
                });
            },
            edit(path){
                this.isEditing = true;
                this.form = path;
                $('#path-store').appendTo('body').modal('show');
            },
            reload() {
                this.query = '';
                this.queryFiled = 'name';
                this.$Progress.start();
                this.fetchPaths();
                this.$Progress.finish();
            },
            create(){
                $('#path-store').appendTo('body').modal('show');
            },
            destroy(path){
                swal({
                    title: "Êtes-vous sûr?",
                    text: "Vous ne pourrez pas récupérer ce lien après supression!",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }, () => {
                    axios.get('/chemins/'+path.id+'/supression').then(response => {
                        this.fetchPaths();
                        toastr['success']("Le chemin a bien été supprimé", '', {timeOut: 5000, closeButton: true});
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
                this.fetchPaths();
                $('#path-store').modal('hide');
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
