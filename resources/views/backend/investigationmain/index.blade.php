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
                                            <input type="text" class="form-control form-control-sm" name='investigation_name' placeholder="Investigation Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Investigation Type</label>
                                          <select class="form-control form-control-sm"  name="investigation_type_id">
                                            <option value="" selected disabled>Please select</option>
                                            @foreach($inv_types as $inv_type)
                                            <option value="{{$inv_type->id}}">{{$inv_type->name_eng}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" class="form-control form-control-sm" name='price' placeholder="Price" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Discount Percentage</label>
                                            <input type="text" class="form-control form-control-sm" name='discount_per' placeholder="Discount Percentage">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Discount Amount</label>
                                            <input type="text" class="form-control form-control-sm" name='discount_amount' placeholder="Discount Amount" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
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
                                <th style="width: 5%">
                                    SL
                                </th>
                                <th style="width: 30%" class="text-center">
                                    Name
                                </th>
                                <th style="width: 15%" class="text-center">
                                    Investigation Type
                                </th>
                                <th style="width: 9%" class="text-center">
                                    Price
                                </th>
                                <th style="width: 8%" class="text-center">
                                    Discount Perc
                                </th>
                                <th style="width: 8%" class="text-center">
                                    Discount Amt
                                </th>
                                <th class="text-center" style="width: 20%">
                                    Action
                                </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($inv_main as $item)
                          <tr>
                              <td>
                                  #
                              </td>
                              <td class="project-state text-center">
                                {!! $item->investigation_name !!}
                              </td>
                              <td class="project-state text-center">
                                {!! $item->type->name_eng !!}
                              </td>
                              <td class="project-state text-center">
                                {!! $item->price !!}
                              </td>
                              <td class="project-state text-center">
                                {!! $item->discount_per !!}
                              </td>
                              <td class="project-state text-center">
                                {!! $item->discount_amount !!}
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
                    {{ $inv_main->links('pagination::bootstrap-4')}}
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
                                            <input type="text" class="form-control form-control-sm" name='investigation_name' id="u-investigation-name" placeholder="Investigation Name" required>
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
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" class="form-control form-control-sm" name='price' id="u-price" placeholder="Price" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Discount Percentage</label>
                                            <input type="text" class="form-control form-control-sm" name='discount_per' id="u-discount-per" placeholder="Discount Percentage">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Discount Amount</label>
                                            <input type="text" class="form-control form-control-sm" name='discount_amount' id="u-discount-amount" placeholder="Discount Amount" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
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
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('investigationmain/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-investigation-name').val(result.investigation_name);
                        $('#u-investigation-type-id').val(result.investigation_type_id);
                        $('#u-price').val(result.price);
                        $('#u-discount-per').val(result.discount_per);
                        $('#u-discount-amount').val(result.discount_amount);
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
    });
</script>

@endpush
