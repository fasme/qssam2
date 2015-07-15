<?php
class PrestamoController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
         $prestamos = DB::table("bodega_prestamo")->get();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('bodega.prestamo.show')->with("prestamos",$prestamos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
            $productos = Producto::lists("nombre","id");
        $bodegas = Bodega::lists("nombre","id");
        $personals = Personal::lists("nombre","id");
    
        
        return View::make('bodega.prestamo.formulario')->with("productos",$productos)
        ->with("bodegas",$bodegas)
        ->with("personals",$personals);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        

        $datos = Input::all(); 

        $datos["cantidad"] = $datos["cantidad"] * -1;

        $random = rand(0,99999);

        DB::insert('insert into bodega_prestamo (bodega_id, producto_id, personal_id, tipo,cantidad) values (?, ?,?,?,?)', array($datos["bodega_id"], $datos["producto_id"], $datos["personal_id"], $datos["tipo"], $datos["cantidad"]));
        
       
       return Redirect::to('prestamo');
    // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios
 
    }
 
     /**
     * Ver usuario con id
     */

    public function update($id) //get
    {
        //echo $id;
      
 
           $prestamo = Prestamo::find($id);
           $categoria = Categoria::lists("nombre","id");
   
        return View::make('bodega.prestamo.formulario')
        ->with("prestamo", $prestamo)
        ->with("categoria",$categoria);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $prestamo = Prestamo::find($id);



         $datos = Input::all(); 

         $random = rand(0,99999);
        
        if ($prestamo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


         

            $prestamo->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $prestamo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('prestamo')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('prestamo/update/'.$id)->withInput()->withErrors($prestamo->errors);
            //return "mal2";
        }

        return Redirect::to('prestamo')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $prestamo = Prestamo::find($id);

        $prestamo->delete();

    //return Redirect::to('usuarios/insert');
    }


    public function devolver()
    {
        $id = Input::get('id');

        DB::update('update bodega_prestamo set cantidad = cantidad*-1, tipo=2  where id = ?', array($id));
        return $id;
    }









}



?>