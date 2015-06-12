<?php
class PacController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $pacs = Pac::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('pac.show')->with("pacs",$pacs);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $pac = new Pac; 
        $categoria = Categoria::lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('pac.formulario')->with("pac",$pac)->with("categoria",$categoria);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $pac = new Pac;

        $datos = Input::all(); 

        $random = rand(0,99999);
        
        if ($pac->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


            if (Input::hasFile("pac"))
                {
                    $adjunto1 = Input::file('pac');
                    $datos["pac"] = $random."_".$adjunto1->getClientOriginalName();
                    $adjunto1->move("pacs/biblioteca",$random."_".$adjunto1->getClientOriginalName());
                    
                   
                }


            $pac->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $pac->save();

            return Redirect::to('pac')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('pac/insert')->withInput()->withErrors($pac->errors);
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
      
 
           $pac = Pac::find($id);
           $categoria = Categoria::lists("nombre","id");
   
        return View::make('pac.formulario')
        ->with("pac", $pac)
        ->with("categoria",$categoria);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $pac = Pac::find($id);



        $datos = Input::all(); 

         $random = rand(0,99999);
        
        if ($pac->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


            if (Input::hasFile("pac"))
                {
                    $adjunto1 = Input::file('pac');
                    $datos["pac"] = $random."_".$adjunto1->getClientOriginalName();
                    $adjunto1->move("pacs/biblioteca",$random."_".$adjunto1->getClientOriginalName());
                    
                   
                }


            $pac->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $pac->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('pac')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('pac/update/'.$id)->withInput()->withErrors($pac->errors);
            //return "mal2";
        }

        return Redirect::to('pac')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $pac = Pac::find($id);

        $pac->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>