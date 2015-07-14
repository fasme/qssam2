@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Producto
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

        $form_data = array('url' => 'productotransaccion/insert', 'class'=>'class="form-horizontal', 'files'=>true);
        

?>


{{ Form::open($form_data) }}
            

            <div class="form-group">
            {{Form::label('Bodega', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('bodega_id',$bodegas, "",  array("class"=>"chosen-select col-sm-3"))}}
            </div>

            <div class="form-group">
            {{Form::label('Producto', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('producto_id',$productos, "",  array("class"=>"chosen-select col-sm-3"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Tipo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('tipo', array(1=>"Entrada",2=>"Salida"),"" )}}
            </div>


            <div class="form-group">
            {{Form::label('', 'Cantidad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('cantidad',"")}}
            </div>




            
         

     
           
         
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   


$( "#productotransaccionactive" ).addClass( "active" );
$('.chosen-select').chosen(); 
    
  });   
</script>

@stop


