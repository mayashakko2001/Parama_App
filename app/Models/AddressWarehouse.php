<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressWarehouse extends Model
{
    use HasFactory;
    protected $table='address_warehouse';
    protected $fillable = [
        'Governorate_name',
        'Area_name',
        'street_name',
        'id_warehouse',
    ];
    
    public function warehouse(){
        return $this->belongsTo('App\Models\Warehouse','id_warehouse','id');
      }
}
