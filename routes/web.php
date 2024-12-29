<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandImageController;
use App\Http\Controllers\Backend\PatientsController;
use App\Http\Controllers\Backend\DoctorController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\AppoinmentController;
use App\Http\Controllers\Backend\AppointedPatientController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdviceController;
use App\Http\Controllers\Backend\DiagnosisController;
use App\Http\Controllers\Backend\ComplaintController;
use App\Http\Controllers\Backend\ComplaintDurationController;
use App\Http\Controllers\Backend\AppointmentTypeController;
use App\Http\Controllers\Backend\AppointmentFeeController;
use App\Http\Controllers\Backend\InvestigationEquipmentControllers;
use App\Http\Controllers\Backend\InvestigationTypeControllers;
use App\Http\Controllers\Auth\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


    Route::get('login',[UserController::class,'index'])->name('login');
    Route::post('login',[AuthenticationController::class,'login'])->name('login.post');
    Route::get('logout',[AuthenticationController::class,'logout'])->name('logout.get');
    Route::get('register',[UserController::class,'create']);
    Route::post('register',[UserController::class,'store'])->name('register');



    Route::middleware(['auth'])->group(function () {

        Route::get('/',function(){
            return view('backend.welcome');
        })->name('home');


        Route::resource('/brand-image',BrandImageController::class)->names([
            'index'=>'brand-image.home',
            'create'=>'brand-image.create',
            'store'=>'brand-image.save',
            'edit'=>'brand-image.edit',
            'update'=>'brand-image.update',
            'destroy'=>'brand-image.delete'
        ]);
        Route::resource('/departments',DepartmentController::class)->names([
            'index'=>'departments.home',
            'create'=>'departments.create',
            'store'=>'departments.save',
            'edit'=>'departments.edit',
            'update'=>'departments.update',
            'destroy'=>'departments.delete'
        ]);
        Route::resource('/patients',PatientsController::class)->names([
            'index'=>'patients.home',
            'create'=>'patients.create',
            'store'=>'patients.save',
            'edit'=>'patients.edit',
            'update'=>'patients.update',
            'destroy'=>'patients.delete'
        ]);

        Route::resource('/doctors',DoctorController::class)->names([
            'index'=>'doctors.home',
            'create'=>'doctors.create',
            'store'=>'doctors.save',
            'edit'=>'doctors.edit',
            'update'=>'doctors.update',
            'destroy'=>'doctors.delete'
        ]);

        Route::resource('/appoinments',AppoinmentController::class)->names([
            'index'=>'appoinments.home',
            'create'=>'appoinments.create',
            'store'=>'appoinments.save',
            'edit'=>'appoinments.edit',
            'update'=>'appoinments.update',
            'destroy'=>'appoinments.delete'
        ]);

        Route::resource('/appointed',AppointedPatientController::class)->names([
            'index'=>'appointed.home',
            'create'=>'appointed.create',
            'store'=>'appointed.save',
            'edit'=>'appointed.edit',
            'update'=>'appointed.update',
            'destroy'=>'appointed.delete'
        ]);
        Route::post('appointment/checkserial',[AppoinmentController::class,'getSerial']);
        Route::get('appointed/patientlist/{id}',[AppointedPatientController::class,'patientList']);

        Route::put('/patient',[PatientsController::class,'search']);
        Route::put('/doctor',[DoctorController::class,'search']);

        Route::resource('/advices',AdviceController::class)->names([
            'index'=>'advices.home',
            'create'=>'advices.create',
            'store'=>'advices.save',
            'edit'=>'advices.edit',
            'update'=>'advices.update',
            'destroy'=>'advices.delete'
        ]);

        Route::resource('/diagnosis',DiagnosisController::class)->names([
            'index'=>'diagnosis.home',
            'create'=>'diagnosis.create',
            'store'=>'diagnosis.save',
            'edit'=>'diagnosis.edit',
            'update'=>'diagnosis.update',
            'destroy'=>'diagnosis.delete'
        ]);
        Route::resource('/complaint',ComplaintController::class)->names([
            'index'=>'complaint.home',
            'create'=>'complaint.create',
            'store'=>'complaint.save',
            'edit'=>'complaint.edit',
            'update'=>'complaint.update',
            'destroy'=>'complaint.delete'
        ]);

        Route::resource('/complaintduration',ComplaintDurationController::class)->names([
            'index'=>'complaintduration.home',
            'create'=>'complaintduration.create',
            'store'=>'complaintduration.save',
            'edit'=>'complaintduration.edit',
            'update'=>'complaintduration.update',
            'destroy'=>'complaintduration.delete'
        ]);

        Route::resource('/appointtype',AppointmentTypeController::class)->names([
            'index'=>'appointtype.home',
            'create'=>'appointtype.create',
            'store'=>'appointtype.save',
            'edit'=>'appointtype.edit',
            'update'=>'appointtype.update',
            'destroy'=>'appointtype.delete'
        ]);
        Route::resource('/appointfee',AppointmentFeeController::class)->names([
            'index'=>'appointfee.home',
            'create'=>'appointfee.create',
            'store'=>'appointfee.save',
            'edit'=>'appointfee.edit',
            'update'=>'appointfee.update',
            'destroy'=>'appointfee.delete'
        ]);

        Route::resource('/investigationequipments',InvestigationEquipmentControllers::class)->names([
            'index'=>'investigationequipments.home',
            'create'=>'investigationequipments.create',
            'store'=>'investigationequipments.save',
            'edit'=>'investigationequipments.edit',
            'update'=>'investigationequipments.update',
            'destroy'=>'investigationequipments.delete'
        ]);

        Route::resource('/investigationtype',InvestigationTypeControllers::class)->names([
            'index'=>'investigationtype.home',
            'create'=>'investigationtype.create',
            'store'=>'investigationtype.save',
            'edit'=>'investigationtype.edit',
            'update'=>'investigationtype.update',
            'destroy'=>'investigationtype.delete'
        ]);

    });

