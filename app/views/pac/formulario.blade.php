@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Plan de Accion
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
    if ($pac->exists):
        $form_data = array('url' => 'pac/update/'.$pac->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'pac/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

             <div class="form-group">
            {{Form::label('', 'Faena',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('faena', $pac->faena)}}
            </div>

            <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                {{Form::label('', 'OHSAS 18001',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
            <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'ISO 9001',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
             <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'ISO 14001',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
            </div>



<div class="row">
             <div class="col-xs-4">
                <div class="form-group">
                {{Form::label('', 'Aud. Interna',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
            <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'Aud. Externa',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
             <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'Rev. Gerencial ',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
</div>



<div class="row">
             <div class="col-xs-4">
                <div class="form-group">
                {{Form::label('', 'Recl. Cliente',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
            <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'Inspecciones',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
             <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'Legal',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
</div>


<div class="row">
             <div class="col-xs-4">
                <div class="form-group">
                {{Form::label('', 'NC',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
            <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'OBS',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
             <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'OM',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('faena', $pac->faena)}}
                </div>
            </div>
</div>


<div class="row">
<div class="col-xs-12">
    <div class="form-group">
    {{Form::label('', 'NO CONFORMIDAD N°1: IDENTIFICACIÓN DE PELIGROS Y ASPECTOS',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('faena', $pac->faena,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', 'Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('faena', $pac->faena,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', 'Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('faena', $pac->faena,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', 'Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('faena', $pac->faena,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', 'Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('faena', $pac->faena,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', 'Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('faena', $pac->faena,['size' => '60x2'])}}
    </div>
</div>
</div>
          





           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   



$( "#actividadactive" ).addClass( "active" );
$( "#noprogramadaactive" ).addClass( "active" );


$(".chosen-select").chosen();

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


