<button class="btn btn-sm btn-primary"  data-toggle="modal" id="newptnbtn" data-target="#newPatient">New Patient</button>
<div class="modal fade" id="newPatient" tabindex="-1" role="dialog" aria-labelledby="newPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form action="{{route('patients.save')}}" method="post" enctype="multipart/form-data" id="new_patient_create">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="newPatientModalLabel">New Patient</h5>
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
                                        <label>Name</label>
                                        <input type="text" class="form-control form-control-sm" name='name' placeholder="Patients Name" required>
                                        <input type="hidden" name="save_type" value=3>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control form-control-sm" name='contact_no' placeholder="Contact Number" required>
                                    </div>
                                </div>
                                <div class="col-sm-3 d-flex">
                                    <div class="form-group pr-2">
                                        <label>Age</label>
                                        <input type="text" class="form-control form-control-sm" name='year' placeholder="Year">
                                    </div>
                                    <div class="form-group pr-2">
                                        <label>&nbsp;</label>
                                        <input type="text" class="form-control form-control-sm" name='month' placeholder="Month">
                                    </div>
                                    <div class="form-group pr-2">
                                        <label>&nbsp;</label>
                                        <input type="text" class="form-control form-control-sm" name='day' placeholder="Day">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Emergency Contact No.</label>
                                        <input type="text" class="form-control form-control-sm" name='emr_cont_no' placeholder="Emergency Contact Number">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control form-control-sm" name='address' placeholder="Address" >
                                    </div>
                                </div>
                                <div class="form-group  col-lg-4">
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
                                <div class="form-group col-lg-6 d-flex">
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

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                            <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
                        </div>

                </div>

            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){

        $(function () {
            $('.select2bs4').select2({
            theme: 'bootstrap4',
            })
            $('#birth_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });

        $('#new_patient_create').submit(function(e) {
                e.preventDefault();
                let formdata = $('#new_patient_create').serialize();
                console.log(formdata);
                $.ajax({
                    type: "POST",
                    url: "{{url('patients')}}",
                    data: formdata,
                    success: function(response) {
                            if('error' in response){
                                if('message' in response) {toastr.warning(response.message);}
                                toastr.error(response.error);
                            }else{
                                $("#patient-id").text(response.patient_id);
                                $("#patient-name").text(response.name);
                                $("#patient-gender").text(response.sex=='M'?'Male':(response.sex=='F'?'Female':'Other'));
                                $("#patient-age").text(response.age);
                                $('#new_patient_create').trigger("reset");
                                $('#newPatient').modal("hide");
                                toastr.success('New Patient Created');
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('billing')}}",
                                    data: {
                                            '_token':'{{ csrf_token() }}',
                                            patient_id:response.patient_id,
                                        },
                                    success: function(response) {
                                        $("#bill-date").text(response.bill_date);
                                        $("#bill-no").text(response.bill_id);
                                        $("#bill_main_id").val(response.bill_id);
                                        // $("#bill-item-add-list").empty();
                                        // $("#bill-service-add-list").empty();
                                        // $("#bill-equip-add-list").empty();
                                        // $("#bill-amount").val(0);
                                        // $("#bill-dis-amt").val(0);
                                        // $("#bill-in-per").val(0);
                                        // $("#bill-total-amount").val(0);
                                        // $("#bill-paid-amount").val(0);
                                        // $("#bill-due-amount").val(0);
                                        toastr.success('New Bill Is Created');
                                    },
                                });
                            }

                    },
                    error:function(req,status,err){
                        console.log(err);
                    }
                });
                console.log('Worked');
        });



    });

</script>

@endpush
