<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValuationDr extends Model
{
    use HasFactory;
    
    protected $table='valuation_d_r';
    protected $fillable = [
        'id_driver',
        'id_star',
        'id_user',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class,'id_driver');
    }
    public function star()
    {
        return $this->belongsTo(Star::class,'id_star');
    }
    
}
