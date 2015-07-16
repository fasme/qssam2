@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Cerrar Curso {{$curso->nombre}}: 
    </h3>



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    
        
{{ Form::open(array('url' => 'curso/cerrar/'.$curso->id)) }}
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Nombre</th>
            <th>Rut</th>
            <th>Asistencia</th>
            <th>Aprobaado</th>
            <th>Observacion</th>
            
        
            
          </tr>
        </thead>
        <tbody>


  @foreach($curso->muchaspersonal()->get() as $personal)
           <tr>

             <td> {{ $personal->nombre}}</td>
             
             <td>{{ $personal->rut}}</td>
             <td> {{ Form::select("asistencia[]", array("si"=>"si", "no"=>"no"))}}</td>
             <td> {{ Form::select("aprobado[]", array("si"=>"si", "no"=>"no"))}}</td>
             <td> {{ Form::text("observacion[]","")}}</td>
           
         


</tr>
          @endforeach
        </tbody>
  </table>

{{Form::submit('Cerrar', array('class'=>'btn btn-small btn-success'))}}
{{Form::close()}}

  </div>







































  <script type="text/javascript">
 $(document).ready(function() {



$( "#capacitacionactive" ).addClass( "active" );
$( "#cursoactive" ).addClass( "active" );




         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop

