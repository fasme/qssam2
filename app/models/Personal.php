<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Personal extends Eloquent implements UserInterface,RemindableInterface { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'personal';
   
   protected $fillable = array('id','nombre','rut','cargo_id','usuario', 'password','remember_token', 'fono', 'correo','perfil'); // los campos de la tabla


   public function cargo(){
    return $this->belongsTo("Cargo");
   }

   public function personal(){
    return $this->belongsTo("Personal");
   }



   public function actividadesProgramadas(){
        return $this->belongsToMany('ActividadProgramada', 'actividad_responsable', 'personal_id', 'actividad_id')->withPivot("tipoactividad","id", "estado","adjunto1", "adjunto2","adjunto3","adjunto4","adjunto5");
    }

    public function actividadesNoProgramadas(){
        return $this->belongsToMany('ActividadNoProgramada', 'actividad_responsable', 'personal_id', 'actividad_id')->withPivot("tipoactividad","id","estado","adjunto1", "adjunto2","adjunto3","adjunto4","adjunto5");
    }



    public $errors;
    
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            'nombre' => 'required',
            'rut'     => 'required',
            'correo' => 'required|email'
            
            
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
       
        
        return false;
    }







    //funcion para el editar usuario, de esta forma la contraseña no es enviada
    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
     

            $this->attributes['password'] = Hash::make($value);
        }
    }




public function getAuthIdentifier()
{
    return $this->getKey();
}

/**
 * Get the password for the user.
 *
 * @return string
 */
public function getAuthPassword()
{
    return $this->password;
}

/**
 * Get the e-mail address where password reminders are sent.
 *
 * @return string
 */
public function getReminderEmail()
{
    return $this->email;
}

public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
}

public function getRememberTokenName()
{
    return 'remember_token';
}
  





    }
?>