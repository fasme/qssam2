<?php
class ActividadProgramada extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'actividad_programada';
    protected $fillable = array('elementoestrategico','cumplimientonormativo','numero', 'requisito', 'actividad', 'frecuencia');

   public function muchaspersonal()
{
    return $this->belongsToMany("Personal",'actividad_responsable','actividad_id','personal_id')
    ->withpivot("id","estado","tipoactividad","adjunto1");
}





public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
          //  'cliente_id'     => 'exists:cliente,id',
          //  "guiavalue" => "required",
            
         
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