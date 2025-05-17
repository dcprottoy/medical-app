@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Collection Summary"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        @php
                            $totalPaidAmount = collect($transactions)->sum('paid_amount');
                            $totalDueCollectedAmount = collect($transactions)->where('prev_due','!=',0)->sum('paid_amount');
                            $totalBillCollectedAmount = collect($transactions)->where('prev_due','=',0)->sum('paid_amount');

                        @endphp
                        <div class="card-header border-0">
                            <h3 class="card-title"> Bill Collection Overview</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right text-info">Today Bill Collected Amount</span>
                                <span class="font-weight-bold text-xl text-info">
                                    {!! number_format($totalBillCollectedAmount,2) !!}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right  text-primary">Today Due Collected</span>
                                <span class="font-weight-bold text-xl  text-primary">
                                    {!! number_format($totalDueCollectedAmount,2) !!}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-lg text-right text-success">Today Total Collected Amount</span>
                                <span class="font-weight-bold text-xl text-success">
                                    {!! number_format($totalPaidAmount,2) !!}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-4">
                    <div class="card">
                        @php
                            $totalBillAmount = collect($transactions)->where('prev_due','=',0)->sum('total_amount');
                            $totalDiscountAmount = collect($transactions)->where('prev_due','=',0)->sum('discount_amount');
                            $totalCollectableAmount = collect($transactions)->where('prev_due','=',0)->sum('payable_amount');
                            $totalPaidAmount = collect($transactions)->where('prev_due','=',0)->sum('paid_amount');
                            $totalDueAmount = collect($transactions)->where('prev_due','=',0)->sum('due_amount');
                        @endphp
                        <div class="card-header border-0">
                            <h3 class="card-title"> Bill Collection Overview</h3>
                            <div class="card-tools">
                                ({{ collect($transactions)->where('prev_due','=',0)->count(); }})
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right">Today Bill Amount</span>
                                <span class="font-weight-bold text-xl">
                                    {!! number_format($totalBillAmount,2) !!}
                                </span>

                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right">Today Discount Amount</span>
                                <span class="font-weight-bold text-xl">
                                    {!! number_format($totalDiscountAmount,2) !!}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right">Today Collectable Amount</span>
                                <span class="font-weight-bold text-xl">
                                    {!! number_format($totalCollectableAmount,2) !!}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-centerborder-bottom  mb-3">
                                <span class="text-lg text-right text-success">Today Collected Amount</span>
                                <span class="font-weight-bold text-xl text-success">
                                    {!! number_format($totalPaidAmount,2) !!}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-lg text-right  text-danger">Today Due Amount</span>
                                <span class="font-weight-bold text-xl  text-danger">
                                    {!! number_format($totalDueAmount,2) !!}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        @php
                            $totalBillAmount = collect($transactions)->where('prev_due','!=',0)->sum('prev_due');
                            $totalDiscountAmount = collect($transactions)->where('prev_due','!=',0)->sum('discount_amount');
                            $totalCollectableAmount = collect($transactions)->where('prev_due','!=',0)->sum('payable_amount');
                            $totalPaidAmount = collect($transactions)->where('prev_due','!=',0)->sum('paid_amount');
                            $totalDueAmount = collect($transactions)->where('prev_due','!=',0)->sum('due_amount');
                        @endphp
                        <div class="card-header border-0">
                            <h3 class="card-title"> Due Collection Overview</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right">Today Due Amount</span>
                                <span class="font-weight-bold text-xl">
                                    {!! number_format($totalBillAmount,2) !!}
                                </span>

                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right">Today Discount Amount</span>
                                <span class="font-weight-bold text-xl">
                                    {!! number_format($totalDiscountAmount,2) !!}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right">Today Collectable Amount</span>
                                <span class="font-weight-bold text-xl">
                                    {!! number_format($totalCollectableAmount,2) !!}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <span class="text-lg text-right text-success">Today Collected Amount</span>
                                <span class="font-weight-bold text-xl text-success">
                                    {!! number_format($totalPaidAmount,2) !!}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-lg text-right  text-danger">Today Due Amount</span>
                                <span class="font-weight-bold text-xl  text-danger">
                                    {!! number_format($totalDueAmount,2) !!}
                                </span>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
