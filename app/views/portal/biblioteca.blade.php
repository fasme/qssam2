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
$archivos = Archivo::where("obsoleto","<>","si")->get();
?>



 <table id="example" class="table table-striped table-bordered table-hover">
<div class="info"></div>
                        <thead>
                          <tr>
                            
                            <th>Nombre Documento</th>
                            <th>Categoria</th>
                            <th>Codigo</th>
                            <th>Version</th>
                            <th>Tiempo Vigencia</th>
                            <th>Fecha Elaboracion</th>
                          
                             <th>Estado</th>
                            
                            

                           
                          </tr>
                        </thead>

                        <tbody>

                        
                         @foreach($archivos as $archivo)
                          <tr>
                        
                       

                            <td>{{ $archivo->nombre}}</td>
                            <td>{{$archivo->categoria->nombre}}</td>
                            <td>{{$archivo->codigo}}</td>
                            <td>{{$archivo->version}}</td>
                            <td>{{$archivo->tiempo}}</td>
                                                        <td>{{ date_format(date_create($archivo->elaboracion), 'd/m/Y')}}

                            <td>
                            <a data-toggle="modal" class="botoncito" data-urlarchivo="https://docs.google.com/viewer?url=http://avachintranet.cl/qssam2/public/archivos/biblioteca/{{$archivo->archivo}}&embedded=true"  href="#" >
                                  <span class="label label-success arrowed">Vista Previa</span>
                                </a>
                                

                               

{{
link_to_asset('archivos/biblioteca/'.$archivo->archivo, "Descargar", array("class"=>"label label-warning arrowed"))
}}
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


  $( "#biblioactive" ).addClass( "active" );

var table = 
        $('#example')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "datatables.spanish.json"
            }
        });



        var tableTools = new $.fn.dataTable.TableTools( table, {
  
  "fnRowSelected": function(nodes) {
      var a = nodes[0].id;
      $("#selectmatrices").append("<option value="+a+" selected>"+a+"</option>");
      /*
        if (myDeselectList) {
            var nodeList = myDeselectList;
            myDeselectList = null;
            this.fnDeselect(nodeList);
        }
        */
    },
    "fnRowDeselected": function(nodes){
      var a = nodes[0].id;
      $("#selectmatrices option[value="+a+"]").remove();

    },
      "aButtons": [
                    {
                        "sExtends": "pdf",
                        "sButtonText":"Listado Maestro",
                        "sTitle": "LISTADO MAESTRO DE DOCUMENTOS Y REGISTROS",
                        "sPdfMessage": "",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},
                         "mColumns": [ 0, 1,2,3,4 ]

                    }
                ]
    
      
    } );
$( tableTools.fnContainer() ).insertAfter('div.info');



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