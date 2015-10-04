<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />



           <?php
  // si existe el usuario carga los datos
    if ($pac->exists):
        $form_data = array('url' => 'pac/update/'.$pac->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'pac/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


<h1>Plan de Acción</h1>

<div style="position: absolute;top: 100px; left:0px;">

<table width='30%' class='oli'>

<tr>
<td>Quien Ingresa Reporte</td><td>:</td><td>{{Personal::find($pac->personal_id)->nombre}}</td>
</tr>
<tr>
<td>Faena</td><td>:</td><td>{{$pac->faena}}</td>
</tr>

</div>




<div style="position: absolute;top: 100px; left: 0px; background-color: #F2F2F2">
<table width='20%' class='oli'>
<?php
echo "<tr>
<td>OHSAS 18001</td><td>:</td><td>$pac->ohsas</td>
</tr>
<tr>
<td>ISO 9001</td><td>:</td><td>$pac->iso9</td>
</tr>
<tr>
<td>ISO 14001</td><td>:</td><td>$pac->iso1</td>
</tr>
<tr>
<td>Aud. Interna</td><td>:</td><td>$pac->audinterna</td>
</tr>
<tr>
<td>Aud. Externa</td><td>:</td><td>$pac->audexterna</td>
</tr>
<tr>
<td>Rev. Gerencial</td><td>:</td><td>$pac->revgerencial</td>
</tr>

<tr>
<td>Recl. Cliente</td><td>:</td><td>$pac->reccliente</td>
</tr>

<tr>
<td>Inspecciones</td><td>:</td><td>$pac->inspecciones</td>
</tr>

<tr>
<td>Legal</td><td>:</td><td>$pac->legal</td>
</tr>

<tr>
<td>NC</td><td>:</td><td>$pac->nc</td>
</tr>

<tr>
<td>Obs.</td><td>:</td><td>$pac->obs</td>
</tr>

<tr>
<td>OM</td><td>:</td><td>$pac->om</td>
</tr>";
?>

</table>
 </div>



<div style="position: absolute;top: 100px; left: 400px; background-color: #F2F2F2">
    <table width='100%' class='oli'>
    <tr>
      
      <td>Causa</td><td>:</td><td>{{$pac->identificacion}}</td>
    </tr>

     <tr>
      
      <td>1.- Por que ?</td><td>:</td><td>{{$pac->porque1}}</td>
    </tr>

     <tr>
      
      <td>2.- Por que ?</td><td>:</td><td>{{$pac->porque2}}</td>
    </tr>

     <tr>
      
      <td>3.- Por que ?</td><td>:</td><td>{{$pac->porque3}}</td>
    </tr>

     <tr>
      
      <td>4.- Por que ?</td><td>:</td><td>{{$pac->porque4}}</td>
    </tr>

     <tr>
      
      <td>5.- Por que ?</td><td>:</td><td>{{$pac->porque5}}</td>
    </tr>

   
    </table>
</div>


<?php
$arreglo = array("1"=>"Plan de accion inmediato","2"=>"Plan de accion Correctivo","3"=>"Plan de accion preventivo");
?>

<div style="position: absolute;top: 600px; left: 0px; background-color: #F2F2F2">
<table width='100%' class='oli'>
  @foreach($pac->muchaspersonal as $actividadpac)
 <tr>
  <td>Personal</td><td>{{Personal::find($actividadpac->pivot->personal_id)->nombre}}</td>
  <td>Actividad</td><td>{{$actividadpac->pivot->actividad}}</td>
 <td>Fecha</td><td> {{date_format(date_create($actividadpac->pivot->plazo), 'd/m/Y')}}</td>
 <td>Plan</td><td> {{$arreglo[$actividadpac->pivot->tipoplan]}}</td>
</tr>
  @endforeach
</table>
  </div>





           

    





