<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint_warehouse extends Model
{
    use HasFactory;
    protected $table='complaint_warehouse';
    protected $fillable = [
        'id_warehouse',
        'category_user',
        'description',
        'his_phone',
        'his_email',
       
    ];
    
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'id_warehouse');
    }
}
