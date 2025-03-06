@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Collection Summary"/>
    <div class="content">
        <div class="container-fluid">
            <div class="col-sm-4">
                <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Bill Collection Overview</h3>
                    <div class="card-tools">
                    <a href="#" class="btn btn-sm btn-tool">
                        <i class="fas fa-bars"></i>
                    </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="d-flex flex-column text-right">
                            <span class="text-muted">Today Collectable Amount</span>
                            <span class="font-weight-bold">
                                <i class="ion ion-android-arrow-up text-success"></i> 12%
                            </span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="d-flex flex-column text-right">
                                <span class="text-muted">Today Collectable Amount</span>
                                <span class="font-weight-bold">
                                    <i class="ion ion-android-arrow-up text-success"></i> 12%
                                </span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center mb-0">
                    <p class="text-danger text-xl">
                        <i class="ion ion-ios-people-outline"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                        <i class="ion ion-android-arrow-down text-danger"></i> 1%
                        </span>
                        <span class="text-muted">REGISTRATION RATE</span>
                    </p>
                    </div>
                    <!-- /.d-flex -->
                </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('#from_date').datetimepicker({
                format: 'YYYY-MM-DD',
        });
        $('#to_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });
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
