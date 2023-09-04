@extends('larasnap::layouts.app', ['class' => 'employee-show'])
@section('title','Employee Management')
@section('content')
<!-- Page Heading  Start-->

<div class="d-sm-flex align-items-center justify-content-between mb-4">

</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('employee.index') }}" title="Back" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back
               </a>
               <br> <br>
               <div class="row">             
                
                  <div class="col-md-6">
                     <strong class="table-heading">Employee Details</strong>
                     				

                     <div class="d-flex border mb-2">
                        <div class="col-lg-3 bg-back">
                           <div class="header p-2">Name</div>
                        </div>
                        <div class="col-lg-9">
                           <div class="show-text p-2">
                              {{ $employees->name ? $employees->name : '- NA -' }}
                           </div>
                        </div>
                     </div>

                     <div class="d-flex border mb-2">
                        <div class="col-lg-3 bg-back">
                           <div class="header p-2">City</div>
                        </div>
                        <div class="col-lg-9">
                           <div class="show-text p-2">
                              {{ $employees->city ? $employees->city: '- NA -' }}
                           </div>
                        </div>
                     </div>

                     <div class="d-flex border mb-2">
                        <div class="col-lg-3 bg-back">
                           <div class="header p-2">Phone Number</div>
                        </div>
                        <div class="col-lg-9">
                           <div class="show-text p-2">
                              {{ $employees->phone_number ? $employees->phone_number: '- NA -' }}
                           </div>
                        </div>
                     </div>

                     <div class="d-flex border mb-2">
                        <div class="col-lg-3 bg-back">
                           <div class="header p-2">Email</div>
                        </div>
                        <div class="col-lg-9">
                           <div class="show-text p-2">
                              {{$employees->email ? $employees->email: '- NA -' }}
                           </div>
                        </div>
                     </div>


                     <div class="d-flex border mb-2">
                        <div class="col-lg-3 bg-back">
                           <div class="header p-2">Type</div>
                        </div>
                        <div class="col-lg-9">
                           <div class="show-text p-2">
                              {{$employees->type ? $employees->type: '- NA -' }}
                           </div>
                        </div>
                     </div>



                     <div class="d-flex border mb-2">
                        <div class="col-lg-3 bg-back">
                           <div class="header p-2">Agency Name</div>
                        </div>
                        <div class="col-lg-9">
                           <div class="show-text p-2">
                              {{$employees->agency_name ? $employees->agency_name: '- NA -' }}
                           </div>
                        </div>
                     </div>


                     <div class="d-flex border mb-2">
                        <div class="col-lg-3 bg-back">
                           <div class="header p-2">Employee Id</div>
                        </div>
                        <div class="col-lg-9">
                           <div class="show-text p-2">
                              {{$employees->emp_id ? $employees->emp_id: '- NA -' }}
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<style>
   .bg-back {

      background: #e7eff3;
      font-weight: 800;
      font-size: 16px;
   }
</style>
<!-- Page Content End-->
@endsection
