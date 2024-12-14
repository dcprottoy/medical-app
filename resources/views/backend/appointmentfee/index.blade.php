@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Appointment Fee"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Appointment Fee Entry</h3>
                </div>
                <form action="{{route('appointfee.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Appointment Type</label>
                                  <select class="form-control form-control-sm"  name="appointment_type_id">
                                    <option value="" selected disabled>Please select</option>
                                    @foreach($appointtypes as $appointtype)
                                    <option value="{{$appointtype->id}}">{{$appointtype->name_eng}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Day Differece Range</label>
                                    <input type="number" class="form-control form-control-sm" name="day_diff" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Fee Amount</label>
                                    <input type="number" class="form-control form-control-sm" name="fee_amount" min="0" value="0">
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>&nbsp;</label><br>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="defaultCheckbox" name="is_default" value=1>
                                    <label for="defaultCheckbox" class="custom-control-label">Default Fee</label>
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
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
                            <th style="width: 15%" class="text-center">
                                Appointment Type
                            </th>
                            <th style="width: 15%" class="text-center">
                                Day Differece Range
                            </th>
                            <th style="width: 15%" class="text-center">
                                Fee Amount
                            </th>
                            <th style="width: 15%" class="text-center">
                                Default
                            </th>
                            <th style="width: 15%" class="text-center">
                                Status
                            </th>
                            <th class="text-center" style="width: 25%">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($appointfees as $item)
                            <tr>
                                <td>
                                   #
                                </td>
                                <td  class="text-center">
                                    {!! $item->appointmenttype->name_eng !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->day_diff !!}
                                    </td>
                                <td  class="text-center">
                                    {!! $item->fee_amount !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->is_default  ? '<span class="badge badge-success">Default</span>' :'<span class="badge badge-warning">Not Default</span>' !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->status == 'Y' ? '<span class="badge badge-success">Active</span>' :'<span class="badge badge-warning">Dactive</span>' !!}
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
                    {{ $appointfees->links('pagination::bootstrap-4')}}
                </div>
            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Examination</h4>
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
                                <h4 class="modal-title">Update Examination Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                              <label>Appointment Type</label>
                                              <select class="form-control form-control-sm"  name="appointment_type_id" id="u-appointment_type_id">
                                                <option value="" selected disabled>Please select</option>
                                                @foreach($appointtypes as $appointtype)
                                                <option value="{{$appointtype->id}}">{{$appointtype->name_eng}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Day Differece Range</label>
                                                <input type="number" class="form-control form-control-sm" name="day_diff" id="u-day_diff" min="0" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Fee Amount</label>
                                                <input type="number" class="form-control form-control-sm" name="fee_amount" id="u-fee_amount" min="0" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label>&nbsp;</label><br>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="u-defaultCheckbox" name="is_default" value=1>
                                                <label for="u-defaultCheckbox" class="custom-control-label">Default Fee</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
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
            let link = "{{url('appointfee/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
        });
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('appointfee/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-appointment_type_id').val(result.appointment_type_id);
                        $('#u-day_diff').val(result.day_diff);
                        $('#u-fee_amount').val(result.fee_amount);
                        if(result.is_default == 1){
                            $('#u-defaultCheckbox').attr('checked','checked');
                        }else{
                            $('#u-defaultCheckbox').removeAttr('checked');
                        }
                        if(result.status == 'Y'){
                            $('#u-active').attr('checked','checked');
                        }else if(result.status == 'N'){
                            $('#u-deactive').attr('checked','checked');
                        }

                    }
                });
            let link = "{{url('appointfee/')}}/"+id;
            $('#update-modal').attr('action',link);
            $('#modal-default-update').modal('show');

        });


    });

</script>

@endpush
