{{-- patient info --}}
<li class="list-group-item">
    <div class="row">
        <div class="col-sm-8">
            <b>Patient ID :</b><em id="patient-id"></em>
            <br>
            <b>Name :</b> <span id="patient-name"></span>
            <br>
            <b>Contact No :</b> <span id="patient-contact"></span>
            <br>
            <b>Age :</b> <span id="patient-age"></span>
        </div>
        <div class="col-sm-4">
            <b>Date :</b> <em id="appon-date"></em>
            <br>
            <b>Serial No :</b><span id="serial-no"></span>
            <br>
            <b>Note :</b><em id="note">
        </div>
    </div>
</li>



/**
$.ajax({
    url: "{{ route('company.store') }}",
    type: "POST",
    data : data,
    dataType:"JSON",
    processData : false,
    contentType:false,

success: function(response) {
},
error: function(xhr, status, error) {

    iziToast.error({
        message: 'An error occurred: ' + error,
        position: 'topRight'
    });
}

});
**/
