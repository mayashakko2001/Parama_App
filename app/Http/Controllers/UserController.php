<?php

namespace App\Http\Controllers;
use  App\Models\User;
use Illuminate\Http\Request;
use  App\Models\ValuationDr;
use  App\Models\ValuationPh;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FileController as FileController;
class UserController extends FileController
{
    public function register(Request $request)
    {
        
     $data=$request->validate([
     'FirstName'=>'required|string|max:191',
     'lastName'=>'required|string|max:191',
     'email'=>'required|email|max:191|unique:users,email',
     'password'=>'required|string',
     'UsPhone'=>'required|string|regex:/^09[0-9]{8}$/',
     'image'=>'required',

     ]);

     $image1 = $request->file('image');
     $cvName1 = $image1->getClientOriginalName();
     $cvPath1 = $image1->storeAs('public/uploads', $cvName1);
 
         
     $user=User::create([
         'FirstName'=>$data['FirstName'],
         'lastName'=>$data['lastName'],
         'email'=>$data['email'],
         'image'=>$cvPath1,
         'password'=>Hash::make($data['password']),       
         'UsPhone'=>$data['UsPhone'],

     ]);

       
     $token = $user->createToken('ghaidaaProjectToken')->plainTextToken;

     $response=[
     'user'=>$user,
     'token'=>$token,

     ];
     
 return response( $response,201);


    }

///////////////////2
    
    public function loginUser(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Password is worng or email'
            ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

   ////////////3

    public function logoutUser(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
    public function valuationDr(Request $request)
    {
     $user=Auth::user();
     $user1=$user->id;
        $req = $request->validate([
            'id_driver' => 'required',
            'id_star' => 'required',
           
        ]);

        $data=ValuationDr::create([
            'id_driver'=>$req['id_driver'],
            'id_star'=>$req['id_star'],
           
            'id_user'=>$user1,
            
        ]);

        return response()->json([
            'message' => 'valuation Driver successfully'], 200);

    } 


    public function valuationPh(Request $request)
    {
     $user=Auth::user();
     $user1=$user->id;
        $req = $request->validate([
            'id_pharma' => 'required',
            'id_star' => 'required',
           
        ]);

        $data=ValuationPh::create([
            'id_pharma'=>$req['id_pharma'],
            'id_star'=>$req['id_star'],
           
            'id_user'=>$user1,
            
        ]);

        return response()->json([
            'message' => 'valuation Pharmacy successfully'], 200);

    } 


    ////////////////
    ////////////////////////////
   /* 
public function countStarOne()
{
    $count1 = ValuationDr::where('id_star', 1)->count();
    $count2 = ValuationDr::where('id_star', 2)->count();
    $count3 = ValuationDr::where('id_star', 3)->count();
    $count4 = ValuationDr::where('id_star', 4)->count();
    $count5 = ValuationDr::where('id_star', 5)->count();
    $max_count = max($count1, $count2, $count3, $count4, $count5);
   

}*/

public function countStarOne($id)
{
    $counts = ValuationDr::where('id_driver',$id)->select('id_star', DB::raw('count(*) as count'))
        ->groupBy('id_star')
        ->orderBy('count', 'desc')
        ->first();

    return [
        'count' => $counts->count,
        'id_star' => $counts->id_star,
    ];
}


////////////////

public function countStarTwo($id)
{
    $counts = ValuationPh::where('id_pharma',$id)->select('id_star', DB::raw('count(*) as count'))
        ->groupBy('id_star')
        ->orderBy('count', 'desc')
        ->first();

    return [
        'count' => $counts->count,
        'id_star' => $counts->id_star,
    ];
}

}
