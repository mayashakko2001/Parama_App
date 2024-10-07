<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint_pharma extends Model
{
    use HasFactory;
    protected $table='complaint_pharma';
    protected $fillable = [
        'id_pharma',
        'category_user',
        'description',
        'his_phone',
        'his_email',
       
    ];
    
    public function pharma()
    {
        return $this->belongsTo(Pharmacy::class,'id_pharma');
    }
}
