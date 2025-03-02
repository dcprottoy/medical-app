@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Brand Image"/>
    <x-upper-right-button title="Back" link="patients.home" icon="fas fa-arrow-left"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Patients</h3>
                        </div>
                        <form action="{{route('patients.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="Patients Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Contact No.</label>
                                            <input type="text" class="form-control" placeholder="Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" placeholder="Address">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="text" class="form-control" placeholder="Age">
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
    $('#reservationdate').datetimepicker({
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

