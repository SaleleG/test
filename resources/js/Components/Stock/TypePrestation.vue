<template>
    <div class="container-fluid">
        <div class="header">
            <h4><strong>Gestion des types deprestations</strong></h4>
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
                        <input v-model="query" @keyup.enter="searchTypePrestation" type="text" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <span class="input-group-text" @click.prevent="searchTypePrestation"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-white mt-4 mb-4">
            <div class="col-sm-12">
                <button type="button" class="btn  btn-secondary mb-4 float-left" @click="back">Retourner aux prestations <i class="fa fa-reply"></i></button>
                <button type="button" class="btn  btn-primary mb-4 float-right" @click="create">Ajouter un type de prestation <i class="fa fa-user-cog"></i></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>TYPE DE PRESTATION</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-show="typeprestations.length" v-for="(typeprestation, index) in typeprestations" :key="typeprestation.id">
                            <td class="align-middle">{{ typeprestation.libelletypeprestation}}</td>
                            <td class="align-middle">
                                <button @click.prevent="edit(typeprestation)" class="btn btn-warning btn-sm" style="width:30px;"><i class="fa fa-edit"></i></button>
                                <button @click.prevent="destroy(typeprestation)" class="btn btn-danger btn-sm" style="width:30px;"><i class="fa fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" style="margin-top: 5px;" id="typeprestation-store" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 v-if="!isEditing" class="title largeModalLabel">Création d'un type de prestation</h4>
                        <h4 v-if="isEditing" class="title largeModalLabel">Modifier un type de prestation</h4>
                        <button type="button" class="close" @click.prevent="resetForm" aria-label="Fermer" :disabled="loading">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nom du type</label>
                                    <input type="text" v-model="form.libelletypeprestation" class="form-control" placeholder="Entrer le type" />
                                    <span class="text-danger" v-if="getErrors.libelletypeprestation">
                                        {{ getErrors.libelletypeprestation[0] }}
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
                queryOptions: [{field: 'libelletypeprestation', value: 'Type de prestation'}],
                queryFiled: 'libelletypeprestation',
                query:'',
                typeprestations: [],
                form:{libelletypeprestation: '',idtypeprestation: ''},
                pagination:{current_page: 1},
                loading: false,
                isEditing:false,
            }
        },
        mounted() {
            this.fetchTypePrestations();
        },
        methods: {
            fetchTypePrestations(){
                axios.get('/typeprestations/?page='+this.pagination.current_page).then(response => {
                    this.typeprestations = response.data.data;
                    this.pagination = response.data.meta;
                }).catch(error => {
                    this.toast(error);
                })
            },
            searchTypePrestation(){
                if (this.query == ''){
                    toastr['warning']('Le champ rechercher est requit!', 'Oops', {timeOut: 5000, closeButton: true});
                } else {
                    this.$Progress.start();
                    axios.get('/typeprestations/search/'+this.queryFiled+'/'+this.query+'?page='+this.pagination.current_page).then(response => {
                        this.typeprestations = response.data.data;
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
                    url = '/typeprestations/nouveau';
                }else {
                    url = '/typeprestations/'+this.form.idtypeprestation+'/edition';
                }
                this.loading = true;
                this.errors = [];
                axios.post(url, this.form).then(response => {
                    this.resetForm();
                    toastr['success'](this.isEditing ? "Le type de prestation a bien été créé" : "Le chemin a bien été mis à jour", '', {timeOut: 5000, closeButton: true});
                    this.loading = false;
                    this.isEditing = false;
                    this.fetchTypePrestations();
                }).catch(error => {
                    this.loading = false;
                    this.toast(error);
                });
            },
            edit(prestation){
                this.isEditing = true;
                this.form = prestation;
                $('#typeprestation-store').appendTo('body').modal('show');
            },
            reload() {
                this.query = '';
                this.queryFiled = 'name';
                this.$Progress.start();
                this.fetchTypePrestations();
                this.$Progress.finish();
            },
            create(){
                $('#typeprestation-store').appendTo('body').modal('show');
            },
            destroy(typeprestation){
                swal({
                    title: "Êtes-vous sûr?",
                    text: "Vous ne pourrez pas récupérer ce type de prestation après supression!",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }, () => {
                    axios.get('/typeprestations/'+typeprestation.idtypeprestation+'/supression').then(response => {
                        this.fetchTypePrestations();
                        toastr['success']("Le type de prestation a bien été supprimé", '', {timeOut: 5000, closeButton: true});
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
                this.fetchTypePrestations();
                this.form.idtypeprestation = '';
                this.form.libelletypeprestation = '';
                $('#typeprestation-store').modal('hide');
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
