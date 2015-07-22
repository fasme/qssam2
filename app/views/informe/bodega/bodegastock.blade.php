@extends('layouts.master')

@section('contenido')

            

 <h3 class="header smaller lighter">Stock de Productos 
                
    </h3>


<?php

?>


<div class="row">
  <div class="col-xs-12">
      <div class="alert alert-block alert-success">

      {{ Form::open(array('url' => "informebodegastock", "method"=>"get")) }}
            <div class="form-group">
            {{Form::label('', 'Bodega',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('bodegaid',$bodegas,$data['bodegaid'])}}

            {{Form::submit()}}

      {{ Form::close()}}
            </div>
      </div>
</div>
</div>

 <div class="row">
  <div class="col-xs-6">
 <canvas id="myChart1" width="400" height="300"></canvas>
 </div>
 <div class="col-xs-6">
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
    labels: {{$productos}},
    datasets: [
        {
            label: "Actividades Abiertas",
            fillColor: "#FA5858",
          //  strokeColor: "rgba(220,220,220,0.8)",
           // highlightFill: "rgba(220,220,220,0.75)",
           // highlightStroke: "rgba(220,220,220,1)",
            data: {{$stock}}
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

              animation: false
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