@extends('portal.layouts')

@section('contenido')

<body class="homepage">
<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Mis Actividades</h2>
             </div>

            <div class="row">
            @if (Auth::check())

<?php
//$actividadProgramadas = ActividadProgramada::all();
$personal = Personal::find(Auth::user()->id);

$actividadresponsable = DB::table('actividad_responsable_noprogramada')->Where("personal_id","=",Auth::user()->id)->get();
//$actividadresponsable_kpi = DB::table('actividad_responsable_kpi')->Where("personal_id","=",Auth::user()->id)->get();
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->Where("personal_id","=",Auth::user()->id)->get();

//$actividadresponsable_pac = DB::table('actividad_responsable_pac')->Where("personal_id","=",Auth::user()->id)->get();
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->Where("personal_id","=",Auth::user()->id)->get();

//print_r($actividadresponsable);
?>



 <table id="example" class="table table-striped table-bordered table-hover">

                        <thead>
                          <tr>
                            
                           
                            <th class="hidden-480">Actividad</th>
                            <th>Tipo</th>
                             <th>Estado</th>
                            <th>Plazo</th>

                            <th>
                              <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                              Subir Evidencia
                            </th>
                            

                           
                          </tr>
                        </thead>

                        <tbody>

                        
                         @foreach($actividadresponsable as $actividad)
                          <tr>
                        
                           <?php
                           
                            
                             
                            $busqueda = "";
                            ?>

                          <?php
                             $busqueda = ActividadNoProgramada::find($actividad->actividad_id);
                            ?>
                            


                            <?php

                            $datetime1 = new DateTime($busqueda->frecuencia);
                            $datetime2 = new DateTime(date("Y/m/d"));
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>(". $interval->format('Atrasado %a')." Dias)</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>(". $interval->format('Faltan %a')." Dias)</font>";
                            }

                            if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }

                            ?>
                            <td>{{$busqueda->actividad}}</td>
                            
                            
                            
                            <td>{{$actividad->tipoactividad}}</td>
                            <td>{{$actividad->estado}}</td>
                            <td>{{date_format(date_create($busqueda->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            
                            <td>
                            @if($actividad->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad->id}}" data-actividadid="{{$actividad->actividad_id}}" data-tipoactividad="{{$actividad->tipoactividad}}" href="#" >
                                  <i class="ace-icon fa fa-upload bigger-130"></i>
                                </a>
                              </div>
                              @else

                              <a href="archivos/evidencia/{{ $actividad->adjunto1}}">{{$actividad->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto2}}">{{$actividad->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto3}}">{{$actividad->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto4}}">{{$actividad->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto5}}">{{$actividad->adjunto5}}</a><br>

                              @endif
                              </td>
                           
                            </tr>

                            @endforeach








                             @foreach(Kpi::all() as $actividad)
                                  @foreach($actividad->muchaspersonal()->where("personal_id","=",Auth::user()->id)->get() as $actividad2)
                                

                                 
                              <?php
                           $busqueda = "";
                            ?>

                            
                            <?php
                            //$busqueda = ActividadKpi::find($actividad->actividad_id);
                              ?>
                           

                         
                            
                          <tr>
                            
                        
                           <?php
                            $datetime1 = new DateTime($actividad->frecuencia);
                            $datetime2 = new DateTime(date("Y/m/d"));
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>(". $interval->format('%R%a')." Dias)</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>(". $interval->format('%R%a')." Dias)</font>";
                            }

                             if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }
                             
                            ?>

                            <td>{{ $actividad2->pivot->actividad}}</td>
                            <td>{{"KPI"}}</td>
                            <td>{{$actividad2->pivot->estado}}</td>
                            

                          
                            <td>{{date_format(date_create($actividad2->pivot->frecuencia),"d/m/Y")}} {{$dif}}</td>
                             <td>
                            @if($actividad2->pivot->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad2->pivot->id}}" data-actividadid="{{$actividad2->pivot->kpi_id}}" data-tipoactividad="kpi" href="#" >
                                  <i class="ace-icon fa fa-upload bigger-130"></i>
                                </a>
                              </div>
                              @else

                              <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto1}}">{{$actividad2->pivot->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto2}}">{{$actividad2->pivot->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto3}}">{{$actividad2->pivot->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto4}}">{{$actividad2->pivot->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto5}}">{{$actividad2->pivot->adjunto5}}</a><br>

                              @endif
                              </td>
                            </tr>
                                @endforeach
                                  @endforeach





                            @foreach($actividadresponsable_programada as $actividad)
                          <tr>
                        
                           <?php
                           
                            
                             
                            $busqueda = "";
                            ?>

                            <?php 
                            $busqueda = ActividadProgramada::find($actividad->actividad_id);
                            ?>
                        


                            <?php

                            $datetime1 = new DateTime($actividad->frecuencia);
                            $datetime2 = new DateTime(date("Y/m/d"));
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>(". $interval->format('Atrasado %a')." Dias)</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>(". $interval->format('Faltan %a')." Dias)</font>";
                            }

                            if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }

                            ?>
                            <td>{{$busqueda->actividad}}</td>
                            
                            
                            
                            <td>{{$actividad->tipoactividad}}</td>
                            <td>{{$actividad->estado}}</td>
                            <td>{{date_format(date_create($actividad->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            
                            <td>
                            @if($actividad->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad->id}}" data-actividadid="{{$actividad->actividad_id}}" data-tipoactividad="{{$actividad->tipoactividad}}" href="#" >
                                  <i class="ace-icon fa fa-upload bigger-130"></i>
                                </a>
                              </div>
                              @else

                              <a href="archivos/evidencia/{{ $actividad->adjunto1}}">{{$actividad->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto2}}">{{$actividad->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto3}}">{{$actividad->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto4}}">{{$actividad->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto5}}">{{$actividad->adjunto5}}</a><br>

                              @endif
                              </td>
                           
                            </tr>

                            @endforeach




                            @foreach(Pac::all() as $actividad)
                                  @foreach($actividad->muchaspersonal()->where("personal_id","=",Auth::user()->id)->get() as $actividad2)
                                

                                 
                              <?php
                           $busqueda = "";
                            ?>

                            
                            <?php
                            //$busqueda = ActividadKpi::find($actividad->actividad_id);
                              ?>
                           

                         
                            
                          <tr>
                            
                        
                           <?php
                            $datetime1 = new DateTime($actividad->frecuencia);
                            $datetime2 = new DateTime(date("Y/m/d"));
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>(". $interval->format('%R%a')." Dias)</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>(". $interval->format('%R%a')." Dias)</font>";
                            }

                             if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }
                             
                            ?>

                            <td>{{ $actividad2->pivot->actividad}}</td>
                            <td>{{"Pac"}}</td>
                            <td>{{$actividad2->pivot->estado}}</td>
                            

                          
                            <td>{{date_format(date_create($actividad2->pivot->frecuencia),"d/m/Y")}} {{$dif}}</td>
                             <td>
                            @if($actividad2->pivot->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad2->pivot->id}}" data-actividadid="{{$actividad2->pivot->pac_id}}" data-tipoactividad="pac" href="#" >
                                  <i class="ace-icon fa fa-upload bigger-130"></i>
                                </a>
                              </div>
                              @else

                              <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto1}}">{{$actividad2->pivot->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto2}}">{{$actividad2->pivot->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto3}}">{{$actividad2->pivot->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto4}}">{{$actividad2->pivot->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto5}}">{{$actividad2->pivot->adjunto5}}</a><br>

                              @endif
                              </td>
                            </tr>
                                @endforeach
                                  @endforeach







                            @foreach($actividadresponsable_mantencion as $actividad)
                          <tr>
                        
                           <?php
                           
                            
                             
                            $busqueda = "";
                            ?>

                            
                            <?php 
                            $busqueda = Mantencion::find($actividad->actividad_id);
                            ?>
                            



                            <?php

                            $datetime1 = new DateTime($busqueda->frecuencia);
                            $datetime2 = new DateTime(date("Y/m/d"));
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>(". $interval->format('Atrasado %a')." Dias)</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>(". $interval->format('Faltan %a')." Dias)</font>";
                            }

                            if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }

                            ?>
                            <td>{{$busqueda->mantencionrealizada}}</td>
                            
                            
                            
                            <td>{{$actividad->tipoactividad}}</td>
                            <td>{{$actividad->estado}}</td>
                            <td>{{date_format(date_create($busqueda->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            
                            <td>
                            @if($actividad->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad2->pivot->id}}" data-actividadid="{{$actividad2->pivot->actividad_id}}" data-tipoactividad="kpi" href="#" >
                                  <i class="ace-icon fa fa-upload bigger-130"></i>
                                </a>
                              </div>
                              @else

                              <a href="archivos/evidencia/{{ $actividad->adjunto1}}">{{$actividad->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto2}}">{{$actividad->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto3}}">{{$actividad->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto4}}">{{$actividad->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto5}}">{{$actividad->adjunto5}}</a><br>

                              @endif
                              </td>
                           
                            </tr>

                            @endforeach
                            
                            </tbody>
                            </table>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

    










<!-- Modal -->
{{Form::open(array('url' => 'evidenciaupdate', 'files' => true))}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enviar Evidencia</h4>
      </div>
      <div class="modal-body">
      {{Form::hidden("actividadid","",array("id"=>"actividadid"))}}
      {{Form::hidden("id","",array("id"=>"id"))}}
      {{Form::hidden("tipoactividad","",array("id"=>"tipoactividad"))}}
      
      
      {{Form::label("Archivo 1")}}
      {{Form::file("adjunto1")}}

      {{Form::label("Archivo 2")}}
      {{Form::file("adjunto2")}}

      {{Form::label("Archivo 3")}}
      {{Form::file("adjunto3")}}

      {{Form::label("Archivo 4")}}
      {{Form::file("adjunto4")}}

      {{Form::label("Archivo 5")}}
      {{Form::file("adjunto5")}}
      </div>
      <div class="modal-footer">
    
        {{Form::submit("Enviar", array("class"=>"btn btn-primary"))}}
      </div>
    </div>
  </div>
</div>
{{Form::close()}}

</body>

    

  

    








    <script type="text/javascript">


 $(document).ready(function() {


  $( "#actividadactive" ).addClass( "active" );

var oTable1 = 
        $('#example')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "datatables.spanish.json"
            }
        });



var oTable1 = 
        $('#example1')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "datatables.spanish.json"
            }
        });


        var oTable1 = 
        $('#example2')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "datatables.spanish.json"
            }
        });


$(".botoncito").click(function(){

  var id = $(this).data('id');
  var actividadid = $(this).data('actividadid');
  var tipoactividad = $(this).data('tipoactividad');

  $("#actividadid").val(actividadid);
  $("#id").val(id);
  $("#tipoactividad").val(tipoactividad);
  //alert(id);
  $('#myModal').modal("show");
});


});
 </script>

@stop