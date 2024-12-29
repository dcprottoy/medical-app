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
                    <button class="btn btn-sm btn-info" data-toggle="modal" id="allptnbtn" data-target="#allPatient">Registered Patient</button>
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
                                                                        Prescribe
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
                    <button class="btn btn-sm btn-primary"  data-toggle="modal" id="newptnbtn" data-target="#newPatient">New Patient</button>
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
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Emergency Contact No.</label>
                                                            <input type="text" class="form-control form-control-sm" name='emr_cont_no' placeholder="Emergency Contact Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input type="text" class="form-control form-control-sm" name='address' placeholder="Address" required>
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
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <b>Patient ID :</b><em id="patient-id"></em>
                            <br>
                            <b>Name :</b> <span id="patient-name"></span>
                        </div>
                        <div class="col-sm-4">
                            <b>Gender :</b> <span id="patient-gender"></span>
                            <br>
                            <b>Age :</b> <span id="patient-age"></span>
                        </div>
                        <div class="col-sm-4">
                            <b>Date :</b> <em id="appon-date"></em>
                            <br>
                            <b>Serial No :</b><span id="serial-no"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-sm btn-info" style="min-width:115px;" data-toggle="modal" id="chiefcomplaintbtn" data-target="#cheifComplaint">Cheif Complaint</button>
                    <div class="modal fade" id="cheifComplaint" tabindex="-1" role="dialog" aria-labelledby="cheifComplaintLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-info">
                                <h5 class="modal-title" id="cheifComplaintModalLabel">Chief Complaint List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <h4 class="text-center">Complaint Information</h4>
                                        <div class="row">
                                            <div class="col-9 border-right" >
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="form-group text-center">
                                                            <input type="text" class="form-control form-control-md" id="complaint-search" placeholder="Search..">
                                                        </div>
                                                        <ul class="list-group complaint-search-list" id="complaint-list">
                                                            @foreach($complaints as $complaint)
                                                                <li class="list-group-item complaint-list-item" data-value="{{$complaint->id}}">{{$complaint->name_eng}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group text-center">
                                                            <input type="text" class="form-control form-control-md" id="compalint-duration-search" placeholder="Search..">
                                                        </div>
                                                        <ul class="list-group complaint-search-list" id="complaint-duration-list">
                                                            @foreach($complaintdurations as $complaintdration)
                                                                <li class="list-group-item complaint-duration-list-item" data-value="{{$complaintdration->id}}">{{$complaintdration->name_eng}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group mt-5">
                                                            <label>Complaint Value</label>
                                                            <input type="text" class="form-control form-control-md" name='complaint_value' placeholder="Complaint Value" id="complaint_value">
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-md btn-success"  id="complaint-add" >Add Complaint</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-3" style="min-height:500px;">
                                                <ul id="complaint-list-text">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-sm btn-success" id="cheif-complaint-save">&nbsp;Save&nbsp;</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-warning" style="min-width:115px;" data-toggle="modal" id="onExaminationbtn" data-target="#onExamination">On Examination</button>
                    <div class="modal fade" id="onExamination" tabindex="-1" role="dialog" aria-labelledby="onExaminationLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
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
                                                    <input type="text" class="form-control form-control-sm" id="bloodPressure" name='blood_pressure' placeholder="Pressure">
                                                </div>
                                                <div class="form-group">
                                                    <label>Body Temperature</label>
                                                    <input type="text" class="form-control form-control-sm" id="bodyTemperature" name='body_temperature' placeholder="Temperature">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Body Weight</label>
                                                    <input type="text" class="form-control form-control-sm" id='bodyWeight' name='body_weight' placeholder="Weight">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-sm btn-success" id="on-examination-save">&nbsp;Save&nbsp;</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-success" style="min-width:115px;" data-toggle="modal" id="diagnosisbtn" data-target="#diagnosis">Diagnosis</button>
                    <div class="modal fade" id="diagnosis" tabindex="-1" role="dialog" aria-labelledby="diagnosisLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-success">
                                <h5 class="modal-title" id="diagnosisModalLabel">Diagnosis List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <h4 class="text-center">Diagnosis Information</h4>
                                        <div class="row">
                                            <div class="col-7 border-right">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-md" id="complaint-search" placeholder="Search..">
                                                </div>
                                                <ul class="list-group complaint-search-list" id="complaint-list">
                                                    @foreach($diagnosis as $diagnos)
                                                        <li class="list-group-item complaint-list-item" data-value="{{$diagnos->id}}">{{$diagnos->name_eng}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-5" style="min-height:500px;">
                                                <ul id="complaint-list-text">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-sm btn-success" id="cheif-complaint-save">&nbsp;Save&nbsp;</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-danger" style="min-width:115px;" data-toggle="modal" id="medecinebtn" data-target="#medecine">Medecine</button>
                    <div class="modal fade" id="medecine" tabindex="-1" role="dialog" aria-labelledby="medecineLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-danger">
                                <h5 class="modal-title" id="medecineModalLabel">Medecine List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <h4 class="text-center">Medecine Information</h4>
                                        <div class="row">
                                            <div class="col-7 border-right">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-md" id="complaint-search" placeholder="Search..">
                                                </div>
                                                <ul class="list-group complaint-search-list" id="complaint-list">
                                                    @foreach($diagnosis as $diagnos)
                                                        <li class="list-group-item complaint-list-item" data-value="{{$diagnos->id}}">{{$diagnos->name_eng}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-5" style="min-height:500px;">
                                                <ul id="complaint-list-text">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-sm btn-success" id="cheif-complaint-save">&nbsp;Save&nbsp;</button>

                                </div>
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-sm btn-primary" style="min-width:115px;" data-toggle="modal" id="advicebtn" data-target="#advice">Advice</button>
                    <div class="modal fade" id="advice" tabindex="-1" role="dialog" aria-labelledby="adviceLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                <h5 class="modal-title" id="adviceModalLabel">Diagnosis List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <h4 class="text-center">Diagnosis Information</h4>
                                        <div class="row">
                                            <div class="col-7 border-right">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-md" id="complaint-search" placeholder="Search..">
                                                </div>
                                                <ul class="list-group complaint-search-list" id="complaint-list">
                                                    @foreach($diagnosis as $diagnos)
                                                        <li class="list-group-item complaint-list-item" data-value="{{$diagnos->id}}">{{$diagnos->name_eng}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-5" style="min-height:500px;">
                                                <ul id="complaint-list-text">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-sm btn-success" id="cheif-complaint-save">&nbsp;Save&nbsp;</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-secondary" style="min-width:115px;" data-toggle="modal" id="referredbtn" data-target="#referred">Referred</button>
                    <div class="modal fade" id="referred" tabindex="-1" role="dialog" aria-labelledby="adviceLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-secondary">
                                <h5 class="modal-title" id="referredModalLabel">Referred List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <h4 class="text-center">Referred Information</h4>
                                        <div class="row">
                                            <div class="col-7 border-right">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-md" id="complaint-search" placeholder="Search..">
                                                </div>
                                                <ul class="list-group complaint-search-list" id="complaint-list">
                                                    @foreach($diagnosis as $diagnos)
                                                        <li class="list-group-item complaint-list-item" data-value="{{$diagnos->id}}">{{$diagnos->name_eng}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-5" style="min-height:500px;">
                                                <ul id="complaint-list-text">
                                                </ul>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-sm btn-success" id="cheif-complaint-save">&nbsp;Save&nbsp;</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body" style = "min-height:250px;">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6>Cheif Complaint</h6>
                            <ul class="border-top pt-2" id="onexam-list" style="min-height:200px;">
                            </ul>
                            <h6>On Examination</h6>
                            <ul class="border-top pt-2" id="onexamination-list" style="min-height:200px;">
                            </ul>
                            <h6>Investigation</h6>
                            <ul class="border-top pt-2" id="test-list" style="min-height:200px;">
                            </ul>
                        </div>
                        <div class=" col-sm-6 border-left">
                                <h6>Diagnosis</h6>
                                <ul class="border-top pt-2" id="diagnosis-list" style="min-height:200px;">
                                </ul>
                                <h5>Rx</h5>
                                <ul id="treatment-list">
                                </ul>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title" style="font-weight:800;">Previous Appointments</h3>
                                </div>
                                <div class="card-body" style = "min-height:80vh;">

                                </div>
                            </div>

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
        let chiefComplaint = [];
        let tempComplaintID = '';
        let tempComplaintText = '';
        let tempComplaintDurationID = '';
        let tempComplaintDurationText = '';
        let tempComplaintValue = '';
        let tempCompleteComplaint = '';
        let onExamination = {
                            blood_pressure:'',
                            body_temperature:'',
                            body_weight:''
                            };

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

            $("#patient-id").text(patient_id);
            $("#patient-name").text(patient_name);
            $("#patient-gender").text(patient_gender);
            $("#patient-age").text(patient_age);
            $("#appon-date").text(appon_date);
            $("#serial-no").text(serial_no);
            console.log([id,patient_id]);
            $('#appointedPatient').modal('hide')
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
                                                        Prescribe
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


            let patient_id = $("#reg-patient-id"+id).text();
            let patient_name = $("#reg-patient-name"+id).text();
            let patient_gender = $("#reg-patient-gender"+id).text();
            let patient_age = $("#reg-patient-age"+id).text();
            let appon_date = $("#reg-appon-date"+id).text();
            let serial_no = $("#reg-serial-no"+id).text();

            $("#patient-id").text(patient_id);
            $("#patient-name").text(patient_name);
            $("#patient-gender").text(patient_gender);
            $("#patient-age").text(patient_age);
            $("#appon-date").text(appon_date);
            $("#serial-no").text(serial_no);
            console.log([id,patient_id]);
            $('#allPatient').modal('hide')

            // $.ajax({
            //         url: "{{url('patients/')}}/"+id,
            //         success: function (result) {
            //             console.log(result);
            //             $("#patient-id").text(result.patient_id);
            //             $("#patient-name").text(result.name);
            //             $("#patient-contact").text(result.contact_no);
            //             $("#patient-age").text(result.age);
            //             checkSerial();
            //         }
            //     });
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
                                                                        Prescribe
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
                            $('#new_patient_create').trigger("reset");
                            toastr.success('New Patient & Appointment Created');
                        }
                    $('#newPatient').modal("hide");
                    },
                });
                console.log('Worked');
        });

        $("#symptom-dropdown").on('change',function(){
            let sypmtomp = $("#symptom-dropdown option:selected").val();
            $("#symptomp-list").append(`
            <li style="list-style-type: none;">
                <div class="row">
                <div class="col-sm-10">${"-"+sypmtomp}</div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-xs remove-btn" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                </div>


                </li>
            `);
            $('.remove-btn').on('click',function(e){
                console.log("Prottoy");
                $(this).closest("li").remove();
            });
        });
        $("#advice-dropdown").on('change',function(){
            let advice = $("#advice-dropdown option:selected").val();
            $("#advice-list").append(`
            <li style="list-style-type: none;">
                <div class="row">
                <div class="col-sm-10">${"-"+advice}</div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-xs remove-btn" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                </div>


                </li>
            `);
            $('.remove-btn').on('click',function(e){
                console.log("Prottoy");
                $(this).closest("li").remove();
            });
        });
        $("#test-dropdown").on('change',function(){
            let test = $("#test-dropdown option:selected").val();
            $("#test-list").append(`
            <li style="list-style-type: none;">
                <div class="row">
                <div class="col-sm-10">${"-"+test}</div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-xs remove-btn" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                </div>


                </li>
            `);

            $('.remove-btn').on('click',function(e){
                console.log("Prottoy");
                $(this).closest("li").remove();
            });
        });

        function removeComplaint(id){
            chiefComplaint = chiefComplaint.filter(x=>{
               return x.complaint_id != id;
            });
            renderComplaint();
        }

        function renderComplaint(){
            $("#complaint-list-text").empty();
            $("#onexam-list").empty();
            let myElement = "";
            chiefComplaint.forEach(x=>{
                tempCompleteComplaint = x.complaint_text+" "+x.complaint_value+" "+x.complaint_duration_text;
                myElement +=`
            <li style="list-style-type: none;">
                <div class="row">
                <div class="col-sm-10">${"- &ensp;"+tempCompleteComplaint}</div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-xs remove-complaint-btn" data-id=${x.complaint_id} title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                </div>


                </li>
            `;
            });

            $("#complaint-list-text").append(myElement);
            $("#onexam-list").append(myElement);

            $('.remove-complaint-btn').on('click',function(e){
                console.log("Prottoy");
                let removeID = $(this).attr('data-id');
                removeComplaint(removeID);
            });

           console.log(tempCompleteComplaint);
        }

        $("#chiefcomplaintbtn").on('click',function(){
            renderComplaint();
        });
        $(".complaint-list-item").on('click',function(){
           let text = $(this).text();
           let id = $(this).attr('data-value');
           $('.complaint-list-item').each(function(){
            $(this).css("background-color", "white");
           });
           $(this).css("background-color", "beige");
           tempComplaintID = id;
           tempComplaintText = text;
           console.log([tempComplaintID,tempComplaintText]);
        });
        $(".complaint-duration-list-item").on('click',function(){
           let text = $(this).text();
           let id = $(this).attr('data-value');
           $('.complaint-duration-list-item').each(function(){
            $(this).css("background-color", "white");
           });
           if(tempComplaintDurationID != id){
                $(this).css("background-color", "beige");
            tempComplaintDurationID = id;
            tempComplaintDurationText = text;
            console.log([tempComplaintDurationID,tempComplaintDurationText]);
           }else{
            tempComplaintDurationID = '';
            tempComplaintDurationText = '';
           }

        });
        $("#complaint-add").on('click',function(){
            let text = $("#complaint_value").val();

            let checkExistence = false;
            chiefComplaint.forEach(x=>{
                if(x.complaint_id == tempComplaintID){
                    checkExistence =  true ;
                }
            });
            if(tempComplaintID && tempComplaintText){
                if(!checkExistence){
                    chiefComplaint = [...chiefComplaint,{
                    'complaint_id':tempComplaintID,
                    'complaint_text':tempComplaintText,
                    'complaint_duration_id':tempComplaintDurationID,
                    'complaint_duration_text':tempComplaintDurationText,
                    'complaint_value':text
                    }]
                }else{
                    chiefComplaint = chiefComplaint.map( x =>{

                        if(x.complaint_id == tempComplaintID){
                            x.complaint_id = tempComplaintID,
                            x.complaint_text = tempComplaintText,
                            x.complaint_duration_id = tempComplaintDurationID,
                            x.complaint_duration_text = tempComplaintDurationText,
                            x.complaint_value = text
                        }

                        return x;


                    });
                }

                console.log(chiefComplaint);
                renderComplaint();
                $('.complaint-duration-list-item').each(function(){
                    $(this).css("background-color", "white");
                });
                $('.complaint-list-item').each(function(){
                    $(this).css("background-color", "white");
                });
                $("#complaint_value").val('');
                tempComplaintID = '';
                tempComplaintText = '';
                tempComplaintDurationID = '';
                tempComplaintDurationText = '';
                text = '';
            }
        });
        $('#complaint-search').on('keyup', function() {
                var value = $(this).val().toLowerCase(); // Get the search input value
                $('#complaint-list li').filter(function() {
                    // Show or hide list items based on the search query
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
        });
        $('#compalint-duration-search').on('keyup', function() {
                var value = $(this).val().toLowerCase(); // Get the search input value
                $('#complaint-duration-list li').filter(function() {
                    // Show or hide list items based on the search query
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
        });
        function removeOnExamination(id){
            onExamination[id]='';
            renderOnExamination();
        }
        function renderOnExamination(){
            $("#onexamination-list").empty();
            $("#bloodPressure").val(onExamination.blood_pressure);
            $("#bodyTemperature").val(onExamination.body_temperature);
            $("#bodyWeight").val(onExamination.body_weight);
            let myElement = "";

            if(onExamination.blood_pressure!=''){
                myElement +=`
                <li style="list-style-type: none;">
                    <div class="row">
                    <div class="col-sm-10">Blood Pressure${":&ensp;"+onExamination.blood_pressure}</div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-xs remove-onexamination-btn" data-id='blood_pressure' title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                </li>
                `;
            }
            if(onExamination.body_temperature!=''){
                myElement +=`
                <li style="list-style-type: none;">
                    <div class="row">
                    <div class="col-sm-10">Body Temperature${":&ensp;"+onExamination.body_temperature}<sup>o</sup></div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-xs remove-onexamination-btn" data-id='body_temperature' title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                </li>
                `;
            }
            if(onExamination.body_weight!=''){
                myElement +=`
                <li style="list-style-type: none;">
                    <div class="row">
                    <div class="col-sm-10">Body Weight${":&ensp;"+onExamination.body_weight} kg</div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-xs remove-onexamination-btn" data-id='body_weight' title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                </li>
                `;
            }

            $("#onexamination-list").append(myElement);

            $('.remove-onexamination-btn').on('click',function(e){
                console.log("Prottoy");
                let removeID = $(this).attr('data-id');
                removeOnExamination(removeID);
            });

        }

        $("#on-examination-save").on('click',function(){
            onExamination.blood_pressure = $("#bloodPressure").val();
            onExamination.body_temperature = $("#bodyTemperature").val();
            onExamination.body_weight = $("#bodyWeight").val();
            renderOnExamination();
            $('#onExamination').modal('hide');
        });

        $("#onExaminationbtn").on('click',function(){
            renderOnExamination();
        });


    });

</script>

@endpush
