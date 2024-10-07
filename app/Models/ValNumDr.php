<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValNumDr extends Model
{
    use HasFactory;
    protected $table='val_number_dr';
    protected $fillable = [
        'id_driver',
        'num',
        
        
    ];

    
    public function driver()
    {
        return $this->belongsTo(Driver::class,'id_driver');
    }

}
