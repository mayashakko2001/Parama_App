<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\PharmaController;
use App\Http\Controllers\DriverController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//admin
Route::post('loginAdmin', [AdminController::class, 'loginAdmin']);
//.....................................................................................
 //driver
 Route::post('requestJoinDriver', [DriverController::class, 'requestJoinDriver']);
 Route::post('loginDriver', [DriverController::class, 'loginDriver']);
//.......................................................................................
//warehouse
Route::post('requestJoinWarehouse', [WarehouseController::class, 'requestJoinWarehouse']);
Route::post('loginWarehouse', [WarehouseController::class, 'loginWarehouse']);
Route::post('logoutWarehouse', [WarehouseController::class, 'logoutWarehouse']);
//......................................................................................
//pharmacy
Route::post('requestJoinPharma', [PharmaController::class, 'requestJoinPharma']);
Route::post('loginpharma', [PharmaController::class, 'loginpharma']);
//......................................................................................
//user
Route::post('register', [UserController::class, 'register']);
Route::post('loginUser', [UserController::class, 'loginUser']);
//....................................................................................... 
Route::get('showAllAcceptrequestfromdriver', [DriverController::class, 'showAllAcceptrequestfromdriver']);
Route::post('Acceptrequestuser_driver/{id}', [DriverController::class, 'Acceptrequestuser_driver']);





Route::middleware('auth:sanctum')->group(function () {
   //Admin
    Route::post('logout', [AdminController::class, 'logout']);
    Route::get('ShowAdminProfile', [AdminController::class, 'ShowAdminProfile']);
    Route::post('updateprofileAdmin', [AdminController::class, 'updateprofileAdmin']);
    Route::get('show_complaintsPh', [AdminController::class, 'show_complaintsPh']);
    Route::get('show_complaintsWa', [AdminController::class, 'show_complaintsWa']);
    Route::get('show_complaintWa_byId/{id}', [AdminController::class, 'show_complaintWa_byId']);
    Route::get('show_complaintPh_byId/{id}', [AdminController::class, 'show_complaintPh_byId']);
    Route::post('add_Driver', [AdminController::class, 'add_Driver']);
    Route::post('add_pharmacy', [AdminController::class, 'add_pharmacy']);
    Route::post('add_warehouse', [AdminController::class, 'add_warehouse']);
    Route::post('add_user', [AdminController::class, 'add_user']);
    Route::delete('delete_user/{id}', [AdminController::class, 'soft_delete_user']);
    Route::delete('delete_pharmacy/{id}', [AdminController::class, 'soft_delete_pharmacy']);
    Route::delete('delete_warehouse/{id}', [AdminController::class, 'soft_delete_warehouse']);
    Route::delete('delete_driver/{id}', [AdminController::class, 'soft_delete_driver']);
    Route::post('back_from_soft_delete_wa/{id}', [AdminController::class, 'back_from_soft_delete_wa']);
    Route::post('back_from_soft_delete_ph/{id}', [AdminController::class, 'back_from_soft_delete_ph']);
    Route::post('back_from_soft_delete_user/{id}', [AdminController::class, 'back_from_soft_delete_user']);
    Route::post('back_from_soft_delete_dr/{id}', [AdminController::class, 'back_from_soft_delete_dr']);
    Route::put('update_pharmacy/{id}', [AdminController::class, 'update_pharmacy']);
    Route::put('update_warehouse/{id}', [AdminController::class, 'update_warehouse']);
    Route::post('AcceptDriver/{id}', [AdminController::class, 'AcceptDriver']);
    Route::post('AcceptWarehouse/{id}', [AdminController::class, 'AcceptWarehouse']);
    Route::post('AcceptPharma/{id}', [AdminController::class, 'AcceptPharma']);
    Route::post('AcceptWarehouse1/{id}', [AdminController::class, 'AcceptWarehouse1']);
    Route::post('AcceptPharma1/{id}', [AdminController::class, 'AcceptPharma1']);
    Route::post('AcceptWarehouse2/{id}', [AdminController::class, 'AcceptWarehouse2']);
    Route::post('AcceptPharma2/{id}', [AdminController::class, 'AcceptPharma2']);
    Route::post('notAcceptDriver/{id}', [AdminController::class, 'notAcceptDriver']);
    Route::post('notAcceptWarehouse/{id}', [AdminController::class, 'notAcceptWarehouse']);
    Route::post('notAcceptPharma/{id}', [AdminController::class, 'notAcceptPharma']);
    Route::post('notAcceptWarehouse1/{id}', [AdminController::class, 'notAcceptWarehouse1']);
    Route::post('notAcceptPharma1/{id}', [AdminController::class, 'notAcceptPharma1']);
    Route::post('notAcceptWarehouse2/{id}', [AdminController::class, 'notAcceptWarehouse2']);
    Route::post('notAcceptPharma2/{id}', [AdminController::class, 'notAcceptPharma2']);
    Route::get('showAllAcceptPharma', [AdminController::class, 'showAllAcceptPharma']);
    Route::get('showAllAcceptWarehouse', [AdminController::class, 'showAllAcceptWarehouse']);
    Route::get('showAllAcceptDriver', [AdminController::class, 'showAllAcceptDriver']);
    Route::get('showAllAcceptPharma1', [AdminController::class, 'showAllAcceptPharma1']);
    Route::get('showAllAcceptWarehouse1', [AdminController::class, 'showAllAcceptWarehouse1']);
    Route::get('showAllAcceptPharma2', [AdminController::class, 'showAllAcceptPharma2']);
    Route::get('showAllAcceptWarehouse2', [AdminController::class, 'showAllAcceptWarehouse2']);
    Route::get('showAllNotYetDeterminedPharma', [AdminController::class, 'showAllNotYetDeterminedPharma']);
    Route::get('showAllNotYetDeterminedWarehouse', [AdminController::class, 'showAllNotYetDeterminedWarehouse']);
    Route::get('showAllNotYetDeterminedDriver', [AdminController::class, 'showAllNotYetDeterminedDriver']);
    Route::post('showPharma/{id}', [AdminController::class, 'showPharma']);
    Route::post('showWarehouse/{id}', [AdminController::class, 'showWarehouse']);
    Route::post('showDriver/{id}', [AdminController::class, 'showDriver']);
    Route::get('showpay', [AdminController::class, 'showpay']);
    Route::post('updateprofilewarehousebyAdmin/{id}', [AdminController::class, 'updateprofilewarehousebyAdmin']);
    Route::post('updateprofilepharmacybyAdmin/{id}', [AdminController::class, 'updateprofilepharmacybyAdmin']);
    Route::get('showAlldisallowPharma', [AdminController::class, 'showAlldisallowPharma']);
    Route::get('showAlldisallowWarehouse', [AdminController::class, 'showAlldisallowWarehouse']);
    Route::get('showAlldisallowDriver', [AdminController::class, 'showAlldisallowDriver']);
    Route::get('showAlldisallowPharma1', [AdminController::class, 'showAlldisallowPharma1']);
    Route::get('showAlldisallowWarehouse1', [AdminController::class, 'showAlldisallowWarehouse1']);
    Route::get('showAlldisallowPharma2', [AdminController::class, 'showAlldisallowPharma2']);
    Route::get('showAlldisallowWarehouse2', [AdminController::class, 'showAlldisallowWarehouse2']);
//........................................................................................................
//pharmacy
Route::get('show_medicine_pharma', [PharmaController::class, 'show_medicine_pharma']);
Route::get('search_name_medicine', [PharmaController::class, 'search_name_medicine']);
Route::post('request_medicine', [PharmaController::class, 'request_medicine']);
Route::post('pay_pharma/{id}', [PharmaController::class, 'pay_pharma']);
Route::post('create_bill_pharma', [PharmaController::class, 'create_bill_pharma']);
Route::post('add_complaintPh', [PharmaController::class, 'add_complaintPh']);
Route::post('request_medicine_user', [PharmaController::class, 'request_medicine_user']);
Route::post('create_bill_user', [PharmaController::class, 'create_bill_user']);
Route::post('addMedicinPh', [PharmaController::class, 'addMedicinPh']);
Route::post('subscription_ph', [PharmaController::class, 'subscription_ph']);
Route::put('updatePharmamedicin/{id}', [PharmaController::class, 'updatePharmamedicin']);
Route::delete('deleteMedicinePharma/{id}', [PharmaController::class, 'deleteMedicinePharma']);
Route::get('ShowPharmaProfile', [PharmaController::class, 'ShowPharmaProfile']);
Route::post('Acceptrequestuser/{id}', [PharmaController::class, 'Acceptrequestuser']);
Route::post('notAcceptrequestuser/{id}', [PharmaController::class, 'notAcceptrequestuser']);
Route::get('showmedicinewabyid/{id}', [PharmaController::class, 'showmedicinewabyid']);   
Route::get('showAllRequestsPhbyph', [PharmaController::class, 'showAllRequestsPhbyph']);  
//...............................................................................................
//warehouse
Route::get('ShowWarehouseProfile', [WarehouseController::class, 'ShowWarehouseProfile']);
Route::put('update', [WarehouseController::class, 'update']);
Route::get('showmedicinewa', [WarehouseController::class, 'showmedicinewa']);    
Route::get('showAllRequestsPh', [WarehouseController::class, 'showAllRequestsPh']);    
Route::delete('deleteMedicineWarehouse/{id}', [WarehouseController::class, 'deleteMedicineWarehouse']);
Route::post('add_complaintWa', [WarehouseController::class, 'add_complaintWa']);
Route::put('updateWarehousemedicin/{id}', [WarehouseController::class, 'updateWarehousemedicin']);
Route::post('subscription_wa', [WarehouseController::class, 'subscription_wa']);
Route::post('addMedicinWa', [WarehouseController::class, 'addMedicinWa']);
Route::post('notAcceptrequestpharma/{id}', [WarehouseController::class, 'notAcceptrequestpharma']);
Route::post('Acceptrequestpharma/{id}', [WarehouseController::class, 'Acceptrequestpharma']);
Route::delete('delete_requests/{id}', [WarehouseController::class, 'delete_requests']);
//...............................................................................................
//user
Route::post('logoutUser', [UserController::class, 'logoutUser']);
Route::post('valuationDr', [UserController::class, 'valuationDr']);
Route::post('valuationPh', [UserController::class, 'valuationPh']);
Route::get('countStarOne/{id}', [UserController::class, 'countStarOne']);
Route::get('countStarTwo/{id}', [UserController::class, 'countStarTwo']);
//..............................................................................................
//driver




});
