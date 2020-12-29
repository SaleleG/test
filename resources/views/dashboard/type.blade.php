@extends('layout.app')

@section('content')
 <script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>
<div class="container-fluid">
        <div class="header">
            <h4><strong>Gestion des Gammes</strong></h4>
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

           
        </div>

   <div class="row bg-white mt-4 mb-4">
            <div class="col-sm-12">
               
                <button type="button" class="btn  btn-primary mb-4 float-right"  data-toggle="modal" data-target="#myModal1"  >Ajouter une Gamme <i class="fa fa-user-cog"></i></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Libelle</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                         @foreach ($data as $value) 
                        <tr class="text-center"sd>
                            <td class="align-middle">{{ $value->libelle}}</td>
                            <td class="align-middle">
                                <button  class="btn btn-warning btn-sm" style="width:30px;"><i class="fa fa-edit"></i></button>
                                <button  class="btn btn-danger btn-sm" style="width:30px;"><i class="fa fa-trash-alt"></i></button>
                            </td>
                        </tr>
                       @endforeach
                        </tbody>
                    </table>
                    
                </div>
                <div class="position:center text-center">
              			{!! $data->links() !!}
              	</div>
            </div>
        </div>
      
      <div  id="myModal1" class="modal fade" style="margin-top: 5px;" id="" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
              <form class="form-horizontal" method="POST" action="{{route('store-gamme') }}">
            	{{ csrf_field() }}
                    <div class="modal-header mb-4">
                        <h4  class="title largeModalLabel">Création d'une Gamme de Produit</h4>
                        <button type="button" class="close"  aria-label="Fermer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       
                        <div class="row clearfix mt-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Libelle</label>
                                    <input type="text" id='libelle' name='libelle' class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" value="{{ old('libelle') }}" placeholder="Entre le libelle" autocomplete="off">
                    	{!! $errors->first('libelle', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" >
                                        
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                       
                        <button  type="submit" class="btn btn-default btn-round btn-success" >
                            <template >SAUVEGARDER</template>
                            
                        </button>
                        <button class="btn btn-default btn-warning float-right" data-dismiss="modal">ANNULER</button>
                    </div>
                </div>
             </form>
            </div>
        </div>
    </div>
<script type='jQuery'>

$('#myModal1').on('show.bs.modal', function (event) {

 var $ = jQuery;
});



</script>

      
@endsection
