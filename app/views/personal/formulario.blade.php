@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Personal
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
    if ($personal->exists):
        $form_data = array('url' => 'personal/update/'.$personal->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'personal/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

             <div class="form-group">
            {{Form::label('', 'Cargo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('cargo_id', $cargo, $personal->cargo_id)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $personal->nombre)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Rut',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('rut', $personal->rut)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Fono',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('fono', $personal->fono)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Correo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('correo', $personal->correo)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Perfil',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('perfil', array("usuario"=>"usuario", "admin"=>"admin"), $personal->perfil)}}
            </div>



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');


$( "#personalactive" ).addClass( "active" );
    
  });   
</script>

@stop


