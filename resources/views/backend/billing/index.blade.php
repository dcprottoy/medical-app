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
                    @include('backend.billing.registeredpatioent')
                    @include('backend.billing.createpatient')
                    @include('backend.billing.billlist')
                    @include('backend.billing.referrencelist')
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
                                    <select class="form-control form-control-sm"  name="investigation_type_id" id="investigation_type_id">
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
        function billItemAdd(id){
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
                                myElement2="";
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
                                <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" type="text" id="amt${x.equip.id}" data-id="${result.item.id}" name="amount[${x.equip.id}]" value="${Number(x.equip.price)*Number(x.quantity)}" readonly></td>
                                <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${x.equip.id}" data-discountable="${x.equip.discountable}" type="text" id="dis-per${x.equip.id}" name="discount_per[${x.equip.id}]" value="${discount_per_cal}" ${Boolean(x.equip.discountable)?"":"readonly"}></td>
                                <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${x.equip.id}" type="text" id="dis-amt${x.equip.id}" name="discount_amt[${x.equip.id}]" value="${disc_amount}" ${Boolean(x.equip.discountable)?"":"readonly"}></td>
                                <td><input class="form-control form-control-sm billing-item-total-payable w-100 text-center" data-id="${x.equip.id}" type="text" id="total-payable${x.equip.id}" name="total_payable[${x.equip.id}]" value="${((Number(x.equip.price)*Number(x.quantity))-disc_amount).toFixed(2)}"></td>
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
        }

        $(".bill-item-add").on('click',function(){
            let id = $(this).attr('data-id');
            billItemAdd(id);
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

        $("#print-bill-top").on('click',function(e){
            let billID = $("#bill-no").text();
            if(billID){
                window.open("{{url('billing-pdf')}}/"+Number(billID), '_blank');

            }else{
                toastr.error('Please Select Bill');
            }

        })

        $("#investigation_type_id").on('change',function(e){
            value = $(this).val();
            console.log(value);
                if(value){
                    $.ajax({
                        type: "PUT",
                        url: "{{url('billitemsearch')}}",
                        data: {
                            'search':value,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            console.log(response);
                            let element="";
                            response.map(x=>{
                            element +=`
                            <tr class="bill-item-add" data-id="${x.id}">
                                    <td>${x.id}</td>
                                    <td>${x.item_name}</td>
                                    <td>${x.price}</td>
                                </tr>`

                            });
                            $("#bill-item-list").empty();
                            $("#bill-item-list").append(element);
                            $(".bill-item-add").on('click',function(){
                                let id = $(this).attr('data-id');
                                billItemAdd(id);
                            });

                        },
                        error:function(req,status,err){
                            console.log(err);
                        }
                    });
                }else{
                    toastr.error('Please Select Bill');
                }

        });


    });

</script>

@endpush
