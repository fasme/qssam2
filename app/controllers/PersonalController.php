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
            // Si la data es valida se la asignamos al usuario
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



 






}



?>