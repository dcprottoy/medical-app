@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Service"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Service Entry</h3>
                </div>
                <form action="{{route('service.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Service Name</label>
                                    <input type="text" class="form-control form-control-sm" name='item_name' placeholder="Service Name">
                                </div>
                            </div>
                            <div class="col-6">
                                    <div class="form-group">
                                    <label>Service Type</label>
                                    <select class="form-control form-control-sm"  name="service_type_id">
                                        <option value="" selected disabled>Service Type</option>
                                        @foreach($service_types as $service_type)
                                        <option value="{{$service_type->id}}">{{$service_type->name_eng}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control form-control-sm price" name='price' id="price" placeholder="Price">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Discount Percentage</label>
                                    <input type="number" class="form-control form-control-sm price" name='discount_per' id="discount_per" placeholder="Discount Percentage">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Discount Amount</label>
                                    <input type="number" class="form-control form-control-sm price" name='discount_amount' id="discount_amount" placeholder="Discount Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Final Price</label>
                                <input type="number" class="form-control form-control-sm price" name='final_price' id="final_price" placeholder="Final Price">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Status</label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" value="Y" required checked>
                                  <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" value="N">
                                  <label class="form-check-label">Deactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="hidden" name='service_category_id' value="4">
                        <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                        <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Service</h3>
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
                            <th style="width: 4%">
                                SL
                            </th>
                            <th style="width: 15%" class="text-center">
                                Service Name
                            </th>
                            <th style="width: 15%" class="text-center">
                                Service Type
                            </th>
                            <th style="width: 10%" class="text-center">
                                Price
                            </th>
                            <th style="width:10%" class="text-center">
                                Discount Percentage
                            </th>
                            <th style="width: 10%" class="text-center">
                                Discount Amouont
                            </th>
                            <th style="width: 10%" class="text-center">
                                Final Price
                            </th>
                            <th style="width: 5%" class="text-center">
                                Status
                            </th>
                            <th class="text-center" style="width: 15%">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $item)
                            <tr>
                                <td>
                                   #
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                {!! $item->item_name !!}
                                </td>
                                <td  class="text-center">
                                    {!! @$item->serviceType->name_eng !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->price !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->discount_per !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->discount_amount !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->final_price !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->status == 'Y' ? '<span class="badge badge-success">Active</span>' :'<span class="badge badge-warning">Dactive</span>' !!}
                                </td>
                                <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm update" data-id="{{$item->id}}">
                                        <i style="font-size:10px;" class="fas fa-pencil-alt">
                                        </i>
                                    </a>
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
                    {{ $services->links('pagination::bootstrap-4')}}
                </div>
            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Service</h4>
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
                                <h4 class="modal-title">Update Service Information</h4>
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
                                                <label>Service Name</label>
                                                <input type="text" class="form-control form-control-sm" id='u-item-name' name='item_name' placeholder="Service Name" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                            <label>Service Type</label>
                                            <select class="form-control form-control-sm"  name="service_type_id" id="u-service-type-id">
                                                <option value="" selected disabled>Service Type</option>
                                                @foreach($service_types as $service_type)
                                                <option value="{{$service_type->id}}">{{$service_type->name_eng}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" class="form-control form-control-sm u-price" id='u-price' name='price' placeholder="Price" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Discount Percentage</label>
                                                <input type="number" class="form-control form-control-sm u-price" id='u-discount-per' name='discount_per' placeholder="Discount Percentage" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Discount Amount</label>
                                                <input type="number" class="form-control form-control-sm u-price" id='u-discount-amount' name='discount_amount' placeholder="Discount Amount" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Final Price</label>
                                                <input type="number" class="form-control form-control-sm u-price" id='u-final-price' name='final_price' placeholder="Final Price" >
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Status</label><br>
                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input" type="radio" id="u-active" name="status" value="Y" required>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="u-deactive" value="N">
                                                <label class="form-check-label">Deactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between" id="up-pl">
                                <input type="hidden" name='service_category_id' value="4">
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
        $(".delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('service/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
        });
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('service/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-item-name').val(result.item_name);
                        $('#u-price').val(result.price);
                        $('#u-service-type-id').val(result.service_type_id);
                        $('#u-discount-per').val(result.discount_per);
                        $('#u-discount-amount').val(result.discount_amount);
                        $('#u-final-price').val(result.final_price);
                        if(result.status == 'Y'){
                            $('#u-active').attr('checked','checked');
                        }else if(result.sex == 'N'){
                            $('#u-deactive').attr('checked','checked');
                        }

                    }
                });
            let link = "{{url('service/')}}/"+id;
            $('#update-modal').attr('action',link);
            $('#modal-default-update').modal('show');

        });

        $(".price").on('keyup',function(e){
            let price = $("#price").val();
            let discountPer = $("#discount_per").val();
            let discountAmount = $("#discount_amount").val();
            let finalPrice = $("#final_price").val();
            if(e.target.name=="price"){
                $("#discount_amount").val(0);
                $("#discount_per").val(0);
                $("#final_price").val(price);

            }else if(e.target.name=="discount_per"){

                let calPrice = Number(price)-(Number(price)*Number(discountPer))/100;
                $("#final_price").val(calPrice.toFixed(2));
                let discount = Number(price)-Number(calPrice);
                $("#discount_amount").val(discount.toFixed(2));

            }else if(e.target.name=="discount_amount"){

                let calPrice = Number(price)-Number(discountAmount);
                $("#final_price").val(calPrice.toFixed(2));
                let discount = (Number(discountAmount)/Number(price))*100;
                $("#discount_per").val(discount.toFixed(2));

            }
            console.log(e.target.name);
        });

        $(".u-price").on('keyup',function(e){
            let price = $("#u-price").val();
            let discountPer = $("#u-discount-per").val();
            let discountAmount = $("#u-discount-amount").val();
            let finalPrice = $("#u-final-price").val();
            if(e.target.name=="price"){
                $("#u-discount-amount").val(0);
                $("#u-discount-per").val(0);
                $("#u-final-price").val(price);

            }else if(e.target.name=="discount_per"){

                let calPrice = Number(price)-(Number(price)*Number(discountPer))/100;
                $("#u-final-price").val(calPrice.toFixed(2));
                let discount = Number(price)-Number(calPrice);
                $("#u-discount-amount").val(discount.toFixed(2));

            }else if(e.target.name=="discount_amount"){

                let calPrice = Number(price)-Number(discountAmount);
                $("#u-final-price").val(calPrice.toFixed(2));
                let discount = (Number(discountAmount)/Number(price))*100;
                $("#u-discount-per").val(discount.toFixed(2));

            }
            console.log(e.target.name);
        });


    });

</script>

@endpush
