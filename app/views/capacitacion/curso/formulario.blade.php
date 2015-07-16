@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Curso
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
    if ($curso->exists):
        $form_data = array('url' => 'curso/update/'.$curso->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'curso/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
            <div class="form-group">
            {{Form::label('Nombre', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $curso->nombre)}}
            </div>

          <div class="form-group">
            {{Form::label('', 'Fecha',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('fecha', date_format(date_create($curso->fecha),'d/m/Y'), array("class"=>"date-picker", "id"=>"id-date-picker-1", "data-date-format"=>"dd/mm/yyyy"))}}
            </div>

           <div class="form-group">
            {{Form::label('Nombre', 'Lugar',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('lugar', $curso->lugar)}}
            </div>
           
           <div class="form-group">
            {{Form::label('Nombre', 'Relator',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('relator', $curso->relator)}}
            </div>
           

           <div class="form-group">
            {{Form::label('Nombre', 'Otec',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('otec', $curso->otec)}}
            </div>
           
           <div class="form-group">
            {{Form::label('Nombre', 'Duracion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('duracion', $curso->duracion)}}
            </div>
           
           <div class="form-group">
            {{Form::label('Nombre', 'Contenido',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::textarea('contenido', $curso->contenido)}}
            </div>
           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   
$('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });

$( "#cursoactive" ).addClass( "active" );
    
  });   
</script>

@stop


