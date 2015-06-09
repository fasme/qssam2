@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Categoria
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

             <div class="form-group">
            {{Form::label('', 'Plazo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('frecuencia', $actividadprogramada->frecuencia)}}
            </div>



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');


$( "#actividadprogramadaactive" ).addClass( "active" );
    
  });   
</script>

@stop


