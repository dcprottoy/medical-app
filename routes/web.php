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
use App\Http\Controllers\Backend\InvestigationGroupController;
use App\Http\Controllers\Backend\InvenstigationMainController;
use App\Http\Controllers\Backend\InvestigationSectionControllers;
use App\Http\Controllers\Backend\InvestigstionDetailsController;
use App\Http\Controllers\Backend\InvestigationEquiSetController;
use App\Http\Controllers\Backend\ExaminationController;
use App\Http\Controllers\Backend\ReferredController;
use App\Http\Controllers\Backend\DueController;

use App\Http\Controllers\Backend\UsageController;
use App\Http\Controllers\Backend\DoseController;
use App\Http\Controllers\Backend\DoseDurationController;
use App\Http\Controllers\Backend\ServiceCategoryController;
use App\Http\Controllers\Backend\ServiceTypeController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\BillingController;
use App\Http\Controllers\Backend\BillingDetailsController;




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
use App\Http\Controllers\PDFController;

Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);


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
        Route::put('/billing',[BillingController::class,'search']);


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
            'show'=>'investigationtype.show',
            'store'=>'investigationtype.save',
            'edit'=>'investigationtype.edit',
            'update'=>'investigationtype.update',
            'destroy'=>'investigationtype.delete'
        ]);

        Route::resource('/investigationgroup',InvestigationGroupController::class)->names([
            'index'=>'investigationgroup.home',
            'create'=>'investigationgroup.create',
            'show'=>'investigationgroup.show',
            'store'=>'investigationgroup.save',
            'edit'=>'investigationgroup.edit',
            'update'=>'investigationgroup.update',
            'destroy'=>'investigationgroup.delete'
        ]);
        Route::resource('/investigationmain',InvenstigationMainController::class)->names([
            'index'=>'investigationmain.home',
            'create'=>'investigationmain.create',
            'store'=>'investigationmain.save',
            'edit'=>'investigationmain.edit',
            'update'=>'investigationmain.update',
            'destroy'=>'investigationmain.delete'
        ]);

        Route::resource('/investsection',InvestigationSectionControllers::class)->names([
            'store'=>'investsection.save'
        ]);

        Route::resource('/investdetails',InvestigstionDetailsController::class)->names([
            'store'=>'investdetails.save'
        ]);

        Route::resource('/investequipset',InvestigationEquiSetController::class)->names([
            'store'=>'investequipset.save'
        ]);

        Route::resource('/examination',ExaminationController::class)->names([
            'index'=>'examination.home',
            'create'=>'examination.create',
            'store'=>'examination.save',
            'edit'=>'examination.edit',
            'update'=>'examination.update',
            'destroy'=>'examination.delete'
        ]);

        Route::resource('/referred',ReferredController::class)->names([
            'index'=>'referred.home',
            'create'=>'referred.create',
            'store'=>'referred.save',
            'edit'=>'referred.edit',
            'update'=>'referred.update',
            'destroy'=>'referred.delete'
        ]);

        Route::resource('/usage',UsageController::class)->names([
            'index'=>'usage.home',
            'create'=>'usage.create',
            'store'=>'usage.save',
            'edit'=>'usage.edit',
            'update'=>'usage.update',
            'destroy'=>'usage.delete'
        ]);

        Route::resource('/dose',DoseController::class)->names([
            'index'=>'dose.home',
            'create'=>'dose.create',
            'store'=>'dose.save',
            'edit'=>'dose.edit',
            'update'=>'dose.update',
            'destroy'=>'dose.delete'
        ]);

        Route::resource('/doseduration',DoseDurationController::class)->names([
            'index'=>'doseduration.home',
            'create'=>'doseduration.create',
            'store'=>'doseduration.save',
            'edit'=>'doseduration.edit',
            'update'=>'doseduration.update',
            'destroy'=>'doseduration.delete'
        ]);

        Route::resource('/servicecategory',ServiceCategoryController::class)->names([
            'index'=>'servicecategory.home',
            'create'=>'servicecategory.create',
            'store'=>'servicecategory.save',
            'edit'=>'servicecategory.edit',
            'update'=>'servicecategory.update',
            'destroy'=>'servicecategory.delete'
        ]);

        Route::resource('/servicetype',ServiceTypeController::class)->names([
            'index'=>'servicetype.home',
            'create'=>'servicetype.create',
            'store'=>'servicetype.save',
            'edit'=>'servicetype.edit',
            'update'=>'servicetype.update',
            'destroy'=>'servicetype.delete'
        ]);

        Route::resource('/service',ServiceController::class)->names([
            'index'=>'service.home',
            'create'=>'service.create',
            'store'=>'service.save',
            'edit'=>'service.edit',
            'update'=>'service.update',
            'destroy'=>'service.delete'
        ]);

        Route::resource('/billing',BillingController::class)->names([
            'index'=>'billing.home',
            'create'=>'billing.create',
            'store'=>'billing.save',
            'edit'=>'billing.edit',
            'update'=>'billing.update',
            'destroy'=>'billing.delete'
        ]);

        Route::resource('/billingdetails',BillingDetailsController::class)->names([
            'index'=>'billingdetails.home',
            'create'=>'billingdetails.create',
            'store'=>'billingdetails.save',
            'edit'=>'billingdetails.edit',
            'update'=>'billingdetails.update',
            'destroy'=>'billingdetails.delete'
        ]);


        Route::resource('/duecollection',DueController::class)->names([
            'index'=>'duecollection.home',
            'create'=>'duecollection.create',
            'store'=>'duecollection.save',
            'edit'=>'duecollection.edit',
            'update'=>'duecollection.update',
            'destroy'=>'duecollection.delete'
        ]);

    Route::get('billingitems/{id}',[BillingController::class,'billingitems']);

    Route::get('billing-pdf/{id}',[BillingController::class,'pdf'])->name('billing.pdf');




    });

