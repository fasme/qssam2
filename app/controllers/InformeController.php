<?php
use Khill\Lavacharts\Lavacharts;
class InformeController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */



    // MANTENCION

    public function informeevidencia()
    {
       
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('informe.evidencia.informeevidencia');
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


    public function informemantencionmensual()
    {
       
      //  

        $titulo = "Mantencion Programda vs Mantencion Realizada";
        $data = Input::all();
        if(!isset($data["mes"]))
        {
            $data["mes"] = date("n");
        }

        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }
    
        
        $programada = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->count("*");
        $realizada = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->where("estado","=","Cerrada")->count("*");
    
        
       return View::make('informe.mantencion.informemantencionmensual')
       ->with("programada",$programada)
       ->with("realizada",$realizada)
       ->with("titulo", $titulo)
       ->with("data",$data);
      
        
     
    }

    public function informemantencionanual()
    {
        $titulo = "Mantencion Programda vs Mantencion Realizada";
        $data = Input::all();
       
        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }   


        for($i=1; $i<=12; $i++)
        {
        $programada[] = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$i)->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->count("*");
        $realizada[] =  DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$i)->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->where("estado","=","Cerrada")->count("*");
        }
        
       
        return View::make('informe.mantencion.informemantencionanual')
        ->with("programada",$programada)
        ->with("realizada",$realizada)
        ->with("titulo", $titulo)
        ->with("data",$data);



    }

    public function informemantencionvehiculo()
    {

        $titulo = "Horas Utilizadas vs Mantencion Realizadas";
        $data = Input::all();
       if(!isset($data["mes"]))
        {
            $data["mes"] = date("n");
        }
        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }   


    
        foreach(Vehiculo::all() as $vehiculo)
        {
        $vehiculos[] = $vehiculo->patente;
        $programada[] = Vehiculo::join("vehiculo_horometro","vehiculo.id","=","vehiculo_horometro.vehiculo_id")->where(DB::raw("MONTH(vehiculo_horometro.created_at)"),"=",$data["mes"])->where(DB::raw("YEAR(vehiculo_horometro.created_at)"),"=",$data["ano"])->where("vehiculo.id","=",$vehiculo->id)->sum("vehiculo_horometro.horometro");

        $realizada[] = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->where("mantencion.vehiculo_id","=",$vehiculo->id)->count("*");
        }

        //return json_encode($vehiculos);

        
       
        return View::make('informe.mantencion.informemantencionvehiculo')
        ->with("programada",json_encode($programada))
        ->with("realizada",json_encode($realizada))
       ->with("vehiculos",json_encode($vehiculos))
       ->with("titulo", $titulo)
        ->with("data",$data);



    }


















 // EVIDENCIAS

public function informeevidenciamensual()
{

        $titulo = "Actividades Abiertas vs Actividades Cerradas";
        $data = Input::all();
       if(!isset($data["mes"]))
        {
            $data["mes"] = date("n");
        }
        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }   
    $actividadresponsable = DB::table('actividad_responsable_noprogramada')->join("actividad_noprogramada","actividad_responsable_noprogramada.actividad_id","=","actividad_noprogramada.id")->Where(DB::raw("MONTH(actividad_responsable_noprogramada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_noprogramada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");
 $actividadresponsable_kpi = DB::table('actividad_kpi')->join("kpi","actividad_kpi.kpi_id","=","kpi.id")->Where(DB::raw("MONTH(actividad_kpi.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_kpi.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->join("actividad_programada","actividad_responsable_programada.actividad_id","=","actividad_programada.id")->Where(DB::raw("MONTH(actividad_responsable_programada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_programada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");
$actividadresponsable_pac = DB::table('actividad_pac')->join("pac","actividad_pac.pac_id","=","pac.id")->Where(DB::raw("MONTH(actividad_pac.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_pac.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->join("mantencion","actividad_responsable_mantencion.actividad_id","=","mantencion.id")->Where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");

$abiertas = $actividadresponsable + $actividadresponsable_kpi + $actividadresponsable_programada + $actividadresponsable_pac + $actividadresponsable_mantencion;



    $actividadresponsable = DB::table('actividad_responsable_noprogramada')->join("actividad_noprogramada","actividad_responsable_noprogramada.actividad_id","=","actividad_noprogramada.id")->Where(DB::raw("MONTH(actividad_responsable_noprogramada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_noprogramada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");
 $actividadresponsable_kpi = DB::table('actividad_kpi')->join("kpi","actividad_kpi.kpi_id","=","kpi.id")->Where(DB::raw("MONTH(actividad_kpi.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_kpi.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->join("actividad_programada","actividad_responsable_programada.actividad_id","=","actividad_programada.id")->Where(DB::raw("MONTH(actividad_responsable_programada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_programada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");
$actividadresponsable_pac = DB::table('actividad_pac')->join("pac","actividad_pac.pac_id","=","pac.id")->Where(DB::raw("MONTH(actividad_pac.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_pac.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->join("mantencion","actividad_responsable_mantencion.actividad_id","=","mantencion.id")->Where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");

$cerradas = $actividadresponsable + $actividadresponsable_kpi + $actividadresponsable_programada + $actividadresponsable_pac + $actividadresponsable_mantencion;

    return View::make('informe.evidencia.informeevidencia')
        ->with("abiertas",json_encode($abiertas))
        ->with("cerradas",json_encode($cerradas))
        ->with("titulo", $titulo)
        ->with("data",$data);
        
}

public function informeevidenciaanualpersonal(){


    $titulo = "Actividades Abiertas vs Actividades Cerradas ANUAL/PERSONAL";
        $data = Input::all();
       

        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }  
        if(!isset($data["personal"]))
        {
            $data["personal"] = Personal::first()->id;
        }  


          $personals = Personal::lists("nombre","id");
        //  $abiertas = array();
          $cerradas = array();



        for($i=1; $i<=12; $i++)
        {
            $data["mes"] = $i;
 
        
   $actividadresponsable = DB::table('actividad_responsable_noprogramada')->join("actividad_noprogramada","actividad_responsable_noprogramada.actividad_id","=","actividad_noprogramada.id")->Where(DB::raw("MONTH(actividad_responsable_noprogramada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_noprogramada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->where("personal_id","=",$data["personal"])->count("*");
 $actividadresponsable_kpi = DB::table('actividad_kpi')->join("kpi","actividad_kpi.kpi_id","=","kpi.id")->Where(DB::raw("MONTH(actividad_kpi.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_kpi.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->where("personal_id","=",$data["personal"])->count("*");
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->join("actividad_programada","actividad_responsable_programada.actividad_id","=","actividad_programada.id")->Where(DB::raw("MONTH(actividad_responsable_programada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_programada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->where("personal_id","=",$data["personal"])->count("*");
$actividadresponsable_pac = DB::table('actividad_pac')->join("pac","actividad_pac.pac_id","=","pac.id")->Where(DB::raw("MONTH(actividad_pac.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_pac.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->where("actividad_pac.personal_id","=",$data["personal"])->count("*");
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->join("mantencion","actividad_responsable_mantencion.actividad_id","=","mantencion.id")->Where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->Where("estado","=","Abierta")->where("personal_id","=",$data["personal"])->count("*");

$abiertas[] = $actividadresponsable + $actividadresponsable_kpi + $actividadresponsable_programada + $actividadresponsable_pac + $actividadresponsable_mantencion;



    $actividadresponsable = DB::table('actividad_responsable_noprogramada')->join("actividad_noprogramada","actividad_responsable_noprogramada.actividad_id","=","actividad_noprogramada.id")->Where(DB::raw("MONTH(actividad_responsable_noprogramada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_noprogramada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->where("personal_id","=",$data["personal"])->count("*");
 $actividadresponsable_kpi = DB::table('actividad_kpi')->join("kpi","actividad_kpi.kpi_id","=","kpi.id")->Where(DB::raw("MONTH(actividad_kpi.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_kpi.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->where("personal_id","=",$data["personal"])->count("*");
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->join("actividad_programada","actividad_responsable_programada.actividad_id","=","actividad_programada.id")->Where(DB::raw("MONTH(actividad_responsable_programada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_programada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->where("personal_id","=",$data["personal"])->count("*");
$actividadresponsable_pac = DB::table('actividad_pac')->join("pac","actividad_pac.pac_id","=","pac.id")->Where(DB::raw("MONTH(actividad_pac.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_pac.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->where("actividad_pac.personal_id","=",$data["personal"])->count("*");
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->join("mantencion","actividad_responsable_mantencion.actividad_id","=","mantencion.id")->Where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->Where("estado","=","Cerrada")->where("personal_id","=",$data["personal"])->count("*");

$cerradas[] = $actividadresponsable + $actividadresponsable_kpi + $actividadresponsable_programada + $actividadresponsable_pac + $actividadresponsable_mantencion;
    


    $actividadresponsable = DB::table('actividad_responsable_noprogramada')->join("actividad_noprogramada","actividad_responsable_noprogramada.actividad_id","=","actividad_noprogramada.id")->Where(DB::raw("MONTH(actividad_responsable_noprogramada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_noprogramada.frecuencia)"),"=",$data["ano"])->Where("actividad_responsable_noprogramada.frecuencia",">","fechaenvio")->where("personal_id","=",$data["personal"])->count("*");
 $actividadresponsable_kpi = DB::table('actividad_kpi')->join("kpi","actividad_kpi.kpi_id","=","kpi.id")->Where(DB::raw("MONTH(actividad_kpi.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_kpi.frecuencia)"),"=",$data["ano"])->Where("actividad_kpifrecuencia",">","fechaenvio")->where("personal_id","=",$data["personal"])->count("*");
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->join("actividad_programada","actividad_responsable_programada.actividad_id","=","actividad_programada.id")->Where(DB::raw("MONTH(actividad_responsable_programada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_responsable_programada.frecuencia)"),"=",$data["ano"])->Where("actividad_responsable_programada.frecuencia",">","fechaenvio")->where("personal_id","=",$data["personal"])->count("*");
$actividadresponsable_pac = DB::table('actividad_pac')->join("pac","actividad_pac.pac_id","=","pac.id")->Where(DB::raw("MONTH(actividad_pac.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_pac.frecuencia)"),"=",$data["ano"])->Where("actividad_frecuencia",">","fechaenvio")->where("actividad_pac.personal_id","=",$data["personal"])->count("*");
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->join("mantencion","actividad_responsable_mantencion.actividad_id","=","mantencion.id")->Where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->Where("mantencion.fecha_mantencion",">","fechaenvio")->where("personal_id","=",$data["personal"])->count("*");

$atrasadas[] = $actividadresponsable + $actividadresponsable_kpi + $actividadresponsable_programada + $actividadresponsable_pac + $actividadresponsable_mantencion;
    


    }
    
    //return json_encode($abiertas);
  
    return View::make('informe.evidencia.informeevidenciaanualpersonal')
        ->with("abiertas",$abiertas)
        ->with("cerradas",$cerradas)
        ->with("atrasadas",$atrasadas)
        ->with("titulo", $titulo)
        ->with("data",$data)
        ->with("personals",$personals);

}









// BODEGA

public function bodegastock(){

        $titulo = "Stock de Productos";
        $data = Input::all();

         if(!isset($data["bodegaid"]))
        {
            $data["bodegaid"] = Bodega::first()->id;
        }      
        $bodegas = Bodega::lists("nombre","id"); 

        $bodega = Bodega::find($data["bodegaid"]);
     $productos = $bodega->muchasproducto()->groupby("producto_id")->select(DB::raw("SUM(cantidad) as suma, nombre"))->get();

         $productosarray = "";
         $stock = array();
         foreach ($productos as $producto) {
             $productosarray[] = $producto->nombre;
             $stock[] = $producto->suma;//$stock[] = ;
         }


         
         //return json_encode($productosarray);

        return View::make('informe.bodega.bodegastock')
        ->with("productos",json_encode($productosarray))
        ->with("stock",json_encode($stock))
        ->with("titulo", $titulo)
        ->with("data",$data)
        ->with("bodegas",$bodegas);

}



public function massalida(){

        $titulo = "Stock de Productos";
        $data = Input::all();
        $stock = array();

         if(!isset($data["bodegaid"]))
        {
            $data["bodegaid"] = Bodega::first()->id;
        }      
        $bodegas = Bodega::lists("nombre","id"); 

        $bodega = Bodega::find($data["bodegaid"]);
      $productos = $bodega->muchasproducto()->groupby("producto_id")->select(DB::raw("SUM(cantidad) as suma,nombre"))->where("tipo","=",2)->take(10)->get();

         $productosarray = "";
         foreach ($productos as $producto) {
             $productosarray[] = $producto->nombre;
             $stock[] = ($producto->suma)*-1;//$stock[] = ;
         }


         
         //return json_encode($productosarray);

        return View::make('informe.bodega.massalida')
        ->with("productos",json_encode($productosarray))
        ->with("stock",json_encode($stock))
        ->with("titulo", $titulo)
        ->with("data",$data)
        ->with("bodegas",$bodegas);

}



public function masentrada(){

        $titulo = "Producto con mas entradas";
        $data = Input::all();
        $stock = array();

         if(!isset($data["bodegaid"]))
        {
            $data["bodegaid"] = Bodega::first()->id;
        }      
        $bodegas = Bodega::lists("nombre","id"); 

        $bodega = Bodega::find($data["bodegaid"]);
      $productos = $bodega->muchasproducto()->groupby("producto_id")->select(DB::raw("SUM(cantidad) as suma,nombre"))->where("tipo","=",1)->take(10)->get();

         $productosarray = "";
         foreach ($productos as $producto) {
             $productosarray[] = $producto->nombre;
             $stock[] = ($producto->suma);//$stock[] = ;
         }


         
         //return json_encode($productosarray);

        return View::make('informe.bodega.masentrada')
        ->with("productos",json_encode($productosarray))
        ->with("stock",json_encode($stock))
        ->with("titulo", $titulo)
        ->with("data",$data)
        ->with("bodegas",$bodegas);

}


public function sindevolucion(){

        $titulo = "Productos sin devolucion";
        $data = Input::all();
        $stock = array();

         if(!isset($data["bodegaid"]))
        {
            $data["bodegaid"] = Bodega::first()->id;
        }      
        $bodegas = Bodega::lists("nombre","id"); 

        $bodega = Bodega::find($data["bodegaid"]);
      $productos = $bodega->muchasproducto()->groupby("producto_id")->select(DB::raw("SUM(cantidad) as suma,nombre"))->where("tipo","=",3)->get();

         $productosarray = "";
         foreach ($productos as $producto) {
             $productosarray[] = $producto->nombre;
             $stock[] = ($producto->suma)*-1;//$stock[] = ;
         }


         
         //return json_encode($productosarray);

        return View::make('informe.bodega.sindevolucion')
        ->with("productos",json_encode($productosarray))
        ->with("stock",json_encode($stock))
        ->with("titulo", $titulo)
        ->with("data",$data)
        ->with("bodegas",$bodegas);

}

public function prestamo()
{
        $titulo = "Prestamos";
        $data = Input::all();
        $stock = array();

         $prestamos = DB::table("bodega_producto")
        ->join('prestamo', 'bodega_producto.id', '=', 'prestamo.bodega_producto_id')
        ->get();

         if(!isset($data["bodegaid"]))
        {
            $data["bodegaid"] = Bodega::first()->id;
        }      
        $bodegas = Bodega::lists("nombre","id"); 

        $bodega = Bodega::find($data["bodegaid"]);
         $productos = $bodega->muchasproducto()->groupby("producto_id")->select(DB::raw("SUM(cantidad) as suma,nombre"))->where("tipo","=",3)->get();

         $productosarray = "";
         foreach ($productos as $producto) {
             $productosarray[] = $producto->nombre;
             $stock[] = ($producto->suma)*-1;//$stock[] = ;
         }

        return View::make('informe.bodega.prestamo')
        ->with("productos",json_encode($productosarray))
        ->with("stock",json_encode($stock))
        ->with("titulo", $titulo)
        ->with("data",$data)
        ->with("bodegas",$bodegas)
        ->with("prestamos",$prestamos);
}







// ATENCION MEDICA

public function atencionmedicaanual(){

    $titulo = "Cantidad de atencion medicas";
    $personals = Personal::lists("nombre","id");
    $personals0 = array(""=>"-- Personal --");
    $personals = $personals0 + $personals;

    $diaturno = Medica::lists("diaturno","diaturno");
    $diaturno0 = array(""=>"--Dia Turno--");
    $diaturno = $diaturno0 + $diaturno;

    $diagnostico = Medica::lists("diagnostico","diagnostico");
    $diagnostico0 = array(""=>"--Diagnostico--");
    $diagnostico = $diagnostico0 + $diagnostico;

    $clasificacion = Medica::lists("clasificacion","clasificacion");
    $clasificacion0 = array(""=>"--Clasificacion--");
    $clasificacion = $clasificacion0 + $clasificacion;

    $comuna = Medica::lists("comuna","comuna");
    $comuna0 = array(""=>"--Comuna--");
    $comuna = $comuna0 + $comuna;

        $data = Input::all();
       
        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }  
        if(!isset($data["personal"]))
        {
            $data["personal"] = "";
        }  
        if(!isset($data["diaturno"]))
        {
            $data["diaturno"] = "";
        }
        if(!isset($data["diagnostico"]))
        {
            $data["diagnostico"] = "";
        }
        if(!isset($data["clasificacion"]))
        {
            $data["clasificacion"] = "";
        }
        if(!isset($data["comuna"]))
        {
            $data["comuna"] = "";
        }
       


        for($i=1; $i<=12; $i++)
        {
       // $programada[] = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$i)->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->count("*");
       // $realizada[] =  DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$i)->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->where("estado","=","Cerrada")->count("*");
          $sql = Medica::where(DB::raw("MONTH(created_at)"),"=",$i)->where(DB::raw("YEAR(created_at)"),"=",$data["ano"]); 
           
           if($data["personal"] != "")
           {
            $sql = $sql->where("personal_id","=",$data["personal"]); 
           }
           if($data["diaturno"] != "")
           {
            $sql = $sql->where("diaturno","=",$data["diaturno"]);
           }
            if($data["diagnostico"] != "")
           {
            $sql = $sql->where("diagnostico","=",$data["diagnostico"]);
           }
           if($data["clasificacion"] != "")
           {
            $sql = $sql->where("clasificacion","=",$data["clasificacion"]);
           }
           if($data["comuna"] != "")
           {
            $sql = $sql->where("comuna","=",$data["comuna"]);
           }



           
            $cantidad[] = $sql->count("*");
        }
    
       
        return View::make('informe.medica.atencionmedicaanual')
        ->with("cantidad",$cantidad)
        ->with("personals",$personals)
        ->with("titulo", $titulo)
        ->with("diaturno",$diaturno)
        ->with("diagnostico",$diagnostico)
        ->with("clasificacion",$clasificacion)
        ->with("comuna",$comuna)
        ->with("data",$data);
}



public function atencionmedicapersonal()
{
        $titulo = "Cantidad de atencion medicas";
        $data = Input::all();

        //$personals = Personal::lists("nombre","id");
       $cantidad = array();
       $personals=array();
         if(!isset($data["mes"]))
        {
            $data["mes"] = date("n");
        }
        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }   

         $atencionmedicas = Medica::join("personal","personal.id","=","medica.personal_id")->where(DB::raw("MONTH(medica.created_at)"),"=",$data["mes"])->where(DB::raw("YEAR(medica.created_at)"),"=",$data["ano"])->select(DB::raw("COUNT(*) as cant, personal_id"))->groupby("personal_id")->get(); 
           
        foreach ($atencionmedicas as $atencion) {
           $cantidad[] = $atencion->cant;
           $personals[] = Personal::find($atencion->personal_id)->nombre;
        }
       
       //return json_encode($personals);
        return View::make('informe.medica.atencionmedicapersonal')
        ->with("cantidad",json_encode($cantidad))
        ->with("personals",json_encode($personals))
        ->with("titulo", $titulo)
        ->with("data",$data);
}



public function informepdf(){
    $data = Input::all();

    $view = View::make('informe.informepdf')
    ->with("data",$data);

    return PDF::load($view, 'a4', 'portrait')->download();

}

}



?>
