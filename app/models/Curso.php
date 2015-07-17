<?php
class Curso extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'curso';
    protected $fillable = array('nombre','fecha','lugar', 'contenido','relator','otec','duracion','estado');




public function muchaspersonal()
{
    return $this->belongsToMany("Personal",'curso_personal','curso_id','personal_id')
    ->withpivot("id", "aprobado")
    ->withTimestamps();
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