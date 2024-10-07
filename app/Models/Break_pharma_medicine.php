<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Break_pharma_medicine extends Model
{
    use HasFactory;
    protected $table='break_pharma_medicine';
    protected $fillable = [
        'id_pharma',
        'id_ph_medicine',
       
    ];
    
    public function pharma()
    {
        return $this->belongsTo(Pharmacy::class,'id_pharma');
    }
    
    public function pharmaMedicine()
    {
        return $this->belongsTo(Pharma_medicine::class,'id_medicine_ph');
    }
    
}
