<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint_driver extends Model
{
    use HasFactory;
    protected $table='complaint_driver';
    protected $fillable = [
        'id_driver',
        'category_user',
        'description',
        'his_phone',
        'his_email',
       
    ];
    
    public function driver()
    {
        return $this->belongsTo(Driver::class,'id_driver');
    }
}
