@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Investigation Equipment"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Investigation Equipment Entry</h3>
                </div>
                <form action="{{route('investigationequipments.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Equipment Name</label>
                                    <input type="text" class="form-control form-control-sm" name='equipment_name' placeholder="Equipment Name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control form-control-sm" name='price' placeholder="Price">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Discount Percentage</label>
                                    <input type="text" class="form-control form-control-sm" name='discount_per' placeholder="Discount Percentage">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Discount Amount</label>
                                    <input type="text" class="form-control form-control-sm" name='discount_amount' placeholder="Discount Amount">
                                </div>
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
                        <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                        <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Advice</h3>
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
                                SL
                            </th>
                            <th style="width: 30%" class="text-center">
                                Equipment Name
                            </th>
                            <th style="width: 15%" class="text-center">
                                Price
                            </th>
                            <th style="width: 15%" class="text-center">
                                Discount Percentage
                            </th>
                            <th style="width: 15%" class="text-center">
                                Discount Amouont
                            </th>
                            <th class="text-center" style="width: 25%">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($inv_equip as $item)
                            <tr>
                                <td>
                                   #
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                {!! $item->equipment_name !!}
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
                    {{ $inv_equip->links('pagination::bootstrap-4')}}
                </div>
            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Investigation Equipment</h4>
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
                                <h4 class="modal-title">Update Investigation Equipment Information</h4>
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
                                                <label>Equipment Name</label>
                                                <input type="text" class="form-control form-control-sm" id='u-equipment_name' name='equipment_name' placeholder="Equipment Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control form-control-sm" id='u-price' name='price' placeholder="Price" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Discount Percentage</label>
                                                <input type="text" class="form-control form-control-sm" id='u-discount_per' name='discount_per' placeholder="Discount Percentage" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Discount Amount</label>
                                                <input type="text" class="form-control form-control-sm" id='u-discount_amount' name='discount_amount' placeholder="Discount Amount" >
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
            let link = "{{url('investigationequipments/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
        });
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('investigationequipments/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-equipment_name').val(result.equipment_name);
                        $('#u-price').val(result.price);
                        $('#u-discount_per').val(result.discount_per);
                        $('#u-discount_amount').val(result.discount_amount);
                        if(result.status == 'Y'){
                            $('#u-active').attr('checked','checked');
                        }else if(result.sex == 'N'){
                            $('#u-deactive').attr('checked','checked');
                        }

                    }
                });
            let link = "{{url('investigationequipments/')}}/"+id;
            $('#update-modal').attr('action',link);
            $('#modal-default-update').modal('show');

        });


    });

</script>

@endpush
