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
    //if ($curso->exists):
        $form_data = array('url' => 'curso/asignar/'.$curso->id);
      //  $action    = 'Editar';
    //else:
      //  $form_data = array('url' => 'curso/insert', 'class'=>'class="form-horizontal');
       // $action    = 'Crear';        
    //endif;

?>


{{ Form::open($form_data) }}
       
       {{Form::hidden('curso_id',$curso->id)}}
            
           <div class="form-group">
            {{Form::label('Nombre', 'Contenido',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $curso->nombre, array("readonly"=>"readonly"))}}
            </div>
           

           <div class="form-group">
            {{Form::label('Personal', 'Personal',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('personal_id[]', $personals, "", array("class"=>"chosen-select", "multiple"=>"multiple"))}}
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

$(".chosen-select").chosen();
  });   
</script>

@stop


