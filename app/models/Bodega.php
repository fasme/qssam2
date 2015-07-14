<?php
class Bodega extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'bodega';
    protected $fillable = array('nombre');


/*
public function categoria()
{
    return $this->belongsTo("Categoria");
}
*/


    public function muchasproducto()
{
    return $this->belongsToMany("Producto",'bodega_producto','bodega_id','producto_id')
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