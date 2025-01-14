@extends('backend.layout.main')
@section('body-part')
<style>
.edit-delete-icon:hover{
        cursor: pointer;
        color: #e6e7ec;
        scale: 1.1;
        transition-duration: 0.1s ease;

    }
.search-list{
    height:550px;
    overflow-x: hidden;
    overflow-y: scroll;
}

#investigation-list{
    height:300px;
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
    <x-breadcumb title="Billing"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-sm btn-info" data-toggle="modal" id="allptnbtn" data-target="#allPatient">Registered Patient</button>
                    <div class="modal fade" id="allPatient" tabindex="-1" role="dialog" aria-labelledby="allPatientLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="allPatientModalLabel">Registered Patient List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-sm" id="patient" name="patient" placeholder="Patient ID">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 " style="height:300px;overflow-y:scroll;">
                                                <table class="table table-sm table-striped">
                                                    <thead style="position: sticky;top: 0;background:white;">
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Contact</th>
                                                        <th>Age</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="patient_search_list">
                                                    @foreach($patients as $patient)
                                                        <tr>
                                                            <td id="reg-patient-id{!! $patient->id !!}">{!! $patient->patient_id !!}</td>
                                                            <td id="reg-patient-name{!! $patient->id !!}">{!! $patient->name !!}</td>
                                                            <td id="reg-patient-gender{!! $patient->id !!}">{!! $patient->sex == 'M'?'Male':($patient->sex == 'F'?'Female':'Other') !!}</td>
                                                            <td id="reg-patient-contact_no{!! $patient->id !!}">{!! $patient->contact_no !!}</td>
                                                            <td id="reg-patient-age{!! $patient->id !!}">{!! $patient->age !!}</td>
                                                            <td>
                                                                <button class="btn btn-sm btn-info reg-select" data-id="{!! $patient->id !!}">
                                                                    <i class="fas fa-check p-1 edit-delete-icon" style="color:#004369;" data-id="{{$patient->id}}"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
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
                                                            <input type="hidden" name="save_type" value=3>
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
                            <b>Date :</b> <em id="bill-date"></em>
                            <br>
                            <b>Serial No :</b><span id="bill-no"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Investigation</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Services</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Equipments</a>
                        </li>

                      </ul>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                    <div>
                                        {{-- <h6>Investigation</h6> --}}

                                        <div class="form-group text-center">
                                            <input type="text" class="form-control form-control-sm" id="investigation" name="investigation" placeholder="Investigation Name">
                                        </div>
                                    </div>
                                    <div id="investigation-list" style="height:450px;font-size:14px;">
                                        <table class="table table-sm table-striped">
                                            <thead style="position: sticky;top: 0;background:white;">
                                                <th style="width:70%;">Name</th>
                                                <th style="width:10%;">Price</th>
                                                <th class="text-center" style="width:20%;">Action</th>
                                            </thead>
                                            <tbody id="investigation-table-list">
                                                @foreach($inv_mains as $inv_main)
                                                    <tr>
                                                        <td>{!! $inv_main->investigation_name !!}</td>
                                                        <td>{!! $inv_main->final_price !!}</td>
                                                        <td class="text-center">
                                                            {{-- <button class="btn btn-sm m-0 btn-info inv-select text-center" data-id="{!! $inv_main->id !!}"> --}}
                                                                <i class="fas fa-check-square inv-select edit-delete-icon" style="color:#175c81;font-size:16px;" data-id="{{$inv_main->id}}"></i>
                                                            {{-- </button> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                    <div>
                                        {{-- <h6>Service</h6> --}}

                                        <div class="form-group text-center">
                                            <input type="text" class="form-control form-control-sm" id="investigation" name="investigation" placeholder="Investigation Name">
                                        </div>
                                    </div>
                                    <div id="investigation-list" style="height:450px;font-size:14px;">
                                        <table class="table table-sm table-striped">
                                            <thead style="position: sticky;top: 0;background:white;">
                                                <th style="width:70%;">Name</th>
                                                <th style="width:10%;">Price</th>
                                                <th class="text-center" style="width:20%;">Action</th>
                                            </thead>
                                            <tbody id="investigation-table-list">
                                                @foreach($services as $service)
                                                    <tr>
                                                        <td>{!! $service->service_name !!}</td>
                                                        <td>{!! $inv_main->final_price !!}</td>
                                                        <td class="text-center">
                                                            {{-- <button class="btn btn-sm m-0 btn-info inv-select text-center" data-id="{!! $inv_main->id !!}"> --}}
                                                                <i class="fas fa-check-square inv-select edit-delete-icon" style="color:#175c81;font-size:16px;" data-id="{{$inv_main->id}}"></i>
                                                            {{-- </button> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                    <div>
                                        {{-- <h6>Equipment</h6> --}}

                                        <div class="form-group text-center">
                                            <input type="text" class="form-control form-control-sm" id="investigation" name="investigation" placeholder="Investigation Name">
                                        </div>
                                    </div>
                                    <div id="investigation-list" style="height:450px;font-size:14px;">
                                        <table class="table table-sm table-striped">
                                            <thead style="position: sticky;top: 0;background:white;">
                                                <th style="width:70%;">Name</th>
                                                <th style="width:10%;">Price</th>
                                                <th class="text-center" style="width:20%;">Action</th>
                                            </thead>
                                            <tbody id="investigation-table-list">
                                                @foreach($inv_equips as $inv_equip)
                                                    <tr>
                                                        <td>{!! $inv_equip->equipment_name !!}</td>
                                                        <td>{!! $inv_equip->final_price !!}</td>
                                                        <td class="text-center">
                                                            {{-- <button class="btn btn-sm m-0 btn-info inv-select text-center" data-id="{!! $inv_main->id !!}"> --}}
                                                                <i class="fas fa-check-square inv-select edit-delete-icon" style="color:#175c81;font-size:16px;" data-id="{{$inv_main->id}}"></i>
                                                            {{-- </button> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                              </div>
                        </div>
                        <div class="col-sm-8">

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
            $('#birth_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });

        $(".reg-select").on('click',function(e){
           let id = $(this).attr('data-id');
            patientSet(id);
            let patient_id = $("#patient-id").text();
            $.ajax({
                    type: "POST",
                    url: "{{url('billing')}}",
                    data: {
                            '_token':'{{ csrf_token() }}',
                            patient_id:patient_id,
                        },
                    success: function(response) {
                            $("#bill-date").text(response.bill_date);
                            $("#bill-no").text(response.bill_id);
                            toastr.success('New Bill Is Created');
                    },
                });

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
                            // element += `<li class="list-group-item">
                            //                                 <div class="row">
                            //                                     <div class="col-md-6">
                            //                                     <b>Patient ID :</b> <em id="reg-patient-id${x.id}">${x.patient_id}</em>
                            //                                     <br>
                            //                                     <b>Name :</b> <span id="reg-patient-name${x.id}">${x.name}</span>
                            //                                     <br>
                            //                                     <b>Gender :</b> <span id="reg-patient-gender${x.id}">${x.sex == 'M'?'Male':(x.sex == 'F'?'Female':'Other')}</span>
                            //                                     </div>
                            //                                     <div class="col-md-6">
                            //                                         <b>Contact No :</b> ${x.contact_no}
                            //                                         <br>
                            //                                         <b>Age :</b> <span id="reg-patient-age${x.id}">${x.age}</span>
                            //                                         <br>
                            //                                         <button class="btn btn-sm btn-info reg-prescribe" data-id=${x.id} style="float: right">
                            //                                             Prescribe
                            //                                         </button>
                            //                                     </div>
                            //                                 </div>

                            //                             </li>`
                                element+=`<tr>
                                        <td id="reg-patient-id${x.id}">${x.patient_id}</td>
                                        <td id="reg-patient-name${x.id}">${x.name}</td>
                                        <td id="reg-patient-gender${x.id}">${x.sex == 'M'?'Male':(x.sex == 'F'?'Female':'Other')}</td>
                                        <td id="reg-patient-contact${x.id}">${x.contact_no}</td>
                                        <td id="reg-patient-age${x.id}">${x.age}</td>
                                        <td ><button class="btn btn-sm btn-info reg-select" data-id="${x.id}">
                                            <i class="fas fa-check p-1 edit-delete-icon" style="color:#004369;" data-id="${x.id}"></i>
                                        </button></td>
                                    </tr>`
                        });
                        $("#patient_search_list").empty();
                        $("#patient_search_list").append(element);
                        $(".reg-select").on('click',function(e){
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
                            $("#patient-id").text(response.patient_id);
                            $("#patient-name").text(response.name);
                            $("#patient-gender").text(response.sex=='M'?'Male':(response.sex=='F'?'Female':'Other'));
                            $("#patient-age").text(response.age);
                            $('#new_patient_create').trigger("reset");
                            $('#newPatient').modal("hide");
                            toastr.success('New Patient Created');
                            $.ajax({
                                type: "POST",
                                url: "{{url('billing')}}",
                                data: {
                                        '_token':'{{ csrf_token() }}',
                                        patient_id:response.patient_id,
                                    },
                                success: function(response) {
                                        $("#bill-date").text(response.bill_date);
                                        $("#bill-no").text(response.bill_id);
                                        toastr.success('New Bill Is Created');
                                },
                            });

                    },
                    error:function(req,status,err){
                        console.log(err);
                    }
                });
                console.log('Worked');
        });

        $("#investigation").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#investigation-table-list tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
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
