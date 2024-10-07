<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_driver extends Model
{

    use HasFactory;
    protected $table='bill_driver';

    protected $fillable = [
        'id_driver',
        'state_bill',
        'state_bill_driver',
        'id_user_request'
       
    ];
    
    public function driver()
    {
        return $this->belongsTo(Driver::class,'id_driver');
    }
}
