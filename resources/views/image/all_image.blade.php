@extends('larasnap::layouts.app', ['class' => 'Image-create'])
@section('title','Image Management')
@section('content')

<style>
    .error {
        color: #f70909;
        font-size: 15px;
        position: relative;
        line-height: 1;
        width: 100%;
    }
</style>
<!-- <title>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.css">

</title> -->
<!-- Page Heading  Start-->

<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <br> <br>
                    <form method="POST" action="{{route('over_all_image.store')}}" enctype="multipart/form-data" class="form-horizontal" id="my_form" autocomplete="on">
                    @method('POST')    
                    @csrf

                        <div class="row">                      
                      
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="images" class="control-label">Upload Images<small class="text-danger required">*</small></label>
                                    <input name="images" type="file" id="images" class="form-control" value="{{ old('images') }}">
                                    @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                           
                            <div class="table-responsive">
                <table class="table noExl" id="myTab">
                    <thead>
                        <tr>         

                            <th>S.No</th>
                            <th>Image</th>
                            <th>Added Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($all_images as $i => $all_image)

                        <tr>		
                        
                              <td>{{ ++$i }}</td>
                              <td><img src="{{ url('/all_images/'. $all_image->images) }}" width="80px" height="80px" alt=""></td>
                              <td>{{date('M d,Y', strtotime($all_image->created_at))}}</td>  
                              <td><form id="department_deleteForm" action="{{route('all_image.destroy',$all_image->id)}}" method="GET" id="deleteForm">
                                   @csrf
                                    @method('GET')   
                                    <a href="{{route('image.all_image_export',$all_image->id)}}" title="Image Download"><button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-download"></i></button></a>
                                                              
                                    <a onclick="deleteModel_departments({{$all_image->id}})" title="Delete "><button data-toggle="modal" data-target="#small_departments" class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                </form>
                              </td>                                              
                              
                        </tr>

                          @empty
                           <tr>
                              <td class="text-center" colspan="12">No Record found!</td>
                           </tr>
                           @endforelse

                    </tbody>
                </table>
               
            </div>
            
                        
                            <div class="col-md-12 no-label">
                                <div class="form-group"  style="float: right;">
                                    <input type="submit" value="Save" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="small_departments" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body delete-modal text-center">
                <p><img src="{{asset('images/sure.jpg')}}" alt=""></p>
                <h4><b>Are you sure?</b></h4>
                <input type="hidden" id="departments_id" value="" class="deleteAdmin">
                <p>Do you really want to delete these record? this process cannot be undone.</p>
            </div>
            <div class="modal-footer p-0">
                <button type="button" onclick="triggerDelete_departments()" class="btn btn-danger" data-dismiss="modal">Yes Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- Page Content End-->
@endsection
<script>
    var roleDelteURL_dep = "{{route('all_image.destroy',':id')}}"

    function deleteModel_departments(id) {
        jQuery('#departments_id').val(id);
    }

    function triggerDelete_departments() {
        var action_url = jQuery("#deleteForm").prop('action');
        let roleId = jQuery('#departments_id').val();

        action_url = roleDelteURL_dep.replace(':id', roleId);

        jQuery("#department_deleteForm").attr('action', action_url);

        jQuery("#department_deleteForm").submit();
    }
</script>