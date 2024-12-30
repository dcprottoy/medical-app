@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <!-- <x-breadcumb title="Investigation Details"/> -->
    <x-upper-right-button title="Back" link="investigationmain.home" icon="fas fa-arrow-left"/>
    <div class="content">
        <div class="container-fluid">
        <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Investigation Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <b>Investigation Name : </b>{!! $inv_main->investigation_name !!}
                                </div>
                                <div class="col-sm-4">
                                    <b>Discount Percentage :</b>  {!! $inv_main->discount_per !!}
                                </div>
                                <div class="col-sm-4">
                                    <b style="color:brown">Price : </b>  {!! $inv_main->price !!}
                                </div>
                                <div class="col-sm-4">
                                    <b>Investigation Type :</b>  {!! $inv_main->type->name_eng !!}
                                </div>
                                <div class="col-sm-4">
                                    <b>Discount Amount :</b>  {!! $inv_main->discount_amount !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Investigation Setup</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 border-right">
                            <div style="min-height:200px;">
                                Sections Setup<hr>
                            </div>
                            <div style="min-height:300px;">
                                Details Setup<hr>
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            Details<hr>
                        </div>
                        <div class="col-sm-3 border-left">
                            Equipment Setup<hr>
                        </div>
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
                                <h4 class="modal-title">Update investigationmain Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control form-control-sm" name='name' id='u-name' placeholder="Patients Name"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact No.</label>
                                            <input type="text" class="form-control form-control-sm" name='contact_no' id='u-contact_no' placeholder="Contact Number"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Emergency Contact No.</label>
                                            <input type="text" class="form-control form-control-sm" name='emr_cont_no' id='u-emr_cont_no' placeholder="Emergency Contact Number" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control form-control-sm" name='address' id='u-address' placeholder="Address"  required>
                                        </div>
                                    </div>
                                    <div class="form-group  col-lg-3">
                                        <label>Birth Date</label>
                                        <div class="input-group date" id="birth_date_update" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#birth_date_update" name="birth_date"  id="u-date"/>
                                            <div class="input-group-append" data-target="#birth_date_update" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Department</label>
                                          <select class="form-control" name="department_id" id="u-department_id" >
                                            @foreach($inv_types as $inv_type)
                                            <option value="{{$inv_type->id}}">{{$inv_type->name_eng}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-8 d-flex">
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="sex" id='u-male' value="M"  required>
                                          <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="sex" id='u-female' value="F" >
                                          <label class="form-check-label">Female</label>
                                        </div>
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="radio" name="sex" id='u-other'  value="O" >
                                            <label class="form-check-label">Other</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Degree</label>
                                            <input type="text" class="form-control form-control-sm" name='degree' id="u-degree" placeholder="Degree"   required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Specialities</label>
                                            <input type="text" class="form-control form-control-sm" name='specialities' id="u-specialities" placeholder="Specialities" required>
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
  $(function () {
    $('#birth_date').datetimepicker({
        format: 'YYYY-MM-DD',
    });
    $('#birth_date_update').datetimepicker({
        format: 'YYYY-MM-DD',
    });
  })
</script>
<script>
    $(document).ready(function(){
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('investigationmain/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-name').val(result.name);
                        $('#u-contact_no').val(result.contact_no);
                        $('#u-emr_cont_no').val(result.emr_cont_no);
                        $('#u-address').val(result.address);
                        $('#u-date').val(result.birth_date);
                        $('#u-department_id').val(result.department_id);
                        $('#u-degree').val(result.degree);
                        $('#u-specialities').val(result.specialities);
                        if(result.sex == 'M'){
                            $('#u-male').attr('checked','checked');
                        }else if(result.sex == 'F'){
                            $('#u-female').attr('checked','checked');
                        }else if(result.sex == 'O'){
                            $('#u-other').attr('checked','checked');
                        }

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
