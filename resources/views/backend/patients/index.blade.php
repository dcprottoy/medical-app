@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Patients"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Patients Entry</h3>
                </div>
                <form action="{{route('patients.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control form-control-sm" name='name' placeholder="Patients Name" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Contact No.</label>
                                    <input type="text" class="form-control form-control-sm" name='contact_no' placeholder="Contact Number" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Emergency Contact No.</label>
                                    <input type="text" class="form-control form-control-sm" name='emr_cont_no' placeholder="Emergency Contact Number">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control form-control-sm" name='address' placeholder="Address" required>
                                </div>
                            </div>
                            <div class="form-group  col-lg-3">
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
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Patient</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style = "min-height:500px;">
                    <table id="example1" class="table table-sm table-striped projects">
                        <thead>
                            <tr>
                            <th style="width: 5%">
                                Patient ID
                            </th>
                            <th style="width: 30%" class="text-center">
                                Name
                            </th>
                            <th style="width: 15%" class="text-center">
                                Contact No
                            </th>
                            <th style="width: 15%" class="text-center">
                                Address
                            </th>
                            <th style="width: 15%" class="text-center">
                                Gender
                            </th>
                            <th style="width: 10%" class="text-center">
                                Age
                            </th>
                            <th class="text-center" style="width: 25%">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $item)
                            <tr>
                                <td>
                                    {!! $item->patient_id !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                {!! $item->name !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->contact_no !!}
                                </td>
                                <td  class="text-Left">
                                    {!! $item->address !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->sex == 'M' ? '<span class="badge badge-success">Male</span>' :( $item->sex == 'F' ? '<span class="badge badge-info">Female</span>' : '<span class="badge badge-warning">Other</span>') !!}
                                </td>
                                <td  class="text-center">
                                    {!! $item->age !!}
                                </td>

                                <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm update" data-id="{{$item->id}}">
                                        <i style="font-size:10px;" class="fas fa-pencil-alt">
                                        </i>

                                    </a>
                                    {{-- <a class="btn btn-danger btn-sm" href="{{route('patients.delete',$item->id)}}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a> --}}
                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
                                        <i style="font-size:10px;" class="fas fa-trash">
                                        </i>

                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="m-3">
                    {{-- {{ $patients->links('pagination::bootstrap-4')}} --}}
                </div>
            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Patient</h4>
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
                                <h4 class="modal-title">Update Patient Information</h4>
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
                                                <input type="text" class="form-control form-control-sm" id='u-name' name='name' placeholder="Patients Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Contact No.</label>
                                                <input type="text" class="form-control form-control-sm" id='u-contact_no' name='contact_no' placeholder="Contact Number" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Emergency Contact No.</label>
                                                <input type="text" class="form-control form-control-sm" id='u-emr_cont_no' name='emr_cont_no' placeholder="Emergency Contact Number">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control form-control-sm" id='u-address' name='address' placeholder="Address" required>
                                            </div>
                                        </div>
                                        <div class="form-group  col-lg-3">
                                            <label>Birth Date</label>
                                            <div class="input-group date" id="birth_date_u" data-target-input="nearest">
                                                <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#birth_date_u" name="birth_date" id="u-date"/>
                                                <div class="input-group-append" data-target="#birth_date_u" data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 d-flex">
                                            <div class="form-group pr-2">
                                                <label>Year</label>
                                                <input type="text" class="form-control form-control-sm" name='year' id="u-year" placeholder="Year">
                                            </div>
                                            <div class="form-group pr-2">
                                                <label>&nbsp;Month</label>
                                                <input type="text" class="form-control form-control-sm" name='month' id="u-month" placeholder="Month">
                                            </div>
                                            <div class="form-group pr-2">
                                                <label>&nbsp;Day</label>
                                                <input type="text" class="form-control form-control-sm" name='day' id="u-day" placeholder="Day">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <div class="form-check m-2">
                                            <input class="form-check-input" type="radio" id="u-male" name="sex" value="M" required>
                                            <label class="form-check-label">Male</label>
                                            </div>
                                            <div class="form-check m-2">
                                            <input class="form-check-input" type="radio" name="sex" id="u-female" value="F">
                                            <label class="form-check-label">Female</label>
                                            </div>
                                            <div class="form-check m-2">
                                                <input class="form-check-input" type="radio" name="sex" id="u-other" value="O">
                                                <label class="form-check-label">Other</label>
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
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $(".delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('patients/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
        });

        $(function () {
            $('#birth_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#birth_date_u').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        })

        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('patients/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-name').val(result.name);
                        $('#u-contact_no').val(result.contact_no);
                        $('#u-emr_cont_no').val(result.emr_cont_no);
                        $('#u-address').val(result.address);
                        $('#u-date').val(result.birth_date);
                        $('#u-year').val(result.da['year']);
                        $('#u-month').val(result.da['month']);
                        $('#u-day').val(result.da['day']);
                        if(result.sex == 'M'){
                            $('#u-male').attr('checked','checked');
                        }else if(result.sex == 'F'){
                            $('#u-female').attr('checked','checked');
                        }else if(result.sex == 'O'){
                            $('#u-other').attr('checked','checked');
                        }

                    }
                });
            let link = "{{url('patients/')}}/"+id;
            $('#update-modal').attr('action',link);
            $('#modal-default-update').modal('show');

        });
        $("#example1").DataTable({"order": [[0, 'desc']],
        "responsive": true, "lengthChange": false, "autoWidth": false,
        //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

</script>

@endpush
