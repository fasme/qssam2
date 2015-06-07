<?php
class Matriz extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'matriz';
    protected $fillable = array('proceso','matriz_actividad_id','matriz_peligro_id','rutinaria','factorseveridad','factorexposicion','factorprobabilidad','resultado','actprevio','totalprevio', 'resultadoprevio', 'acteliminacion', 'totaleliminacion','resultadoeliminacion','actsustitucion','totalsustitucion','resultadosustitucion','actingenieria','totalingenieria','resultadoingenieria','actadministrativo','resultadoadministrativo','actepp', 'totalepp','resultadoepp','magnitud');







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