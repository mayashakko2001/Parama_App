<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
class Pharmacy extends Model
{use SoftDeletes;
    use HasApiTokens,HasFactory;
    protected $table='pharmacy';
    public $timestamps=true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'PhName',
        'PhPhone',
        'role',
        'email',
        'password',
        'state',
        'license',
        'certificate',
        'image',
        'state3',
        'state2'
        
       
    ];
    
    public function valuationPh()
    {
     return $this->hasMany(ValuationPh::class);

    }
    
      
    public function ph_request()
    {
     return $this->hasMany(Pharma_request::class);

    }
    
    public function complaintPh()
    {
     return $this->hasMany(Complaint_pharma::class);

    }
    
    public function billPh()
    {
     return $this->hasMany(Bill_pharma::class);

    }
    
    public function breakPhMedicine()
    {
     return $this->hasMany(Break_pharma_medicine::class);

    }
  
}
