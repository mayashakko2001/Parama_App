<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Public_record extends Model
{
    use HasFactory;
    protected $table='public_record';
    protected $fillable = [
        'id_pharma',
        'id_warehouse',
        'id_driver',
        'id_user',
       
       
    ];
    
    public function user(){
        return $this->belongsTo('App\Models\User','id_user','id');
      }
      
     public function warehouse(){
        return $this->belongsTo('App\Models\Warehouse','id_warehouse','id');
      }
      
     public function driver(){
        return $this->belongsTo('App\Models\Driver','id_driver','id');
      }
      
     public function pharma(){
        return $this->belongsTo('App\Models\Pharmacy','id_pharma','id');
      }
}
