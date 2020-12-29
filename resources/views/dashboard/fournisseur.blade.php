@extends('layout.app')

@section('content')
<div class="container-fluid">
        <div class="header">
            <h4><strong>Gestion des Fournisseurs</strong></h4>
        </div>
        <div class="row bg-white">
            <div class="col-sm-2 mt-2">
                <strong class="">Recherche : </strong>
            </div>
            <div class="col-sm-3">
                <select  class="form-control">
                    <option></option>
                </select>
            </div>

            <div class="col-sm-7">
                <div class="form-group">
                    <div class="input-group mb-0">
                        <input  type="text" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <span class="input-group-text" ><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>

   <div class="row bg-white mt-4 mb-4">
            <div class="col-sm-12">
               
                <button type="button" class="btn  btn-primary mb-4 float-right"  data-toggle="modal" data-target="#myModal1"  >Ajouter un Fournisseur <i class="fa fa-user-cog"></i></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>RCCM</th>
                            <th>NIF</th>
                            <th>N°du compte</th>
                            <th>Date_entree</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center"sd>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle">
                                <button  class="btn btn-warning btn-sm" style="width:30px;"><i class="fa fa-edit"></i></button>
                                <button  class="btn btn-danger btn-sm" style="width:30px;"><i class="fa fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
      <div  id="myModal1" class="modal fade" style="margin-top: 5px;" id="" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4  class="title largeModalLabel">Création d'un Fournisseur</h4>
                        <button type="button" class="close"  aria-label="Fermer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="row clearfix">
                             <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text"  class="form-control" placeholder="Entrer le nom" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="text"  class="form-control" placeholder="Entrer le numero de téléphone" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Adresse</label>
                                    <input type="text"  class="form-control" placeholder="Entrer l'adresse" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>


                        </div>
                        
                        <div class="row clearfix">
                             <div class="col-sm-4">
                                <div class="form-group">
                                    <label>RCCM</label>
                                    <input type="text"  class="form-control" placeholder="Entrer le RCCM" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>NIF</label>
                                    <input type="text"  class="form-control" placeholder="Entrer le NIF" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>N° du compte</label>
                                    <input type="text"  class="form-control" placeholder="Entrer le numero du compte" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>


                        </div>
                        <div class="row clearfix">
            
                             <div class="form-group">
                                    <label>Date_entree</label>
                                    <input type="date"  class="form-control" placeholder="Entrer la date" />
                                    <span class="text-danger" >
                                    </span>
                                </div>

                        
                        </div>

                    
                    </div>
                    <div class="modal-footer">
                       
                        <button  type="button" class="btn btn-default btn-round btn-success" >
                            <template >SAUVEGARDER</template>
                            
                        </button>
                        <button class="btn btn-default btn-warning float-right" data-dismiss="modal">ANNULER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type='jQuery'>

$('#myModal1').on('show.bs.modal', function (event) {

 var $ = jQuery;
});



</script>

      
@endsection
