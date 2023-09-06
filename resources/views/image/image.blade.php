@extends('larasnap::layouts.app', ['class' => 'employee-create'])
@section('title','Employee Management')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Add Imgae</h1>
</div>
<!-- Page Heading End-->				  
<!-- Page Content Start-->				  
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('employee.index') }}" title="Back to employee List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to employee List
               </a> 
               <br> <br> 
               <form method="POST" action="{{ route('image.store') }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
			   @csrf
                  <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="image" class="control-label">Upload Image</label> 
							<input name="image" type="file" id="image" class="form-control" >
							 @error('image')
							 <span class="text-danger">{{ $message }}</span>
							@enderror 	
						</div>
					</div>
					<input type="hidden" name="emp_id" value="{{$employee->id}}">
					<div class="col-md-4 no-label">
						<div class="form-group">
							<input type="submit" value="Save" class="btn btn-primary">
						</div>
					</div>
				  </div>
				  </form>
				  <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								@foreach($employeeImages as $employeeImage)
								<form id="department_deleteForm" action="{{route('image.destroy',$employeeImage->images->id)}}" method="GET" id="deleteForm">
                                   @csrf
                                    @method('GET')
								<img src="{{ url('storage/upload/employee_images/' . $employeeImage->images->name) }}" width="300px" height="300px" alt="">
								<span style="background-color: greenyellow;">{{date('M d,Y', strtotime($employeeImage->images->created_at))}}</span>
								<a onclick="deleteModel_departments({{$employeeImage->images->id}})" title="Delete "><button data-toggle="modal" data-target="#small_departments" class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
								</form>
								@endforeach
							</div>
							
						</div>
				  </div>
				   
		
             
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>



<script>
    var roleDelteURL_dep = "{{route('image.destroy',':id')}}"

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