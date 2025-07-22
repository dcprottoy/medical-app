@extends('backend.layout.main')
@section('body-part')
<style>
.search-list{
    height:550px;
    overflow-x: hidden;
    overflow-y: scroll;
}
.complaint-search-list{
    height:450px;
    overflow-x: hidden;
    overflow-y: scroll;
}
.add-list{
    overflow-x: hidden;
    overflow-y: scroll;
}
.complaint-list-item:hover{
    cursor: pointer;
    background-color: beige;
}

.complaint-duration-list-item:hover{
    cursor: pointer;
    background-color: beige;
}
@media print
{
body * { visibility: hidden; }
#print-div * { visibility: visible; }
#print-button { visibility: hidden; }

#print-div { position: absolute; top: 40px; left: 30px; }
}



        /* Custom scrollbar for WebKit-based browsers (Chrome, Safari, Edge) */
        .complaint-search-list::-webkit-scrollbar {
            width: 10px; /* Width of the scrollbar */
        }

        .complaint-search-list::-webkit-scrollbar-track {
            background: #f1f1f1; /* Track color */
            border-radius: 5px;
        }

        .complaint-search-list::-webkit-scrollbar-thumb {
            background: #888; /* Scrollbar thumb color */
            border-radius: 5px; /* Rounded corners */
        }

        .complaint-search-list::-webkit-scrollbar-thumb:hover {
            background: #555; /* Hover effect */
        }

        /* Custom scrollbar for Firefox */
        .complaint-search-list {
            scrollbar-width: thin; /* Thin scrollbar */
            scrollbar-color: #888 #f1f1f1; /* Thumb color and track color */
        }

        /* Custom scrollbar for Internet Explorer (Optional) */
        .complaint-search-list {
            -ms-overflow-style: scrollbar; /* Custom IE scrollbar style */
        }

       
</style>
<div class="content-wrapper">
    <x-breadcumb title="Prescription"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-sm btn-success" data-toggle="modal" id="aptpantbtn" data-target="#appointedPatient">Appointed Patients</button>
                    <div class="modal fade" id="appointedPatient" tabindex="-1" role="dialog" aria-labelledby="appointedPatientLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="appointedPatientModalLabel">Appointed Patient List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <h4 class="text-center">Appointment Information</h4>
                                        <ul class="list-group search-list" id="appoin-patient-list">
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-warning" data-toggle="modal" id="prescribedbtn" data-target="#prescribedPatient">Prescribed Patients</button>
                    <div class="modal fade" id="prescribedPatient" tabindex="-1" role="dialog" aria-labelledby="prescribedPatientLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="prescribedPatientModalLabel">Prescribed Patient List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    {{-- <div class="col-sm-12">
                                        <div class="form-group text-center">
                                            <input type="text" class="form-control form-control-sm" id="pres_patient" name="pres_patient" placeholder="Patient ID,Name,Contact No">
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-12">
                                        <h4 class="text-center">Prescribed Information</h4>
                                        <ul class="list-group search-list" id="prescribed-patient-list">
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-info " data-toggle="modal" id="allptnbtn" data-target="#allPatient">Registered Patient</button>
                    <div class="modal fade" id="allPatient" tabindex="-1" role="dialog" aria-labelledby="allPatientLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="allPatientModalLabel">Registered Patient List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <h4 class="text-center">Patient Information</h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-sm" id="patient" name="patient" placeholder="Patient ID,Name,Contact No">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <ul class="list-group search-list" id="patient_search_list">
                                                    @foreach($patients as $patient)
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <b>Patient ID :</b> <em><span id="reg-patient-id{!! $patient->id !!}">{!! $patient->patient_id !!}</span></em>
                                                                <br>
                                                                <b>Name :</b> <span id="reg-patient-name{!! $patient->id !!}">{!! $patient->name !!}</span>
                                                                <br>
                                                                <b>Gender :</b> <span id="reg-patient-gender{!! $patient->id !!}">{!! $patient->sex == 'M'?'Male':($patient->sex == 'F'?'Female':'Other') !!}</span>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <b>Contact No :</b> <span id="reg-patient-contact_no{!! $patient->id !!}">{!! $patient->contact_no !!}</span>
                                                                    <br>
                                                                    <b>Age :</b> <span id="reg-patient-age{!! $patient->id !!}">{!! $patient->age !!}</span>
                                                                    <br>
                                                                    <button class="btn btn-sm btn-info reg-prescribe" data-id="{!! $patient->id !!}" style="float: right">
                                                                        SELECT
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary "  data-toggle="modal" id="newptnbtn" data-target="#newPatient">New Patient</button>
                    <div class="modal fade" id="newPatient" tabindex="-1" role="dialog" aria-labelledby="newPatientLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <form action="{{route('patients.save')}}" method="post" enctype="multipart/form-data" id="new_patient_create">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="newPatientModalLabel">New Patient</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control form-control-sm" name='name' placeholder="Patients Name" required>
                                                            <input type="hidden" name="save_type" value=2>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Contact No.</label>
                                                            <input type="text" class="form-control form-control-sm" name='contact_no' placeholder="Contact Number" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 d-flex">
                                                        <div class="form-group pr-2">
                                                            <label>Age</label>
                                                            <input type="text" class="form-control form-control-sm" name='year' placeholder="Year">
                                                        </div>
                                                        <div class="form-group pr-2">
                                                            <label>&nbsp;</label>
                                                            <input type="text" class="form-control form-control-sm" name='month' placeholder="Month">
                                                        </div>
                                                        <div class="form-group pr-2">
                                                            <label>&nbsp;</label>
                                                            <input type="text" class="form-control form-control-sm" name='day' placeholder="Day">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Emergency Contact No.</label>
                                                            <input type="text" class="form-control form-control-sm" name='emr_cont_no' placeholder="Emergency Contact Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input type="text" class="form-control form-control-sm" name='address' placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-lg-3">
                                                        <label>Birth Date</label>
                                                        <div class="input-group date" id="birth_date" data-target-input="nearest">
                                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#birth_date" name="birth_date" id="date"/>
                                                            <div class="input-group-append" data-target="#birth_date" data-toggle="datetimepicker">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6 d-flex">
                                                        <div class="form-check m-2">
                                                        <input class="form-check-input" type="radio" name="sex" value="M" required>
                                                        <label class="form-check-label">Male</label>
                                                        </div>
                                                        <div class="form-check m-2">
                                                        <input class="form-check-input" type="radio" name="sex" value="F">
                                                        <label class="form-check-label">Female</label>
                                                        </div>
                                                        <div class="form-check m-2">
                                                            <input class="form-check-input" type="radio" name="sex" value="O">
                                                            <label class="form-check-label">Other</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6 d-flex">
                                                        @foreach($appointmenttypes as $apttype)
                                                            <div class="form-check m-2">
                                                                <input class="form-check-input" type="radio" name="appointment_type_id" value="{{$apttype->id}}" required {{$apttype->name_eng === "Consultation"?"checked":""}}>
                                                                <label class="form-check-label">{{$apttype->name_eng}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                                <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
                                            </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-danger float-right" data-toggle="modal" id="prescribe-btn" style="text-transform: uppercase;">Prescribe</button>
                    <button class="btn btn-sm btn-secondary mr-2 float-right" data-toggle="modal" id="visited-btn" style="text-transform: uppercase;">Visited</button>
                    <button class="btn btn-sm btn-primary float-right mr-2" data-toggle="modal" id="searchpresbtn" data-target="#searchPres"><i class="fas fa-search"></i> Search Prescription</button>
                    <div class="modal fade" id="searchPres" tabindex="-1" role="dialog" aria-labelledby="searchPresLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="searchPresModalLabel">Prescription List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <h4 class="text-center">Prescription Information</h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-sm" id="prescription-search" name="prescription-search" placeholder="Prescription No">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <ul class="list-group search-list" id="prescription_search_list">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Patient ID :</b><em id="patient-id"></em>
                            <br>
                            <b>Name :</b> <span id="patient-name"></span>
                        </div>
                        <div class="col-sm-3">
                            <b>Gender :</b> <span id="patient-gender"></span>
                            <br>
                            <b>Age :</b> <span id="patient-age"></span>
                        </div>
                        <div class="col-sm-3">
                            <b>Date :</b> <em id="appon-date"></em>
                            <br>
                            <b>Serial No :</b><span id="serial-no"></span>
                        </div>
                        <div class="col-sm-3">
                            
                            <b>PRESCRIPTION NO:</b><span id="prescription-no" style="color:red;font-weight:bolder;"></span>
                            <input type="hidden" value="0" name="appoint_no" id="appoint_no"/>
                        </div>
                    

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-sm btn-info" style="min-width:115px;"  id="chiefcomplaintbtn" >Cheif Complaint</button>
                    <div class="modal fade" id="cheifComplaint" tabindex="-1">
                        <div class="modal-dialog modal-xl" role="document">
                            <form action="{{route('prescriptioncomplaint.save')}}" method="post" enctype="multipart/form-data" id="prescription_complaint_create">
                            @csrf
                                <div class="modal-content">
                                    <div class="modal-header  bg-info">
                                    <h5 class="modal-title" id="cheifComplaintModalLabel">Chief Complaint List</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row justify-content-center" style="min-height: 300px;">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Complaint Type</label>
                                                        <select class="form-control form-control-lg"  name="complaint_id[]" id="complaint_id" multiple></select>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Complaint Duration</label>
                                                        <select class="form-control form-control-sm"  name="complaint_duration_id" id="complaint_duration_id"></select>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="reset">&nbsp;Cancel&nbsp;</button>
                                        <button class="btn btn-sm btn-success" type="submit">&nbsp;Save&nbsp;</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-warning" style="min-width:115px;" data-toggle="modal" id="onExaminationbtn" data-target="#onExamination">On Examination</button>
                    <div class="modal fade" id="onExamination" tabindex="-1" role="dialog" aria-labelledby="onExaminationLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <form action="{{route('prescriptiononexam.save')}}" method="post" enctype="multipart/form-data" id="prescription_onexam_create"> 
                                    @csrf
                                    <div class="modal-header  bg-warning">
                                        <h5 class="modal-title" id="onExaminationModalLabel">On Examination</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Blood Pressure </label>
                                                        <input type="text" class="form-control form-control-sm" id="bloodPressure" name='pressure' placeholder="Pressure">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Body Height</label>
                                                        <input type="text" class="form-control form-control-sm" id='bodyHight' name='height' placeholder="height">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>BMI</label>
                                                        <input type="text" class="form-control form-control-sm" id='bmi' name='bmi' placeholder="BMI">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Body Temperature</label>
                                                        <input type="text" class="form-control form-control-sm" id="bodyTemperature" name='temperature' placeholder="Temperature">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Body Weight</label>
                                                        <input type="text" class="form-control form-control-sm" id='bodyWeight' name='weight' placeholder="Weight">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="reset">&nbsp;Cancel&nbsp;</button>
                                        <button class="btn btn-sm btn-success" id="on-examination-save">&nbsp;Save&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-success" style="min-width:115px;" data-toggle="modal" id="diagnosisbtn" data-target="#diagnosis">Diagnosis</button>
                    <div class="modal fade" id="diagnosis" tabindex="-1" role="dialog" aria-labelledby="diagnosisLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-success">
                                <h5 class="modal-title" id="diagnosisModalLabel">Diagnosis List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('prescriptiondiagnosis.save')}}" method="post" enctype="multipart/form-data" id="prescription_diagnosis_create">
                                    @csrf
                                    <div class="modal-body" style="min-height: 300px;">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control form-control-lg"  name="diagnosis_id[]" id="diagnosis_id"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="reset">&nbsp;Cancel&nbsp;</button>
                                        <button class="btn btn-sm btn-success" type="submit" >&nbsp;Save&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-danger" style="min-width:115px;" data-toggle="modal" id="medecinebtn" data-target="#medecine">Medecine</button>
                    <div class="modal fade" id="medecine" tabindex="-1" role="dialog" aria-labelledby="medecineLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-danger">
                                    <h5 class="modal-title" id="medecineModalLabel">Medecine Entry</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('tests.save')}}" method="post" enctype="multipart/form-data" id="prescription_medicines_create">
                                    @csrf
                                    <div class="modal-body" style="min-height: 300px;">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="medicines_id">Medicine Name</label>
                                                        <select class="form-control form-control-md"  name="medicines_id" id="medicines_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="dose_id">Dose</label>
                                                        <select class="form-control form-control-md"  name="dose_id" id="dose_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="usage_id">Dose Frequency</label>
                                                        <select class="form-control form-control-md"  name="dose_frequency_id" id="dose_frequency_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="dose_duration_id">Dose Duration</label>
                                                        <select class="form-control form-control-md"  name="dose_duration_id" id="dose_duration_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="usage_id">Usage</label>
                                                        <select class="form-control form-control-md"  name="usage_id" id="usage_id"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="reset">&nbsp;Cancel&nbsp;</button>
                                        <button class="btn btn-sm btn-success" type="submit" >&nbsp;Save&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="medecine-edit" >
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                    <h5 class="modal-title">Medecine Update</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="put" enctype="multipart/form-data" id="medecine-edit-form">
                                    @csrf
                                    <input type="hidden" name="id" id="u-id">
                                    <div class="modal-body" style="min-height: 300px;">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="medicines_id">Medicine Name</label>
                                                        <select class="form-control form-control-md"  name="medicines_id" id="u-medicines_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="dose_id">Dose</label>
                                                        <select class="form-control form-control-md"  name="dose_id" id="u-dose_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="usage_id">Dose Frequency</label>
                                                        <select class="form-control form-control-md"  name="dose_frequency_id" id="u-dose_frequency_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="dose_duration_id">Dose Duration</label>
                                                        <select class="form-control form-control-md"  name="dose_duration_id" id="u-dose_duration_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="usage_id">Usage</label>
                                                        <select class="form-control form-control-md"  name="usage_id" id="u-usage_id"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="reset">&nbsp;Cancel&nbsp;</button>
                                        <button class="btn btn-sm btn-success" type="submit" >&nbsp;Save&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-secondary" style="min-width:115px;" data-toggle="modal" id="investigationsbtn" data-target="#investigations">Investigations</button>
                    <div class="modal fade" id="investigations" tabindex="-1" role="dialog" aria-labelledby="adviceLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-secondary">
                                <h5 class="modal-title" id="investigationsModalLabel">Investigations List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                               <form action="{{route('tests.save')}}" method="post" enctype="multipart/form-data" id="prescription_investigations_create">
                                    @csrf
                                    <div class="modal-body" style="min-height: 300px;">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control form-control-sm"  name="investigations_id" id="investigations_id"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="reset">&nbsp;Cancel&nbsp;</button>
                                        <button class="btn btn-sm btn-success" type="submit" >&nbsp;Save&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-primary" style="min-width:115px;" data-toggle="modal" id="advicebtn" data-target="#advice">Advice</button>
                    <div class="modal fade" id="advice" tabindex="-1" role="dialog" aria-labelledby="adviceLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                    <h5 class="modal-title" id="adviceModalLabel">Advice List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('prescriptiondiagnosis.save')}}" method="post" enctype="multipart/form-data" id="prescription_advice_create">
                                    @csrf
                                    <div class="modal-body" style="min-height: 300px;">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control form-control-sm"  name="advice_id" id="advice_id"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="reset">&nbsp;Cancel&nbsp;</button>
                                        <button class="btn btn-sm btn-success" type="submit" >&nbsp;Save&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm" style="min-width:115px;background-color: #14576d;color: white;" data-toggle="modal" id="referredbtn" data-target="#referred">Reffered</button>
                    <div class="modal fade" id="referred" tabindex="-1" role="dialog" aria-labelledby="adviceLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-secondary">
                                <h5 class="modal-title" id="referredModalLabel">Referred List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                               <form action="{{route('tests.save')}}" method="post" enctype="multipart/form-data" id="prescription_referred_create">
                                    @csrf
                                    <div class="modal-body" style="min-height: 300px;">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control form-control-sm"  name="referred_id" id="referred_id"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-danger" type="reset">&nbsp;Cancel&nbsp;</button>
                                        <button class="btn btn-sm btn-success" type="submit" >&nbsp;Save&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm float-right" style="min-width:115px;background-color: #551adf;color: white;" id="printbtn" >Print</button>
                </div>
                <div class="card-body" style = "min-height:250px;">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6><b>Cheif Complaint</b></h6>
                            <ul class="border-top pt-2" id="cheif-complaint-list" style="min-height:200px;">
                            </ul>
                            <h6><b>On Examination</b></h6>
                            <div class="row mb-2 border-top" style="min-height: 200px;">
                                <div class="col-sm-6 p-1 exam-part" style="display:none;">
                                    Temperature : <span id="temperature_value"></span>&nbsp;<sup>o</sup>F
                                </div>
                                <div class="col-sm-6 p-1 exam-part" style="display:none;">
                                    BP : <span id="pressure_value"></span>&nbsp;
                                </div>
                                <div class="col-sm-6 p-1 exam-part" style="display:none;">
                                    Height : <span id="height_value"></span>
                                </div>
                                <div class="col-sm-6 p-1 exam-part" style="display:none;">
                                    Weight : <span id="weight_value"></span>&nbsp;Kg
                                </div>
                                <div class="col-sm-6 p-1 exam-part" style="display:none;">
                                    BMI : <span id="bmi_value"></span>
                                </div>
                            </div>
                            <h6><b>Investigation</b></h6>
                            <ul class="border-top pt-2" id="test-list" style="min-height:200px;">
                            </ul>
                        </div>
                        <div class=" col-sm-6 border-left border-right">
                                <h6><b>Diagnosis</b></h6>
                                <ul class="border-top pt-2" id="diagnosis-list" style="min-height:100px;">
                                </ul>
                                <h5>Rx</h5>
                                <ol class="border-top" id="treatment-list">
                                </ol>
                        </div>
                        <div class="col-sm-3">
                            <h6><b>Advice</b></h6>
                            <ul class="border-top pt-2" id="advice-list" style="min-height:200px;">
                            </ul>
                            <h6><b>Referred</b></h6>
                            <ul class="border-top pt-2" id="referred-list" style="min-height:200px;">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $("#printbtn").on('click',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
            }else{
                event.preventDefault();
                // Open the link's URL in a new tab
                window.open("{{url('appointed/print')}}"+'/'+prescription_no, '_blank');
            }
        });

        function setSelectedValue(select, id, value) {

             // Step 1: Set default value from response
                let defaultData = {
                    'id': id,       // e.g., 5
                    'text': value        // e.g., "Main Store"
                };
                console.log(defaultData);
                // Step 2: Create and add the option dynamically
                let newOption = new Option(defaultData.text, defaultData.id, true, true);
                $('#'+select).append(newOption).trigger('change');
            
        }

        function clearPrescribedSpace(){
            $("#cheif-complaint-list").empty();
            $("#test-list").empty();
            $("#diagnosis-list").empty();
            $("#treatment-list").empty();
            $("#advice-list").empty();
            $("#referred-list").empty();
            $('#pressure_value').text("");
            $('#pressure_value').closest('.exam-part').hide();
            $('#temperature_value').text("");
            $('#temperature_value').closest('.exam-part').hide();
            $('#height_value').text("");
            $('#height_value').closest('.exam-part').hide();
            $('#weight_value').text("");
            $('#weight_value').closest('.exam-part').hide();
            $('#bmi_value').text("");
            $('#bmi_value').closest('.exam-part').hide();
        }


        function checkNew(name){
            let value = $('#'+name).val();
            if(value) {
                let text = $('#'+name).select2('data');
                let data = text.map(item => {
                    if(item.id == item.text){
                        return {'id':item.id,'text':item.text,'newItem':true};
                    }else{
                        return {'id':item.id,'text':item.text,'newItem':false};
                    }
                })

                return data;
            }
            else return 0;
        }
    

        //Complaint Section Add Delete Start Here
        $('#complaint_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            multiple: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('complaint/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#cheifComplaint'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });
        function removeComplaint(id){
            $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{ url('prescriptioncomplaint') }}/"+id,
                    data: {
                        _token:'{{ csrf_token() }}',
                        _method:'DELETE'
                    },
                    success: function (data) {
                        console.log(data);
                        if(data.success){
                            toastr.success("Complaint Remove Successfully");
                            $("#remove-complaint-btn"+id).closest("li").remove();
                        }
                    }
                });
        }
        $("#prescription_complaint_create").on('submit',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            let selectedData = checkNew('complaint_id');
            console.log(selectedData);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
                $('#cheifComplaint').modal('hide');
            }
            else{
                if(selectedData.length){
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{ url('prescriptioncomplaint') }}",
                        data: {
                            _token:'{{ csrf_token() }}',
                            formData:selectedData,
                            prescription_id:prescription_no
                        },
                        success: function (datas) {
                            console.log(datas);
                            if('error' in datas){
                                toastr.error(datas.error);
                                return;
                            }
                            toastr.success("Complaint Added Successfully");
                            let element = '';
                            datas.forEach((data) => {
                                element +=`<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.complaint}    ${data.complaint_duration == undefined ? '' : data.complaint_duration} </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger btn-xs remove-complaint-btn" data-id=${data.id} title="Remove" id="remove-complaint-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            })
                            $("#cheif-complaint-list").empty();
                            $("#cheif-complaint-list").append(element);
                            $("#complaint_id").val(null).empty().trigger('change');
                            $("#complaint_duration_id").val(null).empty().trigger('change');
                            setTimeout(() => {
                                $('#cheifComplaint').modal('hide');
                            }, 300);

                            $('.remove-complaint-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeComplaint(id);
                            });
                        }
                    });
                }
            }
        });

        $("#prescription_complaint_create").on('reset',function(e){
            e.preventDefault();
            $("#complaint_id").val(null).empty().trigger('change');
            setTimeout(() => {
                $('#cheifComplaint').modal('hide');
            }, 300);
        });

        $("#chiefcomplaintbtn").on('click',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
                $('#cheifComplaint').modal('hide');
            }else{
                $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: "{{ url('prescriptioncomplaint') }}/"+prescription_no,
                        success: function (data) {
                            if(data.success){
                                $("#complaint_id").val(null).empty().trigger('change');
                                data.complain.forEach(x => {
                                    console.log([x.complaint,x.complaint_id])
                                    let newOption = new Option(x.complaint,x.complaint_id, true, true);
                                    $('#complaint_id').append(newOption).trigger('change');
                                });
                            }else{
                                $("#complaint_id").val(null).empty().trigger('change');
                            }
                            
                        }
                    });

            $('#cheifComplaint').modal('show');

            }
        })
        //Complaint Section Add Delete End Here

        //Prescription On Examination 
        $("#prescription_onexam_create").on('submit',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
            }else{
                let formData = $(this).serialize();
                    formData += '&prescription_id=' + encodeURIComponent(prescription_no);
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{ url('prescriptiononexam') }}",
                        data: formData,
                        success: function (data) {
                            console.log(data);
                            toastr.success("Complaint Added Successfully");
                            let x = data.on_exam;
                           
                            if(x.pressure == null){
                                $('#pressure_value').text("");
                                $('#pressure_value').closest('.exam-part').hide();
                            }else{
                                $('#pressure_value').text(x.pressure);
                                $('#pressure_value').closest('.exam-part').show();
                            }
                            if(x.temperature == null){
                                $('#temperature_value').text("");
                                $('#temperature_value').closest('.exam-part').hide();
                            }else{
                                $('#temperature_value').text(x.temperature);
                                $('#temperature_value').closest('.exam-part').show();
                            }
                            if(x.height == null){
                                $('#height_value').text("");
                                $('#height_value').closest('.exam-part').hide();
                            }else{
                                $('#height_value').text(x.height);
                                $('#height_value').closest('.exam-part').show();
                            }
                            if(x.weight == null){
                                $('#weight_value').text("");
                                $('#weight_value').closest('.exam-part').hide();
                            }else{
                                $('#weight_value').text(x.weight);
                                $('#weight_value').closest('.exam-part').show();
                            }
                            if(x.bmi == null){
                                $('#bmi_value').text("");
                                $('#bmi_value').closest('.exam-part').hide();
                            }else{
                                $('#bmi_value').text(x.bmi);
                                $('#bmi_value').closest('.exam-part').show();
                            }
                            
                        }
                    });
            }
            setTimeout(() => {
                $("#onExamination").modal('hide');
            }, 100);
        });
        $("#prescription_onexam_create").on('reset',function(e){
            e.preventDefault();
            setTimeout(() => {
                $("#onExamination").modal('hide');
            }, 100);
        });
         //Complaint Section Add Delete Start Here
        $('#diagnosis_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            multiple: true,
            autoClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('diagnosis/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#diagnosis'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        function removeDiagnosis(id){
            $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{ url('prescriptiondiagnosis') }}/"+id,
                    data: {
                        _token:'{{ csrf_token() }}',
                        _method:'DELETE'
                    },
                    success: function (data) {
                        console.log(data);
                        if(data.success){
                            toastr.success("Diagnosis Remove Successfully");
                            $("#remove-diagnosis-btn"+id).closest("li").remove();
                        }
                    }
                });
        }

        $('#prescription_diagnosis_create').on('submit',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
             let selectedData = checkNew('diagnosis_id');
            console.log(selectedData);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
            }else{
               if(selectedData.length){
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{ url('prescriptiondiagnosis') }}",
                        data: {
                            _token:'{{ csrf_token() }}',
                            formData:selectedData,
                            prescription_id:prescription_no
                        },
                        success: function (data) {
                            console.log("data",data);
                            if('error' in data){
                                toastr.error(data.error);
                                return;
                            }
                            toastr.success("Diagnosi Added Successfully");
                            let element =``;
                            data.forEach((data) => {
                                element += `<li>
                                    <div class="row">
                                        <div class="col-sm-10">${data.diagnosis_value}</div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-danger btn-xs remove-diagnosis-btn" data-id=${data.id} title="Remove" id="remove-diagnosis-btn${data.id}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>`;
                            });
                            $("#diagnosis-list").empty();
                            $("#diagnosis-list").append(element);
                            $("#diagnosis_id").val(null).empty().trigger('change');
                            setTimeout(() => {
                                $('#diagnosis').modal('hide');
                            }, 100);

                            $('.remove-diagnosis-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeDiagnosis(id);
                            });
                            
                        }
                    });
               }else{
                toastr.error('No Diagnosis Selected');
               }
                   
            }
            setTimeout(() => {
                $("#onExamination").modal('hide');
            }, 100);
        });

        $('#prescription_diagnosis_create').on('reset',function(e){
            e.preventDefault();
            $("#diagnosis_id").val(null).empty().trigger('change');
            setTimeout(() => {
                $('#diagnosis').modal('hide');
            }, 100);
        });

        $("#diagnosisbtn").on('click',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
                $('#diagnosis').modal('hide');
            }else{
                $.ajax({
                        type: 'get',
                        dataType: "json",
                        url: "{{ url('prescriptiondiagnosis') }}/"+prescription_no,
                        success: function (data) {
                            if(data.success){
                                $("#diagnosis_id").val(null).empty().trigger('change');
                                data.diagnosis.forEach(x => {
                                    console.log([x.diagnosis_value,x.diagnosis_id])
                                    let newOption = new Option(x.diagnosis_value,x.diagnosis_id, true, true);
                                    $('#diagnosis_id').append(newOption).trigger('change');
                                });
                            }else{
                                $("#diagnosis_id").val(null).empty().trigger('change');
                            }
                            
                        }
                    });

            $('#diagnosis').modal('show');

            }
        })

         //Advice Section Add Delete Start Here
        $('#advice_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('advices/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#advice'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        function removeAdvice(id){
            $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{ url('prescriptionadvice') }}/"+id,
                    data: {
                        _token:'{{ csrf_token() }}',
                        _method:'DELETE'
                    },
                    success: function (data) {
                        console.log(data);
                        if(data.success){
                            toastr.success("Advice Remove Successfully");
                            $("#remove-advice-btn"+id).closest("li").remove();
                        }
                        
                    }
                });
        }

        $('#prescription_advice_create').on('submit',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
            }else{
                let formData = $(this).serialize();
                let new_advice = checkNew('advice_id');
                    formData += '&prescription_id=' + encodeURIComponent(prescription_no);
                    formData += '&new_advice=' + encodeURIComponent(new_advice);
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{ url('prescriptionadvice') }}",
                        data: formData,
                        success: function (data) {
                            console.log(data);
                            toastr.success("Advice Added Successfully");
                            let element = `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.advice_value}</div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn  btn-xs remove-advice-btn" data-id=${data.id} title="Remove" id="remove-advice-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            $("#advice-list").append(element);
                            $("#advice_id").val('').empty().trigger('change');
                            setTimeout(() => {
                                $('#advice').modal('hide');
                            }, 100);

                            $('.remove-advice-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeAdvice(id);
                            });
                            
                        }
                    });
            }
            setTimeout(() => {
                $("#onExamination").modal('hide');
            }, 100);
        });

        $('#prescription_advice_create').on('reset',function(e){
            e.preventDefault();
            $("#advice_id").val('').empty().trigger('change');
            setTimeout(() => {
                $('#advice').modal('hide');
            }, 100);
        });

        //Investigations Section Add Delete Start Here
        $('#investigations_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('tests/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        function removeInvestigations(id){
            $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{ url('prescriptioninvestigation') }}/"+id,
                    data: {
                        _token:'{{ csrf_token() }}',
                        _method:'DELETE'
                    },
                    success: function (data) {
                        console.log(data);
                        if(data.success){
                            toastr.success("Diagnosis Remove Successfully");
                            $("#remove-test-btn"+id).closest("li").remove();
                        }
                        
                    }
                });
        }

        $('#prescription_investigations_create').on('submit',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
            }else{
                let formData = $(this).serialize();
                let new_investigations = checkNew('investigations_id');
                    formData += '&prescription_id=' + encodeURIComponent(prescription_no);
                    formData += '&new_investigations=' + encodeURIComponent(new_investigations);
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{ url('prescriptioninvestigation') }}",
                        data: formData,
                        success: function (data) {
                            console.log(data);
                            if('error' in data){
                                toastr.error(data.error);
                                return;
                            }
                            toastr.success("Investigation Added Successfully");
                            let element = `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.investigations_value}</div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger btn-xs remove-test-btn" data-id=${data.id} title="Remove" id="remove-test-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            $("#test-list").append(element);
                            $("#investigations_id").val('').empty().trigger('change');
                            setTimeout(() => {
                                $('#investigations').modal('hide');
                            }, 100);

                            $('.remove-test-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeInvestigations(id);
                            });
                            
                        }
                    });
            }
            setTimeout(() => {
                $("#investigations").modal('hide');
            }, 100);
        });

        $('#prescription_investigations_create').on('reset',function(e){
            e.preventDefault();
             $("#investigations_id").val('').empty().trigger('change');
            setTimeout(() => {
                $('#investigations').modal('hide');
            }, 100);
        });

        //Referred Section Add Delete Start Here
        $('#referred_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('referred/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#referred'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        function removeReferred(id){
            $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{ url('prescriptionreferred') }}/"+id,
                    data: {
                        _token:'{{ csrf_token() }}',
                        _method:'DELETE'
                    },
                    success: function (data) {
                        console.log(data);
                        if(data.success){
                            toastr.success("Referred Remove Successfully");
                            $("#remove-test-btn"+id).closest("li").remove();
                        }
                        
                    }
                });
        }

        $('#prescription_referred_create').on('submit',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
            }else{
                let formData = $(this).serialize();
                let new_referred = checkNew('referred_id');
                    formData += '&new_referred=' + encodeURIComponent(new_referred);
                    formData += '&prescription_id=' + encodeURIComponent(prescription_no);
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{ url('prescriptionreferred') }}",
                        data: formData,
                        success: function (data) {
                            console.log(data);
                            if('error' in data){
                                toastr.error(data.error);
                                return;
                            }
                            toastr.success("Referred Added Successfully");
                            let element = `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.referred}</div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger btn-xs remove-referred-btn" data-id=${data.id} title="Remove" id="remove-test-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            $("#referred-list").append(element);
                            $("#referred_id").val(null).empty().trigger('change');
                            setTimeout(() => {
                                $('#investigations').modal('hide');
                            }, 100);

                            $('.remove-referred-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeReferred(id);
                            });
                            
                        }
                    });
            }
            setTimeout(() => {
                $("#referred").modal('hide');
            }, 100);
        });

        $('#prescription_referred_create').on('reset',function(e){
            e.preventDefault();
            $("#referred_id").val(null).empty().trigger('change');
            setTimeout(() => {
                $("#referred").modal('hide');
            }, 100);
        });

        //Medicines Section Add Delete Start Here
        $('#medicines_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('medicines/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

         //Doses Section Add Delete Start Here
        $('#dose_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('dose/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });
         //Dose Duration Section Add Delete Start Here
        $('#dose_duration_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('doseduration/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

         //Usage Section Add Delete Start Here
        $('#usage_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('usage/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        $('#dose_frequency_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('dosefrequency/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        function removeMedicines(id){
            $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{ url('prescriptionmedicines') }}/"+id,
                    data: {
                        _token:'{{ csrf_token() }}',
                        _method:'DELETE'
                    },
                    success: function (data) {
                        console.log(data);
                        if(data.success){
                            toastr.success("Medicine Remove Successfully");
                            $("#remove-medicines-btn"+id).closest("li").remove();
                        }
                        
                    }
                });
        }

        function updateMedicines(id){
            $("#medecine-edit").modal('show');
            $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: "{{ url('prescriptionmedicines') }}/"+id,
                    success: function (data) {
                        console.log(data);
                        if(data){
                            // toastr.success("Medicine Remove Successfully");
                            setSelectedValue('u-medicines_id',data.medicine_id,data.medicine);
                            setSelectedValue('u-dose_id',data.dose_id,data.dose);
                            setSelectedValue('u-dose_duration_id',data.dose_duration_id,data.dose_duration);
                            setSelectedValue('u-usage_id',data.usage_id,data.usage);
                            setSelectedValue('u-dose_frequency_id',data.dose_frequency_id,data.dose_frequency);
                            $("#u-id").val(data.id);
                            // $("#remove-medicines-btn"+id).closest("li").remove();
                        }
                        
                    }
            });
        }

        $('#prescription_medicines_create').on('submit',function(e){
            e.preventDefault();
            let prescription_no = $("#prescription-no").text();
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
            }else{
                let formData = $(this).serialize();
                let new_medicines = checkNew('medicines_id');
                let new_dose = checkNew('dose_id');
                let new_dose_duration = checkNew('dose_duration_id');
                let new_usage = checkNew('usage_id');
                let new_dose_frequency = checkNew('dose_frequency_id');
                    formData += '&prescription_id=' + encodeURIComponent(prescription_no);
                    formData += '&new_medicines=' + encodeURIComponent(new_medicines);
                    formData += '&new_dose=' + encodeURIComponent(new_dose);
                    formData += '&new_dose_duration=' + encodeURIComponent(new_dose_duration);
                    formData += '&new_usage=' + encodeURIComponent(new_usage);
                    formData += '&new_dose_frequency=' + encodeURIComponent(new_dose_frequency);
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{ url('prescriptionmedicines') }}",
                        data: formData,
                        success: function (data) {
                            console.log(data);
                            toastr.success("Medicine Added Successfully");
                            let element = `<li>
                                <div class="row border m-2">
                                    <div class="col-sm-10">
                                        <h5>${data.medicine}</h5>
                                        ${data.dose} ${data.dose_frequency == undefined ? '' :'--'+data.dose_frequency}    ${data.dose_duration == undefined ? '' :'-- [ '+data.dose_duration+' ]'}  -- ${data.usage == undefined ? '' :'-- '+data.usage} 

                                    </div>
                                    <div class="col-sm-2 align-center">
                                        <button type="button" class="btn btn-primary btn-xs update-medicines-btn float-left" data-id=${data.id} title="Update" id="update-medicines-btn${data.id}">
                                            <i class="fas fa-edit p-1"></i>Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs remove-medicines-btn float-right" data-id=${data.id} title="Remove" id="remove-medicines-btn${data.id}">
                                            <i class="fas fa-times p-1"></i>Remove
                                        </button>
                                    </div>
                                    
                                </div>
                            </li>`;
                            $("#treatment-list").append(element);
                            $("#medicines_id").val('').empty().trigger('change');
                            $("#dose_id").val('').empty().trigger('change');
                            $("#dose_duration_id").val('').empty().trigger('change');
                            $("#usage_id").val('').empty().trigger('change');
                            $("#dose_frequency_id").val('').empty().trigger('change');
                            $('.remove-medicines-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeMedicines(id);
                            });
                            $('.update-medicines-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                updateMedicines(id);
                            });
                        }
                    });
            }
            setTimeout(() => {
                $("#medecine").modal('hide');
            }, 100);
        });

        $('#prescription_medicines_create').on('reset',function(e){
            e.preventDefault();
            $("#medicines_id").val('').empty().trigger('change');
            $("#dose_id").val('').empty().trigger('change');
            $("#dose_duration_id").val('').empty().trigger('change');
            $("#usage_id").val('').empty().trigger('change');
            $("#dose_frequency_id").val('').empty().trigger('change');
            setTimeout(() => {
                $("#medecine").modal('hide');
            }, 100);
        });

        //medicine update and remove

        //Medicines Section Add Delete Start Here
        $('#u-medicines_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('medicines/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

         //Doses Section Add Delete Start Here
        $('#u-dose_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('dose/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });
        //Dose Duration Section Add Delete Start Here
        $('#u-dose_duration_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('doseduration/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        //Usage Section Add Delete Start Here
        $('#u-usage_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('usage/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        $('#u-dose_frequency_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
            allowClear: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('dosefrequency/search') }}",
                dataType: 'json',
                delay: 250,
                cache: true,
                dropdownParent: $('#investigations'),
                data: function (params) {
                    return {
                        q: params.term, // search term
                        _token: "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            },
            createTag: function (params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // flag to identify new item
                };
            }
        });

        $("#medecine-edit-form").on('submit',function(e){
            e.preventDefault();
            let id = $("#u-id").val();
            let formData = $(this).serialize();
            let new_medicines = checkNew('u-medicines_id');
            let new_dose = checkNew('u-dose_id');
            let new_dose_duration = checkNew('u-dose_duration_id');
            let new_usage = checkNew('u-usage_id');
            let new_dose_frequency = checkNew('u-dose_frequency_id');
                formData += '&new_medicines=' + encodeURIComponent(new_medicines);
                formData += '&new_dose=' + encodeURIComponent(new_dose);
                formData += '&new_dose_duration=' + encodeURIComponent(new_dose_duration);
                formData += '&new_usage=' + encodeURIComponent(new_usage);
                formData += '&new_dose_frequency=' + encodeURIComponent(new_dose_frequency);
                console.log(formData);
            $.ajax({
                type: 'put',
                dataType: "json",
                url: "{{ url('prescriptionmedicines') }}/"+id,
                data: formData,
                success: function (data) {
                    console.log(data);
                    toastr.success("Medicine Updated Successfully");
                    let element = `<li>
                        <div class="row border m-2">
                            <div class="col-sm-10">
                                <h5>${data.medicine}</h5>
                                ${data.dose} ${data.dose_frequency == undefined ? '' :'--'+data.dose_frequency}    ${data.dose_duration == undefined ? '' :'-- [ '+data.dose_duration+' ]'}  -- ${data.usage == undefined ? '' :'-- '+data.usage} 

                            </div>
                            <div class="col-sm-2 align-center">
                                <button type="button" class="btn btn-primary btn-xs update-medicines-btn float-left" data-id=${data.id} title="Update" id="update-medicines-btn${data.id}">
                                    <i class="fas fa-edit p-1"></i>Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-xs remove-medicines-btn float-right" data-id=${data.id} title="Remove" id="remove-medicines-btn${data.id}">
                                    <i class="fas fa-times p-1"></i>Remove
                                </button>
                            </div>
                            
                        </div>
                        </li>`;
                    $("#update-medicines-btn"+id).closest('li').replaceWith(element);
                    $("#u-medicines_id").val('').empty().trigger('change');
                    $("#u-dose_id").val('').empty().trigger('change');
                    $("#u-dose_duration_id").val('').empty().trigger('change');
                    $("#u-usage_id").val('').empty().trigger('change');
                    $("#u-dose_frequency_id").val('').empty().trigger('change');
                    $("#u-id").val('');
                    $('.remove-medicines-btn').off('click').on('click',function(e){
                        let id = $(this).attr('data-id');
                        removeMedicines(id);
                    });
                    $('.update-medicines-btn').off('click').on('click',function(e){
                        let id = $(this).attr('data-id');
                        updateMedicines(id);
                    });
                }
            });
           
        });

        $(document).on('select2:open', function (e) {
            const searchField = document.querySelector('.select2-container--open .select2-search__field');
            if (searchField) {
                searchField.focus();
            }
        });
        $.fn.modal.Constructor.prototype._enforceFocus = function() {};

        function getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`; // Format: YYYY-MM-DD
        }

        $(function () {
            $('.select2bs4').select2({
            theme: 'bootstrap4',
            })
            $('#birth_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });

        $("#cheif-complaint-save").on('click',function(){
            $('#cheifComplaint').modal('hide')
        });

        function setPatient(id){
            let patient_id = $("#patient-id"+id).text();
            let patient_name = $("#patient-name"+id).text();
            let patient_gender = $("#patient-gender"+id).text();
            let patient_age = $("#patient-age"+id).text();
            let appon_date = $("#appon-date"+id).text();
            let serial_no = $("#serial-no"+id).text();
            let appoint_id = $("#appointment_id"+id).val();
            
            $("#patient-id").text(patient_id);
            $("#patient-name").text(patient_name);
            $("#patient-gender").text(patient_gender);
            $("#patient-age").text(patient_age);
            $("#appon-date").text(appon_date);
            $("#serial-no").text(serial_no);
            $("#appoint_no").val(appoint_id);
            $("#prescription-no").text("");
            
            console.log([id,patient_id]);
            $('#appointedPatient').modal('hide');
            clearPrescribedSpace();
        }

        $("#aptpantbtn").on('click',function(){
            let doctor_id = "{{Auth::user()->user_id}}";
                $.ajax({
                    type:"GET",
                    url: "{{url('appointed/patientlist/')}}/"+doctor_id,
                    success: function (result) {
                        $("#appoin-patient-list").empty();
                            console.log(result);
                         let element = "";
                         result.forEach(x =>{
                            element += `<li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="appointment_id[]" id="appointment_id${x.id}" value="${x.appoint_id}">
                                                    <b>Patient ID :</b><em id="patient-id${x.id}">${x.patient_id}</em>
                                                    <br>
                                                    <b>Name :</b> <span id="patient-name${x.id}">${x.patient.name}</span>
                                                    <br>
                                                    <b>Contact No :</b> <span id="patient-contact${x.id}">${x.patient.contact_no}</span>
                                                    <br>
                                                    <b>Age :</b> <span id="patient-age${x.id}">${x.patient.age}</span>
                                                    <br>
                                                    <b>Gender :</b> <span id="patient-gender${x.id}">${x.patient.sex == 'M'?'Male':(x.patient.sex == 'F'?'Female':'Other')}</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <b>Date :</b> <em id="appon-date${x.id}">${x.appointed_date}</em>
                                                    <br>
                                                    <b>Serial No :</b><span id="serial-no${x.id}">${x.serial}</span>
                                                    <br>
                                                    <b>Note :</b><em id="note${x.id}">${x.note}</em>
                                                    <br>
                                                     <button class="btn btn-sm btn-info prescribe" data-id=${x.id} style="float: right">
                                                        Select
                                                    </button>
                                                </div>

                                            </div>
                                        </li>`;
                         });
                         $("#appoin-patient-list").append(element);
                         $(".prescribe").on('click',function(e){
                            let appoint_id = $(this).attr('data-id');
                            setPatient(appoint_id);
                         });
                    }
                });
        });

        $(".reg-prescribe").on('click',function(e){
            let id = $(this).attr('data-id');
            patientSet(id);
        });

        function patientSet(id){
            let doctor_id = "{{Auth::user()->user_id}}";
            let patient_id = $("#reg-patient-id"+id).text();
            let patient_name = $("#reg-patient-name"+id).text();
            let patient_gender = $("#reg-patient-gender"+id).text();
            let patient_age = $("#reg-patient-age"+id).text();
           let appointed_date = getTodayDate();
           console.log([appointed_date,patient_id,doctor_id]);
           $.ajax({
                    type: "POST",
                    url: "{{url('appoinments')}}",
                    data: {
                            '_token':'{{ csrf_token() }}',
                            'patient_id':patient_id,
                            'doctor_id':doctor_id,
                            'appointed_date':appointed_date
                        },
                    success: function(response) {
                        if("success" in response){
                            toastr.success('New Appointment Created');
                                $("#patient-id").text(patient_id);
                                $("#patient-name").text(patient_name);
                                $("#patient-gender").text(patient_gender);
                                $("#patient-age").text(patient_age);
                                $("#serial-no").text(response.success.serial);
                                $("#appoint_no").val(response.success.appoint_id);
                                $("#appon-date").text(response.success.appointed_date);
                                console.log([id,patient_id]);
                                $('#allPatient').modal('hide')
                                $("#prescription-no").text("");
                                clearPrescribedSpace();
                        }
                    },
                });
        }
        $("#patient").on('keyup',function(e){
            let ch_data = $("#patient").val();
            console.log(ch_data);
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('patient')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                        element += `<li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <b>Patient ID :</b> <em id="reg-patient-id${x.id}">${x.patient_id}</em>
                                            <br>
                                            <b>Name :</b> <span id="reg-patient-name${x.id}">${x.name}</span>
                                            <br>
                                            <b>Gender :</b> <span id="reg-patient-gender${x.id}">${x.sex == 'M'?'Male':(x.sex == 'F'?'Female':'Other')}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <b>Contact No :</b> ${x.contact_no}
                                                <br>
                                                <b>Age :</b> <span id="reg-patient-age${x.id}">${x.age}</span>
                                                <br>
                                                <button class="btn btn-sm btn-info reg-prescribe" data-id=${x.id} style="float: right">
                                                    SELECT
                                                </button>
                                            </div>
                                        </div>
                                    </li>`
                        });
                        $("#patient_search_list").empty();
                        $("#patient_search_list").append(element);
                        $(".reg-prescribe").on('click',function(e){
                            let id = $(this).attr('data-id');
                            patientSet(id);
                        });
                    }
                });
        });

        
        $('#new_patient_create').submit(function(e) {
                e.preventDefault();
                let formdata = $('#new_patient_create').serialize();
                console.log(formdata);
                $.ajax({
                    type: "POST",
                    url: "{{url('patients')}}",
                    data: formdata,
                    success: function(response) {
                        if('success' in response){
                            console.log(response);
                            $("#patient-id").text(response.success.patient_id);
                            $("#patient-name").text(response.patient.name);
                            $("#patient-gender").text(response.patient.sex=='M'?'Male':(response.success.sex=='F'?'Female':'Other'));
                            $("#patient-age").text(response.patient.age);
                            $("#appon-date").text(response.success.appointed_date);
                            $("#serial-no").text(response.success.serial);
                            $("#appoint_no").val(response.success.appoint_id);
                            $('#new_patient_create').trigger("reset");
                            $('#allPatient').modal('hide')
                            $("#prescription-no").text("");
                            clearPrescribedSpace();
                            toastr.success('New Patient & Appointment Created');
                        }
                    $('#newPatient').modal("hide");
                    },
                });
                console.log('Worked');
        });

        $("#prescribe-btn").on('click',function(){
            let doctor_id = "{{Auth::user()->user_id}}";
            let patient_id = $("#patient-id").text();
            let patient_name = $("#patient-name").text();
            let patient_gender = $("#patient-gender").text();
            let patient_age = $("#patient-age").text();
            let appoint_id = $("#appoint_no").val();
           let prescribed_date = getTodayDate();
           console.log([prescribed_date,patient_id,doctor_id]);
           $.ajax({
                    type: "POST",
                    url: "{{url('prescribe')}}",
                    data: {
                            '_token':'{{ csrf_token() }}',
                            'patient_id':patient_id,
                            'doctor_id':doctor_id,
                            'patient_name':patient_name,
                            'patient_gender':patient_gender,
                            'patient_age':patient_age,
                            'prescribed_date':prescribed_date,
                            'appoint_id':appoint_id,
                            'visited_btn':2

                        },
                    success: function(response) {
                        if('error' in response){
                            toastr.error(response.error);
                        }
                        if("success" in response){
                            toastr.success('New Prescription Generated');
                            $("#prescription-no").text(response.success.prescription_id);
                            
                        }
                    },
                });
        });

        $("#visited-btn").on('click',function(){
            let doctor_id = "{{Auth::user()->user_id}}";
            let patient_id = $("#patient-id").text();
            let patient_name = $("#patient-name").text();
            let patient_gender = $("#patient-gender").text();
            let patient_age = $("#patient-age").text();
            let appoint_id = $("#appoint_no").val();
           let prescribed_date = getTodayDate();
           console.log([prescribed_date,patient_id,doctor_id]);
           $.ajax({
                    type: "POST",
                    url: "{{url('prescribe')}}",
                    data: {
                            '_token':'{{ csrf_token() }}',
                            'patient_id':patient_id,
                            'doctor_id':doctor_id,
                            'patient_name':patient_name,
                            'patient_gender':patient_gender,
                            'patient_age':patient_age,
                            'prescribed_date':prescribed_date,
                            'appoint_id':appoint_id,
                            'visited_btn':1
                        },
                    success: function(response) {
                        if("success" in response){
                            toastr.success('New Prescription Generated');
                            $("#patient-id").text("");
                            $("#patient-name").text("");
                            $("#patient-gender").text("");
                            $("#patient-age").text("");
                            $("#appon-date").text("");
                            $("#serial-no").text("");
                            $("#appoint_no").val("");
                        }
                    },
                });
        });

        function loadPrescription(id){
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('prescription/detail')}}/",
                    data:{
                        'search':id,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let appointment = result.appointment;
                        $("#patient-id").text(appointment.patient_id);
                        $("#patient-name").text(appointment.patient.name);
                        $("#patient-gender").text(appointment.patient.sex == 'M' ? 'Male' : (appointment.patient.sex == 'F' ? 'Female' : 'Other'));
                        $("#patient-age").text(appointment.patient.age);
                        $("#appon-date").text(appointment.appointed_date);
                        $("#serial-no").text(appointment.serial);
                        $("#appoint_no").val(appointment.appoint_id);
                        $("#prescription-no").text("");
                        clearPrescribedSpace();
                        if(result.main){
                            $("#prescription-no").text(result.main.prescription_id);
                        }
                        if(result.complain){
                            let element = ""
                            result.complain.forEach(data => {
                                console.log(data);
                                element += `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.complaint} </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger btn-xs remove-complaint-btn" data-id=${data.id} title="Remove" id="remove-complaint-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            });
                            $("#cheif-complaint-list").empty();
                            $("#cheif-complaint-list").append(element);
                            $('.remove-complaint-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeComplaint(id);
                            });
                        }

                        if(result.diagnosis){
                            let element = ""
                            result.diagnosis.forEach(data => {
                                console.log(data);
                                element += `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.diagnosis_value}</div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger btn-xs remove-diagnosis-btn" data-id=${data.id} title="Remove" id="remove-diagnosis-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            });
                            $("#diagnosis-list").empty();
                            $("#diagnosis-list").append(element);
                            $('.remove-diagnosis-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeDiagnosis(id);
                            });
                        }

                        if(result.onexam){
                            let x = result.onexam;
                            if(x.pressure == null){
                                $('#pressure_value').text("");
                                $('#pressure_value').closest('.exam-part').hide();
                            }else{
                                $('#pressure_value').text(x.pressure);
                                $('#pressure_value').closest('.exam-part').show();
                            }
                            if(x.temperature == null){
                                $('#temperature_value').text("");
                                $('#temperature_value').closest('.exam-part').hide();
                            }else{
                                $('#temperature_value').text(x.temperature);
                                $('#temperature_value').closest('.exam-part').show();
                            }
                            if(x.height == null){
                                $('#height_value').text("");
                                $('#height_value').closest('.exam-part').hide();
                            }else{
                                $('#height_value').text(x.height);
                                $('#height_value').closest('.exam-part').show();
                            }
                            if(x.weight == null){
                                $('#weight_value').text("");
                                $('#weight_value').closest('.exam-part').hide();
                            }else{
                                $('#weight_value').text(x.weight);
                                $('#weight_value').closest('.exam-part').show();
                            }
                            if(x.bmi == null){
                                $('#bmi_value').text("");
                                $('#bmi_value').closest('.exam-part').hide();
                            }else{
                                $('#bmi_value').text(x.bmi);
                                $('#bmi_value').closest('.exam-part').show();
                            }
                        }

                        if(result.investigations){
                            let element = "";
                            result.investigations.forEach(data => {
                                 element += `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.investigations_value}</div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger btn-xs remove-test-btn" data-id=${data.id} title="Remove" id="remove-test-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            });
                            $("#test-list").empty();
                            $("#test-list").append(element);
                            $('.remove-test-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeInvestigations(id);
                            });
                            
                        }

                        if(result.advices){
                            let element = "";
                            result.advices.forEach(data => {
                                console.log(data);
                                 element += `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.advice_value}</div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn  btn-xs remove-advice-btn" data-id=${data.id} title="Remove" id="remove-advice-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            });
                            $("#advice-list").empty();
                            $("#advice-list").append(element);
                            $('.remove-advice-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeAdvice(id);
                            });
                        }

                        if(result.referred){
                            let element = "";
                            result.referred.forEach(data => {
                                console.log(data);
                                 element += `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.referred}</div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger btn-xs remove-referred-btn" data-id=${data.id} title="Remove" id="remove-test-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            });
                            $("#referred-list").empty();
                            $("#referred-list").append(element);
                            $('.remove-referred-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeReferred(id);
                            });
                        }

                        if(result.medicins){
                            let element = "";
                            result.medicins.forEach(data => {
                                element += `<li>
                                <div class="row border m-2">
                                    <div class="col-sm-10">
                                        <h5>${data.medicine}</h5>
                                        ${data.dose} ${data.dose_frequency == undefined ? '' :'--'+data.dose_frequency}    ${data.dose_duration == undefined ? '' :'-- [ '+data.dose_duration+' ]'}  -- ${data.usage == undefined ? '' :'-- '+data.usage} 

                                    </div>
                                    <div class="col-sm-2 align-center">
                                        <button type="button" class="btn btn-primary btn-xs update-medicines-btn float-left" data-id=${data.id} title="Update" id="update-medicines-btn${data.id}">
                                            <i class="fas fa-edit p-1"></i>Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs remove-medicines-btn float-right" data-id=${data.id} title="Remove" id="remove-medicines-btn${data.id}">
                                            <i class="fas fa-times p-1"></i>Remove
                                        </button>
                                    </div>
                                    
                                </div>
                            </li>`;
                            
                            });
                            $("#treatment-list").empty();
                            $("#treatment-list").append(element);
                            $('.remove-medicines-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeMedicines(id);
                            });

                            $('.update-medicines-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                updateMedicines(id);
                            });
                        }

                    }
                });
        
        }

        $("#prescribedbtn").on('click',function(){
            let doctor_id = "{{Auth::user()->user_id}}";
                $.ajax({
                    type:"GET",
                    url: "{{url('appointed/prescribedlist/')}}/"+doctor_id,
                    success: function (result) {
                        $("#prescribed-patient-list").empty();
                            console.log(result);
                         let element = "";
                         result.forEach(x =>{
                            element += `<li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="appointment_id[]" id="appointment_id${x.id}" value="${x.appoint_id}">
                                                    <b>Patient ID :</b><em id="patient-id${x.id}">${x.patient_id}</em>
                                                    <br>
                                                    <b>Name :</b> <span id="patient-name${x.id}">${x.patient.name}</span>
                                                    <br>
                                                    <b>Age :</b> <span id="patient-age${x.id}">${x.patient.age}</span>
                                                    <br>
                                                    <b>Gender :</b> <span id="patient-gender${x.id}">${x.patient.sex == 'M'?'Male':(x.patient.sex == 'F'?'Female':'Other')}</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span id="visited${x.id}" style="text-align: center;display: block;width: 100%;padding: 5px;background-color: ${x.visited == 2 ? "#7dcea0":"#aed6f1"}"><b>${x.visited == 1 ? "Visit":"Prescribed"}</b></span>
                                                    <b>Date :</b> <em id="appon-date${x.id}">${x.appointed_date}</em>
                                                    <br>
                                                    <b>Serial No :</b><span id="serial-no${x.id}">${x.serial}</span>
                                                    <br>
                                                    <br>
                                                     <button class="btn btn-sm btn-info prescribe" data-id=${x.appoint_id} style="float: right">
                                                        Select
                                                    </button>
                                                </div>

                                            </div>
                                        </li>`;
                         });
                         $("#prescribed-patient-list").append(element);
                         $(".prescribe").on('click',function(e){
                            let appoint_id = $(this).attr('data-id');
                            loadPrescription(appoint_id);
                            $("#prescribedPatient").modal('hide');
                         });

                         
                    }
                });
        });

        function printPrescription(prescription_no){
        //    $("#searchPres").modal('hide');
            window.open("{{url('appointed/print')}}"+'/'+prescription_no, '_blank');
        }

        function importPrescription(fromPrescription_no){
            let prescription_no = $("#prescription-no").text();
            let appoint_no = $("#appoint_no").val();
            let from_prescription_no = fromPrescription_no;
            console.log(prescription_no);
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
            }else{
                $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('prescription/importprescription')}}",
                    data:{
                        'fromPrescription_no':from_prescription_no,
                        'toPrescription_no':prescription_no,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        if('success' in result){
                            toastr.success('Prescription Imported Successfully');
                            loadPrescription(appoint_no);
                        }else{
                            toastr.error('Prescription Not Imported');
                        }
                    }
                });
            }
        }

        $("#prescription-search").on('keyup',function(e){
            let ch_data = $("#prescription-search").val();
            console.log(ch_data);
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('prescribe')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                        element += `<li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <b>Patient ID :</b> <em>${x.patient_id}</em>
                                            <br>
                                            <b>Name :</b> <span >${x.patient_name}</span>
                                            <br>
                                            <b>Gender :</b> <span>${x.patient_gender}</span>
                                            <br>
                                            <b>Age :</b> <span >${x.patient_age}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <b>Prescription No :</b> <em>${x.prescription_id}</em>
                                                <br>
                                                <b>Prescribed Date :</b> <em>${x.prescribed_date}</em>
                                                <br>
                                                <b>Appointment No :</b> <em>${x.appoint_id}</em>
                                                <br>
                                                <br>
                                                <button class="btn btn-sm btn-primary prev-prescribe mr-2" data-id=${x.prescription_id} style="float: right">
                                                    PREVIEW
                                                </button>
                                                <button class="btn btn-sm btn-secondary import-prescribe mr-2" data-id=${x.prescription_id} style="float: right">
                                                    IMPORT
                                                </button>
                                                <button class="btn btn-sm btn-info select-prescribe mr-2" data-id=${x.appoint_id} style="float: right">
                                                    SELECT
                                                </button>
                                            </div>
                                        </div>
                                    </li>`
                        });
                        $("#prescription_search_list").empty();
                        $("#prescription_search_list").append(element);
                        $(".select-prescribe").off('click').on('click',function(e){
                            let id = $(this).attr('data-id');
                            loadPrescription(id);
                            $("#searchPres").modal('hide');
                        });

                        $(".prev-prescribe").off('click').on('click',function(e){
                            let id = $(this).attr('data-id');
                            printPrescription(id);
                            // $("#searchPres").modal('hide');
                        });

                        $(".import-prescribe").off('click').on('click',function(e){
                            let id = $(this).attr('data-id');
                            importPrescription(id);
                            $("#searchPres").modal('hide');
                        });
                    }
                });
        });

    });

</script>

@endpush
