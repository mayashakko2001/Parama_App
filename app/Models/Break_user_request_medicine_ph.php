<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Break_user_request_medicine_ph extends Model
{
    use HasFactory;
    protected $table='break_user_request_medicine_ph';
    protected $fillable = [
        'id_user_request',
        'id_ph_medicine',
        'image_rasheta',
        'quantety',
       
    ];
    
    public function userRequest()
    {
        return $this->belongsTo(User_request::class,'id_user_request');
    }
    
    public function PharmaMedicine()
    {
        return $this->belongsTo(Pharma_medicine::class,'id_ph_medicine');
    }
}
