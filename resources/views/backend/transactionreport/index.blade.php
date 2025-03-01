@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Transaction Report"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Transaction Report</h3>
                </div>
                <form action="{{route('collectionreport.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> Service Category Name</label>
                                    <input type="text" class="form-control form-control-sm" name='name_eng' placeholder="Service Category Name">
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
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
                    </div> --}}
                    <div class="card-footer text-right">
                        <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                        <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaction Data</h3>
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
                            <th style="width: 12%">
                                Bill ID
                            </th>
                            <th  style="width: 16%" class="text-center">
                                Patient Name
                            </th>
                            <th class="text-center"  style="width: 12%">
                                Bill Amount
                            </th>
                            <th class="text-center"  style="width: 12%">
                                Payable Amount
                            </th>
                            <th class="text-center"  style="width: 12%">
                                Discount Amount
                            </th>
                            <th class="text-center"  style="width: 12%">
                                Paid Amount
                            </th>
                            <th class="text-center"  style="width: 12%">
                                Due Amount
                            </th>
                            <th  style="width: 12%">
                                Collection Date
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $item)
                            <tr>
                                <td class="text-center">
                                    {!! $item->referrence_id !!}
                                </td>
                                <td class="text-center">
                                {!! $item->patient_name !!}
                                </td>
                                <td class="text-center">
                                    {!! $item->total_amount !!}
                                </td>
                                <td class="text-center">
                                    {!! $item->payable_amount !!}
                                </td>
                                <td class="text-center">
                                {!! $item->discount_amount !!}
                                </td>
                                <td class="text-center">
                                    {!! $item->paid_amount !!}
                                </td>
                                <td class="text-center">
                                    {!! $item->due_amount !!}
                                </td>
                                <td class="text-center">
                                    {!! $item->transaction_date !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="m-3">
                    {{-- {{ $service_category->links('pagination::bootstrap-4')}} --}}
                </div>
            </div>
            {{-- <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Service Category</h4>
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
                                <h4 class="modal-title">Update Service Category Information</h4>
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
                                                <label>Service Category Name</label>
                                                <input type="text" class="form-control form-control-sm" id='u-name_eng' name='name_eng' placeholder="Service Category Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
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
            </div> --}}
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $(".delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('servicecategory/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
        });
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('servicecategory/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-name_eng').val(result.name_eng);
                        if(result.status == 'Y'){
                            $('#u-active').attr('checked','checked');
                        }else if(result.status == 'N'){
                            $('#u-deactive').attr('checked','checked');
                        }

                    }
                });
            let link = "{{url('servicecategory/')}}/"+id;
            $('#update-modal').attr('action',link);
            $('#modal-default-update').modal('show');

        });


    });

</script>

@endpush
