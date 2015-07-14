<?php
class producto extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'producto';
    protected $fillable = array('nombre','stock','tipoproducto','codigo', 'unidad');



public function productotransaccion()
{
    return $this->hasMany("ProductoTransaccion");
}


public function muchasbodega()
{
    return $this->belongsToMany("Bodega",'bodega_producto','producto_id','bodega_id')
    ->withpivot("tipo","cantidad")
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