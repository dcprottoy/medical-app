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
                            <b>Bill No :</b><span id="bill-no"></span>
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
                        <div class="card-body pt-1">
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
                                <div class="col-sm-12 search-list" style="font-size:14px;height:430px;">
                                    <table class="table table-sm">
                                        <thead>
                                            <th style="width:10%;">SL</th>
                                            <th style="width:50%;">Name</th>
                                            <th style="width:30%;">Price</th>
                                            <th style="width:10%;">Action</th>
                                        </thead>
                                        <tbody class="bill-item-list-cl" id="bill-item-list">
                                        @foreach($bill_items as $item)
                                        <tr>
                                            <td>{!! $item->id !!}</td>
                                            <td>{!! $item->item_name !!}</td>
                                            <td>{!! $item->final_price !!}</td>
                                            <td>
                                                <button class="btn btn-sm  p-0 bill-item-add" data-id="{!! $item->id !!}">
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
                </div>
                    <div class="col-sm-6">
                        <form action="{{route('billingdetails.save')}}" method="post" enctype="multipart/form-data" id="new_billing_details_create">
                            @csrf
                        <div class="card"  style="min-height:550px;">
                            <div class="card-header">
                                <h6>Billing Section</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:450px;">
                                    <table class="table table-sm">
                                        <thead>
                                            <th style="width:30%">Name</th>
                                            <th style="width:10%">Price</th>
                                            <th style="width:25%">Quantity</th>
                                            <th style="width:25%">Amount</th>
                                            <th style="width:10%">Action</th>
                                        </thead>
                                        <tbody id="bill-item-add-list">
                                        </tbody>
                                        <tbody id="bill-equip-add-list">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card"  style="min-height:500px;">
                            <div class="card-header">
                                <h6>Billing Section</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:400px;">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: right;">Total Amount :</td>
                                                <td><input class="form-control form-control-sm" type="number" step="any" value="0" name="bill_amount" id="bill-amount" /></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Discount in Amount :</td>
                                                <td><input class="form-control form-control-sm" type="number" step="any" value="0" name="bill_dis_amt" id="bill-dis-amt" /></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Discount in Percentage :</td>
                                                <td><input class="form-control form-control-sm" type="number" step="any" value="0" name="bill_in_per" id="bill-in-per"/></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Net Payable Amount :</td>
                                                <td><input class="form-control form-control-sm" type="number" step="any" value="0" name="bill_total_amount" id="bill-total-amount"/></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Total Paid :</td>
                                                <td><input class="form-control form-control-sm" type="number" step="any" value="0" name="bill_paid_amount" id="bill-paid-amount"/></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Total Due :</td>
                                                <td><input class="form-control form-control-sm" type="number" step=".1" value="0" name="bill_due_amount" id="bill-due-amount"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
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
        function calculateBill(){
            let amtResult = 0;
                $(".billing-item-amount").each(function(){

                    amtResult += Number($(this).val());
                });
                $("#bill-amount").val(amtResult);
        }
        function billItemotalCal(id){
            let quantity = $("#qty"+id).val();
            if(!isNaN(quantity)&&quantity!=""){
                let price = $("#price"+id).text();
                let total = (Number(price)*Number(quantity)).toFixed(2);
                $("#amt"+id).val(total);
            }else{
                $("#amt"+id).val(0);

            }
            calculateBill();
        }

        $("#bill-item-search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#bill-item-list tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
        $(".bill-item-add").on('click',function(){
            let id = $(this).attr('data-id');
            myElement='';
            myElement2='';
            $.ajax({
                    url: "{{url('billingitems/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        if($("#qty"+result.item.id).val()){
                                    console.log($("#qty"+result.item.id).val())
                                    let qty = $("#qty"+result.item.id).val();
                                    let amt = $("#amt"+result.item.id).val();
                                    $("#qty"+result.item.id).val(Number(qty)+1);
                                    $("#amt"+result.item.id).val(Number(amt)+Number(result.item.final_price));
                                    calculateBill();
                        }else{
                            myElement +=`<tr>
                                <td><input type="hidden" name="bill_item[]" value="${result.item.id}" />${result.item.item_name}</td>
                                <td id="price${result.item.id}">${result.item.final_price}</td>
                                <td><input class="form-control form-control-sm billing-item-qty" data-id="${result.item.id}" type="number" id="qty${result.item.id}" name="quantity[${result.item.id}]" value="1"></td>
                                <td><input class="form-control form-control-sm billing-item-amount" type="number" id="amt${result.item.id}" name="amount[${result.item.id}]" value="${Number(result.item.final_price)}"></td>
                                <td>
                                    <button type="button" class="btn btn-xs remove-btn" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>

                                </tr>
                            `;
                            $("#bill-item-add-list").append(myElement);
                            calculateBill();
                        }
                        if(result.equipments){
                            result.equipments.map(x=>{
                                if($("#qty"+x.equip.id).val()){
                                    console.log($("#qty"+x.equip.id).val())
                                    let qty = $("#qty"+x.equip.id).val();
                                    let amt = $("#amt"+x.equip.id).val();
                                    $("#qty"+x.equip.id).val(Number(qty)+1);
                                    $("#amt"+x.equip.id).val(Number(amt)+Number(x.equip.final_price));
                                    calculateBill();
                                }else{
                                    myElement2 +=`<tr>
                                        <td><input type="hidden" name="bill_item[]" value="${x.equip.id}" />${x.equip.item_name}</td>
                                        <td id="price${x.equip.id}">${x.equip.final_price}</td>
                                        <td><input class="form-control form-control-sm billing-item-qty" data-id="${x.equip.id}" type="number" id="qty${x.equip.id}" name="quantity[${x.equip.id}]" value="1"></td>
                                        <td><input class="form-control form-control-sm billing-item-amount" type="number" id="amt${x.equip.id}" name="amount[${x.equip.id}]" value="${Number(x.equip.final_price)}"></td>
                                        <td>
                                            <button type="button" class="btn btn-xs remove-btn" title="Remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>

                                        </tr>
                                    `;
                                    $("#bill-equip-add-list").append(myElement2);
                                    calculateBill();
                                }
                            });
                        }
                        $(".billing-item-qty").on('keyup',function(e){
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
        });



    });

</script>

@endpush
