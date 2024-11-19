@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Doctor"/>
    <x-upper-right-button title="Back" link="doctors.home" icon="fas fa-arrow-left"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Doctors Add</h3>
                        </div>
                        <form action="{{route('doctors.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control form-control-sm" name='name' placeholder="Doctor's Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact No.</label>
                                            <input type="text" class="form-control form-control-sm" name='contact_no' placeholder="Contact Number" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Emergency Contact No.</label>
                                            <input type="text" class="form-control form-control-sm" name='emr_cont_no' placeholder="Emergency Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control form-control-sm" name='address' placeholder="Address" required>
                                        </div>
                                    </div>
                                    <div class="form-group  col-lg-3">
                                        <label>Birth Date</label>
                                        <div class="input-group date" id="birth_date" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#birth_date" name="birth_date" id="date"/>
                                            <div class="input-group-append" data-target="#birth_date" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-8">
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="sex" value="M" required>
                                          <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="sex" value="F">
                                          <label class="form-check-label">Female</label>
                                        </div>
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="radio" name="sex" value="O">
                                            <label class="form-check-label">Other</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Degree</label>
                                            <input type="text" class="form-control form-control-sm" name='degree' placeholder="Degree" required>
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
  })
</script>
<script>
    $(document).ready(function(){
        $("#brand-image").on('change',function(e){
            $("#imgPreview").attr("src", URL.createObjectURL(e.target.files[0]));
        });
        $("#type").on('change',function(e){
            if($("#type").val() == 'S'){
                $('#date').attr('disabled',false);
            }else{
                $('#date').val('');
                $('#date').attr('disabled',true);
            }
        });
      });
</script>
@endpush

