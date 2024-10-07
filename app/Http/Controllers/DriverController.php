<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\FileController as FileController;
use App\Models\Address;
use App\Models\Pharmacy;
use App\Models\Warehouse;
use App\Models\User_request;
use App\Models\AddressPharma;
use App\Models\Bill_driver;
use App\Models\Break_pharma_medicine;
use Illuminate\Support\Facades\Auth;

use App\Models\Driver;
use App\Models\AddressDriver;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DriverController extends FileController
{
public function requestJoinDriver(Request $request)
    {
        $data = $request->validate([
            'DrName' => 'required',
            'email' => 'required',
            'DrPhone' => 'required|string|regex:/^09[0-9]{8}$/',           
            'password' => 'required',
            'cv' => 'required',
            'transport' => 'required',
            'image'=>'required',
        ]);

        if (!$data) {
            return response()->json([
                'message' =>
                ' errort'
            ], 401);

        }

        $input = Driver::where('email', $request->email)->first();

        if ($input) {
            return response()->json(['message' => 'There is a similar email, please use a new email'], 500);
        }

       // $photo = $this->saveFile($request, 'cv', public_path('public/uploads'));
    
       else{
       $cv = $request->file('cv');
       $cvName = $cv->getClientOriginalName();
       $cvPath = $cv->storeAs('public/uploads', $cvName);

       $cv1 = $request->file('image');
       $cvName1 = $cv1->getClientOriginalName();
       $cvPath1 = $cv1->storeAs('public/uploads', $cvName1);


        $driver = Driver::create([
           
            'DrName' => $request->DrName,
            'DrPhone' => $request->DrPhone,
            'transport' => $request->transport,
            'cv' => $cvPath,
            'image'=>$cvPath1,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        
        return response()->json(['message' => 'Driver saved successfully'], 200);

    }
    }

    //.........................................................................................
    public function showAllAcceptrequestfromdriver(Request $request)
    {
        $req = Bill_driver::where('state_bill', 'accept')->get();
    
        $userRequests = [];
    
        foreach ($req as $bill) {
            $userRequest = User_request::where('id_bill_driver', $bill->id)->first();
    
            if ($userRequest) {
                $userRequests[] = $userRequest;
    
                $address = Address::where('id_userRequest', $userRequest->id)->first();
                $userRequest->address_user = $address;
    
           
                }
                
                return response()->json([
                    'message' => 'All accepted requests',
                    'info_driver' => $req,
                    'user_request' => $userRequests,
                ], 200);
    }
}
//...........................................................................................
public function Acceptrequestuser_driver($id)
{

    $pharma_request = Bill_driver::find($id);

    if (!$pharma_request) {
        return response()->json(['error' => 'pharma not found'], 404);
    }

    $pharma_request->update([
        'state_bill_driver' => 'accept',
    ]);

    return response()->json([
        'message' => 'Bill driver  accept successfully',
        'info office' => $pharma_request
    ], 200);

}











}