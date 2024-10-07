<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\Break_warehouse_medicine;
use App\Models\Break_ph_request_medicine;
use App\Models\Warehouse_medicine;
use App\Models\Break_pharma_medicine;
use App\Models\Pharma_request;
use App\Models\Bill_pharma;
use App\Models\Bill_driver;
use App\Models\Pay;
use App\Models\Complaint_pharma;
use App\Models\Break_user_request_medicine_ph;
use App\Models\Pharma_medicine;
use App\Models\User_request;
use App\Models\Pin;
use App\Models\Address;
use App\Models\Driver;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FileController as FileController;
class PharmaController extends FileController
{
    
 public function requestJoinPharma(Request $request)
    {
        $data = $request->validate([
            'PhName' => 'required|string',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required',
            'PhPhone' => 'required',
            'certificate' => 'required',
            'license' => 'required',
            'image'=>'required',
            
        ]);

        if (!$data) {
            return response()->json([
                'message' =>
                ' error'
            ], 200);

        }
  else{
        $input = Pharmacy::where('email', $request->email)->first();

        if ($input) {
            return response()->json(['message' => 'There is a similar email, please use a new email'], 500);
        }
        $cv = $request->file('license');
        $cvName = $cv->getClientOriginalName();
        $cvPath = $cv->storeAs('public/uploads', $cvName);
    
        $cv2 = $request->file('certificate');
        $cvName2 = $cv2->getClientOriginalName();
        $cvPath2 = $cv2->storeAs('public/uploads', $cvName2);


        
        $cv3 = $request->file('image');
        $cvName3 = $cv3->getClientOriginalName();
        $cvPath3 = $cv3->storeAs('public/uploads', $cvName3);

        $pharmacy = Pharmacy::create([
           
            'PhName' => $request->PhName,
            'PhPhone' => $request->PhPhone,
            'license' => $cvPath,
            'certificate' => $cvPath2,
            'image'=>$cvPath3,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        return response()->json(['message' => 'pharmacy saved successfully'], 200);

    }
    }
//...............................................................................................
public function create_bill_pharma()
{
    $pharma = Auth::user();
    $e = $pharma->id;
    
    $break1 = Bill_pharma::create([
        'id_pharma' => $e,
       
    ]);
   
return response()->json(['message' => ' create bill pharma successfully'], 200);

}
//.................................................................................................
public function create_bill_user(Request $request)
{
    $pharma = Auth::user();
    $e = $pharma->id;
    
    // التحقق من صحة قيمة id_driver
    $driver = Driver::find($e);
    if (!$driver) {
        return response()->json(['message' => 'Invalid driver'], 400);
    }
    
    $break1 = Bill_driver::create([
        'id_driver' => $e,
        'id_user_request' => $request->id_user_request,
    ]);
   
    $pin = rand(100, 999); 
    
    $pinEntry = Pin::create([
        'id_billDriver' => $break1->id,
        'PIN' => $pin,
    ]);

    return response()->json(['message' => 'Create bill user successfully', 'pin' => $pin], 200);
}
//.....................................................................................................
public function request_medicine(Request $request)
{
    $pharma = Auth::user();
    $e = $pharma->id;

    $data = $request->validate([
        'id_waMedicin' => 'required',
        'quantety' => 'required',
        'id_warehouse' => 'required',
        'id_bill_pharma'=>'required',
    ]);


    
    $break1 = Pharma_request::create([
        'id_pharma' => $e,
        'id_bill_pharma'=>$request->id_bill_pharma,
    ]);
    $b = $break1->id;

    $break = Break_ph_request_medicine::create([
        'id_waMedicin' => $request->id_waMedicin,
        'id_request_ph' => $b,
        'quantety' => $request->quantety ,
    ]);

    $break2 = Break_warehouse_medicine::create([
        'id_medicine_wa' => $request->id_waMedicin,
        'id_warehouse' => $request->id_warehouse,
    ]);


    $c=0;
    $d = Warehouse_medicine::where('id', $request->id_waMedicin)->value('quantety');

    $f=$d-$request->quantety;
   
    if($f>=0){
$break = Warehouse_medicine::where('id', $request->id_waMedicin)->update([
    'quantety' => $f,
]);

return response()->json(['message' => ' request  medicine successfully'], 200);

    }
    return response()->json(['message' => '  not request  medicine successfully'], 200);

}

//.........................................................................................
public function loginpharma(Request $request)
{
    $fields = $request->validate([
        'email' => 'required|string',
        'password' => 'required|string'
    ]);

    $pharmacy = Pharmacy::where('email', $fields['email'])->first();

    if (!$pharmacy || !Hash::check($fields['password'], $pharmacy->password)) {
        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
    }

    if ($pharmacy->state !== 'accept') {
        return response()->json([
            'message' => 'Login not allowed for the provided state'
        ], 401);
    }

    $token = $pharmacy->createToken('pharma-token')->plainTextToken;

    $response = [
        'pharma' => $pharmacy,
        'token' => $token
    ];

    return response()->json($response, 200);
}
//......................................................................................
public function addMedicinPh(Request $request)
{
    $d=Auth::user();
    $dd=$d->id;
    $cmedicine= $request->validate([
        'price' => 'required',
        'quantety' => 'required',
        'name_company' => 'required|string',
        'name_medicine' => 'required|string',
    ]);
    $cv3 = $request->file('image');
    $cvName3 = $cv3->getClientOriginalName();
    $cvPath3 = $cv3->storeAs('public/uploads', $cvName3);
    $pharma = Pharma_medicine::create([
           
        'price' => $request->price,
        'quantety' => $request->quantety,
        'name_company' => $request->name_company,
        'name_medicine' => $request->name_medicine,
        'image'=>$cvPath3,
    ]);
    $x=$pharma->id;
    
    $v = Break_pharma_medicine::create([
           
        'id_pharma' => $dd,
        'id_ph_medicine' => $x,
        
        
    ]);
    return response()->json(['message' => 'pharmacy medicine saved successfully'], 200);



}
//.....................................................................
public function deleteMedicinePharma($id)
{
    $user = Pharma_medicine::find($id);

    if(empty($user)) {
        return response()->json([
            'message' => 'Pharma medicine not found'
        ], 404);
    }

    $user1 = $user->id;
    $x = Break_pharma_medicine::where('id_ph_medicine', $user1)->first();

    if ($x) {
        $x->delete();
    }

    $user->delete();

    return response()->json(['message' => 'Pharma deleted successfully'], 200);
}
//......................................................................................
public function ShowPharmaProfile()
{
  $id1=Auth::user();
  $id=$id1->id;
   $data = Pharmacy::where('id',$id)->get()->first();
   return  response()->json($data,200);


}
//..............................................................
public function updatePharmamedicin(Request $request,$id)
{    $user = Pharma_medicine::find($id);

    if(empty($user)) {
        return response()->json([
            'message' => 'Pharma medicine not found'
        ], 404);
    }

     $pharma = Pharma_medicine::where('id', $id)->update($request->all());

    return response()->json(['data' => $pharma, 'message' => "updated", 200]);
}

//...........................................................................................
public function request_medicine_user(Request $request)
{
    $pharma = Auth::user();
    $e = $pharma->id;

    $data = $request->validate([
        'id_ph_medicine' => 'required',
        'quantety' => 'required',
        'id_pharma' => 'required',
        'Governorate_name' => 'required',
        'Area_name' => 'required',
        'street_name' => 'required',
    ]);

   
        $break1 = User_request::create([
            'id_user' => $e,
           
        ]);
    
    $b = $break1->id;

    $pharmaMedicine = Pharma_medicine::where('id', $request->id_ph_medicine)->first();

    if ($pharmaMedicine) {
        $prescriptionRequired = $pharmaMedicine->prescription_required;

        if ($prescriptionRequired === null) {
            $break = Break_user_request_medicine_ph::create([
                'id_ph_medicine' => $request->id_ph_medicine,
                'id_user_request' => $b,
                'quantety' => $request->quantety,
            ]);

            if ($break) {
                // جلب البيانات الخاصة بتفاصيل العنوان من الطلب
                $governorateName = $request->input('Governorate_name');
                $areaName = $request->input('Area_name');
                $streetName = $request->input('street_name');

                // إنشاء سجل في جدول العنوان
                $address = new Address();
                $address->id_userRequest = $b;
                $address->Governorate_name = $governorateName;
                $address->Area_name = $areaName;
                $address->street_name = $streetName;
                $address->save();

                return response()->json(['message' => 'Request medicine successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to save the data'], 400);
            }
        } elseif ($prescriptionRequired === 'yes') {
            if ($request->hasFile('image_rasheta')) {
                $image1 = $request->file('image_rasheta');
                $cvName1 = $image1->getClientOriginalName();
                $cvPath1 = $image1->storeAs('public/uploads', $cvName1);

                $break = Break_user_request_medicine_ph::create([
                    'id_ph_medicine' => $request->id_ph_medicine,
                    'id_user_request' => $b,
                    'quantety' => $request->quantety,
                    'image_rasheta' => $cvPath1,
                ]);

                if ($break) {
                    
                    $governorateName = $request->input('Governorate_name');
                    $areaName = $request->input('Area_name');
                    $streetName = $request->input('street_name');

                    
                    $address = new Address();
                    $address->id_userRequest = $b;
                    $address->Governorate_name = $governorateName;
                    $address->Area_name = $areaName;
                    $address->street_name = $streetName;
                    $address->save();

                    return response()->json(['message' => 'Request medicine successfully'], 200);
                } else {
                    return response()->json(['message' => 'Failed to save the data'], 400);
                }
            } else {
                return response()->json(['message' => 'Please upload the image_rasheta'], 400);
            }
        }
    } else {
        return response()->json(['message' => 'Medicine not found'], 404);
    }

    $break2 = Break_pharma_medicine::create([
        'id_ph_medicine' => $request->id_ph_medicine,
        'id_pharma' => $request->id_pharma,
    ]);

    $d = Pharma_medicine::where('id', $request->id_ph_medicine)->value('quantety');
    $f = $d - $request->quantety;

    if ($f >= 0) {
        $break = Pharma_medicine::where('id', $request->id_ph_medicine)->update([
            'quantety' => $f,
        ]);

        return response()->json(['message' => 'Request medicine successfully'], 200);
    } else {
        return response()->json(['message' => 'Insufficient quantity of medicine'], 400);
    }
}
//..............................................................................................
public function Acceptrequestuser($id)
{
    $pharma_request = Bill_driver::find($id);

    if (!$pharma_request) {
        return response()->json(['error' => 'pharma not found'], 404);
    }

    $pharma_request->update([
        'state_bill' => 'accept',
    ]);

    
    $medicines = $pharma_request->medicines;

    
        $breakRequestMedicine = DB::table('break_user_request_medicine_ph')
        ->select('id_ph_medicine', 'quantety')
        ->get();
    
    foreach ($breakRequestMedicine as $breakMedicine) {
        $medicineId = $breakMedicine->id_ph_medicine;
        $requestedQuantity = $breakMedicine->quantety;
    
        $pharmaMedicine = DB::table('pharma_medicine')
            ->select('quantety')
            ->where('id', $medicineId)
            ->first();
    
        if ($pharmaMedicine) {
            $currentQuantity = $pharmaMedicine->quantety;
            $newQuantity = $currentQuantity - $requestedQuantity;
    
           
            DB::table('pharma_medicine')
                ->where('id', $medicineId)
                ->update(['quantety' => $newQuantity]);
        }
    }
    

    return response()->json([
        'message' => 'Bill driver accepted successfully',
        'info_office' => $pharma_request
    ], 200);
}
//.........................................................................................
public function notAcceptrequestuser($id)
{

    $pharma_request = Bill_driver::find($id);

    if (!$pharma_request) {
        return response()->json(['error' => 'pharma not found'], 404);
    }

    $pharma_request->update([
        'state_bill' => 'disallow',
    ]);

    return response()->json([
        'message' => 'Bill driver  disallow successfully',
        'info office' => $pharma_request
    ], 200);

}
public function showmedicinewabyid($id)
{
    $user1=Warehouse::find($id);
    $warehousemedicines = Break_warehouse_medicine::where('id_warehouse', $id)->get();

    $result = [];

    foreach ($warehousemedicines as $warehousemedicine) {
        $medicine = Warehouse_medicine::find($warehousemedicine->id_medicine_wa);

        if ($medicine) {
            $result[] = [
                'id' => $medicine->id,
                'price' => $medicine->price,
                'quantity' => $warehousemedicine->quantity,
                'name_medicine' => $medicine->name_medicine,
                'name_company' => $medicine->name_company,
            ];
        }
    }

    return response()->json($result, 200);
}
//...................................................................................................

public function show_medicine_pharma()
{
    $user = Auth::user();
    $user1 = $user->id;
    $phmedicines = Break_pharma_medicine::where('id_pharma', $user1)->get();

    $result = [];

    foreach ($phmedicines as $phmedicine) {
        $medicine = Pharma_medicine::find($phmedicine->id_ph_medicine);

        if ($medicine) {
            $result[] = [
                'id' => $medicine->id,
                'price' => $medicine->price,
                'quantity' => $phmedicine->quantety,
                'name_medicine' => $medicine->name_medicine,
                'name_company' => $medicine->name_company,
            ];
        }
    }

    return response()->json($result, 200);
}
//......................................................................................................
public function search_name_medicine(Request $request)
{
    $pharmacyId = $request->input('id_pharma');
    $medicineName = $request->input('name_medicine');

    $pharmacy = Break_pharma_medicine::find($pharmacyId);

    if (!$pharmacy) {
        return response()->json(['error' => 'Pharmacy not found'], 404);
    }

    $medicines = $pharmacy->medicines()->where('name_medicine', 'like', '%' . $medicineName . '%')->get();

    return response()->json($medicines, 200);
}
//......................................................................................................
public function add_complaintPh(Request $request)
{
    $user = Auth::user();
    $id_pharma = $user->id;
    
    $pharmacy = Pharmacy::find($id_pharma);
    $email = $pharmacy->email;
    $phone = $pharmacy->PhPhone;
    
    $data = $request->validate([
        'description' => 'required|string|max:191',
        'category_user' => 'required|string',
    ]);     

    $user = Complaint_pharma::create([
        'description' => $data['description'],
        'id_pharma' => $id_pharma,
        'his_email' => $email,
        'category_user' => $data['category_user'],       
        'his_phone' => $phone, 
    ]);

    return response()->json(['message' => 'user saved successfully'], 200);
}
//................................................................................................
public function subscription_ph()
{
    $user = Auth::user();
    $id_pharma = $user->id;

    $pharmacy = Pharmacy::find($id_pharma);
    $current_time = time();
    $created_time = strtotime($pharmacy->created_at);
    $months_difference = round(($current_time - $created_time) / (30 * 24 * 60 * 60)); 

    if ($months_difference >= 1) { 
        $pharmacy->state2 = 'disallow';
        $pharmacy->save();
        $pharmacy->delete();
        return response()->json(['message' => 'Subscription expired and deleted successfully'], 200);
    }

    $pharmacy->save();
    return response()->json(['message' => 'Subscription active'], 200);
}
//...........................................................................................










public function showAllRequestsPhbyph()
{
    $user = Auth::user();
    $id_pharma = $user->id;

  $requests = Break_ph_request_medicine::whereHas('pharmaRequest', function ($query) use ($id_pharma) {
    $query->where('id_pharma', $id_pharma);
})->with('medicine')->get();

$req = Pharma_request::where('id_bill_pharma', $id_pharma)->get();
$r = Bill_pharma::whereIn('state_bill', $req->pluck('id_pharma'))->get();

return response()->json([
    'requests' => $requests,
    'pharma_requests' => $req,
    'state_bill' => $r
], 200);
}}