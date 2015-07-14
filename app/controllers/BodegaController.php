<?php
class BodegaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $bodegas = Bodega::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('bodega.bodega.show')->with("bodegas",$bodegas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $bodega = new Bodega; 
    
        
        return View::make('bodega.bodega.formulario')->with("bodega",$bodega);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $bodega = new Bodega;

        $datos = Input::all(); 

        $random = rand(0,99999);
        
        if ($bodega->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


       

            $bodega->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $bodega->save();

            return Redirect::to('bodega')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('bodega/insert')->withInput()->withErrors($bodega->errors);
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
      
 
           $bodega = Bodega::find($id);
           $categoria = Categoria::lists("nombre","id");
   
        return View::make('bodega.bodega.formulario')
        ->with("bodega", $bodega)
        ->with("categoria",$categoria);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $bodega = Bodega::find($id);



         $datos = Input::all(); 

         $random = rand(0,99999);
        
        if ($bodega->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


         

            $bodega->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $bodega->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('bodega')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('bodega/update/'.$id)->withInput()->withErrors($bodega->errors);
            //return "mal2";
        }

        return Redirect::to('bodega')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $bodega = Bodega::find($id);

        $bodega->delete();

    //return Redirect::to('usuarios/insert');
    }









}



?>