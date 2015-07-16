@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Curso: 
                    <a href="{{URL::to('curso/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>
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
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Lugar</th>
            <th>Relator</th>
            <th>otec</th>
            <th>duracion</th>
            
              
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($cursos as $curso)
           <tr>

             <td> {{ $curso->nombre}}</td>
             
             <td>{{date_format(date_create($curso->fecha),'d/m/Y')}}</td>
             <td> {{ $curso->lugar}}</td>
             <td> {{ $curso->relator}}</td>
             <td> {{ $curso->otec}}</td>
             <td> {{ $curso->duracion}}</td>
         

  <td class="td-actions">
                       
                      


                          <a class="green" href= {{ 'curso/update/'.$curso->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $curso->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                          <a class="green" href={{'curso/asignar/'.$curso->id}}>
                          <span class="label label-white middle">Asignar Personal</span>
                          </a>

                          <a class="red" href={{'curso/cerrar/'.$curso->id}}>
                          <span class="label label-white middle">Cerrar Curso</span>
                          </a>
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>





































<div class="col-xs-12">

                    <h3 class="header smaller lighter">Asignaciones: 
                   
    </h3>



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                      Resultados
                    </div>
        
 
<table id="example2" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Curso</th>
            <th>Personal</th>
           
              
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($cursos as $curso)
    @foreach($curso->muchaspersonal()->get() as $personal)
           <tr>

             <td> {{ $curso->nombre}}</td>
              <td> {{ $personal->nombre}}</td>
             

  <td class="td-actions">
                       
                      



                         <a class="red bootbox-confirm2" data-cursoid="{{ $curso->id }}" data-personalid="{{$personal->id}}">
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                         
                      </td>
</tr>
          @endforeach
          @endforeach
        </tbody>
  </table>

  </div>


  <script type="text/javascript">
 $(document).ready(function() {


$('#example').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );


$('#example2').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );

$( "#capacitacionactive" ).addClass( "active" );
$( "#cursoactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('curso/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });




$(".bootbox-confirm2").on(ace.click_event, function() {
  var cursoid = $(this).data('cursoid');
  var personalid = $(this).data("personalid");
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro ", function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('curso/eliminarasignacion')}}",
              { cursoid: cursoid, personalid: personalid },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });




$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('curso/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop

