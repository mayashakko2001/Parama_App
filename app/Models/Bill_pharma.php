<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_pharma extends Model
{
    use HasFactory;
    protected $table='bill_pharma';
    protected $fillable = [
        'id_pharma',
        'state_bill',
        
    ];
    
    public function pharma()
    {
        return $this->belongsTo(Pharmacy::class,'id_pharma');
    }
    
   
    public function pharma_request()
    {
     return $this->hasMany(Pharma_request::class);

    }
   
}
