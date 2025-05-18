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
@push('scripts')
<script>
    $(document).ready(function(){
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
                            $('#billList').modal("hide");
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
    });

</script>

@endpush
