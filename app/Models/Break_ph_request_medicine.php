<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Break_ph_request_medicine extends Model
{
    use HasFactory;
    protected $table='break_ph_request_medicine';
    protected $fillable = [
        'id_waMedicin',
        'id_request_ph',
        'quantety',
       
    ];
    
    public function warehouseMedicine()
    {
        return $this->belongsTo(Warehouse_medicine::class,'id_waMedicin');
    }
    
    public function pharmaRequest()
    {
        return $this->belongsTo(Pharma_request::class,'id_request_ph');
    }
    
public function medicine()
{
    return $this->belongsTo(Warehouse_medicine::class, 'id_waMedicin');
}
}
