@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Doctor"/>
    <x-upper-right-button title="Back" link="doctors.home" icon="fas fa-arrow-left"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Doctor Edit</h3>
                        </div>
                        <form action="{{route('doctors.update',$doctor->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control form-control-sm" name='name' placeholder="Patients Name" value="{{@$doctor->name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact No.</label>
                                            <input type="text" class="form-control form-control-sm" name='contact_no' placeholder="Contact Number" value="{{@$doctor->contact_no}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Emergency Contact No.</label>
                                            <input type="text" class="form-control form-control-sm" name='emr_cont_no' placeholder="Emergency Contact Number" value="{{@$doctor->emr_cont_no}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control form-control-sm" name='address' placeholder="Address" value="{{@$doctor->address}}"  required>
                                        </div>
                                    </div>
                                    <div class="form-group  col-lg-3">
                                        <label>Birth Date</label>
                                        <div class="input-group date" id="birthdate" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#birth_date" name="birth_date"  value="{{@$doctor->birth_date}}" id="date"/>
                                            <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-8">
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="sex" value="M" {!! @$doctor->sex=='M' ? 'checked' : "" !!} required>
                                          <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="sex" value="F" {!! @$doctor->sex=='F' ? 'checked' : "" !!}>
                                          <label class="form-check-label">Female</label>
                                        </div>
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="radio" name="sex"  value="O" {!! @$doctor->sex=='O' ? 'checked' : "" !!}>
                                            <label class="form-check-label">Other</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Degree</label>
                                            <input type="text" class="form-control form-control-sm" name='degree' placeholder="Degree" value="{{@$doctor->degree}}"  required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="reset" class="btn btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                <button type="submit" class="btn btn-success">&nbsp;Update&nbsp;</button>
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
    $('#reservationdate').datetimepicker({
        format: 'YYYY-MM-DD',
    });
  })
</script>
<script>
    $(document).ready(function(){

        $(function () {
            $('#birthdate').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        })


      });
</script>
@endpush

