<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricBill extends Model
{
    use HasFactory;
    protected $table='price_bill';
    protected $fillable = [
        'id_bill_pharma',  
        'price',   
    ];
    
    public function billpharma()
    {
        return $this->belongsTo(Bill_pharma::class,'id_bill_pharma');
    }
}
