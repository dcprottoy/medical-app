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
                    <button class="btn btn-sm btn-info" style="min-width:115px;" data-toggle="modal" id="chiefcomplaintbtn" data-target="#cheifComplaint">Cheif Complaint</button>
                    <div class="modal fade" id="cheifComplaint" tabindex="-1" role="dialog" aria-labelledby="cheifComplaintLabel" aria-hidden="true">
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
                                            <div class="row" style="min-height: 300px;">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Complaint Type</label>
                                                        <select class="form-control form-control-sm"  name="complaint_id" id="complaint_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Complaint Duration</label>
                                                        <select class="form-control form-control-sm"  name="complaint_duration_id" id="complaint_duration_id"></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Complaint Value</label>
                                                        <select class="form-control form-control-sm"  name="complaint_value_id" id="complaint_value_id"></select>
                                                    </div>
                                                </div>
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
                                                    <label>Body Height</label>
                                                    <input type="text" class="form-control form-control-sm" id='bodyHeight' name='body_height' placeholder="height">
                                                </div>
                                                 <div class="form-group">
                                                    <label>BMI</label>
                                                    <input type="text" class="form-control form-control-sm" id='bmi' name='bmi' placeholder="BMI">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Body Temperature</label>
                                                    <input type="text" class="form-control form-control-sm" id="bodyTemperature" name='body_temperature' placeholder="Temperature">
                                                </div>
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
                            <ul class="border-top pt-2" id="cheif-complaint-list" style="min-height:200px;">
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

        //Complaint Section Add Delete Start Here
        $('#complaint_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            autoClear: true,
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
        $('#complaint_duration_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('complaintduration/search') }}",
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
         $('#complaint_value_id').select2({
            placeholder: 'Search or add an item',
            minimumInputLength: 1,
            tags: true,
            ajax: {
                type: 'PUT',
                url: "{{ url('complaintvalue/search') }}",
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
            if(prescription_no == null || prescription_no == undefined || prescription_no == '' || prescription_no == ' ' || prescription_no == NaN){
                toastr.error('Prescription No Not Found');
                $('#cheifComplaint').modal('hide');
            }
            else{
                let formData = $(this).serialize();
                    formData += '&prescription_id=' + encodeURIComponent(prescription_no);
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{ url('prescriptioncomplaint') }}",
                        data: formData,
                        success: function (data) {
                            console.log(data);
                            toastr.success("Complaint Added Successfully");
                            let element = `<li>
                                <div class="row">
                                    <div class="col-sm-10">${data.complaint}    ${data.complaint_duration == undefined ? '' : data.complaint_duration}      ${data.complaint_duration_value == undefined ? '' : data.complaint_duration_value}</div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-xs remove-complaint-btn" data-id=${data.id} title="Remove" id="remove-complaint-btn${data.id}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>`;
                            $("#cheif-complaint-list").append(element);
                            $("#complaint_id").val('').trigger('change');
                            $("#complaint_duration_id").val('').trigger('change');
                            $("#complaint_value_id").val('').trigger('change');
                            setTimeout(() => {
                                $('#cheifComplaint').modal('hide');
                            }, 100);

                            $('.remove-complaint-btn').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                removeComplaint(id);
                            });
                        }
                    });
            }
        });
        //Complaint Section Add Delete End Here





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
                            'appoint_id':appoint_id
                        },
                    success: function(response) {
                        if("success" in response){
                            toastr.success('New Prescription Generated');
                            $("#prescription-no").text(response.success.prescription_id);
                            
                        }
                    },
                });
        });



       

        


    });

</script>

@endpush
