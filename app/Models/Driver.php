<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Driver extends Model
{use SoftDeletes;
    use HasFactory;
    protected $table='driver';
    protected $fillable = [
        'DrName',
        'email',
        'DrPhone',
        'password',
        'cv',
        'role',
        'state',
        'transport',
        'image',
        
       
    ];
   
    public function billDriver()
    {
     return $this->hasMany(Bill_driver::class);

    }
    
    public function valuationDr()
    {
     return $this->hasMany(ValuationDr::class);

    }
    
    public function complaintDriver()
    {
     return $this->hasMany(Complaint_driver::class);

    }

}
