@extends('backend.layout.main')
@section('body-part')
<style>
.edit-delete-icon:hover{
        cursor: pointer;
        color: #e6e7ec;
        scale: 1.1;
        transition-duration: 0.1s ease;

    }
.bill-item-list-cl tr:hover{

    background-color:rgb(241, 242, 248);
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
                <div class="card-header p-1">
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
                                                                    <i class="fas fa-check edit-delete-icon" style="color:#004369;" data-id="{{$patient->id}}"></i>
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
                                                            <input type="text" class="form-control form-control-sm" name='address' placeholder="Address" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-lg-4">
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
                    <button class="btn btn-sm btn-warning" data-toggle="modal" id="billListbtn" data-target="#billList">Bill List</button>
                    <div class="modal fade" id="billList" tabindex="-1" role="dialog" aria-labelledby="abillListLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="billListModalLabel">Registered Bill List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-sm" id="billlist" name="bill_list" placeholder="Bill ID">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 " style="height:300px;overflow-y:scroll;">
                                                <table class="table table-sm table-striped">
                                                    <thead style="position: sticky;top: 0;background:white;">
                                                        <th>Bill ID</th>
                                                        <th>Patient ID</th>
                                                        <th>Patient Name</th>
                                                        <th>Bill Date</th>
                                                        <th class="text-center">Action</th>
                                                    </thead>
                                                    <tbody id="bill_search_list">

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
                    <button class="btn btn-sm btn-secondary" data-toggle="modal" id="refereceListbtn" data-target="#refereceList">Reference List</button>
                    <div class="modal fade" id="refereceList" tabindex="-1" role="dialog" aria-labelledby="refereceListLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="refereceListModalLabel">Reference List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-sm" id="referencelist" name="reference_list" placeholder="Reference ID">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group text-center">
                                                    <input type="text" class="form-control form-control-sm" id="referencelistAdd" name="name_eng" placeholder="Reference Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-sm btn-success" id="referencelistAddBtn" data-target="#refereceList">ADD</button>
                                            </div>
                                            <div class="col-sm-12 " style="height:300px;overflow-y:scroll;">
                                                <table class="table table-sm table-striped">
                                                    <thead style="position: sticky;top: 0;background:white;">
                                                        <th style="width:20%;">Reference ID</th>
                                                        <th style="width:80%;">Reference Name</th>
                                                    </thead>
                                                    <tbody id="reference_search_list">

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
                    <button class="btn btn-sm btn-secondary float-right" id="print-bill-top">Print
                        <i class="fas fa-print" style="color:#fafcfd;" ></i>
                    </button>
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
                            <b>Date :</b> <em id="bill-date"></em>
                            <br>
                            <b>Bill No :</b><span id="bill-no"></span>
                        </div>
                        <div class="col-sm-3">
                            <b>Reference ID :</b> <em id="reference-id"></em>
                            <br>
                            <b>Reference Name :</b><span id="reference-name"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">
                            <h6>Select Item</h6>
                        </div>
                        <div class="card-body p-1">
                            <div class="row">
                                <div class="col-sm-4 form-group m-0">
                                    <select class="form-control form-control-sm"  name="investigation_type_id">
                                    <option value="0" selected >All</option>
                                    @foreach($service_category as $item)
                                    <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group text-center col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="bill-item-search" name="bill_item_search" placeholder="Item Name Search">
                                </div>
                                <div class="col-sm-12 search-list" style="font-size:14px;height:550px;">
                                    <table class="table table-sm">
                                        <thead>
                                            <th style="width:10%;">SL</th>
                                            <th style="width:60%;">Name</th>
                                            <th style="width:30%;">Price</th>
                                        </thead>
                                        <tbody class="bill-item-list-cl" id="bill-item-list">
                                        @foreach($bill_items as $item)
                                        <tr class="bill-item-add" data-id="{!! $item->id !!}">
                                            <td>{!! $item->id !!}</td>
                                            <td>{!! $item->item_name !!}</td>
                                            <td>{!! $item->price !!}</td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    <div class="col-sm-9">
                        <form action="{{route('billingdetails.save')}}" method="post" enctype="multipart/form-data" id="new_billing_details_create">
                            @csrf
                            <input type="hidden" name="bill_main_id" id="bill_main_id" />
                            <div class="card"  style="min-height:550px;">
                                <div class="card-header">
                                    <h6>Billing Section</h6>
                                </div>
                                <div class="card-body p-1">
                                    <div class="table-responsive" style="height:420px;font-size:14px;">
                                        <table class="table table-sm">
                                            <thead>
                                                <th style="width:22%">Name</th>
                                                <th style="width:10%">Price</th>
                                                <th class="bg-primary" style="width:8%;text-align:center;">Quantity</th>
                                                <th style="width:8%;text-align:center;">Amount</th>
                                                <th class="bg-secondary" style="width:8%;text-align:center;">Discount(%)</th>
                                                <th style="width:8%;text-align:center;">Discount(Tk)</th>
                                                <th class="bg-warning" style="width:10%;text-align:center;">Payable</th>
                                                <th style="width:10%;text-align:center;">Delivery Date</th>
                                                <th style="width:5%;text-align:center;">Action</th>
                                            </thead>
                                            <tbody id="bill-item-add-list">
                                            </tbody>
                                            <tbody id="bill-service-add-list">
                                            </tbody>
                                            <tbody id="bill-equip-add-list">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive mt-5" style="font-size:14px;">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <th style="text-align: right;">Discount in Amount :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_dis_amt" id="bill-dis-amt" /></td>
                                                    <th style="text-align: right;">Total Amount :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_amount" id="bill-amount" /></td>
                                                    <th style="text-align: right;">Total Paid :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_paid_amount" id="bill-paid-amount"/></td>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: right;">Discount in Percentage :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_in_per" id="bill-in-per"/></td>
                                                    <th style="text-align: right;">Net Payable Amount :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_total_amount" id="bill-total-amount"/></td>
                                                    <th style="text-align: right;">Total Due :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_due_amount" id="bill-due-amount"/></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-right m-0 p-1">
                                    <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                    <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
                                </div>
                            </div>
                        </form>
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

        function patientSet(id){
                let patient_id = $("#reg-patient-id"+id).text();
                let patient_name = $("#reg-patient-name"+id).text();
                let patient_gender = $("#reg-patient-gender"+id).text();
                let patient_age = $("#reg-patient-age"+id).text();
                let appon_date = $("#reg-appon-date"+id).text();

                $("#patient-id").text(patient_id);
                $("#patient-name").text(patient_name);
                $("#patient-gender").text(patient_gender);
                $("#patient-age").text(patient_age);
                $("#appon-date").text(appon_date);
                console.log([id,patient_id]);
                $('#allPatient').modal('hide')
                }
        function regPatientBill(id){
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
                                    $("#bill_main_id").val(response.bill_id);
                                    $("#bill-item-add-list").empty();
                                    $("#bill-service-add-list").empty();
                                    $("#bill-equip-add-list").empty();
                                    $("#bill-amount").val(0);
                                    $("#bill-dis-amt").val(0);
                                    $("#bill-in-per").val(0);
                                    $("#bill-total-amount").val(0);
                                    $("#bill-paid-amount").val(0);
                                    $("#bill-due-amount").val(0);
                                    toastr.success('New Bill Is Created');
                            },
                        });
        }
        $("#allptnbtn").on('click',function(e){
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('patient')}}/",
                    data:{
                        'search':"",
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                            element +=`<tr>
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
                            regPatientBill(id);
                        });
                    }
                });
        });

        $(".reg-select").on('click',function(e){
            let id = $(this).attr('data-id');
            regPatientBill(id);

        });

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
                            element +=`<tr>
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
                            regPatientBill(id);
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
                            if('error' in response){
                                if('message' in response) {toastr.warning(response.message);}
                                toastr.error(response.error);

                            }else{
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
                                            $("#bill_main_id").val(response.bill_id);
                                            $("#bill-item-add-list").empty();
                                            $("#bill-service-add-list").empty();
                                            $("#bill-equip-add-list").empty();
                                            $("#bill-amount").val(0);
                                            $("#bill-dis-amt").val(0);
                                            $("#bill-in-per").val(0);
                                            $("#bill-total-amount").val(0);
                                            $("#bill-paid-amount").val(0);
                                            $("#bill-due-amount").val(0);
                                            toastr.success('New Bill Is Created');
                                    },
                                });
                            }

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
        function finalBillCalculation(){
          let billAmount =  $("#bill-amount").val();
          let discountAmount =  $("#bill-dis-amt").val();
          let discountPer =  $("#bill-in-per").val();
          let finalAmount =  $("#bill-total-amount").val();
          let paidAmount =  $("#bill-paid-amount").val();
          let dueAmount =  $("#bill-due-amount").val();
          let newFinalAmount = billAmount;
          if((!isNaN(discountAmount)) && discountAmount != 0){
            newFinalAmount = (Number(billAmount)-Number(discountAmount)).toFixed(2);
          }
          if(!isNaN(paidAmount)){
            let newDueAmount = (Number(newFinalAmount)-Number(paidAmount)).toFixed(2);
            $("#bill-due-amount").val(newDueAmount);
          }
          $("#bill-total-amount").val(newFinalAmount);


        }
        function calculateBill(){
            let amtResult = 0;
            let discResult = 0;
                $(".billing-item-amount").each(function(){
                    amtResult += Number($(this).val());
                });
                console.log(amtResult);
                $(".billing-item-dis-amt").each(function(){

                    discResult += Number($(this).val());
                });
                $("#bill-amount").val(amtResult);
                $("#bill-dis-amt").val(discResult);
                finalBillCalculation();
        }
        function billItemotalCal(id){
            let quantity = $("#qty"+id).val();
            let discount_per = $("#dis-per"+id).val();
            let isDiscountable = $("#dis-per"+id).attr('data-discountable');
            if(!isNaN(quantity)&&quantity!=""){
                let price = $("#price"+id).text();
                let total_price = (Number(price)*Number(quantity)).toFixed(2);
                let discount_amount = ((Number(discount_per)/100)*Number(price)).toFixed(2);
                let total_discount_amount = (discount_amount*Number(quantity)).toFixed(2);
                let total_payable = (total_price-total_discount_amount).toFixed(2);
                if(isDiscountable == 1){
                    $("#amt"+id).val(total_price);
                    $("#dis-amt"+id).val(total_discount_amount);
                    $("#total-payable"+id).val(total_payable);
                }else{
                    $("#amt"+id).val(Number(total_price).toFixed(2));
                    $("#dis-amt"+id).val(0);
                    $("#total-payable"+id).val(Number(total_price).toFixed(2));
                    $("#dis-per"+id).val(0);
                }
            }else{
                $("#amt"+id).val(0);
                $("#dis-amt"+id).val(0);
                $("#total-payable"+id).val(0);
            }
            calculateBill();
        }
        $(".final-bill-field").on('keyup',function(e){
            if(e.target.name == "bill_dis_amt"){
                $("#bill-in-per").val(0);
                finalBillCalculation();
            }else if(e.target.name == "bill_in_per"){
                let discount_per =  $(this).val();
                $(".billing-item-amount").each(function(){
                    let id = $(this).attr('data-id');
                    let quantity = $("#qty"+id).val();
                    let isDiscountable = $("#dis-per"+id).attr('data-discountable');
                    console.log(isDiscountable);
                     if(isDiscountable == 1 ){
                        $("#dis-per"+id).val(discount_per);
                        if(!isNaN(quantity)&&quantity!=""){
                            let price = $("#price"+id).text();
                            let total_price = (Number(price)*Number(quantity)).toFixed(2);
                            let discount_amount = ((Number(discount_per)/100)*Number(price)).toFixed(2);
                            let total_discount_amount = (discount_amount*Number(quantity)).toFixed(2);
                            let total_payable = (total_price-total_discount_amount).toFixed(2);
                            $("#amt"+id).val(total_price);
                            $("#dis-amt"+id).val(total_discount_amount);
                            $("#total-payable"+id).val(total_payable);
                        }else{
                            $("#amt"+id).val(0);
                            $("#dis-amt"+id).val(0);
                            $("#total-payable"+id).val(0);
                        }
                    }

                });
                // $("#bill-dis-amt").val(amtValue);
                calculateBill();
            }else{
                finalBillCalculation();
            }

        });
        $("#bill-item-search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#bill-item-list tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
        $(".bill-item-add").on('click',function(){
            let id = $(this).attr('data-id');
            let check = $("#bill_main_id").val();
            if(check){
                myElement2='';
                $.ajax({
                        url: "{{url('billingitems/')}}/"+id,
                        success: function (result) {
                            console.log(result);
                            if($("#qty"+result.item.id).val()){
                                        console.log($("#qty"+result.item.id).val())
                                        let qty = $("#qty"+result.item.id).val();
                                        let amt = $("#amt"+result.item.id).val();
                                        let disc_per = $("#dis-per"+result.item.id).val();
                                        let total_qty = Number(qty)+1;
                                        let total_amt = (Number(result.item.price)*total_qty).toFixed(2);
                                        let discount_amount = ((Number(disc_per)/100)*Number(result.item.price)).toFixed(2);
                                        let total_dis_amt = discount_amount*total_qty;
                                        let total_payable_amt = (total_amt- total_dis_amt).toFixed(2);

                                        $("#qty"+result.item.id).val(total_qty);
                                        $("#amt"+result.item.id).val(total_amt);
                                        $("#dis-amt"+result.item.id).val(total_dis_amt);
                                        $("#total-payable"+result.item.id).val(total_payable_amt);

                                        calculateBill();
                            }else{
                                let discount_per_final =  $("#bill-in-per").val();
                                let disc_amount = 0;
                                if(Boolean(result.item.discountable)&&(!isNaN(discount_per_final) && discount_per_final!="" && discount_per_final > 0)){
                                    discount_per_cal = Number(discount_per_final);
                                }else if(Boolean(result.item.discountable)){
                                    discount_per_cal = Number(result.item.discount_per);
                                }else{
                                    discount_per_cal = 0;
                                }
                                disc_amount = ((discount_per_cal/100)*Number(result.item.price)).toFixed(2);

                                let  myElement =`<tr>
                                        <td>
                                            <input type="hidden" name="bill_item[]" value="${result.item.id}" />
                                            <input type="hidden" name="discountable[${result.item.id}]" value="${result.item.discountable}" />
                                            <input type="hidden" name="service_category_id[${result.item.id}]" value="${result.item.service_category_id}" />
                                            ${result.item.item_name}
                                        </td>
                                        <td id="price${result.item.id}">${result.item.price}</td>
                                        <td><input class="form-control form-control-sm billing-item-qty w-100 text-center" data-id="${result.item.id}" type="text" id="qty${result.item.id}" name="quantity[${result.item.id}]" value="1"></td>
                                        <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" type="text" id="amt${result.item.id}" data-id="${result.item.id}" name="amount[${result.item.id}]" value="${Number(result.item.price)}" readonly></td>
                                        <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${result.item.id}" data-discountable="${result.item.discountable}" type="text" id="dis-per${result.item.id}" name="discount_per[${result.item.id}]" value="${discount_per_cal}" ${Boolean(result.item.discountable)?"":"readonly"}></td>
                                        <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${result.item.id}" type="text" id="dis-amt${result.item.id}" name="discount_amt[${result.item.id}]" value="${disc_amount}" ${Boolean(result.item.discountable)?"":"readonly"}></td>
                                        <td><input class="form-control form-control-sm billing-item-total-payable w-100 text-center" data-id="${result.item.id}" type="text" id="total-payable${result.item.id}" name="total_payable[${result.item.id}]" value="${(Number(result.item.price)-disc_amount).toFixed(2)}"></td>
                                        <td>
                                            <div class="input-group date  w-100" id="delivery_date${result.item.id}" data-target-input="nearest">
                                                <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#delivery_date${result.item.id}" name="delivery_date[${result.item.id}]"  readonly}/>
                                                <div class="input-group-append" data-target="#delivery_date${result.item.id}" data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-xs remove-btn" title="Remove">
                                                <i class="fas fa-times p-1"></i>
                                            </button>
                                        </td>

                                        </tr>
                                    `;
                                    if(result.item.service_category_id == 2){
                                        $("#bill-item-add-list").append(myElement);
                                    }else if(result.item.service_category_id == 3){
                                        $("#bill-equip-add-list").append(myElement);
                                    }else if(result.item.service_category_id == 4){
                                        $("#bill-service-add-list").append(myElement);
                                    }
                                    calculateBill();
                                    $(function () {
                                        let todaydate = new Date();
                                        $("#delivery_date"+result.item.id).datetimepicker({
                                            format: 'YYYY-MM-DD',
                                            defaultDate: todaydate.setDate(todaydate.getDate() + result.item.duration),
                                        });

                                    });

                            }
                                if(result.equipments){
                                    result.equipments.map(x=>{
                                        if($("#qty"+x.equip.id).val()){
                                            console.log($("#qty"+x.equip.id).val())
                                            let qty = $("#qty"+x.equip.id).val();
                                            let amt = $("#amt"+x.equip.id).val();
                                            let disc_per = $("#dis-per"+x.equip.id).val();
                                            let total_qty = Number(qty)+Number(x.quantity);
                                            let total_amt = (Number(x.equip.price)*total_qty).toFixed(2);
                                            let discount_amount = ((Number(disc_per)/100)*Number(x.equip.price)).toFixed(2);
                                            let total_dis_amt = discount_amount*total_qty;
                                            let total_payable_amt = (total_amt- total_dis_amt).toFixed(2);

                                            $("#qty"+x.equip.id).val(total_qty);
                                            $("#amt"+x.equip.id).val(total_amt);
                                            $("#dis-amt"+x.equip.id).val(total_dis_amt);
                                            $("#total-payable"+x.equip.id).val(total_payable_amt);

                                            calculateBill();
                                        }else{

                                            let discount_per_final =  $("#bill-in-per").val();
                                            let disc_amount = 0;
                                            if(Boolean(x.equip.discountable)&&(!isNaN(discount_per_final)&&discount_per_final!=""  && discount_per_final > 0)){

                                                discount_per_cal = Number(discount_per_final);
                                            }else{
                                                discount_per_cal = Number(x.equip.discount_per);
                                            }
                                            disc_amount = ((Number(discount_per_cal)/100)*Number(x.equip.price)).toFixed(2);

                                            myElement2 +=`<tr>
                                        <td>
                                            <input type="hidden" name="bill_item[]" value="${x.equip.id}" />
                                            <input type="hidden" name="discountable[${x.equip.id}]" value="${x.equip.discountable}" />
                                            <input type="hidden" name="service_category_id[${x.equip.id}]" value="${x.equip.service_category_id}" />
                                            ${x.equip.item_name}
                                        </td>
                                        <td id="price${x.equip.id}">${x.equip.price}</td>
                                        <td><input class="form-control form-control-sm billing-item-qty w-100 text-center" data-id="${x.equip.id}" type="text" id="qty${x.equip.id}" name="quantity[${x.equip.id}]" value="${x.quantity}"></td>
                                        <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" type="text" id="amt${x.equip.id}" data-id="${result.item.id}" name="amount[${x.equip.id}]" value="${Number(x.equip.price)}" readonly></td>
                                        <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${x.equip.id}" data-discountable="${x.equip.discountable}" type="text" id="dis-per${x.equip.id}" name="discount_per[${x.equip.id}]" value="${discount_per_cal}" ${Boolean(x.equip.discountable)?"":"readonly"}></td>
                                        <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${x.equip.id}" type="text" id="dis-amt${x.equip.id}" name="discount_amt[${x.equip.id}]" value="${disc_amount}" ${Boolean(x.equip.discountable)?"":"readonly"}></td>
                                        <td><input class="form-control form-control-sm billing-item-total-payable w-100 text-center" data-id="${x.equip.id}" type="text" id="total-payable${x.equip.id}" name="total_payable[${x.equip.id}]" value="${(Number(x.equip.price)-disc_amount).toFixed(2)}"></td>
                                        <td>
                                            <div class="input-group date  w-100" id="delivery_date${x.equip.id}" data-target-input="nearest">
                                                <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#delivery_date${x.equip.id}" name="delivery_date[${x.equip.id}]" readonly/>
                                                <div class="input-group-append" data-target="#delivery_date${x.equip.id}" data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-xs remove-btn" title="Remove">
                                                <i class="fas fa-times p-1"></i>
                                            </button>
                                        </td>

                                        </tr>
                                    `;
                                            $("#bill-equip-add-list").append(myElement2);
                                            calculateBill();
                                            $(function () {
                                                let todaydate = new Date();
                                            $("#delivery_date"+x.equip.id).datetimepicker({
                                                format: 'YYYY-MM-DD',
                                                defaultDate: todaydate,
                                            });

                                    });
                                        }
                                    });
                                }
                                $(".billing-item-qty").on('keyup',function(e){
                                    let id = $(this).data('id');
                                    billItemotalCal(id);
                                })
                                $(".billing-item-dis-per").on('keyup',function(e){
                                    let id = $(this).data('id');
                                    billItemotalCal(id);
                                })
                                $(".billing-item-dis-amt").on('keyup',function(e){
                                    let id = $(this).data('id');
                                    billItemotalCal(id);
                                })
                                $(".billing-item-total-payable").on('keyup',function(e){
                                    let id = $(this).data('id');
                                    billItemotalCal(id);
                                })
                                $('.billing-item-amount').on('keyup',function(e){
                                    calculateBill();
                                });
                                $('.remove-btn').on('click',function(e){
                                    console.log("Prottoy");
                                    $(this).closest("tr").remove();
                                    calculateBill();
                                });
                        },
                        error: function (req, status, error) {
                        var err = req.responseText;
                        console.log(err);
                        }

                    });
            }else{
                    toastr.error('Please Select Bill');
            }
        });
        $("#new_billing_details_create").submit(function(e){
            e.preventDefault();
            let formdata = $('#new_billing_details_create').serialize();
            let check = $("#bill_main_id").val();
                if(check){
                    $.ajax({
                    type: "POST",
                    url: "{{url('billingdetails')}}",
                    data: formdata,
                    success: function(response) {
                        if('message' in response){
                            toastr.error(response.message);
                        }else if('error' in response){
                            toastr.error(response.error);
                        }else{
                            console.log(response);
                            toastr.success('Bill Details Saved');

                            }
                    },
                    error:function(req,status,err){
                        console.log(err);
                    }
                });
                }else{
                    toastr.error('Please Select Bill');
                }


        });
        function editBill(id){
                $("#bill-item-add-list").empty();
                $("#bill-equip-add-list").empty();
                $("#bill-service-add-list").empty();

            console.log(id);
            $.ajax({
                    url: "{{url('billing/')}}/"+id,
                    success: function (response) {
                        console.log(response);
                        $("#patient-id").text(response.main.patient_id);
                        $("#patient-name").text(response.main.patient_name);
                        $("#patient-gender").text(response.main.patient.sex=='M'?'Male':(response.main.patient.sex=='F'?'Female':'Other'));
                        $("#patient-age").text(response.main.patient.age);
                        $("#bill-date").text(response.main.bill_date);
                        $("#bill-no").text(response.main.bill_id);
                        $("#reference-id").text(response.main.referrence_id);
                        $("#reference-name").text(response.main.reference.name_eng);
                        $("#bill_main_id").val(response.main.bill_id);
                        $("#bill-amount").val(Number(response.main.total_amount).toFixed(2));
                        $("#bill-dis-amt").val(Number(response.main.discount_amount).toFixed(2));
                        $("#bill-in-per").val(Number(response.main.discount_percent).toFixed(2));
                        $("#bill-total-amount").val(Number(response.main.payable_amount).toFixed(2));
                        $("#bill-paid-amount").val(Number(response.main.paid_amount).toFixed(2));
                        $("#bill-due-amount").val(Number(response.main.due_amount).toFixed(2));
                        response.details.map(x=>{
                          let  myElement =`<tr>
                                    <td>
                                        <input type="hidden" name="bill_item[]" value="${x.item_id}" />
                                        <input type="hidden" name="discountable[${x.item_id}]" value="${x.discountable}" />
                                        <input type="hidden" name="service_category_id[${x.item_id}]" value="${x.service_category_id}" />
                                        ${x.item_name}
                                    </td>
                                    <td id="price${x.item_id}">${x.item_rate}</td>
                                    <td><input class="form-control form-control-sm billing-item-qty w-100 text-center" data-id="${x.item_id}" type="text" id="qty${x.item_id}" name="quantity[${x.item_id}]" value="${x.quantity}"></td>
                                    <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" data-id="${x.item_id}" type="text" id="amt${x.item_id}" name="amount[${x.item_id}]" value="${Number(x.price)}" readonly></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${x.item_id}" data-discountable="${x.discountable}" type="text" id="dis-per${x.item_id}" name="discount_per[${x.item_id}]" value="${x.discount_percent}" ${Boolean(x.discountable)?"":"readonly"}></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${x.item_id}" type="text" id="dis-amt${x.item_id}" name="discount_amt[${x.item_id}]" value="${x.discount_amount}" ${Boolean(x.discountable)?"":"readonly"}></td>
                                    <td><input class="form-control form-control-sm billing-item-total-payable w-100 text-center" data-id="${x.item_id}" type="text" id="total-payable${x.item_id}" name="total_payable[${x.item_id}]" value="${Number(x.final_price).toFixed(2)}"></td>
                                    <td>
                                        <div class="input-group date  w-100" id="delivery_date${x.item_id}" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#delivery_date${x.item_id}" name="delivery_date[${x.item_id}]"  readonly}/>
                                            <div class="input-group-append" data-target="#delivery_date${x.item_id}" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-xs remove-btn" title="Remove">
                                            <i class="fas fa-times p-1"></i>
                                        </button>
                                    </td>
                                    </tr>
                                `;
                                if(x.service_category_id == 2){
                                    $("#bill-item-add-list").append(myElement);
                                }else if(x.service_category_id == 3){
                                    $("#bill-equip-add-list").append(myElement);
                                }else if(x.service_category_id == 4){
                                    $("#bill-service-add-list").append(myElement);
                                }

                                $(function () {
                                    let todaydate = new Date(x.delivery_date);
                                    $("#delivery_date"+x.item_id).datetimepicker({
                                        format: 'YYYY-MM-DD',
                                        defaultDate: todaydate,
                                    });

                                });
                        });
                        $(".billing-item-qty").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-dis-per").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-dis-amt").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-total-payable").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $('.billing-item-amount').on('keyup',function(e){
                                calculateBill();
                            });


                            $('.remove-btn').on('click',function(e){
                                console.log("Prottoy");
                                $(this).closest("tr").remove();
                                calculateBill();
                            });
                    }
                });

        }
        $(".bill-edit").on('click',function(e){
            let id = $(this).attr('data-bill-id');
                editBill(id);

        });

        $("#billListbtn").on('click',function(e){
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('billing')}}/",
                    data:{
                        'search':"",
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element+= `<tr>
                                <td id="main-bill-id${x.id}">${x.bill_id}</td>
                                <td id="main-patient-id${x.id}">${x.patient_id}</td>
                                <td id="main-patient-name${x.id}">${x.patient_name}</td>
                                <td id="main-bill-date${x.id}">${x.bill_date}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary bill-edit" data-id="${x.id}" data-bill-id="${x.bill_id}" >Edit
                                        <i class="fas fa-edit edit-delete-icon" style="color:#eef4f7;" data-id="${x.id}"></i>
                                    </a>
                                    <a class="btn btn-sm btn-secondary" href="{{url('billing-pdf')}}/${x.bill_id}" target="_blank" data-id="${x.id}">Print
                                        <i class="fas fa-print edit-delete-icon" style="color:#ecf3f7;" data-id="${x.id}"></i>
                                    </a>
                                </td>
                            </tr>`
                        });
                        $("#bill_search_list").empty();
                        $("#bill_search_list").append(element);

                        $(".bill-edit").on('click',function(e){
                            let id = $(this).attr('data-bill-id');
                            editBill(id);
                        });
                    }
                });
        })


        $("#billlist").on('keyup',function(e){
            let ch_data = $("#billlist").val();
            console.log(ch_data);
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('billing')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<tr>
                                <td id="main-bill-id${x.id}">${x.bill_id}</td>
                                <td id="main-patient-id${x.id}">${x.patient_id}</td>
                                <td id="main-patient-name${x.id}">${x.patient_name}</td>
                                <td id="main-bill-date${x.id}">${x.bill_date}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary bill-edit" data-id="${x.id}" data-bill-id="${x.bill_id}" >Edit
                                        <i class="fas fa-edit edit-delete-icon" style="color:#eef4f7;" data-id="${x.id}"></i>
                                    </a>
                                    <a class="btn btn-sm btn-secondary" href="{{url('billing-pdf')}}/${x.bill_id}" target="_blank" data-id="${x.id}">Print
                                        <i class="fas fa-print edit-delete-icon" style="color:#ecf3f7;" data-id="${x.id}"></i>
                                    </a>
                                </td>
                            </tr>`
                        });
                        $("#bill_search_list").empty();
                        $("#bill_search_list").append(element);

                        $(".bill-edit").on('click',function(e){
                            let id = $(this).attr('data-bill-id');
                            editBill(id);
                        });
                    }
                });
        });

        $("#print-bill-top").on('click',function(e){
            let billID = $("#bill-no").text();
            if(billID){
                window.open("{{url('billing-pdf')}}/"+Number(billID), '_blank');

            }else{
                toastr.error('Please Select Bill');
            }

        })
        function referenceSelect(id){
            let check = $("#bill_main_id").val();
            if(check){
                let reference_id = $("#bill-reference-id"+id).text();
                let reference_name = $("#bill-referenc-name"+id).text();
                $("#reference-id").text(reference_id);
                $("#reference-name").text(reference_name);
                console.log({"id":id,"reference_id":reference_id,"reference_name":reference_name});
                $.ajax({
                        url: "{{url('add/billreference')}}",
                        type: "POST",
                        data:{
                        '_token': '{{ csrf_token() }}',
                        'reference_id':reference_id,
                        'bill_main_id':check,
                        'reference_name':reference_name,
                        'add_type':1
                    },
                        success: function (response) {
                            if('success' in response)
                            toastr.success(response.success);
                            console.log(response);
                        }
                    });
                }else{
                    toastr.error('Please Select Bill');
                }

        }
        $("#refereceListbtn").on('click',function(e){
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('billreference')}}/",
                    data:{
                        'search':"",
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element+= `<tr class="reference-select" data-reference-id="${x.id}">
                                <td style="width:20%;" id="bill-reference-id${x.id}">${x.reference_id}</td>
                                <td style="width:80%;" id="bill-referenc-name${x.id}">${x.name_eng}</td>
                            </tr>`
                        });
                        $("#reference_search_list").empty();
                        $("#reference_search_list").append(element);
                        $(".reference-select").on('click',function(e){
                            let id = $(this).attr('data-reference-id');
                            referenceSelect(id);
                        });
                    }
                });
        })
        $("#referencelistAddBtn").on('click',function(e){

            let check = $("#bill_main_id").val();
            if(check){
                let reference_name = $("#referencelistAdd").val();
                if(reference_name !=""){
                    $.ajax({
                            url: "{{url('add/billreference')}}",
                            type: "POST",
                            data:{
                            '_token': '{{ csrf_token() }}',
                            'bill_main_id':check,
                            'name_eng':reference_name,
                            'add_type':2
                        },
                            success: function (response) {
                                if('success' in response)
                                toastr.success(response.success);
                                console.log(response);
                                $("#reference-id").text(response.data.reference_id);
                                $("#reference-name").text(response.data.name_eng);
                            }
                        });
                    }else{
                        toastr.error('Reference Name Can Not Be Empty');
                    }
                }else{
                    toastr.error('Please Select Bill');
                }
        });
        $("#referencelist").on('keyup',function(e){
            let ch_data = $("#referencelist").val();
            console.log(ch_data);
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('billreference')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element+= `<tr class="reference-select" data-reference-id="${x.id}">
                                <td style="width:20%;" id="bill-reference-id${x.id}">${x.reference_id}</td>
                                <td style="width:80%;" id="bill-referenc-name${x.id}">${x.name_eng}</td>
                            </tr>`
                        });
                        $("#reference_search_list").empty();
                        $("#reference_search_list").append(element);
                        $(".reference-select").on('click',function(e){
                            let id = $(this).attr('data-reference-id');
                            referenceSelect(id);
                        });
                    }
                });
        });

    });

</script>

@endpush
