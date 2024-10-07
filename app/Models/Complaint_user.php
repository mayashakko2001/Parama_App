<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint_user extends Model
{
    use HasFactory;
    protected $table='complaint_user';
    protected $fillable = [
        'id_user',
        'category_user',
        'description',
        'his_phone',
        'his_email',
       
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
