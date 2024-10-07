<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValNumPh extends Model
{
    use HasFactory;
    protected $table='val_number_ph';

    protected $fillable = [
        'id_pharma',
        'num',
       
        
    ];

    
    public function pharma()
    {
        return $this->belongsTo(Pharmacy::class,'id_pharma');
    }

}
