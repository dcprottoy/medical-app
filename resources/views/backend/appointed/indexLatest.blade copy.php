@extends('backend.layout.main')
@section('body-part')
<style>
.search-list{
    height:550px;
    overflow-x: hidden;
    overflow-y: scroll;
}
.add-list{
    overflow-x: hidden;
    overflow-y: scroll;
}
@media print
{
body * { visibility: hidden; }
#print-div * { visibility: visible; }
#print-button { visibility: hidden; }

#print-div { position: absolute; top: 40px; left: 30px; }
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
                                    <h5 class="modal-title" id="newPatientModalLabel">New Patient Registration</h5>
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
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Age</label>
                                                            <input type="text" class="form-control form-control-sm" name='age' placeholder="Age" required>
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
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight:800;">On Examination</h3>
                        </div>
                        <div class="card-body" style = "min-height:250px;">

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        {{-- <select class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                                                style="width: 100%;"> --}}
                                        <select class="select2bs4" data-placeholder="Select a Symptomps" style="width: 100%;" id="onexam-dropdown">
                                            <option value="" >Select An Examination</option>
                                            <option value="Fever" >Fever</option>
                                            <option value="Chest Pain">Chest Pain</option>
                                            <option value="Joint Pain">Joint Pain</option>
                                            <option value="Caugh">Caugh</option>
                                            <option value="Blury Vission">Blury Vission</option>
                                            <option value="Pain In Stomach">Pain In Stomach</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-md" name='onexam_value' placeholder="value" id="onexam_value">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <a class="btn btn-info btn-sm p-2 add-exam">
                                            <i style="font-size:10px;" class="fas fa-check"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <ul id="onexam-list">
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight:800;">Tests</h3>
                        </div>
                        <div class="card-body" style = "min-height:250px;">
                            <div class="form-group">
                                {{-- <select class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                                        style="width: 100%;"> --}}
                                <select class="select2bs4" data-placeholder="Select a Test" style="width: 100%;" id="test-dropdown">
                                    <option value="" >Select An Test</option>
                                    <option value="CBC" >CBC</option>
                                    <option value="RBS">RBS</option>
                                    <option value="Dengue(NS1)">Dengue(NS1)</option>
                                </select>
                            </div>
                            <ul id="test-list">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card col-sm-6">
                    <div class="card-header">
                        <h3 class="card-title" style="font-weight:800;">Treatment</h3>
                        <div class="card-tools">

                            <button type="button" class="btn" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style = "min-height:500px;">

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight:800;">Initial Examination</h3>
                        </div>
                        <div class="card-body" style = "min-height:100px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood Pressure </label>
                                        <input type="text" class="form-control form-control-sm" name='blood_pressure' placeholder="Pressure" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Body Temperature</label>
                                        <input type="text" class="form-control form-control-sm" name='body_temperature' placeholder="Temperature" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Body Weight</label>
                                        <input type="text" class="form-control form-control-sm" name='body_weight' placeholder="Weight" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight:800;">Symptomps</h3>
                        </div>
                        <div class="card-body" style = "min-height:200px;">
                            <div class="form-group">
                                {{-- <select class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                                        style="width: 100%;"> --}}
                                <select class="select2bs4" data-placeholder="Select a Symptomps" style="width: 100%;" id="symptom-dropdown">
                                    <option value="" >Select An Symptomps</option>
                                    <option value="Fever" >Fever</option>
                                    <option value="Chest Pain">Chest Pain</option>
                                    <option value="Joint Pain">Joint Pain</option>
                                    <option value="Caugh">Caugh</option>
                                    <option value="Blury Vission">Blury Vission</option>
                                </select>
                            </div>
                            <ul id="symptomp-list">
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight:800;">Advices</h3>
                        </div>
                        <div class="card-body" style = "min-height:200px;">
                            <div class="form-group">
                                {{-- <select class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                                        style="width: 100%;"> --}}
                                <select class="select2bs4" data-placeholder="Select a Advice" style="width: 100%;" id="advice-dropdown">
                                    <option value="" >Select An Advice</option>
                                    <option value="Avoid Cold" >Avoid Cold</option>
                                    <option value="Bed Rest For 7 Days">Bed Rest For 7 Days</option>
                                    <option value="Bed Rest For 14 Days">Bed Rest For 14 Days</option>
                                    <option value="Bed Rest For 1 Month">Bed Rest For 1 Month</option>
                                    <option value="Visit After 7 Days">Visit After 7 Days</option>
                                    <option value="Visit After 14 Days">Visit After 14 Days</option>
                                    <option value="Visit After 1 Month">Visit After 1 Month</option>
                                </select>
                            </div>
                            <ul id="advice-list">
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
        $(function () {
            $('.select2bs4').select2({
            theme: 'bootstrap4',
            })
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
            let doctor_id = 1;
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
                            $("#patient-name").text(response.success.name);
                            $("#patient-gender").text(response.success.sex=='M'?'Male':(response.success.sex=='F'?'Female':'Other'));
                            $("#patient-age").text(response.success.age);
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
        $(".add-exam").on('click',function(){
            let test = $("#onexam-dropdown option:selected").val();
            let value = $("#onexam_value").val();
            $("#onexam-list").append(`
            <li style="list-style-type: none;">
                <div class="row">
                <div class="col-sm-8">${"-"+test}</div>
                <div class="col-sm-2">${value}</div>
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

    });

</script>

@endpush
