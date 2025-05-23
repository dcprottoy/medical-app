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
    <x-breadcumb title="Due Collection"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-1">
                    <button class="btn btn-sm btn-secondary float-right" id="print-bill-top">Print
                        <i class="fas fa-print" style="color:#fafcfd;" ></i>
                    </button>
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
                            <h6>Select Bill</h6>
                        </div>
                        <div class="card-body p-1">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group text-center">
                                        <input type="text" class="form-control form-control-sm" id="billlist" name="bill_list" placeholder="Bill ID">
                                    </div>
                                </div>
                                <div class="col-sm-12" style="height:580px;font-size:14px;">
                                    <table class="table table-sm table-striped">
                                        <tbody id="bill_search_list">
                                        @foreach($bill_mains as $item)
                                            <tr>
                                                <td id="main-bill-id{!! $item->id !!}" class="due-bill" data-bill-id="{{ $item->bill_id }}">{!! $item->bill_id !!}</td>

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
                        <form action="{{route('duecollection.save')}}" method="post" enctype="multipart/form-data" id="new_billing_details_create">
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
                                                <th style="width:15%;text-align:center;">Delivery Date</th>
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
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_dis_amt" id="bill-dis-amt"  disabled/></td>
                                                    <th style="text-align: right;">Total Amount :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_amount" id="bill-amount"  disabled/></td>
                                                    <th style="text-align: right;">Total Paid :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_paid_amount" id="bill-paid-amount" disabled/></td>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: right;">Discount in Percentage :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_in_per" id="bill-in-per" disabled/></td>
                                                    <th style="text-align: right;">Net Payable Amount :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_total_amount" id="bill-total-amount" disabled/></td>
                                                    <th style="text-align: right;">Previous Due :</th>
                                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_due_amount" id="bill-due-amount" disabled/></td>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: right;">Discount :</th>
                                                    <td><input class="form-control form-control-sm due-collection-field" type="number" step="any" name="new_discount" id="new-discount"/></td>
                                                    <th style="text-align: right;">New Paid Amount :</th>
                                                    <td><input class="form-control form-control-sm due-collection-field" type="number" step="any" name="new_paid" id="new-paid"/></td>
                                                    <th style="text-align: right;">New Due :</th>
                                                    <td><input class="form-control form-control-sm due-collection-field" type="number" step="any" name="new_due" id="new-due"/></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-right m-0 p-1">
                                    <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                    <button type="submit" class="btn btn-sm btn-success" id="save-btn">&nbsp;Save&nbsp;</button>
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
          }else if((!isNaN(discountPer)) && discountPer != 0){
            newFinalAmount = (Number(billAmount) - ((Number(discountPer)*Number(billAmount))/100)).toFixed(2);
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
            let discount_amt = $("#dis-amt"+id).val();
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
            calculateBill();
        }
        $(".final-bill-field").on('keyup',function(e){
            if(e.target.name == "bill_dis_amt"){
                $("#bill-in-per").val(0);
            }else if(e.target.name == "bill_in_per"){
                let billAmount =  $("#bill-amount").val();
                let discountPer =  $(this).val();
                let amtValue = ((Number(discountPer)/100)*Number(billAmount)).toFixed(2);
                $("#bill-dis-amt").val(amtValue);
            }
            finalBillCalculation();
        });
        $("#bill-item-search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#bill-item-list tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
        $(".bill-item-add").on('click',function(){
            let id = $(this).attr('data-id');
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
                            let disc_amount = ((Number(result.item.discount_per)/100)*Number(result.item.price)).toFixed(2);
                            let  myElement =`<tr>
                                    <td>
                                        <input type="hidden" name="bill_item[]" value="${result.item.id}" />
                                        <input type="hidden" name="service_category_id[${result.item.id}]" value="${result.item.service_category_id}" />
                                        ${result.item.item_name}
                                    </td>
                                    <td id="price${result.item.id}">${result.item.price}</td>
                                    <td><input class="form-control form-control-sm billing-item-qty w-100 text-center" data-id="${result.item.id}" type="text" id="qty${result.item.id}" name="quantity[${result.item.id}]" value="1"></td>
                                    <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" type="text" id="amt${result.item.id}" name="amount[${result.item.id}]" value="${Number(result.item.price)}" readonly></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${result.item.id}" type="text" id="dis-per${result.item.id}" name="discount_per[${result.item.id}]" value="${result.item.discount_per}"></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${result.item.id}" type="text" id="dis-amt${result.item.id}" name="discount_amt[${result.item.id}]" value="${disc_amount}"></td>
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
                                         disc_amount = ((Number(x.equip.discount_per)/100)*Number(x.equip.price)).toFixed(2);

                                        myElement2 +=`<tr>
                                    <td>
                                        <input type="hidden" name="bill_item[]" value="${x.equip.id}" />
                                        <input type="hidden" name="service_category_id[${x.equip.id}]" value="${x.equip.service_category_id}" />
                                        ${x.equip.item_name}
                                    </td>
                                    <td id="price${x.equip.id}">${x.equip.price}</td>
                                    <td><input class="form-control form-control-sm billing-item-qty w-100 text-center" data-id="${x.equip.id}" type="text" id="qty${x.equip.id}" name="quantity[${x.equip.id}]" value="${x.quantity}"></td>
                                    <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" type="text" id="amt${x.equip.id}" name="amount[${x.equip.id}]" value="${Number(x.equip.price)}" readonly></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${x.equip.id}" type="text" id="dis-per${x.equip.id}" name="discount_per[${x.equip.id}]" value="${x.equip.discount_per}"></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${x.equip.id}" type="text" id="dis-amt${x.equip.id}" name="discount_amt[${x.equip.id}]" value="${disc_amount}"></td>
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
        });
        $("#new_billing_details_create").submit(function(e){
            e.preventDefault();
            let formdata = $('#new_billing_details_create').serialize();
            let check = $("#bill_main_id").val();
                if(check){
                    $.ajax({
                    type: "POST",
                    url: "{{url('duecollection')}}",
                    data: formdata,
                    success: function(response) {
                        if('error' in response){
                            toastr.error(response.error);
                        }else{
                            console.log(response);
                            toastr.success('Bill Details Saved');
                            $('#save-btn').prop('disabled',true);
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
        $(".due-collection-field").on('keyup',function(e){
            let discount = $("#new-discount").val();
            let payable = $("#bill-due-amount").val();
            let paid = $("#new-paid").val();
            let due = (Number(payable)-(Number(discount)+Number(paid))).toFixed(2);
            $("#new-due").val(due);
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
                        $("#bill_main_id").val(response.main.bill_id);
                        $("#bill-amount").val(Number(response.main.total_amount).toFixed(2));
                        $("#bill-dis-amt").val(Number(response.main.discount_amount).toFixed(2));
                        $("#bill-in-per").val(Number(response.main.discount_percent).toFixed(2));
                        $("#bill-total-amount").val(Number(response.main.payable_amount).toFixed(2));
                        $("#bill-paid-amount").val(Number(response.main.paid_amount).toFixed(2));
                        $("#bill-due-amount").val(Number(response.main.due_amount).toFixed(2));
                        $("#new-discount").val(0);
                        $("#new-paid").val(0);
                        $("#new-due").val(Number(response.main.due_amount).toFixed(2));
                        response.details.map(x=>{
                          let  myElement =`<tr>
                                    <td>${x.item_name}</td>
                                    <td id="price${x.item_id}">${x.item_rate}</td>
                                    <td style="text-align:center;">${x.quantity}</td>
                                    <td style="text-align:center;">${Number(x.price)}</td>
                                    <td style="text-align:center;">${x.discount_percent}</td>
                                    <td style="text-align:center;">${x.discount_amount}</td>
                                    <td style="text-align:center;">${Number(x.final_price).toFixed(2)}</td>
                                    <td style="text-align:center;">${x.delivery_date}</td>
                                    </tr>
                                `;
                                if(x.service_category_id == 2){
                                    $("#bill-item-add-list").append(myElement);
                                }else if(x.service_category_id == 3){
                                    $("#bill-equip-add-list").append(myElement);
                                }else if(x.service_category_id == 4){
                                    $("#bill-service-add-list").append(myElement);
                                }
                                $('#save-btn').prop('disabled',false);
                        });

                    }
                });

        }
        $(".due-bill").on('click',function(e){
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
                    url: "{{url('duecollection')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<tr>
                                <td id="main-bill-id${x.id}" class="due-bill" data-bill-id="${x.bill_id}">${x.bill_id}</td>
                            </tr>`
                        });
                        $("#bill_search_list").empty();
                        $("#bill_search_list").append(element);

                        $(".due-bill").on('click',function(e){
                            let id = $(this).attr('data-bill-id');
                            editBill(id);
                        });
                    }
                });
        });

        $("#print-bill-top").on('click',function(e){
            let billID = $("#bill-no").text();
            if(billID){
                window.open("{{url('due-pdf')}}/"+Number(billID), '_blank');

            }else{
                toastr.error('Please Select Bill');
            }

        })

    });

</script>

@endpush
