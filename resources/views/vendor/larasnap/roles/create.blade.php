@extends('larasnap::layouts.app', ['class' => 'role-create'])
@section('title','Role Management')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Add Role</h1>
</div>
<!-- Page Heading End-->				  
<!-- Page Content Start-->				  
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('roles.index') }}" title="Back to Role List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Role List
               </a> 
               <br> <br> 
               <form method="POST" action="{{ route('roles.store') }}"  class="form-horizontal" autocomplete="off">
                  @csrf
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="name" class="control-label">Name(Slug)<small class="text-danger required">*</small></label> 
                           <input name="name" type="text" id="name" class="form-control lower-case" value="{{ old('name') }}">
                           @error('name')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror 							
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="shortform" class="control-label">Shotform(This will be used in employee id)<small class="text-danger required">*</small></label> 
                           <input name="shortform" type="text" id="shortform" class="form-control" value="{{ old('shortform') }}">
                           @error('shortform')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror 							
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="label" class="control-label">Label<small class="text-danger required">*</small></label> 
                           <input name="label" type="text" id="label" class="form-control" value="{{ old('label') }}">
                           @error('label')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror 							
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
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
<!-- Page Content End-->				  
@endsection