@extends('portal.layouts')

@section('contenido')

<body class="homepage">
<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Entrada/Salida</h2>
             </div>

            <div class="row">
            @if (Auth::check())



  <?php

        $form_data = array('url' => 'productotransaccion/insert', 'class'=>'class="form-horizontal', 'files'=>true);
        
        $bodegas = Bodega::lists("nombre","id");
        $productos = Producto::lists("nombre","id");
?>

<div class="well">
{{ Form::open($form_data) }}
            

            <div class="form-group">
            {{Form::label('Bodega', 'Bodega',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('bodega_id',$bodegas, "",  array("class"=>"chosen-select col-sm-3", "id"=>"bodegaid"))}}
            </div>

        <!--    <div class="form-group">
            {{Form::label('Producto', 'Producto',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('producto_id',$productos, "",  array("class"=>"chosen-select col-sm-3"))}}
            </div>
-->


           <div class="form-group">
            {{Form::label('', 'Tipo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('tipo', array(""=>"--Seleccione--",1=>"Entrada",2=>"Salida"),"", array("id"=>"tipo") )}}
            </div>


             <div id="divocultoentrada">
              <div class="form-group">
              {{Form::label('', 'Documento',array("class"=>"col-sm-3 control-label no-padding-right"))}}
              {{Form::select('documento', array(1=>"Factura"),"" )}}
              </div>
              <div class="form-group">
              {{Form::label('', 'Proveedor/Empresa',array("class"=>"col-sm-3 control-label no-padding-right"))}}
              {{Form::text('origendestino',"" )}}
              </div>

            </div>

            <div id="divocultosalida">
              <div class="form-group">
              {{Form::label('', 'Documento',array("class"=>"col-sm-3 control-label no-padding-right"))}}
              {{Form::select('documento', array(2=>"Guia"),"" )}}
              </div>
              <div class="form-group">
              {{Form::label('', 'Destino',array("class"=>"col-sm-3 control-label no-padding-right"))}}
              {{Form::text('origendestino',"" )}}
              </div>
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



@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

    




</body>


  

    








    <script type="text/javascript">

  $(document).ready(function(){
   


$( "#productotransaccionactive" ).addClass( "active" );
$('.chosen-select').chosen(); 


$("#divocultoentrada").hide();
$("#divocultosalida").hide();

//$("#divocultoentrada").hide();
//$("#divocultosalida").hide();

$("#tipo").change(function(){ 
  if($("#tipo").val() == 1) // entrada
  {
    $("#divocultoentrada").show();
    $("#divocultosalida").hide();
    $("#divocultoentrada").find("input,select,textarea,button").prop('disabled',false);
    $("#divocultosalida").find("input,select,textarea,button").prop('disabled',true);

  }
  if($("#tipo").val() == 2) // entrada
  {
    $("#divocultosalida").show();
    $("#divocultoentrada").hide();
    $("#divocultosalida").find("input,select,textarea,button").prop('disabled',false);
    $("#divocultoentrada").find("input,select,textarea,button").prop('disabled',true);
  }
});


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

            $(contenedor).after('<div>{{Form::select("producto_id[]",$productos,"",array("class"=>"chosen-select col-sm-3", "id"=>"productos"))}}{{Form::text("cantidad[]","",array("placeholder"=>"Cantidad", "id"=>"cantidad"))}}{{Form::text("stock","",array("id"=>"stock", "readonly"=>"readonly"))}}<a href="#" class="eliminar">&times;</a></div>');
            x++; //text box increment
           

           $("#productos").change(function(){
            var productoid = $("#productos").val();
            var bodegaid = $("#bodegaid").val();

                $.get("{{ url('bodega/stock')}}",
                  { productoid: productoid, bodegaid: bodegaid },
                  function(data)
                  { 
                    $("#cantidad").focus();
                    $("#stock").val(data);
                   // alert(data);
                    //bootbox.dialog({message: data});
                   

                  });
      
    });

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



