@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Brand Image"/>
    <x-upper-right-button title="Add New" link="brand-image.create" icon="fas fa-plus"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Brand Image</h3>
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
                  <table class="table table-striped projects">
                      <thead>
                          <tr>
                            <th style="width: 5%">
                                SL
                            </th>
                            <th style="width: 30%" class="text-center">
                                Image
                            </th>
                            <th style="width: 15%" class="text-center">
                                Type
                            </th>
                            <th style="width: 15%" class="text-center">
                                Showing Date
                            </th>
                            <th style="width: 10%" class="text-center">
                                Status
                            </th>
                            <th class="text-center" style="width: 25%">
                                Action
                            </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($images as $item)
                          <tr>
                              <td>
                                  #
                              </td>
                              <td class="justify-content-center row">
                               <img src="{!! @url($item->Image) !!}" width="195px" height="59px" />
                              </td>
                              <td  class="text-center">
                                {!! $item->Type == 'R' ? 'Regular' : 'Special' !!}
                              </td>
                              <td  class="text-center">
                                {!! @$item->SpecialDate ? $item->SpecialDate : '' !!}
                              </td>
                              <td class="project-state text-center">
                                {!! $item->Status == 'Y' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactive</span>' !!}
                              </td>
                              <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm" href="{{route('brand-image.edit',$item->id)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    {{-- <a class="btn btn-danger btn-sm" href="{{route('brand-image.delete',$item->id)}}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a> --}}
                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
                <div class="m-3">
                    {{ $images->links('pagination::bootstrap-4')}}
                  </div>
                <!-- /.card-body -->
              </div>
              <div class="modal fade" id="modal-default-test">
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
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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
            let link = "{{url('dashboard/brand-image/')}}/"+id;
            $('#modal-default-test').modal('show');
            $('#delete-modal').attr('action',link);
        });

      });
</script>

@endpush
