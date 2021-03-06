@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Transacción: 
                    <a href="{{URL::to('productotransaccion/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>

     
    </h3>



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
          <th class="select-filter">Bodega</th>
          <th class="select-filter">Producto</th>
                            <th>Cantidad</th>
                            <th class="select-filter">Documento</th>
                            <th class="select-filter">N de Documento</th>
                            <th class="select-filter">Tipo</th>
                            <th class="select-filter">Origen/Destino</th>
                            <th class="select-filter">Fecha</th>
                            <th>Accion</th>
                           
          
 
            
          </tr>
        </thead>



        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>


        <tbody>


  @foreach($bodegas as $bodega)
      @foreach($bodega->muchasproducto as $producto)
      
           <tr>
           <td>{{ $bodega->nombre}}</td>
           <td>{{ $producto->nombre}} ({{$producto->codigo}} )</td>
           <td>{{$producto->pivot->cantidad}}</td>
           <td>
           @if($producto->pivot->tipo == 1){{"Factura"}} @endif
           @if($producto->pivot->tipo == 2){{"Guia"}} @endif
            @if($producto->pivot->tipo == 2){{"Boleta"}} @endif
           
          
           </td>
           <td>{{$producto->pivot->documento}}</td>
           <td>
           @if($producto->pivot->tipo == 1){{"Entrada"}} @endif
           @if($producto->pivot->tipo == 2){{"Salida"}} @endif
           @if($producto->pivot->tipo == 3){{"Prestamo"}} @endif
           @if($producto->pivot->tipo == 4){{"Devolucion"}} @endif
           </td>
           <td>{{$producto->pivot->origendestino}}</td>
           <td>{{ date_format(date_create($producto->pivot->created_at), 'd/m/Y')}}</td>
           <td><a class="red bootbox-confirm" data-id={{ $producto->pivot->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a></td>
         
</tr>
          @endforeach
    @endforeach
        </tbody>
  </table>

  </div>


  <script type="text/javascript">
 $(document).ready(function() {


var table = $('#example').DataTable( {
      
       initComplete: function () {

            this.api().columns('.select-filter').every( function () {

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
                
               "infoEmpty": "Nasdasd",
                "info": "Mostrando Resultados _PAGE_ of _PAGES_",
                "lengthMenu": "Mostrar _MENU_ Registros",
                "search": "Buscar:",
                "paginate": {
                  "next": "Siguiente",
                  "previous": "Anterior"
                }
            },
            


             "footerCallback": function ( row, data, start, end, display ) {
      
          var api = this.api(), data;
     
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    
                  //  alert(a + b);
                   // $.fn.dataTable.render.number( '\'', '.', 0, '$' );
                    return intVal(a) + intVal(b);

                } );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                pageTotal
            );
         }

    } );




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




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('productotransaccion/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
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

