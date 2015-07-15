@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Prestamo: 
                    <a href="{{URL::to('prestamo/insert')}}"  class="btn btn-white btn-info btn-bold"> 
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


  @foreach($prestamos as $prestamo)

 
           <tr>
           <td>{{Bodega::find($prestamo->bodega_id)->nombre}}</td>
           <td>{{ Producto::find($prestamo->producto_id)->nombre}}</td>
           <td>{{Personal::find($prestamo->personal_id)->nombre}}</td>
           <td>{{$prestamo->cantidad}}</td>
           <td>
           @if($prestamo->tipo == 1) {{"Prestamo"}}  <a class="red bootbox-confirm" data-id={{ $prestamo->id }}>
                             <span class="label label-success arrowed">Devolver</span>
                          </a> @endif
           @if($prestamo->tipo == 2) {{"Entregado"}} @endif
           </td>
</tr>
    @endforeach
        </tbody>
  </table>

  </div>


  <script type="text/javascript">
 $(document).ready(function() {


$("#example tfoot th").eq(0).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(1).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');


var table = $('#example').DataTable( {
      
       

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






 table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
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
//var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Devolver  "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('prestamo/devolver')}}",
              { id: id },

              function(data,status){ /*tr.fadeOut(1000);*/ }
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

