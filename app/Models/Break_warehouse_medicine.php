<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Break_warehouse_medicine extends Model
{
    use HasFactory;
    protected $table='break_warehouse_medicine';
    protected $fillable = [
        'id_warehouse',
        'id_medicine_wa',
       
    ];
    
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'id_warehouse');
    }
    
    public function warehouseMedicine()
    {
        return $this->belongsTo(Warehouse_medicine::class,'id_medicine_wa');
    }
}
