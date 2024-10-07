<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pay;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\FileController as FileController;
use App\Models\Address;
use App\Models\Pharmacy;
use App\Models\Warehouse;
use App\Models\Driver;
use App\Models\Complaint_warehouse;
use App\Models\Complaint_pharma;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use LaravelJsonApi\Eloquent\Filters\OnlyTrashed;

class AdminController extends FileController
{
    public function loginAdmin(Request $request)
    {$fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {

            return response([ 'message' => 'Password is worng or email' ], 401);
        }
        $token = $user->createToken('GhaidaaFarwan')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
//....................................................................................................
    public function ShowAdminProfile()
    {
      $id=Auth::id();
       $data = User::where('id',$id)->get()->first();
       return  response()->json($data,200);


    }
//....................................................................................................
    public function updateprofileAdmin(Request $request)
    { $id = Auth::id();
        $admin = User::where('id', $id)->update($request->all());
        return response()->json(['data' => $admin, 'message' => "updated", 200]);
    }

//.....................................................................................................
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }


//.....................................................................................................
    public function AcceptDriver($id)
    {
        $driver = Driver::find($id);
        if (!$driver) {
            return response()->json(['error' => 'Driver not found'], 404);
        }
        $driver->update([
            'state' => 'accept',
        ]);

        return response()->json(['message' => 'Driver accepted successfully','info office' => $driver], 200);

    }
    
//.......................................................................................................
    public function AcceptWarehouse($id)
    { $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json(['error' => 'warehouse not found'], 404);
        }
        $warehouse->update([
            'state' => 'accept',
        ]);
        return response()->json(['message' => 'warehouse accepted successfully','info office' => $warehouse], 200);

    }
    
//...........................................................................................................
    public function AcceptPharma($id)
    { $pharma = Pharmacy::find($id);

        if (!$pharma) {
            return response()->json(['error' => 'pharmacy not found'], 404);
        }

        $pharma->update([
            'state' => 'accept',
        ]);

        return response()->json(['message' => 'pharmacy accepted successfully','info pharma' => $pharma], 200);

    }

//..........................................................................................................

public function AcceptWarehouse1($id)
{ $warehouse = Warehouse::find($id);

    if (!$warehouse) {
        return response()->json(['error' => 'warehouse not found'], 404);
    }

    $warehouse->update([
        'state2' => 'accept',
    ]);

    return response()->json(['message' => 'warehouse accepted state1 successfully','info office' => $warehouse], 200);

}

//...........................................................................................................
public function AcceptPharma1($id)
{$pharma = Pharmacy::find($id);

    if (!$pharma) {
        return response()->json(['error' => 'pharmacy not found'], 404);
    }

    $pharma->update([
        'state2' => 'accept',
    ]);

    return response()->json(['message' => 'pharmacy accepted state1 successfully','info pharma' => $pharma], 200);

}
//...........................................................................................................

public function AcceptWarehouse2($id)
{$warehouse = Warehouse::find($id);

    if (!$warehouse) {
        return response()->json(['error' => 'warehouse not found'], 404);
    }

    $warehouse->update([
        'state3' => 'accept',
    ]);

    return response()->json(['message' => 'warehouse accepted state2 successfully','info office' => $warehouse], 200);

}
//................................................................................................................
public function AcceptPharma2($id)
{$pharma = Pharmacy::find($id);

    if (!$pharma) {
        return response()->json(['error' => 'pharmacy not found'], 404);
    }

    $pharma->update([
        'state3' => 'accept',
    ]);

    return response()->json(['message' => 'pharmacy accepted state2 successfully','info pharma' => $pharma], 200);

}
//...........................................................................................................
public function notAcceptDriver($id)
{$driver = Driver::find($id);

    if (!$driver) {
        return response()->json(['error' => 'Driver not found'], 404);
    }

    $driver->update([
        'state' => 'disallow',
    ]);

    return response()->json([
        'message' => 'Driver accepted successfully',
        'info office' => $driver,
        
    ], 200);

}
//.....................................................................................................
public function notAcceptWarehouse($id)
{$warehouse = Warehouse::find($id);

    if (!$warehouse) {
        return response()->json(['error' => 'warehouse not found'], 404);
    }

    $warehouse->update([
        'state' => 'disallow',
    ]);

    return response()->json(['message' => 'warehouse disallow successfully','info office' => $warehouse,], 200);

}
//........................................................................................................
public function notAcceptPharma($id)
{$pharma = Pharmacy::find($id);

    if (!$pharma) {
        return response()->json(['error' => 'pharmacy not found'], 404);
    }

    $pharma->update([
        'state' => 'disallow',
    ]);

    return response()->json(['message' => 'pharmacy disallow successfully','info pharma' => $pharma,], 200);

}
//........................................................................................................
public function notAcceptWarehouse1($id)
{$warehouse = Warehouse::find($id);

    if (!$warehouse) {
        return response()->json(['error' => 'warehouse not found'], 404);
    }

    $warehouse->update([
        'state2' => 'disallow',
    ]);

    return response()->json([
        'message' => 'warehouse disallow successfully',
        'info office' => $warehouse,
       
    ], 200);

}
//........................................................................................................
public function notAcceptPharma1($id)
{$pharma = Pharmacy::find($id);

    if (!$pharma) {
        return response()->json(['error' => 'pharmacy not found'], 404);
    }

    $pharma->update([
        'state2' => 'disallow',
    ]);

    return response()->json([
        'message' => 'pharmacy disallow successfully',
        'info pharma' => $pharma,
       
    ], 200);

}
//........................................................................................................

public function notAcceptWarehouse2($id)
{$warehouse = Warehouse::find($id);

    if (!$warehouse) {
        return response()->json(['error' => 'warehouse not found'], 404);
    }

    $warehouse->update([
        'state3' => 'disallow',
    ]);

    return response()->json([
        'message' => 'warehouse disallow successfully',
        'info office' => $warehouse,
       
    ], 200);

}
//...................................................................................................
public function notAcceptPharma2($id)
{$pharma = Pharmacy::find($id);

    if (!$pharma) {
        return response()->json(['error' => 'pharmacy not found'], 404);
    }

    $pharma->update([
        'state3' => 'disallow',
    ]);

    return response()->json([
        'message' => 'pharmacy disallow successfully',
        'info pharma' => $pharma,
       
    ], 200);

}
//......................................................................................................
public function showAllAcceptPharma1()
{
$pharmacy=Pharmacy::where(['state2' => 'accept'])->get();
return response()->json([ 'message' => 'pharmacy  All accepted state2 ','info pharma' => $pharmacy], 200);
}
//......................................................................................................
public function showAllAcceptWarehouse1()
{
    $warehouse=Warehouse::where(['state2' => 'accept'])->get();
    return response()->json([
        'message' => 'warehouse  All accepted state2',
        'info warehouse' => $warehouse
    ], 200);

}
//......................................................................................................
public function showAllAcceptPharma2()
{
    $pharmacy=Pharmacy::where(['state3' => 'accept'])->get();
    return response()->json([
        'message' => 'pharmacy  All accepted  state3',
        'info pharma' => $pharmacy
    ], 200);
}
//.....................................................................................................
public function showAllAcceptWarehouse2()
{
    $warehouse=Warehouse::where(['state3' => 'accept'])->get();
    return response()->json([
        'message' => 'warehouse  All accepted state3 ',
        'info warehouse' => $warehouse
    ], 200);

}
//...................................................................................................
public function showAllAcceptPharma()
{
    $pharmacy=Pharmacy::where(['state' => 'accept'])->get();
    return response()->json([
        'message' => 'pharmacy  All accepted ',
        'info pharma' => $pharmacy
    ], 200);
}
//...................................................................................................
public function showAllAcceptWarehouse()
{
    $warehouse=Warehouse::where(['state' => 'accept'])->get();
    return response()->json([
        'message' => 'warehouse  All accepted ',
        'info warehouse' => $warehouse
    ], 200);

}
//....................................................................................................
public function showAllAcceptDriver()
{

    $driver=Driver::where(['state' => 'accept'])->get();
    return response()->json([
        'message' => 'driver  All accepted ',
        'info driver' => $driver
    ], 200);

}
//...................................................................................................
public function showAllNotYetDeterminedPharma()
{
    $pharmacy=Pharmacy::where(['state' => 'NotYetDetermined'])->get();
    return response()->json([
        'message' => 'pharmacy  All NotYetDetermined ',
        'info pharma' => $pharmacy
    ], 200);
}
//....................................................................................................
public function showAllNotYetDeterminedWarehouse()
{
    $warehouse=Warehouse::where(['state' => 'NotYetDetermined'])->get();
    return response()->json([
        'message' => 'warehouse  All NotYetDetermined ',
        'info warehouse' => $warehouse
    ], 200);

}
//....................................................................................................
public function showAllNotYetDeterminedDriver()
{

    $driver=Driver::where(['state' => 'NotYetDetermined'])->get();
    return response()->json([
        'message' => 'driver  All NotYetDetermined ',
        'info driver' => $driver
    ], 200);

}
//....................................................................................................
public function showPharma($id)
{
    $pharmacy=Pharmacy::where(['id' => $id])->get()->first();
    return response()->json([
        'info pharma' => $pharmacy
    ], 200);
}
//...................................................................................................
public function showWarehouse($id)
{
    $warehouse=Warehouse::where(['id' => $id])->get()->first();
    return response()->json([
        'info warehouse' => $warehouse
    ], 200);

}
//...................................................................................................
public function showDriver($id)
{

    $driver=Driver::where(['id' => $id])->get()->first();
    return response()->json([
        'info driver' => $driver
    ], 200);

}
//.........................................................................................
public function add_Driver(Request $request) 
{
    $request->validate([
        'DrPhone' => 'required',
        'email' => 'required',
        'password' => 'required',
        'DrName' => 'required',
        'cv' => 'required',
        'transport' => 'required',
        'state' => 'required',
    ]);

    $cv = $request->file('cv');
    $cvName = $cv->getClientOriginalName();
    $cv->storeAs('public/uploads', $cvName);

    $drive = new Driver();
    $drive->DrPhone = $request->DrPhone;
    $drive->email = $request->email;
    $drive->DrName = $request->DrName;
    $drive->cv = $cvName;
    $drive->state = $request->state;
    $drive->transport = $request->transport;
    $drive->password = bcrypt($request->password);
    $drive->save();

    return response()->json([
        'message' => 'added successfully',
        'drive' => $drive
    ], 200);
}
//....................................................................................................
public function add_pharmacy(Request $request)
{$request -> validate([
    'PhName' => 'required|string',
    'email' => 'required|email|max:191|unique:pharmacy,email',
    'password' => 'required',
    'PhPhone' => 'required',
    'certificate' => 'required',
    'license' => 'required',
    
   ]);
 $license = $request->file('license');
 $licenseName = $license->getClientOriginalName();
 $licensePath = $license->storeAs('public/uploads', $licenseName);

 $certificate = $request->file('certificate');
 $certificateName = $certificate->getClientOriginalName();
 $certificatePath = $certificate->storeAs('public/uploads', $certificateName);

 $pharmacy = Pharmacy::create([
           
    'PhName' => $request->PhName,
    'PhPhone' => $request->PhPhone,
    'license' => $licensePath,
    'certificate' => $certificatePath,
    'email' => $request->email,
    'password' => Hash::make($request->password)
 ]  );
 return response()->json(['message' => 'pharmacy saved successfully'], 200);

}
//....................................................................................................
public function add_warehouse(Request $request){
    $data = $request->validate([
        'WaName' => 'required|string',
        'email' => 'required|email|max:191|unique:warehouse,email',
        'password' => 'required',
        'WaPhone' => 'required',
       
        'license' => 'required',
        
    ]);
    $cv = $request->file('license');
    $cvName = $cv->getClientOriginalName();
    $cvPath = $cv->storeAs('public/uploads', $cvName);


  $warehouse = Warehouse::create([
           
            'WaName' => $request->WaName,
            'WaPhone' => $request->WaPhone,
            'license' => $cvPath,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        return response()->json(['message' => 'warehouse saved successfully'], 200);

}

//..............................................................................................
public function add_user(Request $request)
{
    
 $data=$request->validate([
 'FirstName'=>'required|string|max:191',
 'lastName'=>'required|string|max:191',
 'email'=>'required|email|max:191|unique:users,email',
 'password'=>'required|string',
 'UsPhone'=>'required',


 ]);     
 $user=User::create([
     'FirstName'=>$data['FirstName'],
     'lastName'=>$data['lastName'],
     'email'=>$data['email'],
     'password'=>Hash::make($data['password']),       
     'UsPhone'=>$data['UsPhone'],
     
     
 ]);

 return response()->json(['message' => 'user saved successfully'], 200);
}
//.........................................................................................

public function soft_delete_user($id)
{
    $user = User::find($id);
    if(empty($user)) {
        return response()->json([
            'message' =>
            ' error'
        ], 200);
   }
   $user->delete($id);
   return response()->json(['message' => 'user delete successfully'], 200);}
    //.......................................................................................
    public function soft_delete_pharmacy($id)
    {
        $pharmacy = Pharmacy::find($id);
        if(empty($pharmacy)) {
            return response()->json([
                'message' =>
                ' error'
            ], 200);
       }
       $pharmacy->delete($id);
       return response()->json(['message' => 'pharmacy delete successfully'], 200);
}

//..........................................................................................
public function soft_delete_warehouse($id)
{
    $Warehouse = Warehouse::find($id);
    if(empty($Warehouse)) {
        return response()->json([
            'message' =>
            ' error'
        ], 200);
   }
   $Warehouse->delete($id);
   return response()->json(['message' => 'warehouse delete successfully'], 200);
}
//.............................................................................................
public function soft_delete_driver($id)
{
    $d = Driver::find($id);
    if(empty($d)) {
        return response()->json([
            'message' =>
            ' error'
        ], 200);
   }
   $d->delete($id);
   return response()->json(['message' => 'driver delete successfully'], 200);
}

//.................................................................................................
    public function back_from_soft_delete_user($id)
{
    $admin = User::onlyTrashed()->where('id',$id)->first();
    
    if(empty($admin)) {
       return;
    }
    
    $admin->restore();
    
    
    return response()->json(['message' => 'user back from delete successfully'], 200);
      
    
}
//...............................................................................................
public function back_from_soft_delete_ph($id){
    $admin = Pharmacy::onlyTrashed()->where('id',$id)->first();
    
    if(empty($admin)) {
       return;
    }
    
    $admin->restore();
    
    return response()->json(['message' => 'pharmacy back from delete successfully'], 200);
    
}
//...................................................................................................
public function back_from_soft_delete_wa($id)
{
    $admin = Warehouse::onlyTrashed()->where('id',$id)->first();
    
    if(empty($admin)) {
       return;
    }
    
    $admin->restore();
    
 
    return response()->json(['message' => 'warehouse back from delete successfully'], 200);
    
}
//.......................................................................................................
public function back_from_soft_delete_dr($id)
{
    $admin = Driver::onlyTrashed()->where('id',$id)->first();
    
    if(empty($admin)) {
        return response()->json(['message' => 'cannot find'], 200);
    }
    
    $admin->restore();
    return response()->json(['message' => 'Driver back from delete successfully'], 200);
    
   
      
    
}
//......................................................................................................
public function updateprofilewarehousebyAdmin(Request $request)
{
    $admin = Warehouse::where('id', $request->id)->update($request->all());

    return response()->json(['data' => $admin, 'message' => "updated", 200]);
}
//........................................................................................................
public function showpay()
{
  $f=Pay::get()->first();
  $h=$f->value_pay;


    $admin1 = User::where('role',0)->get()->first();
    $admin = $admin1->UsPhone;
    return response()->json(['data' => $admin,'value_pay' => $h, 'message' => "pay via syriatel cash to the following number of all month", 200]);
}
//.........................................................................................................
public function updateprofilepharmacybyAdmin(Request $request)
{
    $admin = Pharmacy::where('id', $request->id)->update($request->all());

    return response()->json(['data' => $admin, 'message' => "updated", 200]);
}
//.........................................................................................................
public function showAlldisallowPharma()
{
    $pharmacy=Pharmacy::where(['state' => 'disallow'])->get();
    return response()->json([
        'message' => 'pharmacy  All disallow ',
        'info pharma' => $pharmacy
    ], 200);
}
//.........................................................................................................
public function showAlldisallowWarehouse()
{
    $warehouse=Warehouse::where(['state' => 'disallow'])->get();
    return response()->json([
        'message' => 'warehouse  All disallow ',
        'info warehouse' => $warehouse
    ], 200);

}
//.........................................................................................................
public function showAlldisallowPharma1()
{
    $pharmacy=Pharmacy::where(['state2' => 'disallow'])->get();
    return response()->json([
        'message' => 'pharmacy  All disallow state2 ',
        'info pharma' => $pharmacy
    ], 200);
}
//.........................................................................................................
public function showAlldisallowWarehouse1()
{
    $warehouse=Warehouse::where(['state2' => 'disallow'])->get();
    return response()->json([
        'message' => 'warehouse  All disallow state2 ',
        'info warehouse' => $warehouse
    ], 200);

}
//.........................................................................................................
public function showAlldisallowPharma2()
{
    $pharmacy=Pharmacy::where(['state3' => 'disallow'])->get();
    return response()->json([
        'message' => 'pharmacy  All disallow state3  ',
        'info pharma' => $pharmacy
    ], 200);
}
//.........................................................................................................
public function showAlldisallowWarehouse2()
{
    $warehouse=Warehouse::where(['state3' => 'disallow'])->get();
    return response()->json([
        'message' => 'warehouse  All disallow state3 ',
        'info warehouse' => $warehouse
    ], 200);

}
//.......................................................................................................
public function showAlldisallowDriver()
{

    $driver=Driver::where(['state' => 'disallow'])->get();
    return response()->json([
        'message' => 'driver  All disallow ',
        'info driver' => $driver
    ], 200);

}
//........................................................................................................
public function show_complaintsPh()
{
    $complaints = Complaint_pharma::all();
    
    return response()->json($complaints, 200);
}
//........................................................................................................
public function show_complaintsWa()
{
    $complaints = Complaint_warehouse::all();
    
    return response()->json($complaints, 200);
}
//.........................................................................................................
public function show_complaintWa_byId($complaintId)
{
    $complaint = Complaint_warehouse::find($complaintId);
    
    if (!$complaint) {
        return response()->json(['message' => 'Complaint not found'], 404);
    }
    
    return response()->json($complaint, 200);
}
//.........................................................................................................
public function show_complaintPh_byId($complaintId)
{
    $complaint = Complaint_pharma::find($complaintId);
    
    if (!$complaint) {
        return response()->json(['message' => 'Complaint not found'], 404);
    }
    
    return response()->json($complaint, 200);
}
//












}    

    






















