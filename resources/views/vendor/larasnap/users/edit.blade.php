@extends('larasnap::layouts.app', ['class' => 'user-edit'])
@section('title','User Management')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
</div>
<!-- Page Heading End-->				  
<!-- Page Content Start-->				  
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('users.index') }}" title="Back to User List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to User List
               </a> 
               <br> <br> 
               <form method="POST" action="{{ route('users.update', $user->id) }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
			   @csrf
			   @method('PUT')
                  <div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="first_name" class="control-label">First Name<small class="text-danger required">*</small></label> 
							<input name="first_name" type="text" id="first-name" class="form-control" value="{{ old('first_name', $user->userProfile ? $user->userProfile->first_name : '') }}">
							@error('first_name')
							 <span class="text-danger">{{ $message }}</span>
							@enderror 							
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="last-name" class="control-label">Last Name<small class="text-danger required">*</small></label> 
							<input name="last_name" type="text" id="last-name" class="form-control" value="{{ old('last_name', $user->userProfile ? $user->userProfile->last_name : '') }}">
							@error('last_name')
							 <span class="text-danger">{{ $message }}</span>
							@enderror 							
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="email" class="control-label">Email Address<small class="text-danger required">*</small></label> 
							<input name="email" type="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
							@error('email')
							 <span class="text-danger">{{ $message }}</span>
							@enderror 							
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="mobile-no" class="control-label">Mobile No<small class="text-danger required">*</small></label>
							<input name="mobile_no" type="number" id="mobile-no" class="form-control" onKeyPress="if(this.value.length==10) return false;" value="{{ old('mobile_no', $user->userProfile ? $user->userProfile->mobile_no : '') }}">
							@error('mobile_no')
							 <span class="text-danger">{{ $message }}</span>
							@enderror 
						</div>
					</div>
					
					
					
					<div class="col-md-4">
						<div class="form-group">
							<label for="agency_name" class="control-label">Agency Name<small class="text-danger required">*</small></label> 
							<input name="agency_name" type="text" id="agency_name" class="form-control" value="{{ old('agency_name', $user->userProfile ? $user->userProfile->agency_name : '') }}">
							@error('agency_name')
							 <span class="text-danger">{{ $message }}</span>
							@enderror 							
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="city" class="control-label">City<small class="text-danger required">*</small></label> 
							<input name="city" type="text" id="city" class="form-control" value="{{ old('city', $user->userProfile ? $user->userProfile->city : '') }}">
							@error('city')
							 <span class="text-danger">{{ $message }}</span>
							@enderror 								
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="">
							<label for="user_photo" class="control-label">Profile Picture</label> 
							<input name="user_photo" type="file" id="user-photo" class="form-control" >
							 @error('user_photo')
							 <span class="text-danger">{{ $message }}</span>
							@enderror 	
						</div>
                        <small>Allowed File Formats: jpg, jpeg, png</small>
                        <p><img src="{{ $user->avatar }}" style="width: 50px;" alt="Prof Picture" ></p>
					</div>
                    <div class="col-md-4 profile-status">
					<div class="form-group">
						<label class="form-control-label" for="input-address2">Status</label><br>
						<input type="radio" name="status" value="1" id="active" checked="">
						<label for="active">Active</label>					 
						<input type="radio" name="status" value="0" id="inactive" {{ old('status', $user->status)=="0" ? 'checked' : '' }} >
						<label for="inactive">InActive</label>					 
					</div>
                     </div>
					<div class="col-md-4 no-label">
						<div class="form-group">
							<input type="submit" value="Update" class="btn btn-primary">
						</div>
					</div>
				  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page Content End-->				  
@endsection