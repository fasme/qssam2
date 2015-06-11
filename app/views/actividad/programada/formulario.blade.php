@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Actividad Programada
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->


     @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif


<div class="row">
  <div class="col-xs-12">

           <?php
  // si existe el usuario carga los datos
    if ($actividadprogramada->exists):
        $form_data = array('url' => 'actividadprogramada/update/'.$actividadprogramada->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'actividadprogramada/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
            <div class="form-group">
            {{Form::label('Elemento Estrategico', 'Elemento Estrategico',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('elementoestrategico', $actividadprogramada->elementoestrategico)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Cumplimiento Normativo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('cumplimientonormativo', $actividadprogramada->cumplimientonormativo)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Numero',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('numero', $actividadprogramada->numero)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Requisito',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('requisito', $actividadprogramada->requisito)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Actividad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::textarea('actividad', $actividadprogramada->actividad)}}
            </div>

            <?php
                              $array = ActividadProgramada::find($actividadprogramada->id);
                              $arrayName = "";
                              if(count($array) >0)
                              {

                              foreach ($array->muchaspersonal as $key) {
                               echo $arrayName[] = $key->id;
                               
                              }
                            }

                              ?>

                              <div class="form-group">
                              {{Form::label('', 'Personal',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('personal_id[]', $personals, $arrayName, array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>

             <div class="form-group">
            {{Form::label('', 'Plazo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('frecuencia', date_format(date_create($actividadprogramada->frecuencia),'d/m/Y'), array("class"=>"date-picker", "id"=>"id-date-picker-1", "data-date-format"=>"dd/mm/yyyy"))}}
            </div>

            



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   
$(".chosen-select").chosen();

$( "#actividadprogramadaactive" ).addClass( "active" );


$('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

   
  });   
</script>

@stop


