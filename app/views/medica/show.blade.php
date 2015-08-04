@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Atencion Medica: 
                    <a href="{{URL::to('medica/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>
    </h3>



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                      Resultados
                    </div>
        
 
<table id="example" class="table table-striped table-bordered table-hover">
<div class="info"></div>
  <thead>
          <tr>
            <th>Nombre</th>
            <th>Tratamiento</th>
            <th>Diagnostico</th>
            <th>Edad</th>
            <th>Proyecto</th>
            <th>Clasificacion</th>
            <th>Comuna</th>
            <th>Fecha</th>
            <th>Dia Turno</th>
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($medicas as $medica)
           <tr>

             <td> {{ $medica->personal->nombre}}</td>
             <td>{{$medica->tratamiento}}</td>
             <td>{{$medica->diagnostico}}</td>
             <td>{{$medica->edad}}</td>
             <td>{{$medica->domicilio}}</td>
              <td>{{$medica->clasificacion}}</td>
              <td>{{$medica->comuna}}</td>
              <td>{{ date_format(date_create($medica->fecha), 'd/m/Y')}}
         
              <td>{{$medica->diaturno}}</td>

  <td class="td-actions">
                       
                      
                          <a class="blue bootbox-mostrar" data-id={{$medica->id}}>
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>


                          <a class="green" href= {{ 'medica/update/'.$medica->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $medica->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>


  <script type="text/javascript">
 $(document).ready(function() {


var table = $('#example').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );


var tableTools = new $.fn.dataTable.TableTools( table, {
  

    
      "aButtons": [
                   {
                        "sExtends": "pdf",
                        "sButtonText":"Listado pdf",
                        "sTitle": "Atencion Medica",
                        //"sPdfMessage": "Summary Info",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},
                        "mColumns": [ 0, 1,2,3,4,5,6 ]

                    }

                ]
      
    } );


$( tableTools.fnContainer() ).insertAfter('div.info');



$( "#medicaactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('medica/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });





$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('medica/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop

