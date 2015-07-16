<?php
class CursoController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $cursos = Curso::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('capacitacion.curso.show')->with("cursos",$cursos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $curso = new Curso; 
        $categoria = Categoria::lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('capacitacion.curso.formulario')->with("curso",$curso)->with("categoria",$categoria);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $curso = new Curso;

        $datos = Input::all(); 

        $random = rand(0,99999);
        
        if ($curso->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario

            if($datos["fecha"])
            {
                list($dia,$mes,$ano) = explode("/",$datos['fecha']);
            $datos['fecha'] = "$ano-$mes-$dia";

            }


            $curso->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $curso->save();

            return Redirect::to('curso')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('curso/insert')->withInput()->withErrors($curso->errors);
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
      
 
           $curso = Curso::find($id);
           
   
        return View::make('capacitacion.curso.formulario')
        ->with("curso", $curso);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $curso = Curso::find($id);



         $datos = Input::all(); 

         $random = rand(0,99999);
        
        if ($curso->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario

if($datos["fecha"])
            {
                list($dia,$mes,$ano) = explode("/",$datos['fecha']);
            $datos['fecha'] = "$ano-$mes-$dia";

            }

            $curso->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $curso->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('curso')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('curso/update/'.$id)->withInput()->withErrors($curso->errors);
            //return "mal2";
        }

        return Redirect::to('curso')->with("mensaje","NO");
      
    }


    public function asignar($id)
    {
        $curso = Curso::find($id);
        $personals = Personal::lists("nombre","id");

        return View::make("capacitacion.asignar.formulario")
        ->with("curso",$curso)
        ->with("personals",$personals);
    }

public function asignar2($id)
{

    $datos = Input::all();
     $curso = Curso::find($id);


     foreach ($datos["personal_id"] as $personalid) {
       
        $personal = Personal::find($personalid);
         $curso->muchaspersonal()->attach($personal);
     }
        //$personal = Personal::find($personalid);

      
      
}

    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $curso = Curso::find($id);

        $curso->delete();

    //return Redirect::to('usuarios/insert');
    }
 

    public function eliminarasignacion()
    {
        $cursoid = Input::get('cursoid'); //acedemos a la variable id traida por AJAX ($.get)
        $personalid = Input::get("personalid");
        
        $curso = Curso::find($cursoid);
        $personal = Personal::find($personalid);

      
       
        $curso->muchaspersonal()->detach($personal);

        //$curso->delete();

    //return Redirect::to('usuarios/insert');
    }


 






}



?>