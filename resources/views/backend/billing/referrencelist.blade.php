<button class="btn btn-sm btn-secondary" data-toggle="modal" id="refereceListbtn" data-target="#refereceList">Reference List</button>
<div class="modal fade" id="refereceList" tabindex="-1" role="dialog" aria-labelledby="refereceListLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="refereceListModalLabel">Reference List</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group text-center">
                                <input type="text" class="form-control form-control-sm" id="referencelist" name="reference_list" placeholder="Reference ID">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group text-center">
                                <input type="text" class="form-control form-control-sm" id="referencelistAdd" name="name_eng" placeholder="Reference Name">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-sm btn-success" id="referencelistAddBtn" data-target="#refereceList">ADD</button>
                        </div>
                        <div class="col-sm-12 " style="height:300px;overflow-y:scroll;">
                            <table class="table table-sm table-striped">
                                <thead style="position: sticky;top: 0;background:white;">
                                    <th style="width:20%;">Reference ID</th>
                                    <th style="width:80%;">Reference Name</th>
                                </thead>
                                <tbody id="reference_search_list">

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
        function referenceSelect(id){
            let check = $("#bill_main_id").val();
            if(check){
                let reference_id = $("#bill-reference-id"+id).text();
                let reference_name = $("#bill-referenc-name"+id).text();
                $("#reference-id").text(reference_id);
                $("#reference-name").text(reference_name);
                console.log({"id":id,"reference_id":reference_id,"reference_name":reference_name});
                $.ajax({
                        url: "{{url('add/billreference')}}",
                        type: "POST",
                        data:{
                        '_token': '{{ csrf_token() }}',
                        'reference_id':reference_id,
                        'bill_main_id':check,
                        'reference_name':reference_name,
                        'add_type':1
                    },
                        success: function (response) {
                            if('success' in response)
                            toastr.success(response.success);
                            console.log(response);
                        }
                    });
                }else{
                    toastr.error('Please Select Bill');
                }

        }
        $("#refereceListbtn").on('click',function(e){
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('billreference')}}/",
                    data:{
                        'search':"",
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element+= `<tr class="reference-select" data-reference-id="${x.id}">
                                <td style="width:20%;" id="bill-reference-id${x.id}">${x.reference_id}</td>
                                <td style="width:80%;" id="bill-referenc-name${x.id}">${x.name_eng}</td>
                            </tr>`
                        });
                        $("#reference_search_list").empty();
                        $("#reference_search_list").append(element);
                        $(".reference-select").on('click',function(e){
                            let id = $(this).attr('data-reference-id');
                            referenceSelect(id);
                        });
                    }
                });
        })
        $("#referencelistAddBtn").on('click',function(e){

            let check = $("#bill_main_id").val();
            if(check){
                let reference_name = $("#referencelistAdd").val();
                if(reference_name !=""){
                    $.ajax({
                            url: "{{url('add/billreference')}}",
                            type: "POST",
                            data:{
                            '_token': '{{ csrf_token() }}',
                            'bill_main_id':check,
                            'name_eng':reference_name,
                            'add_type':2
                        },
                            success: function (response) {
                                if('success' in response)
                                toastr.success(response.success);
                                console.log(response);
                                $("#reference-id").text(response.data.reference_id);
                                $("#reference-name").text(response.data.name_eng);
                            }
                        });
                    }else{
                        toastr.error('Reference Name Can Not Be Empty');
                    }
                }else{
                    toastr.error('Please Select Bill');
                }
        });
        $("#referencelist").on('keyup',function(e){
            let ch_data = $("#referencelist").val();
            console.log(ch_data);
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('billreference')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element+= `<tr class="reference-select" data-reference-id="${x.id}">
                                <td style="width:20%;" id="bill-reference-id${x.id}">${x.reference_id}</td>
                                <td style="width:80%;" id="bill-referenc-name${x.id}">${x.name_eng}</td>
                            </tr>`
                        });
                        $("#reference_search_list").empty();
                        $("#reference_search_list").append(element);
                        $(".reference-select").on('click',function(e){
                            let id = $(this).attr('data-reference-id');
                            referenceSelect(id);
                        });
                    }
                });
        });
    });

</script>

@endpush
