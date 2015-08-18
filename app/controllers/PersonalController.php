<?php
class PersonalController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $personals = Personal::all();
        $cargos = Cargo::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('personal.show')->with("personals",$personals)->with("cargos",$cargos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $personal = new Personal; 
        $cargo = Cargo::lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('personal.formulario')->with("personal",$personal)->with("cargo",$cargo);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $personal = new Personal;

        $datos = Input::all(); 
        
        if ($personal->isValid($datos))
        {
            
            $personal->usuario = $datos["rut"];
            $personal->password = $datos["rut"];
            $personal->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $personal->save();

            return Redirect::to('personal')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('personal/insert')->withInput()->withErrors($personal->errors);
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
      
 
           $personal = Personal::find($id);
           $cargo = Cargo::lists("nombre","id");
   
        return View::make('personal.formulario')->with("personal", $personal)->with("cargo",$cargo);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $personal = Personal::find($id);



        $datos = Input::all(); 
        
        if ($personal->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $personal->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $personal->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('personal')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('personal/update/'.$id)->withInput()->withErrors($personal->errors);
            //return "mal2";
        }

        return Redirect::to('personal')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $personal = Personal::find($id);

        $personal->delete();

    //return Redirect::to('usuarios/insert');
    }


//PORTAL
    public function evidencia()
    {

          $datos = Input::all();
        $random = rand(0,99999);

        



         if($datos["tipoactividad"] == "noprogramada")   
         {





             $actividadrespoonsable = DB::table('actividad_responsable_noprogramada')
            ->Where("id","=",$datos["id"]);

            $adjunto11 ="";
            $adjunto22="";
            $adjunto33 ="";
            $adjunto44 ="";
            $adjunto55 ="";

            $actividadrespoonsable2 = DB::table('actividad_responsable_noprogramada')->select("personal_admin_id")
            ->Where("id","=",$datos["id"])->first();
            return $actividadrespoonsable2->personal_admin_id;
           

             // CORREO
            Mail::send('emails.emailactividad', array('key' => 'value'), function($message) use($actividadrespoonsable2)
{             

    $message->from(Personal::find(Auth::user()->id)->correo, '');
    $message->to(Personal::find($actividadrespoonsable2->personal_admin_id)->correo, '')->subject('Nuevo KPI!');
});
            // FIN correo

          

            // return $actividad->muchaspersonal()->wherePivot('id', '=', 40)->first();



                
                if (Input::hasFile("adjunto1"))
                {
                    $adjunto1 = Input::file('adjunto1');
                    $adjunto11 = $random."_".$adjunto1->getClientOriginalName();
                    $adjunto1->move("archivos/evidencia",$random."_".$adjunto1->getClientOriginalName());
                    
                   
                }

                if (Input::hasFile("adjunto2"))
                {
                    $adjunto2 = Input::file('adjunto2');
                    $adjunto22 = $random."_".$adjunto2->getClientOriginalName();
                    $adjunto2->move("archivos/evidencia",$random."_".$adjunto2->getClientOriginalName());
                    

                 
                }

                if (Input::hasFile("adjunto3"))
                {
                    $adjunto3 = Input::file('adjunto3');
                    $adjunto33 = $random."_".$adjunto3->getClientOriginalName();
                    $adjunto3->move("archivos/evidencia",$random."_".$adjunto3->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto4"))
                {
                    $adjunto4 = Input::file('adjunto4');
                    $adjunto44 = $random."_".$adjunto4->getClientOriginalName();
                    $adjunto4->move("archivos/evidencia",$random."_".$adjunto4->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto5"))
                {
                    $adjunto5 = Input::file('adjunto5');
                    $adjunto55 = $random."_".$adjunto5->getClientOriginalName();
                    $adjunto5->move("archivos/evidencia",$random."_".$adjunto5->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

              //  $actividadrespoonsable->pivot->estado = "Pendiente";
                //$actividadrespoonsable->save();

                $actividadrespoonsable = DB::table('actividad_responsable_noprogramada')
            ->Where("id","=",$datos["id"])->update(array('adjunto1' => $adjunto11,'adjunto2' => $adjunto22,'adjunto3' => $adjunto33,'adjunto4' => $adjunto44,'adjunto5' => $adjunto55, "estado"=>"Pendiente", "fechaenvio"=>date("Y-m-d")));



/*
        // CORREO
            Mail::send('emails.emailactividad', array('key' => 'value'), function($message) use($datos)
{             

    $message->from(Personal::find(Auth::user()->id)->correo, '');
   /$message->to(Personal::find($administrador->id)->correo, '')->subject('Nueva Evidencia!');
});
            // FIN correo
*/

        }







        if($datos["tipoactividad"] == "kpi")   
         {




            $actividadrespoonsable = DB::table('actividad_kpi')
            ->Where("id","=",$datos["id"]);

            $adjunto11 ="";
            $adjunto22="";
            $adjunto33 ="";
            $adjunto44 ="";
            $adjunto55 ="";

            //return $actividadrespoonsable;

          

            // return $actividad->muchaspersonal()->wherePivot('id', '=', 40)->first();



                
                if (Input::hasFile("adjunto1"))
                {
                    $adjunto1 = Input::file('adjunto1');
                    $adjunto11 = $random."_".$adjunto1->getClientOriginalName();
                    $adjunto1->move("archivos/evidencia",$random."_".$adjunto1->getClientOriginalName());
                    
                   
                }

                if (Input::hasFile("adjunto2"))
                {
                    $adjunto2 = Input::file('adjunto2');
                    $adjunto22 = $random."_".$adjunto2->getClientOriginalName();
                    $adjunto2->move("archivos/evidencia",$random."_".$adjunto2->getClientOriginalName());
                    

                 
                }

                if (Input::hasFile("adjunto3"))
                {
                    $adjunto3 = Input::file('adjunto3');
                    $adjunto33 = $random."_".$adjunto3->getClientOriginalName();
                    $adjunto3->move("archivos/evidencia",$random."_".$adjunto3->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto4"))
                {
                    $adjunto4 = Input::file('adjunto4');
                    $adjunto44 = $random."_".$adjunto4->getClientOriginalName();
                    $adjunto4->move("archivos/evidencia",$random."_".$adjunto4->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto5"))
                {
                    $adjunto5 = Input::file('adjunto5');
                    $adjunto55 = $random."_".$adjunto5->getClientOriginalName();
                    $adjunto5->move("archivos/evidencia",$random."_".$adjunto5->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

              //  $actividadrespoonsable->pivot->estado = "Pendiente";
                //$actividadrespoonsable->save();

                $actividadrespoonsable = DB::table('actividad_kpi')
            ->Where("id","=",$datos["id"])->update(array('adjunto1' => $adjunto11,'adjunto2' => $adjunto22,'adjunto3' => $adjunto33,'adjunto4' => $adjunto44,'adjunto5' => $adjunto55, "estado"=>"Pendiente", "fechaenvio"=>date("Y-m-d")));

        }


        if($datos["tipoactividad"] == "programada")   
         {




            $actividadrespoonsable = DB::table('actividad_responsable_programda')
            ->Where("id","=",$datos["id"]);

            $adjunto11 ="";
            $adjunto22="";
            $adjunto33 ="";
            $adjunto44 ="";
            $adjunto55 ="";

            //return $actividadrespoonsable;

          

            // return $actividad->muchaspersonal()->wherePivot('id', '=', 40)->first();



                
                if (Input::hasFile("adjunto1"))
                {
                    $adjunto1 = Input::file('adjunto1');
                    $adjunto11 = $random."_".$adjunto1->getClientOriginalName();
                    $adjunto1->move("archivos/evidencia",$random."_".$adjunto1->getClientOriginalName());
                    
                   
                }

                if (Input::hasFile("adjunto2"))
                {
                    $adjunto2 = Input::file('adjunto2');
                    $adjunto22 = $random."_".$adjunto2->getClientOriginalName();
                    $adjunto2->move("archivos/evidencia",$random."_".$adjunto2->getClientOriginalName());
                    

                 
                }

                if (Input::hasFile("adjunto3"))
                {
                    $adjunto3 = Input::file('adjunto3');
                    $adjunto33 = $random."_".$adjunto3->getClientOriginalName();
                    $adjunto3->move("archivos/evidencia",$random."_".$adjunto3->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto4"))
                {
                    $adjunto4 = Input::file('adjunto4');
                    $adjunto44 = $random."_".$adjunto4->getClientOriginalName();
                    $adjunto4->move("archivos/evidencia",$random."_".$adjunto4->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto5"))
                {
                    $adjunto5 = Input::file('adjunto5');
                    $adjunto55 = $random."_".$adjunto5->getClientOriginalName();
                    $adjunto5->move("archivos/evidencia",$random."_".$adjunto5->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

              //  $actividadrespoonsable->pivot->estado = "Pendiente";
                //$actividadrespoonsable->save();

                $actividadrespoonsable = DB::table('actividad_responsable_programada')
            ->Where("id","=",$datos["id"])->update(array('adjunto1' => $adjunto11,'adjunto2' => $adjunto22,'adjunto3' => $adjunto33,'adjunto4' => $adjunto44,'adjunto5' => $adjunto55, "estado"=>"Pendiente", "fechaenvio"=>date("Y-m-d")));

        }



        if($datos["tipoactividad"] == "pac")   
         {




            $actividadrespoonsable = DB::table('actividad_pac')
            ->Where("id","=",$datos["id"]);

            $adjunto11 ="";
            $adjunto22="";
            $adjunto33 ="";
            $adjunto44 ="";
            $adjunto55 ="";

            //return $actividadrespoonsable;

          

            // return $actividad->muchaspersonal()->wherePivot('id', '=', 40)->first();



                
                if (Input::hasFile("adjunto1"))
                {
                    $adjunto1 = Input::file('adjunto1');
                    $adjunto11 = $random."_".$adjunto1->getClientOriginalName();
                    $adjunto1->move("archivos/evidencia",$random."_".$adjunto1->getClientOriginalName());
                    
                   
                }

                if (Input::hasFile("adjunto2"))
                {
                    $adjunto2 = Input::file('adjunto2');
                    $adjunto22 = $random."_".$adjunto2->getClientOriginalName();
                    $adjunto2->move("archivos/evidencia",$random."_".$adjunto2->getClientOriginalName());
                    

                 
                }

                if (Input::hasFile("adjunto3"))
                {
                    $adjunto3 = Input::file('adjunto3');
                    $adjunto33 = $random."_".$adjunto3->getClientOriginalName();
                    $adjunto3->move("archivos/evidencia",$random."_".$adjunto3->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto4"))
                {
                    $adjunto4 = Input::file('adjunto4');
                    $adjunto44 = $random."_".$adjunto4->getClientOriginalName();
                    $adjunto4->move("archivos/evidencia",$random."_".$adjunto4->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto5"))
                {
                    $adjunto5 = Input::file('adjunto5');
                    $adjunto55 = $random."_".$adjunto5->getClientOriginalName();
                    $adjunto5->move("archivos/evidencia",$random."_".$adjunto5->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

              //  $actividadrespoonsable->pivot->estado = "Pendiente";
                //$actividadrespoonsable->save();

                $actividadrespoonsable = DB::table('actividad_pac')
            ->Where("id","=",$datos["id"])->update(array('adjunto1' => $adjunto11,'adjunto2' => $adjunto22,'adjunto3' => $adjunto33,'adjunto4' => $adjunto44,'adjunto5' => $adjunto55, "estado"=>"Pendiente", "fechaenvio"=>date("Y-m-d")));

        }





        if($datos["tipoactividad"] == "mantencion")   
         {




            $actividadrespoonsable = DB::table('actividad_responsable_mantencion')
            ->Where("id","=",$datos["id"]);

            $adjunto11 ="";
            $adjunto22="";
            $adjunto33 ="";
            $adjunto44 ="";
            $adjunto55 ="";

            //return $actividadrespoonsable;

          

            // return $actividad->muchaspersonal()->wherePivot('id', '=', 40)->first();



                
                if (Input::hasFile("adjunto1"))
                {
                    $adjunto1 = Input::file('adjunto1');
                    $adjunto11 = $random."_".$adjunto1->getClientOriginalName();
                    $adjunto1->move("archivos/evidencia",$random."_".$adjunto1->getClientOriginalName());
                    
                   
                }

                if (Input::hasFile("adjunto2"))
                {
                    $adjunto2 = Input::file('adjunto2');
                    $adjunto22 = $random."_".$adjunto2->getClientOriginalName();
                    $adjunto2->move("archivos/evidencia",$random."_".$adjunto2->getClientOriginalName());
                    

                 
                }

                if (Input::hasFile("adjunto3"))
                {
                    $adjunto3 = Input::file('adjunto3');
                    $adjunto33 = $random."_".$adjunto3->getClientOriginalName();
                    $adjunto3->move("archivos/evidencia",$random."_".$adjunto3->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto4"))
                {
                    $adjunto4 = Input::file('adjunto4');
                    $adjunto44 = $random."_".$adjunto4->getClientOriginalName();
                    $adjunto4->move("archivos/evidencia",$random."_".$adjunto4->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto5"))
                {
                    $adjunto5 = Input::file('adjunto5');
                    $adjunto55 = $random."_".$adjunto5->getClientOriginalName();
                    $adjunto5->move("archivos/evidencia",$random."_".$adjunto5->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

              //  $actividadrespoonsable->pivot->estado = "Pendiente";
                //$actividadrespoonsable->save();

                $actividadrespoonsable = DB::table('actividad_responsable_mantencion')
            ->Where("id","=",$datos["id"])->update(array('adjunto1' => $adjunto11,'adjunto2' => $adjunto22,'adjunto3' => $adjunto33,'adjunto4' => $adjunto44,'adjunto5' => $adjunto55, "estado"=>"Pendiente", "fechaenvio"=>date("Y-m-d")));

        }

  
        


            
return Redirect::to('misactividades');


    }  //fin funcion evidencia



 
public function cambiarclave(){

    $personal = Personal::find(Auth::user()->id);
    return View::make('personal.cambiarclave')->with("personal",$personal);
        
}

public function cambiarclave2(){

    $data = Input::all();

    $personal = Personal::find($data["id"]);

    if (Hash::check($data["actual"], $personal->password))
    {
        $data["validar"] = true;
    }
    else
    {
        $data["validar"] = "NO";
    }
 
    if ($personal->isValid2($data))
    {


      
           
           $personal->password = $data["nueva"];
           $personal->save();
           return Redirect::to("login");
       


        

    }
     else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('personal/cambiarclave')->withInput()->withErrors($personal->errors);
            //return "mal2";
        }
}






}



?>