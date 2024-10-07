<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;
    protected $table='pin';
    protected $fillable = [
        'PIN',  
        'id_billDriver',   
    ];
    public function Bill_driver()
    {
        return $this->hasOne(Bill_driver::class,'id_billDriver');
    }




}
