<?php
class ActividadProgramadaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $actividadprogramadas = ActividadProgramada::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('actividadprogramadas.show')->with("actividadprogramadas",$actividadprogramadas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $actividadprogramada = new ActividadProgramada; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('actividadprogramadas.formulario')->with("actividadprogramada",$actividadprogramada);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $actividadprogramada = new ActividadProgramada;

        $datos = Input::all(); 
        
        if ($actividadprogramada->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $actividadprogramada->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $actividadprogramada->save();

            return Redirect::to('actividadprogramada')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('actividadprogramada/insert')->withInput()->withErrors($actividadprogramada->errors);
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
      
 
           $actividadprogramada = ActividadProgramada::find($id);
   
        return View::make('actividadprogramadas.formulario')->with("actividadprogramada", $actividadprogramada);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $actividadprogramada = ActividadProgramada::find($id);



        $datos = Input::all(); 
        
        if ($actividadprogramada->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $actividadprogramada->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $actividadprogramada->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('actividadprogramada')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('actividadprogramada/insert')->withInput()->withErrors($actividadprogramada->errors);
            //return "mal2";
        }

        return Redirect::to('actividadprogramada')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $actividadprogramada = ActividadProgramada::find($id);

        $actividadprogramada->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>