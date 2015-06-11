@extends('portal.layouts')

@section('contenido')

<body class="homepage">
<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Biblioteca</h2>
             </div>

            <div class="row">
            @if (Auth::check())

<?php
//$actividadProgramadas = ActividadProgramada::all();
$archivos = Archivo::all();
?>



 <table id="example" class="table table-striped table-bordered table-hover">

                        <thead>
                          <tr>
                            
                            <th>Nombre Documento</th>
                            <th>Categoria</th>
                          
                             <th>Estado</th>
                            
                            

                           
                          </tr>
                        </thead>

                        <tbody>

                        
                         @foreach($archivos as $archivo)
                          <tr>
                        
                       

                            <td>{{ $archivo->nombre}}</td>
                            <td>{{$archivo->categoria->nombre}}</td>
                            
                            <td>
                            <a data-toggle="modal" class="botoncito" data-urlarchivo="https://docs.google.com/viewer?url=http://190.47.105.44/qssam2/public/archivos/biblioteca/{{$archivo->archivo}}&embedded=true"  href="#" >
                                  <span class="label label-success arrowed">Vista Previa</span>
                                </a>

                                <a data-toggle="modal" class="botoncito2" data-id="{{$archivo->id}}"  href="#" >
                                  <span class="label label-warning arrowed">Descargar</span>
                                </a>

                                </td>
                          
                            </tr>

                            @endforeach
                            
                            </tbody>
                            </table>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

    




</body>

    



    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Vista Previa</h4>
      </div>
      <div class="modal-body">

      
     
      
     <iframe id="iframe" src="" width="550" height="300" style="border: none;"></iframe> </div>
      
      <div class="modal-footer">
    
        
      </div>
    </div>
  </div>
</div>

  

    








    <script type="text/javascript">


 $(document).ready(function() {


  $( "#actividadactive" ).addClass( "active" );

var oTable1 = 
        $('#example')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });



$(".botoncito").click(function(){

  var urlarchivo = $(this).data('urlarchivo');
  

  $("#urlarchivo").val(urlarchivo);


        $('#iframe').attr('src', urlarchivo);
        //$('#iframe').reload();

  $('#myModal').modal("show");
});


});
 </script>

@stop