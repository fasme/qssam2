@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Matriz: 
                    <a href="{{URL::to('matriz/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>

    <a href="{{URL::to('matriz/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-file-pdf-o bigger-120 red"></i>Pdf</a>
    </h3>



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                      Resultados
                    </div>
        
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Proceso</th>
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($matrizs as $matriz)
           <tr>

             <td> {{ $matriz->proceso}}</td>
         

  <td class="td-actions">
                       
                      
                          <a class="blue bootbox-mostrar" data-id={{$matriz->id}}>
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>


                          <a class="green" href= {{ 'matriz/update/'.$matriz->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $matriz->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>


                          <a class="blue" href= {{ 'matriz/update/'.$matriz->id }}>
                            <i class="fa fa-print bigger-130"></i>
                          </a>
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>



<!-- CARGO -->


  <script type="text/javascript">
 $(document).ready(function() {


$('#example').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );




$( "#bibliotecaactive" ).addClass( "active" );
$( "#matrizactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('matriz/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('matriz/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop

