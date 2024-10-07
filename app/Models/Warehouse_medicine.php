<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse_medicine extends Model
{
    use HasFactory;
    protected $table='warehouse_medicine';
    protected $fillable = [
        'price',
        'quantety',
        'name_medicine',
        'name_company',
       'image',
    ];
    function breakWarehouseMedicine()
    {
     return $this->hasMany(Break_warehouse_medicine::class);

    }
    
    function breakPhRequestMedicine()
    {
     return $this->hasMany(Break_ph_request_medicine::class);

    }
}
