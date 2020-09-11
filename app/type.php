<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    protected $table= 'type';
    protected $fillable = ['name'];
   /*  protected $fillable = [
        'title', 'content', 'category_id',
    ]; */
    //relacion de uno a muchos 
    public function palancas_objetivos(){

        return $this->hasMany('App\palancas_objetivos');
    }
}
