@extends('backend.layout.main')
@section('body-part')
<style>
    .edit-delete-icon:hover{
        cursor: pointer;
        scale: 1.1;
        transition-duration: 0.1s ease;
    }

</style>
<div class="content-wrapper">
    <!-- <x-breadcumb title="Investigation Details"/> -->
    <x-upper-right-button title="Back" link="investigationmain.home" icon="fas fa-arrow-left"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Investigation Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <b>Investigation Name : </b>{!! $inv_main->item_name !!}
                                </div>
                                <div class="col-sm-4">
                                    <b>Discount Percentage :</b>  {!! $inv_main->discount_per !!}
                                </div>
                                <div class="col-sm-4">
                                    <b >Price : </b>  {!! $inv_main->price !!}
                                </div>
                                <div class="col-sm-4">
                                    <b>Investigation Type :</b>  {!! @$inv_main->investigationType->name_eng !!}
                                </div>
                                <div class="col-sm-4">
                                    <b>Discount Amount :</b>  {!! $inv_main->discount_amount !!}
                                </div><div class="col-sm-4">
                                    <b style="color:brown">Final Price : </b>  {!! $inv_main->final_price !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="container border p-2 shadow-sm bg-white" style="min-height:350px;">
                        <form action="{{route('investsection.save')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <h5> <b> Sections Setup</b></h5><hr>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control form-control-sm" name='investigation_main_id' value="{{$inv_main->id}}">
                                        <input type="text" class="form-control form-control-sm" name='section_name' id='section-name' placeholder="Section Name"  required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-sm" name='serial' id='serial' placeholder="Serial No."  required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="reset" class="btn btn-sm btn-danger  float-left">&nbsp;Clear&nbsp;</button>
                                    <button type="submit" class="btn btn-sm btn-warning float-right">&nbsp;Save&nbsp;</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="container border pt-2 shadow-sm bg-white" style="min-height:350px;">
                        <h5><b>Details Setup</b></h5><hr>
                        <form action="{{route('investdetails.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                    <select class="form-control form-control-sm"  name="investigation_section_id">
                                        <option value="" selected disabled>Investigation Section</option>
                                        @foreach($inv_sections as $inv_sec)
                                        <option value="{{$inv_sec->id}}">{{$inv_sec->section_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-sm" name='serial' id='serial' placeholder="Serial No."  required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name='details_name' id='details-name' placeholder="Detail's Name"  required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="4" placeholder="Refference Range" id="note-field" name="refference_value"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" class="form-control form-control-sm" name='investigation_main_id' value="{{$inv_main->id}}">
                                    <button type="reset" class="btn btn-sm btn-danger  float-left">&nbsp;Clear&nbsp;</button>
                                    <button type="submit" class="btn btn-sm btn-warning float-right">&nbsp;Save&nbsp;</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="container border pt-2 shadow-sm bg-white" style="min-height:350px;">
                        <h5><b>Equipment Setup</b></h5><hr>
                        <form action="{{route('investequipset.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm"  name="investigation_equip_id">
                                        <option value="" selected disabled>Investigation Equipment</option>
                                        @foreach($inv_equips as $inv_equip)
                                            <option value="{{$inv_equip->id}}">{{$inv_equip->item_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-sm" name='quantity' id='equip-qty' placeholder="Quantity"  required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" class="form-control form-control-sm" name='investigation_main_id' value="{{$inv_main->id}}">
                                    <button type="reset" class="btn btn-sm btn-danger  float-left">&nbsp;Clear&nbsp;</button>
                                    <button type="submit" class="btn btn-sm btn-warning float-right">&nbsp;Save&nbsp;</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-sm-4 border p-2" style="min-height:300px;">
                                    <h5><em>Investigation Section Information</em></h5><hr>
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <th>SL.</th>
                                            <th>Section Name</th>
                                            <th>Order No.</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach($inv_sections as $inv_sec)
                                            <tr>
                                                <td>#</td>
                                                <td>{{ $inv_sec->section_name }}</td>
                                                <td>{{ $inv_sec->serial }}</td>
                                                <td>
                                                    <i class="fas fa-edit p-1 edit-delete-icon section-edit" style="color:#004369;" data-id="{{$inv_sec->id}}"></i>
                                                    <i class="fas fa-trash p-1 edit-delete-icon section-delete" style="color:#DB1F48" data-id="{{$inv_sec->id}}"></i>
                                                </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="modal-section-update">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <form action="" method="post" id="update-modal-section">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Investigation Section Information</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control form-control-sm" name='investigation_main_id' value="{{$inv_main->id}}">
                                                                    <input type="text" class="form-control form-control-sm" name='section_name' id='u-section_name' placeholder="Section Name"  required>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control form-control-sm" name='serial' id='u-serial' placeholder="Serial No."  required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-section-delete">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <form action="" method="post" id="delete-modal-section">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Section</h4>
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
                                </div>
                                <div class="col-sm-5 border p-2" style="min-height:300px;">
                                    <h5><em>Investigation Details Information</em></h5><hr>
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Serial</th>
                                            <th>Reference Value</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach($inv_sections as $inv_sec)
                                                <tr>
                                                    <td><b>Section : </b>{{ $inv_sec->section_name }}</td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                @php
                                                    $details = collect($inv_details)->where('investigation_section_id',$inv_sec->id)->sortBy('serial');
                                                    // dd($inv_details);
                                                @endphp

                                                @foreach($details as $item)
                                                    <tr>
                                                        <td>{{ $item->details_name }}</td>
                                                        <td>{{ $item->serial }}</td>
                                                        <td><textarea class="form-control bg-transparent" rows="4" readonly >{!! $item->refference_value !!}</textarea></td>
                                                        <td>
                                                            <i class="fas fa-edit p-1 edit-delete-icon detail-edit" style="color:#004369;" data-id="{{$item->id}}"></i>
                                                            <i class="fas fa-trash p-1 edit-delete-icon detail-delete" style="color:#DB1F48" data-id="{{$item->id}}"></i>
                                                        </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            @php
                                                $details_without_section = collect($inv_details)->whereNull('investigation_section_id')->sortBy('serial');

                                            @endphp
                                             <tr>
                                                <td><b>Section:</b>N/A</td>
                                                <td colspan="3"></td>
                                            </tr>
                                            @foreach($details_without_section as $item)
                                            <tr>
                                                <td>{{ $item->details_name }}</td>
                                                <td>{{ $item->serial }}</td>
                                                <td><textarea class="form-control bg-transparent" rows="4" readonly >{!! $item->refference_value !!}</textarea></td>
                                                <td>
                                                    <i class="fas fa-edit p-1 edit-delete-icon detail-edit" style="color:#004369;" data-id="{{$item->id}}"></i>
                                                    <i class="fas fa-trash p-1 edit-delete-icon detail-delete" style="color:#DB1F48" data-id="{{$item->id}}"></i>
                                                </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="modal-detail-update">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <form action="" method="post" id="update-modal-detail">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Investigation Section Information</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                <select class="form-control form-control-sm"  name="investigation_section_id" id="u-investigation-section-id">
                                                                    <option value="" selected disabled>Investigation Section</option>
                                                                    @foreach($inv_sections as $inv_sec)
                                                                    <option value="{{$inv_sec->id}}">{{$inv_sec->section_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control form-control-sm" name='serial' id='u-detail-serial' placeholder="Serial No."  required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm" name='details_name' id='u-detail-name' placeholder="Detail's Name"  required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" rows="4" placeholder="Refference Range" id="u-refference-value" name="refference_value"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <input type="hidden" class="form-control form-control-sm" name='investigation_main_id' value="{{$inv_main->id}}">
                                                                <button type="reset" class="btn btn-sm btn-danger  float-left">&nbsp;Clear&nbsp;</button>
                                                                <button type="submit" class="btn btn-sm btn-warning float-right">&nbsp;Save&nbsp;</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-detail-delete">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <form action="" method="post" id="delete-modal-detail">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Detail</h4>
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
                                </div>
                                <div class="col-sm-3 border p-2" style="min-height:300px;">
                                    <h5><em>Investigation Equipment Information</em></h5><hr>
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach($inv_equip_sets as $item)
                                                <tr>
                                                    <td>{{ $item->equip->item_name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>
                                                        <i class="fas fa-edit p-1 edit-delete-icon equipt-edit" style="color:#004369;" data-id="{{$item->id}}"></i>
                                                        <i class="fas fa-trash p-1 edit-delete-icon equipt-delete" style="color:#DB1F48" data-id="{{$item->id}}"></i>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="modal-equipt-update">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <form action="" method="post" id="update-modal-equipt">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Investigation Section Information</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <select class="form-control form-control-sm"  name="investigation_equip_id" id="u-investigation-equip-id">
                                                                    <option value="" selected disabled>Investigation Equipment</option>
                                                                    @foreach($inv_equips as $inv_equip)
                                                                        <option value="{{$inv_equip->id}}">{{$inv_equip->item_name}}</option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control form-control-sm" name='quantity' id='u-equip-qty' placeholder="Quantity"  required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <input type="hidden" class="form-control form-control-sm" name='investigation_main_id' value="{{$inv_main->id}}">
                                                                <button type="reset" class="btn btn-sm btn-danger  float-left">&nbsp;Clear&nbsp;</button>
                                                                <button type="submit" class="btn btn-sm btn-warning float-right">&nbsp;Save&nbsp;</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-equipt-delete">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <form action="" method="post" id="delete-modal-equipt">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Equipment</h4>
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
                                </div>
                            </div>
                        </div>
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
                                <h4 class="modal-title">Update investigationmain Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control form-control-sm" name='name' id='u-name' placeholder="Patients Name"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact No.</label>
                                            <input type="text" class="form-control form-control-sm" name='contact_no' id='u-contact_no' placeholder="Contact Number"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Emergency Contact No.</label>
                                            <input type="text" class="form-control form-control-sm" name='emr_cont_no' id='u-emr_cont_no' placeholder="Emergency Contact Number" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control form-control-sm" name='address' id='u-address' placeholder="Address"  required>
                                        </div>
                                    </div>
                                    <div class="form-group  col-lg-3">
                                        <label>Birth Date</label>
                                        <div class="input-group date" id="birth_date_update" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#birth_date_update" name="birth_date"  id="u-date"/>
                                            <div class="input-group-append" data-target="#birth_date_update" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Department</label>
                                          <select class="form-control" name="department_id" id="u-department_id" >
                                            @foreach($inv_types as $inv_type)
                                            <option value="{{$inv_type->id}}">{{$inv_type->name_eng}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-8 d-flex">
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="sex" id='u-male' value="M"  required>
                                          <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check m-2">
                                          <input class="form-check-input" type="radio" name="sex" id='u-female' value="F" >
                                          <label class="form-check-label">Female</label>
                                        </div>
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="radio" name="sex" id='u-other'  value="O" >
                                            <label class="form-check-label">Other</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Degree</label>
                                            <input type="text" class="form-control form-control-sm" name='degree' id="u-degree" placeholder="Degree"   required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Specialities</label>
                                            <input type="text" class="form-control form-control-sm" name='specialities' id="u-specialities" placeholder="Specialities" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Brand Image</h4>
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
  $(function () {
    $('#birth_date').datetimepicker({
        format: 'YYYY-MM-DD',
    });
    $('#birth_date_update').datetimepicker({
        format: 'YYYY-MM-DD',
    });
  })
</script>
<script>
    $(document).ready(function(){
        $(".section-edit").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('investsection/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-section_name').val(result.section_name);
                        $('#u-serial').val(result.serial);
                    }
                });
            let link = "{{url('investsection/')}}/"+id;
            $('#update-modal-section').attr('action',link);
            $('#modal-section-update').modal('show');
        });

        $(".section-delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('investsection/')}}/"+id;
            $('#modal-section-delete').modal('show');
            $('#delete-modal-section').attr('action',link);
        });

        $(".detail-edit").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('investdetails/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-investigation-section-id').val(result.investigation_section_id);
                        $('#u-detail-serial').val(result.serial);
                        $('#u-detail-name').val(result.details_name);
                        $('#u-refference-value').val(result.refference_value);
                    }
                });
            let link = "{{url('investdetails/')}}/"+id;
            $('#update-modal-detail').attr('action',link);
            $('#modal-detail-update').modal('show');
        });
        $(".detail-delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('investdetails/')}}/"+id;
            $('#modal-detail-delete').modal('show');
            $('#delete-modal-detail').attr('action',link);
        });

        $(".equipt-edit").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('investequipset/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-investigation-equip-id').val(result.investigation_equip_id);
                        $('#u-equip-qty').val(result.quantity);

                    }
                });
            let link = "{{url('investequipset/')}}/"+id;
            $('#update-modal-equipt').attr('action',link);
            $('#modal-equipt-update').modal('show');
        });
        $(".equipt-delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('investequipset/')}}/"+id;
            $('#modal-equipt-delete').modal('show');
            $('#delete-modal-equipt').attr('action',link);
        });
    });
</script>

@endpush
