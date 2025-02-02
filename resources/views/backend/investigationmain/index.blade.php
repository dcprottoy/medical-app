@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Investigation"/>
    <div class="content">
        <div class="container-fluid">
        <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Investigations</h3>
                        </div>
                        <form action="{{route('investigationmain.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control form-control-sm" name='item_name' placeholder="Investigation Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Investigation Type</label>
                                          <select class="form-control form-control-sm"  name="investigation_type_id" id="investigation_type_id">
                                            <option value="" selected disabled>Please select</option>
                                            @foreach($inv_types as $inv_type)
                                            <option value="{{$inv_type->id}}">{{$inv_type->name_eng}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <input type="text" class="form-control form-control-sm" name='duration' placeholder="Investigation Duration" id="investigation-duration" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Investigation Group</label>
                                          <select class="form-control form-control-sm"  name="investigation_group_id">
                                            <option value="" selected disabled>Please select</option>
                                            @foreach($inv_groups as $inv_group)
                                            <option value="{{$inv_group->id}}">{{$inv_group->name_eng}}--{{$inv_group->room_no}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" step="any" class="form-control form-control-sm price" name='price' id="price"  placeholder="Price" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Discount Percentage</label>
                                            <input type="number" step="any" class="form-control form-control-sm price" name='discount_per' id="discount_per"  placeholder="Discount Percentage">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Discount Amount</label>
                                            <input type="number" step="any" class="form-control form-control-sm price" name='discount_amount' id="discount_amount"  placeholder="Discount Amount" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Final Price</label>
                                            <input type="number" step="any" class="form-control form-control-sm price" name='final_price' id="final_price"  placeholder="Final Price" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="hidden" name='service_category_id' value="2">
                                <button type="reset" class="btn btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                <button type="submit" class="btn btn-success">&nbsp;Save&nbsp;</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Investigation Main</h3>
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
                  <table class="table table-striped projects">
                      <thead>
                          <tr>
                                <th style="width: 3%">
                                    SL
                                </th>
                                <th style="width: 30%" class="text-center">
                                    Name
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Investigation Type
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Group & Room
                                </th>
                                <th style="width: 4%" class="text-center">
                                    Price
                                </th>
                                <th style="width: 4%" class="text-center">
                                    Discount
                                </th>
                                <th style="width: 4%" class="text-center">
                                    Final Price
                                </th>
                                <th style="width: 4%" class="text-center">
                                    Duration (Day)
                                </th>
                                <th class="text-center" style="width: 20%">
                                    Action
                                </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($bill_items as $item)
                          <tr>
                              <td>
                                  #
                              </td>
                              <td class="project-state text-center">
                                {!! $item->item_name !!}
                              </td>
                              <td class="project-state text-center">
                                {!! @$item->investigationType->name_eng !!}
                              </td>
                              <td class="project-state text-center">
                                {!! @$item->investigationGroup->name_eng !!}--{!! @$item->investigationGroup->room_no !!}
                              </td>
                              <td class="project-state text-center">
                                {!! $item->price !!}
                              </td>
                              <td class="project-state text-center">
                                {!! $item->discount_per !!} %<br>
                                {!! $item->discount_amount !!} taka
                              </td>
                              <td class="project-state text-center">
                                {!! $item->final_price !!}
                              </td>
                              <td class="project-state text-center">
                                {!! $item->duration !!}
                              </td>
                              {{-- <td class="project-state text-center">
                                {!! $item->status == 'Y' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactive</span>' !!}
                              </td> --}}
                              <td class="project-actions text-center">

                                    <a class="btn btn-info btn-sm update" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                    <a class="btn btn-warning btn-sm" href="{{route('investigationmain.edit',$item->id)}}">
                                    <i class="fas fa-cogs"></i>
                                    Setup
                                    </a>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
                <div class="m-3">
                    {{ $bill_items->links('pagination::bootstrap-4')}}
                </div>
            </div>
            <div class="modal fade" id="modal-default-update">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form action="" method="post" id="update-modal">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h4 class="modal-title">Update Investigation Main Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control form-control-sm" name='item_name' id="u-item-name" placeholder="Investigation Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Investigation Type</label>
                                          <select class="form-control form-control-sm"  name="investigation_type_id" id="u-investigation-type-id">
                                            <option value="" selected disabled>Please select</option>
                                            @foreach($inv_types as $inv_type)
                                            <option value="{{$inv_type->id}}">{{$inv_type->name_eng}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <input type="text" class="form-control form-control-sm" name='duration' id="u-duration" placeholder="Completion Duration" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Investigation Group</label>
                                          <select class="form-control form-control-sm"  name="investigation_group_id" id="u-investigation-group-id">
                                            <option value="" selected disabled>Please select</option>
                                            @foreach($inv_groups as $inv_group)
                                            <option value="{{$inv_group->id}}">{{$inv_group->name_eng}}--{{$inv_group->room_no}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" step="any" class="form-control form-control-sm u-price" name='price' id="u-price" placeholder="Price" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Discount Percentage</label>
                                            <input type="number" step="any" class="form-control form-control-sm u-price" name='discount_per' id="u-discount-per" placeholder="Discount Percentage">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Discount Amount</label>
                                            <input type="number" step="any" class="form-control form-control-sm u-price" name='discount_amount' id="u-discount-amount" placeholder="Discount Amount" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Final Price</label>
                                            <input type="number" step="any" class="form-control form-control-sm u-price" name='final_price' id="u-final-price" placeholder="Final Price" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <input type="hidden" name='service_category_id' value="2">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Brand Image</h4>
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        let duration_list = {!! $durations !!};
        console.log(duration_list);
        $("#investigation_type_id").on('change',function(e){
            let selected_value = $(this).val();
            console.log(selected_value);
            $('#investigation-duration').val(selected_value);
        });

        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('investigationmain/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-item-name').val(result.item_name);
                        $('#u-investigation-type-id').val(result.investigation_type_id);
                        $('#u-investigation-group-id').val(result.investigation_group_id);
                        $('#u-price').val(result.price);
                        $('#u-duration').val(result.duration);
                        $('#u-discount-per').val(result.discount_per);
                        $('#u-discount-amount').val(result.discount_amount);
                        $('#u-final-price').val(result.final_price);
                    }
                });
            let link = "{{url('investigationmain/')}}/"+id;
            $('#update-modal').attr('action',link);
            $('#modal-default-update').modal('show');

        });

        $(".delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('investigationmain/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
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
