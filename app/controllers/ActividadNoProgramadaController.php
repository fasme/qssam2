<?php
class ActividadNoProgramadaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $actividadnoprogramadas = ActividadNoProgramada::join("actividad_responsable_noprogramada","actividad_noprogramada.id","=","actividad_responsable_noprogramada.actividad_id")->Where("personal_admin_id","=",Auth::user()->id)->get();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('actividad.noprogramada.show')->with("actividadnoprogramadas",$actividadnoprogramadas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $actividadnoprogramada = new ActividadNoProgramada; 
        $personals = Personal::lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('actividad.noprogramada.formulario')
        ->with("actividadnoprogramada",$actividadnoprogramada)
        ->with("personals",$personals);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $actividadnoprogramada = new ActividadNoProgramada;

         $datos = Input::all(); 
        
        if ($actividadnoprogramada->isValid($datos))
        {
            

            $actividadnoprogramada->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $actividadnoprogramada->save();

           $actividadnoprogramada = ActividadNoProgramada::find($actividadnoprogramada->id);
           //echo count($datos["actividad_id"]);
           for($i=0;$i<count($datos["personal_id"]);$i++)
           {
            
            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $frecuencia = "$ano-$mes-$dia";

            $actividadnoprogramada->muchaspersonal()->attach($datos["personal_id"][$i],array("frecuencia"=>$frecuencia, "personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"noprogramada"));
            

            $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = $datos["personal_id"][$i];  // id_de
            $alerta->personal_id_admin = Auth::user()->id;  // id_para
            $alerta->tipo = "aportal";
            $alerta->save();


// CORREO
            Mail::send('emails.emailactividad', array('key' => 'value'), function($message) use($datos, $i)
{             

    $message->from(Personal::find(Auth::user()->id)->correo, '');
    $message->to(Personal::find($datos["personal_id"][$i])->correo, '')->subject('Nueva Actividad No Programada!');
});
            // FIN correo



           }


            return Redirect::to('actividadnoprogramada')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('actividadnoprogramada/update/'.$id)->withInput()->withErrors($actividadnoprogramada->errors);
            //return "mal2";
        }
     //   return Redirect::to('usuarios');
    // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios
 
    }
 
     /**
     * Ver usuario con id
     */

    public function update($id) //get
    {
        //echo $id;
      
 
           $actividadnoprogramada = ActividadNoProgramada::find($id);
           $personals = Personal::lists("nombre","id");
   
        return View::make('actividad.noprogramada.formulario')
        ->with("actividadnoprogramada", $actividadnoprogramada)
        ->with("personals",$personals);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $actividadnoprogramada = ActividadNoProgramada::find($id);



        $datos = Input::all(); 
        
        if ($actividadnoprogramada->isValid($datos))
        {

            $actividadnoprogramada->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            


        $actividadnoprogramada->muchaspersonal()->detach();
           for($i=0;$i<count($datos["personal_id"]);$i++)
           {
            
            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $frecuencia = "$ano-$mes-$dia";

            $actividadnoprogramada->muchaspersonal()->attach($datos["personal_id"][$i],array("frecuencia"=>$frecuencia, "personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"noprogramada"));
            

             $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = $datos["personal_id"][$i];  // id_de
            $alerta->personal_id_admin = Auth::user()->id;  // id_para
            $alerta->tipo = "aportal";
            $alerta->save();


            // CORREO
            Mail::send('emails.emailactividad', array('key' => 'value'), function($message) use($datos, $i)
{             

    $message->from(Personal::find(Auth::user()->id)->correo, '');
    $message->to(Personal::find($datos["personal_id"][$i])->correo, '')->subject('Nueva Actividad No Programada!');
});
            // FIN correo
            
           }


           $actividadnoprogramada->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('actividadnoprogramada')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('actividadnoprogramada/insert')->withInput()->withErrors($actividadnoprogramada->errors);
            //return "mal2";
        }

        return Redirect::to('actividadnoprogramada')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $actividadnoprogramada = ActividadNoProgramada::find($id);

        $actividadnoprogramada->delete();

    //return Redirect::to('usuarios/insert');
    }



     public function mostrar()
    {

$id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
       
        $actividadnoprogramada = ActividadNoProgramada::find($id);
           $personals = Personal::lists("nombre","id");
   
        return View::make('actividad.noprogramada.mostrar')
        ->with("actividadnoprogramada", $actividadnoprogramada)
        ->with("personals",$personals);
 
        
    }



 






}



?>