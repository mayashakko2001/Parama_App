<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressPharma extends Model
{
    use HasFactory;
    protected $table='address_pharma';
    protected $fillable = [
        'Governorate_name',
        'Area_name',
        'street_name',
        'id_pharma',
    ];
    
    public function pharma(){
        return $this->belongsTo('App\Models\Pharmacy','id_pharma','id');
      }
}
