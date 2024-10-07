<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table='address';
    protected $fillable = [
        'Governorate_name',
        'Area_name',
        'street_name',
        'id_userRequest',
    ];


    public function userRequest(){
        return $this->belongsTo('App\Models\User_request','id_userRequest','id');
      }
    }