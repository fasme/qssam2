<?php
class MatrizController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $matrizs = Matriz::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matrizs.show')->with("matrizs",$matrizs);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $matriz = new Matriz; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matrizs.formulario')->with("matriz",$matriz);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $matriz = new Matriz;

        $datos = Input::all(); 
        
        if ($matriz->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matriz->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $matriz->save();

            return Redirect::to('matriz')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matriz/insert')->withInput()->withErrors($matriz->errors);
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
      
 
           $matriz = Matriz::find($id);
   
        return View::make('matrizs.formulario')->with("matriz", $matriz);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $matriz = Matriz::find($id);



        $datos = Input::all(); 
        
        if ($matriz->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matriz->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $matriz->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('matriz')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matriz/update/'.$id)->withInput()->withErrors($matriz->errors);
            //return "mal2";
        }

        return Redirect::to('matriz')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $matriz = Matriz::find($id);

        $matriz->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>