@extends('larasnap::layouts.app', ['class' => 'employee-edit'])
@section('title','Employee Management')
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
                    <a href="{{ route('employee.index') }}" title="Back" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back</a>
                    <br> <br>
                    <form method="POST" action="{{route('employee.update',$employees->id)}}" enctype="multipart/form-data" class="form-horizontal" id="my_form" autocomplete="on">
                    @method('PUT')
                        @csrf
                        <div class="row">                      
                      
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name<small class="text-danger required">*</small></label>
                                    <input name="name" type="text" id="name" class="form-control" value="{{ old('name',$employees->name) }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone_number" class="control-label">Phone Number<small class="text-danger required">*</small></label>
                                    <input name="phone_number" type="number" id="phone_number" class="form-control" value="{{ old('phone_number',$employees->phone_number) }}">
                                    @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email<small class="text-danger required">*</small></label>
                                    <input name="email" type="email" id="email" class="form-control" value="{{ old('email',$employees->email) }}">
                                
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city" class="control-label">City<small class="text-danger required">*</small></label>
                                    <input name="city" type="text" id="city" class="form-control" value="{{ old('city',$employees->city) }}">
                                
                                    @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="agency_name" class="control-label">Agency Name<small class="text-danger required">*</small></label>
                                    <input name="agency_name" type="text" id="agency_name" class="form-control" value="{{ old('agency_name',$employees->agency_name) }}">
                                
                                    @error('agency_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="type" name="type" class="control-label">Type<small class="text-danger required">*</small></label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="Distributer"@if($employees->type=="Distributer") selected @endif>Distributer</option>
                                        <option value="Employee"@if($employees->type=="Employee") selected @endif>Employee</option>
                                        <option value="ModernTrade"@if($employees->type=="ModernTrade") selected @endif>ModernTrade</option>
                                    
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        <input type="hidden" name="type" value="edit">
                        <input type="hidden" name="emp_id" value="{{$employees->id}}" >
                        
                            <div class="col-md-12 no-label">
                                <div class="form-group"  style="float: right;">
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
@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- change departments -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://someothersite.com/external.js"></script>



@endsection