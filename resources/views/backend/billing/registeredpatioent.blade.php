<button class="btn btn-sm btn-info" data-toggle="modal" id="allptnbtn" data-target="#allPatient">Registered Patient</button>
<div class="modal fade" id="allPatient" tabindex="-1" role="dialog" aria-labelledby="allPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="allPatientModalLabel">Registered Patient List</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group text-center">
                                <input type="text" class="form-control form-control-sm" id="patient" name="patient" placeholder="Patient ID">
                            </div>
                        </div>
                        <div class="col-sm-12 " style="height:300px;overflow-y:scroll;">
                            <table class="table table-sm table-striped">
                                <thead style="position: sticky;top: 0;background:white;">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Age</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="patient_search_list">
                                @foreach($patients as $patient)
                                    <tr>
                                        <td id="reg-patient-id{!! $patient->id !!}">{!! $patient->patient_id !!}</td>
                                        <td id="reg-patient-name{!! $patient->id !!}">{!! $patient->name !!}</td>
                                        <td id="reg-patient-gender{!! $patient->id !!}">{!! $patient->sex == 'M'?'Male':($patient->sex == 'F'?'Female':'Other') !!}</td>
                                        <td id="reg-patient-contact_no{!! $patient->id !!}">{!! $patient->contact_no !!}</td>
                                        <td id="reg-patient-age{!! $patient->id !!}">{!! $patient->age !!}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info reg-select" data-id="{!! $patient->id !!}">
                                                <i class="fas fa-check edit-delete-icon" style="color:#004369;" data-id="{{$patient->id}}"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        function patientSet(id){
                let patient_id = $("#reg-patient-id"+id).text();
                let patient_name = $("#reg-patient-name"+id).text();
                let patient_gender = $("#reg-patient-gender"+id).text();
                let patient_age = $("#reg-patient-age"+id).text();
                let appon_date = $("#reg-appon-date"+id).text();

                $("#patient-id").text(patient_id);
                $("#patient-name").text(patient_name);
                $("#patient-gender").text(patient_gender);
                $("#patient-age").text(patient_age);
                $("#appon-date").text(appon_date);
                console.log([id,patient_id]);
                $('#allPatient').modal('hide')
        }
        function regPatientBill(id){
            patientSet(id);
            let patient_id = $("#patient-id").text();
            $.ajax({
                    type: "POST",
                    url: "{{url('billing')}}",
                    data: {
                            '_token':'{{ csrf_token() }}',
                            patient_id:patient_id,
                        },
                    success: function(response) {
                            $("#bill-date").text(response.bill_date);
                            $("#bill-no").text(response.bill_id);
                            $("#bill_main_id").val(response.bill_id);
                            $("#bill-item-add-list").empty();
                            $("#bill-service-add-list").empty();
                            $("#bill-equip-add-list").empty();
                            $("#bill-amount").val(0);
                            $("#bill-dis-amt").val(0);
                            $("#bill-in-per").val(0);
                            $("#bill-total-amount").val(0);
                            $("#bill-paid-amount").val(0);
                            $("#bill-due-amount").val(0);
                            toastr.success('New Bill Is Created');
                    },
                });
        }
        $("#allptnbtn").on('click',function(e){
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('patient')}}/",
                    data:{
                        'search':"",
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                            element +=`<tr>
                                        <td id="reg-patient-id${x.id}">${x.patient_id}</td>
                                        <td id="reg-patient-name${x.id}">${x.name}</td>
                                        <td id="reg-patient-gender${x.id}">${x.sex == 'M'?'Male':(x.sex == 'F'?'Female':'Other')}</td>
                                        <td id="reg-patient-contact${x.id}">${x.contact_no}</td>
                                        <td id="reg-patient-age${x.id}">${x.age}</td>
                                        <td ><button class="btn btn-sm btn-info reg-select" data-id="${x.id}">
                                            <i class="fas fa-check p-1 edit-delete-icon" style="color:#004369;" data-id="${x.id}"></i>
                                        </button></td>
                                    </tr>`
                        });
                        $("#patient_search_list").empty();
                        $("#patient_search_list").append(element);
                        $(".reg-select").on('click',function(e){
                            let id = $(this).attr('data-id');
                            regPatientBill(id);
                        });
                    }
                });
        });

        $(".reg-select").on('click',function(e){
            let id = $(this).attr('data-id');
            regPatientBill(id);

        });

        $("#patient").on('keyup',function(e){
            let ch_data = $("#patient").val();
            console.log(ch_data);
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('patient')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                            element +=`<tr>
                                        <td id="reg-patient-id${x.id}">${x.patient_id}</td>
                                        <td id="reg-patient-name${x.id}">${x.name}</td>
                                        <td id="reg-patient-gender${x.id}">${x.sex == 'M'?'Male':(x.sex == 'F'?'Female':'Other')}</td>
                                        <td id="reg-patient-contact${x.id}">${x.contact_no}</td>
                                        <td id="reg-patient-age${x.id}">${x.age}</td>
                                        <td ><button class="btn btn-sm btn-info reg-select" data-id="${x.id}">
                                            <i class="fas fa-check p-1 edit-delete-icon" style="color:#004369;" data-id="${x.id}"></i>
                                        </button></td>
                                    </tr>`
                        });
                        $("#patient_search_list").empty();
                        $("#patient_search_list").append(element);
                        $(".reg-select").on('click',function(e){
                            let id = $(this).attr('data-id');
                            regPatientBill(id);
                        });
                    }
                });
        });

    });

</script>

@endpush
