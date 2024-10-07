<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 use App\Models\Pay;
class PaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
      $inn=  Pay::create([
    
      
          'value_pay' =>100000,
         
          
          
      ]);
  }
}
