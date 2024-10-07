<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Pharma_request extends Model
{
    use HasFactory;
  
    protected $table='pharma_request';
  
    protected $fillable = [
        'id_pharma',
        'id_bill_pharma',
       
    ];
    
    public function pharma()
    {
        return $this->belongsTo(Pharmacy::class,'id_pharma');
    }
    
    public function billPharma(): HasOne
    {
        return $this->hasOne(Bill_pharma::class, 'id_request_ph', 'id_request_ph');
    }

    public function getIdBillPharmaAttribute()
    {
        $billPharma = $this->billPharma;

        if ($billPharma) {
            return $billPharma->id_bill_pharma;
        }

        return null;
    }
    
    function breakPhRequestMedicine()
    {
     return $this->hasMany(Break_ph_request_medicine::class);

    }
}
