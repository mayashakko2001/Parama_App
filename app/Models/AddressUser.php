<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressUser extends Model
{
    use HasFactory;
    protected $table='users';
    protected $fillable = [
        'Governorate_name',
        'Area_name',
        'street_name',
        'id_user',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','id_user','id');
      }
    
}
