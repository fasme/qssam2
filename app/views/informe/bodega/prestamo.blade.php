@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

            



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                      Resultados
                    </div>
        
 
<table id="example" class="table table-striped table-bordered table-hover">
<div class="info"></div>
  <thead>
          <tr>
          <th>Bodega</th>
          <th>Producto</th>
          <th>Personal</th>
                            <th>Cantidad</th>
                            
                            <th>Fecha Prestamo</th>
                            <th>Fecha Devolucion</th>
                           
          
 
            
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


  @foreach($prestamos as $prestamo)

           <tr>
           <td>{{Bodega::find($prestamo->bodega_id)->nombre}}</td>
           <td>{{ Producto::find($prestamo->producto_id)->nombre}}</td>
           <td>{{Personal::find($prestamo->personal_id)->nombre}}</td>
           <td>{{$prestamo->cantidad}}</td>
           
           <td>
           	 @if($prestamo->tipo == 3)
           	 {{ date_format(date_create($prestamo->created_at), 'd/m/Y H:i')}}
           
         
                          @endif
           
           </td>
           <td>

           @if($prestamo->cantidad == 0) 
{{ date_format(date_create($prestamo->updated_at), 'd/m/Y H:i')}}

         
            @endif

           </td>
</tr>
    @endforeach
        </tbody>
  </table>

  </div>


  <script type="text/javascript">
 $(document).ready(function() {


//$("#example tfoot th").eq(0).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
//$("#example tfoot th").eq(1).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');


var table = $('#example').DataTable( {
      
       initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },

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






/*
 table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );

*/

var tableTools = new $.fn.dataTable.TableTools( table, {
  

    
      "aButtons": [
                    
                   
                    {
                        "sExtends": "pdf",
                        "sButtonText":"Listado pdf",
                        //"sTitle": "Report Name",
                        //"sPdfMessage": "Summary Info",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    }

                ]
      
    } );


$( tableTools.fnContainer() ).insertAfter('div.info');




$( "#bodegaactive" ).addClass( "active" );
$( "#bodegaactive" ).addClass( "active" );



/*
$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
//var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Devolver  ", function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('prestamo/devolver')}}",
              { id: id },

              function(data,status){  }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });
*/



$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
          bootbox.prompt("Cantidad a Devolver", function(result) {
            if(result){
            
            $.get("{{ url('prestamo/devolver')}}",
              { id: id, cantidad:result },

              function(data,status){ location.reload(); }
).fail(function(data)
{bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");
});
}

     
            });
        });

        




$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('bodega/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop

