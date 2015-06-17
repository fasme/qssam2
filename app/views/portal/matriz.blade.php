@extends('portal.layouts')

@section('contenido')
<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Matriz</h2>
             </div>

            <div class="row">
            @if (Auth::check())




 <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            
                            <th class="hidden-480">Proceso</th>
                            
                            <th>Peligro</th>
                            <th>Acciones</th>


                           
                          </tr>
                        </thead>

                        <tbody>
                        
                         @foreach(Matriz::all() as $matriz)
                          <tr>
                            
                            <td>{{$matriz->proceso}}</td>
                            <td>{{$matriz->peligro->nombre}}</td>
                            <td>
                            <a href= {{ 'matriz/pdf/'.$matriz->id }}>
                            <span class="label label-success arrowed">Imprimir</span>

                          </a></td>
                           
                            
                            </tr>
                            @endforeach
                            
                            </tbody>
                            </table>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->



    <script type="text/javascript">


 $(document).ready(function() {


  $( "#matrizactive" ).addClass( "active" );

var oTable1 = 
        $('#example')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });



var oTable1 = 
        $('#example1')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });


        var oTable1 = 
        $('#example2')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });


$(".botoncito").click(function(){

  var id = $(this).data('id');
  var actividadid = $(this).data('actividadid');
  var tipoactividad = $(this).data('tipoactividad');

  $("#actividadid").val(actividadid);
  $("#id").val(id);
  $("#tipoactividad").val(tipoactividad);
  //alert(id);
  $('#myModal').modal("show");
});


});
 </script>


@stop