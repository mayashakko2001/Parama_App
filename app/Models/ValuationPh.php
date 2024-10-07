<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValuationPh extends Model
{
    use HasFactory;
    
    protected $table='valuation_p_h';
    protected $fillable = [
        'id_pharma',
        'id_star',
        'id_user',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function pharma()
    {
        return $this->belongsTo(Pharmacy::class,'id_pharma');
    }
    public function star()
    {
        return $this->belongsTo(Star::class,'id_star');
    }

}
