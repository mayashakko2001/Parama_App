<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        
      $inn=  User::create([
    
        'FirstName' =>'John',
       'lastName'=>'Doe',
        'email' =>'johndoe@example.com',
        'password' =>bcrypt('johan$$'),
        'role' =>0,
        'UsPhone'=>'0998888888',
        
        
    ]);
}
}