<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_request extends Model
{
    use HasFactory;
    protected $table='user_request';
    protected $fillable = [
        'id_user',
       
        
        'image_rasheta',
    ];
    

    public function address(){
        return $this->belongsTo('App\Models\Address','id_address','id');
      }
      public function bill_driver(){
        return $this->HasONe('App\Models\Bill_driver','id_bill_driver','id');
      }

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    
    public function BreakUserRequestMedicinePh()
    {
     return $this->hasMany(Break_user_request_medicine_ph::class);

    }
}
