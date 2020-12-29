@extends('layout.app')

@section('content')
<div class="container-fluid">
        <div class="header">
            <h4><strong>Gestion des Produits</strong></h4>
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
               
                <button type="button" class="btn  btn-primary mb-4 float-right"  data-toggle="modal" data-target="#myModal1"  >Ajouter un Produit <i class="fa fa-user-cog"></i></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Gamme</th>
                            <th>Désignation</th>
                            <th>Qte Stock</th>
                            <th>Seuil</th>
                            <th>Emplacement</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center"sd>
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
                        <h4  class="title largeModalLabel">Création d'un Produit</h4>
                        <button type="button" class="close"  aria-label="Fermer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gamme</label>
                                    <select  class="form-control">
                                        <option value="">Selectionnez...</option>
                                        @foreach($data1 as $data1)
                                        
                                        <option value="{{ $data1->id }}">{{ $data1->libelle }}</option>
                                    @endforeach
                                    </select>

                                    
                                 
                                    <span class="text-danger" >
                                    
                                    </span>
                                </div>
                            </div>

                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text"  class="form-control" placeholder="Entrer la designation" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>


                        </div>

                        <div class="row clearfix">
            
                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Seuil-Alerte</label>
                                    <input type="text"  class="form-control" placeholder="Entrer le seuil" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Qte-stock</label>
                                    <input type="text"  class="form-control" placeholder="0"  readonly="yes"/>
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix mt-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Emplacement</label>
                                    <input type="text"  class="form-control" placeholder="Entrer l'emplacement" />
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
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
