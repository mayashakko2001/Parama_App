<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Warehouse_medicine;
use App\Models\Break_warehouse_medicine;
use App\Models\Pharma_request;
use App\Models\Break_ph_request_medicine;
use App\Models\Bill_pharma;
use Illuminate\Support\Facades\DB;



use App\Models\Complaint_warehouse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\FileController as FileController;
class WarehouseController extends FileController
{
    public function requestJoinWarehouse(Request $request)
    {
        $data = $request->validate([
            'WaName' => 'required|string',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required',
            'WaPhone' => 'required',
            'license' => 'required',
        ]);
    
        if (!$data) {
            return response()->json([
                'message' => 'error'
            ], 200);
        }
    
        $input = Warehouse::where('email', $request->email)->first();
    
        if ($input) {
            return response()->json(['message' => 'There is a similar email, please use a new email'], 500);
        }
    
        $cv = $request->file('license');
        $cvName = $cv->getClientOriginalName();
        $cvPath = $cv->storeAs('public/uploads', $cvName);
    
        $image1 = null;
        $cvPath1 = null;
        if ($request->hasFile('image')) {
            $image1 = $request->file('image');
            $cvName1 = $image1->getClientOriginalName();
            $cvPath1 = $image1->storeAs('public/uploads', $cvName1);
        } else {
            $cvPath1 = null; // تعيين قيمة null عندما لا يتم تحديد صورة
        }
    
        $warehouse = Warehouse::create([
            'WaName' => $request->WaName,
            'WaPhone' => $request->WaPhone,
            'license' => $cvPath,
            'email' => $request->email,
            'image' => $cvPath1,
            'password' => Hash::make($request->password)
        ]);
    
        return response()->json(['message' => 'Warehouse saved successfully'], 200);
    }
//..................................................................................................
public function loginWarehouse(Request $request)
{
    $fields = $request->validate([
        'email' => 'required|string',
        'password' => 'required|string'
    ]);

    $warehouse = Warehouse::where('email', $fields['email'])->first();

    if (!$warehouse || !Hash::check($fields['password'], $warehouse->password)) {
        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
    }

    if ($warehouse->state !== 'accept') {
        return response()->json([
            'message' => 'Login not allowed for the provided state'
        ], 401);
    }

    $token = $warehouse->createToken('warehouse-token')->plainTextToken;

    $response = [
        'warehouse' => $warehouse,
        'token' => $token
    ];

    return response()->json($response, 200);
}
//..............................................................................................
public function addMedicinWa(Request $request)
{
    $d = Auth::user();
    $dd = $d->id;
    $cmedicine = $request->validate([
        'price' => 'required',
        'quantety' => 'required',
        'name_company' => 'required|string',
        'name_medicine' => 'required|string',
    ]);

    $cvPath3 = null; // تعيين القيمة الافتراضية لمسار الصورة إلى قيمة فارغة

    if ($request->hasFile('image')) {
        $cv3 = $request->file('image');
        $cvName3 = $cv3->getClientOriginalName();
        $cvPath3 = $cv3->storeAs('public/uploads', $cvName3);
    }

    $warehouse = Warehouse_medicine::create([
        'price' => $request->price,
        'quantety' => $request->quantety,
        'name_company' => $request->name_company,
        'name_medicine' => $request->name_medicine,
        'image' => $cvPath3,
    ]);
    $x = $warehouse->id;

    $v = Break_warehouse_medicine::create([
        'id_warehouse' => $dd,
        'id_medicine_wa' => $x,
    ]);

    return response()->json(['message' => 'Warehouse medicine saved successfully'], 200);
}
//.......................................................................
public function Acceptrequestpharma($id)
  {

      $pharma_request = Bill_pharma::find($id);

      if (!$pharma_request) {
          return response()->json(['error' => 'warehouse not found'], 404);
      }

      $pharma_request->update([
          'state' => 'accept',
      ]);

      return response()->json([
          'message' => 'Bill pharma  accepted successfully',
          'info office' => $pharma_request
      ], 200);

  }
//...........................................................................
public function notAcceptrequestpharma($id)
{

    $pharma_request = Bill_pharma::find($id);

    if (!$pharma_request) {
        return response()->json(['error' => 'warehouse not found'], 404);
    }

    $pharma_request->update([
        'state' => 'disallow',
    ]);

    return response()->json([
        'message' => 'Bill pharma  disallow successfully',
        'info office' => $pharma_request
    ], 200);

}
//..........................................................................
public function deleteMedicineWarehouse($id)
{
    $user = Warehouse_medicine::find($id);

    if(empty($user)) {
        return response()->json([
            'message' => 'Warehouse medicine not found'
        ], 404);
    }

    $user1 = $user->id;

    $x = Break_warehouse_medicine::where('id_medicine_wa', $user1)->first();

    if ($x) {
        $x->delete();
    }

    $user->delete();

    return response()->json(['message' => 'Warehouse deleted successfully'], 200);
}
//..................................................................................
public function showmedicinewa()
{
    $user = Auth::user();
    $user1 = $user->id;
    $warehousemedicines = Break_warehouse_medicine::where('id_warehouse', $user1)->get();

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
//..................................................................................

//.....................................................................
public function updateWarehousemedicin(Request $request,$id)
{ $warehouse = Warehouse_medicine::where('id', $id)->update($request->all());

    return response()->json(['data' => $warehouse, 'message' => "updated", 200]);
}
//........................................................................
public function subscription_wa()
{
    $user = Auth::user();
    $id_pharma = $user->id;

    $pharmacy = Warehouse::find($id_pharma);
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
///////////////////////////////
public function delete_requests($id)
{
    $pharmaRequest = Pharma_request::find($id);

    if (empty($pharmaRequest)) {
        return response()->json([
            'message' => 'Error: Pharma request not found'
        ], 200);
    }

    $id_bill_pharma = $pharmaRequest->id_bill_pharma;

    $billPharma = Bill_pharma::where('id_bill_pharma', $id_bill_pharma)->first();

    if (empty($billPharma)) {
        return response()->json([
            'message' => 'Error: Invalid bill or bill not found'
        ], 200);
    }

    if ($billPharma->state_bill === 'accept') {
        $pharmaRequest->delete(); // حذف الناعم
        return response()->json(['message' => 'Pharma_request deleted successfully'], 200);
    } else {
        return response()->json([
            'message' => 'Error: Invalid bill state or bill not in "accept" state'
        ], 200);
    }
}





public function showAllRequestsPh()
{
    $requests = Break_ph_request_medicine::with('medicine')->get();

    return response()->json($requests, 200);
}
}