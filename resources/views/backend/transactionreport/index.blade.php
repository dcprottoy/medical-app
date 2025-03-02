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
                     <div class="card-body">
                        <div class="row">
                            <div class="form-group  col-lg-3">
                                <label>From Date</label>
                                <div class="input-group date" id="from_date" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" value="{{@$date1 ? $date1:$date}}" data-target="#from_date" name="from_date" id="date"/>
                                    <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  col-lg-3">
                                <label>To Date</label>
                                <div class="input-group date" id="to_date" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datetimepicker-input"  value="{{@$date2 ? $date2:$date}}"  data-target="#to_date" name="to_date" id="date"/>
                                    <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-sm btn-success mt-4">&nbsp;Show&nbsp;</button>
                            </div>
                        </div>
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
                                <td class="text-center" style ="{{$item->due_amount > 0 ? 'color:red;font-weight:bold;':''}}">
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
