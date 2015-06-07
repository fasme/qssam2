<?php
class EvidenciaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $evidencias = Evidencia::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('evidencias.show')->with("evidencias",$evidencias);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $evidencia = new Evidencia; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('evidencias.formulario')->with("evidencia",$evidencia);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $evidencia = new Evidencia;

        $datos = Input::all(); 
        
        if ($evidencia->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $evidencia->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $evidencia->save();

            return Redirect::to('evidencia')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('evidencia/insert')->withInput()->withErrors($evidencia->errors);
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
      
 
           $evidencia = Evidencia::find($id);
   
        return View::make('evidencias.formulario')->with("evidencia", $evidencia);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $evidencia = Evidencia::find($id);



        $datos = Input::all(); 
        
        if ($evidencia->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $evidencia->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $evidencia->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('evidencia')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('evidencia/update/'.$id)->withInput()->withErrors($evidencia->errors);
            //return "mal2";
        }

        return Redirect::to('evidencia')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $evidencia = Evidencia::find($id);

        $evidencia->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>