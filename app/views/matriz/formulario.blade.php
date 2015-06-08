@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
            Matriz
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->


     @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif


<div class="row">
  <div class="col-xs-12">

           <?php
  // si existe el usuario carga los datos
    if ($matriz->exists):
        $form_data = array('url' => 'matriz/update/'.$matriz->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'matriz/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

            

            <div class="widget-box">
                      <div class="widget-header widget-header-small">
                        <h5 class="widget-title smaller">Tabbed</h5>

                        <div class="widget-toolbar no-border">
                          <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                              <a data-toggle="tab" href="#uno">1.-Identificacion de Peligro</a>
                            </li>

                            <li>
                              <a data-toggle="tab" href="#dos">2.-Evaluacion del Riesgo Base</a>
                            </li>

                            <li>
                              <a data-toggle="tab" href="#tres">3.-Controles Preventivos</a>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="widget-body">
                        <div class="widget-main padding-6">
                          <div class="tab-content">
                            <div id="uno" class="tab-pane in active">
                              
                               <div class="form-group">
                              {{Form::label('', 'Peligro',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('nombre', $matrizPeligro, "", array("class"=>"chosen-select"))}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Actividad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('actividad_id', $matrizActividad, "", array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Riesgo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('riesgo_id', $matrizRiesgo, "", array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Rutinaria',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('riesgo_id', array("si"=>"si","no"=>"no"), "")}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Cargo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('cargo_id', $matrizCargo, "", array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>


                            </div>

                            <div id="dos" class="tab-pane">

                             <div class="form-group">
                              {{Form::label('', 'Factor Consecuencia',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('criterioConsecuencia', $criterioConsecuencia, "")}}
                              </div>
                              <div class="form-group">
                              {{Form::label('', 'Factor Exposicion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('criterioExposicion', $criterioExposicion, "")}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Factor Probabilidad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('criterioProbabilidad', $criterioProbabilidad, "")}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultado', $matriz->resultado, array("id"=>"resultado1", "readonly"=>"readonly"))}}
                              </div>


                            </div>

                            <div id="tres" class="tab-pane">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                  {{Form::label('', 'Previo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actprevio', $matriz->actprevio, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totalprevio', array(1=>"1",2=>"2",3=>"3",4=>"4",5=>"5 o mas"), $matriz->totalprevio)}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoprevio', $matriz->resultadoprevio, array("id"=>"resultado2", "readonly"=>"readonly"))}}
                              </div>

                                  <div class="hr hr-24"></div>


                                  <div class="form-group">
                                  {{Form::label('', 'Sustitucion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('sustitucion', $matriz->sustitucion, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totalsustitucion', array(1=>"1",2=>"2",3=>"3",4=>"4",5=>"5 o mas"), $matriz->totalsustitucion)}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadosustitucion', $matriz->resultadosustitucion, array("id"=>"resultado4", "readonly"=>"readonly"))}}
                              </div>

<div class="hr hr-24"></div>

                              <div class="form-group">
                                  {{Form::label('', 'Administrativo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actadministrativo', $matriz->actadministrativo, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totaladministrativo', array(1=>"1",2=>"2",3=>"3",4=>"4",5=>"5 o mas"), $matriz->totaladministrativo)}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoeliminacioon', $matriz->resultadoadministrativo, array("id"=>"resultado6", "readonly"=>"readonly"))}}
                              </div>


                                </div>
                                <div class="col-xs-6">
                                      <div class="form-group">
                                  {{Form::label('', 'Eliminacion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('acteliminacion', $matriz->acteliminacion, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totaleliminacion', array(1=>"1",2=>"2",3=>"3",4=>"4",5=>"5 o mas"), $matriz->totaleliminacion)}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoeliminacioon', $matriz->resultadoeliminacion, array("id"=>"resultado3", "readonly"=>"readonly"))}}
                              </div>

<div class="hr hr-24"></div>

                              <div class="form-group">
                                  {{Form::label('', 'Ingenieria',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actingenieria', $matriz->actingenieria, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totalingenieria', array(1=>"1",2=>"2",3=>"3",4=>"4",5=>"5 o mas"), $matriz->totalingenieria)}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoeliminacioon', $matriz->resultadoingenieria, array("id"=>"resultado5", "readonly"=>"readonly"))}}
                              </div>
<div class="hr hr-24"></div>

                              <div class="form-group">
                                  {{Form::label('', 'Administrativo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actepp', $matriz->actepp, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totalepp', array(1=>"1",2=>"2",3=>"3",4=>"4",5=>"5 o mas"), $matriz->totalepp)}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoeliminacioon', $matriz->resultadoepp, array("id"=>"resultado7", "readonly"=>"readonly"))}}
                              </div>


                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>



            

           



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   



$( "#matrizactive" ).addClass( "active" );

$('.chosen-select').chosen(); 

    
  });   
</script>

@stop


