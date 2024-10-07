<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharma_medicine extends Model
{
    use HasFactory;
    protected $table='pharma_medicine';
    protected $fillable = [
        'price',
        'quantety',
        'name_medicine',
        'name_company',
        'image',
    ];
    
    public function BreakUserRequestMedicinePh()
    {
     return $this->hasMany(Break_user_request_medicine_ph::class);

    }
    function breakPharmaMedicine()
    {
     return $this->hasMany(Break_pharma_medicine::class);

    }
}
