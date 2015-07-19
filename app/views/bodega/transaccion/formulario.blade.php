@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Entrada/Salida
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
            {{Form::label('Bodega', 'Bodega',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('bodega_id',$bodegas, "",  array("class"=>"chosen-select col-sm-3"))}}
            </div>

        <!--    <div class="form-group">
            {{Form::label('Producto', 'Producto',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('producto_id',$productos, "",  array("class"=>"chosen-select col-sm-3"))}}
            </div>
-->


            <div class="form-group">
            {{Form::label('', 'Tipo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('tipo', array(1=>"Entrada",2=>"Salida", 5=>"A Mantencion"),"" )}}
            </div>

<!--
            <div class="form-group">
            {{Form::label('', 'Cantidad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('cantidad',"")}}
            </div>
-->
            <div class="form-group">
            {{Form::label('', 'Documento',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('documento', array(1=>"Factura",2=>"Guia"),"" )}}
            </div>


             <div class="form-group">
            {{Form::label('', 'Num Documento',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('numdocumento',"")}}
            </div>





            
         
         <div class="row">
  <div class="col-xs-12">
            <a id="agregarCampo" class="btn btn-info" href="#">Agregar Producto</a>
        <div id="contenedor">

</div>
  </div>
</div>

     
           
         
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   


$( "#productotransaccionactive" ).addClass( "active" );
$('.chosen-select').chosen(); 




var MaxInputs       = 20; //Número Maximo de Campos
    var contenedor       = $("#contenedor"); //ID del contenedor
    var AddButton       = $("#agregarCampo"); //ID del Botón Agregar

    //var x = número de campos existentes en el contenedor
    var x = $("#contenedor div").length + 1;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            //agregar campo

            $(contenedor).after('<div>{{Form::select("producto_id[]",$productos,"",array("class"=>"chosen-select col-sm-3"))}}{{Form::text("cantidad[]","",array("placeholder"=>"Cantidad"))}}<a href="#" class="eliminar">&times;</a></div>');
            x++; //text box increment
           

           /* $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });
*/

   $('.chosen-select').chosen(); 

            //$("#plazo").addClass("date-picker");

        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
    
  });   
</script>

@stop


