<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
class Warehouse extends Model
{
    use SoftDeletes;
    use HasApiTokens,HasFactory;
    protected $table='warehouse';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'WaPhone',
        'WaName',
        'email',
        'state',
        'password',
        'license',
        'role',
        'state2',
        'state3',
        'image'
       
    ];
    
    public function complaintWa()
    {
     return $this->hasMany(Complaint_warehouse::class);

    }
    
    public function breakWaMedicine()
    {
     return $this->hasMany(Break_warehouse_medicine::class);

    }
    
}
