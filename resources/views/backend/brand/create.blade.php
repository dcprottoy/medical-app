@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Brand Image"/>
    <x-upper-right-button title="Back" link="brand-image.home" icon="fas fa-arrow-left"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Brand Image</h3>
                        </div>
                        <form action="{{route('brand-image.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div style="display:block;display: flex; justify-content: center;">
                                    <img src="{{url('dummy.jpg')}}" alt="Brand Image" id="imgPreview" height="59px" width="195px"/>
                                </div>
                                <div class="form-group">
                                    <label for="brand-image">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="brand-image" name="Image">
                                        <label class="custom-file-label" for="brand-image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <em style="color:red;">Image dimension must be 195px X 59px</em>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>Display Type</label>
                                        <select class="form-control" name = "Type" id="type">
                                          <option value = "R" selected>Regular</option>
                                          <option value = "S">Special</option>
                                        </select>
                                      </div>
                                    <div class="form-group  col-lg-6">
                                        <label>Special Date</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="SpecialDate" id="date" disabled/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6 d-flex">
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="Status" value="Y">
                                          <label class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="Status" value="N" checked>
                                          <label class="form-check-label">Deactive</label>
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

