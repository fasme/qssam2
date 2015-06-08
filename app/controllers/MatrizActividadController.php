<?php
class MatrizActividadController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $matrizactividads = MatrizActividad::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.actividad.show')->with("matrizactividads",$matrizactividads);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $matrizactividad = new MatrizActividad; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matriz.actividad.formulario')->with("matrizactividad",$matrizactividad);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $matrizactividad = new MatrizActividad;

        $datos = Input::all(); 
        
        if ($matrizactividad->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matrizactividad->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $matrizactividad->save();

            return Redirect::to('matrizactividad')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matrizactividad/insert')->withInput()->withErrors($matrizactividad->errors);
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
      
 
           $matrizactividad = MatrizActividad::find($id);
   
        return View::make('matriz.actividad.formulario')->with("matrizactividad", $matrizactividad);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $matrizactividad = MatrizActividad::find($id);



        $datos = Input::all(); 
        
        if ($matrizactividad->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matrizactividad->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $matrizactividad->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('matrizactividad')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matrizactividad/update/'.$id)->withInput()->withErrors($matrizactividad->errors);
            //return "mal2";
        }

        return Redirect::to('matrizactividad')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $matrizactividad = MatrizActividad::find($id);

        $matrizactividad->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>