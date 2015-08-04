@extends('portal.layouts')

@section('contenido')

<body class="homepage">
<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Prestamos</h2>
             </div>

            <div class="row">
            @if (Auth::check())



  <?php

        $form_data = array('url' => 'prestamo/insert', 'class'=>'class="form-horizontal', 'files'=>true);
        
        $bodegas = Bodega::lists("nombre","id");
        $productos = Producto::lists("nombre","id");
        $personals = Personal::lists("nombre","id");
?>

<div class="well">
{{ Form::open($form_data) }}
            

            <div class="form-group">
            {{Form::label('Bodega', 'Bodega',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('bodega_id',$bodegas, "",  array("class"=>"chosen-select col-sm-3", "id"=>"bodegaid"))}}
            </div>

            

            <div class="form-group">
            {{Form::label('Producto', 'Personal',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('personal_id',$personals, "",  array("class"=>"chosen-select col-sm-3"))}}
            </div>

          <!--  <div class="form-group">
            {{Form::label('Producto', 'Producto',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('producto_id',$productos, "",  array("class"=>"chosen-select col-sm-3"))}}
            </div>
-->


            <div class="form-group">
            {{Form::label('', 'Tipo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('tipo', array(3=>"Prestamo"),"" )}}
            </div>


         <!--   <div class="form-group">
            {{Form::label('', 'Cantidad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('cantidad',"")}}
            </div>
            -->



            <div class="row">
  <div class="col-xs-12">
 

 


 

            <a id="agregarCampo" class="btn btn-info" href="#">Agregar Producto</a>
        <div id="contenedor">
           

        

</div>
  </div>
</div>




            
         

     
           
         
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}
</div> <!-- fin well -->



 <div class="center wow fadeInDown">
                <h2>Devoluciones</h2>
             </div>

<div class="well">



<table id="example" class="table table-striped table-bordered table-hover">
<div class="info"></div>
  <thead>
          <tr>
          <th>Bodega</th>
          <th>Producto</th>
          <th>Personal</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                           
          
 
            
          </tr>
        </thead>



        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                
              
            </tr>
        </tfoot>


        <tbody>

<?php
$prestamos = DB::table("bodega_producto")
        ->join('prestamo', 'bodega_producto.id', '=', 'prestamo.bodega_producto_id')
        ->get();
?>
  @foreach($prestamos as $prestamo)

           <tr>
           <td>{{Bodega::find($prestamo->bodega_id)->nombre}}</td>
           <td>{{ Producto::find($prestamo->producto_id)->nombre}}</td>
           <td>{{Personal::find($prestamo->personal_id)->nombre}}</td>
           <td>{{$prestamo->cantidad}}</td>
           <td>
           @if($prestamo->cantidad != 0) {{"Prestamo"}}  <a class="red bootbox-confirm" data-id={{ $prestamo->bodega_producto_id }}>
                             <span class="label label-success arrowed">Devolver</span>
                          </a> @endif
           @if($prestamo->tipo == 0) {{"Entregado"}} @endif
           </td>
</tr>
    @endforeach
        </tbody>
  </table>

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



var table = $('#example').DataTable( {
      
       

         "language": {
                
               "infoEmpty": "Vacio",
                "info": "Mostrando Resultados _PAGE_ of _PAGES_",
                "lengthMenu": "Mostrar _MENU_ Registros",
                "search": "Buscar:",
                "paginate": {
                  "next": "Siguiente",
                  "previous": "Anterior"
                }
            },
            

    } );





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






$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
          bootbox.prompt("Cantidad a Devolver", function(result) {
            if(result){
            
            $.get("{{ url('prestamo/devolver')}}",
              { id: id, cantidad:result },

              function(data,status){ location.reload(); 
              }
).fail(function(data)
{bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");
});
}

     
            });
        });






    
  });   
</script>

@stop



