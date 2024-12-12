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
use App\Http\Controllers\Backend\SymptompsController;
use App\Http\Controllers\Backend\OnExaminationController;
use App\Http\Controllers\Backend\AppointmentTypeController;
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
    Route::post('logout',[AuthenticationController::class,'logout'])->name('logout.post');
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
        Route::resource('/symptomps',SymptompsController::class)->names([
            'index'=>'symptomps.home',
            'create'=>'symptomps.create',
            'store'=>'symptomps.save',
            'edit'=>'symptomps.edit',
            'update'=>'symptomps.update',
            'destroy'=>'symptomps.delete'
        ]);
        Route::resource('/onexaminations',OnExaminationController::class)->names([
            'index'=>'onexaminations.home',
            'create'=>'onexaminations.create',
            'store'=>'onexaminations.save',
            'edit'=>'onexaminations.edit',
            'update'=>'onexaminations.update',
            'destroy'=>'onexaminations.delete'
        ]);

        Route::resource('/appointype',AppointmentTypeController::class)->names([
            'index'=>'appointype.home',
            'create'=>'appointype.create',
            'store'=>'appointype.save',
            'edit'=>'onexaminations.edit',
            'update'=>'appointype.update',
            'destroy'=>'appointype.delete'
        ]);

    });

