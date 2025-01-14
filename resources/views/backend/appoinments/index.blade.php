@extends('backend.layout.main')
@section('body-part')
<style>
.search-list{
    height:480px;
    overflow-x: hidden;
    overflow-y: scroll;
}
/*
.patient-select:hover{
    cursor: pointer;
    background-color: beige;
}
*/
@media print
{
body * { visibility: hidden; }
#print-div * { visibility: visible; }
#print-button { visibility: hidden; }
#print-buttons { visibility: hidden; }

#print-div { position: absolute; top: 40px; left: 30px; }
}
</style>
<div class="content-wrapper">
    <x-breadcumb title="Appoinments"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Appoinments Entry</h3>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group text-center">
                                            <label><h4>Search Patient</h4></label>
                                            <input type="text" class="form-control form-control-sm" id="patient" name="patient" placeholder="Patient ID,Name,Contact No">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <ul class="list-group search-list" id="patient_s_list">
                                            @foreach($patients as $patient)
                                            <li class="list-group-item patient-select " data-id={!! $patient->id !!}>

                                                    <b>Patient ID :</b> <em>{!! $patient->patient_id !!}</em><br>
                                                    <b>Name :</b> {!! $patient->name !!}<br>
                                                    <b>Contact No :</b> {!! $patient->contact_no !!}<br>
                                                    <b>Age :</b> {!! $patient->age !!}<br>
                                                    <button class="btn btn-sm btn-info patient_search_btn" style="width:50%;float:right;" data-id={!! $patient->id !!} >Select</button>

                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group  text-center">
                                            <label><h4>Search Doctor</h4></label>
                                            <input type="text" class="form-control form-control-sm" id="doctor" name="doctor" placeholder="Doctor ID,Name,Contact No" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <ul class="list-group  search-list " id="doctor_s_list">
                                            @foreach($doctors as $doctor)
                                            <li class="list-group-item doctor-select ">
                                                <b>Doctor ID :</b><em>{!! $doctor->doctor_id !!}</em><br>
                                                <b>Name :</b> {!! $doctor->name !!}<br>
                                                <b>Department :</b> {!! $doctor->department->name_eng !!}<br>
                                                <b>Contact No :</b>{!! $doctor->contact_no !!} <br>
                                                <button class="btn btn-sm btn-info  doctor_select" data-id={!! $doctor->id !!} style="float: right;width:50%;">Select</button></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="form-group  col-lg-12 text-center">
                                        <label><h4>Date</h4></label>
                                        <div class="input-group date" id="appointment_date" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#appointment_date" name="appointment_date"  id="appointment"/>
                                            <div class="input-group-append" data-target="#appointment_date" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group text-center">
                                        <label><h4>Note</h4></label>
                                        <textarea class="form-control" rows="5" placeholder="Enter ..." id="note-field"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        @foreach($appointmenttypes as $apttype)
                                            <div class="form-check m-2">
                                                <input class="form-check-input" type="radio" name="appointment_type_id" value="{{$apttype->id}}" required {{$apttype->name_eng === "Consultation"?"checked":""}}>
                                                <label class="form-check-label">{{$apttype->name_eng}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button class="btn btn-md btn-success col-sm-12" id="save-appointment">Save</button>
                            </div>
                            <div class="col-sm-4" id="print-div">
                                <h4 class="text-center">Appointment Information</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">Patient Information</li>
                                    <li class="list-group-item">Appointment No:<span id="appoint-no"></span></li>
                                    <li class="list-group-item"><b>Patient ID :</b> <em id="patient-id"></em><br><b>Name :</b> <span id="patient-name"></span><br><b>Contact No :</b> <span id="patient-contact"></span><br><b>Age :</b> <span id="patient-age"></span></li>
                                    <li class="list-group-item">Doctor Information</li>
                                    <li class="list-group-item"><b>Doctor ID :</b> <em id="doctor-id"></em><br><b>Name :</b><span id="doctor-name"></span><br><b>Degree :</b><span id="doctor-department"></span> <br><b>Contact No :</b><span id="doctor-contact"></span></li>
                                    <li class="list-group-item">Appointment Details</li>
                                    <li class="list-group-item"><b>Date :</b> <em id="appon-date"></em><br><b>Serial No :</b><span id="serial-no"></span><br><b>Note :</b><em id="note"> </li>
                                    <li class="list-group-item" id="print-buttons"><button class="btn btn-md btn-danger col-sm-12" id="print-button">Print</button></li>
                                </ul>

                            </div>

                        </div>
                    </div>

            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Patient</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style = "min-height:500px;">
                    <table class="table table-sm table-striped projects">
                        <thead>
                            <tr>
                            <th style="width: 5%">
                                Patient ID
                            </th>
                            <th style="width: 30%" class="text-center">
                                Name
                            </th>
                            <th style="width: 15%" class="text-center">
                                Contact No
                            </th>
                            <th style="width: 15%" class="text-center">
                                Address
                            </th>
                            <th style="width: 15%" class="text-center">
                                Gender
                            </th>
                            <th style="width: 10%" class="text-center">
                                Age
                            </th>
                            <th class="text-center" style="width: 25%">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($doctors as $item)
                            <tr>
                                <td>
                                    {!! $item->patient_id !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                {!! $item->name !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->contact_no !!}
                                </td>
                                <td  class="text-Left">
                                    {!! $item->address !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->sex == 'M' ? '<span class="badge badge-success">Male</span>' :( $item->sex == 'F' ? '<span class="badge badge-info">Female</span>' : '<span class="badge badge-warning">Other</span>') !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->age !!}
                                </td>

                                <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm update" data-id="{{$item->id}}">
                                        <i style="font-size:10px;" class="fas fa-pencil-alt">
                                        </i>

                                    </a>
                                    {{-- <a class="btn btn-danger btn-sm" href="{{route('patients.delete',$item->id)}}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a> --}}
                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
                                        <i style="font-size:10px;" class="fas fa-trash">
                                        </i>

                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="m-3">
                    {{-- {{ $doctors->links('pagination::bootstrap-4')}} --}}
                </div>
            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Patient</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>One fine body&hellip;</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-default-update">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form action="" method="post" id="update-modal">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h4 class="modal-title">Update Patient Information</h4>
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
                                                <input type="text" class="form-control form-control-sm" id='u-name' name='name' placeholder="Patients Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Contact No.</label>
                                                <input type="text" class="form-control form-control-sm" id='u-contact_no' name='contact_no' placeholder="Contact Number" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Emergency Contact No.</label>
                                                <input type="text" class="form-control form-control-sm" id='u-emr_cont_no' name='emr_cont_no' placeholder="Emergency Contact Number">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control form-control-sm" id='u-address' name='address' placeholder="Address" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="text" class="form-control form-control-sm" name="age" id="u-age" placeholder="Age" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <div class="form-check m-2">
                                            <input class="form-check-input" type="radio" id="u-male" name="sex" value="M" required>
                                            <label class="form-check-label">Male</label>
                                            </div>
                                            <div class="form-check m-2">
                                            <input class="form-check-input" type="radio" name="sex" id="u-female" value="F">
                                            <label class="form-check-label">Female</label>
                                            </div>
                                            <div class="form-check m-2">
                                                <input class="form-check-input" type="radio" name="sex" id="u-other" value="O">
                                                <label class="form-check-label">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between" id="up-pl">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
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
        $("#print-button").on('click',function(e){
            window.print();
        });
        $(".patient_search_btn").on('click',function(e){
           let id = $(this).attr('data-id');
           $('.patient-select').each(function(){
            $(this).css("background-color", "white");
           });
           $(this).parents('.list-group-item').first().css("background-color", "beige");
            patientSet(id);

        });
        function patientSet(id){
            $.ajax({
                    url: "{{url('patients/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $("#patient-id").text(result.patient_id);
                        $("#patient-name").text(result.name);
                        $("#patient-contact").text(result.contact_no);
                        $("#patient-age").text(result.age);
                        checkSerial();
                    }
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
                            element += `<li class="list-group-item d-flex">
                                <span>
                                    <b>Patient ID :</b>
                                    <em>${x.patient_id}</em>
                                    <br>
                                    <b>Name :</b>
                                    ${x.name}
                                </span>
                                <span>
                                    <b>
                                    Contact No :
                                    </b>
                                    ${x.contact_no}
                                    <br>
                                    <b>Age :</b>
                                     ${x.age}
                                    <button class="btn btn-sm btn-warning patient_search_btn" data-id=${x.id} style="float: right">
                                            Select
                                    </button>
                                </span>
                            </li>`
                        });
                        $("#patient_s_list").empty();
                        $("#patient_s_list").append(element);
                        $(".patient_search_btn").on('click',function(e){
                            let id = $(this).attr('data-id');
                            patientSet(id);
                        });
                    }
                });
        });
        $(".doctor_select").on('click',function(e){
           let id = $(this).attr('data-id');
           $('.doctor-select').each(function(){
            $(this).css("background-color", "white");
           });
           $(this).parents('.doctor-select').first().css("background-color", "beige");
            doctorSet(id);
        });
        function doctorSet(id){
            $.ajax({
                    url: "{{url('doctors/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $("#doctor-id").text(result.doctor_id);
                        $("#doctor-name").text(result.name);
                        $("#doctor-department").text(result.department.name_eng);
                        $("#doctor-contact").text(result.contact_no);
                        checkSerial();
                    }
                });
        }
        $("#doctor").on('keyup',function(e){
            let ch_data = $("#doctor").val();
            console.log(ch_data);
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('doctor')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x=>{
                            element += `<li class="list-group-item">
                            <b>Doctor ID :</b>
                             <em>${x.doctor_id}</em>
                             <br>
                             <b>Name :</b>
                             ${x.name}
                             <br>
                             <b>Degree :</b>
                              ${x.degree}<br>
                              <b>Contact No :</b>
                              ${x.contact_no}
                              <button class="btn btn-sm btn-warning doctor_select" style="float: right" data-id=${x.id}>
                                Select</button>
                                </li>`
                        })

                        $("#doctor_s_list").empty();
                        $("#doctor_s_list").append(element);
                        $(".doctor_select").on('click',function(e){
                            let id = $(this).attr('data-id');
                            doctorSet(id);
                        });
                    }
                });
        });
        $(function () {
            var currentDate = new Date();
            console.log(currentDate);
            $('#appointment_date').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate:  currentDate
            });
        })
        $("#appointment_date").on("change.datetimepicker", ({date}) => {
             let  dateData = new Date(date);
             let Year = dateData.getFullYear();
             let Month = dateData.getMonth()+1 < 10 ? '0'+(dateData.getMonth()+1) :dateData.getMonth()+1;
             let Day = dateData.getDate() < 10 ? '0'+dateData.getDate() :dateData.getDate();

            $("#appon-date").text(Year+'-'+Month+'-'+Day);
            checkSerial();

        })
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
                            element += `<li class="list-group-item d-flex">
                                <span>
                                    <b>Patient ID :</b>
                                    <em>${x.patient_id}</em>
                                    <br>
                                    <b>Name :</b>
                                    ${x.name}
                                </span>
                                <span>
                                    <b>
                                    Contact No :
                                    </b>
                                    ${x.contact_no}
                                    <br>
                                    <b>Age :</b>
                                     ${x.age}
                                    <button class="btn btn-sm btn-warning patient_search_btn" data-id=${x.id} style="float: right">
                                            Select
                                    </button>
                                </span>
                            </li>`
                        });
                        $("#patient_s_list").empty();
                        $("#patient_s_list").append(element);
                        $(".patient_search_btn").on('click',function(e){
                            let id = $(this).attr('data-id');
                            patientSet(id);
                        });
                    }
            });
        });

        $("#note-field").on('keyup',function(e){
            let note_data = $("#note-field").val();
            $("#note").text(note_data);
        });
        $("#save-appointment").on('click',function(e){
            let note_data = $("#note-field").val();
            let date =  $("#appointment").val();
            let doctor_id =  $("#doctor-id").text();
            let patient_id =  $("#patient-id").text();
            if(doctor_id && patient_id && date){
                console.log({note_data,date,doctor_id,patient_id});
                $.ajax({
                    type: "POST",
                    url: "{{url('appoinments')}}",
                    data: {
                            '_token':'{{ csrf_token() }}',
                            patient_id:patient_id,
                            doctor_id:doctor_id,
                            appointed_date:date,
                            note:note_data,
                        },
                    success: function(response) {
                        if("success" in response){
                            toastr.success('New Appointment Created');
                            $("#appoint-no").text(response.success.appoint_id);
                        }
                    },
                });

            }
        });
        function checkSerial(){
            let date =  $("#appointment").val();
            let doctor_id =  $("#doctor-id").text();
            let patient_id =  $("#patient-id").text();
            console.log({date,doctor_id,patient_id});

            if(doctor_id && patient_id && date){
                console.log({date,doctor_id,patient_id});
                $.ajax({
                    type:"POST",
                    url: "{{url('appointment/checkserial')}}",
                    data:{
                        '_token':'{{ csrf_token() }}',
                            patient_id:patient_id,
                            doctor_id:doctor_id,
                            appointed_date:date,

                    },
                    success: function (result) {
                        if(result.message == "Already Appointed"){
                            toastr.warning('Already Appointed');
                            $("#serial-no").text(result.data.serial);
                            $("#appoint-no").text(result.data.appoint_id);
                            $("#note").text(result.data.note);
                        }else if(result.message == "New Serial No"){
                            $("#appoint-no").text("");
                            $("#serial-no").text(result.data);
                        }

                    }
                });

            }
        }


    });

</script>

@endpush
