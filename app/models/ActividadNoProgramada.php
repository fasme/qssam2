<?php
class ActividadNoProgramada extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'actividad_noprogramada';
    protected $fillable = array('actividad','frecuencia');


    public function muchaspersonal()
{
    return $this->belongsToMany("Personal",'actividad_responsable','actividad_id','personal_id')
    ->withpivot("id","estado","tipoactividad","adjunto1","adjunto2","adjunto3","adjunto4","adjunto5");
}





public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
            'frecuencia'     => 'required',
            "personal_id" => "required",
            
         
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }





}
?>