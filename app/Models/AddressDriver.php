<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDriver extends Model
{
    use HasFactory;
    protected $table='address_driver';
    protected $fillable = [
        'Governorate_name',
        'Area_name',
        'street_name',
        'id_driver',
    ];


    public function userRequest(){
        return $this->belongsTo('App\Models\Driver','id_driver','id');
      }
}
