<?php
class ProductoTransaccionController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {

        $bodegas = Bodega::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('bodega.transaccion.show')->with("bodegas",$bodegas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        //$productotransaccion = new ProductoTransaccion; 
        $productos = Producto::lists("nombre","id");
        $bodegas = Bodega::lists("nombre","id");
    //    $personals = Personal::lists("nombre","id");
    
        
        return View::make('bodega.transaccion.formulario')
        ->with("bodegas",$bodegas)
        ->with("productos",$productos);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        //$productotransaccion = new ProductoTransaccion;



         $datos = Input::all(); 

         $bodega = Bodega::find($datos["bodega_id"]);

         for($i=0; $i<count($datos["producto_id"]); $i++)
        {
        
         //$producto = Producto::find($datos["producto_id"]);
        $producto = Producto::find($datos["producto_id"][$i]);

        if($datos["tipo"] == 2)
            {
                $datos["cantidad"][$i] = $datos["cantidad"][$i] * -1;
            }

          //  $productotransaccion->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            $bodega->muchasproducto()->attach($datos["producto_id"][$i], array("tipo"=>$datos["tipo"], "cantidad"=>$datos["cantidad"][$i], "documento"=>$datos["documento"], "numdocumento"=>$datos["numdocumento"], "origendestino"=>$datos["origendestino"]));
         
    }

    
        
     
            // Si la data es valida se la asignamos al usuario


             // $productotransaccion->save();

            //return Redirect::to('productotransaccion')->with("mensaje","Datos Ingresados correctamente");
       return Redirect::back()->with('message','Datos ingresado Correctamente'); 
     //   return Redirect::to('usuarios');
    // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios
 
    }
 
     /**
     * Ver usuario con id
     */
/*
    public function update($id) //get
    {
        //echo $id;
      
 
           $productotransaccion = ProductoTransaccion::find($id);
           $categoria = Categoria::lists("nombre","id");
   
        return View::make('bodega.transaccion.formulario')
        ->with("productotransaccion", $productotransaccion)
        ->with("categoria",$categoria);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $productotransaccion = ProductoTransaccion::find($id);



         $datos = Input::all(); 

         $random = rand(0,99999);
        
        if ($productotransaccion->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


         

            $productotransaccion->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $productotransaccion->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('productotransaccion')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('productotransaccion/update/'.$id)->withInput()->withErrors($productotransaccion->errors);
            //return "mal2";
        }

        return Redirect::to('productotransaccion')->with("mensaje","NO");
      
    }

*/

    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        //$productotransaccion = ProductoTransaccion::find($id);

        DB::table('bodega_producto')->where("id","=",$id)->delete();
        //$productotransaccion->delete();

    //return Redirect::to('usuarios/insert');
    }









}



?>