@extends('layouts.master')

@section('contenido')

            

 <h3 class="header smaller lighter">Cantidad de atencion medicas: 
                
    </h3>



<div class="row">
  <div class="col-xs-12">
      <div class="alert alert-block alert-success">

      {{ Form::open(array('url' => "informeatencionmedicaanual", "method"=>"get")) }}
            <div class="form-group">
            

            {{Form::select('ano',array("2015"=>"2015","2016"=>"2016","2017"=>"2017","2018"=>"2018"), $data["ano"])}}
            {{Form::select('personal',$personals, $data["personal"])}}

            {{Form::select('diaturno',$diaturno,$data["diaturno"])}}
            
            {{Form::select('diagnostico',$diagnostico,$data["diagnostico"])}}
            {{Form::select('clasificacion',$clasificacion,$data["clasificacion"])}}
            {{Form::select('comuna',$comuna,$data["comuna"])}}
            {{Form::submit()}}

      {{ Form::close()}}
            </div>
      </div>
</div>
</div>

 <div class="row">
  <div class="col-xs-9">
 <canvas id="myChart1" width="800" height="300"></canvas>
 </div>
 <div class="col-xs-3">
 <div id="chart1"></div>
{{ Form::open(array('url' => "informepdf")) }}
            <div class="form-group">
            {{Form::hidden('img',"", array("id"=>"img64"))}}
            {{Form::hidden('titulo',$titulo)}}
            {{Form::submit("Descargar PDF", array("class"=>"btn btn-success"))}}

            

      {{ Form::close()}}

 </div>
 </div>

   
<script type="text/javascript">
    
     $(document).ready(function() {

      $( "#informeactive" ).addClass( "active" );


      var ctx = document.getElementById("myChart1").getContext("2d");


 var data = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
    datasets: [
        {
            label: "Cantidad de atencion medicas",
            fillColor: "#FA5858",
          //  strokeColor: "rgba(220,220,220,0.8)",
           // highlightFill: "rgba(220,220,220,0.75)",
           // highlightStroke: "rgba(220,220,220,1)",
            data: [{{$cantidad["0"]}},{{$cantidad["1"]}},{{$cantidad["2"]}},{{$cantidad["3"]}},{{$cantidad["4"]}},{{$cantidad["5"]}},{{$cantidad["6"]}},{{$cantidad["7"]}},{{$cantidad["8"]}},{{$cantidad["9"]}},{{$cantidad["10"]}},{{$cantidad["11"]}}]
        }
    ]
};

var options = {
  legendTemplate : '<ul>'
                  +'<% for (var i=0; i<datasets.length; i++) { %>'
                    +'<li>'
                    +'<span style=\"background-color:<%=datasets[i].fillColor%>\">  &nbsp;&nbsp;  &nbsp;&nbsp;</span>'
                    +'<% if (datasets[i].label) { %><%= datasets[i].label %><% } %>'
                  +'</li>'
                +'<% } %>'
              +'</ul>',

              animation: false,

  };



var myBarChart = new Chart(ctx).Bar(data,options);
var legend = myBarChart.generateLegend();


var wa = ctx.canvas.toDataURL();

    $("#img64").val(wa);

  //and append it to your page somewhere
  $('#chart1').append(legend);




});

</script>
    

@stop