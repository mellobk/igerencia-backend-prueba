<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class palancas_objetivos extends Model
{
    protected $table= 'palancas_objetivos';
    protected $fillable = ['type_id','description','year_P_O'];
   /*  protected $fillable = [
        'title', 'content', 'category_id',
    ]; */
    //relacion de uno a muchos 
    public function type(){

        return $this->belongsTo('App\type', 'type_id');
    }

}
